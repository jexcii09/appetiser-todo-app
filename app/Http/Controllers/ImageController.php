<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Services\Image\ImageService;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Config;

class ImageController extends Controller
{
    private $name = 'Image';

    public function __construct(ImageService $ImageService){
        $this->ImageService = $ImageService;
    }

    public function store(Request $request)
    {
        $host = $request->getSchemeAndHttpHost();
        $path = $host . '/public/images/';

        if($request->hasFile('file')){
            $file = $request->file;

            //get file name with extenstion
            $fileNameWithExt = $file->getClientOriginalName();

            //get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //get extension
            $extension = $file->getClientOriginalExtension();

            //file to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            //upload to store
            $file->move('public/images', $fileNameToStore);


            $data = [
                'todo_id' => $request->todo_id,
                'file_name' => $fileNameToStore,
                'path' => $path . $fileNameToStore,
            ];
        
            $response = $this->ImageService->store($data);

            $message = $this->name . ' Successfully Created.';
            return $this->JsonResponse($message, $response, 200);
        }

    }

    public function destroy($id)
    {
        $response = $this->ImageService->delete($id);

        $message = $this->name . ' Successfully Deleted.';
        return $this->JsonResponse($message, '', 200);
    }
}
