<?php
        $role = $model->getRole();
        if ($role == 'admin'){
          include_once 'public/adminProfile.php';
          include_once 'public/navAdmin.php';
        }
        else {
          include_once 'public/userProfile.php';
          include_once 'public/navLogIn.php';
        }
