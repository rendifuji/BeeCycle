const form = document.querySelector(".itemForm");
console.log("itemForm", form);

// Item Title --------------------------------------------------------------------------------------------------------
const ItemTitle = document.getElementById("itemTitle");

function ValidateItemTitle() {
    if (ItemTitle.value.trim() === "") {
        return showError(ItemTitle, "ItemTitleError", "Must fill the item's title");
    }
    return clearError(ItemTitle, "ItemTitleError");
}

// Price -----------------------------------------------------------------------------------------------------------------
const Price = document.getElementById("price");

function ValidatePrice() {
    const value = Price.value.trim();

    if (value === "") {
        return showError(Price, "PriceError", "Must fill the item's price");
    }

    if (!value.startsWith("Rp")) {
        return showError(Price, "PriceError", "Price must start with 'Rp'");
    }

    if (value.includes(",00")) {
        return showError(Price, "PriceError", "Do not use ',00' format");
    }

    return clearError(Price, "PriceError");
}

// Description ---------------------------------------------------------------------------------------------------------------------------
const Description = document.getElementById("description");

function ValidateDescription() {
    if (Description.value.trim() === "") {
        return showError(Description, "DescriptionError", "Must fill the item's description");
    }
    return clearError(Description, "DescriptionError");
}

//COD --------------------------------------------------------------------------------------------------------------------
const COD = document.getElementById("COD");

function ValidateCOD() {
    if (COD.value.trim() === "") {
        return showError(COD, "CODError", "Must fill the preferred meeting spot");
    }
    return clearError(COD, "CODError");
}

// Item Photo ---------------------------------------------------------------------------------------------
const ItemPhoto = document.getElementById("ItemPhoto");

function ValidateItemPhoto() {
    const file = ItemPhoto.files[0];

    if (!file) {
        return showError(ItemPhoto, "ItemPhotoError", "Please upload an image");
    }

    const allowedTypes = ["image/jpeg", "image/png"];

    if (!allowedTypes.includes(file.type)) {
        return showError(ItemPhoto, "ItemPhotoError", "Only JPG or PNG allowed");
    }

    return clearError(ItemPhoto, "ItemPhotoError");
}

// Category ------------------------------------------------------------------------------------------------------------
const Category = document.getElementById("itemCategory");

function ValidateCategory() {
    if (Category.value === "") {
        return showError(Category, "CategoryError", "Please select a category");
    }
    return clearError(Category, "CategoryError");
}

//  Condition ------------------------------------------------------------------------------------------------------------------------------
const Condition = document.getElementById("condition");

function ValidateCondition() {
    if (Condition.value === "") {
        return showError(Condition, "ConditionError", "Please select a condition");
    }
    return clearError(Condition, "ConditionError");
}

//  Helper ------------------------------------------------------------------------------------------------------------
function showError(input, errorId, message) {
    input.classList.add("invalid");
    document.getElementById(errorId).innerText = message;
    return false;
}

function clearError(input, errorId) {
    input.classList.remove("invalid");
    document.getElementById(errorId).innerText = "";
    return true;
}

//  Submit ------------------------------------------------------------------------------------------------------------------------------
form.addEventListener("submit", (e) => {
    e.preventDefault();

    const isValid =
        ValidateItemTitle() &&
        ValidatePrice() &&
        ValidateDescription() &&
        ValidateCOD() &&
        ValidateItemPhoto() &&
        ValidateCategory() &&
        ValidateCondition();

    if (isValid) {
        alert("Item successfully posted");
        form.reset();
    }
});