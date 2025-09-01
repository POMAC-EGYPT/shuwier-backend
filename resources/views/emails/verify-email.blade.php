<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ __('message.verify_your_email') }} - {{ config('app.name') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: {
                    {
                    app()->getLocale()=='ar'? "'Segoe UI', 'Tahoma', 'Arabic UI Text', Arial, sans-serif": "'Segoe UI', 'Helvetica Neue', Arial, sans-serif"
                }
            }

            ;
            line-height: 1.8;
            color: #000000;
            background-color: #ecf0f1;

            direction: {
                    {
                    app()->getLocale()=='ar'? 'rtl': 'ltr'
                }
            }

            ;
            padding: 30px 20px;
        }

        .email-container {
            max-width: 650px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 1px solid #e8eaed;
        }

        .header {
            background-color: #1e3c72;
            color: white;
            padding: 40px 30px;
            text-align: center;
        }


        .header-content {
            position: relative;
            z-index: 1;
        }

        .company-logo {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            margin: 0 auto 15px;
            display: block;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            line-height: 60px;
        }

        .company-logo img {
            width: 40px;
            height: 40px;
            vertical-align: middle;
            display: inline-block;
        }

        .header h1 {
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .header h2 {
            font-size: 18px;
            font-weight: 400;
            opacity: 0.95;
            letter-spacing: 0.5px;
        }

        .content {
            padding: 50px 40px;

            text-align: {
                    {
                    app()->getLocale()=='ar'? 'right': 'left'
                }
            }

            ;
            background: #ffffff;
        }

        .formal-greeting {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e8eaed;
        }

        .formal-greeting h3 {
            color: #1e3c72;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .formal-greeting .subtitle {
            color: #000000;
            font-size: 16px;
            font-style: italic;
            font-weight: 500;
        }

        .content p {
            margin-bottom: 25px;
            font-size: 17px;
            line-height: 1.8;
            color: #000000;
            text-align: justify;
        }

        .content p.intro {
            font-size: 18px;
            color: #000000;
            font-weight: 600;
        }

        .verification-section {
            background-color: #f8f9fa;
            border: 2px solid #dee2e6;
            border-radius: 12px;
            padding: 30px;
            margin: 40px 0;
            text-align: center;
        }


        .verification-title {
            font-size: 20px;
            color: #1e3c72;
            font-weight: 600;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .otp-label {
            font-size: 14px;
            color: #000000;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 600;
        }

        .otp-code {
            background-color: #28a745;
            color: white;
            font-size: 36px;
            font-weight: 800;
            padding: 25px 50px;
            border-radius: 12px;
            letter-spacing: 6px;
            direction: ltr;
            display: inline-block;
            min-width: 280px;
            border: 3px solid #ffffff;
            font-family: 'Courier New', monospace;
        }

        .security-notice {
            background-color: #fff3cd;
            border: 2px solid #ffc107;

            border- {
                    {
                    app()->getLocale()=='ar'? 'right': 'left'
                }
            }

            : 6px solid #fd7e14;
            color: #000000;
            padding: 20px;
            border-radius: 8px;
            margin: 30px 0;

            text-align: {
                    {
                    app()->getLocale()=='ar'? 'right': 'left'
                }
            }

            ;
        }


        .security-notice .notice-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #d4a425;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .security-notice p {
            margin-bottom: 0;
            font-size: 15px;
            font-weight: 600;
            color: #000000;
        }

        .formal-signature {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #e8eaed;

            text-align: {
                    {
                    app()->getLocale()=='ar'? 'right': 'left'
                }
            }

            ;
        }

        .formal-signature .regards {
            font-size: 17px;
            color: #000000;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .formal-signature .company-info {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;

            border- {
                    {
                    app()->getLocale()=='ar'? 'right': 'left'
                }
            }

            : 4px solid #1e3c72;
        }

        .formal-signature .company-name {
            font-size: 20px;
            font-weight: 700;
            color: #1e3c72;
            margin-bottom: 5px;
        }

        .formal-signature .department {
            font-size: 14px;
            color: #000000;
            font-style: italic;
            font-weight: 500;
        }

        .footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            text-align: center;
            padding: 30px;
            border-top: 3px solid #1e3c72;
        }

        .footer-content {
            max-width: 500px;
            margin: 0 auto;
        }

        .footer p {
            font-size: 13px;
            margin-bottom: 10px;
            line-height: 1.6;
            opacity: 0.9;
        }

        .footer .confidentiality {
            font-size: 11px;
            opacity: 0.7;
            font-style: italic;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .footer .copyright {
            font-weight: 600;
            color: #ffffff;
            font-size: 14px;
            margin-top: 10px;
        }

        /* Enhanced mobile responsiveness */
        @media screen and (max-width: 650px) {
            body {
                padding: 15px 10px;
            }

            .content {
                padding: 30px 25px;
            }

            .header {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 26px;
            }

            .otp-code {
                font-size: 30px;
                padding: 20px 35px;
                letter-spacing: 4px;
                min-width: 240px;
            }

            .verification-section {
                padding: 25px 20px;
            }
        }

        /* Print styles for formal documentation */
        @media print {
            body {
                background-color: white;
                padding: 0;
            }

            .email-container {
                box-shadow: none;
                border: 2px solid #000;
            }

            .header {
                background: #2c3e50 !important;
                -webkit-print-color-adjust: exact;
            }
        }

    </style>
</head>
<body>
    <div class="email-container">
        <div class="header" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px; color: #1e3c72; padding: 40px 30px; text-align: center;background-color: #f8f9fa; border: 2px solid #dee2e6; border-radius: 12px;">
            <div class="header-content">
                <div class="company-logo" style="width: 60px; height: 60px; border-radius: 30px; margin: 0 auto 15px; display: block; text-align: center; line-height: 60px;">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="width: 80px; height: 80px; vertical-align: middle; object-fit: contain;">
                </div>
                <h1 style="color: #5660ff; font-size: 32px; margin-bottom: 10px; font-weight: 700;">{{ config('app.name') }}</h1>
                <h2 style="font-size: 18px; font-weight: 400; margin: 0;color: #5660ff;">{{ __('message.email_verification') }}</h2>
            </div>
        </div>

        <div class="content">
            <div class="formal-greeting">
                <h3>{{ __('message.hello') }}</h3>
                <div class="subtitle">{{ __('message.registration_thank_you') }}</div>
            </div>

            <div class="verification-section" style="background-color: #f8f9fa; border: 2px solid #dee2e6; border-radius: 12px; padding: 30px; margin: 40px 0; text-align: center;">
                <div class="verification-title" style="font-size: 20px; color: #1e3c72; font-weight: 600; margin-bottom: 15px;">🔐 {{ __('message.email_verification') }}</div>
                <div class="otp-label" style="font-size: 14px; color: #000000; margin-bottom: 15px;">{{ __('message.verify_your_email') }}</div>
                <div class="otp-code" style="background-color: #28a745; color: white; font-size: 36px; font-weight: 800; padding: 25px 50px; border-radius: 12px; letter-spacing: 6px; direction: ltr; display: inline-block; min-width: 280px; border: 3px solid #ffffff; font-family: 'Courier New', monospace;">{{ $otp }}</div>
            </div>

            <div class="security-notice" style="background-color: #fff3cd; border: 2px solid #ffc107; border-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}: 6px solid #fd7e14; color: #000000; padding: 20px; border-radius: 8px; margin: 30px 0;">
                <div class="notice-title" style="font-size: 16px; font-weight: 700; margin-bottom: 8px; color: #d4a425;">⚠️ {{ __('message.important') }}</div>
                <p style="margin-bottom: 0; font-size: 15px; font-weight: 600; color: #000000;">{{ __('message.code_expires_5_minutes') }}</p>
            </div>

            <p>{{ __('message.ignore_if_not_you') }}</p>

            <div class="formal-signature">
                <p class="regards">{{ __('message.best_regards') }}</p>
                <div class="company-info">
                    <div class="company-name">{{ config('app.name') }}</div>
                    <div class="department">{{ __('message.team') }} - {{ __('message.email_verification') }}</div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="footer-content">
                <p>{{ __('message.automated_email_no_reply') }}</p>
                <p class="confidentiality">This email contains confidential information intended solely for the addressee.</p>
                <p class="copyright">&copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('message.all_rights_reserved') }}</p>
            </div>
        </div>
    </div>
</body>
</html>
