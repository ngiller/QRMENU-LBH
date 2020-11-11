

$(function()
{

    function timeChecker()
    {
        setInterval(function()
        {
            var storedTimeStamp = sessionStorage.getItem("lastTimeStamp");  
            timeCompare(storedTimeStamp);
        },3000);
    }


    function timeCompare(timeString)
    {
        window.onscroll = function(event) { 
            var timeStamp = new Date();
            sessionStorage.setItem("lastTimeStamp",timeStamp);
        }

        //var maxMinutes  = 1;  //GREATER THEN 1 MIN.
        var currentTime = new Date();
        var pastTime    = new Date(timeString);
        var timeDiff    = currentTime - pastTime;
        var minPast     = Math.floor( (timeDiff/60000) ); 

        if( minPast > maxMinutes)
        {
            sessionStorage.removeItem("lastTimeStamp");
            window.location = "/scan_qr";
            return false;
        }else
        {
            //JUST ADDED AS A VISUAL CONFIRMATION
            console.log(currentTime +" - "+ pastTime+" - "+minPast+" min past");
        }
    }

    if (maxMinutes > 0) {
        if (localStorage.getItem("lastTimeStamp") === null) {
            var timeStamp = new Date();
            sessionStorage.setItem("lastTimeStamp",timeStamp);
            timeChecker();
        } else {    
            timeChecker();
        } 
    } 
});//END JQUERY


