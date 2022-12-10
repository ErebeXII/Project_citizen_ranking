let pwd;
function loadUser(dictionary, address_dic){
    dictionary = JSON.parse(dictionary);
    address_dic = JSON.parse(address_dic);

    let fname = dictionary["first_name"];
    let lname = dictionary["last_name"];
    let birthday = dictionary["birthday"];
    let birth_place = dictionary["place_of_birth"];
    let address_nb = address_dic["street_number"];
    let address_street = address_dic["street"];
    let address_city = address_dic["city"];
    let mail = dictionary["email"];
    let phone = dictionary["phone"];
    pwd = dictionary["pwd"]; // initial pwd
    let id = dictionary["id"];

    console.log(dictionary);

    document.getElementById("firstname").value = fname;
    document.getElementById("lastname").value = lname;
    document.getElementById("bday").value = birthday;
    document.getElementById("place_birth").value = birth_place;
    document.getElementById("place_birth").value = birth_place;

    document.getElementById("current_address_n").value = address_nb;
    document.getElementById("current_address_street").value = address_street;
    document.getElementById("current_address_city").value = address_city;

    document.getElementById("e-mail").value = mail;
    document.getElementById("phone_n").value = phone;

    document.getElementById("password").value = pwd; // pwd are encrypted
    document.getElementById("confirm_password").value = pwd;

    document.getElementById("title_edit").innerHTML += " ID : "+ id;

}

function check_input_edit(){
    let input_correct = true;

    if (!check_mail())
        input_correct = false;
    if (!check_phone())
        input_correct = false;
    if (!check_address())
        input_correct = false;
    if (!check_pswd_imported())
        input_correct = false;
    if (!check_city())
        input_correct = false;
    if (!check_bday())
        input_correct = false;
    if (!check_name())
        input_correct = false;

    return input_correct;
}

function submitEditForm(){
    let form = document.getElementById("edit_form");
    let btn = document.getElementById("edit_btn");
    console.log("1");
    if (check_input_edit()){
        console.log("2");
        btn.setAttribute('type', 'submit');
        form.submit();
    }
}

/*
* Password when imported are larger than 20 characters due to the encryption, thus if the password wasn't change we
* accept the input
*/
function check_pswd_imported(){
    if (document.getElementById("password").value === pwd
    && document.getElementById("confirm_password").value === pwd){
        return true;
    }
    else {
        check_pswd();
    }
}