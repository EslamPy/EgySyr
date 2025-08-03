<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Testimonial;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Projects
        $this->seedProjects();
        
        // Seed Testimonials
        $this->seedTestimonials();
    }

    private function seedProjects(): void
    {
        $projects = [
            [
                'title' => 'AI-Powered E-commerce Platform',
                'slug' => 'ai-ecommerce-platform',
                'description' => 'A next-generation e-commerce platform with AI recommendations, real-time inventory management, and seamless checkout experience.',
                'long_description' => 'This comprehensive e-commerce solution leverages artificial intelligence to provide personalized shopping experiences, intelligent product recommendations, and automated inventory management. Built with modern technologies for maximum performance and scalability.',
                'category' => 'Web Application',
                'technologies' => ['React', 'Node.js', 'AI/ML', 'PostgreSQL', 'AWS', 'Redis', 'Elasticsearch'],
                'image_url' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&h=600&fit=crop',
                'live_url' => 'https://demo.example.com',
                'github_url' => 'https://github.com/example/ai-ecommerce',
                'is_featured' => true,
                'completion_date' => '2023-12-15',
                'client_name' => 'TechCorp Solutions',
                'project_value' => 45000.00,
                'duration_months' => 6,
                'features' => [
                    'AI-powered product recommendations',
                    'Real-time inventory tracking',
                    'Advanced search with filters',
                    'Multi-currency support',
                    'Admin analytics dashboard'
                ],
                'challenges' => [
                    'Implementing real-time AI recommendations',
                    'Handling high-traffic during sales events',
                    'Complex inventory management across multiple warehouses'
                ],
                'results' => [
                    '150% increase in conversion rate',
                    '40% reduction in cart abandonment',
                    '60% improvement in page load times'
                ]
            ],
            [
                'title' => 'Secure Mobile Banking App',
                'slug' => 'mobile-banking-app',
                'description' => 'Revolutionary mobile banking application with biometric authentication, real-time transactions, and advanced security features.',
                'long_description' => 'A state-of-the-art mobile banking solution that prioritizes security while delivering an exceptional user experience. Features include biometric authentication, real-time transaction processing, and comprehensive financial management tools.',
                'category' => 'Mobile App',
                'technologies' => ['React Native', 'Node.js', 'MongoDB', 'Blockchain', 'Firebase', 'Socket.io'],
                'image_url' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=800&h=600&fit=crop',
                'live_url' => 'https://app.example.com',
                'is_featured' => true,
                'completion_date' => '2023-11-20',
                'client_name' => 'SecureBank Financial',
                'project_value' => 65000.00,
                'duration_months' => 8,
                'features' => [
                    'Biometric authentication (Face ID, Touch ID)',
                    'Real-time transaction notifications',
                    'Budget tracking and analytics',
                    'Secure peer-to-peer transfers',
                    'Multi-language support'
                ],
                'challenges' => [
                    'Implementing bank-grade security standards',
                    'Real-time transaction processing',
                    'Cross-platform consistency'
                ],
                'results' => [
                    '95% user satisfaction rating',
                    '200% increase in mobile transactions',
                    'Zero security incidents since launch'
                ]
            ],
            [
                'title' => 'Cloud Infrastructure Dashboard',
                'slug' => 'cloud-dashboard',
                'description' => 'Comprehensive cloud management dashboard with real-time monitoring, automated scaling, and cost optimization.',
                'long_description' => 'An enterprise-grade cloud management platform that provides comprehensive monitoring, automated scaling, and cost optimization for cloud infrastructure. Built for DevOps teams managing complex multi-cloud environments.',
                'category' => 'Cloud Solution',
                'technologies' => ['Vue.js', 'Python', 'Docker', 'Kubernetes', 'AWS', 'Terraform', 'Grafana'],
                'image_url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=600&fit=crop',
                'live_url' => 'https://cloud.example.com',
                'is_featured' => true,
                'completion_date' => '2023-10-30',
                'client_name' => 'CloudTech Enterprises',
                'project_value' => 55000.00,
                'duration_months' => 7,
                'features' => [
                    'Real-time infrastructure monitoring',
                    'Automated scaling policies',
                    'Cost optimization recommendations',
                    'Multi-cloud support (AWS, Azure, GCP)',
                    'Custom alerting and notifications'
                ],
                'challenges' => [
                    'Handling massive amounts of telemetry data',
                    'Multi-cloud API integration',
                    'Real-time dashboard performance'
                ],
                'results' => [
                    '30% reduction in infrastructure costs',
                    '99.9% uptime improvement',
                    '80% faster incident response times'
                ]
            ]
        ];

        foreach ($projects as $projectData) {
            Project::create($projectData);
        }
    }

    private function seedTestimonials(): void
    {
        $testimonials = [
            [
                'client_name' => 'Sarah Johnson',
                'client_title' => 'CTO',
                'client_company' => 'TechCorp Solutions',
                'content' => 'EgySyr delivered an exceptional e-commerce platform that exceeded all our expectations. Their AI-powered recommendations have significantly increased our conversion rates. The team\'s expertise and professionalism made the entire process smooth.',
                'rating' => 5,
                'project_type' => 'E-commerce Platform',
                'project_value' => 45000.00,
                'project_completion_date' => '2023-12-15',
                'is_published' => true,
                'is_featured' => true,
                'display_order' => 1,
                'tags' => ['e-commerce', 'AI', 'web-development']
            ],
            [
                'client_name' => 'Michael Chen',
                'client_title' => 'Product Manager',
                'client_company' => 'SecureBank Financial',
                'content' => 'The mobile banking app developed by EgySyr is absolutely outstanding. The security features are top-notch, and our customers love the intuitive interface. It\'s been a game-changer for our digital banking strategy.',
                'rating' => 5,
                'project_type' => 'Mobile Banking App',
                'project_value' => 65000.00,
                'project_completion_date' => '2023-11-20',
                'is_published' => true,
                'is_featured' => true,
                'display_order' => 2,
                'tags' => ['mobile-app', 'fintech', 'security']
            ],
            [
                'client_name' => 'Emma Rodriguez',
                'client_title' => 'DevOps Lead',
                'client_company' => 'CloudTech Enterprises',
                'content' => 'EgySyr\'s cloud management dashboard has revolutionized how we monitor and manage our infrastructure. The cost optimization features alone have saved us thousands of dollars monthly. Highly recommended!',
                'rating' => 5,
                'project_type' => 'Cloud Dashboard',
                'project_value' => 55000.00,
                'project_completion_date' => '2023-10-30',
                'is_published' => true,
                'is_featured' => false,
                'display_order' => 3,
                'tags' => ['cloud', 'devops', 'monitoring']
            ],
            [
                'client_name' => 'David Kim',
                'client_title' => 'Startup Founder',
                'client_company' => 'InnovateLab',
                'content' => 'Working with EgySyr was one of the best decisions for our startup. They delivered a robust web application that perfectly matched our vision. The team was responsive, creative, and delivered on time.',
                'rating' => 5,
                'project_type' => 'Custom Web Application',
                'project_value' => 25000.00,
                'project_completion_date' => '2023-09-10',
                'is_published' => true,
                'is_featured' => false,
                'display_order' => 4,
                'tags' => ['startup', 'web-app', 'mvp']
            ],
            [
                'client_name' => 'Lisa Thompson',
                'client_title' => 'Marketing Director',
                'client_company' => 'BrandFlow Agency',
                'content' => 'The UI/UX design work done by EgySyr transformed our client\'s brand presence. The designs are not only beautiful but also highly functional. Our client saw a 200% increase in user engagement.',
                'rating' => 5,
                'project_type' => 'UI/UX Design',
                'project_value' => 15000.00,
                'project_completion_date' => '2023-08-25',
                'is_published' => true,
                'is_featured' => false,
                'display_order' => 5,
                'tags' => ['ui-ux', 'design', 'branding']
            ]
        ];

        foreach ($testimonials as $testimonialData) {
            Testimonial::create($testimonialData);
        }
    }
}