<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;

class StatusController extends Controller
{
    private $name = 'Status';

    public function index(){
        $response = Status::all();

        $message = $this->name . ' Successfully Fetch.';
        return $this->JsonResponse($message, $response, 200);
    }
}
