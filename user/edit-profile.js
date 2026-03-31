const editProfileForm = document.querySelector(".edit-profile-form");

if (editProfileForm) {
  const profileFields = {
    email: document.getElementById("binus-email"),
    studentId: document.getElementById("student-id"),
    fullName: document.getElementById("full-name"),
    campus: document.getElementById("campus-location"),
    whatsapp: document.getElementById("whatsapp-number"),
  };

  const profileStatus = document.createElement("p");
  profileStatus.className = "form-status";
  profileStatus.setAttribute("aria-live", "polite");
  editProfileForm.prepend(profileStatus);

  const setFieldState = (input, message) => {
    const field = input.closest(".form-field");
    if (!field) {
      return;
    }

    let error = field.querySelector(".field-error");
    if (!error) {
      error = document.createElement("p");
      error.className = "field-error";
      field.append(error);
    }

    if (message) {
      field.classList.add("has-error");
      input.setAttribute("aria-invalid", "true");
      error.textContent = message;
    } else {
      field.classList.remove("has-error");
      input.removeAttribute("aria-invalid");
      error.textContent = "";
    }
  };

  const validators = {
    email(value) {
      if (!value) return "Binus email is required.";
      if (!/^[^\s@]+@binus\.ac\.id$/i.test(value)) {
        return "Use a valid Binus email ending with @binus.ac.id.";
      }
      return "";
    },
    studentId(value) {
      if (!value) return "Student ID / NIM is required.";
      if (!/^\d{10}$/.test(value)) {
        return "Student ID must contain exactly 10 digits.";
      }
      return "";
    },
    fullName(value) {
      if (!value) return "Full name is required.";
      if (value.trim().length < 6) {
        return "Full name must be at least 6 characters.";
      }
      return "";
    },
    campus(value) {
      if (!value) return "Please select your campus location.";
      return "";
    },
    whatsapp(value) {
      if (!value) return "WhatsApp number is required.";
      const normalized = value.replace(/[^\d]/g, "");
      if (normalized.length < 10 || normalized.length > 15) {
        return "WhatsApp number must contain 10 to 15 digits.";
      }
      return "";
    },
  };

  const validateProfileField = (input) => {
    const value = input.value.trim();
    let message = "";

    if (input === profileFields.email) message = validators.email(value);
    if (input === profileFields.studentId) message = validators.studentId(value);
    if (input === profileFields.fullName) message = validators.fullName(value);
    if (input === profileFields.campus) message = validators.campus(input.value);
    if (input === profileFields.whatsapp) message = validators.whatsapp(value);

    setFieldState(input, message);
    return !message;
  };

  Object.values(profileFields).forEach((input) => {
    input.addEventListener("input", () => {
      validateProfileField(input);
      profileStatus.textContent = "";
      profileStatus.classList.remove("is-success");
    });

    input.addEventListener("blur", () => {
      validateProfileField(input);
    });
  });

  editProfileForm.addEventListener("submit", (event) => {
    const isValid = Object.values(profileFields).every((input) => validateProfileField(input));

    if (!isValid) {
      event.preventDefault();
      profileStatus.textContent = "Please fix the highlighted fields before submitting.";
      const firstError = editProfileForm.querySelector("[aria-invalid='true']");
      if (firstError) {
        firstError.focus();
      }
      return;
    }

    profileStatus.textContent = "Profile looks good. Redirecting to your dashboard...";
    profileStatus.classList.add("is-success");
  });
}
