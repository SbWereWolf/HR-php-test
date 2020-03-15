<?php

use Illuminate\Support\Collection;

/* @var Collection $errors */

$has = session()->has('error');
if ($has && !isset($errors)) {
    $errors = new Collection();
}
if ($has) {
    $message = session()->get('error');
    $errors->push($message);
}
?>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div
                class="alert alert-danger alert-dismissable">
            <button type="button" class="close"
                    data-dismiss="alert" aria-hidden="true">&times;
            </button>
            <p>{{ $error }}</p>
        </div>
    @endforeach
@endif
