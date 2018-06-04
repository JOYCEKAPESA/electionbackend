$(document).ready(function () {
    $('#btn-login').on("click", function () {
        $('#form-login').submit();
    });

    $('#faculty').change(function () {
        var faculty_id = $(this).val();

        $.ajax({
            url: "course_options.php",
            data: {
                facultyId: faculty_id
            },
            method: 'POST',
            dataType: 'html',
            beforeSend: function (xhr) {

            },
            success: function (data, textStatus, jqXHR) {
                $('#course').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        });
    });

    $(document).on('change', '#course', function () {
        var course_id = $(this).val();

        $.ajax({
            url: "batch_options.php",
            data: {
                courseId: course_id
            },
            method: 'POST',
            dataType: 'html',
            success: function (data, textStatus, jqXHR) {
                $('#batch').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.load(errorThrown)
            }
        });
    });
});





