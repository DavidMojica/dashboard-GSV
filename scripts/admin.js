const municipio = document.getElementById('municipio');
const toggle = document.getElementById('toggle');
const victima = document.getElementById('victima');
const cantidad = document.getElementById('cantidad');
const fecha = document.getElementById('fecha');
const formAccidentes = document.getElementById('formAccidentes');
const msg =document.getElementById('msg_error');


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
        error += "Ingrese la fecha en formato (YYYY-MM)."
    }



    if (error == "") AJAXaccidentes(municipio_text, toggle_text, victima_text, cantidad_text, fecha_text);
    else msg.textContent = error;
});

function AJAXaccidentes(municipio, fatalidad, victima, cantidad, fecha){
    const split = fecha.split("-");
    const anio = split[0];
    const mes = split[1];


}

