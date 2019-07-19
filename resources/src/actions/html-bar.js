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
     * Make Finger Print Per Client Information for Unique Cookie
     * @param key
     * @param seed
     * @returns {number}
     */
    function murmurhash3_32_gc(key, seed) {
        var remainder, bytes, h1, h1b, c1, c2, k1, i;
        
        remainder = key.length & 3;
        bytes = key.length - remainder;
        h1 = seed;
        c1 = 0xcc9e2d51;
        c2 = 0x1b873593;
        i = 0;
        
        while (i < bytes) {
            k1 =
                ((key.charCodeAt(i) & 0xff)) |
                ((key.charCodeAt(++i) & 0xff) << 8) |
                ((key.charCodeAt(++i) & 0xff) << 16) |
                ((key.charCodeAt(++i) & 0xff) << 24);
            ++i;
            
            k1 = ((((k1 & 0xffff) * c1) + ((((k1 >>> 16) * c1) & 0xffff) << 16))) & 0xffffffff;
            k1 = (k1 << 15) | (k1 >>> 17);
            k1 = ((((k1 & 0xffff) * c2) + ((((k1 >>> 16) * c2) & 0xffff) << 16))) & 0xffffffff;
            
            h1 ^= k1;
            h1 = (h1 << 13) | (h1 >>> 19);
            h1b = ((((h1 & 0xffff) * 5) + ((((h1 >>> 16) * 5) & 0xffff) << 16))) & 0xffffffff;
            h1 = (((h1b & 0xffff) + 0x6b64) + ((((h1b >>> 16) + 0xe654) & 0xffff) << 16));
        }
        
        k1 = 0;
        
        switch (remainder) {
            case 3:
                k1 ^= (key.charCodeAt(i + 2) & 0xff) << 16;
            case 2:
                k1 ^= (key.charCodeAt(i + 1) & 0xff) << 8;
            case 1:
                k1 ^= (key.charCodeAt(i) & 0xff);
                
                k1 = (((k1 & 0xffff) * c1) + ((((k1 >>> 16) * c1) & 0xffff) << 16)) & 0xffffffff;
                k1 = (k1 << 15) | (k1 >>> 17);
                k1 = (((k1 & 0xffff) * c2) + ((((k1 >>> 16) * c2) & 0xffff) << 16)) & 0xffffffff;
                h1 ^= k1;
        }
        
        h1 ^= key.length;
        
        h1 ^= h1 >>> 16;
        h1 = (((h1 & 0xffff) * 0x85ebca6b) + ((((h1 >>> 16) * 0x85ebca6b) & 0xffff) << 16)) & 0xffffffff;
        h1 ^= h1 >>> 13;
        h1 = ((((h1 & 0xffff) * 0xc2b2ae35) + ((((h1 >>> 16) * 0xc2b2ae35) & 0xffff) << 16))) & 0xffffffff;
        h1 ^= h1 >>> 16;
        
        return h1 >>> 0;
    }
    
    /**
     * Check Is IE.
     * @returns {boolean}
     */
    function isIE() {
        return (navigator.appName === "Microsoft Internet Explorer") || (navigator.appName === "Netscape" && navigator.userAgent.indexOf("Trident/") !== -1);
    }
    
    /**
     * Get Browsers Plugins String for making finger print
     * @returns {string}
     */
    function getRegularPluginsString() {
        var re = [];
        Object.keys(navigator.plugins).forEach(function (p) {
            var mimeTypes = "";
            Object.keys(navigator.plugins[p]).forEach(function (mt) {
                mimeTypes = [navigator.plugins[p][mt].type, navigator.plugins[p][mt].suffixes].join("~");
            });
            
            re.push([navigator.plugins[p].name, navigator.plugins[p].description, mimeTypes].join("::"));
        });
        
        return re.join(";");
    }
    
    /**
     * Get IE Plugins String for making finger print
     * @returns {string}
     */
    function getIEPluginsString() {
        if (window.ActiveXObject) {
            var names = [
                "ShockwaveFlash.ShockwaveFlash",
                "AcroPDF.PDF",
                "PDF.PdfCtrl",
                "QuickTime.QuickTime",
                "rmocx.RealPlayer G2 Control",
                "rmocx.RealPlayer G2 Control.1",
                "RealPlayer.RealPlayer(tm) ActiveX Control (32-bit)",
                "RealVideo.RealVideo(tm) ActiveX Control (32-bit)",
                "RealPlayer",
                "SWCtl.SWCtl",
                "WMPlayer.OCX",
                "AgControl.AgControl",
                "Skype.Detection"
            ];
            return names.map(function (name) {
                try {
                    new ActiveXObject(name);
                    return name;
                } catch (e) {
                    return null;
                }
            }).join(";");
        } else {
            return "";
        }
    }
    
    /**
     * Get Finger Print for getting unique cookie per visit clients.
     * @returns {number}
     */
    function getFingerPrint() {
        var keys = [];
        keys.push(navigator.userAgent);
        keys.push(navigator.language);
        keys.push(screen.colorDepth);
        var resolution = [screen.height, screen.width];
        if (typeof resolution !== "undefined") {
            keys.push(resolution.join("x"));
        }
        keys.push(new Date().getTimezoneOffset());
        keys.push(!!window.sessionStorage);
        keys.push(!!window.localStorage);
        keys.push(!!window.indexedDB);
        if (document.body) {
            keys.push(typeof (document.body.addBehavior));
        } else {
            keys.push(typeof undefined);
        }
        keys.push(typeof (window.openDatabase));
        keys.push(navigator.cpuClass);
        keys.push(navigator.platform);
        keys.push(navigator.doNotTrack);
        if (isIE()) {
            keys.push(getIEPluginsString());
        } else {
            keys.push(getRegularPluginsString());
        }
        
        return murmurhash3_32_gc(keys.join("###"), 31);
    }
    
    /**
     * Show Main Bar when load window.
     */
    $(function () {
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
        
        if (!checkCookie('CVP--fp-id')) {
            setCookie('CVP--fp-id', getFingerPrint(), 1);
        }
    });
    
    /**
     * Appearance scroll option actions.
     */
    function scrollDisplay() {
        $(window).scroll(function () {
            let per = Math.round(($(this).height() * __cp_cf[bar_id].bar.scroll_point_percent) / 100);
            if ($(this).scrollTop() > per) {
                immediateDisplayBar();
            }
        });
    }
    
    /**
     * Appearance exit option actions.
     */
    function exitDisplay() {
        window.onbeforeunload = function () {
            immediateDisplayBar();
            return false;
        };
    }
    
    /**
     * Appearance immediately option actions.
     */
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
    if (document.querySelector('#main--cp-bar-close-btn-' + bar_id)) {
        $('#main--cp-bar-close-btn-' + bar_id).on('click', function () {
            showHideMainBar(true);
        });
    }
    
    /**
     * close button click of cta bar.
     */
    if (document.querySelector('#cta--cp-bar-close-btn-' + bar_id)) {
        $('#cta--cp-bar-close-btn-' + bar_id).on('click', function () {
            showHideCtaBar(true);
        });
    }
    
    /**
     * Main bars Action button click after event.
     */
    function cp_bar_action_btn_click_after() {
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
    }
    
    /**
     * main bar button click.
     */
    if (document.querySelector('#cp--bar-action-btn-' + bar_id)) {
        $('#cp--bar-action-btn-' + bar_id).on('click', function () {
            if (window.__cp_bar_config.option === 'preview') {
                cp_bar_action_btn_click_after();
            } else {
                $.post(__cp_cf[bar_id].act_btn_action, {
                    cookie: checkCookie("CVP--fp-id") ? getCookie("CVP--fp-id") : getFingerPrint()
                }).done((r) => {
                    console.log(r);
                }).always(() => {
                    cp_bar_action_btn_click_after();
                });
            }
        });
    }
    
    /**
     * CTA button click after event
     */
    function cta_cp_bar_button_click_after() {
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
    }
    
    /**
     * CTA Button click event
     */
    if (document.querySelector('#cta--cp-bar-button-' + bar_id)) {
        $('#cta--cp-bar-button-' + bar_id).on('click', function () {
            if ($('#lead_capture_cta_name__cp_bar_' + bar_id).val() === '' || $('#lead_capture_cta_email__cp_bar_' + bar_id).val() === '') {
                alert('Name and Email field is required.');
                $('#lead_capture_cta_name__cp_bar_' + bar_id).focus();
                return false;
            }
            
            let param = $('#cp-bar--cta-form-' + bar_id).serialize() + "&cookie=" + (checkCookie("CVP--fp-id") ? getCookie("CVP--fp-id") : getFingerPrint());
            if (window.__cp_bar_config.option === 'preview') {
                cta_cp_bar_button_click_after();
            } else {
                $.post($('#cp-bar--cta-form-' + bar_id).attr('action'), param)
                    .done((r) => {
                        console.log(r);
                    })
                    .always(() => {
                        cta_cp_bar_button_click_after();
                    });
            }
        });
    }
    
    /**
     * Set Cookie event
     * @param cname
     * @param cvalue
     * @param exdays
     */
    function setCookie(cname, cvalue, exdays) {
        let d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    
    /**
     * Get Cookie
     * @param cname
     * @returns {string}
     */
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
    
    /**
     * Check existing cookie
     * @param cname
     * @returns {string|boolean}
     */
    function checkCookie(cname) {
        let user = getCookie(cname);
        
        return (user && user !== "");
    }
})(jQuery);
