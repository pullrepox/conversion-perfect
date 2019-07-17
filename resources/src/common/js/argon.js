require('jquery.scrollbar/jquery.scrollbar.min.js');
require('jquery-scroll-lock/dist/jquery-scrollLock.min.js');
import Cookies from 'js-cookie';
/*!

=========================================================
* Argon Dashboard PRO - v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2019 Creative Tim (https://www.creative-tim.com)

* Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

*/
//
// Layout
//

'use strict';

let Layout = (function () {
    
    function pinSidenav() {
        $('.sidenav-toggler').addClass('active');
        $('.sidenav-toggler').data('action', 'sidenav-unpin');
        $('body').removeClass('g-sidenav-hidden').addClass('g-sidenav-show g-sidenav-pinned');
        $('body').append('<div class="backdrop d-xl-none" data-action="sidenav-unpin" data-target=' + $('#sidenav-main').data('target') + ' />');
        
        // Store the sidenav state in a cookie session
        Cookies.set('sidenav-state', 'pinned');
    }
    
    function unpinSidenav() {
        $('.sidenav-toggler').removeClass('active');
        $('.sidenav-toggler').data('action', 'sidenav-pin');
        $('body').removeClass('g-sidenav-show g-sidenav-pinned').addClass('g-sidenav-hidden');
        $('body').find('.backdrop').remove();
        
        // Store the sidenav state in a cookie session
        Cookies.set('sidenav-state', 'unpinned');
    }
    
    // Set sidenav state from cookie
    
    let $sidenavState = Cookies.get('sidenav-state') ? Cookies.get('sidenav-state') : 'pinned';
    
    if ($(window).width() >= 1200) {
        if ($sidenavState === 'pinned') {
            pinSidenav();
        }
        
        if (Cookies.get('sidenav-state') === 'unpinned') {
            unpinSidenav();
        }
    } else {
        unpinSidenav();
    }
    
    $("body").on("click", "[data-action]", function (e) {
        
        e.preventDefault();
        
        let $this = $(this);
        let action = $this.data('action');
        let target = $this.data('target');
        
        // Manage actions
        
        switch (action) {
            case 'sidenav-pin':
                pinSidenav();
                break;
            
            case 'sidenav-unpin':
                unpinSidenav();
                break;
        }
    });
    
    
    // Add sidenav modifier classes on mouse events
    
    $('.sidenav').on('mouseenter', function () {
        if (!$('body').hasClass('g-sidenav-pinned')) {
            $('body').removeClass('g-sidenav-hide').removeClass('g-sidenav-hidden').addClass('g-sidenav-show');
        }
    });
    
    $('.sidenav').on('mouseleave', function () {
        if (!$('body').hasClass('g-sidenav-pinned')) {
            $('body').removeClass('g-sidenav-show').addClass('g-sidenav-hide');
            
            setTimeout(function () {
                $('body').removeClass('g-sidenav-hide').addClass('g-sidenav-hidden');
            }, 300);
        }
    });
    
    
    // Make the body full screen size if it has not enough content inside
    $(window).on('load resize', function () {
        if ($('body').height() < 800) {
            // $('body').css('min-height', '100vh');
            // $('#footer-main').addClass('footer-auto-bottom')
        }
    })
    
})();


//
// Navbar
//

'use strict';

let Navbar = (function () {
    
    // Variables
    
    let $nav = $('.navbar-nav, .navbar-nav .nav');
    let $collapse = $('.navbar .collapse');
    let $dropdown = $('.navbar .dropdown');
    
    // Methods
    
    function accordion($this) {
        $this.closest($nav).find($collapse).not($this).collapse('hide');
    }
    
    function closeDropdown($this) {
        let $dropdownMenu = $this.find('.dropdown-menu');
        
        $dropdownMenu.addClass('close');
        
        setTimeout(function () {
            $dropdownMenu.removeClass('close');
        }, 200);
    }
    
    
    // Events
    
    $collapse.on({
        'show.bs.collapse': function () {
            accordion($(this));
        }
    });
    
    $dropdown.on({
        'hide.bs.dropdown': function () {
            closeDropdown($(this));
        }
    })
    
})();


