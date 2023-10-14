function burgermenu() {
    var x = $("nav")[0]; //lekéri az első nav objectet
    if (x.className != "respons") {
        x.className = "respons";
        $([document.documentElement, document.body]).animate({
            scrollTop: $("nav").offset().top
        }, 1000); // felmegy az oldal tetejére mert a nav ott jelenik meg 
    } else {
        x.className = "";
    }
}