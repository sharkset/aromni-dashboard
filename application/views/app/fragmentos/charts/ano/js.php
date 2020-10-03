<script>
    /*
Template Name: Admin Template
Author: Wrappixel

File: js
*/
$(function () {
    "use strict";
    
});
// ============================================================== 
// doughnut chart option
// ============================================================== 
var doughnutChart = echarts.init(document.getElementById('m-piechart_ano'));
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
        , data: ['35', '42', '8', '15']
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
                    , name: '35% (8.858)'
                }
                , {
                    value: 42
                    , name: '42% (10.630)'
                }
                , {
                    value: 8
                    , name: '8% (2.025)'
                }
                , {
                    value: 15
                    , name: '15% (3.796)'
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