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
        Schema::disableForeignKeyConstraints();
        Sala::truncate();
        Schema::enableForeignKeyConstraints();

        $sala = new Sala();
        $sala->id = 'MZCKDA';
        $sala->save();
        $sala = new Sala();
        $sala->id = 'QEWJFV';
        $sala->save();
        $sala = new Sala();
        $sala->id = 'CWIJV0';
        $sala->save();

        User::truncate();
        $user = new User();
        $user->name = 'user';
        $user->email = 'mail@mail.org';
        $user->password = bcrypt('password');
        $user->sala_id = $sala->id;
        $user->favoritas = json_decode('[{"id":95557,"media_type":"tv"},{"id":559581,"media_type":"movie"}]');
        $user->por_ver = json_decode('[{"id":95557,"media_type":"tv"},{"id":559581,"media_type":"movie"}]');
        $user->save();

        $user = new User();
        $user->name = 'user2';
        $user->email = 'mail2@mail.org';
        $user->password = bcrypt('password');
        $user->favoritas = json_decode('[{"id":691179,"media_type":"movie"},{"id":637649,"media_type":"movie"},{"id":503736,"media_type":"movie"},{"id":337404,"media_type":"movie"}]');
        $user->por_ver = json_decode('[{"id":691179,"media_type":"movie"},{"id":637649,"media_type":"movie"},{"id":503736,"media_type":"movie"},{"id":337404,"media_type":"movie"}]');
        $user->save();
    }
}
