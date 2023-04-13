if (window['IPTV'] === undefined) {
    window['IPTV'] = {}; // creates a window object with name IPTV if not present in global space
  }

  IPTV.namespace = function () {
    var o, d;
    $.each(arguments, function (i, v) {
      d = v.split('.');
      o = window[d[0]] = window[d[0]] || {};
      $.each(d.slice(1), function (i, v2) {
        o = o[v2] = o[v2] || {};
      });
    });
    return o;
  };

  IPTV.hasNamespace = function (ns) {
    return eval(ns + ' != undefined');
  };

IPTV.ns = IPTV.namespace;
