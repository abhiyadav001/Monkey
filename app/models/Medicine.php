<?php

class Medicine extends Eloquent {

    protected $table = 'medicines';

    public function findMedicines() {
        $name=Input::get('name');
        return $medicines = DB::table($this->table)->where('name','like',"$name%")->get();
    }
    
    public function getAllMedicines() {
        return $medicines = DB::table($this->table)->simplePaginate(10);
    }
}