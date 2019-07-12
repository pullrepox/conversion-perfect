(function ($) {
    'use strict';
    
    /**
     * Show Hide Main bar.
     * @param flag
     */
    function showHideMainBar(flag) {
        if (window.__cp_bar_config.bar.position !== 'bottom') {
            $('#main-preview--cp-bar').css('top', (flag ? '-450px' : 0));
        } else {
            $('#main-preview--cp-bar').css('bottom', (flag ? '-450px' : 0));
        }
        
        if (flag) {
            window.localStorage.setItem('closed-cp-bar', 'closed');
        }
    }
    
    /**
     * Show Hide CTA Bar
     * @param flag
     */
    function showHideCtaBar(flag) {
        if (!flag) {
            $('#cta-preview--cp-bar').show();
        }
        
        $('#cta-preview--cp-bar').css('bottom', (flag ? '-450px' : 0));
        
        if (window.__cp_bar_config.bar.position !== 'bottom') {
            $('#cta-preview--cp-bar').css('top', (flag ? '-450px' : 0));
        } else {
            $('#cta-preview--cp-bar').css('bottom', (flag ? '-450px' : 0));
        }
        
        if (flag) {
            $('#cta-preview--cp-bar').hide('slow');
            window.localStorage.setItem('closed-cta-cp-bar', 'closed');
        }
    }
    
    /**
     * Show Main Bar when load window.
     */
    $(function () {
        // console.log(window.__cp_bar_config.countdown_target);
        if (window.__cp_bar_config.bar.countdown !== 'none') {
            let countDownDate = new Date(window.__cp_bar_config.countdown_target.toLocaleString('en-US', {
                timeZone: window.__cp_bar_config.bar.countdown_timezone
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
                
                if (window.__cp_bar_config.bar.countdown_format === 'dd') {
                    $('#cp-bar--countdown-days').html((`0${days}`).slice(-2));
                }
                
                if (window.__cp_bar_config.bar.countdown_format !== 'mm') {
                    $('#cp-bar--countdown-hours').html((`0${hours}`).slice(-2));
                }
                
                $('#cp-bar--countdown-minutes').html((`0${minutes}`).slice(-2));
                $('#cp-bar--countdown-seconds').html((`0${seconds}`).slice(-2));
                
                if (distance < 0) {
                    clearInterval(x);
                    //expired action here.
                    if (window.__cp_bar_config.bar.countdown_on_expiry === 'hide_bar') {
                        showHideMainBar(true);
                        showHideCtaBar(true);
                    } else if (window.__cp_bar_config.bar.countdown_on_expiry === 'redirect') {
                        location.href = window.__cp_bar_config.bar.countdown_expiration_url;
                    } else if (window.__cp_bar_config.bar.countdown_on_expiry === 'display_text') {
                        $('#cp-bar--cta-content-section').html(`<div style="font-weight: bold;">${window.__cp_bar_config.bar.countdown_expiration_text}</div>`);
                        setTimeout(function () {
                            showHideCtaBar(true);
                        }, (window.__cp_bar_config.bar.autohide_delay_seconds * 1000));
                    }
                }
            }, 1000);
        }
    });
    
    window.onload = function () {
        showHideMainBar(window.localStorage.getItem('closed-cp-bar') && window.localStorage.getItem('closed-cp-bar') === 'closed');
    };
    
    /**
     * close button click of main bar.
     */
    $('#main--cp-bar-close-btn').on('click', function () {
        showHideMainBar(true);
    });
    
    /**
     * close button click of cta bar.
     */
    $('#cta--cp-bar-close-btn').on('click', function () {
        showHideCtaBar(true);
    });
    
    /**
     * main bar button click.
     */
    $('#cp--bar-action-btn').on('click', function () {
        if (window.__cp_bar_config.bar.button_action === 'open_click_url') {
            window.open(window.__cp_bar_config.bar.button_click_url, 'Conversion Perfect', '_blank');
            showHideMainBar(true);
        } else {
            setTimeout(function () {
                showHideMainBar(true);
            }, (window.__cp_bar_config.bar.autohide_delay_seconds * 1000));
        }
        
        if (window.__cp_bar_config.bar.integration_type !== 'none') {
            showHideCtaBar((window.localStorage.getItem('closed-cta-cp-bar') && window.localStorage.getItem('closed-cta-cp-bar') === 'closed'));
        }
    });
    
    $('#cta--cp-bar-button').on('click', function () {
        if ($('#lead_capture_cta_name__cp_bar').val() === '' || $('#lead_capture_cta_email__cp_bar').val() === '') {
            alert('Name and Email field is required.');
            return false;
        }
        
        $.post($('#cp-bar--cta-form').data('action'), $('#cp-bar--cta-form').serialize())
            .done((r) => {
                console.log(r);
            })
            .always(() => {
                if (window.__cp_bar_config.bar.after_submit === 'show_message' || window.__cp_bar_config.bar.after_submit === 'show_message_hide_bar') {
                    $('#cp-bar--cta-content-section').html(`<div style="font-weight: bold;">${window.__cp_bar_config.bar.message}</div>`);
                    if (window.__cp_bar_config.bar.after_submit === 'show_message_hide_bar') {
                        setTimeout(function () {
                            showHideCtaBar(true);
                        }, (window.__cp_bar_config.bar.autohide_delay_seconds * 1000));
                    }
                } else {
                    showHideCtaBar(true);
                    location.href = window.__cp_bar_config.bar.redirect_url;
                }
            });
    });
})(jQuery);
