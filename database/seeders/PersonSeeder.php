<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('persons')->insert([

            ['groupId' => 1,
             'name' => "イチロー",
             'ruby' => "イチロー",
             'character' => "おもしろい",
             'memo'=> "友達",
             'imageName'=>"image/ichiro.png",
            ],
            ['groupId' => 2,
             'name' => "ナオトインティライミ",
             'ruby' => "ナオトインティライミ",
             'character' => "かわいい",
             'memo'=> "先輩",
             'imageName'=>"image/naomi.png",
            ],
            ['groupId' => 2,
             'name' => "オードリー若林",
             'ruby' => "オードリーワカバヤシ",
             'character' => "おおらか",
             'memo'=> "飲み仲間",
             'imageName'=>"image/wakabayashi.png",
            ],
        ]);
    }
}