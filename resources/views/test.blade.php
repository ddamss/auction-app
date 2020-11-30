<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>


    <div id="countdown"></div>
    <button id="btn">click</button>


</body>


<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
function renderCountdown(dateStart, dateEnd, counter) {

    console.log(dateStart, dateEnd);

    // Logs 
    // Sat Dec 19 2015 11:42:04 GMT-0600 (CST) 
    // Mon Jan 18 2016 11:42:04 GMT-0600 (CST)

    let currentDate = dateStart.getTime();
    let targetDate = dateEnd.getTime(); // set the countdown date
    let days, hours, minutes, seconds; // variables for time units
    let countdown = document.getElementById("countdown"); // get tag element
    // let count = 0;
    var getCountdown = function(c) {
        // find the amount of "seconds" between now and target
        let secondsLeft = ((targetDate - currentDate) / 1000) - c;
        days = pad(Math.floor(secondsLeft / 86400));
        secondsLeft %= 86400;
        hours = pad(Math.floor(secondsLeft / 3600));
        secondsLeft %= 3600;
        minutes = pad(Math.floor(secondsLeft / 60));
        seconds = pad(Math.floor(secondsLeft % 60));
        // format countdown string + set tag value
        countdown.innerHTML = "days : " + days + " ||" + hours + ":" + minutes + ":" + seconds;
        console.log("C HERE ==>" + c)

        console.log("days : " + days + " ||" + hours + ":" + minutes + ":" + seconds);
    }

    function pad(n) {
        return (n < 10 ? '0' : '') + n;
    }

    getCountdown(counter);
    console.log("Counter here ==>" + counter)

    // getCountdown();

    // setInterval(function() {
    //     getCountdown(count++);

    // }, 1000);
    counter++;
    console.log("Counter here 2 ==>" + counter)

}


var d1 = "2020-11-20 12:13:00"
var d2 = "2020-11-20 12:14:00"
var counter = 0
setInterval("renderCountdown(new Date(d1), new Date(d2),counter)", 1000);

// renderCountdown(new Date("2020-11-20 12:13:00"), new Date("2020-11-20 12:16:00"))


// var dt = new Date();

// var date =
//     `${dt.getFullYear().toString().padStart(4, '0')}-${(dt.getMonth()+1).toString().padStart(2, '0')}-${dt.getDate().toString().padStart(2, '0')} ${dt.getHours().toString().padStart(2, '0')}:${dt.getMinutes().toString().padStart(2, '0')}:${dt.getSeconds().toString().padStart(2, '0')}`

// console.log(date)
// console.log(
//     `-${dt.getFullYear().toString().padStart(4, '0')} 
//     -${(dt.getMonth()+1).toString().padStart(2, '0')}
//     -${dt.getDate().toString().padStart(2, '0')}
//     ${dt.getHours().toString().padStart(2, '0')}
//     :${dt.getMinutes().toString().padStart(2, '0')}
//     :${dt.getSeconds().toString().padStart(2, '0')}`
// );
</script>

</html>