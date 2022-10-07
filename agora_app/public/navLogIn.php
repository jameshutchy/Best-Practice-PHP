<?php
$nav= '<div class="row">
    <nav class="navbar navbar-expand-md navbar-light justify-content-end border-top header-footer">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="fas fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav w-100 pt-1 justify-content-start">
            <li class="nav-item rounded-2 active hover">
              <a class="nav-link pr-5 text-dark h5" href="##site##index.php">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item rounded-2 pr-5 hover">
              <a class="nav-link text-dark" href="##site##user.php/allListings/'.$model->getID().'">Listings</a>
            </li>
            <li class="nav-item rounded-2 pr-5 hover">
                <a class="nav-link text-dark" href="activity.php">Activity</a>
              </li>
          </ul>
        </div>
    </nav>
    </div>'
?>