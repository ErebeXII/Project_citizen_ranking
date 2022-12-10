let edit_data = false;

let uid = 0;

function editPersonalData(){
    let edit = document.getElementById("edit_btn");
    let address_nb = document.getElementById("current_address_nb");
    let address_street = document.getElementById("current_address_street");
    let address_city = document.getElementById("current_address_city");
    let mail = document.getElementById("mail_data");
    let phone = document.getElementById("phone_data");

    if (!edit_data){
        edit_data = true;
        edit.innerHTML = "&#9989;";

        editCSSChanges(address_nb);
        editCSSChanges(address_street);
        editCSSChanges(address_city);

        editCSSChanges(mail);
        editCSSChanges(phone);

    }
    else if (checkDataChange()){
        edit_data = false;
        edit.innerHTML = "&#9999;&#65039;";

        editCSSChanges(address_nb, true);
        editCSSChanges(address_street, true);
        editCSSChanges(address_city, true);
        editCSSChanges(mail, true);
        editCSSChanges(phone, true);

        uploadDataChanges(address_nb, address_city, address_street, phone, mail);
    }

}

function checkDataChange(){

    let address_nb = document.getElementById("current_address_nb");
    let address_street = document.getElementById("current_address_street");
    let address_city = document.getElementById("current_address_city");

    let mail = document.getElementById("mail_data");
    let phone = document.getElementById("phone_data");

    let input_correct = true;

    if (!phone_re.test(phone.innerHTML)){
        setWarning(phone, "popup_phone", "rgb(0, 255, 46)");
        input_correct = false;
    }

    if (!mail_re.test(mail.innerHTML)){
        setWarning(mail, "popup_mail", "rgb(0, 255, 46)");
        input_correct = false;
    }

    if (!nb_re.test(address_nb.innerHTML)){
        setWarning(address_nb, "popup_address", "rgb(0, 255, 46)");
        input_correct = false;
    }

    if (!letter_re.test(address_street.innerHTML)){
        setWarning(address_street, "popup_address", "rgb(0, 255, 46)");
        input_correct = false;
    }

    if (!letter_re.test(address_city.innerHTML)){
        setWarning(address_city, "popup_address", "rgb(0, 255, 46)");
        input_correct = false;
    }

    return input_correct;
}

function editCSSChanges(elmnt, reset){

    if (reset !== true){
        elmnt.style.backgroundColor = "rgb(0, 255, 46)";
        elmnt.style.padding = ".5em";
        elmnt.style.border = "solid black 0.1em";
        elmnt.contentEditable = true;
    }
    else {
        elmnt.style.backgroundColor = "transparent";
        elmnt.style.padding = "0";
        elmnt.style.border = "0";
        elmnt.contentEditable = false;
    }
}

function loadProfilePage(dictionary, dic_address,violation_score){
    dictionary = JSON.parse(dictionary);
    dic_address = JSON.parse(dic_address);

    let fname = dictionary["first_name"];
    let lname = dictionary["last_name"];
    let birthday = dictionary["birthday"];
    let birth_place = dictionary["place_of_birth"];
    let address_nb = dic_address["street_number"];
    let address_street = dic_address["street"];
    let address_city = dic_address["city"];
    let mail = dictionary["email"];
    let phone = dictionary["phone"];

    // let score = dictionary["total_point"];
    let gender = dictionary["gender"];

    let nb_studies = dictionary["years_of_study"];
    let social_class = dictionary["social_class"];
    let salary = parseInt(dictionary["salary"]);
    let marital_status = dictionary["marital_status"];
    let children = parseInt(dictionary["children"]);
    let party_opinion = dictionary["political_affiliation"];
    let donation = parseInt(dictionary["donation"]);
    let social_status = parseInt(dictionary["status"]);

    if (dictionary["status"] === "0"){
        updatePP();
    }else {
        updatePP(gender);

    }

    loadProfileData(lname, fname, birthday, birth_place, address_nb, address_street, address_city, mail, phone);

    updateDetailScore(nb_studies, social_class, salary, violation_score, marital_status, children,
        party_opinion, donation, social_status);

    uid = dictionary["id"];
}



function updatePP(gender){

    switch (gender){

        case "Male":
            setUpImg("../images/male.jpg");
            break;

        case "Female":
            setUpImg("../images/female.jpg");
            break;

        default:
            setUpImg("../images/admin.jpg");
            break;

    }

}

function setUpImg(path){
    let img = document.getElementById("pp_img");
    img.src = path;
    img.style.width = "100%";
    img.style.height = "auto";

    return img;
}

function loadProfileData(lname, fname, bday, birth_place, address_nb, address_street, address_city, mail, phone ){
    document.getElementById("last_name").innerText = lname;
    document.getElementById("first_name").innerText = fname;
    document.getElementById("bday").innerText = bday;
    document.getElementById("birth_place").innerText = birth_place;

    document.getElementById("current_address_nb").innerText = address_nb;
    document.getElementById("current_address_nb").style.marginRight = "1em";
    document.getElementById("current_address_street").innerText = address_street;
    document.getElementById("current_address_street").style.marginRight = "1em";
    document.getElementById("current_address_city").innerText = address_city;

    document.getElementById("mail_data").innerText = mail;
    document.getElementById("phone_data").innerText = phone;

}

