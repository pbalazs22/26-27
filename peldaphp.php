<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?>" method="post" enctype="multipart/form-data">
        <label for="">Első szám</label>
        <input type="number" name="elsoSzam"><br>
        <label for="">Művelet</label>
        <input type="text" name="muvelet"><br>
        <label for="">Második szám</label>
        <input type="number" name="masodikSzam"><br>
        <input type="submit" name="bekuld">
        
    </form>

    <?php

        $elsoSzam = 0;
        $muvelet = "";
        $masodikSzam = 0;

        if(htmlspecialchars($_REQUEST["elsoSzam"]))
        {
            $elsoSzam = (int)$_REQUEST["elsoSzam"];
        }
        if(htmlspecialchars($_REQUEST["masodikSzam"]))
        {
            $masodikSzam = (int)$_REQUEST["masodikSzam"];
        }
        if(htmlspecialchars($_REQUEST["muvelet"]))
        {
            $muvelet = $_REQUEST["muvelet"];
        }

        echo $elsoSzam . $muvelet . $masodikSzam . "<br>";
        
        $eredmeny = 0;

        if($muvelet == "+")
        {
            $eredmeny = $elsoSzam + $masodikSzam;
        }
        if($muvelet == "-")
        {
            $eredmeny = $elsoSzam - $masodikSzam;
        }
        if($muvelet == "*" || $muvelet == "X" )
        {
            $eredmeny = $elsoSzam * $masodikSzam;
        }
        if($muvelet == "/")
        {
            $eredmeny = $elsoSzam / $masodikSzam;
        }

        $file = fopen("szamolasok.txt","a+");

        $sor = $elsoSzam . $muvelet . $masodikSzam . "=" . $eredmeny . "\n";
        fwrite($file,$sor);

        fclose($file);

        phpinfo(32);

    ?>

</body>
</html>