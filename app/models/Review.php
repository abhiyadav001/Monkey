<?php

class Review extends Eloquent
{

    protected $table = 'reviews';

    public function insert($data)
    {
        $this->order_id = $data['order_id'];
        $this->rating = $data['rating'];
        $this->review_message = $data['review_message'];
        $this->save();
        return $this;
    }

    public function getReviewByOrderID($id){
        return DB::table($this->table)->where('order_id', $id)->first();
    }
}