<button type="button" style="border: 0;padding: 8px 12px;"
        :style="{
        'background-color': model.content.button_background_color.indexOf('#') > -1 ? model.content.button_background_color : `#${model.content.button_background_color}`,
        'color': model.content.button_text_color.indexOf('#') > -1 ? model.content.button_text_color : `#${model.content.button_text_color}`,
        'box-shadow': `0 3px 10px -4px ${model.content.button_background_color.indexOf('#') > -1 ? model.content.button_background_color : `#${model.content.button_background_color}`}`,
        'border-radius': model.content.button_type === 'rounded' ? '6px' : 0
        }">@{{ model.content.button_label }}
</button>
