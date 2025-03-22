(function($) {
    "use strict";
    
    $(document).ready(function() {
        // Initialize SPAPP
        try {
            var app = $.spapp({
                templateDir: './',  
                pageNotFound: '404.html',
                defaultView: 'home'
            });
            app.run();
        } catch(e) {
            console.error('SPAPP initialization error:', e);
        }

        initScrollNav();
        
        Chocolat(document.querySelectorAll('.image-link'), {
            imageSize: 'contain',
            loop: true,
        });

        $('#header-wrap').on('click', '.search-toggle', function(e) {
            var selector = $(this).data('selector');
    
            $(selector).toggleClass('show').find('.search-input').focus();
            $(this).toggleClass('active');
    
            e.preventDefault();
        });


        // close when click off of container
        $(document).on('click touchstart', function (e){
            if (!$(e.target).is('.search-toggle, .search-toggle *, #header-wrap, #header-wrap *')) {
                $('.search-toggle').removeClass('active');
                $('#header-wrap').removeClass('show');
            }
        });

        $('.main-slider').slick({
            autoplay: false,
            autoplaySpeed: 4000,
            fade: true,
            dots: true,
            prevArrow: $('.prev'),
            nextArrow: $('.next'),
        }); 

        $('.product-grid').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 2000,
            dots: true,
            arrows: false,
            responsive: [
              {
                breakpoint: 1400,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 1
                }
              },
              {
                breakpoint: 999,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 1
                }
              },
              {
                breakpoint: 660,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1
                }
              }
              // You can unslick at a given breakpoint now by adding:
              // settings: "unslick"
              // instead of a settings object
            ]
        });

        AOS.init({
            duration: 1200,
            once: true,
        })

        jQuery('.stellarnav').stellarNav({
            theme: 'plain',
            closingDelay: 250,
            // mobileMode: false,
        });

        // Tab functionality for books
        function initBookTabs() {
            const tabs = document.querySelectorAll('.tabs .tab');
            const tabContents = document.querySelectorAll('[data-tab-content]');
        
            // Show first tab by default
            tabContents[0]?.classList.add('active');
            tabs[0]?.classList.add('active');
        
            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const targetId = tab.getAttribute('data-tab-target');
                    const target = document.querySelector(targetId);
        
                    // Remove active class from all tabs and contents
                    tabs.forEach(t => t.classList.remove('active'));
                    tabContents.forEach(content => {
                        content.classList.remove('active');
                        content.style.display = 'none';
                    });
        
                    // Add active class to clicked tab and its content
                    tab.classList.add('active');
                    if (target) {
                        target.classList.add('active');
                        target.style.display = 'block';
                        // Force reflow for smooth transition
                        target.offsetHeight;
                        target.style.opacity = '1';
                    }
                });
            });
        }
        
        // Initialize tabs
        initBookTabs();

    }); // End of a document

    // Tab functionality
    const tabs = document.querySelectorAll('[data-tab-target]');
    const tabContents = document.querySelectorAll('[data-tab-content]');

    // Show first tab by default
    if (tabContents.length > 0) {
        tabContents[0].classList.add('active');
    }

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const target = document.querySelector(tab.dataset.tabTarget);
            
            // Remove active class from all tabs and contents
            tabs.forEach(t => t.classList.remove('active'));
            tabContents.forEach(content => {
                content.classList.remove('active');
                content.style.display = 'none';
            });
            
            // Add active class to clicked tab and its content
            tab.classList.add('active');
            if (target) {
                target.classList.add('active');
                target.style.display = 'block';
                // Force a reflow to ensure transition works
                target.offsetHeight;
                target.style.opacity = '1';
            }
        });
    });

    // Responsive Navigation with Button

    const hamburger = document.querySelector(".hamburger");
    const navMenu = document.querySelector(".menu-list");

    hamburger.addEventListener("click", mobileMenu);

    function mobileMenu() {
        hamburger.classList.toggle("active");
        navMenu.classList.toggle("responsive");
    }

    const navLink = document.querySelectorAll(".nav-link");

    navLink.forEach(n => n.addEventListener("click", closeMenu));

    function closeMenu() {
        hamburger.classList.remove("active");
        navMenu.classList.remove("responsive");
    }

    var initScrollNav = function() {
        var scroll = $(window).scrollTop();
    
        if (scroll >= 200) {
            $('#header').addClass("fixed-top");
        }else{
            $('#header').removeClass("fixed-top");
        }
    }

    $(window).scroll(function() {    
        initScrollNav();
    }); 

    $(document).ready(function(){
        initScrollNav();
    
        Chocolat(document.querySelectorAll('.image-link'), {
            imageSize: 'contain',
            loop: true,
        })

        $('#header-wrap').on('click', '.search-toggle', function(e) {
            var selector = $(this).data('selector');
    
            $(selector).toggleClass('show').find('.search-input').focus();
            $(this).toggleClass('active');
    
            e.preventDefault();
        });
    
    
        // close when click off of container
        $(document).on('click touchstart', function (e){
            if (!$(e.target).is('.search-toggle, .search-toggle *, #header-wrap, #header-wrap *')) {
                $('.search-toggle').removeClass('active');
                $('#header-wrap').removeClass('show');
            }
        });
    
        // Initialize slick slider only once here
        setTimeout(function() {
            $('.main-slider').slick({
                autoplay: false,
                autoplaySpeed: 4000,
                fade: true,
                dots: true,
                prevArrow: $('.prev'),
                nextArrow: $('.next'),
                infinite: true,
                speed: 500,
                cssEase: 'linear',
                slidesToShow: 1,
                slidesToScroll: 1,
                adaptiveHeight: true
            });
        }, 100);
    
        $('.product-grid').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 2000,
            dots: true,
            arrows: false,
            responsive: [
              {
                breakpoint: 1400,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 1
                }
              },
              {
                breakpoint: 999,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 1
                }
              },
              {
                breakpoint: 660,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1
                }
              }
              // You can unslick at a given breakpoint now by adding:
              // settings: "unslick"
              // instead of a settings object
            ]
        });
    
        AOS.init({
            duration: 1200,
            once: true,
        })
    
        jQuery('.stellarnav').stellarNav({
            theme: 'plain',
            closingDelay: 250,
            // mobileMode: false,
        });
    }); // End of a document


    // Add this inside your document ready function
    $(document).ready(function() {
        // Star rating functionality
        $('.star-rating span').on('click', function() {
            const rating = $(this).data('rating');
            $('.star-rating span').each(function() {
                const starRating = $(this).data('rating');
                if (starRating <= rating) {
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }
            });
        });
    
        // Hover effect
        $('.star-rating span').hover(
            function() {
                const rating = $(this).data('rating');
                $('.star-rating span').each(function() {
                    const starRating = $(this).data('rating');
                    if (starRating <= rating) {
                        $(this).addClass('hover');
                    }
                });
            },
            function() {
                $('.star-rating span').removeClass('hover');
            }
        );
    
        // Form submission handling
        $('#review-form').on('submit', function(e) {
            e.preventDefault();
            // Add your form submission logic here
        });
    });
    // Admin Dashboard Functions
    function addBook() {
        // Simulate adding a book
        alert('Book added successfully!');
        $('#addBookModal').modal('hide');
    }

    function editBook(id) {
        // Book data is already populated in the modal HTML
        $('#editBookModal').modal('show');
    }

    function updateBook() {
        // Simulate updating a book
        alert('Book updated successfully!');
        $('#editBookModal').modal('hide');
    }

    function deleteBook(id) {
        if (confirm('Are you sure you want to delete this book?')) {
            // Simulate deleting a book
            alert('Book deleted successfully!');
        }
    }

    function deleteReview(id) {
        if (confirm('Are you sure you want to delete this review?')) {
            // Simulate deleting a review
            alert('Review deleted successfully!');
        }
    }})(jQuery);


    // Header scroll behavior
    let lastScrollTop = 0;
    const header = document.getElementById('header-wrap');
    const scrollThreshold = 100; // Adjust this value as needed
    
    window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > scrollThreshold) {
            if (scrollTop > lastScrollTop) {
                // Scrolling down
                header.classList.add('header-hidden');
            } else {
                // Scrolling up
                header.classList.remove('header-hidden');
            }
        } else {
            // At the top of the page
            header.classList.remove('header-hidden');
        }
        
        lastScrollTop = scrollTop;
    });
