<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class WonderfulArticlesSeeder extends Seeder
{
    /**
     * Three full sample articles for local / demo testing (idempotent by slug).
     */
    public function run(): void
    {
        $now = Carbon::now();
        $authorId = User::query()->where('role', 'publisher')->orderBy('id')->value('id');

        $articles = [
            [
                'slug' => 'hydration-energy-and-focus-in-daily-life',
                'title' => 'Hydration, Energy, and Focus in Daily Life',
                'excerpt' => 'Why water matters more than caffeine alone, how to build simple hydration habits, and gentle ways to stay alert through long work or study days.',
                'cover_image_url' => 'https://images.unsplash.com/photo-1548839140-29a749e1cf4d?auto=format&fit=crop&w=1400&q=82',
                'published_at' => $now->copy()->subHours(8),
                'body' => <<<'HTML'
<p>Feeling tired in the afternoon is common—and it is not always about sleep alone. How you hydrate, move, and pace your day plays a big role in steady energy and clearer thinking.</p>

<h2>Why hydration comes first</h2>
<p>Your body uses water for temperature control, digestion, and carrying nutrients. Even mild dehydration can show up as headaches, irritability, or difficulty concentrating. A practical goal is to sip water regularly rather than only drinking when you feel thirsty.</p>
<ul>
<li>Keep a bottle visible at your desk or kitchen counter.</li>
<li>Pair meals with a glass of water.</li>
<li>In warm weather or after activity, add a small pinch of salt and a piece of fruit with water if you sweat heavily—when in doubt, ask a clinician what is right for you.</li>
</ul>

<h2>Steady energy without spikes</h2>
<p>Large portions of refined starch at one sitting can lead to a quick rise and then a dip in energy. Combining fibre-rich foods with protein and healthy fats often helps meals feel satisfying for longer. Examples include beans with vegetables, eggs with whole grains, or nuts with fruit.</p>

<h2>Movement as a reset button</h2>
<p>Short walks, stretching, or a few minutes of stair climbing can improve circulation and mood. You do not need a gym membership—two or three five-minute breaks during the day already help.</p>

<blockquote><p><strong>Remember:</strong> This article is for general awareness. It does not replace medical advice. If you have ongoing fatigue, dizziness, or sudden changes in thirst or urination, speak with a qualified health professional.</p></blockquote>
HTML,
            ],
            [
                'slug' => 'building-balanced-plates-for-the-whole-family',
                'title' => 'Building Balanced Plates for the Whole Family',
                'excerpt' => 'A friendly guide to colourful plates, affordable staples, and simple routines so children and adults can enjoy nutritious meals without rigid rules.',
                'cover_image_url' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&w=1400&q=82',
                'published_at' => $now->copy()->subHours(32),
                'body' => <<<'HTML'
<p>Eating well as a family is less about perfect recipes and more about repeatable habits: variety, enough protein for growth and repair, and plenty of vegetables and fruit when available.</p>

<h2>The “half plate” idea</h2>
<p>Imagine dividing the plate: roughly half vegetables and fruit, one quarter whole grains or starchy roots, and one quarter protein foods such as fish, beans, eggs, lean meat, or dairy where appropriate for your household. Flexibility matters—markets and seasons change.</p>

<h2>Budget-friendly staples</h2>
<ul>
<li>Dried beans and lentils store well and cook in batches.</li>
<li>Seasonal produce is often fresher and better value.</li>
<li>Frozen vegetables retain nutrients and reduce waste.</li>
</ul>

<h2>Involving children</h2>
<p>Letting children help wash vegetables, mix salads, or choose between two healthy options can build confidence and curiosity. Keep mealtimes calm; repeated gentle exposure to new foods works better than pressure.</p>

<h2>When to seek individual guidance</h2>
<p>Growth concerns, allergies, diabetes, or kidney conditions need personalised plans. A registered dietitian or doctor can adapt portions and food choices to your family’s needs.</p>
HTML,
            ],
            [
                'slug' => 'small-steps-for-mental-wellbeing-at-home-and-work',
                'title' => 'Small Steps for Mental Wellbeing at Home and Work',
                'excerpt' => 'Practical, low-cost habits—sleep rhythm, boundaries, breathing, and connection—that support emotional balance alongside professional care when needed.',
                'cover_image_url' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&w=1400&q=82',
                'published_at' => $now->copy()->subHours(56),
                'body' => <<<'HTML'
<p>Mental wellbeing is shaped by sleep, relationships, physical health, and life stressors. Small, consistent actions can create more room to cope—and they complement counselling or medical treatment, not replace it.</p>

<h2>Protect your sleep rhythm</h2>
<p>Try a regular wake time, dim screens in the evening, and a wind-down routine (reading, light stretching, or quiet music). If insomnia persists for weeks, consider discussing it with a clinician.</p>

<h2>Boundaries that reduce overload</h2>
<ul>
<li>Batch notifications instead of reacting to every ping.</li>
<li>Short agendas for meetings and clear “offline” windows at home.</li>
<li>Saying no to one extra commitment can protect recovery time.</li>
</ul>

<h2>Breathing and grounding</h2>
<p>Slow breathing—inhale four counts, exhale six counts for a minute or two—can lower physical tension for many people. Naming five things you see and four you can touch is another simple grounding technique during anxiety spikes.</p>

<h2>Staying connected</h2>
<p>Even brief conversations with someone you trust can shift perspective. Community groups, faith gatherings, or peer support can matter when isolation creeps in.</p>

<blockquote><p>If you or someone you know is in crisis, reach out to local emergency services or a trusted crisis line in your country immediately.</p></blockquote>
HTML,
            ],
        ];

        foreach ($articles as $row) {
            Article::query()->updateOrCreate(
                ['slug' => $row['slug']],
                [
                    'user_id' => $authorId,
                    'title' => $row['title'],
                    'excerpt' => $row['excerpt'],
                    'body' => $row['body'],
                    'cover_image_url' => $row['cover_image_url'],
                    'published_at' => $row['published_at'],
                ]
            );
        }
    }
}
