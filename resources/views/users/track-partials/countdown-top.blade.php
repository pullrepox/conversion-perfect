<div style="height:20px; width:100%; text-align:center;
    color: {{ (strpos($bar->countdown_text_color, '#') === false ? '#' . $bar->countdown_text_color : $bar->countdown_text_color) }};">
    @if ($bar->countdown_format == 'dd')
        <div style="margin-left:5px; margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;
            background-color: {{ $bar->countdown_background_color == '' ? 'transparent' : (strpos($bar->countdown_background_color, '#') === false ? '#' . $bar->countdown_background_color : $bar->countdown_background_color) }};">
            {{ $bar->countdown == 'evergreen' ? sprintf('%02d', $bar->countdown_days) : sprintf('%02d', calcDaysCurrAndGiven($bar->countdown_end_date)) }}
        </div>
    @endif
    @if ($bar->countdown_format != 'mm')
        <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;
            background-color: {{ $bar->countdown_background_color == '' ? 'transparent' : (strpos($bar->countdown_background_color, '#') === false ? '#' . $bar->countdown_background_color : $bar->countdown_background_color) }};">
            {{ $bar->countdown == 'evergreen' ? sprintf('%02d', $bar->countdown_hours) : sprintf('%02d', explode(':', $bar->countdown_end_time)[0]) }}
        </div>
    @endif
    <div style="margin-right:5px; float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;
        background-color: {{ $bar->countdown_background_color == '' ? 'transparent' : (strpos($bar->countdown_background_color, '#') === false ? '#' . $bar->countdown_background_color : $bar->countdown_background_color) }};">
        {{ $bar->countdown == 'evergreen' ? sprintf('%02d', $bar->countdown_minutes) : sprintf('%02d', explode(':', $bar->countdown_end_time)[1]) }}
    </div>
    <div style="float:left; padding:0; height:20px; width:50px; font-size:18px; font-weight:bold;
        background-color: {{ $bar->countdown_background_color == '' ? 'transparent' : (strpos($bar->countdown_background_color, '#') === false ? '#' . $bar->countdown_background_color : $bar->countdown_background_color) }};">
        {{ date('s') }}
    </div>
</div>
