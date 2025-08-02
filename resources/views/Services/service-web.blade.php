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
                Website Programming
            </h1>
            <!-- <p><span style="background: linear-gradient(308deg, rgba(145, 3, 137, 1), rgba(242, 119, 244, 1));background-clip: text;color: #00000000;">Need Assistance? Contact EgySyr ! </span>💡</p> -->
            <p id="about">
                EgySyr offers professional website programming and design services, including custom website development and WordPress website design. We use the latest technologies to ensure fast performance, high security, and an outstanding user experience. Our modern designs are fully responsive, with continuous technical support to ensure efficient and stable website operation.
            </p>
            
        </div>
        <div class="img_Home" data-aos="fade-left">
            <svg xmlns="http://www.w3.org/2000/svg" width="234" height="234" viewBox="0 0 234 234" fill="none">
                <path d="M139.6 4H94.4C57.336 4 38.8153 4 25.6847 13.1982C20.8262 16.6003 16.6003 20.8262 13.1982 25.6847C4 38.804 4 57.336 4 94.4C4 131.464 4 149.985 13.1982 163.115C16.6003 167.974 20.8262 172.2 25.6847 175.602C38.804 184.8 57.336 184.8 94.4 184.8H139.6C176.664 184.8 195.185 184.8 208.315 175.602C213.174 172.2 217.4 167.974 220.802 163.115C230 149.996 230 131.464 230 94.4C230 57.336 230 38.8153 220.802 25.6847C217.4 20.8262 213.174 16.6003 208.315 13.1982C195.196 4 176.664 4 139.6 4Z" stroke="url(#paint0_linear_736_632)" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M162.2 71.8L176.065 83.7441C181.885 88.7726 184.8 91.2812 184.8 94.4C184.8 97.5188 181.885 100.027 176.065 105.056L162.2 117M71.8002 71.8L57.9351 83.7441C52.1156 88.7726 49.2002 91.2812 49.2002 94.4C49.2002 97.5188 52.1156 100.027 57.9351 105.056L71.8002 117M128.3 60.5L105.7 128.3M147.013 230L142.267 225.265C137.063 220.063 133.629 213.355 132.453 206.091C131.277 198.828 132.417 191.379 135.713 184.8M83.1002 230L87.8462 225.265C93.0501 220.063 96.4838 213.355 97.6602 206.091C98.8366 198.828 97.696 191.379 94.4002 184.8M60.5002 230H173.5" stroke="url(#paint1_linear_736_632)" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"></path>
                <defs>
                <linearGradient id="paint0_linear_736_632" x1="117" y1="4" x2="117" y2="184.8" gradientUnits="userSpaceOnUse">
                <stop stop-color="#910389"></stop>
                <stop offset="1" stop-color="#F277F4"></stop>
                </linearGradient>
                <linearGradient id="paint1_linear_736_632" x1="117" y1="60.5" x2="117" y2="230" gradientUnits="userSpaceOnUse">
                <stop stop-color="#910389"></stop>
                <stop offset="1" stop-color="#F277F4"></stop>
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
                <input value="web" type="hidden" name="service_type" id="service_type">
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
                    <p>In the digital transformation era, a professional website is essential for any business’s success. At EgySyr, we provide integrated website development and design solutions that reflect your brand identity and ensure a seamless user experience, whether it’s an introductory website, an online store, or a service platform.</p>
                    <div style="width: 100%;" class="f_line"></div>
                    <ol>
                      <li><strong>Consultation & Needs Assessment</strong>
                        We understand your business and goals to design a website that meets your needs precisely.
                      </li>
                      <li><strong>Planning & Site Structure</strong>
                        We define sections to ensure easy navigation and an excellent user experience.
                      </li>
                      <li><strong>Initial design (UI/UX Design)</strong>
                        We create an attractive design that reflects your brand identity and ensures a seamless experience.
                      </li>
                      <li><strong>Development & Programming</strong>
                        We build the website professionally, ensuring high performance, security, and full responsiveness.
                      </li>
                      <li><strong>Content & Product Addition</strong>
                        We help you prepare text content, images and videos, and add products or services in an organized and attractive way.
                      </li>
                      <li><strong>Testing & Quality Assurance</strong>
                        We conduct thorough testing to ensure error-free functionality and fast loading speed.
                      </li>
                      <li><strong>Launch & Delivery</strong>
                        Once ready, we officially launch the website, making it accessible to your customers.
                      </li>
                      <li><strong>Support & Maintenance</strong>
                        We provide ongoing technical support and updates to keep your website secure and up to date.
                      </li>
                    </ol>
                  </div>
                
            </section>

            @php
                $hasWebPublishedReview = $reviews->contains(function ($review) {
                    return $review->status === 'publication' && $review->service_type === 'service_web';
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
                                @if($review->status === 'publication' && $review->service_type === 'service_web')
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