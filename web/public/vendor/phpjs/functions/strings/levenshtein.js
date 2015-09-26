function levenshtein(s1, s2, cost_ins, cost_rep, cost_del) {
  //       discuss at: http://phpjs.org/functions/levenshtein/
  //      original by: Carlos R. L. Rodrigues (http://www.jsfromhell.com)
  //      bugfixed by: Onno Marsman
  //       revised by: Andrea Giammarchi (http://webreflection.blogspot.com)
  // reimplemented by: Brett Zamir (http://brett-zamir.me)
  // reimplemented by: Alexander M Beedie
  // reimplemented by: Rafał Kukawski
  //        example 1: levenshtein('Kevin van Zonneveld', 'Kevin van Sommeveld');
  //        returns 1: 3
  //        example 2: levenshtein("carrrot", "carrots");
  //        returns 2: 2
  //        example 3: levenshtein("carrrot", "carrots", 2, 3, 4);
  //        returns 3: 6

  var LEVENSHTEIN_MAX_LENGTH = 255; // PHP limits the function to max 255 character-long strings

  cost_ins = cost_ins == null ? 1 : +cost_ins;
  cost_rep = cost_rep == null ? 1 : +cost_rep;
  cost_del = cost_del == null ? 1 : +cost_del;

  if (s1 == s2) {
    return 0;
  }

  var l1 = s1.length;
  var l2 = s2.length;

  if (l1 === 0) {
    return l2 * cost_ins;
  }
  if (l2 === 0) {
    return l1 * cost_del;
  }

  // Enable the 3 lines below to set the same limits on string length as PHP does
  /*if (l1 > LEVENSHTEIN_MAX_LENGTH || l2 > LEVENSHTEIN_MAX_LENGTH) {
    return -1;
  }*/

  // BEGIN STATIC
  var split = false;
  try {
    split = !('0')[0];
  } catch (e) {
    // Earlier IE may not support access by string index
    split = true;
  }
  // END STATIC
  if (split) {
    s1 = s1.split('');
    s2 = s2.split('');
  }

  var p1 = new Array(l2 + 1);
  var p2 = new Array(l2 + 1);

  var i1, i2, c0, c1, c2, tmp;

  for (i2 = 0; i2 <= l2; i2++) {
    p1[i2] = i2 * cost_ins;
  }

  for (i1 = 0; i1 < l1; i1++) {
    p2[0] = p1[0] + cost_del;

    for (i2 = 0; i2 < l2; i2++) {
      c0 = p1[i2] + ((s1[i1] == s2[i2]) ? 0 : cost_rep);
      c1 = p1[i2 + 1] + cost_del;

      if (c1 < c0) {
        c0 = c1;
      }

      c2 = p2[i2] + cost_ins;

      if (c2 < c0) {
        c0 = c2;
      }

      p2[i2 + 1] = c0;
    }

    tmp = p1;
    p1 = p2;
    p2 = tmp;
  }

  c0 = p1[l2];

  return c0;
}