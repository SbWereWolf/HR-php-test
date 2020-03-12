<?php


namespace App\Dictionary;


use App\Model\Status;

class Statuses
{
    static public function get()
    {
        $data = Status::all('id', 'title');

        $dictionary = [];
        foreach ($data as $item) {
            /* @var Status $item */
            $dictionary[] =
                ['value' => $item->id, 'text' => $item->title];
        }

        return $dictionary;
    }
}