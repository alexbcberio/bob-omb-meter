document.addEventListener("DOMContentLoaded", init);

function init() {
  initToTop();
}

function initToTop() {
  const toTopElem = document.createElement("span");
  toTopElem.classList.add("transition");
  toTopElem.id = "to-top";
  toTopElem.innerHTML = `<i class="fas fa-arrow-up"></i>`;
  toTopElem.addEventListener("click", () => scrollToTop(300));

  document.getElementsByTagName("main")[0].appendChild(toTopElem);
  window.addEventListener("scroll", windowScroll);
}

function windowScroll() {
  const headerRect = document.getElementsByTagName("header")[0].getBoundingClientRect(),
    showToTop = headerRect.y + headerRect.height * 2 <= 0,
    toTopElem = document.getElementById("to-top");

  if (showToTop) {
    toTopElem.classList.remove("hide");
    toTopElem.classList.add("show");

  } else if (toTopElem.classList.contains("show")) {
    toTopElem.classList.remove("show");
    toTopElem.classList.add("hide");
  }
}

/*
 * Taken from: https://stackoverflow.com/a/24559613
 */
function scrollToTop (duration) {
  // cancel if already on top
  if (document.scrollingElement.scrollTop === 0)
    return;

  const totalScrollDistance = document.scrollingElement.scrollTop;
  let scrollY = totalScrollDistance,
    oldTimestamp = null;

  function step (newTimestamp) {
      if (oldTimestamp !== null) {
          // if duration is 0 scrollY will be -Infinity
          scrollY -= totalScrollDistance * (newTimestamp - oldTimestamp) / duration;

          if (scrollY <= 0) {
            return document.scrollingElement.scrollTop = 0;
          }

          document.scrollingElement.scrollTop = scrollY;
      }
      oldTimestamp = newTimestamp;
      window.requestAnimationFrame(step);
  }
  window.requestAnimationFrame(step);
}