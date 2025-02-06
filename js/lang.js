

function Language(lang)
{
    var __construct = function() {
        if (eval('typeof ' + lang) == 'undefined')
        {
            lang = "en";
        }
        return;
    }()

    this.getStr = function(str, defaultStr) {
        var retStr = eval('eval(lang).' + str);
        if (typeof retStr != 'undefined')
        {
            return retStr;
        } else {
            if (typeof defaultStr != 'undefined')
            {
                return defaultStr;
            } else {
                return eval('en.' + str);
            }
        }
    }
}

var en = {
    greeting: 'hello',
    
    weather : 'Weather',

    pt : 'Portuguese',
    en : 'English',
    es : 'Spanish',
    fr : 'French',

    details : 'Details',
    thermal_sensation : 'thermal sensation',
    humidity : 'humidity',
    pressure : 'pressure',
    wind : 'wind',

    search: 'Search',
    research : 'Research',
    not_found : 'Not Found',
    no_results : 'No Results to Present',

    city_region : 'City/Region',
    unit : 'Unit',

    search_placeholder : "London, England"
};

var pt = {
    greeting: 'olá',

    weather : 'Tempo',

    pt : 'Português',
    en : 'Inglês',
    es : 'Espanhol',
    fr : 'Francês',

    details : 'Detalhes',
    thermal_sensation : 'sensação térmica',
    humidity : 'humidade',
    pressure : 'pressão',
    wind : 'vento',

    search: 'Procurar',
    research : 'Pesquisar',
    not_found : 'Não Encontrado',
    no_results : 'Nenhum resultado para apresentar',

    city_region : 'Cidade/Região',
    unit : 'Unidade',

    search_placeholder : "Lisboa, Portugal"
};
    
var es = {
    greeting: 'hola',

    weather : 'Tiempo',

    pt : 'Portugués',
    en : 'Inglés',
    es : 'Español',
    fr : 'Francés',

    details : 'Detalles', 
    thermal_sensation : 'sensación térmica',
    humidity : 'humedad',
    pressure : 'presión',
    wind : 'viento',

    search: 'Buscar',
    research : 'Explorar',
    not_found : 'No encontrado',
    no_results : 'No hay resultados para mostrar',

    city_region : 'Ciudad/Región',
    unit : 'Unidad',

    search_placeholder : "Madrid, España"
};
    
var fr = {
    greeting: 'bonjour',

    weather : 'Météo',

    pt : 'Portugais',
    en : 'Anglais',
    es : 'Espagnol',
    fr : 'Français',

    details : 'Détails',
    thermal_sensation : 'sensation thermique',
    humidity : 'humidité',
    pressure : 'pression',
    wind : 'vent',

    search: 'Chercher',
    research : 'Rechercher',
    not_found : 'Non trouvé',
    no_results : 'Aucun résultat à afficher',

    city_region : 'Ville/Région',
    unit : 'Unité',

    search_placeholder : "Paris, France"
};

//Change lang when click on select
let select = document.getElementById("lang");
select.addEventListener("change", function() {
    translate()
});

function translate() {
    let lang = select.value;
    let translator = new Language(lang);

    //Select Options
    let lang_options = [
        document.getElementById("lang-en"),
        document.getElementById("lang-pt"),
        document.getElementById("lang-es"),
        document.getElementById("lang-fr"),
    ];

    for (let i = 0; i < lang_options.length; i++) {
        lang_options[i].innerHTML = translator.getStr(lang_options[i].value);
    };

    //Search Button
    let button_main = document.getElementById("button-main");

    //Details
    let details = document.getElementById("details");
    let thermal_sensation = document.getElementById("thermal_sensation");
    let humidity = document.getElementById("humidity");
    let pressure = document.getElementById("pressure");
    let wind = document.getElementById("wind");
    let not_found = document.getElementById("not_found");
    let no_results = document.getElementById("no_results");
    let research = document.getElementById("research");
    let city_region = document.getElementById("city_region");
    let unit = document.getElementById("unit");
    let search = document.getElementById("search");
    
    //Apply Translations
    if(button_main) button_main.innerHTML = translator.getStr("search");
    if(thermal_sensation) thermal_sensation.innerHTML = translator.getStr("thermal_sensation");
    if(details) details.innerHTML = translator.getStr("details");
    if(humidity) humidity.innerHTML = translator.getStr("humidity");
    if(pressure) pressure.innerHTML = translator.getStr("pressure");
    if(wind) wind.innerHTML = translator.getStr("wind");
    if(not_found) not_found.innerHTML = translator.getStr("not_found");
    if(no_results) no_results.innerHTML = translator.getStr("no_results");
    research.innerHTML = translator.getStr("research");
    city_region.innerHTML = translator.getStr("city_region");
    unit.innerHTML = translator.getStr("unit");
    search.placeholder = translator.getStr("search_placeholder");
}

translate();