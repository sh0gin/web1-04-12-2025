<?php $this->params['title'] = 'Добавление гудс' ?>


<div class="d-flex flex-column justify-content-center form-container good">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="text-center mb-4 fs-1">Add|Edit good</h2>
                    <div class="alert alert-danger fs-2" id="errorMessage">
                        All fields is required
                    </div>
                    <form id="addGood">
                        <div class="mb-5">
                            <label for="name" class="form-label fs-2">Name</label>
                            <input type="text" class="form-control fs-2 is-invalid" id="name" name="name"
                                   placeholder="Enter good name">
                            <div class="invalid-feedback fs-3">
                                Maximum 20 characters.
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="description" class="form-label fs-2">Description</label>
                            <textarea class="form-control fs-2 is-invalid" id="description" name="description"
                                      placeholder="Enter description"></textarea>
                            <div class="invalid-feedback fs-3">
                                Maximum 50 characters.
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="price" class="form-label fs-2">Price</label>
                            <input type="number" min="10" step="0.01" class="form-control fs-2 is-invalid" id="price" name="price"
                                   placeholder="Enter price">
                            <div class="invalid-feedback fs-3">
                                Format xx.xx
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="productImages" class="form-label">Image(s)</label>
                            <input type="file" class="form-control" id="productImages" name="images">
                            <div class="invalid-feedback">
                                You can upload up to 5 images.
                            </div>
                            <div id="fileCounter" class="form-text"></div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 my-2 fs-2">Add</button>
                    </form>
                </div>
            </div>
        </div>