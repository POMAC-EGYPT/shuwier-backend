<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['name_en' => 'English', 'name_ar' => 'الإنجليزية'],
            ['name_en' => 'Chinese', 'name_ar' => 'الصينية'],
            ['name_en' => 'Spanish', 'name_ar' => 'الإسبانية'],
            ['name_en' => 'Hindi', 'name_ar' => 'الهندية'],
            ['name_en' => 'Arabic', 'name_ar' => 'العربية'],
            ['name_en' => 'Bengali', 'name_ar' => 'البنغالية'],
            ['name_en' => 'Portuguese', 'name_ar' => 'البرتغالية'],
            ['name_en' => 'Russian', 'name_ar' => 'الروسية'],
            ['name_en' => 'Japanese', 'name_ar' => 'اليابانية'],
            ['name_en' => 'German', 'name_ar' => 'الألمانية'],
            ['name_en' => 'French', 'name_ar' => 'الفرنسية'],
            ['name_en' => 'Urdu', 'name_ar' => 'الأردية'],
            ['name_en' => 'Indonesian', 'name_ar' => 'الإندونيسية'],
            ['name_en' => 'Turkish', 'name_ar' => 'التركية'],
            ['name_en' => 'Tamil', 'name_ar' => 'التاميلية'],
            ['name_en' => 'Vietnamese', 'name_ar' => 'الفيتنامية'],
            ['name_en' => 'Korean', 'name_ar' => 'الكورية'],
            ['name_en' => 'Persian', 'name_ar' => 'الفارسية'],
            ['name_en' => 'Swahili', 'name_ar' => 'السواحلية'],
            ['name_en' => 'Italian', 'name_ar' => 'الإيطالية'],
        ];

        foreach ($languages as $language)
            Language::create($language);
    }
}
