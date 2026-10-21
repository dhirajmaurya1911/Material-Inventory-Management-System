<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
</head>
<body>

<h1>Edit Category</h1>

@if ($errors->any())
    <div style="color: red;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form
    action="{{ route('categories.update', $category) }}"
    method="POST"
>

    @csrf

    @method('PUT')

    <div>
        <label>Category Name *</label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $category->name) }}"
            required
        >
    </div>

    <br>

    <button type="submit">
        Update
    </button>

</form>

<br>

<a href="{{ route('categories.index') }}">
    Back to Categories
</a>

</body>
</html>