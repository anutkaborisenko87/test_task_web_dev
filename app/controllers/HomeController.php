<?php

namespace TestWebDev\app\controllers;

use TestWebDev\app\models\Position;
use TestWebDev\src\Controller;
use TestWebDev\src\DB\QueryBuilder;
use TestWebDev\src\Response;

class HomeController extends Controller
{
    public function index()
    {
        $positions = (new Position())->all();
        $data = [
            'title' => 'Home Page',
            'site_name' => 'Anna Borisenko Test task',
            'contentdata' => compact('positions')
        ];
        $this->view->render('home', $data);
    }

}