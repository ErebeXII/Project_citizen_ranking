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

        uploadDataChanges(address, mail, phone);
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

function loadProfilePage(dictionary, dic_address,violation_score){
    dictionary = JSON.parse(dictionary);
    dic_address = JSON.parse(dic_address);

    let fname = dictionary["first_name"];
    let lname = dictionary["last_name"];
    let birthday = dictionary["birthday"];
    let birth_place = dictionary["place_of_birth"];
    let address = dic_address["street_number"]+" "+ dic_address["street"]+" "+ dic_address["city"];
    let mail = dictionary["email"];
    let phone = dictionary["phone"];

    let score = dictionary["total_point"];
    let gender = dictionary["gender"];

    updatePP(gender);

    loadProfileData(lname, fname, birthday, birth_place, address, mail, phone);

}



function updatePP(gender){
    let pp = document.getElementById("pp");

    let malepp = document.createElement("img");
    malepp.src = "../image/male.jpg";


    switch (gender){

        case "Male":
            pp.append(malepp)
            break;

        case "Female":

            break;

        default:
            break;

    }

}

function loadProfileData(lname, fname, bday, birth_place, address, mail, phone ){
    document.getElementById("last_name").innerText = lname;
    document.getElementById("first_name").innerText = fname;
    document.getElementById("bday").innerText = bday;
    document.getElementById("birth_place").innerText = birth_place;

    document.getElementById("current_address").innerText = address;
    document.getElementById("mail_data").innerText = mail;
    document.getElementById("phone_data").innerText = phone;

}

function updateDetailScore(){

}

function uploadDataChanges(address, mail, phoneNB){
    $.ajax({
        type : "POST",  //type of method
            url  : "profile_page.php",  //your page
            data : { name : address.innerHTML, email : mail.innerHTML, phone : phoneNB.innerHTML },// passing the values
            success: function(res){  
                                    console.log("success ?");
                    }
    })
}
