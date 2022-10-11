<?php
$id = $uri->getID();
$model->getUserByID($id);
$model->loadBusiness($db);