<?php
/* @var array $partner */
/* @var string $chosenPartner */
$selected = '';
if ($partner['text'] === $chosenPartner) {
    $selected = 'selected';
}
?>
<option value="{{$partner['value']}}" {{$selected}} >
    {{$partner['text']}}
</option>