<div id="previewbar" :style="{ background: bg_color_start, opacity: opacity }" style="height: 170px; width: 100%; font-size: 20px; font-family: Nunito, sans-serif; color: rgb(255, 255, 255); text-align: right;">
    <div id="previewbarinner" style="height:155px; width:100%; font-size:20px; font-family:Nunito,sans-serif; text-align:center; vertical-align:middle; position:relative">

        <div style="width:auto; min-width:60%; height:170px; text-align:center;">

            <div style="width:auto; height:auto;">
                <div  :style="{ color: heading_color }" style="width:100%; min-width:100%; margin:0 auto; padding-top:15px;" id="">@{{ heading }}</div>
                <div :style="{ color: sub_heading_color }" style="width:100%; min-width:100%; margin:0 auto; font-size:16px; color:#ffffff" id="">@{{ sub_heading }}</div>
            </div>

            <div style="width:auto; height:60px;">
                @{{ description }}
            </div>

            <div id="previewcount" style="height:40px; width:100%; visibility:hidden; text-align:center;">
                <div id="previewcounttext" style="height:20px; width:100%; text-align:center; color:#ffffff;">
                    <div class="previewcountbox" style="background-color:#fd5d22; margin-right:5px; display:inline-block; vertical-align:top; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;" id="count_days">00</div>
                    <div class="previewcountbox" style="background-color:#fd5d22; margin-right:5px; display:inline-block; vertical-align:top; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;" id="count_hours">00</div>
                    <div class="previewcountbox" style="background-color:#fd5d22; margin-right:5px; display:inline-block; vertical-align:top; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;" id="count_mins">00</div>
                    <div class="previewcountbox" style="background-color:#fd5d22;  display:inline-block; vertical-align:top; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;" id="count_secs">00</div>
                </div>
                <div id="previewlabtext" style="min-height:20px; width:100%; text-align:center; color:#ffffff;">
                    <div class="previewcountbox" style="background-color:#fd5d22; margin-right:5px; display:inline-block; vertical-align:top; padding:0; height:20px; width:50px; font-size:10px;">DAYS</div>
                    <div class="previewcountbox" style="background-color:#fd5d22; margin-right:5px; display:inline-block; vertical-align:top; padding:0; height:20px; width:50px; font-size:10px;">HOURS</div>
                    <div class="previewcountbox" style="background-color:#fd5d22; margin-right:5px; display:inline-block; vertical-align:top; padding:0; height:20px; width:50px; font-size:10px;">MINS</div>
                    <div class="previewcountbox" style="background-color:#fd5d22; display:inline-block; vertical-align:top; padding:0; height:20px; width:50px; font-size:10px;">SECS</div>
                </div>
            </div>

        </div>


        <div id="previewclose" style="position:absolute; top:5px; right:8px; font-size:15px;">X</div>
    </div>

    <div id="previewbranding" style="font-size:12px; line-height:3px; font-family:Oswald; padding-right:5px;">
        POWERED BY <a style="color:inherit; text-decoration:inherit;" href="//conversiongorilla.com" target="_BLANK">CONVERSION-PERFECT</a>
    </div>

</div>

<div>
    <img src="{{asset('assets/img/mockup.gif')}}" alt="" style="width: 100%">
</div>
