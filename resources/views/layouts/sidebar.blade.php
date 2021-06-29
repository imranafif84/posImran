        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
          <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon">
              <img src="{{ asset('backend/img/logo/logo2.png') }}">
            </div>
            <div class="sidebar-brand-text mx-3">POS Imran</div>
          </a>
          <hr class="sidebar-divider my-0">
          <li class="nav-item active">
            <router-link to="/" class="nav-link">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Dashboard</span></router-link>
          </li>
          <li class="nav-item bg-info">
            <router-link to="/pos" class="nav-link">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>POS</span></router-link>
          </li>
          <hr class="sidebar-divider">
          <div class="sidebar-heading">
            Features
          </div>
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmployee"
              aria-expanded="true" aria-controls="collapseEmployee">
              <i class="far fa-fw fa-window-maximize"></i>
              <span>Employees</span>
            </a>
            <div id="collapseEmployee" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Employees</h6>
                <router-link to="/allEmployee" class="collapse-item">All Employees</router-link>
                <router-link to="/createEmployee" class="collapse-item">Add Employee</router-link>
                <router-link to="/allEmpSalary" class="collapse-item">Pay Salaries</router-link>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSupplier"
              aria-expanded="true" aria-controls="collapseSupplier">
              <i class="far fa-fw fa-window-maximize"></i>
              <span>Suppliers</span>
            </a>
            <div id="collapseSupplier" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Suppliers</h6>
                <router-link to="/allSupplier" class="collapse-item">All Suplliers</router-link>
                <router-link to="/createSupplier" class="collapse-item">Add Supllier</router-link>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory"
              aria-expanded="true" aria-controls="collapseCategory">
              <i class="far fa-fw fa-window-maximize"></i>
              <span>Categories</span>
            </a>
            <div id="collapseCategory" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Categories</h6>
                <router-link to="/allCategory" class="collapse-item">All Categories</router-link>
                <router-link to="/createCategory" class="collapse-item">Add Category</router-link>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct"
              aria-expanded="true" aria-controls="collapseProduct">
              <i class="far fa-fw fa-window-maximize"></i>
              <span>Products</span>
            </a>
            <div id="collapseProduct" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Products</h6>
                <router-link to="/allProduct" class="collapse-item">All Products</router-link>
                <router-link to="/createProduct" class="collapse-item">Add Product</router-link>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseExpense"
              aria-expanded="true" aria-controls="collapseExpense">
              <i class="far fa-fw fa-window-maximize"></i>
              <span>Expenses</span>
            </a>
            <div id="collapseExpense" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Expenses</h6>
                <router-link to="/allExpense" class="collapse-item">All Expenses</router-link>
                <router-link to="/createExpense" class="collapse-item">Add Expense</router-link>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCustomer"
              aria-expanded="true" aria-controls="collapseCustomer">
              <i class="far fa-fw fa-window-maximize"></i>
              <span>Customers</span>
            </a>
            <div id="collapseCustomer" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Customers</h6>
                <router-link to="/allCustomer" class="collapse-item">All Customer</router-link>
                <router-link to="/createCustomer" class="collapse-item">Add Customer</router-link>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSalary"
              aria-expanded="true" aria-controls="collapseSalary">
              <i class="far fa-fw fa-window-maximize"></i>
              <span>Salaries</span>
            </a>
            <div id="collapseSalary" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Salaries</h6>
                <router-link to="/allSalary" class="collapse-item">All Salaries</router-link>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrder"
              aria-expanded="true" aria-controls="collapseOrder">
              <i class="far fa-fw fa-window-maximize"></i>
              <span>Orders</span>
            </a>
            <div id="collapseOrder" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Orders</h6>
                <router-link to="/todayOrder" class="collapse-item">Today Orders</router-link>
                <router-link to="/searchOrder" class="collapse-item">Search</router-link>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <router-link to="/allStock" class="nav-link">
              <i class="fab fa-fw fa-wpforms"></i>
              <span>Stocks</span>
            </router-link>
          </li>
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport" aria-expanded="true"
              aria-controls="collapseReport">
              <i class="fas fa-fw fa-table"></i>
              <span>Reports</span>
            </a>
            <div id="collapseReport" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="simple-tables.html">Report One</a>
                <a class="collapse-item" href="datatables.html">Report Two</a>
              </div>
            </div>
          </li>
        </ul>