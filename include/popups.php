<noscript>
    <div class="nojs">
        An error occurred. Try reloading this page, or enable JavaScript if it is disabled in your browser.
    </div>
</noscript>
<div aria-live="polite" aria-atomic="true" class="position-relative">
    <div class="toast-container position-fixed bottom-0 end-0 p-3" id="toastcontainer">

    </div>
</div>
<div class="modal fade" id="popupModal" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="popupModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="popupModalContent">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary px-4" data-bs-dismiss="modal" id="popupModalActionName"></button>
            </div>
        </div>
    </div>
</div>
<?php 
   if (isLogin()) {
       include("profile.php");
   }
?>