<?php

namespace App\Services\Implementation;

use App\Mail\VerifyEmail;
use App\Services\Contracts\EmailVerificationServiceInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class EmailVerificationService implements EmailVerificationServiceInterface
{
    private $cacheTTL = 3600;
    private $cooldown = 60;
    private $maxAttempts = 4;
    private $attemptWindow = 900;

    private $decayMinutes = 5;

    /**
     * Send initial verification code
     */
    public function sendVerificationCode(array $data): array
    {
        $key = "verify_{$data['email']}";
        $cached = Cache::get($key);
        $now = now();

        if ($cached) {
            $windowStart = $cached['window_start'] ?? $now;
            $diffWindow = intval($now->diffInSeconds($windowStart));

            if ($cached['attempts'] >= $this->maxAttempts && $diffWindow < $this->attemptWindow) {
                return [
                    'status' => false,
                    'error_num' => 429,
                    'message' => __('message.too_many_attempts')
                ];
            }

            if ($diffWindow >= $this->attemptWindow) {
                $cached['attempts'] = 0;
                $cached['window_start'] = $now;
            }

            $diff = intval($cached['send_time']->diffInSeconds($now, false));
            if ($diff < $this->cooldown) {
                $remaining = $this->cooldown - $diff;
                return [
                    'status' => false,
                    'error_num' => 400,
                    'message' => __('message.wait_before_resend') . " {$remaining} " . __('message.seconds_remaining')
                ];
            }

            $otp = 1234; // أو rand(1000, 9999);
            $cached['otp'] = $otp;
            $cached['otp_time'] = $now;
            $cached['send_time'] = $now;
            $cached['attempts']++;

            Cache::put($key, $cached, $this->cacheTTL);
            Mail::to($data['email'])->send(new VerifyEmail($otp));

            return [
                'status' => true,
                'message' => __('message.verification_code_resent')
            ];
        }

        $otp = 1234; // أو rand(1000, 9999);

        Cache::put($key, [
            'data'         => $data,
            'otp'          => $otp,
            'otp_time'     => $now,
            'send_time'    => $now,
            'attempts'     => 1,
            'window_start' => $now,
        ], $this->cacheTTL);

        Mail::to($data['email'])->send(new VerifyEmail($otp));

        return [
            'status' => true,
            'message' => __('message.verification_code_sent')
        ];
    }


    /**
     * Resend verification code
     */
    public function resendVerificationCode(string $email): array
    {
        $key = "verify_{$email}";
        $cached = Cache::get($key);

        if (!$cached) {
            return [
                'status' => false,
                'error_num' => 400,
                'message' => __('message.invalid_email')
            ];
        }

        $now = now();
        $windowStart = $cached['window_start'] ?? $now;
        $diffWindow = intval($now->diffInSeconds($windowStart));

        if ($cached['attempts'] >= $this->maxAttempts && $diffWindow < $this->attemptWindow) {
            return [
                'status' => false,
                'error_num' => 429,
                'message' => __('message.too_many_attempts')
            ];
        }

        if ($diffWindow >= $this->attemptWindow) {
            $cached['attempts'] = 0;
            $cached['window_start'] = $now;
        }

        $diff = intval($cached['send_time']->diffInSeconds($now, false));
        if ($diff < $this->cooldown) {
            $remaining = $this->cooldown - $diff;
            return [
                'status' => false,
                'error_num' => 400,
                'message' => __('message.wait_before_resend') . " {$remaining} " . __('message.seconds_remaining')
            ];
        }

        // Generate OTP
        $otp = 1234; // أو rand(1000, 9999)

        $cached['otp'] = $otp;
        $cached['otp_time'] = $now;
        $cached['send_time'] = $now;
        $cached['attempts']++;

        Cache::put($key, $cached, $this->cacheTTL);
        Mail::to($email)->send(new VerifyEmail($otp));

        return [
            'status' => true,
            'message' => __('message.verification_code_resent')
        ];
    }

    /**
     * Verify entered code
     */
    public function verifyCode(string $email, string $otp): array
    {
        $key = "verify_{$email}";
        $cached = Cache::get($key);

        if (!$cached) {
            return [
                'status' => false,
                'error_num' => 400,
                'message' => __('message.invalid_email')
            ];
        }

        if ($cached['otp_time'] < now()->subMinutes($this->decayMinutes)) {
            return [
                'status' => false,
                'error_num' => 400,
                'message' => __('message.verification_code_expired')
            ];
        }

        if ($cached['otp'] != $otp) {
            return [
                'status' => false,
                'error_num' => 400,
                'message' => __('message.invalid_verification_code')
            ];
        }

        $data = $cached['data'];

        if ($cached['data']['type'] == 'forget_password') {
            $forget_cached = Cache::get('forget_password_' . $cached['data']['email']);
            if (!$forget_cached)
                return [
                    'status' => false,
                    'error_num' => 400,
                    'message' => __('message.invalid_email')
                ];

            $forget_cached['is_verified_forget_password'] = true;
            Cache::put('forget_password_' . $cached['data']['email'], $forget_cached, $this->cacheTTL);
        }

        Cache::forget($key);

        return [
            'status' => true,
            'message' => __('message.verification_success'),
            'data'    => $data
        ];
    }

    /**
     * Resend verification code to a new email (change email)
     */
    public function resetEmail(string $oldEmail, string $newEmail): array
    {
        $oldKey = "verify_{$oldEmail}";
        $cached = Cache::get($oldKey);

        if (!$cached) {
            return [
                'status' => false,
                'error_num' => 400,
                'message' => __('message.verification_session_expired')
            ];
        }

        $now = now();
        $windowStart = $cached['window_start'] ?? $now;
        $diffWindow = intval($now->diffInSeconds($windowStart));

        if ($cached['attempts'] < $this->maxAttempts && $diffWindow < $this->attemptWindow) {
            return [
                'status' => false,
                'error_num' => 400,
                'message' => __('message.cannot_change_email_yet')
            ];
        }

        $data = $cached['data'];
        $data['email'] = $newEmail;

        $otp = 1234; // أو rand(1000, 9999)

        $newKey = "verify_{$newEmail}";
        Cache::put($newKey, [
            'data'         => $data,
            'otp'          => $otp,
            'otp_time'     => $now,
            'send_time'    => $now,
            'attempts'     => 1,
            'window_start' => $now,
        ], $this->cacheTTL);

        Cache::forget($oldKey);

        Mail::to($newEmail)->send(new VerifyEmail($otp));

        return [
            'status' => true,
            'message' => __('message.verification_code_sent_to_new_email')
        ];
    }
}
