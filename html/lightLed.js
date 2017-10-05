function turn(led, name) {
    var data = 0;
    //Make a http request
    var request = new XMLHttpRequest();
    request.open("GET", "testLed.php?action=" + led + "&device=" + name,true);
    request.send();
    //receiving informations
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            data = request.responseText;
        }
        else if(request.readyState == 4 && request.status ==500) {
            alert("Server Error!!!");
            return("fail");
        }
        else if (request.readyState == 4 && request.status != 200 && request.status != 500) {
            alert("Something went wrong!!!");
            return("fail");
        }
    }
    alert("Turned " + led + " " + name);
    return 0;
}


