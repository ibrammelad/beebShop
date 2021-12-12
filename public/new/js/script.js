$(document).ready(function() {
    $('.select2').select2({});
    $('.select2-modal').select2({
        dropdownParent: $('#assignDeliveryModal')
    });
    $('.select2-modal2').select2({
        dropdownParent: $('#AddNewItem')
    });
});

(function () {
    var header = Array();
    //first get the data from the headings
    $(".table thead th").each(function (i, v) {
        header[i] = $(this).text();
    })
    //now loop through table rows and apply headings to the td in each row
    $(".table tbody tr").each(function (i, v) {
        var myRow = $(this);

        myRow.find('td').each(function (j) {
            $(this).attr('data-th', header[j]);

        })
    });

    $( ".datepicker-input" ).datepicker({
        autoSize: true
    });
}());
$(".control-container .form-control").focus(function () {
    $(this).parent().addClass("focused");
}).blur(function () {
    $(this).parent().removeClass("focused");
})
$("label").on("click", function () {
    $(this).next().focus();
})