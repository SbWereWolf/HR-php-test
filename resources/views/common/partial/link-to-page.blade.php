<?php /* @var $page */
$has = !empty($page->link);
?>
<td>
    @if ($has)
        <a href="{{ $page->link }}">{{ $page->text }}</a>
    @endif
    @if (!$has)
        {{ $page->text }}
    @endif
</td>