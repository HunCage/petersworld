let arr = ['Peter', 'Andreas', 'David', 'Agustin'];
let additonalBlock = {
        title: 'Pasted with JavaScript',
        text: 'This block was inserted with the JavaScript jQuery library. King!'
    }
    // let len = arr.length;
    // let i = 0;

// for (; i < len; i++) {
//     $('ul').append(`<li>${arr[i]}</li>`);
// }

arr.forEach(function(value) {
    $('ul').append(`<li>${value}</li>`)
});

$('ul li:nth-child(7)').css({ 'font-weight': 'bold', 'color': 'tomato' });

$('p:last-child').append(`<h2>${additonalBlock.title}</h2>`);
$('p:last-child').append(`<p>${additonalBlock.text}</p>`);
$('p:last-child').css('padding-bottom', '50px');