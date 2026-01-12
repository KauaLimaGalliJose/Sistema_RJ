

function graficos(dados , div_id , tipo  ) {
        
        const div = document.getElementById(div_id);

        let options = {
            chart: {
                type: tipo,
                height: '100%',
                width: '100%',
                stacked: false ,
                toolbar: { show: false }
            },
            series: [{
                name: 'Vendas',
                //dados valores exemplo eixo y
                data: Object.entries(dados)
            }],
            xaxis: {
                type: 'datetime',
                labels: {
                    style: {
                        fontSize: '15px'
                    }
                },
            },
            legend: {
                fontSize: '18px',   // 👈 aumenta o tamanho
                fontWeight:  'bold',
                offsetY: 10,
                labels: {
                    colors: '#000'  // opcional
                },
                itemMargin: {
                    horizontal: 20,  // espaço lateral entre itens
                    vertical: 10     // espaço vertical entre itens
                }
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'gradient',
                gradient: {
                shade: 'none',
                shadeIntensity: 0.4,
                opacityFrom: 0.9,
                opacityTo: 0.1,
                stops: [0,100]
                }
            }
            
        };
        const chart = new ApexCharts(div, options);
        chart.render().then(() => {

        // Adiciona os botões de zoom após o gráfico ser renderizado
        document.querySelector("#reset_zoom").onclick = () => chart.resetSeries();
        document.getElementById("download_png").onclick = () => chart.dataURI().then(uri => baixar(uri.imgURI, "grafico.png"));
        document.getElementById("download_csv").onclick = () => chart.exportToCSV();

        function baixar(uri, nome) {
            const a = document.createElement("a");
            a.href = uri;
            a.download = nome;
            a.click();
        }
        
        })
}

function graficos_todos(dados, dadosG , dadosE , div_id , tipo  ) {
        
        const div = document.getElementById(div_id);

        let options = {
            
            chart: {
                type: tipo,
                height: '100%',
                width: '100%',
                stacked: false,
                toolbar: { show: false },
                animations: {
                    enabled: true,
                    speed: 900,
                    animateGradually: {
                        enabled: true,
                        delay: 150
                    },
                    dynamicAnimation: {
                        enabled: true,
                        speed: 350
                    }
                }
            },
            tooltip: {
                shared: true,     // mostra todas as séries juntas
                intersect: false, // não exige estar exatamente no ponto
                x: {
                    show: true,
                    format: 'dd/MM/yyyy'
                }
            },
            stroke: {
                width: 3,
                curve: 'smooth'  // 👈 isso sim é o lugar certo da curva
            },

            series: [{
                name: 'Pedidos PF',
                //dados valores exemplo eixo y
                data: Object.entries(dados)
            },{
                name: 'Pedidos PG',
                //dados valores exemplo eixo y
                data: Object.entries(dadosG)
            },{
                name: 'Pedidos PE',
                //dados valores exemplo eixo y
                data: Object.entries(dadosE)
            }],
            xaxis: {
                type: 'datetime',
                labels: {
                    style: {
                        fontSize: '15px'
                    }
                },
                
            },

            legend: {
                fontSize: '18px',   // 👈 aumenta o tamanho
                fontWeight:  'bold',
                offsetY: 10,
                labels: {
                    colors: '#000'  // opcional
                },
                itemMargin: {
                    horizontal: 20,  // espaço lateral entre itens
                    vertical: 10     // espaço vertical entre itens
                }
            },

            dataLabels: {
                enabled: false
            },

            fill: {
                type: 'gradient',
                gradient: {
                shade: 'none',
                shadeIntensity: 0.4,
                opacityFrom: 0.9,
                opacityTo: 0.1,
                stops: [0,100]
                }
            }
            
        };
        const chart = new ApexCharts(div, options);
        chart.render().then(() => {

        // Adiciona os botões de zoom após o gráfico ser renderizado
        document.querySelector("#reset_zoom").onclick = () => chart.resetSeries();
        document.getElementById("download_png").onclick = () => chart.dataURI().then(uri => baixar(uri.imgURI, "grafico.png"));
        document.getElementById("download_csv").onclick = () => chart.exportToCSV();

        function baixar(uri, nome) {
            const a = document.createElement("a");
            a.href = uri;
            a.download = nome;
            a.click();
        }
        
        });
}

