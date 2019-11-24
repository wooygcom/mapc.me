<?php
function uuidGen($args = ['type' => 'simple']) {
    switch($args['type']) {
        case 'simple':
            return sprintf('%04x%08x',
                mt_rand(0, 0xffff), mt_rand(0, 0xffffffff)
            );
            break;
        default:
            return sprintf('%08x-%04x-%04x-%04x-%04x%08x',
                mt_rand(0, 0xffffffff),
                mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
                mt_rand(0, 0xffff), mt_rand(0, 0xffffffff)
            );
            break;
    }
}

// this is it
