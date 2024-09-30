<!--   Core JS Files   -->
<script src="<?php echo e(\Illuminate\Support\Facades\URL::asset('assets/js/core/popper.min.js')); ?>" ></script>
<script src="<?php echo e(\Illuminate\Support\Facades\URL::asset('assets/js/core/bootstrap.min.js')); ?>" ></script>
<script src="<?php echo e(\Illuminate\Support\Facades\URL::asset('assets/js/plugins/perfect-scrollbar.min.js')); ?>" ></script>
<script src="<?php echo e(\Illuminate\Support\Facades\URL::asset('assets/js/plugins/smooth-scrollbar.min.js')); ?>" ></script>



<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>


<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>



<!-- Nepcha Analytics (nepcha.com) -->
<!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
<script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

<?php echo $__env->yieldContent('scripts'); ?>
<?php /**PATH C:\Users\Suzan\Downloads\evento\evento\resources\views/layout/footer-scripts.blade.php ENDPATH**/ ?>