//ACCIDENTES
const municipio = document.getElementById('municipio');
const toggle = document.getElementById('toggle');
const victima = document.getElementById('victima');
const cantidad = document.getElementById('cantidad');
const anio = document.getElementById('anio');
const mes = document.getElementById('mes');
const formAccidentes = document.getElementById('formAccidentes');
const msg =document.getElementById('msg_error');

//DANE
const municipio_dane = document.getElementById('municipio_dane');
const cantidad_dane = document.getElementById('cantidad_dane');
const anio_dane = document.getElementById('anio_dane');
const formDane = document.getElementById('formDane');
const msg_dane = document.getElementById('msg_dane');


var fechaActual = new Date();
var anio_actual = fechaActual.getFullYear();

const cantidadMunicipiosAntioquia = 125;
const cantidadTiposVictimas = 6;
const regex = /^\d{4}$/

formAccidentes.addEventListener('submit', function(event){
    event.preventDefault();

    const municipio_text = municipio.value.trim();
    const toggle_text = toggle.checked ? 2 : 1 //1 muerte 2 lesión 
    const victima_text = victima.value.trim();
    const cantidad_text = cantidad.value.trim();
    const anio_text = anio.value.trim();
    const mes_text = mes.value.trim();


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

    if(regex.test(anio_text)){
        if(anio_text > 2000 && anio_text <= anio_actual){

        }
        else{
            msg.textContent = "Error en el año.";
            return;
        }
    }    
    else{
        msg.textContent = "Error en el formato del año.";
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
            if(data.success){
                // cantidad.value = cantidad.defaultValue;
                msg.textContent = "Datos insertados correctamente.";
            }
            else alert(data.mensaje);
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

formDane.addEventListener('submit', function(event){
    event.preventDefault();

    let municipio_dane_text = municipio_dane.value.trim(); 
    let cantidad_dane_text = cantidad_dane.value.trim(); 
    let anio_dane_text = anio_dane.value.trim(); 

    if(municipio_dane_text.length == 0 || cantidad_dane_text.length == 0 || anio_dane_text.length == 0){
        msg_dane.textContent = "Algún campo está vacío";
        return;
    }

    if(municipio_dane_text <= 0 || municipio_dane_text > cantidadMunicipiosAntioquia){
        msg_dane.textContent = "Valor de municipio inválido.";
        return;
    }

    if(cantidad_dane_text <= 0 || isNaN(cantidad_dane_text)){
        msg_dane.textContent = "Valor de cantidad no válido.";
        return;
    }

    if(regex.test(anio_dane_text)){
        if(anio_dane_text > 2000 && anio_dane_text <= anio_actual){

        }
        else{
            msg_dane.textContent = "Error en el año.";
            return;
        }
    }    
    else{
        msg_dane.textContent = "Error en el formato del año.";
        return;
    }

    AJAXdane(municipio_dane_text, cantidad_dane_text, anio_dane_text);
});

function AJAXdane(municipio, cantidad, anio){
    $.ajax({
        url: '../processes/AJAX_dane.php',
        type: 'POST',
        data:{
            municipio: municipio,
            cantidad: cantidad,
            anio: anio
        },
        success: function(response){
            let jsonString = JSON.stringify(response);
            let data       = JSON.parse(jsonString);
            if(data.success){
                msg_dane.textContent = "Datos insertados correctamente.";
            }
            else alert(data.mensaje);
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
