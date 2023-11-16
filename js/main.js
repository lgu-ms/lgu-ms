/*
 * FUNCTIONS
 */

let validator = {
    set: function(obj, prop, val) {
      if (prop === 'href') {
        if(typeof val != 'string'){
          throw new TypeError('href must be string.');
        }
        if (!val.startsWith("https://digitalbarangay.com/")) {
          throw new Error('XSS');
        }
      }
     obj[prop] = val;
     return true;
    },
    get: function(obj, prop){
     return prop in obj?
         obj[prop] :
         null;
    }
 };

insertParam = (key, value) => {
    const url = new URL(window.location.href);
    url.searchParams.set(key, value);
    window.history.pushState({ path: url.href }, "", url.href);
};

showToast = (err) => {
    let toast = document.createElement("div");
    toast.setAttribute("data-bs-autohide", true);
    toast.setAttribute("class", "toast");
    let toastheader = document.createElement("div");
    toastheader.setAttribute("class", "toast-header");
    let strong = document.createElement("strong");
    strong.setAttribute("class", "me-auto");
  
    strong.innerHTML = "<i class=\"fa-solid fa-circle-exclamation\"></i> Houston!";
    toastheader.append(strong);
    let actionbutton = document.createElement("button");
    actionbutton.setAttribute("type", "button");
    actionbutton.setAttribute("class", "btn-close");
    actionbutton.setAttribute("data-bs-dismiss", "toast");
    actionbutton.setAttribute("aria-label", "Close");
    toastheader.append(actionbutton);

    let toastbody = document.createElement("div");
    toastbody.setAttribute("class", "toast-body");
    let error = document.createElement("p");
    error.innerHTML = err;
    toastbody.append(error);
    toast.append(toastheader);
    toast.append(toastbody);

    let alert = new bootstrap.Toast(toast);
    alert.show();

    document.getElementById("toastcontainer").append(toast);
};

showAnnoucement = (annc, url) => {
        let toast = document.createElement("div");
        toast.setAttribute("data-bs-autohide", true);
        toast.setAttribute("class", "toast");
        let toastheader = document.createElement("div");
        toastheader.setAttribute("class", "toast-header");
        let strong = document.createElement("strong");
        strong.setAttribute("class", "me-auto");
      
        strong.innerHTML = "<i class=\"fa-solid fa-bell\"></i> Announcement!";
        toastheader.append(strong);
        let actionbutton = document.createElement("button");
        actionbutton.setAttribute("type", "button");
        actionbutton.setAttribute("class", "btn-close");
        actionbutton.setAttribute("data-bs-dismiss", "toast");
        actionbutton.setAttribute("aria-label", "Close");
        toastheader.append(actionbutton);
    
        let toastbody = document.createElement("div");
        toastbody.setAttribute("class", "toast-body");
        let announcement = document.createElement("p");
        announcement.innerHTML = annc;
        announcement.setAttribute("href", annc);
        let announcementurl = document.createElement("a");
        announcementurl.setAttribute("class", "text-muted mb-0");
        announcementurl.innerHTML = url;
        toastbody.append(announcement);
        toastbody.append(announcementurl);
        toast.append(toastheader);
        toast.append(toastbody);
    
        let alert = new bootstrap.Toast(toast);
        alert.show();
    
        document.getElementById("toastcontainer").append(toast);
};

showPopup = (title, content, action, actionName) => {
    let bsModal = new bootstrap.Modal(document.getElementById("popupModal"));
    bsModal.show();
    document.getElementById("popupModalLabel").innerText = title;
    document.getElementById("popupModalContent").innerText = content;
    document.getElementById("popupModalActionName").innerText = actionName;
    $("#popupModal").on("hidden.bs.modal", function () {
        window.location.href = action;
    });
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

/*
window.onerror = function a(msm, url, num) {
    alert(msm + "\n\n" + url);
    return false;
};
*/

/*
 * NAVIGATION CONTROL
 */

window.addEventListener("DOMContentLoaded", () => {
    scrollProgressBar();
    el_autohide = document.querySelector(".autohide");
    navbar_height = document.querySelector(".navbar");
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
    showAnnoucement("QC Alam mo ba? Real Property Tax", "https://quezoncity.gov.ph/qc-alam-mo-ba-real-property-tax/")
});

if (typeof executeCaptcha !== "undefined") {
    grecaptcha.ready(function() {
        grecaptcha.execute(captcha_site_key, {action: 'validate_captcha'}).then(function(token) {
            document.getElementById('g-recaptcha-response').value = token;
        });
    });
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
    label.innerHTML = "Dark";
    input.setAttribute("checked", null);
} else if (currentTheme == "light") {
    document.body.classList.toggle("light-mode");
    label.innerHTML = "Light";
}

input.addEventListener("click", function () {
    if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
        document.body.classList.toggle("light-mode");
        var theme = document.body.classList.contains("light-mode") ? "light" : "dark";
    } else {
        document.body.classList.toggle("dark-mode");
        var theme = document.body.classList.contains("dark-mode") ? "dark" : "light";
    }
    if (theme == "dark") {
        label.innerHTML = "Dark";
    } else {
        label.innerHTML = "Light";
    }
    localStorage.setItem("theme", theme);
});

function scrollProgressBar() {
    var getMax = function () {
      return $(document).height() - $(window).height();
    };
  
    var getValue = function () {
      return $(window).scrollTop();
    };
  
    var progressBar = $(".progress-bar"),
      max = getMax(),
      value,
      width;
  
    var getWidth = function () {
      value = getValue();
      width = (value / max) * 100;
      width = width + "%";
      return width;
    };
  
    var setWidth = function () {
      progressBar.css({ width: getWidth() });
    };
  
    $(document).on("scroll", setWidth);
    $(window).on("resize", function () {
      max = getMax();
      setWidth();
    });
}