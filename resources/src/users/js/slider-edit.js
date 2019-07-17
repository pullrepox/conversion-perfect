require('select2/dist/js/select2.min');
require('bootstrap-tagsinput/dist/bootstrap-tagsinput.min');
require('bootstrap-datepicker/dist/js/bootstrap-datepicker.min');
require('iframe2image/dist/iframe2image.min');
require('../vendor/jscolor');
import Quill from 'quill';
import PerfectScrollbar from 'perfect-scrollbar';
import Vue from 'vue';
import vueSlider from 'vue-slider-component';
import html2canvas from 'html2canvas';

new Vue({
    el: '#prod-edit-page',
    components: {
        'vue-slider': vueSlider
    },
    data: () => ({
        loading: false,
        create_edit: false,
        bar_id: '',
        form_action: '/bars',
        permissions: {},
        upgrades: {},
        changed_status: false,
        basic_model: {
            sel_tab: 'main',
            friendly_name: '', position: 'top_sticky', group_id: '0', headline: [{attributes: {}, insert: 'Your Headline'}], headline_color: '#ffffff', background_color: '#3BAF85',
            show_bar_type: 'immediate', frequency: 'every', delay_in_seconds: 3, scroll_point_percent: 10,
            appearance: {
                opacity: 100, drop_shadow: 0, close_button: 0, background_gradient: 0, gradient_end_color: '#3BAF85', gradient_angle: 0, powered_by_position: 'bottom_right',
            },
            content: {
                sub_headline: [{attributes: {}, insert: ''}], sub_headline_color: '#ffffff', sub_background_color: '',
                video_type: 'none', content_youtube_url: '', content_vimeo_url: '', video_auto_play: 0, video_code: '',
                button_type: 'none', button_location: 'right', button_label: 'Click Here', button_background_color: '#515f7f', button_text_color: '#FFFFFF', button_animation: 'none',
                button_action: 'hide_bar', button_click_url: '', button_open_new: 0, social_button_type: 'none'
            },
            timer: {
                countdown: 'none', countdown_location: 'left', countdown_format: 'dd', countdown_end_date: '0000-00-00', countdown_end_time: '00:00:00',
                countdown_timezone: 'Canada/Central', countdown_days: 0, countdown_hours: 0, countdown_minutes: 0, countdown_background_color: '', countdown_text_color: '#FFFFFF',
                countdown_on_expiry: 'hide_bar', countdown_expiration_text: 'Expired!', countdown_expiration_url: ''
            },
            overlay: {
                third_party_url: '', custom_link: 0, custom_link_text: '', meta_title: '', meta_description: '', meta_keywords: ''
            },
            lead_capture: {
                integration_type: 'none', list: '', after_submit: 'show_message', message: 'Thank You!', autohide_delay_seconds: 3, redirect_url: '',
                opt_in_type: 'none', opt_in_youtube_url: '', opt_in_vimeo_url: '', opt_in_video_code: '', opt_in_video_auto_play: 0, image_url: '', image_upload: '',
                call_to_action: [{attributes: {}, insert: 'Call To Action Text Here'}], panel_color: '#F0F0F0',
                subscribe_text: [{attributes: {}, insert: 'Enter Your Name And Email Below...'}], subscribe_text_color: '#666666',
                opt_in_button_type: 'match_main_button', opt_in_button_label: 'Click Here', opt_in_button_bg_color: '#515f7f', opt_in_button_label_color: '#ffffff',
                opt_in_button_animation: 'none'
            },
            translation: {
                days_label: 'Days', hours_label: 'Hours', minutes_label: 'Mins', seconds_label: 'Secs', opt_in_name_placeholder: 'Your Name',
                opt_in_email_placeholder: 'you@yourdomain.com', powered_by_label: 'Powered by', disclaimer: 'We respect your privacy and will never share your information.',
            },
            auto_responder_list: [],
            group_list: [],
            template_name: ''
        },
        model: {
            sel_tab: 'main',
            friendly_name: '', position: 'top_sticky', group_id: '0', headline: [{attributes: {}, insert: 'Your Headline'}], headline_color: '#ffffff', background_color: '#3BAF85',
            show_bar_type: 'immediate', frequency: 'every', delay_in_seconds: 3, scroll_point_percent: 10, auto_responder_list: [], group_list: [], template_name: ''
        },
        showUpload: false,
        uploadPercentage: 0,
        group_name: '',
        error_message: 'Please insert correct value.',
        decodeList: {
            'friendly_name': 'friendly_name',
            'timer': 'countdown_expiration_text',
            'lead_capture': 'opt_in_button_label',
            'content': ['video_code', 'button_label'],
            'overlay': ['custom_link_text', 'meta_title'],
            'translation': ['days_label', 'hours_label', 'minutes_label', 'seconds_label', 'opt_in_name_placeholder', 'opt_in_email_placeholder', 'powered_by_label', 'disclaimer'],
        },
        quill: {},
        capturing: false
    }),
    created() {
        this.model = JSON.parse(JSON.stringify(this.basic_model));
        this.create_edit = (window._bar_opt_ary.create_edit || window._bar_opt_ary.create_edit === 'true');
        this.form_action = window._bar_opt_ary.form_action;
        this.permissions = window._clickAppConfig.permissions;
        this.upgrades = window._clickAppConfig.upgrades;
        this.bar_id = window._bar_opt_ary.bar_id;
        let vm = this;
        Object.keys(this.model).forEach(function (item) {
            if (window._bar_opt_ary.model[item]) {
                vm.model[item] = window._bar_opt_ary.model[item];
            }
        });
    },
    mounted() {
        let vm = this;
        $('[data-toggle="tooltip"]').tooltip({
            container: 'body'
        });
        
        this.initSelect2();
        this.initDatePicker();
        this.initQuillEditor();
        
        this.model.content.video_code = this.decodeHTML(this.model.content.video_code);
        this.model.content.button_label = this.decodeHTML(this.model.content.button_label);
        this.model.timer.countdown_expiration_text = this.decodeHTML(this.model.timer.countdown_expiration_text);
        this.model.overlay.custom_link_text = this.decodeHTML(this.model.overlay.custom_link_text);
        this.model.overlay.meta_title = this.decodeHTML(this.model.overlay.meta_title);
        this.model.lead_capture.opt_in_button_label = this.decodeHTML(this.model.lead_capture.opt_in_button_label);
        
        Object.keys(this.decodeList).forEach(function (item) {
            if (Array.isArray(vm.decodeList[item])) {
                for (let i = 0; i < vm.decodeList[item].length; i++) {
                    vm.model[item][vm.decodeList[item][i]] = vm.decodeHTML(vm.model[item][vm.decodeList[item][i]]);
                }
            } else {
                if (vm.decodeList[item] === item) {
                    vm.model[item] = vm.decodeHTML(vm.model[item]);
                } else {
                    vm.model[item][vm.decodeList[item]] = vm.decodeHTML(vm.model[item][vm.decodeList[item]]);
                }
            }
        });
        
        $('[data-toggle="tags"]').each(function () {
            $(this).val(vm.model[$(this).data('parent')][$(this).attr('id')]);
            
            $(this).tagsinput({
                tagClass: 'badge badge-primary'
            });
            
            $(this).on('itemAdded', function () {
                vm.model[$(this).data('parent')][$(this).attr('id')] = $(this).val();
                vm.changeStatusVal();
            });
            
            $(this).on('itemRemoved', function () {
                vm.model[$(this).data('parent')][$(this).attr('id')] = $(this).val();
                vm.changeStatusVal();
            });
        });
        
        $('#barsTab a').on('click', function (e) {
            e.preventDefault();
            return false;
        });
        
        this.initScrollTab();
        
        if (!this.changed_status && this.model.sel_tab !== 'main') {
            this.changeStatusVal();
        }
        
        this.capturing = false;
    },
    methods: {
        changeStatusVal() {
            this.changed_status = true;
        },
        tabClick(e, id) {
            e.preventDefault();
            if (!this.changed_status) {
                this.model.sel_tab = id;
                this.autoFocusField();
            } else {
                this.saveOption(id);
            }
        },
        autoFocusField() {
            let vm = this;
            let inputOptions = {main: '#friendly_name', overlay: '#third_party_url', translation: '#days_label'};
            // let selOptions = {timer: '#countdown', lead_capture: '#integration_type'};
            if (this.model.sel_tab === 'content') {
                this.$nextTick(function () {
                    vm.quill['sub_headline'].focus();
                });
            } else if (this.model.sel_tab in inputOptions) {
                this.$nextTick(function () {
                    $(inputOptions[vm.model.sel_tab]).focus();
                });
            }/* else if (this.model.sel_tab in selOptions) {
                this.$nextTick(function () {
                    vm.select2Open(selOptions[vm.model.sel_tab]);
                });
            }*/
        },
        initScrollTab() {
            new PerfectScrollbar('#prod-edit-page', {
                wheelSpeed: 2,
                wheelPropagation: true,
                minScrollbarLength: 20
            });
            
            $('.tab-pane').each(function () {
                let classN = '.' + $(this).attr('id');
                new PerfectScrollbar(classN, {
                    wheelSpeed: 2,
                    wheelPropagation: true,
                    minScrollbarLength: 20,
                    useBothWheelAxes: false,
                    suppressScrollX: true
                });
            });
        },
        initSelect2() {
            let $select = $('[data-toggle="select"]');
            let vm = this;
            if ($select.length) {
                // Init selects
                $select.each(function () {
                    $(this).select2({
                        minimumResultsForSearch: 12
                    }).on('select2:open', function () {
                        $('.form-control-label').css('color', '#525f7f');
                        $('label[data-id="' + $(this).attr('id') + '"]').css('color', '#515f7f');
                    }).on('select2:select', function () {
                        vm.changeStatusVal();
                        if ($(this).data('parent')) {
                            if ($(this).attr('id') === 'powered_by_position') {
                                if ($(this).val() === 'hidden') {
                                    if (vm.permissions['remove-powered-by'] === 0 && vm.upgrades['professional']['to_do']) {
                                        let i_html = 'Sorry, your current plan does allow hiding "Powered by Conversion Perfect". ';
                                        i_html += 'You need to upgrade to the ' + vm.upgrades['professional']['description'] + ' plan to hide "Powered by Conversion Perfect".';
                                        $('#pro-plan-item-text').html(i_html);
                                        $('#upgrade-pro-modal').modal('show');
                                        $(this).val('bottom_right').trigger('change');
                                        vm.model[$(this).data('parent')][$(this).attr('id')] = 'bottom_right';
                                        return false;
                                    }
                                }
                                
                                vm.model[$(this).data('parent')][$(this).attr('id')] = $(this).val();
                            } else {
                                vm.model[$(this).data('parent')][$(this).attr('id')] = $(this).val();
                                if ($(this).attr('id') === 'integration_type') {
                                    vm.getResponderList();
                                }
                            }
                        } else {
                            vm.model[$(this).attr('id')] = $(this).val();
                        }
                    }).on('select2:close', function () {
                        switch ($(this).attr('id')) {
                            case 'position':
                                vm.select2Open('#group_id');
                                break;
                            case 'group_id':
                                vm.quill['headline'].focus();
                                break;
                        }
                    });
                    if ($(this).data('parent')) {
                        $(this).val(`${vm.model[$(this).data('parent')][$(this).attr('id')]}`).trigger('change.select2');
                    } else {
                        $(this).val(`${vm.model[$(this).attr('id')]}`).trigger('change.select2');
                    }
                });
            }
        },
        select2Open(next_input) {
            $(next_input).select2('focus');
            $(next_input).select2('open');
        },
        initDatePicker() {
            let vm = this;
            let $datepicker = $('.datepicker');
            if ($datepicker.length) {
                $datepicker.each(function () {
                    let parent = $(this).data('parent');
                    $(this).datepicker({
                        disableTouchKeyboard: true,
                        autoclose: false,
                        startDate: new Date()
                    }).on('show', function () {
                        $('.datepicker.datepicker-dropdown').css('top', parseInt($('.datepicker.datepicker-dropdown').get(0).style.top) + 72 + 'px');
                    }).on('hide', function () {
                        if ($(this).val() !== '') {
                            if (parent) {
                                vm.model[parent][$(this).attr('id')] = $(this).val();
                            } else {
                                vm.model[$(this).attr('id')] = $(this).val();
                            }
                            vm.changeStatusVal();
                        } else {
                            if (parent) {
                                $(this).val(vm.model[parent][$(this).attr('id')]);
                            } else {
                                $(this).val(vm.model[$(this).attr('id')]);
                            }
                        }
                    }).on('changeDate', function () {
                        if ($(this).val() !== '') {
                            if (parent) {
                                vm.model[parent][$(this).attr('id')] = $(this).val();
                            } else {
                                vm.model[$(this).attr('id')] = $(this).val();
                            }
                            vm.changeStatusVal();
                        } else {
                            if (parent) {
                                $(this).val(vm.model[parent][$(this).attr('id')]);
                            } else {
                                $(this).val(vm.model[$(this).attr('id')]);
                            }
                        }
                    });
                    if (parent) {
                        $(this).val(vm.model[parent][$(this).attr('id')]);
                    } else {
                        $(this).val(vm.model[$(this).attr('id')]);
                    }
                });
            }
        },
        initQuillEditor() {
            let $quill = $('[data-toggle="quill"]');
            let vm = this;
            if ($quill.length) {
                $quill.each(function () {
                    let placeholder = $(this).data('quill-placeholder');
                    
                    // Init editor
                    vm.quill[$(this).attr('id')] = new Quill($(this).get(0), {
                        modules: {
                            toolbar: [
                                ['bold', 'italic', 'underline', 'strike']
                            ],
                            keyboard: {
                                bindings: {
                                    tab: false,
                                    handleEnter: {
                                        key: 13,
                                        handler: function () {
                                            return false;
                                        }
                                    }
                                }
                            }
                        },
                        placeholder: placeholder,
                        theme: 'snow'
                    });
                    
                    let parentId = '';
                    if ($(this).data('parent')) {
                        vm.quill[$(this).attr('id')].setContents(vm.model[$(this).data('parent')][$(this).attr('id')]);
                        parentId = $(this).data('parent');
                    } else {
                        vm.quill[$(this).attr('id')].setContents(vm.model[$(this).attr('id')]);
                    }
                    
                    let attrId = $(this).attr('id');
                    
                    let limit = 60;
                    vm.quill[$(this).attr('id')].on('text-change', function (delta, old, source) {
                        vm.changeStatusVal();
                        if (vm.quill[attrId].getLength() > limit) {
                            vm.quill[attrId].deleteText(limit, vm.quill[attrId].getLength());
                        }
                        
                        if (parentId !== '') {
                            vm.model[parentId][attrId] = JSON.parse(JSON.stringify(vm.quill[attrId].getContents().ops));
                        } else {
                            vm.model[attrId] = JSON.parse(JSON.stringify(vm.quill[attrId].getContents().ops));
                        }
                    });
                });
            }
        },
        // Form Element Tab Key Press Event
        tabKeyPress(next_input, select, e) {
            if (e.keyCode === 9) {
                e.preventDefault();
                if (select) {
                    this.select2Open(next_input);
                } else {
                    $(next_input).focus().select();
                }
            } else {
                return true;
            }
        },
        updateJSColor(id, flag) {
            this.changeStatusVal();
            if (!flag) {
                if ($(`#${id}`).val() === '') {
                    this.model[id] = '';
                } else {
                    this.model[id] = this.rgbToHex($(`#${id}`).get(0).style['background-color']);
                }
            } else {
                if ($(`#${id}`).val() === '') {
                    this.model[flag][id] = '';
                } else {
                    this.model[flag][id] = this.rgbToHex($(`#${id}`).get(0).style['background-color']);
                }
            }
        },
        rgbToHex(rgbStr) {
            let a = rgbStr.split("(")[1].split(")")[0];
            a = a.split(",");
            let b = a.map(function (x) {
                x = parseInt(x).toString(16);
                return (x.length === 1) ? "0" + x : x;
            });
            
            return b.join("").toUpperCase();
        },
        saveErrorEvent(e, save_data) {
            this.loading = false;
            if (e.response.status === 422) {
                let vm = this;
                let notify_happened = false;
                Object.keys(save_data).forEach(function (item) {
                    if (e.response.data[item]) {
                        vm.commonNotification('danger', e.response.data[item][0]);
                        notify_happened = true;
                    }
                });
                if (!notify_happened) {
                    this.showSaveErrorNotify();
                }
            } else {
                this.showSaveErrorNotify();
            }
        },
        saveOption(key) {
            if (this.create_edit) {
                let save_data = {};
                let vm = this;
                Object.keys(this.model).forEach(function (item) {
                    if (item !== 'auto_responder_list' && item !== 'group_list') {
                        if (item !== 'headline' && typeof vm.model[item] === 'object') {
                            Object.keys(vm.model[item]).forEach(function (s_item) {
                                save_data[s_item] = vm.model[item][s_item];
                            });
                        } else {
                            save_data[item] = vm.model[item];
                        }
                    }
                });
                this.loading = true;
                axios.post(this.form_action, save_data).then((r) => {
                    this.loading = false;
                    if (r.data.result === 'success') {
                        this.bar_id = r.data.id;
                        this.form_action = `${window._clickAppConfig.BASE}/bars/${this.bar_id}`;
                        this.changed_status = false;
                        this.create_edit = false;
                        this.model.sel_tab = key;
                        this.autoFocusField();
                        $('#edit_page_title').html('Edit Conversion Bar');
                    } else {
                        if (r.data.result === 'failure') {
                            this.commonNotification('error', r.data.message);
                            location.href = '/bars';
                        } else {
                            this.showSaveErrorNotify();
                        }
                    }
                }).catch((e) => {
                    this.saveErrorEvent(e, save_data);
                });
            } else {
                let save_data = {};
                if (this.model.sel_tab === 'main') {
                    save_data = {
                        friendly_name: this.model.friendly_name,
                        template_name: this.model.template_name,
                        position: this.model.position,
                        group_id: this.model.group_id,
                        headline: this.model.headline,
                        headline_color: this.model.headline_color,
                        background_color: this.model.background_color,
                        show_bar_type: this.model.show_bar_type,
                        frequency: this.model.frequency,
                        delay_in_seconds: this.model.delay_in_seconds,
                        scroll_point_percent: this.model.scroll_point_percent
                    };
                } else {
                    save_data = this.model[this.model.sel_tab];
                }
                save_data.option_key = this.model.sel_tab;
                this.loading = true;
                if (this.template_name !== '') {
                    this.capturing = true;
                    let vm = this;
                    this.$nextTick(function () {
                        html2canvas(document.querySelector('#bar-preview-section')).then((canvas) => {
                            vm.capturing = false;
                            save_data.thumbnail = canvas.toDataURL('image/png');
                            vm.saveOptionData(save_data, key);
                        });
                    });
                } else {
                    save_data.thumbnail = '';
                    this.saveOptionData(save_data, key);
                }
            }
        },
        saveOptionData(save_data, key) {
            axios.post(`/save-option/${this.bar_id}`, save_data).then((r) => {
                this.loading = false;
                if (r.data.status === 'success') {
                    $('.invalid-feedback').hide();
                    $('.form-control').removeClass('is-invalid');
                    this.model.sel_tab = key;
                    this.changed_status = false;
                    this.autoFocusField();
                } else {
                    this.showSaveErrorNotify();
                }
            }).catch((e) => {
                this.saveErrorEvent(e, save_data);
            });
        },
        showGetErrorNotify() {
            this.commonNotification('danger', 'Failed! Please make sure your internet connection or contact to support.');
        },
        showSaveErrorNotify() {
            this.commonNotification('danger', 'Data save failed! Please make sure your internet connection or inserted data correctly.');
        },
        showClearErrorNotify() {
            this.commonNotification('danger', 'Data clear failed! Please make sure your internet connection.');
        },
        commonNotification(type, msg) {
            commonNotify('top', 'right', 'fas fa-bug', type, null, msg, '', 'animated fadeInDown', 'animated fadeOutUp');
        },
        decodeHTMLEntities(text) {
            let entities = [['amp', '&'], ['apos', '\''], ['#x27', '\''], ['#x2F', '/'], ['#39', '\''], ['#47', '/'], ['lt', '<'], ['gt', '>'], ['nbsp', ' '], ['quot', '"']];
            for (let i = 0, max = entities.length; i < max; ++i)
                text = text.replace(new RegExp('&' + entities[i][0] + ';', 'g'), entities[i][1]);
            return text;
        },
        decodeHTML(html) {
            let txt = document.createElement("textarea");
            txt.innerHTML = html;
            return txt.value;
        },
        matchMainBar() {
            this.model.timer.countdown_background_color = this.model.background_color;
            this.model.timer.countdown_text_color = this.model.headline_color;
            $('#countdown_background_color').css('background-color', this.model.background_color.indexOf('#') > -1 ? this.model.background_color : `#${this.model.background_color}`);
            $('#countdown_background_color').val(this.model.background_color);
            $('#countdown_text_color').val(this.model.headline_color);
            $('#countdown_text_color').css('background-color', this.model.headline_color.indexOf('#') > -1 ? this.model.headline_color : `#${this.model.headline_color}`);
        },
        countdownCalculate() {
            let vm = this;
            let date_val = new Date(vm.model.timer.countdown_end_date);
            let change_date = new Date(date_val.toLocaleString('en-US', {
                timeZone: vm.model.timer.countdown_timezone
            }));
            let curr_date = new Date();
            let date_diff = Math.abs(change_date.getTime() - curr_date.getTime());
            return (`0${Math.ceil(date_diff / (24 * 60 * 60 * 1000))}`).slice(-2);
        },
        validationCheck(flag, parent) {
            this.changeStatusVal();
            switch (flag) {
                case 'button_label':
                    if (this.model[parent][flag] === '') {
                        this.commonNotification('danger', 'Button Text is required.');
                        this.model[parent][flag] = 'Click Here';
                        $(`#${flag}`).focus().select();
                    }
                    break;
                case 'countdown_expiration_url':
                    if (this.model[parent][flag] === '') {
                        this.commonNotification('danger', 'This field is required.');
                        $(`#${flag}`).focus().select();
                    }
                    break;
                default:
                    if (this.model[parent][flag] === '') {
                        this.commonNotification('danger', 'This field is required.');
                        $(`#${flag}`).focus().select();
                    }
                    break;
            }
        },
        changeToUrl(flag, parent) {
            this.changeStatusVal();
            switch (this.model[parent][flag]) {
                case 'h':
                case 'ht':
                case 'htt':
                case 'y':
                case 'yo':
                case 'you':
                case 'yout':
                case 'youtu':
                case 'youtub':
                case 'youtube':
                case 'v':
                case 'vi':
                case 'vim':
                case 'vime':
                case 'vimeo':
                case 'p':
                case 'pl':
                case 'pla':
                case 'play':
                case 'playe':
                case 'player':
                case 'player.':
                case 'w':
                case 'ww':
                case 'www':
                case 'www.':
                    if (flag === 'content_youtube_url' || flag === 'opt_in_youtube_url') {
                        this.model[parent][flag] = `https://www.youtube.com/embed/`;
                    } else if (flag === 'content_vimeo_url' || flag === 'opt_in_vimeo_url') {
                        this.model[parent][flag] = `https://player.vimeo.com/video`;
                    } else {
                        this.model[parent][flag] = `http`;
                    }
                    break;
            }
            if (this.model[parent][flag] !== '') {
                if (this.model[parent][flag].indexOf('http') < 0) {
                    this.model[parent][flag] = `https://${this.model[parent][flag]}`;
                }
                if (flag === 'content_youtube_url' || flag === 'opt_in_youtube_url') {
                    if (this.model[parent][flag].indexOf('watch?v=') > -1) {
                        this.model[parent][flag] = this.model[parent][flag].replace('watch?v=', 'embed/');
                    }
                }
                if (flag === 'content_vimeo_url' || flag === 'opt_in_vimeo_url') {
                    if (this.model[parent][flag].indexOf('https://vimeo.com') > -1) {
                        this.model[parent][flag] = this.model[parent][flag].replace('https://vimeo.com', 'https://player.vimeo.com/video');
                    }
                }
            }
        },
        getResponderList() {
            this.model.auto_responder_list = [{key: '', name: '-- Choose List --'}];
            if (this.model.lead_capture.integration_type === 'none') {
                this.model.lead_capture.list = '';
            } else {
                this.loading = true;
                axios.get(`/get-responder-lists?responder_id=${this.model.lead_capture.integration_type}`).then((r) => {
                    this.loading = false;
                    if (r.data.result === 'success') {
                        this.model.auto_responder_list = JSON.parse(JSON.stringify(r.data.message));
                        this.model.lead_capture.list = '';
                    } else if (r.data.result === 'failure') {
                        this.model.lead_capture.list = '';
                        this.commonNotification('danger', r.data.message);
                    } else {
                        this.model.lead_capture.list = '';
                        this.showGetErrorNotify();
                    }
                }).catch((e) => {
                    this.loading = false;
                    this.model.lead_capture.list = '';
                    this.showGetErrorNotify();
                });
            }
        },
        uploadImage(e) {
            const file = e.target.files[0];
            const formData = new FormData();
            formData.enctype = 'multipart/form-data';
            formData.append('image-upload', file, file.name);
            this.uploadPercentage = 0;
            this.showUpload = true;
            axios.post(`/image-upload/${this.bar_id}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                onUploadProgress: function (progressEvent) {
                    this.uploadPercentage = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    if (this.uploadPercentage >= 100) {
                        this.showUpload = false;
                        this.loading = true;
                    }
                }.bind(this)
            }).then((r) => {
                this.loading = false;
                if (r.data.result === 'success') {
                    this.model.lead_capture.image_upload = r.data.message;
                } else {
                    this.model.lead_capture.image_upload = '';
                    this.commonNotification('danger', r.data.message);
                }
            }).catch((e) => {
                this.loading = false;
                this.model.lead_capture.image_upload = '';
                this.commonNotification('danger', 'Internal Server Error');
            });
        },
        quickAddGroup() {
            if (this.group_name === '' || this.group_name === null) {
                this.error_message = 'Group Name is required';
                $('#group_name').addClass('is-invalid').focus();
                return;
            }
            
            $('#group_name').removeClass('is-invalid');
            axios.post(`/groups`, {
                flag: 'quick-add',
                name: this.group_name
            }).then((r) => {
                if (r.data.result === 'success') {
                    this.model.group_id = r.data.id;
                    this.model.group_list = r.data.group_list;
                    $('#group-add-modal').modal('hide');
                } else {
                    this.error_message = r.data.message;
                    $('#group_name').addClass('is-invalid').focus();
                }
            }).catch((e) => {
                this.error_message = 'Internal Server Error';
                $('#group_name').addClass('is-invalid').focus();
            });
        },
        saveAsTemplate() {
            if (this.model.template_name === '' || this.model.template_name === null) {
                this.error_message = 'Template Name is required';
                $('#template_name').addClass('is-invalid').focus();
                return;
            }
            
            this.capturing = true;
            this.loading = true;
            let vm = this;
            this.$nextTick(function () {
                html2canvas(document.querySelector('#bar-preview-section')).then((canvas) => {
                    vm.capturing = false;
                    axios.put(`/bars/${window._bar_opt_ary.bar_id}`, {
                        template_name: vm.model.template_name,
                        flag: 'template',
                        thumbnail: canvas.toDataURL('image/png')
                    }).then((r) => {
                        vm.loading = false;
                        $('#template-save-modal').modal('hide');
                        vm.commonNotification('success', 'Successfully saved.');
                    }).catch((e) => {
                        $('#template-save-modal').modal('hide');
                        vm.loading = false;
                        vm.commonNotification('danger', 'Internal Server Error. Please check your connection.');
                    });
                });
            });
        },
        actionsBar(flag, message) {
            this.loading = true;
            axios.put(`/bars/${window._bar_opt_ary.bar_id}`, {
                flag: flag,
            }).then((r) => {
                this.loading = false;
                this.commonNotification('success', 'Successfully ' + message + '.');
                location.href = '/bars';
            }).catch((e) => {
                this.loading = false;
                this.commonNotification('danger', 'Internal Server Error. Please check your connection.');
            });
        },
        archiveBar() {
            this.loading = true;
            this.actionsBar('archive', 'archived');
        },
        resetStats() {
            this.loading = true;
            this.actionsBar('reset_stats', 'reset');
        }
    }
});
