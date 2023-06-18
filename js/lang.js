

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
    
    weather : 'weather',

    portuguese : 'portuguese',
    english : 'english',
    spanish : 'spanish',
    french : 'french',

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
};

var pt = {
    greeting: 'olá',

    weather : 'tempo',

    portuguese : 'português',
    english : 'inglês',
    spanish : 'espanhol',
    french : 'francês',

    details : 'Detalhes',
    thermal_sensation : 'sensação térmica',
    humidity : 'umidade',
    pressure : 'pressão',
    wind : 'vento',

    search: 'Procurar',
    research : 'Pesquisar',
    not_found : 'Não Encontrado',
    no_results : 'Nenhum resultado para apresentar',

    city_region : 'Cidade/Região',
    unit : 'Unidade',
};
    
var es = {
    greeting: 'hola',

    weather : 'tiempo',

    portuguese : 'portugués',
    english : 'inglés',
    spanish : 'español',
    french : 'francés',

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
};
    
var fr = {
    greeting: 'bonjour',

    weather : 'météo',

    portuguese : 'portugais',
    english : 'anglais',
    spanish : 'espagnol',
    french : 'français',

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
};