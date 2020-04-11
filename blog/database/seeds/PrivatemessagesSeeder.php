<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use App\User; 

class PrivatemessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('privatemessages')->delete(); 
        $faker = Faker\Factory::create();
        $users = User::all()->pluck('id')->toArray();
  
        DB::table('privatemessages')->insert([
            'user_id' => $faker->randomElement($users),
            'message' => 'Привет! Как твои дела?',            
        ]);   
        DB::table('privatemessages')->insert([
            'user_id' => $faker->randomElement($users),
            'message' => 'Цикл, без использования формальных признаков поэзии, диссонирует мелодический скрытый смысл, но не рифмами. Эстетическое воздействие, не учитывая количества слогов, стоящих между ударениями, притягивает реципиент, заметим, каждое стихотворение объединено вокруг основного философского стержня.', 
        ]);
        DB::table('privatemessages')->insert([
            'user_id' => $faker->randomElement($users),
            'message' => 'Метафора выбирает мифологический поток сознания, несмотря на отсутствие единого пунктуационного алгоритма. Матрица абсурдно нивелирует подтекст, особенно подробно рассмотрены трудности, с которыми сталкивалась женщина-крестьянка в 19 веке. Комбинаторное приращение нивелирует мелодический дискурс, несмотря на отсутствие единого пунктуационного алгоритма. Расположение эпизодов вызывает литературный эпитет, также необходимо сказать о сочетании метода апроприации художественных стилей прошлого с авангардистскими стратегиями.', 
        ]);
        DB::table('privatemessages')->insert([
            'user_id' => $faker->randomElement($users),
            'message' => 'Развивая эту тему, типизация отталкивает амфибрахий – это уже пятая стадия понимания по М.Бахтину.', 
        ]);  
    }
}
