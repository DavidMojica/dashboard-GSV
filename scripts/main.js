// ----------- CHART 1: Incidentes viales-------------------
const chart1Select = document.getElementById('chart1Select');
let chart1;
//init
const getOptionChart1 = (callback) => {
    getDataChart1("init", 'getDataChart1', function (data) {
        let graph_data = [];

        // Procesa los datos según sea necesario
        for (let i of data) {
            graph_data.push({ value: i.total_accidentes, name: i.nombre_vehiculo })
        }

        let option = {
            title: {
                text: `Incidentes viales (${chart1Select.value})`,
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
    getDataChart1(chart1Select.value, 'getDataChart1', function (data) {
        let graph_data = [];

        // Procesa los datos según sea necesario
        for (let i of data) {
            graph_data.push({ value: i.total_accidentes, name: i.nombre_vehiculo });
        }

        // Actualiza la opción del gráfico
        let updatedOption = {
            title: {
                text: `Incidentes viales (${chart1Select.value})`,
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
function getDataChart1(anio, action, callback) {
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
    getDataChart1("init", 'getDataChart2', function (data) {

        let nombres = [];
        let lesionadosDict = {};
        let muertosDict = {};

        for (let i of data) {
            if (!nombres.includes(i.nombre_vehiculo)) {
                nombres.push(i.nombre_vehiculo);
                lesionadosDict[i.nombre_vehiculo] = 0;
                muertosDict[i.nombre_vehiculo] = 0;
            }

            if (i.tipo_accidente === 'Lesion') {
                lesionadosDict[i.nombre_vehiculo] += parseInt(i.total_accidentes);
            } else {
                muertosDict[i.nombre_vehiculo] += parseInt(i.total_accidentes);
            }
        }

        let lesionadosData = Object.values(lesionadosDict);
        let muertosData = Object.values(muertosDict);

        let option = {
            title: {
                text: 'Fatalidad por actor vial'
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                }
            },
            legend: { top: '5%', right: '5%' },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis: [
                {
                    type: 'category',
                    data: nombres
                }
            ],
            yAxis: [
                {
                    type: 'value'
                }
            ],
            series: [
                {
                    name: 'Lesionados',
                    type: 'bar',
                    stack: 'let',
                    emphasis: {
                        focus: 'series'
                    },
                    data: lesionadosData
                },
                {
                    name: 'Muertos',
                    type: 'bar',
                    stack: 'let',
                    emphasis: {
                        focus: 'series'
                    },
                    data: muertosData
                },
            ]
        };
        // Llama a la función de devolución de llamada con las opciones del gráfico
        callback(option);
    });
};
// Filter
chart2Select.addEventListener('change', function () {
    getDataChart1(chart2Select.value, 'getDataChart2', function (data) {
        let nombres = [];
        let lesionadosDict = {};
        let muertosDict = {};

        for (let i of data) {
            if (!nombres.includes(i.nombre_vehiculo)) {
                nombres.push(i.nombre_vehiculo);
                lesionadosDict[i.nombre_vehiculo] = 0;
                muertosDict[i.nombre_vehiculo] = 0;
            }

            if (i.tipo_accidente === 'Lesion') {
                lesionadosDict[i.nombre_vehiculo] += parseInt(i.total_accidentes);
            } else {
                muertosDict[i.nombre_vehiculo] += parseInt(i.total_accidentes);
            }
        }

        let lesionadosData = Object.values(lesionadosDict);
        let muertosData = Object.values(muertosDict);

        let updatedOption = {
            title: {
                text: `Fatalidad por actor vial (${chart2Select.value})`
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                }
            },
            legend: { top: '5%', right: '5%' },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis: [
                {
                    type: 'category',
                    data: nombres
                }
            ],
            yAxis: [
                {
                    type: 'value'
                }
            ],
            series: [
                {
                    name: 'Lesionados',
                    type: 'bar',
                    stack: 'let',
                    emphasis: {
                        focus: 'series'
                    },
                    data: lesionadosData
                },
                {
                    name: 'Muertos',
                    type: 'bar',
                    stack: 'let',
                    emphasis: {
                        focus: 'series'
                    },
                    data: muertosData
                },
            ]
        };

        // Actualiza el gráfico con la nueva opción
        chart2.setOption(updatedOption);
    });
});

//------------CHART 3: Comparativo muertes por incidentes viales (casos)--------------//
let chart3;

const getOptionChart3 = (callback) => {
    getDataChart1("init", 'getDataChart3', function (data) {

        let option = {
            title: {
              text: 'Stacked Line'
            },
            tooltip: {
              trigger: 'axis'
            },
            legend: {
              data: ['Email', 'Union Ads', 'Video Ads', 'Direct', 'Search Engine']
            },
            grid: {
              left: '3%',
              right: '4%',
              bottom: '3%',
              containLabel: true
            },
            toolbox: {
              feature: {
                saveAsImage: {}
              }
            },
            xAxis: {
              type: 'category',
              boundaryGap: false,
              data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
            },
            yAxis: {
              type: 'value'
            },
            series: [
              {
                name: 'Email',
                type: 'line',
                stack: 'Total',
                data: [120, 132, 101, 134, 90, 230, 210]
              },
              {
                name: 'Union Ads',
                type: 'line',
                stack: 'Total',
                data: [220, 182, 191, 234, 290, 330, 310]
              },
              {
                name: 'Video Ads',
                type: 'line',
                stack: 'Total',
                data: [150, 232, 201, 154, 190, 330, 410]
              },
              {
                name: 'Direct',
                type: 'line',
                stack: 'Total',
                data: [320, 332, 301, 334, 390, 330, 320]
              },
              {
                name: 'Search Engine',
                type: 'line',
                stack: 'Total',
                data: [820, 932, 901, 934, 1290, 1330, 1320]
              }
            ]
          };
        // Llama a la función de devolución de llamada con las opciones del gráfico
        callback(option);
    });
};



// ------------INIT CHARTS - RESPONSIVITY--------------//

function initCharts() {
    chart1 = echarts.init(document.getElementById("chart1"));
    getOptionChart1(function (option) {
        chart1.setOption(option);
    });

    chart2 = echarts.init(document.getElementById("chart2"));
    getOptionChart2(function (option) {
        chart2.setOption(option);
    });

    chart3 = echarts.init(document.getElementById("chart3"));
    getOptionChart2(function (option) {
        chart3.setOption(option);
    });
}

document.addEventListener('DOMContentLoaded', function () {
    initCharts();
});

//Echarts-Responsividad
window.addEventListener('resize', function () {
    chart1.resize();
    chart2.resize();
    chart3.resize();
});
