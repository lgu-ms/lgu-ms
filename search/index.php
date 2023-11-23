<?php
include("../include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-11-22T13:37:36+00:00";
$page_title = "Search - A LGU Management System";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "https://digitalbarangay.com/images/ogimage.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "https://digitalbarangay.com/search";
$page_url = $page_canonical;
$directory = "../";
$directory_img = $directory;
$hideSearchBar = true;

include("../include/header.php");

?>

<body class="d-flex flex-column min-vh-100">

    <?php include("../include/nav.php"); ?>

    <main>

        <div class="container pt-2 pt-xl-5 mb-5">
            <div class="row pt-5">
                <div class="col-12 col-lg-10 mx-auto">

                    <form action="<?php echo $directory; ?>search" method="get">
                        <div class="search-container">
                            <?php
                            if (isset($_GET["q"]) && !empty($_GET["q"])) {
                                echo '<input id="search" placeholder="What are you looking for?" type="text" name="q" value="' . $_GET["q"] . '">';
                            } else {
                                echo '<input id="search" placeholder="What are you looking for?" type="text" name="q">';
                            }
                            ?>

                            <i class="fa-solid fa-magnifying-glass" id="but"></i>
                        </div>
                    </form>
                    <?php
                    if (isset($_GET["q"]) && !empty($_GET["q"])) {
                        echo '<h2 class="mt-4">No results found!</h2><p><a href="https://google.com/search?q=' . $_GET["q"] . '%20site:digitalbarangay.com">search to google instead?</a></p>';
                    }
                    ?>
                </div>
            </div>
        </div>


    </main>

    <?php include("../include/footer.php"); ?>
</body>

</html>