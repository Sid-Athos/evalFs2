function select(day,event){
    event.preventDefault();
    date = String(document.getElementById('date'+ day).value);
    date = date.split('-');
    $('#kill'+ day).tooltip('hide');
    (date[2] < 10)? date[2] = "0"+ date[2]: date[2] = date[2];
    $('#loginModal').modal('show');
    document.getElementById('0').value = date[0]+"-"+date[1]+"-"+date[2];
}


function showPass()
{
    if(document.getElementById('1').type === "password")
    {
        document.getElementById('1').type = "text";
    }
    else
    {
        document.getElementById('1').type = "password";
    }
}

function showPasswordReg()
{
    if(document.getElementById('1').type === "password")
    {
        document.getElementById('1').type = "text";
        document.getElementById('2').type = "text";        
    }
    else
    {
        document.getElementById('1').type = "password";
        document.getElementById('2').type = "password";
    }
}
function logoEvent(event)
{
    event.preventDefault();
    document.getElementById('0').value = "";
    document.getElementById('1').value = "";
    document.getElementById('2').value = "";
    document.getElementById('3').value = "";
}

function check(event)
{
    if(document.getElementById('1').value !== document.getElementById('2').value)
    {
        alert('Les mots de passe ne sont pas identiques');
        event.preventDefault();
    }
     
}
function showPw()
{
    if(document.getElementById('0').type === "password")
    {
        document.getElementById('0').type = "text";        
        document.getElementById('1').type = "text";
        document.getElementById('2').type = "text";
    }
    else
    {
        document.getElementById('0').type = "password";        
        document.getElementById('1').type = "password";
        document.getElementById('2').type = "password";
    }
}

function logoEventReg(event)
{
    for(let i = 0; i < 8; i++)
    {
        document.getElementById(i). value = "";
    }
    event.preventDefault();
}

function readURL(input) {
    /* Là on regarde si il y a un fichier dans un input type file */
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            /* On récupère la preview une fois que c'est préupload mamène */
                document.getElementById('blah').src = e.target.result;
        };
        /* Le petit outil qui permet de lire l'image sans reload */
        reader.readAsDataURL(input.files[0]);
    }
}

function selectAvatar()
{
    document.getElementById("file").click();

}

function subPlatoon(event)
{
    if(document.getElementById('0').style.color === "rgba(139, 0, 0, 0.4)")
    {
        event.preventDefault();        
    }
}
function checkPlatName(val)
{
    var val = val.replace(" ","-");

    var ajaxRequest;  // The variable that makes Ajax possible!
    try {
        ajaxRequest = new XMLHttpRequest();
    }catch (e) {
        try {
            ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
        }catch (e) {
            try{
                ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            }catch (e){
                alert("Your browser broke!");
                return false;
            }
        }
    }
    /** Crée la connexion et récupère la réponse */
        
    ajaxRequest.onreadystatechange = function(){
        if(ajaxRequest.readyState == 4){
            var ajaxDisplay = document.getElementById('0');
            if(ajaxRequest.responseText === '1')
            {
                document.getElementById('0').style.color = "rgb(139,0,0,0.4)";
                document.getElementById('0').style.fontWeight = "900";
                document.getElementById('0').style.fontSize = "18px";
                document.getElementById('check').style.color = "rgb(239,230,230,0.9)";
                document.getElementById('check').textContent = "Le nom du salon est déjà pris!";
                document.getElementById('check').style.fontSize = "18px";
                document.getElementById('check').style.fontWeight = "980";
            }
            else
            {
                document.getElementById('0').style.color = "#FFFFFF";
                document.getElementById('0').style.fontWeight = "500";
                document.getElementById('0').style.fontSize = "14px";
                document.getElementById('check').textContent = "";
            }
            if(document.getElementById('0').value === "")
            {
                document.getElementById('0').style.color = "#FFFFFF";
                document.getElementById('0').style.fontWeight = "500";
                document.getElementById('0').style.fontSize = "14px";
                document.getElementById('check').textContent = "";
            }
        }
    }
    /** Valeurs à passer en arguments et déclaration du Model à utiliser */
    var queryString = "?name=" + val;
    ajaxRequest.open("GET","C/AJAX/checkPlatName.php" + queryString, true);
    ajaxRequest.send(); 
}

function searchSelect()
{
    var content = $('#0').val().toLowerCase();
    var liste = document.querySelector("#select");
    var options = liste.options;
    for (var i = 0; i < options.length; i++) {
        var option = options[i]; 
        optionText = option.innerText.toLowerCase();
        if (optionText.indexOf(content) === 0) {
            option.selected = true;
            return;
        }
    }
}



function showIt(val){
    val = Number(val);
    if(val === 36)
    {
        document.getElementById('lolilol').style.display = "";
        document.getElementById('loulilol').style.display = "";
        document.getElementById('ownersSelect').style.display="none";
        document.getElementById('patientsSelect').style.display= "none";
        document.getElementById('cliMail').setAttribute('required','true');
        document.getElementById('4').removeAttribute('required');
        document.getElementById('10').type= "phone";
        document.getElementById('cliMail').type= "mail";
    }
    else if(val === 35)
    {
        document.getElementById('loulilol').style.display = "none";
        document.getElementById('lolilol').style.display = "";
        document.getElementById('4').removeAttribute('required');
        document.getElementById('ownersSelect').style.display= "";
        document.getElementById('patientsSelect').style.display= "none";
        document.getElementById('cliMail').removeAttribute('required');

        document.getElementById('10').type= "text";
        document.getElementById('cliMail').type= "text";
    } else {

        document.getElementById('loulilol').style.display = "none";
        document.getElementById('lolilol').style.display = "none";
        document.getElementById('4').setAttribute('required','true');
        document.getElementById('cliMail').removeAttribute('required');
        document.getElementById('patientsSelect').style.display= "";
        document.getElementById('10').type= "text";
        document.getElementById('cliMail').type= "text";
    }
}

function newDate(item)
{
    
    query = $.post({
        url : 'indexAjax.php',
        data : 
        {
            'date': $('input[name=appDate]').val(), 
        }
    });
    query.done(function(response){
        $('#endDate').attr({"min" :response});
    });
}

    