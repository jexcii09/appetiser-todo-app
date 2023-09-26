<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Services\Tag\TagService;

class TagController extends Controller
{
    private $name = 'Tag';

    public function __construct(TagService $TagService){
        $this->TagService = $TagService;
    }

    public function store(Request $request)
    {
        $data = [
            'todo_id' => $request->todo_id,
            'name' => $request->name,
        ];
    
        $response = $this->TagService->store($data);

        $message = $this->name . ' Successfully Created.';
        return $this->JsonResponse($message, $response, 200);
    }


    public function destroy($id)
    {
        $response = $this->TagService->delete($id);

        $message = $this->name . ' Successfully Deleted.';
        return $this->JsonResponse($message, '', 200);
    }
}
