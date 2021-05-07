var endDate = document.querySelector('.endDate');
var decompte = document.querySelector('.decompte');
var state = document.querySelector('.a-state');
var hDate = document.querySelector('.h-date');
var h_decompte = document.querySelector('.h-decompte');

if(state.getAttribute("state") == "0") {

    var dast = new Date("January 1, 1970 00:00:00");
    var hours = 1000 * 60 * 60;
    var days = hours * 24;

    /* DECOMPTE DE DATE DE FIN */

    var endD = new Date(endDate.innerText);
    endDates = new Date(endD - Date.now());
    var nbrDay = Math.round(Date.parse(endDates) / days);
    decompte.innerHTML = nbrDay + "jours " + endDates.getHours() + "h " + endDates.getMinutes() + "min " + endDates.getSeconds() + "s";
    setInterval(function() {
        if(nbrDay == 0 && endDates.getHours() == 0 && endDates.getMinutes() == 0 && endDates.getSeconds() == 0) {
            location.assign("account.php");
        }
        endDates.setMilliseconds(-1000);
        nbrDay = Math.round(Date.parse(endDates) / days);
        decompte.innerHTML = nbrDay + "jours " + endDates.getHours() + "h " + endDates.getMinutes() + "min " + endDates.getSeconds() + "s";
    }, 1000)


    /* DECOMPTE DES 5 MINUTES */

    var h_Date = new Date(hDate.innerText);
    h_d = new Date(h_Date - Date.now());
    h_decompte.innerHTML = h_d.getMinutes() + ":" + h_d.getSeconds();
    setInterval(function() {
        if(h_d.getMinutes() == 0 && h_d.getSeconds() == 0) {
            location.assign("account.php");
        }
        h_d.setMilliseconds(-1000);
        h_decompte.innerHTML = h_d.getMinutes() + ":" + h_d.getSeconds();
    }, 1000)

}