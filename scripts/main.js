const chart1Select = document.getElementById('chart1Select');
let chart1;


chart1Select.addEventListener('change', function () {
    getDataChart1(chart1Select.value, function (data) {
        console.log(data)
        console.log(chart1Select.value)
        let graph_data = [];

        // Procesa los datos según sea necesario
        for (let i of data) {
            graph_data.push({ value: i.total_accidentes, name: i.nombre_vehiculo });
        }

        // Actualiza la opción del gráfico
        let updatedOption = {
            title: {
                text: `Accidentalidad por actor vial en ${chart1Select.value}`,
            },
            tooltip: {
                trigger: 'item'
            },
            legend: {
                bottom: '5%',
                left: 'center'
            },
            series: [
                {
                    name: 'Vehículo/Actor vial',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    itemStyle: {
                        borderRadius: 10,
                        borderColor: '#fff',
                        borderWidth: 2
                    },
                    label: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        label: {
                            show: true,
                            fontSize: 40,
                            fontWeight: 'bold'
                        }
                    },
                    labelLine: {
                        show: false
                    },
                    data: graph_data
                }
            ]
        };

        // Actualiza el gráfico con la nueva opción
        chart1.setOption(updatedOption);
    });
});


const getOptionChart1 = (callback) => {
    getDataChart1("init", function (data) {
        let graph_data = [];

        // Procesa los datos según sea necesario
        for (let i of data){
            graph_data.push({value: i.total_accidentes, name: i.nombre_vehiculo})
        }

        let option = {
            title: {
                text: 'Accidentalidad por actor vial.'
            },
            tooltip: {
                trigger: 'item'
            },
            legend: {
                bottom: '5%',
                left: 'center'
            },
            series: [
                {
                    name: 'Vehículo/Actor vial',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    itemStyle: {
                        borderRadius: 10,
                        borderColor: '#fff',
                        borderWidth: 2
                    },
                    label: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        label: {
                            show: true,
                            fontSize: 40,
                            fontWeight: 'bold'
                        }
                    },
                    labelLine: {
                        show: false
                    },
                    data: graph_data
                }
            ]
        };
        // Llama a la función de devolución de llamada con las opciones del gráfico
        callback(option);
    });
};

function getDataChart1(anio, callback) {
    $.ajax({
        url: 'processes/get_data.php',
        type: 'POST',
        data: {
            anio: anio,
            action: 'getDataChart1'
        },
        success: function (response) {
            let jsonString = JSON.stringify(response);
            let data = JSON.parse(jsonString);
            callback(data.content);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Manejar errores AJAX
            console.log('Error en la solicitud');
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        }
    });
}


document.addEventListener('DOMContentLoaded', function () {
    initCharts();
});

function initCharts() {
    chart1 = echarts.init(document.getElementById("chart1"));
    getOptionChart1(function (option) {
        chart1.setOption(option);
    });
}

//Echarts-Responsividad
window.addEventListener('resize', function () {
    chart1.resize();
});
