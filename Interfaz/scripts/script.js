/*jslint browser: true*/
/*global $, jQuery, alert*/



$(function () {
    'use strict';
    $(".pruebaReview a[href]").qtip({
        content: {
            text: $('.pruebaReview').next('.reviews')
        },
        style: {
            classes: 'qtip-light qtip-rounded',
            width: 650,
            height: 174

        }
    });
});
