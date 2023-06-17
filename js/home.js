/*
<div class="input-box">
    <label for="switch" class="input-label">Unidade:</label>
    <div id="switch" class="triple-toggle-button">
        <div class="option first"><button type="button">Kelvin</button></div>
        <div class="option second active"><button type="button">Celsius</button></div>
        <div class="option third"><button type="button">Fahrenheit</button></div>
    </div>
</div>
*/

const switchs = document.getElementById("switch");
const button1 = switchs.getElementsByTagName('button')[0];
const button2 = switchs.getElementsByTagName('button')[1];
const button3 = switchs.getElementsByTagName('button')[2];

button1.addEventListener("click", function() {
  selectOption(button1);
});
button2.addEventListener("click", function() {
  selectOption(button2);
});
button3.addEventListener("click", function() {
  selectOption(button3);
});

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
