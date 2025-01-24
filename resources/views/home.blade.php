@extends('layouts.app') <!-- Extends the main layout -->

@section('title', 'LunchMap') <!-- Set the page title -->

@section('content')
    <div class="container-fluid home p-0 ">

        <!-- Hero Section -->
        <div class="hero-section position-relative text-center text-white">
            <div class="parallax-img position-absolute w-100 h-100"
                style="background-image: url('{{ asset('images/here-background.jpg') }}');">
            </div>
            <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.6);">
            </div>
            <div class="hero-content position-absolute top-50 start-50 translate-middle text-center">
                <h1 class="display-4 fw-bold">Find Lunch Offers Nearby</h1>
                <p class="lead">Discover the best places to eat in your city</p>
                <form class="row g-3 justify-content-center mt-4">
                    <!-- City Dropdown -->
                    <div class="col-auto">
                        <label for="city" class="form-label">City</label>
                        <select class="form-select" id="city-list" name="city">
                            <option value="All Latvia">All Latvia</option>
                        </select>
                    </div>

                    <!-- Distance Dropdown -->
                    <div class="col-auto">
                        <label for="distance" class="form-label">Distance</label>
                        <select class="form-select" id="distance-list" name="distance"></select>
                    </div>

                    <!-- Price Category Dropdown -->
                    <div class="col-auto">
                        <label for="price" class="form-label">Price Category</label>
                        <select class="form-select" id="price-list" name="price">
                            <option value="All">All</option>
                        </select>
                    </div>

                    <!-- Rating Dropdown -->
                    <div class="col-auto">
                        <label for="rating" class="form-label">Rating</label>
                        <select class="form-select" id="rating-list" name="rating">
                            <option value="All">All</option>
                        </select>
                    </div>

                    <!-- Search Button -->
                    <div class="col-auto">
                        <label class="form-label d-block invisible">Search</label>
                        <button class="btn btn-success" type="submit" id="btnSearch">Search</button>
                    </div>

                    <!-- Use My Location Button -->
                    <div class="text-center mt-3">
                        <button class="btn btn-outline-primary" id="btnUserLocation" type="button">Use My Location</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Map Container -->
        <div class="container-fluid mt-3">
            <div id="map" style="height: 600px;"></div>
        </div>

        <!-- Placeholder for the places list -->
        <div id="places-list" class="container mt-4">
            <h3 id="places-heading" class="text-center my-3"></h3>
            <div class="row" id="places-container"></div>
            <div class="text-center mt-3">
                <button id="backButton" class="btn btn-primary" style="display: none;"><i
                        class="bi bi-caret-left"></i></button>
                <label id="pageNumber"></label>
                <button id="nextButton" class="btn btn-primary" style="display: none;"><i
                        class="bi bi-caret-right"></i></button>
            </div>
        </div>
    </div>
@endsection
