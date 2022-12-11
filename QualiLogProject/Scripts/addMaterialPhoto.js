function performClick(elemId) {
    $(elemId).click();
    $(elemId).change(function () {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onloadend = function () {
            $('.MaterielAdd img').attr('src', reader.result);
        }
        if (file) {
            reader.readAsDataURL(file);
        }
    });
}

$('.MaterielAdd input[type="submit"]').on('click', function () {
    var file = $('.MaterielAdd input[type="file"]').val();
    if (file == "") {
        alert("Choisissez une photo en cliquant sur l'image");
        return false;
    }
});