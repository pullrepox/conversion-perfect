<div style="height:20px; width:100%; text-align:center;"
     :style="{'color': model.timer.countdown_text_color.indexOf('#') > -1 ? model.timer.countdown_text_color : `#${model.timer.countdown_text_color}`}">
    <div style="margin-left:5px; margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
         v-show="model.timer.countdown_format === 'dd'"
         :style="{'background-color': model.timer.countdown_background_color !== '' ? (model.timer.countdown_background_color.indexOf('#') > -1 ? model.timer.countdown_background_color : `#${model.timer.countdown_background_color}`) : 'transparent'}">
        @{{ model.timer.countdown === 'evergreen' ? (`0${model.timer.countdown_days}`).slice(-2) : countdownCalculate() }}
    </div>
    <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
         v-show="model.timer.countdown_format !== 'mm'"
         :style="{'background-color': model.timer.countdown_background_color !== '' ? (model.timer.countdown_background_color.indexOf('#') > -1 ? model.timer.countdown_background_color : `#${model.timer.countdown_background_color}`) : 'transparent'}">
        @{{ model.timer.countdown === 'evergreen' ? (`0${model.timer.countdown_hours}`).slice(-2) :
        ((`${model.timer.countdown_end_time}`).split(':'))[0] }}
    </div>
    <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
         :style="{'background-color': model.timer.countdown_background_color !== '' ? (model.timer.countdown_background_color.indexOf('#') > -1 ? model.timer.countdown_background_color : `#${model.timer.countdown_background_color}`) : 'transparent'}">
        @{{ model.timer.countdown === 'evergreen' ? (`0${model.timer.countdown_minutes}`).slice(-2) :
        ((`${model.timer.countdown_end_time}`).split(':'))[1] }}
    </div>
    <div style="float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
         :style="{'background-color': model.timer.countdown_background_color !== '' ? (model.timer.countdown_background_color.indexOf('#') > -1 ? model.timer.countdown_background_color : `#${model.timer.countdown_background_color}`) : 'transparent'}">
        @{{ (`0${(new Date().getUTCSeconds())}`).slice(-2) }}
    </div>
</div>
