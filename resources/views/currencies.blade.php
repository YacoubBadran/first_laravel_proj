<!doctype html>
<html>
    <head>
    </head>
    <body>
        <select name="currency" onchange="getValue(this.value)">
            @foreach ($data["rates"] as $key => $value)
            <option value="{{ $key }}">{{ $key }}</option>
            @endforeach
        </select>

        <div id = 'msg'>Price</div>
    </body>

    <script>
         function getValue(value) {

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                document.getElementById("msg").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "/api/v1/currencies/convert?currency=" + value, true);
            xhttp.send();
         }
      </script>
</html>
