
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
    let list = document.getElementById('dlCities');

    cities.forEach(function(item){
        let option = document.createElement('option');
        option.value = item;
        list.appendChild(option);
    });

}

function check_input_rgst(){
    let input_correct = true;

    if (!check_mail())
        input_correct = false;
    if (!check_phone())
        input_correct = false;
    if (!check_address())
        input_correct = false;
    if (!check_pswd())
        input_correct = false;
    if (!check_city())
        input_correct = false;
    if (!check_bday())
        input_correct = false;
    if (!check_name())
        input_correct = false;

    return input_correct;
}

function submitRegisterForm(){
    let form = document.getElementById("register_form");
    let btn = document.getElementById("register_btn");
    if (check_input_rgst()){
        btn.setAttribute('type', 'submit');
        form.submit();
    }
}

const letter_re = new RegExp('^([a-zA-Z]|-|é|è){1,20}$');
const nb_re = new RegExp('^\\d{1,12}$');
const mail_re = new RegExp('^[a-zA-Z0-9.!#$%&\'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\\.[a-zA-Z0-9-]+)*$');
const phone_re = new RegExp('^(\\d{3} ){2}\\d{4}$' );


function check_name(){
    let el_fname =   document.getElementById('firstname');
    let el_lname =   document.getElementById('lastname');
    let fname = el_fname.value.toLowerCase();
    let lname = el_lname.value.toLowerCase();


    if (!letter_re.test(fname)){
        setWarning(el_fname, "popup_fname");
        return false;
    }

    if (!letter_re.test(lname)){
        setWarning(el_lname, "popup_lname");
        return false
    }

    return true;
}

function check_bday(){
    let el_date = document.getElementById('bday')
    let date = new Date(el_date.value);


    if(el_date.value === "" || date > new Date()){
        setWarning(el_date, "popup_bday");
        return false
    }
    return true
}

function check_city(){
    let el_city = document.getElementById('place_birth');
    let city = el_city.value.toLowerCase();

    if (!letter_re.test(city)){
        setWarning(el_city, "popup_pbirth");
        return false
    }
    return true;
}

function check_pswd(){
    let el_pwd1 = document.getElementById('password');
    let el_pwd2 = document.getElementById('confirm_password');

    let pwd1 = el_pwd1.value;
    let pwd2 = el_pwd2.value;

    if (pwd1.length > 20 || pwd1 === ""){
        setWarning(el_pwd1, "popup_pwd1");
        return false
    }
    if(pwd1 !== pwd2){
        setWarning(el_pwd2, "popup_pwd2");

        return false
    }
    return true;
}

function check_address(){
    let el_nb = document.getElementById('current_address_n');
    let el_street = document.getElementById('current_address_street');
    let el_city = document.getElementById('current_address_city');

    let nb = el_nb.value;
    let street = el_street.value.toLowerCase();
    let city = el_city.value.toLowerCase();

    if (!nb_re.test(nb) || !letter_re.test(street) || !letter_re.test(city)){
        setWarning(el_nb, "popup_address");
        setWarning(el_street, "popup_address");
        setWarning(el_city, "popup_address");
        return false;
    }

    return true;
}

function check_phone(){
    let el_phone = document.getElementById('phone_n');
    let phone = el_phone.value;

    if(phone!== "" && !phone_re.test(phone)){
        setWarning(el_phone, "popup_phone");
        return false;
    }
    return true;
}

function check_mail(){
    let el_mail = document.getElementById('e-mail');
    let mail = el_mail.value;

    if(mail !=="" && !mail_re.test(mail)){
        setWarning(el_mail, "popup_mail");
        return false;
    }

    return true;
}

function show_pop_up(pop_up, stop) {
    let popup = document.getElementById(pop_up);
    if (!popup.classList.contains("show") || stop)
        popup.classList.toggle("show");
}

function setWarning(elmnt, popup, color){
    elmnt.style.backgroundColor = "rgba(185,0,0,0.5)";
    show_pop_up(popup);
    setTimeout(reset_warning,5000, elmnt, popup, color);
}

function reset_warning(elmnt, popup, color){
    if(color === undefined){
        color = 'transparent';
    }
    if (elmnt.style.backgroundColor !== color){//avoid blinking popup if user spams register btn with wrong input
        elmnt.style.backgroundColor = color;
        show_pop_up(popup, true);
    }
}

