var boxes = document.getElementsByClassName("box");

for (var i = 0; i < boxes.length; i++) {
    boxes[i].addEventListener("mouseover", function(event) {
        var src = event.target.getAttribute("src");
        var index = event.target.getAttribute("index");

        for (var j = 0; j < boxes.length; j++) {
            if (j == index) continue;
            boxes[j].style.opacity = "0";
        }
        document.body.style.background = "url(" + src + ") center no-repeat";
        document.body.style.backgroundSize = "cover";
    });

    boxes[i].addEventListener("mouseleave", function(event) {
        for (var j = 0; j < boxes.length; j++) {
            boxes[j].style.opacity = "1";
        }
        document.body.style.background = "rgba(0,0,0,0.9)";
    });
}