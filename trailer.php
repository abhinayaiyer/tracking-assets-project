<?php
        include_once 'config.php';
global $db;
global $get_users;
        $get_users=$db->prepare('SELECT assetID FROM main WHERE asset_type="Trailer" ');
        $get_users->execute();
        $users = $get_users->fetchAll();
foreach ($users as $user) {
    echo $user['assetID'] . '<br />';
}
?>