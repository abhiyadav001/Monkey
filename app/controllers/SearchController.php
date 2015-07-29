<?php

class SearchController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $name=Input::get('name');
            $medicine=new Medicine;
            $medicines=$medicine->findMedicines($name);
            $msg='Medicine results are retrived successfully.';
            return $data=$this->successMessageWithVar($msg, $medicines, 'medicines');
	}
            
        public function successMessageWithVar($msg,$data,$key){
        return json_encode(array(
                'success' => true,
                'messages' => $msg,
                'response' => array(
                    $key => $data)
                ),
            200
        );
    }

}
