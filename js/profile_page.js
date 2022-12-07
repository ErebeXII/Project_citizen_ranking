let edit_data = false;

const address_re = new RegExp('^([a-zA-Z]|\\d|\\s){3,}$');


function editPersonalData(){
    let edit = document.getElementById("edit_btn");
    let address = document.getElementById("current_address");
    let mail = document.getElementById("mail_data");
    let phone = document.getElementById("phone_data");

    if (!edit_data){
        edit_data = true;
        edit.innerHTML = "&#9989;";

        editCSSChanges(address);
        editCSSChanges(mail);
        editCSSChanges(phone);

    }
    else if (checkDataChange()){
        edit_data = false;
        edit.innerHTML = "&#9999;&#65039;";

        editCSSChanges(address, true);
        editCSSChanges(mail, true);
        editCSSChanges(phone, true);

    }

}

function checkDataChange(){

    let address = document.getElementById("current_address");
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

    if (!address_re.test(address.innerHTML)){
        setWarning(address, "popup_address", "rgb(0, 255, 46)");
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

function loadProfilePage(dictionary, violation_score){
    dictionary = JSON.parse(dictionary);

    let fname = dictionary["first_name"];
    let lname = dictionary["lname"];
    let score = dictionary["total_point"];
    let gender = dictionary["gender"];

    updatePP(gender);
}

loadProfilePage(JSON.stringify({"id":"27","psw_visi":"XI25UxAf9w","pwd":"7f6bffc5c2185af396209eead72bb3cb","last_name":"Bellew",
    "first_name":"Cordy","birthday":"1965-03-06","place_of_birth":"Nushki","current_adress_id":"557",
    "previous_address_id":"209","email":"cbellewq@indiatimes.com","phone":"981 267 6314",
    "years_of_study":"0","gender":"Female","political_affiliation":"for","status":"0","donation":"2200",
    "marital_status":"Married","children":"2","social_class":"popular class","salary":"500","total_point":"90"}), -50);

function updatePP(gender){
    let pp = document.getElementById("pp");

    switch (gender){

        case "Male":

            break;

        case "Female":

            break;

        default:
            break;

    }

}

function updateDetailScore(){

}
