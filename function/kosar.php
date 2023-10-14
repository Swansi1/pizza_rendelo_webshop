<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(!isset($_SESSION)) { 
    session_start(); 
} 
if(!isset($_SESSION["username"])){
   die("Előbb be kéne jelentkezni");
} 

require_once("../connect/connect.php");

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['method'])){
    $method = $_POST["method"];
    if($method == "addkosar"){
        if(isset($_POST["pizzaid"]) && isset($_POST["pizzadb"])){
            $stmt = $conn->prepare("SELECT * FROM `kosar` WHERE `kinel` = :kinel AND `pizzaid` = :pizzaid");
            $stmt->execute(["kinel" => $_SESSION["uid"], "pizzaid" => $_POST["pizzaid"]]); 
            $pizza = $stmt->fetch();
            if($pizza !== false){
                // már van ilyen a kosarában
                $stmt = $conn->prepare("UPDATE `kosar` SET `db` = :pizzadb WHERE `kosar`.`pizzaid` = :pizzaid AND `kinel` = :ki");
                $stmt->execute([
                    "pizzadb" => $_POST["pizzadb"],
                    "pizzaid" => $_POST["pizzaid"],
                    "ki" => $_SESSION["uid"],
                ]);
            }else{
                $stmt = $conn->prepare("INSERT INTO `kosar` (`kinel`, `pizzaid`, `db`) VALUES (:ki, :pizzaid, :pizzadb);");
                $stmt->execute([
                    "ki" => $_SESSION["uid"],
                    "pizzaid" => $_POST["pizzaid"],
                    "pizzadb" => $_POST["pizzadb"]
                ]);
            } 
        }
    }elseif ($method == "removekosar") {
        if(isset($_POST["pizzaid"])){
            $stmt = $conn->prepare("DELETE FROM `kosar` WHERE `kosar`.`pizzaid` = :pizzaid AND `kinel` = :ki");
            $stmt->execute([
                "pizzaid" => $_POST["pizzaid"],
                "ki" => $_SESSION["uid"],
            ]);
        }
    }
}

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['method'])){
    $method = $_GET["method"];
    if($method == "getPizzaById"){
        if(isset($_GET["pizzaid"])){
            $stmt = $conn->prepare("SELECT * FROM `pizzak` WHERE `id` = :pizzaid");
            $stmt->execute(["pizzaid" => $_GET["pizzaid"]]); 
            $pizza = $stmt->fetch();
            if($pizza !== false){
                print_r(json_encode($pizza, JSON_UNESCAPED_UNICODE));
            }
        }
    }
}

?>