<div class="px-4 px-lg-5 py-5">
    <div class="d-flex justify-content-between align-items-center mb-5 border-bottom pb-4">
        <div>
            <h2 class="fw-extrabold text-dark tracking-tight mb-1" style="font-size: 2rem;">Manage Articles</h2>
            <p class="text-muted fw-medium small mb-0">Publish and curate the centralized news feed.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= BASE_URL ?>admin/articles/sync" class="btn btn-outline-dark px-4 fw-bold shadow-sm d-flex align-items-center gap-2 rounded-pill">
                <i class="bi bi-arrow-repeat"></i> Sync Live News
            </a>
            <a href="<?= BASE_URL ?>admin/articles/create" class="btn btn-primary-custom px-4 fw-bold shadow-sm d-flex align-items-center gap-2">
                <i class="bi bi-pencil-square"></i> Draft Article
            </a>
        </div>
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
                        <th class="py-3 px-4 text-muted small text-uppercase fw-bold" style="letter-spacing: 0.5px; width: 45%;">Article</th>
                        <th class="py-3 px-4 text-muted small text-uppercase fw-bold" style="letter-spacing: 0.5px;">Category</th>
                        <th class="py-3 px-4 text-muted small text-uppercase fw-bold" style="letter-spacing: 0.5px;">Published</th>
                        <th class="py-3 px-4 text-muted small text-uppercase fw-bold text-end" style="letter-spacing: 0.5px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($articles)): ?>
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">No published articles yet.</td>
                    </tr>
                    <?php else: foreach($articles as $article): ?>
                    <tr>
                        <td class="py-3 px-4">
                            <div class="d-flex align-items-center gap-3">
                                <?php if($article['image_url']): ?>
                                    <img src="<?= htmlspecialchars($article['image_url']) ?>" class="rounded-3 object-fit-cover shadow-sm" width="60" height="45">
                                <?php else: ?>
                                    <div class="bg-secondary bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 45px;"><i class="bi bi-image text-muted"></i></div>
                                <?php endif; ?>
                                <div>
                                    <a href="<?= BASE_URL ?>article/show/<?= $article['id'] ?>" class="fw-bold text-dark text-decoration-none lh-sm d-block text-hover-primary" style="font-size: 0.95rem;">
                                        <?= htmlspecialchars(substr($article['title'], 0, 60)) ?><?= strlen($article['title']) > 60 ? '...' : '' ?>
                                    </a>
                                    <span class="text-muted small fw-medium" style="font-size: 0.75rem;"><i class="bi bi-globe me-1"></i> <?= htmlspecialchars($article['source_name'] ?: 'Editorial') ?></span>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4"><span class="badge bg-light text-dark border rounded-pill px-3 py-2"><i class="bi bi-tag-fill text-warning me-1"></i> <?= htmlspecialchars($article['category_name']) ?></span></td>
                        <td class="py-3 px-4 text-muted fw-bold small">
                            <?= date('M j, Y', strtotime($article['published_at'])) ?><br>
                            <span class="opacity-50" style="font-size: 0.7rem;"><?= date('H:i', strtotime($article['published_at'])) ?></span>
                        </td>
                        <td class="py-3 px-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="<?= BASE_URL ?>admin/articles/edit/<?= $article['id'] ?>" class="btn btn-sm btn-outline-pill py-1 px-3">Edit</a>
                                <form action="<?= BASE_URL ?>admin/articles/delete/<?= $article['id'] ?>" method="POST" class="m-0" onsubmit="return confirm('Delete this article forever?');">
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill py-1 px-3 border-0 fw-bold bg-danger bg-opacity-10">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination inside table card -->
        <?php if ($totalPages > 1): ?>
        <div class="card-footer bg-white border-top py-3 px-4 d-flex justify-content-between align-items-center">
            <span class="text-muted small fw-medium">Page <?= $currentPage ?> of <?= $totalPages ?></span>
            <div class="d-flex gap-2">
                <a href="<?= BASE_URL ?>admin/articles?page=<?= max(1, $currentPage - 1) ?>" class="btn btn-sm btn-outline-pill py-1 px-3 <?= $currentPage <= 1 ? 'disabled text-muted' : 'text-dark fw-bold' ?>">Previous</a>
                <a href="<?= BASE_URL ?>admin/articles?page=<?= min($totalPages, $currentPage + 1) ?>" class="btn btn-sm btn-outline-pill py-1 px-3 <?= $currentPage >= $totalPages ? 'disabled text-muted' : 'text-dark fw-bold' ?>">Next</a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
.text-hover-primary:hover { color: var(--primary-color) !important; }
</style>
