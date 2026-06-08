<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $now = now();
        $photoUrl = fn (string $keywords, int $width = 900, int $height = 540, int $lock = 1): string => "https://loremflickr.com/{$width}/{$height}/{$keywords}?lock={$lock}";

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        foreach ([
            'reviews',
            'contact_us',
            'video_galleries',
            'photo_galleries',
            'live_tvs',
            'banners',
            'news',
            'subcategories',
            'categories',
            'seos',
            'users',
            'admins',
        ] as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $admin = Admin::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Site Admin',
                'phone' => '1234567890',
                'address' => 'Newsroom Office',
                'image' => $photoUrl('admin-profile', 512, 512),
                'password' => Hash::make('password'),
                'password_hint' => null,
                'status' => true,
            ]
        );

        $user = User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Demo Reader',
                'phone' => '1234567891',
                'image' => $photoUrl('reader-profile', 512, 512),
                'password' => Hash::make('password'),
            ]
        );

        $categories = [
            [
                'name' => 'Politics',
                'slug' => 'politics',
                'keywords' => 'government,city,hall',
                'titles' => [
                    'Cabinet Reviews New Public Service Reform Plan',
                    'Local Leaders Debate Transport Budget Priorities',
                    'Election Commission Opens Updated Voter Registration Drive',
                    'City Council Approves Climate Resilience Funding',
                    'Opposition Lawmakers Call For Broader Oversight Hearings',
                    'Policy Experts Warn Delays Could Raise Infrastructure Costs',
                ],
            ],
            [
                'name' => 'Entertainment',
                'slug' => 'entertainment',
                'keywords' => 'cinema,concert,stage',
                'titles' => [
                    'Film Festival Opens With Record Number Of Local Premieres',
                    'Streaming Drama Wins Audience Prize After Surprise Finale',
                    'Musicians Announce Summer Concert Series Across The City',
                    'Theatre Revival Brings Classic Story To A Younger Crowd',
                    'Independent Producers Push For More Regional Screen Funding',
                    'Critics Name Ten Performances Defining The Season',
                ],
            ],
            [
                'name' => 'Automobiles',
                'slug' => 'automobiles',
                'keywords' => 'car,traffic,road',
                'titles' => [
                    'Electric Vehicle Sales Rise As Charging Network Expands',
                    'New Safety Ratings Put Compact SUVs Under The Spotlight',
                    'Auto Dealers Prepare For Hybrid Demand During Holiday Rush',
                    'City Traffic Pilot Tests Smarter Signals On Busy Corridors',
                    'Manufacturers Reveal Lower-Cost Battery Replacement Plans',
                    'Road Test Finds Family Sedans Are Getting Quieter And Safer',
                ],
            ],
            [
                'name' => 'Crime',
                'slug' => 'crime',
                'keywords' => 'police,court,security',
                'titles' => [
                    'Police Expand Patrols After Downtown Theft Complaints',
                    'Court Orders New Hearing In High-Profile Fraud Case',
                    'Cybercrime Unit Warns Residents About Banking Text Scam',
                    'Neighborhood Watch Groups Coordinate Safety Workshops',
                    'Investigators Recover Stolen Vehicles In Overnight Raids',
                    'Legal Aid Team Launches Support Desk For Witnesses',
                ],
            ],
            [
                'name' => 'Health and Fitness',
                'slug' => 'health-and-fitness',
                'keywords' => 'health,fitness,hospital',
                'titles' => [
                    'Doctors Urge Early Screening As Seasonal Illnesses Increase',
                    'Community Clinics Add Weekend Fitness And Nutrition Classes',
                    'New Study Links Daily Walking To Better Heart Health',
                    'Hospitals Upgrade Emergency Wards Ahead Of Monsoon Season',
                    'Nutritionists Share Practical Advice For Office Workers',
                    'Mental Health Campaign Focuses On Students And Caregivers',
                ],
            ],
            [
                'name' => 'Sports',
                'slug' => 'sports',
                'keywords' => 'sports,stadium,football',
                'titles' => [
                    'National Team Names Squad For Crucial Qualifier',
                    'Young Striker Scores Twice In Championship Semi-Final',
                    'Cricket Board Confirms Expanded Domestic Tournament',
                    'Marathon Organizers Expect Record Turnout This Weekend',
                    'Coach Credits Defensive Discipline For Late Season Surge',
                    'Fans Celebrate Historic Win At Packed City Stadium',
                ],
            ],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                ['slug' => $category['slug']],
                [
                    'name' => $category['name'],
                    'slug' => $category['slug'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        $categoryRecords = DB::table('categories')->whereIn('slug', array_column($categories, 'slug'))->get()->keyBy('slug');

        foreach ($categoryRecords as $category) {
            foreach (['Latest', 'Analysis'] as $label) {
                DB::table('subcategories')->updateOrInsert(
                    ['slug' => Str::slug($category->slug.'-'.$label)],
                    [
                        'category_id' => $category->id,
                        'name' => $label,
                        'slug' => Str::slug($category->slug.'-'.$label),
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }
        }

        $subcategories = DB::table('subcategories')->get()->groupBy('category_id');
        $categorySeedData = collect($categories)->keyBy('slug');
        $newsCounter = 1;

        foreach ($categoryRecords as $category) {
            $seedData = $categorySeedData[$category->slug];

            for ($index = 1; $index <= 6; $index++) {
                $title = $seedData['titles'][$index - 1];
                $subcategory = $subcategories[$category->id]->first();

                DB::table('news')->updateOrInsert(
                    ['slug' => Str::slug($title)],
                    [
                        'category_id' => $category->id,
                        'subcategory_id' => $subcategory->id,
                        'admin_id' => $admin->id,
                        'title' => $title,
                        'slug' => Str::slug($title),
                        'image' => $photoUrl($seedData['keywords'], 900, 540, $newsCounter),
                        'details' => implode("\n\n", [
                            'The newsroom followed this story throughout the day, speaking with officials, residents, and subject specialists to understand what changed and why it matters.',
                            'Early details show a wider effect than first expected. Community groups said the decision could influence daily services, local planning, and public confidence over the coming weeks.',
                            'Analysts say the next phase will depend on transparent implementation, timely communication, and whether leaders can answer the practical questions now being raised by readers.',
                        ]),
                        'tags' => strtolower($category->slug).',news,featured',
                        'breaking_news' => $index <= 2 ? 1 : 0,
                        'top_slider' => $newsCounter <= 18 ? 1 : 0,
                        'first_section_three' => $newsCounter <= 3 ? 1 : 0,
                        'first_section_nine' => $newsCounter <= 9 ? 1 : 0,
                        'post_date' => $now->format('d-m-Y'),
                        'post_month' => $now->format('F'),
                        'status' => true,
                        'view_count' => 100 - $newsCounter,
                        'created_at' => $now->copy()->subMinutes($newsCounter),
                        'updated_at' => $now,
                    ]
                );

                $newsCounter++;
            }
        }

        DB::table('banners')->updateOrInsert(
            ['id' => 1],
            [
                'home_one' => $photoUrl('newspaper,office', 725, 100, 201),
                'home_two' => $photoUrl('city,night', 725, 100, 202),
                'home_three' => $photoUrl('press,conference', 725, 100, 203),
                'home_four' => $photoUrl('newsroom,journalist', 725, 100, 204),
                'news_category_one' => $photoUrl('newspaper,desk', 725, 100, 205),
                'news_details_one' => $photoUrl('media,camera', 725, 100, 206),
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('live_tvs')->updateOrInsert(
            ['id' => 1],
            [
                'image' => $photoUrl('television,studio', 784, 436, 301),
                'url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'post_date' => $now->format('d-m-Y'),
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('seos')->updateOrInsert(
            ['id' => 1],
            [
                'meta_title' => 'Online Easy News',
                'meta_author' => 'Online Easy News',
                'meta_keyword' => 'news, politics, sports, entertainment',
                'meta_description' => 'Latest seeded news articles with real photo imagery across politics, sports, health, entertainment, crime, and automobiles.',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        for ($index = 1; $index <= 6; $index++) {
            DB::table('photo_galleries')->updateOrInsert(
                ['photo_gallery' => $photoUrl('journalism,city,people', 640, 420, 400 + $index)],
                [
                    'photo_gallery' => $photoUrl('journalism,city,people', 640, 420, 400 + $index),
                    'post_date' => $now->format('d-m-Y'),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        for ($index = 1; $index <= 5; $index++) {
            DB::table('video_galleries')->updateOrInsert(
                ['title' => 'Video Report '.$index],
                [
                    'image' => $photoUrl('camera,interview,news', 640, 360, 500 + $index),
                    'title' => 'Video Report '.$index.': Field Update',
                    'url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                    'post_date' => $now->format('d-m-Y'),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        DB::table('contact_us')->updateOrInsert(
            ['email' => 'reader@example.com'],
            [
                'name' => 'Interested Reader',
                'email' => 'reader@example.com',
                'phone' => '1234567892',
                'comments' => 'Please send me updates from the newsroom.',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        $firstNews = DB::table('news')->first();

        if ($firstNews) {
            DB::table('reviews')->updateOrInsert(
                ['user_id' => $user->id, 'news_id' => $firstNews->id],
                [
                    'comments' => 'Helpful story with clear context.',
                    'status' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
