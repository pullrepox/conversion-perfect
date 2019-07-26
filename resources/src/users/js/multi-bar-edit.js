require('select2/dist/js/select2.min');
import Vue from 'vue';

new Vue({
    el: '#prod-edit-page',
    data: () => ({
        loading: false,
        create_edit: false,
        multi_bar_id: '',
        form_action: '/multi-bars',
        changed_status: false,
        model: {
            multi_bar_name: '',
            bar_ids: []
        }
    }),
    created() {
        let vm = this;
        this.create_edit = (window._multi_bar.create_edit || window._multi_bar.create_edit === 'true');
        this.form_action = window._multi_bar.form_action;
        this.multi_bar_id = window._multi_bar.multi_bar_id;
        Object.keys(this.model).forEach(function (item) {
            if (window._multi_bar.model[item]) {
                vm.model[item] = window._multi_bar.model[item];
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
                        vm.changeStatusVal();
                        vm.model.bar_ids = $(this).val();
                    });
                });
            }
        }
    }
});
