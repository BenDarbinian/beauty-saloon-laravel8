const trigger = document.querySelector(".NavButton");
const nav = document.querySelector(".fullScreenNav");
const backdrop = document.querySelector(".backdrop");
const navmenu = document.querySelector(".navMenu");

trigger.addEventListener("click", () => nav.classList.add("open-nav"));
backdrop.addEventListener("click", () => nav.classList.remove("open-nav"));
navmenu.addEventListener("click", () => nav.classList.remove("open-nav"));


