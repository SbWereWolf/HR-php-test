<?php
/* @var $item */

use App\Presentation\OrderSummary;

/* @var OrderSummary $summary */
$summary = $item['summary'];
$link = $item['link'];
$class = '';
if ($summary->getStatus() === 'новый') {
    $class = 'warning';
}
if ($summary->getStatus() === 'подтвержден') {
    $class = 'info';
}
if ($summary->getStatus() === 'завершен') {
    $class = 'success';
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