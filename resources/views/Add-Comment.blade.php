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
            display: flex;
            margin-bottom: 5px;
            background: linear-gradient(308deg, rgba(242, 119, 244, 1), rgba(145, 3, 137, 1));
            -webkit-background-clip: text;
            background-clip: text;
            color: #00000000;
            font-family: Al Qabas;
            font-size: 14px;
            justify-content: space-between;
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
        .custom-file-upload {
            border: 2px solid #f0f;
            display: inline-block;
            padding: 8px 12px;
            cursor: pointer;
            background-color: #222;
            color: white;
            border-radius: 5px;
            transition: 0.3s;
        }

        .custom-file-upload:hover {
            background-color: #f0f;
            color: #ffffff;
        }

        input[type="file"] {
            display: none;
        }

        .Choose-avatar label {
            display: inline-block;
            cursor: pointer;
            margin: 5px;
            position: relative;
        }

        .Choose-avatar input[type="radio"] {
            display: none;
        }

        .Choose-avatar img {
            width: 80px;
        }

        .Choose-avatar div {
            border: solid rgba(145, 3, 137, 1);
        }

        /* لو الراديو متحدد، حط بوردر حوالين الصورة */
        .Choose-avatar input[type="radio"]:checked + div {
            border-color: #00f; /* غير اللون لو حابب */
            box-shadow: 0 0 34px rgba(0, 0, 255, 0.5);
            border: solid rgb(3, 145, 34);
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
                Customer Reviews
            </h1>
            <p><span style="background: linear-gradient(308deg, rgba(145, 3, 137, 1), rgba(242, 119, 244, 1));background-clip: text;color: #00000000;">Your evaluation matters to us ! </span>💡</p>
            <p id="about">
                Your experience matters to us and helps us grow. Feel free to share your review or testimonial through our available channels — we’re always eager to hear from you. Your satisfaction drives our success, and your voice makes a difference!
            </p>
            
        </div>
        <div class="img_Home" data-aos="fade-left">
            <svg xmlns="http://www.w3.org/2000/svg" width="219" height="204" viewBox="0 0 219 204" fill="none">
                <path d="M109.5 114.849L130.305 127.458C132.312 128.737 134.32 128.693 136.327 127.326C138.335 125.959 139.065 124.085 138.517 121.702L133.042 97.8548L151.658 81.6827C153.483 80.0381 154.03 78.0755 153.3 75.795C152.57 73.5144 150.927 72.2791 148.372 72.0891L124.009 70.1704L114.427 47.6939C113.515 45.5011 111.872 44.4047 109.5 44.4047C107.128 44.4047 105.485 45.5011 104.573 47.6939L94.9913 70.1704L70.6275 72.0891C68.0725 72.2718 66.43 73.5071 65.7 75.795C64.97 78.0828 65.5175 80.0454 67.3425 81.6827L85.9575 97.8548L80.4825 121.702C79.935 124.077 80.665 125.952 82.6725 127.326C84.68 128.701 86.6875 128.744 88.695 127.458L109.5 114.849ZM43.8 175.426L18.615 200.643C15.1475 204.115 11.1763 204.894 6.70142 202.979C2.22652 201.064 -0.00728216 197.636 1.78339e-05 192.694V21.9282C1.78339e-05 15.898 2.14622 10.7375 6.43862 6.4469C10.731 2.15628 15.8848 0.00730941 21.9 0H197.1C203.122 0 208.28 2.14897 212.572 6.4469C216.865 10.7448 219.007 15.9053 219 21.9282V153.498C219 159.528 216.857 164.692 212.572 168.99C208.287 173.288 203.13 175.433 197.1 175.426H43.8ZM34.4925 153.498H197.1V21.9282H21.9V165.832L34.4925 153.498Z" fill="url(#paint0_linear_1040_849)"/>
                <defs>
                <linearGradient id="paint0_linear_1040_849" x1="109.5" y1="0" x2="109.5" y2="204" gradientUnits="userSpaceOnUse">
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
                    <form class="contact-form" action="{{ route('reviews.store', ['service_type' => $service_type]) }}" enctype="multipart/form-data" method="POST" data-aos="zoom-in-up">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: green;width: fit-content;padding: 10px;border-radius: 10px;margin: auto;">
                                The evaluation has been submitted successfully.
                                
                            </div>
                        @endif
                
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="background-color: rgb(255, 0, 0);width: fit-content;padding: 10px;border-radius: 10px;margin: auto;">
                                {{ session('error') }}
                                
                            </div>
                        @endif
                        @csrf
                        <div class="row">
                            <div class="form-group">
                                <label class="text_h" for="fullName">Full Name</label>
                                <input type="text" name="full_name" required>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label>Your Comment</label>
                            <textarea style="height: 150px;" name="comment" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="file-upload">Choose a profile picture or avatar</label>
                            <label for="file-upload" class="custom-file-upload">
                                Choose a profile picture
                                <img height="height: 50px;" id="preview" src="#" alt="صورة المعاينة" style="display: none;" />
                            </label>
                            <input id="file-upload" type="file" name="profile_image" accept="image/*">
                        </div>

                        <div class="form-group">
                            <label style="display: block;"><input class="checkbox-avatar" style="width: auto;" type="checkbox" name="predefined_image" value="">or avatar</label>
                            <div class="Choose-avatar" style="display: none; justify-content: space-around;flex-wrap: wrap;">
                                @foreach(['Avatar1.webp', 'Avatar2.webp', 'Avatar3.webp', 'Avatar4.webp'] as $img)
                                    <label>
                                        <input type="radio" name="predefined_image" value="{{ $img }}">
                                        <div style="width: 80px; height: 80px; overflow: hidden; border-radius: 50%;">
                                            <img src="{{ asset('images/avatars/' . $img) }}">
                                        </div>
                                    </label>
                                @endforeach
                            </div>
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
        
        document.getElementById('file-upload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    preview.style.height = '50px';
                }
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
                preview.src = '#';
            }
        });

        document.querySelector('.checkbox-avatar').addEventListener('change', function () {
            const avatarSection = document.querySelector('.Choose-avatar');
            avatarSection.style.display = this.checked ? 'flex' : 'none';
        });
    </script>
    
    
    <script src="../js/all.min.js"></script>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <script src="../js/index.js"></script>
</body>
</html>