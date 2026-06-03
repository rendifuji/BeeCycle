const form = document.querySelector(".edit-profile-form");


form.addEventListener("submit", (e) => {
  e.preventDefault();

  const fullName = document.getElementById("full-name").value.trim();
  const campusLocation = document.getElementById("campus-location").value.trim();
  const whatsappNumber = document.getElementById("whatsapp-number").value.trim();

  if (fullName === "") {
    alert("Full name is required");
    return;
  }

  if (fullName.length < 5) {
    alert("Full name must be at least 5 characters long");
    return;
  }

  if (campusLocation === "") {
    alert("Campus location is required");
    return;
  }

  if (whatsappNumber === "") {
    alert("WhatsApp number is required");
    return;
  }

  if (whatsappNumber.includes(" ")) {
    alert("WhatsApp number must not contain spaces");
    return;
  }

  const numericWhatsapp = whatsappNumber.replace(/\D/g, "");

  if (numericWhatsapp.length < 10 || numericWhatsapp.length > 15) {
    alert("WhatsApp number must be between 10 and 15 digits");
    return;
  }

  alert("Profile updated successfully!");
  form.submit();
});

