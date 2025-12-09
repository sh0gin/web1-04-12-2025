<?php $this->params['title'] = 'Добавление категории' ?>

<div class="d-flex flex-column justify-content-center form-container category">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="text-center mb-4 fs-1">Add|Edit category</h2>
                    <div class="alert alert-danger fs-2" id="errorMessage">
                        Both fields is required
                    </div>
                    <form id="addCategory">
                        <div class="mb-5">
                            <label for="name" class="form-label fs-2">Name</label>
                            <input type="text" class="form-control fs-2 is-invalid" id="name" name="name"
                                   placeholder="Enter category name">
                            <div class="invalid-feedback fs-3">
                                Maximum 15 characters. Only cyrillic, space, dash.
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="description" class="form-label fs-2">Description</label>
                            <textarea class="form-control fs-2 is-invalid" id="description" name="description"
                                      placeholder="Enter description"></textarea>
                            <div class="invalid-feedback fs-3">
                                Maximum 50 characters. Only cyrillic, space, dash.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 my-2 fs-2">Add</button>
                    </form>
                </div>
            </div>
        </div>