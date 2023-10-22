const switchs = document.getElementById("switch");
const button1 = switchs.getElementsByTagName("button")[0];
const button2 = switchs.getElementsByTagName("button")[1];
const button3 = switchs.getElementsByTagName("button")[2];
const langSelect = document.getElementById("lang");
const langInput = document.getElementById("langInput");

langSelect.addEventListener("change", function () {
  changeLanguage(this);
});

button1.addEventListener("click", function () {
  selectOption(button1);
});
button2.addEventListener("click", function () {
  selectOption(button2);
});
button3.addEventListener("click", function () {
  selectOption(button3);
});

function changeLanguage(obj) {
  langInput.value = obj.value;
}

function selectOption(obj) {
  const buttonParents = switchs.getElementsByClassName("option");
  const tempType = document.getElementById("tempType");

  // Remove active class from all button parents
  for (let i = 0; i < buttonParents.length; i++) {
    buttonParents[i].classList.remove("active");
  }

  // Add active class to the clicked button's parent
  obj.parentElement.classList.add("active");
  tempType.value = obj.value;
}
//Write searched string
const searchInput = document.getElementById("search");
searchInput.value = search;

//Select weather unit option

if (tempType == "")
  document.getElementsByClassName("default")[0].classList.add("active");
else document.getElementsByClassName(tempType)[0].classList.add("active");

//Get Lang from post request

if (lang == "") document.getElementById("langInput").value = "en";
else {
  document.getElementById("langInput").value = lang;
  for (var i = 0; i < document.getElementById("lang").options.length; i++) {
    var option = document.getElementById("lang").options[i];
    if (option.value === lang) {
      option.selected = true;
      break;
    }
  }
}

//Choose weather icon
let icon = "";
switch (iconMain) {
  case "Clouds":
    icon = "fa-cloud";
    break;
  case "Clear":
    icon = "fa-sun";
    break;
  case "Snow":
    icon = "fa-snowflake";
    break;
  case "Rain":
    icon = "fa-cloud-showers-heavy";
    break;
  case "Drizzle":
    icon = "fa-cloud-drizzle";
    break;
  case "Thunderstorm":
    icon = "fa-bolt";
    break;
  default:
    icon = "fa-cloud";
}
let iconElement = document.getElementById("icon")
if(iconElement) iconElement.classList.add(icon);
