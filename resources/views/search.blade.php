@if(!empty(old('search')))
    Your search value: {{ old('search') }}
@endif
<form method="GET" action="search">
    <label for="search">Search</label>
    <input type="text" id="search" name="search" />
    <button type="submit">Search</button>
</form>