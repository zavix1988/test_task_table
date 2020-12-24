<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{
    public function index()
    {
        Cache::put('productsData', false);

        $tableData =  Cache::get('productsData');

        if (!$tableData) {
            $tableData =  DB::table('products')
                ->join('collections', 'products.collection_id','=', 'collections.id')
                ->leftJoin('order_products', 'products.id','=', 'order_products.product_id')
                ->select([
                    'products.id as id',
                    'products.name as name',
                    'collections.name as collection_name',
                    DB::raw('count(order_products.product_id) as count'),
                    DB::raw('SUM(order_products.price+order_products.shipping_cost) - count(*)*products.cost_of_sale as gross_margin'),
                    DB::raw('SUM(order_products.price+order_products.shipping_cost) as total_income'),
                ])
                ->groupBy('products.id')
                ->orderBy('products.id', 'ASC')
                ->get();
            Cache::put('productsData', $tableData, now()->addHour());
        }
        return response()->view('table',['data' => $tableData]);
    }
}
