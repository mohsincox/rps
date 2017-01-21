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
