<table>
    <tbody>
    <tr>
        @foreach ($pages as $page)
            @include('common.partial.link-to-page')
        @endforeach
    </tr>
    </tbody>
</table>