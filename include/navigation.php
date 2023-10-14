<?php

if(!isset($_SESSION)) { 
    session_start(); 
}

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href='https://fonts.googleapis.com/css?family=Finger%20Paint' rel='stylesheet'>
<style>
    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    nav {
        background-color: #333;
        position: fixed;
        top: 0;
        width: 100%;
        border-radius: 0px !important;
        z-index: 10;
        /* z-index a pizzára ráviszed az egeret ne a nav felett legyen */
    }

    nav a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    nav a:hover {
        transition: 0.5s;
        background-color: #ddd;
        color: black;
    }

    nav a.active {
        background-color: #169b6a;
        color: white;
    }

    nav .icon {
        display: none;
    }

    @media screen and (max-width: 780px) {
        nav a:not(:first-child) {
            display: none;
        }
        nav a.icon {
            float: right;
            display: block;
        }
    }

    @media screen and (max-width: 780px) {
        nav.respons {
            position: relative;
        }
        nav.respons .icon {
            position: absolute;
            right: 0;
            top: 0;
        }
        nav.respons a {
            float: none;
            display: block;
            text-align: left;
        }
    }

    .dropbtn {
        background-color: #169b6a;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    .kosar {
        float: right;
        position: relative;
    }

    .kosar-content {
        display: none;
        position: absolute;
        right: 0;
        background-color: #f9f9f9;
        min-width: 250px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        overflow: hidden;
        max-height: 450px;
        overflow-y: scroll;
    }

    .kosar-content p {
        color: black;
        width: 100%;
        /* padding: 12px 16px; */
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .kosar-content a {
        width: 100%;
    }

    .kosar-content p button {
        background-color: red;
        color: white;
        border: none;
        cursor: pointer;
        display: block;
        margin: auto;
        margin-top: 10px;
        width: 50%;
        transition: background-color 0.3s;
    }

    .kosar-content p button:hover {
        background-color: rgb(165, 0, 0);
    }

    .kosar-content p:hover {
        background-color: #f1f1f1;
    }

    .kosar:hover .kosar-content {
        display: block;
    }

    .kosar:hover .dropbtn {
        background-color: #3e8e41;
    }

    /* Navbar container */

        /* The dropdown container */
        .dropdown {
        float: left;
        overflow: hidden;
        }

        /* Dropdown button */
        .dropdown .dropbtn {
        font-size: 16px;
        border: none;
        outline: none;
        color: white;
        padding: 14px 16px;
        background-color: inherit;
        font-family: inherit; /* Important for vertical align on mobile phones */
        margin: 0; /* Important for vertical align on mobile phones */
        }

        /* Add a red background color to navbar links on hover */
        .navbar a:hover, .dropdown:hover .dropbtn {
        background-color: red;
        }

        /* Dropdown content (hidden by default) */
        .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
        float: none;
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
    }

    /* Add a grey background color to dropdown links on hover */
    .dropdown-content a:hover {
    background-color: #ddd;
    }

    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {
    display: block;
    }
