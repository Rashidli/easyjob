<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class VacanciesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Define company IDs and category IDs
        $companyIds = [1, 2];
        $categoryIds = [5, 6, 7, 8];

        // Generate 50 fake vacancies
        foreach (range(1, 50) as $index) {
            $vacancyName = $faker->jobTitle;
            $slug = Str::slug($vacancyName);

            // Ensure the slug is unique by appending an index if needed
            $existingSlugCount = DB::table('vacancies')->where('slug', $slug)->count();
            if ($existingSlugCount > 0) {
                $slug = $slug . '-' . $index;
            }

            DB::table('vacancies')->insert([
                'vacancy_name' => $vacancyName,
                'slug' => $slug,
                'company_id' => $faker->randomElement($companyIds),
                'company_name' => $faker->company,
                'company_logo' => $faker->imageUrl(100, 100, 'business'),
                'category_id' => $faker->randomElement($categoryIds),
                'job_responsibilities' => $faker->text(200),
                'requirements' => $faker->text(200),
                'working_conditions' => $faker->text(200),
                'application_method' => $faker->url,
                'salary' => $faker->randomFloat(2, 1000, 5000),
                'is_active' => $faker->boolean,
                'is_premium' => $faker->boolean,
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'), // Random date from the past 2 years
                'updated_at' => $faker->dateTimeBetween('-2 years', 'now'), // Another random date from the past 2 years
            ]);
        }
    }
}
