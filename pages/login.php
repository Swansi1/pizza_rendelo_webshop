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
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])){
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

    $email = $_POST["email"];
    $password1 = $_POST["password1"];


    if(trim($password1) == ""){
        $errors .= "Nem lehet üres a jelszó! <br>";
    }
    if(trim($email) == ""){
        $errors .= "Nem lehet üres az email! <br>";
    }

    if(!strpos($email, '@') || !strpos($email, '.')){
        $errors .= "Helytelen email cím!<br>";
    }

    if($errors == ""){// NINCS HIBA
        // megnézzük hogy van-e ilyen felhasználó regisztrálva
        require_once("../connect/connect.php"); // mysql meghívás
        $stmt = $conn->prepare("SELECT id,email,password,admin,blocked FROM `accounts` WHERE `email` LIKE :email");
        $stmt->execute(["email" => $email]); 
        $isExists = $stmt->fetch();
        if($isExists["blocked"] == 0){
            if($isExists && password_verify($password1, $isExists["password"])){
                $_SESSION["username"] = $email;
                $_SESSION["admin"] = $isExists["admin"];
                $_SESSION["uid"] = $isExists["id"];
                setcookie("username", $email);
                header("Location: /index.php");
            }else{
                //TODO nincs ilyen felhasználó
                // print_r($errors);
                $errors = "Hibás felhasználónév vagy jelszó!";
                // header("Location: /pages/login.php?errmsg=hibás felhasználónév vagy jelszó!");
            }
        }else{
            $errors = "A felhasználó blokkolva lett!";
        }
    }else{
        header("Location: /pages/login.php?errmsg=". urlencode($errors));
    }

}

?>


<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzabajnok Bejelentkezés</title>

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
        <h1>Bejelentkezés</h1>
        <form action="/pages/login.php" method="post">
            <fieldset>
                <h2 style="color:red;"><?php print($errors) ?></h2>
                <legend>Adatok megadása</legend>
                
                <div class="row">
                    <div class="col-25">
                        <label for="email">Email cím</label>
                    </div>
                    <div class="col-60">
                        <input type="email" id="email" name="email" value="
                            <?php 
                                if(isset($_COOKIE["username"])){
                                    echo $_COOKIE["username"];
                                }
                            ?>
                        " placeholder="Email címed.." required>
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
            </fieldset>


            <div class="row">
                <input type="submit" value="Bejelentkezés">
            </div>
        </form>
    </main>



    <?php require("../include/footer.html"); ?>


</body>

</html>