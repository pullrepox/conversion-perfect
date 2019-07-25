require('select2/dist/js/select2.min');
import Vue from 'vue';

new Vue({
    el: '#prod-edit-page',
    data: () => ({
        loading: false,
        create_edit: false,
        split_id: '',
        form_action: '/bars',
        permissions: {},
        upgrades: {},
        changed_status: false,
        model: {
            conversion_bar: 0,
            conversion_bar_name: '',
            split_bar_name: '',
            split_bar_weight: 0,
            splits_list: [],
            main_weight: 0
        }
    }),
    created() {
        let vm = this;
        this.create_edit = (window._split_bar.create_edit || window._split_bar.create_edit === 'true');
        this.form_action = window._split_bar.form_action;
        this.permissions = window._clickAppConfig.permissions;
        this.upgrades = window._clickAppConfig.upgrades;
        this.split_id = window._split_bar.split_id;
        Object.keys(this.model).forEach(function (item) {
            if (window._split_bar.model[item]) {
                vm.model[item] = window._split_bar.model[item];
            }
        });
    },
    mounted() {
        let vm = this;
        
        this.initSelect2();
    },
    methods: {
        changeStatusVal() {
            this.changed_status = true;
            if (!this.create_edit) {
                this.updateSplitRow();
            }
        },
        initSelect2() {
            let $select = $('[data-toggle="select"]');
            let vm = this;
            if ($select.length) {
                $select.each(function () {
                    let $this = $(this);
                    
                    $(this).select2({
                        minimumResultsForSearch: 12
                    }).on('select2:open', function () {
                        $('.form-control-label').css('color', '#525f7f');
                        $('label[data-id="' + $(this).attr('id') + '"]').css('color', '#515f7f');
                    }).on('select2:select', function () {
                        vm.model.conversion_bar = $(this).val();
                        vm.getSplitLists();
                        vm.model.conversion_bar_name = $this.select2('data')[0].text;
                    });
                    
                    $(this).val(`${vm.model.conversion_bar}`).trigger('change.select2');
                });
            }
        },
        commonNotification(type, msg) {
            commonNotify('top', 'right', 'fas fa-bug', type, null, msg, '', 'animated fadeInDown', 'animated fadeOutUp');
        },
        getSplitLists() {
            axios.get(`/split-tests?flag=list-of-bar&bar_id=${this.model.conversion_bar}`).then((r) => {
                if (r.data.status === 'success') {
                    this.model.splits_list = r.data.splits_list;
                    this.model.main_weight = r.data.main_weight;
                }
            });
        },
        equalizeWeight() {
            let averageVal = Math.round((100 / (this.model.splits_list.length + (this.model.create_edit ? 1 : 2))) * 100) / 100;
            this.loading = true;
            axios.post(`/split-tests`, {
                flag: 'average',
                bar_id: this.model.conversion_bar,
                average_weight: averageVal
            }).then((r) => {
                this.loading = false;
                if (r.data.status === 'success') {
                    this.model.splits_list.map(function (item) {
                        item.split_bar_weight = averageVal;
                    });
                    
                    this.model.main_weight = averageVal;
                    this.model.split_bar_weight = averageVal;
                } else {
                    this.saveErrorNotify();
                }
            }).catch((e) => {
                this.loading = false;
                this.saveErrorNotify();
            });
        },
        updateSplitRow() {
            let split_validate = {
                split_bar_name: true,
                split_bar_weight: 100,
            };
            
            if (this.model.split_bar_name === '' || this.model.split_bar_name === null) {
                this.commonNotification('danger', 'Description is required.');
                return false;
            }
            if (this.model.split_bar_name === this.model.conversion_bar_name) {
                this.commonNotification('danger', "Description must be different with Main Conversion Bar\'s Name.");
                return false;
            }
            if (this.model.split_bar_weight < 0.01) {
                this.commonNotification('danger', "Weight must be bigger than zero.");
                return false;
            }
            split_validate.split_bar_weight -= this.model.split_bar_weight;
            let vm = this;
            if (this.model.splits_list.length) {
                this.model.splits_list.map(function (item, i) {
                    if (item.split_bar_name === vm.model.split_bar_name) {
                        split_validate.split_bar_name = false;
                    }
                    split_validate.split_bar_weight -= item.split_bar_weight;
                });
            }
            if (split_validate.split_bar_weight <= 0) {
                this.commonNotification('danger', 'Weight must be less than 100.');
                return false;
            }
            if (!split_validate.split_bar_name) {
                this.commonNotification('danger', 'Description must be unique.');
                return false;
            }
            this.model.main_weight = split_validate.split_bar_weight;
        },
        deleteSplitTest(split_id, ind) {
            this.loading = true;
            axios.delete(`/split-tests/${split_id}`).then((r) => {
                this.loading = false;
                if (r.data.status === 'success') {
                    this.model.main_weight += Math.round(this.model.splits_list[ind].split_bar_weight * 1);
                    this.model.splits_list.splice(ind, 1);
                } else {
                    this.saveErrorNotify();
                }
            }).catch((e) => {
                this.loading = false;
                this.saveErrorNotify();
            });
        },
        addSplitRow() {
            let split_validate = {
                split_bar_name: true,
                split_bar_weight: 100,
            };
            if (this.model.split_bar_name === '' || this.model.split_bar_name === null) {
                this.commonNotification('danger', 'Description is required.');
                return false;
            }
            if (this.model.split_bar_name === this.model.conversion_bar_name) {
                this.commonNotification('danger', "Description must be different with Main Conversion Bar\'s Name.");
                return false;
            }
            if (this.model.split_bar_weight === 0) {
                this.commonNotification('danger', "Weight must be bigger than zero.");
                return false;
            }
            split_validate.split_bar_weight -= this.model.split_bar_weight;
            let vm = this;
            if (this.model.splits_list.length) {
                this.model.splits_list.map(function (item, i) {
                    if (item.split_bar_name === vm.model.split_bar_name) {
                        split_validate.split_bar_name = false;
                    }
                    split_validate.split_bar_weight -= item.split_bar_weight;
                });
            }
            if (split_validate.split_bar_weight <= 0) {
                this.commonNotification('danger', 'Weight must be less than 100.');
                return false;
            }
            
            if (!split_validate.split_bar_name) {
                this.commonNotification('danger', 'Description must be unique.');
                return false;
            }
            
            this.model.main_weight = split_validate.split_bar_weight;
            let split_test_ary = {
                split_bar_name: this.model.split_bar_name,
                split_bar_weight: this.model.split_bar_weight
            };
            this.loading = true;
            axios.post(`/split-tests`, {
                bar_id: this.model.conversion_bar,
                split_bar_name: this.model.split_bar_name,
                split_bar_weight: this.model.split_bar_weight,
                flag: 'create'
            }).then((r) => {
                this.loading = false;
                if (r.data.status === 'success') {
                    split_test_ary.id = r.data.id;
                    this.$set(this.model.splits_list, this.model.splits_list.length, split_test_ary);
                    this.model.split_bar_name = '';
                    this.model.split_bar_weight = 0;
                } else {
                    this.saveErrorNotify();
                }
            }).catch((e) => {
                this.loading = false;
                this.saveErrorNotify();
            });
        },
        saveErrorNotify() {
            this.commonNotification('danger', 'Internal Server Error. Please retry after refresh your browser.');
        }
    }
});
