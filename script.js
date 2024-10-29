let img = document.getElementById("big-img");
let imgGroup = document.getElementsByClassName("small-img");

for (let i = 0; i < imgGroup.length; i++) {
    imgGroup[i].onclick = function () {
        console.log("working");
        img.src = imgGroup[i].src;
    };
}
