<div class="px-3 px-md-5 pt-3 pt-md-4">

    <!-- Header Banner -->
    <div class="bg-dark rounded-5 p-3 p-md-5 d-flex flex-column align-items-center justify-content-center mb-4 mb-md-5 text-white shadow-lg banner-bg position-relative overflow-hidden">
        <!-- Abstract gradient overlay -->
        <div class="position-absolute top-0 end-0 bottom-0 w-100 w-md-50" style="background: radial-gradient(circle at right, rgba(250,204,21,0.15) 0%, transparent 70%); pointer-events: none;"></div>
        
        <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mb-3 mb-md-4 z-1 shadow" style="width: 60px; height: 60px;">
            <i class="bi bi-bookmark-star-fill text-warning fs-3 fs-md-1"></i>
        </div>
        <h2 class="fw-extrabold fs-3 fs-md-2 mb-2 z-1 tracking-tight text-center">Your Reading List</h2>
        <p class="text-white-50 mx-auto text-center z-1 lh-relaxed small fs-md-6" style="max-width: 500px;">
            A personal library of stories you've saved. Curate your knowledge and revisit important insights anytime.
        </p>
    </div>

    <div class="row justify-content-center">
        <!-- Main Feed Column (Left side) -->
        <div class="col-xl-9">

            <?php if (empty($articles)): ?>
                <div class="text-center py-5 mt-4 bg-white rounded-5 shadow-sm border p-4 p-md-5">
                    <i class="bi bi-journal-x text-muted opacity-25" style="font-size: 4rem;"></i>
                    <h4 class="fw-bold mt-3 text-dark fs-5 fs-md-4">No Saved Stories</h4>
                    <p class="text-muted small">You haven't bookmarked any articles yet. Explore the feed and click the save icon to build your reading list.</p>
                    <a href="<?= BASE_URL ?>dashboard" class="btn btn-primary-custom mt-2 px-4 py-2 rounded-pill fw-medium w-100 w-md-auto">
                        Explore News <i class="bi bi-compass ms-1"></i>
                    </a>
                </div>
            <?php else: ?>
                <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
                    <?php foreach($articles as $article): ?>
                        <div class="col">
                            <div class="news-card position-relative bg-white shadow-sm rounded-5 overflow-hidden border">
                                <?php if (!empty($article['image_url'])): ?>
                                    <div class="news-card-img-wrapper" style="height: 180px;">
                                        <!-- Overlay badge top-left -->
                                        <div class="position-absolute top-0 start-0 m-3 z-1">
                                            <span class="badge badge-pill-light d-flex align-items-center gap-1 shadow-sm">
                                                <i class="bi bi-lightning-charge-fill text-warning"></i> <?= htmlspecialchars($article['category_name']) ?>
                                            </span>
                                        </div>
                                        <img src="<?= htmlspecialchars($article['image_url']) ?>" alt="Cover" class="news-card-img">
                                    </div>
                                <?php endif; ?>
                                
                                <div class="p-3 p-md-4 d-flex flex-column h-100">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="bg-primary rounded-circle" style="width:24px; height:24px; overflow:hidden;">
                                                <img src="<?= BASE_URL ?>public/images/unsplash/avatar1.jpg" width="24" height="24">
                                            </div>
                                            <span class="small fw-semibold text-dark"><?= htmlspecialchars($article['source_name'] ?: 'Editorial') ?></span>
                                        </div>
                                        <span class="small fw-bold text-muted" style="font-size:0.7rem;">Saved <?= date('M j', strtotime($article['bookmarked_at'])) ?></span>
                                    </div>
                                    
                                    <h5 class="fw-extrabold mb-3 lh-sm fs-6">
                                        <a href="<?= BASE_URL ?>article/show/<?= $article['id'] ?>" class="text-dark text-decoration-none text-hover-primary stretched-link">
                                            <?= htmlspecialchars($article['title']) ?>
                                        </a>
                                    </h5>
                                    
                                    <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                                        <a href="<?= BASE_URL ?>article/show/<?= $article['id'] ?>" class="text-decoration-none fw-semibold text-primary-custom small position-relative z-3">
                                            Read Full <i class="bi bi-arrow-right ms-1"></i>
                                        </a>
                                        <form action="<?= BASE_URL ?>bookmark/toggle" method="POST" class="m-0 position-relative z-3">
                                            <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                                            <input type="hidden" name="redirect_to" value="bookmark">
                                            <button type="submit" class="btn btn-sm btn-light border rounded-circle p-2 d-flex hover-opacity-100" data-bs-toggle="tooltip" title="Remove bookmark">
                                                <i class="bi bi-bookmark-fill text-warning fs-6"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Pagination Controls -->
                <?php if ($totalPages > 1): ?>
                    <nav aria-label="Bookmarks pagination" class="mt-4 mb-5">
                        <ul class="pagination justify-content-center">
                            <?php $baseUrl = BASE_URL . "bookmark/index?page="; ?>
                            <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link rounded-pill px-3 me-2 text-dark border-0 shadow-sm" href="<?= $baseUrl . ($currentPage - 1) ?>">Prev</a>
                            </li>
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                    <a class="page-link rounded-circle mx-1 border-0 shadow-sm <?= ($i == $currentPage) ? 'bg-dark text-white' : 'text-dark' ?>" style="width: 40px; height: 40px; text-align: center; line-height: 24px;" href="<?= $baseUrl . $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                                <a class="page-link rounded-pill px-3 ms-2 text-dark border-0 shadow-sm" href="<?= $baseUrl . ($currentPage + 1) ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                <?php endif; ?>
            <?php endif; ?>
            
        </div>
    </div>
</div>

<style>
.banner-bg { background: linear-gradient(90deg, #1e293b 0%, #0f172a 100%); }
.text-hover-primary:hover { color: var(--primary-color) !important; }
.tracking-tight { letter-spacing: -0.05em; }
.hover-opacity-100 { opacity: 1 !important; transition: all 0.2s; }
.hover-opacity-100:hover { transform: scale(1.1); }
</style>
