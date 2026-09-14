<?php

namespace App\Http\Controllers\Publisher;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\HealthNews;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $articlesCount = Article::query()->count();
        $newsCount = HealthNews::query()->count();
        $publishedArticles = Article::query()->whereNotNull('published_at')->count();
        $publishedNews = HealthNews::query()->whereNotNull('published_at')->count();

        return view('publisher.dashboard', [
            'articlesCount' => $articlesCount,
            'newsCount' => $newsCount,
            'publishedArticles' => $publishedArticles,
            'publishedNews' => $publishedNews,
            'draftArticles' => max($articlesCount - $publishedArticles, 0),
            'draftNews' => max($newsCount - $publishedNews, 0),
            'latestArticles' => Article::query()->with('author')->latest()->limit(5)->get(),
            'latestNews' => HealthNews::query()->with('author')->latest()->limit(5)->get(),
        ]);
    }
}
