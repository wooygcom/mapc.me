<?php
// Path of locale files
$locale_path = CONFIG_PATH . "locale/";

// locale set
$domain = "messages";

/**
 *
 * Get LOCALE
 *
 */
// 1st - from user
if ($_REQUEST['locale']) {
    $locale = $_REQUEST['locale'];
// 2nd - from SESSION
} elseif (isset($_SESSION["locale"])) {
    $locale = $_SESSION["locale"];
// 3rd - frome HTTP_ACCEPT_LANGUAGE
} else {
    $locale = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 5);
}

if(! in_array($locale, $CONFIG['lang']['support'])) {
    $locale = $CONFIG['lang']['support'][0];
}

// Set default locale if locale file unavailable
if (! is_dir($locale_path . $locale) ) {
    $locale = $CONFIG['locale'];
}

putenv("LANG=" . $locale);
setlocale(LC_ALL, $locale);
$_SESSION['locale'] = $locale;

bindtextdomain($domain, $locale_path);
bind_textdomain_codeset($domain, 'UTF-8');

textdomain($domain);

unset($locale_path, $available, $domain);

return $locale;

// this is it
