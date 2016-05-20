<?php

//测试类
use Model\UserModel;
require_once './Model/UserModel.class.php';

$use = new UserModel();

$reflect = new ReflectionClass($use);

var_dump($reflect->getFileName());
var_dump($reflect->get);

var_dump($reflect->getDefaultProperties());
