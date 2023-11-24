<?php
include("../../include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-11-22T13:37:36+00:00";
$page_title = "Solid Waste Management";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/cover.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/modules/solid-waste-management-module/";
$page_url = $page_canonical;
$directory = "../../";
$directory_img = "../";
$recaptcha = true;

include("../../include/header.php");

?>

<body class="d-flex flex-column min-vh-100">

    <?php include("../../include/nav.php"); ?>

    <main>
        <div class="container pt-4 pt-xl-5 mb-5">
            <div class="row g-0">
            <div class="col-md-4 p-3">
                <button class="btn btn-primary px-5 mt-5">Add Data</button>
                </div>
                <div class="col-md-8 p-3">
                    
                    <form action="<?php htmlspecialchars('php_self'); ?>" method="get">
                        <div class="search-container mt-5">
                            <?php
                            if (isset($_GET["q"]) && !empty($_GET["q"])) {
                                echo ' <input id="search" placeholder="Search documents/records..." type="text" name="q" value="' . $_GET["q"] . '">';
                            } else {
                                echo ' <input id="search" placeholder="Search documents/records..." type="text" name="q">';
                            }
                            ?>

                            <i class="fa-solid fa-magnifying-glass" id="but"></i>
                        </div>
                    </form>
                </div>
            </div> 
            <table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Waste Generation Area</th>
      <th scope="col">No. Trucks</th>
      <th scope="col">Estimate Waste Collected</th>
      <th scope="col">Collection Date</th>
      <th scope="col">Transport to</th>
      <th scope="col">Processing</th>
      <th scope="col">Update on</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Payatas</td>
      <td>2</td>
      <td>2 tons</td>
      <td>8-23-2023</td>
      <td>Bulacan</td>
      <td>Anaerobic Digester</td>
      <td>2 minutes ago</td>
      <td><i class="fa-solid fa-pen-to-square"></i> &nbsp; <i class="fa-solid fa-trash"></i></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Novaliches</td>
      <td>2</td>
      <td>2 tons</td>
      <td>9-23-2023</td>
      <td>Payatas</td>
      <td>Compost</td>
      <td>2 minutes ago</td>
      <td><i class="fa-solid fa-pen-to-square"></i> &nbsp; <i class="fa-solid fa-trash"></i></td>
    
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Tandang Sora</td>
      <td>2</td>
      <td>2 tons</td>
      <td>10-23-2023</td>
      <td>Payatas</td>
      <td>Incineration</td>
      <td>2 minutes ago</td>
      <td><i class="fa-solid fa-pen-to-square"></i> &nbsp; <i class="fa-solid fa-trash"></i></td>
    
    </tr>
    <tr>
      <th scope="row">4</th>
      <td>North Fairview</td>
      <td>2</td>
      <td>2 tons</td>
      <td>11-23-2023</td>
      <td>Payatas</td>
      <td>Sanitary Landfill</td>
      <td>2 minutes ago</td>
      <td><i class="fa-solid fa-pen-to-square"></i> &nbsp; <i class="fa-solid fa-trash"></i></td>
    
    </tr>
  </tbody>
</table>
        </div>
    </main>
    <?php include("../../include/footer.php"); ?>
</body>

</html>