<div style="height:25px; width:100%; text-align:center;"
     :style="{'color': model.timer.countdown_text_color.indexOf('#') > -1 ? model.timer.countdown_text_color : `#${model.timer.countdown_text_color}`}">
    <div style="float:left; padding:0; width:55px; font-size:12px;"
         v-show="model.timer.countdown_format === 'dd'">
        DAYS
    </div>
    <div style="float:left; padding:0; width:50px; font-size:12px;"
         v-show="model.timer.countdown_format !== 'mm'">
        HOURS
    </div>
    <div style="float:left; padding:0; width:50px; font-size:12px;">
        MINS
    </div>
    <div style="float:left; padding:0; width:55px; font-size:12px;">
        SECS
    </div>
</div>
