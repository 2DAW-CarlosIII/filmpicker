<?php

namespace Database\Seeders;

use App\Models\Sala;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Schema::disableForeignKeyConstraints();
        Sala::truncate();
        Schema::enableForeignKeyConstraints();

        $sala = new Sala();
        $sala->id = 'abcdef';
        $sala->save();

        User::truncate();
        $user = new User();
        $user->email = 'mail@mail.org';
        $user->password = bcrypt('password');
        $user->sala_id = $sala->id;
        $user->save();
    }
}
