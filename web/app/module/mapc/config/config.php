<?php
if(!defined('__MAPC__')) { exit(); }

/**
 * URL & PATH
 */
$MODULE['mapc']['installed'] = TRUE;

$PATH['mapc']['root'] = MODULE_PATH . 'mapc/';
$PATH['mapc']['view'] = MODULE_PATH . 'mapc/view/';
$PATH['mapc']['data'] = DATA_PATH . 'mapc/';

$URL['mapc']['root']     = $URL['core']['root'] . 'mapc/';
$URL['mapc']['edit']     = $URL['mapc']['root'] . 'edit/';
$URL['mapc']['edit_act'] = $URL['mapc']['root'] . 'edit_act/';
$URL['mapc']['del']      = $URL['mapc']['root'] . 'del/';
$URL['mapc']['view']     = $URL['mapc']['root'] . 'view/';
$URL['mapc']['list']     = $URL['mapc']['root'] . 'list/';
$URL['mapc']['scrap']    = $URL['mapc']['root'] . 'scrap/';
$URL['mapc']['scrap_act']= $URL['mapc']['root'] . 'scrap_act/';
$URL['mapc']['file_view']= $URL['mapc']['root'] . 'file/';

/**
 * 모듈 환경설정
 *
 * 각 모듈별 환경설정이 필요할 경우 이곳에서 설정
 */

{ // BLOCK:mapc_cate_edit:20131214:어떤 형태의 글을 쓸지에 대한 환경설정

    // #TODO 환경설정에서 변경할 경우 기존에 등록된 글들도 변경되도록!!!!!!!!!!!!!!!!!!!!!!!
    //        (type:설명->설명문 으로 변경할 경우 기존에 "설명"으로 등록된 것도 "설명문"으로 변경되도록)

    $CONFIG_MODL_MAPC['core']['skin'] = $CONFIG['skin'];

    // word : 이름씨를 쓸 경우 글의 type은 text/plain 저장할 디렉토리는 word/...
    $CONFIG_MODL_MAPC['edit']['word']['post_info']['post_origin_type']     = 'text/plain';
    $CONFIG_MODL_MAPC['edit']['word']['postmeta_info']['mapc_dir'][0]      = '이름씨/';
    $CONFIG_MODL_MAPC['edit']['word']['postmeta_info']['dc_subject'][0]    = '이름씨';
    $CONFIG_MODL_MAPC['edit']['word']['postmeta_info']['dc_subject_id'][0] = 'A3W1FXJYPZ5EHRTNS8V4';
    $CONFIG_MODL_MAPC['edit']['word']['postmeta_info']['dc_type'][0]    = '정의';
    $CONFIG_MODL_MAPC['edit']['word']['postmeta_info']['dc_type_id'][0] = 'XHVYMN287ZSTF4JWUPQA';
    $CONFIG_MODL_MAPC['edit']['word']['publish_check_option']['mapc_make_file__uid'] = true;

    // memo : 적바림
    $CONFIG_MODL_MAPC['edit']['memo']['post_info']['post_origin_type']  = 'text/markdown';
    $CONFIG_MODL_MAPC['edit']['memo']['postmeta_info']['mapc_dir'][0]   = '적바림/';
    $CONFIG_MODL_MAPC['edit']['memo']['postmeta_info']['dc_type'][0]    = '적바림';
    $CONFIG_MODL_MAPC['edit']['memo']['postmeta_info']['dc_type_id'][0] = 'N3A2HX9FEWTGC6Q78KMV';

    // quiz : 퀴즈
    $CONFIG_MODL_MAPC['edit']['quiz']['post_info']['post_origin_type']  = 'text/markdown';
    $CONFIG_MODL_MAPC['edit']['quiz']['postmeta_info']['mapc_dir'][0]   = '퀴즈/';
    $CONFIG_MODL_MAPC['edit']['quiz']['postmeta_info']['dc_subject'][0]    = '퀴즈';
    $CONFIG_MODL_MAPC['edit']['quiz']['postmeta_info']['dc_subject_id'][0] = 'SUQPCELTYB1K7MA326F4';

    // diary
    $CONFIG_MODL_MAPC['edit']['diary']['post_info']['post_origin_type']     = 'text/markdown';
    $CONFIG_MODL_MAPC['edit']['diary']['postmeta_info']['mapc_dir'][0]      = '날적이/';
    $CONFIG_MODL_MAPC['edit']['diary']['postmeta_info']['dc_type'][0]    = '날적이';
    $CONFIG_MODL_MAPC['edit']['diary']['postmeta_info']['dc_type_id'][0] = 'UHFLS46E1B257KDR3YXZ';
    $CONFIG_MODL_MAPC['edit']['diary']['publish_check_option']['mapc_make_file__date'] = true;

    // proverb
    $CONFIG_MODL_MAPC['edit']['proverb']['post_info']['post_origin_type']     = 'text/markdown';
    $CONFIG_MODL_MAPC['edit']['proverb']['postmeta_info']['mapc_dir'][0]      = '좋은글/';
    $CONFIG_MODL_MAPC['edit']['proverb']['postmeta_info']['dc_subject'][0]    = '좋은글';
    $CONFIG_MODL_MAPC['edit']['proverb']['postmeta_info']['dc_subject_id'][0] = 'RE39GU51Q8SY74XFN2CB';

    // satire
    $CONFIG_MODL_MAPC['edit']['satire']['post_info']['post_origin_type']     = 'file';
    $CONFIG_MODL_MAPC['edit']['satire']['postmeta_info']['mapc_dir'][0]      = '풍자/';
    $CONFIG_MODL_MAPC['edit']['satire']['postmeta_info']['dc_subject'][0]    = '풍자';
    $CONFIG_MODL_MAPC['edit']['satire']['postmeta_info']['dc_subject_id'][0] = '8ZUB12GVNATDFPH9R7WS';

    // animal_picture
    $CONFIG_MODL_MAPC['edit']['animal_picture']['post_info']['post_origin_type']     = 'file';
    $CONFIG_MODL_MAPC['edit']['animal_picture']['postmeta_info']['mapc_dir'][0]      = '동물/';
    $CONFIG_MODL_MAPC['edit']['animal_picture']['postmeta_info']['dc_subject'][0]    = '반려동물';
    $CONFIG_MODL_MAPC['edit']['animal_picture']['postmeta_info']['dc_subject_id'][0] = 'AYBR9ULVHGSQEWKXP7MT';

    // landscape_picture
    $CONFIG_MODL_MAPC['edit']['landscape_picture']['post_info']['post_origin_type']     = 'file';
    $CONFIG_MODL_MAPC['edit']['landscape_picture']['postmeta_info']['mapc_dir'][0]      = '풍경/';
    $CONFIG_MODL_MAPC['edit']['landscape_picture']['postmeta_info']['dc_subject'][0]    = '풍경';
    $CONFIG_MODL_MAPC['edit']['landscape_picture']['postmeta_info']['dc_subject_id'][0] = 'J72VF3XP8Q61A5N9WLDR';

} // BLOCK

// end of file
