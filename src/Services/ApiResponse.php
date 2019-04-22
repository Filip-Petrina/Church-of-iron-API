<?php 
namespace App\Services;

class ApiResponse {

	public function __construct () 
	{
		
	}

	public static function getResponse() {

		// $this->response 
		return array(
			'status' => array(
				'success' => 1,
				'msg' => 'Success',
				'debug' => ''
			),
			'data' => array(),
		);
	}


	public function getErrorMessages(\Symfony\Component\Form\Form $form) {
		$errors = array();

		foreach ($form->getErrors() as $key => $error) {
			if ($form->isRoot()) {
				$errors['#'] = $error->getMessage();
			} else {
				$errors = $error->getMessage();
			}
		}
		
		foreach ($form->all() as $child) {
			if (!$child->isValid()) {
				$errors[$child->getName()] = ApiResponse::getErrorMessages($child);
			}
		}

		return $errors;
	}
}