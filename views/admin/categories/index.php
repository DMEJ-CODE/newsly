<div class="px-4 px-lg-5 py-5">
    <div class="d-flex justify-content-between align-items-center mb-5 border-bottom pb-4">
        <div>
            <h2 class="fw-extrabold text-dark tracking-tight mb-1" style="font-size: 2rem;">Manage Categories</h2>
            <p class="text-muted fw-medium small mb-0">Organize and structure the global news feed.</p>
        </div>
        <a href="<?= BASE_URL ?>admin/categories/create" class="btn btn-primary-custom px-4 fw-bold shadow-sm d-flex align-items-center gap-2">
            <i class="bi bi-plus-lg"></i> New Category
        </a>
    </div>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success px-4 py-3 border-0 bg-success bg-opacity-10 text-success rounded-4 fw-medium mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2 fs-5"></i> <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger px-4 py-3 border-0 bg-danger bg-opacity-10 text-danger rounded-4 fw-medium mb-4" role="alert">
            <i class="bi bi-exclamation-octagon-fill me-2 fs-5"></i> <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <div class="card bg-white border-0 shadow-sm rounded-5 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="py-3 px-4 text-muted small text-uppercase fw-bold" style="letter-spacing: 0.5px;">ID</th>
                        <th class="py-3 px-4 text-muted small text-uppercase fw-bold" style="letter-spacing: 0.5px;">Name</th>
                        <th class="py-3 px-4 text-muted small text-uppercase fw-bold" style="letter-spacing: 0.5px;">Slug</th>
                        <th class="py-3 px-4 text-muted small text-uppercase fw-bold" style="letter-spacing: 0.5px;">Created</th>
                        <th class="py-3 px-4 text-muted small text-uppercase fw-bold text-end" style="letter-spacing: 0.5px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($categories)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">No categories found.</td>
                    </tr>
                    <?php else: foreach($categories as $category): ?>
                    <tr>
                        <td class="py-3 px-4 text-muted fw-bold">#<?= $category['id'] ?></td>
                        <td class="py-3 px-4 fw-semibold text-dark"><?= htmlspecialchars($category['name']) ?></td>
                        <td class="py-3 px-4"><span class="badge bg-light text-dark border rounded-pill px-3 py-2">/<?= htmlspecialchars($category['slug']) ?></span></td>
                        <td class="py-3 px-4 text-muted small"><?= date('M j, Y', strtotime($category['created_at'])) ?></td>
                        <td class="py-3 px-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="<?= BASE_URL ?>admin/categories/edit/<?= $category['id'] ?>" class="btn btn-sm btn-outline-pill py-1 px-3">Edit</a>
                                <form action="<?= BASE_URL ?>admin/categories/delete/<?= $category['id'] ?>" method="POST" class="m-0" onsubmit="return confirm('Are you absolutely sure you want to delete this category? This might delete attached articles!');">
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill py-1 px-3 border-0 fw-bold bg-danger bg-opacity-10">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
