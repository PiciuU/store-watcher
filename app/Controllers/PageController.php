<?php

namespace App\Controllers;

use App\Models\Product;
use Services\Support\View;
use Symfony\Component\Routing\RouteCollection;

class PageController {

	public function renderHome(RouteCollection $routes) {
		View::render('home');
	}

	public function renderProduct(int $id, RouteCollection $routes)
	{
        $product = new Product();
        $product->read($id);

        // $products = QueryBuilder::params(
        //     array('url', 'https://www.morele.net/karta-graficzna-palit-geforce-rtx-3050-stormx-8gb-gddr6-ne63050019p1-190af-9710311/', QueryBuilder::PARAM_STR),
        //     array('name', "Karta graficzna Palit Geforce RTX 3050", QueryBuilder::PARAM_STR)
        // )->query("UPDATE products SET name = :name WHERE url = :url")->execute();



        require_once config('APP_ROOT').'/resources/views/product.php';

	}

	public function test() {
		echo 'test';
	}
}