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
        .speech-box {
            position: relative;
            max-width: 700px;
            margin: 100px auto;
            padding: 25px 30px;
            background-color: rgb(27 0 21);
            border: 5px solid;
            border-image: linear-gradient(45deg, #e567e5, #910389) 1;
            border-radius: 10px;
            color: #ffffff;
            font-size: 1rem;
            line-height: 1.7;
            /* box-shadow: 0 0 25px rgba(208, 46, 255, 0.5); */
            backdrop-filter: blur(6px);
            }

            .timeline-container {
            position: relative;
            background: url('your-background.jpg') center/cover no-repeat;
            padding: 60px 20px;
            /* overflow: hidden; */
            color: #fff;
            font-family: sans-serif;
            width: calc(90% - 45px);
            margin: auto;
        }

        .timeline-line {
            position: absolute;
            top: 50%;
            left: 5%;
            right: 5%;
            height: 2px;
            background: linear-gradient(to right, #910389, #F277F4);
            z-index: 0;
            /* width: calc(90% - 45px); */
            display: flex;
            justify-content: space-around;
        }

        .timeline-row {
            display: flex;
            justify-content: space-evenly;
            gap: 20px;
            position: relative;
            z-index: 1;
            /* flex-wrap: wrap; */
        }

        .timeline-row.top {
            margin-bottom: 160px;
        }

        .timeline-card {
            background: rgb(27 0 21);
            border: 2px solid;
            border-image: linear-gradient(to bottom, #910389, #F277F4) 1;
            padding: 20px;
            width: 250px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(242, 119, 244, 0.3);
        }

        .timeline-card h4 {
            margin: 0 0 10px;
            font-size: 16px;
            color: #F277F4;
        }

        .timeline-card h4 span {
            color: white;
            font-weight: normal;
        }

        .timeline-card p {
            font-size: 14px;
            line-height: 1.4;
        }

        @media (max-width: 768px) {
            .timeline-row {
            flex-direction: column;
            align-items: center;
            }
            .timeline-container{
                width: calc(64% - 45px);
            }

            .timeline-card {
            width: 90%;
            margin-bottom: 20px;
            }

            .timeline-line{
                display: none;
            }
        }

        @media (max-width: 835px){
            .speech-box{
                width: 80%;
            }
        }
        @media (max-width: 642px){
            .speech-box{
                width: 70%;
            }
        }
        @media (max-width: 398px){
            .Founder{
                width: 70%;
            }
        }
        .connector {
            width: 2px;
            height: 41px;
            background: linear-gradient(to bottom, #910389, #F277F4);
            margin: auto;
        }
        .up {
            transform: translatey(-100%);
        }

        .down {
            transform: translatey(-100%);
        }

        .About_Us{
            width: 100% - 20px;
            /* height: 500px; */
            /* background-color: rgba(127, 255, 212, 0.226); */
            padding: 20px;
            display: flex;
            justify-content: space-around;
            margin-top: 69px;
            flex-wrap: wrap;
            font-family: Inter;
            font-weight: 100;

        }


        .About_box{
            max-width: 700px;
            background-color: rgba(27, 0, 21, 1);
            text-align: center;
            border: solid 3px  #910389;
            border-radius: 10px;
            padding: 20px;
            margin-top: 50px;
            font-family: Inter;
        }






        .Founder{
            width: 300px;
            background-color: rgba(27, 0, 21, 1);
            text-align: center;
            border: solid 3px  #910389;
            border-radius: 10px;
            padding: 20px;
            margin-top: 50px;
            font-family: Inter;
            margin-top: 177px;
        }



        .Founders{
            width: 100%;
            background-color: rgba(27, 0, 21, 1);
            text-align: center;
            border-top: solid 3px  #910389;
            border-bottom: solid 3px  #910389;
            border-radius: 10px;
            padding: 62px 0;
            margin-top: 50px;
            font-family: Inter;
        }


        .ser_box a,h2{
            /* color: linear-gradient(135deg, #910389,#f277f4 ); */
            font-weight: bold;
            background: linear-gradient(135deg, rgba(145, 3, 137, 1),rgba(242, 119, 244, 1) );
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }



        .box_h{
            max-width: 175px;
            margin: auto;
            background-color: rgba(27, 0, 21, 1);
            text-align: center;
            border: solid 3px  #910389;
            border-radius: 17px;
            /* padding: 10px; */
            margin-top: -69px;
            font-family: Inter;
            /* transform: translatey(-71px); */
        }

        .h1{
            margin: 30px;
            font-weight: bold;
        }





        .box_Founders{
            width: 175px;
            height: 175px;
            margin: auto;
            background-color: rgba(27, 0, 21, 1);
            text-align: center;
            border: solid 3px  #910389;
            border-radius: 17px;
            /* padding: 10px; */
            margin-top: -113px;
            margin-bottom: 50px;
            font-family: Inter;
            transform: rotate(45deg);
            background-color: white;
            overflow: hidden;
            /* background-image: url(../img/ezz\ \(2\).png);
            background-size: cover; */
        }


        .line{
            margin: auto;
            width: 150px;
            height: 3px;
            background: linear-gradient(135deg, rgba(145, 3, 137, 1),rgba(242, 119, 244, 1) );
        }





        .Founders_s{
            width: 100%;
            margin-top: 162px;
            margin-bottom: 162px;
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
                EgySyr Vision Technology Solutions
            </h1>
            <p><span style="background: linear-gradient(308deg, rgba(145, 3, 137, 1), rgba(242, 119, 244, 1));background-clip: text;color: #00000000;">Comprehensive tech solutions to elevate your business </span>💡</p>
            <p id="about">
                EgySyr V.T.S – Innovating the Future
                At EgySyr Technology, we harness innovation to drive progress and transform 
                businesses. Our expert team delivers cutting-edge, tailored solutions that merge 
                creativity with technical excellence. Through successful projects and strategic 
                partnerships, we streamline operations, enhance industries, and fuel sustainable 
                growth. Every challenge is an opportunity for breakthrough solutions.
                Join us in 
                shaping a smarter, more connected world.
            </p>
            
        </div>
        <div class="img_Home" data-aos="fade-left">
            <svg xmlns="http://www.w3.org/2000/svg" width="191" height="191" viewBox="0 0 191 191" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M95.4998 0C42.757 0 0 42.7565 0 95.4998C0 148.243 42.757 191 95.4998 191C148.243 191 191 148.243 191 95.4998C191 42.7565 148.243 0 95.4998 0ZM95.4998 171.9C53.3731 171.9 19.1001 137.627 19.1001 95.4998C19.1001 53.3727 53.3727 19.1001 95.4998 19.1001C137.627 19.1001 171.9 53.3727 171.9 95.4998C171.9 137.627 137.627 171.9 95.4998 171.9ZM107.458 57.3C107.458 64.2243 102.417 69.2376 95.5969 69.2376C88.5011 69.2376 83.5832 64.2238 83.5832 57.1674C83.5832 50.3855 88.6341 45.3628 95.5969 45.3628C102.417 45.3628 107.458 50.3855 107.458 57.3ZM85.971 85.9499H105.071V143.25H85.971V85.9499Z" fill="url(#paint0_linear_901_101)"/>
                <defs>
                <linearGradient id="paint0_linear_901_101" x1="95.5" y1="0" x2="95.5" y2="191" gradientUnits="userSpaceOnUse">
                <stop stop-color="#910389"/>
                <stop offset="1" stop-color="#F277F4"/>
                </linearGradient>
                </defs>
            </svg>
        </div>
    </section>
    <section class="container">
        <!-- ---------------------------- -->
        <section class="all">
        
        
            <section class="vision">
                <div data-aos="zoom-in-down" class="Choose_box_h aos-init aos-animate">
                    <h1>Our vision & Mission</h1>
                </div>
                <div data-aos="zoom-in-right" class="speech-box">
                    We strive to become the global leader in providing technology and artificial intelligence solutions, while excelling in local and regional markets. Our focus is on delivering high-quality, innovative, and reliable services that support small and medium-sized businesses. We are here to simplify life and contribute to a smarter, more advanced society by offering fast, secure, and competitively priced solutions that effectively meet our clients’ needs and ensure their satisfaction — which remains at the heart of our success
                    <div style="width: 30px;height: 30px;transform: translateY(47px);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="67" height="80" viewBox="0 0 67 80" fill="none">
                            <path d="M7 75L60.9998 7.00007L23 2L7 75Z" fill="#1D0016"/>
                            <path d="M60.9998 7.00007L7 75L23 2" stroke="#E467E5" stroke-width="5px"/>
                        </svg>
                    </div>
                </div>
                
            </section>

            <section class="Goals">
                <div data-aos="zoom-in-down" class="Choose_box_h aos-init aos-animate">
                    <h1>Our Goals</h1>
                </div>


                <div class="timeline-container">
                    <div class="timeline-line">
                        <div style="width: 100%;height: 2px;">
                            <div class="connector down"></div>
                            <div class="connector up"></div>
                        </div>
                        <div style="width: 100%;height: 2px;">
                            <div class="connector down"></div>
                            <div class="connector up"></div>
                        </div>
                        <div style="width: 100%;height: 2px;">
                            <div class="connector down"></div>
                            <div class="connector up"></div>
                        </div>
                        <div data-aos="zoom-in" style="right: -86px;position: absolute;top: -38px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="76" height="76" viewBox="0 0 76 76" fill="none">
                                <path d="M74.1104 26.2383C76.7528 34.359 76.5837 43.1334 73.6301 51.1462C70.6766 59.1589 65.1109 65.9429 57.8309 70.4038C50.5508 74.8647 41.9807 76.7424 33.5031 75.7342C25.0254 74.7259 17.1344 70.8904 11.1029 64.8464C5.07133 58.8023 1.25094 50.9021 0.257909 42.42C-0.735122 33.9378 1.1571 25.3684 5.62937 18.0938C10.1016 10.8193 16.8932 5.26375 24.9086 2.32337C32.924 -0.617005 41.6959 -0.77081 49.8093 1.88677L44.837 6.86064C44.5648 7.133 44.3146 7.42596 44.0867 7.7395C37.5904 6.42786 30.8445 7.24244 24.8468 10.0628C18.8492 12.8831 13.9181 17.5594 10.7829 23.4001C7.64771 29.2408 6.47489 35.9357 7.43788 42.4948C8.40087 49.0539 11.4485 55.1288 16.1302 59.8211C20.8118 64.5134 26.8788 67.574 33.4339 68.5502C39.9889 69.5263 46.6841 68.3663 52.529 65.2416C58.374 62.1169 63.0585 57.1934 65.8897 51.1994C68.7209 45.2053 69.5485 38.4589 68.25 31.958C68.5749 31.7274 68.8799 31.47 69.1618 31.1884L74.1104 26.2383ZM61.2641 33.2739C61.5807 34.8131 61.739 36.3966 61.739 38.0245C61.7376 42.9264 60.2202 47.7078 57.3948 51.7129C54.5695 55.7179 50.5746 58.7505 45.9581 60.3947C41.3417 62.0388 36.3298 62.214 31.6099 60.8962C26.89 59.5784 22.6932 56.8321 19.5953 53.034C16.4974 49.236 14.65 44.5722 14.3066 39.6823C13.9632 34.7925 15.1405 29.9162 17.6772 25.7221C20.2138 21.5281 23.9854 18.2218 28.4748 16.2568C32.9641 14.2918 37.9513 13.7643 42.7522 14.7466V22.091C39.2078 21.0326 35.4116 21.1871 31.9649 22.53C28.5181 23.8729 25.6176 26.3276 23.7226 29.5053C21.8276 32.6831 21.0464 36.4023 21.5027 40.0743C21.959 43.7462 23.6266 47.161 26.2417 49.7779C28.8567 52.3949 32.2697 54.0646 35.9402 54.5225C39.6108 54.9805 43.3292 54.2006 46.5067 52.3064C49.6843 50.4122 52.1394 47.5118 53.4834 44.0645C54.8273 40.6172 54.9834 36.8199 53.9268 33.2739H61.2641ZM37.9936 45.1504C39.0861 45.151 40.1641 44.9002 41.1442 44.4174C42.1243 43.9347 42.9803 43.2329 43.6459 42.3663C44.3116 41.4998 44.7691 40.4917 44.983 39.4201C45.197 38.3484 45.1617 37.2419 44.8798 36.186L52.3928 28.6658L52.5353 28.5233H64.1231C64.4351 28.5239 64.7442 28.4629 65.0326 28.3439C65.3211 28.2249 65.5833 28.0502 65.8042 27.8297L75.3024 18.3286C75.6353 17.9964 75.8622 17.5727 75.9541 17.1114C76.0461 16.6501 75.9991 16.1718 75.819 15.7373C75.6389 15.3027 75.3339 14.9315 74.9427 14.6705C74.5514 14.4096 74.0915 14.2707 73.6212 14.2716H61.7485V2.39508C61.7484 1.92565 61.6093 1.46678 61.3486 1.0764C61.088 0.686024 60.7176 0.381649 60.2842 0.201713C59.8507 0.0217772 59.3737 -0.0256527 58.9133 0.0654127C58.453 0.156478 58.0299 0.381955 57.6976 0.713373L48.1994 10.2146C47.9782 10.4352 47.8026 10.6973 47.6828 10.9858C47.563 11.2744 47.5013 11.5838 47.5013 11.8963V23.4877L47.3588 23.6302L39.8458 31.1409C38.7893 30.8564 37.6816 30.819 36.6084 31.0318C35.5353 31.2447 34.5255 31.7019 33.6575 32.368C32.7895 33.0342 32.0865 33.8914 31.6031 34.8731C31.1197 35.8549 30.8689 36.9349 30.87 38.0293C30.87 39.9192 31.6205 41.7317 32.9565 43.068C34.2924 44.4044 36.1043 45.1551 37.9936 45.1551" fill="url(#paint0_linear_648_668)"/>
                                <defs>
                                <linearGradient id="paint0_linear_648_668" x1="38" y1="0" x2="38" y2="76" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#F277F4"/>
                                <stop offset="1" stop-color="#910389"/>
                                </linearGradient>
                                </defs>
                            </svg>
                        </div>
                    </div>
                    
                
                    <div class="timeline-row top">
                        <div data-aos="zoom-in" class="timeline-card">
                            <!-- <div style="width: 100%;height: 2px;">
                                <div class="connector up"></div>
                            </div> -->
                            <h4>#2025 <span>Establishment & launch</span></h4>
                            <p>EgySyr officially launched as a leading provider of technology solutions, specializing in website and application development, digital marketing, and administrative system solutions.</p>
                            
                        </div>
                
                        <div data-aos="zoom-in" class="timeline-card">
                            <!-- <div style="width: 100%;height: 2px;">
                                <div class="connector up"></div>
                            </div> -->
                            <h4>#2026 <span>Egyptian market expansion</span></h4>
                            <p>EgySyr expands its presence in the Egyptian market, strengthening its position by offering innovative digital solutions and enhancing partnerships with local businesses.</p>
                            
                        </div>    
                
                        <div data-aos="zoom-in" class="timeline-card">
                            <!-- <div style="width: 100%;height: 2px;">
                                <div class="connector up"></div>
                            </div> -->
                            <h4>#2027 <span>Gulf market expansion</span></h4>
                            <p>EgySyr expands into the Gulf market, targeting Saudi Arabia and the UAE with tailored digital solutions and strategic partnerships.</p>
                            
                        </div>
                    </div>
                
                    <div class="timeline-row bottom">
                        <div data-aos="zoom-in" class="timeline-card">
                            <!-- <div style="width: 100%;height: 2px;">
                                <div class="connector down"></div>
                            </div> -->
                            <h4>#2028 <span>Worldwide spread</span></h4>
                            <p>EgySyr expands globally, offering cutting-edge digital solutions to businesses worldwide and establishing an international presence</p>
                        </div>
                
                        <div data-aos="zoom-in" class="timeline-card">
                            <!-- <div style="width: 100%;height: 2px;">
                                <div class="connector down"></div>
                            </div> -->
                            <h4>#2029 <span>First robot launched</span></h4>
                            <p>Its first robot will be unveiled, marking a milestone in automation and AI solutions, revolutionizing business efficiency and technological advancement.</p>
                        </div>
                
                        <div data-aos="zoom-in" class="timeline-card">
                            <!-- <div style="width: 100%;height: 2px;">
                                <div class="connector down"></div>
                            </div> -->
                            <h4>#2030 <span>Leading the tech market</span></h4>
                            <p>Code reviews before release help detect issues like memory leaks, file leaks, performance signs, and general bad smells</p>
                        </div>
                    </div>
                </div>

            </section>

            <section class="Founders_s">
                <div class="Founders">
                    <div data-aos="fade-down" class="">
                        <img src="{{ asset('images/logo.webp') }}" alt="">
                        <h2>Founders of EgySyr</h2>
                    </div>
                    
                    <p data-aos="fade-down" style="max-width: 859px; margin: auto; padding: 20px;">
                        The founders of EgySyr, with extensive IT expertise, lead with strategic vision and a passion for innovation. They excel in website programming, app development, and efficient business system design. United by professionalism, they are committed to delivering innovative and reliable solutions at EgySyr, meeting the aspirations of our clients with seriousness and high-quality technological services
                    </p>
    
                    <div style="display: flex; flex-wrap: wrap; justify-content: space-around;">
    
                        <div data-aos="fade-right" class="Founder">
                            <div class="box_Founders">
                                <img style="width: 100%; transform: rotate(-45deg) scale(1.4); " src="{{ asset('images/ezz (2).webp') }}" alt="">
                            </div>
                            
                            <h2>Ahmed Ezz</h2>
                            <div class="line"></div>
                            <p>
                                Founder & Chairman of the Board, EgySyr Technology Ahmed Ezz is an expert in programming and website design. As Chairman of EgySyr, he combines technical skills and strategy to deliver innovative solutions that drive growth and client satisfaction.
                            </p>
                        </div>
    
    
    
                        <div data-aos="fade-left" class="Founder">
                            <div class="box_Founders">
                                <img style="width: 100%; transform: rotate(-45deg) scale(1.4); " src="{{ asset('images/naiem.webp') }}" alt="">
                            </div>
                            
                            <h2>Naiem Shamyeh</h2>
                            <div class="line"></div>
                            <p>
                                Founder & CEO, EgySyr Technology Naiem Shamyeh is a leader with expertise in business management, marketing, and software development. As CEO of EgySyr, he drives growth through innovative, high-quality solutions that meet client needs with professionalism.
                            </p>
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