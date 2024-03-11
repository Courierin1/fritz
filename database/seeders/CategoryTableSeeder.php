<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\EventCategory;
use Illuminate\Support\Facades\DB;
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_categories')->delete();
        $categories = array(
            [
                'name' => "Auto, Boat & Air",
                "subCategory" => [
                    ["name" => "Air"],
                    ["name" => "Auto"],
                    ["name" => "Boat"],
                    ["name" => "Motorcycle/ATV"],
                    ["name" => "Other"],
                ]
            ],
            [
                'name' => "Business & Professional",
                "subCategory" => [
                    ["name" => "Career"],
                    ["name" => "Design"],
                    ["name" => "Educators"],
                    ["name" => "Environment & Sustainability"],
                    ["name" => "Finance"],
                    ["name" => "Investment"],
                    ["name" => "Media"],
                    ["name" => "Non Profit & NGOs"],
                    ["name" => "Other"],
                    ["name" => "Real Estate"],
                    ["name" => "Sales & Marketing"],
                    ["name" => "Startups & Small Business"],
                ]
            ],
            [
                'name' => "Charity & Causes",
                "subCategory" => [
                    ["name" => "Animal Welfare"],
                    ["name" => "Disaster Relief"],
                    ["name" => "Education"],
                    ["name" => "Environment"],
                    ["name" => "Healthcare"],
                    ["name" => "Human Rights"],
                    ["name" => "International Aid"],
                    ["name" => "Other"],
                    ["name" => "Poverty"],
                ]
            ],
            [
                'name' => "Community & Culture",
                "subCategory" => [
                    ["name" => "City/Town"],
                    ["name" => "County"],
                    ["name" => "Heritage"],
                    ["name" => "Historic"],
                    ["name" => "LGBT"],
                    ["name" => "Language"],
                    ["name" => "Medieval"],
                    ["name" => "Nationality"],
                    ["name" => "Other"],
                    ["name" => "Renaissance"],
                    ["name" => "State"],
                ]
            ],
            [
                'name' => "Family & Education",
                "subCategory" => [
                    ["name" => "Alumni"],
                    ["name" => "Baby"],
                    ["name" => "Children & Youth "],
                    ["name" => "Education"],
                    ["name" => "Other"],
                    ["name" => "Parenting"],
                    ["name" => "Parents Association"],
                    ["name" => "Reunion"],
                    ["name" => "Senior Citizen"],
                ]
            ],
            [
                'name' => "Fashion & Beauty",
                "subCategory" => [
                    ["name" => "Accessories"],
                    ["name" => "Beauty"],
                    ["name" => "Bridal"],
                    ["name" => "Fashion"],
                    ["name" => "Other"],
                ]
            ],
            [
                'name' => "Film, Media & Entertainment",
                "subCategory" => [
                    ["name" => "Adult"],
                    ["name" => "Anime"],
                    ["name" => "Comedy"],
                    ["name" => "Comics"],
                    ["name" => "Film"],
                    ["name" => "Gaming"],
                    ["name" => "Other"],
                    ["name" => "TV"],
                ]
            ],
            [
                'name' => "Food & Drink",
                "subCategory" => [
                    ["name" => "Beer"],
                    ["name" => "Food"],
                    ["name" => "Other"],
                    ["name" => "Spirits"],
                    ["name" => "Wine"],
                ]
            ],
            [
                'name' => "Government & Politics",
                "subCategory" => [
                    ["name" => "County/Municipal Government "],
                    ["name" => "Democratic Party"],
                    ["name" => "Federal Government"],
                    ["name" => "International Affairs"],
                    ["name" => "Military"],
                    ["name" => "National Security"],
                    ["name" => "Non-partisan"],
                    ["name" => "Other"],
                    ["name" => "Other Party"],
                    ["name" => "Republican Party"],
                    ["name" => "State Government"],
                ]
            ],
            [
                'name' => "Health & Wellness",
                "subCategory" => [
                    ["name" => "Medical"],
                    ["name" => "Mental health"],
                    ["name" => "Other"],
                    ["name" => "Personal health"],
                    ["name" => "Spa"],
                    ["name" => "Yoga"],
                ]
            ],
            [
                'name' => "Hobbies & Special Interest",
                "subCategory" => [
                    ["name" => "Adult"],
                    ["name" => "Anime/Comics"],
                    ["name" => "Books"],
                    ["name" => "DIY"],
                    ["name" => "Drawing & Painting"],
                    ["name" => "Gaming"],
                    ["name" => "Knitting"],
                    ["name" => "Other"],
                    ["name" => "Photography"],
                ]
            ],
            [
                'name' => "Home & Lifestyle",
                "subCategory" => [
                    ["name" => "Dating"],
                    ["name" => "Home & Garden"],
                    ["name" => "Other"],
                    ["name" => "Pets & Animals"],
                ]
            ],
            [
                'name' => "Music",
                "subCategory" => [
                    ["name" => "Acoustic"],
                    ["name" => "Alternative"],
                    ["name" => "Americana"],
                    ["name" => "Bluegrass"],
                    ["name" => "Blues"],
                    ["name" => "Blues & Jazz"],
                    ["name" => "Classical"],
                    ["name" => "Country"],
                    ["name" => "Cultural"],
                    ["name" => "DJ/Dance"],
                    ["name" => "EDM"],
                    ["name" => "EDM / Electronic"],
                    ["name" => "Electronic"],
                    ["name" => "Experimental"],
                    ["name" => "Folk"],
                    ["name" => "Hip Hop / Rap"],
                    ["name" => "Indie"],
                    ["name" => "Jazz"],
                    ["name" => "Latin"],
                    ["name" => "Metal"],
                    ["name" => "Opera"],
                    ["name" => "Other"],
                    ["name" => "Pop"],
                    ["name" => "Psychedelic"],
                    ["name" => "Punk/Hardcore"],
                    ["name" => "R&B"],
                    ["name" => "Reggae"],
                    ["name" => "Religious/Spiritual"],
                    ["name" => "Rock"],
                    ["name" => "Singer/Songwriter"],
                    ["name" => "Top 40"],
                    ["name" => "World"],
                ]
            ],
            [
                'name' => "Performing & Visual Arts",
                "subCategory" => [
                    ["name" => "Ballet"],
                    ["name" => "Comedy"],
                    ["name" => "Craft"],
                    ["name" => "Dance"],
                    ["name" => "Design"],
                    ["name" => "Fine Art"],
                    ["name" => "Jewelry"],
                    ["name" => "Literary Arts"],
                    ["name" => "Musical"],
                    ["name" => "Opera"],
                    ["name" => "Orchestra"],
                    ["name" => "Other"],
                    ["name" => "Painting"],
                    ["name" => "Sculpture"],
                    ["name" => "Theatre"],
                ]
            ],
            [
                'name' => "Religion & Spirituality",
                "subCategory" => [
                    ["name" => "Agnosticism"],
                    ["name" => "Atheism"],
                    ["name" => "Buddhism"],
                    ["name" => "Christianity"],
                    ["name" => "Eastern Religion"],
                    ["name" => "Folk Religions"],
                    ["name" => "Hinduism"],
                    ["name" => "Islam"],
                    ["name" => "Judaism"],
                    ["name" => "Mormonism"],
                    ["name" => "Mysticism and Occult"],
                    ["name" => "New Age"],
                    ["name" => "Other"],
                    ["name" => "Shintoism"],
                    ["name" => "Sikhism"],
                    ["name" => "Unaffiliated"],
                ]
            ],
            [
                'name' => "School Activities",
                "subCategory" => [
                    ["name" => "After School Care"],
                    ["name" => "Dinner"],
                    ["name" => "Fund Raiser"],
                    ["name" => "Parking"],
                    ["name" => "Public Speaker"],
                    ["name" => "Raffle"],
                ]
            ],
            [
                'name' => "Science & Technology",
                "subCategory" => [
                    ["name" => "Biotech"],
                    ["name" => "High Tech"],
                    ["name" => "Medicine"],
                    ["name" => "Mobile"],
                    ["name" => "Other"],
                    ["name" => "Robotics"],
                    ["name" => "Science"],
                    ["name" => "Social Media"],
                ]
            ],
            [
                'name' => "Seasonal & Holiday",
                "subCategory" => [
                    ["name" => "Channukah"],
                    ["name" => "Christmas"],
                    ["name" => "Easter"],
                    ["name" => "Fall events"],
                    ["name" => "Halloween/Haunt"],
                    ["name" => "Independence Day"],
                    ["name" => "New Years Eve"],
                    ["name" => "Other"],
                    ["name" => "St Patricks Day"],
                    ["name" => "Thanksgiving"],
                ]
            ],
            [
                'name' => "Sports & Fitness",
                "subCategory" => [
                    ["name" => "Baseball"],
                    ["name" => "Basketball"],
                    ["name" => "Camps"],
                    ["name" => "Cheer"],
                    ["name" => "Cycling"],
                    ["name" => "Exercise"],
                    ["name" => "Fighting & Martial Arts"],
                    ["name" => "Football"],
                    ["name" => "Golf"],
                    ["name" => "Hockey"],
                    ["name" => "Lacrosse"],
                    ["name" => "Motorsports"],
                    ["name" => "Mountain Biking"],
                    ["name" => "Obstacles"],
                    ["name" => "Other"],
                    ["name" => "Rugby"],
                    ["name" => "Running"],
                    ["name" => "Snow Sports"],
                    ["name" => "Soccer"],
                    ["name" => "Softball"],
                    ["name" => "Swimming & Water Sports"],
                    ["name" => "Tennis"],
                    ["name" => "Track & Field"],
                    ["name" => "Volleyball"],
                    ["name" => "Walking"],
                    ["name" => "Weightlifting"],
                    ["name" => "Wrestling"],
                    ["name" => "Yoga"],
                ]
            ],
            [
                'name' => "Travel & Outdoor",
                "subCategory" => [
                    ["name" => "Canoeing"],
                    ["name" => "Climbing"],
                    ["name" => "Hiking"],
                    ["name" => "Kayaking"],
                    ["name" => "Other"],
                    ["name" => "Rafting"],
                    ["name" => "Travel"],
                ]
            ],
            [
                'name' => "Other",
                "subCategory" => []
            ],

        );

        foreach($categories as $category)   {
            $cat=EventCategory::create(["name" => $category['name'] ,"parent_id" => null]);
                foreach($category['subCategory'] as $subCategory) {
                   
                    $sub=EventCategory::create(["name" => $subCategory['name'] ,"parent_id" => $cat->id]);
                }

        }
    }
}
