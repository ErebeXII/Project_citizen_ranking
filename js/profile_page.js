let edit_data = false;

function editPersonalData(){
    let address = document.getElementById("current_address");
    let mail = document.getElementById("mail_data");
    let phone = document.getElementById("phone_data");
    let edit = document.getElementById("edit_btn");

    if (!edit_data){
        edit_data = true;
        edit.innerHTML = "&#9989;";

        editCSSChanges(address);
        editCSSChanges(mail);
        editCSSChanges(phone);

    }
    else {
        edit_data = false;
        edit.innerHTML = "&#9999;&#65039;";

        editCSSChanges(address, true);
        editCSSChanges(mail, true);
        editCSSChanges(phone, true);

    }

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