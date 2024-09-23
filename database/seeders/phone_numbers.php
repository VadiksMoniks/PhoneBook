<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class phone_numbers extends Seeder
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
                'person_id' => '1',
                'phone_number' => '+38-093-583-4170',
            ],
            [
                'person_id' => '2',
                'phone_number' => '+38-099-903-7765',
            ],
            [
                'person_id' => '1',
                'phone_number' => '+38-052-227-0365',
            ],
            [
                'person_id' => '3',
                'phone_number' => '+54-981-551-2264',
            ],
            [
                'person_id' => '4',
                'phone_number' => '+38-099-765-4444',
            ],
            [
                'person_id' => '5',
                'phone_number' => '+4-444-444-4444',
            ],
            [
                'person_id' => '6',
                'phone_number' => '+4-444-444-4445',
            ],
            [
                'person_id' => '7',
                'phone_number' => '+4-444-444-4446',
            ],
            [
                'person_id' => '8',
                'phone_number' => '+38-052-227-0345',
            ],
            [
                'person_id' => '8',
                'phone_number' => '+4-444-222-6666',
            ],
            [
                'person_id' => '1',
                'phone_number' => '+1-215-666-7890',
            ],
            [
                'person_id' => '5',
                'phone_number' => '+4-444-444-4448',
            ],
        ];
    }

    public function run()
    {
        DB::table('phone_numbers')->truncate();
        DB::table('phone_numbers')->insert($this->data);
    }
}
