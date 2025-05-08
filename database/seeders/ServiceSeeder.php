<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'AC Repair',
                'category' => 'Home Appliance',
                'price' => 1500,
                'description' => 'Repair and maintenance of air conditioning units.'
            ],
            [
                'name' => 'Plumbing',
                'category' => 'Home Maintenance',
                'price' => 800,
                'description' => 'Fixing leaks, clogged drains, and more.'
            ],
            [
                'name' => 'Car Wash',
                'category' => 'Auto',
                'price' => 500,
                'description' => 'Full exterior and interior car cleaning.'
            ],
            [
                'name' => 'Pest Control',
                'category' => 'Cleaning',
                'price' => 1200,
                'description' => 'Eliminate pests from your home or office.'
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
