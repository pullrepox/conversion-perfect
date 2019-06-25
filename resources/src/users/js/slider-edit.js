require('select2/dist/js/select2.min');
require('bootstrap-tagsinput/dist/bootstrap-tagsinput.min');
require('bootstrap-datepicker/dist/js/bootstrap-datepicker.min');
import PerfectScrollbar from 'perfect-scrollbar';
import Vue from 'vue';

new Vue({
    el: '#bar-edit-page',
    data: () => ({
        loading: false,
        create_edit: false,
        bar_option: {
            general: false, cloak: false, traffic: false, conversions: false, notifications: false, split: false, popovers: false, retargeting: false,
            geotargeting: false, language: false, mobile: false, repeat: false, maximum: false, expire: false, abuse: false
        },
        show_btn: {
            general: false, cloak: false, traffic: false, conversions: false, notifications: false, split: false, popovers: false, retargeting: false,
            geotargeting: false, language: false, mobile: false, repeat: false, maximum: false, expire: false, abuse: false
        },
        options_list: [
            {key: 'general', name: 'General', class: 'btn-outline-default'}, {key: 'cloak', name: 'Cloak URL', class: 'btn-outline-default'},
            {key: 'traffic', name: 'Costs', class: 'btn-outline-default'}, {key: 'conversions', name: 'Conversions', class: 'btn-outline-default'},
            {key: 'notifications', name: 'Notifications', class: 'btn-outline-default'}, {key: 'split', name: 'Split Test', class: 'btn-outline-success'},
            {key: 'popovers', name: 'Popovers', class: 'btn-outline-success'}, {key: 'retargeting', name: 'Retargeting', class: 'btn-outline-success'},
        ],
        options_list1: [
            {key: 'geotargeting', name: 'Geotargeting', class: 'btn-outline-warning'}, {key: 'language', name: 'Language', class: 'btn-outline-warning'},
            {key: 'mobile', name: 'Mobile', class: 'btn-outline-warning'}, {key: 'repeat', name: 'Repeat', class: 'btn-outline-warning'},
            {key: 'maximum', name: 'Maximum', class: 'btn-outline-warning'}, {key: 'expire', name: 'Expiration', class: 'btn-outline-warning'},
            {key: 'abuse', name: 'Abuse', class: 'btn-outline-danger'}
        ],
        options_label: {
            general: 'General', cloak: 'Cloak URL', traffic: 'Costs', conversions: 'Conversions', notifications: 'Notifications',
            split: 'Split Test', popovers: 'Popovers', retargeting: 'Retargeting',
            geotargeting: 'Geotargeting', language: 'Language', mobile: 'Mobile', repeat: 'Repeat', maximum: 'Maximum', expire: 'Expiration', abuse: 'Abuse'
        },
        show_options: {
            cloak: false, geo_include: false, geo_type_include: true, geo_type_exclude: true, lang_include: false
        },
        basic_model: {
            general: {redirect_mode: '301', bar_password: '', notes: '', tags: '', erase_referral: null, forward_parameters: null},
            cloak: {cloak_link: null, hide_search_engine: null, page_title: '', page_description: '', page_keywords: ''},
            traffic: {cost: 0, cost_unit: 'one_time'},
            geotargeting: {include_all: null, geo_alternate_url: '', include_countries: [], exclude_countries: []},
            language: {language_all: null, language_alternate_url: '', include_languages: [], exclude_languages: []},
            mobile: {mobile_click: '1', mobile_click_url: '', tablet_click: '1', tablet_click_url: '', ios_click: '1', ios_click_url: ''},
            repeat: {
                second_click: '1', repeat_url: ''
            },
            maximum: {max_click: 100, alternate_url: '',},
            expire: {start_at: '', url_before_start: '', expire_at: '', expire_alternate_url: '',},
            split: {id: 1, split_url_name: '', split_url: '', split_weight: 0},
            splits: []
        },
        model: {
            destination_url: '', friendly_name: '', tracking_link: '', group_id: '0',
            general: {redirect_mode: '301', bar_password: '', notes: '', tags: '', erase_referral: null, forward_parameters: null},
            cloak: {cloak_link: null, hide_search_engine: null, page_title: '', page_description: '', page_keywords: ''},
            traffic: {cost: 0, cost_unit: 'one_time'},
            geotargeting: {include_all: null, geo_alternate_url: '', include_countries: [], exclude_countries: []},
            language: {language_all: null, language_alternate_url: '', include_languages: [], exclude_languages: []},
            mobile: {mobile_click: '1', mobile_click_url: '', tablet_click: '1', tablet_click_url: '', ios_click: '1', ios_click_url: ''},
            repeat: {
                second_click: '1', repeat_url: ''
            },
            maximum: {max_click: 100, alternate_url: '',},
            expire: {start_at: '', url_before_start: '', expire_at: '', expire_alternate_url: '',},
            split: {id: 1, split_url_name: '', split_url: '', split_weight: 0},
            splits: []
        },
        sel_countries: {
            tier1: ['US', 'CA', 'GB', 'AU', 'NZ'],
            tier2: [
                'AR', 'AT', 'AW', 'BS', 'BB', 'BY', 'BE', 'BZ', 'BM', 'BR', 'CR', 'CZ', 'DE', 'DK', 'ES', 'FI', 'FR', 'GR', 'GU', 'HK', 'HU', 'IE', 'IL', 'IT', 'JP', 'MX',
                'NL', 'NO', 'PA', 'PH', 'PL', 'PT', 'PR', 'RO', 'RS', 'RU', 'SG', 'SE', 'CH', 'TW', 'TH', 'VG', 'VI'
            ],
            tier3: [
                'AD', 'AE', 'AF', 'AG', 'AI', 'AL', 'AM', 'AN', 'AO', 'AQ', 'AS', 'AX', 'AZ', 'BA', 'BD', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BL', 'BN', 'BO', 'BT', 'BV', 'BW', 'CC',
                'CD', 'CF', 'CG', 'CI', 'CK', 'CL', 'CM', 'CN', 'CO', 'CU', 'CV', 'CX', 'CY', 'DJ', 'DM', 'DO', 'DZ', 'EC', 'EE', 'EG', 'EH', 'ER', 'ET', 'FJ', 'FK', 'FM', 'FO',
                'GA', 'GD', 'GE', 'GF', 'GG', 'GH', 'GI', 'GL', 'GM', 'GN', 'GP', 'GQ', 'GS', 'GT', 'GW', 'GY', 'HM', 'HN', 'HR', 'HT', 'ID', 'IM', 'IN', 'IO', 'IQ', 'IR', 'IS',
                'JE', 'JM', 'JO', 'KE', 'KG', 'KH', 'KI', 'KM', 'KN', 'KP', 'KR', 'KW', 'KY', 'KZ', 'LA', 'LB', 'LC', 'LI', 'LK', 'LR', 'LS', 'LT', 'LU', 'LV', 'LY', 'MA', 'MC',
                'MD', 'ME', 'MF', 'MG', 'MH', 'MK', 'ML', 'MM', 'MN', 'MO', 'MP', 'MQ', 'MR', 'MS', 'MT', 'MU', 'MV', 'MW', 'MY', 'MZ', 'NA', 'NC', 'NE', 'NF', 'NG', 'NI', 'NP',
                'NR', 'NU', 'OM', 'PE', 'PF', 'PG', 'PK', 'PM', 'PN', 'PS', 'PW', 'PY', 'QA', 'RE', 'RW', 'SA', 'SB', 'SC', 'SD', 'SH', 'SI', 'SJ', 'SK', 'SL', 'SM', 'SN', 'SO',
                'SR', 'ST', 'SV', 'SY', 'SZ', 'TC', 'TD', 'TF', 'TG', 'TJ', 'TK', 'TL', 'TM', 'TN', 'TO', 'TR', 'TT', 'TV', 'TZ', 'UA', 'UG', 'UM', 'UY', 'UZ', 'VA', 'VC', 'VE',
                'VN', 'VU', 'WF', 'WS', 'YE', 'YT', 'ZA', 'ZM', 'ZW'
            ],
            eu: [
                'AT', 'BE', 'BG', 'HR', 'CY', 'CZ', 'DK', 'EE', 'FI', 'FR', 'DE', 'GR', 'HU', 'IE', 'IT', 'LV', 'LT', 'LU', 'MT', 'NL', 'PL', 'PT', 'RO', 'SK', 'SI', 'ES', 'SE', 'GB'
            ]
        },
        del_option: {
            key: '',
            label: ''
        },
        options_sub: {
            split_weight: 100
        }
    }),
    mounted() {
        let vm = this;
        this.create_edit = (window._bar_opt_ary.create_edit || window._bar_opt_ary.create_edit === 'true');
        $('[data-toggle="tooltip"]').tooltip({
            container: 'body'
        });
        
        new PerfectScrollbar('.main-content', {
            wheelSpeed: 2,
            wheelPropagation: true,
            minScrollbarLength: 20
        });
        
        
        Object.keys(this.bar_option).forEach(function (item) {
            vm.bar_option[item] = !window._bar_opt_ary[item] ? false : (window._bar_opt_ary[item] === 'true')
        });
        
        Object.keys(this.model).forEach(function (item) {
            if (window._bar_opt_ary.model[item]) {
                vm.model[item] = window._bar_opt_ary.model[item];
            }
        });
        
        this.toggleCloakOption();
        
        this.show_options.cloak = (this.model.cloak.cloak_link === 'on');
        this.show_options.geo_include = !(this.model.geotargeting.include_all === 'on');
        this.show_options.lang_include = !(this.model.language.language_all === 'on');
        if (this.bar_option.geotargeting === 'false') {
            this.show_options.geo_include = true;
        }
        if (this.bar_option.language === 'false') {
            this.show_options.lang_include = true;
        }
        
        this.initSelect2();
        this.initDatePicker();
        
        $('[data-toggle="tags"]').each(function () {
            $(this).val(vm.model[$(this).data('parent')][$(this).attr('id')]);
            
            $(this).tagsinput({
                tagClass: 'badge badge-primary'
            });
            
            $(this).on('itemAdded', function () {
                vm.model[$(this).data('parent')][$(this).attr('id')] = $(this).val();
                vm.showSaveBtn('general');
            });
            
            $(this).on('itemRemoved', function () {
                vm.model[$(this).data('parent')][$(this).attr('id')] = $(this).val();
                vm.showSaveBtn('general');
            });
        });
        
        this.initGeoTarget();
        this.initLangTarget();
        this.options_sub.split_weight = parseFloat(window._bar_opt_ary.options_sub.split_weight);
    },
    methods: {
        initSelect2() {
            let $select = $('[data-toggle="select"]');
            let vm = this;
            if ($select.length) {
                // Init selects
                $select.each(function () {
                    let multi_sel = ['include_countries', 'exclude_countries', 'include_languages', 'exclude_languages'];
                    $(this).select2({
                        minimumResultsForSearch: 12
                    }).on('select2:open', function () {
                        $('.form-control-label').css('color', '#525f7f');
                        $('label[data-id="' + $(this).attr('id') + '"]').css('color', '#515f7f');
                    }).on('select2:select', function () {
                        if ($(this).data('parent')) {
                            vm.model[$(this).data('parent')][$(this).attr('id')] = $(this).val();
                            vm.showSaveBtn($(this).data('parent'));
                        } else {
                            vm.model[$(this).attr('id')] = $(this).val();
                        }
                    }).on('select2:close', function () {
                        switch ($(this).attr('id')) {
                            case 'include_languages':
                                vm.changeDisableEnable('include_languages', 'language', 'exclude_languages');
                                vm.showSaveBtn('language');
                                break;
                            case 'exclude_languages':
                                vm.changeDisableEnable('exclude_languages', 'language', 'include_languages');
                                vm.showSaveBtn('language');
                                break;
                            case 'include_countries':
                                vm.changeDisableEnable('include_countries', 'geotargeting', 'exclude_countries');
                                vm.showSaveBtn('geotargeting');
                                break;
                            case 'exclude_countries':
                                vm.changeDisableEnable('exclude_countries', 'geotargeting', 'include_countries');
                                vm.showSaveBtn('geotargeting');
                                break;
                        }
                    });
                    if ($(this).attr('id') !== 'tracking_domain' && multi_sel.indexOf($(this).attr('id')) === -1) {
                        if ($(this).data('parent')) {
                            $(this).val(`${vm.model[$(this).data('parent')][$(this).attr('id')]}`).trigger('change.select2');
                        } else {
                            $(this).val(`${vm.model[$(this).attr('id')]}`).trigger('change.select2');
                        }
                    }
                });
            }
        },
        changeDisableEnable(sel, parent, other_sel) {
            if ($(`#${sel}`).val().length > 0) {
                this.model[parent][other_sel] = [];
                $(`#${other_sel}`).attr('disabled', 'disabled');
                if (sel === 'include_countries') {
                    this.show_options.geo_type_include = true;
                    this.show_options.geo_type_exclude = false;
                } else if (sel === 'exclude_countries') {
                    this.show_options.geo_type_include = false;
                    this.show_options.geo_type_exclude = true;
                }
            } else {
                $(`#${other_sel}`).removeAttr('disabled');
                if (sel === 'include_countries' || sel === 'exclude_countries') {
                    this.show_options.geo_type_include = true;
                    this.show_options.geo_type_exclude = true;
                }
            }
        },
        initDatePicker() {
            let $datepicker = $('.datepicker');
            if ($datepicker.length) {
                $datepicker.each(function () {
                    $(this).datepicker({
                        disableTouchKeyboard: true,
                        autoclose: false,
                        startDate: new Date()
                    });
                });
            }
        },
        // Form Element Tab Key Press Event
        tabKeyPress(next_input, select, e) {
            if (e.keyCode === 9) {
                e.preventDefault();
                if (select) {
                    $(next_input).select2('focus');
                    $(next_input).select2('open');
                } else {
                    $(next_input).focus().select();
                }
            } else {
                return true;
            }
        },
        // Option Hide Show Event
        toggleOption(name) {
            this.bar_option[name] = !this.bar_option[name];
            if (this.del_option.name === 'split') {
                return;
            }
            axios.post(`/hide-option/${window._bar_opt_ary.bar_id}`, {
                option_key: name
            }).then((r) => {
            }).catch((e) => {
            });
        },
        // Cloak Link Show Hide Event
        toggleCloakOption() {
            this.show_options.cloak = $('#cloak_link').prop('checked');
            this.showSaveBtn('cloak');
        },
        // Geo All Countries Show Hide
        toggleGeoOption() {
            this.show_options.geo_include = !($('#include_all').prop('checked'));
            if (!this.show_options.geo_include) {
                this.model.geotargeting.include_countries = [];
                this.model.geotargeting.exclude_countries = [];
                this.changeGeoCountries();
                this.show_options.geo_type_include = true;
                this.show_options.geo_type_exclude = true;
            }
            
            this.showSaveBtn('geotargeting');
        },
        toggleLangOption() {
            this.show_options.lang_include = !($('#language_all').prop('checked'));
            if (!this.show_options.lang_include) {
                this.model.language.include_languages = [];
                this.model.language.exclude_languages = [];
                this.changeLangOptions();
            }
            
            this.showSaveBtn('language');
        },
        isUrlValid(userInput) {
            let res = userInput.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
            return !(res === null);
        },
        autoFillCloakOptions() {
            if ($('#destination_url').val() === '') {
                $('#destination_url').focus();
                $('#destination_url').addClass('is-invalid');
                this.commonNotification('danger', 'Please Insert Destination URL.');
                return false;
            }
            
            if (!this.isUrlValid($('#destination_url').val())) {
                $('#destination_url').focus();
                $('#destination_url').addClass('is-invalid');
                this.commonNotification('danger', 'Please Insert Correct URL Value.');
                return false;
            }
            
            $('#destination_url').removeClass('is-invalid');
            
            this.loading = true;
            axios.get(`/get-track-page-info?destination_url=${$('#destination_url').val()}`).then((r) => {
                this.loading = false;
                if (r.data.result === 'success') {
                    this.model.cloak.page_title = r.data.page_title;
                    this.model.cloak.page_description = r.data.page_description;
                    this.model.cloak.page_keywords = r.data.page_keywords;
                    this.showSaveBtn('cloak');
                } else {
                    this.commonNotification('danger', 'Does not exist meta data');
                }
            }).catch((e) => {
                this.loading = false;
                this.commonNotification('danger', e.response.data.message);
            });
        },
        initLangTarget() {
            this.changeLangOptions();
            if (this.model.language.include_languages.length > 0 && this.model.language.exclude_languages.length === 0) {
                $('#include_languages').removeAttr('disabled');
                $('#exclude_languages').attr('disabled', 'disabled');
            } else if (this.model.language.include_languages.length === 0 && this.model.language.exclude_languages.length > 0) {
                $('#include_languages').attr('disabled', 'disabled');
                $('#exclude_languages').removeAttr('disabled');
            } else {
                $('#include_languages').removeAttr('disabled');
                $('#exclude_languages').removeAttr('disabled');
            }
        },
        initGeoTarget() {
            this.changeGeoCountries();
            this.show_options.geo_type_include = ((this.model.geotargeting.include_countries.length > 0 && this.model.geotargeting.exclude_countries.length === 0) || (this.model.geotargeting.include_countries.length === 0 && this.model.geotargeting.exclude_countries.length === 0));
            this.show_options.geo_type_exclude = ((this.model.geotargeting.exclude_countries.length > 0 && this.model.geotargeting.include_countries.length === 0) || (this.model.geotargeting.include_countries.length === 0 && this.model.geotargeting.exclude_countries.length === 0));
            if (!this.show_options.geo_type_include) {
                $('#include_countries').attr('disabled', 'disabled');
            } else {
                $('#include_countries').removeAttr('disabled');
            }
            if (!this.show_options.geo_type_exclude) {
                $('#exclude_countries').attr('disabled', 'disabled');
            } else {
                $('#exclude_countries').removeAttr('disabled');
            }
        },
        setGeoTarget(index, flag) {
            if (flag) {
                this.model.geotargeting.include_countries = this.sel_countries[index];
                this.model.geotargeting.exclude_countries = [];
                $('#include_countries').removeAttr('disabled');
                $('#exclude_countries').attr('disabled', 'disabled');
                this.show_options.geo_type_include = true;
                this.show_options.geo_type_exclude = false;
            } else {
                this.model.geotargeting.include_countries = [];
                this.model.geotargeting.exclude_countries = this.sel_countries[index];
                $('#include_countries').attr('disabled', 'disabled');
                $('#exclude_countries').removeAttr('disabled');
                this.show_options.geo_type_include = false;
                this.show_options.geo_type_exclude = true;
            }
            this.changeGeoCountries();
            this.showSaveBtn('geotargeting');
        },
        clearGeoTarget() {
            this.model.geotargeting.include_countries = [];
            this.model.geotargeting.exclude_countries = [];
            $('#include_countries').removeAttr('disabled');
            $('#exclude_countries').removeAttr('disabled');
            this.show_options.geo_type_include = true;
            this.show_options.geo_type_exclude = true;
            this.changeGeoCountries();
            this.showSaveBtn('geotargeting');
        },
        changeGeoCountries() {
            $('#include_countries').val(this.model.geotargeting.include_countries).trigger('change.select2');
            $('#exclude_countries').val(this.model.geotargeting.exclude_countries).trigger('change.select2');
        },
        changeLangOptions() {
            $('#include_languages').val(this.model.language.include_languages).trigger('change.select2');
            $('#exclude_languages').val(this.model.language.exclude_languages).trigger('change.select2');
        },
        clearOptionConfirm(key) {
            this.del_option.key = key;
            this.del_option.label = this.options_label[key];
            $('#delete-modal').modal('show');
        },
        clearOption() {
            axios.post(`/clear-option/${window._bar_opt_ary.bar_id}`, {
                option_key: this.del_option.key
            }).then((r) => {
                if (r.data.status === 'success') {
                    this.commonNotification('success', 'Successfully cleared!');
                    $('#delete-modal').modal('hide');
                    this.show_btn[this.del_option.key] = false;
                    this.bar_option[this.del_option.key] = false;
                    this.model[this.del_option.key] = JSON.parse(JSON.stringify(this.basic_model[this.del_option.key]));
                    let vm = this;
                    Object.keys(this.model[this.del_option.key]).forEach(function (item) {
                        if ($(`#${item}`).data('toggle')) {
                            if ($(`#${item}`).data('toggle') === 'select') {
                                $(`#${item}`).val(vm.model[vm.del_option.key][item]).trigger('change.select2');
                            } else if ($(`#${item}`).data('toggle') === 'tags') {
                                $(`#${item}`).tagsinput('removeAll');
                            }
                        }
                    });
                } else {
                    this.showClearErrorNotify();
                }
            }).catch((e) => {
                this.showClearErrorNotify();
            });
        },
        showSaveBtn(key) {
            this.show_btn[key] = true;
        },
        saveOption(key) {
            let save_data = this.model[key];
            save_data.option_key = key;
            this.loading = true;
            axios.post(`/save-option/${window._bar_opt_ary.bar_id}`, save_data).then((r) => {
                this.loading = false;
                if (r.data.status === 'success') {
                    this.show_btn[key] = false;
                } else {
                    this.showSaveErrorNotify();
                }
            }).catch((e) => {
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
            });
        },
        showSaveErrorNotify() {
            this.commonNotification('danger', 'Data save failed! Please make sure your internet connection or inserted data correctly.');
        },
        showClearErrorNotify() {
            this.commonNotification('danger', 'Data clear failed! Please make sure your internet connection.');
        },
        addSplitRow() {
            let split_validate = {
                split_url_name: true,
                split_url: {
                    invalid_url: true,
                    same: true,
                },
                split_weight: 100,
            };
            if (this.model.split.split_url_name === '' || this.model.split.split_url_name === null) {
                this.commonNotification('danger', 'URL Name is required.');
                return false;
            }
            if (this.model.split.split_url_name === this.model.friendly_name) {
                this.commonNotification('danger', 'URL Name must be different with Main Friendly Name.');
                return false;
            }
            if (this.model.split.split_url === '' || this.model.split.split_url === null) {
                this.commonNotification('danger', 'Split Test URL is required.');
                return false;
            }
            if (this.model.split.split_url === this.model.destination_url) {
                this.commonNotification('danger', 'Split Test URL must be different with Main Destination URL.');
                return false;
            }
            if (this.model.split.split_weight === 0) {
                this.commonNotification('danger', 'Weight must be bigger than zero.');
                return false;
            }
            split_validate.split_weight -= this.model.split.split_weight;
            let vm = this;
            if (this.model.splits.length) {
                this.model.splits.map(function (item, i) {
                    if (!vm.isUrlValid(item.split_url)) {
                        split_validate.split_url.invalid_url = false;
                    }
                    if (item.split_url === vm.model.split.split_url) {
                        split_validate.split_url.same = false;
                    }
                    if (item.split_url_name === vm.model.split.split_url_name) {
                        split_validate.split_url_name = false;
                    }
                    split_validate.split_weight -= item.split_weight;
                });
            }
            
            if (split_validate.split_weight <= 0) {
                this.commonNotification('danger', 'Weight Invalid.');
                return false;
            }
            
            if (!split_validate.split_url_name) {
                this.commonNotification('danger', 'URL Name must be unique.');
                return false;
            }
            
            if (!split_validate.split_url.same) {
                this.commonNotification('danger', 'Split Test URL must be unique.');
                return false;
            }
            
            if (!split_validate.split_url.invalid_url) {
                this.commonNotification('danger', 'Please insert correct URL.');
                return false;
            }
            
            this.options_sub.split_weight = split_validate.split_weight;
            
            this.showSaveBtn('split');
            axios.post(`/add-split-test/${window._bar_opt_ary.bar_id}`, this.model.split).then((r) => {
                if (r.data.status === 'success') {
                    this.model.split.id = r.data.id;
                    let split_url_ary = JSON.parse(JSON.stringify(this.model.split));
                    this.$set(this.model.splits, this.model.splits.length, split_url_ary);
                }
            });
        },
        deleteSplitRow(ind) {
            this.showSaveBtn('split');
            axios.post(`/delete-split-test/${window._bar_opt_ary.bar_id}/${this.model.splits[ind].id}`).then((r) => {
                if (r.data.status === 'success') {
                    this.options_sub.split_weight += Math.round(this.model.splits[ind].split_weight * 1);
                    this.model.splits.splice(ind, 1);
                }
            });
        },
        commonNotification(type, msg) {
            commonNotify('top', 'right', 'fas fa-bug', type, null, msg, '', 'animated fadeInDown', 'animated fadeOutUp');
        }
    }
});
