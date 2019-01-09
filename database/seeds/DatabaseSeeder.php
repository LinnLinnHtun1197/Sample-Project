<?php

use App\Widget;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Widget::unguard();
        Widget::truncate();
        factory(Widget::class,30)->create();
        Widget::reguard();
    }
}
