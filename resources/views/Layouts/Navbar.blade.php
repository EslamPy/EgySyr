<nav data-aos="fade-down">
    <div class="container">
        <a href="{{ route('welcome') }}">
            <img src="{{ asset('images/logo.webp') }}" alt="EgySyr Technology">
        </a>

        <ul class="ul_nav">
            <li><a href="{{ route('welcome') }}" {!! request()->is('/') ? 'class="active"' : '' !!}>Home</a></li>
            <li><a href="{{ route('services') }}" {!! request()->is('services', 'services/web', 'services/system', 'services/application', 'services/hosting', 'services/protection-systems', 'services/graphic', 'services/marketing') ? 'class="active"' : '' !!}>Services</a></li>
            <li><a href="{{ route('blog') }}" {!! request()->is('blog', 'blog-details') ? 'class="active"' : '' !!}>Blog</a></li>
            <li><a href="{{ route('about') }}" {!! request()->is('about') ? 'class="active"' : '' !!}>About Us</a></li>
            <li><a href="{{ route('contact') }}" {!! request()->is('contact') ? 'class="active"' : '' !!}>Contact Us</a></li>
            
            <li><a href="{{ route('contact') }}" class="btn_su">Request a consultation</a></li>
        </ul>
        
        <span class="material-symbols-outlined i_menu" id="menuToggle">
            menu
        </span>
    </div>
</nav>

<div class="menu" id="menu">
    <div class="container">
        <ul>
            <li><a href="{{ route('welcome') }}" {!! request()->is('/') ? 'class="active"' : '' !!}>Home</a></li>
            <li><a href="{{ route('services') }}" {!! request()->is('services', 'services/web', 'services/system', 'services/application', 'services/hosting', 'services/protection-systems', 'services/graphic', 'services/marketing') ? 'class="active"' : '' !!}>Services</a></li>
            <li><a href="{{ route('blog') }}" {!! request()->is('blog') ? 'class="active"' : '' !!}>Blog</a></li>
            <li><a href="{{ route('about') }}" {!! request()->is('about') ? 'class="active"' : '' !!}>About Us</a></li>
            <li><a href="{{ route('contact') }}" {!! request()->is('contact') ? 'class="active"' : '' !!}>Contact Us</a></li>
            
            <li><a href="{{ route('contact') }}" class="btn_su">Request a consultation</a></li>
        </ul>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menuToggle');
    const menu = document.getElementById('menu');
    
    menuToggle.addEventListener('click', function() {
        menu.classList.toggle('active');
    });
    
    // Close menu when clicking on a link
    const menuLinks = menu.querySelectorAll('a');
    menuLinks.forEach(link => {
        link.addEventListener('click', function() {
            menu.classList.remove('active');
        });
    });
    
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const nav = document.querySelector('nav');
        if (window.scrollY > 50) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
    });
});
</script>