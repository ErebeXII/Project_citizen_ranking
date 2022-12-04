
let table_loaded = false;

function rankingTable(){

    let wrapper = document.getElementById("hidden_wrapper1");
    if (wrapper.style.display === "flex"){
        wrapper.style.display = "none";
        window.location.href = "#wrapper1";
    }
    else{
        wrapper.style.display = "flex";
        window.location.href = "#ranking_table";
    }
    if (!table_loaded){
        //loadTable();
        loadTableFromJSON("../json/top_score.json");
        table_loaded = true;
    }

}

function fetchJSON(path){
    return fetch(path,{
        method: "POST"
    })
        .then(result => {
            return result.json();
        })
        ;
}

function loadTableFromJSON(){
    let top_score =  fetchJSON("../json/top_score.json");
    top_score.then(
        function (json){
            let data = json[2]['data'];

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
                rank.style.width = "10%";
                score.style.width = "10%";
                //console.log(data[i]);
                surname.innerHTML = data[i]['last_name'];
                name.innerHTML = data[i]['first_name'];
                score.innerHTML = data[i]['total_point'];

                tr.appendChild(rank);
                tr.appendChild(surname);
                tr.appendChild(name);
                tr.appendChild(score);
                table.appendChild(tr);

            }
        }
    )
}


function funnierEmoji(){
    let emoji_title = document.getElementById("emoji_title");
    let img = document.createElement("img");

    if (emoji_title.innerText === "😀") {
        img.src = "../images/mrincredible0.png";
        emoji_title.innerHTML = "";
        img.style.borderRadius = "2em";
        img.style.height = "30vh";
        img.style.width = "auto";
        emoji_title.appendChild(img);
        setTimeout(noMoreFunnyEmoji,5000, "😀");

    }
}

function noMoreFunnyEmoji(emoji){
    let emoji_title = document.getElementById("emoji_title");
    let h1 = document.createElement("h1");
    emoji_title.innerHTML = "";
    emoji_title.style.height = "";

    h1.innerText = emoji;
    emoji_title.appendChild(h1);
}


function updateWithScore(score){

    console.log(score);
}



