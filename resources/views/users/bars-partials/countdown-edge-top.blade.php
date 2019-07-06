<div style="height:25px; width:100%; text-align:center;"
     :style="{'color': model.timer.countdown_text_color.indexOf('#') > -1 ? model.timer.countdown_text_color : `#${model.timer.countdown_text_color}`}">
    <div style="float:left;  padding: 0 0 0 12px; font-weight:bold; width: 55px; font-size:20px;"
         v-show="model.timer.countdown_format === 'dd'">
        @{{ model.timer.countdown === 'evergreen' ? (`0${model.timer.countdown_days}`).slice(-2) : countdownCalculate() }}
    </div>
    <div style="float:left; padding: 0; font-weight:bold; width: 50px; font-size:20px;"
         v-show="model.timer.countdown_format !== 'mm'">
        @{{ model.timer.countdown === 'evergreen' ? (`0${model.timer.countdown_hours}`).slice(-2) :
        ((`${model.timer.countdown_end_time}`).split(':'))[0] }}
    </div>
    <div style="float:left; padding: 0; font-weight:bold; width: 50px; font-size:20px;">
        @{{ model.timer.countdown === 'evergreen' ? (`0${model.timer.countdown_minutes}`).slice(-2) :
        ((`${model.timer.countdown_end_time}`).split(':'))[1] }}
    </div>
    <div style="float:left;  padding: 0 12px 0 0; font-weight:bold; width: 55px; font-size:20px;">
        @{{ (`0${(new Date().getUTCSeconds())}`).slice(-2) }}
    </div>
</div>
