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
        /* Hero Section */
        .blog-hero {
            position: relative;
            padding: 80px 0;
            background-color: #1B0015;
            border-bottom: 3px solid #910389;
            overflow: hidden;
        }

        .blog-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 50% 50%, rgba(145, 3, 137, 0.15) 0%, rgba(27, 0, 21, 0) 70%);
            pointer-events: none;
        }

        .blog-hero h1 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #f176f3 0%, #910389 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: 700;
        }

        .blog-hero p {
            font-size: clamp(1rem, 2vw, 1.2rem);
            color: #fff;
            opacity: 0.9;
            max-width: 800px;
            line-height: 1.6;
        }

        /* Search Section */
        .search-section {
            display: flex;
            justify-content: center;
            margin: -30px auto 40px;
            width: 100%;
            position: relative;
            z-index: 10;
        }

        /* Blog Layout */
        .blog-container {
            display: grid;
            grid-template-columns: minmax(250px, 300px) 1fr;
            gap: 40px;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        @media (max-width: 1024px) {
            .blog-container {
                grid-template-columns: 1fr;
            }
        }

        /* Sidebar */
        .sidebar {
            background: rgba(27, 0, 21, 0.8);
            border: 2px solid #910389;
            border-radius: 15px;
            padding: 30px;
            height: fit-content;
            backdrop-filter: blur(10px);
            position: sticky;
            top: 20px;
        }

        .sidebar-title {
            font-size: 1.5rem;
            color: #fff;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #910389;
        }

        .category-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .category-list a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin-bottom: 8px;
        }

        .category-list a:hover,
        .category-list a.active {
            background: linear-gradient(135deg, rgba(242, 119, 244, 0.1) 0%, rgba(145, 3, 137, 0.1) 100%);
            color: #f176f3;
        }

        .category-list a.active {
            border-left: 3px solid #f176f3;
        }

        /* Blog Cards */
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }

        .blog-card {
            background: rgba(27, 0, 21, 0.8);
            border: 2px solid #910389;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            backdrop-filter: blur(10px);
        }

        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(145, 3, 137, 0.2);
        }

        .blog-card-image {
            width: 100%;
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .blog-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .blog-card:hover .blog-card-image img {
            transform: scale(1.05);
        }

        .blog-card-content {
            padding: 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .blog-card-title {
            font-size: 1.4rem;
            color: #fff;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .blog-card-excerpt {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 20px;
            line-height: 1.6;
            flex-grow: 1;
        }

        .blog-card-link {
            color: #f176f3;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            transition: color 0.3s ease;
        }

        .blog-card-link:hover {
            color: #910389;
        }

        .blog-card-link svg {
            width: 20px;
            height: 20px;
            margin-left: 8px;
            transition: transform 0.3s ease;
        }

        .blog-card-link:hover svg {
            transform: translateX(5px);
        }

        /* Pagination */
        .pagination-wrapper {
            margin-top: 60px;
            margin-bottom: 40px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            list-style: none;
            padding: 0;
        }

        .pagination li {
            margin: 0;
        }

        .pagination li a,
        .pagination li span {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border: 2px solid #910389;
            border-radius: 50%;
            color: #fff;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .pagination li.active span {
            background: linear-gradient(135deg, #f176f3 0%, #910389 100%);
            border-color: transparent;
        }

        .pagination li a:hover {
            background: rgba(145, 3, 137, 0.2);
        }

        @media (max-width: 768px) {
            .blog-grid {
                grid-template-columns: 1fr;
            }

            .blog-card {
                max-width: 500px;
                margin: 0 auto;
            }
        }
        .custom-pagination{
            max-width: 500px;
            margin: auto
        }

        .pagination-wrapper {
            text-align: center;
            margin: 40px 0;
            overflow: hidden;
        }

        .pagination2{
            width: 65%;
            /* background-color: aqua; */
            overflow: auto;
            margin: auto;
        }
        .pagination {
            display: inline-flex;
            list-style: none;
            gap: 10px;
            padding: 0;
        }

        .pagination li {
            border: 1px solid #c42eff;
            color: #fff;
            padding: 8px 14px;
            border-radius: 5px;
            background-color: transparent;
            transition: background 0.3s ease;
        }

        .pagination li.active {
            background-color: #c42eff;
            color: #fff;
        }

        .pagination li a {
            color: #fff;
            text-decoration: none;
        }

        .pagination li:hover {
            background-color: #c42eff33;
        }

        .Blog{
            display: flex;
        }
        .blog_card{
            width: 400px;
            background-color: #1B0015;
            /* height: 100%; */
            padding: 20px;
            box-sizing: border-box;
            border-radius: 10px;
            background-color: rgba(27, 0, 21, 1);
            border: solid 3px #910389;
            text-align: start;
            display: flex;
            flex-direction: column; 
        }
        .blog_text {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .blog_img{
            text-align: center;
            width: 100%;
            border-radius: 10px;
            border: solid 3px #910389;
            overflow: hidden;
        }
        .blog_img img{ 
            width: 100%;
            /* height: auto; */
            display: block;
        }
        .a_blog{
            width: 100%;
            text-align: right;
            margin-top: auto; 
        }
        .a_blog a{
            color: #cb00c0;
        }
        .f_line{
            width: 100%;
            margin: 10px 0;
        }
        .blog_title{
            width: fit-content;
        }
        .blog_title h1{
            font-family: Inter;
            font-size: 25px;
            font-size: clamp(17px, 5vw, 24px);
        }
        .blog_text p{
            font-size: clamp(10px, 3vw, 16px);
        }
        .row_blog{
            display: flex;
            justify-content: space-around;
            margin-bottom: 70px;
            gap: 70px;
            flex-wrap: wrap;
        }
        .sidebar{
            box-sizing: border-box;
            border-radius: 10px;
            background-color: rgba(27, 0, 21, 1);
            border: solid 3px #910389;
            padding: 20px;
            width: min-content;
        }
        .blog_box{
            width: 100%;
            flex: 9;
        }
        .sidebar ul{
            border-left: solid 2px #cb00c0;
            padding: 0 10px;
        }
        .sidebar a{
            color: #cb00c0;
            text-decoration: none;
            display: flex;
        }
        .active div{
            width: 2px;
            background-color: #910389;
            transform: translate(-12px, 0);
            /* display: none; */
        }
        .sidebar a:hover{
            color: #910389;
        }
        .active li{
            color: #910389;
        }
        li {
            display: block;
            margin-bottom: 15px;
        }

        .search-section {
            display: flex;
            justify-content: center;
            margin: 20px auto 40px;
            width: 100%;
        }

        .search-container {
            position: relative;
            width: 500px;
            height: 50px;
            border-radius: 25px;
            border: 2px solid transparent;
            background-image: linear-gradient(#1b0015, #1b0015), linear-gradient(to right, #f176f3, #910389);
            background-origin: border-box;
            background-clip: padding-box, border-box;
            box-shadow: 0 0 15px rgba(145, 3, 137, 0.3);
            transition: all 0.3s ease;
        }

        .search-container:focus-within {
            box-shadow: 0 0 20px rgba(145, 3, 137, 0.5);
            transform: translateY(-2px);
        }

        .search-container input {
            width: calc(100% - 60px);
        height: 100%;
        border: none;
        outline: none;
            border-radius: 25px;
            padding-left: 50px;
            padding-right: 20px;
        background: transparent;
            color: #fff;
            font-size: 16px;
        }

        .search-container input::placeholder {
        color: #666;
            transition: color 0.3s ease;
        }

        .search-container input:focus::placeholder {
            color: #888;
        }

        .search-icon {
        position: absolute;
            left: 20px;
            top: 50%;
        transform: translateY(-50%);
        color: #666;
            transition: color 0.3s ease;
        }

        .search-container:focus-within .search-icon {
            color: #f176f3;
        }

        .search-results {
            position: absolute;
            top: 60px;
            left: 0;
            right: 0;
            background-color: #1B0015;
            border: 2px solid #910389;
            border-radius: 15px;
            margin-top: 5px;
            z-index: 1000;
            max-height: 300px;
            overflow-y: auto;
            box-shadow: 0 5px 15px rgba(145, 3, 137, 0.2);
        }

        .search-results ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .search-results li {
            padding: 15px 20px;
            border-bottom: 1px solid rgba(145, 3, 137, 0.3);
            margin: 0;
            transition: background-color 0.3s ease;
        }

        .search-results li:hover {
            background-color: rgba(145, 3, 137, 0.1);
        }

        .search-results li:last-child {
            border-bottom: none;
        }

        .search-results a {
            color: #fff;
            text-decoration: none;
            display: block;
            font-size: 14px;
        }

        .search-results a:hover {
            color: #f176f3;
        }

        @media (max-width: 768px) {
            .search-container {
                width: 90%;
                margin: 0 auto;
            }
        }

        aside {
            position: absolute;
            top: 0;
            transition: top 0.3s ease;
            transition: 1s;
        }

        .sidebar_box {
            position: relative;
            flex: 3.5;
        }

        aside.fixed {
            position: fixed;
            top: 0;
        }

        aside.stuck-bottom {
            position: absolute;
            top: auto;
            bottom: 0;
        }
        footer {
            position: absolute;
        }

        .sidebar_btn{
            width: 30px;
            height: 30px;
            background-color: #1b0015;
            position: absolute;
            top: 50%;
            right: -30px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: solid 2px #910389;
            border-radius: 10px;
            display: none;
            transition: 1s;
        }

        .Home{
            text-align: start;
        }

        .Home p {
            line-height: 1.8;
        }

        @media (min-width: 320px) and (max-width: 1138px) {
            .sidebar_btn{
                display: flex;
            }
            .sidebar{
                left: -320px;
            }
            .sidebar_box{
                flex: 0;
            }
        }
        @media (min-width: 320px) and (max-width: 800px) {
            .row_blog{
                gap: 70px;
            }
        }
        @media (min-width: 320px) and (max-width: 430px) {
            .blog_card{
                width: 80%;
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

    <!-- Hero Section -->
    <section class="blog-hero">
        <div class="container">
            <div data-aos="fade-up">
                <h1>Our Blog</h1>
                <p>Stay updated with the latest trends in technology, web development, digital marketing, and security systems. Our blog offers expert insights, practical tips, and in-depth articles to help you grow your business and stay ahead in the digital world.</p>
        </div>
        </div>
    </section>
    
    <!-- Search Section -->
    <div class="search-section">
                        <div class="search-container">
            <input type="text" id="liveSearch" name="search" placeholder="Search articles..." value="{{ request('search') }}" autocomplete="off">
                            <span class="search-icon">
                                <svg width="23" height="23" fill="none" stroke="#666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </span>
            <div id="searchResults" class="search-results"></div>
                        </div>
                        </div>

    <!-- Main Content -->
    <div class="container">
        <div class="blog-container">
            <!-- Sidebar -->
            <aside class="sidebar">
                <h2 class="sidebar-title">Categories</h2>
                <ul class="category-list">
                    <li>
                        <a href="{{ route('blog') }}" class="{{ request()->get('category') ? '' : 'active' }}">
                            All Categories
                        </a>
                    </li>
                            @foreach($categories as $category)
                        <li>
                            <a href="{{ route('blog', ['category' => $category->id]) }}" 
                               class="{{ request()->get('category') == $category->id ? 'active' : '' }}">
                                {{ $category->name }}
                            </a>
                        </li>
                            @endforeach
                        </ul>
            </aside>

            <!-- Blog Grid -->
            <div class="blog-grid">
                @forelse ($articles as $article)
                    <article class="blog-card">
                        <div class="blog-card-image">
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                        </div>
                        <div class="blog-card-content">
                            <h3 class="blog-card-title">{{ $article->title }}</h3>
                            <p class="blog-card-excerpt">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($article->summary), 150) }}
                                    </p>
                            <a href="{{ route('blog.details', $article->id) }}" class="blog-card-link">
                                Read More
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                                    </div>
                    </article>
                        @empty
                    <div class="no-articles">
                        <p>No articles found.</p>
                    </div>
                @endforelse
            </div>
                </div>
                
        <!-- Pagination -->
        <div class="pagination-wrapper">
                {{ $articles->appends(request()->query())->links('custom') }}
            </div>
    </div>

    @include('layouts.footer')

    <script src="../splide.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
         AOS.init({
            duration: 1000,
        });

        $('#liveSearch').on('keyup', function () {
            let query = $(this).val();
            $.ajax({
                url: "{{ route('articles.search') }}",
                type: "GET",
                data: { search: query },
                success: function (data) {
                    $('#searchResults').html(data);
                }
            });
        });
    </script>
    
    
    
    <script src="../js/all.min.js"></script>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <script src="../js/index.js"></script>
</body>
</html>