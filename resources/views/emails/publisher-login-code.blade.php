@extends('emails.layout-branded')

@section('preheader')
    Your 6-digit sign-in code for {{ config('app.name') }} — expires in 10 minutes.
@endsection

@section('header_title')
    Sign-in verification
@endsection

@section('body')
    <h1 style="margin:0 0 12px;font-size:1.35rem;font-weight:800;color:#0f172a;line-height:1.25;">
        Your sign-in code
    </h1>
    <p style="margin:0 0 18px;color:#475569;">
        Hi {{ $user->name }},
    </p>
    <p style="margin:0 0 22px;color:#475569;">
        Use this code to finish signing in to <strong style="color:#0f172a;">{{ config('app.name') }}</strong>. It expires in <strong>10 minutes</strong>.
    </p>
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="margin:0 0 22px;">
        <tr>
            <td align="center" style="padding:20px 16px;border-radius:14px;background-color:#f0fdf4;border:1px solid #bbf7d0;">
                <p style="margin:0 0 6px;font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#15803d;">
                    Verification code
                </p>
                <p style="margin:0;font-family:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,monospace;font-size:2rem;font-weight:800;letter-spacing:0.35em;color:#166534;">
                    {{ $code }}
                </p>
            </td>
        </tr>
    </table>
    <p style="margin:0;font-size:14px;color:#64748b;">
        If you did not try to sign in, you can ignore this email. Your account stays protected.
    </p>
@endsection
