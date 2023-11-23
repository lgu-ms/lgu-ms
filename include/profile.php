<div class="modal fade" id="popupProfileModal" tabindex="-1" aria-labelledby="popupProfileModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="card" style="background: none; border: none;">
                <div class="card-body">
                    <img loading="lazy" src="<?php echo $directory ?>images/defaultprofile.png"
                        class="mx-auto d-block img-fluid circle-png" alt="" width="150">
                    <h5 class="title mb-1 mt-3 text-capitalize">
                        <?php echo $dec_user_name; ?>
                    </h5>
                    <hr class="mt-5">
                    <a  href="<?php echo $directory ?>change-password?ref=profile"><i class="fa-solid fa-lock"></i>&nbsp;&nbsp;Change
                        Password</a> &nbsp;&nbsp;&nbsp;&nbsp;
                    <a  href="<?php echo $directory ?>logout?ref=profile"><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp;&nbsp;Logout</a>
                </div>

            </div>
        </div>
    </div>
</div>