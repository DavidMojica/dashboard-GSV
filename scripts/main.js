//Globals
let meses = {
    "Enero": 1, "Febrero": 2, "Marzo": 3, "Abril": 4, "Mayo": 5, "Junio": 6, "Julio": 7, "Agosto": 8, "Septiembre": 9, "Octubre": 10, "Noviembre": 11, "Diciembre": 12
}

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
const chart3Select = document.getElementById('chart3Select');

const getOptionChart3 = (callback) => {
    getDataChart1("init", 'getDataChart3', function (newData) {
        let datosPorAnio = {};
        let anios = [];
        // Inicializar datosPorAnio y anios
        newData.forEach(element => {
            let { anio, mes, total_muertes } = element;
            if (!datosPorAnio[anio]) {
                datosPorAnio[anio] = {};
                anios.push(anio.toString());
            }
            if (!datosPorAnio[anio][mes]) {
                datosPorAnio[anio][mes] = 0;
            }
            datosPorAnio[anio][mes] = parseInt(total_muertes);
        });


        // Crear series con relleno de 0 para meses faltantes
        let series = anios.map(anio => {
            let data = Array.from({ length: 12 }).fill(0);

            for (let mes in datosPorAnio[anio]) {
                let mesIndex = meses[mes] - 1;

                data[mesIndex] = datosPorAnio[anio][mes];
            }

            return {
                name: anio.toString(),
                type: 'line',
                data: data
            };
        });


        let option = {
            title: {
                text: 'Muertes por incidentes viales por año'
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: anios,
                right: '5%'
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
                data: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
            },
            yAxis: {
                type: 'value'
            },
            series: series
        };
        // Llama a la función de devolución de llamada con las opciones del gráfico
        callback(option);
    });
};

chart3Select.addEventListener('change', function () {
    chart3.dispose();
    chart3 = echarts.init(document.getElementById("chart3"));
    getDataChart1(chart3Select.value, 'getDataChart3', function (newData) {
        let datosPorAnio = {};
        let anios = [];
        // Inicializar datosPorAnio y anios
        newData.forEach(element => {
            let { anio, mes, total_muertes } = element;
            if (!datosPorAnio[anio]) {
                datosPorAnio[anio] = {};
                anios.push(anio.toString());
            }
            if (!datosPorAnio[anio][mes]) {
                datosPorAnio[anio][mes] = 0;
            }
            datosPorAnio[anio][mes] = parseInt(total_muertes);
        });

        // Crear series con relleno de 0 para meses faltantes
        let nseries = anios.map(anio => {
            let data = Array.from({ length: 12 }).fill(0);

            for (let mes in datosPorAnio[anio]) {
                let mesIndex = meses[mes] - 1;
                data[mesIndex] = datosPorAnio[anio][mes];
            }
            return {
                name: anio.toString(),
                type: 'line',
                data: data
            };
        });
        console.log(nseries);

        let updatedOption = {
            title: {
                text: 'Muertes por incidentes viales por año'
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: anios,
                right: '5%'
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
                data: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
            },
            yAxis: {
                type: 'value'
            },
            series: nseries
        };
        chart3.setOption(updatedOption);
    });
});

//-------------CHART 4: Comparativo lesiones por incidentes viales (casos)
let chart4;
const chart4Select = document.getElementById('chart4Select');

const getOptionChart4 = (callback) => {
    getDataChart1("init", 'getDataChart4', function (newData) {
        let datosPorAnio = {};
        let anios = [];
        let pobTotalAntioquia = newData[1][0]['pob_total'];
        let quarryData = newData[0];
        let acumMuertesPorAnio = {};

        quarryData.forEach(element => {
            let { anio, mes, total_muertes } = element;

            if (!datosPorAnio[anio]) {
                datosPorAnio[anio] = {};
                anios.push(anio.toString());
                acumMuertesPorAnio[anio] = 0; // Reiniciar la acumulación al inicio de cada año
            }

            if (!datosPorAnio[anio][mes]) {
                datosPorAnio[anio][mes] = 0;
            }

            acumMuertesPorAnio[anio] += parseInt(total_muertes);
            datosPorAnio[anio][mes] = parseFloat((acumMuertesPorAnio[anio] / pobTotalAntioquia) * 100000).toFixed(2);
        });
        let series = anios.map(anio => {
            let data = Array.from({ length: 12 });

            for (let mes in datosPorAnio[anio]) {
                let mesIndex = meses[mes] - 1;

                data[mesIndex] = datosPorAnio[anio][mes];
            }
            return {
                name: anio.toString(),
                type: 'line',
                data: data
            };
        });

        let option = {
            title: {
                text: 'Muertes por incidentes viales por año'
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: anios,
                right: '5%'
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
                data: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
            },
            yAxis: {
                type: 'value'
            },
            series: series
        };
        // Llama a la función de devolución de llamada con las opciones del gráfico
        callback(option);
    });
};

chart4Select.addEventListener('change', function(){
    chart4.dispose();
    chart4 = echarts.init(document.getElementById("chart4"))
    getDataChart1(chart4Select.value, 'getDataChart4', function (newData) {
        let datosPorAnio = {};
        let anios = [];
        var pobTotalMpioPorAnio = {};
        let quarryData = newData[0];
        let acumMuertesPorAnio = {};
        
        if(isNaN(chart4Select.value)){
            var pobTotalAntioquia = newData[1][0]['pob_total'];
        }
        else{
            var pobTotalMpioAnios = newData[1]
            for (let i of pobTotalMpioAnios){
                pobTotalMpioPorAnio[i.anio] = i.cantidad
            }
        }

        quarryData.forEach(element => {
            let { anio, mes, total_muertes } = element;
            if (!datosPorAnio[anio]) {
                datosPorAnio[anio] = {};
                anios.push(anio.toString());
                acumMuertesPorAnio[anio] = 0; // Reiniciar la acumulación al inicio de cada año
            }
            if(isNaN(chart4Select.value)){
                if (!datosPorAnio[anio][mes]) {
                    datosPorAnio[anio][mes] = 0;
                }
    
                acumMuertesPorAnio[anio] += parseInt(total_muertes);
                datosPorAnio[anio][mes] = parseFloat((acumMuertesPorAnio[anio] / pobTotalAntioquia) * 100000).toFixed(2);
            }        
            else{
                anios.forEach(a => {
                    
                    console.log(a)


                });
            }
        });

        let series = anios.map(anio => {
            let data = Array.from({ length: 12 });

            for (let mes in datosPorAnio[anio]) {
                let mesIndex = meses[mes] - 1;

                data[mesIndex] = datosPorAnio[anio][mes];
            }
            return {
                name: anio.toString(),
                type: 'line',
                data: data
            };
        });

        let updatedOption = {
            title: {
                text: 'Muertes por incidentes viales por año'
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: anios,
                right: '5%'
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
                data: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
            },
            yAxis: {
                type: 'value'
            },
            series: series
        };
       chart4.setOption(updatedOption);
    });
});


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
    getOptionChart3(function (option) {
        chart3.setOption(option);
    });

    chart4 = echarts.init(document.getElementById("chart4"));
    getOptionChart4(function (option) {
        chart4.setOption(option);
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
    chart4.resize();
});
