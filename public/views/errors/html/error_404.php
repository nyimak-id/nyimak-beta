<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman yang Anda cari tidak ada (404) - Nyimak.ID - Make Me Happy</title>
    <link rel="icon" href="">
    <style>

        ::selection{ background-color: #E13300; color: white; }
        ::moz-selection{ background-color: #E13300; color: white; }
        ::webkit-selection{ background-color: #E13300; color: white; }

        body {
            background-color: #690000;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
            margin: 0 auto;
            width: 100%;
        }

        a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
        }

        h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 19px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }

        code {
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            background-color: #f9f9f9;
            border: 1px solid #D0D0D0;
            color: #002166;
            display: block;
            margin: 14px 0 14px 0;
            padding: 12px 10px 12px 10px;
        }

        #container {
            border: 1px solid #D0D0D0;
            -webkit-box-shadow: 0 0 8px rgb(60, 54, 54);
            background: #fff;
            width: 30%;
            text-align: center;
            margin: 0 auto;
            margin-top: 20px;
        }

        p {
            margin: 12px 15px 12px 15px;
        }
        .logo{
            margin-top: 170px;
            margin: 0 auto;
            text-align: center;
            margin-top: 50px;
        }
        .button.danger {
            background-color: #9a1616 !important;
            color: #ffffff !important;
            margin-bottom: 15px;
            margin-top: 15px;
        }
        .button {
            padding: 11px 19px;
            text-align: center;
            vertical-align: middle !important;
            background-color: #d9d9d9;
            border: 1px transparent solid;
            color: #222222;
            border-radius: 0;
            cursor: pointer;
            display: inline-block;
            outline: none;
            font-family: 'Segoe UI Light_', 'Open Sans Light', Verdana, Arial, Helvetica, sans-serif;
            font-size: 17.5px;
            line-height: 16px;
            margin: auto;
        }
    </style>
    <script>
        function goBack() {
            window.history.back()
        }
    </script>
</head>
<body>
<div class="logo" style="margin-top: 150px"><img src="<?php echo $base_url = load_class('Config')->config['base_url']; ?>resources/images/logo-dashboard.png" style="width: 320px"></div>
<div id="container">
    <h1>404 Page Not Found</h1>
    <p>The page you requested was not found.</p>
    <button onclick="goBack()" class="button danger">Kembali</button>
</div>
</body>
</html>