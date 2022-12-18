$('input[name="datefilter"]')
    .daterangepicker({
        autoUpdateInput: false,
        drops: "auto",
        opens: "center",
        isInvalidDate: function(date) {
            let id = $(this).attr('element').attr('id').substring(5)
            if (dispo[id][0]['begin'] != null) {
                for (var periode in dispo[id]) {
                    if (date.isBetween(dispo[id][periode]['begin'], dispo[id][periode]['end'], null, '[]')) {
                        return true;
                    }
                }
            }
        },
        locale: {
            cancelLabel: 'Cancel',
            applyLabel: 'Réserver',
            format: 'DD/MM/YYYY',
            daysOfWeek: [
                "Dim.",
                "Lun.",
                "Mar.",
                "Mer.",
                "Jeu.",
                "Ven.",
                "Sam."
            ],
            monthNames: [
                "Janvier",
                "Fevrier",
                "Mars",
                "Avril",
                "Mai",
                "Juin",
                "Juillet",
                "Août",
                "Septembre",
                "Octobre",
                "Novembre",
                "Decembre"
            ],
            firstDay: 1}
        }
);

$('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
    let id = $(this).attr('id').substring(5);

    let start = picker.startDate;
    let end = picker.endDate;

    fetch('AddNewReservation.php?debut='+start.format('YYYY-MM-DD')+'&fin='+end.format('YYYY-MM-DD')+'&id='+id)
        .then(function(res) {
            if (res.ok) {
                return res.text();
            }
        })
        .then(function(value) {
            valeur = value;
            if (valeur == '0') {
                //alert("Réservation ajoutée");
                document.location.href = "Home.php?alerte=reservSuccess";
            }
            else {
                //alert("Erreur lors de l'ajout de la réservation : La période selectionnée se superpose avec une autre réservation");
                document.location.href = "Home.php?alerte=reservError";
        }
        })
});


let dispo = [];

fetch('dispoJSON.php')
    .then(function(res) {
        if (res.ok) {
            return res.json();
        }
    })
    .then(function(value) {
        dispo = value;
    })
    .catch(function(err) {
        console.log(err)
    });
