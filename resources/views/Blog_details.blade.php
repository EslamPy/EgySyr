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


        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            border: 2px solid #d09eff;
            background-color: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 15px;
            border: 1px solid #f277f4;
            text-align: left;
        }
        th {
            background-color: rgba(255, 255, 255, 0.1);
            font-weight: bold;
        }
        tr:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .Blog{
            width: 100%;
            padding: 70px 0;
        }

        .Home{
            background-image: url({{ asset('storage/' . $article->image) }});
            background-size: cover;
            background-position: 50%;
            text-align: start;
            padding: 0;
        }
        .filter{
            padding-bottom: 55px;
            background-color: #0000008c;
            display: flex;
        }

        .Home p {
            line-height: 1.8;
        }

        .Blog_box{
            background: rgb(27 0 21);
            border: 2px solid #ff00ff;
            border-radius: 20px;
            padding: 30px 40px;
            max-width: 90%;
            box-shadow: 0 0 20px #ff00ff88;
            margin: auto;
        }

        @media (min-width: 320px) and (max-width: 1138px) {
            
        }
        @media (min-width: 320px) and (max-width: 800px) {
            
        }
        @media (min-width: 320px) and (max-width: 430px) {
            
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

    <section style="border-bottom: solid 3px #910389;background-color: #1B0015;margin-top: 45px;margin-bottom: 46px;" class="Home">
        <div class="filter">
            <div data-aos="fade-right">
                <h1>
                    {{ $article->title }}
                </h1>
                <p id="about">
                    {{ $article->summary }}
                </p>
                
            </div>
            <div class="img_Home" data-aos="fade-left">
                
            </div>
        </div>
    </section>
    
    <section class="container">
        <!-- ---------------------------- -->
        <section class="all">
        
        
            <section class="Blog">
                <div class="Blog_box">
                    {!! $article->content !!}
                </div>
                
            </section>
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
        

        const sidebarBox = document.querySelector('.sidebar_box');
        const aside = document.querySelector('aside');
        const sidebarBtn = document.querySelector('.sidebar_btn');

        function sidebar_fun() {
            if(aside.style.left < "0"){
                aside.style.left = "0";
                sidebarBtn.style.right = "0";
            }else{
                sidebarBtn.style.right = "-30px";
                aside.style.left = "-320px";
            }
        }


        window.addEventListener('scroll', () => {
            const sidebarRect = sidebarBox.getBoundingClientRect();
            const asideHeight = aside.offsetHeight;

            if (sidebarRect.top <= 0 && sidebarRect.bottom >= asideHeight) {
            // داخل الـ div → خليه fixed
            aside.classList.add('fixed');
            aside.classList.remove('stuck-bottom');
            } else if (sidebarRect.bottom < asideHeight) {
            // وصل لآخر الـ div → خليه يثبت مكانه (أسفل الـ div)
            aside.classList.remove('fixed');
            aside.classList.add('stuck-bottom');
            } else {
            // قبل ما يدخل الـ div → خليه static أو absolute عادي
            aside.classList.remove('fixed');
            aside.classList.remove('stuck-bottom');
            }
        });
        
    </script>
    
    
    <script src="../js/all.min.js"></script>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <script src="../js/index.js"></script>
</body>
</html>