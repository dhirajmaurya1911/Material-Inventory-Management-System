<!DOCTYPE html>
<html>
<head>
    <title>Add Material</title>
</head>
<body>

<h1>Add Material</h1>

@if($errors->any())
    <ul style="color:red;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form
    action="{{ route('materials.store') }}"
    method="POST"
>
    @csrf

    <div>
        <label>Material Category *</label>

        <select name="category_id" required>
            <option value="">Select Category</option>

            @foreach($categories as $category)
                <option
                    value="{{ $category->id }}"
                    {{ old('category_id') == $category->id ? 'selected' : '' }}
                >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <br>

    <div>
        <label>Material Name *</label>

        <input
            type="text"
            name="name"
            value="{{ old('name') }}"
            required
        >
    </div>

    <br>

    <div>
        <label>Opening Balance *</label>

        <input
            type="number"
            name="opening_balance"
            step="0.01"
            min="0"
            value="{{ old('opening_balance') }}"
            required
        >
    </div>

    <br>

    <button type="submit">
        Save
    </button>

</form>

</body>
</html>