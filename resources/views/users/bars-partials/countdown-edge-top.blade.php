<div style="height:25px; width:100%; text-align:center;"
     :style="{'color': model.countdown.countdown_text_color.indexOf('#') > -1 ? model.countdown.countdown_text_color : `#${model.countdown.countdown_text_color}`}">
    <div style="float:left; padding:0; font-weight:bold; width: 55px; font-size:20px;"
         v-show="model.countdown.countdown_format === 'dd'">
        @{{ model.countdown.countdown === 'evergreen' ? (`0${model.countdown.countdown_days}`).slice(-2) : countdownCalculate() }}
    </div>
    <div style="float:left; padding:0; font-weight:bold; width: 50px; font-size:20px;"
         v-show="model.countdown.countdown_format !== 'mm'">
        @{{ model.countdown.countdown === 'evergreen' ? (`0${model.countdown.countdown_hours}`).slice(-2) :
        ((`${model.countdown.countdown_end_time}`).split(':'))[0] }}
    </div>
    <div style="float:left; padding:0; font-weight:bold; width: 50px; font-size:20px;">
        @{{ model.countdown.countdown === 'evergreen' ? (`0${model.countdown.countdown_minutes}`).slice(-2) :
        ((`${model.countdown.countdown_end_time}`).split(':'))[1] }}
    </div>
    <div style="float:left; padding:0; font-weight:bold; width: 55px; font-size:20px;">
        @{{ (`0${(new Date().getUTCSeconds())}`).slice(-2) }}
    </div>
</div>
