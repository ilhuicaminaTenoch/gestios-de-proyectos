<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
    <!-- graficas -->
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(columnChart);
    google.charts.setOnLoadCallback(pieChart);

    function columnChart() {

        var data = google.visualization.arrayToDataTable([
            ['Compania', '# Contratistas',  { role: 'annotation' }],
            @foreach($columChart as $keyColumn  => $Column)
                ['{{ $keyColumn }}', {{ $Column }}, '{{ $Column }}'],
            @endforeach
        ]);

        var options = {
            title: 'Distribución Por Compañía', 
            width: 900,
            height: 500,
            bar: {groupWidth: "95%"},
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('columnChart'));
        chart.draw(data, options);
    }

    function pieChart() {
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
            width: 900,
            height: 500
        };

        var chart = new google.visualization.PieChart(document.getElementById('pieChart'));
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
        <td><div id="pieChart"></div></td>
      </tr>
      <tr>
      <td><div id="columnChart"></div></td>
      </tr>
    </table>

</body>

</html>