<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
</head>
<body>

<h1>Category Management</h1>

@if(session('success'))
    <p style="color: green;">
        {{ session('success') }}
    </p>
@endif

<a href="{{ route('categories.create') }}">
    Add Category
</a>

<br><br>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>

                <td>{{ $category->name }}</td>

                <td>
                    <a href="{{ route('categories.edit', $category) }}">
                        Edit
                    </a>

                    <form
                        action="{{ route('categories.destroy', $category) }}"
                        method="POST"
                        style="display:inline;"
                    >
                        @csrf
                        @method('DELETE')

                        <button type="submit">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>