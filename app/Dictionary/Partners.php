<?php


namespace App\Dictionary;


use App\Model\Partner;

class Partners
{
    static public function get()
    {
        $data = Partner::all('id', 'name');

        $dictionary = [];
        foreach ($data as $item) {
            /* @var Partner $item */
            $dictionary[] =
                ['value' => $item->id, 'text' => $item->name];
        }

        return $dictionary;
    }
}