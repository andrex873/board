<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Board\Database\Entities\Board;
use Board\Database\Entities\Note;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        factory(Board::class, 10)->create();
        factory(Note::class, 80)->create();

        // $this->call(BoardTableSeeder::class);

        Model::reguard();
    }
}
