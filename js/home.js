const switchs = document.getElementById("switch");
const button1 = switchs.getElementsByTagName('button')[0];
const button2 = switchs.getElementsByTagName('button')[1];
const button3 = switchs.getElementsByTagName('button')[2];
const langSelect = document.getElementById("lang");
const langInput = document.getElementById("langInput");

langSelect.addEventListener("change", function() {
  changeLanguage(this);
});

button1.addEventListener("click", function() {
  selectOption(button1);
});
button2.addEventListener("click", function() {
  selectOption(button2);
});
button3.addEventListener("click", function() {
  selectOption(button3);
});

function changeLanguage(obj){
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
  console.log(tempType.value);
}
