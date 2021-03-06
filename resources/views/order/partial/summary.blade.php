<?php
/* @var $item */

use App\Presentation\OrderSummary;

/* @var OrderSummary $summary */
$summary = $item['summary'];
$link = $item['link'];
$class = '';
if ($summary->getStatus() === 'новый') {
    $class = 'bg-warning';
}
if ($summary->getStatus() === 'подтвержден') {
    $class = 'bg-info';
}
if ($summary->getStatus() === 'завершен') {
    $class = 'bg-success';
}
?>
<tr class="{{$class}}">
    <td>
        <a href="{{$link}}">{{$summary->getId()}}</a>
    </td>
    <td>
        {{$summary->getPartner()}}
    </td>
    <td>
        {{$summary->getCost()}}
    </td>
    <td>
        {{$summary->getProducts()}}
    </td>
    <td>
        {{$summary->getStatus()}}
    </td>
</tr>