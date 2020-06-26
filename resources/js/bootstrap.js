// window._ = require('lodash');
//
// /**
//  * We'll load the axios HTTP library which allows us to easily issue requests
//  * to our Laravel back-end. This library automatically handles sending the
//  * CSRF token as a header based on the value of the "XSRF" token cookie.
//  */
//
// window.axios = require('axios');
//
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
//
// /**
//  * Echo exposes an expressive API for subscribing to channels and listening
//  * for events that are broadcast by Laravel. Echo and event broadcasting
//  * allows your team to easily build robust real-time web applications.
//  */
//
// // import Echo from 'laravel-echo';
//
// // window.Pusher = require('pusher-js');
//
// // window.Echo = new Echo({
// //     broadcaster: 'pusher',
// //     key: process.env.MIX_PUSHER_APP_KEY,
// //     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
// //     forceTLS: true
// // });

/**
 * Dependancy AdminLTE
 */
window.$ = window.jQuery = require('jquery/dist/jquery');
require('jquery-ui-dist/jquery-ui.min');
$.widget.bridge('uibutton', $.ui.button);
// require('popper.js/dist/popper');
require('bootstrap/dist/js/bootstrap.bundle');
require('admin-lte/build/js/AdminLTE');
window.Swal = require('sweetalert2/dist/sweetalert2');
require('overlayscrollbars/js/jquery.overlayScrollbars');
require('datatables.net-bs4/js/dataTables.bootstrap4.min');
require('datatables.net-buttons-bs4/js/buttons.bootstrap4.min');
require('datatables.net-select-bs4/js/select.bootstrap4.min');
require('@fancyapps/fancybox/dist/jquery.fancybox.min');
