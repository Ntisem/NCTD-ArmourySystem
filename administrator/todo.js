

const inputBox = document.getElementById("input-box");
const listContainer = document.getElementById("list-container");
// let itemsArray = localStorage.getItem('data') ?
// JSON.parse(localStorage.getItem('data')) : [];
function addTask() {
     if(inputBox.value === ''){
        alert("You must write something !");
     }
     else{
        let li = document.createElement("li");
        li.innerText = inputBox.value;
        listContainer.appendChild(li);

        let span = document.createElement("span");
        span.innerHTML = "\u00d7";
        // To display delete or cross icon
        li.appendChild(span);
     }
      inputBox.value = "";
      saveData();
}
// when data is checked
listContainer.addEventListener("click", function(e){
  if(e.target.tagName === "LI"){
    e.target.classList.toggle("checked");
    saveData();
  }
//   Deleting data or task list
  if(e.target.tagName === "SPAN"){
    e.target.parentElement.remove();
    saveData();
  }
}, false);

// To prevent data from losing when the page is reloaded
function saveData(){
    localStorage.setItem("data", listContainer.innerHTML);
}
// To display data when the website is reloaded
function showTask(){
    listContainer.innerHTML = localStorage.getItem("data");
}
showTask();


//   function del(){
//   localStorage.clear();
//   ul.innerHTML = '';
//   itemsArray = [];
// }