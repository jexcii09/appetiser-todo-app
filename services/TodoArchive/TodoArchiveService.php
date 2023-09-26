<?php
namespace Services\TodoArchive;

use App\Models\TodoArchive;


class TodoArchiveService {

    public function __construct(TodoArchive $TodoArchive){
        $this->TodoArchive = $TodoArchive;
    }

    public function store(array $data): array {
		return $this->TodoArchive->create($data)->toArray();
	}

	public function show(int $id): array {
		return $this->TodoArchive->with(['user'])->find($id)->toArray();
	}

	public function delete(int $id) {
		return $this->TodoArchive->destroy($id);
	}

	public function list(array $data): array {
		$response = $this->TodoArchive->with(['user']);

		if(isset($data['user_id'])){
			$response = $response->where('user_id', $data['user_id']);
		}

		if($data['paginate']){
			return $response = $response->paginate($data['per_page'])->toArray();
		}
		return $response = $response->all()->toArray();
	}



}