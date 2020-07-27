<!DOCTYPE html>
<html>
    <head>
        <style>
            * {
                font-family: Verdana, Arial, sans-serif;
            }
            @page {
                margin: 0cm 0cm;
            }
            table{
                font-size: x-small;
            }
            tfoot tr td{
                font-weight: bold;
                font-size: x-small;
            }
    
            body {
                margin: 3cm 2cm 2cm;
            }
    
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;
                background-color: #2a0927;
                color: white;
                text-align: center;
                line-height: 30px;
            }
            header img{
                float: left;
                width: 100px;
                height: 80px;
                background: #555;
            }

            header h1 {
                position: relative;
                top: 10px;
                left: 30px;
            }
    
            footer {
                position: fixed;
                bottom: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;
                background-color: #2a0927;
                color: white;
                text-align: center;
                line-height: 35px;
            }
        </style>
    </head>
    <body>
        <header>
            <img src="images/logoUnilever.png" alt="Unilever" height="150">
            <h1>Unilever</h1>
            
        </header>
        @yield('content')
        <footer>
            <h1>https://www.unilever.com.mx/</h1>
        </footer>
    </body>
</html>