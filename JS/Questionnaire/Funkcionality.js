function startUpload(){
    document.getElementById('f1_upload_process').style.display = 'block';
    return true;
}

function stopUpload(success,idPrvok,idvalue,value){
    if (success == 1){
        document.getElementById('result').innerHTML =
            '<span class="cente msg">Súbor sa nahral!<\/span><br/><br/>';
        document.getElementById(idPrvok).classList.add('hidden');
        let tmp=document.getElementById(idPrvok+"_"+idvalue);
        tmp.value=value;
    }
    else {
        document.getElementById('result').innerHTML =
            '<span class="center emsg">Došlo ku chybe!<\/span><br/><br/>';
    }
    document.getElementById('f1_upload_process').style.display = 'none';
    return true;
}

function submit_form() {
    let url=document.form_quiz_ans.action;
    let formData = $("#form_quiz_ans").serialize();
    if(control()) {
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            success: function (data) {
                submit_item(data);
                location.href="questionnaire_succes.php";
            }
        });
    }
}

function submit_item(data) {
    let prvky = document.getElementsByClassName('form_quiz');
    for (let i = 0; i < prvky.length; ++i) {
        let item = prvky[i];

        let html = document.createElement('input');
        html.type = "number";
        html.name = "vyplnenie";
        html.classList.add("hidden");
        html.value = data;
        item.append(html);

        let formData = $(item).serialize();
        url = item.action;

        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            success: function (data) {
            }
        });
    }
}

function control() {
    let bool=false;
    let prvky = document.getElementsByClassName('form_quiz');
    for (let i = 0; i < prvky.length; ++i) {
        let item=prvky[i];
        if (item.checkValidity() && checkOther(item,item.children[0].value)) {
            bool = true;
        } else {
            alert("Vo formulári sú dáta ktoré niesu vyplnené!");
            item.scrollIntoView();
            let tmp = item.previousElementSibling;
            tmp.classList.add("nevyplnene");
            bool = false;
            break;
        }
    }
    return bool;
}

function checkOther(item,typ) {
    if(item.getElementsByTagName('input')[1].value==1) {
        if (typ === "3" || typ === "11") {
            let checkboxes = item.querySelectorAll('input[type=checkbox]:checked');
            if (checkboxes.length > 0)
                return true;
            else {
                if(typ === "3" ){
                    let sibling=item.nextSibling;
                    if((sibling.children[3].value===""||sibling.children[3].value===null))
                        return true;
                }
                return false;
            }
        }
        if (typ === "4" || typ === "9" || typ === "10") {
            let id = item.getElementsByTagName('input')[3].value;
            let prvky = document.getElementsByClassName('form_quiz');
            for (let i = 0; i < prvky.length; ++i) {
                let prvok = prvky[i];
                if (typ === prvok.getElementsByTagName('input')[0].value) {
                    if (id === prvok.getElementsByTagName('input')[3].value) {
                        let checkboxes = prvok.querySelectorAll('input[type=checkbox]:checked');
                        if (checkboxes.length > 0)
                            return true;
                    }
                }
            }
            if(typ === "4" ){
                let prvky = document.getElementsByClassName('form_quiz');
                for (let i = 0; i < prvky.length; ++i) {
                    if ("1" === prvok.getElementsByTagName('input')[0].value) {
                        if (id === prvok.getElementsByTagName('input')[2].value) {
                            sibling=prvky[i];
                            let sibling=item.nextSibling;
                            if((sibling.children[3].value===""||sibling.children[3].value===null))
                                return true;
                        }
                    }
                }
            }
            return false;
        }
    }
    return true;
}