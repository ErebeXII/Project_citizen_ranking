
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
}

/*function fetchJSON(path){
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
}*/

function loadTableFromPHP(rank, fname, lname, score){
    let table = document.getElementById("ranking_table_body");
    let tr = document.createElement("tr");
    let rankTD = document.createElement("td");
    let surnameTD = document.createElement("td");
    let nameTD = document.createElement("td");
    let scoreTD = document.createElement("td");
    let rankInt = parseInt(rank);

    switch (rankInt){
        case 0:
            rankTD.innerHTML = "&#129351;";
            tr.style.fontSize = "18pt";
            tr.style.fontWeight = "bolder";
            break;
        case 1:
            rankTD.innerHTML = "&#129352;";
            tr.style.fontSize = "16pt";
            tr.style.fontWeight = "bolder";
            break;
        case 2:
            rankTD.innerHTML = "&#129353;";
            tr.style.fontSize = "14pt";
            tr.style.fontWeight = "bolder";
            break;

        default:
            rankTD.innerHTML = (rankInt+1).toString();
            break;
    }
    rankTD.style.width = "10%";
    scoreTD.style.width = "10%";
    //console.log(data[i]);
    surnameTD.innerHTML = lname;
    nameTD.innerHTML = fname;
    scoreTD.innerHTML = score;

    tr.appendChild(rankTD);
    tr.appendChild(surnameTD);
    tr.appendChild(nameTD);
    tr.appendChild(scoreTD);
    table.appendChild(tr);

}


function funnierEmoji(){
    let emoji_title = document.getElementById("emoji_title");


    if (emoji_title.innerText === "😀") {
        setEmoji("../images/mrincredible0.png");
    }
    else if(emoji_title.innerText === "😐"){
        setEmoji("../images/mrincredible1.png");
    }
    else if(emoji_title.innerText === "😬"){
        setEmoji("../images/mrincredible2.png");
    }
    else if(emoji_title.innerText === "😨"){
        setEmoji("../images/mrincredible3.png");
    }
    else if(emoji_title.innerText === "💀"){
        setEmoji("../images/mrincredible4.png");
    }

}

function setEmoji( img_path){
    let emoji_title = document.getElementById("emoji_title");

    let img = document.createElement("img");
    let inner_emoji = emoji_title.innerText;
    img.src = img_path;
    emoji_title.innerText = "";
    img.style.borderRadius = "2em";
    img.style.height = "30vh";
    img.style.width = "auto";
    emoji_title.appendChild(img);
    setTimeout(noMoreFunnyEmoji,5000, inner_emoji);
}

function noMoreFunnyEmoji(emoji){
    let emoji_title = document.getElementById("emoji_title");
    let h1 = document.createElement("h1");
    emoji_title.innerHTML = "";
    emoji_title.style.height = "";

    h1.innerText = emoji;
    emoji_title.appendChild(h1);
}


function searchCitizen(score, fname, lname){

    let data = document.getElementById("result_data");
    let container = document.getElementById("user_results");
    let emoji_text;


    data.innerHTML = "Hello "+ fname + " " + lname + ", your score is : " + score;

    container.style.height = "5vh";
    container.style.opacity = "1";
    container.style.visibility = "visible";

    switch (true){
        case score < (-50):
            emoji_text = "💀";
            break
        case score < (-20):
            emoji_text = "😨";
            break
        case score < 0:
            emoji_text = "😬";
            break
        case score < 10:
            emoji_text = "😐";
            break

        default:
            emoji_text = "😀";
            break
    }

    noMoreFunnyEmoji(emoji_text);
}



