<div class="px-0 px-lg-4 pt-2 pt-lg-4">

    <!-- Premium Dark Banner (Responsive) -->
    <div class="bg-dark rounded-4 p-2 p-md-4 d-flex flex-column flex-md-row justify-content-between align-items-center mb-3 mb-md-5 text-white shadow-lg banner-bg">
        <div class="d-flex align-items-center mb-2 mb-md-0 text-center text-md-start flex-column flex-md-row">
            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center me-md-3 mb-2 mb-md-0 shadow-sm" style="width: 32px; height: 32px;">
                <i class="bi bi-star-fill text-warning fs-6"></i>
            </div>
            <div>
                <h6 class="fw-bold mb-0 mb-md-1" style="font-size: clamp(0.85rem, 1.5vw, 1.15rem);">Subscribe to Newsly+</h6>
                <p class="text-white-50 mb-0 d-none d-md-block small" style="font-size: clamp(0.7rem, 1.5vw, 0.9rem);">Unlock ad-free premium articles.</p>
            </div>
        </div>
        <button class="btn btn-outline-light rounded-pill px-3 px-md-4 fw-medium border-2 hover-bg-light w-100 w-md-auto mt-2 mt-md-0" style="font-size: clamp(0.75rem, 1.5vw, 0.9rem); min-height: 34px; padding: 0.3rem 1rem !important;">Subscribe Now</button>
    </div>

    <!-- Search Bar -->
    <div class="mb-4 d-flex gap-2 gap-md-3 align-items-center">
        <div class="position-relative flex-grow-1">
            <i class="bi bi-search position-absolute text-muted fs-6" style="left: 18px; top: 12px;"></i>
            <input type="text" class="form-control form-control-custom w-100 shadow-sm" style="padding-left: 50px;" placeholder="Search News...">
        </div>
        <button class="btn btn-white shadow-sm rounded-circle d-flex align-items-center justify-content-center border" style="width:42px; height:42px; padding: 0;">
            <i class="bi bi-bell fs-6 text-muted"></i>
        </button>
    </div>

    <!-- Category Pills (Horizontal scrolling capability) -->
    <div class="d-flex gap-2 overflow-auto py-2 mb-4 scrollbar-hide">
        <a href="<?= BASE_URL ?>dashboard" class="category-pill text-nowrap <?= !isset($activeCategory) ? 'active' : '' ?>">
            All News
        </a>
        <?php foreach($categories as $category): ?>
            <a href="<?= BASE_URL ?>dashboard/index/<?= htmlspecialchars($category['slug']) ?>" 
               class="category-pill text-nowrap <?= (isset($activeCategory) && $activeCategory['slug'] === $category['slug']) ? 'active' : '' ?>">
                # <?= htmlspecialchars($category['name']) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="row g-4 g-lg-5">
        <!-- Main Feed Column (Left side) -->
        <div class="col-lg-7 col-xl-8">
            <div class="d-flex border-bottom mb-4 overflow-auto scrollbar-hide flex-nowrap">
                <a href="#" class="text-dark fw-bold text-decoration-none border-bottom border-dark border-3 pb-2 px-3 text-nowrap">For You</a>
                <a href="#" class="text-muted fw-bold text-decoration-none pb-2 px-3 text-nowrap">Trending</a>
                <a href="#" class="text-muted fw-bold text-decoration-none pb-2 px-3 text-nowrap">Following</a>
            </div>

            <?php if (empty($articles)): ?>
                <div class="text-center py-5 mt-5">
                    <i class="bi bi-layout-text-window-reverse text-muted opacity-25" style="font-size: 5rem;"></i>
                    <h4 class="fw-bold mt-4 text-dark">No Articles Found</h4>
                    <p class="text-muted">There are no stories available in this section right now.</p>
                </div>
            <?php else: ?>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-1 row-cols-xl-2 g-4 mb-5">
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
                                            <div class="bg-primary rounded-circle shadow-sm" style="width:24px; height:24px; overflow:hidden;">
                                                <img src="<?= BASE_URL ?>public/images/unsplash/avatar1.jpg" width="24" height="24">
                                            </div>
                                            <span class="small fw-semibold text-dark"><?= htmlspecialchars($article['source_name'] ?: 'Editorial') ?></span>
                                        </div>

                                        <?php if (isset($_SESSION['user_id'])): ?>
                                            <form action="<?= BASE_URL ?>bookmark/toggle" method="POST" class="m-0">
                                                <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                                                <button type="submit" class="btn btn-white shadow-xs rounded-circle p-2 d-flex opacity-75 hover-opacity-100 border-0" style="width: 32px; height: 32px; justify-content: center; align-items: center;">
                                                    <?php if (in_array($article['id'], $bookmarkedIds)): ?>
                                                        <i class="bi bi-bookmark-fill text-warning fs-7"></i>
                                                    <?php else: ?>
                                                        <i class="bi bi-bookmark text-muted fs-7"></i>
                                                    <?php endif; ?>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <h5 class="fw-extrabold mb-2 mb-md-3 lh-sm">
                                        <a href="<?= BASE_URL ?>article/show/<?= $article['id'] ?>" class="text-dark text-decoration-none text-hover-primary stretched-link">
                                            <?= htmlspecialchars($article['title']) ?>
                                        </a>
                                    </h5>
                                    
                                    <p class="text-muted small flex-grow-1 d-none d-md-block" style="line-height: 1.6;">
                                        <?= htmlspecialchars(substr(strip_tags($article['content']), 0, 110)) ?>...
                                    </p>
                                    
                                    <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top-dashed">
                                        <div class="text-muted small d-flex gap-3">
                                            <span><i class="bi bi-calendar-event me-1"></i> <?= date('d M Y', strtotime($article['published_at'])) ?></span>
                                            <span><i class="bi bi-clock me-1"></i> 2m</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Pagination Controls -->
                <?php if ($totalPages > 1): ?>
                    <nav aria-label="Feed pagination" class="mt-4 mb-5">
                        <ul class="pagination justify-content-center">
                            <?php $baseUrl = BASE_URL . "dashboard/index/" . ($activeCategory['slug'] ?? '') . "?page="; ?>
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

        <!-- Curated Picks Column (Right side, shows on all widths but collapses smartly) -->
        <div class="col-12 col-lg-5 col-xl-4">
            <div class="sticky-lg-top" style="top: 2rem; z-index: 10;">
                <h5 class="fw-bold mb-4 px-2">Curated Picks</h5>
                
                <div class="d-flex flex-column gap-4 mb-5">
                    <?php 
                    // We'll reuse the first few articles to mock "Curated Picks"
                    $curated = array_slice($articles, 0, 3);
                    foreach($curated as $item): ?>
                    <div class="d-flex gap-3 align-items-center group" style="cursor: pointer;">
                        <img src="<?= htmlspecialchars($item['image_url'] ?: BASE_URL . 'public/images/unsplash/curated.jpg') ?>" class="rounded-4 object-fit-cover shadow-sm" style="width: 80px; height: 80px;">
                        <div>
                            <div class="text-muted fw-bold mb-1" style="font-size: 0.65rem;"><i class="bi bi-circle-fill text-primary-custom me-1" style="font-size: 5px;"></i> <?= htmlspecialchars($item['category_name']) ?></div>
                            <h6 class="fw-bold mb-1 lh-sm" style="font-size: 0.85rem;">
                                <a href="<?= BASE_URL ?>article/show/<?= $item['id'] ?>" class="text-dark text-decoration-none"><?= htmlspecialchars($item['title']) ?></a>
                            </h6>
                            <div class="text-muted" style="font-size: 0.75rem;">12 July 2024 &bull; 4 min read</div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Recommended Follows Simulator -->
                <div class="mt-5 pt-4 border-top">
                    <h5 class="fw-bold mb-4 px-2">Recommended Follows</h5>
                    
                    <div class="d-flex align-items-center justify-content-between mb-3 px-2">
                        <div class="d-flex align-items-center gap-3">
                            <img src="<?= BASE_URL ?>public/images/unsplash/avatar3.jpg" width="40" height="40" class="rounded-circle border border-2 border-white shadow-sm">
                            <span class="fw-bold small text-dark">Haylie Botosh</span>
                        </div>
                        <button class="btn btn-sm btn-outline-pill py-1 fs-7">Follow +</button>
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-between mb-3 px-2">
                        <div class="d-flex align-items-center gap-3">
                            <img src="<?= BASE_URL ?>public/images/unsplash/avatar2.jpg" width="40" height="40" class="rounded-circle border border-2 border-white shadow-sm">
                            <span class="fw-bold small text-dark">Emerson Dias</span>
                        </div>
                        <button class="btn btn-sm btn-outline-pill py-1 fs-7">Follow +</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.banner-bg { background: linear-gradient(90deg, #1e293b 0%, #0f172a 100%); }
.hover-bg-light:hover { background-color: #fff; color: #000; }
.scrollbar-hide::-webkit-scrollbar { display: none; }
.scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
.hover-opacity-100 { opacity: 1 !important; }
.group:hover h6 a { color: var(--primary-color) !important; }
</style>
