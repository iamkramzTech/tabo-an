 <!-- Navigation-->
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="index">TABOAN</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index">Home</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="about" rel="noopener" target="_blank">About</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Shop</a></li>
            <!-- <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                id="navbarDropdown"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                >Shop</a
              >
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">All Products</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
              </ul> -->
            </li>
          </ul>
          <!-- <form class="d-flex">
            <button class="btn btn-outline-dark" type="submit">
              <i class="bi-cart-fill me-1"></i>
              Cart
              <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
            </button>
          </form> -->

          <!-- Search Bar -->
          <form class="d-flex">
            <input
              class="form-control me-2"
              type="text"
              placeholder="Search"
              aria-label="Search"
            />
            <button class="btn btn-outline-dark" type="submit">
              <i class="bi-search"></i>
            </button>
          </form>
          <div class="d-flex ms-3">
            <?php
            if(isset($_SESSION['customer']))
            {
              $stmt = $dbConn->prepare("SELECT * FROM users WHERE user_id=:user_id AND user_role=:user_role");
              $stmt->bindParam(':user_id',$_SESSION['customer'],PDO::PARAM_INT);
              $stmt->bindValue(':user_role',2,PDO::PARAM_INT);
              $stmt->execute();
              $userLogin = $stmt->fetch(PDO::FETCH_ASSOC);
              echo'
              <div class="dropdown">
              <button class="btn btn-outline-dark dropdown-toggle" type="button" id="cartDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi-cart-fill me-1"></i>
                  Cart
                  <span class="badge bg-dark text-white ms-1 rounded-pill" id="cartItemCount">0</span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="cartDropdown">
                  <!-- Cart items go here -->
                  <li><a class="dropdown-item" href="#">Item 1</a></li>
                  <li><a class="dropdown-item" href="#">Item 2</a></li>
                  <!-- Add more items dynamically based on the cart content -->
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="cart-view">View All</a></li>
              </ul>
          </div>
            <button class="btn btn-outline-dark ms-2" type="button">
            <a href="customer-profile" class="nav-link"><i class="bi-person"></i>'. $userLogin['first_name'].'</a>
            </button>
            ';
            }
            else
            {
              echo'
              <button class="btn btn-outline-dark ms-2" type="button">
             <a href="my-account" class="nav-link"><i class="bi-person"></i> Account</a>
            </button>
            ';
            }
            ?>
          </div>
        </div>
      </div>
    </nav>