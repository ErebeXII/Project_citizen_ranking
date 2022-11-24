
let cities = [
    "Dankul",
    "Omkharak",
    "Nushki",
    "Sanratta",
    "Malkanpra",
    "Bagudi",
    "Nikadavan",
    "Polyawa",
    "Bhaktarahi",
    "Sankharkot",
    "Sulnaidah",
    "Lakni",
    "Nolhishi",
    "Farukolfaaru",
    "Phisupe",
    "Saksoperi",
    "Keligorak",
    "Abeddura",
    "Maswal",
    "Chishkhela",
    "Fazilribag",
    "Barpalle",
    "Bodipana",
    "Toralena",
    "Birgadhi",
    "Janakkhara",
    "Jhaloni",
    "Narsingshahi",
    "Veymanfushi",
    "Farukolfunadhoo",
    "Tariripe",
    "Naknig",
    "Jawmandan",
    "Abresabad",
    "Batdara",
    "Shartung",
    "Guwani",
    "Gopalribag",
    "Irarawa",
    "Thiraywatta",
    "Mechibagar",
    "Chaunepa",
    "Lalmoninaidah",
    "Sandrail",
    "Veydu",
    "Naimeedhoo",
    "Kamdang",
    "Harachap",
    "Ghulur",
    "Abrangi",
    "Qammuqam",
    "Dipalwal",
    "Jaggundi",
    "Khagasugur",
    "Attarapana",
    "Nugawatura",
    "Kamagram",
    "Khandran",
    "Khanaidah",
    "Sandlokati",
    "Magoofaru",
    "Ungoobadhoo",
    "Diplunang",
    "Sakmanu"
]

function load_dlCities(){
    var list = document.getElementById('dlCities');

    cities.forEach(function(item){
        var option = document.createElement('option');
        option.value = item;
        list.appendChild(option);
    });
}

function check_input_rgst(){

    check_name();

    check_bday();

    check_city();

    check_pswd();

    check_address(
        document.getElementById('current_address_n').value,
        document.getElementById('current_address_street').value,
        document.getElementById('current_address_city').value
    )

    check_phone(
        document.getElementById('phone_n').value
    )

    check_mail(
        document.getElementById('e-mail').value
    )
}

const letter_re = new RegExp('([a-z]|-|é|è){1,20}');

function check_name(){
    let el_fname =   document.getElementById('firstname');
    let el_lname =   document.getElementById('lastname');
    let fname = el_fname.value.toLowerCase();
    let lname = el_lname.value.toLowerCase();


    if (!letter_re.test(fname)){
        el_fname.style.backgroundColor = "rgba(185,0,0,0.5)";
        show_pop_up("popup_fname");
        setTimeout(reset_warning,5000, el_fname, "popup_fname");
        return false;
    }

    if (!letter_re.test(lname)){
        el_lname.style.backgroundColor = "rgba(185,0,0,0.5)";
        show_pop_up("popup_lname");
        setTimeout(reset_warning,5000, el_lname, "popup_lname");
        return false
    }

    return true;
}

function check_bday(){
    let el_date = document.getElementById('bday')
    let date = new Date(el_date.value);


    if(el_date.value === "" || date > new Date()){
        el_date.style.backgroundColor = "rgba(185,0,0,0.5)";
        show_pop_up("popup_bday");
        setTimeout(reset_warning,5000, el_date, "popup_bday");
        return false
    }
    return true
}

function check_city(){
    let el_city = document.getElementById('place_birth');
    let city = el_city.value;

    if (!letter_re.test(city)){
        el_city.style.backgroundColor = "rgba(185,0,0,0.5)";
        show_pop_up("popup_pbirth");
        setTimeout(reset_warning,5000, el_city, "popup_pbirth");
        return false
    }
    return true;
}

function check_pswd(psw1, psw2){
    let el_pwd1 = document.getElementById('password');
    let el_pwd2 = document.getElementById('confirm_password');

    let pwd1 = el_pwd1.value;
    let pwd2 = el_pwd2.value;

    if (pwd1.length > 20 || pwd1 === ""){
        el_pwd1.style.backgroundColor = "rgba(185,0,0,0.5)";
        show_pop_up("popup_pwd1");
        setTimeout(reset_warning,5000, el_pwd1, "popup_pwd1");
        return false
    }
    if(pwd1 !== pwd2){
        el_pwd2.style.backgroundColor = "rgba(185,0,0,0.5)";
        show_pop_up("popup_pwd2");
        setTimeout(reset_warning,5000, el_pwd2, "popup_pwd2");
        return false
    }
}

function check_address(nb,address,city){

}

function check_phone(phone){

}

function check_mail(mail){

}

function show_pop_up(pop_up, stop) {
    let popup = document.getElementById(pop_up);
    if (!popup.classList.contains("show") | stop)
        popup.classList.toggle("show");
}

function reset_warning(elmnt, popup){
    if (elmnt.style.backgroundColor !== 'transparent'){//avoid blinking popup if user spams register btn with wrong input
        elmnt.style.backgroundColor = 'transparent';
        show_pop_up(popup, true);
    }

}

