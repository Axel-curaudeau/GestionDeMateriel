function DeleteUser(userId) {
    var r = confirm("Voulez-vous vraiment supprimer cet utilisateur ?");
    if (r == true) {
        fetch("DeleteUser.php?userId=" + userId);
        $("#"+userId).remove();
    }
}

function ChangeUser($userId){
    location.href = "ChangeUserPage.php?userId=" + $userId;
}

function DeleteMaterial(materialId){
    console.log(materialId);
    var r = confirm("Voulez-vous vraiment supprimer ce matériel ?");
    if (r == true) {
        fetch("DeleteMaterial.php?ref=" + materialId);
        $("#"+materialId).remove();
        document.location.reload(true);
    }
}

function DeleteReservation(reservationId, userID){
    var r = confirm("Voulez-vous vraiment supprimer cette réservation ?");
    if (r == true) {
        fetch("DeleteReservation.php?reservationId=" + reservationId);
        $("#"+reservationId).remove();
        
        console.log($(".Materiel"));
        if ($(".Materiel").length == 0) {
            $("#NoReservation").show();
            console.log(userID);
            $("#UID"+userID).remove();
        }
    }
}

$(".Tableau input").change(function() {
    var r = confirm("Voulez-vous vraiment modifier les droits de cet utilisateur ?");
    if (r == true) {
        var userId = $(this).parent().parent().attr("id");
        if ($(this).is(":checked")) {
            var admin = 1;
        } else {
            var admin = 0;
        }
        fetch("ChangeUserAdmin.php?userId=" + userId + "&admin=" + admin);
    } else {
        if ($(this).is(":checked")) {
            $(this).prop("checked", false);
        } else {
            $(this).prop("checked", true);
        }
    }
});