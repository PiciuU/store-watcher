<?php

namespace App\Controllers;

use App\Models\Product;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Request;
use Services\Support\Response;

use Database\QueryRaw;

class ProductController {

    public function summary_builder(Request $request) {

        print_r(Product::instance()->select(['*'])->where('id', 1)->get());
        // print_r(
        //     Product::instance()->select(['*'])
        //         ->where('id', '1')
        //         ->where('name', 'productName')
        //         ->first(1)
        //         ->get()
        // );
    }

    public function summary_raw(Request $request) {
        print_r(QueryRaw::instance()->query("SELECT * FROM products")->fetch());
    }

    public function post(Request $request) {
        echo $request->get('id');
        Response::toJson();
    }
}