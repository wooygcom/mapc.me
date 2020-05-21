<?php
if(! function_exists('httpAlert')) {
    function httpAlert($message, $url=ROOT_URL, $type="html") {
?>

            <!DOCTYPE html>
                <html>
                <head>
                <meta http-equiv="refresh" content="0;url=<?=$url;?>" />
                <meta charset="UTF-8">
                <title><?= $CONFIG['site']['title']; ?></title>
                <script>alert('<?= $message; ?>');</script>
                </head>

                <body>
                    <?= $message; ?>
                </body>
            </html>

<?php
        exit;
    }
}

// this is it
