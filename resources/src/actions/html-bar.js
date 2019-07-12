(function ($) {
    'use strict';
    
    var __cp_cf = window.__cp_bar_config;
    var bar_id = __cp_cf.bar_id;
    
    /**
     * Show Hide Main bar.
     * @param flag
     */
    function showHideMainBar(flag) {
        if (__cp_cf[bar_id].bar.position !== 'bottom') {
            $('#main-preview--cp-bar-' + bar_id).css('top', (flag ? '-450px' : 0));
        } else {
            $('#main-preview--cp-bar-' + bar_id).css('bottom', (flag ? '-450px' : 0));
        }
        
        if (flag) {
            window.localStorage.setItem('closed-cp-bar-' + bar_id, 'closed');
        }
    }
    
    /**
     * Show Hide CTA Bar
     * @param flag
     */
    function showHideCtaBar(flag) {
        if (__cp_cf[bar_id].bar.list === '' && __cp_cf[bar_id].bar.list === null) {
            $('#cta-preview--cp-bar-' + bar_id).hide('slow');
            window.localStorage.setItem('closed-cta-cp-bar-' + bar_id, 'closed');
            flag = true;
            return;
        }
        if (!flag) {
            $('#cta-preview--cp-bar-' + bar_id).show();
        }
        
        $('#cta-preview--cp-bar-' + bar_id).css('bottom', (flag ? '-450px' : 0));
        
        if (__cp_cf[bar_id].bar.position !== 'bottom') {
            $('#cta-preview--cp-bar-' + bar_id).css('top', (flag ? '-450px' : 0));
        } else {
            $('#cta-preview--cp-bar-' + bar_id).css('bottom', (flag ? '-450px' : 0));
        }
        
        if (flag) {
            $('#cta-preview--cp-bar-' + bar_id).hide('slow');
            window.localStorage.setItem('closed-cta-cp-bar-' + bar_id, 'closed');
        }
    }
    
    /**
     * Show Main Bar when load window.
     */
    $(function () {
        // console.log(__cp_cf[bar_id].countdown_target);
        if (__cp_cf[bar_id].bar.countdown !== 'none') {
            let countDownDate = new Date(__cp_cf[bar_id].countdown_target.toLocaleString('en-US', {
                timeZone: __cp_cf[bar_id].bar.countdown_timezone
            })).getTime();
            
            let x = setInterval(function () {
                // Get today's date and time
                let now = new Date().getTime();
                // Find the distance between now and the count down date
                let distance = countDownDate - now;
                
                // Time calculations for days, hours, minutes and seconds
                let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                days = isNaN(days) ? 0 : days;
                hours = isNaN(hours) ? 0 : hours;
                minutes = isNaN(minutes) ? 0 : minutes;
                seconds = isNaN(seconds) ? 0 : seconds;
                
                if (days === 0 && hours === 0 && minutes === 0 && seconds === 0) {
                    distance = -1;
                }
                
                if (__cp_cf[bar_id].bar.countdown_format === 'dd') {
                    $('#cp-bar--countdown-days-' + bar_id).html((`0${days}`).slice(-2));
                }
                
                if (__cp_cf[bar_id].bar.countdown_format !== 'mm') {
                    $('#cp-bar--countdown-hours-' + bar_id).html((`0${hours}`).slice(-2));
                }
                
                $('#cp-bar--countdown-minutes-' + bar_id).html((`0${minutes}`).slice(-2));
                $('#cp-bar--countdown-seconds-' + bar_id).html((`0${seconds}`).slice(-2));
                
                if (distance < 0) {
                    clearInterval(x);
                    //expired action here.
                    if (__cp_cf[bar_id].bar.countdown_on_expiry === 'hide_bar') {
                        showHideMainBar(true);
                        showHideCtaBar(true);
                    } else if (__cp_cf[bar_id].bar.countdown_on_expiry === 'redirect') {
                        location.href = __cp_cf[bar_id].bar.countdown_expiration_url;
                    } else if (__cp_cf[bar_id].bar.countdown_on_expiry === 'display_text') {
                        $('#cp-bar--cta-content-section-' + bar_id).html(`<div style="font-weight: bold;">${__cp_cf[bar_id].bar.countdown_expiration_text}</div>`);
                        setTimeout(function () {
                            showHideCtaBar(true);
                        }, (__cp_cf[bar_id].bar.autohide_delay_seconds * 1000));
                    }
                }
            }, 1000);
        }
    
        switch (__cp_cf[bar_id].bar.show_bar_type) {
            case "immediate":
                immediateDisplayBar();
                break;
            case "delay":
                setTimeout(function () {
                    immediateDisplayBar();
                }, (__cp_cf[bar_id].bar.delay_in_seconds * 1000));
                break;
            case "scroll":
                scrollDisplay();
                break;
            case "exit":
                exitDisplay();
                break;
            default:
                showHideMainBar(window.localStorage.getItem('closed-cp-bar-' + bar_id) && window.localStorage.getItem('closed-cp-bar-' + bar_id) === 'closed');
                break;
        }
    
        if (__cp_cf[bar_id].bar.meta_title !== '') {
            document.title = __cp_cf[bar_id].bar.meta_title;
        }
    
        if (__cp_cf[bar_id].bar.meta_description !== '') {
            if ($('meta[name=description]')) {
                $('meta[name=description]').attr('content', __cp_cf[bar_id].bar.meta_description);
            } else {
                $(document.head).append('<meta name="description" content="' + __cp_cf[bar_id].bar.meta_description + '"/>');
            }
        }
    
        if (__cp_cf[bar_id].bar.meta_keywords !== '') {
            if ($('meta[name=keywords]')) {
                $('meta[name=keywords]').attr('content', __cp_cf[bar_id].bar.meta_keywords);
            } else {
                $(document.head).append('<meta name="keywords" content="' + __cp_cf[bar_id].bar.meta_keywords + '"/>');
            }
        }
    });
    
    function scrollDisplay() {
        $(window).scroll(function () {
            let per = Math.round(($(this).height() * __cp_cf[bar_id].bar.scroll_point_percent) / 100);
            if ($(this).scrollTop() > per) {
                immediateDisplayBar();
            }
        });
    }
    
    function exitDisplay() {
        window.onbeforeunload = function () {
            immediateDisplayBar();
            return false;
        };
    }
    
    function immediateDisplayBar() {
        if (__cp_cf[bar_id].bar.frequency === 'every') {
            showHideMainBar(window.localStorage.getItem('closed-cp-bar-' + bar_id) && window.localStorage.getItem('closed-cp-bar-' + bar_id) === 'closed');
        } else if (__cp_cf[bar_id].bar.frequency === 'day') {
            if (!checkCookie('__cp_bar_frequency_day-' + bar_id)) {
                setCookie('__cp_bar_frequency_day-' + bar_id, 'day', 1);
                showHideMainBar(window.localStorage.getItem('closed-cp-bar-' + bar_id) && window.localStorage.getItem('closed-cp-bar-' + bar_id) === 'closed');
            }
        } else if (__cp_cf[bar_id].bar.frequency === 'week') {
            if (!checkCookie('__cp_bar_frequency_week-' + bar_id)) {
                setCookie('__cp_bar_frequency_week-' + bar_id, 'week', 7);
                showHideMainBar(window.localStorage.getItem('closed-cp-bar-' + bar_id) && window.localStorage.getItem('closed-cp-bar-' + bar_id) === 'closed');
            }
        } else if (__cp_cf[bar_id].bar.frequency === 'once') {
            if (!(window.localStorage.getItem('__cp_bar_frequency_once-' + bar_id) && window.localStorage.getItem('__cp_bar_frequency_once-' + bar_id) === 'opened')) {
                window.localStorage.setItem('__cp_bar_frequency_once-' + bar_id, 'opened');
                showHideMainBar(window.localStorage.getItem('closed-cp-bar-' + bar_id) && window.localStorage.getItem('closed-cp-bar-' + bar_id) === 'closed');
            }
        }
    }
    
    /**
     * close button click of main bar.
     */
    $('#main--cp-bar-close-btn-' + bar_id).on('click', function () {
        showHideMainBar(true);
    });
    
    /**
     * close button click of cta bar.
     */
    $('#cta--cp-bar-close-btn-' + bar_id).on('click', function () {
        showHideCtaBar(true);
    });
    
    /**
     * main bar button click.
     */
    $('#cp--bar-action-btn-' + bar_id).on('click', function () {
        if (__cp_cf[bar_id].bar.button_action === 'open_click_url') {
            window.open(__cp_cf[bar_id].bar.button_click_url, 'Conversion Perfect', '_blank');
            showHideMainBar(true);
        } else {
            setTimeout(function () {
                showHideMainBar(true);
            }, (__cp_cf[bar_id].bar.autohide_delay_seconds * 1000));
        }
        
        if (__cp_cf[bar_id].bar.integration_type !== 'none') {
            showHideCtaBar((window.localStorage.getItem('closed-cta-cp-bar-' + bar_id) && window.localStorage.getItem('closed-cta-cp-bar-' + bar_id) === 'closed'));
        }
    });
    
    $('#cta--cp-bar-button-' + bar_id).on('click', function () {
        if ($('#lead_capture_cta_name__cp_bar_' + bar_id).val() === '' || $('#lead_capture_cta_email__cp_bar_' + bar_id).val() === '') {
            alert('Name and Email field is required.');
            $('#lead_capture_cta_name__cp_bar_' + bar_id).focus();
            return false;
        }
        
        $.post($('#cp-bar--cta-form-' + bar_id).attr('action'), $('#cp-bar--cta-form-' + bar_id).serialize())
            .done((r) => {
                console.log(r);
            })
            .always(() => {
                if (__cp_cf[bar_id].bar.after_submit === 'show_message' || __cp_cf[bar_id].bar.after_submit === 'show_message_hide_bar') {
                    $('#cp-bar--cta-content-section-' + bar_id).html(`<div style="font-weight: bold;">${__cp_cf[bar_id].bar.message}</div>`);
                    if (__cp_cf[bar_id].bar.after_submit === 'show_message_hide_bar') {
                        setTimeout(function () {
                            showHideCtaBar(true);
                        }, (__cp_cf[bar_id].bar.autohide_delay_seconds * 1000));
                    }
                } else {
                    showHideCtaBar(true);
                    location.href = __cp_cf[bar_id].bar.redirect_url;
                }
            });
    });
    
    function setCookie(cname, cvalue, exdays) {
        let d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    
    function getCookie(cname) {
        let name = cname + "=";
        let ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) === 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    
    function checkCookie(cname) {
        let user = getCookie(cname);
        
        return (user && user !== "");
    }
})(jQuery);
