<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
// 
$db->query("CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', `create_time` datetime DEFAULT NULL COMMENT 'Create Time', `email` varchar(255) DEFAULT NULL, `password` varchar(255) DEFAULT NULL, PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 5 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci", [


]);
$db->query("CREATE TABLE IF NOT EXISTS `notes` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT, `body` varchar(255) NOT NULL, `user_id` int(11) NOT NULL, `timestamp` timestamp NOT NULL DEFAULT current_timestamp(), PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci
", [


]);



header('location: /');
die();

