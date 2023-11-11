const user = document.getElementById('user');
const pass = document.getElementById('pass');
const send = document.getElementById('send');
const msg  = document.getElementById('msg');
const loginForm = document.getElementById('loginForm');

loginForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Evitar el envío del formulario

    const user_text = user.value.trim();
    const pass_text = pass.value.trim();
    let error = ""
    let ban = true;

    if (user_text === "" || pass_text === "") {
        error += "Algún dato está vacío";
        ban = false;
    }

    if (ban) {
        mandar_al_servidor(user_text, pass_text);
    }
    else {
        msg.textContent = error;
    }
});

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
            if(data.success){
                window.location.href = "../templates/admin.php";
            }
            else{
                msg.textContent = data.mensaje;
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
