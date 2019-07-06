<div style="height:25px; width:100%; text-align:center; text-transform: uppercase;"
     :style="{'color': model.timer.countdown_text_color.indexOf('#') > -1 ? model.timer.countdown_text_color : `#${model.timer.countdown_text_color}`}">
    <div style="float:left; padding: 0 0 0 12px; width:55px; font-size:12px;"
         v-show="model.timer.countdown_format === 'dd'">
        @{{ model.translation.days_label }}
    </div>
    <div style="float:left; padding: 0; width:50px; font-size:12px;"
         v-show="model.timer.countdown_format !== 'mm'">
        @{{ model.translation.hours_label }}
    </div>
    <div style="float:left; padding: 0; width:50px; font-size:12px;">
        @{{ model.translation.minutes_label }}
    </div>
    <div style="float:left; padding: 0 12px 0 0; width:55px; font-size:12px;">
        @{{ model.translation.seconds_label }}
    </div>
</div>
