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
        .why-choose-us {
            text-align: center;
        }
        .Projects{
            padding: 50px 20px;
        }
        .heading h2 {
            font-size: 2em;
            color: #ff00ff;
        }
        .heading span {
            color: white;
        }
        .carousel-container {
            width: 100%;
            overflow: hidden;
            position: relative;
            display: flex;
            justify-content: flex-end;
            margin-bottom: 100px;
        }
        .carousel {
            display: flex;
            gap: 40px;
            width: max-content;
            animation: scroll 10s linear infinite;
            flex-direction: row-reverse;
            padding: 20px;
        }
        .card {
            padding: 20px;
            border-radius: 10px;
            width: 192px;
            transition: transform 0.3s ease, background 0.3s ease;
            backdrop-filter: blur(10px);
            flex-shrink: 0;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .icon {
            font-size: 2em;
            margin-bottom: 10px;
        }
        @keyframes scroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(1390px);
            }
        }

        .project-card{
            max-width: 80%;
            background-color: rgba(27, 0, 21, 1);
            border: solid 3px #910389;
            border-radius: 17px;
            padding: 20px;
            font-family: Inter;
            display: flex;
            margin-bottom: 100px;
        }
        .projects-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }
        .project-card{
            max-width: 80%;
            background-color: rgba(27, 0, 21, 1);
            border: solid 3px #910389;
            border-radius: 17px;
            padding: 20px;
            font-family: Inter;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .project-card img {
            width: 200px;
            border-radius: 10px;
            border: solid 3px #910389;
        }
        .project-content {
            flex: 1;
            padding: 0 20px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }
        .details-button {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: rgba(145, 3, 137, 1);
            color: white;
            text-decoration: none;
            border-radius: 10px;
        }
        .left {
            align-self: flex-start;
        }
        
        .right {
            align-self: flex-end;
        }

        .details_div {
            display: flex;
            align-items: flex-end;
        }
        .right{
            justify-content: flex-end;
        }


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
        }

        .review {
            height: 100%;
            padding: 20px;
            box-sizing: border-box; 
            border-radius: 10px;
            text-align: center;
            overflow: hidden;
        }


        .box_h_2{
            display: flex; 
            align-items: center;
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



        .Services{
            width: 100% - 20px;
            padding: 20px;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }


        .ser_box{
            width: 300px;
            background-color: rgba(27, 0, 21, 1);
            text-align: center;
            border: solid 3px  #910389;
            border-radius: 10px;
            padding: 20px;
            margin-top: 50px;
            font-family: Inter;
        }


        .ser_box a,h2{
            font-weight: bold;
            background: linear-gradient(135deg, #910389,#f277f4 );
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
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
                Comprehensive tech solutions to elevate your business.
            </h1>
            <p id="about">
                From development and design to digital security and marketing.We advance your digital future with global standards.
            </p>
            <p>💡 <span style="background: linear-gradient(308deg, rgba(145, 3, 137, 1), rgba(242, 119, 244, 1));background-clip: text;color: #00000000;">Smart solutions, secure technology—partner with us today! </span> 🚀</p>
            
        </div>
        <div class="img_Home" data-aos="fade-left">
            <svg xmlns="http://www.w3.org/2000/svg" width="206" height="206" viewBox="0 0 206 206" fill="none">
                <path d="M125.335 120.855L139.754 95.8788C140.681 94.3307 140.269 92.3697 138.93 91.2345L123.687 79.2625C123.996 76.992 124.202 74.6182 124.202 72.2445C124.202 69.8707 123.996 67.497 123.687 65.1233L138.93 53.1513C140.269 52.016 140.681 50.0551 139.754 48.507L125.335 23.5311C124.408 21.983 122.554 21.3637 120.906 21.983L102.984 29.2074C99.2759 26.3176 95.2589 23.9439 90.83 22.0862L88.152 2.99299C87.9792 2.15827 87.5282 1.40728 86.8731 0.863379C86.2179 0.319478 85.3977 0.0150131 84.547 0H55.7073C53.9564 0 52.4114 1.34168 52.1024 3.09619L49.4244 22.1894C45.0985 24.0471 40.9785 26.4208 37.2705 29.3106L19.3487 22.0862C17.7008 21.4669 15.8468 22.0862 14.9198 23.6343L0.499941 48.6102C-0.427049 50.1583 -0.0150518 52.1192 1.32393 53.2545L16.5678 65.2265C16.2588 67.497 16.0528 69.8707 16.0528 72.2445C16.0528 74.6182 16.2588 76.992 16.5678 79.3657L1.32393 91.3377C-0.0150518 92.473 -0.427049 94.4339 0.499941 95.982L14.9198 120.958C15.8468 122.506 17.7008 123.125 19.3487 122.506L37.2705 115.282C40.9785 118.171 44.9955 120.545 49.4244 122.403L52.1024 141.496C52.4114 143.147 53.9564 144.489 55.7073 144.489H84.547C86.298 144.489 87.843 143.147 88.152 141.393L90.83 122.3C95.1559 120.442 99.2759 118.068 102.984 115.178L120.906 122.403C122.554 123.022 124.408 122.403 125.335 120.855ZM70.1272 92.8858C58.7973 92.8858 49.5274 83.5972 49.5274 72.2445C49.5274 60.8918 58.7973 51.6032 70.1272 51.6032C81.4571 51.6032 90.727 60.8918 90.727 72.2445C90.727 83.5972 81.4571 92.8858 70.1272 92.8858ZM205.159 172.045L195.271 164.408C195.477 162.963 195.683 161.415 195.683 159.867C195.683 158.319 195.58 156.771 195.271 155.326L205.056 147.688C205.88 146.966 206.189 145.727 205.571 144.695L196.301 128.698C195.786 127.666 194.55 127.357 193.417 127.666L181.984 132.311C179.615 130.453 177.04 128.905 174.156 127.77L172.405 115.591C172.364 115.04 172.12 114.523 171.721 114.141C171.321 113.76 170.794 113.541 170.242 113.527H151.805C150.672 113.527 149.642 114.353 149.539 115.488L147.788 127.666C145.007 128.905 142.329 130.35 139.96 132.207L128.528 127.563C128.003 127.365 127.425 127.36 126.897 127.549C126.369 127.738 125.925 128.109 125.644 128.595L116.374 144.592C115.859 145.624 115.962 146.863 116.889 147.585L126.674 155.222C126.256 158.235 126.256 161.292 126.674 164.305L116.889 171.942C116.065 172.664 115.756 173.903 116.374 174.935L125.644 190.932C126.159 191.964 127.395 192.274 128.528 191.964L139.96 187.32C142.329 189.177 144.904 190.725 147.788 191.861L149.539 204.039C149.745 205.174 150.672 206 151.805 206H170.242C171.375 206 172.405 205.174 172.508 204.039L174.259 191.861C177.04 190.622 179.718 189.177 181.984 187.32L193.52 191.964C194.55 192.377 195.786 191.964 196.404 190.932L205.674 174.935C206.292 174.006 205.983 172.768 205.159 172.045ZM160.972 173.696C159.146 173.696 157.337 173.335 155.649 172.633C153.962 171.932 152.429 170.905 151.138 169.61C149.847 168.316 148.823 166.779 148.124 165.087C147.426 163.396 147.067 161.584 147.067 159.753C147.068 157.923 147.429 156.111 148.128 154.42C148.828 152.729 149.853 151.193 151.145 149.899C152.437 148.605 153.971 147.579 155.659 146.879C157.347 146.18 159.156 145.82 160.983 145.82C164.672 145.822 168.209 147.291 170.817 149.906C173.425 152.521 174.889 156.067 174.887 159.764C174.886 163.46 173.419 167.005 170.81 169.618C168.2 172.231 164.661 173.698 160.972 173.696Z" fill="url(#paint0_linear_904_105)"/>
                <defs>
                <linearGradient id="paint0_linear_904_105" x1="103" y1="0" x2="103" y2="206" gradientUnits="userSpaceOnUse">
                <stop stop-color="#F277F4"/>
                <stop offset="1" stop-color="#910389"/>
                </linearGradient>
                </defs>
            </svg>
        </div>
    </section>
    <section class="container">
        <!-- ---------------------------- -->
        <section class="all">
        
        
        <section class="Projects">
            <div class="projects-container">
                
                <div data-aos="fade-right" class="project-card left">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="234" height="234" viewBox="0 0 234 234" fill="none">
                            <path d="M139.6 4H94.4C57.336 4 38.8153 4 25.6847 13.1982C20.8262 16.6003 16.6003 20.8262 13.1982 25.6847C4 38.804 4 57.336 4 94.4C4 131.464 4 149.985 13.1982 163.115C16.6003 167.974 20.8262 172.2 25.6847 175.602C38.804 184.8 57.336 184.8 94.4 184.8H139.6C176.664 184.8 195.185 184.8 208.315 175.602C213.174 172.2 217.4 167.974 220.802 163.115C230 149.996 230 131.464 230 94.4C230 57.336 230 38.8153 220.802 25.6847C217.4 20.8262 213.174 16.6003 208.315 13.1982C195.196 4 176.664 4 139.6 4Z" stroke="url(#paint0_linear_736_632)" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M162.2 71.8L176.065 83.7441C181.885 88.7726 184.8 91.2812 184.8 94.4C184.8 97.5188 181.885 100.027 176.065 105.056L162.2 117M71.8002 71.8L57.9351 83.7441C52.1156 88.7726 49.2002 91.2812 49.2002 94.4C49.2002 97.5188 52.1156 100.027 57.9351 105.056L71.8002 117M128.3 60.5L105.7 128.3M147.013 230L142.267 225.265C137.063 220.063 133.629 213.355 132.453 206.091C131.277 198.828 132.417 191.379 135.713 184.8M83.1002 230L87.8462 225.265C93.0501 220.063 96.4838 213.355 97.6602 206.091C98.8366 198.828 97.696 191.379 94.4002 184.8M60.5002 230H173.5" stroke="url(#paint1_linear_736_632)" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"/>
                            <defs>
                            <linearGradient id="paint0_linear_736_632" x1="117" y1="4" x2="117" y2="184.8" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#910389"/>
                            <stop offset="1" stop-color="#F277F4"/>
                            </linearGradient>
                            <linearGradient id="paint1_linear_736_632" x1="117" y1="60.5" x2="117" y2="230" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#910389"/>
                            <stop offset="1" stop-color="#F277F4"/>
                            </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <div class="project-content">
                        <div class="margin" style="width: fit-content;">
                            <div class="text_h">Website programming</div>
                            <div class="f_line" style="width: 100%;margin: 20px 0;"></div>
                        </div>
                        <div class="project-description">We transform your ideas into a professional, fast, and responsive website using the latest technologies to ensure top performance and a seamless user experience.</div>
                        <div class="details_div right">
                            <a href="service_web" class="details-button">More details ></a>
                        </div>
                    </div>
                </div>
                <div data-aos="fade-left" class="project-card right">
                    <div class="project-content">
                        <div class="margin" style="width: fit-content;">
                            <div class="text_h">Administrative systems programming</div>
                            <div class="f_line" style="width: 100%;margin: 20px 0;"></div>
                        </div>
                        <div class="project-description">We provide smart, tailor-made administrative systems that enhance productivity, automate processes, and save time and effort.</div>
                        <div class="details_div ">
                            <a href="service_system" class="details-button">More details ></a>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="218" height="194" viewBox="0 0 218 194" fill="none">
                            <path d="M216.936 138.136L203.736 143.316C204.588 147.514 204.588 151.645 203.736 155.708L216.936 160.888L211.72 172.975L198.521 167.693C197.314 169.386 195.966 170.977 194.476 172.467C192.985 173.957 191.282 175.277 189.366 176.428L194.901 189.023L182.234 194L176.806 181.405C174.677 181.812 172.512 182.015 170.312 182.015C168.113 182.015 165.948 181.812 163.819 181.405L158.391 194L145.724 189.023L151.259 176.428C147.64 174.058 144.588 171.147 142.104 167.693L128.905 172.975L123.689 160.888L136.889 155.708C136.037 151.577 136.037 147.447 136.889 143.316L123.689 138.136L128.905 126.049L142.104 131.331C144.588 127.877 147.64 124.966 151.259 122.596L145.724 110.001L158.391 105.024L163.819 117.619C168.219 116.806 172.548 116.806 176.806 117.619L182.234 105.024L194.901 110.001L189.366 122.596C191.14 123.747 192.808 125.034 194.369 126.455C195.93 127.877 197.314 129.503 198.521 131.331L211.72 126.049L216.936 138.136ZM178.083 167.49C180.709 166.474 182.944 165.052 184.789 163.224C186.634 161.396 188.089 159.297 189.153 156.927C190.218 154.557 190.715 152.119 190.644 149.614C190.573 147.108 190.076 144.603 189.153 142.097C188.16 139.66 186.705 137.527 184.789 135.698C182.873 133.87 180.638 132.482 178.083 131.534C175.599 130.518 173.009 130.01 170.312 130.01C167.545 130.01 164.955 130.518 162.542 131.534C159.987 132.482 157.752 133.87 155.836 135.698C153.92 137.527 152.465 139.66 151.472 142.097C149.272 147.04 149.272 151.984 151.472 156.927C152.465 159.364 153.92 161.497 155.836 163.326C157.752 165.154 159.987 166.542 162.542 167.49C167.722 169.589 172.903 169.589 178.083 167.49ZM218 0V91.0073H204.375V52.0042H13.625V156.013H109V169.014H0V0H218ZM204.375 39.0031V13.001H13.625V39.0031H204.375ZM95.375 130.01V115.791C93.1751 115.046 91.0462 113.895 88.9883 112.337L76.1084 119.346L69.2959 108.173L82.0693 101.063C81.8564 99.9794 81.75 98.7944 81.75 97.5079C81.75 96.289 81.8564 95.104 82.0693 93.9529L69.2959 86.8429L76.1084 75.6702L88.9883 82.6785C91.0462 81.1211 93.1751 79.97 95.375 79.2251V65.0052H109V79.2251C110.206 79.6314 111.306 80.1054 112.3 80.6471C113.293 81.1888 114.322 81.866 115.387 82.6785L128.267 75.6702L135.079 86.8429L122.306 93.9529C122.519 95.104 122.625 96.289 122.625 97.5079C122.625 98.7944 122.519 99.9794 122.306 101.063L135.079 108.173L128.267 119.346L115.387 112.337C114.393 113.082 113.4 113.725 112.406 114.267C111.413 114.809 110.277 115.317 109 115.791V130.01H95.375ZM91.9688 97.5079C91.9688 100.216 92.9622 102.519 94.9492 104.415C96.9362 106.311 99.349 107.259 102.188 107.259C105.026 107.259 107.439 106.311 109.426 104.415C111.413 102.519 112.406 100.216 112.406 97.5079C112.406 94.7993 111.413 92.497 109.426 90.601C107.439 88.7051 105.026 87.7571 102.188 87.7571C99.349 87.7571 96.9362 88.7051 94.9492 90.601C92.9622 92.497 91.9688 94.7993 91.9688 97.5079Z" fill="url(#paint0_linear_197_218)"/>
                            <defs>
                            <linearGradient id="paint0_linear_197_218" x1="109" y1="0" x2="109" y2="194" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#910389"/>
                            <stop offset="0.516667" stop-color="#F277F4"/>
                            </linearGradient>
                            </defs>
                        </svg>
                    </div>
                </div>
                <div data-aos="fade-right" class="project-card left right-2">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="148" height="205" viewBox="0 0 148 205" fill="none">
                            <path d="M7 64.3C7.09573 39.0498 8.03394 25.5366 16.8032 16.7888C26.6161 7 42.4123 7 74.0048 7C105.597 7 121.394 7 131.206 16.7888C139.976 25.5366 140.904 39.0403 141 64.3M7 140.7C7.09573 165.95 8.03394 179.463 16.8032 188.211C26.6161 198 42.4123 198 74.0048 198C105.597 198 121.394 198 131.206 188.211C139.976 179.463 140.904 165.96 141 140.7M64.4409 169.35H83.5878M112.308 83.4L124.055 93.4944C128.985 97.7441 131.455 99.8642 131.455 102.5C131.455 105.136 128.985 107.256 124.055 111.506L112.308 121.6M35.7204 83.4L23.9738 93.4944C19.0434 97.7441 16.5735 99.8642 16.5735 102.5C16.5735 105.136 19.0434 107.256 23.9738 111.506L35.7204 121.6M83.5878 73.85L64.4409 131.15" stroke="url(#paint0_linear_667_636)" stroke-width="13" stroke-linecap="round" stroke-linejoin="round"/>
                            <defs>
                            <linearGradient id="paint0_linear_667_636" x1="7" y1="7" x2="140.587" y2="198.308" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#F277F4"/>
                            <stop offset="1" stop-color="#910389"/>
                            </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <div class="project-content">
                        <div class="margin" style="width: fit-content;">
                            <div class="text_h">Application programming</div>
                            <div class="f_line" style="width: 100%;margin: 20px 0;"></div>
                        </div>
                        <div class="project-description">We develop modern and fast mobile applications for iOS and Android with an attractive interface and exceptional user experience, helping you reach your customers with ease.</div>
                        <div class="details_div right">
                            <a href="service_Application" class="details-button">More details ></a>
                        </div>
                    </div>
                </div>
                <div data-aos="fade-left" class="project-card right">
                    <div class="project-content">
                        <div class="margin" style="width: fit-content;">
                            <div class="text_h">Hosting & Domains</div>
                            <div class="f_line" style="width: 100%;margin: 20px 0;"></div>
                        </div>
                        <div class="project-description">Get secure and fast hosting for your website with a unique domain that reflects your brand, along with continuous technical support to ensure your website’s stability.</div>
                        <div class="details_div ">
                            <a href="service_Hosting" class="details-button">More details ></a>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="164" height="189" viewBox="0 0 164 189" fill="none">
                            <path d="M9.11111 0H154.889C157.305 0 159.623 0.905111 161.331 2.51622C163.04 4.12733 164 6.31246 164 8.59091V42.9545C164 45.233 163.04 47.4181 161.331 49.0292C159.623 50.6403 157.305 51.5455 154.889 51.5455H9.11111C6.69469 51.5455 4.37725 50.6403 2.66858 49.0292C0.959918 47.4181 0 45.233 0 42.9545V8.59091C0 6.31246 0.959918 4.12733 2.66858 2.51622C4.37725 0.905111 6.69469 0 9.11111 0ZM9.11111 68.7273H154.889C157.305 68.7273 159.623 69.6324 161.331 71.2435C163.04 72.8546 164 75.0397 164 77.3182V111.682C164 113.96 163.04 116.145 161.331 117.757C159.623 119.368 157.305 120.273 154.889 120.273H9.11111C6.69469 120.273 4.37725 119.368 2.66858 117.757C0.959918 116.145 0 113.96 0 111.682V77.3182C0 75.0397 0.959918 72.8546 2.66858 71.2435C4.37725 69.6324 6.69469 68.7273 9.11111 68.7273ZM9.11111 137.455H154.889C157.305 137.455 159.623 138.36 161.331 139.971C163.04 141.582 164 143.767 164 146.045V180.409C164 182.688 163.04 184.873 161.331 186.484C159.623 188.095 157.305 189 154.889 189H9.11111C6.69469 189 4.37725 188.095 2.66858 186.484C0.959918 184.873 0 182.688 0 180.409V146.045C0 143.767 0.959918 141.582 2.66858 139.971C4.37725 138.36 6.69469 137.455 9.11111 137.455ZM54.6667 34.3636H63.7778V17.1818H54.6667V34.3636ZM54.6667 103.091H63.7778V85.9091H54.6667V103.091ZM54.6667 171.818H63.7778V154.636H54.6667V171.818ZM18.2222 17.1818V34.3636H36.4444V17.1818H18.2222ZM18.2222 85.9091V103.091H36.4444V85.9091H18.2222ZM18.2222 154.636V171.818H36.4444V154.636H18.2222Z" fill="url(#paint0_linear_197_216)"/>
                            <defs>
                            <linearGradient id="paint0_linear_197_216" x1="82" y1="0" x2="82" y2="189" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#910389"/>
                            <stop offset="0.560434" stop-color="#F277F4"/>
                            </linearGradient>
                            </defs>
                        </svg>
                    </div>
                </div>
                <div data-aos="fade-right" class="project-card left">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="269" height="203" viewBox="0 0 269 203" fill="none">
                            <path d="M101.541 123.847V197H6M262.622 89.3241L236.27 82.2639L208.964 131.446L248.501 142.04L262.622 89.3241Z" stroke="url(#paint0_linear_736_628)" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M236.271 82.2634L208.964 131.446L197.081 149.448L6 98.246L30.714 6L248.16 64.2617L236.271 82.2634Z" stroke="url(#paint1_linear_736_628)" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
                            <defs>
                            <linearGradient id="paint0_linear_736_628" x1="134.311" y1="82.2639" x2="134.311" y2="197" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#F277F4"/>
                            <stop offset="1" stop-color="#910389"/>
                            </linearGradient>
                            <linearGradient id="paint1_linear_736_628" x1="127.08" y1="6" x2="127.08" y2="149.448" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#F277F4"/>
                            <stop offset="1" stop-color="#910389"/>
                            </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <div class="project-content">
                        <div class="margin" style="width: fit-content;">
                            <div class="text_h">Surveillance Cameras</div>
                            <div class="f_line" style="width: 100%;margin: 20px 0;"></div>
                        </div>
                        <div class="project-description">We provide comprehensive surveillance solutions with the latest high-definition security cameras, offering remote monitoring via mobile devices to ensure the safety of your business and property 24/7.</div>
                        <div class="details_div right">
                            <a href="service_protection_systems" class="details-button">More details ></a>
                        </div>
                    </div>
                </div>
                <div data-aos="fade-left" class="project-card right">
                    <div class="project-content">
                        <div class="margin" style="width: fit-content;">
                            <div class="text_h">Graphic Design</div>
                            <div class="f_line" style="width: 100%;margin: 20px 0;"></div>
                        </div>
                        <div class="project-description">We create innovative and professional designs that represent your brand, from logos and brochures to visually appealing content that strengthens your brand identity.</div>
                        <div class="details_div ">
                            <a href="service_Graphic" class="details-button">More details ></a>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="212" height="212" viewBox="0 0 212 212" fill="none">
                            <path d="M42.4143 7.95548C42.4157 6.45719 41.9936 4.98899 41.1964 3.72024C40.3993 2.45148 39.2597 1.43384 37.9091 0.784691C36.5584 0.13554 35.0518 -0.118683 33.5628 0.0513457C32.0739 0.221374 30.6634 0.808728 29.494 1.74566C15.6091 12.8619 8.05196 22.6005 4.0773 31.0781C1.21522 37.0871 -0.17622 43.6906 0.0178407 50.3433C0.0178407 60.3681 5.07362 69.2059 12.7792 74.4514C10.6609 76.2399 8.84926 78.3625 7.41602 80.7354C2.37084 88.8951 0.0178407 101.368 0.0178407 119.277C0.0178407 137.419 2.45564 159.206 6.4303 176.606C8.40174 185.253 10.8501 193.233 13.7649 199.22C15.217 202.198 16.987 205.101 19.1704 207.38C21.3538 209.616 24.7138 212 29.1654 212C33.617 212 36.9769 209.616 39.1497 207.38C41.3621 204.955 43.1855 202.203 44.5553 199.22C47.4807 193.222 49.929 185.253 51.9005 176.596C56.0385 157.763 58.1878 138.548 58.3129 119.266C58.3129 101.357 55.9599 88.8951 50.9148 80.7354C49.4815 78.3625 47.6699 76.2399 45.5516 74.4514C49.4843 71.7786 52.7032 68.1844 54.9276 63.9823C57.1519 59.7801 58.3142 55.0977 58.3129 50.3433C58.3129 40.52 53.6917 33.6637 50.1728 28.4288L49.8654 27.9731C45.7318 21.8163 42.4143 16.751 42.4143 7.95548ZM15.9165 50.3433C15.9165 47.1854 15.9165 43.2858 18.4815 37.8283C20.2621 34.0028 23.4525 29.1494 29.2078 23.2999C31.2534 28.7785 34.1152 33.0491 36.5424 36.6521L36.6696 36.8428C40.4534 42.4698 42.4143 45.6913 42.4143 50.3433C42.4143 53.8564 41.0184 57.2257 38.5338 59.7098C36.0491 62.194 32.6792 63.5895 29.1654 63.5895C25.6516 63.5895 22.2817 62.194 19.797 59.7098C17.3124 57.2257 15.9165 53.8564 15.9165 50.3433ZM15.9165 119.277C15.9165 102.078 18.3119 93.3458 20.9405 89.0858C21.7402 87.657 22.9366 86.4903 24.3852 85.7266C25.8881 85.0635 27.5245 84.7588 29.1654 84.8364C31.2852 84.8364 32.8009 85.165 33.9456 85.7266C35.0055 86.2352 36.1926 87.1572 37.3903 89.0858C40.0189 93.3458 42.4143 102.078 42.4143 119.277C42.4143 136.242 40.1037 156.843 36.4046 173.067C34.5391 181.226 32.4193 187.85 30.2677 192.258C29.9258 192.96 29.5581 193.649 29.1654 194.324C28.7727 193.649 28.405 192.96 28.0631 192.258C25.9115 187.85 23.7916 181.216 21.9262 173.067C18.0616 155.394 16.0475 137.367 15.9165 119.277ZM68.7425 127.987C73.8435 130.229 79.2662 131.652 84.8107 132.205V108.627C84.8107 104.104 85.7017 99.6254 87.4328 95.447C89.164 91.2685 91.7013 87.4718 94.9 84.2738C98.0987 81.0757 101.896 78.5389 106.075 76.8081C110.255 75.0773 114.734 74.1865 119.258 74.1865H142.841C141.97 65.5126 138.973 57.1875 134.114 49.9492C129.255 42.7108 122.685 36.783 114.986 32.6911C107.287 28.5992 98.6968 26.4698 89.9776 26.4916C81.2585 26.5134 72.6794 28.6857 65.001 32.816C63.3512 29.3368 61.4081 26.0043 59.1927 22.8548L58.6627 22.0706L56.7655 19.1883C66.8626 13.6044 78.2008 10.6456 89.7395 10.5834C101.278 10.5211 112.648 13.3574 122.804 18.8319C132.961 24.3065 141.58 32.2439 147.87 41.9157C154.16 51.5875 157.919 62.6839 158.803 74.1865H177.553C182.077 74.1865 186.556 75.0773 190.735 76.8081C194.915 78.5389 198.712 81.0757 201.911 84.2738C205.109 87.4718 207.647 91.2685 209.378 95.447C211.109 99.6254 212 104.104 212 108.627V166.91C212 171.433 211.109 175.911 209.378 180.09C207.647 184.268 205.109 188.065 201.911 191.263C198.712 194.461 194.915 196.998 190.735 198.728C186.556 200.459 182.077 201.35 177.553 201.35H119.258C110.122 201.35 101.36 197.722 94.9 191.263C88.4399 184.804 84.8107 176.044 84.8107 166.91V148.164C78.9557 147.717 73.1819 146.524 67.6296 144.614C68.1595 138.998 68.5411 133.402 68.7425 127.987ZM177.553 90.0819H158.199C155.945 104.517 149.163 117.864 138.83 128.194C128.497 138.525 115.148 145.307 100.709 147.56V166.91C100.709 177.147 109.019 185.455 119.258 185.455H177.553C182.472 185.455 187.19 183.501 190.669 180.023C194.147 176.545 196.101 171.828 196.101 166.91V108.627C196.101 103.708 194.147 98.9914 190.669 95.5136C187.19 92.0358 182.472 90.0819 177.553 90.0819ZM100.709 131.41C110.888 129.321 120.23 124.291 127.578 116.945C134.926 109.599 139.956 100.259 142.046 90.0819H119.258C114.338 90.0819 109.621 92.0358 106.142 95.5136C102.664 98.9914 100.709 103.708 100.709 108.627V131.41Z" fill="url(#paint0_linear_667_634)"/>
                            <defs>
                            <linearGradient id="paint0_linear_667_634" x1="106" y1="0" x2="106" y2="212" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#F277F4"/>
                            <stop offset="1" stop-color="#910389"/>
                            </linearGradient>
                            </defs>
                        </svg>
                    </div>
                </div>
                <div data-aos="fade-right" class="project-card left">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="253" height="167" viewBox="0 0 253 167" fill="none">
                            <path d="M224.207 2.73968C221.502 1.21982 218.409 0.30034 215.199 0.0620573C211.989 -0.176226 208.761 0.273989 205.799 1.37313L108.721 34.5805C106.422 35.3929 103.965 35.8106 101.483 35.8104H39.3346C34.1185 35.8104 29.116 37.6101 25.4277 40.8136C21.7394 44.0171 19.6673 48.362 19.6673 52.8924V54.2589H0V95.2557H19.6673V97.0322C19.7905 101.491 21.9169 105.731 25.592 108.847C29.267 111.962 34.1992 113.706 39.3346 113.704L62.9353 157.161C64.5334 160.087 67.0494 162.563 70.1943 164.303C73.3392 166.044 76.9856 166.978 80.7146 167H90.6269C95.8156 166.964 100.778 165.148 104.432 161.949C108.087 158.749 110.137 154.425 110.137 149.918V115.344L205.799 148.551C208.151 149.365 210.661 149.782 213.193 149.781C217.122 149.726 220.948 148.682 224.207 146.775C226.795 145.257 228.93 143.226 230.434 140.85C231.939 138.474 232.771 135.82 232.861 133.109V16.8152C232.846 14.0345 232.05 11.2989 230.542 8.84593C229.034 6.39298 226.86 4.29688 224.207 2.73968ZM90.4695 52.8924V97.0322H39.3346V52.8924H90.4695ZM90.4695 149.918H80.5572L61.2046 113.704H90.4695V149.918ZM115.958 99.082C114.09 98.2529 112.142 97.567 110.137 97.0322V51.9358C112.123 51.5798 114.071 51.0769 115.958 50.4326L213.193 16.8152V132.699L115.958 99.082ZM233.333 57.6753V91.8393C238.549 91.8393 243.551 90.0396 247.24 86.8361C250.928 83.6326 253 79.2877 253 74.7573C253 70.2269 250.928 65.882 247.24 62.6785C243.551 59.475 238.549 57.6753 233.333 57.6753Z" fill="url(#paint0_linear_197_220)"/>
                            <defs>
                            <linearGradient id="paint0_linear_197_220" x1="126.5" y1="0" x2="126.5" y2="167" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#910389"/>
                            <stop offset="0.59928" stop-color="#F277F4"/>
                            </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <div class="project-content">
                        <div class="margin" style="width: fit-content;">
                            <div class="text_h">Digital Marketing</div>
                            <div class="f_line" style="width: 100%;margin: 20px 0;"></div>
                        </div>
                        <div class="project-description">We enhance your digital presence with comprehensive marketing strategies, including SEO, paid advertising management, and social media marketing.</div>
                        <div class="details_div right">
                            <a href="service_Marketing" class="details-button">More details ></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        </section>
    
    
        <!-- ---------------------------- -->
    </section>






    <!-- ----------footer---------- -->
    @include('layouts.footer')

    <!-- <script src="../splide.min.js"></script> -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
         AOS.init({
            duration: 1000, // مدة الحركة 1 ثانية
            // once: true, // الحركة تشتغل مرة واحدة بس
        });
        
    </script>
    
    
    <script src="../js/all.min.js"></script>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <script src="../js/index.js"></script>
</body>
</html>