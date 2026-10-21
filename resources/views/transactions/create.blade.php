<!DOCTYPE html>
<html>
<head>
    <title>Add Inward / Outward</title>
</head>

<body>

<h1>Add Inward / Outward Quantity</h1>

@if(session('success'))
    <p style="color:green;">
        {{ session('success') }}
    </p>
@endif

@if($errors->any())

    <ul style="color:red;">

        @foreach($errors->all() as $error)

            <li>
                {{ $error }}
            </li>

        @endforeach

    </ul>

@endif

<form
    action="{{ route('transactions.store') }}"
    method="POST"
>

    @csrf

    <div>

        <label>Material Category *</label>

        <select
            id="category_id"
            required
        >

            <option value="">
                Select Category
            </option>

            @foreach($categories as $category)

                <option value="{{ $category->id }}">

                    {{ $category->name }}

                </option>

            @endforeach

        </select>

    </div>

    <br>

    <div>

        <label>Material Name *</label>

        <select
            name="material_id"
            id="material_id"
            required
        >

            <option value="">
                Select Material
            </option>

        </select>

    </div>

    <br>

    <div>

        <label>Date *</label>

        <input
            type="date"
            name="transaction_date"
            value="{{ old('transaction_date') }}"
            required
        >

    </div>

    <br>

    <div>

        <label>
            Inward / Outward Quantity *
        </label>

        <input
            type="number"
            name="quantity"
            step="0.01"
            value="{{ old('quantity') }}"
            placeholder="Example: 10 or -5"
            required
        >

        <p>
            Positive value = Inward
            <br>
            Negative value = Outward
        </p>

    </div>

    <br>

    <button type="submit">
        Save
    </button>

</form>

<script>

    // Store all categories and their materials
    const categories = @json($categories);

    const categorySelect =
        document.getElementById('category_id');

    const materialSelect =
        document.getElementById('material_id');

    // When category changes, load its materials
    categorySelect.addEventListener('change', function () {

        const categoryId = this.value;

        materialSelect.innerHTML =
            '<option value="">Select Material</option>';

        const selectedCategory =
            categories.find(
                category => category.id == categoryId
            );

        if (
            selectedCategory &&
            selectedCategory.materials
        ) {

            selectedCategory.materials.forEach(
                function (material) {

                    const option =
                        document.createElement('option');

                    option.value =
                        material.id;

                    option.textContent =
                        material.name;

                    materialSelect.appendChild(
                        option
                    );
                }
            );
        }

    });

</script>

</body>
</html>