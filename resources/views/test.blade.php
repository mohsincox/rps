<!DOCTYPE html>
<html>
<head>

    <script class="jsbin" src="js/jquery-3.1.1.min.js"></script>




</head>
<body>
<input type='file' onchange="readURL(this);" />
<img id="blah" src="#" alt="your image" />
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