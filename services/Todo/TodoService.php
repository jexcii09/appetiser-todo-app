<?php
namespace Services\Todo;

use App\Models\Todo;


class TodoService {

    public function __construct(Todo $Todo){
        $this->Todo = $Todo;
    }

    public function store(array $data): array {
		return $this->Todo->create($data)->toArray();
	}

	/**
	 * @param int $id
	 * @param array $data
	 * @return array
	 */
	public function update(array $data, int $id): array {
		if ($response = $this->Todo->find($id)) {
			
            $response->fill($data)->save();

			return $this->Todo->find($id)->toArray();
		}
	}

	public function updateStatus(array $data, int $id): array {
		if ($response = $this->Todo->find($id)) {
			
            $response->fill($data)->save();

			return $this->Todo->find($id)->toArray();
		}
	}

	/**
	 * @param int $id
	 * @return array
	 */
	public function show(int $id): array {
		return $this->Todo->with(['user', 'priorityLevel', 'status', 'images', 'tags'])->find($id)->toArray();
	}


	/**
	 * @param int $id
	 * @return array
	 */
	public function delete(int $id) {
		return $this->Todo->destroy($id);
	}

	/**
	 * @param array $data
	 * @return array
	 */
	public function list(array $data): array {
		$response = $this->Todo->with(['user', 'priorityLevel', 'status', 'images', 'tags']);


		// SORTING
		if(isset($data['order_by'])){
			$response = $response->orderBy('id', $data['order_by']);
		}

		if(isset($data['status_id'])){
			$response = $response->orderByRaw("status_id =" . $data['status_id'] ." DESC")->orderBy('status_id');
		}

		if(isset($data['priority_level_id'])){
			$response = $response->orderByRaw("priority_level_id =" . $data['priority_level_id'] ." DESC")->orderBy('priority_level_id');
		}

		if(isset($data['due_date'])){
			$response = $response->orderByRaw("due_date =" . $data['due_date'] ." DESC")->orderBy('due_date');
		}


		//FILTERING
		if(isset($data['filter_status_id'])){
			$response = $response->where('status_id',  $data['filter_status_id']);
		}

		if(isset($data['filter_priority_level_id'])){
			$response = $response->where('priority_level_id',  $data['filter_priority_level_id']);
		}

		if(isset($data['keyword'])){
			$response = $response->where('name', 'LIKE', '%' . $data['keyword']. '%');
		}

		if(isset($data['filter_due_date_from'])){
			$response = $response->where('due_date', '>=' , $data['filter_due_date_from']);
		}

		if(isset($data['filter_due_date_to'])){
			$data['filter_due_date_to'] = $data['filter_due_date_to'];
			$response = $response->where('due_date', '<=' , $data['filter_due_date_to']);
		}



		if(isset($data['user_id'])){
			$response = $response->where('user_id', $data['user_id']);
		}

		

		if($data['paginate']){
			return $response = $response->paginate($data['per_page'])->toArray();
		}
		return $response = $response->all()->toArray();
	}



}