const name_re = new RegExp('^([a-zA-Z]|-|é|è| ){1,40}$');
const level_re = new RegExp('^([123])$');
const id_re = new RegExp('^\\d+$');

function check_input_violation(){
    let input_correct = true;

    let name = document.getElementById("violation_name");
    let date = document.getElementById("violation_date");
    let level = document.getElementById("violation_level");
    let id_address = document.getElementById("violation_id_address");
    let id_person = document.getElementById("violation_id_person");

    if(!name_re.test(name.value)){
        setWarning(name, "popup_Vname");
        input_correct = false;
    }

    if (date.value === "" || date.value > new Date()){
        setWarning(date, "popup_Vdate");
        input_correct = false;
    }

    if (!level_re.test(level.value)){
        setWarning(level, "popup_Vlevel");
        input_correct = false;
    }

    if (!id_re.test(id_address.value)){
        setWarning(id_address, "popup_VIDaddress");
        input_correct = false;
    }

    if (!id_re.test(id_person.value)){
        setWarning(id_person, "popup_VIDperson");
        input_correct = false;
    }


    return input_correct;
}

function submitViolationForm(){
    let form = document.getElementById("register_violation_form");
    let btn = document.getElementById("register_violation_btn");
    if (check_input_violation()){
        btn.setAttribute('type', 'submit');
        form.submit();
    }
}