<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php'); // Ensures logDailyActivity() is loaded

// Access Control
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    try {
        if ($action == 'update') {
            $id = $_POST['book_ammoID'];
            $rounds = $_POST['ammo_rounds'];
            $status = $_POST['ammo_returns'];
            $returned_time = ($status == 'Returned') ? date("F j, Y, g:i a") : ' ';

            $stmt = $pdo->prepare("UPDATE ammo_bookings SET ammo_rounds = ?, ammo_returns = ?, returned_time = ? WHERE book_ammoID = ?");
            $stmt->execute([$rounds, $status, $returned_time, $id]);

            logDailyActivity($pdo, "Updated Booked Ammunition [ ID: " . $id . " ]", '', 'Ammunition Management');   
            echo json_encode(['status' => 'success']);
        }

        if ($action == 'delete') {
            $id = $_POST['book_ammoID'];
            $stmt = $pdo->prepare("DELETE FROM ammo_bookings WHERE book_ammoID = ?");
            $stmt->execute([$id]);
            
            logDailyActivity($pdo, "Deleted Booked Ammunition [ ID: " . $id . " ]", '', 'Ammunition Management');
            echo json_encode(['status' => 'success']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit();
}