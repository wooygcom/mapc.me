<?php
if(! function_exists('httpAlert')) {
    function httpAlert($message, $url, $type="html") {
?>

            <!DOCTYPE html>
                <html>
                <head>
                <meta http-equiv="refresh" content="0;url=<?= ROOT_URL; ?>" />
                <meta charset="UTF-8">
                <title><?= $CONFIG['site']['title']; ?></title>
                <script>alert('<?= $message; ?>');</script>
                </head>

                <body>
                    <?= $message; ?>
                </body>
            </html>

<?php

    }
}

// this is it
