function toggleText(id) {
  const textElement = document.getElementById("text-" + id);
  const button = document.getElementById("toggleButton-" + id);

  if (textElement.classList.contains("expanded")) {
    textElement.classList.remove("expanded");
    button.textContent = "Show More";
  } else {
    textElement.classList.add("expanded");
    button.textContent = "Show Less";
  }
}

function previewImage(event) {
  const imagePreview = document.getElementById("imagePreview");
  const newImageDiv = document.getElementById("newImage");

  const file = event.target.files[0];
  const reader = new FileReader();

  reader.onload = function () {
    imagePreview.src = reader.result;
    newImageDiv.classList.remove("hidden");
  };

  if (file) {
    reader.readAsDataURL(file);
  }
}
