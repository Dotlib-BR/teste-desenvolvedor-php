require('./bootstrap');

const swal = window.swal = require('sweetalert2');
const toast = window.toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2500
});
