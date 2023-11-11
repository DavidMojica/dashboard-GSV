const municipio = document.getElementById('municipio');
const toggle = document.getElementById('toggle');
const victima = document.getElementById('victima');
const cantidad = document.getElementById('cantidad');
const fecha = document.getElementById('fecha');
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
    const fecha_text = fecha.value.trim();
    const regex = /^\d{4}-\d{2}$/
    let error = "";

    if(municipio_text.length == 0 || victima_text.length == 0 || cantidad_text.length == 0 || fecha_text.length == 0){
        error += "Algún campo está vacío";
    }

    if(municipio_text <= 0 || municipio_text > cantidadMunicipiosAntioquia){
        error += "Valor de municipio inválido. <br>";
    }

    if(victima_text <= 0 || victima_text > cantidadTiposVictimas){
        error += "Valor de tipo de víctima no válido. <br>";
    }

    if(cantidad_text <= 0 || isNaN(cantidad_text)){
        error += "Valor de cantidad no válido. <br>";
    }

    if(!regex.test(fecha_text)){
        error += "Ingrese la fecha en formato (YYYY-MM). <br>"
    }
    else{
        const split = fecha.split("-");
        const anio = split[0];
        const mes = split[1];
        if(mes <= 0 && mes > 12) error += "Mes no válido. <br>";
        if(anio <= 2000 && anio > anio_actual) error += "Año no válido. <br>"
    }



    if (error == "") AJAXaccidentes(municipio_text, toggle_text, victima_text, cantidad_text, fecha_text);
    else msg.textContent = error;
});

function AJAXaccidentes(municipio, fatalidad, victima, cantidad, fecha){
    
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

