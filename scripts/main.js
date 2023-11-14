// ----------- CHART 1: Accidentalidad por actor vial-------------------
const chart1Select = document.getElementById('chart1Select');
let chart1;
//init
const getOptionChart1 = (callback) => {
    getDataChart1("init",'getDataChart1', function (data) {
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
//Filter
chart1Select.addEventListener('change', function () {
    getDataChart1(chart1Select.value,'getDataChart1', function (data) {
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
//Get data
function getDataChart1(anio,action, callback) {
    $.ajax({
        url: 'processes/get_data.php',
        type: 'POST',
        data: {
            anio: anio,
            action: action
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
//------------CHART 2: Letalidad/Vehiculos-------------//
const chart2Select = document.getElementById('chart2Select');
let chart2;
//init
const getOptionChart2 = (callback) => {
    getDataChart1("init",'getDataChart2', function (data) {
        let graph_data = [];

        // Procesa los datos según sea necesario
        for (let i of data){
            graph_data.push({value: i.total_accidentes, name: i.nombre_vehiculo})
        }

        let option = {
            tooltip: {
              trigger: 'axis',
              axisPointer: {
                type: 'shadow'
              }
            },
            legend: {},
            grid: {
              left: '3%',
              right: '4%',
              bottom: '3%',
              containLabel: true
            },
            xAxis: [
              {
                type: 'category',
                data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
              }
            ],
            yAxis: [
              {
                type: 'value'
              }
            ],
            series: [
              {
                name: 'Direct',
                type: 'bar',
                emphasis: {
                  focus: 'series'
                },
                data: [320, 332, 301, 334, 390, 330, 320]
              },
              {
                name: 'Email',
                type: 'bar',
                stack: 'Ad',
                emphasis: {
                  focus: 'series'
                },
                data: [120, 132, 101, 134, 90, 230, 210]
              },
              {
                name: 'Union Ads',
                type: 'bar',
                stack: 'Ad',
                emphasis: {
                  focus: 'series'
                },
                data: [220, 182, 191, 234, 290, 330, 310]
              },
              {
                name: 'Video Ads',
                type: 'bar',
                stack: 'Ad',
                emphasis: {
                  focus: 'series'
                },
                data: [150, 232, 201, 154, 190, 330, 410]
              },
              {
                name: 'Search Engine',
                type: 'bar',
                data: [862, 1018, 964, 1026, 1679, 1600, 1570],
                emphasis: {
                  focus: 'series'
                },
                markLine: {
                  lineStyle: {
                    type: 'dashed'
                  },
                  data: [[{ type: 'min' }, { type: 'max' }]]
                }
              },
              {
                name: 'Baidu',
                type: 'bar',
                barWidth: 5,
                stack: 'Search Engine',
                emphasis: {
                  focus: 'series'
                },
                data: [620, 732, 701, 734, 1090, 1130, 1120]
              },
              {
                name: 'Google',
                type: 'bar',
                stack: 'Search Engine',
                emphasis: {
                  focus: 'series'
                },
                data: [120, 132, 101, 134, 290, 230, 220]
              },
              {
                name: 'Bing',
                type: 'bar',
                stack: 'Search Engine',
                emphasis: {
                  focus: 'series'
                },
                data: [60, 72, 71, 74, 190, 130, 110]
              },
              {
                name: 'Others',
                type: 'bar',
                stack: 'Search Engine',
                emphasis: {
                  focus: 'series'
                },
                data: [62, 82, 91, 84, 109, 110, 120]
              }
            ]
          };
        // Llama a la función de devolución de llamada con las opciones del gráfico
        callback(option);
    });
};
//Filter
chart2Select.addEventListener('change', function () {
    getDataChart1(chart2Select.value,'getDataChart2', function (data) {
        let graph_data = [];

        // Procesa los datos según sea necesario
        for (let i of data) {
            graph_data.push({ value: i.total_accidentes, name: i.nombre_vehiculo });
        }

        // Actualiza la opción del gráfico
        let updatedOption = {
            tooltip: {
              trigger: 'axis',
              axisPointer: {
                type: 'shadow'
              }
            },
            legend: {},
            grid: {
              left: '3%',
              right: '4%',
              bottom: '3%',
              containLabel: true
            },
            xAxis: [
              {
                type: 'category',
                data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
              }
            ],
            yAxis: [
              {
                type: 'value'
              }
            ],
            series: [
              {
                name: 'Direct',
                type: 'bar',
                emphasis: {
                  focus: 'series'
                },
                data: [320, 332, 301, 334, 390, 330, 320]
              },
              {
                name: 'Email',
                type: 'bar',
                stack: 'Ad',
                emphasis: {
                  focus: 'series'
                },
                data: [120, 132, 101, 134, 90, 230, 210]
              },
              {
                name: 'Union Ads',
                type: 'bar',
                stack: 'Ad',
                emphasis: {
                  focus: 'series'
                },
                data: [220, 182, 191, 234, 290, 330, 310]
              },
              {
                name: 'Video Ads',
                type: 'bar',
                stack: 'Ad',
                emphasis: {
                  focus: 'series'
                },
                data: [150, 232, 201, 154, 190, 330, 410]
              },
              {
                name: 'Search Engine',
                type: 'bar',
                data: [862, 1018, 964, 1026, 1679, 1600, 1570],
                emphasis: {
                  focus: 'series'
                },
                markLine: {
                  lineStyle: {
                    type: 'dashed'
                  },
                  data: [[{ type: 'min' }, { type: 'max' }]]
                }
              },
              {
                name: 'Baidu',
                type: 'bar',
                barWidth: 5,
                stack: 'Search Engine',
                emphasis: {
                  focus: 'series'
                },
                data: [620, 732, 701, 734, 1090, 1130, 1120]
              },
              {
                name: 'Google',
                type: 'bar',
                stack: 'Search Engine',
                emphasis: {
                  focus: 'series'
                },
                data: [120, 132, 101, 134, 290, 230, 220]
              },
              {
                name: 'Bing',
                type: 'bar',
                stack: 'Search Engine',
                emphasis: {
                  focus: 'series'
                },
                data: [60, 72, 71, 74, 190, 130, 110]
              },
              {
                name: 'Others',
                type: 'bar',
                stack: 'Search Engine',
                emphasis: {
                  focus: 'series'
                },
                data: [62, 82, 91, 84, 109, 110, 120]
              }
            ]
          };

        // Actualiza el gráfico con la nueva opción
        chart1.setOption(updatedOption);
    });
});



// ------------INIT CHARTS - RESPONSIVITY--------------//

function initCharts() {
    chart1 = echarts.init(document.getElementById("chart1"));
    getOptionChart1(function (option) {
        chart1.setOption(option);
    });
    getOptionChart2(function (option) {
        chart2.setOption(option);
    });
}

document.addEventListener('DOMContentLoaded', function () {
    initCharts();
});

//Echarts-Responsividad
window.addEventListener('resize', function () {
    chart1.resize();
    chart2.resize();
});
