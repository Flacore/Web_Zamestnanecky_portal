function fLoad() {
    $("#componentWindow").load("SystemComponents/Home_Component.php");
    active(1);
}

function active(k,podskupina) {
    var links = document.getElementsByClassName("active");
    for (i = 0; i < links.length; i++) {
        links[i].classList.add("menuItem");
        links[i].classList.remove("active");
    }
    var menuItems = document.getElementById(k);
    menuItems.classList.add("active");
    menuItems.classList.remove("menuItem");
    if(!(podskupina=="null")) {
        var parent = document.getElementById(podskupina);
        parent.classList.add("active");
        parent.classList.remove("menuItem");
    }
}

function BlogOpen() {
    $("#componentWindow").load("SystemComponents/Blog_Component.php");
    active(6);
}

function ContactsOpen() {
    $("#componentWindow").load("SystemComponents/Contacts_Component.php");
    active(3);
}

function MessegesOpen() {
    $("#componentWindow").load("SystemComponents/Messeges_Component.php");
    active(2);
}

function SettingsOpen() {
    $("#componentWindow").load("SystemComponents/Settings_Component.php");
    active(8);
}

function openNav() {
    hideDropdowns();
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("sidenav-button").style.width = "0px";
}


function closeNav() {
    hideDropdowns();
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("sidenav-button").style.width = "30px";
}

