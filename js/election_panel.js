$(document).ready(function () {
    $('#btn-login').on("click", function () {
        $('#form-login').submit();
    });

    $('#faculty').change(function () {
        var m_facult_id = $(this).val();

        $.ajax({
            url: "course_options.php",
            data: {
                fucult_id = m_facult_id
            },
            type: 'POST',
            dataType: 'html',
            beforeSend: function (xhr) {

            },
            success: function (data, textStatus, jqXHR) {
                console.log(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        });
    });
});





