<?php

class SearchController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $medicine=new Medicine;
            $medicines=$medicine->findMedicines();
            $msg='Medicine results are retrieved successfully.';
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
    
    public function getLocations() {
        $locations = DB::table('location_mapping')->get();
        $msg='Locations retrieved successfully.';
        return $data=$this->successMessageWithVar($msg, $locations, 'locations');
    }
    
    public function getAppSettings() {
        $location=Input::get('location');
        $appSetting = DB::table('app_settings')->where('location',$location)->get();
        $msg="App Setting retrieved successfully.";
        return $data=$this->successMessageWithVar($msg, $appSetting, 'app-settings');
    }

}
