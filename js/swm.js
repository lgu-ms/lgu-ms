/*
* Solid Waste Management
*/

showMultiPurposeInput = (title, label, actionName, action, item_id, collectionArea, noTrucksID, solidWasteWeightID, collectionDateID,
    transportToID, wasteProcessingType, wasteType)  => {
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

    let p = document.createElement("p");
    p.innerText = label;

    let form = document.createElement("form");
    form.setAttribute("action", "");
    form.setAttribute("method", "post");

    let inputG = document.createElement("div");
    inputG.setAttribute("class", "input-group2");
    let input = document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("placeholder", "Collection area");
    input.setAttribute("name", "collection_area");
    input.setAttribute("required", "required");
    input.setAttribute("id", collectionArea);
    let inputI = document.createElement("i");
    inputI.setAttribute("class", "fa-solid fa-circle-info");
    inputG.append(input);
    inputG.append(inputI);
    form.append(inputG);

    let inputG1 = document.createElement("div");
    inputG1.setAttribute("class", "input-group2");
    let input1 = document.createElement("input");
    input1.setAttribute("type", "number");
    input1.setAttribute("placeholder", "No. trucks");
    input1.setAttribute("name", "no_trucks");
    input1.setAttribute("required", "required");
    input1.setAttribute("id", noTrucksID);
    let inputI1 = document.createElement("i");
    inputI1.setAttribute("class", "fa-solid fa-circle-info");
    inputG1.append(input1);
    inputG1.append(inputI1);
    form.append(inputG1);

    let inputG1a = document.createElement("div");
    inputG1a.setAttribute("class", "input-group2");
    let input1a = document.createElement("input");
    input1a.setAttribute("type", "number");
    input1a.setAttribute("placeholder", "Solid waste weight in tons");
    input1a.setAttribute("name", "solid_waste_weight");
    input1a.setAttribute("required", "required");
    input1a.setAttribute("id", solidWasteWeightID);
    let inputI1a = document.createElement("i");
    inputI1a.setAttribute("class", "fa-solid fa-circle-info");
    inputG1a.append(input1a);
    inputG1a.append(inputI1a);
    form.append(inputG1a);

    let inputG1ab = document.createElement("div");
    inputG1ab.setAttribute("class", "input-group2");
    let input1ab = document.createElement("input");
    input1ab.setAttribute("type", "date");
    input1ab.setAttribute("placeholder", "Collection date m/d/yyyy");
    input1ab.setAttribute("name", "collection_date");
    input1ab.setAttribute("required", "required");
    input1ab.setAttribute("id", collectionDateID);
    let inputI1ab = document.createElement("i");
    inputI1ab.setAttribute("class", "fa-solid fa-circle-info");
    inputG1ab.append(input1ab);
    inputG1ab.append(inputI1ab);
    form.append(inputG1ab);

    let inputG1abc = document.createElement("div");
    inputG1abc.setAttribute("class", "input-group2");
    let input1abc = document.createElement("input");
    input1abc.setAttribute("type", "text");
    input1abc.setAttribute("placeholder", "Transport to");
    input1abc.setAttribute("name", "transport_to");
    input1abc.setAttribute("required", "required");
    input1abc.setAttribute("id", transportToID);
    let inputI1abc = document.createElement("i");
    inputI1abc.setAttribute("class", "fa-solid fa-circle-info");
    inputG1abc.append(input1abc);
    inputG1abc.append(inputI1abc);
    form.append(inputG1abc);

    let inputG1abcd = document.createElement("div");
    inputG1abcd.setAttribute("class", "input-group2");
    let input1abcd = document.createElement("input");
    input1abcd.setAttribute("type", "text");
    input1abcd.setAttribute("placeholder", "Solid waste processing type");
    input1abcd.setAttribute("name", "waste_processing_type");
    input1abcd.setAttribute("required", "required");
    input1abcd.setAttribute("id", wasteProcessingType);
    let inputI1abcd = document.createElement("i");
    inputI1abcd.setAttribute("class", "fa-solid fa-circle-info");
    inputG1abcd.append(input1abcd);
    inputG1abcd.append(inputI1abcd);
    form.append(inputG1abcd);

    let inputG1abcde = document.createElement("div");
    inputG1abcde.setAttribute("class", "input-group2");
    let input1abcde = document.createElement("input");
    input1abcde.setAttribute("type", "text");
    input1abcde.setAttribute("placeholder", "Solid waste type");
    input1abcde.setAttribute("name", "waste_type");
    input1abcde.setAttribute("required", "required");
    input1abcde.setAttribute("id", wasteType);
    let inputI1abcde = document.createElement("i");
    inputI1abcde.setAttribute("class", "fa-solid fa-circle-info");
    inputG1abcde.append(input1abcde);
    inputG1abcde.append(inputI1abcde);
    form.append(inputG1abcde);

    let hiddenInputResponse = document.createElement("input");
    hiddenInputResponse.setAttribute("type", "hidden");
    hiddenInputResponse.setAttribute("id", "g-recaptcha-response");
    hiddenInputResponse.setAttribute("name", "g-recaptcha-response");
    let hiddenInputAction = document.createElement("input");
    hiddenInputAction.setAttribute("type", "hidden");
    hiddenInputAction.setAttribute("name", "action");
    hiddenInputAction.setAttribute("value", "validate_captcha");
    let hiddenIdentificationAction = null;
    if (item_id != null) {
     hiddenIdentificationAction = document.createElement("input");
    hiddenIdentificationAction.setAttribute("type", "hidden");
    hiddenIdentificationAction.setAttribute("name", "id");
    hiddenIdentificationAction.setAttribute("value", item_id);
    }

    let dFlex = document.createElement("div");
    dFlex.setAttribute("class", "d-flex");
    let msAuto = document.createElement("div");
    msAuto.setAttribute("class", "ms-auto");

    let actionButton = document.createElement("button");
    actionButton.setAttribute("type", "submit");
    actionButton.setAttribute("name", actionName);
    actionButton.setAttribute("class", "btn btn-primary px-4");
    // actionButton.setAttribute("data-bs-dismiss", "modal");
    actionButton.innerText = action;

    msAuto.append(actionButton);
    dFlex.append(msAuto);
    form.append(hiddenInputResponse);
    form.append(hiddenInputAction);
    if (hiddenIdentificationAction != null) {
    form.append(hiddenIdentificationAction);
    }
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

    var zoningMaps = ["Alicia", "Bagong Pagasa", "Bahay Toro", "Balingasa", "Bungad", "Damar", "Damayan", "Del Monte", "Katipunan", "Lourdes", "Maharlika", "Manresa", "Mariblo", "Masambong", "N.S. Amoranto", "Nayon Kanluran", "Paang Bundok", "Pag-ibig sa Nayon", "Paltok", "Paraiso", "Phil-am", "Project 6", "R. Magsaysay", "Salvacion", "San Antonio", "San Isidro Labrador", "San Jose", "Sienna", "St. Peter", "Sta. Cruz", "Sta. Teresita", "Sto. Cristo", "Sto. Domingo", "Talayan", "Vasra", "Veterans Village", "West Triangle", "Bagong Silangan", "Batasan Hills", "Commonwealth", "Holy Spirit", "Payatas", "Amihan", "Bagumbayan", "Bagumbuhay", "Bayanihan", "Blue Ridge A", "Blue Ridge B", "Camp Aguinaldo", "Claro", "Dioquino Zobel", "Duyan-duyan", "E. Rodriquez", "East Kamias", "Escopa 1", "Escopa 2", "Escopa 3", "Escopa 4", "Libis", "Loyola Heights", "Manga", "Marilag", "Masagana", "Matandang Balara", "Milgrosa", "Pansol", "Quirino 2-A", "Quirino 2-B", "Quirino 2-C", "Quirino 3-A", "San Roque", "Silangan", "Socorro", "St. Ignatius", "Tagumpay", "Ugong Norte", "Villa Maria Clara", "West Kamias", "White Plains", "B.L. ng Crame", "Botocan", "Central", "Damayang Lagi", "Don Manuel", "Doña Aurora", "Doña Imelda", "Doña Josefa", "Horseshoe", "Immaculate Concepcion", "Kalusugan", "Kamuning", "Kaunlaran", "Kristong Hari", "Krus na Ligas", "Laging Handa", "Malaya", "Mariana", "Obrero", "Old Capitol Site", "Paligsahan", "Pinagkaisahan", "Pinyahan", "Roxas", "Sacred Heart", "San Isidro Galas", "San Martin de Porres", "San Vicente", "Santo Niño", "Santol", "Sikatuna Village", "South Triangle", "Tatalon", "Teachers Village East", "Teachers Village West", "UP Campus", "UP Village", "Valencia", "Bagbag", "Capri", "Fairview", "Greater Lagro", "Gulod", "Kaligayahan", "Nagkaisang Nayon", "North Fairview", "Novaliches", "Pasong Putik", "San Agustin", "San Bartolome", "Sta. Lucia", "Sta. Monica", "Aplonio Samson", "Baesa", "Balumbato", "Culiat", "New Era", "Pasong Tamo", "Sangandaan", "Sauyo", "Talipapa", "Tandang Sora", "Unang Sigaw"];
    var processingType = ["Anaerobic Digester", "Compost", "Vermicompost", "Incineration", "Landfill", "Recycling"];
    var wasteType = ["Municipal waste", "Hazardous waste", "Construction waste", "Biodegerable waste", "Industrial waste", "Household hazardous waste", "Electronic waste", "Chemical waste", "Agricultural waste", "Green waste", "Biomedical waste", "Radioactive waste"];
    autocomplete(input, zoningMaps);
    autocomplete(input1abc, zoningMaps);
    autocomplete(input1abcd, processingType);
    autocomplete(input1abcde, wasteType);
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
    p.innerText = "Do you really want to delete this date?";

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

addData.onclick = function () {
    let collectionArea = generateRandomId(10);
    let noTrucksID = generateRandomId(10);
    let solidWasteWeightID = generateRandomId(10);
    let collectionDateID = generateRandomId(10);
    let transportToID = generateRandomId(10);
    let wasteProcessingType = generateRandomId(10);
    let wasteType = generateRandomId(10);
    showMultiPurposeInput("Add Data", "Fill up the following form:", "add", "Add", null,
    collectionArea, noTrucksID, solidWasteWeightID, collectionDateID, transportToID, wasteProcessingType, wasteType);
};

let deleteItems = document.querySelectorAll(".delete");

for (const item in deleteItems) {
    if (typeof deleteItems[item] === "object") {
        let cardTitles = document.querySelectorAll(".swm-title");
        const a = deleteItems[item].dataset.id;
        deleteItems[item].onclick = function () {
            deleteData(cardTitles[item].innerText, a);
        };
    }
}

let editItems = document.querySelectorAll(".edit");

for (const item in editItems) {
    if (typeof editItems[item] === "object") {
        let cardTitles = document.querySelectorAll(".swm-title");
        const a = editItems[item].dataset.id;
        const data = JSON.parse(atob(editItems[item].dataset.res));
        console.log(data);
        editItems[item].onclick = function () {
            let collectionArea = generateRandomId(10);
            let noTrucksID = generateRandomId(10);
            let solidWasteWeightID = generateRandomId(10);
            let collectionDateID = generateRandomId(10);
            let transportToID = generateRandomId(10);
            let wasteProcessingType = generateRandomId(10);
            let wasteType = generateRandomId(10);
            showMultiPurposeInput(cardTitles[item].innerText, "Update the following form:", "edit", "Update", a,
            collectionArea, noTrucksID, solidWasteWeightID, collectionDateID, transportToID, wasteProcessingType, wasteType);
            document.getElementById(collectionArea).value = data.collection_area;
            document.getElementById(noTrucksID).value = data.no_trucks;
            document.getElementById(solidWasteWeightID).value = data.solid_waste_weight;
            document.getElementById(collectionDateID).value = data.collection_date;
            document.getElementById(transportToID).value = data.transport_to;
            document.getElementById(wasteProcessingType).value = data.waste_processing_type;
            document.getElementById(wasteType).value = data.waste_type;
        };
    }
}
