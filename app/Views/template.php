<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="static/css/bootstrap.min.css" rel="stylesheet">
  <link href="static/css/style.css" rel="stylesheet">
  <link href="static/css/boxicons.min.css" rel="stylesheet">
</head>

<body id="body">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!--sidebar-->
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
      <button id="sidebarToggleTop" class="btn btn-link menu-close" >
        <img src="static/images/close.png" alt="" width="18">
      </button>
      <!-- logo -->
      <a class="sidebar-brand d-flex align-items-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <img src="static/images/logo.png" class="logo1" />
          <img src="static/images/logo-small.png" class="logo2" />
        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0" />

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="home.php">
          <i class='bx bx-chalkboard'></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link active" href="overview.php"  data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
          <i class='bx bx-spreadsheet'></i>
          <span>CRM</span>
        </a>
        <div class="collapse show" id="home-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" >   <i class='bx bx-search-alt' ></i>CRM Search</a></li>
            <li><a href="#">   <i class='bx bx-bar-chart-square' ></i>Sales Report</a></li>
           
          </ul>

        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="files.php">
          <i class='bx bx-line-chart'></i>
          <span>Reports</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="child-accounts.php">
          <i class='bx bx-cog'></i>
          <span>Administration Tools</span></a>
      </li>

    </ul>
    <!--sodebar-close-->


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">


        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-3 static-top ">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link  rounded-circle mr-3" onclick="toggle()">
            <i class='bx bx-menu'></i>
          </button>

          <!-- Topbar Search -->
          <form class="form-inline me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group search-group ">
              <div class="search-icon">
                <i class='bx bx-search'></i>
              </div>
              <input type="text" class="form-control border-0 small" placeholder="Search for" />
              <button class="btn search-btn">Search</button>

            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ms-auto">
            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                      aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>





            <div class="topbar-divider d-none d-sm-block"></div>

           
             <!-- Nav Item - User Information -->
             <li class="nav-item dropdown no-arrow " type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <a class="nav-link dropdown-toggle">
                <span class="me-2 d-none d-lg-inline text-gray-600 small " >John Doe</span>
                <img class="img-profile rounded-circle " 
                  src="static/images/Max-R_Headshot (1).jpg " />
              </a>
              <!-- Dropdown - User Information -->

            </li>
            <ul class="dropdown-menu " >
              <a class="dropdown-item" href="profile.php">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
              </a>
              <a class="dropdown-item" href="#">
                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Settings
              </a>
              <a class="dropdown-item" href="#">
                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> Activity Log
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
              </a>
            </ul>
        </nav>


        <!-- home-Page-Content -->
        <div class="container-fluid">

     

          <h4 class="mb-0 text-gray-800">CRM Search</h4>
          <nav class="border-bottom">
            <ol class="breadcrumb mt-3">
              <li class="breadcrumb-item"><a href="#"><i class='bx bx-home'></i></a></li>
              <li class="breadcrumb-item active" aria-current="page">CRM</li>
            </ol>
          </nav>

          <div class="filter-sec border-bottom mb-4 pb-3">
            <div class="d-flex mt-3">
              <span for="" class="me-2">Filter:</span>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="filter" value="option1">
                <label class="form-check-label" for="inlineRadio1">District</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="filter" value="option2">
                <label class="form-check-label" for="inlineRadio2">School</label>
              </div>

            </div>

            <div class="row mb-3 mt-3 f-form-row">

              <div class="col-md-2">
                <select name="" id="" class="form-select">
                  <option value="">State</option>
                </select>
              </div>
              <div class="col-md-1">
                <input type="text" class="form-control" placeholder="Region">
              </div>

              <div class="col-md-2">
                <select name="" id="" class="form-select">
                  <option value="">Distcrit</option>
                </select>
              </div>

              <div class="col-md-2">
                <input type="text" class="form-control" placeholder="School">
              </div>
              <div class="col-md-2">
                <input type="text" class="form-control" placeholder="Phone number">
              </div>


              <div class="col-md-3">
                <select name="" id="" class="form-select">
                  <option value="">Pipeline Stage</option>
                </select>
              </div>

            </div>

            <div class="row mb-3">

              <div class="col-md-6">
                <button class="btn btn-primary">Search</button>
              </div>
              <div class="col-md-6 d-flex">
                <div class="ms-auto">
                  <button class="btn btn-light add-btn "><i class='bx bx-plus'></i> Add School</button>
                  <button class="btn btn-light add-btn "> <i class='bx bx-plus'></i>Add District</button>
                </div>

              </div>
            </div>

          </div>
          <!--Close-filter-sec -->



          <!--table-sec-->
          <div class="row">
            <div class="col-md-12">
              
              <!--pagination-->
              <div class="d-flex align-items-center justify-content-end mb-3">            
                <div class="csv border-end me-3 pe-3 d-flex align-items-center">
                  <a href="" class="d-flex text-decoration-none text-dark "><img src="static/images/excel-file.svg" class="me-2"> Export CSV  </a>
                </div>
               
                <select name="" id="" class="form-select me-2 page-count ">
                  <option value="">10</option>
                </select>

                <ul class="pagination mb-0">
                  <li class="page-item"><a class="page-link" href="#"> <img src="static/images/left-arrow-light.svg" alt="">  </a></li>
                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">4</a></li>
                  <li class="page-item"><a class="page-link" href="#">5</a></li>
                  <li class="page-item"><a class="page-link" href="#"><img src="static/images/right-arrow-dark.svg" alt=""> </a></li>
                </ul>
              </div>
         
                <?php
                        // This is the main content partial
                        $this->renderSection('content');
                    ?>
             <!--close-pagination-->
