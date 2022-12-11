let horizontal_ads = setUpImg(["../images/ad1.png","../images/ad2.jpg","../images/ad3.jpg",
        "../images/ad5.jpg"]);

let vertical_ads = setUpImg(["../images/ad21.jpg","../images/ad22.png","../images/ad23.jpg"], true);

function setUpImg(list, vertical){
    let copy = [];

    for (let i = 0; i < list.length; i++) {
        let img = document.createElement("img");

        if (!vertical){
            img.style.width = "50vw";
            img.style.height = "40vh";
        }
        else {
            img.style.width = "20vw";
            img.style.height = "80vh";
        }

        img.style.objectFit = "cover";
        img.src = list[i];
        copy[i] = img;
    }

    return copy;
}

function adsFilm(element_name, index, vertical){

    console.log(index);
    let save_name = element_name;
    let element = document.getElementById(save_name);
    element.innerHTML = "";


    if (vertical === undefined){
        if (index >= horizontal_ads.length)
            index = 0;

        element.appendChild(horizontal_ads[index]);
        setTimeout(adsFilm, 3000, save_name, index+1);
    }
    else {
        if (index >= vertical_ads.length)
            index = 0;

        element.appendChild(vertical_ads[index]);

        setTimeout(adsFilm, 3000, save_name, index+1, true);
    }

}