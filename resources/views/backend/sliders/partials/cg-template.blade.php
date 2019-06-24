<link href="https://fonts.googleapis.com/css?family=Nunito|Oswald" rel="stylesheet">
<style> .cog_countbox {
        line-height: normal !important;
    }

    .cogslidetop {
        position: fixed;
        top: -170px;
        bottom: 0px;
        left: 0px;
        right: 0px;
        margin: 0px auto auto;
        -webkit-transition: top 1s; /* Safari */
        transition: top 1s;
    }

    .cogslidetop.out {
        top: 0px;
    }

    .cogslidetop.in {
        top: -170px;
    }

    .cogslidebottom {
        position: fixed;
        bottom: -170px;
        left: 0px;
        right: 0px;
        margin: 0px auto auto;
        -webkit-transition: bottom 1s; /* Safari */
        transition: bottom 1s;
    }

    .cogslidebottom.out {
        bottom: 0px;
    }

    .cogslidebottom.in {
        bottom: -170px;
    }

    .cog_jiggle {
        animation: cog_shakebutton 0.82s cubic-bezier(.36, .07, .19, .97) both;
        transform: translate3d(0, 0, 0);
        backface-visibility: hidden;
        perspective: 1000px;
    }

    @keyframes cog_shakebutton {
        10%, 90% {
            transform: translate3d(-1px, 0, 0) rotate(-2deg);
        }
        20%, 80% {
            transform: translate3d(2px, 0, 0) rotate(2deg);
        }
        30%, 50%, 70% {
            transform: translate3d(-4px, 0, 0) rotate(-2deg);
        }
        40%, 60% {
            transform: translate3d(4px, 0, 0) rotate(2deg);
        }
    }

    .bodypushin {
        margin-top: 8px;
        -webkit-transition: margin-top 1s;
        transition: margin-top 1s;
    }

    .bodypushout {
        margin-top: 170px;
        -webkit-transition: margin-top 1s;
        transition: margin-top 1s;
    }

    .ifpushin {
        margin-top: 0px;
        -webkit-transition: margin-top 1s;
        transition: margin-top 1s;
    }

    .ifpushout {
        margin-top: 170px;
        -webkit-transition: margin-top 1s;
        transition: margin-top 1s;
    }

    .mcogslidetop {
        position: fixed;
        top: -230px;
        bottom: 0px;
        left: 0px;
        right: 0px;
        margin: 0px auto auto;
        -webkit-transition: top 1s; /* Safari */
        transition: top 1s;
    }

    .mcogslidetop.out {
        top: 0px;
    }

    .mcogslidetop.in {
        top: -230px;
    }

    .mcogslidebottom {
        position: fixed;
        bottom: -230px;
        left: 0px;
        right: 0px;
        margin: 0px auto auto;
        -webkit-transition: bottom 1s; /* Safari */
        transition: bottom 1s;
    }

    .mcogslidebottom.out {
        bottom: 0px;
    }

    .mcogslidebottom.in {
        bottom: -230px;
    }</style>
