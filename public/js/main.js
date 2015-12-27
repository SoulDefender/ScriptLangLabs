$(document).ready(function () {
    $( "#datepicker" ).datepicker({
        autoSize: true,
        changeYear: false,
        dateFormat: "yy-mm-dd",
        minDate: new Date(),

    });


    $(".datepicker").on("change", function () {
        var id = $(this).attr("id");
        var val = $("label[for='" + id + "']").text();
        $("#msg").text(val + " changed");
    });
});
