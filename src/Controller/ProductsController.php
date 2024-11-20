<?php

namespace App\Controller;

use App\Model\ProductsModel;

class ProductsController
{
    public function create(array $data): void
    {
        $model = new ProductsModel();
        if ($model->create($data)) {
            header('Location: /admin');
        }
    }
}
