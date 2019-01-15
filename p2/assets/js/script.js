$('select').formSelect();
// Mise en place du datepicker en français
$('.datepicker').datepicker({
    i18n: {
        selectMonths: true,
        selectYears: 2,
        firstDay: 1,
        months: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthsShort: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        weekdays: ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'],
        weekdaysShort: ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'],
        weekdaysAbbrev: ['L', 'M', 'M', 'J', 'V', 'S', 'D'],
        today: 'Aujourd\'hui',
        clear: 'Réinitialiser',
        cancel: 'Fermer'
    },
    format: 'dd/mm/yyyy'
});
// Mis en place du timepicker
$('.timepicker').timepicker({
    defaultTime: 'now', // Set default time: 'now', '1:30AM', '16:30'
    fromNow: 0, // set default time to * milliseconds from now (using with default = 'now')
    twelveHour: false, // don't AM/PM or 24-hour format
    done: 'OK', // text for done-button
    clear: 'Effacer', // text for clear-button
    cancel: 'Annuler', // Text for cancel-button,
    container: undefined, // ex. 'body' will append picker to body
    autoclose: false, // automatic close timepicker
    ampmclickable: true, // make AM PM clickable
    aftershow: function () {} //Function for after opening timepicker
});
//Script du modal materialized
// the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
$('.modal').modal();