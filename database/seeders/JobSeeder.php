<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\User;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Get the owner user to assign as job creator
        $owner = User::where('role', 'owner')->first();
        
        if (!$owner) {
            echo "No owner user found. Please run AdminUserSeeder first.\n";
            return;
        }

        // Create sample jobs
        $jobs = [
            [
                'title' => 'Senior Frontend Developer',
                'slug' => 'senior-frontend-developer',
                'description' => "We are looking for a Senior Frontend Developer to join our dynamic team. You will be responsible for developing user-facing web applications using modern JavaScript frameworks.\n\nKey Responsibilities:\n• Develop responsive web applications using React, Vue.js, or Angular\n• Collaborate with UX/UI designers to implement pixel-perfect designs\n• Optimize applications for maximum speed and scalability\n• Write clean, maintainable, and well-documented code\n• Participate in code reviews and mentor junior developers",
                'requirements' => "Required Skills:\n• 5+ years of experience in frontend development\n• Expert knowledge of HTML5, CSS3, and JavaScript (ES6+)\n• Proficiency in React, Vue.js, or Angular\n• Experience with state management libraries (Redux, Vuex, etc.)\n• Knowledge of build tools (Webpack, Vite, etc.)\n• Understanding of responsive design and cross-browser compatibility\n• Experience with version control systems (Git)\n\nPreferred Skills:\n• Experience with TypeScript\n• Knowledge of testing frameworks (Jest, Cypress, etc.)\n• Familiarity with CI/CD pipelines\n• Experience with design systems and component libraries",
                'location' => 'Remote / New York, NY',
                'type' => 'full-time',
                'department' => 'Engineering',
                'salary_min' => 90000,
                'salary_max' => 130000,
                'salary_currency' => 'USD',
                'is_active' => true,
                'application_deadline' => now()->addDays(30),
                'created_by' => $owner->id,
            ],
            [
                'title' => 'Digital Marketing Specialist',
                'slug' => 'digital-marketing-specialist',
                'description' => "Join our marketing team as a Digital Marketing Specialist and help drive our online presence and customer acquisition strategies.\n\nKey Responsibilities:\n• Develop and execute digital marketing campaigns across multiple channels\n• Manage social media accounts and create engaging content\n• Analyze campaign performance and optimize for better ROI\n• Collaborate with the design team to create marketing materials\n• Conduct market research and competitor analysis",
                'requirements' => "Required Skills:\n• 3+ years of experience in digital marketing\n• Proficiency in Google Analytics, Google Ads, and Facebook Ads\n• Experience with email marketing platforms (Mailchimp, Constant Contact, etc.)\n• Strong understanding of SEO and SEM principles\n• Excellent written and verbal communication skills\n• Creative thinking and problem-solving abilities\n\nPreferred Skills:\n• Experience with marketing automation tools\n• Knowledge of graphic design software (Photoshop, Canva, etc.)\n• Understanding of conversion rate optimization\n• Experience with A/B testing",
                'location' => 'San Francisco, CA',
                'type' => 'full-time',
                'department' => 'Marketing',
                'salary_min' => 60000,
                'salary_max' => 85000,
                'salary_currency' => 'USD',
                'is_active' => true,
                'application_deadline' => now()->addDays(45),
                'created_by' => $owner->id,
            ],
            [
                'title' => 'UX/UI Designer Intern',
                'slug' => 'ux-ui-designer-intern',
                'description' => "We're offering an exciting internship opportunity for aspiring UX/UI designers to gain hands-on experience in a fast-paced environment.\n\nWhat You'll Do:\n• Assist in creating user-centered design solutions\n• Participate in user research and usability testing\n• Create wireframes, prototypes, and high-fidelity designs\n• Collaborate with developers to ensure design implementation\n• Learn from experienced designers and contribute to real projects",
                'requirements' => "Required:\n• Currently pursuing a degree in Design, HCI, or related field\n• Basic knowledge of design principles and user experience\n• Familiarity with design tools (Figma, Sketch, Adobe Creative Suite)\n• Strong portfolio showcasing design projects\n• Excellent communication and collaboration skills\n• Eagerness to learn and take on new challenges\n\nPreferred:\n• Previous internship or project experience in UX/UI design\n• Understanding of web technologies (HTML, CSS)\n• Experience with prototyping tools\n• Knowledge of accessibility principles",
                'location' => 'Remote',
                'type' => 'internship',
                'department' => 'Design',
                'salary_min' => 20,
                'salary_max' => 25,
                'salary_currency' => 'USD',
                'is_active' => true,
                'application_deadline' => now()->addDays(60),
                'created_by' => $owner->id,
            ],
        ];

        foreach ($jobs as $jobData) {
            Job::updateOrCreate(
                ['slug' => $jobData['slug']],
                $jobData
            );
        }

        echo "Sample jobs created successfully!\n";
        echo "Created " . count($jobs) . " job postings\n";
    }
}
