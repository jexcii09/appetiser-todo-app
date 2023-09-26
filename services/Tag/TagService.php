<?php
namespace Services\Tag;

use App\Models\Tag;


class TagService {

    public function __construct(Tag $Tag){
        $this->Tag = $Tag;
    }

    public function store(array $data): array {
		return $this->Tag->create($data)->toArray();
	}
	
	public function delete(int $id) {
		return $this->Tag->destroy($id);
	}
}