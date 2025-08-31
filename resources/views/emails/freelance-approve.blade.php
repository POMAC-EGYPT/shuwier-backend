<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ __('message.freelancer_approval_notification') }} - {{ config('app.name') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: {{ app()->getLocale() == 'ar' ? "'Segoe UI', 'Tahoma', 'Arabic UI Text', Arial, sans-serif" : "'Segoe UI', 'Helvetica Neue', Arial, sans-serif" }};
            line-height: 1.8;
            color: #000000;
            background-color: #ecf0f1;
            direction: {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }};
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
            background-color: #28a745;
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
            text-align: {{ app()->getLocale() == 'ar' ? 'right' : 'left' }};
            background: #ffffff;
        }
        
        .formal-greeting {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e8eaed;
        }
        
        .formal-greeting h3 {
            color: #28a745;
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
        
        .approval-section {
            background-color: #d4edda;
            border: 2px solid #c3e6cb;
            border-radius: 12px;
            padding: 30px;
            margin: 40px 0;
            text-align: center;
        }
        
        .approval-title {
            font-size: 20px;
            color: #28a745;
            font-weight: 600;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .approval-message {
            background-color: #28a745;
            color: white;
            font-size: 24px;
            font-weight: 700;
            padding: 25px 50px;
            border-radius: 12px;
            display: inline-block;
            min-width: 280px;
            border: 3px solid #ffffff;
        }
        
        .next-steps {
            background-color: #e7f3ff;
            border: 2px solid #b3d4fc;
            border-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}: 6px solid #007bff;
            color: #000000;
            padding: 20px;
            border-radius: 8px;
            margin: 30px 0;
            text-align: {{ app()->getLocale() == 'ar' ? 'right' : 'left' }};
        }
        
        .next-steps .steps-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #007bff;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .next-steps ul {
            margin: 10px 0 0 {{ app()->getLocale() == 'ar' ? '0' : '20px' }};
            margin-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}: {{ app()->getLocale() == 'ar' ? '20px' : '0' }};
            padding: 0;
        }
        
        .next-steps li {
            margin-bottom: 8px;
            font-size: 15px;
            font-weight: 500;
            color: #000000;
        }
        
        .formal-signature {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #e8eaed;
            text-align: {{ app()->getLocale() == 'ar' ? 'right' : 'left' }};
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
            border-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}: 4px solid #28a745;
        }
        
        .formal-signature .company-name {
            font-size: 20px;
            font-weight: 700;
            color: #28a745;
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
            border-top: 3px solid #28a745;
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
            
            .approval-message {
                font-size: 20px;
                padding: 20px 35px;
                min-width: 240px;
            }
            
            .approval-section {
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
                background: #28a745 !important;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header" style="background-color: #28a745; color: white; padding: 40px 30px; text-align: center;">
            <div class="header-content">
                <div class="company-logo" style="width: 60px; height: 60px; background: rgba(255, 255, 255, 0.2); border-radius: 30px; margin: 0 auto 15px; display: block; text-align: center; line-height: 60px;">
                    <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo" style="width: 40px; height: 40px; vertical-align: middle; display: inline-block;">
                </div>
                <h1 style="color: white; font-size: 32px; margin-bottom: 10px; font-weight: 700;">{{ config('app.name') }}</h1>
                <h2 style="font-size: 18px; font-weight: 400; margin: 0;">{{ __('message.freelancer_approval_notification') }}</h2>
            </div>
        </div>
        
        <div class="content">
            <div class="formal-greeting">
                <h3>{{ __('message.congratulations') }} {{ $freelancer->name }}!</h3>
                <div class="subtitle">{{ __('message.freelancer_approval_welcome') }}</div>
            </div>
            
            <p class="intro">{{ __('message.freelancer_approval_intro') }}</p>
            
            <div class="approval-section" style="background-color: #d4edda; border: 2px solid #c3e6cb; border-radius: 12px; padding: 30px; margin: 40px 0; text-align: center;">
                <div class="approval-title" style="font-size: 20px; color: #28a745; font-weight: 600; margin-bottom: 15px;">🎉 {{ __('message.approval_status') }}</div>
                <div class="approval-message" style="background-color: #28a745; color: white; font-size: 24px; font-weight: 700; padding: 25px 50px; border-radius: 12px; display: inline-block; min-width: 280px; border: 3px solid #ffffff;">{{ __('message.approved') }}</div>
            </div>
            
            <p>{{ __('message.freelancer_approval_description') }}</p>
            
            <div class="next-steps" style="background-color: #e7f3ff; border: 2px solid #b3d4fc; border-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}: 6px solid #007bff; color: #000000; padding: 20px; border-radius: 8px; margin: 30px 0;">
                <div class="steps-title" style="font-size: 16px; font-weight: 700; margin-bottom: 8px; color: #007bff;">📋 {{ __('message.next_steps') }}</div>
                <ul style="margin: 10px 0 0 {{ app()->getLocale() == 'ar' ? '0' : '20px' }}; padding: 0;">
                    <li style="margin-bottom: 8px; font-size: 15px; font-weight: 500; color: #000000;">{{ __('message.step_login_account') }}</li>
                    <li style="margin-bottom: 8px; font-size: 15px; font-weight: 500; color: #000000;">{{ __('message.step_complete_profile') }}</li>
                    <li style="margin-bottom: 8px; font-size: 15px; font-weight: 500; color: #000000;">{{ __('message.step_start_bidding') }}</li>
                    <li style="margin-bottom: 8px; font-size: 15px; font-weight: 500; color: #000000;">{{ __('message.step_read_guidelines') }}</li>
                </ul>
            </div>
            
            <p>{{ __('message.freelancer_support_message') }}</p>
            
            <div class="formal-signature">
                <p class="regards">{{ __('message.welcome_aboard') }},</p>
                <div class="company-info">
                    <div class="company-name">{{ config('app.name') }} {{ __('message.team') }}</div>
                    <div class="department">{{ __('message.freelancer_management_department') }}</div>
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
