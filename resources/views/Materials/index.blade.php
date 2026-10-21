<!DOCTYPE html>
<html>
<head>
    <title>Manage Materials</title>
</head>
<body>

<h1>Manage Materials</h1>

@if(session('success'))
    <p style="color:green;">
        {{ session('success') }}
    </p>
@endif

<a href="{{ route('categories.index') }}">
    Manage Categories
</a>

&nbsp; | &nbsp;

<a href="{{ route('materials.create') }}">
    Add Material
</a>

&nbsp; | &nbsp;

<a href="{{ route('transactions.create') }}">
    Add Inward / Outward
</a>

<br><br>

<table border="1" cellpadding="10">

    <thead>
        <tr>
            <th>Internal Material ID</th>
            <th>Category</th>
            <th>Material Name</th>
            <th>Opening Balance</th>
            <th>Current Balance</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>

        @forelse($materials as $material)

            <tr>

                <td>
                    {{ $material->id }}
                </td>

                <td>
                    {{ $material->category->name }}
                </td>

                <td>
                    {{ $material->name }}
                </td>

                <td>
                    {{ number_format($material->opening_balance, 2) }}
                </td>

                <td>
                    {{
                        number_format(
                            $material->opening_balance
                            + ($material->transactions_sum_quantity ?? 0),
                            2
                        )
                    }}
                </td>

                <td>
                    <a
                        href="{{ route('materials.edit', $material) }}"
                    >
                        Edit
                    </a>
                </td>

                <td>

                    <form
                        action="{{ route('materials.destroy', $material) }}"
                        method="POST"
                    >

                        @csrf

                        @method('DELETE')

                        <button type="submit">
                            Delete
                        </button>

                    </form>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="7">
                    No materials found.
                </td>
            </tr>

        @endforelse

    </tbody>

</table>

</body>
</html>