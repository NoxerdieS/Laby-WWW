let contactCount = 1;
const dog = document.querySelector("#dog");

document.addEventListener("DOMContentLoaded", () => {
  const addButton = document.getElementById("addPerson");
  addButton.addEventListener("click", addContact);
});

function addContact() {
  const name = document.getElementById("name").value;
  const lastname = document.getElementById("lastname").value;
  const email = document.getElementById("email").value;
  const age = document.getElementById("age").value;
  const birthdate = document.getElementById("birthdate").value;
  const gender = document.getElementById("gender").value;
  const group = document.getElementById("group").value;
  
  if (!name || !lastname) {
    alert("Imię oraz nazwisko są wymagane!");
    return;
  }

  const tbody = document.querySelector("table tbody");
  const tr = document.createElement("tr");

  tr.className = group;

  const cellLp = document.createElement("td");
  cellLp.textContent = contactCount++;
  
  const cellName = document.createElement("td");
  cellName.textContent = name;
  
  const cellLastname = document.createElement("td");
  cellLastname.textContent = lastname;
  
  const cellEmail = document.createElement("td");
  cellEmail.textContent = email;
  
  const cellAge = document.createElement("td");
  cellAge.textContent = age;
  
  const cellBirthdate = document.createElement("td");
  cellBirthdate.textContent = birthdate;
  
  const cellGender = document.createElement("td");
  cellGender.textContent = gender;
  
  const cellGroup = document.createElement("td");
  cellGroup.textContent = group;

  tr.appendChild(cellLp);
  tr.appendChild(cellName);
  tr.appendChild(cellLastname);
  tr.appendChild(cellEmail);
  tr.appendChild(cellAge);
  tr.appendChild(cellBirthdate);
  tr.appendChild(cellGender);
  tr.appendChild(cellGroup);
  
  tbody.appendChild(tr);
  
  document.getElementById("name").value = "";
  document.getElementById("lastname").value = "";
  document.getElementById("email").value = "";
  document.getElementById("age").value = "";
  document.getElementById("birthdate").value = "";
  document.getElementById("gender").selectedIndex = 0;
  document.getElementById("group").selectedIndex = 0;
  
  dog.classList.remove("animate");
  void dog.offsetWidth;
  dog.classList.add("animate");
}
