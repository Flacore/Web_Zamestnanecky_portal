window.onscroll = function() {scrollFunction()};
var showPrihlasovanie = false;
var showAboutUs = false;
var showOznamy = false;
var showPozicie = false;
var showKurzy = false;

function scrollFunction() {

    /*Menu a skrolovacia ikonka*/
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        document.getElementById("img_scroll").style.opacity="0%";
        document.getElementById("scroll_down").style.bottom="-60px";
        document.getElementById("navbar").style.top = "0";
    } else {
        document.getElementById("img_scroll").style.opacity="50%";
        document.getElementById("scroll_down").style.bottom="0px";
        document.getElementById("navbar").style.top = "-60px";
    }

    /*Activna cast menu*/
    //Prihlasovanie
    var heightPrihlasovanie = document.getElementById("prihlasovanie").offsetHeight;
    var heightAboutUs = document.getElementById("o_nas").offsetHeight + heightPrihlasovanie;
    var heightOznamy = document.getElementById("oznamy").offsetHeight + heightAboutUs;
    var heightPozicie = document.getElementById("prac_pozicie").offsetHeight + heightOznamy;
    var heightKurzy = document.getElementById("kurzy").offsetHeight + heightPozicie;

    if ((document.body.scrollTop < heightPrihlasovanie || document.documentElement.scrollTop < heightPrihlasovanie) && !showPrihlasovanie
    && !(document.body.scrollTop >= heightPrihlasovanie || document.documentElement.scrollTop >= heightPrihlasovanie)) {
        document.getElementById("prihlasovanieButton").classList.add("navbarButtonActive");
        document.getElementById("o_nasButton").classList.remove("navbarButtonActive");
        document.getElementById("oznamyButton").classList.remove("navbarButtonActive");
        document.getElementById("prac_pozicieButton").classList.remove("navbarButtonActive");
        document.getElementById("kurzyButton").classList.remove("navbarButtonActive");
        showPrihlasovanie = true;
        showAboutUs = false;
        showOznamy = false;
        showPozicie = false;
        showKurzy = false;
    }

    //O nas
    if ((document.body.scrollTop >= heightPrihlasovanie || document.documentElement.scrollTop >= heightPrihlasovanie) && !showAboutUs
        && !(document.body.scrollTop >= heightAboutUs || document.documentElement.scrollTop >= heightAboutUs)) {
        document.getElementById("prihlasovanieButton").classList.remove("navbarButtonActive");
        document.getElementById("o_nasButton").classList.add("navbarButtonActive");
        document.getElementById("oznamyButton").classList.remove("navbarButtonActive");
        document.getElementById("prac_pozicieButton").classList.remove("navbarButtonActive");
        document.getElementById("kurzyButton").classList.remove("navbarButtonActive");
        showPrihlasovanie = false;
        showAboutUs = true;
        showOznamy = false;
        showPozicie = false;
        showKurzy = false;
    }

    //Oznamy
    if ((document.body.scrollTop >= heightAboutUs || document.documentElement.scrollTop >= heightAboutUs) && !showOznamy
    && !(document.body.scrollTop >= heightOznamy || document.documentElement.scrollTop >= heightOznamy)) {
        document.getElementById("prihlasovanieButton").classList.remove("navbarButtonActive");
        document.getElementById("o_nasButton").classList.remove("navbarButtonActive");
        document.getElementById("oznamyButton").classList.add("navbarButtonActive");
        document.getElementById("prac_pozicieButton").classList.remove("navbarButtonActive");
        document.getElementById("kurzyButton").classList.remove("navbarButtonActive");
        showPrihlasovanie = false;
        showAboutUs = false;
        showOznamy = true;
        showPozicie = false;
        showKurzy = false;
    }

    //Pracovne Pozicie
    if ((document.body.scrollTop >= heightOznamy || document.documentElement.scrollTop >= heightOznamy) && !showPozicie
    && !(document.body.scrollTop >= heightPozicie || document.documentElement.scrollTop >= heightPozicie)) {
        document.getElementById("prihlasovanieButton").classList.remove("navbarButtonActive");
        document.getElementById("o_nasButton").classList.remove("navbarButtonActive");
        document.getElementById("oznamyButton").classList.remove("navbarButtonActive");
        document.getElementById("prac_pozicieButton").classList.add("navbarButtonActive");
        document.getElementById("kurzyButton").classList.remove("navbarButtonActive");
        showPrihlasovanie = false;
        showAboutUs = false;
        showOznamy = false;
        showPozicie = true;
        showKurzy = false;
    }

    //Kurzy
    if ((document.body.scrollTop >= heightPozicie || document.documentElement.scrollTop >= heightPozicie) && !showKurzy
    && !(document.body.scrollTop >= heightKurzy || document.documentElement.scrollTop >= heightKurzy)) {
        document.getElementById("prihlasovanieButton").classList.remove("navbarButtonActive");
        document.getElementById("o_nasButton").classList.remove("navbarButtonActive");
        document.getElementById("oznamyButton").classList.remove("navbarButtonActive");
        document.getElementById("prac_pozicieButton").classList.remove("navbarButtonActive");
        document.getElementById("kurzyButton").classList.add("navbarButtonActive");
        showPrihlasovanie = false;
        showAboutUs = false;
        showOznamy = false;
        showPozicie = false;
        showKurzy = true;
    }

    //Ostatne
    if (document.body.scrollTop >= heightKurzy || document.documentElement.scrollTop >= heightKurzy) {
        document.getElementById("prihlasovanieButton").classList.remove("navbarButtonActive");
        document.getElementById("o_nasButton").classList.remove("navbarButtonActive");
        document.getElementById("oznamyButton").classList.remove("navbarButtonActive");
        document.getElementById("prac_pozicieButton").classList.remove("navbarButtonActive");
        document.getElementById("kurzyButton").classList.remove("navbarButtonActive");
        showPrihlasovanie = false;
        showAboutUs = false;
        showOznamy = false;
        showPozicie = false;
        showKurzy = false;
    }
}