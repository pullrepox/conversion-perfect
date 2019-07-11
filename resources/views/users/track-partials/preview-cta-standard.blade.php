<div style="height: 235px; width: 100%; font-size: 20px; font-family: 'Nunito', sans-serif; text-align: center; position: relative;
    background-color: {{ $bar->panel_color == '' ? 'transparent' : (strpos($bar->panel_color, '#') === false ? '#' . $bar->panel_color : $bar->panel_color) }};
    color: {{ (strpos($bar->subscribe_text_color, '#') === false ? '#' . $bar->subscribe_text_color : $bar->subscribe_text_color) }};">
    @if (!$bar->close_button)
        <div id="cta--cp-bar-close-btn" class="cp--bar--close-btn" style="position: absolute; top: -4px; right: 6px;font-size: 24px;z-index: 9999;
            color: {{ (strpos($bar->headline_color, '#') === false ? '#' . $bar->headline_color : $bar->headline_color) }};">&times;
        </div>
    @endif
    <div style="height: 45px; width: 100%; font-size: 20px;line-height: 45px;
        background-color: {{ (strpos($bar->background_color, '#') === false ? '#' . $bar->background_color : $bar->background_color) }};
        color: {{ (strpos($bar->headline_color, '#') === false ? '#' . $bar->headline_color : $bar->headline_color) }};">
        @foreach(json_decode($bar->call_to_action, true) as $c_t_row)
            <span>
                @if (isset($c_t_row['attributes']))
                    <span style="font-weight: {{ isset($c_t_row['attributes']['bold']) ? 'bold' : 'normal' }};
                        font-style: {{ isset($c_t_row['attributes']['italic']) ? 'italic' : 'normal' }};
                        text-decoration: {{ (isset($c_t_row['attributes']['underline']) && isset($c_t_row['attributes']['strike'])) ? 'underline line-through' :
                            ((isset($c_t_row['attributes']['underline']) && !isset($c_t_row['attributes']['strike'])) ? 'underline' :
                            ((!isset($c_t_row['attributes']['underline']) && isset($c_t_row['attributes']['strike'])) ? 'line-through' : 'normal')) }};">
                        {{ stripslashes($c_t_row['insert']) }}
                    </span>
                @else
                    <span>
                        {{ stripslashes($c_t_row['insert']) }}
                    </span>
                @endif
            </span>
        @endforeach
    </div>
    <section id="cp-bar--cta-content-section" style="margin-top: 10px;width: 100%;">
        <div style="width: 100%; height: 30px; font-size: 17px;
            color: {{ (strpos($bar->subscribe_text_color, '#') === false ? '#' . $bar->subscribe_text_color : $bar->subscribe_text_color) }};">
            @foreach(json_decode($bar->subscribe_text, true) as $s_t_row)
                <span>
                    @if (isset($s_t_row['attributes']))
                        <span style="font-weight: {{ isset($s_t_row['attributes']['bold']) ? 'bold' : 'normal' }};
                            font-style: {{ isset($s_t_row['attributes']['italic']) ? 'italic' : 'normal' }};
                            text-decoration: {{ (isset($s_t_row['attributes']['underline']) && isset($s_t_row['attributes']['strike'])) ? 'underline line-through' :
                                ((isset($s_t_row['attributes']['underline']) && !isset($s_t_row['attributes']['strike'])) ? 'underline' :
                                ((!isset($s_t_row['attributes']['underline']) && isset($s_t_row['attributes']['strike'])) ? 'line-through' : 'normal')) }};">
                            {{ stripslashes($s_t_row['insert']) }}
                        </span>
                    @else
                        <span>
                            {{ stripslashes($s_t_row['insert']) }}
                        </span>
                    @endif
                </span>
            @endforeach
        </div>
        <form id="cp-bar--cta-form" data-action="{{ secure_redirect(route('conversion.set-lead-capture-subscribers', ['bar_id' => $bar->id])) }}" method="post">
            @csrf
            <div style="width: 100%; margin-top: 5px;">
                <input type="text" id="lead_capture_cta_name__cp_bar" name="lead_capture_cta_name__cp_bar"
                       style="width: calc(250px - .75rem - .75rem);padding: 0 .75rem;height: calc(1.5em + 1.25rem + 5px); display: inline-block; font-weight: 400; line-height: 1.5; color: #8898aa; background-clip: padding-box; border: 1px solid #dee2e6; border-radius: .25rem; margin-right: 5px; background-color: #ffffff; font-size: 0.875rem; transition: all .15s ease-in-out;"
                       placeholder="{{ $bar->opt_in_name_placeholder }}" required/>
                <input type="email" id="lead_capture_cta_email__cp_bar" name="lead_capture_cta_email__cp_bar"
                       style="width: calc(250px - .75rem - .75rem);padding: 0 .75rem;height: calc(1.5em + 1.25rem + 5px); display: inline-block; font-weight: 400; line-height: 1.5; color: #8898aa; background-clip: padding-box; border: 1px solid #dee2e6; border-radius: .25rem; margin-left: 5px; background-color: #ffffff; font-size: 0.875rem; transition: all .15s ease-in-out;"
                       placeholder="{{ $bar->opt_in_email_placeholder }}" required/>
            </div>
            @if ($bar->opt_in_button_type == 'match_main_button')
                <button type="button" id="cta--cp-bar-button"
                        style="width: 514px; padding: .625rem .75rem; margin-top: 15px; line-height: 1.5; border: none; text-decoration: none; font-size: 0.875rem; white-space: nowrap; height: calc(1.5em + 1.25rem + 5px);
                            background-color: {{ (strpos($bar->button_background_color, '#') === false ? '#' . $bar->button_background_color : $bar->button_background_color) }};
                            color: {{ (strpos($bar->button_text_color, '#') === false ? '#' . $bar->button_text_color : $bar->button_text_color) }};
                            box-shadow: 0 3px 10px -4px {{ (strpos($bar->button_background_color, '#') === false ? '#' . $bar->button_background_color : $bar->button_background_color) }};
                            border-radius: {{ $bar->button_type === 'rounded' ? '6px' : 0 }};">
                    {{ $bar->opt_in_button_label }}
                </button>
            @else
                <button type="button" id="cta--cp-bar-button"
                        style="width: 514px; padding: .625rem .75rem; margin-top: 15px; line-height: 1.5; border: none; text-decoration: none; font-size: 0.875rem; white-space: nowrap; height: calc(1.5em + 1.25rem + 5px);
                            background-color: {{ (strpos($bar->opt_in_button_bg_color, '#') === false ? '#' . $bar->opt_in_button_bg_color : $bar->opt_in_button_bg_color) }};
                            color: {{ (strpos($bar->opt_in_button_label_color, '#') === false ? '#' . $bar->opt_in_button_label_color : $bar->opt_in_button_label_color) }};
                            box-shadow: 0 3px 10px -4px {{ (strpos($bar->opt_in_button_bg_color, '#') === false ? '#' . $bar->opt_in_button_bg_color : $bar->opt_in_button_bg_color) }};
                            border-radius: {{ $bar->opt_in_button_type === 'rounded' ? '6px' : 0 }};">
                    {{ $bar->opt_in_button_label }}
                </button>
            @endif
        </form>
        <div style="font-size: 12px; margin-bottom: 10px; margin-top: 5px;
            color: {{ (strpos($bar->subscribe_text_color, '#') === false ? '#' . $bar->subscribe_text_color : $bar->subscribe_text_color) }};">
            {{ $bar->disclaimer }}
        </div>
    </section>
</div>
