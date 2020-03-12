<?php
/* @var array $status */
/* @var string $state */
$selected = '';
if ($status['text'] === $state) {
    $selected = 'selected';
}
?>
<option value="{{$status['value']}}" {{$selected}} >
    {{$status['text']}}
</option>