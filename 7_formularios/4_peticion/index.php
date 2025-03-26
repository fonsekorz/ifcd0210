<?

$array = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: rgba(117, 116, 116, 0.5);
            background-size: cover;
            color: #ffffff;
            margin: 0;
            padding: 20px;
        }

        .form-container {
            max-width: 400px;
            margin: 20px auto;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }

        .show-result {
            max-width: 400px;
            margin:  auto;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }

        legend {
            font-weight: bold;
            color: #ffcc00;
            margin-bottom: 30px;
            text-shadow: 0 0 5px #000;
        }

        h1 {
            text-align: center;
            color: #ffcc00;
            margin-bottom: 30px;
            text-shadow: 0 0 5px #000;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #ffcc00;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: none;
            background-color: rgba(255, 255, 255, 0.86);
            color: black;
            border-radius: 3px;
            box-sizing: border-box;
        }


        input[type="submit"] {
            margin-top: 20px;
            background-color: #4a6da7;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
            text-transform: uppercase;
            transition: background-color 0.3s;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }

        input[type="submit"]:hover {
            background-color: #5c8bd6;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <section>
        <div class="form-container">
            <form action="./index.php">
                <fieldset>
                    <legend>Formulario</legend>
                    <div class="form-group">
                        <label for="input-text">Introduce Texto:</label>
                        <input type="text" id="input-text" name="input-text">
                        <input type="submit" value="Añadir">
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="show-result">
            <h1>Resultados</h1>
            <div id="new-text">
                
            </div>
        </div>
    </section>
</body>

</html>