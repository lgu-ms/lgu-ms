<noscript>
    <div class="nojs">
        <?php echo $getString["nojs"]; ?>
    </div>
</noscript>
<div aria-live="polite" aria-atomic="true" class="position-relative">
    <div class="toast-container position-fixed bottom-0 end-0 p-3" id="toastcontainer">

    </div>
</div>
<div id="mainModal"></div>
<?php 
   if (isLogin()) {
       include("profile.php");
   }
?>