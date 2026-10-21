<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
</head>
<body>

<h1>Add Category</h1>

@if($errors->any())
    <ul style="color:red;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form
    action="{{ route('categories.store') }}"
    method="POST"
>
    @csrf

    <label>Category Name</label>

    <input
        type="text"
        name="name"
        value="{{ old('name') }}"
        required
    >

    <button type="submit">
        Save
    </button>
</form>

<br>

<a href="{{ route('categories.index') }}">
    Back
</a>

</body>
</html>