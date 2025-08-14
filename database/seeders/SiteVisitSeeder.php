<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteVisit;
use Carbon\Carbon;

class SiteVisitSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $countries = [
            ['name' => 'Egypt', 'code' => 'EG'],
            ['name' => 'Saudi Arabia', 'code' => 'SA'],
            ['name' => 'United Arab Emirates', 'code' => 'AE'],
            ['name' => 'United States', 'code' => 'US'],
            ['name' => 'Germany', 'code' => 'DE'],
            ['name' => 'United Kingdom', 'code' => 'GB'],
            ['name' => 'France', 'code' => 'FR'],
            ['name' => 'Canada', 'code' => 'CA'],
        ];

        $pages = [
            '/',
            '/services',
            '/about',
            '/contact',
            '/careers',
            '/blog',
        ];

        $userAgents = [
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0',
            'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1',
            'Mozilla/5.0 (iPad; CPU OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Tablet/15E148 Safari/604.1',
        ];

        // Generate visits for the last 30 days
        for ($i = 30; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $visitsCount = rand(50, 200); // Random visits per day

            for ($j = 0; $j < $visitsCount; $j++) {
                $country = $countries[array_rand($countries)];
                $page = $pages[array_rand($pages)];
                $userAgent = $userAgents[array_rand($userAgents)];

                SiteVisit::create([
                    'ip_address' => $this->generateRandomIP(),
                    'user_agent' => $userAgent,
                    'country' => $country['name'],
                    'country_code' => $country['code'],
                    'city' => $this->getRandomCity($country['name']),
                    'page_url' => $page,
                    'referrer' => rand(0, 1) ? 'https://google.com' : null,
                    'session_duration' => rand(30, 600), // 30 seconds to 10 minutes
                    'is_unique_visitor' => rand(0, 1),
                    'visitor_id' => 'visitor_' . uniqid(),
                    'created_at' => $date->addMinutes(rand(0, 1439)), // Random time during the day
                    'updated_at' => $date,
                ]);
            }
        }

        echo "✅ Site visit data created successfully!\n";
        echo "Generated visits for the last 30 days\n";
    }

    private function generateRandomIP(): string
    {
        return rand(1, 255) . '.' . rand(0, 255) . '.' . rand(0, 255) . '.' . rand(1, 255);
    }

    private function getRandomCity(string $country): string
    {
        $cities = [
            'Egypt' => ['Cairo', 'Alexandria', 'Giza', 'Luxor', 'Aswan'],
            'Saudi Arabia' => ['Riyadh', 'Jeddah', 'Mecca', 'Medina', 'Dammam'],
            'United Arab Emirates' => ['Dubai', 'Abu Dhabi', 'Sharjah', 'Ajman'],
            'United States' => ['New York', 'Los Angeles', 'Chicago', 'Houston', 'Phoenix'],
            'Germany' => ['Berlin', 'Munich', 'Hamburg', 'Cologne', 'Frankfurt'],
            'United Kingdom' => ['London', 'Manchester', 'Birmingham', 'Liverpool', 'Leeds'],
            'France' => ['Paris', 'Lyon', 'Marseille', 'Toulouse', 'Nice'],
            'Canada' => ['Toronto', 'Montreal', 'Vancouver', 'Calgary', 'Ottawa'],
        ];

        $countryCities = $cities[$country] ?? ['Unknown City'];
        return $countryCities[array_rand($countryCities)];
    }
}
