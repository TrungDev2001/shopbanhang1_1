$.validate({
    modules: 'file',
});
$('.checkbox_cha').on('click', function () {
    $(this).parents('.card').find('.checkboxChildren').prop('checked', $(this).prop('checked'));
});
$('#checkAll').on('click', function () {
    $(this).parents().find('.checkboxChildren').prop('checked', $(this).prop('checked'));
    $(this).parents().find('.checkbox_cha').prop('checked', $(this).prop('checked'));
});