function glyphiconList(text,i) {
    var list=[257];
    list[0]="glyphicon-asterisk" ;
    list[1]="glyphicon-plus" ;
    list[2]="glyphicon-minus" ;
    list[3]="glyphicon-euro" ;
    list[4]="glyphicon-cloud" ;
    list[5]="glyphicon-envelope" ;
    list[6]="glyphicon-pencil" ;
    list[7]="glyphicon-glass" ;
    list[8]="glyphicon-music" ;
    list[9]="glyphicon-search" ;
    list[10]="glyphicon-heart" ;
    list[11]="glyphicon-star" ;
    list[12]="glyphicon-star-empty" ;
    list[13]="glyphicon-user" ;
    list[14]="glyphicon-film" ;
    list[15]="glyphicon-th-large" ;
    list[16]="glyphicon-th" ;
    list[17]="glyphicon-th-list" ;
    list[18]="glyphicon-ok" ;
    list[19]="glyphicon-remove" ;
    list[20]="glyphicon-zoom-in" ;
    list[21]="glyphicon-zoom-out" ;
    list[22]="glyphicon-off" ;
    list[23]="glyphicon-signal" ;
    list[24]="glyphicon-cog" ;
    list[25]="glyphicon-trash" ;
    list[26]="glyphicon-home" ;
    list[27]="glyphicon-file" ;
    list[28]="glyphicon-time" ;
    list[29]="glyphicon-road" ;
    list[30]="glyphicon-download-alt" ;
    list[31]="glyphicon-download" ;
    list[32]="glyphicon-upload" ;
    list[33]="glyphicon-inbox" ;
    list[34]="glyphicon-play-circle" ;
    list[35]="glyphicon-repeat" ;
    list[36]="glyphicon-refresh" ;
    list[37]="glyphicon-list-alt" ;
    list[38]="glyphicon-lock" ;
    list[39]="glyphicon-flag" ;
    list[40]="glyphicon-headphones" ;
    list[41]="glyphicon-volume-off" ;
    list[42]="glyphicon-volume-down" ;
    list[43]="glyphicon-volume-up" ;
    list[44]="glyphicon-qrcode" ;
    list[45]="glyphicon-barcode" ;
    list[46]="glyphicon-tag" ;
    list[47]="glyphicon-tags" ;
    list[48]="glyphicon-book" ;
    list[49]="glyphicon-bookmark" ;
    list[50]="glyphicon-print" ;
    list[51]="glyphicon-camera" ;
    list[52]="glyphicon-font" ;
    list[53]="glyphicon-bold" ;
    list[54]="glyphicon-italic" ;
    list[55]="glyphicon-text-height" ;
    list[56]="glyphicon-text-width" ;
    list[57]="glyphicon-align-left" ;
    list[58]="glyphicon-align-center" ;
    list[59]="glyphicon-align-right" ;
    list[60]="glyphicon-align-justify" ;
    list[61]="glyphicon-list" ;
    list[62]="glyphicon-indent-left" ;
    list[63]="glyphicon-indent-right" ;
    list[64]="glyphicon-facetime-video" ;
    list[65]="glyphicon-picture" ;
    list[66]="glyphicon-map-marker" ;
    list[67]="glyphicon-adjust" ;
    list[68]="glyphicon-tint" ;
    list[69]="glyphicon-edit" ;
    list[70]="glyphicon-share" ;
    list[71]="glyphicon-check" ;
    list[72]="glyphicon-move" ;
    list[73]="glyphicon-step-backward" ;
    list[74]="glyphicon-fast-backward" ;
    list[75]="glyphicon-backward" ;
    list[76]="glyphicon-play" ;
    list[77]="glyphicon-pause" ;
    list[78]="glyphicon-stop" ;
    list[79]="glyphicon-forward" ;
    list[80]="glyphicon-fast-forward" ;
    list[81]="glyphicon-step-forward" ;
    list[82]="glyphicon-eject" ;
    list[83]="glyphicon-chevron-left" ;
    list[84]="glyphicon-chevron-right" ;
    list[85]="glyphicon-plus-sign" ;
    list[86]="glyphicon-minus-sign" ;
    list[87]="glyphicon-remove-sign" ;
    list[88]="glyphicon-ok-sign" ;
    list[89]="glyphicon-question-sign" ;
    list[90]="glyphicon-info-sign" ;
    list[91]="glyphicon-screenshot" ;
    list[92]="glyphicon-remove-circle" ;
    list[93]="glyphicon-ok-circle" ;
    list[94]="glyphicon-ban-circle" ;
    list[95]="glyphicon-arrow-left" ;
    list[96]="glyphicon-arrow-right" ;
    list[97]="glyphicon-arrow-up" ;
    list[98]="glyphicon-arrow-down" ;
    list[99]="glyphicon-share-alt" ;
    list[100]="glyphicon-resize-full" ;
    list[101]="glyphicon-resize-small" ;
    list[102]="glyphicon-exclamation-sign" ;
    list[103]="glyphicon-gift" ;
    list[104]="glyphicon-leaf" ;
    list[105]="glyphicon-fire" ;
    list[106]="glyphicon-eye-open" ;
    list[107]="glyphicon-eye-close" ;
    list[108]="glyphicon-warning-sign" ;
    list[109]="glyphicon-plane" ;
    list[110]="glyphicon-calendar" ;
    list[111]="glyphicon-random" ;
    list[112]="glyphicon-comment" ;
    list[113]="glyphicon-magnet" ;
    list[114]="glyphicon-chevron-up" ;
    list[115]="glyphicon-chevron-down" ;
    list[116]="glyphicon-retweet" ;
    list[117]="glyphicon-shopping-cart" ;
    list[118]="glyphicon-folder-close" ;
    list[119]="glyphicon-folder-open" ;
    list[120]="glyphicon-resize-vertical" ;
    list[121]="glyphicon-resize-horizontal" ;
    list[122]="glyphicon-hdd" ;
    list[123]="glyphicon-bullhorn" ;
    list[124]="glyphicon-bell" ;
    list[125]="glyphicon-certificate" ;
    list[126]="glyphicon-thumbs-up" ;
    list[127]="glyphicon-thumbs-down" ;
    list[128]="glyphicon-hand-right" ;
    list[129]="glyphicon-hand-left" ;
    list[130]="glyphicon-hand-up" ;
    list[131]="glyphicon-hand-down" ;
    list[132]="glyphicon-circle-arrow-right" ;
    list[133]="glyphicon-circle-arrow-left" ;
    list[134]="glyphicon-circle-arrow-up" ;
    list[135]="glyphicon-circle-arrow-down" ;
    list[136]="glyphicon-globe" ;
    list[137]="glyphicon-wrench" ;
    list[138]="glyphicon-tasks" ;
    list[139]="glyphicon-filter" ;
    list[140]="glyphicon-briefcase" ;
    list[141]="glyphicon-fullscreen" ;
    list[142]="glyphicon-dashboard" ;
    list[143]="glyphicon-paperclip" ;
    list[144]="glyphicon-heart-empty" ;
    list[145]="glyphicon-link" ;
    list[146]="glyphicon-phone" ;
    list[147]="glyphicon-pushpin" ;
    list[148]="glyphicon-usd" ;
    list[149]="glyphicon-gbp" ;
    list[150]="glyphicon-sort" ;
    list[151]="glyphicon-sort-by-alphabet" ;
    list[152]="glyphicon-sort-by-alphabet-alt" ;
    list[153]="glyphicon-sort-by-order" ;
    list[154]="glyphicon-sort-by-order-alt" ;
    list[155]="glyphicon-sort-by-attributes" ;
    list[156]="glyphicon-sort-by-attributes-alt" ;
    list[157]="glyphicon-unchecked" ;
    list[158]="glyphicon-expand" ;
    list[159]="glyphicon-collapse-down" ;
    list[160]="glyphicon-collapse-up" ;
    list[161]="glyphicon-log-in" ;
    list[162]="glyphicon-flash" ;
    list[163]="glyphicon-log-out" ;
    list[164]="glyphicon-new-window" ;
    list[165]="glyphicon-record" ;
    list[166]="glyphicon-save" ;
    list[167]="glyphicon-open" ;
    list[168]="glyphicon-saved" ;
    list[169]="glyphicon-import" ;
    list[170]="glyphicon-export" ;
    list[171]="glyphicon-send" ;
    list[172]="glyphicon-floppy-disk" ;
    list[173]="glyphicon-floppy-saved" ;
    list[174]="glyphicon-floppy-remove" ;
    list[175]="glyphicon-floppy-save" ;
    list[176]="glyphicon-floppy-open" ;
    list[177]="glyphicon-credit-card" ;
    list[178]="glyphicon-transfer" ;
    list[179]="glyphicon-cutlery" ;
    list[180]="glyphicon-header" ;
    list[181]="glyphicon-compressed" ;
    list[182]="glyphicon-earphone" ;
    list[183]="glyphicon-phone-alt" ;
    list[184]="glyphicon-tower" ;
    list[185]="glyphicon-stats" ;
    list[186]="glyphicon-sd-video" ;
    list[187]="glyphicon-hd-video" ;
    list[188]="glyphicon-subtitles" ;
    list[189]="glyphicon-sound-stereo" ;
    list[190]="glyphicon-sound-dolby" ;
    list[191]="glyphicon-sound-5-1" ;
    list[192]="glyphicon-sound-6-1" ;
    list[193]="glyphicon-sound-7-1" ;
    list[194]="glyphicon-copyright-mark" ;
    list[195]="glyphicon-registration-mark" ;
    list[196]="glyphicon-cloud-download" ;
    list[197]="glyphicon-cloud-upload" ;
    list[198]="glyphicon-tree-conifer" ;
    list[199]="glyphicon-tree-deciduous" ;
    list[200]="glyphicon-cd" ;
    list[201]="glyphicon-save-file" ;
    list[202]="glyphicon-open-file" ;
    list[203]="glyphicon-level-up" ;
    list[204]="glyphicon-copy" ;
    list[205]="glyphicon-paste" ;
    list[206]="glyphicon-alert" ;
    list[207]="glyphicon-equalizer" ;
    list[208]="glyphicon-king" ;
    list[209]="glyphicon-queen" ;
    list[210]="glyphicon-pawn" ;
    list[211]="glyphicon-bishop" ;
    list[212]="glyphicon-knight" ;
    list[213]="glyphicon-baby-formula" ;
    list[214]="glyphicon-tent" ;
    list[215]="glyphicon-blackboard" ;
    list[216]="glyphicon-bed" ;
    list[217]="glyphicon-apple" ;
    list[218]="glyphicon-erase" ;
    list[219]="glyphicon-hourglass" ;
    list[220]="glyphicon-lamp" ;
    list[221]="glyphicon-duplicate" ;
    list[222]="glyphicon-piggy-bank" ;
    list[223]="glyphicon-scissors" ;
    list[224]="glyphicon-bitcoin" ;
    list[225]="glyphicon-yen" ;
    list[226]="glyphicon-ruble" ;
    list[227]="glyphicon-scale" ;
    list[228]="glyphicon-ice-lolly" ;
    list[229]="glyphicon-ice-lolly-tasted" ;
    list[230]="glyphicon-education" ;
    list[231]="glyphicon-option-horizontal" ;
    list[232]="glyphicon-option-vertical" ;
    list[233]="glyphicon-menu-hamburger" ;
    list[234]="glyphicon-modal-window" ;
    list[235]="glyphicon-oil" ;
    list[236]="glyphicon-grain" ;
    list[237]="glyphicon-sunglasses" ;
    list[238]="glyphicon-text-size" ;
    list[239]="glyphicon-text-color" ;
    list[240]="glyphicon-text-background" ;
    list[241]="glyphicon-object-align-top" ;
    list[242]="glyphicon-object-align-bottom" ;
    list[243]="glyphicon-object-align-horizontal" ;
    list[244]="glyphicon-object-align-left" ;
    list[245]="glyphicon-object-align-vertical" ;
    list[246]="glyphicon-object-align-right" ;
    list[247]="glyphicon-triangle-right" ;
    list[248]="glyphicon-triangle-left" ;
    list[249]="glyphicon-triangle-bottom" ;
    list[250]="glyphicon-triangle-top" ;
    list[251]="glyphicon-superscript" ;
    list[252]="glyphicon-subscript" ;
    list[253]="glyphicon-menu-left" ;
    list[254]="glyphicon-menu-right" ;
    list[255]="glyphicon-menu-down" ;
    list[256]="glyphicon-menu-up" ;


    if(i==null){
        for(j=0;j<257;j++){
            if(list[j]===text)
                return j;
        }
        return 0;
    }else{
        if(i<257 && i>=0)
            return list[i];
        return list[0];
    }

}

function nextGlyph() {
    var valueHolder=document.getElementById("icon_value");
    var self=glyphiconList(valueHolder.value,null);
    if(self===256){
        setGlyph(0)
    }else{
        setGlyph(self+1);
    }
}

function prevGlyph() {
    var valueHolder=document.getElementById("icon_value");
    var self=glyphiconList(valueHolder.value,null);
    if(self===0){
        setGlyph(256)
    }else{
        setGlyph(self-1);
    }
}

function setGlyph(i) {
    var element=document.getElementById("showing_icon");
    var valueHolder=document.getElementById("icon_value");
    element.className="";
    element.classList.add("glyphicon");
    element.classList.add(glyphiconList("",i));
    valueHolder.value=""+glyphiconList("",i)+"";
}
