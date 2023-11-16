//Globals
let meses = {
    "Enero": 1, "Febrero": 2, "Marzo": 3, "Abril": 4, "Mayo": 5, "Junio": 6, "Julio": 7, "Agosto": 8, "Septiembre": 9, "Octubre": 10, "Noviembre": 11, "Diciembre": 12
}
let arrayMeses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
const añoActual = new Date().getFullYear();

// ----------- CHART 1: Incidentes viales-------------------
const chart1Select = document.getElementById('chart1Select');
let chart1;
//init
const getOptionChart1 = (callback) => {
    getData("init", 'getDataChart1', function (data) {
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
                    data: data
                }
            ]
        };
        // Llama a la función de devolución de llamada con las opciones del gráfico
        callback(option);
    });
};
//Filter
chart1Select.addEventListener('change', function () {
    getData(chart1Select.value, 'getDataChart1', function (data) {
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
                    data: data
                }
            ]
        };

        // Actualiza el gráfico con la nueva opción
        chart1.setOption(updatedOption);
    });
});
//------------CHART 2: Letalidad/Vehiculos-------------//
const chart2Select = document.getElementById('chart2Select');
let chart2;
//init
const getOptionChart2 = (callback) => {
    getData("init", 'getDataChart2', function (data) {

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
    getData(chart2Select.value, 'getDataChart2', function (data) {
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
    getData("init", 'getDataChart3', function (newData) {
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
                top: '5%', right: '5%'
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
                data: arrayMeses
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
    getData(chart3Select.value, 'getDataChart3', function (newData) {
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
                top: '5%',
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
                data: arrayMeses
            },
            yAxis: {
                type: 'value'
            },
            series: nseries
        };
        chart3.setOption(updatedOption);
    });
});

//-------------CHART 4: Tasa de muerte * 100hab
let chart4;
const chart4Select = document.getElementById('chart4Select');

const getOptionChart4 = (callback) => {
    let selectedIndex = chart4Select.selectedIndex;
    let selectedText = chart4Select.options[selectedIndex].text;
    getData("init", 'getDataChart4', function (newData) {
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
                text: `Tasa de muertes x 100.000 hab por I.V. - ${selectedText}`
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: anios,
                top: '5%', right: '5%'
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
                data: arrayMeses
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

chart4Select.addEventListener('change', function () {
    chart4.dispose();
    chart4 = echarts.init(document.getElementById("chart4"))
    getData(chart4Select.value, 'getDataChart4', function (newData) {
        let datosPorAnio = {};
        let anios = [];
        var pobTotalMpioPorAnio = {};
        let quarryData = newData[0];
        let acumMuertesPorAnio = {};
        let selectedIndex = chart4Select.selectedIndex;
        let selectedText = chart4Select.options[selectedIndex].text;

        if (isNaN(chart4Select.value)) {
            var pobTotalAntioquia = newData[1][0]['pob_total'];
        }
        else {
            var pobTotalMpioAnios = newData[1]
            for (let i of pobTotalMpioAnios) {
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
            if (!datosPorAnio[anio][mes]) {
                datosPorAnio[anio][mes] = 0;
            }

            acumMuertesPorAnio[anio] += parseInt(total_muertes);
            if (isNaN(chart4Select.value)) {
                datosPorAnio[anio][mes] = parseFloat((acumMuertesPorAnio[anio] / pobTotalAntioquia) * 100000).toFixed(2);
            }
            else {
                datosPorAnio[anio][mes] = parseFloat((acumMuertesPorAnio[anio] / pobTotalMpioPorAnio[anio]) * 100000).toFixed(2);
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
                text: `Muertes por incidentes viales x 100.000 hab. - ${selectedText}`
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
                data: arrayMeses
            },
            yAxis: {
                type: 'value'
            },
            series: series
        };
        chart4.setOption(updatedOption);
    });
});

//--------------CHART 5: Mortalidad por actor vial----------------
let chart5;
let chart5Select = document.getElementById('chart5Select');

const getOptionChart5 = (callback) => {
    getData("init", 'getDataChart5', function (newData) {
        let option = {
            title: {
                text: 'Mortalidad por actor vial',
                subtext: '(2016 - 2023)',
                left: 'center'
            },
            tooltip: {
                trigger: 'item'
            },
            legend: {
                orient: 'horizontal',
                bottom: '5%'
            },
            series: [
                {
                    name: 'Muertes por:',
                    type: 'pie',
                    radius: '55%',
                    data: newData,
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };
        callback(option);
    });
};

chart5Select.addEventListener('change', function () {
    getData(chart5Select.value, 'getDataChart5', function (newData) {
        let updatedOption = {
            title: {
                text: 'Mortalidad por actor vial',
                subtext: '(2016 - 2023)',
                left: 'center'
            },
            tooltip: {
                trigger: 'item'
            },
            legend: {
                orient: 'horizontal',
                bottom: '5%'
            },
            series: [
                {
                    name: 'Muertes por:',
                    type: 'pie',
                    radius: '55%',
                    data: newData,
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };
        chart5.setOption(updatedOption);
    });
});

//-----------CHART 6: Lesionados por actor vial-----------------
let chart6;
let chart6Select = document.getElementById('chart6Select');

const getOptionChart6 = (callback) => {
    getData("init", 'getDataChart6', function (newData) {
        let option = {
            title: {
                text: 'Lesionados por actor vial',
                subtext: '(2016 - 2023)',
                left: 'center'
            },
            tooltip: {
                trigger: 'item'
            },
            legend: {
                orient: 'horizontal',
                bottom: '5%'
            },
            series: [
                {
                    name: 'Muertes por:',
                    type: 'pie',
                    radius: '55%',
                    data: newData,
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };
        callback(option);
    });
}

chart6Select.addEventListener('change', function () {
    getData(chart6Select.value, 'getDataChart6', function (newData) {
        let updatedOption = {
            title: {
                text: 'Mortalidad por actor vial',
                subtext: '(2016 - 2023)',
                left: 'center'
            },
            tooltip: {
                trigger: 'item'
            },
            legend: {
                orient: 'horizontal',
                bottom: '5%'
            },
            series: [
                {
                    name: 'Muertes por:',
                    type: 'pie',
                    radius: '55%',
                    data: newData,
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };
        chart6.setOption(updatedOption);
    });
});


//-----------CHART 7: MORTALIDAD VS TASA DEPARTAMENTAL POR I.V -------------//
let chart7;
let chart7Select = document.getElementById('chart7Select');

const getOptionChart7 = (callback) => {
    getData(chart7Select.value, 'getDataChart7', function (newData) {
        // Seleccionar automáticamente el option con el valor del año actual
        document.getElementById("chart7Select").value = añoActual;

        const pobTotalAntioquia = newData[1][0]['value'];
        const dict = newData[0];

        console.log(dict)
        const barData = dict.map(function (objeto) {
            return parseInt(objeto.value);
        });

        console.log(barData)

        let acumMuertes = 0;
        const tasaPor100000Data = barData.map((value, index, array) => {
            acumMuertes += value; // Acumula las muertes
            const tasaPor100000 = parseFloat((acumMuertes / pobTotalAntioquia) * 100000).toFixed(2);
            return tasaPor100000;
        });

        let option = {
            title: {
                text: 'Mortalidad vs Tasa departamental',
                subtext: chart7Select.value,
                x: 'center',
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow',
                },
            },
            toolbox: {
                show: true,
                feature: {
                    saveAsImage: {
                        pixelRatio: 2,
                    },
                },
            },
            grid: {
                top: 80,
                bottom: 30,
            },
            xAxis: [
                {
                    type: 'category',
                    axisTick: { show: false },
                    data: arrayMeses,
                },
            ],
            yAxis: [
                {
                    type: 'value',
                    name: 'No. Muertos',
                },
                {
                    type: 'value',
                    name: 'Tasa x 100.000 hab',
                },
            ],
            series: [
                {
                    name: 'No. Muertos',
                    type: 'bar',
                    data: barData,
                },
                {
                    name: 'Tasa x 100.000 hab',
                    type: 'line',
                    yAxisIndex: 1,
                    data: tasaPor100000Data,
                },
            ],
        };
        callback(option);
    });
}

chart7Select.addEventListener('change', function () {
    chart7.dispose();
    chart7 = echarts.init(document.getElementById("chart7"));
    getData(chart7Select.value, 'getDataChart7', function (newData) {
        const pobTotalAntioquia = newData[1][0]['value'];
        const dict = newData[0];

        const barData = dict.map(function (objeto) {
            return parseInt(objeto.value);
        });

        let acumMuertes = 0;
        const tasaPor100000Data = barData.map((value, index, array) => {
            acumMuertes += value; // Acumula las muertes
            const tasaPor100000 = parseFloat((acumMuertes / pobTotalAntioquia) * 100000).toFixed(2);
            return tasaPor100000;
        });

        let updatedOption = {
            title: {
                text: 'Mortalidad vs Tasa departamental',
                subtext: chart7Select.value,
                x: 'center',
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow',
                },
            },
            toolbox: {
                show: true,
                feature: {
                    saveAsImage: {
                        pixelRatio: 2,
                    },
                },
            },
            grid: {
                top: 80,
                bottom: 30,
            },
            xAxis: [
                {
                    type: 'category',
                    axisTick: { show: false },
                    data: arrayMeses,
                },
            ],
            yAxis: [
                {
                    type: 'value',
                    name: 'No. Muertos',
                },
                {
                    type: 'value',
                    name: 'Tasa x 100.000 hab',
                },
            ],
            series: [
                {
                    name: 'No. Muertos',
                    type: 'bar',
                    data: barData,
                },
                {
                    name: 'Tasa x 100.000 hab',
                    type: 'line',
                    yAxisIndex: 1,
                    data: tasaPor100000Data,
                },
            ],
        };
        chart7.setOption(updatedOption);
    });
});

//-----------CHART 8: Lesionados VS TASA DEPARTAMENTAL POR I.V -------------//
let chart8;
let chart8Select = document.getElementById('chart8Select');

const getOptionChart8 = (callback) => {
    getData(chart8Select.value, 'getDataChart8', function (newData) {
        const añoActual = new Date().getFullYear();

        // Seleccionar automáticamente el option con el valor del año actual
        document.getElementById("chart8Select").value = añoActual;

        const pobTotalAntioquia = newData[1][0]['value'];
        const dict = newData[0];

        const barData = dict.map(function (objeto) {
            return parseInt(objeto.value);
        });

        let acumMuertes = 0;
        const tasaPor100000Data = barData.map((value, index, array) => {
            acumMuertes += value; // Acumula las muertes
            const tasaPor100000 = parseFloat((acumMuertes / pobTotalAntioquia) * 100000).toFixed(2);
            return tasaPor100000;
        });

        let option = {
            title: {
                text: 'Lesionados vs Tasa departamental',
                subtext: chart7Select.value,
                x: 'center',
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow',
                },
            },
            toolbox: {
                show: true,
                feature: {
                    saveAsImage: {
                        pixelRatio: 2,
                    },
                },
            },
            grid: {
                top: 80,
                bottom: 30,
            },
            xAxis: [
                {
                    type: 'category',
                    axisTick: { show: false },
                    data: arrayMeses,
                },
            ],
            yAxis: [
                {
                    type: 'value',
                    name: 'No. Muertos',
                },
                {
                    type: 'value',
                    name: 'Tasa x 100.000 hab',
                },
            ],
            series: [
                {
                    name: 'No. Muertos',
                    type: 'bar',
                    data: barData,
                },
                {
                    name: 'Tasa x 100.000 hab',
                    type: 'line',
                    yAxisIndex: 1,
                    data: tasaPor100000Data,
                },
            ],
        };
        callback(option);
    });
};

chart8Select.addEventListener('change', function () {
    chart8.dispose();
    chart8 = echarts.init(document.getElementById("chart8"));
    getData(chart8Select.value, 'getDataChart8', function (newData) {
        const pobTotalAntioquia = newData[1][0]['value'];
        const dict = newData[0];

        const barData = dict.map(function (objeto) {
            return parseInt(objeto.value);
        });

        let acumMuertes = 0;
        const tasaPor100000Data = barData.map((value, index, array) => {
            acumMuertes += value; // Acumula las muertes
            const tasaPor100000 = parseFloat((acumMuertes / pobTotalAntioquia) * 100000).toFixed(2);
            return tasaPor100000;
        });

        let updatedOption = {
            title: {
                text: 'Lesionados vs Tasa departamental',
                subtext: chart7Select.value,
                x: 'center',
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow',
                },
            },
            toolbox: {
                show: true,
                feature: {
                    saveAsImage: {
                        pixelRatio: 2,
                    },
                },
            },
            grid: {
                top: 80,
                bottom: 30,
            },
            xAxis: [
                {
                    type: 'category',
                    axisTick: { show: false },
                    data: arrayMeses,
                },
            ],
            yAxis: [
                {
                    type: 'value',
                    name: 'No. Muertos',
                },
                {
                    type: 'value',
                    name: 'Tasa x 100.000 hab',
                },
            ],
            series: [
                {
                    name: 'No. Muertos',
                    type: 'bar',
                    data: barData,
                },
                {
                    name: 'Tasa x 100.000 hab',
                    type: 'line',
                    yAxisIndex: 1,
                    data: tasaPor100000Data,
                },
            ],
        };
        chart8.setOption(updatedOption);
    });
});

//----------CHART 9: I.V Por regiones------------//
let chart9;
const chart9Select = document.getElementById('chart9Select');

const getOptionChart9 = (callback) => {
    getData("init", 'getDataChart9', function (newData) {
        option = {
            title: {
                text: 'I.V x Regiones',
                subtext: '(2016 - 2023)',
                x: 'center',
            },
            legend: {
                top: 'bottom'
            },
            tooltip: {
                trigger: 'item'
            },
            toolbox: {
                show: true,
                feature: {
                    mark: { show: true },
                }
            },
            series: [
                {
                    name: 'Incidentes Viales',
                    type: 'pie',
                    radius: [40, 160],
                    center: ['50%', '50%'],
                    roseType: 'area',
                    itemStyle: {
                        borderRadius: 8
                    },
                    data: newData
                }
            ]
        };
        callback(option);
    });
};

chart9Select.addEventListener('change', function () {
    getData(chart9Select.value, 'getDataChart9', function (newData) {
        updatedOption = {
            title: {
                text: 'I.V x Regiones',
                subtext: chart9Select.value,
                x: 'center',
            },
            legend: {
                top: 'bottom'
            },
            tooltip: {
                trigger: 'item'
            },
            toolbox: {
                show: true,
                feature: {
                    mark: { show: true },
                }
            },
            series: [
                {
                    name: 'Incidentes Viales',
                    type: 'pie',
                    radius: [40, 160],
                    center: ['50%', '50%'],
                    roseType: 'area',
                    itemStyle: {
                        borderRadius: 8
                    },
                    data: newData
                }
            ]
        };
        chart9.setOption(updatedOption);
    });
});

//----------CHART 10: Mixed Actores viales x regiones x % del total de accidentes x cantidad------------------//
let chart10;


const getOptionChart10 = (callback) => {
    getData("init", 'getDataChart10', function (datos) {
        console.log(datos)
        const names = [...new Set(datos.map(item => item.name))];
        var vehiculos = [...new Set(datos.map(item => item.vehiculo))];

        var datosOrganizados = {};

        names.forEach(function (region) {
            if (!datosOrganizados[region]) {
                datosOrganizados[region] = {};
            }

            vehiculos.forEach(function (vehiculo) {
                datosOrganizados[region][vehiculo] = 0;
            });
        });
        var muertesPorRegion = [];

        datos.forEach(function (item) {
            datosOrganizados[item.name][item.vehiculo] += parseInt(item.value);
            var nombreRegion = item.name;
            var cantidadMuertes = parseInt(item.value);

            // Inicializar el total de muertes para la región si no existe
            if (!muertesPorRegion[nombreRegion]) {
                muertesPorRegion[nombreRegion] = 0;
            }

            // Acumular el total de muertes para la región
            muertesPorRegion[nombreRegion] += cantidadMuertes;
        });
        let lista = Object.values(muertesPorRegion);
        var sumaTotal = lista.reduce((a, b) => a + b, 0);

        var porcentajeAcumulado = [];
        var acumulado = 0;

        for (var i = 0; i < lista.length; i++) {
            acumulado += (lista[i] / sumaTotal) * 100;
            porcentajeAcumulado.push(acumulado.toFixed(2));
        }
        
        var series = vehiculos.map(function (vehiculo) {
            var valores = names.map(function (region) {
                return datosOrganizados[region][vehiculo];
            });

            return {
                name: vehiculo,
                type: 'bar',
                stack: 'vehiculos',
                emphasis: {
                    focus: 'series'
                },
                data: valores
            };
        });

        series.push({
            name: "% del total",
            type: 'line',
            emphasis: {
                focus: 'series'
            },
            data: porcentajeAcumulado,
            yAxisIndex: 1
        });

        let option = {
            title: {
                text: 'Actores viales y % de accidentes por regiones.'
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                }
            },
            legend: { top: 'bottom' },
            grid: {
                containLabel: true
            },
            xAxis: [
                {
                    type: 'category',
                    data: names
                }
            ],
            yAxis: [
                {
                    type: 'value',
                    name: '# Incidentes Viales'
                },
                {
                    type: 'value',
                    'name': '% del total'
                },
            ],
            series: series
        };
        // Utilizar la configuración para dibujar el gráfico
        chart10.setOption(option);
    })
};


//Get data
function getData(anio, action, callback) {
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
            // console.log(data)
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

    chart5 = echarts.init(document.getElementById("chart5"));
    getOptionChart5(function (option) {
        chart5.setOption(option);
    });

    chart6 = echarts.init(document.getElementById("chart6"));
    getOptionChart6(function (option) {
        chart6.setOption(option);
    });

    chart7 = echarts.init(document.getElementById("chart7"));
    getOptionChart7(function (option) {
        chart7.setOption(option);
    });

    chart8 = echarts.init(document.getElementById("chart8"));
    getOptionChart8(function (option) {
        chart8.setOption(option);
    });

    chart9 = echarts.init(document.getElementById("chart9"));
    getOptionChart9(function (option) {
        chart9.setOption(option);
    });

    chart10 = echarts.init(document.getElementById("chart10"));
    getOptionChart10(function (option) {
        chart10.setOption(option);
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
    chart5.resize();
    chart6.resize();
    chart7.resize();
    chart8.resize();
    chart9.resize();
    chart10.resize();
});
