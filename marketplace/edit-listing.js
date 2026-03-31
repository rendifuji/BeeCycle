const form = document.querySelector(".edit-listing-form");

form.addEventListener("submit", (e) => {
  e.preventDefault();

  const itemTitle = document.getElementById("item-title").value.trim();
  const category = document.getElementById("category").value.trim();
  const condition = document.getElementById("condition").value.trim();
  const price = document.getElementById("price").value.trim();
  const description = document.getElementById("description").value.trim();
  const campusLocation = document.getElementById("campus-location").value.trim();
  const meetingSpot = document.getElementById("meeting-spot").value.trim();
  const photoInput = document.getElementById("item-photo");
  const photo = photoInput.files[0];

  if (itemTitle === "") {
    alert("Item title is required");
    return;
  }

  if (itemTitle.length < 5) {
    alert("Item title must be at least 5 characters long");
    return;
  }

  if (category === "") {
    alert("Category is required");
    return;
  }

  if (condition === "") {
    alert("Condition is required");
    return;
  }

  if (price === "") {
    alert("Price is required");
    return;
  }

  const numericPrice = Number(price);

  if (Number.isNaN(numericPrice) || numericPrice <= 0) {
    alert("Price must be a valid number greater than 0");
    return;
  }

  if (description === "") {
    alert("Description is required");
    return;
  }

  if (description.length < 20) {
    alert("Description must be at least 20 characters long");
    return;
  }

  if (campusLocation === "") {
    alert("Campus location is required");
    return;
  }

  if (meetingSpot === "") {
    alert("Preferred meeting spot is required");
    return;
  }

  if (meetingSpot.length < 3) {
    alert("Preferred meeting spot must be at least 3 characters long");
    return;
  }

  if (photo) {
    const validExtensions = [".jpg", ".jpeg", ".png"];
    const lowerCaseName = photo.name.toLowerCase();
    const isValidPhoto = validExtensions.some((extension) =>
      lowerCaseName.endsWith(extension)
    );

    if (!isValidPhoto) {
      alert("Item photo must be a JPG or PNG file");
      return;
    }
  }

  alert("Listing updated successfully!");
  form.submit();
});

