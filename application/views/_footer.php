<!-- =======================
Footer START -->
<footer class="bg-light p-3">
    <div class="container">
        <div class="row align-items-center">

            <!-- Logo -->
            <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
                <a href="<?= base_url(); ?>">
                    <img style="height: 30px;" src="<?= base_url('assets/assets/img/fulllogo_bg.png') ?>" alt="logo">
                </a>
            </div>

            <!-- Copyright -->
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="text-center text-primary-hover">
                    © <?= date('Y') ?> <?= $konfig->judul_website ?>. All rights reserved.
                </div>
            </div>

            <!-- Social media -->
            <div class="col-md-4">
                <ul class="list-inline mb-0 text-center text-md-end">
                    <?php if (!empty($sosmed->facebook)) : ?>
                        <li class="list-inline-item ms-2">
                            <a href="<?= $sosmed->facebook ?>" target="_blank">
                                <i class="text-black fab fa-facebook"></i>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (!empty($sosmed->instagram)) : ?>
                        <li class="list-inline-item ms-2">
                            <a href="<?= $sosmed->instagram ?>" target="_blank">
                                <i class="text-black fab fa-instagram"></i>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (!empty($sosmed->tiktok)) : ?>
                        <li class="list-inline-item ms-2">
                            <a href="<?= $sosmed->tiktok ?>" target="_blank">
                                <i class="text-black fab fa-tiktok"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

        </div>
    </div>
</footer>
<!-- =======================
Footer END -->
