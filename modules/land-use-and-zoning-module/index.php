<?php
include("../../include/session.php");

$page_publisher = "https://github.com/reyes-9";
$page_modified_time = "2023-10-08T13:37:36+00:00";
$page_title = "Land Use and Zoning Module";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/cover.png";
$page_author = "Enzo Reyes";
$page_canonical = "https://digitalbarangay.com/modules/land-use-and-zoning-module/";
$page_url = $page_canonical;
$directory = "../../";
$directory_img = "../../";
$isForm = false;

include("../../include/header.php");

?>

<body class="d-flex flex-column min-vh-100">

  <div class="main vh-100">
    <?php include("../../include/nav.php"); ?>

    <header>
      <div class="container pt-4 pt-xl-5">
        <div class="row pt-5">
          <div class="col-md-8 col-xl-6 text-center text-md-start mx-auto">
            <div class="text-center">
              <h4 style="color: #4285f4;">Digital Barangay</h4>
              <h1 class="fw-bold">Land Use and Zoning Module</h1>
            </div>
          </div>
        </div>
      </div>
    </header>

    <div class="container mt-5" id="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <img src="../../images/landscape.jpg" class="rounded mx-auto d-block img-fluid" alt="Hero Image">
        </div>
        <div class="col-md-6">
          <p>Land use and zoning are terms used in urban planning and development to describe the regulation and organization of land within a municipality, city, or region. These concepts help shape the physical and social structure of communities, ensuring that different areas are used effectively and harmoniously.</p>
          <a href="#sub" class="btn btn-primary shadow px-4" >Get Started</a>
          <a class="accnt px-3" href="../login/index.php" style="margin: 10px;">Login</a>
        </div>
      </div>
    </div>
  </div>

  <!-- management -->
  <div class="container" id="sub">
    <div class="container px-3 py-5">
      <h2 class="pb-2 border-bottom">Land Use and Zoning Module</h2>

      <div class="row row-cols-1 row-cols-md-2 align-items-md-center g-5 py-5">
        <div class="col d-flex flex-column align-items-start gap-2">
          <h2>What it is?</h2>
          <p> Land use refers to how different areas of land are utilized, such as residential, commercial, industrial, recreational, and agricultural purposes. Zoning, a legal tool used by local governments, regulates land use by dividing areas into specific zones with rules on setbacks, building height, density, landscaping, and allowed activities. These regulations ensure organized development, preserve neighborhood character, protect the environment, enhance public safety, and influence property values. Land use and zoning are fundamental in shaping communities, promoting order, and meeting the needs of residents and the environment.</p>
        </div>

        <div class="col">
          <div class="row row-cols-1 row-cols-sm-2 g-4">
            <div class="col d-flex flex-column gap-2">
              <a href="users.php" class="btn btn-primary shadow px-4" >Users</a>
              <h4 class="fw-semibold mb-0">Users</h4>
              <p>People who intends to use the web application</p>
            </div>

            <div class="col d-flex flex-column gap-2">
              <a href="#sub" class="btn btn-primary shadow px-4" >Managers</a>
              <h4 class="fw-semibold mb-0">Managers</h4>
              <p>People who manages the web application.</p>
            </div>

            <div class="col d-flex flex-column gap-2">
              <a href="#sub" class="btn btn-primary shadow px-4" >Visitors</a>
              <h4 class="fw-semibold mb-0">Site Visitors</h4>
              <p>People who intends to view the web application.</p>
            </div>

            <div class="col d-flex flex-column gap-2">
              <a href="#sub" class="btn btn-primary shadow px-4" >Admin</a>
              <h4 class="fw-semibold mb-0">Administrator</h4>
              <p>People who manages and administrate the web application</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- management -->
</body>

<?php include("../../include/footer.php"); ?>

</html>
<?php
    if (!isLogin()) {
        echo '<script> alert("Please login to continue...");</script>';
        echo '<script>window.location.href = "../../login"</script>';
      }
      
?>