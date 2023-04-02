<?php

namespace TestWebDev\app\controllers;

use TestWebDev\src\Controller;
use TestWebDev\src\Response;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Home Page',
            'site_name' => 'Anna Borisenko Test task',
            'contentdata' => [
                ['id' => 1, "name" => "Test Name", "lastname" => "Test Last Name", "position" => "test position"],
                ['id' => 2, "name" => "Test Name", "lastname" => "Test Last Name", "position" => "test position"]
            ]
        ];
        $this->view->render('home', $data);
    }

    public function jsonData(): Response
    {

        $trees = [
            ['id' => 1, "name" => "Test Name", "lastname" => "Test Last Name", "position" => "test position"],
            ['id' => 2, "name" => "Test Name", "lastname" => "Test Last Name", "position" => "test position"]

        ];
        return response()->json(['data' => $trees]);
    }
}