</style>
<nav>
    <a class="<?php print($_SERVER['PHP_SELF'] == "/pages/kezdolap.php" ? "active" : ""); ?>" href="/pages/kezdolap.php"><i class="fa fa-home"></i> Kezdőlap</a>
    <a class="<?php print($_SERVER['PHP_SELF'] == "/pages/akciok.php" ? "active" : ""); ?>" href="/pages/akciok.php"><i class="fa fa-percent"></i> Akciók</a>
    <a class="<?php print($_SERVER['PHP_SELF'] == "/pages/ajanlataink.php" ? "active" : ""); ?>" href="/pages/ajanlataink.php"><i class="fa fa-envelope"></i> Ajánlataink</a>
    <a class="<?php print($_SERVER['PHP_SELF'] == "/pages/elerhetosegeink.php" ? "active" : ""); ?>" href="/pages/elerhetosegeink.php"><i class="fa fa-address-card"></i> Elérhetőségeink</a>
    <a class="<?php print($_SERVER['PHP_SELF'] == "/pages/videok.php" ? "active" : ""); ?>" href="/pages/videok.php"><i class="fa fa-video"></i> Videóink</a>
        
    <?php 
        if(isset($_SESSION["admin"])) 
            if($_SESSION["admin"] > 0) : 
        
    ?>
        <a class="<?php print($_SERVER['PHP_SELF'] == "/pages/admin.php" ? "active" : ""); ?>" href="/pages/admin.php"><i class="fa fa-users-gear"></i> Admin panel</a>
    <?php endif; ?>
    <?php 
        if(isset($_SESSION["username"])) :
    ?>
        <div class="dropdown">
            <button class="dropbtn">Felhasználói funkciók
            <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
            <a class="<?php print($_SERVER['PHP_SELF'] == "/pages/uzenetkuldes.php" ? "active" : ""); ?>" href="/pages/uzenetkuldes.php">Üzenetküldés</a>
            <a class="<?php print($_SERVER['PHP_SELF'] == "/pages/profil.php" ? "active" : ""); ?>" href="/pages/profil.php">Saját profil</a>
            <a class="<?php print($_SERVER['PHP_SELF'] == "/pages/felhasznkeres.php" ? "active" : ""); ?>" href="/pages/felhasznkeres.php">Felhasználó kereső</a>
            <a class="<?php print($_SERVER['PHP_SELF'] == "/pages/rendelesek.php" ? "active" : ""); ?>" href="/pages/rendelesek.php">Rendeléseim</a>
            <a class="<?php print($_SERVER['PHP_SELF'] == "/pages/logout.php" ? "active" : ""); ?>" href="/logout.php">Kijelentkezés</a>
            </div>
        </div>
        <a href="javascript:void(0);" class="icon" onclick="burgermenu()">
            <i class="fa fa-bars"></i>
        </a>
        <div class="kosar">
            <button class="dropbtn">Kosár
                <i class="fa fa-basket-shopping"></i>
            </button>
            <div class="kosar-content" id="kosar-content-append">
                <?php 
                    require_once("../connect/connect.php");
                    $stmt = $conn->prepare("SELECT pizzak.id, pizzak.nev, kosar.db FROM `kosar` INNER JOIN pizzak ON kosar.pizzaid = pizzak.id WHERE kosar.kinel = :kinel");
                    $stmt->execute(["kinel" => $_SESSION["uid"]]); 
                    $kosar = $stmt->fetchAll();
                    if($kosar !== false){
                        foreach ($kosar as $k) {
                            print('<p id="kosar_pizza_'. $k["id"] .'"><i class="fa-solid fa-pizza-slice"></i> '. $k["nev"] .' <br>
                            Mennyiség: <input type="number" name="pizza_'. $k["id"] .'" onchange="pizza.modifyKosar('. $k["id"] .',this.value)" id="pizza_input_'. $k["id"] .'" value="'. $k["db"] .'"  min="1" max="99">
                            <button onclick="pizza.torolkosar('. $k["id"] .')">Törlés</button>
                            <hr>
                            </p>');
                        }
                    }
                ?>
                <a href="/pages/szamla.php" id="rendelesButton"> Rendelés </a>
            </div>
        </div>
    <?php
        else :  
    ?>
        <div class="kosar">
            <a class="<?php print($_SERVER['PHP_SELF'] == "/pages/reg.php" ? "active" : ""); ?>" href="/pages/reg.php"><i class="fa fa-user-pen"></i>  Regisztráció</a>
            <a class="<?php print($_SERVER['PHP_SELF'] == "/pages/login.php" ? "active" : ""); ?>" href="/pages/login.php"><i class="fa fa-right-to-bracket"></i>  Bejelentkezés</a>
        </div>
    <?php endif; ?>
</nav>

<script src="../scripts/nav.js"></script>
<script src="../scripts/pizzak.js?v=6"></script>