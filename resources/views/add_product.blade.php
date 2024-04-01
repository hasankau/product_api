<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<h2>Add product</h2>

<div class="container">
<div class="row">
    <div class="col-6">
<form id="productForm" method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea class="form-control" id="description" name="description"></textarea>
    </div>

    <div class="mb-3">
        <label for="code" class="form-label">Code:</label>
        <input type="text" class="form-control" id="code" name="code" pattern="^[a-zA-Z0-9]+$" required>
    </div>

    <div class="mb-3">
        <label for="category" class="form-label">Category:</label>
        <input type="text" class="form-control" id="category" name="category" required>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Image:</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>

    <div class="mb-3">
        <label for="sellingPrice" class="form-label">Selling Price:</label>
        <input type="number" class="form-control" id="sellingPrice" name="sellingPrice" step="0.01" min="0" value="0" required>
    </div>

    <div class="mb-3">
        <label for="specialPrice" class="form-label">Special Price:</label>
        <input type="number" class="form-control" id="specialPrice" name="specialPrice" step="0.01" min="0" value="0" required>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status:</label>
        <select class="form-select" id="status" name="status" required>
            <option value="draft">Draft</option>
            <option value="published">Published</option>
            <option value="out of stock">Out of Stock</option>
        </select>
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="isDeliveryAvailable" name="isDeliveryAvailable" value="1" checked>
        <label class="form-check-label" for="isDeliveryAvailable">Is Delivery Available</label>
    </div>

    <div class="mb-3">
        <select class="form-select" id="attributes" name="attributes[]" multiple="multiple"></select>
    </div>

    <button type="submit" class="btn btn-primary">Add Product</button>
</form>
</div>
</div>
</div>
<div id="message"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{URL::to('controllers/authCheck.js')}}"></script>
<script src="{{URL::to('controllers/createProductController.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#attributes').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });
    });
    </script>
</body>
</html>
