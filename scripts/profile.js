// User Modal

const modalMenu = document.getElementById("modal-menu");
const profiileUser = document.getElementById("profile-user");
const more = document.getElementById("avatar-icon-more");

let switchStateModal = true;
profiileUser.addEventListener("click", () => {
	modalMenu.classList.toggle("show");

	if (switchStateModal) {
		more.innerHTML = "expand_less";
		switchStateModal = !switchStateModal;
	} else {
		more.innerHTML = "expand_more";
		switchStateModal = !switchStateModal;
	}
});

//Dark Mode

const darkModeSwitch = document.getElementById("dark-mode");
const body = document.getElementById("body");
const logoDark = document.getElementById("logo-dark");
const textDark = document.getElementById("text-dark");
const logoHeader = document.getElementById("logo-header");
const title = document.getElementById("title-info");
const subTitle = document.getElementById("profile");
const contentProfile = document.getElementsByClassName("content-profile");
const contentProfileArray = Array.from(contentProfile);
const modalGray = document.getElementsByClassName("modal-gray");
const modalGrayArray = Array.from(modalGray);
const modalOption = document.getElementsByClassName("modal-option");
const modalOptionArray = Array.from(modalOption);

function applyDarkMode() {
	body.classList.toggle("dark");
	title.classList.toggle("dark");
	subTitle.classList.toggle("dark");
	profiileUser.classList.toggle("dark");
	modalMenu.classList.toggle("dark");
	modalGrayArray.forEach((e) => {
		e.classList.toggle("dark");
	});
	contentProfileArray.forEach((e) => {
		e.classList.toggle("dark");
	});
	logoDark.innerHTML = "light_mode";
	logoHeader.src = "../assets/devchallenges-light.svg";
	textDark.innerHTML = "Ligth Mode";
	sessionStorage.setItem("darkMode", "true");
}

function applyLightMode() {
	body.classList.remove("dark");
	title.classList.remove("dark");
	subTitle.classList.remove("dark");
	profiileUser.classList.remove("dark");
	modalMenu.classList.remove("dark");
	modalGrayArray.forEach((e) => {
		e.classList.remove("dark");
	});
	contentProfileArray.forEach((e) => {
		e.classList.remove("dark");
	});
	logoDark.innerHTML = "dark_mode";
	textDark.innerHTML = "Dark Mode";
	logoHeader.src = "../assets/devchallenges.svg";
	sessionStorage.setItem("darkMode", "false");
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
