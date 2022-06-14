<?php

require_once __DIR__ . '/../../dao/RoleDAO.php';

echo "__DIR__ is :: " . __DIR__;


$roleDAO = new RoleDAO();

$roleDAO->testLogger();
$roleNames = $roleDAO->fetchAll();

print_r($roleNames);

?>
