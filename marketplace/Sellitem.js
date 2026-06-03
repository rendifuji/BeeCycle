const form = document.querySelector(".itemForm");

const ItemTitle = document.getElementById("itemTitle");
const Price = document.getElementById("price");
const Description = document.getElementById("description");
const COD = document.getElementById("COD");
const ItemPhoto = document.getElementById("itemPhoto");
const Category = document.getElementById("category");
const Condition = document.getElementById("itemCondition");
const CampusLocation = document.getElementById("CampusLocation");

function ValidateItemTitle() {
    if (ItemTitle.value.trim() === "") {
        return showError(ItemTitle, "ItemTitleError", "Must fill the item's title");
    }
    return clearError(ItemTitle, "ItemTitleError");
}

function ValidatePrice() {
    const value = Price.value.trim();

    if (value === "") {
        return showError(Price, "PriceError", "Must fill the item's price");
    }

    if (!/^\d+$/.test(value) || Number(value) <= 0) {
        return showError(Price, "PriceError", "Price must be a whole number greater than 0");
    }

    return clearError(Price, "PriceError");
}

function ValidateDescription() {
    if (Description.value.trim() === "") {
        return showError(Description, "DescriptionError", "Must fill the item's description");
    }
    return clearError(Description, "DescriptionError");
}

function ValidateCOD() {
    if (COD.value.trim() === "") {
        return showError(COD, "CODError", "Must fill the preferred meeting spot");
    }
    return clearError(COD, "CODError");
}

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

function ValidateCategory() {
    if (Category.value === "") {
        return showError(Category, "CategoryError", "Please select a category");
    }
    return clearError(Category, "CategoryError");
}

function ValidateCondition() {
    if (Condition.value === "") {
        return showError(Condition, "ConditionError", "Please select a condition");
    }
    return clearError(Condition, "ConditionError");
}

function ValidateCampusLocation() {
    if (CampusLocation.value === "") {
        return showError(CampusLocation, "LocationError", "Please select campus location");
    }
    return clearError(CampusLocation, "LocationError");
}

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

form.addEventListener("submit", (e) => {
    const isValid =
        ValidateItemTitle() &&
        ValidatePrice() &&
        ValidateDescription() &&
        ValidateCOD() &&
        ValidateItemPhoto() &&
        ValidateCategory() &&
        ValidateCondition() &&
        ValidateCampusLocation();

    if (!isValid) {
        e.preventDefault();
    }
});
