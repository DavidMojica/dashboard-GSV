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

function mandar_al_servidor(user, pass) {
    // Utiliza el método fetch en lugar de $.ajax (jQuery) para realizar la solicitud AJAX
    fetch('../processes/login_process.php', {
        method: 'POST',
        body: JSON.stringify({ user, pass }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.success) {
            window.location.href = "../templates/admin.php";
        } else {
            msg.textContent = data.mensaje;
        }
    })
    .catch(error => {
        // Manejar errores en la solicitud AJAX
        console.log('Error en la solicitud');
        console.error(error);
    });
}
