/*
* FUNCTIONS
*/

insertParam = (key, value) => {
    const url = new URL(window.location.href);
    url.searchParams.set(key, value);
    window.history.pushState({ path: url.href }, "", url.href);
};

setSession = (key, value) => {
    sessionStorage.setItem(key, value);
};

getSession = (key) => {
    return sessionStorage.getItem(key);
};

setCookies = (cname, cvalue, exdays) => {
    const d = new Date();
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
};

getCookies = (cname) => {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(";");
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
};


window.onerror = function a(msm, url, num) {
    alert(msm + "\n\n" + url);
    return false;
}

/*
* NAVIGATION CONTROL
*/

window.addEventListener("DOMContentLoaded", () => {
    el_autohide = document.querySelector(".autohide");
    navbar_height = document.querySelector(".navbar").offsetHeight;
    document.body.style.paddingTop = navbar_height + "px";
    if (el_autohide) {
        var last_scroll_top = 0;
        window.addEventListener("scroll", function () {
            let scroll_top = window.scrollY;
            if (scroll_top == 0) {
                el_autohide.classList.add("scrolled-up-tr");
            } else {
                el_autohide.classList.remove("scrolled-up-tr");
            }
            if (scroll_top < last_scroll_top) {
                el_autohide.classList.remove("scrolled-down");
                el_autohide.classList.add("scrolled-up");
            } else {
                el_autohide.classList.remove("scrolled-up");
                el_autohide.classList.add("scrolled-down");
            }
            last_scroll_top = scroll_top;
        });
    }
});


const queryString = window.location.search
const urlParams = new URLSearchParams(queryString);
const rdr = urlParams.get('rdr')

if (rdr != null) {
    window.location.href = rdr + "?utm_source=" + btoa(window.location);
}

/*
* THEME CONTROLS
*/

let themeswitch = document.getElementById("themeswitch");
let input = document.createElement("input");
input.setAttribute("class", "form-check-input");
input.setAttribute("type", "checkbox");
input.setAttribute("role", "switch");
input.setAttribute("id", "theme");
themeswitch.append(input);
let label = document.createElement("label");
label.setAttribute("class", "form-check-label");
label.setAttribute("for", "theme");
label.setAttribute("id", "themelabel");
themeswitch.append(label);

const currentTheme = localStorage.getItem("theme");
if (currentTheme == "dark" && window.matchMedia("(prefers-color-scheme: dark)").matches) {
  document.body.classList.toggle("dark-mode");
  label.innerHTML = "Dark Theme";
  input.setAttribute("checked", null);
} else if (currentTheme == "light") {
  document.body.classList.toggle("light-mode");
  label.innerHTML = "Light Theme";
} 

input.addEventListener("click", function() {
  if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
    document.body.classList.toggle("light-mode");
    var theme = document.body.classList.contains("light-mode") ? "light" : "dark";
  } else {
    document.body.classList.toggle("dark-mode");
    var theme = document.body.classList.contains("dark-mode") ? "dark" : "light";
  }
  if (theme == "dark") {
    label.innerHTML = "Dark Theme";
  } else {
    label.innerHTML = "Light Theme";
  }
  localStorage.setItem("theme", theme);
});