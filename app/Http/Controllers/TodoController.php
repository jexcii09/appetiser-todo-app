<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Services\Todo\TodoService;
use App\Http\Requests\TodoRequest;
use App\Http\Requests\PaginateRequest;

class TodoController extends Controller
{
    private $name = 'Todo';

    public function __construct(TodoService $TodoService){
        $this->TodoService = $TodoService;
    }
    
    
    public function index(PaginateRequest $request)
    {
        $data = $request->all();
	    $response = $this->TodoService->list($data);

        $message = $this->name . ' Successfully Fetched.';
        return $this->JsonResponse($message, $response, 200);
    }

    public function create(){

    }

    public function store(TodoRequest $request)
    {
        $data = [
            'user_id' => $request->user_id,
            'name' => $request->name,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority_level_id' => $request->priority_level_id,
            'status_id' => $request->status_id,
        ];

	    $response = $this->TodoService->store($data);

        $message = $this->name . ' Successfully Created.';
        return $this->JsonResponse($message, $response, 200);
    }


    public function show($id)
    {
        $response = $this->TodoService->show($id);

        $message = $this->name . ' Successfully Fetched.';
        return $this->JsonResponse($message, $response, 200);
    }


    public function edit(){

    }

    public function update(TodoRequest $request, $id)
    {
        $data = [
            'user_id' => $request->user_id,
            'name' => $request->name,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority_level_id' => $request->priority_level_id,
            'status_id' => $request->status_id,
        ];

        $response = $this->TodoService->update($data, $id);

        $message = $this->name . ' Successfully Updated.';
        return $this->JsonResponse($message, $response, 200);
    }


    public function destroy($id)
    {
        $response = $this->TodoService->delete($id);

        $message = $this->name . ' Successfully Deleted.';
        return $this->JsonResponse($message, '', 204);
    }


    public function updateStatus(Request $request, $id){
        $data = [
            'status_id' => $request->status_id,
        ];

        $response = $this->TodoService->updateStatus($data, $id);

        $message = $this->name . ' Successfully Updated.';
        return $this->JsonResponse($message, $response, 200);
    }
}