<div id="cog_bar" class="cogslidetop"
     style="z-index:999999999; height:170px; width:100%; font-size:20px; font-family:Nunito,sans-serif; background-color:rgba(253,93,34,1); color:#ffffff; text-align:right; display: block; ">
    <div id="cog_branding"
         style="position:absolute; right:5px; z-index:999999999; bottom:6px; font-size:10px; line-height:10px; "><br>POWERED
        BY <a style="color:inherit; text-decoration:inherit;" href="//conversiongorilla.com" target="_BLANK">CONVERSIONGORILLA</a>
    </div>
    <div id="cog_barinner"
         style="height:155px; width:100%; font-size:20px; font-family:Nunito,sans-serif; text-align:center; vertical-align:middle; position:relative">
        <div style="width:auto; min-width:60%; height:170px; text-align:center;">
            <div style="width:auto; height:auto;">
                <div style="width:100%; min-width:100%; margin:0 auto; padding-top:10px; color:#ffffff;" id="cog_text">
                    trdgdf
                </div>
                <div style="width:100%; min-width:100%; margin:0 auto; font-size:16px; color:#ffffff" id="cog_text2">My
                    sub bar message goes here
                </div>
            </div>
            <div style="width:auto; height:60px;">
                <button id="cog_button"
                        style="cursor:pointer; padding-left:50px; padding-right:50px; padding-top:12px; padding-bottom:12px; border-radius:5px; cursor:hand; margin-top:10px; border:none; text-decoration:none; background:#120e29; color:#ffffff; display:inline-block; white-space:nowrap; font-family:Nunito,sans-serif; font-size:16px; "
                        type="button">Click Me
                </button>
            </div>
            <div id="cog_count" style="height:40px; width:100%; visibility:hidden; text-align:center; color:#ffffff;">
                <div id="cog_counttext" style="height:20px; width:100%; text-align:center;">
                    <div class="cog_countbox"
                         style="background-color:#fd5d22; margin-right:5px; display:inline-block; vertical-align:top; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
                         id="count_days">20
                    </div>
                    <div class="cog_countbox"
                         style="background-color:#fd5d22; margin-right:5px; display:inline-block; vertical-align:top; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
                         id="count_hours">10
                    </div>
                    <div class="cog_countbox"
                         style="background-color:#fd5d22; margin-right:5px; display:inline-block; vertical-align:top; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
                         id="count_mins">05
                    </div>
                    <div class="cog_countbox"
                         style="background-color:#fd5d22;  display:inline-block; vertical-align:top; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
                         id="count_secs">23
                    </div>
                </div>
                <div id="cog_labtext" style="min-height:20px; width:100%; text-align:center; color:#ffffff;">
                    <div class="cog_countbox"
                         style="background-color:#fd5d22; margin-right:5px; display:inline-block; vertical-align:top; padding:0; height:20px; width:50px; font-size:10px;">
                        DAYS
                    </div>
                    <div class="cog_countbox"
                         style="background-color:#fd5d22; margin-right:5px; display:inline-block; vertical-align:top; padding:0; height:20px; width:50px; font-size:10px;">
                        HOURS
                    </div>
                    <div class="cog_countbox"
                         style="background-color:#fd5d22; margin-right:5px; display:inline-block; vertical-align:top; padding:0; height:20px; width:50px; font-size:10px;">
                        MINS
                    </div>
                    <div class="cog_countbox"
                         style="background-color:#fd5d22; display:inline-block; vertical-align:top; padding:0; height:20px; width:50px; font-size:10px;">
                        SECS
                    </div>
                </div>
            </div>
        </div>
        <div style="position:absolute; top:5px; right:8px; font-size:15px; cursor:pointer; " id="cog_close">X</div>
    </div>
</div>
<div id="cog_mail" class="mcogslidetop"
     style="z-index:999999999; height:230px; width:100%; font-size:20px; font-family:Nunito,sans-serif; background-color:#dddddd; color:#777777; text-align:center;">
    <div id="cog_branding"
         style="position:absolute; right:5px; bottom:10px; font-size:12px; line-height:3px; font-family:Oswald; "><br>POWERED
        BY <a style="color:inherit; text-decoration:inherit;" href="//conversiongorilla.com" target="_BLANK">CONVERSIONGORILLA</a>
    </div>
    <div class="cog_mailtop"
         style="height:45px; width:100%; font-size:20px; font-family:Nunito,sans-serif; background-color:#fd5d22; color:#ffffff; line-height:45px;">
        Your Slide Out Opt-In Call To Action Will Go Here!
    </div>
    <div class="cog_mailarrow"
         style="margin:0 auto; width:0; height:0; border-left:15px solid transparent; border-right:15px solid transparent; border-top:15px solid #fd5d22"></div>
    <div id="cog_mailsubhead"
         style="margin-top:15px; width:100%; height:30px; font-size:17px; font-family:Nunito,sans-serif; color:#777777">
        Enter Your Name And Email Below...
    </div>
    <div id="cog_mailfields" style="width:100%;"><input name="cog_mailname" id="cog_mailname" type="input"
                                                        style="width:250px; border:1px solid #BBBBBB; display:inline-block; padding:12px; margin-right:5px; padding-right:30px;background: url(//conversiongorilla.com/iconavatar.png) no-repeat right center; background-color:#ffffff;"
                                                        placeholder="Your Name"></input><input name="cog_mailemail"
                                                                                               id="cog_mailemail"
                                                                                               type="input"
                                                                                               style="width:250px; border:1px solid #BBBBBB; display:inline-block; padding:12px; margin-left:5px; padding-right:30px; background: url(//conversiongorilla.com/iconmail.png) no-repeat right center; background-color:#ffffff;"
                                                                                               placeholder="you@email.com"></input>
    </div>
    <button id="cog_mailbutton"
            style="cursor:pointer; min-height:37px; width:596px; padding-left:10px; padding-right:10px; padding-top:15px; padding-bottom:15px; border-radius:0px; cursor:hand; margin-top:15px; border:none; text-decoration:none; background:#252237; color:#ffffff; display:inline-block; white-space:nowrap; font-family:Nunito,sans-serif; font-size:16px; "
            type="button">Yes! Count Me In!
    </button>
    <div style="color:#ffffff; position:absolute; top:5px; right:8px; cursor:pointer;" id="mail_close">X</div>
