<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PriorityLevel;

class PriorityLevelController extends Controller
{
    private $name = 'Priority Level';

    public function index(){
        $response = PriorityLevel::all();

        $message = $this->name . ' Successfully Fetch.';
        return $this->JsonResponse($message, $response, 200);
    }
}
