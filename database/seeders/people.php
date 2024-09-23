<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class people extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $data;

    public function __construct()
    {
        $this->data = [
            [
                'last_name' => 'James',
                'first_name' => 'Jasmine',
            ],
            [
                'last_name' => 'Boss',
                'first_name' => 'Hugo',
            ],
            [
                'last_name' => 'Gimenez',
                'first_name' => 'Juan',
            ],
            [
                'last_name' => 'Soprano',
                'first_name' => 'Tony',
            ],
            [
                'last_name' => 'Jovovich',
                'first_name' => 'Milla',
            ],
            [
                'last_name' => 'Michael',
                'first_name' => 'Moore',
            ],
            [
                'last_name' => 'Gleesone',
                'first_name' => 'Brendan',
            ],
            [
                'last_name' => 'Cruise',
                'first_name' => 'Thomas',
            ],
            [
                'last_name' => 'Husein',
                'first_name' => 'Saddam',
            ]
        ];
    }

    public function run()
    {
        DB::table('phone_numbers')->truncate();
        DB::table('people')->insert($this->data);
    }
}