function graficos_pizza(arrayEstoque, div_id) {

    const div = document.getElementById(div_id);

    // Pega os valores do seu objeto
    const valores = [
        Number(arrayEstoque.PF ?? 0),
        Number(arrayEstoque.PG ?? 0),
        Number(arrayEstoque.PE ?? 0),
        Number(arrayEstoque.Outros ?? 0)
    ];

    const total = valores.reduce((a, b) => a + b, 0);

    // Monta labels com porcentagem
    const labelsComPorcentagem = ['PF', 'PG', 'PE', 'Outros'].map((nome, i) => {
        const perc = total > 0 ? ((valores[i] / total) * 100) : 0;
        return `${nome} ${perc.toFixed(1)}%`;
    });


    var options = {
        chart: {
            type: 'donut',
            height: '100%',
            width: '100%',
        },

        series: valores,

        labels: labelsComPorcentagem,
        

        // Mostra os valores com "g"
        dataLabels: {
            enabled: false
        },

        colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560'],

        legend: {
            position: 'right',
            fontSize: "18px",
            fontWeight: 'bold',
            markers: { width: 14, height: 14, radius: 4 },
            itemMargin: { vertical: 7 },
        },

        plotOptions: {
            pie: {
                donut: {
                    size: '65%',
                    labels: {
                        show: true,

                    value: {
                        formatter: (val) => Number(val).toFixed(2) + " g"
                    },

                        total: {
                            show: true,
                            label: 'Peso Total',
                            fontSize: '18px',
                            fontWeight: 'bold',
                            formatter: (w) => {
                                const sum = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                return sum.toFixed(2) + ' g';
                            }
                        }
                    }
                }
            }
        }
    };

    var chart = new ApexCharts(div, options);
    chart.render().then(() => {

        // ===== Botões personalizados =====

        document.getElementById("reset_zoom_2").onclick = () => chart.resetSeries();

        document.getElementById("download_png_2").onclick = () =>
            chart.dataURI().then(uri => baixar(uri.imgURI, "grafico_pizza.png"));

        document.getElementById("download_csv_2").onclick = () =>
            chart.exportToCSV();

        function baixar(uri, nome) {
            const a = document.createElement("a");
            a.href = uri;
            a.download = nome;
            a.click();
        }

    });
}


function graficos_barra(dados , div_id , tipo  ) {
        
        const div = document.getElementById(div_id);

        let options = {
            chart: {
                type: tipo,
                height: '100%',
                width: '100%',
                stacked: false ,
                toolbar: { show: false }
            },
            series: [{
                name: 'Vendas',
                //dados valores exemplo eixo y
                data: Object.entries(dados)
            }],
            xaxis: {
                type: 'datetime',
                labels: {
                    style: {
                        fontSize: '15px'
                    }
                },
            },
            legend: {
                fontSize: '18px',   // 👈 aumenta o tamanho
                fontWeight:  'bold',
                offsetY: 10,
                labels: {
                    colors: '#000'  // opcional
                },
                itemMargin: {
                    horizontal: 20,  // espaço lateral entre itens
                    vertical: 10     // espaço vertical entre itens
                }
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'solid',
                gradient: {
                shade: 'none',
                shadeIntensity: 0.4,
                opacityFrom: 0.9,
                opacityTo: 0.1,
                stops: [0,100]
                }
            }
            
        };
        const chart = new ApexCharts(div, options);
        chart.render().then(() => {

        // Adiciona os botões de zoom após o gráfico ser renderizado
        document.querySelector("#reset_zoom_totais").onclick = () => chart.resetSeries();
        document.getElementById("download_png_totais").onclick = () => chart.dataURI().then(uri => baixar(uri.imgURI, "grafico.png"));
        document.getElementById("download_csv_totais").onclick = () => chart.exportToCSV();

        function baixar(uri, nome) {
            const a = document.createElement("a");
            a.href = uri;
            a.download = nome;
            a.click();
        }
        
        })
}