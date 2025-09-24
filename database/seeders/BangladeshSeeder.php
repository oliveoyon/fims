<?php

namespace Database\Seeders;

use App\Models\Component;
use Illuminate\Database\Seeder;
use App\Models\Division;
use App\Models\Zone;
use App\Models\District;
use App\Models\Upazila;

class BangladeshSeeder extends Seeder
{
    public function run()
    {
        // Clear existing data
        Upazila::truncate();
        District::truncate();
        Zone::truncate();
        Division::truncate();

        // Divisions with their Zones and Districts
        $divisionsData = [
            'Dhaka' => [
                'Dhaka Zone' => ['Dhaka', 'Faridpur', 'Gazipur'],
                'Tangail Zone' => ['Tangail', 'Madaripur']
            ],
            'Chattogram' => [
                'Chattogram Zone' => ['Chattogram', 'Coxs Bazar', 'Comilla'],
                'Feni Zone' => ['Feni', 'Brahmanbaria']
            ],
            'Khulna' => [
                'Khulna Zone' => ['Khulna', 'Jessore'],
                'Bagerhat Zone' => ['Bagerhat', 'Satkhira']
            ],
            'Rajshahi' => [
                'Rajshahi Zone' => ['Rajshahi', 'Pabna', 'Natore'],
            ],
            'Barishal' => [
                'Barishal Zone' => ['Barishal', 'Patuakhali'],
            ],
            'Sylhet' => [
                'Sylhet Zone' => ['Sylhet', 'Moulvibazar'],
            ],
            'Rangpur' => [
                'Rangpur Zone' => ['Rangpur', 'Dinajpur'],
            ],
            'Mymensingh' => [
                'Mymensingh Zone' => ['Mymensingh', 'Netrokona'],
            ],
        ];

        foreach ($divisionsData as $divisionName => $zones) {
            $division = Division::create(['name' => $divisionName]);

            foreach ($zones as $zoneName => $districts) {
                $zone = Zone::create([
                    'name' => $zoneName,
                    'division_id' => $division->id,
                ]);

                foreach ($districts as $districtName) {
                    $district = District::create([
                        'name' => $districtName,
                        'zone_id' => $zone->id,
                    ]);

                    // Add 2-3 upazilas per district for demo
                    for ($i = 1; $i <= 2; $i++) {
                        Upazila::create([
                            'name' => $districtName . ' Upazila ' . $i,
                            'district_id' => $district->id,
                        ]);
                    }
                }
            }
        }

        Component::truncate();

        $components = [
            'Big Classroom',
            'Head Teacher Room',
            'Staff Room',
            'Library',
            'Computer Lab',
            'Playground',
            'Canteen',
            'Toilet Block',
            'Boundary Wall',
            'Science Lab',
            'Assembly Hall',
            'Laboratory Storage Room',
        ];

        foreach ($components as $componentName) {
            Component::create(['name' => $componentName]);
        }
    }
}
