
<?php

function fetchRole($role){
    include 'connection.php';

    $sql = "SELECT `id` FROM `roles` WHERE `name` = 'client'";
    $result = mysqli_query($db,$sql);

    $role = mysqli_fetch_assoc($result);

    return $role['id'];
}

function isUserExists($email){
    include 'connection.php';

    $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($db, $sql);

    return mysqli_num_rows($result) > 0;
}