let lp = 3;
const newTechnology = document.querySelector("#newTechnology");
const addTechnologyButton = document.querySelector("#addTechnology");
const technologyList = document.querySelector(".technologies-list");
const deleteLastTechnology = document.querySelector("#deleteLastTechnology");
const deleteAllTechnologyBtn = document.querySelector("#deleteAllTechnology");
const sum = document.querySelector("#sumInput");
const currency = document.querySelector(".currency-select");
const result = document.querySelector(".result"); 

function addTechnology() {
  const element = document.createElement("li");
  element.innerText = newTechnology.value;
  technologyList.appendChild(element);
}

function deleteTechnology() {
  let count = technologyList.childElementCount;
  if (count !== 0) {
    technologyList.removeChild(technologyList.children[count - 1]);
  }
}

function deleteAllTechnology() {
  Array.from(technologyList.children).forEach((li) =>
    technologyList.removeChild(li)
  );
}

function exchangeCurrency() {
  if (currency.value == "dollars") {
    result.innerHTML = `${Math.round(parseFloat(sum.value) * 3.85 * 100) / 100} $`;
  } else if (currency.value == "euro") {
    result.innerHTML = `${Math.round(parseFloat(sum.value) * 4.17 * 100) / 100} €`;
  }
}

function addFilm() {
  const title = document.getElementById('filmTitle').value;
  const director = document.getElementById('filmDirector').value;
  const year = document.getElementById('filmYear').value;

  const newRow = document.createElement('tr');

  const lpCell = document.createElement('td');
  lpCell.innerText = lp;
  lp++; 

  const titleCell = document.createElement('td');
  titleCell.innerText = title;

  const directorCell = document.createElement('td');
  directorCell.innerText = director;

  const yearCell = document.createElement('td');
  yearCell.innerText = year;


  newRow.appendChild(lpCell);
  newRow.appendChild(titleCell);
  newRow.appendChild(directorCell);
  newRow.appendChild(yearCell);

  const tbody = document.querySelector('tbody');
  tbody.appendChild(newRow);

  document.getElementById('filmTitle').value = '';
  document.getElementById('filmDirector').value = '';
  document.getElementById('filmYear').value = '';
}
