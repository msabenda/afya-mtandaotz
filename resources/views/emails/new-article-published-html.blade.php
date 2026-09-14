@extends('emails.layout-branded')

@section('preheader')
    {{ $article->title }} — read the new article on {{ config('app.name') }}.
@endsection

@section('header_title')
    New for subscribers
@endsection

@section('body')
    @php
        $cover = $article->cover_image_url;
        if ($cover) {
            $coverMail = \Illuminate\Support\Str::startsWith($cover, ['http://', 'https://'])
                ? $cover
                : url(\Illuminate\Support\Str::startsWith($cover, '/') ? $cover : '/'.ltrim($cover, '/'));
        } else {
            $coverMail = null;
        }
        $articleUrl = url('/articles/'.$article->slug);
    @endphp

    <h1 style="margin:0 0 10px;font-size:1.35rem;font-weight:800;color:#0f172a;line-height:1.25;">
        New article published
    </h1>
    <p style="margin:0 0 20px;color:#475569;font-size:15px;">
        Here is the latest post we think you will find useful.
    </p>

    @if ($coverMail)
        <a href="{{ $articleUrl }}" style="text-decoration:none;color:inherit;">
            <img
                src="{{ $coverMail }}"
                alt=""
                width="504"
                style="display:block;width:100%;max-width:504px;height:auto;border-radius:14px;margin:0 0 18px;border:1px solid #e2e8f0;"
            >
        </a>
    @endif

    <p style="margin:0 0 10px;font-size:1.1rem;font-weight:800;color:#0f172a;line-height:1.35;">
        {{ $article->title }}
    </p>
    @if ($article->excerpt)
        <p style="margin:0 0 22px;color:#475569;font-size:15px;">
            {{ \Illuminate\Support\Str::limit(strip_tags((string) $article->excerpt), 220) }}
        </p>
    @endif

    <table role="presentation" cellpadding="0" cellspacing="0" border="0" style="margin:0 0 20px;">
        <tr>
            <td align="center" style="border-radius:12px;background:linear-gradient(135deg,#16a34a 0%,#0b1220 130%);">
                <a href="{{ $articleUrl }}" style="display:inline-block;padding:14px 26px;font-family:system-ui,-apple-system,sans-serif;font-size:15px;font-weight:800;color:#ffffff;text-decoration:none;border-radius:12px;">
                    Read the article
                </a>
            </td>
        </tr>
    </table>

    @if ($subscriber)
        <p style="margin:0;padding-top:18px;border-top:1px solid #f1f5f9;font-size:12px;color:#94a3b8;line-height:1.5;">
            You are receiving this because you subscribed to updates at {{ config('app.name') }}.
        </p>
    @endif
@endsection
