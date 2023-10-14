<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzabajnok Kezdőlap</title>

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/kezdolap.css">
    <script src="../scripts/jquery.js"></script>

</head>

<body>
    <?php require("../include/navigation.php");  ?>

    <main>
        <h1 id="focim">Üdvözlet<br><a class="pb">A Pizzabajnok </a><br>Web pizzériában!</h1>
        <div class="row">
            <div class="column">
                <table>
                    <tr>
                        <th>
                            <a href="/pages/akciok.php"><img src="../img/Akciokkep.jpg" alt="akciokep" title="akciokep" id="balk"></a>
                        </th>
                    </tr>
                </table>
            </div>
            <div class="column">
                <table>
                    <tr>
                        <th>
                            <a href="/pages/ajanlataink.php"> <img src="../img/Ajanlatokkep.jpg" alt="ajanlatainkkep" title="ajanlatainkkep"></a>
                        </th>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="column">
                <table>
                    <tr>
                        <th>
                            <a href="/pages/elerhetosegeink.php"> <img src="../img/Elerhetosegeinkkep.jpg" alt="elerhetosegeinkkep" title="elerhetosegeinkkep"></a>
                        </th>
                    </tr>
                </table>
            </div>
            <div class="column">
                <table>
                    <tr>
                        <th>
                            <a href="/pages/videok.php"><img src="../img/Videokkep.jpg" alt="videokkep" title="videokkep"></a>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </main>

    <?php require("../include/footer.html"); ?>
</body>

</html>