<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Services\TodoArchive\TodoArchiveService;
use App\Http\Requests\PaginateRequest;

class TodoArchiveController extends Controller
{
    private $name = 'Todo Archive';

    public function __construct(TodoArchiveService $TodoArchiveService){
        $this->TodoArchiveService = $TodoArchiveService;
    }

    public function index(PaginateRequest $request)
    {
        $data = $request->all();

	    $response = $this->TodoArchiveService->list($data);

        $message = $this->name . ' Successfully Fetched.';
        return $this->JsonResponse($message, $response, 200);
    }

    public function store(Request $request)
    {
        $data = [
            'user_id' => $request->user_id,
            'details' => $request['details'],
        ];
	    $response = $this->TodoArchiveService->store($data);

        $message = $this->name . ' Successfully Created.';
        return $this->JsonResponse($message, $response, 200);
    }

    public function destroy($id)
    {
        $response = $this->TodoArchiveService->delete($id);

        $message = $this->name . ' Successfully Deleted.';
        return $this->JsonResponse($message, '', 204);
    }
}
