<div style="height:25px; width:100%; text-align:center;
    color: {{ (strpos($bar->countdown_text_color, "#") === false ? "#" . $bar->countdown_text_color : $bar->countdown_text_color) }};">
    @if ($bar->countdown_format == "dd")
        <div id="cp-bar--countdown-days-{{ $bar->id }}" style="float:left;  padding: 0 0 0 12px; font-weight:bold; width: 55px; font-size:20px;">
            {{ $bar->countdown == "evergreen" ? sprintf("%02d", $bar->countdown_days) : sprintf("%02d", calcDaysCurrAndGiven($bar->countdown_end_date)) }}
        </div>
    @endif
    @if ($bar->countdown_format != "mm")
        <div id="cp-bar--countdown-hours-{{ $bar->id }}" style="float:left; padding: 0; font-weight:bold; width: 50px; font-size:20px;">
            {{ $bar->countdown == "evergreen" ? sprintf("%02d", $bar->countdown_hours) : sprintf("%02d", explode(":", $bar->countdown_end_time)[0]) }}
        </div>
    @endif
    <div id="cp-bar--countdown-minutes-{{ $bar->id }}" style="float:left; padding: 0; font-weight:bold; width: 50px; font-size:20px;">
        {{ $bar->countdown == "evergreen" ? sprintf("%02d", $bar->countdown_minutes) : sprintf("%02d", explode(":", $bar->countdown_end_time)[1]) }}
    </div>
    <div id="cp-bar--countdown-seconds-{{ $bar->id }}" style="float:left;  padding: 0 12px 0 0; font-weight:bold; width: 55px; font-size:20px;">
        {{ date("s") }}
    </div>
</div>
