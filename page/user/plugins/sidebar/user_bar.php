<aside class="main-sidebar elevation-4 sidebar-light-primary">

  <a href="production_plan.php" class="brand-link d-flex align-items-center">
    <img src="../../dist/img/shipment.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light p-0" style="color: black;">&ensp;Shipment Control<br>
      &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; System</span>
  </a>

  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
      <div class="image">
        <img src="../../dist/img/user.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="production_plan" class="d-block"><?= htmlspecialchars(strtoupper($_SESSION['username'])); ?></a>
      </div>
    </div>


    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="production_plan.php"
            class="nav-link <?= ($_SERVER['REQUEST_URI'] == "/shipment_control/page/user/production_plan.php") ? 'active' : '' ?>">
            <i class="far fa-chart-bar"></i>
            <p>Production Plan</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="summary.php"
            class="nav-link <?= ($_SERVER['REQUEST_URI'] == "/shipment_control/page/user/summary.php") ? 'active' : '' ?>">
            <i class="fas fa-list"></i>
            <p>Summary</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="masterlist.php"
            class="nav-link <?= ($_SERVER['REQUEST_URI'] == "/shipment_control/page/user/masterlist.php") ? 'active' : '' ?>">
            <i class="fas fa-newspaper"></i>
            <p>Masterlist</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="cost_structure.php"
            class="nav-link <?= ($_SERVER['REQUEST_URI'] == "/shipment_control/page/user/cost_structure.php") ? 'active' : '' ?>">
            <i class="fas fa-dollar-sign"></i>
            <p>Cost Structure</p>
          </a>
        </li>



        <?php include 'logout.php'; ?>
      </ul>
    </nav>

  </div>

</aside>