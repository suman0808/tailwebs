/* ===================================================================
    
    Author          : Valid Theme
    Template Name   : Crysa - It Solution Template
    Version         : 1.0
    
* ================================================================= */
(function($) {
    "use strict";

    $(document).ready(function() {


        /* ==================================================
            # Wow Init
         ===============================================*/
        var wow = new WOW({
            boxClass: 'wow', // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            offset: 0, // distance to the element when triggering the animation (default is 0)
            mobile: true, // trigger animations on mobile devices (default is true)
            live: true // act on asynchronously loaded content (default is true)
        });
        wow.init();


        /* ==================================================
            # Tooltip Init
        ===============================================*/
        $('[data-toggle="tooltip"]').tooltip();


        /* ==================================================
            # Youtube Video Init
         ===============================================*/
        $('.player').mb_YTPlayer();


        /* ==================================================
            # Slide Animated Button
        ===============================================*/
        var $slideLink = $(".text-slide"),
            slideLinkText = $slideLink.find("span")[0];

        $slideLink.on("mouseenter", linkOver);

        function linkOver() {
            TweenLite.to(slideLinkText, 0.3, {
                y: -25,
                ease: Cubic.easeIn,
                onComplete: function() {
                    TweenLite.fromTo(slideLinkText, 0.3, {
                        y: 25
                    }, {
                        y: 0,
                        ease: Cubic.easeOut
                    })
                }
            });
        }


        /* ==================================================
            # Scrolla active
        ===============================================*/
        $('.animate').scrolla();


        /* ==================================================
            # imagesLoaded active
        ===============================================*/
        $('#gallery-masonary,.blog-masonry').imagesLoaded(function() {

            /* Filter menu */
            $('.mix-item-menu').on('click', 'button', function() {
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({
                    filter: filterValue
                });
            });

            /* filter menu active class  */
            $('.mix-item-menu button').on('click', function(event) {
                $(this).siblings('.active').removeClass('active');
                $(this).addClass('active');
                event.preventDefault();
            });

            /* Filter active */
            var $grid = $('#gallery-masonary').isotope({
                itemSelector: '.gallery-item',
                percentPosition: true,
                masonry: {
                    columnWidth: '.gallery-item',
                }
            });

            /* Filter active */
            $('.blog-masonry').isotope({
                itemSelector: '.blog-item',
                percentPosition: true,
                masonry: {
                    columnWidth: '.blog-item',
                }
            });

        });


        /* ==================================================
            # Fun Factor Init
        ===============================================*/
        $('.timer').countTo();
        $('.fun-fact').appear(function() {
            $('.timer').countTo();
        }, {
            accY: -100
        });


        /* ==================================================
            # Hover Active Init
        ===============================================*/
        $('.style-one-item').on('mouseenter', function() {
            $(this).addClass('active').parent().siblings().find('.style-one-item').removeClass('active');
        })

        $('.gallery-mixed-item').on('mouseenter', function() {
            $(this).addClass('active').parent().siblings().find('.gallery-mixed-item').removeClass('active');
        })


        /* ==================================================
            # Magnific popup init
         ===============================================*/
        $(".popup-link").magnificPopup({
            type: 'image',
            // other options
        });

        $(".popup-gallery").magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            },
            // other options
        });

        $(".popup-youtube, .popup-vimeo, .popup-gmaps").magnificPopup({
            type: "iframe",
            mainClass: "mfp-fade",
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });

        $('.magnific-mix-gallery').each(function() {
            var $container = $(this);
            var $imageLinks = $container.find('.item');

            var items = [];
            $imageLinks.each(function() {
                var $item = $(this);
                var type = 'image';
                if ($item.hasClass('magnific-iframe')) {
                    type = 'iframe';
                }
                var magItem = {
                    src: $item.attr('href'),
                    type: type
                };
                magItem.title = $item.data('title');
                items.push(magItem);
            });

            $imageLinks.magnificPopup({
                mainClass: 'mfp-fade',
                items: items,
                gallery: {
                    enabled: true,
                    tPrev: $(this).data('prev-text'),
                    tNext: $(this).data('next-text')
                },
                type: 'image',
                callbacks: {
                    beforeOpen: function() {
                        var index = $imageLinks.index(this.st.el);
                        if (-1 !== index) {
                            this.goTo(index);
                        }
                    }
                }
            });
        });


        /* ==================================================
            Nice Select Init
         ===============================================*/
         $('.consultation-form select').niceSelect();
         $('.appoinment-style-two select').niceSelect();


        /* ==================================================
            _Progressbar Init
         ===============================================*/
        function animateElements() {
            $('.progressbar').each(function() {
                var elementPos = $(this).offset().top;
                var topOfWindow = $(window).scrollTop();
                var percent = $(this).find('.circle').attr('data-percent');
                var animate = $(this).data('animate');
                if (elementPos < topOfWindow + $(window).height() - 30 && !animate) {
                    $(this).data('animate', true);
                    $(this).find('.circle').circleProgress({
                        // startAngle: -Math.PI / 2,
                        value: percent / 100,
                        size: 160,
                        thickness: 13,
                        lineCap: 'round',
                        emptyFill: 'rgba(255, 255, 255, 1)',
                        fill: {
                            gradient: ['#104cba', '#00ccff']
                        }
                    }).on('circle-animation-progress', function(event, progress, stepValue) {
                        $(this).find('strong').text((stepValue * 100).toFixed(0) + "%");
                    }).stop();
                }
            });
        }

        animateElements();
        $(window).scroll(animateElements);



        /* ==================================================
            # Banner Carousel
         ===============================================*/
        const bannerFade = new Swiper(".banner-fade", {
            // Optional parameters
            direction: "horizontal",
            loop: true,
            autoplay: true,
            effect: "fade",
            fadeEffect: {
                crossFade: true
            },
            speed: 2000,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true,
            },

            // Navigation arrows
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            }

            // And if we need scrollbar
            /*scrollbar: {
            el: '.swiper-scrollbar',
          },*/
        });


        /* ==================================================
            # Banner Carousel
         ===============================================*/
        const bannerSlide = new Swiper(".banner-slide", {
            // Optional parameters
            direction: "horizontal",
            loop: false,
            grabCursor: true,
            autoplay: true,
            speed: 2000,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true,
            },

            // Navigation arrows
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            }

            // And if we need scrollbar
            /*scrollbar: {
            el: '.swiper-scrollbar',
          },*/
        });


        /* ==================================================
            # Brand Carousel
         ===============================================*/
         const brandCarousel = new Swiper(".brand-carousel", {
            // Optional parameters
            loop: true,
            slidesPerView: 2,
            spaceBetween: 15,
            autoplay: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            // Navigation arrows
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            breakpoints: {
                768: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                992: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
                1200: {
                    slidesPerView: 5,
                    spaceBetween: 30,
                },
            },
        });

        /* ==================================================
            # Brand Carousel
         ===============================================*/
         const brand3col = new Swiper(".brand3col", {
            // Optional parameters
            loop: true,
            slidesPerView: 2,
            spaceBetween: 15,
            autoplay: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            // Navigation arrows
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            breakpoints: {
                768: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                }
            },
        });


        /* ==================================================
            # Brand Carousel
         ===============================================*/
         const brand4col = new Swiper(".brand4col", {
            // Optional parameters
            loop: true,
            slidesPerView: 2,
            spaceBetween: 15,
            autoplay: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            // Navigation arrows
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            breakpoints: {
                768: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                }
            },
        });


        /* ==================================================
            # Team Carousel
         ===============================================*/
        const teamCarousel = new Swiper(".team-carousel", {
            // Optional parameters
            loop: true,
            slidesPerView: 1,
            spaceBetween: 15,
            autoplay: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            // Navigation arrows
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 50,
                },
            },
        });


        /* ==================================================
            # Services Carousel
         ===============================================*/
        const servicesCarousel = new Swiper(".services-carousel", {
            // Optional parameters
            loop: true,
            slidesPerView: 1,
            spaceBetween: 15,
            autoplay: true,
            pagination: {
                el: ".service-carousel-pagination",
                clickable: true,
            },
            // Navigation arrows
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                991: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1200: {
                    slidesPerView: 5,
                    spaceBetween: 30,
                },
            },
        });


        /* ==================================================
            # Testimonails Carousel
         ===============================================*/
        const testimonialCarousel = new Swiper(".testimonial-style-one-carousel", {
            // Optional parameters
            loop: true,
            slidesPerView: 1,
            spaceBetween: 30,
            autoplay: true,
            breakpoints: {
                768: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                1200: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                }
            },
        });

        /* ==================================================
            # Testimonial Carousel
         ===============================================*/
         const testimonial2 = new Swiper(".testimonial-style-two-carousel", {
            // Optional parameters
            loop: true,
            slidesPerView: 1,
            spaceBetween: 30,
            autoplay: true,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true,
            },

            // Navigation arrows
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            }

            // And if we need scrollbar
            /*scrollbar: {
            el: '.swiper-scrollbar',
          },*/
        });


        /* ==================================================
            # Banner Carousel
         ===============================================*/
         const bannerSeven = new Swiper(".banner-style-seven-fade", {
            // Optional parameters
            direction: "horizontal",
            loop: true,
            autoplay: false,
            effect: "fade",
            fadeEffect: {
                crossFade: true
            },
            speed: 2000,
            

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true,
            },

            // Navigation arrows
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            }

            // And if we need scrollbar
            /*scrollbar: {
            el: '.swiper-scrollbar',
          },*/
        });



        /* ==================================================
            # Services Carousel
         ===============================================*/
         const servicesSevenCarousel = new Swiper(".services-style-seven-carousel", {
            // Optional parameters
            loop: true,
            slidesPerView: 1,
            spaceBetween: 15,
            autoplay: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            // Navigation arrows
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 50,
                },
            },
        });


        /* ==================================================
            # Product Gallery Carousel
         ===============================================*/
         const productGallery = new Swiper(".product-gallery-carousel", {
            // Optional parameters
            loop: true,
            slidesPerView: 2,
            spaceBetween: 30,
            autoplay: true,
            breakpoints: {
                768: {
                    slidesPerView: 3,
                },
                992: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 4,
                },
            },
        });


        /* ==================================================
            # Related Product Carousel
         ===============================================*/
         const relatedProduct = new Swiper(".related-product-carousel", {
            // Optional parameters
            loop: true,
            slidesPerView: 1,
            spaceBetween: 30,
            autoplay: true,
            breakpoints: {
                768: {
                    slidesPerView: 3,
                },
                992: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 4,
                },
            },
        });


        /* ==================================================
            Contact Form Validations
        ================================================== */
        $('.contact-form').each(function() {
            var formInstance = $(this);
            formInstance.submit(function() {

                var action = $(this).attr('action');

                $("#message").slideUp(750, function() {
                    $('#message').hide();

                    $('#submit')
                        .after('<img src="assets/img/ajax-loader.gif" class="loader" />')
                        .attr('disabled', 'disabled');

                    $.post(action, {
                            name: $('#name').val(),
                            email: $('#email').val(),
                            phone: $('#phone').val(),
                            comments: $('#comments').val()
                        },
                        function(data) {
                            document.getElementById('message').innerHTML = data;
                            $('#message').slideDown('slow');
                            $('.contact-form img.loader').fadeOut('slow', function() {
                                $(this).remove()
                            });
                            $('#submit').removeAttr('disabled');
                        }
                    );
                });
                return false;
            });
        });

    }); // end document ready function

    /* ==================================================
        Preloader Init
     ===============================================*/
     $(window).on('load', function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");;
    });
    
})(jQuery); // End jQuery