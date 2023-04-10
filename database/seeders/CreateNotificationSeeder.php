<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Models
use App\Models\NotificationTemplate;

class CreateNotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create dummy notification templates
        NotificationTemplate::insert([
            [
                'greeting' => "Dear ",
                'subject' => 'Happy New Year Wishes',
                'body' => "With the new year comes a sense of renewal: an opportunity to bring out the best in ourselves, moving forward with positivity and purpose. Thank you for being part of the WE Movement this year—whether you've been with us every step of the way or have just joined, we truly appreciate having you in our community.
                              Together, we change the world.",
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'greeting' => "Hello",
                'subject' => "Invitation Letter for Book Exhibition",
                'body' => "Readings, announces its own book exhibition for the first time. We invite you all for the Book Exhibition also offering discounts up to 20% on all the books. There is a huge variety of books this time, and many of the rare books have been ordered from different countries to please you all our customers. Looking forward to all the bookworms, or who love reading.",
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ]);
    }
}
