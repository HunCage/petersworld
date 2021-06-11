function checkTime(i) {
    if (i<10) {
        i="0" + i;
    }
    return i;
}


function nowTime () {
    now = new Date();
    hour = checkTime(now.getHours());
    minut = checkTime(now.getMinutes());
    second = checkTime(now.getSeconds());
    day = now.getDate();
    month = now.getMonth()+1;
    year = now.getFullYear();

    write = day + "." + month + "." + year;
    writeNow = hour + ":" + minut + ":" + second;
    document.getElementById('date').innerHTML = write;
    document.getElementById('time').innerHTML = writeNow;
    }

    function startTime() {
        setInterval('nowTime()',1000);
    }

startTime();
