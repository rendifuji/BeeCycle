const form = document.querySelector(".login-form");

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

function validateEmail() {
    const emailInput = document.getElementById("email");
    const email = emailInput.value.trim();

    if (email === "") {
        return showError(emailInput, "emailError", "Email is required");
    }

    const at = email.indexOf("@");
    const dot = email.lastIndexOf(".");

    if (at < 1 || dot <= at + 1 || dot === email.length - 1) {
        return showError(emailInput, "emailError", "Must be a valid email format");
    }

    const isAdmin = email === "admin@gmail.com";
    const isBinus =
        email.toLowerCase().endsWith("@binus.ac.id") ||
        email.toLowerCase().endsWith("@binus.edu");

    if (!isAdmin && !isBinus) {
        return showError(emailInput, "emailError", "Use a @binus.ac.id or @binus.edu email");
    }

    return clearError(emailInput, "emailError");
}

function validatePassword() {
    const passwordInput = document.getElementById("password");
    const password = passwordInput.value;

    if (password === "") {
        return showError(passwordInput, "passwordError", "Password is required");
    }

    return clearError(passwordInput, "passwordError");
}

form.addEventListener("submit", (e) => {
    e.preventDefault();

    const isValid = validateEmail() && validatePassword();

    if (isValid) {
        form.submit();
    }
});
