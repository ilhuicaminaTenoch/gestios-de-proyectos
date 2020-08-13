<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <script src="https://www.google.com/jsapi"></script>
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
    </style>
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
                @foreach($datum as $dato)
                <td>{{ $dato->CONTRATISTAS }}</td>
                <td>{{ $dato->EMPRESA }}</td>
                @endforeach

            </tr>
        </tfoot>
    </table>




    <div id="chartDiv" class="pie-chart"></div>



    <div class="text-center">
        <a href="{{ route('download', ['fechaInicial' => $params['fechaInicial'], 'fechaFinal' => $params['fechaFinal']]) }}">Download PDF File</a>
        <h2>ItSolutionStuff.com.com</h2>
    </div>



    <script type="text/javascript">
    window.onload = function() {
        google.load("visualization", "1.1", {
            packages: ["corechart"],
            callback: 'drawChart'
        });
    };

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Pizza');
        data.addColumn('number', 'Populartiy');
        data.addRows([
            ['Laravel', 33],
            ['Codeigniter', 26],
            ['Symfony', 22],
            ['CakePHP', 10],
            ['Slim', 9]
        ]);

        var options = {
            title: 'Popularity of Types of Framework',
            sliceVisibilityThreshold: .2
        };

        var chart = new google.visualization.PieChart(document.getElementById('chartDiv'));
        chart.draw(data, options);
    }
    </script>

</body>

</html>