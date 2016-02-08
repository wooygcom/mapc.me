function array_splice(arr, offst, lgth, replacement) {
  //  discuss at: http://phpjs.org/functions/array_splice/
  // original by: Brett Zamir (http://brett-zamir.me)
  //    input by: Theriault
  //        note: Order does get shifted in associative array input with numeric indices,
  //        note: since PHP behavior doesn't preserve keys, but I understand order is
  //        note: not reliable anyways
  //        note: Note also that IE retains information about property position even
  //        note: after being supposedly deleted, so use of this function may produce
  //        note: unexpected results in IE if you later attempt to add back properties
  //        note: with the same keys that had been deleted
  //  depends on: is_int
  //   example 1: input = {4: "red", 'abc': "green", 2: "blue", 'dud': "yellow"};
  //   example 1: array_splice(input, 2);
  //   returns 1: {0: "blue", 'dud': "yellow"}
  //   example 2: input = ["red", "green", "blue", "yellow"];
  //   example 2: array_splice(input, 3, 0, "purple");
  //   returns 2: []
  //   example 3: input = ["red", "green", "blue", "yellow"]
  //   example 3: array_splice(input, -1, 1, ["black", "maroon"]);
  //   returns 3: ["yellow"]

  var _checkToUpIndices = function(arr, ct, key) {
    // Deal with situation, e.g., if encounter index 4 and try to set it to 0, but 0 exists later in loop (need to
    // increment all subsequent (skipping current key, since we need its value below) until find unused)
    if (arr[ct] !== undefined) {
      var tmp = ct;
      ct += 1;
      if (ct === key) {
        ct += 1;
      }
      ct = _checkToUpIndices(arr, ct, key);
      arr[ct] = arr[tmp];
      delete arr[tmp];
    }
    return ct;
  };

  if (replacement && typeof replacement !== 'object') {
    replacement = [replacement];
  }
  if (lgth === undefined) {
    lgth = offst >= 0 ? arr.length - offst : -offst;
  } else if (lgth < 0) {
    lgth = (offst >= 0 ? arr.length - offst : -offst) + lgth;
  }

  if (Object.prototype.toString.call(arr) !== '[object Array]') {
    /*if (arr.length !== undefined) {
     // Deal with array-like objects as input
    delete arr.length;
    }*/
    var lgt = 0,
      ct = -1,
      rmvd = [],
      rmvdObj = {},
      repl_ct = -1,
      int_ct = -1;
    var returnArr = true,
      rmvd_ct = 0,
      rmvd_lgth = 0,
      key = '';
    // rmvdObj.length = 0;
    for (key in arr) {
      // Can do arr.__count__ in some browsers
      lgt += 1;
    }
    offst = (offst >= 0) ? offst : lgt + offst;
    for (key in arr) {
      ct += 1;
      if (ct < offst) {
        if (this.is_int(key)) {
          int_ct += 1;
          if (parseInt(key, 10) === int_ct) {
            // Key is already numbered ok, so don't need to change key for value
            continue;
          }
          // Deal with situation, e.g.,
          _checkToUpIndices(arr, int_ct, key);
          // if encounter index 4 and try to set it to 0, but 0 exists later in loop
          arr[int_ct] = arr[key];
          delete arr[key];
        }
        continue;
      }
      if (returnArr && this.is_int(key)) {
        rmvd.push(arr[key]);
        // PHP starts over here too
        rmvdObj[rmvd_ct++] = arr[key];
      } else {
        rmvdObj[key] = arr[key];
        returnArr = false;
      }
      rmvd_lgth += 1;
      // rmvdObj.length += 1;
      if (replacement && replacement[++repl_ct]) {
        arr[key] = replacement[repl_ct];
      } else {
        delete arr[key];
      }
    }
    // Make (back) into an array-like object
    // arr.length = lgt - rmvd_lgth + (replacement ? replacement.length : 0);
    return returnArr ? rmvd : rmvdObj;
  }

  if (replacement) {
    replacement.unshift(offst, lgth);
    return Array.prototype.splice.apply(arr, replacement);
  }
  return arr.splice(offst, lgth);
}