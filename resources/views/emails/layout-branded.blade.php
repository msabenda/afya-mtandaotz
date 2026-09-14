<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>
</head>
<body style="margin:0;padding:0;background-color:#f1f5f9;-webkit-text-size-adjust:100%;">
    @hasSection('preheader')
        <div style="display:none;font-size:1px;line-height:1px;max-height:0;max-width:0;opacity:0;overflow:hidden;mso-hide:all;">
            @yield('preheader')
        </div>
    @endif
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:#f1f5f9;">
        <tr>
            <td align="center" style="padding:28px 14px;">
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="max-width:560px;background-color:#ffffff;border-radius:18px;overflow:hidden;box-shadow:0 12px 40px rgba(15,23,42,0.08);">
                    <tr>
                        <td align="center" style="padding:26px 24px 22px;background:linear-gradient(135deg,#0b1220 0%,#15803d 55%,#16a34a 100%);">
                            @include('emails.partials.logo')
                            @hasSection('header_title')
                                <p style="margin:14px 0 0;font-family:system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;font-size:0.95rem;font-weight:700;color:rgba(255,255,255,0.95);letter-spacing:0.04em;text-transform:uppercase;">
                                    @yield('header_title')
                                </p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:28px 28px 8px;font-family:system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;font-size:16px;line-height:1.65;color:#0f172a;">
                            @yield('body')
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:8px 28px 26px;font-family:system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;font-size:13px;line-height:1.55;color:#64748b;text-align:center;border-top:1px solid #e2e8f0;">
                            <p style="margin:0 0 6px;font-weight:600;color:#334155;">{{ config('app.name') }}</p>
                            <p style="margin:0;">{{ config('mail.brand_tagline', 'Health awareness online') }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
