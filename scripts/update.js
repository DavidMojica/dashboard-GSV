const filtroMunicipio = document.getElementById('filtroMunicipio');
const tbody = document.getElementById('tbody');

filtroMunicipio.addEventListener('change', function(){
    while (tbody.firstChild)
        tbody.removeChild(tbody.firstChild);
    
    $.ajax({
        url: "../processes/filterMun.php",
        type: "post",
        data: {
            idMun: filtroMunicipio.value
        },
        success: function(response){

        },
        error: function(jqXHR){
            console.log(jqXHR)
        }
    });

});