//
// Navbar collapse
//


let NavbarCollapse = (function () {
    
    // Variables
    
    let $nav = $('.navbar-nav'),
        $collapse = $('.navbar .navbar-custom-collapse');
    
    
    // Methods
    
    function hideNavbarCollapse($this) {
        $this.addClass('collapsing-out');
    }
    
    function hiddenNavbarCollapse($this) {
        $this.removeClass('collapsing-out');
    }
    
    
    // Events
    
    if ($collapse.length) {
        $collapse.on({
            'hide.bs.collapse': function () {
                hideNavbarCollapse($collapse);
            }
        });
        
        $collapse.on({
            'hidden.bs.collapse': function () {
                hiddenNavbarCollapse($collapse);
            }
        })
    }
    
})();

//
// Scroll to (anchor links)
//
'use strict';
let ScrollTo = (function () {
    
    //
    // Variables
    //
    
    let $scrollTo = $('.scroll-me, [data-scroll-to], .toc-entry a');
    
    
    //
    // Methods
    //
    
    function scrollTo($this) {
        let $el = $this.attr('href');
        let offset = $this.data('scroll-to-offset') ? $this.data('scroll-to-offset') : 0;
        let options = {
            scrollTop: $($el).offset().top - offset
        };
        
        // Animate scroll to the selected section
        $('html, body').stop(true, true).animate(options, 600);
        
        event.preventDefault();
    }
    
    
    //
    // Events
    //
    
    if ($scrollTo.length) {
        $scrollTo.on('click', function (event) {
            scrollTo($(this));
        });
    }
    
})();

//
// Checklist
//

'use strict';

let Checklist = (function () {
    
    //
    // Variables
    //
    
    let $list = $('[data-toggle="checklist"]');
    
    
    //
    // Methods
    //
    
    // Init
    function init($this) {
        let $checkboxes = $this.find('.checklist-entry input[type="checkbox"]');
        
        $checkboxes.each(function () {
            checkEntry($(this));
        });
        
    }
    
    function checkEntry($checkbox) {
        if ($checkbox.is(':checked')) {
            $checkbox.closest('.checklist-item').addClass('checklist-item-checked');
        } else {
            $checkbox.closest('.checklist-item').removeClass('checklist-item-checked');
        }
    }
    
    
    //
    // Events
    //
    
    // Init
    if ($list.length) {
        $list.each(function () {
            init($(this));
        });
        
        $list.find('input[type="checkbox"]').on('change', function () {
            checkEntry($(this));
        });
    }
    
})();

//
// Form control
//

'use strict';

let FormControl = (function () {
    
    // Variables
    
    let $input = $('.form-control');
    
    
    // Methods
    
    function init($this) {
        $this.on('focus blur', function (e) {
            $(this).parents('.form-group').toggleClass('focused', (e.type === 'focus'));
        }).trigger('blur');
    }
    
    
    // Events
    
    if ($input.length) {
        init($input);
    }
    
})();

//
// Scrollbar
//

'use strict';

let Scrollbar = (function () {
    
    // Variables
    
    let $scrollbar = $('.scrollbar-inner');
    
    
    // Methods
    
    function init() {
        $scrollbar.scrollbar().scrollLock()
    }
    
    
    // Events
    
    if ($scrollbar.length) {
        init();
    }
    
})();

//
// Onscreen - viewport checker
//

'use strict';

let OnScreen = (function () {
    
    // Variables
    
    let $onscreen = $('[data-toggle="on-screen"]');
    
    
    // Methods
    
    function init($this) {
        let options = {
            container: window,
            direction: 'vertical',
            doIn: function () {
                //alert();
            },
            doOut: function () {
                // Do something to the matched elements as they get off scren
            },
            tolerance: 200,
            throttle: 50,
            toggleClass: 'on-screen',
            debug: false
        };
        
        $this.onScreen(options);
    }
    
    
    // Events
    
    if ($onscreen.length) {
        init($onscreen);
    }
    
})();
