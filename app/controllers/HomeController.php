<?php

namespace TestWebDev\app\controllers;

use TestWebDev\app\models\Position;
use TestWebDev\src\Controller;
use TestWebDev\src\DB\DataBase;
use TestWebDev\src\DB\QueryBuilder;
use TestWebDev\src\Response;

class HomeController extends Controller
{
    public function index()
    {
        $positions = (new Position())->all();
        $goodsTable = (new DataBase())->tableExists('goods');
        $goods = [];
        if ($goodsTable) {
            $goods = (new QueryBuilder())->table('goods')
                ->select('goods.name, goods.id, goods.article, goods.name AS good_name, goods.price, goods.ean, goods.vat, field1.name As field_name, value1.name AS value_name')
                ->join('additional_goods_field_values AS agfv1', 'goods.id', '=', 'agfv1.good_id')
                ->join('additional_fields AS field1', 'agfv1.additional_field_id', '=', 'field1.id')
                ->join('additional_field_values AS value1', 'agfv1.additional_field_value_id', '=', 'value1.id')
                ->join('additional_goods_field_values AS agfv2', 'goods.id', '=', 'agfv2.good_id')
                ->join('additional_fields AS field2', 'agfv2.additional_field_id', '=', 'field2.id')
                ->join('additional_field_values AS value2', 'agfv2.additional_field_value_id', '=', 'value2.id')
                ->get();
        }
        $data = [
            'title' => 'Home Page',
            'site_name' => 'Anna Borisenko Test task',
            'contentdata' => compact('positions', 'goods')
        ];
        $this->view->render('home', $data);
    }

}