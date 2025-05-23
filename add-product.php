<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['aid'] == 0)) {
    header('location:logout.php');
} else {
    // Add product Code
    if (isset($_POST['submit'])) {
        //Getting Post Values
        $catname = $_POST['category'];
        $company = $_POST['company'];
        $pname = $_POST['productname'];
        $pprice = $_POST['productprice'];
        $quantity = $_POST['quantity'];
        $subcategory = $_POST['subcategory'];

        $query = mysqli_query($con, "INSERT INTO tblproducts(CategoryName, CompanyName, ProductName, ProductPrice, Quantity, SubCategory) 
        VALUES('$catname','$company','$pname','$pprice','$quantity','$subcategory')");
        if ($query) {
            echo "<script>alert('Product added successfully.');</script>";
            echo "<script>window.location.href='add-product.php'</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
            echo "<script>window.location.href='add-product.php'</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Add Product</title>
    <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div class="hk-wrapper hk-vertical-nav">

        <?php include_once('includes/navbar.php');
        include_once('includes/sidebar.php'); ?>

        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>

        <div class="hk-pg-wrapper">
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Product</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>

            <div class="container">
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span>Add Product</h4>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">

                            <div class="row">
                                <div class="col-sm">
                                    <form class="needs-validation" method="post" novalidate>

                                        <div class="form-row">
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom03">Category</label>
                                                <select class="form-control custom-select" name="category" required>
                                                    <option value="">Select category</option>
                                                    <?php
                                                    $ret = mysqli_query($con, "SELECT DISTINCT CategoryName FROM tblcategory");
                                                    while ($row = mysqli_fetch_array($ret)) {
                                                    ?>
                                                        <option value="<?php echo $row['CategoryName']; ?>"><?php echo $row['CategoryName']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback">Please select a category.</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom03">Sub-category</label>
                                                <select class="form-control custom-select" name="subcategory" required>
                                                    <option value="">Select Sub-category</option>
                                                    <option value="Full Cream">Full Cream</option>
                                                    <option value="Toned">Toned</option>
                                                    <option value="Double Toned">Double Toned</option>
                                                    <option value="Skimmed">Skimmed</option>
                                                </select>
                                                <div class="invalid-feedback">Please select a sub-category.</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom03">Company</label>
                                                <select class="form-control custom-select" name="company" required>
                                                    <option value="">Select Company</option>
                                                    <?php
                                                    $ret = mysqli_query($con, "SELECT DISTINCT CompanyName FROM tblcompany");
                                                    while ($row = mysqli_fetch_array($ret)) {
                                                    ?>
                                                        <option value="<?php echo $row['CompanyName']; ?>"><?php echo $row['CompanyName']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback">Please select a company.</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom03">Product Name</label>
                                                <input type="text" class="form-control" id="validationCustom03" placeholder="Product Name" name="productname" required>
                                                <div class="invalid-feedback">Please provide a valid product name.</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom03">Product Price</label>
                                                <input type="text" class="form-control" id="validationCustom03" placeholder="Product Price" name="productprice" required>
                                                <div class="invalid-feedback">Please provide a valid product price.</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom03">Product Quantity (Litres)</label>
                                                <select class="form-control custom-select" name="quantity" required>
                                                    <option value="">Select Quantity</option>
                                                    <option value="250 ml">250 ml</option>
                                                    <option value="500 ml">500 ml</option>
                                                    <option value="1 Litre">1 Litre</option>
                                                    <option value="2 Litre">2 Litre</option>
                                                    <option value="5 Litre">5 Litre</option>
                                                </select>
                                                <div class="invalid-feedback">Please select the quantity.</div>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>

            <?php include_once('includes/footer.php'); ?>

        </div>
    </div>

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="vendors/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
    <script src="dist/js/jquery.slimscroll.js"></script>
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>
    <script src="dist/js/feather.min.js"></script>
    <script src="vendors/jquery-toggles/toggles.min.js"></script>
    <script src="dist/js/toggle-data.js"></script>
    <script src="dist/js/init.js"></script>
    <script src="dist/js/validation-data.js"></script>

</body>

</html>
<?php } ?>
