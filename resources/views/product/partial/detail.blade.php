<?php

use App\Presentation\ProductDetail;

/* @var ProductDetail $item */
$id = $item->getId();
?>

<tr>
    <td>{{$item->getVendor()}}</td>
    <td>{{$id}}</td>
    <td>{{$item->getName()}}</td>
    <td>
        <form onsubmit="savePrice(this,event)">
            <input type="text" name="price"
                   value="{{$item->getPrice()}}">
            <input type="submit" value="💾">
            <output name="status"></output>
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$id}}">
        </form>
    </td>
</tr>
