<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::factory()->count(7)->has(Ticket::factory()->count(1), 'tickets')->create();
    }
}
