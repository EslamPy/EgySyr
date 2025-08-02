<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="icon" href="{{ asset('images/icon.webp') }}" type="image/webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EgySyr</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta property="og:image" content="https://www.egysyr.net/img/logo.webp" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta name="description" content="شركة تكنولوجيا تقدم خدمات برمجة مواقع، تطوير متاجر إلكترونية، وأنظمة إدارية متكاملة. نوفر حلول تقنية مبتكرة تناسب احتياجاتك وتدعم نمو أعمالك.">
    <meta name="description" content="A technology company offering website development, e-commerce solutions, and comprehensive management systems. We provide innovative tech solutions tailored to your needs to support your business growth.">
    <meta name="keywords" content="برمجة مواقع, تطوير متاجر إلكترونية, أنظمة إدارية, شركة تكنولوجيا, حلول تقنية, تصميم مواقع, برمجة ويب, تطوير برمجيات, إدارة أعمال, برمجة أنظمة, تطوير مواقع, website development, e-commerce solutions, management systems, technology company, tech solutions, website design, web development, software development, business management, system programming, website creation">
    <meta name="author" content="EgySyr">
    <meta name="robots" content="index, follow">
    
    <!-- Preload critical resources -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap"></noscript>
    
    <!-- Critical CSS - Inline for performance -->
    <style>
        /* Critical above-the-fold styles */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .loading-placeholder {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        .lazy {
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .lazy.loaded {
            opacity: 1;
        }
    </style>
    
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/style.css', 'resources/js/app.js'])
    @endif
    
    <!-- Defer non-critical CSS -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="https://unpkg.com/aos@2.3.1/dist/aos.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    
    <!-- Defer non-critical JavaScript -->
    <script>
        // Intersection Observer polyfill for older browsers
        if (!('IntersectionObserver' in window)) {
            const script = document.createElement('script');
            script.src = 'https://polyfill.io/v3/polyfill.min.js?features=IntersectionObserver';
            document.head.appendChild(script);
        }
    </script>
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

    <section class="container">
        <!-- ---------------------------- -->
        <section class="all">
        <section class="Home">
            <div class="Home_div" data-aos="fade-right">
                <h1>
                    Advanced technological solutions to build a smarter and easier future
                </h1>
                <p id="about">
                    With EgySyr, we guarantee you website design services, applications, administrative systems, and more to develop your business with the highest standards.
                </p>
                <div style="width: 227px;">
                    <a style="text-decoration: none;" href="">
                        <button class="btn_Services">Request a free consultation <div>>></div></button>
                    </a>
                </div>
                
            </div>
            <div class="img_Home" data-aos="fade-left"  style="text-align: right;">
                <img width="90%" src="{{ asset('images/Scene.webp') }}" alt=""  style="transform: scaleX(-1); -webkit-user-drag: none;">
            </div>
        </section>
        <section class="conters">
            <div data-aos="fade-right" class="conter"><h1 class="num" data-goal="100" data-symbol="+">0</h1><p>Our Customers</p></div>
            <div data-aos="zoom-in-down" class="conter"><h1 class="num" data-goal="50" data-symbol="">0</h1><p>Number of Projects</p></div>
            <div data-aos="fade-left" class="conter"><h1 class="num" data-goal="80" data-symbol="%">0</h1><p>Customer evaluation</p></div>
        </section>
        <section class="why-choose-us">
            <div data-aos="zoom-in-down" class="Choose_box_h">
                <h1>Why Choose Us?</h1>
                <h3>Why EgySyr is your best choice</h3>
            </div>
            <div data-aos="fade-right" class="carousel-container">
                <div class="carousel">
                    <div class="card Choose_o">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="93" height="93" viewBox="0 0 93 93" fill="none">
                                <path d="M16.4889 46.289C13.0287 40.2592 11.357 35.3317 10.3495 30.3385C8.86033 22.9508 12.2695 15.7348 17.9161 11.1284C20.3032 9.18298 23.0408 9.85093 24.4534 12.3804L27.6399 18.1C30.1657 22.6333 31.4286 24.8963 31.1804 27.298C30.9286 29.7034 29.224 31.6598 25.8185 35.5726L16.4889 46.289ZM16.4889 46.289C23.4934 58.502 34.4837 69.5031 46.7114 76.5111M46.7114 76.5111C52.7449 79.9714 57.6688 81.6431 62.6621 82.6505C70.0498 84.1397 77.266 80.7306 81.8687 75.084C83.8178 72.6969 83.1499 69.9594 80.6204 68.5468L74.9008 65.3603C70.3674 62.8345 68.1044 61.5716 65.7026 61.8198C63.2972 62.0717 61.3408 63.7762 57.4279 67.1817L46.7114 76.5111ZM46.4997 28.2507H49.6278C51.1024 28.2507 51.8397 28.2507 52.2996 28.696C52.7559 29.1413 52.7559 29.8603 52.7559 31.2911C52.7559 34.16 52.7559 35.5945 51.8434 36.4851C51.1426 37.164 50.1242 37.3246 48.3758 37.3611C47.4816 37.383 47.0362 37.3939 46.7698 37.6604C46.5033 37.9268 46.4997 38.3502 46.4997 39.2007V43.4603C46.4997 44.8947 46.4997 45.6101 46.9596 46.0554C47.4159 46.5007 48.1532 46.5007 49.6278 46.5007H52.7559M68.4 28.2507V37.3757M68.4 37.3757H63.0819C61.9029 37.3757 61.3116 37.3757 60.9466 37.018C60.5816 36.6639 60.5816 36.0909 60.5816 34.9411V28.2507M68.4 37.3757V46.5007" stroke="url(#paint0_linear_780_100)" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M39 18.4268C39.3254 18.0599 39.6642 17.7003 40.0164 17.3481C42.4019 14.9712 45.2397 13.0966 48.3621 11.835C51.4844 10.5735 54.828 9.95053 58.1952 10.0031C61.5624 10.0556 64.8849 10.7825 67.9664 12.1409C71.0479 13.4992 73.8258 15.4615 76.136 17.9116C78.4462 20.3617 80.2418 23.2501 81.4167 26.4059C82.5916 29.5618 83.122 32.9211 82.9765 36.2854C82.8309 39.6497 82.0125 42.9507 80.5695 45.9933C79.1264 49.036 77.0881 51.7585 74.575 54" stroke="url(#paint1_linear_780_100)" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                                <defs>
                                <linearGradient id="paint0_linear_780_100" x1="46.5" y1="10" x2="46.5" y2="83" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#F277F4"/>
                                <stop offset="1" stop-color="#910389"/>
                                </linearGradient>
                                <linearGradient id="paint1_linear_780_100" x1="61" y1="10" x2="61" y2="54" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#F277F4"/>
                                <stop offset="1" stop-color="#910389"/>
                                </linearGradient>
                                </defs>
                            </svg>
                            <h1 class="text_h" style="font-size: 33px;">Support</h1>
                        </div>
                        <div style="margin: auto;" class="f_line"></div>
                        <p>Technical support services are available 24/7, providing timely assistance and ensuring seamless operations for our clients at all times.</p>
                    </div>
                    <div class="card Choose_o">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="98" height="92" viewBox="0 0 98 92" fill="none">
                                <path d="M59.5755 36.1818C61.5149 36.1818 63.3749 36.9576 64.7462 38.3386C66.1176 39.7195 66.888 41.5925 66.888 43.5455V63.9967C66.888 68.7715 65.0044 73.3507 61.6516 76.727C58.2988 80.1032 53.7514 82 49.0098 82C44.2681 82 39.7207 80.1032 36.3679 76.727C33.0151 73.3507 31.1315 68.7715 31.1315 63.9967V43.5455C31.1315 41.5925 31.9019 39.7195 33.2733 38.3386C34.6446 36.9576 36.5046 36.1818 38.444 36.1818H59.5755ZM59.5755 41.0909H38.444C37.7975 41.0909 37.1775 41.3495 36.7204 41.8098C36.2633 42.2701 36.0065 42.8945 36.0065 43.5455V63.9967C36.0065 67.4695 37.3765 70.8001 39.8151 73.2557C42.2536 75.7113 45.5611 77.0909 49.0098 77.0909C52.4584 77.0909 55.7659 75.7113 58.2044 73.2557C60.643 70.8001 62.013 67.4695 62.013 63.9967V43.5455C62.013 42.8945 61.7562 42.2701 61.2991 41.8098C60.842 41.3495 60.222 41.0909 59.5755 41.0909ZM17.3125 36.1818H30.8195C29.5143 37.5496 28.5974 39.2448 28.1643 41.0909H17.3125C16.666 41.0909 16.0461 41.3495 15.5889 41.8098C15.1318 42.2701 14.875 42.8945 14.875 43.5455V60.724C14.8737 62.3664 15.2816 63.9829 16.0614 65.4255C16.8411 66.868 17.9678 68.0906 19.3382 68.9812C20.7086 69.8718 22.279 70.4019 23.9055 70.5231C25.5321 70.6443 27.1628 70.3527 28.6485 69.6749C29.0808 71.2785 29.7015 72.8036 30.4815 74.2305C28.2549 75.2104 25.8209 75.6162 23.3995 75.4111C20.9781 75.2061 18.6455 74.3967 16.6127 73.0561C14.5798 71.7156 12.9107 69.8861 11.7562 67.7329C10.6017 65.5798 9.99808 63.171 10 60.724V43.5455C10 41.5925 10.7704 39.7195 12.1418 38.3386C13.5131 36.9576 15.3731 36.1818 17.3125 36.1818ZM80.6875 36.1818C82.6269 36.1818 84.4869 36.9576 85.8582 38.3386C87.2296 39.7195 88 41.5925 88 43.5455V60.7273C88.001 63.1725 87.3973 65.5796 86.2435 67.7311C85.0896 69.8827 83.4219 71.7111 81.3909 73.0513C79.3598 74.3916 77.0293 75.2014 74.6097 75.4079C72.1901 75.6143 69.7575 75.2108 67.5315 74.2338L67.7135 73.9C68.409 72.5713 68.9712 71.1607 69.3742 69.6815C70.8592 70.3543 72.4878 70.6419 74.1114 70.518C75.7351 70.3942 77.302 69.8628 78.6694 68.9725C80.0367 68.0821 81.1608 66.8611 81.9391 65.4208C82.7174 63.9806 83.1251 62.367 83.125 60.7273V43.5455C83.125 42.895 82.8686 42.2712 82.4122 41.811C81.9558 41.3508 81.3367 41.0918 80.6908 41.0909H69.8585C69.4245 39.2445 68.5064 37.5492 67.2 36.1818H80.6875ZM49 10C50.4938 10 51.9729 10.2963 53.353 10.8719C54.7331 11.4476 55.9871 12.2913 57.0433 13.355C58.0996 14.4186 58.9375 15.6814 59.5091 17.0711C60.0808 18.4608 60.375 19.9503 60.375 21.4545C60.375 22.9588 60.0808 24.4483 59.5091 25.838C58.9375 27.2277 58.0996 28.4905 57.0433 29.5541C55.9871 30.6178 54.7331 31.4615 53.353 32.0372C51.9729 32.6128 50.4938 32.9091 49 32.9091C45.9832 32.9091 43.0899 31.7023 40.9567 29.5541C38.8234 27.406 37.625 24.4925 37.625 21.4545C37.625 18.4166 38.8234 15.5031 40.9567 13.355C43.0899 11.2068 45.9832 10 49 10ZM75.0098 13.2727C76.2901 13.2727 77.558 13.5267 78.7409 14.0201C79.9238 14.5135 80.9987 15.2367 81.904 16.1484C82.8094 17.0601 83.5276 18.1425 84.0176 19.3337C84.5076 20.5248 84.7598 21.8016 84.7598 23.0909C84.7598 24.3803 84.5076 25.657 84.0176 26.8482C83.5276 28.0394 82.8094 29.1217 81.904 30.0334C80.9987 30.9451 79.9238 31.6683 78.7409 32.1617C77.558 32.6551 76.2901 32.9091 75.0098 32.9091C72.4239 32.9091 69.9439 31.8747 68.1155 30.0334C66.287 28.1921 65.2598 25.6949 65.2598 23.0909C65.2598 20.487 66.287 17.9897 68.1155 16.1484C69.9439 14.3071 72.4239 13.2727 75.0098 13.2727ZM22.9903 13.2727C24.2706 13.2727 25.5385 13.5267 26.7214 14.0201C27.9043 14.5135 28.9792 15.2367 29.8845 16.1484C30.7899 17.0601 31.5081 18.1425 31.9981 19.3337C32.4881 20.5248 32.7403 21.8016 32.7403 23.0909C32.7403 24.3803 32.4881 25.657 31.9981 26.8482C31.5081 28.0394 30.7899 29.1217 29.8845 30.0334C28.9792 30.9451 27.9043 31.6683 26.7214 32.1617C25.5385 32.6551 24.2706 32.9091 22.9903 32.9091C20.4044 32.9091 17.9244 31.8747 16.096 30.0334C14.2675 28.1921 13.2403 25.6949 13.2403 23.0909C13.2403 20.487 14.2675 17.9897 16.096 16.1484C17.9244 14.3071 20.4044 13.2727 22.9903 13.2727ZM49 14.9091C47.2761 14.9091 45.6228 15.5987 44.4038 16.8262C43.1848 18.0537 42.5 19.7186 42.5 21.4545C42.5 23.1905 43.1848 24.8554 44.4038 26.0829C45.6228 27.3104 47.2761 28 49 28C50.7239 28 52.3772 27.3104 53.5962 26.0829C54.8152 24.8554 55.5 23.1905 55.5 21.4545C55.5 19.7186 54.8152 18.0537 53.5962 16.8262C52.3772 15.5987 50.7239 14.9091 49 14.9091ZM75.0098 18.1818C74.3696 18.1818 73.7356 18.3088 73.1442 18.5555C72.5527 18.8022 72.0153 19.1638 71.5626 19.6197C71.1099 20.0755 70.7508 20.6167 70.5058 21.2123C70.2608 21.8079 70.1348 22.4462 70.1348 23.0909C70.1348 23.7356 70.2608 24.3739 70.5058 24.9695C70.7508 25.5651 71.1099 26.1063 71.5626 26.5622C72.0153 27.018 72.5527 27.3796 73.1442 27.6263C73.7356 27.873 74.3696 28 75.0098 28C76.3027 28 77.5427 27.4828 78.4569 26.5622C79.3711 25.6415 79.8848 24.3929 79.8848 23.0909C79.8848 21.7889 79.3711 20.5403 78.4569 19.6197C77.5427 18.699 76.3027 18.1818 75.0098 18.1818ZM22.9903 18.1818C22.3501 18.1818 21.7161 18.3088 21.1247 18.5555C20.5332 18.8022 19.9958 19.1638 19.5431 19.6197C19.0904 20.0755 18.7313 20.6167 18.4863 21.2123C18.2414 21.8079 18.1153 22.4462 18.1153 23.0909C18.1153 23.7356 18.2414 24.3739 18.4863 24.9695C18.7313 25.5651 19.0904 26.1063 19.5431 26.5622C19.9958 27.018 20.5332 27.3796 21.1247 27.6263C21.7161 27.873 22.3501 28 22.9903 28C24.2832 28 25.5232 27.4828 26.4374 26.5622C27.3516 25.6415 27.8653 24.3929 27.8653 23.0909C27.8653 21.7889 27.3516 20.5403 26.4374 19.6197C25.5232 18.699 24.2832 18.1818 22.9903 18.1818Z" fill="url(#paint0_linear_647_135)"/>
                                <defs>
                                <linearGradient id="paint0_linear_647_135" x1="49" y1="10" x2="49" y2="82" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#F277F4"/>
                                <stop offset="1" stop-color="#910389"/>
                                </linearGradient>
                                </defs>
                            </svg>
                            <h1 class="text_h" style="font-size: 33px;">Team</h1>
                        </div>
                        <div style="margin: auto;" class="f_line"></div>
                        <p>The company has a professional team committed to maintaining high-quality standards, ensuring excellence and delivering reliable results.</p>
                    </div>
                    <div class="card Choose_o">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="98" height="92" viewBox="0 0 98 92" fill="none">
                                <path d="M30.9987 73.4939L48.9995 62.9679L67.0003 73.6324L62.2858 53.6884L78.1437 40.3924L57.2856 38.5919L48.9995 19.7559L40.7134 38.4534L19.8554 40.2539L35.7132 53.6884L30.9987 73.4939ZM48.9995 69.4885L28.2557 81.6322C27.6462 81.924 27.0804 82.0421 26.5585 81.9867C26.0404 81.9277 25.5356 81.7541 25.0442 81.466C24.5489 81.1705 24.1755 80.7532 23.9241 80.2139C23.6727 79.6747 23.6498 79.0856 23.8555 78.4467L29.3758 55.6773L11.1178 40.3315C10.6035 39.9252 10.2644 39.4396 10.1006 38.8745C9.93681 38.3094 9.97301 37.7683 10.2092 37.2513C10.4454 36.7342 10.7597 36.3095 11.1521 35.9771C11.5483 35.6557 12.0817 35.4378 12.7522 35.3233L36.8447 33.2846L46.2394 11.7229C46.4985 11.1135 46.8718 10.674 47.3594 10.4044C47.8471 10.1348 48.3938 10 48.9995 10C49.6053 10 50.1539 10.1348 50.6453 10.4044C51.1368 10.674 51.5082 11.1135 51.7596 11.7229L61.1543 33.2846L85.2411 35.3233C85.9155 35.4341 86.4507 35.6539 86.8469 35.9826C87.2431 36.3076 87.5593 36.7305 87.7955 37.2513C88.0279 37.7683 88.0622 38.3094 87.8984 38.8745C87.7346 39.4396 87.3955 39.9252 86.8812 40.3315L68.6233 55.6773L74.1435 78.4467C74.3568 79.0782 74.3359 79.6655 74.0806 80.2084C73.8254 80.7513 73.4501 81.1687 72.9549 81.4604C72.4672 81.7559 71.9624 81.9313 71.4405 81.9867C70.9224 82.0421 70.3586 81.924 69.749 81.6322L48.9995 69.4885Z" fill="url(#paint0_linear_647_136)"/>
                                <defs>
                                <linearGradient id="paint0_linear_647_136" x1="10" y1="20.5" x2="86.806" y2="83.4567" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#F277F4"/>
                                <stop offset="1" stop-color="#910389"/>
                                </linearGradient>
                                </defs>
                            </svg>
                            <h3 class="text_h" style="font-size: 33px;">Experience</h3>
                        </div>
                        <div style="margin: auto;" class="f_line"></div>
                        <p>The company has extensive experience in developing innovative software solutions with the latest technical standards for efficiency and reliability.</p>
                    </div>
                    <div class="card Choose_o">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="84" height="78" viewBox="0 0 84 78" fill="none">
                                <path d="M61.7347 55.7342L61.9879 47.7962C62.7289 47.3143 63.4337 46.7865 64.0974 46.2164C80.1091 31.2181 83.6742 8.61337 79.2441 4.57611C74.814 0.538848 50.4063 3.91298 34.1626 18.7163C33.5524 19.335 32.9818 19.9862 32.4539 20.6666L23.8679 20.9007C22.3942 20.9236 20.9528 21.3029 19.687 22.001C18.4211 22.6991 17.3752 23.6915 16.6532 24.8794L3.21523 47.6207C3.02585 47.978 2.95919 48.3803 3.02422 48.7736C3.08924 49.167 3.28283 49.5325 3.57901 49.8212C3.87519 50.1099 4.25978 50.3079 4.68119 50.3887C5.1026 50.4695 5.54065 50.4292 5.93657 50.2732L24.0367 42.2182C23.6772 44.6252 23.6772 47.0665 24.0367 49.4736L14.839 60.4736C14.6141 60.7226 14.491 61.0367 14.491 61.361C14.491 61.6854 14.6141 61.9995 14.839 62.2485L15.8305 63.1066L16.7587 64.0233C17.0313 64.2327 17.3746 64.3473 17.7291 64.3473C18.0835 64.3473 18.4268 64.2327 18.6995 64.0233L30.5764 55.4612C33.1799 55.7935 35.8204 55.7935 38.424 55.4612L29.9435 72.3709C29.802 72.7233 29.7736 73.1061 29.8619 73.4731C29.9502 73.8401 30.1513 74.1756 30.4411 74.4394C30.7309 74.7032 31.0969 74.8839 31.4952 74.9598C31.8934 75.0357 32.3069 75.0036 32.6859 74.8673L57.3468 62.424C58.6353 61.7731 59.7179 60.8226 60.4874 59.6665C61.257 58.5103 61.6869 57.1885 61.7347 55.8317V55.7342ZM71.502 11.8315C72.1078 12.3941 72.5197 13.11 72.6857 13.8889C72.8518 14.6677 72.7645 15.4746 72.435 16.2077C72.1055 16.9408 71.5485 17.5672 70.8343 18.0078C70.1201 18.4485 69.2807 18.6836 68.422 18.6836C67.5634 18.6836 66.724 18.4485 66.0098 18.0078C65.2956 17.5672 64.7385 16.9408 64.409 16.2077C64.0795 15.4746 63.9923 14.6677 64.1584 13.8889C64.3244 13.11 64.7363 12.3941 65.3421 11.8315C65.7459 11.4564 66.2258 11.1588 66.7544 10.9557C67.2829 10.7527 67.8497 10.6481 68.422 10.6481C68.9944 10.6481 69.5612 10.7527 70.0897 10.9557C70.6183 11.1588 71.0982 11.4564 71.502 11.8315ZM52.3049 29.5798C51.2915 28.6409 50.6019 27.4454 50.3231 26.1444C50.0444 24.8433 50.189 23.495 50.7387 22.2699C51.2884 21.0447 52.2185 19.9977 53.4116 19.2611C54.6046 18.5245 56.0071 18.1314 57.4417 18.1314C58.8764 18.1314 60.2788 18.5245 61.4719 19.2611C62.6649 19.9977 63.5951 21.0447 64.1448 22.2699C64.6945 23.495 64.8391 24.8433 64.5603 26.1444C64.2815 27.4454 63.5919 28.6409 62.5785 29.5798C61.9045 30.2043 61.1038 30.6998 60.2223 31.0378C59.3409 31.3759 58.396 31.5499 57.4417 31.5499C56.4874 31.5499 55.5425 31.3759 54.6611 31.0378C53.7797 30.6998 52.979 30.2043 52.3049 29.5798Z" stroke="url(#paint0_linear_594_762)" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                                <defs>
                                <linearGradient id="paint0_linear_594_762" x1="42" y1="3" x2="42" y2="75" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#F277F4"/>
                                <stop offset="1" stop-color="#910389"/>
                                </linearGradient>
                                </defs>
                            </svg>
                            <h1 class="text_h" style="font-size: 33px;">Prices</h1>
                        </div>
                        <div style="margin: auto;" class="f_line"></div>
                        <p>We offer competitive prices on all services, ensuring high-quality solutions at cost-effective rates for our clients.</p>
                    </div>
                    <div class="card Choose_o">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="78" height="72" viewBox="0 0 78 72" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M29.1119 0C37.1509 0 43.6679 5.92399 43.6679 13.2316C43.6679 20.2958 37.5782 26.0671 29.9106 26.4438L29.1119 26.4635C21.073 26.4635 14.556 20.5395 14.556 13.2316C14.556 6.16766 20.6456 0.396244 28.3132 0.0194933L29.1119 0ZM0 68.0491H36.6089C35.121 65.712 34.1072 63.151 33.6157 60.488H8.31771V54.4393L8.33935 53.7053C8.74035 46.9065 14.678 41.5854 21.8338 41.5854H36.3898L37.1516 41.6056C37.8942 41.6451 38.6215 41.7419 39.3288 41.8913C41.4316 39.6764 43.9842 37.8506 46.847 36.5138C43.7415 34.9267 40.1783 34.0245 36.3898 34.0245H21.8338L20.934 34.0416C9.29283 34.4828 0 43.4463 0 54.4393V68.0491ZM22.8737 13.2316C22.8737 10.0998 25.6666 7.56089 29.1119 7.56089C32.5572 7.56089 35.3501 10.0998 35.3501 13.2316C35.3501 16.3635 32.5572 18.9024 29.1119 18.9024C25.6666 18.9024 22.8737 16.3635 22.8737 13.2316ZM46.0012 72L58.2236 65.2137L70.4461 72L67.123 59.336L78 50.8663L63.7238 49.8259L58.2236 37.805L52.7234 49.8259L38.4472 50.8663L49.3242 59.336L46.0012 72Z" fill="url(#paint0_linear_594_756)"/>
                                <defs>
                                <linearGradient id="paint0_linear_594_756" x1="39" y1="0" x2="39" y2="72" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#F277F4"/>
                                <stop offset="1" stop-color="#910389"/>
                                </linearGradient>
                                </defs>
                            </svg>
                            <h1 class="text_h" style="font-size: 33px;">Clients</h1>
                        </div>
                        <div style="margin: auto;" class="f_line"></div>
                        <p>We are fully committed to meeting deadlines and ensuring complete customer satisfaction through reliable and efficient service delivery.</p>
                    </div>
                </div>
            </div>
        </section>


        <section class="Projects" style="display: none;">
            <div class="projects-container">
                <div data-aos="zoom-in-down" class="Choose_box_h">
                    <h1>Projects of EgySyr Company</h1>
                </div>
                <div data-aos="fade-right" class="project-card">
                    <img src="{{ asset('images/project.webp') }}" alt="Project Image">
                    <div class="project-content">
                        <div class="text_h">KashirKo</div>
                        <div class="project-description">KashirKo streamlines supermarket management with full control over sales, inventory, and invoicing. Featuring an intuitive interface and smart tools, it ensures speed, accuracy, and secure multi-branch management with comprehensive analytics.</div>
                        <div class="details_div right">
                            <a href="#" class="details-button">More details ></a>
                        </div>
                    </div>
                </div>
                <div data-aos="fade-left" class="project-card right">
                    <div class="project-content">
                        <div class="text_h">KashirKo</div>
                        <div class="project-description">KashirKo streamlines supermarket management with full control over sales, inventory, and invoicing. Featuring an intuitive interface and smart tools, it ensures speed, accuracy, and secure multi-branch management with comprehensive analytics.</div>
                        <div class="details_div ">
                            <a href="#" class="details-button">More details ></a>
                        </div>
                    </div>
                    <img src="{{ asset('images/project.webp') }}" alt="Project Image">
                </div>
                <div data-aos="fade-right" class="project-card">
                    <img src="{{ asset('images/project.webp') }}" alt="Project Image">
                    <div class="project-content">
                        <div class="text_h">KashirKo</div>
                        <div class="project-description">KashirKo streamlines supermarket management with full control over sales, inventory, and invoicing. Featuring an intuitive interface and smart tools, it ensures speed, accuracy, and secure multi-branch management with comprehensive analytics.</div>
                        <div class="details_div right">
                            <a href="#" class="details-button">More details ></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="splide" aria-label="Splide Basic HTML Example">
            <div data-aos="zoom-in-down" class="Choose_box_h">
                <h1>Customer Reviews</h1>
            </div>
            <div data-aos="fade-right" class="splide__track" style="padding-left: 0px;padding-right: 0px;margin-top: 50px;margin-bottom: 50px;">
                  <ul class="splide__list">
                    @foreach($reviews as $review)
                        @if($review->status === 'publication')
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
        </section>
    
    
        <!-- ---------------------------- -->
    </section>






    <!-- ----------footer---------- -->
    @include('layouts.footer')

    <!-- <script src="splide.min.js"></script> -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // const video = document.getElementById("myVideo");
        // let reverse = false;
        // let interval;

        // function playReverse() {
        //     clearInterval(interval);
        //     interval = setInterval(() => {
        //         if (video.currentTime <= 0) {
        //             clearInterval(interval);
        //             reverse = false;
        //             video.play();
        //         } else {
        //             video.currentTime -= 0.1; // تقليل الوقت لجعل الفيديو يرجع للخلف
        //         }
        //     }, 100);
        // }

        // video.addEventListener("ended", function () {
        //     if (!reverse) {
        //         reverse = true;
        //         playReverse();
        //     } else {
        //         video.currentTime = 0;
        //         video.play();
        //         reverse = false;
        //     }
        // });



    </script>
    
    
</body>
</html>