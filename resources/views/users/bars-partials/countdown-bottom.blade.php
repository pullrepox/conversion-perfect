<div style="height:20px; width:100%; text-align:center; text-transform: uppercase;"
     :style="{'color': model.timer.countdown_text_color.indexOf('#') > -1 ? model.timer.countdown_text_color : `#${model.timer.countdown_text_color}`}">
    <div style="margin-left:5px; margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:10px;"
         v-show="model.timer.countdown_format === 'dd'"
         :style="{'background-color': model.timer.countdown_background_color !== '' ? (model.timer.countdown_background_color.indexOf('#') > -1 ? model.timer.countdown_background_color : `#${model.timer.countdown_background_color}`) : 'transparent'}">
        @{{ model.translation.days_label }}
    </div>
    <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:10px;"
         v-show="model.timer.countdown_format !== 'mm'"
         :style="{'background-color': model.timer.countdown_background_color !== '' ? (model.timer.countdown_background_color.indexOf('#') > -1 ? model.timer.countdown_background_color : `#${model.timer.countdown_background_color}`) : 'transparent'}">
        @{{ model.translation.hours_label }}
    </div>
    <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:10px;"
         :style="{'background-color': model.timer.countdown_background_color !== '' ? (model.timer.countdown_background_color.indexOf('#') > -1 ? model.timer.countdown_background_color : `#${model.timer.countdown_background_color}`) : 'transparent'}">
        @{{ model.translation.minutes_label }}
    </div>
    <div style="float:left; padding:0; height:20px; width:50px; font-size:10px;"
         :style="{'background-color': model.timer.countdown_background_color !== '' ? (model.timer.countdown_background_color.indexOf('#') > -1 ? model.timer.countdown_background_color : `#${model.timer.countdown_background_color}`) : 'transparent'}">
        @{{ model.translation.seconds_label }}
    </div>
</div>
