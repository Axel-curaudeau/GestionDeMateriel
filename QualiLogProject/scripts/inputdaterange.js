$('input[name="datefilter"]') // Date range picker with invalid date
    .daterangepicker({
        autoUpdateInput: false,
        isInvalidDate: function(date) {
            return date.day() == 1;
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