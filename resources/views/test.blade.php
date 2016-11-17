<!DOCTYPE html>
<html>
<head>

    {{--<script class="jsbin" src="js/jquery-3.1.1.min.js"></script>--}}




</head>
<body>
<input type='file' onchange="readURL(this);" />
<img id="blah" src="#" alt="your image" />



<div>
    <input type="text" id="search-criteria"/>
    <input type="button" id="search" value="search"/>
</div>
<fieldset>
    <legend>Invite Facebook Friend</legend>

    <div class="fbbox">
        <img src="images/User.png" class="fbimg" />
        <div class="fix"><label for="check-2" class="left"> James </label></div>
        <input type="checkbox" name="fb" id="check-1" value="action" class="leftcx"/>
    </div>

    <div class="fbbox">
        <img src="images/User.png" class="fbimg" />
        <div class="fix"><label for="check-2" class="left">Alan </label></div>
        <input type="checkbox" name="fb" id="check-2" value="comedy" class="leftcx"/>
    </div>

    <div class="fbbox">
        <img src="images/User.png" class="fbimg" />
        <div class="fix"><label for="check-3" class="left"> Mathew </label></div>
        <input type="checkbox" name="fb" id="check-3" value="epic" class="leftcx"/>
    </div>
</fieldset>
</body>
</html>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

    {!! Html::script('js/jquery-3.1.1.min.js') !!}

<script>
    $("#search-criteria").on("keyup", function() {
        var g = $(this).val().toLowerCase();
        $(".fbbox .fix label").each(function() {
            var s = $(this).text().toLowerCase();
            $(this).closest('.fbbox')[ s.indexOf(g) !== -1 ? 'show' : 'hide' ]();
        });
    });
</script>