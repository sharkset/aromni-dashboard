<script>
// ============================================================== 
// doughnut chart option
// ============================================================== 
var doughnutChart = echarts.init(document.getElementById('m-piechart_semana'));
// specify chart configuration item and data
option = {
    tooltip: {
        trigger: 'item'
        , formatter: "{a} <br/>{b}"
    }
    , legend: {
        orient: 'horizontal'
        , x: 'center'
        , show: false
        , y: 'bottom'
        , data: ['35', '40', '20', '5']
    }
    , toolbox: {
        show: false
        , feature: {
            dataView: {
                show: true
                , readOnly: false
            }
            , magicType: {
                show: false
                , type: ['pie', 'funnel']
                , option: {
                    funnel: {
                        x: '25%'
                        , width: '50%'
                        , funnelAlign: 'center'
                        , max: 1548
                    }
                }
            }
            , restore: {
                show: true
            }
            , saveAsImage: {
                show: true
            }
        }
    }
    , color: ["#00C292", "#03A9F3", "#FEC107", "#E46A76"]
    , calculable: true
    , series: [
        {
            name: 'Acionamentos'
            , type: 'pie'
            , radius: ['80%', '90%']
            , itemStyle: {
                normal: {
                    label: {
                        show: true, 
                        textStyle: {
                            fontSize: '20'
                            , fontWeight: 'bold'
                        }
                    }
                    , labelLine: {
                        show: true
                    }
                }
            }
            , data: [
                {
                    value: 35
                    , name: '35% (150)'
                }
                , {
                    value: 40
                    , name: '40% (172)'
                }
                , {
                    value: 20
                    , name: '20% (86)'
                }
                , {
                    value: 5
                    , name: '5% (22)'
                }
                ]
            }
        ]
};
// use configuration item and data specified to show chart
doughnutChart.setOption(option, true), $(function () {
    function resize() {
        setTimeout(function () {
            doughnutChart.resize()
        }, 100)
    }
    $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
});
</script>