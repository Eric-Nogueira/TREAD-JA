let darktheme = localStorage.getItem("darktheme");
const themeSwitch = document.getElementById("theme-switch");

const enableDark = () => {
  document.body.classList.add("darktheme");
  localStorage.setItem("darktheme", "active");
};

const disableDark = () => {
  document.body.classList.remove("darktheme");
  localStorage.setItem("darktheme", null);
};

if (darktheme === "active") enableDark();

themeSwitch.addEventListener("click", () => {
  darktheme = localStorage.getItem("darktheme");
  darktheme !== "active" ? enableDark() : disableDark();
});
