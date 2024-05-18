document.addEventListener("DOMContentLoaded", function(){
    var result = location.search.substring(1).split("&");
    if (result == 1){
        messageText = "Белый жемчуг";
    }
    else if (result == 2){
        messageText = "Розовый праздник";
    }
    else if (result == 3){
        messageText = "Снежная ночь";
    }
    else if (result == 4){
        messageText = "Тепло";
    }
    document.getElementById('card').innerText = document.getElementById('card').innerText + " " + messageText + "!";    
});
