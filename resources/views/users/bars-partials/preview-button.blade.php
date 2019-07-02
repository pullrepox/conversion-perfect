<button type="button" style="border: 0;padding: 8px 12px;"
        :style="{
        'background-color': model.button.button_background_color.indexOf('#') > -1 ? model.button.button_background_color : `#${model.button.button_background_color}`,
        'color': model.button.button_text_color.indexOf('#') > -1 ? model.button.button_text_color : `#${model.button.button_text_color}`,
        'box-shadow': `0 3px 10px -4px ${model.button.button_background_color.indexOf('#') > -1 ? model.button.button_background_color : `#${model.button.button_background_color}`}`,
        'border-radius': model.button.button_type === 'rounded' ? '6px' : 0
        }">@{{ model.button.button_label }}
</button>
