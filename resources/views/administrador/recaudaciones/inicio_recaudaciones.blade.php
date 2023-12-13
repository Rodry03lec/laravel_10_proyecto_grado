@extends('menu.principal_recaudaciones')
@section('titulo_recaudaciones', '| INICIO')
@section('contenido_recaudaciones')
    <!-- end single card -->
    <div class="card py-4">
        {{-- <header class=" card-header">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate, adipisci pariatur quisquam quidem velit, perspiciatis esse aspernatur, assumenda optio alias inventore blanditiis accusamus sunt! Totam consequatur vel quam repellendus odit!
        </header> --}}
        <div class="card-body px-6 pb-6">
            <div class="grid xl:grid-cols-2 grid-cols-1 gap-5">
                <div class="text-center">
                    <h4 class="card-title">Personas</h4>
                    <div id="personas_nat_jur"></div>
                </div>
                <div class="text-center">
                    <h4 class="card-title">Zonas</h4>
                    <div id="donutChart1"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- end single card -->
@endsection

@section('script_recaudaciones')
    <script>




        !(function() {
            const l = "dark" === localStorage.theme;
            var e = "rtl" === localStorage.dir;

            function o(e, o, t) {
                for (var a = 0, s = []; a < o;) {
                    var r = Math.floor(Math.random() * (t.max - t.min + 1)) + t.min,
                        i = Math.floor(61 * Math.random()) + 15;
                    s.push([e, r, i]), (e += 864e5), a++;
                }
                return s;
            }
            const t = "#4669FA",
                a = "#F1595C",
                s = "#FA916B",
                r = "#0CE7FA",
                i = "#50C793";
            var n = (e, o) => {
                    var t = parseInt(e.slice(1, 3), 16),
                        a = parseInt(e.slice(3, 5), 16),
                        e = parseInt(e.slice(5, 7), 16);
                    return o ?
                        "rgba(" + t + ", " + a + ", " + e + ", " + o + ")" :
                        "rgb(" + t + ", " + a + ", " + e + ")";
                },
                e = [
                    {
                        id: "areaChart1",
                        options: {
                            chart: {
                                height: 350,
                                type: "area",
                                toolbar: {
                                    show: !1
                                }
                            },
                            series: [{
                                data: [90, 70, 85, 60, 80, 70, 90, 75, 60, 80]
                            }, ],
                            dataLabels: {
                                enabled: !1
                            },
                            stroke: {
                                curve: "smooth",
                                width: 4
                            },
                            colors: ["#4669FA"],
                            tooltip: {
                                theme: "dark"
                            },
                            grid: {
                                show: !0,
                                borderColor: l ? "#334155" : "#e2e8f0",
                                strokeDashArray: 10,
                                position: "back",
                            },
                            fill: {
                                type: "gradient",
                                colors: "#4669FA",
                                gradient: {
                                    shadeIntensity: 1,
                                    opacityFrom: 0.4,
                                    opacityTo: 0.5,
                                    stops: [50, 100, 0],
                                },
                            },
                            yaxis: {
                                labels: {
                                    style: {
                                        colors: l ? "#CBD5E1" : "#475569",
                                        fontFamily: "Inter",
                                    },
                                },
                            },
                            xaxis: {
                                categories: [
                                    "Jan",
                                    "Feb",
                                    "Mar",
                                    "Apr",
                                    "May",
                                    "Jun",
                                    "Jul",
                                    "Aug",
                                    "Sep",
                                    "Oct",
                                    "Nov",
                                    "Dec",
                                ],
                                labels: {
                                    style: {
                                        colors: l ? "#CBD5E1" : "#475569",
                                        fontFamily: "Inter",
                                    },
                                },
                                axisBorder: {
                                    show: !1
                                },
                                axisTicks: {
                                    show: !1
                                },
                            },
                            padding: {
                                top: 0,
                                right: 0,
                                bottom: 0,
                                left: 0
                            },
                        },
                    },
                    {
                        id: "basicBarChart1",
                        options: {
                            chart: {
                                height: 350,
                                type: "bar",
                                toolbar: {
                                    show: !1
                                }
                            },
                            series: [{
                                data: [
                                    400, 430, 448, 470, 540, 580, 690, 1100, 1200,
                                    1380,
                                ],
                            }, ],
                            plotOptions: {
                                bar: {
                                    horizontal: !0
                                }
                            },
                            dataLabels: {
                                enabled: !1
                            },
                            yaxis: {
                                labels: {
                                    style: {
                                        colors: l ? "#CBD5E1" : "#475569",
                                        fontFamily: "Inter",
                                    },
                                },
                            },
                            grid: {
                                show: !0,
                                borderColor: l ? "#334155" : "#e2e8f0",
                                strokeDashArray: 10,
                                position: "back",
                            },
                            xaxis: {
                                categories: [
                                    "South Korea",
                                    "Canada",
                                    "United Kingdom",
                                    "Netherlands",
                                    "Italy",
                                    "France",
                                    "Japan",
                                    "United States",
                                    "China",
                                    "Germany",
                                ],
                                labels: {
                                    style: {
                                        colors: l ? "#CBD5E1" : "#475569",
                                        fontFamily: "Inter",
                                    },
                                },
                                axisBorder: {
                                    show: !1
                                },
                                axisTicks: {
                                    show: !1
                                },
                            },
                            colors: ["#4669FA"],
                        },
                    },



                    {
                        id: "personas_nat_jur",
                        options: {
                            chart: {
                                height: 450,
                                type: "pie",
                                toolbar: {
                                    show: !1
                                }
                            },
                            labels: ["Natural", "Juridica"],
                            dataLabels: {
                                enabled: !0
                            },
                            series: [40, 55],
                            colors: [
                                "#4669FA",
                                "#F1595C",
                                "#50C793",
                                "#0CE7FA",
                                "#FA916B",
                            ],
                            legend: {
                                position: "bottom",
                                fontSize: "16px",
                                fontFamily: "Inter",
                                fontWeight: 400,
                                labels: {
                                    colors: l ? "#CBD5E1" : "#475569"
                                },
                                markers: {
                                    width: 6,
                                    height: 6,
                                    offsetY: -1,
                                    offsetX: -5,
                                    radius: 12,
                                },
                                itemMargin: {
                                    horizontal: 10,
                                    vertical: 0
                                },
                            },
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    legend: {
                                        position: "bottom"
                                    }
                                },
                            }, ],
                        },
                    },
                    {
                        id: "donutChart1",
                        options: {
                            chart: {
                                height: 450,
                                type: "donut",
                                toolbar: {
                                    show: !1
                                },
                            },
                            labels: ["Calles", "Avenidas"],
                            series: [44, 55],
                            dataLabels: {
                                enabled: !0
                            },
                            colors: ["#50C793", "#F1595C"],
                            legend: {
                                position: "bottom",
                                fontSize: "16px",
                                fontFamily: "Inter",
                                fontWeight: 400,
                                labels: {
                                    colors: l ? "#CBD5E1" : "#475569"
                                },
                            },
                            plotOptions: {
                                pie: {
                                    donut: {
                                        size: "65%",
                                        labels: {
                                            show: !0,
                                            name: {
                                                show: !0,
                                                fontSize: "26px",
                                                fontWeight: "bold",
                                                fontFamily: "Inter",
                                                color: l ? "#CBD5E1" : "#475569",
                                            },
                                            value: {
                                                show: !0,
                                                fontFamily: "Inter",
                                                color: l ? "#CBD5E1" : "#475569",
                                                formatter(e) {
                                                    return parseInt(e) + "%";
                                                },
                                            },
                                            total: {
                                                show: !0,
                                                fontSize: "1.5rem",
                                                color: l ? "#CBD5E1" : "#475569",
                                                label: "Total",
                                                formatter() {
                                                    return "80%";
                                                },
                                            },
                                        },
                                    },
                                },
                            },
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    legend: {
                                        position: "bottom"
                                    }
                                },
                            }, ],
                        },
                    },
                    {
                        id: "mixedChart",
                        options: {
                            chart: {
                                stacked: !1,
                                height: 350,
                                type: "line",
                                toolbar: {
                                    show: !1
                                },
                            },
                            series: [{
                                    name: "Column",
                                    type: "column",
                                    data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30],
                                },
                                {
                                    name: "Area",
                                    type: "area",
                                    data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43],
                                },
                                {
                                    name: "Line",
                                    type: "line",
                                    data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39],
                                },
                            ],
                            stroke: {
                                width: [0, 2, 5],
                                curve: "smooth"
                            },
                            plotOptions: {
                                bar: {
                                    columnWidth: "50%"
                                }
                            },
                            fill: {
                                opacity: [0.85, 0.25, 1],
                                gradient: {
                                    inverseColors: !1,
                                    shade: "light",
                                    type: "vertical",
                                    opacityFrom: 0.85,
                                    opacityTo: 0.55,
                                    stops: [0, 100, 100, 100],
                                },
                            },
                            labels: [
                                "01/01/2003",
                                "02/01/2003",
                                "03/01/2003",
                                "04/01/2003",
                                "05/01/2003",
                                "06/01/2003",
                                "07/01/2003",
                                "08/01/2003",
                                "09/01/2003",
                                "10/01/2003",
                                "11/01/2003",
                            ],
                            markers: {
                                size: 0
                            },
                            xaxis: {
                                type: "datetime",
                                labels: {
                                    style: {
                                        colors: l ? "#CBD5E1" : "#475569",
                                        fontFamily: "Inter",
                                    },
                                },
                                axisBorder: {
                                    show: !1
                                },
                                axisTicks: {
                                    show: !1
                                },
                            },
                            yaxis: {
                                min: 0,
                                labels: {
                                    style: {
                                        colors: l ? "#CBD5E1" : "#475569",
                                        fontFamily: "Inter",
                                    },
                                },
                            },
                            tooltip: {
                                shared: !0,
                                intersect: !1,
                                y: {
                                    formatter: function(e) {
                                        return void 0 !== e ?
                                            e.toFixed(0) + " views" :
                                            e;
                                    },
                                },
                            },
                            legend: {
                                labels: {
                                    useSeriesColors: !0
                                }
                            },
                            grid: {
                                show: !0,
                                borderColor: l ? "#334155" : "#e2e8f0",
                                position: "back",
                            },
                            colors: ["#4669FA", "#50C793", "#0CE7FA"],
                        },
                    },
                    {
                        id: "radarChart",
                        options: {
                            chart: {
                                height: 450,
                                type: "radar",
                                toolbar: {
                                    show: !1
                                },
                                dropShadow: {
                                    enabled: !1,
                                    blur: 8,
                                    left: 1,
                                    top: 1,
                                    opacity: 0.2,
                                },
                            },
                            series: [{
                                    name: "Option A",
                                    data: [41, 64, 81, 60, 42, 42, 33, 23],
                                },
                                {
                                    name: "Option B",
                                    data: [65, 46, 42, 25, 58, 63, 76, 43],
                                },
                            ],
                            legend: {
                                show: !0,
                                fontSize: "14px",
                                fontFamily: "Inter",
                                labels: {
                                    colors: l ? "#CBD5E1" : "#475569"
                                },
                            },
                            yaxis: {
                                show: !1
                            },
                            xaxis: {
                                categories: [
                                    "Battery",
                                    "Brand",
                                    "Camera",
                                    "Memory",
                                    "Storage",
                                    "Display",
                                    "OS",
                                    "Price",
                                ],
                            },
                            fill: {
                                opacity: [1, 0.8]
                            },
                            stroke: {
                                show: !1,
                                width: 0
                            },
                            markers: {
                                size: 0
                            },
                            grid: {
                                show: !1
                            },
                        },
                    },
                    {
                        id: "radialbars",
                        options: {
                            chart: {
                                height: 450,
                                type: "radialBar",
                                toolbar: {
                                    show: !1
                                },
                            },
                            series: [44, 55, 67, 83],
                            plotOptions: {
                                radialBar: {
                                    dataLabels: {
                                        name: {
                                            fontSize: "22px",
                                            color: l ? "#CBD5E1" : "#475569",
                                        },
                                        value: {
                                            fontSize: "16px",
                                            color: l ? "#CBD5E1" : "#475569",
                                        },
                                        total: {
                                            show: !0,
                                            label: "Total",
                                            color: l ? "#CBD5E1" : "#475569",
                                            formatter: function() {
                                                return 249;
                                            },
                                        },
                                    },
                                    track: {
                                        background: "#E2E8F0",
                                        strokeWidth: "97%",
                                    },
                                },
                            },
                            labels: ["A", "B", "C", "D"],
                            colors: ["#4669FA", "#FA916B", "#50C793", "#0CE7FA"],
                        },
                    },
                    {
                        id: "spae-line1",
                        options: {
                            chart: {
                                type: "area",
                                height: 41,
                                width: 121,
                                toolbar: {
                                    autoSelected: "pan",
                                    show: !1
                                },
                                offsetX: 0,
                                offsetY: 0,
                                zoom: {
                                    enabled: !1
                                },
                                sparkline: {
                                    enabled: !0
                                },
                            },
                            series: [{
                                data: [800, 600, 1e3, 800, 600, 1e3, 800, 900]
                            }, ],
                            dataLabels: {
                                enabled: !1
                            },
                            stroke: {
                                curve: "smooth",
                                width: 2
                            },
                            colors: ["#00EBFF"],
                            tooltip: {
                                theme: "light"
                            },
                            grid: {
                                show: !1,
                                padding: {
                                    left: 0,
                                    right: 0
                                }
                            },
                            yaxis: {
                                show: !1
                            },
                            fill: {
                                type: "solid",
                                opacity: [0.1]
                            },
                            legend: {
                                show: !1
                            },
                            xaxis: {
                                low: 0,
                                offsetX: 0,
                                offsetY: 0,
                                show: !1,
                                labels: {
                                    low: 0,
                                    offsetX: 0,
                                    show: !1
                                },
                                axisBorder: {
                                    low: 0,
                                    offsetX: 0,
                                    show: !1
                                },
                            },
                        },
                    },
                    {
                        id: "spae-line2",
                        options: {
                            chart: {
                                type: "area",
                                height: 41,
                                width: 121,
                                toolbar: {
                                    autoSelected: "pan",
                                    show: !1
                                },
                                offsetX: 0,
                                offsetY: 0,
                                zoom: {
                                    enabled: !1
                                },
                                sparkline: {
                                    enabled: !0
                                },
                            },
                            series: [{
                                data: [800, 600, 1e3, 800, 600, 1e3, 800, 900]
                            }, ],
                            dataLabels: {
                                enabled: !1
                            },
                            stroke: {
                                curve: "smooth",
                                width: 2
                            },
                            colors: ["#FB8F65"],
                            tooltip: {
                                theme: "light"
                            },
                            grid: {
                                show: !1,
                                padding: {
                                    left: 0,
                                    right: 0
                                }
                            },
                            yaxis: {
                                show: !1
                            },
                            fill: {
                                type: "solid",
                                opacity: [0.1]
                            },
                            legend: {
                                show: !1
                            },
                            xaxis: {
                                low: 0,
                                offsetX: 0,
                                offsetY: 0,
                                show: !1,
                                labels: {
                                    low: 0,
                                    offsetX: 0,
                                    show: !1
                                },
                                axisBorder: {
                                    low: 0,
                                    offsetX: 0,
                                    show: !1
                                },
                            },
                        },
                    },
                    {
                        id: "spae-line3",
                        options: {
                            chart: {
                                type: "area",
                                height: 41,
                                width: 121,
                                toolbar: {
                                    autoSelected: "pan",
                                    show: !1
                                },
                                offsetX: 0,
                                offsetY: 0,
                                zoom: {
                                    enabled: !1
                                },
                                sparkline: {
                                    enabled: !0
                                },
                            },
                            series: [{
                                data: [800, 600, 1e3, 800, 600, 1e3, 800, 900]
                            }, ],
                            dataLabels: {
                                enabled: !1
                            },
                            stroke: {
                                curve: "smooth",
                                width: 2
                            },
                            colors: ["#5743BE"],
                            tooltip: {
                                theme: "light"
                            },
                            grid: {
                                show: !1,
                                padding: {
                                    left: 0,
                                    right: 0
                                }
                            },
                            yaxis: {
                                show: !1
                            },
                            fill: {
                                type: "solid",
                                opacity: [0.1]
                            },
                            legend: {
                                show: !1
                            },
                            xaxis: {
                                low: 0,
                                offsetX: 0,
                                offsetY: 0,
                                show: !1,
                                labels: {
                                    low: 0,
                                    offsetX: 0,
                                    show: !1
                                },
                                axisBorder: {
                                    low: 0,
                                    offsetX: 0,
                                    show: !1
                                },
                            },
                        },
                    },
                    {
                        id: "wline1",
                        options: {
                            chart: {
                                type: "area",
                                height: 48,
                                width: 48,
                                toolbar: {
                                    autoSelected: "pan",
                                    show: !1
                                },
                                offsetX: 0,
                                offsetY: 0,
                                zoom: {
                                    enabled: !1
                                },
                                sparkline: {
                                    enabled: !0
                                },
                            },
                            series: [{
                                data: [800, 600, 1e3, 800, 600, 1e3, 800, 900]
                            }, ],
                            dataLabels: {
                                enabled: !1
                            },
                            stroke: {
                                curve: "smooth",
                                width: 2
                            },
                            colors: ["#00EBFF"],
                            tooltip: {
                                theme: "light"
                            },
                            grid: {
                                show: !1,
                                padding: {
                                    left: 0,
                                    right: 0
                                }
                            },
                            yaxis: {
                                show: !1
                            },
                            fill: {
                                type: "solid",
                                opacity: [0.1]
                            },
                            legend: {
                                show: !1
                            },
                            xaxis: {
                                low: 0,
                                offsetX: 0,
                                offsetY: 0,
                                show: !1,
                                labels: {
                                    low: 0,
                                    offsetX: 0,
                                    show: !1
                                },
                                axisBorder: {
                                    low: 0,
                                    offsetX: 0,
                                    show: !1
                                },
                            },
                        },
                    },
                    {
                        id: "wline2",
                        options: {
                            chart: {
                                type: "area",
                                height: 48,
                                width: 48,
                                toolbar: {
                                    autoSelected: "pan",
                                    show: !1
                                },
                                offsetX: 0,
                                offsetY: 0,
                                zoom: {
                                    enabled: !1
                                },
                                sparkline: {
                                    enabled: !0
                                },
                            },
                            series: [{
                                data: [800, 600, 1e3, 800, 600, 1e3, 800, 900]
                            }, ],
                            dataLabels: {
                                enabled: !1
                            },
                            stroke: {
                                curve: "smooth",
                                width: 2
                            },
                            colors: ["#FB8F65"],
                            tooltip: {
                                theme: "light"
                            },
                            grid: {
                                show: !1,
                                padding: {
                                    left: 0,
                                    right: 0
                                }
                            },
                            yaxis: {
                                show: !1
                            },
                            fill: {
                                type: "solid",
                                opacity: [0.1]
                            },
                            legend: {
                                show: !1
                            },
                            xaxis: {
                                low: 0,
                                offsetX: 0,
                                offsetY: 0,
                                show: !1,
                                labels: {
                                    low: 0,
                                    offsetX: 0,
                                    show: !1
                                },
                                axisBorder: {
                                    low: 0,
                                    offsetX: 0,
                                    show: !1
                                },
                            },
                        },
                    },
                    {
                        id: "wline3",
                        options: {
                            chart: {
                                type: "area",
                                height: 48,
                                width: 48,
                                toolbar: {
                                    autoSelected: "pan",
                                    show: !1
                                },
                                offsetX: 0,
                                offsetY: 0,
                                zoom: {
                                    enabled: !1
                                },
                                sparkline: {
                                    enabled: !0
                                },
                            },
                            series: [{
                                data: [800, 600, 1e3, 800, 600, 1e3, 800, 900]
                            }, ],
                            dataLabels: {
                                enabled: !1
                            },
                            stroke: {
                                curve: "smooth",
                                width: 2
                            },
                            colors: ["#5743BE"],
                            tooltip: {
                                theme: "light"
                            },
                            grid: {
                                show: !1,
                                padding: {
                                    left: 0,
                                    right: 0
                                }
                            },
                            yaxis: {
                                show: !1
                            },
                            fill: {
                                type: "solid",
                                opacity: [0.1]
                            },
                            legend: {
                                show: !1
                            },
                            xaxis: {
                                low: 0,
                                offsetX: 0,
                                offsetY: 0,
                                show: !1,
                                labels: {
                                    low: 0,
                                    offsetX: 0,
                                    show: !1
                                },
                                axisBorder: {
                                    low: 0,
                                    offsetX: 0,
                                    show: !1
                                },
                            },
                        },
                    },
                    {
                        id: "clmn_chart_1",
                        options: {
                            chart: {
                                height: 48,
                                width: 124,
                                type: "bar",
                                toolbar: {
                                    show: !1
                                },
                                offsetX: 0,
                                offsetY: 0,
                                zoom: {
                                    enabled: !1
                                },
                                sparkline: {
                                    enabled: !0
                                },
                            },
                            series: [{
                                name: "Revenue",
                                data: [40, 70, 45, 100, 75, 40, 80, 90],
                            }, ],
                            plotOptions: {
                                bar: {
                                    columnWidth: "60px",
                                    barHeight: "100%"
                                },
                            },
                            legend: {
                                show: !1
                            },
                            dataLabels: {
                                enabled: !1
                            },
                            stroke: {
                                curve: "smooth",
                                width: 2
                            },
                            fill: {
                                opacity: 1
                            },
                            tooltip: {
                                y: {
                                    formatter: function(e) {
                                        return "$ " + e + "k";
                                    },
                                },
                            },
                            yaxis: {
                                show: !1
                            },
                            xaxis: {
                                show: !1,
                                labels: {
                                    show: !1
                                },
                                axisBorder: {
                                    show: !1
                                },
                                axisTicks: {
                                    show: !1
                                },
                            },
                            colors: r,
                            grid: {
                                show: !1
                            },
                        },
                    },
                    {
                        id: "clmn_chart_2",
                        options: {
                            chart: {
                                height: 48,
                                width: 124,
                                type: "bar",
                                toolbar: {
                                    show: !1
                                },
                                offsetX: 0,
                                offsetY: 0,
                                zoom: {
                                    enabled: !1
                                },
                                sparkline: {
                                    enabled: !0
                                },
                            },
                            series: [{
                                name: "Revenue",
                                data: [40, 70, 45, 100, 75, 40, 80, 90],
                            }, ],
                            plotOptions: {
                                bar: {
                                    columnWidth: "60px",
                                    barHeight: "100%"
                                },
                            },
                            legend: {
                                show: !1
                            },
                            dataLabels: {
                                enabled: !1
                            },
                            stroke: {
                                curve: "smooth",
                                width: 2
                            },
                            fill: {
                                opacity: 1
                            },
                            tooltip: {
                                y: {
                                    formatter: function(e) {
                                        return "$ " + e + "k";
                                    },
                                },
                            },
                            yaxis: {
                                show: !1
                            },
                            xaxis: {
                                show: !1,
                                labels: {
                                    show: !1
                                },
                                axisBorder: {
                                    show: !1
                                },
                                axisTicks: {
                                    show: !1
                                },
                            },
                            colors: i,
                            grid: {
                                show: !1
                            },
                        },
                    },
                    {
                        id: "clmn_chart_3",
                        options: {
                            chart: {
                                height: 48,
                                width: 124,
                                type: "bar",
                                toolbar: {
                                    show: !1
                                },
                                offsetX: 0,
                                offsetY: 0,
                                zoom: {
                                    enabled: !1
                                },
                                sparkline: {
                                    enabled: !0
                                },
                            },
                            series: [{
                                name: "Revenue",
                                data: [40, 70, 45, 100, 75, 40, 80, 90],
                            }, ],
                            plotOptions: {
                                bar: {
                                    columnWidth: "60px",
                                    barHeight: "100%"
                                },
                            },
                            legend: {
                                show: !1
                            },
                            dataLabels: {
                                enabled: !1
                            },
                            stroke: {
                                curve: "smooth",
                                width: 2
                            },
                            fill: {
                                opacity: 1
                            },
                            tooltip: {
                                y: {
                                    formatter: function(e) {
                                        return "$ " + e + "k";
                                    },
                                },
                            },
                            yaxis: {
                                show: !1
                            },
                            xaxis: {
                                show: !1,
                                labels: {
                                    show: !1
                                },
                                axisBorder: {
                                    show: !1
                                },
                                axisTicks: {
                                    show: !1
                                },
                            },
                            colors: s,
                            grid: {
                                show: !1
                            },
                        },
                    },
                    {
                        id: "revenue-barchart",
                        options: {
                            chart: {
                                height: 400,
                                width: "100%",
                                type: "bar",
                                toolbar: {
                                    show: !1
                                },
                            },
                            series: [{
                                    name: "Net Profit",
                                    data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
                                },
                                {
                                    name: "Revenue",
                                    data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
                                },
                                {
                                    name: "Free Cash Flow",
                                    data: [35, 41, 36, 26, 45, 48, 52, 53, 41],
                                },
                            ],
                            plotOptions: {
                                bar: {
                                    horizontal: !1,
                                    endingShape: "rounded",
                                    columnWidth: "45%",
                                },
                            },
                            legend: {
                                show: !0,
                                position: "top",
                                horizontalAlign: "right",
                                fontSize: "12px",
                                fontFamily: "Inter",
                                offsetY: -30,
                                markers: {
                                    width: 8,
                                    height: 8,
                                    offsetY: -1,
                                    offsetX: -5,
                                    radius: 12,
                                },
                                labels: {
                                    colors: l ? "#CBD5E1" : "#475569"
                                },
                                itemMargin: {
                                    horizontal: 18,
                                    vertical: 0
                                },
                            },
                            title: {
                                text: "Revenue Report",
                                align: "left",
                                offsetX: e ? "0%" : 0,
                                offsetY: 13,
                                floating: !1,
                                style: {
                                    fontSize: "20px",
                                    fontWeight: "500",
                                    fontFamily: "Inter",
                                    color: l ? "#fff" : "#0f172a",
                                },
                            },
                            dataLabels: {
                                enabled: !1
                            },
                            stroke: {
                                show: !0,
                                width: 2,
                                colors: ["transparent"]
                            },
                            yaxis: {
                                opposite: e,
                                labels: {
                                    style: {
                                        colors: l ? "#CBD5E1" : "#475569",
                                        fontFamily: "Inter",
                                    },
                                },
                            },
                            xaxis: {
                                categories: [
                                    "Feb",
                                    "Mar",
                                    "Apr",
                                    "May",
                                    "Jun",
                                    "Jul",
                                    "Aug",
                                    "Sep",
                                    "Oct",
                                ],
                                labels: {
                                    style: {
                                        colors: l ? "#CBD5E1" : "#475569",
                                        fontFamily: "Inter",
                                    },
                                },
                                axisBorder: {
                                    show: !1
                                },
                                axisTicks: {
                                    show: !1
                                },
                            },
                            fill: {
                                opacity: 1
                            },
                            tooltip: {
                                y: {
                                    formatter: function(e) {
                                        return "$ " + e + " thousands";
                                    },
                                },
                            },
                            colors: ["#4669FA", "#0CE7FA", "#FA916B"],
                            grid: {
                                show: !0,
                                borderColor: l ? "#334155" : "#E2E8F0",
                                strokeDashArray: 10,
                                position: "back",
                            },
                            responsive: [{
                                breakpoint: 600,
                                options: {
                                    legend: {
                                        position: "bottom",
                                        offsetY: 8,
                                        horizontalAlign: "center",
                                    },
                                    plotOptions: {
                                        bar: {
                                            columnWidth: "80%"
                                        }
                                    },
                                },
                            }, ],
                        },
                    },
                    {
                        id: "radial-bar",
                        options: {
                            chart: {
                                type: "radialBar",
                                height: 360,
                                toolbar: {
                                    show: !1
                                },
                            },
                            series: [44, 55, 67, 83],
                            plotOptions: {
                                radialBar: {
                                    dataLabels: {
                                        name: {
                                            fontSize: "22px",
                                            color: l ? "#CBD5E1" : "#475569",
                                        },
                                        value: {
                                            fontSize: "16px",
                                            color: l ? "#CBD5E1" : "#475569",
                                        },
                                        total: {
                                            show: !0,
                                            label: "Total",
                                            color: l ? "#CBD5E1" : "#475569",
                                            formatter: function() {
                                                return 249;
                                            },
                                        },
                                    },
                                    track: {
                                        background: "#E2E8F0",
                                        strokeWidth: "97%",
                                    },
                                },
                            },
                            labels: ["A", "B", "C", "D"],
                            colors: ["#4669FA", "#FA916B", "#50C793", "#0CE7FA"],
                        },
                    },
                    {
                        id: "radar-home-chart",
                        options: {
                            chart: {
                                height: 320,
                                type: "radialBar",
                                toolbar: {
                                    show: !1
                                },
                            },
                            series: [67],
                            plotOptions: {
                                radialBar: {
                                    startAngle: -135,
                                    endAngle: 135,
                                    dataLabels: {
                                        name: {
                                            fontSize: "22px",
                                            color: l ? "#E2E8F0" : "#475569",
                                        },
                                        value: {
                                            fontSize: "16px",
                                            color: l ? "#E2E8F0" : "#475569",
                                        },
                                        total: {
                                            show: !0,
                                            label: "Total",
                                            color: l ? "#E2E8F0" : "#475569",
                                            formatter: function() {
                                                return 249;
                                            },
                                        },
                                    },
                                },
                            },
                            fill: {
                                type: "gradient",
                                gradient: {
                                    shade: "dark",
                                    shadeIntensity: 0.15,
                                    inverseColors: !1,
                                    opacityFrom: 1,
                                    opacityTo: 1,
                                    stops: [0, 50, 65, 91],
                                },
                            },
                            stroke: {
                                dashArray: 4
                            },
                            colors: ["#4669FA"],
                        },
                    },
                    {
                        id: "visitor-chart",
                        options: {
                            chart: {
                                height: 350,
                                type: "radar",
                                toolbar: {
                                    show: !1
                                },
                                dropShadow: {
                                    enabled: !1,
                                    blur: 8,
                                    left: 1,
                                    top: 1,
                                    opacity: 0.5,
                                },
                            },
                            series: [{
                                    name: "Male",
                                    data: [41, 64, 81, 60, 42, 42, 33, 23],
                                },
                                {
                                    name: "Female",
                                    data: [65, 46, 42, 25, 58, 63, 76, 43],
                                },
                            ],
                            legend: {
                                show: !0,
                                fontSize: "14px",
                                fontFamily: "Inter",
                                labels: {
                                    colors: l ? "#CBD5E1" : "#475569"
                                },
                            },
                            yaxis: {
                                show: !0,
                                labels: {
                                    style: {
                                        colors: l ? "#CBD5E1" : "#475569",
                                        fontFamily: "Inter",
                                    },
                                },
                            },
                            colors: [s, t],
                            xaxis: {
                                categories: [
                                    "2019",
                                    "2020",
                                    "2021",
                                    "2017",
                                    "2018",
                                    "2015",
                                    "2014",
                                    "2013",
                                ],
                                labels: {
                                    style: {
                                        colors: l ? "#CBD5E1" : "#475569"
                                    },
                                },
                            },
                            fill: {
                                opacity: [0.5, 0.5]
                            },
                            stroke: {
                                width: 2
                            },
                            markers: {
                                size: 0
                            },
                            grid: {
                                show: !1
                            },
                        },
                    },
                    {
                        id: "stack-bar-chart",
                        options: {
                            chart: {
                                height: 410,
                                type: "bar",
                                stacked: !0,
                                toolbar: {
                                    show: !1
                                },
                            },
                            series: [{
                                    name: "Sales qualified",
                                    data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
                                },
                                {
                                    name: "Meeting",
                                    data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
                                },
                                {
                                    name: "In negotiation",
                                    data: [35, 41, 36, 26, 45, 48, 52, 53, 41],
                                },
                            ],
                            plotOptions: {
                                bar: {
                                    horizontal: !1,
                                    endingShape: "rounded",
                                    columnWidth: "55%",
                                },
                            },
                            legend: {
                                show: !0,
                                position: "bottom",
                                horizontalAlign: "center",
                                fontSize: "12px",
                                fontFamily: "Inter",
                                offsetY: 0,
                                markers: {
                                    width: 6,
                                    height: 6,
                                    offsetY: 0,
                                    offsetX: -5,
                                    radius: 12,
                                },
                                itemMargin: {
                                    horizontal: 18,
                                    vertical: 0
                                },
                                labels: {
                                    colors: l ? "#CBD5E1" : "#475569"
                                },
                            },
                            dataLabels: {
                                enabled: !1
                            },
                            stroke: {
                                show: !0,
                                width: 2,
                                colors: ["transparent"]
                            },
                            yaxis: {
                                labels: {
                                    style: {
                                        colors: l ? "#CBD5E1" : "#475569",
                                        fontFamily: "Inter",
                                    },
                                },
                            },
                            xaxis: {
                                categories: [
                                    "Feb",
                                    "Mar",
                                    "Apr",
                                    "May",
                                    "Jun",
                                    "Jul",
                                    "Aug",
                                    "Sep",
                                    "Oct",
                                ],
                                labels: {
                                    offsetY: -3,
                                    style: {
                                        colors: l ? "#CBD5E1" : "#475569",
                                        fontFamily: "Inter",
                                    },
                                },
                                axisBorder: {
                                    show: !1
                                },
                                axisTicks: {
                                    show: !1
                                },
                            },
                            fill: {
                                opacity: 1
                            },
                            tooltip: {
                                y: {
                                    formatter: function(e) {
                                        return "$ " + e + " thousands";
                                    },
                                },
                            },
                            colors: [t, r, s],
                            grid: {
                                show: !0,
                                borderColor: l ? "#334155" : "#E2E8F0",
                                strokeDashArray: 10,
                                position: "back",
                            },
                        },
                    },
                    {
                        id: "pie-chart-cal",
                        options: {
                            chart: {
                                height: 335,
                                type: "pie",
                                toolbar: {
                                    show: !1
                                }
                            },
                            labels: ["70% Sent", "18% Opend", "12% Rejected"],
                            dataLabels: {
                                enabled: !0
                            },
                            colors: [i, s, "#A3A1FB"],
                            series: [44, 55, 30],
                            legend: {
                                position: "bottom",
                                fontSize: "12px",
                                fontFamily: "Inter",
                                fontWeight: 400,
                                labels: {
                                    colors: l ? "#CBD5E1" : "#475569"
                                },
                                markers: {
                                    width: 6,
                                    height: 6,
                                    offsetY: -1,
                                    offsetX: -5,
                                    radius: 12,
                                },
                                itemMargin: {
                                    horizontal: 10,
                                    vertical: 0
                                },
                            },
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    legend: {
                                        position: "bottom"
                                    }
                                },
                            }, ],
                        },
                    },
                    {
                        id: "history-chart",
                        options: {
                            chart: {
                                height: 360,
                                type: "area",
                                toolbar: {
                                    show: !1
                                },
                                offsetX: 0,
                                offsetY: 0,
                                zoom: {
                                    enabled: !1
                                },
                            },
                            series: [{
                                    name: "Earnings",
                                    data: [31, 40, 28, 51, 42, 109, 100],
                                },
                                {
                                    name: "Expenses",
                                    data: [11, 32, 45, 32, 34, 52, 41],
                                },
                            ],
                            dataLabels: {
                                enabled: !1
                            },
                            stroke: {
                                curve: "straight",
                                width: 2
                            },
                            colors: [t, s],
                            tooltip: {
                                theme: "dark"
                            },
                            legend: {
                                offsetY: 4,
                                show: !0,
                                fontSize: "12px",
                                fontFamily: "Inter",
                                labels: {
                                    colors: l ? "#CBD5E1" : "#475569"
                                },
                                markers: {
                                    width: 6,
                                    height: 6,
                                    offsetY: 0,
                                    offsetX: -5,
                                    radius: 12,
                                },
                                itemMargin: {
                                    horizontal: 18,
                                    vertical: 0
                                },
                            },
                            grid: {
                                show: !0,
                                borderColor: l ? "#334155" : "#e2e8f0",
                                strokeDashArray: 10,
                                position: "back",
                            },
                            fill: {
                                type: "gradient",
                                gradient: {
                                    shadeIntensity: 0.3,
                                    opacityFrom: 0.4,
                                    opacityTo: 0.5,
                                    stops: [0, 30, 0],
                                },
                            },
                            yaxis: {
                                labels: {
                                    style: {
                                        colors: l ? "#CBD5E1" : "#475569",
                                        fontFamily: "Inter",
                                    },
                                },
                            },
                            xaxis: {
                                type: "datetime",
                                categories: [
                                    "2018-09-19T00:00:00.000Z",
                                    "2018-09-19T01:30:00.000Z",
                                    "2018-09-19T02:30:00.000Z",
                                    "2018-09-19T03:30:00.000Z",
                                    "2018-09-19T04:30:00.000Z",
                                    "2018-09-19T05:30:00.000Z",
                                    "2018-09-19T06:30:00.000Z",
                                ],
                                axisBorder: {
                                    show: !1
                                },
                                axisTicks: {
                                    show: !1
                                },
                                labels: {
                                    style: {
                                        colors: l ? "#CBD5E1" : "#475569",
                                        fontFamily: "Inter",
                                    },
                                },
                            },
                        },
                    },
                    {
                        id: "account-receivable-chart",
                        options: {
                            chart: {
                                height: 300,
                                type: "line",
                                toolbar: {
                                    show: !1
                                },
                                offsetX: 0,
                                offsetY: 0,
                                zoom: {
                                    enabled: !1
                                },
                            },
                            series: [{
                                data: [31, 40, 28, 51, 42, 109, 100]
                            }],
                            dataLabels: {
                                enabled: !1
                            },
                            stroke: {
                                curve: "smooth",
                                width: 2
                            },
                            colors: [s],
                            tooltip: {
                                theme: "dark"
                            },
                            legend: {
                                offsetY: 6,
                                show: !0,
                                labels: {
                                    colors: l ? "#CBD5E1" : "#475569"
                                },
                            },
                            markers: {
                                size: 4,
                                colors: s,
                                strokeColors: s,
                                strokeWidth: 2,
                                shape: "circle",
                                radius: 2,
                                hover: {
                                    sizeOffset: 1
                                },
                            },
                            grid: {
                                show: !0,
                                borderColor: l ? "#334155" : "#e2e8f0",
                                strokeDashArray: 10,
                                position: "back",
                            },
                            yaxis: {
                                labels: {
                                    style: {
                                        colors: l ? "#CBD5E1" : "#475569",
                                        fontFamily: "Inter",
                                    },
                                },
                            },
                            xaxis: {
                                type: "datetime",
                                categories: [
                                    "2018-09-19T00:00:00.000Z",
                                    "2018-09-19T01:30:00.000Z",
                                    "2018-09-19T02:30:00.000Z",
                                    "2018-09-19T03:30:00.000Z",
                                    "2018-09-19T04:30:00.000Z",
                                    "2018-09-19T05:30:00.000Z",
                                    "2018-09-19T06:30:00.000Z",
                                ],
                                labels: {
                                    style: {
                                        colors: l ? "#CBD5E1" : "#475569",
                                        fontFamily: "Inter",
                                    },
                                },
                                axisBorder: {
                                    show: !1
                                },
                                axisTicks: {
                                    show: !1
                                },
                            },
                        },
                    },
                    {
                        id: "payable-chart",
                        options: {
                            chart: {
                                type: "line",
                                height: 300,
                                toolbar: {
                                    show: !1
                                },
                                offsetX: 0,
                                offsetY: 0,
                                zoom: {
                                    enabled: !1
                                },
                            },
                            series: [{
                                data: [31, 40, 28, 51, 42, 109, 100]
                            }],
                            dataLabels: {
                                enabled: !1
                            },
                            stroke: {
                                curve: "smooth",
                                width: 2
                            },
                            colors: [t],
                            tooltip: {
                                theme: "dark"
                            },
                            legend: {
                                offsetY: 6,
                                show: !0,
                                labels: {
                                    colors: l ? "#CBD5E1" : "#475569"
                                },
                            },
                            markers: {
                                size: 4,
                                colors: t,
                                strokeColors: t,
                                strokeWidth: 2,
                                shape: "circle",
                                radius: 2,
                                hover: {
                                    sizeOffset: 1
                                },
                            },
                            grid: {
                                show: !0,
                                borderColor: l ? "#334155" : "#e2e8f0",
                                strokeDashArray: 10,
                                position: "back",
                            },
                            yaxis: {
                                labels: {
                                    style: {
                                        colors: l ? "#CBD5E1" : "#475569",
                                        fontFamily: "Inter",
                                    },
                                },
                            },
                            xaxis: {
                                type: "datetime",
                                categories: [
                                    "2018-09-19T00:00:00.000Z",
                                    "2018-09-19T01:30:00.000Z",
                                    "2018-09-19T02:30:00.000Z",
                                    "2018-09-19T03:30:00.000Z",
                                    "2018-09-19T04:30:00.000Z",
                                    "2018-09-19T05:30:00.000Z",
                                    "2018-09-19T06:30:00.000Z",
                                ],
                                labels: {
                                    style: {
                                        colors: l ? "#CBD5E1" : "#475569",
                                        fontFamily: "Inter",
                                    },
                                },
                                axisBorder: {
                                    show: !1
                                },
                                axisTicks: {
                                    show: !1
                                },
                            },
                        },
                    },
                ],
                n = [{
                        id: "chart1",
                        type: "bar",
                        data: {
                            labels: [
                                "January",
                                "February",
                                "March",
                                "April",
                                "May",
                                "June",
                                "July",
                            ],
                            datasets: [{
                                    label: " data one",
                                    data: [35, 59, 80, 81, 56, 55, 40],
                                    fill: !1,
                                    backgroundColor: n(t, 0.6),
                                    borderColor: t,
                                    borderWidth: 2,
                                    borderRadius: "15",
                                    borderSkipped: "bottom",
                                    barThickness: 25,
                                },
                                {
                                    label: " data two",
                                    data: [24, 42, 40, 19, 86, 27, 90],
                                    fill: !1,
                                    backgroundColor: n(i, 0.8),
                                    borderColor: i,
                                    borderWidth: 2,
                                    borderRadius: "15",
                                    borderSkipped: "bottom",
                                    barThickness: 25,
                                },
                            ],
                        },
                        options: {
                            responsive: !0,
                            plugins: {
                                legend: {
                                    labels: {
                                        color: l ? "#cbd5e1" : "#475569"
                                    },
                                },
                            },
                            scales: {
                                y: {
                                    grid: {
                                        color: l ? "#334155" : "#e2e8f0"
                                    },
                                    ticks: {
                                        color: l ? "#cbd5e1" : "#475569"
                                    },
                                },
                                x: {
                                    grid: {
                                        color: l ? "#334155" : "#e2e8f0"
                                    },
                                    ticks: {
                                        color: l ? "#cbd5e1" : "#475569"
                                    },
                                },
                            },
                            maintainAspectRatio: !1,
                        },
                    },
                    {
                        id: "chart2",
                        type: "bar",
                        data: {
                            labels: [
                                "January",
                                "February",
                                "March",
                                "April",
                                "May",
                                "June",
                                "July",
                            ],
                            datasets: [{
                                label: "Option A",
                                data: [35, 59, 80, 81, 56, 55, 40],
                                fill: !1,
                                backgroundColor: n(t, 0.9),
                                borderWidth: 2,
                                borderColor: "transparent",
                                barThickness: 20,
                            }, ],
                        },
                        options: {
                            responsive: !0,
                            maintainAspectRatio: !1,
                            plugins: {
                                legend: {
                                    labels: {
                                        color: l ? "#cbd5e1" : "#475569"
                                    },
                                },
                            },
                            scales: {
                                y: {
                                    grid: {
                                        color: l ? "#334155" : "#e2e8f0"
                                    },
                                    ticks: {
                                        color: l ? "#cbd5e1" : "#475569"
                                    },
                                },
                                x: {
                                    grid: {
                                        color: l ? "#334155" : "#e2e8f0"
                                    },
                                    ticks: {
                                        color: l ? "#cbd5e1" : "#475569"
                                    },
                                },
                            },
                            indexAxis: "y",
                        },
                    },
                    {
                        id: "chart3",
                        type: "bar",
                        data: {
                            labels: [
                                "January",
                                "February",
                                "March",
                                "April",
                                "May",
                                "June",
                                "July",
                            ],
                            datasets: [{
                                    label: " data one",
                                    data: [35, 59, 80, 81, 56, 55, 40],
                                    fill: !1,
                                    backgroundColor: n(t, 1),
                                    borderColor: t,
                                    borderSkipped: "bottom",
                                    barThickness: 40,
                                },
                                {
                                    label: " data two",
                                    data: [24, 42, 40, 19, 86, 27, 90],
                                    fill: !1,
                                    backgroundColor: n(i, 1),
                                    borderColor: i,
                                    borderSkipped: "bottom",
                                    barThickness: 40,
                                },
                                {
                                    label: " data three",
                                    data: [24, 42, 40, 19, 86, 27, 90],
                                    fill: !1,
                                    backgroundColor: n(a, 1),
                                    borderColor: i,
                                    borderSkipped: "bottom",
                                    barThickness: 40,
                                },
                            ],
                        },
                        options: {
                            responsive: !0,
                            maintainAspectRatio: !1,
                            plugins: {
                                legend: {
                                    labels: {
                                        color: l ? "#cbd5e1" : "#475569"
                                    },
                                },
                            },
                            scales: {
                                x: {
                                    stacked: !0,
                                    grid: {
                                        color: l ? "#334155" : "#e2e8f0"
                                    },
                                    ticks: {
                                        color: l ? "#cbd5e1" : "#475569"
                                    },
                                },
                                y: {
                                    stacked: !0,
                                    grid: {
                                        color: l ? "#334155" : "#e2e8f0"
                                    },
                                    ticks: {
                                        color: l ? "#cbd5e1" : "#475569"
                                    },
                                },
                            },
                        },
                    },
                    {
                        id: "chart4",
                        type: "line",
                        data: {
                            labels: [
                                0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120,
                                130, 140,
                            ],
                            datasets: [{
                                    label: " data one",
                                    data: [
                                        80, 150, 180, 270, 210, 160, 160, 202, 265, 210,
                                        270, 255, 290, 360, 375,
                                    ],
                                    fill: !1,
                                    backgroundColor: n(t, 1),
                                    borderColor: t,
                                    borderSkipped: "bottom",
                                    barThickness: 40,
                                    pointRadius: 1,
                                    pointHoverRadius: 5,
                                    pointHoverBorderWidth: 5,
                                    pointBorderColor: "transparent",
                                    lineTension: 0.5,
                                    pointStyle: "circle",
                                    pointShadowOffsetX: 1,
                                    pointShadowOffsetY: 1,
                                    pointShadowBlur: 5,
                                },
                                {
                                    label: " data two",
                                    data: [
                                        80, 125, 105, 130, 215, 195, 140, 160, 230, 300,
                                        220, 170, 210, 200, 280,
                                    ],
                                    fill: !1,
                                    backgroundColor: n(i, 1),
                                    borderColor: i,
                                    borderSkipped: "bottom",
                                    barThickness: 40,
                                    pointRadius: 1,
                                    pointHoverRadius: 5,
                                    pointHoverBorderWidth: 5,
                                    pointBorderColor: "transparent",
                                    lineTension: 0.5,
                                    pointStyle: "circle",
                                    pointShadowOffsetX: 1,
                                    pointShadowOffsetY: 1,
                                    pointShadowBlur: 5,
                                },
                                {
                                    label: " data three",
                                    data: [
                                        80, 99, 82, 90, 115, 115, 74, 75, 130, 155, 125,
                                        90, 140, 130, 180,
                                    ],
                                    fill: !1,
                                    backgroundColor: n(a, 1),
                                    borderColor: a,
                                    borderSkipped: "bottom",
                                    barThickness: 40,
                                    pointRadius: 1,
                                    pointHoverRadius: 5,
                                    pointHoverBorderWidth: 5,
                                    pointBorderColor: "transparent",
                                    lineTension: 0.5,
                                    pointStyle: "circle",
                                    pointShadowOffsetX: 1,
                                    pointShadowOffsetY: 1,
                                    pointShadowBlur: 5,
                                },
                            ],
                        },
                        options: {
                            responsive: !0,
                            maintainAspectRatio: !1,
                            plugins: {
                                legend: {
                                    labels: {
                                        color: l ? "#cbd5e1" : "#475569"
                                    },
                                },
                            },
                            scales: {
                                y: {
                                    stacked: !0,
                                    grid: {
                                        color: l ? "#334155" : "#e2e8f0"
                                    },
                                    ticks: {
                                        color: l ? "#cbd5e1" : "#475569"
                                    },
                                },
                                x: {
                                    grid: {
                                        color: l ? "#334155" : "#e2e8f0"
                                    },
                                    ticks: {
                                        color: l ? "#cbd5e1" : "#475569"
                                    },
                                },
                            },
                        },
                    },
                    {
                        id: "chart5",
                        type: "radar",
                        data: {
                            labels: [
                                "Eating",
                                "Drinking",
                                "Sleeping",
                                "Designing",
                                "Coding",
                                "Cycling",
                                "Running",
                            ],
                            datasets: [{
                                    label: "My First Dataset",
                                    data: [65, 59, 90, 81, 56, 55, 40],
                                    fill: !0,
                                    backgroundColor: t,
                                    borderColor: t,
                                },
                                {
                                    label: "My Second Dataset",
                                    data: [28, 48, 40, 19, 96, 27, 100],
                                    fill: !0,
                                    backgroundColor: i,
                                    borderColor: i,
                                },
                            ],
                        },
                        options: {
                            responsive: !0,
                            plugins: {
                                legend: {
                                    labels: {
                                        color: l ? "#cbd5e1" : "#475569"
                                    },
                                },
                            },
                            scales: {
                                r: {
                                    ticks: {
                                        display: !1,
                                        maxTicksLimit: 1,
                                        color: l ? "#cbd5e1" : "#475569",
                                    },
                                    grid: {
                                        color: l ? "#334155" : "#e2e8f0"
                                    },
                                    pointLabels: {
                                        color: l ? "#cbd5e1" : "#475569"
                                    },
                                    angleLines: {
                                        color: l ? "#334155" : "#e2e8f0"
                                    },
                                },
                            },
                            maintainAspectRatio: !1,
                        },
                    },
                    {
                        id: "chart6",
                        type: "polarArea",
                        data: {
                            labels: [
                                "primary",
                                "success",
                                "warning-500",
                                "info",
                                "danger",
                            ],
                            datasets: [{
                                label: "My First Dataset",
                                data: [11, 16, 7, 3, 14],
                                backgroundColor: [t, i, s, r, a],
                            }, ],
                        },
                        options: {
                            responsive: !0,
                            plugins: {
                                legend: {
                                    labels: {
                                        color: "#cbd5e1"
                                    }
                                }
                            },
                            scales: {
                                r: {
                                    ticks: {
                                        color: (l, "#475569")
                                    },
                                    grid: {
                                        color: l ? "#334155" : "#e2e8f0"
                                    },
                                    pointLabels: {
                                        color: l ? "#cbd5e1" : "#475569"
                                    },
                                    angleLines: {
                                        color: l ? "#334155" : "#e2e8f0"
                                    },
                                },
                            },
                            maintainAspectRatio: !1,
                        },
                    },
                ],
                d =
                (e.forEach(function(e) {
                        var o = document.getElementById(e.id);
                        o && new ApexCharts(o, e.options).render();
                    }),
                    n.forEach(function(e) {
                        var o = document.getElementById(e.id);
                        o &&
                            new Chart(o, {
                                type: e.type,
                                data: e.data,
                                options: e.options,
                            });
                    }),
                    Math.random().toString(36).substring(2, 15) +
                    Math.random().toString(36).substring(2, 15));
            document.querySelectorAll(".donut-chart").forEach((e, o) => {
                    var t = document.createElement("div"),
                        a =
                        (t.setAttribute("id", "donut-chart" + d + o),
                            e.getAttribute("height") || 200),
                        s = (e.getAttribute("width"), e.getAttribute("colors").split(",")),
                        r = e.getAttribute("hideLabel"),
                        i = e.getAttribute("size") || "40%",
                        e =
                        (e.appendChild(t), {
                            chart: {
                                type: "donut",
                                height: a,
                                toolbar: {
                                    show: !1
                                }
                            },
                            series: [70, 30],
                            labels: ["Complete", "Left"],
                            dataLabels: {
                                enabled: !1
                            },
                            plotOptions: {
                                pie: {
                                    donut: {
                                        size: i,
                                        labels: {
                                            show: !r,
                                            name: {
                                                show: !1,
                                                fontSize: "14px",
                                                fontWeight: "bold",
                                                fontFamily: "Inter",
                                            },
                                            value: {
                                                show: !0,
                                                fontSize: "16px",
                                                fontFamily: "Outfit",
                                                color: l ? "#cbd5e1" : "#0f172a",
                                                formatter(e) {
                                                    return parseInt(e) + "%";
                                                },
                                            },
                                            total: {
                                                show: !0,
                                                fontSize: "10px",
                                                label: "",
                                                formatter() {
                                                    return "70";
                                                },
                                            },
                                        },
                                    },
                                },
                            },
                            colors: [...s],
                            legend: {
                                show: !1
                            },
                        });
                    new ApexCharts(
                        document.querySelector("#donut-chart" + d + o),
                        e
                    ).render();
                }),
                document.querySelectorAll(".bar-chart").forEach((e, o) => {
                    var t = document.createElement("div"),
                        a =
                        (t.setAttribute("id", "barchart" + d + o),
                            e.getAttribute("height") || 200),
                        s =
                        (e.getAttribute("width"),
                            e.getAttribute("colors").split(",")),
                        e =
                        (e.appendChild(t), {
                            chart: {
                                type: "bar",
                                height: a,
                                toolbar: {
                                    show: !1
                                },
                                offsetX: 0,
                                offsetY: 0,
                                zoom: {
                                    enabled: !1
                                },
                                sparkline: {
                                    enabled: !0
                                },
                            },
                            series: [{
                                name: "Revenue",
                                data: [40, 70, 45, 100, 75, 40, 80, 90],
                            }, ],
                            plotOptions: {
                                bar: {
                                    columnWidth: "60px",
                                    barHeight: "100%"
                                },
                            },
                            legend: {
                                show: !1
                            },
                            dataLabels: {
                                enabled: !1
                            },
                            stroke: {
                                curve: "smooth",
                                width: 2
                            },
                            fill: {
                                opacity: 1
                            },
                            tooltip: {
                                y: {
                                    formatter: function(e) {
                                        return "$ " + e + "k";
                                    },
                                },
                            },
                            yaxis: {
                                show: !1
                            },
                            xaxis: {
                                show: !1,
                                labels: {
                                    show: !1
                                },
                                axisBorder: {
                                    show: !1
                                },
                                axisTicks: {
                                    show: !1
                                },
                            },
                            colors: [...s],
                            grid: {
                                show: !1
                            },
                        });
                    new ApexCharts(
                        document.querySelector("#barchart" + d + o),
                        e
                    ).render();
                }),
                document.querySelectorAll(".line-chart").forEach((e, o) => {
                    var t = document.createElement("div"),
                        a =
                        (t.setAttribute("id", "linechart" + d + o),
                            e.getAttribute("height") || 200),
                        s =
                        (e.getAttribute("width"),
                            e.getAttribute("colors").split(",")),
                        e =
                        (e.appendChild(t), {
                            chart: {
                                type: "line",
                                height: a,
                                toolbar: {
                                    show: !1
                                },
                                offsetX: 0,
                                offsetY: 0,
                                zoom: {
                                    enabled: !1
                                },
                                sparkline: {
                                    enabled: !0
                                },
                            },
                            series: [{
                                data: [15, 30, 15, 30, 20, 35]
                            }],
                            stroke: {
                                width: [2],
                                curve: "straight",
                                dashArray: [0, 8, 5],
                            },
                            dataLabels: {
                                enabled: !1
                            },
                            markers: {
                                size: 4,
                                colors: s,
                                strokeColors: s,
                                strokeWidth: 2,
                                shape: "circle",
                                radius: 2,
                                hover: {
                                    sizeOffset: 1
                                },
                            },
                            yaxis: {
                                show: !1
                            },
                            xaxis: {
                                show: !1,
                                labels: {
                                    show: !1
                                },
                                axisBorder: {
                                    show: !1
                                },
                                axisTicks: {
                                    show: !1
                                },
                            },
                            grid: {
                                show: !0,
                                borderColor: l ? "#334155" : "#e2e8f0",
                                strokeDashArray: 5,
                                position: "back",
                                xaxis: {
                                    lines: {
                                        show: !0
                                    }
                                },
                                yaxis: {
                                    lines: {
                                        show: !1
                                    }
                                },
                            },
                            colors: [...s],
                        });
                    new ApexCharts(
                        document.querySelector("#linechart" + d + o),
                        e
                    ).render();
                });
        })(jQuery);
    </script>
@endsection
