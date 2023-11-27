const filtroMunicipio = document.getElementById('filtroMunicipio');
const tbody = document.getElementById('tbody');

filtroMunicipio.addEventListener('change', function(){
    while (tbody.firstChild)
        tbody.removeChild(tbody.firstChild);
    
    console.log(filtroMunicipio.value)
    $.ajax({
        url: "../processes/filterMun.php",
        type: "post",
        data: {
            idMun: filtroMunicipio.value
        },
        success: function(response){
            let jsonString = JSON.stringify(response);
            let data = JSON.parse(jsonString);
            let contentArray = data.content;
            for(var i = 0; i < contentArray.length; i++){
                let item = contentArray[i];
                displayTableMembers(item.id, item.Mes, item.Año, item.Vehiculo, item.municipio, item.ML, item.Cantidad);
            };
        },
        error: function(jqXHR){
            console.log(jqXHR)
        }
    });
});


function displayTableMembers(id, mes, año, vehiculo, municipio, ml, cantidad){
    const tr = document.createElement('tr');
    
    const td = document.createElement('td');

}