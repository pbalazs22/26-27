<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row border text-center">
            <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post" enctype="multipart/form-data">
                <h2>Forduló</h2>
                <input type="number" min="1" max="38" name="elsoSzam"><br>
                <h2>Hazai csapat neve</h2>
                <input type="text" name="muvelet"><br>
                <h2>Vendeg csapat neve</h2>
                <input type="text" name="masodikSzam"><br>
                <h2>Hazai gól</h2>
                <input type="number" min="0" max="10" name="hazaiGol"><br>
                <h2>Vendég gól</h2>
                <input type="number" min="0" max="10" name="vendegGol"><br>
                <input type="submit" class="btn btn-primary" name="bekuld">
                <button type="submit" name="mindenMegjelenit" class="btn btn-primary">Mentés</button>

            </form>

        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $elsoSzam = $_POST['elsoSzam'];
        $masodikSzam = $_POST['masodikSzam'];
        $hazaiGol = $_POST['hazaiGol'];
        $vendegGol = $_POST['vendegGol'];

        echo "<p>Forduló: $elsoSzam</p>";
        echo "<p>Vendég csapat: $masodikSzam</p>";
        echo "<p>Hazai gól: $hazaiGol</p>";
        echo "<p>Vendég gól: $vendegGol</p>";

        $file = fopen("focimeccs.txt", "a+");
        if ($file) {
            $sor = "<tr>
        <th>" . $elsoSzam . "</th>
        <th>" . $masodikSzam . "</th>
        <th>" . $hazaiGol . "</th>
        <th>" . $vendegGol . "</th>
    </tr>";
            fwrite($file, $sor);
            fclose($file);
        }
    }

    if (isset($_POST['mindenMegjelenit'])) {
        $file = fopen("focimeccs.txt", "r");
        if ($file) {
            echo "<table class='table table-striped'>";
            echo "<thead><tr><th>Forduló</th><th>Vendég csapat</th><th>Hazai gól</th><th>Vendég gól</th></tr></thead>";
            echo "<tbody>";
            while (($line = fgets($file)) !== false) {
                echo $line;
            }
            echo "</tbody>";
            echo "</table>";
            fclose($file);
        }
    }
    ?>

</body>

</html>