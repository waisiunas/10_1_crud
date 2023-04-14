<?php require_once('./database/connection.php'); ?>

<?php
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $sql = "DELETE FROM `users` WHERE `id` = $id";
    if($conn->query($sql)) {
        header('location: ./index.php');
    } else {
        echo 'Failed to delete!';
    }
} else {
    header('location: ./index.php');
}

?>