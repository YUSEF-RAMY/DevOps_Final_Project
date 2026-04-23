<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;
use App\Models\Upazila;

class BangladeshDistrictsSeeder extends Seeder
{
    public function run(): void
    {
        $districts = [
            // Dhaka Division
            'Dhaka' => ['Dhaka', 'Gazipur', 'Kishoreganj', 'Manikganj', 'Munshiganj', 'Narayanganj', 'Narsingdi', 'Tangail', 'Faridpur', 'Gopalganj', 'Madaripur', 'Rajbari', 'Shariatpur'],
            
            // Chittagong Division
            'Chittagong' => ['Bandarban', 'Brahmanbaria', 'Chandpur', 'Chittagong', 'Comilla', 'Cox\'s Bazar', 'Feni', 'Khagrachhari', 'Lakshmipur', 'Noakhali', 'Rangamati'],
            
            // Rajshahi Division
            'Rajshahi' => ['Bogura', 'Joypurhat', 'Naogaon', 'Natore', 'Chapai Nawabganj', 'Pabna', 'Rajshahi', 'Sirajganj'],
            
            // Khulna Division
            'Khulna' => ['Bagerhat', 'Chuadanga', 'Jashore', 'Jhenaidah', 'Khulna', 'Kushtia', 'Magura', 'Meherpur', 'Narail', 'Satkhira'],
            
            // Barisal Division
            'Barisal' => ['Barguna', 'Barisal', 'Bhola', 'Jhalokati', 'Patuakhali', 'Pirojpur'],
            
            // Sylhet Division
            'Sylhet' => ['Habiganj', 'Moulvibazar', 'Sunamganj', 'Sylhet'],
            
            // Rangpur Division
            'Rangpur' => ['Dinajpur', 'Gaibandha', 'Kurigram', 'Lalmonirhat', 'Nilphamari', 'Panchagarh', 'Rangpur', 'Thakurgaon'],
            
            // Mymensingh Division
            'Mymensingh' => ['Jamalpur', 'Mymensingh', 'Netrokona', 'Sherpur'],
        ];

        $totalDistricts = 0;
        foreach ($districts as $division => $districtNames) {
            foreach ($districtNames as $index => $districtName) {
                District::updateOrCreate(
                    ['name' => $districtName, 'division' => $division],
                    [
                        'is_active' => true,
                        'sort_order' => $index,
                    ]
                );
                $totalDistricts++;
            }
        }
        
        $this->command->info("Seeded {$totalDistricts} districts across " . count($districts) . " divisions.");
    }
}

