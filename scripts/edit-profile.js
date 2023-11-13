//Modal

const modalMenu = document.getElementById("modal-menu");
const profileUser = document.getElementById("profile-user");
const more = document.getElementById("avatar-icon-more");

let switchStateModal = true;
profileUser.addEventListener("click", () => {
  modalMenu.classList.toggle("show");

  if (switchStateModal) {
    more.innerHTML = "expand_less";
    switchStateModal = !switchStateModal;
  } else {
    more.innerHTML = "expand_more";
    switchStateModal = !switchStateModal;
  }
});

document
  .getElementById("upload-photo")
  .addEventListener("change", function (event) {
    var reader = new FileReader();

    reader.onload = function () {
      document.getElementById("photo").src = reader.result;
    };

    var file = event.target.files[0];
    reader.readAsDataURL(file);
  });

//Dark Mode

const darkModeSwitch = document.getElementById("dark-mode");
const body = document.getElementById("body");
const logoDark = document.getElementById("logo-dark");
const logoHeader = document.getElementById("logo-header");
const title = document.getElementById("profile");
const textDark = document.getElementById("text-dark");
const frmLabel = document.getElementsByClassName("frm-label");
const frmLabelArray = Array.from(frmLabel);
const contentProfile = document.getElementsByClassName("frm-input");
const contentProfileArray = Array.from(contentProfile);
const modalGray = document.getElementsByClassName("modal-gray");
const modalGrayArray = Array.from(modalGray);
const modalOption = document.getElementsByClassName("modal-option");
const modalOptionArray = Array.from(modalOption);

function applyDarkMode() {
  body.classList.toggle("dark");
  title.classList.toggle("dark");
  profileUser.classList.toggle("dark");
  modalMenu.classList.toggle("dark");
  frmLabelArray.forEach((e) => {
    e.classList.toggle("dark");
  });
  modalGrayArray.forEach((e) => {
    e.classList.toggle("dark");
  });
  contentProfileArray.forEach((e) => {
    e.classList.toggle("dark");
  });
  logoDark.innerHTML = "light_mode";
  logoHeader.src = "../assets/devchallenges-light.svg";
  textDark.innerHTML = "Ligth Mode";
}

function applyLightMode() {
  body.classList.remove("dark");
  title.classList.remove("dark");
  profileUser.classList.remove("dark");
  modalMenu.classList.remove("dark");
  frmLabelArray.forEach((e) => {
    e.classList.remove("dark");
  });
  modalGrayArray.forEach((e) => {
    e.classList.remove("dark");
  });
  contentProfileArray.forEach((e) => {
    e.classList.remove("dark");
  });
  logoDark.innerHTML = "dark_mode";
  textDark.innerHTML = "Dark Mode";
  logoHeader.src = "../assets/devchallenges.svg";
}

const darkMode = sessionStorage.getItem("darkMode");
if (darkMode === "true") {
  applyDarkMode();
} else {
  applyLightMode();
}

let isDarkMode = darkMode === "true";

darkModeSwitch.addEventListener("click", () => {
  if (isDarkMode) {
    applyLightMode();
  } else {
    applyDarkMode();
  }
  isDarkMode = !isDarkMode;
});
