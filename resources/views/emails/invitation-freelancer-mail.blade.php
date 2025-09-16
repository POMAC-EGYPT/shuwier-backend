<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Freelancer Invitation - {{ config('app.name') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.8;
            color: #000000;
            background-color: #ecf0f1;
            direction: ltr;
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
            background-color: #007bff;
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
            text-align: left;
            background: #ffffff;
        }

        .formal-greeting {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e8eaed;
        }

        .formal-greeting h3 {
            color: #007bff;
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

        .invitation-section {
            background-color: #e7f3ff;
            border: 2px solid #b3d4fc;
            border-radius: 12px;
            padding: 30px;
            margin: 40px 0;
            text-align: center;
        }

        .invitation-title {
            font-size: 20px;
            color: #007bff;
            font-weight: 600;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .invitation-message {
            background-color: #007bff;
            color: white;
            font-size: 24px;
            font-weight: 700;
            padding: 25px 50px;
            border-radius: 12px;
            display: inline-block;
            min-width: 280px;
            border: 3px solid #ffffff;
        }

        .cta-button {
            display: inline-block;
            background-color: #28a745;
            color: white;
            font-size: 18px;
            font-weight: 600;
            padding: 15px 35px;
            text-decoration: none;
            border-radius: 8px;
            margin: 20px 0;
            transition: background-color 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .cta-button:hover {
            background-color: #218838;
        }

        .benefits-section {
            background-color: #f8f9fa;
            border: 2px solid #dee2e6;
            border-left: 6px solid #28a745;
            color: #000000;
            padding: 20px;
            border-radius: 8px;
            margin: 30px 0;
            text-align: left;
        }

        .benefits-section .benefits-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #28a745;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .benefits-section ul {
            margin: 10px 0 0 20px;
            padding: 0;
        }

        .benefits-section li {
            margin-bottom: 8px;
            font-size: 15px;
            font-weight: 500;
            color: #000000;
        }

        .formal-signature {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #e8eaed;
            text-align: left;
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
            border-left: 4px solid #007bff;
        }

        .formal-signature .company-name {
            font-size: 20px;
            font-weight: 700;
            color: #007bff;
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
            border-top: 3px solid #007bff;
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

            .invitation-message {
                font-size: 20px;
                padding: 20px 35px;
                min-width: 240px;
            }

            .invitation-section {
                padding: 25px 20px;
            }

            .cta-button {
                font-size: 16px;
                padding: 12px 25px;
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
                background: #007bff !important;
                -webkit-print-color-adjust: exact;
            }
        }

    </style>
</head>
<body>
    <div class="email-container">
        <div class="header" style="background-color: #007bff; color: white; padding: 40px 30px; text-align: center;">
            <div class="header-content">
                <div class="company-logo" style="width: 60px; height: 60px; background: rgba(255, 255, 255, 0.2); border-radius: 30px; margin: 0 auto 15px; display: block; text-align: center; line-height: 60px;">
                    <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo" style="width: 40px; height: 40px; vertical-align: middle; display: inline-block;">
                </div>
                <h1 style="color: white; font-size: 32px; margin-bottom: 10px; font-weight: 700;">{{ config('app.name') }}</h1>
                <h2 style="font-size: 18px; font-weight: 400; margin: 0;">Freelancer Invitation</h2>
            </div>
        </div>

        <div class="content">
            <div class="formal-greeting">
                <h3>🎉 You're Invited to Join {{ config('app.name') }}!</h3>
                <div class="subtitle">Exclusive Freelancer Invitation</div>
            </div>

            <p class="intro">We're excited to invite you to join <strong>{{ config('app.name') }}</strong> as a freelancer on our platform!</p>

            <div class="invitation-section" style="background-color: #e7f3ff; border: 2px solid #b3d4fc; border-radius: 12px; padding: 30px; margin: 40px 0; text-align: center;">
                <div class="invitation-title" style="font-size: 20px; color: #007bff; font-weight: 600; margin-bottom: 15px;">✨ Special Invitation</div>
                <div class="invitation-message" style="background-color: #007bff; color: white; font-size: 24px; font-weight: 700; padding: 25px 50px; border-radius: 12px; display: inline-block; min-width: 280px; border: 3px solid #ffffff;">Join Our Elite Community</div>
            </div>

            <p>{{ config('app.name') }} is a premier freelancing platform where talented professionals like you can showcase their skills, connect with high-quality clients, and build successful careers. We believe you would be a valuable addition to our growing community of experts.</p>

            <div class="benefits-section" style="background-color: #f8f9fa; border: 2px solid #dee2e6; border-left: 6px solid #28a745; color: #000000; padding: 20px; border-radius: 8px; margin: 30px 0;">
                <div class="benefits-title" style="font-size: 16px; font-weight: 700; margin-bottom: 8px; color: #28a745;">🚀 Why Join {{ config('app.name') }}?</div>
                <ul style="margin: 10px 0 0 20px; padding: 0;">
                    <li style="margin-bottom: 8px; font-size: 15px; font-weight: 500; color: #000000;">🎯 Connect with premium clients and high-value projects</li>
                    <li style="margin-bottom: 8px; font-size: 15px; font-weight: 500; color: #000000;">💼 Showcase your portfolio and professional skills</li>
                    <li style="margin-bottom: 8px; font-size: 15px; font-weight: 500; color: #000000;">💳 Secure and reliable payment processing system</li>
                    <li style="margin-bottom: 8px; font-size: 15px; font-weight: 500; color: #000000;">🌐 Build your professional network and reputation</li>
                    <li style="margin-bottom: 8px; font-size: 15px; font-weight: 500; color: #000000;">⏰ Flexible work opportunities that fit your schedule</li>
                    <li style="margin-bottom: 8px; font-size: 15px; font-weight: 500; color: #000000;">📈 Access to growth tools and career development resources</li>
                </ul>
            </div>

            <p style="text-align: center; margin: 30px 0;">Ready to take your freelancing career to the next level?</p>

            <div style="text-align: center;">
                <a href="{{ config('app.frontend_url') }}/register" class="cta-button" style="display: inline-block; background-color: #28a745; color: white; font-size: 18px; font-weight: 600; padding: 15px 35px; text-decoration: none; border-radius: 8px; margin: 20px 0;">Join {{ config('app.name') }} Now</a>
            </div>

            <p>If you have any questions about the platform or need assistance with registration, our dedicated support team is here to help you every step of the way.</p>

            <div class="formal-signature">
                <p class="regards">Welcome aboard,</p>
                <div class="company-info">
                    <div class="company-name">The {{ config('app.name') }} Team</div>
                    <div class="department">Freelancer Relations Department</div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="footer-content">
                <p>This is an automated message. Please do not reply to this email.</p>
                <p class="confidentiality">This invitation was sent to you because an admin believes you would be a valuable addition to our platform.</p>
                <p class="copyright">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
