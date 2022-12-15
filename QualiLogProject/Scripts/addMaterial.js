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
    console.log($('.MaterielAdd input[type="text"]').val());
});

function DeleteMaterial(materialId){
    console.log(materialId);
    var r = confirm("Voulez-vous vraiment supprimer ce matériel ?");
    if (r == true) {
        fetch("DeleteMaterial.php?ref=" + materialId);
        $("#"+materialId).remove();
    }
}