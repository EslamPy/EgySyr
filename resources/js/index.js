
let nums = document.querySelectorAll(".num");
let contersSection = document.querySelector(".conters");

let started = false;

function startCount(el) {
    let goal = parseInt(el.dataset.goal);
    let symbol = el.dataset.symbol || ""; // جلب الرمز (لو مش موجود يبقى فارغ)
    let count = 0;
    let speed = 1500 / goal; // سرعة العداد

    let counter = setInterval(() => {
        count++;
        el.textContent = count;

        if (count >= goal) {
            clearInterval(counter);
            el.textContent = goal + symbol; // إضافة العلامة المحددة
        }
    }, speed);
}

window.addEventListener("scroll", function () {
    if (window.scrollY >= contersSection.offsetTop - window.innerHeight + 200) {
        if (!started) {
            nums.forEach(num => startCount(num));
            started = true;
        }
    }
});



let menu = document.querySelector(".menu");
let min_menu = document.querySelector(".min_menu");
$(".i_menu").click(function(){
        $(".menu").removeClass("hid");
        $(".menu").addClass("s");   
        
});



$(".menu").click(function(){
        $(".menu").removeClass("s");
        $(".menu").addClass("hid");   
});

// if(menu.style.display == "block"){
//     min_menu.style.right = "0";
//     alert("lsdflk")
// }else{
//     min_menu.style.right = "-100%";
// }



    const video = document.getElementById("myVideo");
        let reverse = false;
        let interval;

        function playReverse() {
            clearInterval(interval);
            interval = setInterval(() => {
                if (video.currentTime <= 0) {
                    clearInterval(interval);
                    reverse = false;
                    video.play();
                } else {
                    video.currentTime -= 0.1; // تقليل الوقت لجعل الفيديو يرجع للخلف
                }
            }, 100);
        }

        video.addEventListener("ended", function () {
            if (!reverse) {
                reverse = true;
                playReverse();
            } else {
                video.currentTime = 0;
                video.play();
                reverse = false;
            }
        });




        // الكود ده بيتحقق إذا كان الجهاز "مش" موبايل أو تابلت
        if (!/Mobi|Android|iPhone|iPad|iPod/i.test(navigator.userAgent)) {

            const cursor = document.querySelector('.cursor');
            let mouseX = 0, mouseY = 0;
            let currentX = 0, currentY = 0;
            let isHovering = false;
        
            document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            cursor.style.width = '20px';
            cursor.style.height = '20px';
            });
        
            function animate() {
            if (!isHovering) {
                currentX += (mouseX - currentX) * 0.2;
                currentY += (mouseY - currentY) * 0.2;
                cursor.style.left = currentX + 'px';
                cursor.style.top = currentY + 'px';
            }
            requestAnimationFrame(animate);
            }
            animate();
        
            const hoverTargets = document.querySelectorAll('.hover-target');
        
            hoverTargets.forEach(el => {
            el.addEventListener('mouseenter', () => {
                const rect = el.getBoundingClientRect();
                isHovering = true;
                cursor.classList.add('active');
                cursor.style.width = rect.width + 20 + 'px';
                cursor.style.height = rect.height + 20 + 'px';
                cursor.style.left = rect.left + rect.width / 2 + 'px';
                cursor.style.top = rect.top + rect.height / 2 + 'px';
            });
        
            el.addEventListener('mouseleave', () => {
                isHovering = false;
                cursor.classList.remove('active');
                cursor.style.width = '20px';
                cursor.style.height = '20px';
            });
            });
        
        }
  
        if (window.innerWidth <= 768 || /Mobi|Android|iPhone|iPad|iPod/i.test(navigator.userAgent)) {
            cursor.style.width = '0px';
            cursor.style.height = '0px';
          }

        // document.addEventListener("contextmenu", function(e) {
        //     e.preventDefault(); // يمنع القائمة
        // });

        // document.addEventListener("keydown", function(e) {
        //     if (
        //         e.key === "F12" ||
        //         (e.ctrlKey && e.shiftKey && (e.key === "I" || e.key === "J" || e.key === "C")) ||
        //         (e.ctrlKey && e.key === "U")
        //     ) {
        //         e.preventDefault();
        //     }
        // });


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