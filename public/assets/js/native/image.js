function previewImage(index) {
    const image = document.querySelector("#image" + index);
    const imgPreview = document.querySelector("#preview" + index);

    imgPreview.style.display = "block";

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    };
}