<!-- 
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">State</th>
                    <th scope="col">Region</th>
                    <th scope="col">District</th>static/
                    <th scope="col">School</th>
                    <th scope="col">Pipeline Stage</th>
                    <th scope="col">County</th>
                    <th scope="col">School Count</th>
                    <th scope="col">Student Count</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Sales Rep</th>
                    <th scope="col">Last Touch</th>
                  </tr>
                </thead>static/
                <tbody>
                  <tr>
                    <th scope="row">
                      <input class="form-check-input" type="checkbox">
                    </th>
                    <td>Tx</td>
                    <td>12</td>
                    <td><a href="">Dallas ISD</a></td>
                    <td><a href="">Curtsinger Elementary</a></td>
                    <td>Prospect</td>
                    <td>Collin</td>
                    <td>345</td>
                    <td>444567</td>
                    <td>400-555-5555</td>
                    <td>John Patric</td>
                    <td>05/10/2021</td>

                  </tr>
                  <tr>
                    <th scope="row">
                      <input class="form-check-input" type="checkbox">
                    </th>
                    <td>Tx</td>
                    <td>12</td>
                    <td><a href="">Dallas ISD</a></td>
                    <td><a href="">Curtsinger Elementary</a></td>
                    <td>Prospect</td>
                    <td>Collin</td>
                    <td>345</td>
                    <td>444567</td>
                    <td>400-555-5555</td>
                    <td>John Patric</td>
                    <td>05/10/2021</td>
