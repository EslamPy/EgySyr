<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="icon" href="{{ asset('images/icon.webp') }}" type="image/webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EgySyr - Leading Technology Solutions</title>
    <meta charset="utf8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:image" content="https://www.egysyr.net/img/logo.webp" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta name="description" content="EgySyr is a leading technology company offering innovative website development, e-commerce solutions, and comprehensive management systems. We provide cutting-edge tech solutions to help your business thrive in the digital age.">
    <meta name="keywords" content="website development, e-commerce solutions, management systems, technology company, tech solutions, website design, web development, software development, business management, system programming, website creation, digital transformation">
    <meta name="author" content="EgySyr">
    <meta name="robots" content="index, follow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,1,0">  
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/splide.min.css', 'resources/css/style.css', 'resources/js/splide.min.js', 'resources/js/all.min.js', 'resources/js/jquery-3.6.1.min.js', 'resources/js/index.js'])
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>
    @include('Layouts.Navbar')

    <!-- Hero Section -->
    <section class="Home">
        <div class="Home_div">
            <div data-aos="fade-right">
                <h1>Transform Your Business with Cutting-Edge Technology Solutions</h1>
                <p>We specialize in creating innovative digital solutions that drive growth and efficiency. From custom websites to comprehensive e-commerce platforms, we help businesses thrive in the digital landscape.</p>
                <a href="{{ route('contact') }}" class="btn_Services">
                    Start Your Project
                    <div></div>
                </a>
            </div>
            <div data-aos="fade-left">
                <img src="{{ asset('images/Scene.webp') }}" alt="Technology Solutions" style="width: 100%; max-width: 500px; border-radius: 20px;">
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="container">
        <div class="conters">
            <div class="conter" data-aos="fade-up" data-aos-delay="100">
                <h1>150+</h1>
                <p>Projects Completed</p>
            </div>
            <div class="conter" data-aos="fade-up" data-aos-delay="200">
                <h1>50+</h1>
                <p>Happy Clients</p>
            </div>
            <div class="conter" data-aos="fade-up" data-aos-delay="300">
                <h1>5+</h1>
                <p>Years Experience</p>
            </div>
            <div class="conter" data-aos="fade-up" data-aos-delay="400">
                <h1>24/7</h1>
                <p>Support Available</p>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="Choose_Us">
        <div class="container">
            <div class="Choose_box_h" data-aos="fade-up">
                <h2>Our Comprehensive Services</h2>
                <p>We offer a full spectrum of technology solutions designed to meet your business needs and drive digital transformation.</p>
            </div>
            
            <div class="Choose_flex">
                <div class="Choose_box" data-aos="fade-up" data-aos-delay="100">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">🌐</div>
                    <h3>Website Development</h3>
                    <p>Custom websites built with modern technologies, responsive design, and optimized for performance and user experience.</p>
                </div>
                
                <div class="Choose_box" data-aos="fade-up" data-aos-delay="200">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">🛒</div>
                    <h3>E-commerce Solutions</h3>
                    <p>Complete online store solutions with secure payment processing, inventory management, and customer analytics.</p>
                </div>
                
                <div class="Choose_box" data-aos="fade-up" data-aos-delay="300">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">⚙️</div>
                    <h3>Management Systems</h3>
                    <p>Custom business management systems that streamline operations, improve efficiency, and provide valuable insights.</p>
                </div>
                
                <div class="Choose_box" data-aos="fade-up" data-aos-delay="400">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">🎨</div>
                    <h3>Graphic Design</h3>
                    <p>Professional graphic design services including logos, branding materials, and marketing collateral.</p>
                </div>
                
                <div class="Choose_box" data-aos="fade-up" data-aos-delay="500">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">📈</div>
                    <h3>Digital Marketing</h3>
                    <p>Comprehensive digital marketing strategies to increase your online presence and drive business growth.</p>
                </div>
                
                <div class="Choose_box" data-aos="fade-up" data-aos-delay="600">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">🛡️</div>
                    <h3>Security Solutions</h3>
                    <p>Advanced security systems and protection services to safeguard your digital assets and customer data.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Projects Section -->
    <section class="Projects">
        <div class="container">
            <div class="Choose_box_h" data-aos="fade-up">
                <h2>Featured Projects</h2>
                <p>Explore some of our recent work that demonstrates our expertise and commitment to delivering exceptional results.</p>
            </div>
            
            <div class="projects-container">
                <div class="project-card" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('images/project.webp') }}" alt="E-commerce Platform">
                    <div class="project-content">
                        <h3>E-commerce Platform</h3>
                        <p>A comprehensive online store with advanced features including inventory management, payment processing, and customer analytics. Built with modern technologies for optimal performance and user experience.</p>
                        <a href="{{ route('contact') }}" class="btn_Services" style="margin-top: 1rem;">View Details</a>
                    </div>
                </div>
                
                <div class="project-card" data-aos="fade-up" data-aos-delay="200">
                    <img src="{{ asset('images/ezz (2).webp') }}" alt="Business Management System">
                    <div class="project-content">
                        <h3>Business Management System</h3>
                        <p>Custom management system designed to streamline business operations, improve efficiency, and provide real-time insights into business performance.</p>
                        <a href="{{ route('contact') }}" class="btn_Services" style="margin-top: 1rem;">View Details</a>
                    </div>
                </div>
                
                <div class="project-card" data-aos="fade-up" data-aos-delay="300">
                    <img src="{{ asset('images/naiem.webp') }}" alt="Corporate Website">
                    <div class="project-content">
                        <h3>Corporate Website</h3>
                        <p>Modern, responsive corporate website with professional design, optimized for search engines, and built for maximum user engagement and conversion.</p>
                        <a href="{{ route('contact') }}" class="btn_Services" style="margin-top: 1rem;">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="Choose_Us">
        <div class="container">
            <div class="Choose_box_h" data-aos="fade-up">
                <h2>Why Choose EgySyr?</h2>
                <p>We combine technical expertise with creative innovation to deliver solutions that exceed expectations.</p>
            </div>
            
            <div class="Choose_flex">
                <div class="Choose_box" data-aos="fade-up" data-aos-delay="100">
                    <h3>Expert Team</h3>
                    <p>Our experienced developers and designers work together to create solutions that are both beautiful and functional.</p>
                </div>
                
                <div class="Choose_box" data-aos="fade-up" data-aos-delay="200">
                    <h3>Custom Solutions</h3>
                    <p>Every project is tailored to your specific needs, ensuring you get exactly what your business requires.</p>
                </div>
                
                <div class="Choose_box" data-aos="fade-up" data-aos-delay="300">
                    <h3>Ongoing Support</h3>
                    <p>We provide continuous support and maintenance to ensure your digital solutions remain up-to-date and secure.</p>
                </div>
                
                <div class="Choose_box" data-aos="fade-up" data-aos-delay="400">
                    <h3>Modern Technologies</h3>
                    <p>We use the latest technologies and best practices to ensure your solutions are fast, secure, and scalable.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section style="padding: 6rem 0; text-align: center; background: rgba(255, 255, 255, 0.02);">
        <div class="container">
            <div data-aos="fade-up">
                <h2 style="font-size: clamp(2rem, 4vw, 3rem); margin-bottom: 1rem; background: linear-gradient(45deg, #ffffff, #667eea); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Ready to Transform Your Business?</h2>
                <p style="font-size: 1.1rem; color: rgba(255, 255, 255, 0.7); margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;">Let's discuss how we can help you achieve your digital goals and take your business to the next level.</p>
                <a href="{{ route('contact') }}" class="btn_Services">
                    Get Started Today
                    <div></div>
                </a>
            </div>
        </div>
    </section>

    @include('Layouts.Footer')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });
    </script>
</body>
</html>