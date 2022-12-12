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
        }, function(start, end, label) {
            
            let id = $(this).attr('element').attr('id').substring(5)
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (Id: ' + id + ')');
            fetch('AddNewReservation.php?debut="'+start+'"&fin="'+end+'"&id="'+id+'"')
                .then(function(res) {
                    if (res.ok) {
                        return res.text();
                    }
                })
                .then(function(value) {
                    console.log(value);
                    valeur = value;
                    if (valeur == '0') {
                        console.log("Réservation ajoutée");
                        alert("Réservation ajoutée");
                        document.location.href('Home.php?alerte="ReservationSuccessfull"');
                    }
                    else {
                        console.log("Erreur lors de l'ajout de la réservation");
                        alert("Erreur lors de l'ajout de la réservation : La période selectionnée se superpose avec une autre réservation");
                }
            })
            
        }, 
);


/*
function printDispo(dispo) {
    for (var elem in dispo) {
        console.log(dispo[elem]);
        $("#input"+elem).daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Cancel',
                applyLabel: 'Réserver',
                format: 'DD/MM/YYYY',
            },
            isInvalidDate: function(date) {
                for (var periode in dispo[elem]) {
                    console.log("periode : "+periode);
                    if (date.isBetween(dispo[elem][periode]['begin'], dispo[elem][periode]['end'], null, '[]')) {
                        return true;
                    }
                }
            }
        }, function(start, end, label) {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        });
    }
}*/


let dispo = [];

fetch('dispoJSON.php')
    .then(function(res) {
        if (res.ok) {
            return res.json();
        }
    })
    .then(function(value) {
        console.log(value);
        dispo = value;
        //addDispo(dispo);
        printDispo(dispo);
    })
    .catch(function(err) {
        // Une erreur est survenue
    });


function addDispo(dispo) {
    for (var elem in dispo) {
        console.log(dispo[elem]);
    }
}