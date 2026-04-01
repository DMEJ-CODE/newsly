<div class="px-3 px-md-5 py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex align-items-center mb-4 mb-md-5 border-bottom pb-4">
                <div class="bg-dark rounded-circle d-flex align-items-center justify-content-center text-warning me-3 shadow" style="width: 50px; height: 50px;">
                    <i class="bi bi-person-gear fs-3"></i>
                </div>
                <div>
                    <h2 class="fw-extrabold text-dark tracking-tight mb-1 fs-3 fs-md-2" style="color: #1e293b;">Account Settings</h2>
                    <p class="text-muted fw-medium small mb-0">Manage your profile visibility, personalization, and security.</p>
                </div>
            </div>
            
            <div class="card bg-white border-0 shadow-sm rounded-5 overflow-hidden mb-5">
                <div class="card-body p-3 p-md-5">
                    
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger px-4 py-3 border-0 bg-danger bg-opacity-10 text-danger rounded-4 fw-medium mb-4" role="alert">
                            <i class="bi bi-exclamation-octagon-fill me-2 fs-5"></i> <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success px-4 py-3 border-0 bg-success bg-opacity-10 text-success rounded-4 fw-medium mb-4" role="alert">
                            <i class="bi bi-check-circle-fill me-2 fs-5"></i> <?= htmlspecialchars($success) ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= BASE_URL ?>profile" method="POST">
                        <div class="d-flex flex-column flex-md-row mb-4 mb-md-5 align-items-center gap-4 text-center text-md-start">
                            <div class="position-relative">
                                <?php if (!empty($user['avatar'])): ?>
                                    <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="Avatar" class="rounded-circle object-fit-cover shadow" width="120" height="120">
                                <?php else: ?>
                                    <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center text-dark fw-bold shadow" style="width: 120px; height: 120px; font-size: 3rem;">
                                        <?= strtoupper(substr($user['name'], 0, 1)) ?>
                                    </div>
                                <?php endif; ?>
                                <div class="position-absolute bottom-0 end-0 bg-dark text-warning rounded-circle d-flex align-items-center justify-content-center shadow-sm border border-2 border-white" style="width: 36px; height: 36px;">
                                    <i class="bi bi-camera-fill small"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 w-100">
                                <label for="avatar" class="form-label ms-md-3 small fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">Avatar URL</label>
                                <input type="url" class="form-control form-control-custom w-100" id="avatar" name="avatar" value="<?= htmlspecialchars($user['avatar'] ?? '') ?>" placeholder="https://unsplash.com/...">
                                <div class="form-text ms-md-3 small mt-2">Link a public image to update your avatar.</div>
                            </div>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6 mb-2">
                                <label for="name" class="form-label ms-3 small fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">Full Name</label>
                                <input type="text" class="form-control form-control-custom w-100" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
                            </div>
                            
                            <div class="col-md-6 mb-2">
                                <label for="email" class="form-label ms-3 small fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">Registered Email</label>
                                <input type="email" class="form-control form-control-custom w-100 text-muted opacity-75" id="email" value="<?= htmlspecialchars($user['email']) ?>" readonly disabled>
                            </div>
                        </div>
                        
                        <div class="mb-5 mt-4">
                            <label for="bio" class="form-label ms-3 small fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">Author Bio</label>
                            <textarea class="form-control form-control-custom w-100" id="bio" name="bio" rows="4" placeholder="Tell the community who you are..." style="border-radius: 20px;"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
                        </div>
                        
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 mt-md-5 pt-4 border-top gap-4 gap-md-0">
                            <div class="d-flex justify-content-center align-items-center gap-2 text-success bg-success bg-opacity-10 px-3 py-2 rounded-pill small fw-bold w-100 w-md-auto">
                                <i class="bi bi-shield-lock-fill"></i> Data Encrypted
                            </div>
                            <div class="d-flex flex-column flex-sm-row gap-3 w-100 w-md-auto">
                                <a href="<?= BASE_URL ?>dashboard" class="btn btn-outline-pill bg-white px-4 fw-medium text-muted w-100 text-center">Discard</a>
                                <button type="submit" class="btn btn-primary-custom px-5 fw-bold shadow-sm w-100 text-nowrap">
                                    Update Profile <i class="bi bi-arrow-right ms-2 fs-6"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

<style>
.form-control-custom { border: 2px solid transparent; }
.form-control-custom:focus { border: 2px solid var(--primary-color) !important; background-color: #fff; }
.tracking-tight { letter-spacing: -0.04em; }
</style>
