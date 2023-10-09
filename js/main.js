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

/*
* THEME CONTROLS
*/
var light = '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M361.5 1.2c5 2.1 8.6 6.6 9.6 11.9L391 121l107.9 19.8c5.3 1 9.8 4.6 11.9 9.6s1.5 10.7-1.6 15.2L446.9 256l62.3 90.3c3.1 4.5 3.7 10.2 1.6 15.2s-6.6 8.6-11.9 9.6L391 391 371.1 498.9c-1 5.3-4.6 9.8-9.6 11.9s-10.7 1.5-15.2-1.6L256 446.9l-90.3 62.3c-4.5 3.1-10.2 3.7-15.2 1.6s-8.6-6.6-9.6-11.9L121 391 13.1 371.1c-5.3-1-9.8-4.6-11.9-9.6s-1.5-10.7 1.6-15.2L65.1 256 2.8 165.7c-3.1-4.5-3.7-10.2-1.6-15.2s6.6-8.6 11.9-9.6L121 121 140.9 13.1c1-5.3 4.6-9.8 9.6-11.9s10.7-1.5 15.2 1.6L256 65.1 346.3 2.8c4.5-3.1 10.2-3.7 15.2-1.6zM160 256a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zm224 0a128 128 0 1 0 -256 0 128 128 0 1 0 256 0z"/></svg>';
var dark = '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M223.5 32C100 32 0 132.3 0 256S100 480 223.5 480c60.6 0 115.5-24.2 155.8-63.4c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6c-96.9 0-175.5-78.8-175.5-176c0-65.8 36-123.1 89.3-153.3c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z"/></svg>';


let secondNavBar = document.getElementById("rightSide");
let navItem = document.createElement("li");
navItem.setAttribute("class", "nav-item");
let navLink = document.createElement("a");
navLink.setAttribute("class", "nav-link");
navLink.setAttribute("href", "#theme");

let spanText = document.createElement("span");
spanText.setAttribute("class", "text");
spanText.setAttribute("id", "theme");
spanText.innerHTML = light;
navLink.append(spanText);

navItem.append(navLink);
secondNavBar.append(navItem);

const queryString = window.location.search
const urlParams = new URLSearchParams(queryString);
const rdr = urlParams.get('rdr')

if (rdr != null) {
    window.location.href = rdr + "?utm_source=" + btoa(window.location);
}

const currentTheme = localStorage.getItem("theme");
if (currentTheme == "dark" && !window.matchMedia("(prefers-color-scheme: dark)").matches) {
  document.body.classList.toggle("dark-mode");
  spanText.innerHTML = light;
} else if (currentTheme == "light") {
  document.body.classList.toggle("light-mode");
  spanText.innerHTML = dark;
}

spanText.addEventListener("click", function() {
  if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
    document.body.classList.toggle("light-mode");
    var theme = document.body.classList.contains("light-mode") ? "light" : "dark";
  } else {
    document.body.classList.toggle("dark-mode");
    var theme = document.body.classList.contains("dark-mode") ? "dark" : "light";
  }
  if (theme == "dark") {
    spanText.innerHTML = light;
    spanText.title = "Switch to light mode";
  } else {
    spanText.innerHTML = dark;
    spanText.title = "Switch to dark mode";
  }
  localStorage.setItem("theme", theme);
});

