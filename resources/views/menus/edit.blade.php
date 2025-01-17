@extends('layouts.app')

@section('title', 'Edit Menu ')

@section('content')
    <div class="container mt-5 edit-menu">
        <h1>Edit Menu</h1>
        <form method="POST" action="{{ route('menus.update', $menu->id_menu) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="item_name" class="form-label">Menu Name</label>
                <input type="text" class="form-control" id="item_name" name="item_name" value="{{ $menu->item_name }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ $menu->price }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="availability_date" class="form-label">Availability Date</label>
                <input type="date" class="form-control" id="availability_date" name="availability_date"
                    value="{{ $menu->availability_date }}" required>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Upload Photo</label>
                <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
            </div>
            <div class="button-container">
                <a href="{{ route('menus.index', ['cafe' => $menu->cafe_id]) }}" class="btn btn-danger me-3">Cancel</a>
                <button type="submit" class="btn btn-success">Save Changes</button>
            </div>
            
        </form>
    </div>
@endsection
