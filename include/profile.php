<div class="modal fade" id="popupProfileModal" tabindex="-1" aria-labelledby="popupProfileModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="card" style="background: none; border: none;">
                <div class="card-body">
                    <div class="profilepic" id="changePhoto">
                        <?php
                        $filename = $directory . "avatar/" . $_SESSION["user_id"] . '.png';
                        if (file_exists($filename)) {
                            echo ' <img class="profilepic-image" src="' . $filename . '"
                            width="125" height="125" alt="User Avatar" />';
                        } else {
                            echo ' <img class="profilepic-image" src="' . $directory . 'images/defaultprofile.png"
                            width="125" height="125" alt="Default Profile Image" />';
                        }
                        ?>
                       
                        <div class="profilepic-content">
                            <span class="profilepic-icon"><i class="fas fa-camera"></i></span>
                            <span class="profilepic-text">Change Photo</span>
                        </div>
                    </div>

                    <h5 class="title mb-1 mt-3 text-capitalize">
                        <?php echo $dec_user_name; ?>
                    </h5>
                    <hr class="mt-5">
                    <a href="<?php echo $directory ?>change-password?ref=profile"><i
                            class="fa-solid fa-lock"></i>&nbsp;&nbsp;Change
                        Password</a> &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="<?php echo $directory ?>logout?ref=profile"><i
                            class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp;&nbsp;Logout</a>
                </div>

            </div>
        </div>
    </div>
</div>