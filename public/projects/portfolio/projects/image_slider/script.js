function currentDiv(n) {
    showDivs(slideIndex = n);
}

function getCurrent() {
    var slide = document.querySelectorAll('.slides').style.display = "block";
    var slides = slide.length;
    document.getElementById('counter').innerHTML = slides;
}

function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("slides");
    var dots = document.getElementsByClassName("nav-block");

    if (n > x.length) {
        slideIndex = 1
    } /*<div class="slides slide-1" data-slide="1" style=""><<div class="slides slide-2" data-slide="2" style="display: none;"></div<div class="slides slide-3" data-slide="3" style="display: none;"></div><div class="slides slide-4" data-slide="4" style="display: none;"></div>*/

    if (n < 1) {
        slideIndex = x.length
    }


    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }

    // current slide has full opacity
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" off", "");
    }

    // set current slide to show
    x[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " off";
}