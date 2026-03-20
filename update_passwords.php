<?php
$hash = password_hash('Password1', PASSWORD_BCRYPT);
echo $hash . PHP_EOL;
var_dump(password_verify('Password1', $hash));
