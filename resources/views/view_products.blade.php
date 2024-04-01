<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<h2>Products</h2>
<a href="add_product" class="btn btn-info">Add product</a>
<a href="#" id="logoutBtn" class="btn btn-warning">Logout</a>
<div><p id="message"></p></div>

<table class="table">
    <thead>
    <tr>
        <th>Image</th>
        <th>Product name</th>
        <th>Code</th>
        <th>Category</th>
        <th>Description</th>
        <th>Selling price</th>
        <th>Special price</th>
        <th>Status</th>
        <th>Delivery available</th>
        <th>Attributes</th>
        <th></th>
    </tr>
</thead>
<tbody id="products_table_body">
    
</tbody>
</table>


<div id="message"></div>

<script src="{{URL::to('controllers/authCheck.js')}}"></script>
<script src="{{URL::to('controllers/getProductsController.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
