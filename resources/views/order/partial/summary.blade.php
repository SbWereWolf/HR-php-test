<?php /* @var $item */ ?>
<tr>
    <td>
        <a href="{{$item->link}}">{{$item->id}}</a>
    </td>
    <td>
        {{$item->partner}}
    </td>
    <td>
        {{$item->cost}}
    </td>
    <td>
        {{$item->content}}
    </td>
    <td>
        {{$item->status}}
    </td>
</tr>