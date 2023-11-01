
<noscript>
    <div class="nojs">
        An error occurred. Try reloading this page, or enable JavaScript if it is disabled in your browser.
    </div>
</noscript>
<div aria-live="polite" aria-atomic="true" class="position-relative">
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div class="toast" id="error-toast"
          
            data-bs-autohide="true">
            <div class="toast-header">
                <strong class="me-auto"><i class="fa-solid fa-circle-exclamation"></i> &nbsp; Houston!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <p id="error"></p>
            </div>
        </div>
        <div class="toast" id="announcement-toast"
           
            data-bs-autohide="false">
            <div class="toast-header">
                <strong class="me-auto"><i class="fa-solid fa-bell"></i> &nbsp; Announcement</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <p id="announcement"></p>
                <div class="text-muted mb-0" id="announcement-url"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="popupModal" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="popupModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="popupModalContent">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>