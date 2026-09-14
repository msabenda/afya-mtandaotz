<?php

namespace Database\Seeders;

use App\Models\HealthNews;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class WonderfulHealthNewsSeeder extends Seeder
{
    /**
     * Sample health news posts (idempotent by slug), published with author attribution.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $authorId = User::query()->where('role', 'publisher')->orderBy('id')->value('id');

        $items = [
            [
                'slug' => 'who-guidance-healthy-diets-physical-activity',
                'headline' => 'WHO highlights updated guidance on healthy diets and physical activity',
                'summary' => '<p><strong>Summary:</strong> Updated guidance reinforces whole foods, reduced salt and sugar, and regular movement across age groups.</p><p>Takeaway: small daily changes—walking, stretching, and cooking at home—add up faster than extreme short-term diets.</p>',
                'source_name' => 'World Health Organization',
                'source_url' => 'https://www.who.int/',
                'image_url' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?auto=format&fit=crop&w=1400&q=82',
                'published_at' => $now->copy()->subHours(4),
            ],
            [
                'slug' => 'local-clinics-routine-screenings-early-detection',
                'headline' => 'Local clinics encourage routine screenings for early detection',
                'summary' => '<p><strong>Summary:</strong> Community clinics are promoting blood pressure, glucose, and basic heart checks as part of routine visits.</p><p>Early detection often means simpler treatment—ask your clinic what screening schedule fits your age and history.</p>',
                'source_name' => 'Community Health',
                'source_url' => null,
                'image_url' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1400&q=82',
                'published_at' => $now->copy()->subHours(18),
            ],
            [
                'slug' => 'awareness-campaign-mental-health-support',
                'headline' => 'New awareness campaign focuses on mental health support',
                'summary' => '<p><strong>Summary:</strong> The campaign highlights counselling services and aims to reduce stigma around seeking help.</p><p>If you are struggling, reaching out to a trusted professional or hotline is a sign of strength—not weakness.</p>',
                'source_name' => 'Health Desk',
                'source_url' => null,
                'image_url' => 'https://images.unsplash.com/photo-1527137342181-19aab11a8ee8?auto=format&fit=crop&w=1400&q=82',
                'published_at' => $now->copy()->subHours(30),
            ],
            [
                'slug' => 'hydration-hot-weather-safety-tips',
                'headline' => 'Tips for staying hydrated during hot weather',
                'summary' => '<p><strong>Summary:</strong> Warning signs of dehydration include dizziness, dark urine, and unusual fatigue during heat waves.</p><p>Combine water with electrolyte-rich foods when sweating heavily, and plan outdoor activity for cooler hours when possible.</p>',
                'source_name' => 'Wellness News',
                'source_url' => null,
                'image_url' => 'https://images.unsplash.com/photo-1548839140-29a749e1cf4d?auto=format&fit=crop&w=1400&q=82',
                'published_at' => $now->copy()->subHours(42),
            ],
        ];

        foreach ($items as $row) {
            HealthNews::query()->updateOrCreate(
                ['slug' => $row['slug']],
                [
                    'user_id' => $authorId,
                    'headline' => $row['headline'],
                    'summary' => $row['summary'],
                    'source_name' => $row['source_name'],
                    'source_url' => $row['source_url'],
                    'image_url' => $row['image_url'],
                    'published_at' => $row['published_at'],
                ]
            );
        }
    }
}
