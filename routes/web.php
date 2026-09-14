<?php

use App\Http\Controllers\Admin\ApplicationLogController as AdminApplicationLogController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\BlockedIpController as AdminBlockedIpController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\SecurityLogController as AdminSecurityLogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactSubmissionController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Publisher\ArticleController;
use App\Http\Controllers\Publisher\ContactSubmissionController as PublisherContactSubmissionController;
use App\Http\Controllers\Publisher\DashboardController;
use App\Http\Controllers\Publisher\EditorUploadController;
use App\Http\Controllers\Publisher\HealthNewsController;
use App\Http\Controllers\Publisher\TwoFactorController;
use App\Models\Article;
use App\Models\HealthNews;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', function () {
    try {
        $latestArticles = Article::query()
            ->with('author')
            ->published()
            ->orderByDesc('published_at')
            ->limit(6)
            ->get();

        $latestNews = HealthNews::query()
            ->with('author')
            ->published()
            ->orderByDesc('published_at')
            ->limit(5)
            ->get();
    } catch (\Throwable $e) {
        $latestArticles = collect([
            (object) [
                'title' => 'Understanding Blood Pressure: What the Numbers Mean',
                'slug' => Str::slug('Understanding Blood Pressure: What the Numbers Mean'),
                'excerpt' => 'A simple guide to systolic/diastolic readings, common risk factors, and when to seek care.',
                'cover_image_url' => 'https://images.unsplash.com/photo-1584515933487-779824d29309?auto=format&fit=crop&w=1200&q=80',
                'published_at' => now()->subDays(0),
            ],
            (object) [
                'title' => 'Healthy Eating on a Budget: Practical Tips',
                'slug' => Str::slug('Healthy Eating on a Budget: Practical Tips'),
                'excerpt' => 'Affordable nutrition strategies you can start today—without strict diets or expensive supplements.',
                'cover_image_url' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=1200&q=80',
                'published_at' => now()->subDays(1),
            ],
            (object) [
                'title' => 'Mental Wellness: Managing Stress in Daily Life',
                'slug' => Str::slug('Mental Wellness: Managing Stress in Daily Life'),
                'excerpt' => 'Small habits that help reduce stress, improve sleep, and support emotional wellbeing.',
                'cover_image_url' => 'https://images.unsplash.com/photo-1527137342181-19aab11a8ee8?auto=format&fit=crop&w=1200&q=80',
                'published_at' => now()->subDays(2),
            ],
            (object) [
                'title' => 'Preventing Common Infections: Hygiene & Awareness',
                'slug' => Str::slug('Preventing Common Infections: Hygiene & Awareness'),
                'excerpt' => 'Simple prevention steps, red flags to watch for, and when to get medical advice.',
                'cover_image_url' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=1200&q=80',
                'published_at' => now()->subDays(3),
            ],
            (object) [
                'title' => 'Family Health: Building Strong Daily Routines',
                'slug' => Str::slug('Family Health: Building Strong Daily Routines'),
                'excerpt' => 'From hydration to movement—how to create a realistic routine for the whole family.',
                'cover_image_url' => 'https://images.unsplash.com/photo-1631217868264-e5b90bb7e133?auto=format&fit=crop&w=1200&q=80',
                'published_at' => now()->subDays(4),
            ],
            (object) [
                'title' => 'Staying Active Safely: Beginner-Friendly Movement',
                'slug' => Str::slug('Staying Active Safely: Beginner-Friendly Movement'),
                'excerpt' => 'Low-impact activities, warm-up basics, and tips to stay consistent without injury.',
                'cover_image_url' => 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=1200&q=80',
                'published_at' => now()->subDays(5),
            ],
        ]);

        $latestNews = collect([
            (object) [
                'headline' => 'WHO highlights updated guidance on healthy diets and physical activity',
                'slug' => Str::slug('WHO highlights updated guidance on healthy diets and physical activity'),
                'summary' => 'A quick overview of what changed and practical takeaways for everyday routines.',
                'source_name' => 'World Health Organization',
                'source_url' => 'https://www.who.int/',
                'published_at' => now(),
            ],
            (object) [
                'headline' => 'Local clinics encourage routine screenings for early detection',
                'slug' => Str::slug('Local clinics encourage routine screenings for early detection'),
                'summary' => 'Why basic checkups matter, especially for blood pressure, blood sugar, and heart health.',
                'source_name' => 'Community Health',
                'source_url' => null,
                'published_at' => now()->subHours(6),
            ],
            (object) [
                'headline' => 'New awareness campaign focuses on mental health support',
                'slug' => Str::slug('New awareness campaign focuses on mental health support'),
                'summary' => 'Campaign aims to reduce stigma and connect people with counselling resources.',
                'source_name' => 'Health Desk',
                'source_url' => null,
                'published_at' => now()->subHours(12),
            ],
            (object) [
                'headline' => 'Tips for staying hydrated during hot weather',
                'slug' => Str::slug('Tips for staying hydrated during hot weather'),
                'summary' => 'Signs of dehydration, hydration-friendly foods, and safe activity planning.',
                'source_name' => 'Wellness News',
                'source_url' => null,
                'published_at' => now()->subHours(18),
            ],
        ]);
    }

    return view('welcome', [
        'latestArticles' => $latestArticles,
        'latestNews' => $latestNews,
    ]);
});
Route::post('/contact-submit', [ContactSubmissionController::class, 'store'])->name('contact.submit');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
    ->middleware('throttle:5,1')
    ->name('newsletter.subscribe');

