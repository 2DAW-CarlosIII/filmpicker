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
        $sala->id = 'abcdef';
        $sala->save();

        User::truncate();
        $user = new User();
        $user->name = 'user';
        $user->email = 'mail@mail.org';
        $user->password = bcrypt('password');
        $user->sala_id = $sala->id;
        $user->favoritas = json_decode('[{"id":95557,"media_type":"tv"}, {"id":559581,"media_type":"movie"},{"id":95557,"media_type":"tv"}, {"id":559581,"media_type":"movie"},{"id":95557,"media_type":"tv"}, {"id":559581,"media_type":"movie"},{"id":95557,"media_type":"tv"}, {"id":559581,"media_type":"movie"},{"id":95557,"media_type":"tv"}, {"id":559581,"media_type":"movie"},{"id":95557,"media_type":"tv"}, {"id":559581,"media_type":"movie"},{"id":95557,"media_type":"tv"}, {"id":559581,"media_type":"movie"},{"id":95557,"media_type":"tv"}, {"id":559581,"media_type":"movie"},{"id":95557,"media_type":"tv"}, {"id":559581,"media_type":"movie"},{"id":95557,"media_type":"tv"}, {"id":559581,"media_type":"movie"},{"id":95557,"media_type":"tv"}, {"id":559581,"media_type":"movie"},{"id":95557,"media_type":"tv"}, {"id":559581,"media_type":"movie"}]');
        $user->por_ver = json_decode('[{"id":95557,"media_type":"tv"}, {"id":559581,"media_type":"movie"}]');
        $user->save();
    }
}
