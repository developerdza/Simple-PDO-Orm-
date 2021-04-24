<?php
//echo phpinfo();
require_once('DB.php');
require_once('Employee.php');
$emp = EmployeeClass::getByPk(2);
$emp->setName("moa");

var_dump($emp->update());