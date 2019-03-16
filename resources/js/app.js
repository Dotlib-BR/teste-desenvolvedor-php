
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(function () {
    $('#modalDestroyConfirm').on('show.bs.modal', function (e) {
        let modal = $(this);
        let button = $(e.relatedTarget);
        let action = button.data('action');
        
        modal.find('form')
            .prop('action', action);
    });
});