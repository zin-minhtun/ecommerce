var init_name_val = $("#name").val();
var init_email_val = $("#email").val();
var init_role_val = $("#role").val();
var init_price_val = $("#price").val();
var init_cat_val = $("#category").val();
var init_desc_val = $("#description").val();
var init_img_val = $("#gallery").val();

$("#name").on("keyup", function (event) {
    var current_name_val = $(this).val();
    if (init_name_val != current_name_val) {
        $(".update-btn").prop("disabled", false);
    } else {
        $(".update-btn").prop("disabled", true);
    }
});
$("#email").on("keyup", function () {
    var current_email_val = $(this).val();
    if (init_email_val != current_email_val) {
        $(".update-btn").prop("disabled", false);
    } else {
        $(".update-btn").prop("disabled", true);
    }
});
$("#price").on("keyup", function () {
    var current_price_val = $(this).val();
    if (init_price_val != current_price_val) {
        $(".update-btn").prop("disabled", false);
    } else {
        $(".update-btn").prop("disabled", true);
    }
});
$("#category").on("change", function () {
    var current_cat_val = $(this).val();
    if (init_cat_val != current_cat_val) {
        $(".update-btn").prop("disabled", false);
    } else {
        $(".update-btn").prop("disabled", true);
    }
});
$("#description").on("keyup", function () {
    var current_desc_val = $(this).val();
    if (init_desc_val != current_desc_val) {
        $(".update-btn").prop("disabled", false);
    } else {
        $(".update-btn").prop("disabled", true);
    }
});

$("#role").on("change", function () {
    var current_role_val = $(this).val();
    if (init_role_val != current_role_val) {
        $(".update-btn").prop("disabled", false);
    } else {
        $(".update-btn").prop("disabled", true);
    }
});
$("#image").on("change", function () {
    var current_img_val = $(this).val();
    if (current_img_val.length == 0) {
        $(".update-btn").prop("disabled", true);
    }else {
        $(".update-btn").prop("disabled", false);
    }
});
