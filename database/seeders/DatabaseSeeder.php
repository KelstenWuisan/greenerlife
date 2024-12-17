<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;
use App\Models\Challenge;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(5)->create();

        \App\Models\Category::firstOrCreate(
            ['name' => 'Volunteer'], 
            ['slug' => 'volunteer']
        );
        
        \App\Models\Category::firstOrCreate(
            ['name' => 'Fundraiser'], 
            ['slug' => 'fundraiser']
        );
        
        \App\Models\Category::firstOrCreate(
            ['name' => 'Workshop'], 
            ['slug' => 'workshop']
        );
        
        \App\Models\Category::firstOrCreate(
            ['name' => 'Seminar'], 
            ['slug' => 'seminar']
        );
        

        \App\Models\Post::factory(10)->create();

        // Seed challenges
        Challenge::factory()->create([
            'title' => 'Plastic-Free Week',
            'description' => 'Avoid using single-use plastics for one week.',
            'points' => 50,
        ]);

        Challenge::factory()->create([
            'title' => 'Carpool Challenge',
            'description' => 'Carpool with colleagues or friends for one week.',
            'points' => 75,
        ]);

        Challenge::factory()->create([
            'title' => 'Energy Saver Week',
            'description' => 'Reduce your energy consumption by turning off lights and unplugging devices when not in use.',
            'points' => 60,
        ]);
        
        Challenge::factory()->create([
            'title' => 'Water Conservation Challenge',
            'description' => 'Limit your water usage by taking shorter showers and fixing leaks in your home.',
            'points' => 70,
        ]);
        
        Challenge::factory()->create([
            'title' => 'Upcycle Project',
            'description' => 'Create something new and useful by upcycling old or discarded items.',
            'points' => 80,
        ]);
        
        Challenge::factory()->create([
            'title' => 'Community Cleanup Day',
            'description' => 'Participate in a local cleanup event to remove trash from parks, beaches, or streets.',
            'points' => 90,
        ]);
        
        Challenge::factory()->create([
            'title' => 'Eco-Friendly Transportation',
            'description' => 'Use bicycles, walking, or public transport instead of driving for a week.',
            'points' => 50,
        ]);

        Challenge::factory()->create([
            'title' => 'Plant a Tree',
            'description' => 'Plant a tree in your neighborhood or garden.',
            'points' => 100,
        ]);
        
        Product::create([
            'name' => 'Earthbound Spirit T-Shirt',
            'description' => 'tribute to the planet beauty and the life it sustains',
            'price' => 50.00,
            'stock' => 50,
            'image' => 'images/product1.jpg',
        ]);

        Product::create([
            'name' => 'Life On Earth Hoodie',
            'description' => 'nature-inspired design symbolizes our shared journey on this planet and the need to nurture the life around us.',
            'price' => 99.00,
            'stock' => 30,
            'image' => 'images/product2.jpg',
        ]);

        Product::create([
            'name' => 'Black Leather Jacket Vol II "The Savior"',
            'description' => 'Make a bold statement with the "Save The Earth" leather jacket. Designed for those who care about the planet, this jacket serves as a reminder of our responsibility to protect the environment and preserve its beauty for future generations.',
            'price' => 199.00,
            'stock' => 30,
            'image' => 'images/product3.jpg',
        ]);

        Product::create([
            'name' => 'Black Leather Jacket vol I "The Earth"',
            'description' => 'A timeless piece with a powerful message, the "Save The Earth" leather jacket is for the eco-conscious adventurer. Crafted to stand out, it represents the strength and resilience needed to safeguard the world we call home.',
            'price' => 199.00,
            'stock' => 30,
            'image' => 'images/product4.jpg',
        ]);

        Product::create([
            'name' => 'Green Earth ToteBag',
            'description' => 'Perfect for everyday use, this bag symbolizes the importance of eco-friendly choices and the ongoing efforts to protect the natural world.',
            'price' => 59.00,
            'stock' => 30,
            'image' => 'images/product5.jpg',
        ]);

        
        // \App\Models\Post::create([
        //     'title' => 'Judul pertama',
        //     'slug' => 'judul-pertama',
        //     'excerpt' => "Aku suka anjing kecil, kuberi nama enrique, enrique guk guk guk kemarin guk guk guk ayo bawa lari, enrique guk guk guk kemari guk guk guk ayo bawa lari.",
        //     "body" => "Dia suka bermain main.",
        //     "category_id" => 1,
        //     'user_id' => 1
        // ]);

        // \App\Models\Post::create([
        //     'title' => 'Judul kedua',
        //     'slug' => 'judul-kedua',
        //     'excerpt' => "Aku suka anjing kecil, kuberi nama enrique, enrique guk guk guk kemarin guk guk guk ayo bawa lari, enrique guk guk guk kemari guk guk guk ayo bawa lari.",
        //     "body" => "Dia suka bermain main.",
        //     'category_id' => 2,
        //     'user_id' => 1
        // ]);

        // \App\Models\Post::create([
        //     'title' => 'Judul ketiga',
        //     'slug' => 'judul-ketiga',
        //     'excerpt' => "Aku suka anjing kecil, kuberi nama enrique, enrique guk guk guk kemarin guk guk guk ayo bawa lari, enrique guk guk guk kemari guk guk guk ayo bawa lari.",
        //     "body" => "Dia suka bermain main.",
        //     'category_id' => 2,
        //     'user_id' => 2
        // ]);
    }
}
