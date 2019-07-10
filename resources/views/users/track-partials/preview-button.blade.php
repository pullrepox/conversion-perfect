<button type="button" style="border: 0;padding: 8px 12px;
    background-color: {{ (strpos($bar->button_background_color, '#') === false ? '#' . $bar->button_background_color : $bar->button_background_color) }};
    color: {{ (strpos($bar->button_text_color, '#') === false ? '#' . $bar->button_text_color : $bar->button_text_color) }};
    box-shadow: 0 3px 10px -4px {{ (strpos($bar->button_background_color, '#') === false ? '#' . $bar->button_background_color : $bar->button_background_color) }};
    border-radius: {{ $bar->button_type === 'rounded' ? '6px' : 0 }}">
    {{ $bar->button_label }}
</button>