</div>
<script>var cog_bardown = 0;
    window.onload = (function (pre) {
        return function () {
            pre && pre.apply(this, arguments);
            cog_load();
        }
    })(window.onload);

    function cogslider(whichbar, direction) {
        if (whichbar == 0) {
            bar_elem = "bar";
        } else {
            bar_elem = "mail";
        }
        body = document.getElementsByTagName("body")[0];
        if (direction == 0) {
            cog_bardown = 1;
            if (bar_elem == "mail") {
                document.getElementById("cog_mail").classList.add("mail_shadow");
            }
            document.getElementById("cog_" + bar_elem).classList.remove("in");
            document.getElementById("cog_" + bar_elem).classList.add("out");
            body.classList.remove("bodypushin");
            body.classList.add("bodypushout");
            if (document.getElementById("cat_content") != null) {
                document.getElementById("cat_content").classList.remove("ifpushin");
                document.getElementById("cat_content").classList.add("ifpushout");
            }
        }
        if (direction == 1) {
            cog_bardown = 0;
            document.getElementById("cog_" + bar_elem).classList.remove("out");
            document.getElementById("cog_" + bar_elem).classList.add("in");
            body.classList.remove("bodypushout");
            body.classList.add("bodypushin");
            if (document.getElementById("cat_content") != null) {
                document.getElementById("cat_content").classList.add("ifpushin");
                document.getElementById("cat_content").classList.remove("ifpushout");
            }
            if (bar_elem == "mail") {
                document.getElementById("cog_mail").classList.remove("mail_shadow");
            }
        }
    }

    function cog_submit() {
        emailfname = document.getElementById("cog_mailname").value;
        emaillname = "";
        emailaddy = document.getElementById("cog_mailemail").value;
        if (emailaddy.indexOf("@") < 1 || emailaddy.indexOf(".") < 1 || emailaddy.indexOf(".") == emailaddy.length - 1) {
            document.getElementById("cog_mailemail").value = "";
        } else {
            var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
            xhr.open("GET", "//conversiongorilla.com/cogemail.php?barid=5375&email=" + emailaddy + "&fname=" + emailfname + "&lname=" + emaillname);
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            xhr.send();
            return (1);
        }
    }

    function cog_load() {
        cogslider(0, 0);
        var cog_exit_intent = 0;

        function cog_addEvent(obj, evt, fn) {
            if (obj.addEventListener) {
                obj.addEventListener(evt, fn, false);
            } else if (obj.attachEvent) {
                obj.attachEvent("on" + evt, fn);
            }
        }

        cog_addEvent(document, "mouseout", function (e) {
            e = e ? e : window.event;
            var from = e.relatedTarget || e.toElement;
            if (!from || from.nodeName == "HTML") {
                if (e.clientY < 10 && cog_exit_intent == 0 && cog_bardown == 0) {
                    cog_exit_intent = 1;
                    cogslider(0, 0);
                }
                ;
            }
        });
        var cog_shake = 0;
        setInterval(function () {
            if (cog_shake == 0) {
                document.getElementById("cog_button").classList.add("cog_jiggle");
                cog_shake = 1;
            } else {
                document.getElementById("cog_button").classList.remove("cog_jiggle");
                cog_shake = 0;
            }
        }, 1000);
        document.getElementById("cog_close").addEventListener("click", function () {
            cogslider(0, 1);
        }, false);
        document.getElementById("mail_close").addEventListener("click", function () {
            cogslider(1, 1);
        }, false);
        document.getElementById("cog_button").addEventListener("click", function () {
            cogslider(1, 0);
        }, false);
        document.getElementById("cog_mailbutton").addEventListener("click", function () {
            if (cog_submit() == 1) {
                document.getElementById("cog_mailsubhead").innerHTML = "Thank You!";
                document.getElementById("cog_mailemail").style.display = "none";
                document.getElementById("cog_mailname").style.display = "none";
                document.getElementById("cog_mailbutton").style.display = "none";
                document.getElementById("cog_mailsubhead").style.fontSize = "30px";
                document.getElementById("cog_mailsubhead").style.paddingTop = "50px";
            }
            ;
        }, false);
    }</script>