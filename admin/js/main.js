


document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
  
  const dropZoneElement = inputElement.closest(".drop-zone");
  dropZoneElement.addEventListener("click", (e) => {
    inputElement.click();
    console.log("clik")
  });
  inputElement.addEventListener("change", (e) => {
    if (inputElement.files.length) {
      //updateThumbnail(dropZoneElement, inputElement.files[0]);
    }
  });
  dropZoneElement.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropZoneElement.classList.add("drop-zone--over");
  });
  ["dragleave", "dragend"].forEach((type) => {
    dropZoneElement.addEventListener(type, (e) => {
      dropZoneElement.classList.remove("drop-zone--over");
    });
  });
  dropZoneElement.addEventListener("drop", (e) => {
    e.preventDefault();
    if (e.dataTransfer.files.length) {
      inputElement.files = e.dataTransfer.files;
      //updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
    }
    dropZoneElement.classList.remove("drop-zone--over");
  });
});


function updateThumbnail(file) {

  let thumbnailElement = file;
 
  console.log('function updateThumbnail');
  console.log(thumbnailElement);
 
  // Show thumbnail for image files
  if (file.type.startsWith("image/")) {
    console.log('bandera de imagen');
    const reader = new FileReader();
    reader.readAsDataURL(file);
    /* reader.onload = () => {
      thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
    }; */
    var formData = new FormData();
    formData.append('fileToUpload', file);
    
      $.ajax({
        url : '../upload/upload.php',
        type : 'POST',
        data : formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
        success : function(data) {
          console.log(data);
        }
    });
  } else {
    thumbnailElement.style.backgroundImage = null;
  }
}

