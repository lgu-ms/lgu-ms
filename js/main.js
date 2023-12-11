/*
 * FUNCTIONS
 */

var entityMap = {
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': "&quot;",
    "'": "&#39;",
    "/": "&#x2F;",
    "`": "&#x60;",
    "=": "&#x3D;",
};

function escapeHtml(string) {
    return String(string).replace(/[&<>"'`=\/]/g, function (s) {
        return entityMap[s];
    });
}

insertParam = (key, value) => {
    const url = new URL(window.location.href);
    url.searchParams.set(key, value);
    window.history.pushState({ path: url.href }, "", url.href);
};

openProfile = () => {
    let bsModal = new bootstrap.Modal(document.getElementById("popupProfileModal"));
    bsModal.show();
};

generateRandomId = (length) => {
    let result = "";
    const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    const charactersLength = characters.length;
    let counter = 0;
    while (counter < length) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
        counter += 1;
    }
    return result;
};

showToast = (err) => {
    let id = generateRandomId(10);
    let toast = document.createElement("div");
    toast.setAttribute("data-bs-autohide", true);
    toast.setAttribute("class", "toast");
    toast.setAttribute("id", id);
    let toastheader = document.createElement("div");
    toastheader.setAttribute("class", "toast-header");
    let strong = document.createElement("strong");
    strong.setAttribute("class", "me-auto");

    strong.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i> Houston!';
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

    $("#" + id).on("hide.bs.toast", function () {
        toast.remove();
    });
};

showAnnoucement = (annc, url) => {
    let id = generateRandomId(10);
    let toast = document.createElement("div");
    toast.setAttribute("data-bs-autohide", true);
    toast.setAttribute("class", "toast");
    toast.setAttribute("id", id);
    let toastheader = document.createElement("div");
    toastheader.setAttribute("class", "toast-header");
    let strong = document.createElement("strong");
    strong.setAttribute("class", "me-auto");

    strong.innerHTML = '<i class="fa-solid fa-bell"></i> Announcement!';
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

    $("#" + id).on("hide.bs.toast", function () {
        toast.remove();
    });
};

