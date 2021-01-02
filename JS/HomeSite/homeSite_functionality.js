window.onscroll = function() {scrollFunction()};
//Smooth scroll
$(document).ready(function(){
    $("a").on('click', function(event) {

        if (this.hash !== "") {
            event.preventDefault();

            var hash = this.hash;

            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function(){

                window.location.hash = hash;
            });
        }
    });
});

// Counter
$(function() {
    function count($this){
        var current = parseInt($this.html(), 10);
        current = current + 50; /* Where 50 is increment */

        $this.html(++current);
        if(current > $this.data('count')){
            $this.html($this.data('count'));
        } else {
            setTimeout(function(){count($this)}, 5);
        }
    }

    $(".stat-count").each(function() {
        $(this).data('count', parseInt($(this).html(), 10));
        $(this).html('0');
        count($(this));
    });

});

var showPrihlasovanie = false;
var showAboutUs = false;
var showOznamy = false;
var showPozicie = false;
var showKurzy = false;

function scrollFunction() {
    var heightPrihlasovanie = document.getElementById("prihlasovanie").offsetHeight;
    var heightOznamy = document.getElementById("oznamy").offsetHeight + heightPrihlasovanie;
    var heightAboutUs = document.getElementById("o_nas").offsetHeight + heightOznamy+
        document.getElementById('oddelovacPozicie').offsetHeight;
    var heightPozicie = document.getElementById("prac_pozicie").offsetHeight + heightOznamy
        +document.getElementById('oddelovacKurzy').offsetHeight;
    var heightKurzy = document.getElementById("kurzy").offsetHeight + heightPozicie
    + document.getElementById('footer').offsetHeight;

    /*Menu a skrolovacia ikonka*/
    if (document.body.scrollTop >= heightPrihlasovanie - 200 || document.documentElement.scrollTop >= heightPrihlasovanie - 200) {
        document.getElementById("img_scroll").style.opacity="0%";
        document.getElementById("scroll_down").style.borderBottomWidth="0px";
        document.getElementById("myTopnav").style.top = "0";
    } else {
        document.getElementById("img_scroll").style.opacity="50%";
        document.getElementById("scroll_down").style.borderBottomWidth="60px";
        document.getElementById("myTopnav").style.top = "-1000px";
    }

    /*Activna cast menu*/
    //Prihlasovanie
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

    //Oznamy
    if ((document.body.scrollTop >= heightPrihlasovanie || document.documentElement.scrollTop >= heightPrihlasovanie) && !showOznamy
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

    //Onas
    if ((document.body.scrollTop >= heightOznamy || document.documentElement.scrollTop >= heightOznamy) && !showAboutUs
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

    //Pracovne Pozicie
    if ((document.body.scrollTop >= heightAboutUs|| document.documentElement.scrollTop >= heightAboutUs) && !showPozicie
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
}
