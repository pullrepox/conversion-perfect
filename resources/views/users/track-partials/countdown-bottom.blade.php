<div style="height:20px; width:100%; text-align:center; text-transform: uppercase;
    color: {{ (strpos($bar->countdown_text_color, '#') === false ? '#' . $bar->countdown_text_color : $bar->countdown_text_color) }};">
    @if ($bar->countdown_format == 'dd')
        <div style="margin-left:5px; margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:10px;
            background-color: {{ $bar->countdown_background_color == '' ? 'transparent' : (strpos($bar->countdown_background_color, '#') === false ? '#' . $bar->countdown_background_color : $bar->countdown_background_color) }};">
            {{ $bar->days_label }}
        </div>
    @endif
    @if ($bar->countdown_format != 'mm')
        <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:10px;
            background-color: {{ $bar->countdown_background_color == '' ? 'transparent' : (strpos($bar->countdown_background_color, '#') === false ? '#' . $bar->countdown_background_color : $bar->countdown_background_color) }};">
            {{ $bar->hours_label }}
        </div>
    @endif
    <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:10px;
        background-color: {{ $bar->countdown_background_color == '' ? 'transparent' : (strpos($bar->countdown_background_color, '#') === false ? '#' . $bar->countdown_background_color : $bar->countdown_background_color) }};">
        {{ $bar->minutes_label }}
    </div>
    <div style="float:left; padding:0; height:20px; width:50px; font-size:10px;
        background-color: {{ $bar->countdown_background_color == '' ? 'transparent' : (strpos($bar->countdown_background_color, '#') === false ? '#' . $bar->countdown_background_color : $bar->countdown_background_color) }};">
        {{ $bar->seconds_label }}
    </div>
</div>
