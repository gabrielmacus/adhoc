<?php
require("/includes/autoload.php");


$employee = new Employee("Macus","Gabriel");

$employeeDao =new EmployeeDAO($db);
echo $employeeDao->upsert($employee);