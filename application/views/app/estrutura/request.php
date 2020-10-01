<!DOCTYPE html>
<html>
<head>
    <title>teste</title>
    <meta charset="UTF-8" />
    <script>
    //var XMLHttpRequest = require("xmlhttprequest").XMLHttpRequest;
    let http = new XMLHttpRequest();
    http.open("GET", "https://portal.stg.eugenio.io/api/v1/things", true);
    http.setRequestProperty("apikey", "1J0Uip9R4agRfEg0SZjAGV1VXVsNzpW6");
    http.setRequestHeader('Content-Type', 'application/json');

    http.onreadystatechange = function() {
        //console.log(http.responseText);
        var div = document.getElementById("divResultado");
        div.innerHTML = http.responseText; 
    }
    http.send();

</script>

</head>
<body>
    <div id="divResultado">
    </div>
</body>
</html>