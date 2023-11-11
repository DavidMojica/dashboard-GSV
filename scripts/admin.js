const municipio = document.getElementById('municipio');
const toggle = document.getElementById('toggle');
const victima = document.getElementById('victima');
const cantidad = document.getElementById('cantidad');
const anio = document.getElementById('anio');
const mes = document.getElementById('mes');
const formAccidentes = document.getElementById('formAccidentes');
const msg =document.getElementById('msg_error');

var fechaActual = new Date();
var anio_actual = fechaActual.getFullYear();

const cantidadMunicipiosAntioquia = 125;
const cantidadTiposVictimas = 6;

formAccidentes.addEventListener('submit', function(event){
    event.preventDefault();

    const municipio_text = municipio.value.trim();
    const toggle_text = toggle.checked ? 2 : 1 //1 muerte 2 lesión 
    const victima_text = victima.value.trim();
    const cantidad_text = cantidad.value.trim();
    const anio_text = anio.value.trim();
    const mes_text = mes.value.trim();
    const regex = /^\d{4}$/
    let error = "";

    if(municipio_text.length == 0 || victima_text.length == 0 || cantidad_text.length == 0 || anio_text.length==0 || mes_text.length==0){
        msg.textContent = "Algún campo está vacío";
        return;
    }

    if(municipio_text <= 0 || municipio_text > cantidadMunicipiosAntioquia){
        msg.textContent = "Valor de municipio inválido.";
        return;
    }

    if(victima_text <= 0 || victima_text > cantidadTiposVictimas){
        msg.textContent = "Valor de tipo de víctima no válido.";
        return;
    }

    if(cantidad_text <= 0 || isNaN(cantidad_text)){
        msg.textContent = "Valor de cantidad no válido.";
        return;
    }

    if(!regex.test(anio_text) || anio <= 2000 && anio > anio_actual){
        msg.textContent = "Error en el año";
        return;
    }

    if(mes_text <= 0 || mes > 12){
        msg.textContent = "Error en el mes";
        return;
    }
    console.log(`${municipio_text}\n${toggle_text},\n${victima_text}\n${cantidad_text}\n${anio_text}\n${mes_text}`);
    AJAXaccidentes(municipio_text, toggle_text, victima_text, cantidad_text, anio_text, mes_text);
});

function AJAXaccidentes(municipio, fatalidad, victima, cantidad, anio, mes){
    
    $.ajax({
        url: '../processes/AJAX_a.php',
        type: 'POST',
        data:{
            municipio: municipio,
            fatalidad: fatalidad,
            victima: victima,
            cantidad: cantidad,
            anio: anio,
            mes: mes
        },
        success: function(response){
            let jsonString = JSON.stringify(response);
            let data       = JSON.parse(jsonString);
            if(data.success) limpiarCampos();
            else alert(data.mensaje)
        },
        error: function(jqXHR, textStatus, errorThrown){
            // Error en la solicitud AJAX
            console.log('Error en la solicitud');
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        }
    });
}

