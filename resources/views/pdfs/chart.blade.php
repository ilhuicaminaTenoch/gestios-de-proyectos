<html>

<head>
    <style>
    .pie-chart {
        width: 600px;
        height: 400px;
        margin: 0 auto;
    }

    .text-center {
        text-align: center;
    }

    table.paleBlueRows {
        font-family: "Times New Roman", Times, serif;
        border: 1px solid #FFFFFF;
        width: 350px;
        height: 200px;
        text-align: center;
        border-collapse: collapse;
    }

    table.paleBlueRows td,
    table.paleBlueRows th {
        border: 1px solid #FFFFFF;
        padding: 3px 2px;
    }

    table.paleBlueRows tbody td {
        font-size: 13px;
    }

    table.paleBlueRows tr:nth-child(even) {
        background: #D0E4F5;
    }

    table.paleBlueRows thead {
        background: #0B6FA4;
        border-bottom: 5px solid #FFFFFF;
    }

    table.paleBlueRows thead th {
        font-size: 17px;
        font-weight: bold;
        color: #FFFFFF;
        text-align: center;
        border-left: 2px solid #FFFFFF;
    }

    table.paleBlueRows thead th:first-child {
        border-left: none;
    }

    table.paleBlueRows tfoot {
        font-size: 14px;
        font-weight: bold;
        color: #333333;
        background: #D0E4F5;
        border-top: 3px solid #444444;
    }

    table.paleBlueRows tfoot td {
        font-size: 14px;
    }



    table.chart {
        border: 0;
        border-collapse: collapse;
        border-spacing: 0;
        font: 14px/20px Roboto,Noto Sans,Noto Sans JP,Noto Sans KR,Noto Naskh Arabic,Noto Sans Thai,Noto Sans Hebrew,Noto Sans Bengali,sans-serif;
        margin: 16px 0 15px;
        width: 100%;
    }

    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);
    google.charts.setOnLoadCallback(barChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Work', 11],
            ['Eat', 2],
            ['Commute', 2],
            ['Watch TV', 2],
            ['Sleep', 7]
        ]);

        var options = {
            title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }

    function barChart() {
       


        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        
        data.addRows([
            @foreach($pieChart as $key  => $row)
                ['{{ $key }}', {{ $row }}],
            @endforeach
        ]);
  
        var options = {
            title: 'Distribución Por Tipo De Compañía',
            width: 500,
            height: 400
        };

        // Instantiate and draw the chart for Anthony's pizza.
        var chart = new google.visualization.PieChart(document.getElementById('barChart'));
        chart.draw(data, options);
    }
    </script>
</head>

<body>
    <table class="paleBlueRows" align="center">
        <thead>
            <tr>
                <th>Contratistas Totales</th>
                <th>Compañias Totales</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                @foreach($head as $dato)
                <td>{{ $dato->CONTRATISTAS }}</td>
                <td>{{ $dato->EMPRESA }}</td>
                @endforeach

            </tr>
        </tfoot>
    </table>
    

    <table class="chart">
      <tr>
        <td><div id="piechart"></div></td>
        <td><div id="barChart"></div></td>
      </tr>
    </table>






    <div class="text-center">
        <a
            href="{{ route('download', ['fechaInicial' => $params['fechaInicial'], 'fechaFinal' => $params['fechaFinal']]) }}">Descargar Archivo PDF</a>
    </div>
</body>

</html>