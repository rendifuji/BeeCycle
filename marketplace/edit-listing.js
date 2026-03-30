const editListingForm = document.querySelector(".edit-listing-form");

if (editListingForm) {
  const listingFields = {
    title: document.getElementById("item-title"),
    category: document.getElementById("category"),
    condition: document.getElementById("condition"),
    price: document.getElementById("price"),
    description: document.getElementById("description"),
    campus: document.getElementById("campus-location"),
    meetingSpot: document.getElementById("meeting-spot"),
    photo: document.getElementById("item-photo"),
  };

  const listingStatus = document.createElement("p");
  listingStatus.className = "form-status";
  listingStatus.setAttribute("aria-live", "polite");
  editListingForm.prepend(listingStatus);

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

  const validateListingField = (input) => {
    const trimmed = input.value.trim();
    let message = "";

    if (input === listingFields.title) {
      if (!trimmed) message = "Item title is required.";
      else if (trimmed.length < 5) message = "Item title must be at least 5 characters.";
    }

    if (input === listingFields.category && !input.value) {
      message = "Please choose a category.";
    }

    if (input === listingFields.condition && !input.value) {
      message = "Please choose the item condition.";
    }

    if (input === listingFields.price) {
      if (!trimmed) {
        message = "Price is required.";
      } else {
        const numeric = Number(trimmed.replace(/[^\d]/g, ""));
        if (!numeric) {
          message = "Enter a valid price greater than 0.";
        }
      }
    }

    if (input === listingFields.description) {
      if (!trimmed) message = "Description is required.";
      else if (trimmed.length < 20) message = "Description must be at least 20 characters.";
    }

    if (input === listingFields.campus && !input.value) {
      message = "Please choose a campus location.";
    }

    if (input === listingFields.meetingSpot) {
      if (!trimmed) message = "Preferred meeting spot is required.";
      else if (trimmed.length < 3) message = "Meeting spot must be at least 3 characters.";
    }

    if (input === listingFields.photo) {
      const file = input.files?.[0];
      if (file) {
        const isImage = ["image/jpeg", "image/png"].includes(file.type);
        const isSmallEnough = file.size <= 3 * 1024 * 1024;
        if (!isImage) message = "Only JPG or PNG files are allowed.";
        else if (!isSmallEnough) message = "Photo must be smaller than 3 MB.";
      }
    }

    setFieldState(input, message);
    return !message;
  };

  Object.values(listingFields).forEach((input) => {
    const eventName = input === listingFields.photo ? "change" : "input";
    input.addEventListener(eventName, () => {
      validateListingField(input);
      listingStatus.textContent = "";
      listingStatus.classList.remove("is-success");
    });

    input.addEventListener("blur", () => {
      validateListingField(input);
    });
  });

  editListingForm.addEventListener("submit", (event) => {
    const isValid = Object.values(listingFields).every((input) => validateListingField(input));

    if (!isValid) {
      event.preventDefault();
      listingStatus.textContent = "Please complete the required fields before saving.";
      const firstError = editListingForm.querySelector("[aria-invalid='true']");
      if (firstError) {
        firstError.focus();
      }
      return;
    }

    listingStatus.textContent = "Listing looks ready. Saving your changes...";
    listingStatus.classList.add("is-success");
  });
}
