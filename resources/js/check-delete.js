$('.delete-all-btn').on('click', function deleteConfirm(event) {
    var res = confirm('Are you sure you want to delete all your records?')
    if (!res) {
        event.preventDefault()
    }
});

$('.single-delete-btn').on('click', function singleDeleteConfirm(event) {
    var res = confirm('Are you sure you want to delete?')
    if (!res) {
        event.preventDefault()
    } else {
        multipleDelete()
    }
});

function multipleDelete() {
    var role_id = []
    for (var i = 0; i < $('.cb-element:checked').length; i++) {
        var e = $('.cb-element:checked')[i];
        role_id.push($(e).val());
    }
    $('#form-role').val(JSON.stringify(role_id))
}

function deleteAllBtnAction() {
    if ($('#checkall').is(':checked')) {
        $('.delete-all-btn').removeClass('d-none') // show ( btn => Delete All )
    } else {
        $('.delete-all-btn').addClass('d-none') // hide ( btn => Delete All )
    }
}

function deleteBtnAction(self) {
    if ($(self).is(':checked')) {
        $('.single-delete-btn').removeClass('d-none') // show ( btn => Delete )
    } else {
        $('.single-delete-btn').addClass('d-none') // hide ( btn => Delete )
    }
}

$('#checkall').on('change', function checkAll() {
    $('.single-delete-btn').addClass('d-none') // hide ( btn => Delete )
    $('.cb-element').prop('checked', $('#checkall').is(':checked')); // check all cb-element
    if ($('.cb-element').length > 0) {
        deleteAllBtnAction() // show/hide ( btn => Delete All )
    }
});

$('.cb-element').on('change', function singleCheck(self) {
    // console.log(event.target)
    deleteBtnAction(self) // show/hide ( btn => Delete )
    if ($('.cb-element:checked').length == $('.cb-element').length) {
        $('#checkall').prop('checked', true) // auto check 
        $('.delete-all-btn').removeClass('d-none') // show ( btn => Delete All )
        $('.single-delete-btn').addClass('d-none') // hide ( btn => Delete )
    } else {
        $('#checkall').prop('checked', false) // auto uncheck
        $('.delete-all-btn').addClass('d-none') // hide ( btn => Delete All )
        $('.single-delete-btn').removeClass('d-none') // show ( btn => Delete )
    }
    if ($('.cb-element:checked').length == 0) {
        $('.single-delete-btn').addClass('d-none') // hide ( btn => Delete )
    }
});