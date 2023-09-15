<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ja_JP'); 
        $companyNames = ['Coca-Cola', 'サントリー', 'キリン', '伊藤園', 'アサヒ', 'ダイドー', 'カゴメ', 'サッポロ'];

        foreach ($companyNames as $companyName) {
            DB::table('companies')->insert([
                'company_name' => $companyName,
                'street_address' => $faker->address, // 修正：会社名とともに住所も挿入
                'representative_name' => $faker->name, // 修正：代表者名もFakerでランダム生成
            ]);
        }
    }
    
}
