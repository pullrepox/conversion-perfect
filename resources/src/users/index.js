import PerfectScrollbar from 'perfect-scrollbar';
import VEvent from './components/VEvent';

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

require('bootstrap-notify');

require('../common/js/argon.js');
require('./js/user-common.js');
require('./js/dashboard.js');
require('./js/bar-list.js');
window.vEvent = new VEvent();

if (document.querySelector('.main-content')) {
    new PerfectScrollbar('.main-content', {
        wheelSpeed: 2,
        wheelPropagation: true,
        minScrollbarLength: 20
    });
}

if (document.querySelector('.table-responsive')) {
    new PerfectScrollbar('.table-responsive', {
        wheelSpeed: 2,
        wheelPropagation: true,
        minScrollbarLength: 20
    });
}

if (document.querySelector('.card')) {
    new PerfectScrollbar('.card', {
        wheelSpeed: 2,
        wheelPropagation: true,
        minScrollbarLength: 20
    });
}
