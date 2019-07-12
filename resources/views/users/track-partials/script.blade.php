<!-- Scripts -->
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i|Open+Sans:300,300i,400,400i,600,600i,700,700i&display=swap" rel="stylesheet"/>
<style type="text/css">
    body * {
        font-family: "Open Sans", sans-serif;
    }
    
    .video-code-preview iframe {
        width: 280px !important;
        height: 158px !important;
    }
    
    .cta-preview--cp-bar {
        display: none;
    }
    
    .main-preview--cp-bar, .cta-preview--cp-bar {
        -webkit-transition: top .7s, bottom .7s;
        -moz-transition: top .7s, bottom .7s;
        -o-transition: top .7s, bottom .7s;
        transition: top .7s, bottom .7s;
    }
    
    input::-webkit-input-placeholder {
        color: inherit;
        opacity: .5;
    }
    
    input:-ms-input-placeholder {
        color: inherit;
        opacity: .5;
    }
    
    input::-ms-input-placeholder {
        color: inherit;
        opacity: .5;
    }
    
    input::placeholder {
        color: inherit;
        opacity: .5;
    }
    
    input:focus {
        outline: 0 !important;
        box-shadow: none;
    }
    
    .cp--bar--close-btn, button {
        cursor: pointer;
    }
    
    button:focus, button:active {
        outline: 0 !important;
    }
</style>
<div id="main-preview--cp-bar-{{ $bar->id }}" class="main-preview--cp-bar" style="width: 100%;margin: 0 !important;padding: 0 !important;z-index: 99999999;
    top: {{ $bar->position == 'top' || $bar->position == 'top_sticky' ? '-450px' : 'auto' }};
    bottom: {{ $bar->position == 'bottom' ? '-450px' : 'auto' }};
    left: 0; position: {{ $bar->position == 'top' ? 'relative' : 'fixed' }}">
    @include('users.track-partials.preview-main')
</div>
@if ($bar->integration_type != 'none')
    <div id="cta-preview--cp-bar-{{ $bar->id }}" class="cta-preview--cp-bar" style="width: 100%;margin: 0 !important;padding: 0 !important;z-index: 99999999;
        top: {{ $bar->position == 'top' || $bar->position == 'top_sticky' ? '-450px' : 'auto' }};
        bottom: {{ $bar->position == 'bottom' ? '-450px' : 'auto' }};
        left: 0; position: {{ $bar->position == 'top' ? 'relative' : 'fixed' }}">
        @if ($bar->opt_in_type == 'standard')
            @include('users.track-partials.preview-cta-standard')
        @else
            @include('users.track-partials.preview-cta-media')
        @endif
    </div>
