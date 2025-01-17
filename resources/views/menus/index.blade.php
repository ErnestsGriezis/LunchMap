@extends('layouts.app')

@section('title', 'Menus for ' . $cafe->name)

@section('content')
    <div class="container mt-5 menu-page">
        <h1>Menus for {{ $cafe->name }}</h1>

        <!-- Button to toggle the "Create new Menu" form -->
        <button type="button" class="btn btn-success mb-3" id="toggleCreateMenuForm">
            Create new Menu
        </button>

        <!-- Hidden form for creating a new menu -->
        <div id="createMenuForm" style="display: none;">
            <form method="POST" action="{{ route('menus.store', ['cafe' => $cafe->id_cafe]) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="item_name" class="form-label">Item Name</label>
                    <input type="text" class="form-control" id="item_name" name="item_name" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                </div>
                <div class="mb-3">
                    <label for="availability_date" class="form-label">Availability Date</label>
                    <input type="date" class="form-control" id="availability_date" name="availability_date" required>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Upload Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                </div>
                <button type="submit" class="btn btn-success">Add Menu</button>
            </form>
        </div>

        <!-- Existing menu items -->
        @if ($menus->isEmpty())
            <div class="alert alert-warning">
                No menu items found for this café. Add the first menu item using the form above!
            </div>
        @else
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Photo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $menu)
                        <tr>
                            <td>{{ $menu->item_name }}</td>
                            <td>{{ $menu->price }}</td>
                            <td>
                                @if ($menu->photo)
                                    <img src="{{ asset('storage/' . $menu->photo) }}" alt="{{ $menu->item_name }}"
                                        class="img-thumbnail" style="max-width: 100px;">
                                @else
                                    No photo
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('menus.edit', ['menu' => $menu->id_menu]) }}"
                                    class="btn btn-warning btn-md">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('menus.destroy', ['menu' => $menu->id_menu]) }}"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-md">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script>
        document.getElementById('toggleCreateMenuForm').addEventListener('click', function() {
            const form = document.getElementById('createMenuForm');
            const button = this;

            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block';
                button.textContent = 'Close';
                button.classList.remove('btn-success');
                button.classList.add('btn-danger');

            } else {
                form.style.display = 'none';
                button.textContent = 'Create new menu';
                button.classList.remove('btn-danger');
                button.classList.add('btn-success');

            }
        });
    </script>
@endsection
