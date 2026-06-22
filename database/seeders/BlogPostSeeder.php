<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'How to Choose the Right Carpet for Every Room',
                'slug' => 'how-to-choose-the-right-carpet-for-every-room',
                'excerpt' => 'A practical guide to choosing carpet by room, lifestyle, comfort, durability and budget.',
                'content' => <<<'TEXT'
Choosing the right carpet is not only about colour. The best carpet for your home depends on the room, the amount of foot traffic, the feel you want underfoot, and how easy the carpet needs to be to maintain.

For bedrooms, many customers prefer a softer carpet because comfort is the main priority. A plush or cut pile carpet can make a bedroom feel warmer and more relaxing. If the room is used mainly for sleeping, you can often choose a softer finish without worrying too much about heavy wear.

For living rooms and family rooms, durability becomes more important. These areas are used every day, so the carpet should handle regular foot traffic, furniture, children, pets and general movement. A good quality nylon, wool blend or loop pile carpet can work well depending on the look and budget.

For hallways, stairs and entry areas, choose a hard wearing option. These spaces usually receive the most traffic, so soft luxury alone is not enough. You need a carpet that can hold its shape and resist visible wear.

Colour also matters. Lighter carpet can make a room feel larger and brighter, but it may show marks more easily. Mid-tone neutral colours are often a safe choice for family homes because they hide everyday dust and blend with many interior styles.

Before making a final decision, it is always best to see samples in your own home. Lighting can change the way carpet looks. A colour that looks warm in a showroom may appear different in your bedroom or lounge.

