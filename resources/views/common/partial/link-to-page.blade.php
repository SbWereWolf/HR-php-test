<?php
/* @var PageLink $page */

use App\Presentation\PageLink;

$link = $page->getLink();
$has = !empty($link);
$caption = $page->getCaption();
?>
<td class="{{$page->getClass()}}">
    @if ($has)
        <a href="{{ $link }}">{{ $caption }}</a>
    @endif
    @if (!$has)
        {{ $caption }}
    @endif
</td>