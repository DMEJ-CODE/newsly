<div class="px-4 px-lg-5 py-5">
    
    <a href="<?= BASE_URL ?>admin/articles" class="text-decoration-none text-muted fw-bold small d-inline-flex align-items-center mb-4 btn btn-white border shadow-sm rounded-pill px-3 py-2">
        <i class="bi bi-arrow-left me-2"></i> Back to Articles
    </a>

    <div class="d-flex align-items-center mb-5 border-bottom pb-4">
        <div class="bg-dark rounded-circle d-flex align-items-center justify-content-center text-warning me-3 shadow" style="width: 50px; height: 50px;">
            <i class="bi bi-journal-check fs-3"></i>
        </div>
        <div>
            <h2 class="fw-extrabold text-dark tracking-tight mb-1" style="font-size: 2rem;">
                <?= isset($article) ? 'Edit Article' : 'Draft Article' ?>
            </h2>
            <p class="text-muted fw-medium small mb-0">Compose news items and distribute them directly to the feed.</p>
        </div>
    </div>

    <form action="<?= BASE_URL ?>admin/articles/<?= isset($article) ? 'edit/'.$article['id'] : 'create' ?>" method="POST">
        <div class="row g-4">
            
            <!-- Left Main Content Column -->
            <div class="col-lg-8">
                <div class="card bg-white border-0 shadow-sm rounded-5 overflow-hidden mb-5">
                    <div class="card-body p-4 p-md-5">
                        
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger px-4 py-3 border-0 bg-danger bg-opacity-10 text-danger rounded-4 fw-medium mb-4" role="alert">
                                <i class="bi bi-exclamation-octagon-fill me-2 fs-5"></i> <?= htmlspecialchars($error) ?>
                            </div>
                        <?php endif; ?>

                        <div class="mb-4">
                            <label for="title" class="form-label ms-3 small fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">Headline Title</label>
                            <input type="text" class="form-control form-control-custom w-100 fs-5 fw-bold text-dark py-3" id="title" name="title" 
                                value="<?= htmlspecialchars($article['title'] ?? '') ?>" 
                                placeholder="Enter impactful headline..." required autofocus>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label ms-3 small fw-bold text-muted text-uppercase d-flex justify-content-between" style="letter-spacing: 0.5px;">
                                <span>Article Content Body</span>
                                <span class="badge bg-light text-dark shadow-sm border rounded-pill text-capitalize fw-semibold" style="letter-spacing: 0;"><i class="bi bi-code-slash text-warning me-1"></i> HTML Supported</span>
                            </label>
                            <textarea class="form-control form-control-custom w-100" id="content" name="content" rows="15" 
                                placeholder="Start typing the story here..." style="border-radius: 20px;" required><?= htmlspecialchars($article['content'] ?? '') ?></textarea>
                        </div>
                        
                    </div>
                </div>
            </div>

            <!-- Right Sidebar Configuration Column -->
            <div class="col-lg-4">
                
                <!-- Category Box -->
                <div class="card bg-white border-0 shadow-sm rounded-4 overflow-hidden mb-4 p-4">
                    <label for="category_id" class="form-label small fw-bold text-dark text-uppercase d-block mb-3" style="letter-spacing: 0.5px;"><i class="bi bi-folder text-warning me-2"></i> Classification</label>
                    <select class="form-select form-control-custom fw-bold text-dark" id="category_id" name="category_id" required>
                        <option value="" disabled <?= !isset($article) ? 'selected' : '' ?>>Assign a Category...</option>
                        <?php foreach($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= (isset($article) && $article['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Media Box -->
                <div class="card bg-white border-0 shadow-sm rounded-4 overflow-hidden mb-4 p-4">
                    <label for="image_url" class="form-label small fw-bold text-dark text-uppercase d-block mb-3" style="letter-spacing: 0.5px;"><i class="bi bi-image text-warning me-2"></i> Cover Media</label>
                    <?php if (isset($article) && !empty($article['image_url'])): ?>
                        <div class="rounded-3 overflow-hidden shadow-sm mb-3" style="height: 120px;">
                            <img src="<?= htmlspecialchars($article['image_url']) ?>" class="w-100 h-100 object-fit-cover">
                        </div>
                    <?php endif; ?>
                    <input type="url" class="form-control form-control-custom w-100" id="image_url" name="image_url" 
                        value="<?= htmlspecialchars($article['image_url'] ?? '') ?>" 
                        placeholder="https://images.unsplash.com/...">
                </div>

                <!-- Source Box -->
                <div class="card bg-white border-0 shadow-sm rounded-4 overflow-hidden mb-4 p-4">
                    <label class="form-label small fw-bold text-dark text-uppercase d-block mb-3" style="letter-spacing: 0.5px;"><i class="bi bi-link-45deg text-warning me-2"></i> Source & Attribution</label>
                    
                    <div class="mb-3">
                        <label for="source_name" class="form-label ms-2 small fw-bold text-muted" style="font-size: 0.75rem;">Source Name</label>
                        <input type="text" class="form-control form-control-custom w-100 py-2" id="source_name" name="source_name" 
                            value="<?= htmlspecialchars($article['source_name'] ?? '') ?>" placeholder="e.g. The New York Times">
                    </div>
                    
                    <div class="mb-2">
                        <label for="source_url" class="form-label ms-2 small fw-bold text-muted" style="font-size: 0.75rem;">Original Link</label>
                        <input type="url" class="form-control form-control-custom w-100 py-2" id="source_url" name="source_url" 
                            value="<?= htmlspecialchars($article['source_url'] ?? '') ?>" placeholder="https://...">
                    </div>
                </div>

                <!-- Publish Settings Box -->
                <div class="card bg-white border-0 shadow-sm rounded-4 overflow-hidden mb-4 p-4">
                    <label for="published_at" class="form-label small fw-bold text-dark text-uppercase d-block mb-3" style="letter-spacing: 0.5px;"><i class="bi bi-calendar-event text-warning me-2"></i> Timeline</label>
                    <div class="mb-4">
                        <input type="datetime-local" class="form-control form-control-custom w-100 font-monospace text-muted py-2" id="published_at" name="published_at" 
                            value="<?= isset($article) ? date('Y-m-d\TH:i', strtotime($article['published_at'])) : date('Y-m-d\TH:i') ?>">
                    </div>

                    <button type="submit" class="btn btn-primary-custom w-100 fw-bold shadow-sm d-flex justify-content-center align-items-center gap-2">
                        <?= isset($article) ? 'Update Post' : 'Distribute Article' ?> <i class="bi bi-send-fill text-dark fs-5"></i>
                    </button>
                    <a href="<?= BASE_URL ?>admin/articles" class="btn btn-outline-pill bg-white w-100 fw-medium text-muted mt-2 border-0">Cancel Discard</a>
                </div>
            </div>

        </div>
    </form>
</div>

<style>
.form-control-custom { border: 2px solid transparent; background-color: var(--input-bg); }
.form-control-custom:focus { border: 2px solid var(--primary-color) !important; background-color: #fff; }
</style>
