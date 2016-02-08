function ctype_lower(text) {
  //  discuss at: http://phpjs.org/functions/ctype_lower/
  // original by: Brett Zamir (http://brett-zamir.me)
  //  depends on: setlocale
  //   example 1: ctype_lower('abc');
  //   returns 1: true

  if (typeof text !== 'string') {
    return false;
  }
  // BEGIN REDUNDANT
  // ensure setup of localization variables takes place
  this.setlocale('LC_ALL', 0);
  // END REDUNDANT
  return text.search(this.php_js.locales[this.php_js.localeCategories.LC_CTYPE].LC_CTYPE.lw) !== -1;
}