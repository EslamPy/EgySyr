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
                Administrative systems programming
            </h1>
            <!-- <p><span style="background: linear-gradient(308deg, rgba(145, 3, 137, 1), rgba(242, 119, 244, 1));background-clip: text;color: #00000000;">Need Assistance? Contact EgySyr ! </span>💡</p> -->
            <p id="about">
                EgySyr offers professional administrative system programming services, tailored to meet business needs efficiently. We develop custom administrative systems with advanced technologies to ensure high security, smooth performance, and an intuitive user experience. Our solutions are fully scalable and responsive, with continuous technical support to guarantee seamless and stable operation.
            </p>
            
        </div>
        <div class="img_Home" data-aos="fade-left">
            <svg xmlns="http://www.w3.org/2000/svg" width="218" height="194" viewBox="0 0 218 194" fill="none">
                <path d="M216.936 138.136L203.736 143.316C204.588 147.514 204.588 151.645 203.736 155.708L216.936 160.888L211.72 172.975L198.521 167.693C197.314 169.386 195.966 170.977 194.476 172.467C192.985 173.957 191.282 175.277 189.366 176.428L194.901 189.023L182.234 194L176.806 181.405C174.677 181.812 172.512 182.015 170.312 182.015C168.113 182.015 165.948 181.812 163.819 181.405L158.391 194L145.724 189.023L151.259 176.428C147.64 174.058 144.588 171.147 142.104 167.693L128.905 172.975L123.689 160.888L136.889 155.708C136.037 151.577 136.037 147.447 136.889 143.316L123.689 138.136L128.905 126.049L142.104 131.331C144.588 127.877 147.64 124.966 151.259 122.596L145.724 110.001L158.391 105.024L163.819 117.619C168.219 116.806 172.548 116.806 176.806 117.619L182.234 105.024L194.901 110.001L189.366 122.596C191.14 123.747 192.808 125.034 194.369 126.455C195.93 127.877 197.314 129.503 198.521 131.331L211.72 126.049L216.936 138.136ZM178.083 167.49C180.709 166.474 182.944 165.052 184.789 163.224C186.634 161.396 188.089 159.297 189.153 156.927C190.218 154.557 190.715 152.119 190.644 149.614C190.573 147.108 190.076 144.603 189.153 142.097C188.16 139.66 186.705 137.527 184.789 135.698C182.873 133.87 180.638 132.482 178.083 131.534C175.599 130.518 173.009 130.01 170.312 130.01C167.545 130.01 164.955 130.518 162.542 131.534C159.987 132.482 157.752 133.87 155.836 135.698C153.92 137.527 152.465 139.66 151.472 142.097C149.272 147.04 149.272 151.984 151.472 156.927C152.465 159.364 153.92 161.497 155.836 163.326C157.752 165.154 159.987 166.542 162.542 167.49C167.722 169.589 172.903 169.589 178.083 167.49ZM218 0V91.0073H204.375V52.0042H13.625V156.013H109V169.014H0V0H218ZM204.375 39.0031V13.001H13.625V39.0031H204.375ZM95.375 130.01V115.791C93.1751 115.046 91.0462 113.895 88.9883 112.337L76.1084 119.346L69.2959 108.173L82.0693 101.063C81.8564 99.9794 81.75 98.7944 81.75 97.5079C81.75 96.289 81.8564 95.104 82.0693 93.9529L69.2959 86.8429L76.1084 75.6702L88.9883 82.6785C91.0462 81.1211 93.1751 79.97 95.375 79.2251V65.0052H109V79.2251C110.206 79.6314 111.306 80.1054 112.3 80.6471C113.293 81.1888 114.322 81.866 115.387 82.6785L128.267 75.6702L135.079 86.8429L122.306 93.9529C122.519 95.104 122.625 96.289 122.625 97.5079C122.625 98.7944 122.519 99.9794 122.306 101.063L135.079 108.173L128.267 119.346L115.387 112.337C114.393 113.082 113.4 113.725 112.406 114.267C111.413 114.809 110.277 115.317 109 115.791V130.01H95.375ZM91.9688 97.5079C91.9688 100.216 92.9622 102.519 94.9492 104.415C96.9362 106.311 99.349 107.259 102.188 107.259C105.026 107.259 107.439 106.311 109.426 104.415C111.413 102.519 112.406 100.216 112.406 97.5079C112.406 94.7993 111.413 92.497 109.426 90.601C107.439 88.7051 105.026 87.7571 102.188 87.7571C99.349 87.7571 96.9362 88.7051 94.9492 90.601C92.9622 92.497 91.9688 94.7993 91.9688 97.5079Z" fill="url(#paint0_linear_739_294)"/>
                <defs>
                <linearGradient id="paint0_linear_739_294" x1="109" y1="0" x2="109" y2="194" gradientUnits="userSpaceOnUse">
                <stop stop-color="#910389"/>
                <stop offset="0.516667" stop-color="#F277F4"/>
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
                <input value="system" type="hidden" name="service_type" id="service_type">
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
                    <p>With digital transformation, a robust administrative system is essential for business efficiency and growth. EgySyr provides professional solutions for resource management, inventory, accounting, and more, ensuring seamless performance and a smooth user experience.</p>
                    <div style="width: 100%;" class="f_line"></div>
                    <ol>
                      <li><strong>Understanding Your Needs</strong>
                        We analyze your business requirements to create a tailored solution that enhances efficiency.
                      </li>
                      <li><strong>Planning & Design</strong>
                        We structure the system and design an intuitive interface for a seamless user experience.
                      </li>
                      <li><strong> Custom Development</strong>
                        We build a high-performance system using the latest technologies, ensuring smooth integration.
                      </li>
                      <li><strong>Testing & Quality Assurance</strong>
                        Comprehensive testing ensures reliability, speed, and ease of use.
                      </li>
                      <li><strong>Deployment & Training</strong>
                        We launch the system and train your team for optimal usage.
                      </li>
                      <li><strong>Ongoing Support & Updates</strong>
                        Continuous support and updates keep your system secure and up to date.
                      </li>
                      
                    </ol>
                  </div>
                
            </section>

            @php
                $hasWebPublishedReview = $reviews->contains(function ($review) {
                    return $review->status === 'publication' && $review->service_type === 'service_system';
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
                                @if($review->status === 'publication' && $review->service_type === 'service_system')
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