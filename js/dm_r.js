download = (url, name) => {
    var evt = document.createEvent("MouseEvents");
    evt.initMouseEvent("click", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
    var link = document.createElement("a");
    link.download = name;
    link.href = "../../uploads/" + url;
    link.dispatchEvent(evt);
};

editData = (title, a, type) => {
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

    let form = document.createElement("form");
    form.setAttribute("action", "");
    form.setAttribute("method", "post");

    let inputG = document.createElement("div");
    inputG.setAttribute("class", "input-group2");
    let input = document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("placeholder", "Enter your document descripton");
    input.setAttribute("name", "description");
    input.setAttribute("required", "required");
    let inputI = document.createElement("i");
    inputI.setAttribute("class", "fa-solid fa-circle-info");

    inputG.append(input);
    inputG.append(inputI);
    let hiddenInputResponse = document.createElement("input");
    hiddenInputResponse.setAttribute("type", "hidden");
    hiddenInputResponse.setAttribute("id", "g-recaptcha-response");
    hiddenInputResponse.setAttribute("name", "g-recaptcha-response");
    let hiddenInputAction = document.createElement("input");
    hiddenInputAction.setAttribute("type", "hidden");
    hiddenInputAction.setAttribute("name", "action");
    hiddenInputAction.setAttribute("value", "validate_captcha");
    let hiddenIdentificationAction = document.createElement("input");
    hiddenIdentificationAction.setAttribute("type", "hidden");
    hiddenIdentificationAction.setAttribute("name", "id");
    hiddenIdentificationAction.setAttribute("value", a);
    let hiddenIdentificationAction1 = document.createElement("input");
    hiddenIdentificationAction1.setAttribute("type", "hidden");
    hiddenIdentificationAction1.setAttribute("name", "name");
    hiddenIdentificationAction1.setAttribute("value", title);

    let dFlex = document.createElement("div");
    dFlex.setAttribute("class", "d-flex");
    let msAuto = document.createElement("div");
    msAuto.setAttribute("class", "ms-auto");

    let actionButton = document.createElement("button");
    actionButton.setAttribute("type", "submit");
    actionButton.setAttribute("name", "edit");
    actionButton.setAttribute("class", "btn btn-primary px-4");
    // actionButton.setAttribute("data-bs-dismiss", "modal");
    actionButton.innerText = "Save";

    msAuto.append(actionButton);
    dFlex.append(msAuto);
    form.append(inputG);
    form.append(hiddenInputResponse);
    form.append(hiddenInputAction);
    form.append(hiddenIdentificationAction);
    form.append(hiddenIdentificationAction1);
    form.append(dFlex);

    grecaptcha.ready(function () {
        grecaptcha.execute(captcha_site_key, { action: "validate_captcha" }).then(function (token) {
            document.getElementById("g-recaptcha-response").value = token;
        });
    });

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
};

deleteData = (title, a, type) => {
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

    let form = document.createElement("form");
    form.setAttribute("action", "");
    form.setAttribute("method", "post");

    let p = document.createElement("p");
    p.innerText = "Do you really want to delete this file?";

    let hiddenInputResponse = document.createElement("input");
    hiddenInputResponse.setAttribute("type", "hidden");
    hiddenInputResponse.setAttribute("id", "g-recaptcha-response");
    hiddenInputResponse.setAttribute("name", "g-recaptcha-response");
    let hiddenInputAction = document.createElement("input");
    hiddenInputAction.setAttribute("type", "hidden");
    hiddenInputAction.setAttribute("name", "action");
    hiddenInputAction.setAttribute("value", "validate_captcha");
    let hiddenIdentificationAction = document.createElement("input");
    hiddenIdentificationAction.setAttribute("type", "hidden");
    hiddenIdentificationAction.setAttribute("name", "id");
    hiddenIdentificationAction.setAttribute("value", a);
    let hiddenIdentificationAction1 = document.createElement("input");
    hiddenIdentificationAction1.setAttribute("type", "hidden");
    hiddenIdentificationAction1.setAttribute("name", "name");
    hiddenIdentificationAction1.setAttribute("value", title);

    let dFlex = document.createElement("div");
    dFlex.setAttribute("class", "d-flex");
    let msAuto = document.createElement("div");
    msAuto.setAttribute("class", "ms-auto");

    let actionButton = document.createElement("button");
    actionButton.setAttribute("type", "submit");
    actionButton.setAttribute("name", "delete");
    actionButton.setAttribute("class", "btn btn-primary px-4");

    actionButton.innerText = "Yes";

    msAuto.append(actionButton);
    dFlex.append(msAuto);
    form.append(p);
    form.append(hiddenInputResponse);
    form.append(hiddenInputAction);
    form.append(hiddenIdentificationAction);
    form.append(hiddenIdentificationAction1);
    form.append(dFlex);

    grecaptcha.ready(function () {
        grecaptcha.execute(captcha_site_key, { action: "validate_captcha" }).then(function (token) {
            document.getElementById("g-recaptcha-response").value = token;
        });
    });

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
};

/*
 * REGISTER EVENTS
 */

let deleteItems = document.querySelectorAll(".delete");

for (const item in deleteItems) {
    if (typeof deleteItems[item] === "object") {
        let cardTitles = document.querySelectorAll(".card-title");
        const a = deleteItems[item].dataset.id;
        deleteItems[item].onclick = function () {
            deleteData(cardTitles[item].innerText, a);
        };
    }
}

let editItems = document.querySelectorAll(".edit");

for (const item in editItems) {
    if (typeof editItems[item] === "object") {
        let cardTitles = document.querySelectorAll(".card-title");
        const a = editItems[item].dataset.id;
        editItems[item].onclick = function () {
            editData(cardTitles[item].innerText, a);
        };
    }
}
