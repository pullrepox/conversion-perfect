<template>
    <div class="input-group color-picker" ref="colorpicker">
        <span class="current-color" :style="{'background-color': colorValue}" @click="togglePicker">{{ colorValue }}</span>
        <chrome-picker :value="colors" @input="updateFromPicker" v-if="displayPicker"></chrome-picker>
    </div>
</template>

<script>
    import {Chrome} from 'vue-color'
    
    export default {
        name: "color-picker",
        components: {
            'chrome-picker': Chrome
        },
        props: ['color'],
        data() {
            return {
                colors: {
                    hex: '#00000000'
                },
                colorValue: '',
                displayPicker: false
            }
        },
        mounted() {
            this.setColor(this.color || '#00000000');
            window.vEvent.listen('hideColorPicker', this.togglePicker);
        },
        methods: {
            setColor(color) {
                this.updateColors(color);
                this.colorValue = color;
            },
            updateColors(color) {
                if (color.slice(0, 1) === '#') {
                    this.colors = {
                        hex: color
                    };
                } else if (color.slice(0, 4) === 'rgba') {
                    let rgba = color.replace(/^rgba?\(|\s+|\)$/g, '').split(','),
                        hex = '#' + ((1 << 24) + (parseInt(rgba[0]) << 16) + (parseInt(rgba[1]) << 8) + parseInt(rgba[2])).toString(16).slice(1);
                    this.colors = {
                        hex: hex,
                        a: rgba[3]
                    }
                }
            },
            showPicker() {
                document.addEventListener('click', this.documentClick);
                this.displayPicker = true;
            },
            hidePicker() {
                document.removeEventListener('click', this.documentClick);
                this.displayPicker = false;
            },
            togglePicker() {
                this.displayPicker ? this.hidePicker() : this.showPicker();
            },
            updateFromPicker(color) {
                this.colors = color;
                if (color.rgba.a === 1) {
                    this.colorValue = color.hex;
                } else {
                    this.colorValue = 'rgba(' + color.rgba.r + ', ' + color.rgba.g + ', ' + color.rgba.b + ', ' + color.rgba.a + ')';
                }
            },
            documentClick(e) {
                let el = this.$refs.colorpicker,
                    target = e.target;
                
                if (el !== target && !el.contains(target)) {
                    this.hidePicker();
                }
            }
        },
        watch: {
            colorValue(val) {
                if (val) {
                    this.updateColors(val);
                    this.$emit('input', val);
                }
            }
        }
    }
</script>

<style scoped>
    .vc-chrome {
        position: absolute;
        bottom: 47px;
        z-index: 999;
    }
    
    .color-picker {
        width: 100%;
        height: 100%;
    }
    
    .color-picker span {
        width: 100%;
        height: 100%;
        text-align: left;
        padding: 10px 15px;
        color: #000;
    }
</style>
