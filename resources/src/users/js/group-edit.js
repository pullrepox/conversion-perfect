import Vue from 'vue';

require('bootstrap-tagsinput/dist/bootstrap-tagsinput.min');

new Vue({
    el: '#prod-edit-page',
    data: () => ({
        create_edit: false,
        changed_status: false,
        model: {
            name: '',
            notes: '',
            tags: ''
        }
    }),
    created() {
        this.create_edit = (window._group_opt_ary.create_edit || window._group_opt_ary.create_edit === 'true');
        let vm = this;
        Object.keys(this.model).forEach(function (item) {
            if (window._group_opt_ary.model[item]) {
                vm.model[item] = window._group_opt_ary.model[item];
            }
        });
    },
    mounted() {
        let vm = this;
        
        $('[data-toggle="tags"]').each(function () {
            $(this).val(vm.model[$(this).attr('id')]);
            
            $(this).tagsinput({
                tagClass: 'badge badge-primary'
            });
            
            $(this).on('itemAdded', function () {
                vm.model[$(this).attr('id')] = $(this).val();
                vm.changed_status = true;
            });
            
            $(this).on('itemRemoved', function () {
                vm.model[$(this).attr('id')] = $(this).val();
                vm.changed_status = true;
            });
        });
    },
    methods: {
        changeStatusVal() {
            this.changed_status = true;
        }
    }
});
