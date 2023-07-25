<?php require_once('./core/database.php') ?>

<?php
session_start();
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('location: ./');
}

$is_deleted = $database->delete('users', $id);

$is_deleted ? $_SESSION['success'] = SUCCESS : $_SESSION['failure'] = FAILURE;

header('location: ./');
