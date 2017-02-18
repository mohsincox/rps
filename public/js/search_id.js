$(function() {
    $(document).on('click', '#student_id_search', function(){
        var studentId = $('#student_id').val();
        console.log(studentId);
        var url  =$(this).attr('data-url') + "?student_id="+ studentId;
        console.log(url);
        $.get(url, function (data) {
            $('#student_name_show').html(data);
        });
    });
});

$(document).ready(function () {
    $('.chosen').chosen();
});

$(function() {
    $(document).on('click', '.add-cart-item-create', function(e){
        e.preventDefault();
        var subjectId = $("#subject-id").val();
        var getMark = $("#get-mark").val();
        console.log(getMark);
        //var baseUrl = $('#url').html();
        //console.log(baseUrl);
        //var url = baseUrl + "/result/add-to-cart-edit";      //kaj kore na

        var url = "http://localhost/rps/public/result/add-to-cart";
        //var url = $(this).attr('data-url');
        console.log(url);
        $.post(url, { subject_id: subjectId, get_mark: getMark, _token: $('input[name="_token"]').val() }, function(data){
            $('#result-info-create').html(data);
            $("#subject-id").val('FFF');
            $("#get-mark").val('');
        });
    });
});