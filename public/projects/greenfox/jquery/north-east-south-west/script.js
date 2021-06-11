let color = 'purple';
let number = 10;
let word = 'cool';

if (color === 'purple') {
    $('.red').css('background-color', 'purple');
}

if (number < 100) {
    $('.yellow').text('wow, this is a great number');
    $('main').css('height', '+=80px');
} else {
    $('.yellow').text('this is only a common number');
}

if (word === 'cool') {
    $('.lightblue').text('The power of DOM');
    $('main').css('height', '+=38px');
} else {
    $('.blue').text('cool');
}