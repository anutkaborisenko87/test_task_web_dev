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
        $positions = (new QueryBuilder())->table('positions')->get();
        $data = [
            'title' => 'Home Page',
            'site_name' => 'Anna Borisenko Test task',
            'contentdata' => compact('positions')
        ];
        $this->view->render('home', $data);
    }

    public function jsonData(): Response
    {

        $users = (new QueryBuilder())
            ->table('users')
            ->select('users.id, users.name, users.last_name, positions.id AS position_id, positions.title AS position_title')
            ->join('positions', 'users.position_id', '=', 'positions.id')
            ->get();
        return response()->json(['data' => $users]);
    }
}