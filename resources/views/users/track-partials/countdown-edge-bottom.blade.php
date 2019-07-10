<div style="height:25px; width:100%; text-align:center; text-transform: uppercase;display: flex;align-items: center;
    color: {{ (strpos($bar->countdown_text_color, '#') === false ? '#' . $bar->countdown_text_color : $bar->countdown_text_color) }};">
    @if ($bar->countdown_format == 'dd')
        <div style="float:left; padding: 0 0 0 12px; width:55px; font-size:12px;">
            {{ $bar->days_label }}
        </div>
    @endif
    @if ($bar->countdown_format != 'mm')
        <div style="float:left; padding: 0; width:50px; font-size:12px;">
            {{ $bar->hours_label }}
        </div>
    @endif
    <div style="float:left; padding: 0; width:50px; font-size:12px;">
        {{ $bar->minutes_label }}
    </div>
    <div style="float:left; padding: 0 12px 0 0; width:55px; font-size:12px;">
        {{ $bar->seconds_label }}
    </div>
</div>
