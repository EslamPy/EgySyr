<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get first user or create one
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Admin User',
                'email' => 'admin@egysyr.net',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }

        // Get technology category or create one
        $category = Category::where('name', 'Technology')->first();
        if (!$category) {
            $category = Category::create([
                'name' => 'Technology',
                'description' => 'Technology related articles and insights'
            ]);
        }

        $blogPosts = [
            [
                'title' => 'The Future of Web Development: Trends to Watch in 2024',
                'content' => '<p>Web development is evolving rapidly, with new technologies and methodologies emerging constantly. As we move through 2024, several key trends are shaping the future of how we build and interact with web applications.</p>

<h3>AI-Powered Development</h3>
<p>Artificial Intelligence is revolutionizing web development by automating code generation, improving user experiences through personalization, and enhancing accessibility features. Developers are increasingly using AI tools to streamline their workflows and create more intelligent applications.</p>

<h3>Progressive Web Apps (PWAs)</h3>
<p>PWAs continue to bridge the gap between web and mobile applications, offering native app-like experiences through web browsers. With improved offline capabilities and faster loading times, PWAs are becoming the preferred choice for many businesses.</p>

<h3>WebAssembly and Performance</h3>
<p>WebAssembly (WASM) is enabling near-native performance for web applications, allowing developers to run computationally intensive applications directly in browsers. This technology is particularly game-changing for graphics-heavy applications and real-time processing.</p>

<h3>Serverless Architecture</h3>
<p>The adoption of serverless computing continues to grow, allowing developers to focus on code rather than infrastructure management. This approach reduces costs and improves scalability for modern web applications.</p>',
                'excerpt' => 'Explore the latest trends and technologies shaping the future of web development, from AI integration to progressive web apps.',
                'tags' => ['web development', 'AI', 'PWA', 'WebAssembly', 'serverless'],
                'status' => 'published',
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Building Successful E-Commerce Platforms: Best Practices',
                'content' => '<p>Creating a successful e-commerce platform requires careful planning, attention to user experience, and implementation of proven best practices. Here are the key strategies that drive e-commerce success.</p>

<h3>User Experience Design</h3>
<p>The foundation of any successful e-commerce platform is exceptional user experience. This includes intuitive navigation, fast loading times, mobile responsiveness, and a streamlined checkout process. Every interaction should be designed to reduce friction and guide users toward completing their purchases.</p>

<h3>Performance Optimization</h3>
<p>Site speed directly impacts conversion rates. Implementing image optimization, content delivery networks (CDNs), and efficient caching strategies can significantly improve load times and user satisfaction.</p>

<h3>Security and Trust</h3>
<p>Building customer trust through robust security measures is crucial. This includes SSL certificates, secure payment gateways, data encryption, and compliance with regulations like GDPR and PCI DSS.</p>

<h3>Mobile-First Approach</h3>
<p>With mobile commerce continuing to grow, adopting a mobile-first design approach ensures your platform provides excellent experiences across all devices.</p>

<h3>Analytics and Optimization</h3>
<p>Implementing comprehensive analytics allows you to understand user behavior, identify bottlenecks, and continuously optimize the shopping experience for better conversions.</p>',
                'excerpt' => 'Learn the essential strategies and technologies needed to create high-converting e-commerce platforms that drive sales.',
                'tags' => ['e-commerce', 'user experience', 'performance', 'security', 'mobile'],
                'status' => 'published',
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Modern UI/UX Design Principles for Better User Experience',
                'content' => '<p>Great user interface and user experience design is more critical than ever in today\'s digital landscape. Understanding and applying modern design principles can significantly impact user engagement and business success.</p>

<h3>Minimalism and Clarity</h3>
<p>Clean, uncluttered designs with plenty of white space help users focus on what matters most. Every element should serve a purpose, and unnecessary complexity should be eliminated.</p>

<h3>Accessibility First</h3>
<p>Designing for accessibility ensures your product can be used by everyone, regardless of their abilities. This includes proper color contrast, keyboard navigation, screen reader compatibility, and clear visual hierarchies.</p>

<h3>Micro-Interactions</h3>
<p>Small animations and feedback mechanisms enhance user engagement and provide visual confirmation of actions. These subtle details can significantly improve the overall user experience.</p>

<h3>Dark Mode and Color Psychology</h3>
<p>Offering dark mode options and understanding color psychology helps create more comfortable viewing experiences and can influence user behavior and emotions.</p>

<h3>Responsive and Adaptive Design</h3>
<p>Ensuring consistent experiences across all devices and screen sizes is fundamental to modern web design. This goes beyond responsive layouts to include adaptive content and functionality.</p>

<h3>Performance-Driven Design</h3>
<p>Design decisions should always consider performance implications. Optimized images, efficient animations, and streamlined interfaces contribute to faster load times and better user satisfaction.</p>',
                'excerpt' => 'Discover the key principles of modern UI/UX design that create engaging and intuitive user experiences.',
                'tags' => ['UI/UX', 'design', 'accessibility', 'user experience', 'responsive design'],
                'status' => 'published',
                'published_at' => now()->subDays(15),
            ],
            [
                'title' => 'The Rise of Headless CMS and JAMstack Architecture',
                'content' => '<p>The traditional monolithic CMS approach is giving way to more flexible, scalable solutions. Headless CMS and JAMstack architecture are revolutionizing how we build and deploy modern web applications.</p>

<h3>What is Headless CMS?</h3>
<p>A headless CMS separates content management from content presentation, providing content through APIs. This approach offers greater flexibility in how and where content is displayed.</p>

<h3>Benefits of JAMstack</h3>
<p>JavaScript, APIs, and Markup (JAMstack) architecture provides better performance, security, and developer experience. Pre-built markup and serverless functions result in faster, more secure websites.</p>

<h3>Implementation Strategies</h3>
<p>Successful implementation requires careful planning of content architecture, API design, and deployment workflows. Popular tools include Gatsby, Next.js, Nuxt.js, and various headless CMS solutions.</p>

<h3>SEO Considerations</h3>
<p>While JAMstack sites can achieve excellent SEO performance, proper implementation of server-side rendering or static site generation is crucial for search engine visibility.</p>',
                'excerpt' => 'Explore how headless CMS and JAMstack architecture are changing the way we build modern web applications.',
                'tags' => ['headless CMS', 'JAMstack', 'API', 'performance', 'architecture'],
                'status' => 'published',
                'published_at' => now()->subDays(20),
            ],
            [
                'title' => 'Cybersecurity Best Practices for Modern Web Applications',
                'content' => '<p>As cyber threats continue to evolve, implementing robust security measures in web applications has become more critical than ever. Here are essential security practices every developer should follow.</p>

<h3>Authentication and Authorization</h3>
<p>Implement strong authentication mechanisms including multi-factor authentication, secure password policies, and proper session management. Use proven authorization frameworks and never rely on client-side security alone.</p>

<h3>Data Protection</h3>
<p>Encrypt sensitive data both in transit and at rest. Use HTTPS everywhere, implement proper database encryption, and follow data minimization principles.</p>

<h3>Input Validation and Sanitization</h3>
<p>Always validate and sanitize user inputs to prevent SQL injection, XSS attacks, and other injection vulnerabilities. Never trust user input, regardless of its source.</p>

<h3>Regular Security Audits</h3>
<p>Conduct regular security assessments, penetration testing, and code reviews. Stay updated with security patches and monitor for vulnerabilities in dependencies.</p>

<h3>Security Headers</h3>
<p>Implement security headers like Content Security Policy (CSP), X-Frame-Options, and HSTS to protect against common attacks and improve overall security posture.</p>',
                'excerpt' => 'Essential cybersecurity practices and strategies to protect modern web applications from evolving threats.',
                'tags' => ['cybersecurity', 'web security', 'authentication', 'data protection', 'security headers'],
                'status' => 'published',
                'published_at' => now()->subDays(25),
            ],
        ];

        foreach ($blogPosts as $post) {
            Blog::create([
                'title' => $post['title'],
                'slug' => Str::slug($post['title']),
                'content' => $post['content'],
                'excerpt' => $post['excerpt'],
                'tags' => $post['tags'],
                'status' => $post['status'],
                'published_at' => $post['published_at'],
                'author_id' => $user->id,
                'category_id' => $category->id,
                'views_count' => rand(50, 500),
                'likes_count' => rand(5, 50),
                'meta_title' => $post['title'],
                'meta_description' => $post['excerpt'],
            ]);
        }
    }
}