<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Vendor</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    
  <div class="nav-item dropdown text-nowrap">
      <div class="dropdown">
        <a class="nav-link dropdown-toggle px-3" href="#" role="button" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person"></i>
<?php  echo($_SESSION['vendor']);?>
        </a>
        <ul class="dropdown-menu" aria-labelledby="accountDropdown">
          <li><a class="dropdown-item" href="#">My Profile</a></li>
         
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="../signout">Sign out</a></li>
        </ul>
      </div>
    </div>
  </div>

</header>