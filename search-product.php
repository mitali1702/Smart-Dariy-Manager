<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Generate Invoice</title>
    <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet">
    <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet">
    <link href="dist/css/style.css" rel="stylesheet">
    <style>
        select, input {
            width: 30% !important;
        }
    </style>
</head>
<body>
<div class="hk-wrapper hk-vertical-nav">
<?php include_once('includes/navbar.php'); include_once('includes/sidebar.php'); ?>

<div class="hk-pg-wrapper">
    <nav class="hk-breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent">
            <li class="breadcrumb-item"><a href="#">Invoices</a></li>
            <li class="breadcrumb-item active">Generate Invoice</li>
        </ol>
    </nav>
    <div class="container">
        <section class="hk-sec-wrapper">
            <h4 class="hk-sec-title">Generate Invoice - Dairy Items</h4>
            <form id="invoiceForm">
                <div class="form-group">
                    <label>Category</label>
                    <select id="category" name="category" class="form-control" readonly>
                        <option>Dairy</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Product Name</label>
                    <select id="product" name="product" class="form-control" required>
                        <option>Butter</option>
                        <option>Milk</option>
                        <option>Paneer</option>
                        <option>Cheese Cubes</option>
                        <option>Curd</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Company</label>
                    <select id="company" name="company" class="form-control" required>
                        <option>Amul</option>
                        <option>Mother Dairy</option>
                        <option>Nestle</option>
                        <option>Britannia</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" id="price" name="price" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Total</label>
                    <input type="text" id="total" name="total" class="form-control" readonly>
                </div>
                <button type="submit" class="btn btn-primary">Generate Invoice</button>
            </form>
        </section>

        <div class="invoice-box" id="invoiceOutput" style="display:none;margin-top:20px;"></div>
    </div>
<?php include_once('includes/footer.php'); ?>
</div>
</div>
<script>
    function calculateTotal() {
        const price = parseFloat(document.getElementById('price').value);
        const qty = parseInt(document.getElementById('quantity').value);
        const total = (price && qty) ? (price * qty).toFixed(2) : '';
        document.getElementById('total').value = total;
    }

    document.getElementById('price').addEventListener('input', calculateTotal);
    document.getElementById('quantity').addEventListener('input', calculateTotal);

    document.getElementById('invoiceForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const category = document.getElementById('category').value;
        const product = document.getElementById('product').value;
        const company = document.getElementById('company').value;
        const price = document.getElementById('price').value;
        const quantity = document.getElementById('quantity').value;
        const total = document.getElementById('total').value;

        document.getElementById('invoiceOutput').style.display = 'block';
        document.getElementById('invoiceOutput').innerHTML = `
            <h4>Invoice</h4>
            <table class='table'>
                <tr><td>Category</td><td>${category}</td></tr>
                <tr><td>Product</td><td>${product}</td></tr>
                <tr><td>Company</td><td>${company}</td></tr>
                <tr><td>Price</td><td>₹${price}</td></tr>
                <tr><td>Quantity</td><td>${quantity}</td></tr>
                <tr><td><b>Total</b></td><td><b>₹${total}</b></td></tr>
            </table>`;
    });
</script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="dist/js/init.js"></script>
</body>
</html>
<?php } ?>
