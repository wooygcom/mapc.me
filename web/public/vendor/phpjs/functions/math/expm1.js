function expm1(x) {
  //  discuss at: http://phpjs.org/functions/expm1/
  // original by: Brett Zamir (http://brett-zamir.me)
  // improved by: Robert Eisele (http://www.xarg.org/)
  //        note: Precision 'n' can be adjusted as desired
  //   example 1: expm1(1e-15);
  //   returns 1: 1.0000000000000007e-15

  return (x < 1e-5 && -1e-5 < x) ? x + 0.5 * x * x : Math.exp(x) - 1;
}