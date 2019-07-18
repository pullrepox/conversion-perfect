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
    top: {{ $bar->position == "top" || $bar->position == "top_sticky" ? "-450px" : "auto" }};
    bottom: {{ $bar->position == "bottom" ? "-450px" : "auto" }};
    left: 0; position: {{ $bar->position == "top" ? "relative" : "fixed" }}">
    @include("users.track-partials.preview-main")
</div>
@if ($bar->integration_type != "none")
    <div id="cta-preview--cp-bar-{{ $bar->id }}" class="cta-preview--cp-bar" style="width: 100%;margin: 0 !important;padding: 0 !important;z-index: 99999999;
        top: {{ $bar->position == "top" || $bar->position == "top_sticky" ? "-450px" : "auto" }};
        bottom: {{ $bar->position == "bottom" ? "-450px" : "auto" }};
        left: 0; position: {{ $bar->position == "top" ? "relative" : "fixed" }}">
        @if ($bar->opt_in_type == "standard")
            @include("users.track-partials.preview-cta-standard")
        @else
            @include("users.track-partials.preview-cta-media")
        @endif
    </div>
@endif
<script type="text/javascript">
    window.__cp_bar_config = window.__cp_bar_config || {};
    window.__cp_bar_config["{{ $bar->id }}"] = {
        BASE: "{{ request()->root() }}",
        bar: {!! json_encode($bar) !!},
        act_btn_action: "{{ route("conversion.set-action-button-click", ["id" => $bar->id]) }}",
        countdown_target: "{{ $bar->countdown == "none" ? "" : ($bar->countdown == "calendar" ? (date("F d, Y", strtotime($bar->countdown_end_date)) . " " . $bar->countdown_end_time) : getCountdownTarget($bar->countdown_days, $bar->countdown_hours, $bar->countdown_minutes, $bar->created_at)) }}"
    };
    
    (function () {
        var __cp_cf = window.__cp_bar_config;
        var bar_id = "{{ $bar->id }}";
        
        function showHideMainBar(flag) {
            if (__cp_cf[bar_id].bar.position !== "bottom") {
                document.querySelector("#main-preview--cp-bar-" + bar_id).style.top = (flag ? "-450px" : 0);
            } else {
                document.querySelector("#main-preview--cp-bar-" + bar_id).style.bottom = (flag ? "-450px" : 0);
            }
            
            if (flag) {
                window.localStorage.setItem("closed-cp-bar-" + bar_id, "closed");
            }
        }
        
        function showHideCtaBar(flag) {
            if (!flag) {
                document.querySelector("#cta-preview--cp-bar-" + bar_id).style.display = "block";
            }
            
            if (__cp_cf[bar_id].bar.position !== "bottom") {
                document.querySelector("#cta-preview--cp-bar-" + bar_id).style.top = (flag ? "-450px" : 0);
            } else {
                document.querySelector("#cta-preview--cp-bar-" + bar_id).style.bottom = (flag ? "-450px" : 0);
            }
            
            if (flag) {
                document.querySelector("#cta-preview--cp-bar-" + bar_id).style.display = "none";
                window.localStorage.setItem("closed-cta-cp-bar-" + bar_id, "closed");
            }
        }
        
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
        
        function isIE() {
            return (navigator.appName === "Microsoft Internet Explorer") || (navigator.appName === "Netscape" && navigator.userAgent.indexOf("Trident/") !== -1);
        }
        
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
        
        window.onload = function () {
            if (!checkCookie('CVP--fp-id')) {
                setCookie('CVP--fp-id', getFingerPrint(), 1);
            }
            if (__cp_cf[bar_id].bar.countdown !== "none") {
                var countDownDate = new Date(__cp_cf[bar_id].countdown_target.toLocaleString("en-US", {
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
                    
                    if (__cp_cf[bar_id].bar.countdown_format === "dd") {
                        document.getElementById("cp-bar--countdown-days-" + bar_id).innerHTML = ("0" + days).slice(-2);
                    }
                    
                    if (__cp_cf[bar_id].bar.countdown_format !== "mm") {
                        document.getElementById("cp-bar--countdown-hours-" + bar_id).innerHTML = ("0" + hours).slice(-2);
                    }
                    
                    document.getElementById("cp-bar--countdown-minutes-" + bar_id).innerHTML = ("0" + minutes).slice(-2);
                    document.getElementById("cp-bar--countdown-seconds-" + bar_id).innerHTML = ("0" + seconds).slice(-2);
                    
                    if (distance < 0) {
                        clearInterval(x);
                        if (__cp_cf[bar_id].bar.countdown_on_expiry === "hide_bar") {
                            showHideMainBar(true);
                            showHideCtaBar(true);
                        } else if (__cp_cf[bar_id].bar.countdown_on_expiry === "redirect") {
                            location.href = __cp_cf[bar_id].bar.countdown_expiration_url;
                        } else if (__cp_cf[bar_id].bar.countdown_on_expiry === "display_text") {
                            document.getElementById("cp-bar--cta-content-section-" + bar_id).innerHTML = "<div style=\"font-weight: bold;\">" + __cp_cf[bar_id].bar.countdown_expiration_text + "</div>";
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
                    showHideMainBar(window.localStorage.getItem("closed-cp-bar-" + bar_id) && window.localStorage.getItem("closed-cp-bar-" + bar_id) === "closed");
                    break;
            }
            
            if (__cp_cf[bar_id].bar.meta_title !== "") {
                document.title = __cp_cf[bar_id].bar.meta_title;
            }
            
            if (__cp_cf[bar_id].bar.meta_description !== "") {
                if (document.querySelector("meta[name=description]")) {
                    document.querySelector("meta[name=description]").setAttribute("content", __cp_cf[bar_id].bar.meta_description);
                } else {
                    document.querySelector("head").appendChild("<meta name=\"description\" content=\"" + __cp_cf[bar_id].bar.meta_description + "\"/>");
                }
            }
            
            if (__cp_cf[bar_id].bar.meta_keywords !== "") {
                if (document.querySelector("meta[name=keywords]")) {
                    document.querySelector("meta[name=keywords]").setAttribute("content", __cp_cf[bar_id].bar.meta_keywords);
                } else {
                    document.querySelector("head").appendChild("<meta name=\"keywords\" content=\"" + __cp_cf[bar_id].bar.meta_keywords + "\"/>");
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
            if (__cp_cf[bar_id].bar.frequency === "every") {
                showHideMainBar(window.localStorage.getItem("closed-cp-bar-" + bar_id) && window.localStorage.getItem("closed-cp-bar-" + bar_id) === "closed");
            } else if (__cp_cf[bar_id].bar.frequency === "day") {
                if (!checkCookie("__cp_bar_frequency_day-" + bar_id)) {
                    setCookie("__cp_bar_frequency_day-" + bar_id, "day", 1);
                    showHideMainBar(window.localStorage.getItem("closed-cp-bar-" + bar_id) && window.localStorage.getItem("closed-cp-bar-" + bar_id) === "closed");
                }
            } else if (__cp_cf[bar_id].bar.frequency === "week") {
                if (!checkCookie("__cp_bar_frequency_week-" + bar_id)) {
                    setCookie("__cp_bar_frequency_week-" + bar_id, "week", 7);
                    showHideMainBar(window.localStorage.getItem("closed-cp-bar-" + bar_id) && window.localStorage.getItem("closed-cp-bar-" + bar_id) === "closed");
                }
            } else if (__cp_cf[bar_id].bar.frequency === "once") {
                if (!(window.localStorage.getItem("__cp_bar_frequency_once-" + bar_id) && window.localStorage.getItem("__cp_bar_frequency_once-" + bar_id) === "opened")) {
                    window.localStorage.setItem("__cp_bar_frequency_once-" + bar_id, "opened");
                    showHideMainBar(window.localStorage.getItem("closed-cp-bar-" + bar_id) && window.localStorage.getItem("closed-cp-bar-" + bar_id) === "closed");
                }
            }
        }
        
        if (document.querySelector("#main--cp-bar-close-btn-" + bar_id)) {
            document.querySelector("#main--cp-bar-close-btn-" + bar_id).addEventListener("click", function () {
                showHideMainBar(true);
            });
        }
        
        if (document.querySelector("#cta--cp-bar-close-btn-" + bar_id)) {
            document.querySelector("#cta--cp-bar-close-btn-" + bar_id).addEventListener("click", function () {
                showHideCtaBar(true);
            });
        }
        
        if (document.querySelector("#cp--bar-action-btn-" + bar_id)) {
            document.querySelector("#cp--bar-action-btn-" + bar_id).addEventListener("click", function () {
                var xml_http;
                if (window.XMLHttpRequest) {
                    xml_http = new XMLHttpRequest();
                } else {
                    xml_http = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xml_http.onreadystatechange = function () {
                    if (__cp_cf[bar_id].bar.button_action === "open_click_url") {
                        window.open(__cp_cf[bar_id].bar.button_click_url, "Conversion Perfect", "_blank");
                        showHideMainBar(true);
                    } else {
                        setTimeout(function () {
                            showHideMainBar(true);
                        }, (__cp_cf[bar_id].bar.autohide_delay_seconds * 1000));
                    }
    
                    if (__cp_cf[bar_id].bar.integration_type !== "none") {
                        showHideCtaBar((window.localStorage.getItem("closed-cta-cp-bar-" + bar_id) && window.localStorage.getItem("closed-cta-cp-bar-" + bar_id) === "closed"));
                    }
                };
                xml_http.open("POST", __cp_cf[bar_id].act_btn_action);
                xml_http.setRequestHeader("Content-type", "application/json");
                xml_http.setRequestHeader("X-Requested-With", "XMLHttpRequest");
                xml_http.send(JSON.stringify({cookie: (checkCookie("CVP--fp-id") ? getCookie("CVP--fp-id") : getFingerPrint())}));
            });
        }
        
        if (document.querySelector("#cta--cp-bar-button-" + bar_id)) {
            document.querySelector("#cta--cp-bar-button-" + bar_id).addEventListener("click", function () {
                if (document.getElementById("lead_capture_cta_name__cp_bar_" + bar_id).value === ""
                    || document.getElementById("lead_capture_cta_email__cp_bar_" + bar_id).value === "") {
                    alert("Name and Email field is required.");
                    document.getElementById("lead_capture_cta_name__cp_bar_" + bar_id).focus();
                    return false;
                }
                
                var form = document.getElementById("cp-bar--cta-form-" + bar_id);
                var params = {};
                for (var i = 0; i < form.elements.length; i++) {
                    if (form.elements[i].nodeName === "INPUT") {
                        params[form.elements[i].getAttribute("name")] = form.elements[i].value;
                    }
                }
                params["cookie"] = checkCookie("CVP--fp-id") ? getCookie("CVP--fp-id") : getFingerPrint();
                
                var xml_http;
                if (window.XMLHttpRequest) {
                    xml_http = new XMLHttpRequest();
                } else {
                    xml_http = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xml_http.onreadystatechange = function () {
                    if (__cp_cf[bar_id].bar.after_submit === "show_message" || __cp_cf[bar_id].bar.after_submit === "show_message_hide_bar") {
                        document.getElementById("cp-bar--cta-content-section-" + bar_id).innerHTML = "<div style=\"font-weight: bold;\">" + __cp_cf[bar_id].bar.message + "</div>";
                        if (__cp_cf[bar_id].bar.after_submit === "show_message_hide_bar") {
                            setTimeout(function () {
                                showHideCtaBar(true);
                            }, (__cp_cf[bar_id].bar.autohide_delay_seconds * 1000));
                        }
                    } else {
                        showHideCtaBar(true);
                        location.href = __cp_cf[bar_id].bar.redirect_url;
                    }
                };
                xml_http.open("POST", form.getAttribute("action"));
                xml_http.setRequestHeader("X-Requested-With", "XMLHttpRequest");
                xml_http.setRequestHeader("Content-type", "application/json");
                xml_http.send(JSON.stringify(params));
            });
        }
        
        function setCookie(cname, c_value, ex_days) {
            var d = new Date();
            d.setTime(d.getTime() + (ex_days * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + c_value + ";" + expires + ";path=/";
        }
        
        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(";");
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) === " ") {
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
