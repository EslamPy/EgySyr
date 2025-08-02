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
        @media (min-width: 320px) and (max-width: 850px) {
            
            .contact-form{
                margin: auto;
                max-width: 70%;
            }
            .services-box{
                max-width: 70%;
            }
        }
        .Connect{
            padding: 100px 0;
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
            margin: auto;
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
        text-align: right;
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
                Support & Inquiry
            </h1>
            <p><span style="background: linear-gradient(308deg, rgba(145, 3, 137, 1), rgba(242, 119, 244, 1));background-clip: text;color: #00000000;">Need Assistance? Contact EgySyr ! </span>💡</p>
            <p id="about">
                We’re here to answer your inquiries and provide the support you need. Reach out to us through our available communication channels, and our team will respond promptly to ensure a smooth experience. Your satisfaction is our priority!
            </p>
            
        </div>
        <div class="img_Home" data-aos="fade-left">
            <svg xmlns="http://www.w3.org/2000/svg" width="247" height="220" viewBox="0 0 247 220" fill="none">
                <path d="M120.344 220V206.25H219.556V103.868C219.556 78.1092 210.106 56.5996 191.205 39.3388C172.296 22.0688 149.728 13.4338 123.5 13.4338C97.2723 13.4338 74.7038 22.0688 55.7946 39.3388C36.8853 56.6088 27.4353 78.1183 27.4444 103.868V182.188H0V117.48H13.7222L13.9555 100.65C14.2025 86.2583 17.3129 72.9437 23.2866 60.7062C29.2604 48.4688 37.2375 37.8217 47.2182 28.765C57.1988 19.7083 68.7438 12.65 81.8531 7.59C94.9624 2.53 108.849 0 123.514 0C138.178 0 152.047 2.53 165.12 7.59C178.192 12.65 189.687 19.6992 199.603 28.7375C209.52 37.7758 217.456 48.4092 223.411 60.6375C229.367 72.8658 232.578 86.1346 233.044 100.444L233.278 117.494H247V182.188H233.278V220H120.344ZM87.6164 131.161C84.7805 131.161 82.3105 130.199 80.2064 128.274C78.1023 126.349 77.0503 123.965 77.0503 121.124C77.0503 118.282 78.1023 115.848 80.2064 113.822C82.3105 111.797 84.7805 110.788 87.6164 110.797C90.4523 110.797 92.9177 111.783 95.0127 113.754C97.1167 115.734 98.1688 118.186 98.1688 121.11C98.1688 123.952 97.1167 126.335 95.0127 128.26C92.9086 130.185 90.4386 131.148 87.6027 131.148M159.397 131.148C156.561 131.148 154.091 130.185 151.987 128.26C149.883 126.335 148.831 123.952 148.831 121.11C148.831 118.268 149.883 115.839 151.987 113.822C154.091 111.806 156.561 110.797 159.397 110.797C162.233 110.797 164.699 111.783 166.794 113.754C168.889 115.725 169.941 118.177 169.95 121.11C169.95 123.952 168.898 126.335 166.794 128.26C164.69 130.185 162.22 131.148 159.384 131.148M51.0192 109.312C49.7751 88.7242 56.3938 71.1746 70.8753 56.6638C85.3476 42.1529 103.127 34.8975 124.214 34.8975C141.915 34.8975 157.604 40.2279 171.281 50.8888C184.957 61.5496 193.314 75.5517 196.351 92.895C178.174 92.6658 161.305 88.0183 145.744 78.9525C130.183 69.8867 118.244 57.2825 109.929 41.14C106.617 57.0075 99.7331 70.9133 89.2768 82.8575C78.8113 94.8017 66.0588 103.62 51.0192 109.312Z" fill="url(#paint0_linear_739_1574)"/>
                <defs>
                <linearGradient id="paint0_linear_739_1574" x1="123.5" y1="0" x2="123.5" y2="220" gradientUnits="userSpaceOnUse">
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
        
        
            <section class="Connect">
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
                                <label for="phoneNumber" type="number" id="phoneNumber">Phone Number</label>
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
                            <input value="contacts" type="hidden" name="service_type" id="service_type">
                        </div>

                        <div class="button-container">
                            <button type="submit">Send Message</button>
                        </div>

                        
                    </form>
                    
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