let mainPhoto = document.querySelector(".mainPhoto");
let smallPhoto = document.querySelectorAll(".galleryButton");
let firstElementOfOperation = document.querySelector("#firstElementOfOperation");
let secondElementOfOperation = document.querySelector("#secondElementOfOperation");
let operationType = document.querySelector("#operation");
let resultOfOperation = document.querySelector("#calculator__result");

function changeContent() {
    document.getElementById("demo1").innerHTML = "Zmieniona zawartość tekstowa!";
  }
  
  function changeAttribute() {
    let img = document.getElementById("demo2");
    if (img.getAttribute("src") === "./img/obrazek1.jpg") {
      img.setAttribute("src", "./img/obrazek2.jpg");
      img.setAttribute("alt", "Obrazek zmieniony");
    } else {
      img.setAttribute("src", "./img/obrazek1.jpg");
      img.setAttribute("alt", "Obrazek początkowy");
    }
  }
  
  function changeStyle() {
    let element = document.getElementById("demo3");
    element.style.color = "blue";
    element.style.fontSize = "20px";
    element.style.fontWeight = "bold";
  }
  
  function toggleVisibility() {
    let element = document.getElementById("demo4");
    if (element.style.display === "none") {
      element.style.display = "block";
    } else {
      element.style.display = "none";
    }
  }

  function operation(){
    if (firstElementOfOperation.value == '' || secondElementOfOperation.value == ''){
      resultOfOperation.innerHTML = "Pola nie mogą być puste";
    } else if (operationType.value == "+"){
      resultOfOperation.innerHTML = `${firstElementOfOperation.value} ${operationType.value} ${secondElementOfOperation.value} = ${parseFloat(firstElementOfOperation.value) + parseFloat(secondElementOfOperation.value)}`;
    } else if (operationType.value == "-"){
      resultOfOperation.innerHTML = `${firstElementOfOperation.value} ${operationType.value} ${secondElementOfOperation.value} = ${parseFloat(firstElementOfOperation.value) - parseFloat(secondElementOfOperation.value)}`;
    } else if (operationType.value == "*"){
      resultOfOperation.innerHTML = `${firstElementOfOperation.value} ${operationType.value} ${secondElementOfOperation.value} = ${parseFloat(firstElementOfOperation.value) * parseFloat(secondElementOfOperation.value)}`;
    }  else if (operationType.value == "/"){
      resultOfOperation.innerHTML = `${firstElementOfOperation.value} ${operationType.value} ${secondElementOfOperation.value} = ${parseFloat(firstElementOfOperation.value) / parseFloat(secondElementOfOperation.value)}`;
    }
  }
  
  smallPhoto.forEach(element => {
    element.addEventListener('click', e => {
      mainPhoto.setAttribute('src', `${element.querySelector('img').getAttribute('src')}`);
    }); 
  });
