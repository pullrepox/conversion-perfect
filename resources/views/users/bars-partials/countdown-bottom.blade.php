<div style="height:20px; width:100%; text-align:center;"
     :style="{'color': model.countdown.countdown_text_color.indexOf('#') > -1 ? model.countdown.countdown_text_color : `#${model.countdown.countdown_text_color}`}">
    <div style="margin-left:5px; margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:10px;"
         v-show="model.countdown.countdown_format === 'dd'"
         :style="{'background-color': model.countdown.countdown_background_color !== '' ? (model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`) : 'transparent'}">
        DAYS
    </div>
    <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:10px;"
         v-show="model.countdown.countdown_format !== 'mm'"
         :style="{'background-color': model.countdown.countdown_background_color !== '' ? (model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`) : 'transparent'}">
        HOURS
    </div>
    <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:10px;"
         :style="{'background-color': model.countdown.countdown_background_color !== '' ? (model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`) : 'transparent'}">
        MINS
    </div>
    <div style="float:left; padding:0; height:20px; width:50px; font-size:10px;"
         :style="{'background-color': model.countdown.countdown_background_color !== '' ? (model.countdown.countdown_background_color.indexOf('#') > -1 ? model.countdown.countdown_background_color : `#${model.countdown.countdown_background_color}`) : 'transparent'}">
        SECS
    </div>
</div>
