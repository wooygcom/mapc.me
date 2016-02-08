<script src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.1.20/require.min.js"></script>
<script type="text/javascript">
    require.config({
        paths: {
            'jquery': 'https://code.jquery.com/jquery-2.1.4.min',
            "inputmask.dependencyLib": "<?= $URL['core']['root']; ?>vendor/jquery.inputmask/dist/min/inputmask/inputmask.dependencyLib.jquery.min",
            "jquery.inputmask": "<?= $URL['core']['root']; ?>vendor/jquery.inputmask/dist/min/inputmask/jquery.inputmask.min",
            "inputmask": "<?= $URL['core']['root']; ?>vendor/jquery.inputmask/dist/min/inputmask/inputmask.min",
        },
        shim : {
            'inputmask': {deps:['jquery']}
        }
    });

    requirejs(['jquery', 'jquery.inputmask'], function (jquery, inputmask) {

            $( document ).ready(function() {

                $("#birthday_cvba").inputmask("9999-99-99", {"placeholder":"YYYY-MM-DD"});

            });

    });
</script>
