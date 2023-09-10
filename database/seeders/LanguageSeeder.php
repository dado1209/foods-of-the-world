<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //get all the languagues that we will use from config
        $locales = Config::get('translatable.locales');
        //create language in languages table
        foreach ($locales as $locale) {
            $language = new Language();
            $language->name = $locale;
            $language->save();
        }
    }
}
