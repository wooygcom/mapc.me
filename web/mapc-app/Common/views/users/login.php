<?php
$layout = 'metro4';

include(LAYOUT_PATH . $layout . '/head.php');
include(LAYOUT_PATH . $layout . '/header.php');
?>

    <form class="login-form bg-white p-6 mx-auto border bd-default win-shadow"
          data-role="validator"
          action="login"
          method="post"
          data-clear-invalid="2000"
          data-on-error-form="invalidForm"
          data-on-validate-form="validateForm">
        <input type="hidden" name="_csrf" value="<?= $_SESSION['csrf']; ?>" />
        <input type="hidden" name="_method" value="update" /><!-- POST, PUT, PATCH, DELETE -->
        <span class="mif-vpn-lock mif-4x place-right" style="margin-top: -10px;"></span>
        <h2 class="text-light"><?php echo '로그인'; ?></h2>
        <hr class="thin mt-4 mb-4 bg-white">
        <div class="form-group">
            <input name="userid" type="text" data-role="input" data-prepend="<span class='mif-envelop'>" placeholder="Enter your email..." data-validate="required email">
        </div>
        <div class="form-group">
            <input name="userpasswd" type="password" data-role="input" data-prepend="<span class='mif-key'>" placeholder="Enter your password..." data-validate="required minlength=6">
        </div>
        <div class="form-group mt-10">
            <input type="checkbox" data-role="checkbox" data-caption="Remember me" class="place-right">
            <button class="button">Submit form</button>
        </div>
    </form>

    <script src="<?= ROOT_URL; ?>vendor/metro4/build/js/metro.js"></script>
    <script>
        function invalidForm(){
            var form  = $(this);
            form.addClass("ani-ring");
            setTimeout(function(){
                form.removeClass("ani-ring");
            }, 1000);
        }

        function validateForm(){
            $(".login-form").animate({
                opacity: 0
            });
        }
    </script>

<?php
include(LAYOUT_PATH . $layout . '/footer.php');
include(LAYOUT_PATH . $layout . '/foot.php');

// this is it
