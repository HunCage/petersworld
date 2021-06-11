/* Clock */
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

function nowTime() {
    now = new Date();
    hour = checkTime(now.getHours());
    minut = checkTime(now.getMinutes());
    // second = checkTime(now.getSeconds());
    day = now.getDate();
    month = now.getMonth() + 1;
    year = now.getFullYear();

    write = "- " + day + "." + month + "." + year;
    writeNow = hour + ":" + minut + " -"; // + ":" + second + " ";
    document.getElementById('date').innerHTML = write;
    document.getElementById('time').innerHTML = writeNow;
}

function startTime() {
    setInterval('nowTime()', 1000);
}


/* SideBoard*/
const btns = document.querySelector(".btnx")
const side = document.querySelector("#text")

function noText(btns) {
    if (side.style.display === "none") {
        side.style.display = "block";
    } else {
        side.style.display = "none";
    }
}


/* slider */
const container = document.querySelector(".container");
const cards = document.querySelector(".cards");

let isPressedDown = false;
let cursorXSpace;

container.addEventListener("mousedown", (e) => {
    isPressedDown = true;
    cursorXSpace = e.offsetX - cards.offsetLeft;
    container.style.cursor = "grabbing";
});

container.addEventListener("mouseup", () => {
    container.style.cursor = "grab";
})
window.addEventListener("mouseup", () => {
    isPressedDown = false;
})

container.addEventListener("mousemove", (e) => {
    if (!isPressedDown) return;
    e.preventDefault();
    cards.style.left = `${e.offsetX - cursorXSpace}px`;
    boundCards();

});

function boundCards() {
    const container_rect = container.getBoundingClientRect();
    const cards_rect = cards.getBoundingClientRect();



    if (parseInt(cards.style.left) > 0) {
        cards.style.left = 0;
    } else if (cards_rect.right < container_rect.right) {
        cards.style.left = `-${cards_rect.width - container_rect.width}px`;
    }
}

function login() {
    var pass = document.getElementById('pass').value;

    if (pass === 'Besucher') {
        return true;
    } else {
        alert('Acces Denied!')
        return false;
    }
}