@if ($errors->any())
<ul class="error">
    @foreach($errors->all() as $message)
    <li>{{ $message }}</li>
    @endforeach
</ul>

@endif

