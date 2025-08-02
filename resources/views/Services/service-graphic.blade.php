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
      
      @include('layouts.navbar')
      <!-- ----------------nav------------------ -->

    <section style="border-bottom: solid 3px #910389;background-color: #1B0015;padding-bottom: 55px;margin-top: 45px;margin-bottom: 46px;" class="Home">
        <div data-aos="fade-right">
            <h1>
                Graphic design
            </h1>
            <!-- <p><span style="background: linear-gradient(308deg, rgba(145, 3, 137, 1), rgba(242, 119, 244, 1));background-clip: text;color: #00000000;">Need Assistance? Contact EgySyr ! </span>💡</p> -->
            <p id="about">
                EgySyr offers professional graphic design services tailored to enhance your brand identity. We create custom designs using advanced tools to ensure high quality, visual appeal, and effective communication. Our solutions cover logos, branding, marketing materials, and digital content, with continuous support to maintain consistency and impact.
            </p>
            
        </div>
        <div class="img_Home" data-aos="fade-left">
            <svg xmlns="http://www.w3.org/2000/svg" width="212" height="212" viewBox="0 0 212 212" fill="none">
                <path d="M42.4143 7.95548C42.4157 6.45719 41.9936 4.98899 41.1964 3.72024C40.3993 2.45148 39.2597 1.43384 37.9091 0.784691C36.5584 0.13554 35.0518 -0.118683 33.5628 0.0513457C32.0739 0.221374 30.6634 0.808728 29.494 1.74566C15.6091 12.8619 8.05196 22.6005 4.0773 31.0781C1.21522 37.0871 -0.17622 43.6906 0.0178407 50.3433C0.0178407 60.3681 5.07362 69.2059 12.7792 74.4514C10.6609 76.2399 8.84926 78.3625 7.41602 80.7354C2.37084 88.8951 0.0178407 101.368 0.0178407 119.277C0.0178407 137.419 2.45564 159.206 6.4303 176.606C8.40174 185.253 10.8501 193.233 13.7649 199.22C15.217 202.198 16.987 205.101 19.1704 207.38C21.3538 209.616 24.7138 212 29.1654 212C33.617 212 36.9769 209.616 39.1497 207.38C41.3621 204.955 43.1855 202.203 44.5553 199.22C47.4807 193.222 49.929 185.253 51.9005 176.596C56.0385 157.763 58.1878 138.548 58.3129 119.266C58.3129 101.357 55.9599 88.8951 50.9148 80.7354C49.4815 78.3625 47.6699 76.2399 45.5516 74.4514C49.4843 71.7786 52.7032 68.1844 54.9276 63.9823C57.1519 59.7801 58.3142 55.0977 58.3129 50.3433C58.3129 40.52 53.6917 33.6637 50.1728 28.4288L49.8654 27.9731C45.7318 21.8163 42.4143 16.751 42.4143 7.95548ZM15.9165 50.3433C15.9165 47.1854 15.9165 43.2858 18.4815 37.8283C20.2621 34.0028 23.4525 29.1494 29.2078 23.2999C31.2534 28.7785 34.1152 33.0491 36.5424 36.6521L36.6696 36.8428C40.4534 42.4698 42.4143 45.6913 42.4143 50.3433C42.4143 53.8564 41.0184 57.2257 38.5338 59.7098C36.0491 62.194 32.6792 63.5895 29.1654 63.5895C25.6516 63.5895 22.2817 62.194 19.797 59.7098C17.3124 57.2257 15.9165 53.8564 15.9165 50.3433ZM15.9165 119.277C15.9165 102.078 18.3119 93.3458 20.9405 89.0858C21.7402 87.657 22.9366 86.4903 24.3852 85.7266C25.8881 85.0635 27.5245 84.7588 29.1654 84.8364C31.2852 84.8364 32.8009 85.165 33.9456 85.7266C35.0055 86.2352 36.1926 87.1572 37.3903 89.0858C40.0189 93.3458 42.4143 102.078 42.4143 119.277C42.4143 136.242 40.1037 156.843 36.4046 173.067C34.5391 181.226 32.4193 187.85 30.2677 192.258C29.9258 192.96 29.5581 193.649 29.1654 194.324C28.7727 193.649 28.405 192.96 28.0631 192.258C25.9115 187.85 23.7916 181.216 21.9262 173.067C18.0616 155.394 16.0475 137.367 15.9165 119.277ZM68.7425 127.987C73.8435 130.229 79.2662 131.652 84.8107 132.205V108.627C84.8107 104.104 85.7017 99.6254 87.4328 95.447C89.164 91.2685 91.7013 87.4718 94.9 84.2738C98.0987 81.0757 101.896 78.5389 106.075 76.8081C110.255 75.0773 114.734 74.1865 119.258 74.1865H142.841C141.97 65.5126 138.973 57.1875 134.114 49.9492C129.255 42.7108 122.685 36.783 114.986 32.6911C107.287 28.5992 98.6968 26.4698 89.9776 26.4916C81.2585 26.5134 72.6794 28.6857 65.001 32.816C63.3512 29.3368 61.4081 26.0043 59.1927 22.8548L58.6627 22.0706L56.7655 19.1883C66.8626 13.6044 78.2008 10.6456 89.7395 10.5834C101.278 10.5211 112.648 13.3574 122.804 18.8319C132.961 24.3065 141.58 32.2439 147.87 41.9157C154.16 51.5875 157.919 62.6839 158.803 74.1865H177.553C182.077 74.1865 186.556 75.0773 190.735 76.8081C194.915 78.5389 198.712 81.0757 201.911 84.2738C205.109 87.4718 207.647 91.2685 209.378 95.447C211.109 99.6254 212 104.104 212 108.627V166.91C212 171.433 211.109 175.911 209.378 180.09C207.647 184.268 205.109 188.065 201.911 191.263C198.712 194.461 194.915 196.998 190.735 198.728C186.556 200.459 182.077 201.35 177.553 201.35H119.258C110.122 201.35 101.36 197.722 94.9 191.263C88.4399 184.804 84.8107 176.044 84.8107 166.91V148.164C78.9557 147.717 73.1819 146.524 67.6296 144.614C68.1595 138.998 68.5411 133.402 68.7425 127.987ZM177.553 90.0819H158.199C155.945 104.517 149.163 117.864 138.83 128.194C128.497 138.525 115.148 145.307 100.709 147.56V166.91C100.709 177.147 109.019 185.455 119.258 185.455H177.553C182.472 185.455 187.19 183.501 190.669 180.023C194.147 176.545 196.101 171.828 196.101 166.91V108.627C196.101 103.708 194.147 98.9914 190.669 95.5136C187.19 92.0358 182.472 90.0819 177.553 90.0819ZM100.709 131.41C110.888 129.321 120.23 124.291 127.578 116.945C134.926 109.599 139.956 100.259 142.046 90.0819H119.258C114.338 90.0819 109.621 92.0358 106.142 95.5136C102.664 98.9914 100.709 103.708 100.709 108.627V131.41Z" fill="url(#paint0_linear_739_819)"/>
                <defs>
                <linearGradient id="paint0_linear_739_819" x1="106" y1="0" x2="106" y2="212" gradientUnits="userSpaceOnUse">
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
                <input value="Graphic" type="hidden" name="service_type" id="service_type">
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
                    <p>With digital transformation, graphic design has become essential for building strong brand identities and attracting customers. At EgySyr, we provide professional design solutions, including logos, visual branding, and marketing content, ensuring a powerful identity and visually appealing impact that enhances your business success.</p>
                    <div style="width: 100%;" class="f_line"></div>
                    <ol>
                      <li><strong>Understanding Your Needs & Concept Analysis</strong>
                        We start with a consultation to define your design goals.
                      </li>
                      <li><strong>Research & Inspiration</strong>
                        Analyzing the market to create unique and creative ideas.
                      </li>
                      <li><strong> Planning & Initial Draft</strong>
                        Crafting an initial concept with colors, fonts, and visuals.
                      </li>
                      <li><strong>  Design & Development</strong>
                        Turning ideas into high-quality graphics using advanced tools.
                      </li>
                      <li><strong> Review & Revisions</strong>
                        Applying your feedback for the perfect final touch.
                      </li>
                      <li><strong>Final Delivery</strong>
                        Providing ready-to-use files in various formats.
                      </li>
                      <li><strong>Ongoing Support & Updates</strong>
                        Offering updates and modifications as needed.
                      </li>
                      
                    </ol>
                  </div>
                
            </section>

            @php
                $hasWebPublishedReview = $reviews->contains(function ($review) {
                    return $review->status === 'publication' && $review->service_type === 'service_Graphic';
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
                                @if($review->status === 'publication' && $review->service_type === 'service_Graphic')
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