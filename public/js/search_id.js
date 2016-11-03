$(function() {
    $(document).on('click', '#student_id_search', function(){
        var studentId = $('#student_id').val();
        console.log(studentId);
        var url  = "/result/student-name-show?student_id="+ studentId;
        console.log(url);
        $.get(url, function (data) {
            $('#student_name_show').html(data);
        });
    });
});

$(document).ready(function () {
    $('.chosen').chosen();
});