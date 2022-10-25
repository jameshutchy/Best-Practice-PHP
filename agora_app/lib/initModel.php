<?php
session_start();
$id = $_SESSION['id'];
$model->getUserByID($id);
$model->loadBusiness($db);