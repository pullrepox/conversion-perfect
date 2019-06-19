
<div id="previewbar" :style="{ background: bg_color_start, opacity: opacity }" style="height: 170px; width: 100%; font-size: 20px; font-family: Nunito, sans-serif; color: rgb(255, 255, 255); text-align: right;">

    <div id="previewbanner" style="height:155px; width:100%; font-size:20px; font-family:Nunito,sans-serif; text-align:center; vertical-align:middle; position:relative">

        <div v-html="video_code" style="max-width:320px; max-height:180px;"></div>

        <div style="width:auto; min-width:60%; height:170px; text-align:center;">

            <div style="width:auto; height:auto;">
                <div  :style="{ color: heading_color }" style="width:100%; min-width:100%; margin:0 auto; padding-top:15px;" id="">@{{ heading }}</div>
                <div :style="{ color: subheading_color }" style="width:100%; min-width:100%; margin:0 auto; font-size:16px; color:#ffffff" id="">@{{ subheading }}</div>
            </div>

            <div style="width:auto; height:60px;">
                @{{ description }}
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