static/
                  </tr>
                  <tr>
                    <th scope="row">
                      <input class="form-check-input" type="checkbox">
                    </th>
                    <td>Tx</td>
                    <td>12</td>
                    <td><a href="">Dallas ISD</a></td>
                    <td><a href="">Curtsinger Elementary</a></td>
                    <td>Prospect</td>
                    <td>Collin</td>
                    <td>345</td>
                    <td>444567</td>
                    <td>400-555-5555</td>
                    <td>John Patric</td>
                    <td>05/10/2021</td>

                  </tr>
                  <tr>
                    <th scope="row">
                      <input class="form-check-input" type="checkbox">
                    </th>
                    <td>Tx</td>
                    <td>12</td>
                    <td><a href="">Dallas ISD</a></td>
                    <td><a href="">Curtsinger Elementary</a></td>
                    <td>Prospect</td>
                    <td>Collin</td>
                    <td>345</td>
                    <td>444567</td>
                    <td>400-555-5555</td>static/
                    <td>John Patric</td>
                    <td>05/10/2021</td>

                  </tr>
                  <tr>
                    <th scope="row">
                      <input class="form-check-input" type="checkbox">
                    </th>
                    <td>Tx</td>
                    <td>12</td>
                    <td><a href="">Dallas ISD</a></td>
                    <td><a href="">Curtsinger Elementary</a></td>
                    <td>Prospect</td>
                    <td>Collin</td>
                    <td>345</td>
                    <td>444567</td>
                    <td>400-555-5555</td>
                    <td>John Patric</td>
                    <td>05/10/2021</td>

                  </tr>
                  <tr>
                    <th scope="row">
                      <input class="form-check-input" type="checkbox">
                    </th>
                    <td>Tx</td>
                    <td>12</td>static/
                    <td><a href="">Dallas ISD</a></td>
                    <td><a href="">Curtsinger Elementary</a></td>
                    <td>Prospect</td>
                    <td>Collin</td>
                    <td>345</td>
                    <td>444567</td>
                    <td>400-555-5555</td>
                    <td>John Patric</td>
                    <td>05/10/2021</td>

                  </tr>
                  <tr>
                    <th scope="row">
                      <input class="form-check-input" type="checkbox">
                    </th>
                    <td>Tx</td>
                    <td>12</td>
                    <td><a href="">Dallas ISD</a></td>
                    <td><a href="">Curtsinger Elementary</a></td>
                    <td>Prospect</td>
                    <td>Collin</td>
                    <td>345</td>
                    <td>444567</td>
                    <td>400-555-5555</td>
                    <td>John Patric</td>
                    <td>05/10/2021</td>

                  </tr>
                  <tr>
                    <th scope="row">
                      <input class="form-check-input" type="checkbox">
                    </th>
                    <td>Tx</td>
                    <td>12</td>
                    <td><a href="">Dallas ISD</a></td>
                    <td><a href="">Curtsinger Elementary</a></td>
                    <td>Prospect</td>
                    <td>Collin</td>
                    <td>345</td>
                    <td>444567</td>
                    <td>400-555-5555</td>
                    <td>John Patric</td>
                    <td>05/10/2021</td>

                  </tr>
                </tbody>
              </table> -->

              <!--pagination-->
              <div class="d-flex align-items-center justify-content-end">            
                <div class="csv border-end me-3 pe-3 d-flex align-items-center">
                  <a href="" class="d-flex text-decoration-none text-dark "><img src="static/images/excel-file.svg" class="me-2"> Export CSV  </a>
                </div>
               
                <select name="" id="" class="form-select me-2 page-count ">
                  <option value="">10</option>
                </select>

                <ul class="pagination mb-0">
                  <li class="page-item"><a class="page-link" href="#"> <img src="static/images/left-arrow-light.svg" alt="">  </a></li>
                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">4</a></li>
                  <li class="page-item"><a class="page-link" href="#">5</a></li>
                  <li class="page-item"><a class="page-link" href="#"><img src="static/images/right-arrow-dark.svg" alt=""> </a></li>
                </ul>
              </div>
              <!--close-pagination-->
             </div>
          </div>
          <!--close-table-sec-->



        </div>
        <!--Close-home-Page-Content -->

      </div>

    </div>
  </div>
  <!--Close-Page-Wrapper -->

  <script src="static/js/bootstrap.bundle.js"></script>
  <script src="static/js/sidebars.js"></script>
  <script>
    function toggle() {
       var element = document.getElementById("accordionSidebar");
       var body = document.getElementById("body");
       element.classList.toggle("toggled");
       body.classList.toggle("sidebar-toggled");
      
      
    }
    </script>

</body>

</html>