<?php

namespace Database\Seeders;

use App\Models\CustomerReview;
use App\Models\Faq;
use Illuminate\Database\Seeder;

class HomeContentSeeder extends Seeder
{
    public function run(): void
    {
        $reviews = [
            [
                'customer_name' => 'Sarah Mitchell',
                'customer_title' => 'Homeowner',
                'location' => 'Melbourne',
                'rating' => 5,
                'review_text' => 'Mega Carpets made the whole flooring process simple. We compared carpet colours, selected the right range for our bedrooms and booked a measure and quote without any confusion. The guidance felt professional and very easy to understand.',
                'sort_order' => 1,
            ],
            [
                'customer_name' => 'James Carter',
                'customer_title' => 'Renovation Client',
                'location' => 'South Melbourne',
                'rating' => 5,
                'review_text' => 'The showroom experience was clean and helpful. I liked that we could compare product ranges before asking for a quote. It saved time and helped us understand which flooring option suited our living area.',
                'sort_order' => 2,
            ],
            [
                'customer_name' => 'Amelia Brown',
                'customer_title' => 'Interior Styling Client',
                'location' => 'Victoria',
                'rating' => 5,
                'review_text' => 'The team helped us choose colours that matched our furniture and room style. The process felt premium but still practical. The review and quote steps were clear from start to finish.',
                'sort_order' => 3,
            ],
        ];

        foreach ($reviews as $review) {
            CustomerReview::updateOrCreate(
                ['customer_name' => $review['customer_name']],
                array_merge($review, [
                    'is_featured' => true,
                    'is_active' => true,
                ])
            );
        }

        $faqs = [
            [
                'question' => 'Can customers buy online?',
                'answer' => 'This website is designed for quote and booking first. Customers can browse products, save favourites and request a consultation.',
                'sort_order' => 1,
            ],
            [
                'question' => 'Can this become a full e-commerce website later?',
                'answer' => 'Yes. Cart, payment, delivery and order management can be added later without changing the product catalogue structure.',
                'sort_order' => 2,
            ],
            [
                'question' => 'Can the product data come from an admin panel?',
                'answer' => 'Yes. Products, categories, colours, sizes, images, reviews and FAQs can be managed from the Laravel admin panel.',
                'sort_order' => 3,
            ],
            [
                'question' => 'Can customers request a free measure and quote?',
                'answer' => 'Yes. Quote requests are saved in the admin panel so the team can follow up with customers.',
                'sort_order' => 4,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                array_merge($faq, [
                    'category' => 'General',
                    'is_active' => true,
                ])
            );
        }
    }
}