<?php

class Medicine extends Eloquent {

    protected $table = 'medicines';

    public function findMedicines($name) {
        return $medicines = DB::table($this->table)->where('name','like',"$name%")->get();
    }

}