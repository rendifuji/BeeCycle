const form = document.querySelector(".edit-profile-form");


form.addEventListener("submit", (e) => {
  e.preventDefault();

  const email = document.getElementById("binus-email").value.trim();
  const studentId = document.getElementById("student-id").value.trim();
  const fullName = document.getElementById("full-name").value.trim();
  const campusLocation = document.getElementById("campus-location").value.trim();
  const whatsappNumber = document.getElementById("whatsapp-number").value.trim();

  if (email === "") {
    alert("Binus email is required");
    return;
  }

  const indexofat = email.indexOf("@");
  const indexofdot = email.indexOf(".");
  const indexoflastdot = email.lastIndexOf(".");

  if (indexofat === -1 || indexofdot === -1) {
    alert("Must be a valid email format");
    return;
  }

  if (indexofat === 0 || indexofdot === 0) {
    alert("Email must not start with @ or .");
    return;
  }

  if (!(indexofat < indexoflastdot - 1)) {
    alert("Email must have at least one character between @ and .");
    return;
  }

  if (indexoflastdot === email.length - 1) {
    alert("Email must not end with .");
    return;
  }

  if (email.includes(" ")) {
    alert("Email must not contain spaces");
    return;
  }

  if (!email.toLowerCase().endsWith("@binus.ac.id")) {
    alert("Email must end with @binus.ac.id");
    return;
  }

  if (studentId === "") {
    alert("Student ID / NIM is required");
    return;
  }

  if (!/^\d+$/.test(studentId)) {
    alert("Student ID / NIM must contain numbers only");
    return;
  }

  if (studentId.length !== 10) {
    alert("Student ID / NIM must be exactly 10 digits long");
    return;
  }

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

