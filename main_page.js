let table_loaded = false;

function rankingTable(){

    let wrapper = document.getElementById("hidden_wrapper1");
    if (wrapper.style.display === "flex"){
        wrapper.style.display = "none";
    }
    else{
        wrapper.style.display = "flex";
    }
    if (!table_loaded){
        loadTable();
        table_loaded = true;
    }
}

function loadTable(){
    let table = document.getElementById("ranking_table_body");

    for (let i = 0; i < 100; i++) {
        let tr = document.createElement("tr");
        let rank = document.createElement("td");
        let surname = document.createElement("td");
        let name = document.createElement("td");
        let score = document.createElement("td");

        switch (i){
            case 0:
                rank.innerHTML = "&#129351;";
                tr.style.fontSize = "18pt";
                tr.style.fontWeight = "bolder";
                break;
            case 1:
                rank.innerHTML = "&#129352;";
                tr.style.fontSize = "16pt";
                tr.style.fontWeight = "bolder";
                break;
            case 2:
                rank.innerHTML = "&#129353;";
                tr.style.fontSize = "14pt";
                tr.style.fontWeight = "bolder";
                break;

            default:
                rank.innerHTML = (i+1).toString();
                break;
        }



        surname.innerHTML = "Dupont";
        name.innerHTML = "George";
        score.innerHTML = (Math.random()*100).toString();

        tr.appendChild(rank);
        tr.appendChild(surname);
        tr.appendChild(name);
        tr.appendChild(score);
        table.appendChild(tr);
    }
}




