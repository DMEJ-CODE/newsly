<div class="px-0 px-md-4 py-3 py-md-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <!-- Sleek Back Navigation -->
            <a href="<?= BASE_URL ?>dashboard" class="text-decoration-none text-muted fw-bold small d-inline-flex align-items-center mb-4 btn btn-white border shadow-sm rounded-pill px-3 py-2 ms-3 ms-md-0">
                <i class="bi bi-arrow-left me-2"></i> Back to Feed
            </a>

            <!-- Article Header -->
            <div class="mb-4 mb-md-5 px-3 px-md-0">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <span class="badge badge-pill-light bg-dark text-white shadow-sm border px-3 py-2">
                        <i class="bi bi-hash text-warning me-1"></i> <?= htmlspecialchars($article['category_name']) ?>
                    </span>
                    <span class="text-muted small fw-bold"><i class="bi bi-clock me-1"></i> <?= date('F j, Y', strtotime($article['published_at'])) ?></span>
                </div>
                
                <h1 class="fw-extrabold text-dark hero-title lh-sm tracking-tight mb-4">
                    <?= htmlspecialchars($article['title']) ?>
                </h1>
                
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between border-top border-bottom py-3 mt-4 gap-4">
                    <div class="d-flex align-items-center gap-3 px-3 px-md-0">
                        <img src="<?= BASE_URL ?>public/images/unsplash/avatar1.jpg" width="48" height="48" class="rounded-circle border border-2 border-white shadow-sm">
                        <div>
                            <div class="fw-bold text-dark lh-sm"><?= htmlspecialchars($article['source_name'] ?: 'Independent Editor') ?></div>
                            <div class="text-muted small fw-medium" style="font-size: 0.75rem;">Staff Publisher</div>
                        </div>
                    </div>
                    
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="px-3 px-md-0">
                            <form action="<?= BASE_URL ?>bookmark/toggle" method="POST" class="m-0">
                                <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                                <input type="hidden" name="redirect_to" value="article/show/<?= $article['id'] ?>">
                                <button type="submit" class="btn btn-outline-pill <?= $isBookmarked ? 'bg-warning text-dark border-warning' : 'bg-white' ?> d-flex align-items-center justify-content-center gap-2 shadow-sm py-2 px-4 w-100">
                                    <i class="bi <?= $isBookmarked ? 'bi-bookmark-fill' : 'bi-bookmark' ?>"></i> 
                                    <?= $isBookmarked ? 'Saved' : 'Save Story' ?>
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Hero Image -->
            <?php if (!empty($article['image_url'])): ?>
                <div class="mb-4 mb-md-5 position-relative rounded-0 rounded-md-5 overflow-hidden shadow-sm border-0 border-md-4 border-white" style="aspect-ratio: 16/9; min-height: 200px;">
                    <img src="<?= htmlspecialchars($article['image_url']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" class="w-100 h-100 object-fit-cover">
                </div>
            <?php endif; ?>

            <!-- Article Content Body -->
            <div class="article-content bg-white p-3 p-md-5 rounded-0 rounded-md-5 shadow-sm border-0 border-md-1 lh-lg text-dark fs-6 fs-md-5 mb-5 shadow-content">
                <!-- Dropcap style simulation via CSS in the first letter -->
                <div class="content-wrapper">
                    <?= strip_tags($article['content'], '<p><br><b><i><strong><em><a><ul><li><ol>') ?>
                </div>
                
                <!-- Original Source Link -->
                <?php if (!empty($article['source_url'])): ?>
                    <div class="mt-5 pt-4 border-top">
                        <div class="bg-light p-3 p-md-4 rounded-4 border d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                            <div>
                                <h6 class="fw-bold fs-6 mb-1 text-dark">Original Publisher</h6>
                                <p class="text-muted small mb-0 fw-medium">Read the original unedited story.</p>
                            </div>
                            <a href="<?= htmlspecialchars($article['source_url']) ?>" target="_blank" class="btn btn-dark-custom rounded-pill px-4 fw-semibold text-decoration-none d-inline-flex justify-content-center gap-2 pe-3 w-100 w-md-auto">
                                Read Here <i class="bi bi-box-arrow-up-right ms-2 opacity-75"></i>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
.tracking-tight { letter-spacing: -0.04em; }
.article-content { line-height: 1.8 !important; color: #334155; }
.content-wrapper p { margin-bottom: 2rem; font-family: Georgia, serif; }
/* Simulated Dropcap for first paragraph */
.content-wrapper p:first-child::first-letter {
    color: var(--primary-color);
    float: left;
    font-size: clamp(3rem, 10vw, 5rem);
    line-height: 0.8;
    margin-right: 0.5rem;
    font-weight: 800;
    font-family: 'Inter', sans-serif;
}
.article-content a { color: var(--dark-color); border-bottom: 2px solid var(--primary-color); text-decoration: none; font-weight: 600; padding-bottom: 2px; }
.article-content a:hover { background-color: rgba(250, 204, 21, 0.2); }
</style>
