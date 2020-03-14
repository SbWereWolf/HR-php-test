<div class="table-responsive">
    <table class="table-hover table-bordered">
        <tbody>
        <tr>
            @foreach ($pages as $page)
                @include('common.partial.link-to-page')
            @endforeach
        </tr>
        </tbody>
    </table>
</div>