A free measure and quote helps confirm the right product, estimated quantity, installation needs and total cost. This gives you a clearer picture before making a final decision.
TEXT,
                'meta_title' => 'How to Choose the Right Carpet for Every Room',
                'meta_description' => 'Learn how to choose the right carpet for bedrooms, living rooms, hallways and family spaces based on comfort, durability and budget.',
                'status' => 'published',
                'is_featured' => true,
                'published_at' => Carbon::now()->subDays(10),
            ],
            [
                'title' => 'Carpet vs Hybrid Flooring: Which One Is Better for Your Home?',
                'slug' => 'carpet-vs-hybrid-flooring-which-one-is-better',
                'excerpt' => 'Compare carpet and hybrid flooring so you can choose the best option for comfort, durability and everyday use.',
                'content' => <<<'TEXT'
Carpet and hybrid flooring are both popular choices, but they suit different rooms and different lifestyles.

Carpet is usually chosen for comfort, warmth and softness. It works especially well in bedrooms, theatre rooms, upstairs areas and family spaces where a softer feel is important. Carpet can also help reduce noise, which makes it a good option for busy homes and multi-level properties.

Hybrid flooring is a hard flooring option designed to look like timber while offering practical durability. It is often used in living rooms, kitchens, dining areas, hallways and rental properties. Many hybrid floors are water resistant, easy to clean and suitable for high traffic areas.

If comfort is your main priority, carpet is usually the better choice. It feels softer underfoot and creates a warmer atmosphere. If easy cleaning and water resistance are more important, hybrid flooring may be the better fit.

The final decision often comes down to room use. Bedrooms are usually better with carpet. Open plan living areas often work well with hybrid flooring. Some homes use both, with carpet in private spaces and hybrid in shared areas.

Budget is another factor. The product price is only one part of the full cost. Installation, floor preparation, underlay, trims and room layout can all affect the final quote. That is why a measure and quote is important before deciding.

A good flooring plan should balance comfort, style and long term performance. The right choice is not always one product for the whole home. Often the best result comes from using different flooring types in the right areas.
TEXT,
                'meta_title' => 'Carpet vs Hybrid Flooring: Which Is Better?',
                'meta_description' => 'Compare carpet and hybrid flooring for comfort, durability, maintenance, water resistance and room suitability.',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => Carbon::now()->subDays(9),
            ],
            [
                'title' => 'What to Know Before Booking a Free Flooring Measure and Quote',
                'slug' => 'what-to-know-before-booking-a-free-flooring-measure-and-quote',
                'excerpt' => 'Understand what happens during a flooring measure and quote and how to prepare before your appointment.',
                'content' => <<<'TEXT'
A free measure and quote is one of the most useful steps when planning new flooring. It helps you understand product options, measurements, preparation needs and estimated cost before committing.

Before the appointment, think about which rooms you want to update. Make a simple list of bedrooms, living areas, stairs, hallway, kitchen or any other spaces. This helps the flooring consultant understand the full project.

It also helps to think about your preferred flooring type. You do not need to know the exact product, but it is useful to know whether you are interested in carpet, timber, hybrid, laminate, vinyl or rugs. If you are unsure, the consultant can guide you based on the room and lifestyle.

During the measure, the team may check room size, floor condition, doorway areas, stairs, joins, trims and installation requirements. These details can affect the final price, so measuring accurately is important.

If you already have existing flooring, the consultant may discuss whether it needs to be removed and whether the subfloor needs preparation. Floor preparation can make a big difference to the final result.

You should also ask about timing. Some products may be available quickly, while others may depend on stock or supplier lead times. If you have a deadline, mention it early.

A free quote gives you more confidence because it turns rough ideas into a clearer plan. It helps you compare products properly and avoid guessing based only on online prices.
TEXT,
                'meta_title' => 'What to Know Before a Free Flooring Quote',
                'meta_description' => 'Learn how to prepare for a free flooring measure and quote, including room details, product choices and installation planning.',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => Carbon::now()->subDays(8),
            ],
            [
                'title' => 'Best Flooring Options for Busy Family Homes',
                'slug' => 'best-flooring-options-for-busy-family-homes',
                'excerpt' => 'Explore practical flooring options for families with children, pets and high traffic living spaces.',
                'content' => <<<'TEXT'
Family homes need flooring that looks good, feels comfortable and handles daily life. Children, pets, guests, furniture and regular cleaning all put pressure on flooring, so choosing the right product is important.

Carpet is still a popular choice for bedrooms and family rooms because it is soft and comfortable. It can also help reduce noise, which is useful in homes with children. For family use, choose carpet that is durable and easy to maintain.

Hybrid flooring is a practical choice for open plan spaces. It is popular because it gives a timber look while being easier to clean. Many families choose hybrid flooring for kitchens, dining areas and living areas because it suits high traffic spaces.

Laminate flooring is another budget friendly option. It can give a modern timber style at a lower price point. Good quality laminate can work well in rental homes, apartments and family areas where style and value are both important.

Vinyl flooring is also worth considering. It is comfortable underfoot, easy to clean and suitable for many rooms. Vinyl can be especially useful in homes where water resistance and maintenance are priorities.

For rugs, choose sizes and textures that suit the room. Rugs can soften hard floors, add warmth and create zones in open plan living spaces.

The best family flooring plan usually uses different products for different areas. Carpet in bedrooms, hybrid or laminate in living areas, and rugs for comfort can create a balanced result.
TEXT,
                'meta_title' => 'Best Flooring Options for Busy Family Homes',
                'meta_description' => 'Discover the best flooring options for family homes, including carpet, hybrid, laminate, vinyl and rugs.',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => Carbon::now()->subDays(7),
            ],
            [
                'title' => 'How to Choose Carpet Colour for Your Home',
                'slug' => 'how-to-choose-carpet-colour-for-your-home',
                'excerpt' => 'Simple tips for choosing carpet colours that match your room, lighting, furniture and lifestyle.',
                'content' => <<<'TEXT'
Carpet colour can completely change the feeling of a room. The right colour can make a space feel warm, bright, calm or more premium.

Start by looking at the room lighting. Natural light makes colours look different throughout the day. A carpet that looks beige in a showroom may look warmer or cooler inside your home. This is why viewing samples at home is always helpful.

Neutral carpet colours are popular because they work with many interior styles. Light grey, warm beige, taupe and soft brown can match different furniture and wall colours. Neutral carpet also makes it easier to update furniture later.

Dark carpet can create a strong and dramatic look, but it may make a small room feel smaller. It can also show lint or dust depending on the fibre. Mid-tone colours are often the most practical because they hide everyday marks better than very light or very dark shades.

If you have children or pets, choose a colour that is forgiving. Textured carpets and mixed tone carpets can help hide small marks and footprints.

Also think about the mood you want. Warm tones can make a room feel cosy. Cooler tones can feel clean and modern. Natural tones can create a relaxed and timeless style.

The safest approach is to compare a few samples in the actual room. Look at them during the day and at night. This helps you choose a carpet colour that works in real life, not just in a showroom.
TEXT,
                'meta_title' => 'How to Choose Carpet Colour for Your Home',
                'meta_description' => 'Tips for choosing carpet colour based on lighting, room size, furniture, lifestyle and maintenance.',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => Carbon::now()->subDays(6),
            ],
            [
                'title' => 'Timber Flooring: A Classic Choice for Modern Homes',
                'slug' => 'timber-flooring-classic-choice-for-modern-homes',
                'excerpt' => 'Learn why timber flooring remains a popular option for homes that need warmth, style and long term appeal.',
                'content' => <<<'TEXT'
Timber flooring has a timeless look that works across many home styles. It can feel warm, natural and premium, which is why many homeowners consider it for living rooms, hallways and feature spaces.

One of the biggest advantages of timber flooring is its visual character. Natural grain patterns and colour variation give each floor a unique appearance. This can make a room feel more established and high quality.

Timber flooring also works well with many interior styles. It can suit modern, coastal, classic, Scandinavian and luxury spaces. Furniture, rugs and wall colours can be changed over time while timber flooring remains a strong base.

However, timber flooring needs the right environment and care. It may not be suitable for every wet area, and it can require more attention than some other flooring types. The subfloor, installation method and room conditions all matter.

If you love the timber look but need easier maintenance, hybrid or laminate flooring may also be worth considering. These options can provide a timber style with different practical benefits.

Before choosing timber, it is best to compare samples in your home and discuss installation requirements. A measure and quote helps confirm whether timber is suitable for your rooms and what preparation may be required.

Timber flooring is not just a product choice. It is a design decision that can shape the whole feel of your home.
TEXT,
                'meta_title' => 'Timber Flooring for Modern Homes',
                'meta_description' => 'Learn the benefits of timber flooring, where it works best and what to consider before installation.',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Why Hybrid Flooring Is Popular in Modern Renovations',
                'slug' => 'why-hybrid-flooring-is-popular-in-modern-renovations',
                'excerpt' => 'Hybrid flooring is popular because it combines timber style with practical everyday performance.',
                'content' => <<<'TEXT'
Hybrid flooring has become a popular choice for modern renovations because it offers a balance of style and practicality. It gives the look of timber while being designed for everyday living.

Many customers choose hybrid flooring for open plan areas, kitchens, dining rooms and hallways. It can handle regular foot traffic and is often easier to clean than some traditional flooring options.

The timber look is one of the main reasons hybrid flooring is popular. It can create a warm and natural style without using real timber. This makes it suitable for homes where customers want a modern finish with practical benefits.

Hybrid flooring can also be a strong option for rental properties and investment homes. It gives a clean and updated appearance while being practical for daily use.

Another advantage is design variety. Hybrid flooring comes in many colours, plank styles and finishes. You can choose light oak looks, warm brown tones, grey tones or darker modern styles.

Before selecting hybrid flooring, check the room conditions and installation requirements. Subfloor preparation is important for a good result. An uneven floor may need work before installation.

A quote helps confirm the final cost, including product, installation, trims and preparation. This makes it easier to compare hybrid flooring with timber, laminate or vinyl.
TEXT,
                'meta_title' => 'Why Hybrid Flooring Is Popular',
                'meta_description' => 'Find out why hybrid flooring is popular for renovations, rental homes and open plan living spaces.',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => Carbon::now()->subDays(4),
            ],
            [
                'title' => 'Laminate Flooring: Style and Value for Everyday Homes',
                'slug' => 'laminate-flooring-style-and-value-for-everyday-homes',
                'excerpt' => 'Laminate flooring can be a stylish and cost effective choice for many everyday homes and rooms.',
                'content' => <<<'TEXT'
Laminate flooring is often chosen by customers who want the look of timber at a more affordable price. It can provide a clean, modern finish and works well in many everyday homes.

One of the main benefits of laminate flooring is value. It allows homeowners to update the look of a space without choosing premium timber. This makes it attractive for renovations, rental properties and budget conscious projects.

Laminate flooring is available in many finishes. Some products have realistic timber patterns, textured surfaces and modern colours. This gives customers a wide range of design options.

It can be suitable for living areas, bedrooms, hallways and some commercial spaces depending on the product rating. For high traffic areas, choose a laminate designed for durability.

Like any flooring, installation quality matters. The subfloor should be checked before laying laminate. If the surface is uneven or damaged, preparation may be needed.

Laminate is not always the best choice for wet areas, so discuss room suitability before deciding. For areas where water resistance is a major concern, hybrid or vinyl may be better options.

A flooring expert can help compare laminate with timber, hybrid and vinyl so you understand the best option for your home and budget.
TEXT,
                'meta_title' => 'Laminate Flooring Style and Value',
                'meta_description' => 'Learn why laminate flooring is a popular affordable option for everyday homes, rentals and renovations.',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => Carbon::now()->subDays(3),
            ],
            [
                'title' => 'Vinyl Flooring: Practical, Comfortable and Easy to Maintain',
                'slug' => 'vinyl-flooring-practical-comfortable-easy-to-maintain',
                'excerpt' => 'Vinyl flooring is a practical option for homes that need comfort, easy cleaning and modern design.',
                'content' => <<<'TEXT'
Vinyl flooring is known for being practical, comfortable and easy to maintain. It can suit many rooms and is often chosen by customers who want a durable floor without a high maintenance routine.

One of the biggest advantages of vinyl is comfort underfoot. It can feel softer and warmer than some hard flooring options. This makes it useful for kitchens, laundries, living areas and rental homes.

Vinyl is also easy to clean. Regular sweeping and mopping are usually enough for everyday maintenance. This makes it a good option for busy households.

Modern vinyl flooring comes in many designs. You can find timber look vinyl, stone look vinyl and neutral styles that suit different interiors. This gives customers design flexibility without sacrificing practicality.

Vinyl can also be useful in areas where moisture resistance matters. Product suitability can vary, so it is always best to check the specific vinyl option before choosing it for wet areas.

Installation and floor preparation are important. A smooth subfloor helps create a better finish. If the existing floor is uneven, preparation may be required before installation.

For many customers, vinyl flooring offers a strong mix of comfort, practicality and value. It is worth comparing with hybrid, laminate and timber before making a final decision.
TEXT,
                'meta_title' => 'Vinyl Flooring Benefits and Uses',
                'meta_description' => 'Learn why vinyl flooring is practical, comfortable, easy to clean and suitable for many modern homes.',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => Carbon::now()->subDays(2),
            ],
            [
                'title' => 'How Rugs Can Complete a Living Room',
                'slug' => 'how-rugs-can-complete-a-living-room',
                'excerpt' => 'A rug can add comfort, warmth, colour and structure to your living room design.',
                'content' => <<<'TEXT'
Rugs are one of the easiest ways to finish a living room. They can add warmth, softness, colour and structure without replacing the whole floor.

In open plan homes, rugs help define different zones. A rug under the lounge setting can separate the living area from the dining or kitchen space. This makes the room feel more organised and intentional.

Size is very important. A rug that is too small can make a room feel disconnected. A larger rug usually creates a more premium look because it connects the sofa, chairs and coffee table.

Texture also matters. A soft rug can make a room feel cosy and relaxed. A flatter weave may be easier to maintain in high traffic areas. The right choice depends on how the room is used.

Colour and pattern can change the whole mood of the space. Neutral rugs create a calm base. Patterned rugs can add personality and hide small marks. Darker rugs can create contrast, while lighter rugs can brighten a room.

Rugs can also make hard floors feel more comfortable. If you have timber, hybrid, laminate or vinyl flooring, adding a rug can soften the space and reduce echo.

A good rug should feel connected to the room. Think about furniture, wall colour, flooring colour and lifestyle before choosing the final size and style.
TEXT,
                'meta_title' => 'How Rugs Complete a Living Room',
                'meta_description' => 'Learn how rugs add comfort, warmth, structure and style to living rooms and open plan spaces.',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => Carbon::now()->subDay(),
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::updateOrCreate(
                ['slug' => $post['slug']],
                [
                    'title' => $post['title'],
                    'excerpt' => $post['excerpt'],
                    'content' => $post['content'],
                    'featured_image' => null,
                    'meta_title' => $post['meta_title'],
                    'meta_description' => $post['meta_description'],
                    'status' => $post['status'],
                    'is_featured' => $post['is_featured'],
                    'published_at' => $post['published_at'],
                ]
            );
        }
    }
}