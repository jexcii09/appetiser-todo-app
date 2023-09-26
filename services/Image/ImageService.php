<?php
namespace Services\Image;

use App\Models\Image;


class ImageService {

    public function __construct(Image $Image){
        $this->Image = $Image;
    }

    public function store(array $data){
		return $this->Image->create($data);
	}

	public function delete(int $id) {
		return $this->Image->destroy($id);
	}
}