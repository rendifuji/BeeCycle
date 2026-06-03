const form = document.querySelector(".register-form");

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

function validateFullName() {
    const input = document.getElementById("fullName");
    const value = input.value.trim();

    if (value === "") {
        return showError(input, "fullNameError", "Full name is required");
    }

    return clearError(input, "fullNameError");
}

function validateEmail() {
    const input = document.getElementById("email");
    const email = input.value.trim();

    if (email === "") {
        return showError(input, "emailError", "Email is required");
    }

    const at = email.indexOf("@");
    const dot = email.lastIndexOf(".");

    if (at < 1 || dot <= at + 1 || dot === email.length - 1) {
        return showError(input, "emailError", "Must be a valid email format");
    }

    if (
        !email.toLowerCase().endsWith("@binus.ac.id") &&
        !email.toLowerCase().endsWith("@binus.edu")
    ) {
        return showError(input, "emailError", "Use a @binus.ac.id or @binus.edu email");
    }

    return clearError(input, "emailError");
}

function validateStudentID() {
    const input = document.getElementById("studentID");
    const value = input.value.trim();

    if (value === "") {
        return showError(input, "studentIDError", "Student ID is required");
    }

    if (!/^\d{10}$/.test(value)) {
        return showError(input, "studentIDError", "Student ID must be exactly 10 digits");
    }

    return clearError(input, "studentIDError");
}

function validateCampus() {
    const input = document.getElementById("campus");
    const value = input.value;

    if (value === "") {
        return showError(input, "campusError", "Please select your campus");
    }

    return clearError(input, "campusError");
}

function validateWhatsapp() {
    const input = document.getElementById("whatsapp");
    const value = input.value.trim();

    if (value === "") {
        return showError(input, "whatsappError", "WhatsApp number is required");
    }

    if (value.includes(" ")) {
        return showError(input, "whatsappError", "WhatsApp number must not contain spaces");
    }

    const digits = value.replace(/\D/g, "");

    if (digits.length < 10 || digits.length > 15) {
        return showError(input, "whatsappError", "WhatsApp number must be 10–15 digits");
    }

    return clearError(input, "whatsappError");
}

function validatePassword() {
    const input = document.getElementById("password");
    const value = input.value;

    if (value === "") {
        return showError(input, "passwordError", "Password is required");
    }

    if (value.length <= 6) {
        return showError(input, "passwordError", "Password must be more than 6 characters");
    }

    return clearError(input, "passwordError");
}

form.addEventListener("submit", (e) => {
    e.preventDefault();

    const isValid =
        validateFullName() &&
        validateEmail() &&
        validateStudentID() &&
        validateCampus() &&
        validateWhatsapp() &&
        validatePassword();

    if (isValid) {
        form.submit();
    }
});
