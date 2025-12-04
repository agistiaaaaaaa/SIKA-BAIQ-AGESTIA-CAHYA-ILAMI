<?php
$host = getenv('DB_HOST') ?: '127.0.0.1';
$user = getenv('DB_USERNAME') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: '';
$db   = 'sika';

$mysqli = @new mysqli($host, $user, $pass);
if ($mysqli->connect_errno) {
    fwrite(STDERR, "Can not connect to MariaDB/MySQL at $host: " . $mysqli->connect_error . "\n");
    exit(1);
}
$sql = "CREATE DATABASE IF NOT EXISTS `$db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if (!$mysqli->query($sql)) {
    fwrite(STDERR, "Failed to create database: " . $mysqli->error . "\n");
    exit(1);
}
echo "Database '$db' is ready.\n";
$mysqli->close();