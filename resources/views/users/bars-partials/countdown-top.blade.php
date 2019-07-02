<div style="height:20px; width:100%; text-align:center;"
     :style="{'color': model.countdown.countdown_text_color.indexOf('#') > -1 ? model.countdown.countdown_text_color : `#${model.countdown.countdown_text_color}`}">
    <div style="margin-left:5px; margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
         v-show="model.countdown.countdown_format === 'dd'"
         :style="{'background-color': model.countdown.countdown_background_color !== '' ? (model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`) : 'transparent'}">
        @{{ model.countdown.countdown === 'evergreen' ? (`0${model.countdown.countdown_days}`).slice(-2) : countdownCalculate() }}
    </div>
    <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
         v-show="model.countdown.countdown_format !== 'mm'"
         :style="{'background-color': model.countdown.countdown_background_color !== '' ? (model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`) : 'transparent'}">
        @{{ model.countdown.countdown === 'evergreen' ? (`0${model.countdown.countdown_hours}`).slice(-2) :
        ((`${model.countdown.countdown_end_time}`).split(':'))[0] }}
    </div>
    <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
         :style="{'background-color': model.countdown.countdown_background_color !== '' ? (model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`) : 'transparent'}">
        @{{ model.countdown.countdown === 'evergreen' ? (`0${model.countdown.countdown_minutes}`).slice(-2) :
        ((`${model.countdown.countdown_end_time}`).split(':'))[1] }}
    </div>
    <div style="float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;"
         :style="{'background-color': model.countdown.countdown_background_color !== '' ? (model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`) : 'transparent'}">
        @{{ (`0${(new Date().getUTCSeconds())}`).slice(-2) }}
    </div>
</div>