@endif
<script type="text/javascript">
    window.__cp_bar_config = window.__cp_bar_config || {};
    window.__cp_bar_config['{{ $bar->id }}'] = {
        BASE: '{{ request()->root() }}',
        bar: {!! json_encode($bar) !!},
        token: '{{ csrf_token() }}',
        countdown_target: '{{ $bar->countdown == 'none' ? '' : ($bar->countdown == 'calendar' ? (date('F d, Y', strtotime($bar->countdown_end_date)) . ' ' . $bar->countdown_end_time) : getCountdownTarget($bar->countdown_days, $bar->countdown_hours, $bar->countdown_minutes, $bar->created_at)) }}'
    };
    
    (function () {
        var __cp_cf = window.__cp_bar_config;
        var bar_id = '{{ $bar->id }}';
        
        function showHideMainBar(flag) {
            if (__cp_cf[bar_id].bar.position !== 'bottom') {
                document.querySelector('#main-preview--cp-bar-' + bar_id).style.top = (flag ? '-450px' : 0);
            } else {
                document.querySelector('#main-preview--cp-bar-' + bar_id).style.bottom = (flag ? '-450px' : 0);
            }
            
            if (flag) {
                window.localStorage.setItem('closed-cp-bar-' + bar_id, 'closed');
            }
        }
        
        function showHideCtaBar(flag) {
            if (!flag) {
                document.querySelector('#cta-preview--cp-bar-' + bar_id).style.display = 'block';
            }
            
            if (__cp_cf[bar_id].bar.position !== 'bottom') {
                document.querySelector('#cta-preview--cp-bar-' + bar_id).style.top = (flag ? '-450px' : 0);
            } else {
                document.querySelector('#cta-preview--cp-bar-' + bar_id).style.bottom = (flag ? '-450px' : 0);
            }
            
            if (flag) {
                document.querySelector('#cta-preview--cp-bar-' + bar_id).style.display = 'none';
                window.localStorage.setItem('closed-cta-cp-bar-' + bar_id, 'closed');
            }
        }
        
        window.onload = function () {
            if (__cp_cf[bar_id].bar.countdown !== 'none') {
                var countDownDate = new Date(__cp_cf[bar_id].countdown_target.toLocaleString('en-US', {
                    timeZone: __cp_cf[bar_id].bar.countdown_timezone
                })).getTime();
                
                var x = setInterval(function () {
                    var now = new Date().getTime();
                    var distance = countDownDate - now;
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    days = isNaN(days) ? 0 : days;
                    hours = isNaN(hours) ? 0 : hours;
                    minutes = isNaN(minutes) ? 0 : minutes;
                    seconds = isNaN(seconds) ? 0 : seconds;
                    
                    if (days === 0 && hours === 0 && minutes === 0 && seconds === 0) {
                        distance = -1;
                    }
                    
                    if (__cp_cf[bar_id].bar.countdown_format === 'dd') {
                        document.getElementById('cp-bar--countdown-days-' + bar_id).innerHTML = ('0' + days).slice(-2);
                    }
                    
                    if (__cp_cf[bar_id].bar.countdown_format !== 'mm') {
                        document.getElementById('cp-bar--countdown-hours-' + bar_id).innerHTML = ('0' + hours).slice(-2);
                    }
                    
                    document.getElementById('cp-bar--countdown-minutes-' + bar_id).innerHTML = ('0' + minutes).slice(-2);
                    document.getElementById('cp-bar--countdown-seconds-' + bar_id).innerHTML = ('0' + seconds).slice(-2);
                    
                    if (distance < 0) {
                        clearInterval(x);
                        if (__cp_cf[bar_id].bar.countdown_on_expiry === 'hide_bar') {
                            showHideMainBar(true);
                            showHideCtaBar(true);
                        } else if (__cp_cf[bar_id].bar.countdown_on_expiry === 'redirect') {
                            location.href = __cp_cf[bar_id].bar.countdown_expiration_url;
                        } else if (__cp_cf[bar_id].bar.countdown_on_expiry === 'display_text') {
                            document.getElementById('cp-bar--cta-content-section-' + bar_id).innerHTML = '<div style="font-weight: bold;">' + __cp_cf[bar_id].bar.countdown_expiration_text + '</div>';
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
                if (document.querySelector('meta[name=description]')) {
                    document.querySelector('meta[name=description]').setAttribute('content', __cp_cf[bar_id].bar.meta_description);
                } else {
                    document.querySelector('head').appendChild('<meta name="description" content="' + __cp_cf[bar_id].bar.meta_description + '"/>');
                }
            }
            
            if (__cp_cf[bar_id].bar.meta_keywords !== '') {
                if (document.querySelector('meta[name=keywords]')) {
                    document.querySelector('meta[name=keywords]').setAttribute('content', __cp_cf[bar_id].bar.meta_keywords);
                } else {
                    document.querySelector('head').appendChild('<meta name="keywords" content="' + __cp_cf[bar_id].bar.meta_keywords + '"/>');
                }
            }
        };
        
        function scrollDisplay() {
            window.onscroll = function () {
                var per = Math.round((window.innerHeight * __cp_cf[bar_id].bar.scroll_point_percent) / 100);
                if (per <= window.scrollY) {
                    immediateDisplayBar();
                }
            };
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
    
        if (document.querySelector('#main--cp-bar-close-btn-' + bar_id)) {
            document.querySelector('#main--cp-bar-close-btn-' + bar_id).addEventListener('click', function () {
                showHideMainBar(true);
            });
        }
        
        if (document.querySelector('#cta--cp-bar-close-btn-' + bar_id)) {
            document.querySelector('#cta--cp-bar-close-btn-' + bar_id).addEventListener('click', function () {
                showHideCtaBar(true);
            });
        }
        
        if (document.querySelector('#cp--bar-action-btn-' + bar_id)) {
            document.querySelector('#cp--bar-action-btn-' + bar_id).addEventListener('click', function () {
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
        }
    
        if (document.querySelector('#cta--cp-bar-button-' + bar_id)) {
            document.querySelector('#cta--cp-bar-button-' + bar_id).addEventListener('click', function () {
                if (document.getElementById('lead_capture_cta_name__cp_bar_' + bar_id).value === ''
                    || document.getElementById('lead_capture_cta_email__cp_bar_' + bar_id).value === '') {
                    alert('Name and Email field is required.');
                    document.getElementById('lead_capture_cta_name__cp_bar_' + bar_id).focus();
                    return false;
                }
        
                var form = document.getElementById('cp-bar--cta-form-' + bar_id);
                var params = {};
                for (var i = 0; i < form.elements.length; i++) {
                    if (form.elements[i].nodeName === 'INPUT') {
                        params[form.elements[i].getAttribute('name')] = form.elements[i].value;
                    }
                }
        
                var xml_http;
                if (window.XMLHttpRequest) {
                    xml_http = new XMLHttpRequest();
                } else {
                    xml_http = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xml_http.onreadystatechange = function () {
                    if (__cp_cf[bar_id].bar.after_submit === 'show_message' || __cp_cf[bar_id].bar.after_submit === 'show_message_hide_bar') {
                        document.getElementById('cp-bar--cta-content-section-' + bar_id).innerHTML = '<div style="font-weight: bold;">' + __cp_cf[bar_id].bar.message + '</div>';
                        if (__cp_cf[bar_id].bar.after_submit === 'show_message_hide_bar') {
                            setTimeout(function () {
                                showHideCtaBar(true);
                            }, (__cp_cf[bar_id].bar.autohide_delay_seconds * 1000));
                        }
                    } else {
                        showHideCtaBar(true);
                        location.href = __cp_cf[bar_id].bar.redirect_url;
                    }
                };
                xml_http.open("POST", form.getAttribute('action'));
                xml_http.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xml_http.setRequestHeader('Content-type', 'application/json');
                xml_http.setRequestHeader('X-CSRF-TOKEN', __cp_cf[bar_id].token);
                xml_http.send(JSON.stringify(params));
            });
        }
        
        function setCookie(cname, c_value, ex_days) {
            var d = new Date();
            d.setTime(d.getTime() + (ex_days * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + c_value + ";" + expires + ";path=/";
        }
        
        function getCookie(cname) {cta--cp-bar-close-btn
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
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
            var user = getCookie(cname);
            
            return (user && user !== "");
        }
    })();
</script>
