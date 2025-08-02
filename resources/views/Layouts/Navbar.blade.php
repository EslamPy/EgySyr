    <nav data-aos="fade-down">
        <a href="">
            <img src="{{ asset('images/logo.webp') }}" alt="">
        </a>

        <ul class="ul_nav">
            <li><a href="{{ route('welcome') }}" {!! request()->is('/') ? 'style="color: white;"' : '' !!}>Home</a></li>
            <li><a href="{{ route('services') }}" {!! request()->is('services', 'services/web', 'services/system', 'services/application', 'services/hosting', 'services/protection-systems', 'services/graphic', 'services/marketing') ? 'style="color: white;"' : '' !!}>Services</a></li>
            <li><a href="{{ route('blog') }}" {!! request()->is('blog', 'blog-details') ? 'style="color: white;"' : '' !!}>Blog</a></li>
            <li><a href="{{ route('about') }}" {!! request()->is('about') ? 'style="color: white;"' : '' !!}>About Us</a></li>
            <li><a href="{{ route('contact') }}" {!! request()->is('contact') ? 'style="color: white;"' : '' !!}>Contact Us</a></li>
            
            <li><a style="display: none;" href="">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="width: 20px; transform: translate(0px, 5px);"><path d="m0 0h24v24h-24z" fill="#fff" opacity="0" transform="matrix(-1 0 0 -1 24 24)"/><path d="m22 12a10 10 0 0 0 -10-10 10 10 0 0 0 0 20 10 10 0 0 0 10-10zm-2.07-1h-2.93a12.91 12.91 0 0 0 -2.33-6.54 8 8 0 0 1 5.26 6.54zm-10.85 2h5.92a11.44 11.44 0 0 1 -3 6.61 11 11 0 0 1 -2.92-6.61zm0-2a11.4 11.4 0 0 1 2.92-6.6 11.19 11.19 0 0 1 3 6.6zm.36-6.57a13.18 13.18 0 0 0 -2.37 6.57h-3a8 8 0 0 1 5.37-6.57zm-5.37 8.57h3a12.86 12.86 0 0 0 2.35 6.56 8 8 0 0 1 -5.35-6.56zm10.55 6.55a13.14 13.14 0 0 0 2.38-6.55h2.95a8 8 0 0 1 -5.33 6.55z" fill="rgb(255, 255, 255)"/></svg>
                {{ app()->getLocale() == 'en' ? 'عربي' : 'English' }}</a></li>
            <li><a href="{{ route('contact') }}" class="btn_su">Request a consultation</a></li>
        </ul>
        <a style="display: none;" class="lan_h" href="">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="width: 20px; transform: translate(0px, 5px);"><path d="m0 0h24v24h-24z" fill="#fff" opacity="0" transform="matrix(-1 0 0 -1 24 24)"/><path d="m22 12a10 10 0 0 0 -10-10 10 10 0 0 0 0 20 10 10 0 0 0 10-10zm-2.07-1h-2.93a12.91 12.91 0 0 0 -2.33-6.54 8 8 0 0 1 5.26 6.54zm-10.85 2h5.92a11.44 11.44 0 0 1 -3 6.61 11 11 0 0 1 -2.92-6.61zm0-2a11.4 11.4 0 0 1 2.92-6.6 11.19 11.19 0 0 1 3 6.6zm.36-6.57a13.18 13.18 0 0 0 -2.37 6.57h-3a8 8 0 0 1 5.37-6.57zm-5.37 8.57h3a12.86 12.86 0 0 0 2.35 6.56 8 8 0 0 1 -5.35-6.56zm10.55 6.55a13.14 13.14 0 0 0 2.38-6.55h2.95a8 8 0 0 1 -5.33 6.55z" fill="rgb(255, 255, 255)"/></svg>
            {{ app()->getLocale() == 'en' ? 'عربي' : 'English' }}
        </a>
        <span class="material-symbols-outlined i_menu">
            menu
        </span>
        

    </nav>


    <div class="menu hid" id="menu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="position: fixed; height: 100%; top: 0; z-index: 9999;  backdrop-filter: blur(2px);">
        <div class="modal-dialog " style="height: 100%;">
        <div data-aos="zoom-in-down" style="height: 100%; display: flex; align-items: center; " tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div style="text-align: center;list-style-type: none;width: max-content;height: 100%;padding: 10px;backdrop-filter: blur(5px);position: absolute;right: 0;background-color: #180013;border-left: solid #910389;" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <ul style="padding: 0;" class="ul_m">
                    <li class="li_m"><a class="a_m" href="{{ route('welcome') }}" {!! request()->is('/') ? 'style="color: white;"' : '' !!}>Home</a></li>
                    <li class="li_m"><a class="a_m" href="{{ route('services') }}" {!! request()->is('services', 'services/web', 'services/system', 'services/application', 'services/hosting', 'services/protection-systems', 'services/graphic', 'services/marketing') ? 'style="color: white;"' : '' !!}>Services</a></li>
                    <li class="li_m"><a class="a_m" href="{{ route('blog') }}" {!! request()->is('blog') ? 'style="color: white;"' : '' !!}>Blog</a></li>
                    <li class="li_m"><a class="a_m" href="{{ route('about') }}" {!! request()->is('about') ? 'style="color: white;"' : '' !!}>About Us</a></li>
                    <li class="li_m"><a class="a_m" href="{{ route('contact') }}" {!! request()->is('contact') ? 'style="color: white;"' : '' !!}>Contact Us</a></li>
                    
                    <li class="li_m"></li><a href="{{ route('contact') }}" class="btn_su">Request a consultation</a></li>
                </ul>
            </div>
        </div>
        </div>
    </div>