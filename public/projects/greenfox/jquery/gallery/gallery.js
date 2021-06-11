$(function() {


    let imagesData = [{
            photo: "img/img1.jpg",
            title: "Montains and lake",
            description: "Cloudy skies... Amet consectetur adipisicing elit. Fuga corrupti porro laboriosam at libero, dignissimos facere  animi architecto Lorem ipsum dolor sit doloremque natus ea.",
        },
        {
            photo: "img/img2.jpg",
            title: "Montains and Serpentine",
            description: "Lightspeed at serpentine... Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga corrupti porro laboriosam at libero, dignissimos facere animi architecto doloremque natus ea.",
        },
        {
            photo: "img/img3.jpg",
            title: "Galaxies",
            description: "Look behind the infity. Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga corrupti porro laboriosam at libero, dignissimos facere animi architecto doloremque natus ea.",
        },
        {
            photo: "img/img4.jpg",
            title: "Montains and Stars",
            description: "Endless look over the montain... Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga corrupti porro laboriosam at libero, dignissimos facere animi architecto doloremque natus ea.",
        },
        {
            photo: "img/img5.jpg",
            title: "Thunderbolt",
            description: "Dark sky with thunder. Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga corrupti porro laboriosam at libero, dignissimos facere animi architecto doloremque natus ea.",
        },
        {
            photo: "img/img6.jpg",
            title: "Coral",
            description: "Coral island, volcanic beach...Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga corrupti porro laboriosam at libero, dignissimos facere animi architecto doloremque natus ea.",
        },
        {
            photo: "img/img7.jpg",
            title: "Islands",
            description: "Small islands under the sunset. Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga corrupti porro laboriosam at libero, dignissimos facere animi architecto doloremque natus ea.",
        },
        {
            photo: "img/img8.jpg",
            title: "Wheatfield",
            description: "Eat wheat and care yourself. Fuga corrupti porro laboriosam at libero, dignissimos facere animi architecto doloremque natus ea. Lorem ipsum dolor sit amet consectetur adipisicing elit.",
        },
    ];

    let currentPhoto = 0;

    let loadPhoto = (currentPhoto) => {
        $("#photo").attr("src", imagesData[currentPhoto].photo);
        $("#photo-title").text(imagesData[currentPhoto].title);
        $("#photo-description").text(imagesData[currentPhoto].description);
        // console.log(imagesData[currentPhoto].description);
    };
    loadPhoto(currentPhoto);

    $("#arrow-left").click(() => {
        if (currentPhoto > 0) {
            currentPhoto--;
        } else if (currentPhoto <= 0) {
            currentPhoto = 7;
        }
        loadPhoto(currentPhoto);
    });
    $("#arrow-right").click(() => {
        if (currentPhoto < 7) {
            currentPhoto++;
        } else if (currentPhoto >= 7) {
            currentPhoto = 0;
        }
        loadPhoto(currentPhoto);
    });

    imagesData.forEach((item, index) => {
        $("#thumbs")
            .append(
                `<div class="thumber">
                <img src="${item.photo}" data-num="${index}" class="thmbs active" alt="">
            </div>`
            );
        $(".thumber").click((event) => {
            let numbs = parseInt($(event.target).attr("data-num"));
            // $("thmbs").toggleClass("active", true);
            loadPhoto(numbs);
        });
    });
});