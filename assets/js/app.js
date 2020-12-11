document.addEventListener("DOMContentLoaded", init);

function init() {
  initToTop();

}

function initToTop() {
  const toTopElem = document.createElement("span");
  toTopElem.classList.add("transition");
  toTopElem.id = "to-top";
  toTopElem.innerHTML = `<i class="fas fa-arrow-up"></i>`;
  document.getElementsByTagName("main")[0].appendChild(toTopElem);
}