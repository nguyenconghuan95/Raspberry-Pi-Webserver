function toggleLed() {
    var data = 0;
    //Make a http request
    var request = new XMLHttpRequest();
    request.open("GET", "/var/www/html/testLed.php?action=toggle",true);
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
        else {
            alert("Something went wrong!!!");
            return("fail");
        }
    }
    return 0;
}

function brightenLed() {
    var data = 0;
    //Make a http request
    var request = new XMLHttpRequest();
    request.open("GET","/var/www/html/testLed.php?action=brighten", true);
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
        else {
            alert("Something went wrong!!!");
            return("fail");
        }
    }
    return 0;
}

function turnOffLed() {
    var data = 0;
    //Make a http request
    var request = new XMLHttpRequest();
    request.open("GET","/var/www/html/testLed.php?action=turnOff", true);
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
        else {
            alert("Something went wrong!!!");
            return("fail");
        }
    }
    return 0;
}
