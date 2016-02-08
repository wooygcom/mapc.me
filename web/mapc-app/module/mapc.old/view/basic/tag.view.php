<style type="text/css">
#tagcloud{
    width:100%;
	text-align: center;
}

#tagcloud a{
        color: green;
        text-decoration: none;
        text-transform: capitalize;
}
</style>

<div class="panel panel-default text-center">
    <?php
    /** this is our array of tags
     * We feed this array of tags and links the tagCloud
     * class method createTagCloud
     */
    foreach($tag_list as $key => $var) {
        $tags[$key]['tagname'] =  $var['name'];
        $tags[$key]['weight']  = ($var['num'] <= 50) ? ($var['num']) : 50;
        $tags[$key]['url']     =  $URL['mapc']['list'] . '&mapc_search_key=dc_subject:' . $var['name'];
    }

    /*** create a new tag cloud object ***/
    $tagCloud = new tagCloud($tags);

    echo $tagCloud -> displayTagCloud();

    ?>
</div>

<?php

class tagCloud{

    // the array of tags
    private $tagsArray;


    public function __construct($tags){
        // set a few properties
        $this->tagsArray = $tags;
    }

    /**
     *
     * Display tag cloud
     *
     * @access public
     *
     * @return string
     *
     */
    public function displayTagCloud(){
        $ret = '';
        $sep = '';
        if(is_array($this->tagsArray)) {
            shuffle($this->tagsArray);
            foreach($this->tagsArray as $tag) {
                $ret .= $sep . '<a style="font-size: '.$tag['weight'].'px;" href="'.$tag['url'].'">'.$tag['tagname'].'</a>'."\n";
                $sep  = ', ';
            }
        } else {
            $ret = '&nbsp;';
        }
        return $ret;
    }

} /*** end of class ***/

?>
