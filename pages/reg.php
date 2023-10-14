<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!isset($_SESSION)) { 
    session_start(); 
} 
if(isset($_SESSION["username"])){
    header("Location: /index.php"); // ne tudja acceselni az oldalt ha már be van lépve 
} 
$errors = "";
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['vnev'])){
//     Array
// (
//     [vnev] => VEZETEKNEV
//     [knev] => KERESZTNEV
//     [email] => email@email.com
//     [telszam] => 06705586541
//     [kedvpizza] => kedvec pizzák
//     [bemutatkozas] => Ez itt a bemutatkozás
//     [tuhsz] => Telepules, Anyad, 69
//     [szulido] => 2022-04-04
// )
    $vnev = $_POST["vnev"];
    $knev = $_POST["knev"];
    $email = $_POST["email"];
    $telszam = $_POST["telszam"];
    $kedvpizza = $_POST["kedvpizza"];
    $bemutatkozas = $_POST["bemutatkozas"];
    $tuhsz = $_POST["tuhsz"];
    $szulido = $_POST["szulido"];
    $password1 = $_POST["password1"];
    $password2 = $_POST["password2"];

    

    if($password1 != $password2){
        $errors .= "A két jelszó nem egyezik meg!<br>";
    }else{
        if(strlen($password1) < 6){
            $errors .= "A jelszónak hosszabbnak kell lennie 6 karakternél!<br>";
        }
    }

    if(trim($vnev) == "" || trim($knev) == ""){
        $errors .= "Nincs megadva név! <br>";
    }

    if(!strpos($email, '@') || !strpos($email, '.')){
        $errors .= "Helytelen email cím!<br>";
    }

    if(trim($tuhsz) == ""){
        $errors .= "Nincs megadva lakcím!<br>";
    }
    if(trim($telszam) == ""){
        $errors .= "Nem adtál meg telefonszámot!<br>";
    }

    $date_now = new DateTime("now");
    $szuildo_date = new DateTime($szulido);
    if($szuildo_date > $date_now){
        $errors .= "Még meg sem születtél!<br>";
    }
    $interval = date_diff($date_now, $szuildo_date);
    if($interval->y < 18){
        $errors .= "Nem vagy 18 éves!<br>";
    }


    if($errors == ""){// NINCS HIBA
        // megnézzük hogy szabad-e az email
        require_once("../connect/connect.php"); // mysql meghívás
        $stmt = $conn->prepare("SELECT email FROM `accounts` WHERE `email` LIKE :email");
        $stmt->execute(["email" => $email]); 
        $isExists = $stmt->fetchAll();
        if(!$isExists){
            $stmt = $conn->prepare("INSERT INTO `accounts`(`email`, `vezeteknev`, `keresztnev`, `password`, `birth`, `bemutatkozas`, `kedvenc_pizza`, `lakcim`, `telefonszam`) VALUES (:email, :vezeteknev, :keresztnev, :password, :birth, :bemutatkozas, :kedvenc_pizza, :lakcim, :telefonszam)");
            $stmt->execute([
                "email" => $email,
                "vezeteknev" => $vnev,
                "keresztnev" => $knev,
                "password" => password_hash($password1, PASSWORD_DEFAULT),
                "birth" => $szulido,
                "bemutatkozas" => $bemutatkozas,
                "kedvenc_pizza" => $kedvpizza,
                "lakcim" => $tuhsz,
                "telefonszam" => $telszam
            ]);
            $last_id = $conn->lastInsertId(); // idvel biztosabb dolgozni mint emaillal
            $_SESSION["username"] = $email;
            $_SESSION["admin"] = 0;
            $_SESSION["uid"] = $last_id;
            setcookie("username", $email);
            header("Location: /index.php");
        }else{
            //TODO van már ilyen account
            $errors .= "Ezzel az email címmel már regisztráltak!<br>";
        }
        
    }

}

?>


<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzabajnok Regisztráció</title>

    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Finger%20Paint' rel='stylesheet'>
    <link rel="stylesheet" href="../css/main.css">
    <script src="../scripts/jquery.js"></script>
    <link rel="stylesheet" href="../css/mindenes.css">


</head>

<body>
<?php require("../include/navigation.php"); ?>

<main id="container">
        <h1>Regisztráció</h1>
        <h4>Az oldalra regisztrálás követelményei: 18. életév betöltése, jelszó minimális hossza 6 karakter </h4>
        <h2 style="color:red;"><?php echo $errors; ?></h2>
        <form action="/pages/reg.php" method="post">
            <fieldset>
                <legend>Adatok megadása</legend>
                <div class="row">
                    <div class="col-25">
                        <label for="vnev">Vezetéknév</label>
                    </div>
                    <div class="col-60">
                        <input type="text" id="vnev" name="vnev" placeholder="Vezetékneved..." required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="knev">Keresztnév</label>
                    </div>
                    <div class="col-60">
                        <input type="text" id="knev" name="knev" placeholder="Keresztneved.." required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="email">Email cím</label>
                    </div>
                    <div class="col-60">
                        <input type="email" id="email" name="email" placeholder="Email címed.." required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="password1">Jelszó</label>
                    </div>
                    <div class="col-60">
                        <input type="password" id="password1" name="password1" placeholder="Jelszavad" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="password2">Jelszó</label>
                    </div>
                    <div class="col-60">
                        <input type="password" id="password2" name="password2" placeholder="Jelszavad" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="telszam">Telefonszám</label>
                    </div>
                    <div class="col-60">
                        <input type="tel" id="telszam" name="telszam" placeholder="Telefonszám.." required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="kedvpizza">Kedvenc pizzáid</label>
                    </div>
                    <div class="col-60">
                        <textarea id="kedvpizza" name="kedvpizza" placeholder="Írj valamit.."></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="bemutatkozas">Bemutatkozás</label>
                    </div>
                    <div class="col-60">
                        <textarea id="bemutatkozas" name="bemutatkozas" placeholder="Írj valamit.."></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="uhsz">Település, utca, házszám</label>
                    </div>
                    <div class="col-60">
                        <input type="text" id="tuhsz" name="tuhsz" placeholder="Utca, házszám.." required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="birth">Születési idő</label>
                    </div>
                    <div class="col-60">
                        <input type="date" id="birth" name="szulido" placeholder="Írj valamit.." required>
                    </div>
                </div>
            </fieldset>


            <div class="row">
                <input type="submit" value="Regisztráció">
                <input type="reset" value="Adatok alaphelyzetbe állítása">
            </div>
        </form>
    </main>



    <?php require("../include/footer.html"); ?>


</body>

</html>