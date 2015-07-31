<?php

class ReviewController extends \BaseController
{
    public function errorMessage($msg)
    {
        return json_encode(array(
                'success' => false,
                'messages' => $msg,
                'response' => Null), 400
        );
    }

    public function successMessage($msg)
    {
        return json_encode(array(
                'success' => true,
                'messages' => $msg,
                'response' => Null), 200
        );
    }

    public function successMessageWithVar($msg, $msgData)
    {
        return json_encode(array(
                'success' => true,
                'messages' => $msg,
                'response' => array(
                    'reviews_details' => $msgData)
            ), 200
        );
    }

    public function checkValidation()
    {
        return $validator = Validator::make(
            array(
                'order_id' => Input::get('order_id'),
                'rating' => Input::get('rating'),
                'review_message' => Input::get('review_message')
            ), array(
                'order_id' => 'required',
                'rating' => 'required',
                'review_message' => 'required'
            )
        );
    }


    public function store()
    {
        $review = new Review();
        $input = Input::all();
        $validator = $this->checkValidation();
        if ($validator->fails()) {
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                $msg[] = $message;
            }
            return $this->errorMessage($msg);
        }
        $saveReview = $review->insert($input);
        $msg = "Review saved successfully.";
        return $this->successMessageWithVar($msg, $saveReview);
    }

}
