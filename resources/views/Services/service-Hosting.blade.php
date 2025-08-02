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


        .pricing-container {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 20px;
        padding: 40px;
        }

        .card {
        background: rgba(0, 0, 0, 0.5);
        border: 1px solid #e945ff;
        border-radius: 10px;
        padding: 20px;
        width: 250px;
        text-align: center;
        box-shadow: 0 0 10px #e945ff;
        transition: transform 0.3s ease;
        }

        .card:hover {
        transform: scale(1.05);
        }

        .plan-name {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
        /* color: #fff; */
        }

        .price {
        font-size: 20px;
        /* color: #ff66cc; */
        margin: 10px 0;
        }

        .save {
        background-color: #ff66cc;
        color: white;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 12px;
        display: inline-block;
        margin-bottom: 10px;
        background: linear-gradient(135deg, #910389, #f277f4);
        }

        .features {
        text-align: left;
        font-size: 14px;
        margin-top: 15px;
        color: #ddd;
        text-align: center;
        }

        .features span {
        display: block;
        margin: 5px 0;
        }

        .other-features {
        /* color: #e945ff; */
        text-align: center;
        margin: 10px 0;
        background: linear-gradient(308deg, rgba(145, 3, 137, 1), rgba(242, 119, 244, 1));
        /* -webkit-background-clip: text; */
        background-clip: text;
        color: #00000000;
        }

        .btn-order {
        margin-top: 20px;
        padding: 10px 20px;
        border: none;
        background: #e945ff;
        color: white;
        font-weight: bold;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s ease;
        background: linear-gradient(-135deg, #910389, #f277f4);
        }

        .btn-order:hover {
            background: linear-gradient(135deg, #910389, #f277f4);
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
                Hosting & Domains
            </h1>
            <!-- <p><span style="background: linear-gradient(308deg, rgba(145, 3, 137, 1), rgba(242, 119, 244, 1));background-clip: text;color: #00000000;">Need Assistance? Contact EgySyr ! </span>💡</p> -->
            <p id="about">
                EgySyr offers domain registration and hosting services with comprehensive solutions ensuring speed, security, and stability. We provide premium domains and reliable hosting, including shared hosting, VPS, and dedicated servers, backed by advanced security measures, SSL certificates, and cutting-edge protection against cyber threats. Our dedicated support team ensures seamless and secure website operation for our clients. 🚀💡
            </p>
            
        </div>
        <div class="img_Home" data-aos="fade-left">
            <svg xmlns="http://www.w3.org/2000/svg" width="163" height="188" viewBox="0 0 163 188" fill="none">
                <path d="M9.05556 0H153.944C156.346 0 158.649 0.900322 160.348 2.50291C162.046 4.10549 163 6.27906 163 8.54545V42.7273C163 44.9937 162.046 47.1672 160.348 48.7698C158.649 50.3724 156.346 51.2727 153.944 51.2727H9.05556C6.65387 51.2727 4.35056 50.3724 2.65231 48.7698C0.954064 47.1672 0 44.9937 0 42.7273V8.54545C0 6.27906 0.954064 4.10549 2.65231 2.50291C4.35056 0.900322 6.65387 0 9.05556 0ZM9.05556 68.3636H153.944C156.346 68.3636 158.649 69.264 160.348 70.8665C162.046 72.4691 163 74.6427 163 76.9091V111.091C163 113.357 162.046 115.531 160.348 117.133C158.649 118.736 156.346 119.636 153.944 119.636H9.05556C6.65387 119.636 4.35056 118.736 2.65231 117.133C0.954064 115.531 0 113.357 0 111.091V76.9091C0 74.6427 0.954064 72.4691 2.65231 70.8665C4.35056 69.264 6.65387 68.3636 9.05556 68.3636ZM9.05556 136.727H153.944C156.346 136.727 158.649 137.628 160.348 139.23C162.046 140.833 163 143.006 163 145.273V179.455C163 181.721 162.046 183.895 160.348 185.497C158.649 187.1 156.346 188 153.944 188H9.05556C6.65387 188 4.35056 187.1 2.65231 185.497C0.954064 183.895 0 181.721 0 179.455V145.273C0 143.006 0.954064 140.833 2.65231 139.23C4.35056 137.628 6.65387 136.727 9.05556 136.727ZM54.3333 34.1818H63.3889V17.0909H54.3333V34.1818ZM54.3333 102.545H63.3889V85.4546H54.3333V102.545ZM54.3333 170.909H63.3889V153.818H54.3333V170.909ZM18.1111 17.0909V34.1818H36.2222V17.0909H18.1111ZM18.1111 85.4546V102.545H36.2222V85.4546H18.1111ZM18.1111 153.818V170.909H36.2222V153.818H18.1111Z" fill="url(#paint0_linear_736_669)"/>
                <defs>
                <linearGradient id="paint0_linear_736_669" x1="81.5" y1="0" x2="81.5" y2="188" gradientUnits="userSpaceOnUse">
                <stop stop-color="#910389"/>
                <stop offset="0.560434" stop-color="#F277F4"/>
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
                <input value="Hosting" type="hidden" name="service_type" id="service_type">
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
                
                <div class="pricing-container">

                    <!-- Start Plan -->
                    <div class="card">
                    <div class="plan-name text_h">Start</div>
                    <div class="save">Save 2%</div>
                    <div class="price text_h">$129.00 USD / yearly</div>
                    <div class="features">
                        <span>6 cPanel Accounts</span>
                        <span>Unlimited NUMe Storage</span>
                        <span>Unlimited Bandwidth</span>
                        <span>Custom Nameservers</span>
                        <span>100% Whitelabel</span>
                        <span>WHM Panel Access</span>
                        <div class="other-features">→ Other Features ←</div>
                        <span>2 GB RAM/Account</span>
                        <span>Cloud Linux Servers</span>
                        <span>LiteSpeed Cache</span>
                        <span>Softaculous Installer</span>
                        <span>Accelerate WordPress</span>
                        <span>Free Virus Scanner</span>
                        <span>Free Immunify 360</span>
                        <span>Free Domain</span>
                        <span>24/7 Support</span>
                    </div>
                    <button class="btn-order">Order Now</button>
                    </div>

                    <!-- Mini Plan -->
                    <div class="card">
                    <div class="plan-name text_h">Mini</div>
                    <div class="save">Save 8%</div>
                    <div class="price text_h">$198.96 USD / yearly</div>
                    <div class="features">
                        <span>15 cPanel Accounts</span>
                        <span>Unlimited NUMe Storage</span>
                        <span>Unlimited Bandwidth</span>
                        <span>Custom Nameservers</span>
                        <span>100% Whitelabel</span>
                        <span>WHM Panel Access</span>
                        <div class="other-features">→ Other Features ←</div>
                        <span>2 GB RAM/Account</span>
                        <span>Cloud Linux Servers</span>
                        <span>LiteSpeed Cache</span>
                        <span>Softaculous Installer</span>
                        <span>Accelerate WordPress</span>
                        <span>Free Virus Scanner</span>
                        <span>Free Immunify 360</span>
                        <span>Free Domain</span>
                        <span>24/7 Support</span>
                    </div>
                    <button class="btn-order">Order Now</button>
                    </div>

                    <!-- Advanced Plan -->
                    <div class="card">
                    <div class="plan-name text_h">Advanced</div>
                    <div class="save">Save 11%</div>
                    <div class="price text_h">$459.96 USD / yearly</div>
                    <div class="features">
                        <span>45 cPanel Accounts</span>
                        <span>Unlimited NUMe Storage</span>
                        <span>Unlimited Bandwidth</span>
                        <span>Custom Nameservers</span>
                        <span>100% Whitelabel</span>
                        <span>WHM Panel Access</span>
                        <div class="other-features">→ Other Features ←</div>
                        <span>2 GB RAM/Account</span>
                        <span>Cloud Linux Servers</span>
                        <span>LiteSpeed Cache</span>
                        <span>Softaculous Installer</span>
                        <span>Accelerate WordPress</span>
                        <span>Free Virus Scanner</span>
                        <span>Free Immunify 360</span>
                        <span>Free Domain</span>
                        <span>24/7 Support</span>
                    </div>
                    <button class="btn-order">Order Now</button>
                    </div>

                    <!-- Premium Plan -->
                    <div class="card">
                    <div class="plan-name text_h">Premium</div>
                    <div class="save">Save 17%</div>
                    <div class="price text_h">$890.04 USD / yearly</div>
                    <div class="features">
                        <span>100 cPanel Accounts</span>
                        <span>Unlimited NUMe Storage</span>
                        <span>Unlimited Bandwidth</span>
                        <span>Custom Nameservers</span>
                        <span>100% Whitelabel</span>
                        <span>WHM Panel Access</span>
                        <div class="other-features">→ Other Features ←</div>
                        <span>2 GB RAM/Account</span>
                        <span>Cloud Linux Servers</span>
                        <span>LiteSpeed Cache</span>
                        <span>Softaculous Installer</span>
                        <span>Accelerate WordPress</span>
                        <span>Free Virus Scanner</span>
                        <span>Free Immunify 360</span>
                        <span>Free Domain</span>
                        <span>24/7 Support</span>
                    </div>
                    <button class="btn-order">Order Now</button>
                    </div>

                </div>

                
            </section>

            @php
                $hasWebPublishedReview = $reviews->contains(function ($review) {
                    return $review->status === 'publication' && $review->service_type === 'service_Hosting';
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
                                @if($review->status === 'publication' && $review->service_type === 'service_Hosting')
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