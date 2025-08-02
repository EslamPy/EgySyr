<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('images/icon.webp') }}" type="image/webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EgySyr</title>
    <meta charset="utf8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:image" content="https://www.egysyr.net/img/logo.webp" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta name="description" content="شركة تكنولوجيا تقدم خدمات برمجة مواقع، تطوير متاجر إلكترونية، وأنظمة إدارية متكاملة. نوفر حلول تقنية مبتكرة تناسب احتياجاتك وتدعم نمو أعمالك.">
    <meta name="description" content="A technology company offering website development, e-commerce solutions, and comprehensive management systems. We provide innovative tech solutions tailored to your needs to support your business growth.">
    <meta name="keywords" content="برمجة مواقع, تطوير متاجر إلكترونية, أنظمة إدارية, شركة تكنولوجيا, حلول تقنية, تصميم مواقع, برمجة ويب, تطوير برمجيات, إدارة أعمال, برمجة أنظمة, تطوير مواقع, website development, e-commerce solutions, management systems, technology company, tech solutions, website design, web development, software development, business management, system programming, website creation">
    <meta name="author" content="EgySyr">
    <meta name="robots" content="index, follow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,1,0">  
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/splide.min.css', 'resources/css/style.css', 'resources/js/splide.min.js', 'resources/js/all.min.js', 'resources/js/jquery-3.6.1.min.js', 'resources/js/index.js'])
        @else
            <style>
            </style>
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .review {
            padding: 20px;
            box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.2);
            text-align: center;
            width: 55%;
            margin: auto;
            cursor: grab;
            background-color: rgba(27, 0, 21, 1);
            border: solid 3px #910389;
            border-radius: 17px;
        }

        .review img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .splide__slide {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 50px;
        }

        .review {
            height: 100%; /* يأخذ الارتفاع بالكامل */
            padding: 20px;
            box-sizing: border-box; /* يمنع تغيير الأبعاد بسبب الـ padding */
            border-radius: 10px;
            text-align: center;
            overflow: hidden; /* يمنع التمدد */
        }


        .box_h_2{
            display: flex; 
            align-items: center;
        }

        @media (min-width: 320px) and (max-width: 850px) {
            
            .contact-form{
                margin: auto;
                max-width: 70%;
            }
            .services-box{
                max-width: 70%;
            }
        }
        @media (min-width: 320px) and (max-width: 1000px) {
            
            .review{
                width: 80%;
            }
        }
        @media (min-width: 320px) and (max-width: 450px) {
            .review{
                width: 90%;
            }
            .box_h_2{
                flex-direction: column;
            }
        }

        .message{
        padding: 100px 0;
        }

        .Connect_box{
        display: flex;
            justify-content: flex-end;
        }

        .contact-form {
            background: rgba(0, 0, 0, 0.5);
            border: 2px solid #f0f;
            border-radius: 15px;
            padding: 30px;
            width: 400px;
            box-shadow: 0 0 10px #f0f;
            color: #fff;
            backdrop-filter: blur(10px); /* هنا البلور */
            -webkit-backdrop-filter: blur(10px); /* دعم سفاري */
            /* margin: auto; */
            /* transform: translateY(-100px); */
            margin-right: 40px;
            position: relative;
            top: -100px;
        }
        .contact-form h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #f0f;
        }
        .form-group {
        margin-bottom: 15px;
        }
        .form-group label {
        display: block;
        margin-bottom: 5px;
        background: linear-gradient(308deg, rgba(242, 119, 244, 1), rgba(145, 3, 137, 1));
            -webkit-background-clip: text;
            background-clip: text;
            color: #00000000;
            font-family: Al Qabas;
        font-size: 14px;
        }
        .form-group input,
        .form-group textarea {
        width: calc(100% - 20px);
        padding: 10px;
        background: transparent;
        border: 1px solid #f0f;
        border-radius: 8px;
        color: #fff;
        font-size: 14px;
        resize: none;
        outline: none;
        background-color: rgba(27, 0, 21, 1);
        }
        .form-group input::placeholder,
        .form-group textarea::placeholder {
        color: #aaa;
        }
        .button-container {
        text-align: center;
        margin-top: 20px;
        }
        .button-container button {
        background: linear-gradient(135deg, rgba(242, 119, 244, 1), rgba(145, 3, 137, 1));
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        transition: background 0.3s;
        }
        .button-container button:hover {
        background: linear-gradient(135deg, rgba(145, 3, 137, 1), rgba(242, 119, 244, 1));
        }
        /* ترتيب الاسم ورقم الموبايل جنب بعض */
        .row {
        display: flex;
        gap: 50px;
        }
        .row .form-group {
        flex: 1;
        }


        .services-box {
        background: rgb(27 0 21);
        border: 2px solid #ff00ff;
        border-radius: 20px;
        padding: 30px 40px;
        max-width: 600px;
        box-shadow: 0 0 20px #ff00ff88;
        margin: auto;
        }

        .services-box h1 {
        color: #fff;
        font-size: 24px;
        margin-bottom: 10px;
        }

        .services-box p {
        color: #ddd;
        font-size: 14px;
        margin-bottom: 25px;
        line-height: 1.6;
        }

        .services-box ol {
        list-style: decimal;
        padding-left: 20px;
        }

        .services-box ol li {
        margin-bottom: 15px;
        }

        .services-box ol li strong {
        color: #ff00ff;
        display: block;
        margin-bottom: 5px;
        }
        li::marker{
        color: #ff00ff;
        }

        .services-box h1{
        font-size: clamp(23px, 8vw, 42px);
            /* padding-top: 40px; */
            /* padding-left: 40px; */
            -webkit-text-fill-color: #ffffff;
            -webkit-text-stroke: 1.5px #910389;
        }

        .img_Home{
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @media (min-width: 320px) and (max-width: 950px) {
            .img_Home{
                display: none;
            }
        }
    </style>
    
    
</head>
<body>
    <!-- <div class="bc"></div> -->

    <div class="cursor" id="cursor"></div>

    <div class="background-video">
        <video id="myVideo" autoplay muted >
          <source src="{{ asset('images/bc.mp4') }}" type="video/mp4">
          المتصفح الخاص بك لا يدعم عنصر الفيديو.
        </video>
      </div>
      
    @include('Layouts.Navbar')
    <!-- ----------------nav------------------ -->

    <section style="border-bottom: solid 3px #910389;background-color: #1B0015;padding-bottom: 55px;margin-top: 45px;margin-bottom: 46px;" class="Home">
        <div data-aos="fade-right">
            <h1>
                Application Programming
            </h1>
            <!-- <p><span style="background: linear-gradient(308deg, rgba(145, 3, 137, 1), rgba(242, 119, 244, 1));background-clip: text;color: #00000000;">Need Assistance? Contact EgySyr ! </span>💡</p> -->
            <p id="about">
                EgySyr offers professional mobile app development services, tailored to meet business needs efficiently. We develop custom mobile applications using advanced technologies to ensure high security, smooth performance, and an intuitive user experience. Our solutions are fully scalable and compatible with both iOS and Android, with continuous technical support to guarantee seamless and stable operation.
            </p>
            
        </div>
        <div class="img_Home" data-aos="fade-left">
            <svg xmlns="http://www.w3.org/2000/svg" width="148" height="205" viewBox="0 0 148 205" fill="none">
                <path d="M7 64.3C7.09573 39.0498 8.03394 25.5366 16.8032 16.7888C26.6161 7 42.4123 7 74.0048 7C105.597 7 121.394 7 131.206 16.7888C139.976 25.5366 140.904 39.0403 141 64.3M7 140.7C7.09573 165.95 8.03394 179.463 16.8032 188.211C26.6161 198 42.4123 198 74.0048 198C105.597 198 121.394 198 131.206 188.211C139.976 179.463 140.904 165.96 141 140.7M64.4409 169.35H83.5878M112.308 83.4L124.055 93.4944C128.985 97.7441 131.455 99.8642 131.455 102.5C131.455 105.136 128.985 107.256 124.055 111.506L112.308 121.6M35.7204 83.4L23.9738 93.4944C19.0434 97.7441 16.5735 99.8642 16.5735 102.5C16.5735 105.136 19.0434 107.256 23.9738 111.506L35.7204 121.6M83.5878 73.85L64.4409 131.15" stroke="url(#paint0_linear_739_467)" stroke-width="13" stroke-linecap="round" stroke-linejoin="round"/>
                <defs>
                <linearGradient id="paint0_linear_739_467" x1="7" y1="7" x2="140.587" y2="198.308" gradientUnits="userSpaceOnUse">
                <stop stop-color="#F277F4"/>
                <stop offset="1" stop-color="#910389"/>
                </linearGradient>
                </defs>
            </svg>
        </div>
    </section>
    <div class="Connect_box">
        <form class="contact-form" action="{{ route('contact.store') }}" method="POST" data-aos="zoom-in-up">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: green;width: fit-content;padding: 10px;border-radius: 10px;margin: auto;">
                    The message has been sent and you will receive a response as soon as possible via WhatsApp or email.
                    
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="background-color: green;width: fit-content;padding: 10px;border-radius: 10px;margin: auto;">
                    {{ session('error') }}
                    
                </div>
            @endif
            @csrf
            <div class="row">
                <div class="form-group">
                    <label class="text_h" for="fullName">Full Name</label>
                    <input type="text" name="full_name" id="fullName" required>
                </div>
                <div class="form-group">
                    <label for="phoneNumber">Phone Number</label>
                    <input type="text" name="phone" id="phoneNumber" required>
                </div>
            </div>
        
            <div class="form-group">
                <label for="email">E-Mail</label>
                <input type="email" name="email" id="email" required>
            </div>
        
            <div class="form-group">
                <label for="message">Message Text</label>
                <textarea name="message" id="message" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <input value="Application" type="hidden" name="service_type" id="service_type">
            </div>

            <div class="button-container">
                <button type="submit">Send Message</button>
            </div>
        </form>
    </div>
    <section class="container">
        <!-- ---------------------------- -->
        <section class="all">
        
        
            <section class="message">
                <div class="services-box" data-aos="zoom-in-up">
                    <h1>Grow your business digitally<br> with EgySyr</h1>
                    <p>With digital transformation, mobile app development has become essential for business success and expanding reach. At EgySyr, we provide professional app development solutions for iOS and Android, ensuring smooth performance and an exceptional user experience that reflects your brand identity.</p>
                    <div style="width: 100%;" class="f_line"></div>
                    <ol>
                      <li><strong>Idea Analysis & Goal Setting</strong>
                        We analyze your vision and design an intuitive user experience.
                      </li>
                      <li><strong>Planning & User Experience (UI/UX) Design</strong>
                        We design a professional and intuitive interface that enhances user engagement and ensures seamless navigation.
                      </li>
                      <li><strong> Development with Cutting-Edge Technologies</strong>
                        sing the latest technologies, we build high-performance Android & iOS apps.
                      </li>
                      <li><strong>Testing & Quality Assurance</strong>
                        We ensure stability, speed, and seamless functionality.
                      </li>
                      <li><strong>Professional Launch & Deployment</strong>
                        Your app goes live on Google Play & App Store with full compliance.
                      </li>
                      <li><strong>Ongoing Support & Updates</strong>
                        We provide ongoing maintenance, updates, and support to optimize performance and add new features.
                      </li>
                      
                    </ol>
                  </div>
                
            </section>

            @php
                $hasWebPublishedReview = $reviews->contains(function ($review) {
                    return $review->status === 'publication' && $review->service_type === 'service_Application';
                });
            @endphp

            @if($hasWebPublishedReview)
                <section class="splide" aria-label="Splide Basic HTML Example">
                    <div data-aos="zoom-in-down" class="Choose_box_h">
                        <h1>Customer Reviews</h1>
                    </div>
                    <div data-aos="fade-right" class="splide__track" style="padding-left: 0px;padding-right: 0px;margin-top: 50px;margin-bottom: 50px;">
                        <ul class="splide__list">
                            @foreach($reviews as $review)
                                @if($review->status === 'publication' && $review->service_type === 'service_Application')
                                    <li class="splide__slide">
                                        <div class="review">
                                            <div class="box_h_2">
                                                <div class="box_img" style="border: solid 3px #910389;width: 80px;height: 80px;border-radius: 50%;">
                                                    <img src="{{asset($review->profile_image)}}" alt="Customer">
                                                </div>
                                                <h3 style="font-size: 30px; margin-left: 10px;" class="text_h">{{ $review->full_name }}</h3>
                                            </div>
                                            <div>
                                                <p>
                                                    {{ $review->comment }}
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </section>
            @endif

            
        
        </section>
    
    
        <!-- ---------------------------- -->
    </section>






    <!-- ----------footer---------- -->
    @include('layouts.footer')

    <script src="../splide.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
         AOS.init({
            duration: 1000, // مدة الحركة 1 ثانية
            // once: true, // الحركة تشتغل مرة واحدة بس
        });
        document.addEventListener("DOMContentLoaded", function() {
            let carousel = document.querySelector(".carousel");
            let cards = document.querySelectorAll(".card");
    
            cards.forEach(card => {
                card.addEventListener("mouseenter", () => {
                    carousel.style.animationPlayState = "paused";
                });
                card.addEventListener("mouseleave", () => {
                    carousel.style.animationPlayState = "running";
                });
            });
        });

        var splide = new Splide( '.splide', {
            type   : 'loop',
            perPage: 2,
            perMove: 1,
            breakpoints: {
                768: { // لما يكون عرض الشاشة 768px أو أقل (مقاس التابلت والموبايل)
                perPage: 1, // يعرض عنصر واحد فقط
                }
            }
        } );

        splide.mount();
    </script>
    
    
    <script src="../js/all.min.js"></script>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <script src="../js/index.js"></script>
</body>
</html>