function updateDetailScore(nb_studies,social_class, salary, violation, marital_status, children, party_opinion,
                           donation, social_status){

    let status = 0;
    let good_spirit = 0;
    let party_fidelity = 0;

    status += nb_studies*5;

    switch (social_class) {
        case "upper class":
            status += 10
            break
        case "popular class":
            status -= 10;
            break
        default:
            break
    }

    switch (true){
        case salary<1000:
            status -= 20;
            break
        case salary<2000:
            break
        case salary<3000:
            status += 10;
            break
        case salary<10000:
            status += 20;
            break
        case salary > 39999:
            status+= 50;
            break
        default:
            break
    }


    good_spirit += violation;

    switch (marital_status){
        case "Married":
            good_spirit+= 30;
            break
        case "single":
            good_spirit -= 10;
            break
        case "divorced":
            good_spirit -= 50;
            break
        default:
            break
    }

    switch (children){
        case 0:
            good_spirit -= 20;
            break
        case 1:
            good_spirit += 10;
            break
        case 2:
            good_spirit += 20;
            break
        case 3:
            good_spirit += 10;
            break
        default:
            good_spirit += -(children-4)*10;
            break
    }

    switch (party_opinion){
        case "for":
            party_fidelity += 50;
            break
        default:
            party_fidelity -= 20;
    }

    switch (true){
        case donation === 0:
            party_fidelity -= 20;
            break
        case donation<100:
            party_fidelity += 10;
            break
        case donation<1000:
            party_fidelity += 30;
            break
        case salary<10000:
            party_fidelity += 50;
            break
        case salary >= 10000:
            party_fidelity+= 100;
            break
        default:
            break
    }

    switch (social_status){
        case 0:
            party_fidelity+= 50;
            break
        case 1:
            party_fidelity += 25;
            break
        default:
            break
    }

    progressBarAdjustment("progress_societal_status", status);
    progressBarAdjustment("progress_public_spirit", good_spirit);
    progressBarAdjustment("progress_party_fidelity", party_fidelity);

    if (social_status === 0 || social_status === 1){
        let btn_to_userList = document.createElement("div");
        btn_to_userList.classList.add("orange_yellow_btn");
        btn_to_userList.innerHTML = "Go To User List";
        btn_to_userList.style.padding = "1em 2em 1em 2em";
        btn_to_userList.style.borderRadius = "0.5em";
        btn_to_userList.style.marginTop = "2vh";

        document.body.append(btn_to_userList);
    }

}


function progressBarAdjustment(parent_bar, score){

    let bar_detail = document.getElementById(parent_bar+"_detail");
    parent_bar = document.getElementById(parent_bar);
    let progress_minus = parent_bar.firstElementChild;
    let progress_plus = parent_bar.lastElementChild;
    let progress;

    let initial_score = score;

    parent_bar.style.display = "flex";

    if (score <= 0){
        parent_bar.style.flexDirection = "row-reverse";
        progress_plus.style.width = "50%";
        /*with row-reverse, the first element, on the right, becomes the first element on the left, thus we need to
        * switch their order
        * */
        progress_plus.style.order = "1";
        progress_minus.style.order = "2";
        progress = progress_minus;
        score = -score;

        progress.style.background ="linear-gradient(to left, #D43629, #F51C0B)";
        progress.style.boxShadow = "0 3px 3px -5px #D43629, 0 2px 5px #D43629";
    }
    else {
        parent_bar.style.flexDirection = "row";
        progress_minus.style.width = "50%";
        progress = progress_plus;
        progress.style.transition = "1s ease";

        switch (true){
            case score < 50:
                progress.style.background ="linear-gradient(to right, #D97D21, #FF6C00)";
                progress.style.boxShadow = "0 3px 3px -5px #D97D21, 0 2px 5px #D97D21";
                break
            case  score >= 50:
                progress.style.background ="linear-gradient(to right, #67B82F, #67E80E)";
                progress.style.boxShadow = "0 3px 3px -5px #67B82F, 0 2px 5px #67B82F";
                break
            default:
                break
        }
    }

    let percentage;

    if (score >= 100){
        percentage = 50;
    }
    else if (score < 10){
        percentage = 5;
    }
    else{
        percentage = score/2;
    }

    progress.style.width = percentage + "%";
    progress.innerHTML = initial_score;
    bar_detail.innerText += "score : "+ initial_score;
}

function uploadDataChanges(address_nb, address_city, address_street, phone, email){

    idAddress = 0;

    console.log("new code 4");

    $.ajax({
        type : "POST",  //type of method
        url  : "profile_page_update.php",  //your page
        data : { "address_nb" : address_nb.innerText,
                "address_city" : address_city.innerHTML,
                "address_street" : address_street.innerText },// passing the values
        success: function(res){
                console.log("success ?");
                console.log(res)
                idAddress = res;
                },
        error: function(error) {
            console.log("error");
            console.log(error);
        }
    })

    $.ajax({
        type : "POST",  //type of method
        url  : "profile_page_update.php",  //your page
        data : { "id" : uid, "new_address" : idAddress, "email" : email.innerText, "phone" : phone.innerText },// passing the values
        success: function(res){
            console.log("success ?");
            console.log(res)
            idAddress = res;
            },
        error: function(error) {
            console.log("error");
            console.log(error);
        }
    })
}