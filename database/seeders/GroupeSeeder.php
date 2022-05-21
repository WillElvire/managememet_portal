<?php

namespace Database\Seeders;
use App\Models\group;
use Illuminate\Database\Seeder;

class GroupeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        group::create([
            'name'=>'internal control',
        ]);
        group::create([
            'name'=>'compliance',
        ]);
        group::create([
            'name'=>'voting',
        ]);
    }
}
