<?php
    if(!defined("__MAPC__")) { exit(); }

    /**
     *
     * Very necessary config, almost config file located in app/site/config/ directory.
     *
     */

    { // BLOCK:basic_config:20150807:기본값지정

        // default, sample, cms and you can make your own SITE_CODE (/app/site/YOUR_OWN)
      define("SITE_CODE", "default");

        // make false before publish
      define("DEBUG_MODE", false);

    } // BLOCK

// end of file
