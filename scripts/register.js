const switchToggle = document.getElementById("switch");
const switchToggleIcon = document.getElementById("switchToggleIcon");
const body = document.getElementById("body");
const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
const title = document.getElementById("title");
const text = document.getElementById("text");
const logo = document.getElementById("logo");

function applyDarkMode() {
  body.classList.toggle("dark");
  switchToggle.classList.toggle("dark");
  switchToggleIcon.classList.toggle("dark");
  emailInput.classList.toggle("dark");
  password.classList.toggle("dark");
  title.classList.toggle("dark");
  text.classList.toggle("dark");
  switchToggleIcon.innerHTML = "dark_mode";
  logo.src = "./assets/devchallenges-light.svg";
  sessionStorage.setItem("darkMode", "true");
}

function applyLightMode() {
  body.classList.remove("dark");
  switchToggle.classList.remove("dark");
  switchToggleIcon.classList.remove("dark");
  emailInput.classList.remove("dark");
  password.classList.remove("dark");
  title.classList.remove("dark");
  text.classList.remove("dark");
  switchToggleIcon.innerHTML = "light_mode";
  logo.src = "./assets/devchallenges.svg";
  sessionStorage.setItem("darkMode", "false");
}

const darkMode = sessionStorage.getItem("darkMode");
if (darkMode === "true") {
  applyDarkMode();
} else {
  applyLightMode();
}

let isDarkMode = darkMode === "true";

switchToggle.addEventListener("click", () => {
  if (isDarkMode) {
    applyLightMode();
  } else {
    applyDarkMode();
  }
  isDarkMode = !isDarkMode;
});
