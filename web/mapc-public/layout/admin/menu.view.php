<?php

    $active_page = $ARGS['modl'] . '/' . $ARGS['page'] . '/';

    return create_list_bkop($VIEW['menu_data'], 0, $active_page);

    function array_key_exists_recur($needle, $array) {

        foreach ($array as $key => $value) {
            if ($key == $needle) { return $value; }

            if (is_array($value)) {
                if ($x = array_key_exists_recur($needle, $value)) { return $x; }
            }
        }
        return false;
    }

    function create_list_bkop( $arr ,$urutan, $active_page )
    {

        if ($urutan==0) {
             $html = "\n<ul class='sidebar-menu'>\n";
        } else {
             $html = "\n<ul class='treeview-menu'>\n";
        }

        foreach ($arr as $key => $v) {

            // 메뉴활성화
            if ( ($key == $active_page) || (array_key_exists_recur($active_page, $v['_sub'])) ) {
                $active = 'active';
            } else {
                $active = '';
            }

            if (array_key_exists('_sub', $v)) {

                $icon = $v['_icon'] ? $v['_icon'] : 'fa fa-circle-o';
                $html .= "<li class='" . $active . " treeview'>\n";
                $html .= '<a href="#">
                                <i class="'.$icon.'"></i>
                                <span>'.$v['_title'].'</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>';
 
                $html .= create_list_bkop($v['_sub'], 1, $active_page);
                $html .= "</li>\n";

            } else {

                $html .= '<li class="'.$active.'"><a href="'.$v['_link'].'">';

                if($urutan==0) {
                    $html .=    '<i class="' . $icon . '"></i>';
                }
                if($urutan==1) {
                    $html .=    '<i class="fa fa-angle-double-right"></i>';
                }

                $html .= $v['_title']."</a></li>\n";
            }
        }

        $html .= "</ul>\n";

        return $html;

    }

// end of file
