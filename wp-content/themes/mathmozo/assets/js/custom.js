(function() {
    // INITIALIZATION OF MEGA MENU
    // =======================================================
    const megaMenu = new HSMegaMenu('.js-mega-menu', {
        desktop: {
            position: 'left'
        }
    })


    // INITIALIZATION OF SHOW ANIMATIONS
    // =======================================================
    new HSShowAnimation('.js-animation-link')


    // INITIALIZATION OF BOOTSTRAP VALIDATION
    // =======================================================
    HSBsValidation.init('.js-validate', {
        onSubmit: data => {
            data.event.preventDefault()
            alert('Submited')
        }
    })


    // INITIALIZATION OF GO TO
    // =======================================================
    new HSGoTo('.js-go-to')


    // INITIALIZATION OF SWIPER
    // =======================================================
    var sliderThumbs = new Swiper('.js-swiper-thumbs', {
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        history: false,
        breakpoints: {
            480: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 15,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 15,
            },
        },
        on: {
            'afterInit': function(swiper) {
                swiper.el.querySelectorAll('.js-swiper-pagination-progress-body-helper')
                    .forEach($progress => $progress.style.transitionDuration =
                        `${swiper.params.autoplay.delay}ms`)
            }
        }
    });

    var sliderMain = new Swiper('.js-swiper-main', {
        effect: 'fade',
        autoplay: true,
        loop: true,
        thumbs: {
            swiper: sliderThumbs
        }
    })

    // INITIALIZATION OF SWIPER
    // =======================================================
    var swiper = new Swiper('.js-swiper-home-hero', {
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        autoplay: {
            delay: 7000,
        },
        pagination: {
            el: '.js-swiper-pagination',
            clickable: true,
        },
    });


    // INITIALIZATION OF TEXT ANIMATION (TYPING)
    // =======================================================
    const typed = HSCore.components.HSTyped.init('.js-typedjs')
})()

//menu
$(".tit_area_wrap .tit_area").click(function() {
    if ($(this).parent().hasClass("sublist_show")) {
        $(this).parent().removeClass("sublist_show");
    } else {
        $(this).parent().addClass("sublist_show");
    }
});


<!--Start of Tawk.to Script-->


var Tawk_API=Tawk_API||{};

var Tawk_LoadStart=new Date();

(function(){

setTimeout(function () { // this function sets a delay before running the lines of codes inside it.
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];

    s1.async=true;

    s1.src='https://embed.tawk.to/647aa5e47c7b15544f3eb6ad/1h1vhg1j5';

    s1.charset='UTF-8';

    s1.setAttribute('crossorigin','*');

    s0.parentNode.insertBefore(s1,so);

}, 10000); // delay in milliseconds. can be changed to requirements.
})();

setInterval( findTawkAndRemove, 100 );

function findTawkAndRemove() {
    let parentElement = document.querySelector("iframe[title*=chat]:nth-child(2)");

    if ( parentElement ) {

        let element = parentElement.contentDocument.querySelector(`a[class*=tawk-branding]`);

        if ( element ) {
            element.remove();
        }
    }
}