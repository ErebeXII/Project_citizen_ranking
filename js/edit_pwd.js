
function check_input_pwd(){
    let input_correct = true;

    let pwd1 = document.getElementById("password");
    let pwd2 = document.getElementById("confirm_pwd");

    if (pwd1.value.length > 20 || pwd1.value.length < 5){
        setWarning(pwd1, "popup_pwd");
        input_correct = false;
    }

    if (pwd2.value !== pwd1.value){
        setWarning(pwd2, "popup_CPwd");
        input_correct = false;
    }

    return input_correct;
}

function submitPwdForm(){
    let form = document.getElementById("edit_pwd_form");
    let btn = document.getElementById("edit_pwd_form_btn");
    if (check_input_pwd()){
        btn.setAttribute('type', 'submit');
        form.submit();
    }
}