<div class="modal fade" id="addCafeModal" tabindex="-1" aria-labelledby="addCafeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCafeModalLabel">Add a New Place</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('places.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Place Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>
                    <div class="mb-3">
                        <label for="price_category" class="form-label">Price Category</label>
                        <select id="price_category" name="price_category" class="form-select" required>
                            <option value="" disabled selected>Select</option>
                            <option value="low">Low (&lt; $5)</option>
                            <option value="medium">Medium ($5 - $10)</option>
                            <option value="high">High (&gt; $10)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select id="rating" name="rating" class="form-select" required>
                            <option value="" disabled selected>Select</option>
                            <option value="1">★☆☆☆☆</option>
                            <option value="2">★★☆☆☆</option>
                            <option value="3">★★★☆☆</option>
                            <option value="4">★★★★☆</option>
                            <option value="5">★★★★★</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
