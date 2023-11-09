const user = document.getElementById('user');
const pass = document.getElementById('pass');
const send = document.getElementById('send');


function validar_login(){
    user_text = user.value.trim();
    pass_text = pass.value.trim();
    let msg = "";
    ban = true

    if(user === "" || pass === ""){
        msg += "Algún campo está vacío<br>";
        ban = false;
    }

    if (ban) mandar_al_servidor(user_text, pass_text);
}

function mandar_al_servidor(user, pass){
    $.ajax({
        url: '../processes/login_process.php',
        type: 'POST',
        data:{
            user: user,
            pass: pass
        },
        success: function(response){
            let jsonString = JSON.stringify(response);
            let data       = JSON.parse(jsonString);
            console.log(data);
            if(data.success){
                window.location.href = "../templates/admin.php"
            }
        },error: function(jqXHR, textStatus, errorThrown){
            // Error en la solicitud AJAX
            console.log('Error en la solicitud');
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        }
    });
}