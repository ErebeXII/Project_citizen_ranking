let display_forgot_pwd = false;

function displayForgotPwd(){

    let form = document.getElementById("forgot_pwd_form");

    if (!display_forgot_pwd){
        form.style.visibility = "visible";
        form.style.height = "15%";
        form.style.opacity = "1";
        display_forgot_pwd = true;
    }
    else {
        form.style.visibility = "hidden";
        form.style.height = "0";
        form.style.opacity = "0";
        display_forgot_pwd = false;
    }
}

function checkInputEmail(){

    let mail = document.getElementById("mail_forgot_pwd");

    if (!mail_re.test(mail.value)){
        setWarning(mail, "popup_mail_forgot_pwd");
    }
    else {
        document.getElementById("forgot_pwd_form").submit();
    }


}

