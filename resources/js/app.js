require('./bootstrap');
require('./check-delete');
require('./disable_updatebtn');
window.$ = window.jQuery = require('jquery');

/*
    List <=> Grid
*/

// Increment, Decrement btn in product detail
$(function() {
    var valueElement = $('#value');
    
    function incrementValue(e) {
        inputNum = Math.max(parseInt(valueElement.text()) + e.data.increment, 1);
        valueElement.text(inputNum);
        $('#qty-addto-cart').val(inputNum);
        $('#qty-buy').val(inputNum);
        return false;
    }

    $('#plus').bind('click', {
        increment: 1
    }, incrementValue);

    $('#minus').bind('click', {
        increment: -1
    }, incrementValue);
});

// success alert fadein fadeout
$(document).ready(function(){
    $('.alert-success').fadeIn().delay(1700).fadeOut();
});