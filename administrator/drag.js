const draggables = document.querySelectorAll(".task");
const droppables = document.querySelectorAll(".swim-lane");

draggables.forEach((task) => {
  task.addEventListener("dragstart", () => {
    task.classList.add("is-dragging");    
    saveData();
  });
  task.addEventListener("dragend", () => {
    task.classList.remove("is-dragging");
    saveData();
  });
});

droppables.forEach((zone) => {
  zone.addEventListener("dragover", (e) => {
    e.preventDefault();

    const bottomTask = insertAboveTask(zone, e.clientY);
    const curTask = document.querySelector(".is-dragging");
    saveData();

    if (!bottomTask) {
      zone.appendChild(curTask);
      saveData();
    } else {
      zone.insertBefore(curTask, bottomTask);
      saveData();
    }
  });
});

const insertAboveTask = (zone, mouseY) => {
  const els = zone.querySelectorAll(".task:not(.is-dragging)");

  let closestTask = null;
  let closestOffset = Number.NEGATIVE_INFINITY;

  els.forEach((task) => {
    const { top } = task.getBoundingClientRect();

    const offset = mouseY - top;
    saveData();

    if (offset < 0 && offset > closestOffset) {
      closestOffset = offset;
      closestTask = task;
      saveData();
    }
  });

  return closestTask;
};

   // To prevent data from losing when the page is reloaded
   function saveData(){
    localStorage.setItem("data", listContainer.innerHTML);
}
// To display data when the website is reloaded
function showTask(){
    listContainer.innerHTML = localStorage.getItem("data");
}
showTask();
