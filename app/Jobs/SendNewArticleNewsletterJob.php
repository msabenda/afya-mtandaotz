<?php

namespace App\Jobs;

use App\Mail\NewArticlePublishedMail;
use App\Models\Article;
use App\Models\NewsletterSubscriber;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendNewArticleNewsletterJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public int $articleId
    ) {}

    public function handle(): void
    {
        $article = Article::query()->find($this->articleId);
        if (! $article || ! $article->published_at) {
            return;
        }

        NewsletterSubscriber::query()
            ->orderBy('id')
            ->chunk(50, function ($subscribers) use ($article): void {
                foreach ($subscribers as $subscriber) {
                    Mail::to($subscriber->email)->send(new NewArticlePublishedMail($article, $subscriber));
                }
            });
    }
}
