$('input[name="datefilter"]')
    .daterangepicker({
        autoUpdateInput: false,
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
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
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

fetch('http://localhost:8888/QualiLogProject/dispoJSON.php')
    .then(function(res) {
        if (res.ok) {
            return res.json();
        }
    })
    .then(function(value) {
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