Route::get('/articles', function () {
    $articles = Article::query()
        ->with('author')
        ->published()
        ->orderByDesc('published_at')
        ->paginate(12);

    return view('public.articles-index', [
        'articles' => $articles,
    ]);
})->name('articles.index');

Route::get('/articles/{slug}', function (string $slug) {
    $article = Article::query()
        ->with('author')
        ->published()
        ->where('slug', $slug)
        ->firstOrFail();

    $previous = Article::query()
        ->published()
        ->where('published_at', '<', $article->published_at)
        ->orderByDesc('published_at')
        ->first();

    $next = Article::query()
        ->published()
        ->where('published_at', '>', $article->published_at)
        ->orderBy('published_at')
        ->first();

    return view('public.article-show', [
        'article' => $article,
        'previous' => $previous,
        'next' => $next,
    ]);
})->name('articles.show');

Route::get('/health-news', function () {
    $newsItems = HealthNews::query()
        ->with('author')
        ->published()
        ->orderByDesc('published_at')
        ->paginate(12);

    return view('public.news-index', [
        'newsItems' => $newsItems,
    ]);
})->name('news.index');

Route::get('/health-news/{slug}', function (string $slug) {
    $news = HealthNews::query()
        ->with('author')
        ->published()
        ->where('slug', $slug)
        ->firstOrFail();

    $previous = HealthNews::query()
        ->published()
        ->where('published_at', '<', $news->published_at)
        ->orderByDesc('published_at')
        ->first();

    $next = HealthNews::query()
        ->published()
        ->where('published_at', '>', $news->published_at)
        ->orderBy('published_at')
        ->first();

    return view('public.news-show', [
        'news' => $news,
        'previous' => $previous,
        'next' => $next,
    ]);
})->name('news.show');

Route::middleware(['guest'])->group(function (): void {
    Route::get('/publisher/login', [AuthController::class, 'showLogin'])
        ->middleware('throttle:20,1')
        ->name('publisher.login');
    Route::post('/publisher/login', [AuthController::class, 'login'])
        ->middleware('throttle:6,1')
        ->name('publisher.login.submit');
});

Route::middleware(['pending.publisher'])->group(function (): void {
    Route::get('/publisher/login/2fa/setup', [TwoFactorController::class, 'showSetup'])
        ->middleware('throttle:20,1')
        ->name('publisher.login.2fa.setup');
    Route::get('/publisher/login/2fa', [TwoFactorController::class, 'showChallenge'])
        ->middleware('throttle:20,1')
        ->name('publisher.login.2fa.challenge');

    Route::post('/publisher/login/2fa/setup', [TwoFactorController::class, 'confirmSetup'])
        ->middleware('throttle:8,1')
        ->name('publisher.login.2fa.setup.confirm');
    Route::post('/publisher/login/2fa', [TwoFactorController::class, 'verifyChallenge'])
        ->middleware('throttle:8,1')
        ->name('publisher.login.2fa.verify');
    Route::post('/publisher/login/2fa/resend', [TwoFactorController::class, 'resend'])
        ->middleware('throttle:3,1')
        ->name('publisher.login.2fa.resend');
});

Route::middleware(['auth', 'publisher'])->prefix('publisher')->name('publisher.')->group(function (): void {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('articles', ArticleController::class)->except(['show']);
    Route::resource('news', HealthNewsController::class)->except(['show']);
    Route::get('/contact-submissions', [PublisherContactSubmissionController::class, 'index'])->name('contact-submissions.index');
    Route::post('/editor/upload-image', [EditorUploadController::class, 'image'])->name('editor.upload-image');
});

Route::prefix('admin')->group(function (): void {
    Route::middleware('guest')->group(function (): void {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])
            ->middleware('throttle:20,1')
            ->name('admin.login');
        Route::post('/login', [AdminAuthController::class, 'login'])
            ->middleware('throttle:8,1')
            ->name('admin.login.submit');
    });

    Route::middleware(['auth', 'admin'])->group(function (): void {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        Route::get('/dashboard', AdminDashboardController::class)->name('admin.dashboard');

        Route::get('/security/logs', [AdminSecurityLogController::class, 'index'])->name('admin.security-logs.index');
        Route::get('/security/application-log', AdminApplicationLogController::class)->name('admin.application-log');

        Route::get('/security/blocked-ips', [AdminBlockedIpController::class, 'index'])->name('admin.blocked-ips.index');
        Route::post('/security/blocked-ips', [AdminBlockedIpController::class, 'store'])->name('admin.blocked-ips.store');
        Route::delete('/security/blocked-ips/{blockedIp}', [AdminBlockedIpController::class, 'destroy'])->name('admin.blocked-ips.destroy');
    });
});
