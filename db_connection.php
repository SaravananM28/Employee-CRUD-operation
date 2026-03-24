<?php
$env = parse_ini_file('.env');

$con = mysqli_connect(
    $env['DB_HOST'],
    $env['DB_USER'],
    $env['DB_PASS'],
    $env['DB_NAME']
);

if (mysqli_connect_errno()) {
    echo "Connection Fail: " . mysqli_connect_error();
}
?>