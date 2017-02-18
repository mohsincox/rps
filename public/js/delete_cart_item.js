/**
 * Created by Mohsin on 1/21/2017.
 */
$(function() {
    $(document).on('click', '.delete-cart-item', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        $.get(url, function (data) {
            $('#result-info').html(data);
        });
    });
});

$(function() {
    $(document).on('click', '.add-cart-item-edit', function(e){
        e.preventDefault();
        var subjectId = $("#subject-id").val();
        var getMark = $("#get-mark").val();
        var resultId = $("#result-id").val();
        //var baseUrl = $('#url').html();
        //console.log(baseUrl);
        //var url = baseUrl + "/result/add-to-cart-edit";      //kaj kore na
        var url = "http://localhost/rps/public/result/add-to-cart-edit";
        //var url = $(this).attr('data-url');
        console.log(url);
        $.post(url, { subject_id: subjectId, get_mark: getMark, result_id: resultId, _token: $('input[name="_token"]').val() }, function(data){
            $('#result-info').html(data);
        });
    });
});
