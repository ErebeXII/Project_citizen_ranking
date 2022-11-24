
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


