function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

function aktualityUp() {
    document.getElementById('aktualityWindow').scrollTop-=20;
}
function aktualityDown() {
    document.getElementById('aktualityWindow').scrollTop+=20;
}

function oznamyUp() {
    document.getElementById('oznamyWindow').scrollTop-=20;
}
function oznamyDown() {
    document.getElementById('oznamyWindow').scrollTop+=20;
}