showPopup = (title, content, action, actionName) => {
    let id = generateRandomId(10);

    let mainModal = document.getElementById("mainModal");

    let modal = document.createElement("div");
    modal.setAttribute("class", "modal fade");
    modal.setAttribute("tabindex", "-1");
    modal.setAttribute("aria-hidden", "true");
    modal.setAttribute("id", id);

    let modalDialog = document.createElement("div");
    modalDialog.setAttribute("class", "modal-dialog modal-dialog-centered");
    let modalContent = document.createElement("div");
    modalContent.setAttribute("class", "modal-content");

    let modalHeader = document.createElement("div");
    modalHeader.setAttribute("class", "modal-header");

    let h1 = document.createElement("h1");
    h1.setAttribute("class", "modal-title fs-5");
    h1.innerText = title;

    let closeButton = document.createElement("button");
    closeButton.setAttribute("class", "btn-close");
    closeButton.setAttribute("type", "button");
    closeButton.setAttribute("data-bs-dismiss", "modal");
    closeButton.setAttribute("aria-label", "close");

    modalHeader.append(h1);
    modalHeader.append(closeButton);

    let modalBody = document.createElement("div");
    modalBody.setAttribute("class", "modal-body");
    modalBody.innerText = content;

    let modalFooter = document.createElement("div");
    modalFooter.setAttribute("class", "modal-footer");
    let actionButton = document.createElement("button");
    actionButton.setAttribute("type", "button");
    actionButton.setAttribute("class", "btn btn-primary px-4");
    actionButton.setAttribute("data-bs-dismiss", "modal");
    actionButton.innerText = actionName;
    actionButton.onclick = function () {
        window.location.href = action;
    };
    modalFooter.append(actionButton);

    modalContent.append(modalHeader);
    modalContent.append(modalBody);
    modalContent.append(modalFooter);

    modalDialog.append(modalContent);
    modal.append(modalDialog);
    mainModal.append(modal);

    let bsModal = new bootstrap.Modal(modal);
    bsModal.show();

    $("#" + id).on("hide.bs.modal", function () {
        modal.remove();
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

function autocomplete(inp, arr) {
    var currentFocus;
    inp.addEventListener("input", function (e) {
        var a,
            b,
            i,
            val = this.value;
        closeAllLists();
        if (!val) {
            return false;
        }
        currentFocus = -1;
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        this.parentNode.appendChild(a);
        for (i = 0; i < arr.length; i++) {
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                b = document.createElement("DIV");
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                b.addEventListener("click", function (e) {
                    inp.value = this.getElementsByTagName("input")[0].value;
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });

    inp.addEventListener("keydown", function (e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            currentFocus++;
            addActive(x);
        } else if (e.keyCode == 38) {
            currentFocus--;
            addActive(x);
        } else if (e.keyCode == 13) {
            e.preventDefault();
            if (currentFocus > -1) {
                if (x) x[currentFocus].click();
            }
        }
    });
    function addActive(x) {
        if (!x) return false;
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = x.length - 1;
        x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt) {
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }

    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}

/*
window.onerror = function a(msm, url, num) {
    alert(msm + "\n\n" + url);
    return false;
};
*/

/*
 * NAVIGATION CONTROL
 */

if (typeof modulesList !== "undefined") {
    let listGroupItem = document.querySelectorAll(".list-group-item");
    for (const item in listGroupItem) {
        listGroupItem[item].onclick = function () {
            let getModuleName = document.querySelectorAll(".module-742");
            for (module in getModuleName) {
                if (item == module) {
                    let title = getModuleName[module].innerText;
                    let url = title.split("\n")[1].replaceAll(" ", "-") + "-module";
                    window.location.href = escapeHtml(url.toLowerCase());
                }
            }
        };
    }
}

if (typeof signupNext !== "undefined") {
    signupNext.onclick = function () {
        let mainModal = document.getElementById("mainModal");

        let modalID = generateRandomId(10);
    
        let modal = document.createElement("div");
        modal.setAttribute("class", "modal fade");
        modal.setAttribute("tabindex", "-1");
        modal.setAttribute("id", modalID);
        modal.setAttribute("aria-hidden", "true");
    
        let modalDialog = document.createElement("div");
        modalDialog.setAttribute("class", "modal-dialog modal-dialog-centered");
        let modalContent = document.createElement("div");
        modalContent.setAttribute("class", "modal-content");
    
        let modalHeader = document.createElement("div");
        modalHeader.setAttribute("class", "modal-header");
    
        let h1 = document.createElement("h1");
        h1.setAttribute("class", "modal-title fs-5");
        h1.innerText = "Complete your signup";
    
        let closeButton = document.createElement("button");
        closeButton.setAttribute("class", "btn-close");
        closeButton.setAttribute("type", "button");
        closeButton.setAttribute("data-bs-dismiss", "modal");
        closeButton.setAttribute("aria-label", "close");
    
        modalHeader.append(h1);
        modalHeader.append(closeButton);
    
        let modalBody = document.createElement("div");
        modalBody.setAttribute("class", "modal-body");
    
        let p = document.createElement("p");
        p.innerText = "hello World";
    
        let form = document.createElement("form");
        form.setAttribute("action", "");
        form.setAttribute("method", "post");
    
        let inputG = document.createElement("div");
        inputG.setAttribute("class", "input-group2");
        let input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("placeholder", "First name");
        input.setAttribute("name", "Firstname");
        input.setAttribute("required", "required");
        let inputI = document.createElement("i");
        inputI.setAttribute("class", "fa-solid fa-circle-info");
        inputG.append(input);
        inputG.append(inputI);
        form.append(inputG);
    
        let inputG1 = document.createElement("div");
        inputG1.setAttribute("class", "input-group2");
        let input1 = document.createElement("input");
        input1.setAttribute("type", "text");
        input1.setAttribute("placeholder", "Middle name (Optional)");
        input1.setAttribute("name", "Middlename");
        input1.setAttribute("required", "required");
        let inputI1 = document.createElement("i");
        inputI1.setAttribute("class", "fa-solid fa-circle-info");
        inputG1.append(input1);
        inputG1.append(inputI1);
        form.append(inputG1);
    
        let inputG1a = document.createElement("div");
        inputG1a.setAttribute("class", "input-group2");
        let input1a = document.createElement("input");
        input1a.setAttribute("type", "text");
        input1a.setAttribute("placeholder", "Last name");
        input1a.setAttribute("name", "Lastname");
        input1a.setAttribute("required", "required");
        let inputI1a = document.createElement("i");
        inputI1a.setAttribute("class", "fa-solid fa-circle-info");
        inputG1a.append(input1a);
        inputG1a.append(inputI1a);
        form.append(inputG1a);
    
        let inputG1ab = document.createElement("div");
        inputG1ab.setAttribute("class", "input-group2");
        let input1ab = document.createElement("input");
        input1ab.setAttribute("type", "date");
        input1ab.setAttribute("placeholder", "Birthdate");
        input1ab.setAttribute("name", "birthdate");
        input1ab.setAttribute("required", "required");
        let inputI1ab = document.createElement("i");
        inputI1ab.setAttribute("class", "fa-solid fa-circle-info");
        inputG1ab.append(input1ab);
        inputG1ab.append(inputI1ab);
        form.append(inputG1ab);
    
        let inputG1abc = document.createElement("div");
        inputG1abc.setAttribute("class", "input-group2");
        let input1abc = document.createElement("input");
        input1abc.setAttribute("type", "text");
        input1abc.setAttribute("placeholder", "Birth place");
        input1abc.setAttribute("name", "Birthplace");
        input1abc.setAttribute("required", "required");
        let inputI1abc = document.createElement("i");
        inputI1abc.setAttribute("class", "fa-solid fa-circle-info");
        inputG1abc.append(input1abc);
        inputG1abc.append(inputI1abc);
        form.append(inputG1abc);
    
        let inputG1abcd = document.createElement("div");
        inputG1abcd.setAttribute("class", "input-group2");
        let input1abcd = document.createElement("input");
        input1abcd.setAttribute("type", "text");
        input1abcd.setAttribute("placeholder", "Sex");
        input1abcd.setAttribute("name", "Sex");
        input1abcd.setAttribute("required", "required");
        let inputI1abcd = document.createElement("i");
        inputI1abcd.setAttribute("class", "fa-solid fa-circle-info");
        inputG1abcd.append(input1abcd);
        inputG1abcd.append(inputI1abcd);
        form.append(inputG1abcd);
    
        let inputG1abcde = document.createElement("div");
        inputG1abcde.setAttribute("class", "input-group2");
        let input1abcde = document.createElement("input");
        input1abcde.setAttribute("type", "number");
        input1abcde.setAttribute("placeholder", "Mobile number");
        input1abcde.setAttribute("name", "Mobilenumber");
        input1abcde.setAttribute("required", "required");
        let inputI1abcde = document.createElement("i");
        inputI1abcde.setAttribute("class", "fa-solid fa-circle-info");
        inputG1abcde.append(input1abcde);
        inputG1abcde.append(inputI1abcde);
        form.append(inputG1abcde);

        let inputG1abcdef = document.createElement("div");
        inputG1abcdef.setAttribute("class", "input-group2");
        let input1abcdef = document.createElement("input");
        input1abcdef.setAttribute("type", "text");
        input1abcdef.setAttribute("placeholder", "Address");
        input1abcdef.setAttribute("name", "Address");
        input1abcdef.setAttribute("required", "required");
        let inputI1abcdef = document.createElement("i");
        inputI1abcdef.setAttribute("class", "fa-solid fa-circle-info");
        inputG1abcdef.append(input1abcdef);
        inputG1abcdef.append(inputI1abcdef);
        form.append(inputG1abcdef);
    
        let hiddenInputResponse = document.createElement("input");
        hiddenInputResponse.setAttribute("type", "hidden");
        hiddenInputResponse.setAttribute("id", "g-recaptcha-response");
        hiddenInputResponse.setAttribute("name", "g-recaptcha-response");
        let hiddenInputAction = document.createElement("input");
        hiddenInputAction.setAttribute("type", "hidden");
        hiddenInputAction.setAttribute("name", "action");
        hiddenInputAction.setAttribute("value", "validate_captcha");
    
        let dFlex = document.createElement("div");
        dFlex.setAttribute("class", "d-flex");
        let msAuto = document.createElement("div");
        msAuto.setAttribute("class", "ms-auto");
    
        let actionButton = document.createElement("button");
        actionButton.setAttribute("type", "submit");
        actionButton.setAttribute("name", "submit");
        actionButton.setAttribute("class", "btn btn-primary px-4");
        // actionButton.setAttribute("data-bs-dismiss", "modal");
        actionButton.innerText = "Signup";
    
        msAuto.append(actionButton);
        dFlex.append(msAuto);
        form.append(hiddenInputResponse);
        form.append(hiddenInputAction);
        form.append(dFlex);
    
        grecaptcha.ready(function () {
            grecaptcha.execute(captcha_site_key, { action: "validate_captcha" }).then(function (token) {
                document.getElementById("g-recaptcha-response").value = token;
            });
        });
    
        modalBody.append(p);
        modalBody.append(form);
        modalContent.append(modalHeader);
        modalContent.append(modalBody);
    
        modalDialog.append(modalContent);
        modal.append(modalDialog);
        mainModal.append(modal);
    
        let bsModal = new bootstrap.Modal(modal);
        bsModal.show();
    
        $("#" + modalID).on("hide.bs.modal", function () {
            modal.remove();
        });
    };
}

if (typeof changePhoto !== "undefined") {
    changePhoto.onclick = function () {
        $("#popupProfileModal").modal("hide");
        let mainModal = document.getElementById("mainModal");

        let id = generateRandomId(10);

        let modal = document.createElement("div");
        modal.setAttribute("class", "modal fade");
        modal.setAttribute("tabindex", "-1");
        modal.setAttribute("id", id);
        modal.setAttribute("aria-hidden", "true");

        let modalDialog = document.createElement("div");
        modalDialog.setAttribute("class", "modal-dialog modal-dialog-centered");
        let modalContent = document.createElement("div");
        modalContent.setAttribute("class", "modal-content");

        let modalHeader = document.createElement("div");
        modalHeader.setAttribute("class", "modal-header");

        let h1 = document.createElement("h1");
        h1.setAttribute("class", "modal-title fs-5");
        h1.innerText = "Upload Photo";

        let closeButton = document.createElement("button");
        closeButton.setAttribute("class", "btn-close");
        closeButton.setAttribute("type", "button");
        closeButton.setAttribute("data-bs-dismiss", "modal");
        closeButton.setAttribute("aria-label", "close");

        modalHeader.append(h1);
        modalHeader.append(closeButton);

        let modalBody = document.createElement("div");
        modalBody.setAttribute("class", "modal-body");

        let form = document.createElement("form");
        form.setAttribute("action", "");
        form.setAttribute("method", "post");
        form.setAttribute("enctype", "multipart/form-data");

        let input = document.createElement("input");
        input.setAttribute("name", "changePhoto");
        input.setAttribute("id", "changePhoto");
        input.setAttribute("require", "required");
        input.setAttribute("type", "file");
        input.setAttribute("class", "form-control mb-5");
        input.setAttribute("accept", "image/*");

        form.append(input);

        modalBody.append(form);
        modalContent.append(modalHeader);
        modalContent.append(modalBody);

        modalDialog.append(modalContent);
        modal.append(modalDialog);
        mainModal.append(modal);

        let bsModal = new bootstrap.Modal(modal);
        bsModal.show();
        $("#" + id).on("hide.bs.modal", function () {
            modal.remove();
        });

        input.onchange = function() {
            form.submit();
        };
    };
}

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
    showAnnoucement("QC Alam mo ba? Real Property Tax", "https://quezoncity.gov.ph/qc-alam-mo-ba-real-property-tax/");
});

if (typeof executeCaptcha !== "undefined") {
    if (typeof showPassword !== "undefined") {
        showPassword.onclick = function () {
            if (password.type === "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
            // sign up
            if (typeof cpassword !== "undefined") {
                if (cpassword.type === "password") {
                    cpassword.type = "text";
                } else {
                    cpassword.type = "password";
                }
            }
            // change password
            if (typeof ppassword !== "undefined") {
                if (ppassword.type === "password") {
                    ppassword.type = "text";
                } else {
                    ppassword.type = "password";
                }
            }
        };
    }

    grecaptcha.ready(function () {
        grecaptcha.execute(captcha_site_key, { action: "validate_captcha" }).then(function (token) {
            document.getElementById("g-recaptcha-response").value = token;
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
if (currentTheme == "dark") {
    document.body.classList.toggle("dark-mode");
    label.innerHTML = "Dark";
    input.click();
} else if (currentTheme == "light") {
    document.body.classList.toggle("light-mode");
    label.innerHTML = "Light";
} else if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
    document.body.classList.toggle("dark-mode");
    label.innerHTML = "Dark";
    input.click();
} else {
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
