<?php

    include_once "../includes/header.php"

?>

    <div class="container py-5">
        <div class="row">
            <h1 class="text-center">Welcome to the admin dashboard</h1>
            <div class="col-6">
                <form action="createProduct.php" method="POST">
                    <h2>Add New Product</h2>
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product name</label>
                        <input type="text" class="form-control" name="productName" id="productName" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Product Quantity</label>
                        <input type="number" name="quantity" id="quantity" placeholder="Count" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Product price</label>
                        <input type="number" name="price" id="price" placeholder="price" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </div>
            <div class="col-6">
                <h2>Products List</h2>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Quantity Left</td>
                            <td>Edit</td>
                            <td>Delete</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Large Kuli Kuli</td>
                            <td>14</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Edit</button>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php

    include_once "../includes/footer.php"

?>