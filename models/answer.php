<?php
class model_answer extends Model{
	protected function load(){
		$this->setTable('answer');
	}

	public function GetByPageID($id){
		$data = $this->find(array(
			'conditions' => 'page='.$id
		));

		if(empty($data)){
			return null;
		}else{
			$Controller = Controller::$self;
			$Member = $Controller->loadModel('member');

			foreach ($data as $id => $answer) {
				$data[$id]['creator'] = $Member->GetByID($data[$id]['creator']);
			}

			return $data;
		}
	}
}
?>