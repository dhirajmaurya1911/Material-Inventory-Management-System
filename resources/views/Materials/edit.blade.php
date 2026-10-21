<!DOCTYPE html>
<html>
<head>
    <title>Edit Material</title>
</head>

<body>

<h1>Edit Material</h1>

@if ($errors->any())

    <div style="color: red;">

        <strong>Please fix the following errors:</strong>

        <ul>

            @foreach ($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

            @endforeach

        </ul>

    </div>

@endif

<form
    action="{{ route('materials.update', $material) }}"
    method="POST"
>

    @csrf

    @method('PUT')

    <!-- Material Category -->

    <div>

        <label>
            Material Category *
        </label>

        <select
            name="category_id"
            required
        >

            <option value="">
                Select Category
            </option>

            @foreach ($categories as $category)

                <option
                    value="{{ $category->id }}"
                    {{ old(
                        'category_id',
                        $material->category_id
                    ) == $category->id
                        ? 'selected'
                        : ''
                    }}
                >

                    {{ $category->name }}

                </option>

            @endforeach

        </select>

    </div>

    <br>


    <!-- Material Name -->

    <div>

        <label>
            Material Name *
        </label>

        <input
            type="text"
            name="name"
            value="{{ old(
                'name',
                $material->name
            ) }}"
            required
        >

    </div>

    <br>


    <!-- Opening Balance -->

    <div>

        <label>
            Opening Balance *
        </label>

        <input
            type="number"
            name="opening_balance"
            value="{{ old(
                'opening_balance',
                $material->opening_balance
            ) }}"
            step="0.01"
            min="0"
            required
        >

    </div>

    <br>


    <!-- Update Button -->

    <button type="submit">
        Update
    </button>

</form>

<br>

<a href="{{ route('materials.index') }}">
    Back to Materials
</a>

</body>
</html>