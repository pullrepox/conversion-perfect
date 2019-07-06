import Vue from 'vue';

new Vue({
    el: '#prod-edit-page',
    data: () => ({
        create_edit: false,
        changed_status: false,
        model: {
            list_name: '',
            description: ''
        }
    }),
    created() {
        this.create_edit = (window._list_opt_ary.create_edit || window._list_opt_ary.create_edit === 'true');
        let vm = this;
        Object.keys(this.model).forEach(function (item) {
            if (window._list_opt_ary.model[item]) {
                vm.model[item] = window._list_opt_ary.model[item];
            }
        });
    },
    mounted() {
        let vm = this;
    },
    methods: {
        changeStatusVal() {
            this.changed_status = true;
        }
    }
});
