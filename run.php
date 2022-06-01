<?php

include 'class.php';

$cookie = cookie();
$login = login('userid', 'password');
$saldo = saldo();
$mutasi = mutasi('01/05/2022', '10/05/2022');
$logout = logout();

print_r($saldo);
print_r($mutasi);

?>