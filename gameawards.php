<?php

$godina = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ans = $_POST;

    if (empty($ans["godina"])) {
        echo "<br><br><br>";
        echo "<h5>Godina nije unesena.</h5>";
        echo "<br>";
    } else {
        $godina = $ans["godina"];
        if ($godina >= 2014 && $godina <= 2023) {
            provjera($godina);
        } else {
            echo "<br><br><br>";
            echo "<h5>Unesene godine nije održan Game Awards. Molim unesite godinu između 2014 i 2023.</h5>";
            echo "<br>";
        }
    }
}

function provjera($godina) {
    $xml = simplexml_load_file("pobjednici.xml");
    $found = false;

    foreach ($xml->igra as $game) {
        $year = $game->godina;
        $name = $game->naziv;
        $dev = $game->developer;
        $genre = $game->zanr;

        
        if ($year == $godina) {
            echo "<br><br><br>";
            echo "<h1>Game Awards Winner za godinu $godina</h1>";
            echo "<table class='table'>";
            echo "<thead>";
            echo "<tr><th scope='col'>Pobjednik</th><th scope='col'>Developer</th><th scope='col'>Žanr</th><th scope='col'>Slika</th></tr>";
            echo "</thead>";
            echo "<tbody>";
            echo "<tr>";
            echo "<td>$name</td>";
            echo "<td>$dev</td>";
            echo "<td>$genre</td>";
            echo "<td><img src='" . $game->image . "' alt=''></td>";
            echo "</tr>";
            echo "</tbody>";
            echo "</table>";

            $found = true;
            break;
        }
    }
    

}
?>

<html>
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Awards Winner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        img{
            max-width:300px;
            max-height:300px;
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-danger navbar-dark fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Game Awards pobjednici</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
</nav>
<br>
<br>
<br>
<h5>Unesite godinu održavanja Game Awards-a (2014-2023) kako bi saznali pobjednika.</h5>
<form action="" method="post">
    <table>
        <tr>
            <td><label>Godina:</label></td>
            <td><input id="name" name="godina" type="text"></td>
        </tr>
        <tr>
            <td><input name="submit" type="submit" value="Unesi"></td>
        </tr>
    </table>
</form>
</body>
</html>
