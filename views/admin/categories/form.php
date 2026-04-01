<div class="px-4 px-lg-5 py-5">
    
    <a href="<?= BASE_URL ?>admin/categories" class="text-decoration-none text-muted fw-bold small d-inline-flex align-items-center mb-4 btn btn-white border shadow-sm rounded-pill px-3 py-2">
        <i class="bi bi-arrow-left me-2"></i> Back to Categories
    </a>

    <div class="d-flex align-items-center mb-5 border-bottom pb-4">
        <div class="bg-dark rounded-circle d-flex align-items-center justify-content-center text-warning me-3 shadow" style="width: 50px; height: 50px;">
            <i class="bi bi-folder-plus fs-3"></i>
        </div>
        <div>
            <h2 class="fw-extrabold text-dark tracking-tight mb-1" style="font-size: 2rem;">
                <?= isset($category) ? 'Edit Category' : 'Create Category' ?>
            </h2>
            <p class="text-muted fw-medium small mb-0">Define organizational segments for news publishing.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card bg-white border-0 shadow-sm rounded-5 overflow-hidden mb-5">
                <div class="card-body p-4 p-md-5">
                    
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger px-4 py-3 border-0 bg-danger bg-opacity-10 text-danger rounded-4 fw-medium mb-4" role="alert">
                            <i class="bi bi-exclamation-octagon-fill me-2 fs-5"></i> <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= BASE_URL ?>admin/categories/<?= isset($category) ? 'edit/'.$category['id'] : 'create' ?>" method="POST">
                        
                        <div class="mb-4">
                            <label for="name" class="form-label ms-3 small fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">Display Name</label>
                            <input type="text" class="form-control form-control-custom w-100" id="name" name="name" 
                                value="<?= htmlspecialchars($category['name'] ?? '') ?>" 
                                placeholder="e.g. Artificial Intelligence" required autofocus>
                        </div>
                        
                        <div class="mb-5">
                            <label for="slug" class="form-label ms-3 small fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">URL Slug (Optional)</label>
                            <input type="text" class="form-control form-control-custom w-100" id="slug" name="slug" 
                                value="<?= htmlspecialchars($category['slug'] ?? '') ?>" 
                                placeholder="e.g. artificial-intelligence">
                            <div class="form-text ms-3 small mt-2">Leave blank to auto-generate based on the Display Name. Must be unique.</div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                            <a href="<?= BASE_URL ?>admin/categories" class="btn btn-outline-pill bg-white px-4 fw-medium text-muted">Cancel</a>
                            <button type="submit" class="btn btn-primary-custom px-5 fw-bold shadow-sm">
                                <?= isset($category) ? 'Save Changes' : 'Create Category' ?> <i class="bi bi-check2 ms-2 fs-5"></i>
                            </button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control-custom { border: 2px solid transparent; background-color: var(--input-bg); }
.form-control-custom:focus { border: 2px solid var(--primary-color) !important; background-color: #fff; }
</style>
