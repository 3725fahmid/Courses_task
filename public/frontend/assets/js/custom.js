(function ($) {
    "use strict";
    var inews = {
        initialize: function () {
            this.pageLoader();
            this.wrapper();
            this.navigation();
            this.sidebarNav();
            this.toggleSearch();
            this.fullSkinSearch();
            this.toTop();
            this.stickySidebar();
            this.youtubeVideo();
            this.tab();
            this.tabPanel();
            this.bgImage();
            this.skyicon();
            this.progresber();
        },
        // -------------------------------------------------------------------------- //
        // Page loader
        // -------------------------------------------------------------------------- //  
        pageLoader: function () {
            $(".se-pre-con").fadeOut("slow");
        },
        // ------------------------------------------------------------------------------ //
        // Wrapper
        // ------------------------------------------------------------------------------ //
        wrapper: function () {
            $("body").wrapInner("<div class='wrapper'></div>");
        },
        // -------------------------------------------------------------------------- //
        // Navbar
        // -------------------------------------------------------------------------- //  
        navigation: function () {
            // Navbar collapse hide
            $(".navbar-collapse .collapse-close").on("click", function () {
                $(".navbar-collapse").collapse("hide");
            });
            if ($('#nav-icon').length) {
                $('#nav-icon').click(function () {
                    $(this).toggleClass('open');
                });
            }
        },
        // ------------------------------------------------------------------------------ //
        // Toggle Search
        // ------------------------------------------------------------------------------ //
        toggleSearch: function () {
            $(".custom-navbar").each(function () {
                $(".btn-search", this).on("click", function (e) {
                    e.preventDefault();
                    $(".top-search").slideToggle();
                });
            });
            $(".input-group-text.close-search").on("click", function () {
                $(".top-search").slideUp();
            });
        },
        // -------------------------------------------------------------------------- //
        // Sidebar Nav
        // -------------------------------------------------------------------------- //  
        sidebarNav: function () {
            if ($('#dismiss, .overlay').length) {
                $('#dismiss, .overlay').on('click', function () {
                    $('#sidebar').removeClass('active');
                    $('.overlay').removeClass('active');
                    $('#nav-icon').removeClass('open');
                });
            }
            if ($('#nav-icon').length) {
                $('#nav-icon').on('click', function () {
                    $('#sidebar').addClass('active');
                    $('.overlay').addClass('active');
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
            }
        },
        // -------------------------------------------------------------------------- //
        // Full Skin Search
        // -------------------------------------------------------------------------- //
        fullSkinSearch: function () {
            //Program created by Ryan Tarson Updated 6.15.16, under this code is my pure JS Version
            var wHeight = window.innerHeight;
            //search bar middle alignment
            $("#fullscreen-searchform").css("top", wHeight / 2);
            //reform search bar
            jQuery(window).resize(function () {
                wHeight = window.innerHeight;
                $("#fullscreen-searchform").css("top", wHeight / 2);
            });
            // Search
            $(".btn-search_two").on('click', function () {
                console.log("Open Search, Search Centered");
                $("div.fullscreen-search-overlay").addClass(
                    "fullscreen-search-overlay-show"
                );
            });
            $("a.fullscreen-close").on('click', function () {
                console.log("Closed Search");
                $("div.fullscreen-search-overlay").removeClass(
                    "fullscreen-search-overlay-show"
                );
            });
        },
        // -------------------------------------------------------------------------- //
        // Back to top
        // -------------------------------------------------------------------------- //  
        toTop: function () {
            $('body').append('<div id="toTop" class="btn back-top"><span class="ti-arrow-up"></span></div>');
            $(window).on("scroll", function () {
                if ($(this).scrollTop() !== 0) {
                    $('#toTop').fadeIn();
                } else {
                    $('#toTop').fadeOut();
                }
            });
            $('#toTop').on("click", function () {
                $("html, body").animate({
                    scrollTop: 0
                }
                    , 600);
                return false;
            });
        },
        // -------------------------------------------------------------------------- //
        // Sticky Sidebar
        // -------------------------------------------------------------------------- //
        stickySidebar: function () {
            $('.leftSidebar, .main-content, .rightSidebar').theiaStickySidebar({
                additionalMarginTop: 30
            });
        },
        // -------------------------------------------------------------------------- //
        // Youtube video
        // -------------------------------------------------------------------------- //    
        youtubeVideo: function () {
            // This key only works for this demo on newspaper
            // You must create your own at:
            // https://developers.google.com/youtube/v3/getting-started
            window.api_key = 'AIzaSyDbVOKeaP-xOLHBEXIcKTyb5ehdjOoptlE';
            // Start two players by ID, with default settings
            $('#rypp-demo-1').rypp(api_key, {
                update_title_desc: true, // Default false
                autoplay: false, autonext: false, loop: false, mute: false, debug: false
            });
        },
        // -------------------------------------------------------------------------- //
        // Tab 
        // -------------------------------------------------------------------------- //    
        tab: function () {
            $(".weather-week>div.list-group>a").click(function (e) {
                e.preventDefault();
                $(this).siblings('a.active').removeClass("active");
                $(this).addClass("active");
                var index = $(this).index();
                $("div.bhoechie-tab>div.weather-temp-wrap").removeClass("active");
                $("div.bhoechie-tab>div.weather-temp-wrap").eq(index).addClass("active");
            });
        },
        // -------------------------------------------------------------------------- //
        // Tab panel 
        // -------------------------------------------------------------------------- //    
        tabPanel: function () {
            $('.collapse.in').prev('.panel-heading').addClass('active');
            $('#accordion').on('show.bs.collapse', function (a) {
                $(a.target).prev('.panel-heading').addClass('active');
            }
            ).on('hide.bs.collapse', function (a) {
                $(a.target).prev('.panel-heading').removeClass('active');
            }
            );
        },
        // -------------------------------------------------------------------------- //
        // Tab panel 
        // -------------------------------------------------------------------------- //    
        bgImage: function () {
            //Background image
            $(".bg-img").css('backgroundImage', function () {
                var bg = ('url(' + $(this).data("image-src") + ')');
                return bg;
            });
        },
        // -------------------------------------------------------------------------- //
        // Tab panel 
        // -------------------------------------------------------------------------- //    
        skyicon: function () {
            //Skyicon
            var icons = new Skycons({ "color": "#fff" }),
                list = [
                    "clear-day", "clear-night", "partly-cloudy-day",
                    "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                    "fog"
                ],
                i;

            for (i = list.length; i--;)
                icons.set(list[i], list[i]);

            icons.play();
        },
        // -------------------------------------------------------------------------- //
        // Progresber
        // -------------------------------------------------------------------------- //    
        progresber: function () {
            var el = document.getElementsByClassName('progressber'), l = el.length;
            for (var i = 0;
                i < l;
                i++) {
                var options = {
                    percent: el[i].getAttribute('data-percent'), size: el[i].getAttribute('data-size') || 60, lineWidth: el[i].getAttribute('data-line') || 4
                }
                    ;
                var canvas = document.createElement('canvas');
                var span = document.createElement('span');
                span.textContent = options.percent + '%';
                if (typeof (G_vmlCanvasManager) !== 'undefined') {
                    G_vmlCanvasManager.initElement(canvas);
                }
                var ctx = canvas.getContext('2d');
                canvas.width = canvas.height = options.size;
                el[i].appendChild(span);
                el[i].appendChild(canvas);
                ctx.translate(options.size / 2, options.size / 2); // change center
                var radius = (options.size - options.lineWidth) / 2;
                var drawCircle = function (color, lineWidth, percent) {
                    percent = Math.min(Math.max(0, percent || 1), 1);
                    ctx.beginPath();
                    ctx.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
                    ctx.strokeStyle = color;
                    ctx.lineCap = 'round';
                    ctx.lineWidth = lineWidth;
                    ctx.stroke();
                }
                    ;
                drawCircle('transparent', options.lineWidth, 100 / 100);
                drawCircle('#eb0254', options.lineWidth, options.percent / 100);
            }
        }
    };
    // Initialize
    $(document).ready(function () {
        inews.initialize();
        $("#datepicker").datepicker();
    });
    // Window load
    $(window).on("load", function () {
        inews.pageLoader();
    });
}(jQuery));

// Swiper slider
document.addEventListener("DOMContentLoaded", function () {
    // Check if Swiper is defined
    if (typeof Swiper !== 'undefined') {
        // Swiper library is available, initialize Swiper
        var newsTickerSwiper = new Swiper(".news-ticker", {
            navigation: {
                nextEl: ".news-ticker-next",
                prevEl: ".news-ticker-prev",
            },
        });

        var featuredCarousel = new Swiper(".featured-carousel", {
            spaceBetween: 15,
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                576: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 2.5,
                },
                992: {
                    slidesPerView: 3.5,
                },
                1200: {
                    slidesPerView: 4
                },
            },
        });

        var masonrySwiper = new Swiper(".masonry-slider", {
            navigation: {
                nextEl: ".masonry-button-next",
                prevEl: ".masonry-button-prev",
            },
            pagination: {
                el: ".masonry-pagination",
            },
        });

        var postSliderSwiper = new Swiper(".post-slider", {
            spaceBetween: 12,
            navigation: {
                nextEl: ".post-button-next",
                prevEl: ".post-button-prev",
            }
        });

        var postSliderTwoSwiper = new Swiper(".post-slider-two", {
            spaceBetween: 12,
            navigation: {
                nextEl: ".post-button-two-next",
                prevEl: ".post-button-two-prev",
            }
        });

        var postSliderThreeSwiper = new Swiper(".post-slider-three", {
            spaceBetween: 8,
            navigation: {
                nextEl: ".post-button-three-next",
                prevEl: ".post-button-three-prev",
            }
        });

        var popularPostSwiper = new Swiper(".related-news", {
            spaceBetween: 12,
            navigation: {
                nextEl: ".related-button-next",
                prevEl: ".related-button-prev",
            }
        });

        var popularPostSwiper = new Swiper(".popular-post", {
            spaceBetween: 12,
            navigation: {
                nextEl: ".popular-post-button-next",
                prevEl: ".popular-post-button-prev",
            }
        });

        var featuredCarouselTwoSwiper = new Swiper(".featured-carousel-two", {
            spaceBetween: 2,
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                576: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 2,
                },
                992: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 4
                },
            },
        });

    }

    else {
        // Swiper library is not available, handle accordingly or log a message
        console.warn("Swiper library is not available. Make sure it is properly included.");
    }
});



