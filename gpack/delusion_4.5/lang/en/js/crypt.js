(function () {
    this.MooTools = {version: "1.4.4", build: "adb02e676407521b516ffa10d2dc6b54237a80f9"};
    var q = this.typeOf = function (u) {
        if (u == null) {
            return"null"
        }
        if (u.$family != null) {
            return u.$family()
        }
        if (u.nodeName) {
            if (u.nodeType == 1) {
                return"element"
            }
            if (u.nodeType == 3) {
                return(/\S/).test(u.nodeValue) ? "textnode" : "whitespace"
            }
        } else {
            if (typeof u.length == "number") {
                if (u.callee) {
                    return"arguments"
                }
                if ("item" in u) {
                    return"collection"
                }
            }
        }
        return typeof u
    };
    var k = this.instanceOf = function (w, u) {
        if (w == null) {
            return false
        }
        var v = w.$constructor || w.constructor;
        while (v) {
            if (v === u) {
                return true
            }
            v = v.parent
        }
        if (!w.hasOwnProperty) {
            return false
        }
        return w instanceof u
    };
    var f = this.Function;
    var r = true;
    for (var l in {toString: 1}) {
        r = null
    }
    if (r) {
        r = ["hasOwnProperty", "valueOf", "isPrototypeOf", "propertyIsEnumerable", "toLocaleString", "toString", "constructor"]
    }
    f.prototype.overloadSetter = function (v) {
        var u = this;
        return function (x, w) {
            if (x == null) {
                return this
            }
            if (v || typeof x != "string") {
                for (var y in x) {
                    u.call(this, y, x[y])
                }
                if (r) {
                    for (var z = r.length; z--;) {
                        y = r[z];
                        if (x.hasOwnProperty(y)) {
                            u.call(this, y, x[y])
                        }
                    }
                }
            } else {
                u.call(this, x, w)
            }
            return this
        }
    };
    f.prototype.overloadGetter = function (v) {
        var u = this;
        return function (x) {
            var y, w;
            if (v || typeof x != "string") {
                y = x
            } else {
                if (arguments.length > 1) {
                    y = arguments
                }
            }
            if (y) {
                w = {};
                for (var z = 0; z < y.length; z++) {
                    w[y[z]] = u.call(this, y[z])
                }
            } else {
                w = u.call(this, x)
            }
            return w
        }
    };
    f.prototype.extend = function (u, v) {
        this[u] = v
    }.overloadSetter();
    f.prototype.implement = function (u, v) {
        this.prototype[u] = v
    }.overloadSetter();
    var o = Array.prototype.slice;
    f.from = function (u) {
        return(q(u) == "function") ? u : function () {
            return u
        }
    };
    Array.from = function (u) {
        if (u == null) {
            return[]
        }
        return(a.isEnumerable(u) && typeof u != "string") ? (q(u) == "array") ? u : o.call(u) : [u]
    };
    Number.from = function (v) {
        var u = parseFloat(v);
        return isFinite(u) ? u : null
    };
    String.from = function (u) {
        return u + ""
    };
    f.implement({hide: function () {
        this.$hidden = true;
        return this
    }, protect: function () {
        this.$protected = true;
        return this
    }});
    var a = this.Type = function (x, w) {
        if (x) {
            var v = x.toLowerCase();
            var u = function (y) {
                return(q(y) == v)
            };
            a["is" + x] = u;
            if (w != null) {
                w.prototype.$family = (function () {
                    return v
                }).hide()
            }
        }
        if (w == null) {
            return null
        }
        w.extend(this);
        w.$constructor = a;
        w.prototype.$constructor = w;
        return w
    };
    var e = Object.prototype.toString;
    a.isEnumerable = function (u) {
        return(u != null && typeof u.length == "number" && e.call(u) != "[object Function]")
    };
    var s = {};
    var t = function (u) {
        var v = q(u.prototype);
        return s[v] || (s[v] = [])
    };
    var b = function (v, z) {
        if (z && z.$hidden) {
            return
        }
        var u = t(this);
        for (var w = 0; w < u.length; w++) {
            var y = u[w];
            if (q(y) == "type") {
                b.call(y, v, z)
            } else {
                y.call(this, v, z)
            }
        }
        var x = this.prototype[v];
        if (x == null || !x.$protected) {
            this.prototype[v] = z
        }
        if (this[v] == null && q(z) == "function") {
            n.call(this, v, function (A) {
                return z.apply(A, o.call(arguments, 1))
            })
        }
    };
    var n = function (u, w) {
        if (w && w.$hidden) {
            return
        }
        var v = this[u];
        if (v == null || !v.$protected) {
            this[u] = w
        }
    };
    a.implement({implement: b.overloadSetter(), extend: n.overloadSetter(), alias: function (u, v) {
        b.call(this, u, this.prototype[v])
    }.overloadSetter(), mirror: function (u) {
        t(this).push(u);
        return this
    }});
    new a("Type", a);
    var d = function (u, z, x) {
        var w = (z != Object), D = z.prototype;
        if (w) {
            z = new a(u, z)
        }
        for (var A = 0, y = x.length; A < y; A++) {
            var E = x[A], C = z[E], B = D[E];
            if (C) {
                C.protect()
            }
            if (w && B) {
                z.implement(E, B.protect())
            }
        }
        if (w) {
            var v = D.propertyIsEnumerable(x[0]);
            z.forEachMethod = function (I) {
                if (!v) {
                    for (var H = 0, F = x.length; H < F; H++) {
                        I.call(D, D[x[H]], x[H])
                    }
                }
                for (var G in D) {
                    I.call(D, D[G], G)
                }
            }
        }
        return d
    };
    d("String", String, ["charAt", "charCodeAt", "concat", "indexOf", "lastIndexOf", "match", "quote", "replace", "search", "slice", "split", "substr", "substring", "trim", "toLowerCase", "toUpperCase"])("Array", Array, ["pop", "push", "reverse", "shift", "sort", "splice", "unshift", "concat", "join", "slice", "indexOf", "lastIndexOf", "filter", "forEach", "every", "map", "some", "reduce", "reduceRight"])("Number", Number, ["toExponential", "toFixed", "toLocaleString", "toPrecision"])("Function", f, ["apply", "call", "bind"])("RegExp", RegExp, ["exec", "test"])("Object", Object, ["create", "defineProperty", "defineProperties", "keys", "getPrototypeOf", "getOwnPropertyDescriptor", "getOwnPropertyNames", "preventExtensions", "isExtensible", "seal", "isSealed", "freeze", "isFrozen"])("Date", Date, ["now"]);
    Object.extend = n.overloadSetter();
    Date.extend("now", function () {
        return +(new Date)
    });
    new a("Boolean", Boolean);
    Number.prototype.$family = function () {
        return isFinite(this) ? "number" : "null"
    }.hide();
    Number.extend("random", function (v, u) {
        return Math.floor(Math.random() * (u - v + 1) + v)
    });
    var g = Object.prototype.hasOwnProperty;
    Object.extend("forEach", function (u, w, x) {
        for (var v in u) {
            if (g.call(u, v)) {
                w.call(x, u[v], v, u)
            }
        }
    });
    Object.each = Object.forEach;
    Array.implement({forEach: function (w, x) {
        for (var v = 0, u = this.length; v < u; v++) {
            if (v in this) {
                w.call(x, this[v], v, this)
            }
        }
    }, each: function (u, v) {
        Array.forEach(this, u, v);
        return this
    }});
    var m = function (u) {
        switch (q(u)) {
            case"array":
                return u.clone();
            case"object":
                return Object.clone(u);
            default:
                return u
        }
    };
    Array.implement("clone", function () {
        var u = this.length, v = new Array(u);
        while (u--) {
            v[u] = m(this[u])
        }
        return v
    });
    var h = function (v, u, w) {
        switch (q(w)) {
            case"object":
                if (q(v[u]) == "object") {
                    Object.merge(v[u], w)
                } else {
                    v[u] = Object.clone(w)
                }
                break;
            case"array":
                v[u] = w.clone();
                break;
            default:
                v[u] = w
        }
        return v
    };
    Object.extend({merge: function (B, x, w) {
        if (q(x) == "string") {
            return h(B, x, w)
        }
        for (var A = 1, u = arguments.length; A < u; A++) {
            var y = arguments[A];
            for (var z in y) {
                h(B, z, y[z])
            }
        }
        return B
    }, clone: function (u) {
        var w = {};
        for (var v in u) {
            w[v] = m(u[v])
        }
        return w
    }, append: function (y) {
        for (var x = 1, v = arguments.length; x < v; x++) {
            var u = arguments[x] || {};
            for (var w in u) {
                y[w] = u[w]
            }
        }
        return y
    }});
    ["Object", "WhiteSpace", "TextNode", "Collection", "Arguments"].each(function (u) {
        new a(u)
    });
    var c = Date.now();
    String.extend("uniqueID", function () {
        return(c++).toString(36)
    })
})();
Array.implement({every: function (c, d) {
    for (var b = 0, a = this.length >>> 0; b < a; b++) {
        if ((b in this) && !c.call(d, this[b], b, this)) {
            return false
        }
    }
    return true
}, filter: function (d, f) {
    var c = [];
    for (var e, b = 0, a = this.length >>> 0; b < a; b++) {
        if (b in this) {
            e = this[b];
            if (d.call(f, e, b, this)) {
                c.push(e)
            }
        }
    }
    return c
}, indexOf: function (c, d) {
    var b = this.length >>> 0;
    for (var a = (d < 0) ? Math.max(0, b + d) : d || 0; a < b; a++) {
        if (this[a] === c) {
            return a
        }
    }
    return -1
}, map: function (c, e) {
    var d = this.length >>> 0, b = Array(d);
    for (var a = 0;
         a < d; a++) {
        if (a in this) {
            b[a] = c.call(e, this[a], a, this)
        }
    }
    return b
}, some: function (c, d) {
    for (var b = 0, a = this.length >>> 0; b < a; b++) {
        if ((b in this) && c.call(d, this[b], b, this)) {
            return true
        }
    }
    return false
}, clean: function () {
    return this.filter(function (a) {
        return a != null
    })
}, invoke: function (a) {
    var b = Array.slice(arguments, 1);
    return this.map(function (c) {
        return c[a].apply(c, b)
    })
}, associate: function (c) {
    var d = {}, b = Math.min(this.length, c.length);
    for (var a = 0; a < b; a++) {
        d[c[a]] = this[a]
    }
    return d
}, link: function (c) {
    var a = {};
    for (var e = 0, b = this.length; e < b; e++) {
        for (var d in c) {
            if (c[d](this[e])) {
                a[d] = this[e];
                delete c[d];
                break
            }
        }
    }
    return a
}, contains: function (a, b) {
    return this.indexOf(a, b) != -1
}, append: function (a) {
    this.push.apply(this, a);
    return this
}, getLast: function () {
    return(this.length) ? this[this.length - 1] : null
}, getRandom: function () {
    return(this.length) ? this[Number.random(0, this.length - 1)] : null
}, include: function (a) {
    if (!this.contains(a)) {
        this.push(a)
    }
    return this
}, combine: function (c) {
    for (var b = 0, a = c.length; b < a; b++) {
        this.include(c[b])
    }
    return this
}, erase: function (b) {
    for (var a = this.length; a--;) {
        if (this[a] === b) {
            this.splice(a, 1)
        }
    }
    return this
}, empty: function () {
    this.length = 0;
    return this
}, flatten: function () {
    var d = [];
    for (var b = 0, a = this.length; b < a; b++) {
        var c = typeOf(this[b]);
        if (c == "null") {
            continue
        }
        d = d.concat((c == "array" || c == "collection" || c == "arguments" || instanceOf(this[b], Array)) ? Array.flatten(this[b]) : this[b])
    }
    return d
}, pick: function () {
    for (var b = 0, a = this.length; b < a; b++) {
        if (this[b] != null) {
            return this[b]
        }
    }
    return null
}, hexToRgb: function (b) {
    if (this.length != 3) {
        return null
    }
    var a = this.map(function (c) {
        if (c.length == 1) {
            c += c
        }
        return c.toInt(16)
    });
    return(b) ? a : "rgb(" + a + ")"
}, rgbToHex: function (d) {
    if (this.length < 3) {
        return null
    }
    if (this.length == 4 && this[3] == 0 && !d) {
        return"transparent"
    }
    var b = [];
    for (var a = 0; a < 3; a++) {
        var c = (this[a] - 0).toString(16);
        b.push((c.length == 1) ? "0" + c : c)
    }
    return(d) ? b : "#" + b.join("")
}});
String.implement({test: function (a, b) {
    return((typeOf(a) == "regexp") ? a : new RegExp("" + a, b)).test(this)
}, contains: function (a, b) {
    return(b) ? (b + this + b).indexOf(b + a + b) > -1 : String(this).indexOf(a) > -1
}, trim: function () {
    return String(this).replace(/^\s+|\s+$/g, "")
}, clean: function () {
    return String(this).replace(/\s+/g, " ").trim()
}, camelCase: function () {
    return String(this).replace(/-\D/g, function (a) {
        return a.charAt(1).toUpperCase()
    })
}, hyphenate: function () {
    return String(this).replace(/[A-Z]/g, function (a) {
        return("-" + a.charAt(0).toLowerCase())
    })
}, capitalize: function () {
    return String(this).replace(/\b[a-z]/g, function (a) {
        return a.toUpperCase()
    })
}, escapeRegExp: function () {
    return String(this).replace(/([-.*+?^${}()|[\]\/\\])/g, "\\$1")
}, toInt: function (a) {
    return parseInt(this, a || 10)
}, toFloat: function () {
    return parseFloat(this)
}, hexToRgb: function (b) {
    var a = String(this).match(/^#?(\w{1,2})(\w{1,2})(\w{1,2})$/);
    return(a) ? a.slice(1).hexToRgb(b) : null
}, rgbToHex: function (b) {
    var a = String(this).match(/\d{1,3}/g);
    return(a) ? a.rgbToHex(b) : null
}, substitute: function (a, b) {
    return String(this).replace(b || (/\\?\{([^{}]+)\}/g), function (d, c) {
        if (d.charAt(0) == "\\") {
            return d.slice(1)
        }
        return(a[c] != null) ? a[c] : ""
    })
}});
Number.implement({limit: function (b, a) {
    return Math.min(a, Math.max(b, this))
}, round: function (a) {
    a = Math.pow(10, a || 0).toFixed(a < 0 ? -a : 0);
    return Math.round(this * a) / a
}, times: function (b, c) {
    for (var a = 0; a < this; a++) {
        b.call(c, a, this)
    }
}, toFloat: function () {
    return parseFloat(this)
}, toInt: function (a) {
    return parseInt(this, a || 10)
}});
Number.alias("each", "times");
(function (b) {
    var a = {};
    b.each(function (c) {
        if (!Number[c]) {
            a[c] = function () {
                return Math[c].apply(null, [this].concat(Array.from(arguments)))
            }
        }
    });
    Number.implement(a)
})(["abs", "acos", "asin", "atan", "atan2", "ceil", "cos", "exp", "floor", "log", "max", "min", "pow", "sin", "sqrt", "tan"]);
Function.extend({attempt: function () {
    for (var b = 0, a = arguments.length; b < a; b++) {
        try {
            return arguments[b]()
        } catch (c) {
        }
    }
    return null
}});
Function.implement({attempt: function (a, c) {
    try {
        return this.apply(c, Array.from(a))
    } catch (b) {
    }
    return null
}, bind: function (e) {
    var a = this, b = arguments.length > 1 ? Array.slice(arguments, 1) : null, d = function () {
    };
    var c = function () {
        var g = e, h = arguments.length;
        if (this instanceof c) {
            d.prototype = a.prototype;
            g = new d
        }
        var f = (!b && !h) ? a.call(g) : a.apply(g, b && h ? b.concat(Array.slice(arguments)) : b || arguments);
        return g == e ? f : g
    };
    return c
}, pass: function (b, c) {
    var a = this;
    if (b != null) {
        b = Array.from(b)
    }
    return function () {
        return a.apply(c, b || arguments)
    }
}, delay: function (b, c, a) {
    return setTimeout(this.pass((a == null ? [] : a), c), b)
}, periodical: function (c, b, a) {
    return setInterval(this.pass((a == null ? [] : a), b), c)
}});
(function () {
    var a = Object.prototype.hasOwnProperty;
    Object.extend({subset: function (d, g) {
        var f = {};
        for (var e = 0, b = g.length; e < b; e++) {
            var c = g[e];
            if (c in d) {
                f[c] = d[c]
            }
        }
        return f
    }, map: function (b, e, f) {
        var d = {};
        for (var c in b) {
            if (a.call(b, c)) {
                d[c] = e.call(f, b[c], c, b)
            }
        }
        return d
    }, filter: function (b, e, g) {
        var d = {};
        for (var c in b) {
            var f = b[c];
            if (a.call(b, c) && e.call(g, f, c, b)) {
                d[c] = f
            }
        }
        return d
    }, every: function (b, d, e) {
        for (var c in b) {
            if (a.call(b, c) && !d.call(e, b[c], c)) {
                return false
            }
        }
        return true
    }, some: function (b, d, e) {
        for (var c in b) {
            if (a.call(b, c) && d.call(e, b[c], c)) {
                return true
            }
        }
        return false
    }, keys: function (b) {
        var d = [];
        for (var c in b) {
            if (a.call(b, c)) {
                d.push(c)
            }
        }
        return d
    }, values: function (c) {
        var b = [];
        for (var d in c) {
            if (a.call(c, d)) {
                b.push(c[d])
            }
        }
        return b
    }, getLength: function (b) {
        return Object.keys(b).length
    }, keyOf: function (b, d) {
        for (var c in b) {
            if (a.call(b, c) && b[c] === d) {
                return c
            }
        }
        return null
    }, contains: function (b, c) {
        return Object.keyOf(b, c) != null
    }, toQueryString: function (b, c) {
        var d = [];
        Object.each(b, function (h, g) {
            if (c) {
                g = c + "[" + g + "]"
            }
            var f;
            switch (typeOf(h)) {
                case"object":
                    f = Object.toQueryString(h, g);
                    break;
                case"array":
                    var e = {};
                    h.each(function (l, k) {
                        e[k] = l
                    });
                    f = Object.toQueryString(e, g);
                    break;
                default:
                    f = g + "=" + encodeURIComponent(h)
            }
            if (h != null) {
                d.push(f)
            }
        });
        return d.join("&")
    }})
})();
(function () {
    var l = this.document;
    var g = l.window = this;
    var a = navigator.userAgent.toLowerCase(), b = navigator.platform.toLowerCase(), h = a.match(/(opera|ie|firefox|chrome|version)[\s\/:]([\w\d\.]+)?.*?(safari|version[\s\/:]([\w\d\.]+)|$)/) || [null, "unknown", 0], d = h[1] == "ie" && l.documentMode;
    var q = this.Browser = {extend: Function.prototype.extend, name: (h[1] == "version") ? h[3] : h[1], version: d || parseFloat((h[1] == "opera" && h[4]) ? h[4] : h[2]), Platform: {name: a.match(/ip(?:ad|od|hone)/) ? "ios" : (a.match(/(?:webos|android)/) || b.match(/mac|win|linux/) || ["other"])[0]}, Features: {xpath: !!(l.evaluate), air: !!(g.runtime), query: !!(l.querySelector), json: !!(g.JSON)}, Plugins: {}};
    q[q.name] = true;
    q[q.name + parseInt(q.version, 10)] = true;
    q.Platform[q.Platform.name] = true;
    q.Request = (function () {
        var s = function () {
            return new XMLHttpRequest()
        };
        var r = function () {
            return new ActiveXObject("MSXML2.XMLHTTP")
        };
        var e = function () {
            return new ActiveXObject("Microsoft.XMLHTTP")
        };
        return Function.attempt(function () {
            s();
            return s
        }, function () {
            r();
            return r
        }, function () {
            e();
            return e
        })
    })();
    q.Features.xhr = !!(q.Request);
    var k = (Function.attempt(function () {
        return navigator.plugins["Shockwave Flash"].description
    }, function () {
        return new ActiveXObject("ShockwaveFlash.ShockwaveFlash").GetVariable("$version")
    }) || "0 r0").match(/\d+/g);
    q.Plugins.Flash = {version: Number(k[0] || "0." + k[1]) || 0, build: Number(k[2]) || 0};
    q.exec = function (r) {
        if (!r) {
            return r
        }
        if (g.execScript) {
            g.execScript(r)
        } else {
            var e = l.createElement("script");
            e.setAttribute("type", "text/javascript");
            e.text = r;
            l.head.appendChild(e);
            l.head.removeChild(e)
        }
        return r
    };
    String.implement("stripScripts", function (r) {
        var e = "";
        var s = this.replace(/<script[^>]*>([\s\S]*?)<\/script>/gi, function (t, u) {
            e += u + "\n";
            return""
        });
        if (r === true) {
            q.exec(e)
        } else {
            if (typeOf(r) == "function") {
                r(e, s)
            }
        }
        return s
    });
    q.extend({Document: this.Document, Window: this.Window, Element: this.Element, Event: this.Event});
    this.Window = this.$constructor = new Type("Window", function () {
    });
    this.$family = Function.from("window").hide();
    Window.mirror(function (e, r) {
        g[e] = r
    });
    this.Document = l.$constructor = new Type("Document", function () {
    });
    l.$family = Function.from("document").hide();
    Document.mirror(function (e, r) {
        l[e] = r
    });
    l.html = l.documentElement;
    if (!l.head) {
        l.head = l.getElementsByTagName("head")[0]
    }
    if (l.execCommand) {
        try {
            l.execCommand("BackgroundImageCache", false, true)
        } catch (f) {
        }
    }
    if (this.attachEvent && !this.addEventListener) {
        var c = function () {
            this.detachEvent("onunload", c);
            l.head = l.html = l.window = null
        };
        this.attachEvent("onunload", c)
    }
    var n = Array.from;
    try {
        n(l.html.childNodes)
    } catch (f) {
        Array.from = function (r) {
            if (typeof r != "string" && Type.isEnumerable(r) && typeOf(r) != "array") {
                var e = r.length, s = new Array(e);
                while (e--) {
                    s[e] = r[e]
                }
                return s
            }
            return n(r)
        };
        var m = Array.prototype, o = m.slice;
        ["pop", "push", "reverse", "shift", "sort", "splice", "unshift", "concat", "join", "slice"].each(function (e) {
            var r = m[e];
            Array[e] = function (s) {
                return r.apply(Array.from(s), o.call(arguments, 1))
            }
        })
    }
})();
(function () {
    var b = {};
    var a = this.DOMEvent = new Type("DOMEvent", function (c, g) {
        if (!g) {
            g = window
        }
        c = c || g.event;
        if (c.$extended) {
            return c
        }
        this.event = c;
        this.$extended = true;
        this.shift = c.shiftKey;
        this.control = c.ctrlKey;
        this.alt = c.altKey;
        this.meta = c.metaKey;
        var k = this.type = c.type;
        var h = c.target || c.srcElement;
        while (h && h.nodeType == 3) {
            h = h.parentNode
        }
        this.target = document.id(h);
        if (k.indexOf("key") == 0) {
            var d = this.code = (c.which || c.keyCode);
            this.key = b[d];
            if (k == "keydown") {
                if (d > 111 && d < 124) {
                    this.key = "f" + (d - 111)
                } else {
                    if (d > 95 && d < 106) {
                        this.key = d - 96
                    }
                }
            }
            if (this.key == null) {
                this.key = String.fromCharCode(d).toLowerCase()
            }
        } else {
            if (k == "click" || k == "dblclick" || k == "contextmenu" || k == "DOMMouseScroll" || k.indexOf("mouse") == 0) {
                var l = g.document;
                l = (!l.compatMode || l.compatMode == "CSS1Compat") ? l.html : l.body;
                this.page = {x: (c.pageX != null) ? c.pageX : c.clientX + l.scrollLeft, y: (c.pageY != null) ? c.pageY : c.clientY + l.scrollTop};
                this.client = {x: (c.pageX != null) ? c.pageX - g.pageXOffset : c.clientX, y: (c.pageY != null) ? c.pageY - g.pageYOffset : c.clientY};
                if (k == "DOMMouseScroll" || k == "mousewheel") {
                    this.wheel = (c.wheelDelta) ? c.wheelDelta / 120 : -(c.detail || 0) / 3
                }
                this.rightClick = (c.which == 3 || c.button == 2);
                if (k == "mouseover" || k == "mouseout") {
                    var m = c.relatedTarget || c[(k == "mouseover" ? "from" : "to") + "Element"];
                    while (m && m.nodeType == 3) {
                        m = m.parentNode
                    }
                    this.relatedTarget = document.id(m)
                }
            } else {
                if (k.indexOf("touch") == 0 || k.indexOf("gesture") == 0) {
                    this.rotation = c.rotation;
                    this.scale = c.scale;
                    this.targetTouches = c.targetTouches;
                    this.changedTouches = c.changedTouches;
                    var f = this.touches = c.touches;
                    if (f && f[0]) {
                        var e = f[0];
                        this.page = {x: e.pageX, y: e.pageY};
                        this.client = {x: e.clientX, y: e.clientY}
                    }
                }
            }
        }
        if (!this.client) {
            this.client = {}
        }
        if (!this.page) {
            this.page = {}
        }
    });
    a.implement({stop: function () {
        return this.preventDefault().stopPropagation()
    }, stopPropagation: function () {
        if (this.event.stopPropagation) {
            this.event.stopPropagation()
        } else {
            this.event.cancelBubble = true
        }
        return this
    }, preventDefault: function () {
        if (this.event.preventDefault) {
            this.event.preventDefault()
        } else {
            this.event.returnValue = false
        }
        return this
    }});
    a.defineKey = function (d, c) {
        b[d] = c;
        return this
    };
    a.defineKeys = a.defineKey.overloadSetter(true);
    a.defineKeys({"38": "up", "40": "down", "37": "left", "39": "right", "27": "esc", "32": "space", "8": "backspace", "9": "tab", "46": "delete", "13": "enter"})
})();
(function () {
    var a = this.Class = new Type("Class", function (h) {
        if (instanceOf(h, Function)) {
            h = {initialize: h}
        }
        var g = function () {
            e(this);
            if (g.$prototyping) {
                return this
            }
            this.$caller = null;
            var k = (this.initialize) ? this.initialize.apply(this, arguments) : this;
            this.$caller = this.caller = null;
            return k
        }.extend(this).implement(h);
        g.$constructor = a;
        g.prototype.$constructor = g;
        g.prototype.parent = c;
        return g
    });
    var c = function () {
        if (!this.$caller) {
            throw new Error('The method "parent" cannot be called.')
        }
        var g = this.$caller.$name, h = this.$caller.$owner.parent, k = (h) ? h.prototype[g] : null;
        if (!k) {
            throw new Error('The method "' + g + '" has no parent.')
        }
        return k.apply(this, arguments)
    };
    var e = function (g) {
        for (var h in g) {
            var l = g[h];
            switch (typeOf(l)) {
                case"object":
                    var k = function () {
                    };
                    k.prototype = l;
                    g[h] = e(new k);
                    break;
                case"array":
                    g[h] = l.clone();
                    break
            }
        }
        return g
    };
    var b = function (g, h, l) {
        if (l.$origin) {
            l = l.$origin
        }
        var k = function () {
            if (l.$protected && this.$caller == null) {
                throw new Error('The method "' + h + '" cannot be called.')
            }
            var n = this.caller, o = this.$caller;
            this.caller = o;
            this.$caller = k;
            var m = l.apply(this, arguments);
            this.$caller = o;
            this.caller = n;
            return m
        }.extend({$owner: g, $origin: l, $name: h});
        return k
    };
    var f = function (h, k, g) {
        if (a.Mutators.hasOwnProperty(h)) {
            k = a.Mutators[h].call(this, k);
            if (k == null) {
                return this
            }
        }
        if (typeOf(k) == "function") {
            if (k.$hidden) {
                return this
            }
            this.prototype[h] = (g) ? k : b(this, h, k)
        } else {
            Object.merge(this.prototype, h, k)
        }
        return this
    };
    var d = function (g) {
        g.$prototyping = true;
        var h = new g;
        delete g.$prototyping;
        return h
    };
    a.implement("implement", f.overloadSetter());
    a.Mutators = {Extends: function (g) {
        this.parent = g;
        this.prototype = d(g)
    }, Implements: function (g) {
        Array.from(g).each(function (l) {
            var h = new l;
            for (var k in h) {
                f.call(this, k, h[k], true)
            }
        }, this)
    }}
})();
(function () {
    this.Chain = new Class({$chain: [], chain: function () {
        this.$chain.append(Array.flatten(arguments));
        return this
    }, callChain: function () {
        return(this.$chain.length) ? this.$chain.shift().apply(this, arguments) : false
    }, clearChain: function () {
        this.$chain.empty();
        return this
    }});
    var a = function (b) {
        return b.replace(/^on([A-Z])/, function (c, d) {
            return d.toLowerCase()
        })
    };
    this.Events = new Class({$events: {}, addEvent: function (d, c, b) {
        d = a(d);
        this.$events[d] = (this.$events[d] || []).include(c);
        if (b) {
            c.internal = true
        }
        return this
    }, addEvents: function (b) {
        for (var c in b) {
            this.addEvent(c, b[c])
        }
        return this
    }, fireEvent: function (e, c, b) {
        e = a(e);
        var d = this.$events[e];
        if (!d) {
            return this
        }
        c = Array.from(c);
        d.each(function (f) {
            if (b) {
                f.delay(b, this, c)
            } else {
                f.apply(this, c)
            }
        }, this);
        return this
    }, removeEvent: function (e, d) {
        e = a(e);
        var c = this.$events[e];
        if (c && !d.internal) {
            var b = c.indexOf(d);
            if (b != -1) {
                delete c[b]
            }
        }
        return this
    }, removeEvents: function (d) {
        var e;
        if (typeOf(d) == "object") {
            for (e in d) {
                this.removeEvent(e, d[e])
            }
            return this
        }
        if (d) {
            d = a(d)
        }
        for (e in this.$events) {
            if (d && d != e) {
                continue
            }
            var c = this.$events[e];
            for (var b = c.length; b--;) {
                if (b in c) {
                    this.removeEvent(e, c[b])
                }
            }
        }
        return this
    }});
    this.Options = new Class({setOptions: function () {
        var b = this.options = Object.merge.apply(null, [
            {},
            this.options
        ].append(arguments));
        if (this.addEvent) {
            for (var c in b) {
                if (typeOf(b[c]) != "function" || !(/^on[A-Z]/).test(c)) {
                    continue
                }
                this.addEvent(c, b[c]);
                delete b[c]
            }
        }
        return this
    }})
})();
(function () {
    var m, q, n, g, a = {}, c = {}, o = /\\/g;
    var e = function (t, s) {
        if (t == null) {
            return null
        }
        if (t.Slick === true) {
            return t
        }
        t = ("" + t).replace(/^\s+|\s+$/g, "");
        g = !!s;
        var r = (g) ? c : a;
        if (r[t]) {
            return r[t]
        }
        m = {Slick: true, expressions: [], raw: t, reverse: function () {
            return e(this.raw, true)
        }};
        q = -1;
        while (t != (t = t.replace(l, b))) {
        }
        m.length = m.expressions.length;
        return r[m.raw] = (g) ? h(m) : m
    };
    var k = function (r) {
        if (r === "!") {
            return" "
        } else {
            if (r === " ") {
                return"!"
            } else {
                if ((/^!/).test(r)) {
                    return r.replace(/^!/, "")
                } else {
                    return"!" + r
                }
            }
        }
    };
    var h = function (x) {
        var u = x.expressions;
        for (var s = 0; s < u.length; s++) {
            var w = u[s];
            var t = {parts: [], tag: "*", combinator: k(w[0].combinator)};
            for (var r = 0; r < w.length; r++) {
                var v = w[r];
                if (!v.reverseCombinator) {
                    v.reverseCombinator = " "
                }
                v.combinator = v.reverseCombinator;
                delete v.reverseCombinator
            }
            w.reverse().push(t)
        }
        return x
    };
    var f = function (r) {
        return r.replace(/[-[\]{}()*+?.\\^$|,#\s]/g, function (s) {
            return"\\" + s
        })
    };
    var l = new RegExp("^(?:\\s*(,)\\s*|\\s*(<combinator>+)\\s*|(\\s+)|(<unicode>+|\\*)|\\#(<unicode>+)|\\.(<unicode>+)|\\[\\s*(<unicode1>+)(?:\\s*([*^$!~|]?=)(?:\\s*(?:([\"']?)(.*?)\\9)))?\\s*\\](?!\\])|(:+)(<unicode>+)(?:\\((?:(?:([\"'])([^\\13]*)\\13)|((?:\\([^)]+\\)|[^()]*)+))\\))?)".replace(/<combinator>/, "[" + f(">+~`!@$%^&={}\\;</") + "]").replace(/<unicode>/g, "(?:[\\w\\u00a1-\\uFFFF-]|\\\\[^\\s0-9a-f])").replace(/<unicode1>/g, "(?:[:\\w\\u00a1-\\uFFFF-]|\\\\[^\\s0-9a-f])"));

    function b(A, v, G, C, u, F, t, E, D, B, x, I, J, y, s, z) {
        if (v || q === -1) {
            m.expressions[++q] = [];
            n = -1;
            if (v) {
                return""
            }
        }
        if (G || C || n === -1) {
            G = G || " ";
            var w = m.expressions[q];
            if (g && w[n]) {
                w[n].reverseCombinator = k(G)
            }
            w[++n] = {combinator: G, tag: "*"}
        }
        var r = m.expressions[q][n];
        if (u) {
            r.tag = u.replace(o, "")
        } else {
            if (F) {
                r.id = F.replace(o, "")
            } else {
                if (t) {
                    t = t.replace(o, "");
                    if (!r.classList) {
                        r.classList = []
                    }
                    if (!r.classes) {
                        r.classes = []
                    }
                    r.classList.push(t);
                    r.classes.push({value: t, regexp: new RegExp("(^|\\s)" + f(t) + "(\\s|$)")})
                } else {
                    if (J) {
                        z = z || s;
                        z = z ? z.replace(o, "") : null;
                        if (!r.pseudos) {
                            r.pseudos = []
                        }
                        r.pseudos.push({key: J.replace(o, ""), value: z, type: I.length == 1 ? "class" : "element"})
                    } else {
                        if (E) {
                            E = E.replace(o, "");
                            x = (x || "").replace(o, "");
                            var H, K;
                            switch (D) {
                                case"^=":
                                    K = new RegExp("^" + f(x));
                                    break;
                                case"$=":
                                    K = new RegExp(f(x) + "$");
                                    break;
                                case"~=":
                                    K = new RegExp("(^|\\s)" + f(x) + "(\\s|$)");
                                    break;
                                case"|=":
                                    K = new RegExp("^" + f(x) + "(-|$)");
                                    break;
                                case"=":
                                    H = function (L) {
                                        return x == L
                                    };
                                    break;
                                case"*=":
                                    H = function (L) {
                                        return L && L.indexOf(x) > -1
                                    };
                                    break;
                                case"!=":
                                    H = function (L) {
                                        return x != L
                                    };
                                    break;
                                default:
                                    H = function (L) {
                                        return !!L
                                    }
                            }
                            if (x == "" && (/^[*$^]=$/).test(D)) {
                                H = function () {
                                    return false
                                }
                            }
                            if (!H) {
                                H = function (L) {
                                    return L && K.test(L)
                                }
                            }
                            if (!r.attributes) {
                                r.attributes = []
                            }
                            r.attributes.push({key: E, operator: D, value: x, test: H})
                        }
                    }
                }
            }
        }
        return""
    }

    var d = (this.Slick || {});
    d.parse = function (r) {
        return e(r)
    };
    d.escapeRegExp = f;
    if (!this.Slick) {
        this.Slick = d
    }
}).apply((typeof exports != "undefined") ? exports : this);
(function () {
    var m = {}, o = {}, d = Object.prototype.toString;
    m.isNativeCode = function (c) {
        return(/\{\s*\[native code\]\s*\}/).test("" + c)
    };
    m.isXML = function (c) {
        return(!!c.xmlVersion) || (!!c.xml) || (d.call(c) == "[object XMLDocument]") || (c.nodeType == 9 && c.documentElement.nodeName != "HTML")
    };
    m.setDocument = function (z) {
        var s = z.nodeType;
        if (s == 9) {
        } else {
            if (s) {
                z = z.ownerDocument
            } else {
                if (z.navigator) {
                    z = z.document
                } else {
                    return
                }
            }
        }
        if (this.document === z) {
            return
        }
        this.document = z;
        var D = z.documentElement, r = this.getUIDXML(D), v = o[r], u;
        if (v) {
            for (u in v) {
                this[u] = v[u]
            }
            return
        }
        v = o[r] = {};
        v.root = D;
        v.isXMLDocument = this.isXML(z);
        v.brokenStarGEBTN = v.starSelectsClosedQSA = v.idGetsName = v.brokenMixedCaseQSA = v.brokenGEBCN = v.brokenCheckedQSA = v.brokenEmptyAttributeQSA = v.isHTMLDocument = v.nativeMatchesSelector = false;
        var t, x, B, C, w;
        var A, y = "slick_uniqueid";
        var c = z.createElement("div");
        var q = z.body || z.getElementsByTagName("body")[0] || D;
        q.appendChild(c);
        try {
            c.innerHTML = '<a id="' + y + '"></a>';
            v.isHTMLDocument = !!z.getElementById(y)
        } catch (F) {
        }
        if (v.isHTMLDocument) {
            c.style.display = "none";
            c.appendChild(z.createComment(""));
            x = (c.getElementsByTagName("*").length > 1);
            try {
                c.innerHTML = "foo</foo>";
                A = c.getElementsByTagName("*");
                t = (A && !!A.length && A[0].nodeName.charAt(0) == "/")
            } catch (F) {
            }
            v.brokenStarGEBTN = x || t;
            try {
                c.innerHTML = '<a name="' + y + '"></a><b id="' + y + '"></b>';
                v.idGetsName = z.getElementById(y) === c.firstChild
            } catch (F) {
            }
            if (c.getElementsByClassName) {
                try {
                    c.innerHTML = '<a class="f"></a><a class="b"></a>';
                    c.getElementsByClassName("b").length;
                    c.firstChild.className = "b";
                    C = (c.getElementsByClassName("b").length != 2)
                } catch (F) {
                }
                try {
                    c.innerHTML = '<a class="a"></a><a class="f b a"></a>';
                    B = (c.getElementsByClassName("a").length != 2)
                } catch (F) {
                }
                v.brokenGEBCN = C || B
            }
            if (c.querySelectorAll) {
                try {
                    c.innerHTML = "foo</foo>";
                    A = c.querySelectorAll("*");
                    v.starSelectsClosedQSA = (A && !!A.length && A[0].nodeName.charAt(0) == "/")
                } catch (F) {
                }
                try {
                    c.innerHTML = '<a class="MiX"></a>';
                    v.brokenMixedCaseQSA = !c.querySelectorAll(".MiX").length
                } catch (F) {
                }
                try {
                    c.innerHTML = '<select><option selected="selected">a</option></select>';
                    v.brokenCheckedQSA = (c.querySelectorAll(":checked").length == 0)
                } catch (F) {
                }
                try {
                    c.innerHTML = '<a class=""></a>';
                    v.brokenEmptyAttributeQSA = (c.querySelectorAll('[class*=""]').length != 0)
                } catch (F) {
                }
            }
            try {
                c.innerHTML = '<form action="s"><input id="action"/></form>';
                w = (c.firstChild.getAttribute("action") != "s")
            } catch (F) {
            }
            v.nativeMatchesSelector = D.matchesSelector || D.mozMatchesSelector || D.webkitMatchesSelector;
            if (v.nativeMatchesSelector) {
                try {
                    v.nativeMatchesSelector.call(D, ":slick");
                    v.nativeMatchesSelector = null
                } catch (F) {
                }
            }
        }
        try {
            D.slick_expando = 1;
            delete D.slick_expando;
            v.getUID = this.getUIDHTML
        } catch (F) {
            v.getUID = this.getUIDXML
        }
        q.removeChild(c);
        c = A = q = null;
        v.getAttribute = (v.isHTMLDocument && w) ? function (J, H) {
            var K = this.attributeGetters[H];
            if (K) {
                return K.call(J)
            }
            var I = J.getAttributeNode(H);
            return(I) ? I.nodeValue : null
        } : function (I, H) {
            var J = this.attributeGetters[H];
            return(J) ? J.call(I) : I.getAttribute(H)
        };
        v.hasAttribute = (D && this.isNativeCode(D.hasAttribute)) ? function (I, H) {
            return I.hasAttribute(H)
        } : function (I, H) {
            I = I.getAttributeNode(H);
            return !!(I && (I.specified || I.nodeValue))
        };
        var G = D && this.isNativeCode(D.contains), E = z && this.isNativeCode(z.contains);
        v.contains = (G && E) ? function (H, I) {
            return H.contains(I)
        } : (G && !E) ? function (H, I) {
            return H === I || ((H === z) ? z.documentElement : H).contains(I)
        } : (D && D.compareDocumentPosition) ? function (H, I) {
            return H === I || !!(H.compareDocumentPosition(I) & 16)
        } : function (H, I) {
            if (I) {
                do {
                    if (I === H) {
                        return true
                    }
                } while ((I = I.parentNode))
            }
            return false
        };
        v.documentSorter = (D.compareDocumentPosition) ? function (I, H) {
            if (!I.compareDocumentPosition || !H.compareDocumentPosition) {
                return 0
            }
            return I.compareDocumentPosition(H) & 4 ? -1 : I === H ? 0 : 1
        } : ("sourceIndex" in D) ? function (I, H) {
            if (!I.sourceIndex || !H.sourceIndex) {
                return 0
            }
            return I.sourceIndex - H.sourceIndex
        } : (z.createRange) ? function (K, I) {
            if (!K.ownerDocument || !I.ownerDocument) {
                return 0
            }
            var J = K.ownerDocument.createRange(), H = I.ownerDocument.createRange();
            J.setStart(K, 0);
            J.setEnd(K, 0);
            H.setStart(I, 0);
            H.setEnd(I, 0);
            return J.compareBoundaryPoints(Range.START_TO_END, H)
        } : null;
        D = null;
        for (u in v) {
            this[u] = v[u]
        }
    };
    var f = /^([#.]?)((?:[\w-]+|\*))$/, h = /\[.+[*$^]=(?:""|'')?\]/, g = {};
    m.search = function (W, B, J, u) {
        var r = this.found = (u) ? null : (J || []);
        if (!W) {
            return r
        } else {
            if (W.navigator) {
                W = W.document
            } else {
                if (!W.nodeType) {
                    return r
                }
            }
        }
        var H, Q, X = this.uniques = {}, K = !!(J && J.length), A = (W.nodeType == 9);
        if (this.document !== (A ? W : W.ownerDocument)) {
            this.setDocument(W)
        }
        if (K) {
            for (Q = r.length; Q--;) {
                X[this.getUID(r[Q])] = true
            }
        }
        if (typeof B == "string") {
            var t = B.match(f);
            simpleSelectors:if (t) {
                var w = t[1], x = t[2], C, G;
                if (!w) {
                    if (x == "*" && this.brokenStarGEBTN) {
                        break simpleSelectors
                    }
                    G = W.getElementsByTagName(x);
                    if (u) {
                        return G[0] || null
                    }
                    for (Q = 0; C = G[Q++];) {
                        if (!(K && X[this.getUID(C)])) {
                            r.push(C)
                        }
                    }
                } else {
                    if (w == "#") {
                        if (!this.isHTMLDocument || !A) {
                            break simpleSelectors
                        }
                        C = W.getElementById(x);
                        if (!C) {
                            return r
                        }
                        if (this.idGetsName && C.getAttributeNode("id").nodeValue != x) {
                            break simpleSelectors
                        }
                        if (u) {
                            return C || null
                        }
                        if (!(K && X[this.getUID(C)])) {
                            r.push(C)
                        }
                    } else {
                        if (w == ".") {
                            if (!this.isHTMLDocument || ((!W.getElementsByClassName || this.brokenGEBCN) && W.querySelectorAll)) {
                                break simpleSelectors
                            }
                            if (W.getElementsByClassName && !this.brokenGEBCN) {
                                G = W.getElementsByClassName(x);
                                if (u) {
                                    return G[0] || null
                                }
                                for (Q = 0;
                                     C = G[Q++];) {
                                    if (!(K && X[this.getUID(C)])) {
                                        r.push(C)
                                    }
                                }
                            } else {
                                var V = new RegExp("(^|\\s)" + e.escapeRegExp(x) + "(\\s|$)");
                                G = W.getElementsByTagName("*");
                                for (Q = 0; C = G[Q++];) {
                                    className = C.className;
                                    if (!(className && V.test(className))) {
                                        continue
                                    }
                                    if (u) {
                                        return C
                                    }
                                    if (!(K && X[this.getUID(C)])) {
                                        r.push(C)
                                    }
                                }
                            }
                        }
                    }
                }
                if (K) {
                    this.sort(r)
                }
                return(u) ? null : r
            }
            querySelector:if (W.querySelectorAll) {
                if (!this.isHTMLDocument || g[B] || this.brokenMixedCaseQSA || (this.brokenCheckedQSA && B.indexOf(":checked") > -1) || (this.brokenEmptyAttributeQSA && h.test(B)) || (!A && B.indexOf(",") > -1) || e.disableQSA) {
                    break querySelector
                }
                var U = B, z = W;
                if (!A) {
                    var E = z.getAttribute("id"), v = "slickid__";
                    z.setAttribute("id", v);
                    U = "#" + v + " " + U;
                    W = z.parentNode
                }
                try {
                    if (u) {
                        return W.querySelector(U) || null
                    } else {
                        G = W.querySelectorAll(U)
                    }
                } catch (S) {
                    g[B] = 1;
                    break querySelector
                } finally {
                    if (!A) {
                        if (E) {
                            z.setAttribute("id", E)
                        } else {
                            z.removeAttribute("id")
                        }
                        W = z
                    }
                }
                if (this.starSelectsClosedQSA) {
                    for (Q = 0; C = G[Q++];) {
                        if (C.nodeName > "@" && !(K && X[this.getUID(C)])) {
                            r.push(C)
                        }
                    }
                } else {
                    for (Q = 0; C = G[Q++];) {
                        if (!(K && X[this.getUID(C)])) {
                            r.push(C)
                        }
                    }
                }
                if (K) {
                    this.sort(r)
                }
                return r
            }
            H = this.Slick.parse(B);
            if (!H.length) {
                return r
            }
        } else {
            if (B == null) {
                return r
            } else {
                if (B.Slick) {
                    H = B
                } else {
                    if (this.contains(W.documentElement || W, B)) {
                        (r) ? r.push(B) : r = B;
                        return r
                    } else {
                        return r
                    }
                }
            }
        }
        this.posNTH = {};
        this.posNTHLast = {};
        this.posNTHType = {};
        this.posNTHTypeLast = {};
        this.push = (!K && (u || (H.length == 1 && H.expressions[0].length == 1))) ? this.pushArray : this.pushUID;
        if (r == null) {
            r = []
        }
        var O, N, M;
        var D, L, F, c, s, I, Y;
        var P, R, q, y, T = H.expressions;
        search:for (Q = 0; (R = T[Q]); Q++) {
            for (O = 0; (q = R[O]); O++) {
                D = "combinator:" + q.combinator;
                if (!this[D]) {
                    continue search
                }
                L = (this.isXMLDocument) ? q.tag : q.tag.toUpperCase();
                F = q.id;
                c = q.classList;
                s = q.classes;
                I = q.attributes;
                Y = q.pseudos;
                y = (O === (R.length - 1));
                this.bitUniques = {};
                if (y) {
                    this.uniques = X;
                    this.found = r
                } else {
                    this.uniques = {};
                    this.found = []
                }
                if (O === 0) {
                    this[D](W, L, F, s, I, Y, c);
                    if (u && y && r.length) {
                        break search
                    }
                } else {
                    if (u && y) {
                        for (N = 0, M = P.length; N < M; N++) {
                            this[D](P[N], L, F, s, I, Y, c);
                            if (r.length) {
                                break search
                            }
                        }
                    } else {
                        for (N = 0, M = P.length; N < M; N++) {
                            this[D](P[N], L, F, s, I, Y, c)
                        }
                    }
                }
                P = this.found
            }
        }
        if (K || (H.expressions.length > 1)) {
            this.sort(r)
        }
        return(u) ? (r[0] || null) : r
    };
    m.uidx = 1;
    m.uidk = "slick-uniqueid";
    m.getUIDXML = function (q) {
        var c = q.getAttribute(this.uidk);
        if (!c) {
            c = this.uidx++;
            q.setAttribute(this.uidk, c)
        }
        return c
    };
    m.getUIDHTML = function (c) {
        return c.uniqueNumber || (c.uniqueNumber = this.uidx++)
    };
    m.sort = function (c) {
        if (!this.documentSorter) {
            return c
        }
        c.sort(this.documentSorter);
        return c
    };
    m.cacheNTH = {};
    m.matchNTH = /^([+-]?\d*)?([a-z]+)?([+-]\d+)?$/;
    m.parseNTHArgument = function (t) {
        var r = t.match(this.matchNTH);
        if (!r) {
            return false
        }
        var s = r[2] || false;
        var q = r[1] || 1;
        if (q == "-") {
            q = -1
        }
        var c = +r[3] || 0;
        r = (s == "n") ? {a: q, b: c} : (s == "odd") ? {a: 2, b: 1} : (s == "even") ? {a: 2, b: 0} : {a: 0, b: q};
        return(this.cacheNTH[t] = r)
    };
    m.createNTHPseudo = function (s, q, c, r) {
        return function (v, t) {
            var x = this.getUID(v);
            if (!this[c][x]) {
                var D = v.parentNode;
                if (!D) {
                    return false
                }
                var u = D[s], w = 1;
                if (r) {
                    var C = v.nodeName;
                    do {
                        if (u.nodeName != C) {
                            continue
                        }
                        this[c][this.getUID(u)] = w++
                    } while ((u = u[q]))
                } else {
                    do {
                        if (u.nodeType != 1) {
                            continue
                        }
                        this[c][this.getUID(u)] = w++
                    } while ((u = u[q]))
                }
            }
            t = t || "n";
            var y = this.cacheNTH[t] || this.parseNTHArgument(t);
            if (!y) {
                return false
            }
            var B = y.a, A = y.b, z = this[c][x];
            if (B == 0) {
                return A == z
            }
            if (B > 0) {
                if (z < A) {
                    return false
                }
            } else {
                if (A < z) {
                    return false
                }
            }
            return((z - A) % B) == 0
        }
    };
    m.pushArray = function (s, c, u, r, q, t) {
        if (this.matchSelector(s, c, u, r, q, t)) {
            this.found.push(s)
        }
    };
    m.pushUID = function (t, c, v, s, q, u) {
        var r = this.getUID(t);
        if (!this.uniques[r] && this.matchSelector(t, c, v, s, q, u)) {
            this.uniques[r] = true;
            this.found.push(t)
        }
    };
    m.matchNode = function (q, r) {
        if (this.isHTMLDocument && this.nativeMatchesSelector) {
            try {
                return this.nativeMatchesSelector.call(q, r.replace(/\[([^=]+)=\s*([^'"\]]+?)\s*\]/g, '[$1="$2"]'))
            } catch (x) {
            }
        }
        var w = this.Slick.parse(r);
        if (!w) {
            return true
        }
        var u = w.expressions, v = 0, t;
        for (t = 0; (currentExpression = u[t]); t++) {
            if (currentExpression.length == 1) {
                var s = currentExpression[0];
                if (this.matchSelector(q, (this.isXMLDocument) ? s.tag : s.tag.toUpperCase(), s.id, s.classes, s.attributes, s.pseudos)) {
                    return true
                }
                v++
            }
        }
        if (v == w.length) {
            return false
        }
        var c = this.search(this.document, w), y;
        for (t = 0; y = c[t++];) {
            if (y === q) {
                return true
            }
        }
        return false
    };
    m.matchPseudo = function (t, c, s) {
        var q = "pseudo:" + c;
        if (this[q]) {
            return this[q](t, s)
        }
        var r = this.getAttribute(t, c);
        return(s) ? s == r : !!r
    };
    m.matchSelector = function (r, y, c, s, t, v) {
        if (y) {
            var w = (this.isXMLDocument) ? r.nodeName : r.nodeName.toUpperCase();
            if (y == "*") {
                if (w < "@") {
                    return false
                }
            } else {
                if (w != y) {
                    return false
                }
            }
        }
        if (c && r.getAttribute("id") != c) {
            return false
        }
        var u, q, x;
        if (s) {
            for (u = s.length; u--;) {
                x = this.getAttribute(r, "class");
                if (!(x && s[u].regexp.test(x))) {
                    return false
                }
            }
        }
        if (t) {
            for (u = t.length; u--;) {
                q = t[u];
                if (q.operator ? !q.test(this.getAttribute(r, q.key)) : !this.hasAttribute(r, q.key)) {
                    return false
                }
            }
        }
        if (v) {
            for (u = v.length; u--;) {
                q = v[u];
                if (!this.matchPseudo(r, q.key, q.value)) {
                    return false
                }
            }
        }
        return true
    };
    var l = {" ": function (t, z, q, u, v, x, s) {
        var w, y, r;
        if (this.isHTMLDocument) {
            getById:if (q) {
                y = this.document.getElementById(q);
                if ((!y && t.all) || (this.idGetsName && y && y.getAttributeNode("id").nodeValue != q)) {
                    r = t.all[q];
                    if (!r) {
                        return
                    }
                    if (!r[0]) {
                        r = [r]
                    }
                    for (w = 0; y = r[w++];) {
                        var c = y.getAttributeNode("id");
                        if (c && c.nodeValue == q) {
                            this.push(y, z, null, u, v, x);
                            break
                        }
                    }
                    return
                }
                if (!y) {
                    if (this.contains(this.root, t)) {
                        return
                    } else {
                        break getById
                    }
                } else {
                    if (this.document !== t && !this.contains(t, y)) {
                        return
                    }
                }
                this.push(y, z, null, u, v, x);
                return
            }
            getByClass:if (u && t.getElementsByClassName && !this.brokenGEBCN) {
                r = t.getElementsByClassName(s.join(" "));
                if (!(r && r.length)) {
                    break getByClass
                }
                for (w = 0; y = r[w++];) {
                    this.push(y, z, q, null, v, x)
                }
                return
            }
        }
        getByTag:{
            r = t.getElementsByTagName(z);
            if (!(r && r.length)) {
                break getByTag
            }
            if (!this.brokenStarGEBTN) {
                z = null
            }
            for (w = 0; y = r[w++];) {
                this.push(y, z, q, u, v, x)
            }
        }
    }, ">": function (s, c, u, r, q, t) {
        if ((s = s.firstChild)) {
            do {
                if (s.nodeType == 1) {
                    this.push(s, c, u, r, q, t)
                }
            } while ((s = s.nextSibling))
        }
    }, "+": function (s, c, u, r, q, t) {
        while ((s = s.nextSibling)) {
            if (s.nodeType == 1) {
                this.push(s, c, u, r, q, t);
                break
            }
        }
    }, "^": function (s, c, u, r, q, t) {
        s = s.firstChild;
        if (s) {
            if (s.nodeType == 1) {
                this.push(s, c, u, r, q, t)
            } else {
                this["combinator:+"](s, c, u, r, q, t)
            }
        }
    }, "~": function (t, c, v, s, q, u) {
        while ((t = t.nextSibling)) {
            if (t.nodeType != 1) {
                continue
            }
            var r = this.getUID(t);
            if (this.bitUniques[r]) {
                break
            }
            this.bitUniques[r] = true;
            this.push(t, c, v, s, q, u)
        }
    }, "++": function (s, c, u, r, q, t) {
        this["combinator:+"](s, c, u, r, q, t);
        this["combinator:!+"](s, c, u, r, q, t)
    }, "~~": function (s, c, u, r, q, t) {
        this["combinator:~"](s, c, u, r, q, t);
        this["combinator:!~"](s, c, u, r, q, t)
    }, "!": function (s, c, u, r, q, t) {
        while ((s = s.parentNode)) {
            if (s !== this.document) {
                this.push(s, c, u, r, q, t)
            }
        }
    }, "!>": function (s, c, u, r, q, t) {
        s = s.parentNode;
        if (s !== this.document) {
            this.push(s, c, u, r, q, t)
        }
    }, "!+": function (s, c, u, r, q, t) {
        while ((s = s.previousSibling)) {
            if (s.nodeType == 1) {
                this.push(s, c, u, r, q, t);
                break
            }
        }
    }, "!^": function (s, c, u, r, q, t) {
        s = s.lastChild;
        if (s) {
            if (s.nodeType == 1) {
                this.push(s, c, u, r, q, t)
            } else {
                this["combinator:!+"](s, c, u, r, q, t)
            }
        }
    }, "!~": function (t, c, v, s, q, u) {
        while ((t = t.previousSibling)) {
            if (t.nodeType != 1) {
                continue
            }
            var r = this.getUID(t);
            if (this.bitUniques[r]) {
                break
            }
            this.bitUniques[r] = true;
            this.push(t, c, v, s, q, u)
        }
    }};
    for (var k in l) {
        m["combinator:" + k] = l[k]
    }
    var n = {empty: function (c) {
        var q = c.firstChild;
        return !(q && q.nodeType == 1) && !(c.innerText || c.textContent || "").length
    }, not: function (c, q) {
        return !this.matchNode(c, q)
    }, contains: function (c, q) {
        return(c.innerText || c.textContent || "").indexOf(q) > -1
    }, "first-child": function (c) {
        while ((c = c.previousSibling)) {
            if (c.nodeType == 1) {
                return false
            }
        }
        return true
    }, "last-child": function (c) {
        while ((c = c.nextSibling)) {
            if (c.nodeType == 1) {
                return false
            }
        }
        return true
    }, "only-child": function (r) {
        var q = r;
        while ((q = q.previousSibling)) {
            if (q.nodeType == 1) {
                return false
            }
        }
        var c = r;
        while ((c = c.nextSibling)) {
            if (c.nodeType == 1) {
                return false
            }
        }
        return true
    }, "nth-child": m.createNTHPseudo("firstChild", "nextSibling", "posNTH"), "nth-last-child": m.createNTHPseudo("lastChild", "previousSibling", "posNTHLast"), "nth-of-type": m.createNTHPseudo("firstChild", "nextSibling", "posNTHType", true), "nth-last-of-type": m.createNTHPseudo("lastChild", "previousSibling", "posNTHTypeLast", true), index: function (q, c) {
        return this["pseudo:nth-child"](q, "" + (c + 1))
    }, even: function (c) {
        return this["pseudo:nth-child"](c, "2n")
    }, odd: function (c) {
        return this["pseudo:nth-child"](c, "2n+1")
    }, "first-of-type": function (c) {
        var q = c.nodeName;
        while ((c = c.previousSibling)) {
            if (c.nodeName == q) {
                return false
            }
        }
        return true
    }, "last-of-type": function (c) {
        var q = c.nodeName;
        while ((c = c.nextSibling)) {
            if (c.nodeName == q) {
                return false
            }
        }
        return true
    }, "only-of-type": function (r) {
        var q = r, s = r.nodeName;
        while ((q = q.previousSibling)) {
            if (q.nodeName == s) {
                return false
            }
        }
        var c = r;
        while ((c = c.nextSibling)) {
            if (c.nodeName == s) {
                return false
            }
        }
        return true
    }, enabled: function (c) {
        return !c.disabled
    }, disabled: function (c) {
        return c.disabled
    }, checked: function (c) {
        return c.checked || c.selected
    }, focus: function (c) {
        return this.isHTMLDocument && this.document.activeElement === c && (c.href || c.type || this.hasAttribute(c, "tabindex"))
    }, root: function (c) {
        return(c === this.root)
    }, selected: function (c) {
        return c.selected
    }};
    for (var b in n) {
        m["pseudo:" + b] = n[b]
    }
    var a = m.attributeGetters = {"for": function () {
        return("htmlFor" in this) ? this.htmlFor : this.getAttribute("for")
    }, href: function () {
        return("href" in this) ? this.getAttribute("href", 2) : this.getAttribute("href")
    }, style: function () {
        return(this.style) ? this.style.cssText : this.getAttribute("style")
    }, tabindex: function () {
        var c = this.getAttributeNode("tabindex");
        return(c && c.specified) ? c.nodeValue : null
    }, type: function () {
        return this.getAttribute("type")
    }, maxlength: function () {
        var c = this.getAttributeNode("maxLength");
        return(c && c.specified) ? c.nodeValue : null
    }};
    a.MAXLENGTH = a.maxLength = a.maxlength;
    var e = m.Slick = (this.Slick || {});
    e.version = "1.1.7";
    e.search = function (q, r, c) {
        return m.search(q, r, c)
    };
    e.find = function (c, q) {
        return m.search(c, q, null, true)
    };
    e.contains = function (c, q) {
        m.setDocument(c);
        return m.contains(c, q)
    };
    e.getAttribute = function (q, c) {
        m.setDocument(q);
        return m.getAttribute(q, c)
    };
    e.hasAttribute = function (q, c) {
        m.setDocument(q);
        return m.hasAttribute(q, c)
    };
    e.match = function (q, c) {
        if (!(q && c)) {
            return false
        }
        if (!c || c === q) {
            return true
        }
        m.setDocument(q);
        return m.matchNode(q, c)
    };
    e.defineAttributeGetter = function (c, q) {
        m.attributeGetters[c] = q;
        return this
    };
    e.lookupAttributeGetter = function (c) {
        return m.attributeGetters[c]
    };
    e.definePseudo = function (c, q) {
        m["pseudo:" + c] = function (s, r) {
            return q.call(s, r)
        };
        return this
    };
    e.lookupPseudo = function (c) {
        var q = m["pseudo:" + c];
        if (q) {
            return function (r) {
                return q.call(this, r)
            }
        }
        return null
    };
    e.override = function (q, c) {
        m.override(q, c);
        return this
    };
    e.isXML = m.isXML;
    e.uidOf = function (c) {
        return m.getUIDHTML(c)
    };
    if (!this.Slick) {
        this.Slick = e
    }
}).apply((typeof exports != "undefined") ? exports : this);
var Element = function (b, g) {
    var h = Element.Constructors[b];
    if (h) {
        return h(g)
    }
    if (typeof b != "string") {
        return document.id(b).set(g)
    }
    if (!g) {
        g = {}
    }
    if (!(/^[\w-]+$/).test(b)) {
        var e = Slick.parse(b).expressions[0][0];
        b = (e.tag == "*") ? "div" : e.tag;
        if (e.id && g.id == null) {
            g.id = e.id
        }
        var d = e.attributes;
        if (d) {
            for (var a, f = 0, c = d.length; f < c; f++) {
                a = d[f];
                if (g[a.key] != null) {
                    continue
                }
                if (a.value != null && a.operator == "=") {
                    g[a.key] = a.value
                } else {
                    if (!a.value && !a.operator) {
                        g[a.key] = true
                    }
                }
            }
        }
        if (e.classList && g["class"] == null) {
            g["class"] = e.classList.join(" ")
        }
    }
    return document.newElement(b, g)
};
if (Browser.Element) {
    Element.prototype = Browser.Element.prototype;
    Element.prototype._fireEvent = (function (a) {
        return function (b, c) {
            return a.call(this, b, c)
        }
    })(Element.prototype.fireEvent)
}
new Type("Element", Element).mirror(function (a) {
    if (Array.prototype[a]) {
        return
    }
    var b = {};
    b[a] = function () {
        var h = [], e = arguments, k = true;
        for (var g = 0, d = this.length; g < d; g++) {
            var f = this[g], c = h[g] = f[a].apply(f, e);
            k = (k && typeOf(c) == "element")
        }
        return(k) ? new Elements(h) : h
    };
    Elements.implement(b)
});
if (!Browser.Element) {
    Element.parent = Object;
    Element.Prototype = {"$constructor": Element, "$family": Function.from("element").hide()};
    Element.mirror(function (a, b) {
        Element.Prototype[a] = b
    })
}
Element.Constructors = {};
var IFrame = new Type("IFrame", function () {
    var e = Array.link(arguments, {properties: Type.isObject, iframe: function (f) {
        return(f != null)
    }});
    var c = e.properties || {}, b;
    if (e.iframe) {
        b = document.id(e.iframe)
    }
    var d = c.onload || function () {
    };
    delete c.onload;
    c.id = c.name = [c.id, c.name, b ? (b.id || b.name) : "IFrame_" + String.uniqueID()].pick();
    b = new Element(b || "iframe", c);
    var a = function () {
        d.call(b.contentWindow)
    };
    if (window.frames[c.id]) {
        a()
    } else {
        b.addListener("load", a)
    }
    return b
});
var Elements = this.Elements = function (a) {
    if (a && a.length) {
        var e = {}, d;
        for (var c = 0; d = a[c++];) {
            var b = Slick.uidOf(d);
            if (!e[b]) {
                e[b] = true;
                this.push(d)
            }
        }
    }
};
Elements.prototype = {length: 0};
Elements.parent = Array;
new Type("Elements", Elements).implement({filter: function (a, b) {
    if (!a) {
        return this
    }
    return new Elements(Array.filter(this, (typeOf(a) == "string") ? function (c) {
        return c.match(a)
    } : a, b))
}.protect(), push: function () {
    var d = this.length;
    for (var b = 0, a = arguments.length; b < a; b++) {
        var c = document.id(arguments[b]);
        if (c) {
            this[d++] = c
        }
    }
    return(this.length = d)
}.protect(), unshift: function () {
    var b = [];
    for (var c = 0, a = arguments.length; c < a; c++) {
        var d = document.id(arguments[c]);
        if (d) {
            b.push(d)
        }
    }
    return Array.prototype.unshift.apply(this, b)
}.protect(), concat: function () {
    var b = new Elements(this);
    for (var c = 0, a = arguments.length; c < a; c++) {
        var d = arguments[c];
        if (Type.isEnumerable(d)) {
            b.append(d)
        } else {
            b.push(d)
        }
    }
    return b
}.protect(), append: function (c) {
    for (var b = 0, a = c.length; b < a; b++) {
        this.push(c[b])
    }
    return this
}.protect(), empty: function () {
    while (this.length) {
        delete this[--this.length]
    }
    return this
}.protect()});
(function () {
    var f = Array.prototype.splice, a = {"0": 0, "1": 1, length: 2};
    f.call(a, 1, 1);
    if (a[1] == 1) {
        Elements.implement("splice", function () {
            var g = this.length;
            var e = f.apply(this, arguments);
            while (g >= this.length) {
                delete this[g--]
            }
            return e
        }.protect())
    }
    Array.forEachMethod(function (g, e) {
        Elements.implement(e, g)
    });
    Array.mirror(Elements);
    var d;
    try {
        d = (document.createElement("<input name=x>").name == "x")
    } catch (b) {
    }
    var c = function (e) {
        return("" + e).replace(/&/g, "&amp;").replace(/"/g, "&quot;")
    };
    Document.implement({newElement: function (e, g) {
        if (g && g.checked != null) {
            g.defaultChecked = g.checked
        }
        if (d && g) {
            e = "<" + e;
            if (g.name) {
                e += ' name="' + c(g.name) + '"'
            }
            if (g.type) {
                e += ' type="' + c(g.type) + '"'
            }
            e += ">";
            delete g.name;
            delete g.type
        }
        return this.id(this.createElement(e)).set(g)
    }})
})();
(function () {
    Slick.uidOf(window);
    Slick.uidOf(document);
    Document.implement({newTextNode: function (e) {
        return this.createTextNode(e)
    }, getDocument: function () {
        return this
    }, getWindow: function () {
        return this.window
    }, id: (function () {
        var e = {string: function (H, G, l) {
            H = Slick.find(l, "#" + H.replace(/(\W)/g, "\\$1"));
            return(H) ? e.element(H, G) : null
        }, element: function (G, H) {
            Slick.uidOf(G);
            if (!H && !G.$family && !(/^(?:object|embed)$/i).test(G.tagName)) {
                var l = G.fireEvent;
                G._fireEvent = function (I, J) {
                    return l(I, J)
                };
                Object.append(G, Element.Prototype)
            }
            return G
        }, object: function (G, H, l) {
            if (G.toElement) {
                return e.element(G.toElement(l), H)
            }
            return null
        }};
        e.textnode = e.whitespace = e.window = e.document = function (l) {
            return l
        };
        return function (G, I, H) {
            if (G && G.$family && G.uniqueNumber) {
                return G
            }
            var l = typeOf(G);
            return(e[l]) ? e[l](G, I, H || document) : null
        }
    })()});
    if (window.$ == null) {
        Window.implement("$", function (e, l) {
            return document.id(e, l, this.document)
        })
    }
    Window.implement({getDocument: function () {
        return this.document
    }, getWindow: function () {
        return this
    }});
    [Document, Element].invoke("implement", {getElements: function (e) {
        return Slick.search(this, e, new Elements)
    }, getElement: function (e) {
        return document.id(Slick.find(this, e))
    }});
    var o = {contains: function (e) {
        return Slick.contains(this, e)
    }};
    if (!document.contains) {
        Document.implement(o)
    }
    if (!document.createElement("div").contains) {
        Element.implement(o)
    }
    var u = function (H, G) {
        if (!H) {
            return G
        }
        H = Object.clone(Slick.parse(H));
        var l = H.expressions;
        for (var e = l.length; e--;) {
            l[e][0].combinator = G
        }
        return H
    };
    Object.forEach({getNext: "~", getPrevious: "!~", getParent: "!"}, function (e, l) {
        Element.implement(l, function (G) {
            return this.getElement(u(G, e))
        })
    });
    Object.forEach({getAllNext: "~", getAllPrevious: "!~", getSiblings: "~~", getChildren: ">", getParents: "!"}, function (e, l) {
        Element.implement(l, function (G) {
            return this.getElements(u(G, e))
        })
    });
    Element.implement({getFirst: function (e) {
        return document.id(Slick.search(this, u(e, ">"))[0])
    }, getLast: function (e) {
        return document.id(Slick.search(this, u(e, ">")).getLast())
    }, getWindow: function () {
        return this.ownerDocument.window
    }, getDocument: function () {
        return this.ownerDocument
    }, getElementById: function (e) {
        return document.id(Slick.find(this, "#" + ("" + e).replace(/(\W)/g, "\\$1")))
    }, match: function (e) {
        return !e || Slick.match(this, e)
    }});
    if (window.$$ == null) {
        Window.implement("$$", function (e) {
            if (arguments.length == 1) {
                if (typeof e == "string") {
                    return Slick.search(this.document, e, new Elements)
                } else {
                    if (Type.isEnumerable(e)) {
                        return new Elements(e)
                    }
                }
            }
            return new Elements(arguments)
        })
    }
    var z = {before: function (l, e) {
        var G = e.parentNode;
        if (G) {
            G.insertBefore(l, e)
        }
    }, after: function (l, e) {
        var G = e.parentNode;
        if (G) {
            G.insertBefore(l, e.nextSibling)
        }
    }, bottom: function (l, e) {
        e.appendChild(l)
    }, top: function (l, e) {
        e.insertBefore(l, e.firstChild)
    }};
    z.inside = z.bottom;
    var m = {}, d = {};
    var n = {};
    Array.forEach(["type", "value", "defaultValue", "accessKey", "cellPadding", "cellSpacing", "colSpan", "frameBorder", "rowSpan", "tabIndex", "useMap"], function (e) {
        n[e.toLowerCase()] = e
    });
    n.html = "innerHTML";
    n.text = (document.createElement("div").textContent == null) ? "innerText" : "textContent";
    Object.forEach(n, function (l, e) {
        d[e] = function (G, H) {
            G[l] = H
        };
        m[e] = function (G) {
            return G[l]
        }
    });
    var A = ["compact", "nowrap", "ismap", "declare", "noshade", "checked", "disabled", "readOnly", "multiple", "selected", "noresize", "defer", "defaultChecked", "autofocus", "controls", "autoplay", "loop"];
    var h = {};
    Array.forEach(A, function (e) {
        var l = e.toLowerCase();
        h[l] = e;
        d[l] = function (G, H) {
            G[e] = !!H
        };
        m[l] = function (G) {
            return !!G[e]
        }
    });
    Object.append(d, {"class": function (e, l) {
        ("className" in e) ? e.className = (l || "") : e.setAttribute("class", l)
    }, "for": function (e, l) {
        ("htmlFor" in e) ? e.htmlFor = l : e.setAttribute("for", l)
    }, style: function (e, l) {
        (e.style) ? e.style.cssText = l : e.setAttribute("style", l)
    }, value: function (e, l) {
        e.value = (l != null) ? l : ""
    }});
    m["class"] = function (e) {
        return("className" in e) ? e.className || null : e.getAttribute("class")
    };
    var f = document.createElement("button");
    try {
        f.type = "button"
    } catch (C) {
    }
    if (f.type != "button") {
        d.type = function (e, l) {
            e.setAttribute("type", l)
        }
    }
    f = null;
    var s = document.createElement("input");
    s.value = "t";
    s.type = "submit";
    if (s.value != "t") {
        d.type = function (l, e) {
            var G = l.value;
            l.type = e;
            l.value = G
        }
    }
    s = null;
    var t = (function (e) {
        e.random = "attribute";
        return(e.getAttribute("random") == "attribute")
    })(document.createElement("div"));
    Element.implement({setProperty: function (l, G) {
        var H = d[l.toLowerCase()];
        if (H) {
            H(this, G)
        } else {
            if (t) {
                var e = this.retrieve("$attributeWhiteList", {})
            }
            if (G == null) {
                this.removeAttribute(l);
                if (t) {
                    delete e[l]
                }
            } else {
                this.setAttribute(l, G);
                if (t) {
                    e[l] = true
                }
            }
        }
        return this
    }, setProperties: function (e) {
        for (var l in e) {
            this.setProperty(l, e[l])
        }
        return this
    }, getProperty: function (I) {
        var G = m[I.toLowerCase()];
        if (G) {
            return G(this)
        }
        if (t) {
            var l = this.getAttributeNode(I), H = this.retrieve("$attributeWhiteList", {});
            if (!l) {
                return null
            }
            if (l.expando && !H[I]) {
                var J = this.outerHTML;
                if (J.substr(0, J.search(/\/?['"]?>(?![^<]*<['"])/)).indexOf(I) < 0) {
                    return null
                }
                H[I] = true
            }
        }
        var e = Slick.getAttribute(this, I);
        return(!e && !Slick.hasAttribute(this, I)) ? null : e
    }, getProperties: function () {
        var e = Array.from(arguments);
        return e.map(this.getProperty, this).associate(e)
    }, removeProperty: function (e) {
        return this.setProperty(e, null)
    }, removeProperties: function () {
        Array.each(arguments, this.removeProperty, this);
        return this
    }, set: function (G, l) {
        var e = Element.Properties[G];
        (e && e.set) ? e.set.call(this, l) : this.setProperty(G, l)
    }.overloadSetter(), get: function (l) {
        var e = Element.Properties[l];
        return(e && e.get) ? e.get.apply(this) : this.getProperty(l)
    }.overloadGetter(), erase: function (l) {
        var e = Element.Properties[l];
        (e && e.erase) ? e.erase.apply(this) : this.removeProperty(l);
        return this
    }, hasClass: function (e) {
        return this.className.clean().contains(e, " ")
    }, addClass: function (e) {
        if (!this.hasClass(e)) {
            this.className = (this.className + " " + e).clean()
        }
        return this
    }, removeClass: function (e) {
        this.className = this.className.replace(new RegExp("(^|\\s)" + e + "(?:\\s|$)"), "$1");
        return this
    }, toggleClass: function (e, l) {
        if (l == null) {
            l = !this.hasClass(e)
        }
        return(l) ? this.addClass(e) : this.removeClass(e)
    }, adopt: function () {
        var H = this, e, J = Array.flatten(arguments), I = J.length;
        if (I > 1) {
            H = e = document.createDocumentFragment()
        }
        for (var G = 0; G < I; G++) {
            var l = document.id(J[G], true);
            if (l) {
                H.appendChild(l)
            }
        }
        if (e) {
            this.appendChild(e)
        }
        return this
    }, appendText: function (l, e) {
        return this.grab(this.getDocument().newTextNode(l), e)
    }, grab: function (l, e) {
        z[e || "bottom"](document.id(l, true), this);
        return this
    }, inject: function (l, e) {
        z[e || "bottom"](this, document.id(l, true));
        return this
    }, replaces: function (e) {
        e = document.id(e, true);
        e.parentNode.replaceChild(this, e);
        return this
    }, wraps: function (l, e) {
        l = document.id(l, true);
        return this.replaces(l).grab(l, e)
    }, getSelected: function () {
        this.selectedIndex;
        return new Elements(Array.from(this.options).filter(function (e) {
            return e.selected
        }))
    }, toQueryString: function () {
        var e = [];
        this.getElements("input, select, textarea").each(function (G) {
            var l = G.type;
            if (!G.name || G.disabled || l == "submit" || l == "reset" || l == "file" || l == "image") {
                return
            }
            var H = (G.get("tag") == "select") ? G.getSelected().map(function (I) {
                return document.id(I).get("value")
            }) : ((l == "radio" || l == "checkbox") && !G.checked) ? null : G.get("value");
            Array.from(H).each(function (I) {
                if (typeof I != "undefined") {
                    e.push(encodeURIComponent(G.name) + "=" + encodeURIComponent(I))
                }
            })
        });
        return e.join("&")
    }});
    var k = {}, D = {};
    var E = function (e) {
        return(D[e] || (D[e] = {}))
    };
    var y = function (l) {
        var e = l.uniqueNumber;
        if (l.removeEvents) {
            l.removeEvents()
        }
        if (l.clearAttributes) {
            l.clearAttributes()
        }
        if (e != null) {
            delete k[e];
            delete D[e]
        }
        return l
    };
    var F = {input: "checked", option: "selected", textarea: "value"};
    Element.implement({destroy: function () {
        var e = y(this).getElementsByTagName("*");
        Array.each(e, y);
        Element.dispose(this);
        return null
    }, empty: function () {
        Array.from(this.childNodes).each(Element.dispose);
        return this
    }, dispose: function () {
        return(this.parentNode) ? this.parentNode.removeChild(this) : this
    }, clone: function (J, H) {
        J = J !== false;
        var O = this.cloneNode(J), G = [O], I = [this], M;
        if (J) {
            G.append(Array.from(O.getElementsByTagName("*")));
            I.append(Array.from(this.getElementsByTagName("*")))
        }
        for (M = G.length; M--;) {
            var K = G[M], N = I[M];
            if (!H) {
                K.removeAttribute("id")
            }
            if (K.clearAttributes) {
                K.clearAttributes();
                K.mergeAttributes(N);
                K.removeAttribute("uniqueNumber");
                if (K.options) {
                    var R = K.options, e = N.options;
                    for (var L = R.length; L--;) {
                        R[L].selected = e[L].selected
                    }
                }
            }
            var l = F[N.tagName.toLowerCase()];
            if (l && N[l]) {
                K[l] = N[l]
            }
        }
        if (Browser.ie) {
            var P = O.getElementsByTagName("object"), Q = this.getElementsByTagName("object");
            for (M = P.length; M--;) {
                P[M].outerHTML = Q[M].outerHTML
            }
        }
        return document.id(O)
    }});
    [Element, Window, Document].invoke("implement", {addListener: function (H, G) {
        if (H == "unload") {
            var e = G, l = this;
            G = function () {
                l.removeListener("unload", G);
                e()
            }
        } else {
            k[Slick.uidOf(this)] = this
        }
        if (this.addEventListener) {
            this.addEventListener(H, G, !!arguments[2])
        } else {
            this.attachEvent("on" + H, G)
        }
        return this
    }, removeListener: function (l, e) {
        if (this.removeEventListener) {
            this.removeEventListener(l, e, !!arguments[2])
        } else {
            this.detachEvent("on" + l, e)
        }
        return this
    }, retrieve: function (l, e) {
        var H = E(Slick.uidOf(this)), G = H[l];
        if (e != null && G == null) {
            G = H[l] = e
        }
        return G != null ? G : null
    }, store: function (l, e) {
        var G = E(Slick.uidOf(this));
        G[l] = e;
        return this
    }, eliminate: function (e) {
        var l = E(Slick.uidOf(this));
        delete l[e];
        return this
    }});
    if (window.attachEvent && !window.addEventListener) {
        window.addListener("unload", function () {
            Object.each(k, y);
            if (window.CollectGarbage) {
                CollectGarbage()
            }
        })
    }
    Element.Properties = {};
    Element.Properties.style = {set: function (e) {
        this.style.cssText = e
    }, get: function () {
        return this.style.cssText
    }, erase: function () {
        this.style.cssText = ""
    }};
    Element.Properties.tag = {get: function () {
        return this.tagName.toLowerCase()
    }};
    Element.Properties.html = {set: function (e) {
        if (e == null) {
            e = ""
        } else {
            if (typeOf(e) == "array") {
                e = e.join("")
            }
        }
        this.innerHTML = e
    }, erase: function () {
        this.innerHTML = ""
    }};
    var w = document.createElement("div");
    w.innerHTML = "<nav></nav>";
    var a = (w.childNodes.length == 1);
    if (!a) {
        var v = "abbr article aside audio canvas datalist details figcaption figure footer header hgroup mark meter nav output progress section summary time video".split(" "), b = document.createDocumentFragment(), x = v.length;
        while (x--) {
            b.createElement(v[x])
        }
    }
    w = null;
    var g = Function.attempt(function () {
        var e = document.createElement("table");
        e.innerHTML = "<tr><td></td></tr>";
        return true
    });
    var c = document.createElement("tr"), r = "<td></td>";
    c.innerHTML = r;
    var B = (c.innerHTML == r);
    c = null;
    if (!g || !B || !a) {
        Element.Properties.html.set = (function (l) {
            var e = {table: [1, "<table>", "</table>"], select: [1, "<select>", "</select>"], tbody: [2, "<table><tbody>", "</tbody></table>"], tr: [3, "<table><tbody><tr>", "</tr></tbody></table>"]};
            e.thead = e.tfoot = e.tbody;
            return function (G) {
                var H = e[this.get("tag")];
                if (!H && !a) {
                    H = [0, "", ""]
                }
                if (!H) {
                    return l.call(this, G)
                }
                var K = H[0], J = document.createElement("div"), I = J;
                if (!a) {
                    b.appendChild(J)
                }
                J.innerHTML = [H[1], G, H[2]].flatten().join("");
                while (K--) {
                    I = I.firstChild
                }
                this.empty().adopt(I.childNodes);
                if (!a) {
                    b.removeChild(J)
                }
                J = null
            }
        })(Element.Properties.html.set)
    }
    var q = document.createElement("form");
    q.innerHTML = "<select><option>s</option></select>";
    if (q.firstChild.value != "s") {
        Element.Properties.value = {set: function (J) {
            var l = this.get("tag");
            if (l != "select") {
                return this.setProperty("value", J)
            }
            var G = this.getElements("option");
            for (var H = 0; H < G.length; H++) {
                var I = G[H], e = I.getAttributeNode("value"), K = (e && e.specified) ? I.value : I.get("text");
                if (K == J) {
                    return I.selected = true
                }
            }
        }, get: function () {
            var G = this, l = G.get("tag");
            if (l != "select" && l != "option") {
                return this.getProperty("value")
            }
            if (l == "select" && !(G = G.getSelected()[0])) {
                return""
            }
            var e = G.getAttributeNode("value");
            return(e && e.specified) ? G.value : G.get("text")
        }}
    }
    q = null;
    if (document.createElement("div").getAttributeNode("id")) {
        Element.Properties.id = {set: function (e) {
            this.id = this.getAttributeNode("id").value = e
        }, get: function () {
            return this.id || null
        }, erase: function () {
            this.id = this.getAttributeNode("id").value = ""
        }}
    }
})();
(function () {
    var k = document.html;
    var d = document.createElement("div");
    d.style.color = "red";
    d.style.color = null;
    var c = d.style.color == "red";
    d = null;
    Element.Properties.styles = {set: function (m) {
        this.setStyles(m)
    }};
    var h = (k.style.opacity != null), e = (k.style.filter != null), l = /alpha\(opacity=([\d.]+)\)/i;
    var a = function (n, m) {
        n.store("$opacity", m);
        n.style.visibility = m > 0 || m == null ? "visible" : "hidden"
    };
    var f = (h ? function (n, m) {
        n.style.opacity = m
    } : (e ? function (n, m) {
        var q = n.style;
        if (!n.currentStyle || !n.currentStyle.hasLayout) {
            q.zoom = 1
        }
        if (m == null) {
            m = ""
        } else {
            m = "alpha(opacity=" + (m * 100).limit(0, 100).round() + ")"
        }
        var o = q.filter || n.getComputedStyle("filter") || "";
        q.filter = l.test(o) ? o.replace(l, m) : o + m;
        if (!q.filter) {
            q.removeAttribute("filter")
        }
    } : a));
    var g = (h ? function (n) {
        var m = n.style.opacity || n.getComputedStyle("opacity");
        return(m == "") ? 1 : m.toFloat()
    } : (e ? function (n) {
        var o = (n.style.filter || n.getComputedStyle("filter")), m;
        if (o) {
            m = o.match(l)
        }
        return(m == null || o == null) ? 1 : (m[1] / 100)
    } : function (n) {
        var m = n.retrieve("$opacity");
        if (m == null) {
            m = (n.style.visibility == "hidden" ? 0 : 1)
        }
        return m
    }));
    var b = (k.style.cssFloat == null) ? "styleFloat" : "cssFloat";
    Element.implement({getComputedStyle: function (o) {
        if (this.currentStyle) {
            return this.currentStyle[o.camelCase()]
        }
        var n = Element.getDocument(this).defaultView, m = n ? n.getComputedStyle(this, null) : null;
        return(m) ? m.getPropertyValue((o == b) ? "float" : o.hyphenate()) : null
    }, setStyle: function (n, m) {
        if (n == "opacity") {
            if (m != null) {
                m = parseFloat(m)
            }
            f(this, m);
            return this
        }
        n = (n == "float" ? b : n).camelCase();
        if (typeOf(m) != "string") {
            var o = (Element.Styles[n] || "@").split(" ");
            m = Array.from(m).map(function (r, q) {
                if (!o[q]) {
                    return""
                }
                return(typeOf(r) == "number") ? o[q].replace("@", Math.round(r)) : r
            }).join(" ")
        } else {
            if (m == String(Number(m))) {
                m = Math.round(m)
            }
        }
        this.style[n] = m;
        if ((m == "" || m == null) && c && this.style.removeAttribute) {
            this.style.removeAttribute(n)
        }
        return this
    }, getStyle: function (u) {
        if (u == "opacity") {
            return g(this)
        }
        u = (u == "float" ? b : u).camelCase();
        var m = this.style[u];
        if (!m || u == "zIndex") {
            m = [];
            for (var t in Element.ShortStyles) {
                if (u != t) {
                    continue
                }
                for (var r in Element.ShortStyles[t]) {
                    m.push(this.getStyle(r))
                }
                return m.join(" ")
            }
            m = this.getComputedStyle(u)
        }
        if (m) {
            m = String(m);
            var o = m.match(/rgba?\([\d\s,]+\)/);
            if (o) {
                m = m.replace(o[0], o[0].rgbToHex())
            }
        }
        if (Browser.opera || (Browser.ie && isNaN(parseFloat(m)))) {
            if ((/^(height|width)$/).test(u)) {
                var n = (u == "width") ? ["left", "right"] : ["top", "bottom"], q = 0;
                n.each(function (s) {
                    q += this.getStyle("border-" + s + "-width").toInt() + this.getStyle("padding-" + s).toInt()
                }, this);
                return this["offset" + u.capitalize()] - q + "px"
            }
            if (Browser.opera && String(m).indexOf("px") != -1) {
                return m
            }
            if ((/^border(.+)Width|margin|padding/).test(u)) {
                return"0px"
            }
        }
        return m
    }, setStyles: function (n) {
        for (var m in n) {
            this.setStyle(m, n[m])
        }
        return this
    }, getStyles: function () {
        var m = {};
        Array.flatten(arguments).each(function (n) {
            m[n] = this.getStyle(n)
        }, this);
        return m
    }});
    Element.Styles = {left: "@px", top: "@px", bottom: "@px", right: "@px", width: "@px", height: "@px", maxWidth: "@px", maxHeight: "@px", minWidth: "@px", minHeight: "@px", backgroundColor: "rgb(@, @, @)", backgroundPosition: "@px @px", color: "rgb(@, @, @)", fontSize: "@px", letterSpacing: "@px", lineHeight: "@px", clip: "rect(@px @px @px @px)", margin: "@px @px @px @px", padding: "@px @px @px @px", border: "@px @ rgb(@, @, @) @px @ rgb(@, @, @) @px @ rgb(@, @, @)", borderWidth: "@px @px @px @px", borderStyle: "@ @ @ @", borderColor: "rgb(@, @, @) rgb(@, @, @) rgb(@, @, @) rgb(@, @, @)", zIndex: "@", zoom: "@", fontWeight: "@", textIndent: "@px", opacity: "@"};
    Element.ShortStyles = {margin: {}, padding: {}, border: {}, borderWidth: {}, borderStyle: {}, borderColor: {}};
    ["Top", "Right", "Bottom", "Left"].each(function (t) {
        var s = Element.ShortStyles;
        var n = Element.Styles;
        ["margin", "padding"].each(function (u) {
            var v = u + t;
            s[u][v] = n[v] = "@px"
        });
        var r = "border" + t;
        s.border[r] = n[r] = "@px @ rgb(@, @, @)";
        var q = r + "Width", m = r + "Style", o = r + "Color";
        s[r] = {};
        s.borderWidth[q] = s[r][q] = n[q] = "@px";
        s.borderStyle[m] = s[r][m] = n[m] = "@";
        s.borderColor[o] = s[r][o] = n[o] = "rgb(@, @, @)"
    })
})();
(function () {
    Element.Properties.events = {set: function (b) {
        this.addEvents(b)
    }};
    [Element, Window, Document].invoke("implement", {addEvent: function (f, h) {
        var k = this.retrieve("events", {});
        if (!k[f]) {
            k[f] = {keys: [], values: []}
        }
        if (k[f].keys.contains(h)) {
            return this
        }
        k[f].keys.push(h);
        var g = f, b = Element.Events[f], d = h, l = this;
        if (b) {
            if (b.onAdd) {
                b.onAdd.call(this, h, f)
            }
            if (b.condition) {
                d = function (m) {
                    if (b.condition.call(this, m, f)) {
                        return h.call(this, m)
                    }
                    return true
                }
            }
            if (b.base) {
                g = Function.from(b.base).call(this, f)
            }
        }
        var e = function () {
            return h.call(l)
        };
        var c = Element.NativeEvents[g];
        if (c) {
            if (c == 2) {
                e = function (m) {
                    m = new DOMEvent(m, l.getWindow());
                    if (d.call(l, m) === false) {
                        m.stop()
                    }
                }
            }
            this.addListener(g, e, arguments[2])
        }
        k[f].values.push(e);
        return this
    }, removeEvent: function (e, d) {
        var c = this.retrieve("events");
        if (!c || !c[e]) {
            return this
        }
        var h = c[e];
        var b = h.keys.indexOf(d);
        if (b == -1) {
            return this
        }
        var g = h.values[b];
        delete h.keys[b];
        delete h.values[b];
        var f = Element.Events[e];
        if (f) {
            if (f.onRemove) {
                f.onRemove.call(this, d, e)
            }
            if (f.base) {
                e = Function.from(f.base).call(this, e)
            }
        }
        return(Element.NativeEvents[e]) ? this.removeListener(e, g, arguments[2]) : this
    }, addEvents: function (b) {
        for (var c in b) {
            this.addEvent(c, b[c])
        }
        return this
    }, removeEvents: function (b) {
        var d;
        if (typeOf(b) == "object") {
            for (d in b) {
                this.removeEvent(d, b[d])
            }
            return this
        }
        var c = this.retrieve("events");
        if (!c) {
            return this
        }
        if (!b) {
            for (d in c) {
                this.removeEvents(d)
            }
            this.eliminate("events")
        } else {
            if (c[b]) {
                c[b].keys.each(function (e) {
                    this.removeEvent(b, e)
                }, this);
                delete c[b]
            }
        }
        return this
    }, fireEvent: function (e, c, b) {
        var d = this.retrieve("events");
        if (!d || !d[e]) {
            return this
        }
        c = Array.from(c);
        d[e].keys.each(function (f) {
            if (b) {
                f.delay(b, this, c)
            } else {
                f.apply(this, c)
            }
        }, this);
        return this
    }, cloneEvents: function (e, d) {
        e = document.id(e);
        var c = e.retrieve("events");
        if (!c) {
            return this
        }
        if (!d) {
            for (var b in c) {
                this.cloneEvents(e, b)
            }
        } else {
            if (c[d]) {
                c[d].keys.each(function (f) {
                    this.addEvent(d, f)
                }, this)
            }
        }
        return this
    }});
    Element.NativeEvents = {click: 2, dblclick: 2, mouseup: 2, mousedown: 2, contextmenu: 2, mousewheel: 2, DOMMouseScroll: 2, mouseover: 2, mouseout: 2, mousemove: 2, selectstart: 2, selectend: 2, keydown: 2, keypress: 2, keyup: 2, orientationchange: 2, touchstart: 2, touchmove: 2, touchend: 2, touchcancel: 2, gesturestart: 2, gesturechange: 2, gestureend: 2, focus: 2, blur: 2, change: 2, reset: 2, select: 2, submit: 2, paste: 2, input: 2, load: 2, unload: 1, beforeunload: 2, resize: 1, move: 1, DOMContentLoaded: 1, readystatechange: 1, error: 1, abort: 1, scroll: 1};
    Element.Events = {mousewheel: {base: (Browser.firefox) ? "DOMMouseScroll" : "mousewheel"}};
    if ("onmouseenter" in document.documentElement) {
        Element.NativeEvents.mouseenter = Element.NativeEvents.mouseleave = 2
    } else {
        var a = function (b) {
            var c = b.relatedTarget;
            if (c == null) {
                return true
            }
            if (!c) {
                return false
            }
            return(c != this && c.prefix != "xul" && typeOf(this) != "document" && !this.contains(c))
        };
        Element.Events.mouseenter = {base: "mouseover", condition: a};
        Element.Events.mouseleave = {base: "mouseout", condition: a}
    }
    if (!window.addEventListener) {
        Element.NativeEvents.propertychange = 2;
        Element.Events.change = {base: function () {
            var b = this.type;
            return(this.get("tag") == "input" && (b == "radio" || b == "checkbox")) ? "propertychange" : "change"
        }, condition: function (b) {
            return this.type != "radio" || (b.event.propertyName == "checked" && this.checked)
        }}
    }
})();
(function () {
    var c = !!window.addEventListener;
    Element.NativeEvents.focusin = Element.NativeEvents.focusout = 2;
    var m = function (n, o, q, r, s) {
        while (s && s != n) {
            if (o(s, r)) {
                return q.call(s, r, s)
            }
            s = document.id(s.parentNode)
        }
    };
    var a = {mouseenter: {base: "mouseover"}, mouseleave: {base: "mouseout"}, focus: {base: "focus" + (c ? "" : "in"), capture: true}, blur: {base: c ? "blur" : "focusout", capture: true}};
    var b = "$delegation:";
    var k = function (n) {
        return{base: "focusin", remove: function (o, r) {
            var s = o.retrieve(b + n + "listeners", {})[r];
            if (s && s.forms) {
                for (var q = s.forms.length; q--;) {
                    s.forms[q].removeEvent(n, s.fns[q])
                }
            }
        }, listen: function (A, u, y, q, w, v) {
            var r = (w.get("tag") == "form") ? w : q.target.getParent("form");
            if (!r) {
                return
            }
            var x = A.retrieve(b + n + "listeners", {}), s = x[v] || {forms: [], fns: []}, o = s.forms, z = s.fns;
            if (o.indexOf(r) != -1) {
                return
            }
            o.push(r);
            var t = function (B) {
                m(A, u, y, B, w)
            };
            r.addEvent(n, t);
            z.push(t);
            x[v] = s;
            A.store(b + n + "listeners", x)
        }}
    };
    var d = function (n) {
        return{base: "focusin", listen: function (o, q, s, t, u) {
            var r = {blur: function () {
                this.removeEvents(r)
            }};
            r[n] = function (v) {
                m(o, q, s, v, u)
            };
            t.target.addEvents(r)
        }}
    };
    if (!c) {
        Object.append(a, {submit: k("submit"), reset: k("reset"), change: d("change"), select: d("select")})
    }
    var h = Element.prototype, f = h.addEvent, l = h.removeEvent;
    var e = function (n, o) {
        return function (u, t, q) {
            if (u.indexOf(":relay") == -1) {
                return n.call(this, u, t, q)
            }
            var r = Slick.parse(u).expressions[0][0];
            if (r.pseudos[0].key != "relay") {
                return n.call(this, u, t, q)
            }
            var s = r.tag;
            r.pseudos.slice(1).each(function (v) {
                s += ":" + v.key + (v.value ? "(" + v.value + ")" : "")
            });
            n.call(this, u, t);
            return o.call(this, s, r.pseudos[0].value, t)
        }
    };
    var g = {addEvent: function (y, t, A) {
        var w = this.retrieve("$delegates", {}), u = w[y];
        if (u) {
            for (var B in u) {
                if (u[B].fn == A && u[B].match == t) {
                    return this
                }
            }
        }
        var s = y, x = t, r = A, q = a[y] || {};
        y = q.base || s;
        t = function (E) {
            return Slick.match(E, x)
        };
        var z = Element.Events[s];
        if (z && z.condition) {
            var n = t, o = z.condition;
            t = function (F, E) {
                return n(F, E) && o.call(F, E, y)
            }
        }
        var C = this, v = String.uniqueID();
        var D = q.listen ? function (E, F) {
            if (!F && E && E.target) {
                F = E.target
            }
            if (F) {
                q.listen(C, t, A, E, F, v)
            }
        } : function (E, F) {
            if (!F && E && E.target) {
                F = E.target
            }
            if (F) {
                m(C, t, A, E, F)
            }
        };
        if (!u) {
            u = {}
        }
        u[v] = {match: x, fn: r, delegator: D};
        w[s] = u;
        return f.call(this, y, D, q.capture)
    }, removeEvent: function (v, q, w, x) {
        var u = this.retrieve("$delegates", {}), t = u[v];
        if (!t) {
            return this
        }
        if (x) {
            var o = v, z = t[x].delegator, n = a[v] || {};
            v = n.base || o;
            if (n.remove) {
                n.remove(this, x)
            }
            delete t[x];
            u[o] = t;
            return l.call(this, v, z)
        }
        var r, y;
        if (w) {
            for (r in t) {
                y = t[r];
                if (y.match == q && y.fn == w) {
                    return g.removeEvent.call(this, v, q, w, r)
                }
            }
        } else {
            for (r in t) {
                y = t[r];
                if (y.match == q) {
                    g.removeEvent.call(this, v, q, y.fn, r)
                }
            }
        }
        return this
    }};
    [Element, Window, Document].invoke("implement", {addEvent: e(f, g.addEvent), removeEvent: e(l, g.removeEvent)})
})();
(function () {
    var h = document.createElement("div"), e = document.createElement("div");
    h.style.height = "0";
    h.appendChild(e);
    var d = (e.offsetParent === h);
    h = e = null;
    var n = function (o) {
        return m(o, "position") != "static" || a(o)
    };
    var k = function (o) {
        return n(o) || (/^(?:table|td|th)$/i).test(o.tagName)
    };
    Element.implement({scrollTo: function (o, q) {
        if (a(this)) {
            this.getWindow().scrollTo(o, q)
        } else {
            this.scrollLeft = o;
            this.scrollTop = q
        }
        return this
    }, getSize: function () {
        if (a(this)) {
            return this.getWindow().getSize()
        }
        return{x: this.offsetWidth, y: this.offsetHeight}
    }, getScrollSize: function () {
        if (a(this)) {
            return this.getWindow().getScrollSize()
        }
        return{x: this.scrollWidth, y: this.scrollHeight}
    }, getScroll: function () {
        if (a(this)) {
            return this.getWindow().getScroll()
        }
        return{x: this.scrollLeft, y: this.scrollTop}
    }, getScrolls: function () {
        var q = this.parentNode, o = {x: 0, y: 0};
        while (q && !a(q)) {
            o.x += q.scrollLeft;
            o.y += q.scrollTop;
            q = q.parentNode
        }
        return o
    }, getOffsetParent: d ? function () {
        var o = this;
        if (a(o) || m(o, "position") == "fixed") {
            return null
        }
        var q = (m(o, "position") == "static") ? k : n;
        while ((o = o.parentNode)) {
            if (q(o)) {
                return o
            }
        }
        return null
    } : function () {
        var o = this;
        if (a(o) || m(o, "position") == "fixed") {
            return null
        }
        try {
            return o.offsetParent
        } catch (q) {
        }
        return null
    }, getOffsets: function () {
        if (this.getBoundingClientRect && !Browser.Platform.ios) {
            var u = this.getBoundingClientRect(), r = document.id(this.getDocument().documentElement), t = r.getScroll(), w = this.getScrolls(), v = (m(this, "position") == "fixed");
            return{x: u.left.toInt() + w.x + ((v) ? 0 : t.x) - r.clientLeft, y: u.top.toInt() + w.y + ((v) ? 0 : t.y) - r.clientTop}
        }
        var q = this, o = {x: 0, y: 0};
        if (a(this)) {
            return o
        }
        while (q && !a(q)) {
            o.x += q.offsetLeft;
            o.y += q.offsetTop;
            if (Browser.firefox) {
                if (!c(q)) {
                    o.x += b(q);
                    o.y += g(q)
                }
                var s = q.parentNode;
                if (s && m(s, "overflow") != "visible") {
                    o.x += b(s);
                    o.y += g(s)
                }
            } else {
                if (q != this && Browser.safari) {
                    o.x += b(q);
                    o.y += g(q)
                }
            }
            q = q.offsetParent
        }
        if (Browser.firefox && !c(this)) {
            o.x -= b(this);
            o.y -= g(this)
        }
        return o
    }, getPosition: function (s) {
        var t = this.getOffsets(), q = this.getScrolls();
        var o = {x: t.x - q.x, y: t.y - q.y};
        if (s && (s = document.id(s))) {
            var r = s.getPosition();
            return{x: o.x - r.x - b(s), y: o.y - r.y - g(s)}
        }
        return o
    }, getCoordinates: function (r) {
        if (a(this)) {
            return this.getWindow().getCoordinates()
        }
        var o = this.getPosition(r), q = this.getSize();
        var s = {left: o.x, top: o.y, width: q.x, height: q.y};
        s.right = s.left + s.width;
        s.bottom = s.top + s.height;
        return s
    }, computePosition: function (o) {
        return{left: o.x - l(this, "margin-left"), top: o.y - l(this, "margin-top")}
    }, setPosition: function (o) {
        return this.setStyles(this.computePosition(o))
    }});
    [Document, Window].invoke("implement", {getSize: function () {
        var o = f(this);
        return{x: o.clientWidth, y: o.clientHeight}
    }, getScroll: function () {
        var q = this.getWindow(), o = f(this);
        return{x: q.pageXOffset || o.scrollLeft, y: q.pageYOffset || o.scrollTop}
    }, getScrollSize: function () {
        var r = f(this), q = this.getSize(), o = this.getDocument().body;
        return{x: Math.max(r.scrollWidth, o.scrollWidth, q.x), y: Math.max(r.scrollHeight, o.scrollHeight, q.y)}
    }, getPosition: function () {
        return{x: 0, y: 0}
    }, getCoordinates: function () {
        var o = this.getSize();
        return{top: 0, left: 0, bottom: o.y, right: o.x, height: o.y, width: o.x}
    }});
    var m = Element.getComputedStyle;

    function l(o, q) {
        return m(o, q).toInt() || 0
    }

    function c(o) {
        return m(o, "-moz-box-sizing") == "border-box"
    }

    function g(o) {
        return l(o, "border-top-width")
    }

    function b(o) {
        return l(o, "border-left-width")
    }

    function a(o) {
        return(/^(?:body|html)$/i).test(o.tagName)
    }

    function f(o) {
        var q = o.getDocument();
        return(!q.compatMode || q.compatMode == "CSS1Compat") ? q.html : q.body
    }
})();
Element.alias({position: "setPosition"});
[Window, Document, Element].invoke("implement", {getHeight: function () {
    return this.getSize().y
}, getWidth: function () {
    return this.getSize().x
}, getScrollTop: function () {
    return this.getScroll().y
}, getScrollLeft: function () {
    return this.getScroll().x
}, getScrollHeight: function () {
    return this.getScrollSize().y
}, getScrollWidth: function () {
    return this.getScrollSize().x
}, getTop: function () {
    return this.getPosition().y
}, getLeft: function () {
    return this.getPosition().x
}});
(function () {
    var f = this.Fx = new Class({Implements: [Chain, Events, Options], options: {fps: 60, unit: false, duration: 500, frames: null, frameSkip: true, link: "ignore"}, initialize: function (g) {
        this.subject = this.subject || this;
        this.setOptions(g)
    }, getTransition: function () {
        return function (g) {
            return -(Math.cos(Math.PI * g) - 1) / 2
        }
    }, step: function (g) {
        if (this.options.frameSkip) {
            var h = (this.time != null) ? (g - this.time) : 0, k = h / this.frameInterval;
            this.time = g;
            this.frame += k
        } else {
            this.frame++
        }
        if (this.frame < this.frames) {
            var l = this.transition(this.frame / this.frames);
            this.set(this.compute(this.from, this.to, l))
        } else {
            this.frame = this.frames;
            this.set(this.compute(this.from, this.to, 1));
            this.stop()
        }
    }, set: function (g) {
        return g
    }, compute: function (k, h, g) {
        return f.compute(k, h, g)
    }, check: function () {
        if (!this.isRunning()) {
            return true
        }
        switch (this.options.link) {
            case"cancel":
                this.cancel();
                return true;
            case"chain":
                this.chain(this.caller.pass(arguments, this));
                return false
        }
        return false
    }, start: function (m, l) {
        if (!this.check(m, l)) {
            return this
        }
        this.from = m;
        this.to = l;
        this.frame = (this.options.frameSkip) ? 0 : -1;
        this.time = null;
        this.transition = this.getTransition();
        var k = this.options.frames, h = this.options.fps, g = this.options.duration;
        this.duration = f.Durations[g] || g.toInt();
        this.frameInterval = 1000 / h;
        this.frames = k || Math.round(this.duration / this.frameInterval);
        this.fireEvent("start", this.subject);
        b.call(this, h);
        return this
    }, stop: function () {
        if (this.isRunning()) {
            this.time = null;
            d.call(this, this.options.fps);
            if (this.frames == this.frame) {
                this.fireEvent("complete", this.subject);
                if (!this.callChain()) {
                    this.fireEvent("chainComplete", this.subject)
                }
            } else {
                this.fireEvent("stop", this.subject)
            }
        }
        return this
    }, cancel: function () {
        if (this.isRunning()) {
            this.time = null;
            d.call(this, this.options.fps);
            this.frame = this.frames;
            this.fireEvent("cancel", this.subject).clearChain()
        }
        return this
    }, pause: function () {
        if (this.isRunning()) {
            this.time = null;
            d.call(this, this.options.fps)
        }
        return this
    }, resume: function () {
        if ((this.frame < this.frames) && !this.isRunning()) {
            b.call(this, this.options.fps)
        }
        return this
    }, isRunning: function () {
        var g = e[this.options.fps];
        return g && g.contains(this)
    }});
    f.compute = function (k, h, g) {
        return(h - k) * g + k
    };
    f.Durations = {"short": 250, normal: 500, "long": 1000};
    var e = {}, c = {};
    var a = function () {
        var h = Date.now();
        for (var k = this.length; k--;) {
            var g = this[k];
            if (g) {
                g.step(h)
            }
        }
    };
    var b = function (h) {
        var g = e[h] || (e[h] = []);
        g.push(this);
        if (!c[h]) {
            c[h] = a.periodical(Math.round(1000 / h), g)
        }
    };
    var d = function (h) {
        var g = e[h];
        if (g) {
            g.erase(this);
            if (!g.length && c[h]) {
                delete e[h];
                c[h] = clearInterval(c[h])
            }
        }
    }
})();
Fx.CSS = new Class({Extends: Fx, prepare: function (c, d, b) {
    b = Array.from(b);
    if (b[1] == null) {
        b[1] = b[0];
        b[0] = c.getStyle(d);
        if (this.options.unit != "px") {
            c.setStyle(d, b[1] + this.options.unit);
            b[0] = (b[1] || 1) / parseFloat(c.getComputedStyle(d)) * (parseFloat(b[0]) || 0);
            c.setStyle(d, b[0] + this.options.unit)
        }
    }
    var a = b.map(this.parse);
    return{from: a[0], to: a[1]}
}, parse: function (a) {
    a = Function.from(a)();
    a = (typeof a == "string") ? a.split(" ") : Array.from(a);
    return a.map(function (c) {
        c = String(c);
        var b = false;
        Object.each(Fx.CSS.Parsers, function (f, e) {
            if (b) {
                return
            }
            var d = f.parse(c);
            if (d || d === 0) {
                b = {value: d, parser: f}
            }
        });
        b = b || {value: c, parser: Fx.CSS.Parsers.String};
        return b
    })
}, compute: function (d, c, b) {
    var a = [];
    (Math.min(d.length, c.length)).times(function (e) {
        a.push({value: d[e].parser.compute(d[e].value, c[e].value, b), parser: d[e].parser})
    });
    a.$family = Function.from("fx:css:value");
    return a
}, serve: function (c, b) {
    if (typeOf(c) != "fx:css:value") {
        c = this.parse(c)
    }
    var a = [];
    c.each(function (d) {
        a = a.concat(d.parser.serve(d.value, b))
    });
    return a
}, render: function (a, d, c, b) {
    a.setStyle(d, this.serve(c, b))
}, search: function (a) {
    if (Fx.CSS.Cache[a]) {
        return Fx.CSS.Cache[a]
    }
    var c = {}, b = new RegExp("^" + a.escapeRegExp() + "$");
    Array.each(document.styleSheets, function (f, e) {
        var d = f.href;
        if (d && d.contains("://") && !d.contains(document.domain)) {
            return
        }
        var g = f.rules || f.cssRules;
        Array.each(g, function (l, h) {
            if (!l.style) {
                return
            }
            var k = (l.selectorText) ? l.selectorText.replace(/^\w+/, function (n) {
                return n.toLowerCase()
            }) : null;
            if (!k || !b.test(k)) {
                return
            }
            Object.each(Element.Styles, function (n, m) {
                if (!l.style[m] || Element.ShortStyles[m]) {
                    return
                }
                n = String(l.style[m]);
                c[m] = ((/^rgb/).test(n)) ? n.rgbToHex() : n
            })
        })
    });
    return Fx.CSS.Cache[a] = c
}});
Fx.CSS.Cache = {};
Fx.CSS.Parsers = {Color: {parse: function (a) {
    if (a.match(/^#[0-9a-f]{3,6}$/i)) {
        return a.hexToRgb(true)
    }
    return((a = a.match(/(\d+),\s*(\d+),\s*(\d+)/))) ? [a[1], a[2], a[3]] : false
}, compute: function (c, b, a) {
    return c.map(function (e, d) {
        return Math.round(Fx.compute(c[d], b[d], a))
    })
}, serve: function (a) {
    return a.map(Number)
}}, Number: {parse: parseFloat, compute: Fx.compute, serve: function (b, a) {
    return(a) ? b + a : b
}}, String: {parse: Function.from(false), compute: function (b, a) {
    return a
}, serve: function (a) {
    return a
}}};
Fx.Tween = new Class({Extends: Fx.CSS, initialize: function (b, a) {
    this.element = this.subject = document.id(b);
    this.parent(a)
}, set: function (b, a) {
    if (arguments.length == 1) {
        a = b;
        b = this.property || this.options.property
    }
    this.render(this.element, b, a, this.options.unit);
    return this
}, start: function (c, e, d) {
    if (!this.check(c, e, d)) {
        return this
    }
    var b = Array.flatten(arguments);
    this.property = this.options.property || b.shift();
    var a = this.prepare(this.element, this.property, b);
    return this.parent(a.from, a.to)
}});
Element.Properties.tween = {set: function (a) {
    this.get("tween").cancel().setOptions(a);
    return this
}, get: function () {
    var a = this.retrieve("tween");
    if (!a) {
        a = new Fx.Tween(this, {link: "cancel"});
        this.store("tween", a)
    }
    return a
}};
Element.implement({tween: function (a, c, b) {
    this.get("tween").start(a, c, b);
    return this
}, fade: function (d) {
    var e = this.get("tween"), g, c = ["opacity"].append(arguments), a;
    if (c[1] == null) {
        c[1] = "toggle"
    }
    switch (c[1]) {
        case"in":
            g = "start";
            c[1] = 1;
            break;
        case"out":
            g = "start";
            c[1] = 0;
            break;
        case"show":
            g = "set";
            c[1] = 1;
            break;
        case"hide":
            g = "set";
            c[1] = 0;
            break;
        case"toggle":
            var b = this.retrieve("fade:flag", this.getStyle("opacity") == 1);
            g = "start";
            c[1] = b ? 0 : 1;
            this.store("fade:flag", !b);
            a = true;
            break;
        default:
            g = "start"
    }
    if (!a) {
        this.eliminate("fade:flag")
    }
    e[g].apply(e, c);
    var f = c[c.length - 1];
    if (g == "set" || f != 0) {
        this.setStyle("visibility", f == 0 ? "hidden" : "visible")
    } else {
        e.chain(function () {
            this.element.setStyle("visibility", "hidden");
            this.callChain()
        })
    }
    return this
}, highlight: function (c, a) {
    if (!a) {
        a = this.retrieve("highlight:original", this.getStyle("background-color"));
        a = (a == "transparent") ? "#fff" : a
    }
    var b = this.get("tween");
    b.start("background-color", c || "#ffff88", a).chain(function () {
        this.setStyle("background-color", this.retrieve("highlight:original"));
        b.callChain()
    }.bind(this));
    return this
}});
Fx.Morph = new Class({Extends: Fx.CSS, initialize: function (b, a) {
    this.element = this.subject = document.id(b);
    this.parent(a)
}, set: function (a) {
    if (typeof a == "string") {
        a = this.search(a)
    }
    for (var b in a) {
        this.render(this.element, b, a[b], this.options.unit)
    }
    return this
}, compute: function (e, d, c) {
    var a = {};
    for (var b in e) {
        a[b] = this.parent(e[b], d[b], c)
    }
    return a
}, start: function (b) {
    if (!this.check(b)) {
        return this
    }
    if (typeof b == "string") {
        b = this.search(b)
    }
    var e = {}, d = {};
    for (var c in b) {
        var a = this.prepare(this.element, c, b[c]);
        e[c] = a.from;
        d[c] = a.to
    }
    return this.parent(e, d)
}});
Element.Properties.morph = {set: function (a) {
    this.get("morph").cancel().setOptions(a);
    return this
}, get: function () {
    var a = this.retrieve("morph");
    if (!a) {
        a = new Fx.Morph(this, {link: "cancel"});
        this.store("morph", a)
    }
    return a
}};
Element.implement({morph: function (a) {
    this.get("morph").start(a);
    return this
}});
Fx.implement({getTransition: function () {
    var a = this.options.transition || Fx.Transitions.Sine.easeInOut;
    if (typeof a == "string") {
        var b = a.split(":");
        a = Fx.Transitions;
        a = a[b[0]] || a[b[0].capitalize()];
        if (b[1]) {
            a = a["ease" + b[1].capitalize() + (b[2] ? b[2].capitalize() : "")]
        }
    }
    return a
}});
Fx.Transition = function (c, b) {
    b = Array.from(b);
    var a = function (d) {
        return c(d, b)
    };
    return Object.append(a, {easeIn: a, easeOut: function (d) {
        return 1 - c(1 - d, b)
    }, easeInOut: function (d) {
        return(d <= 0.5 ? c(2 * d, b) : (2 - c(2 * (1 - d), b))) / 2
    }})
};
Fx.Transitions = {linear: function (a) {
    return a
}};
Fx.Transitions.extend = function (a) {
    for (var b in a) {
        Fx.Transitions[b] = new Fx.Transition(a[b])
    }
};
Fx.Transitions.extend({Pow: function (b, a) {
    return Math.pow(b, a && a[0] || 6)
}, Expo: function (a) {
    return Math.pow(2, 8 * (a - 1))
}, Circ: function (a) {
    return 1 - Math.sin(Math.acos(a))
}, Sine: function (a) {
    return 1 - Math.cos(a * Math.PI / 2)
}, Back: function (b, a) {
    a = a && a[0] || 1.618;
    return Math.pow(b, 2) * ((a + 1) * b - a)
}, Bounce: function (f) {
    var e;
    for (var d = 0, c = 1; 1; d += c, c /= 2) {
        if (f >= (7 - 4 * d) / 11) {
            e = c * c - Math.pow((11 - 6 * d - 11 * f) / 4, 2);
            break
        }
    }
    return e
}, Elastic: function (b, a) {
    return Math.pow(2, 10 * --b) * Math.cos(20 * b * Math.PI * (a && a[0] || 1) / 3)
}});
["Quad", "Cubic", "Quart", "Quint"].each(function (b, a) {
    Fx.Transitions[b] = new Fx.Transition(function (c) {
        return Math.pow(c, a + 2)
    })
});
(function () {
    var d = function () {
    }, a = ("onprogress" in new Browser.Request);
    var c = this.Request = new Class({Implements: [Chain, Events, Options], options: {url: "", data: "", headers: {"X-Requested-With": "XMLHttpRequest", Accept: "text/javascript, text/html, application/xml, text/xml, */*"}, async: true, format: false, method: "post", link: "ignore", isSuccess: null, emulation: true, urlEncoded: true, encoding: "utf-8", evalScripts: false, evalResponse: false, timeout: 0, noCache: false}, initialize: function (e) {
        this.xhr = new Browser.Request();
        this.setOptions(e);
        this.headers = this.options.headers
    }, onStateChange: function () {
        var e = this.xhr;
        if (e.readyState != 4 || !this.running) {
            return
        }
        this.running = false;
        this.status = 0;
        Function.attempt(function () {
            var f = e.status;
            this.status = (f == 1223) ? 204 : f
        }.bind(this));
        e.onreadystatechange = d;
        if (a) {
            e.onprogress = e.onloadstart = d
        }
        clearTimeout(this.timer);
        this.response = {text: this.xhr.responseText || "", xml: this.xhr.responseXML};
        if (this.options.isSuccess.call(this, this.status)) {
            this.success(this.response.text, this.response.xml)
        } else {
            this.failure()
        }
    }, isSuccess: function () {
        var e = this.status;
        return(e >= 200 && e < 300)
    }, isRunning: function () {
        return !!this.running
    }, processScripts: function (e) {
        if (this.options.evalResponse || (/(ecma|java)script/).test(this.getHeader("Content-type"))) {
            return Browser.exec(e)
        }
        return e.stripScripts(this.options.evalScripts)
    }, success: function (f, e) {
        this.onSuccess(this.processScripts(f), e)
    }, onSuccess: function () {
        this.fireEvent("complete", arguments).fireEvent("success", arguments).callChain()
    }, failure: function () {
        this.onFailure()
    }, onFailure: function () {
        this.fireEvent("complete").fireEvent("failure", this.xhr)
    }, loadstart: function (e) {
        this.fireEvent("loadstart", [e, this.xhr])
    }, progress: function (e) {
        this.fireEvent("progress", [e, this.xhr])
    }, timeout: function () {
        this.fireEvent("timeout", this.xhr)
    }, setHeader: function (e, f) {
        this.headers[e] = f;
        return this
    }, getHeader: function (e) {
        return Function.attempt(function () {
            return this.xhr.getResponseHeader(e)
        }.bind(this))
    }, check: function () {
        if (!this.running) {
            return true
        }
        switch (this.options.link) {
            case"cancel":
                this.cancel();
                return true;
            case"chain":
                this.chain(this.caller.pass(arguments, this));
                return false
        }
        return false
    }, send: function (r) {
        if (!this.check(r)) {
            return this
        }
        this.options.isSuccess = this.options.isSuccess || this.isSuccess;
        this.running = true;
        var n = typeOf(r);
        if (n == "string" || n == "element") {
            r = {data: r}
        }
        var h = this.options;
        r = Object.append({data: h.data, url: h.url, method: h.method}, r);
        var l = r.data, f = String(r.url), e = r.method.toLowerCase();
        switch (typeOf(l)) {
            case"element":
                l = document.id(l).toQueryString();
                break;
            case"object":
            case"hash":
                l = Object.toQueryString(l)
        }
        if (this.options.format) {
            var o = "format=" + this.options.format;
            l = (l) ? o + "&" + l : o
        }
        if (this.options.emulation && !["get", "post"].contains(e)) {
            var m = "_method=" + e;
            l = (l) ? m + "&" + l : m;
            e = "post"
        }
        if (this.options.urlEncoded && ["post", "put"].contains(e)) {
            var g = (this.options.encoding) ? "; charset=" + this.options.encoding : "";
            this.headers["Content-type"] = "application/x-www-form-urlencoded" + g
        }
        if (!f) {
            f = document.location.pathname
        }
        var k = f.lastIndexOf("/");
        if (k > -1 && (k = f.indexOf("#")) > -1) {
            f = f.substr(0, k)
        }
        if (this.options.noCache) {
            f += (f.contains("?") ? "&" : "?") + String.uniqueID()
        }
        if (l && e == "get") {
            f += (f.contains("?") ? "&" : "?") + l;
            l = null
        }
        var q = this.xhr;
        if (a) {
            q.onloadstart = this.loadstart.bind(this);
            q.onprogress = this.progress.bind(this)
        }
        q.open(e.toUpperCase(), f, this.options.async, this.options.user, this.options.password);
        if (this.options.user && "withCredentials" in q) {
            q.withCredentials = true
        }
        q.onreadystatechange = this.onStateChange.bind(this);
        Object.each(this.headers, function (t, s) {
            try {
                q.setRequestHeader(s, t)
            } catch (u) {
                this.fireEvent("exception", [s, t])
            }
        }, this);
        this.fireEvent("request");
        q.send(l);
        if (!this.options.async) {
            this.onStateChange()
        } else {
            if (this.options.timeout) {
                this.timer = this.timeout.delay(this.options.timeout, this)
            }
        }
        return this
    }, cancel: function () {
        if (!this.running) {
            return this
        }
        this.running = false;
        var e = this.xhr;
        e.abort();
        clearTimeout(this.timer);
        e.onreadystatechange = d;
        if (a) {
            e.onprogress = e.onloadstart = d
        }
        this.xhr = new Browser.Request();
        this.fireEvent("cancel");
        return this
    }});
    var b = {};
    ["get", "post", "put", "delete", "GET", "POST", "PUT", "DELETE"].each(function (e) {
        b[e] = function (g) {
            var f = {method: e};
            if (g != null) {
                f.data = g
            }
            return this.send(f)
        }
    });
    c.implement(b);
    Element.Properties.send = {set: function (e) {
        var f = this.get("send").cancel();
        f.setOptions(e);
        return this
    }, get: function () {
        var e = this.retrieve("send");
        if (!e) {
            e = new c({data: this, link: "cancel", method: this.get("method") || "post", url: this.get("action")});
            this.store("send", e)
        }
        return e
    }};
    Element.implement({send: function (e) {
        var f = this.get("send");
        f.send({data: this, url: e || f.options.url});
        return this
    }})
})();
Request.HTML = new Class({Extends: Request, options: {update: false, append: false, evalScripts: true, filter: false, headers: {Accept: "text/html, application/xml, text/xml, */*"}}, success: function (f) {
    var e = this.options, c = this.response;
    c.html = f.stripScripts(function (h) {
        c.javascript = h
    });
    var d = c.html.match(/<body[^>]*>([\s\S]*?)<\/body>/i);
    if (d) {
        c.html = d[1]
    }
    var b = new Element("div").set("html", c.html);
    c.tree = b.childNodes;
    c.elements = b.getElements(e.filter || "*");
    if (e.filter) {
        c.tree = c.elements
    }
    if (e.update) {
        var g = document.id(e.update).empty();
        if (e.filter) {
            g.adopt(c.elements)
        } else {
            g.set("html", c.html)
        }
    } else {
        if (e.append) {
            var a = document.id(e.append);
            if (e.filter) {
                c.elements.reverse().inject(a)
            } else {
                a.adopt(b.getChildren())
            }
        }
    }
    if (e.evalScripts) {
        Browser.exec(c.javascript)
    }
    this.onSuccess(c.tree, c.elements, c.html, c.javascript)
}});
Element.Properties.load = {set: function (a) {
    var b = this.get("load").cancel();
    b.setOptions(a);
    return this
}, get: function () {
    var a = this.retrieve("load");
    if (!a) {
        a = new Request.HTML({data: this, link: "cancel", update: this, method: "get"});
        this.store("load", a)
    }
    return a
}};
Element.implement({load: function () {
    this.get("load").send(Array.link(arguments, {data: Type.isObject, url: Type.isString}));
    return this
}});
if (typeof JSON == "undefined") {
    this.JSON = {}
}
(function () {
    var special = {"\b": "\\b", "\t": "\\t", "\n": "\\n", "\f": "\\f", "\r": "\\r", '"': '\\"', "\\": "\\\\"};
    var escape = function (chr) {
        return special[chr] || "\\u" + ("0000" + chr.charCodeAt(0).toString(16)).slice(-4)
    };
    JSON.validate = function (string) {
        string = string.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, "@").replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, "]").replace(/(?:^|:|,)(?:\s*\[)+/g, "");
        return(/^[\],:{}\s]*$/).test(string)
    };
    JSON.encode = JSON.stringify ? function (obj) {
        return JSON.stringify(obj)
    } : function (obj) {
        if (obj && obj.toJSON) {
            obj = obj.toJSON()
        }
        switch (typeOf(obj)) {
            case"string":
                return'"' + obj.replace(/[\x00-\x1f\\"]/g, escape) + '"';
            case"array":
                return"[" + obj.map(JSON.encode).clean() + "]";
            case"object":
            case"hash":
                var string = [];
                Object.each(obj, function (value, key) {
                    var json = JSON.encode(value);
                    if (json) {
                        string.push(JSON.encode(key) + ":" + json)
                    }
                });
                return"{" + string + "}";
            case"number":
            case"boolean":
                return"" + obj;
            case"null":
                return"null"
        }
        return null
    };
    JSON.decode = function (string, secure) {
        if (!string || typeOf(string) != "string") {
            return null
        }
        if (secure || JSON.secure) {
            if (JSON.parse) {
                return JSON.parse(string)
            }
            if (!JSON.validate(string)) {
                throw new Error("JSON could not decode the input; security is enabled and the value is not secure.")
            }
        }
        return eval("(" + string + ")")
    }
})();
Request.JSON = new Class({Extends: Request, options: {secure: true}, initialize: function (a) {
    this.parent(a);
    Object.append(this.headers, {Accept: "application/json", "X-Request": "JSON"})
}, success: function (c) {
    var b;
    try {
        b = this.response.json = JSON.decode(c, this.options.secure)
    } catch (a) {
        this.fireEvent("error", [c, a]);
        return
    }
    if (b == null) {
        this.onFailure()
    } else {
        this.onSuccess(b, c)
    }
}});
var Cookie = new Class({Implements: Options, options: {path: "/", domain: false, duration: false, secure: false, document: document, encode: true}, initialize: function (b, a) {
    this.key = b;
    this.setOptions(a)
}, write: function (b) {
    if (this.options.encode) {
        b = encodeURIComponent(b)
    }
    if (this.options.domain) {
        b += "; domain=" + this.options.domain
    }
    if (this.options.path) {
        b += "; path=" + this.options.path
    }
    if (this.options.duration) {
        var a = new Date();
        a.setTime(a.getTime() + this.options.duration * 24 * 60 * 60 * 1000);
        b += "; expires=" + a.toGMTString()
    }
    if (this.options.secure) {
        b += "; secure"
    }
    this.options.document.cookie = this.key + "=" + b;
    return this
}, read: function () {
    var a = this.options.document.cookie.match("(?:^|;)\\s*" + this.key.escapeRegExp() + "=([^;]*)");
    return(a) ? decodeURIComponent(a[1]) : null
}, dispose: function () {
    new Cookie(this.key, Object.merge({}, this.options, {duration: -1})).write("");
    return this
}});
Cookie.write = function (b, c, a) {
    return new Cookie(b, a).write(c)
};
Cookie.read = function (a) {
    return new Cookie(a).read()
};
Cookie.dispose = function (b, a) {
    return new Cookie(b, a).dispose()
};
(function (k, m) {
    var n, f, e = [], c, b, d = m.createElement("div");
    var g = function () {
        clearTimeout(b);
        if (n) {
            return
        }
        Browser.loaded = n = true;
        m.removeListener("DOMContentLoaded", g).removeListener("readystatechange", a);
        m.fireEvent("domready");
        k.fireEvent("domready")
    };
    var a = function () {
        for (var o = e.length; o--;) {
            if (e[o]()) {
                g();
                return true
            }
        }
        return false
    };
    var l = function () {
        clearTimeout(b);
        if (!a()) {
            b = setTimeout(l, 10)
        }
    };
    m.addListener("DOMContentLoaded", g);
    var h = function () {
        try {
            d.doScroll();
            return true
        } catch (o) {
        }
        return false
    };
    if (d.doScroll && !h()) {
        e.push(h);
        c = true
    }
    if (m.readyState) {
        e.push(function () {
            var o = m.readyState;
            return(o == "loaded" || o == "complete")
        })
    }
    if ("onreadystatechange" in m) {
        m.addListener("readystatechange", a)
    } else {
        c = true
    }
    if (c) {
        l()
    }
    Element.Events.domready = {onAdd: function (o) {
        if (n) {
            o.call(this)
        }
    }};
    Element.Events.load = {base: "load", onAdd: function (o) {
        if (f && this == k) {
            o.call(this)
        }
    }, condition: function () {
        if (this == k) {
            g();
            delete Element.Events.load
        }
        return true
    }};
    k.addEvent("load", function () {
        f = true
    })
})(window, document);
MooTools.More = {version: "1.4.0.1", build: "a4244edf2aa97ac8a196fc96082dd35af1abab87"};
Class.Mutators.Binds = function (a) {
    if (!this.prototype.initialize) {
        this.implement("initialize", function () {
        })
    }
    return Array.from(a).concat(this.prototype.Binds || [])
};
Class.Mutators.initialize = function (a) {
    return function () {
        Array.from(this.Binds).each(function (b) {
            var c = this[b];
            if (c) {
                this[b] = c.bind(this)
            }
        }, this);
        return a.apply(this, arguments)
    }
};
(function (a) {
    Array.implement({min: function () {
        return Math.min.apply(null, this)
    }, max: function () {
        return Math.max.apply(null, this)
    }, average: function () {
        return this.length ? this.sum() / this.length : 0
    }, sum: function () {
        var b = 0, c = this.length;
        if (c) {
            while (c--) {
                b += this[c]
            }
        }
        return b
    }, unique: function () {
        return[].combine(this)
    }, shuffle: function () {
        for (var c = this.length; c && --c;) {
            var b = this[c], d = Math.floor(Math.random() * (c + 1));
            this[c] = this[d];
            this[d] = b
        }
        return this
    }, reduce: function (d, e) {
        for (var c = 0, b = this.length; c < b; c++) {
            if (c in this) {
                e = e === a ? this[c] : d.call(null, e, this[c], c, this)
            }
        }
        return e
    }, reduceRight: function (c, d) {
        var b = this.length;
        while (b--) {
            if (b in this) {
                d = d === a ? this[b] : c.call(null, d, this[b], b, this)
            }
        }
        return d
    }})
})();
(function () {
    var b = function (c) {
        return c != null
    };
    var a = Object.prototype.hasOwnProperty;
    Object.extend({getFromPath: function (e, f) {
        if (typeof f == "string") {
            f = f.split(".")
        }
        for (var d = 0, c = f.length; d < c; d++) {
            if (a.call(e, f[d])) {
                e = e[f[d]]
            } else {
                return null
            }
        }
        return e
    }, cleanValues: function (c, e) {
        e = e || b;
        for (var d in c) {
            if (!e(c[d])) {
                delete c[d]
            }
        }
        return c
    }, erase: function (c, d) {
        if (a.call(c, d)) {
            delete c[d]
        }
        return c
    }, run: function (d) {
        var c = Array.slice(arguments, 1);
        for (var e in d) {
            if (d[e].apply) {
                d[e].apply(d, c)
            }
        }
        return d
    }})
})();
(function () {
    var c = {a: /[àáâãäåăą]/g, A: /[ÀÁÂÃÄÅĂĄ]/g, c: /[ćčç]/g, C: /[ĆČÇ]/g, d: /[ďđ]/g, D: /[ĎÐ]/g, e: /[èéêëěę]/g, E: /[ÈÉÊËĚĘ]/g, g: /[ğ]/g, G: /[Ğ]/g, i: /[ìíîï]/g, I: /[ÌÍÎÏ]/g, l: /[ĺľł]/g, L: /[ĹĽŁ]/g, n: /[ñňń]/g, N: /[ÑŇŃ]/g, o: /[òóôõöøő]/g, O: /[ÒÓÔÕÖØ]/g, r: /[řŕ]/g, R: /[ŘŔ]/g, s: /[ššş]/g, S: /[ŠŞŚ]/g, t: /[ťţ]/g, T: /[ŤŢ]/g, ue: /[ü]/g, UE: /[Ü]/g, u: /[ùúûůµ]/g, U: /[ÙÚÛŮ]/g, y: /[ÿý]/g, Y: /[ŸÝ]/g, z: /[žźż]/g, Z: /[ŽŹŻ]/g, th: /[þ]/g, TH: /[Þ]/g, dh: /[ð]/g, DH: /[Ð]/g, ss: /[ß]/g, oe: /[œ]/g, OE: /[Œ]/g, ae: /[æ]/g, AE: /[Æ]/g}, b = {" ": /[\xa0\u2002\u2003\u2009]/g, "*": /[\xb7]/g, "'": /[\u2018\u2019]/g, '"': /[\u201c\u201d]/g, "...": /[\u2026]/g, "-": /[\u2013]/g, "&raquo;": /[\uFFFD]/g};
    var a = function (f, h) {
        var e = f, g;
        for (g in h) {
            e = e.replace(h[g], g)
        }
        return e
    };
    var d = function (e, g) {
        e = e || "";
        var h = g ? "<" + e + "(?!\\w)[^>]*>([\\s\\S]*?)</" + e + "(?!\\w)>" : "</?" + e + "([^>]+)?>", f = new RegExp(h, "gi");
        return f
    };
    String.implement({standardize: function () {
        return a(this, c)
    }, repeat: function (e) {
        return new Array(e + 1).join(this)
    }, pad: function (e, h, g) {
        if (this.length >= e) {
            return this
        }
        var f = (h == null ? " " : "" + h).repeat(e - this.length).substr(0, e - this.length);
        if (!g || g == "right") {
            return this + f
        }
        if (g == "left") {
            return f + this
        }
        return f.substr(0, (f.length / 2).floor()) + this + f.substr(0, (f.length / 2).ceil())
    }, getTags: function (e, f) {
        return this.match(d(e, f)) || []
    }, stripTags: function (e, f) {
        return this.replace(d(e, f), "")
    }, tidy: function () {
        return a(this, b)
    }, truncate: function (e, f, k) {
        var h = this;
        if (f == null && arguments.length == 1) {
            f = "…"
        }
        if (h.length > e) {
            h = h.substring(0, e);
            if (k) {
                var g = h.lastIndexOf(k);
                if (g != -1) {
                    h = h.substr(0, g)
                }
            }
            if (f) {
                h += f
            }
        }
        return h
    }})
})();
String.implement({parseQueryString: function (d, a) {
    if (d == null) {
        d = true
    }
    if (a == null) {
        a = true
    }
    var c = this.split(/[&;]/), b = {};
    if (!c.length) {
        return b
    }
    c.each(function (k) {
        var e = k.indexOf("=") + 1, g = e ? k.substr(e) : "", f = e ? k.substr(0, e - 1).match(/([^\]\[]+|(\B)(?=\]))/g) : [k], h = b;
        if (!f) {
            return
        }
        if (a) {
            g = decodeURIComponent(g)
        }
        f.each(function (m, l) {
            if (d) {
                m = decodeURIComponent(m)
            }
            var n = h[m];
            if (l < f.length - 1) {
                h = h[m] = n || {}
            } else {
                if (typeOf(n) == "array") {
                    n.push(g)
                } else {
                    h[m] = n != null ? [n, g] : g
                }
            }
        })
    });
    return b
}, cleanQueryString: function (a) {
    return this.split("&").filter(function (e) {
        var b = e.indexOf("="), c = b < 0 ? "" : e.substr(0, b), d = e.substr(b + 1);
        return a ? a.call(null, c, d) : (d || d === 0)
    }).join("&")
}});
(function () {
    var b = function () {
        return this.get("value")
    };
    var a = this.URI = new Class({Implements: Options, options: {}, regex: /^(?:(\w+):)?(?:\/\/(?:(?:([^:@\/]*):?([^:@\/]*))?@)?([^:\/?#]*)(?::(\d*))?)?(\.\.?$|(?:[^?#\/]*\/)*)([^?#]*)(?:\?([^#]*))?(?:#(.*))?/, parts: ["scheme", "user", "password", "host", "port", "directory", "file", "query", "fragment"], schemes: {http: 80, https: 443, ftp: 21, rtsp: 554, mms: 1755, file: 0}, initialize: function (d, c) {
        this.setOptions(c);
        var e = this.options.base || a.base;
        if (!d) {
            d = e
        }
        if (d && d.parsed) {
            this.parsed = Object.clone(d.parsed)
        } else {
            this.set("value", d.href || d.toString(), e ? new a(e) : false)
        }
    }, parse: function (e, d) {
        var c = e.match(this.regex);
        if (!c) {
            return false
        }
        c.shift();
        return this.merge(c.associate(this.parts), d)
    }, merge: function (d, c) {
        if ((!d || !d.scheme) && (!c || !c.scheme)) {
            return false
        }
        if (c) {
            this.parts.every(function (e) {
                if (d[e]) {
                    return false
                }
                d[e] = c[e] || "";
                return true
            })
        }
        d.port = d.port || this.schemes[d.scheme.toLowerCase()];
        d.directory = d.directory ? this.parseDirectory(d.directory, c ? c.directory : "") : "/";
        return d
    }, parseDirectory: function (d, e) {
        d = (d.substr(0, 1) == "/" ? "" : (e || "/")) + d;
        if (!d.test(a.regs.directoryDot)) {
            return d
        }
        var c = [];
        d.replace(a.regs.endSlash, "").split("/").each(function (f) {
            if (f == ".." && c.length > 0) {
                c.pop()
            } else {
                if (f != ".") {
                    c.push(f)
                }
            }
        });
        return c.join("/") + "/"
    }, combine: function (c) {
        return c.value || c.scheme + "://" + (c.user ? c.user + (c.password ? ":" + c.password : "") + "@" : "") + (c.host || "") + (c.port && c.port != this.schemes[c.scheme] ? ":" + c.port : "") + (c.directory || "/") + (c.file || "") + (c.query ? "?" + c.query : "") + (c.fragment ? "#" + c.fragment : "")
    }, set: function (d, f, e) {
        if (d == "value") {
            var c = f.match(a.regs.scheme);
            if (c) {
                c = c[1]
            }
            if (c && this.schemes[c.toLowerCase()] == null) {
                this.parsed = {scheme: c, value: f}
            } else {
                this.parsed = this.parse(f, (e || this).parsed) || (c ? {scheme: c, value: f} : {value: f})
            }
        } else {
            if (d == "data") {
                this.setData(f)
            } else {
                this.parsed[d] = f
            }
        }
        return this
    }, get: function (c, d) {
        switch (c) {
            case"value":
                return this.combine(this.parsed, d ? d.parsed : false);
            case"data":
                return this.getData()
        }
        return this.parsed[c] || ""
    }, go: function () {
        document.location.href = this.toString()
    }, toURI: function () {
        return this
    }, getData: function (e, d) {
        var c = this.get(d || "query");
        if (!(c || c === 0)) {
            return e ? null : {}
        }
        var f = c.parseQueryString();
        return e ? f[e] : f
    }, setData: function (c, f, d) {
        if (typeof c == "string") {
            var e = this.getData();
            e[arguments[0]] = arguments[1];
            c = e
        } else {
            if (f) {
                c = Object.merge(this.getData(), c)
            }
        }
        return this.set(d || "query", Object.toQueryString(c))
    }, clearData: function (c) {
        return this.set(c || "query", "")
    }, toString: b, valueOf: b});
    a.regs = {endSlash: /\/$/, scheme: /^(\w+):/, directoryDot: /\.\/|\.$/};
    a.base = new a(Array.from(document.getElements("base[href]", true)).getLast(), {base: document.location});
    String.implement({toURI: function (c) {
        return new a(this, c)
    }})
})();
(function () {
    if (this.Hash) {
        return
    }
    var a = this.Hash = new Type("Hash", function (b) {
        if (typeOf(b) == "hash") {
            b = Object.clone(b.getClean())
        }
        for (var c in b) {
            this[c] = b[c]
        }
        return this
    });
    this.$H = function (b) {
        return new a(b)
    };
    a.implement({forEach: function (b, c) {
        Object.forEach(this, b, c)
    }, getClean: function () {
        var c = {};
        for (var b in this) {
            if (this.hasOwnProperty(b)) {
                c[b] = this[b]
            }
        }
        return c
    }, getLength: function () {
        var c = 0;
        for (var b in this) {
            if (this.hasOwnProperty(b)) {
                c++
            }
        }
        return c
    }});
    a.alias("each", "forEach");
    a.implement({has: Object.prototype.hasOwnProperty, keyOf: function (b) {
        return Object.keyOf(this, b)
    }, hasValue: function (b) {
        return Object.contains(this, b)
    }, extend: function (b) {
        a.each(b || {}, function (d, c) {
            a.set(this, c, d)
        }, this);
        return this
    }, combine: function (b) {
        a.each(b || {}, function (d, c) {
            a.include(this, c, d)
        }, this);
        return this
    }, erase: function (b) {
        if (this.hasOwnProperty(b)) {
            delete this[b]
        }
        return this
    }, get: function (b) {
        return(this.hasOwnProperty(b)) ? this[b] : null
    }, set: function (b, c) {
        if (!this[b] || this.hasOwnProperty(b)) {
            this[b] = c
        }
        return this
    }, empty: function () {
        a.each(this, function (c, b) {
            delete this[b]
        }, this);
        return this
    }, include: function (b, c) {
        if (this[b] == undefined) {
            this[b] = c
        }
        return this
    }, map: function (b, c) {
        return new a(Object.map(this, b, c))
    }, filter: function (b, c) {
        return new a(Object.filter(this, b, c))
    }, every: function (b, c) {
        return Object.every(this, b, c)
    }, some: function (b, c) {
        return Object.some(this, b, c)
    }, getKeys: function () {
        return Object.keys(this)
    }, getValues: function () {
        return Object.values(this)
    }, toQueryString: function (b) {
        return Object.toQueryString(this, b)
    }});
    a.alias({indexOf: "keyOf", contains: "hasValue"})
})();
Hash.implement({getFromPath: function (a) {
    return Object.getFromPath(this, a)
}, cleanValues: function (a) {
    return new Hash(Object.cleanValues(this, a))
}, run: function () {
    Object.run(arguments)
}});
Element.implement({tidy: function () {
    this.set("value", this.get("value").tidy())
}, getTextInRange: function (b, a) {
    return this.get("value").substring(b, a)
}, getSelectedText: function () {
    if (this.setSelectionRange) {
        return this.getTextInRange(this.getSelectionStart(), this.getSelectionEnd())
    }
    return document.selection.createRange().text
}, getSelectedRange: function () {
    if (this.selectionStart != null) {
        return{start: this.selectionStart, end: this.selectionEnd}
    }
    var e = {start: 0, end: 0};
    var a = this.getDocument().selection.createRange();
    if (!a || a.parentElement() != this) {
        return e
    }
    var c = a.duplicate();
    if (this.type == "text") {
        e.start = 0 - c.moveStart("character", -100000);
        e.end = e.start + a.text.length
    } else {
        var b = this.get("value");
        var d = b.length;
        c.moveToElementText(this);
        c.setEndPoint("StartToEnd", a);
        if (c.text.length) {
            d -= b.match(/[\n\r]*$/)[0].length
        }
        e.end = d - c.text.length;
        c.setEndPoint("StartToStart", a);
        e.start = d - c.text.length
    }
    return e
}, getSelectionStart: function () {
    return this.getSelectedRange().start
}, getSelectionEnd: function () {
    return this.getSelectedRange().end
}, setCaretPosition: function (a) {
    if (a == "end") {
        a = this.get("value").length
    }
    this.selectRange(a, a);
    return this
}, getCaretPosition: function () {
    return this.getSelectedRange().start
}, selectRange: function (e, a) {
    if (this.setSelectionRange) {
        this.focus();
        this.setSelectionRange(e, a)
    } else {
        var c = this.get("value");
        var d = c.substr(e, a - e).replace(/\r/g, "").length;
        e = c.substr(0, e).replace(/\r/g, "").length;
        var b = this.createTextRange();
        b.collapse(true);
        b.moveEnd("character", e + d);
        b.moveStart("character", e);
        b.select()
    }
    return this
}, insertAtCursor: function (b, a) {
    var d = this.getSelectedRange();
    var c = this.get("value");
    this.set("value", c.substring(0, d.start) + b + c.substring(d.end, c.length));
    if (a !== false) {
        this.selectRange(d.start, d.start + b.length)
    } else {
        this.setCaretPosition(d.start + b.length)
    }
    return this
}, insertAroundCursor: function (b, a) {
    b = Object.append({before: "", defaultMiddle: "", after: ""}, b);
    var c = this.getSelectedText() || b.defaultMiddle;
    var g = this.getSelectedRange();
    var f = this.get("value");
    if (g.start == g.end) {
        this.set("value", f.substring(0, g.start) + b.before + c + b.after + f.substring(g.end, f.length));
        this.selectRange(g.start + b.before.length, g.end + b.before.length + c.length)
    } else {
        var d = f.substring(g.start, g.end);
        this.set("value", f.substring(0, g.start) + b.before + d + b.after + f.substring(g.end, f.length));
        var e = g.start + b.before.length;
        if (a !== false) {
            this.selectRange(e, e + d.length)
        } else {
            this.setCaretPosition(e + f.length)
        }
    }
    return this
}});
Elements.from = function (e, d) {
    if (d || d == null) {
        e = e.stripScripts()
    }
    var b, c = e.match(/^\s*<(t[dhr]|tbody|tfoot|thead)/i);
    if (c) {
        b = new Element("table");
        var a = c[1].toLowerCase();
        if (["td", "th", "tr"].contains(a)) {
            b = new Element("tbody").inject(b);
            if (a != "tr") {
                b = new Element("tr").inject(b)
            }
        }
    }
    return(b || new Element("div")).set("html", e).getChildren()
};
(function () {
    var b = function (e, d) {
        var f = [];
        Object.each(d, function (g) {
            Object.each(g, function (h) {
                e.each(function (k) {
                    f.push(k + "-" + h + (k == "border" ? "-width" : ""))
                })
            })
        });
        return f
    };
    var c = function (f, e) {
        var d = 0;
        Object.each(e, function (h, g) {
            if (g.test(f)) {
                d = d + h.toInt()
            }
        });
        return d
    };
    var a = function (d) {
        return !!(!d || d.offsetHeight || d.offsetWidth)
    };
    Element.implement({measure: function (h) {
        if (a(this)) {
            return h.call(this)
        }
        var g = this.getParent(), e = [];
        while (!a(g) && g != document.body) {
            e.push(g.expose());
            g = g.getParent()
        }
        var f = this.expose(), d = h.call(this);
        f();
        e.each(function (k) {
            k()
        });
        return d
    }, expose: function () {
        if (this.getStyle("display") != "none") {
            return function () {
            }
        }
        var d = this.style.cssText;
        this.setStyles({display: "block", position: "absolute", visibility: "hidden"});
        return function () {
            this.style.cssText = d
        }.bind(this)
    }, getDimensions: function (d) {
        d = Object.merge({computeSize: false}, d);
        var k = {x: 0, y: 0};
        var h = function (l, e) {
            return(e.computeSize) ? l.getComputedSize(e) : l.getSize()
        };
        var f = this.getParent("body");
        if (f && this.getStyle("display") == "none") {
            k = this.measure(function () {
                return h(this, d)
            })
        } else {
            if (f) {
                try {
                    k = h(this, d)
                } catch (g) {
                }
            }
        }
        return Object.append(k, (k.x || k.x === 0) ? {width: k.x, height: k.y} : {x: k.width, y: k.height})
    }, getComputedSize: function (d) {
        d = Object.merge({styles: ["padding", "border"], planes: {height: ["top", "bottom"], width: ["left", "right"]}, mode: "both"}, d);
        var g = {}, e = {width: 0, height: 0}, f;
        if (d.mode == "vertical") {
            delete e.width;
            delete d.planes.width
        } else {
            if (d.mode == "horizontal") {
                delete e.height;
                delete d.planes.height
            }
        }
        b(d.styles, d.planes).each(function (h) {
            g[h] = this.getStyle(h).toInt()
        }, this);
        Object.each(d.planes, function (k, h) {
            var m = h.capitalize(), l = this.getStyle(h);
            if (l == "auto" && !f) {
                f = this.getDimensions()
            }
            l = g[h] = (l == "auto") ? f[h] : l.toInt();
            e["total" + m] = l;
            k.each(function (o) {
                var n = c(o, g);
                e["computed" + o.capitalize()] = n;
                e["total" + m] += n
            })
        }, this);
        return Object.append(e, g)
    }})
})();
(function (b) {
    var a = Element.Position = {options: {relativeTo: document.body, position: {x: "center", y: "center"}, offset: {x: 0, y: 0}}, getOptions: function (d, c) {
        c = Object.merge({}, a.options, c);
        a.setPositionOption(c);
        a.setEdgeOption(c);
        a.setOffsetOption(d, c);
        a.setDimensionsOption(d, c);
        return c
    }, setPositionOption: function (c) {
        c.position = a.getCoordinateFromValue(c.position)
    }, setEdgeOption: function (d) {
        var c = a.getCoordinateFromValue(d.edge);
        d.edge = c ? c : (d.position.x == "center" && d.position.y == "center") ? {x: "center", y: "center"} : {x: "left", y: "top"}
    }, setOffsetOption: function (f, d) {
        var c = {x: 0, y: 0}, g = f.measure(function () {
            return document.id(this.getOffsetParent())
        }), e = g.getScroll();
        if (!g || g == f.getDocument().body) {
            return
        }
        c = g.measure(function () {
            var k = this.getPosition();
            if (this.getStyle("position") == "fixed") {
                var h = window.getScroll();
                k.x += h.x;
                k.y += h.y
            }
            return k
        });
        d.offset = {parentPositioned: g != document.id(d.relativeTo), x: d.offset.x - c.x + e.x, y: d.offset.y - c.y + e.y}
    }, setDimensionsOption: function (d, c) {
        c.dimensions = d.getDimensions({computeSize: true, styles: ["padding", "border", "margin"]})
    }, getPosition: function (e, d) {
        var c = {};
        d = a.getOptions(e, d);
        var f = document.id(d.relativeTo) || document.body;
        a.setPositionCoordinates(d, c, f);
        if (d.edge) {
            a.toEdge(c, d)
        }
        var g = d.offset;
        c.left = ((c.x >= 0 || g.parentPositioned || d.allowNegative) ? c.x : 0).toInt();
        c.top = ((c.y >= 0 || g.parentPositioned || d.allowNegative) ? c.y : 0).toInt();
        a.toMinMax(c, d);
        if (d.relFixedPosition || f.getStyle("position") == "fixed") {
            a.toRelFixedPosition(f, c)
        }
        if (d.ignoreScroll) {
            a.toIgnoreScroll(f, c)
        }
        if (d.ignoreMargins) {
            a.toIgnoreMargins(c, d)
        }
        c.left = Math.ceil(c.left);
        c.top = Math.ceil(c.top);
        delete c.x;
        delete c.y;
        return c
    }, setPositionCoordinates: function (m, g, d) {
        var f = m.offset.y, h = m.offset.x, e = (d == document.body) ? window.getScroll() : d.getPosition(), l = e.y, c = e.x, k = window.getSize();
        switch (m.position.x) {
            case"left":
                g.x = c + h;
                break;
            case"right":
                g.x = c + h + d.offsetWidth;
                break;
            default:
                g.x = c + ((d == document.body ? k.x : d.offsetWidth) / 2) + h;
                break
        }
        switch (m.position.y) {
            case"top":
                g.y = l + f;
                break;
            case"bottom":
                g.y = l + f + d.offsetHeight;
                break;
            default:
                g.y = l + ((d == document.body ? k.y : d.offsetHeight) / 2) + f;
                break
        }
    }, toMinMax: function (c, d) {
        var f = {left: "x", top: "y"}, e;
        ["minimum", "maximum"].each(function (g) {
            ["left", "top"].each(function (h) {
                e = d[g] ? d[g][f[h]] : null;
                if (e != null && ((g == "minimum") ? c[h] < e : c[h] > e)) {
                    c[h] = e
                }
            })
        })
    }, toRelFixedPosition: function (e, c) {
        var d = window.getScroll();
        c.top += d.y;
        c.left += d.x
    }, toIgnoreScroll: function (e, d) {
        var c = e.getScroll();
        d.top -= c.y;
        d.left -= c.x
    }, toIgnoreMargins: function (c, d) {
        c.left += d.edge.x == "right" ? d.dimensions["margin-right"] : (d.edge.x != "center" ? -d.dimensions["margin-left"] : -d.dimensions["margin-left"] + ((d.dimensions["margin-right"] + d.dimensions["margin-left"]) / 2));
        c.top += d.edge.y == "bottom" ? d.dimensions["margin-bottom"] : (d.edge.y != "center" ? -d.dimensions["margin-top"] : -d.dimensions["margin-top"] + ((d.dimensions["margin-bottom"] + d.dimensions["margin-top"]) / 2))
    }, toEdge: function (c, d) {
        var e = {}, g = d.dimensions, f = d.edge;
        switch (f.x) {
            case"left":
                e.x = 0;
                break;
            case"right":
                e.x = -g.x - g.computedRight - g.computedLeft;
                break;
            default:
                e.x = -(Math.round(g.totalWidth / 2));
                break
        }
        switch (f.y) {
            case"top":
                e.y = 0;
                break;
            case"bottom":
                e.y = -g.y - g.computedTop - g.computedBottom;
                break;
            default:
                e.y = -(Math.round(g.totalHeight / 2));
                break
        }
        c.x += e.x;
        c.y += e.y
    }, getCoordinateFromValue: function (c) {
        if (typeOf(c) != "string") {
            return c
        }
        c = c.toLowerCase();
        return{x: c.test("left") ? "left" : (c.test("right") ? "right" : "center"), y: c.test(/upper|top/) ? "top" : (c.test("bottom") ? "bottom" : "center")}
    }};
    Element.implement({position: function (d) {
        if (d && (d.x != null || d.y != null)) {
            return(b ? b.apply(this, arguments) : this)
        }
        var c = this.setStyle("position", "absolute").calculatePosition(d);
        return(d && d.returnPos) ? c : this.setStyles(c)
    }, calculatePosition: function (c) {
        return a.getPosition(this, c)
    }})
})(Element.prototype.position);
Element.implement({isDisplayed: function () {
    return this.getStyle("display") != "none"
}, isVisible: function () {
    var a = this.offsetWidth, b = this.offsetHeight;
    return(a == 0 && b == 0) ? false : (a > 0 && b > 0) ? true : this.style.display != "none"
}, toggle: function () {
    return this[this.isDisplayed() ? "hide" : "show"]()
}, hide: function () {
    var b;
    try {
        b = this.getStyle("display")
    } catch (a) {
    }
    if (b == "none") {
        return this
    }
    return this.store("element:_originalDisplay", b || "").setStyle("display", "none")
}, show: function (a) {
    if (!a && this.isDisplayed()) {
        return this
    }
    a = a || this.retrieve("element:_originalDisplay") || "block";
    return this.setStyle("display", (a == "none") ? "block" : a)
}, swapClass: function (a, b) {
    return this.removeClass(a).addClass(b)
}});
Document.implement({clearSelection: function () {
    if (window.getSelection) {
        var a = window.getSelection();
        if (a && a.removeAllRanges) {
            a.removeAllRanges()
        }
    } else {
        if (document.selection && document.selection.empty) {
            try {
                document.selection.empty()
            } catch (b) {
            }
        }
    }
}});
Fx.Elements = new Class({Extends: Fx.CSS, initialize: function (b, a) {
    this.elements = this.subject = $$(b);
    this.parent(a)
}, compute: function (g, h, k) {
    var c = {};
    for (var d in g) {
        var a = g[d], e = h[d], f = c[d] = {};
        for (var b in a) {
            f[b] = this.parent(a[b], e[b], k)
        }
    }
    return c
}, set: function (b) {
    for (var c in b) {
        if (!this.elements[c]) {
            continue
        }
        var a = b[c];
        for (var d in a) {
            this.render(this.elements[c], d, a[d], this.options.unit)
        }
    }
    return this
}, start: function (c) {
    if (!this.check(c)) {
        return this
    }
    var h = {}, k = {};
    for (var d in c) {
        if (!this.elements[d]) {
            continue
        }
        var f = c[d], a = h[d] = {}, g = k[d] = {};
        for (var b in f) {
            var e = this.prepare(this.elements[d], b, f[b]);
            a[b] = e.from;
            g[b] = e.to
        }
    }
    return this.parent(h, k)
}});
Fx.Accordion = new Class({Extends: Fx.Elements, options: {fixedHeight: false, fixedWidth: false, display: 0, show: false, height: true, width: false, opacity: true, alwaysHide: false, trigger: "click", initialDisplayFx: true, resetHeight: true}, initialize: function () {
    var g = function (h) {
        return h != null
    };
    var f = Array.link(arguments, {container: Type.isElement, options: Type.isObject, togglers: g, elements: g});
    this.parent(f.elements, f.options);
    var b = this.options, e = this.togglers = $$(f.togglers);
    this.previous = -1;
    this.internalChain = new Chain();
    if (b.alwaysHide) {
        this.options.link = "chain"
    }
    if (b.show || this.options.show === 0) {
        b.display = false;
        this.previous = b.show
    }
    if (b.start) {
        b.display = false;
        b.show = false
    }
    var d = this.effects = {};
    if (b.opacity) {
        d.opacity = "fullOpacity"
    }
    if (b.width) {
        d.width = b.fixedWidth ? "fullWidth" : "offsetWidth"
    }
    if (b.height) {
        d.height = b.fixedHeight ? "fullHeight" : "scrollHeight"
    }
    for (var c = 0, a = e.length; c < a; c++) {
        this.addSection(e[c], this.elements[c])
    }
    this.elements.each(function (k, h) {
        if (b.show === h) {
            this.fireEvent("active", [e[h], k])
        } else {
            for (var l in d) {
                k.setStyle(l, 0)
            }
        }
    }, this);
    if (b.display || b.display === 0 || b.initialDisplayFx === false) {
        this.display(b.display, b.initialDisplayFx)
    }
    if (b.fixedHeight !== false) {
        b.resetHeight = false
    }
    this.addEvent("complete", this.internalChain.callChain.bind(this.internalChain))
}, addSection: function (g, d) {
    g = document.id(g);
    d = document.id(d);
    this.togglers.include(g);
    this.elements.include(d);
    var f = this.togglers, c = this.options, h = f.contains(g), a = f.indexOf(g), b = this.display.pass(a, this);
    g.store("accordion:display", b).addEvent(c.trigger, b);
    if (c.height) {
        d.setStyles({"padding-top": 0, "border-top": "none", "padding-bottom": 0, "border-bottom": "none"})
    }
    if (c.width) {
        d.setStyles({"padding-left": 0, "border-left": "none", "padding-right": 0, "border-right": "none"})
    }
    d.fullOpacity = 1;
    if (c.fixedWidth) {
        d.fullWidth = c.fixedWidth
    }
    if (c.fixedHeight) {
        d.fullHeight = c.fixedHeight
    }
    d.setStyle("overflow", "hidden");
    if (!h) {
        for (var e in this.effects) {
            d.setStyle(e, 0)
        }
    }
    return this
}, removeSection: function (f, b) {
    var e = this.togglers, a = e.indexOf(f), c = this.elements[a];
    var d = function () {
        e.erase(f);
        this.elements.erase(c);
        this.detach(f)
    }.bind(this);
    if (this.now == a || b != null) {
        this.display(b != null ? b : (a - 1 >= 0 ? a - 1 : 0)).chain(d)
    } else {
        d()
    }
    return this
}, detach: function (b) {
    var a = function (c) {
        c.removeEvent(this.options.trigger, c.retrieve("accordion:display"))
    }.bind(this);
    if (!b) {
        this.togglers.each(a)
    } else {
        a(b)
    }
    return this
}, display: function (b, c) {
    if (!this.check(b, c)) {
        return this
    }
    var h = {}, g = this.elements, a = this.options, f = this.effects;
    if (c == null) {
        c = true
    }
    if (typeOf(b) == "element") {
        b = g.indexOf(b)
    }
    if (b == this.previous && !a.alwaysHide) {
        return this
    }
    if (a.resetHeight) {
        var e = g[this.previous];
        if (e && !this.selfHidden) {
            for (var d in f) {
                e.setStyle(d, e[f[d]])
            }
        }
    }
    if ((this.timer && a.link == "chain") || (b === this.previous && !a.alwaysHide)) {
        return this
    }
    this.previous = b;
    this.selfHidden = false;
    g.each(function (m, l) {
        h[l] = {};
        var k;
        if (l != b) {
            k = true
        } else {
            if (a.alwaysHide && ((m.offsetHeight > 0 && a.height) || m.offsetWidth > 0 && a.width)) {
                k = true;
                this.selfHidden = true
            }
        }
        this.fireEvent(k ? "background" : "active", [this.togglers[l], m]);
        for (var n in f) {
            h[l][n] = k ? 0 : m[f[n]]
        }
        if (!c && !k && a.resetHeight) {
            h[l].height = "auto"
        }
    }, this);
    this.internalChain.clearChain();
    this.internalChain.chain(function () {
        if (a.resetHeight && !this.selfHidden) {
            var k = g[b];
            if (k) {
                k.setStyle("height", "auto")
            }
        }
    }.bind(this));
    return c ? this.start(h) : this.set(h).internalChain.callChain()
}});
Fx.Move = new Class({Extends: Fx.Morph, options: {relativeTo: document.body, position: "center", edge: false, offset: {x: 0, y: 0}}, start: function (a) {
    var b = this.element, c = b.getStyles("top", "left");
    if (c.top == "auto" || c.left == "auto") {
        b.setPosition(b.getPosition(b.getOffsetParent()))
    }
    return this.parent(b.position(Object.merge({}, this.options, a, {returnPos: true})))
}});
Element.Properties.move = {set: function (a) {
    this.get("move").cancel().setOptions(a);
    return this
}, get: function () {
    var a = this.retrieve("move");
    if (!a) {
        a = new Fx.Move(this, {link: "cancel"});
        this.store("move", a)
    }
    return a
}};
Element.implement({move: function (a) {
    this.get("move").start(a);
    return this
}});
(function () {
    var a = function (d) {
        var b = d.options.hideInputs;
        if (window.OverText) {
            var c = [null];
            OverText.each(function (e) {
                c.include("." + e.options.labelClass)
            });
            if (c) {
                b += c.join(", ")
            }
        }
        return(b) ? d.element.getElements(b) : null
    };
    Fx.Reveal = new Class({Extends: Fx.Morph, options: {link: "cancel", styles: ["padding", "border", "margin"], transitionOpacity: !Browser.ie6, mode: "vertical", display: function () {
        return this.element.get("tag") != "tr" ? "block" : "table-row"
    }, opacity: 1, hideInputs: Browser.ie ? "select, input, textarea, object, embed" : null}, dissolve: function () {
        if (!this.hiding && !this.showing) {
            if (this.element.getStyle("display") != "none") {
                this.hiding = true;
                this.showing = false;
                this.hidden = true;
                this.cssText = this.element.style.cssText;
                var d = this.element.getComputedSize({styles: this.options.styles, mode: this.options.mode});
                if (this.options.transitionOpacity) {
                    d.opacity = this.options.opacity
                }
                var c = {};
                Object.each(d, function (f, e) {
                    c[e] = [f, 0]
                });
                this.element.setStyles({display: Function.from(this.options.display).call(this), overflow: "hidden"});
                var b = a(this);
                if (b) {
                    b.setStyle("visibility", "hidden")
                }
                this.$chain.unshift(function () {
                    if (this.hidden) {
                        this.hiding = false;
                        this.element.style.cssText = this.cssText;
                        this.element.setStyle("display", "none");
                        if (b) {
                            b.setStyle("visibility", "visible")
                        }
                    }
                    this.fireEvent("hide", this.element);
                    this.callChain()
                }.bind(this));
                this.start(c)
            } else {
                this.callChain.delay(10, this);
                this.fireEvent("complete", this.element);
                this.fireEvent("hide", this.element)
            }
        } else {
            if (this.options.link == "chain") {
                this.chain(this.dissolve.bind(this))
            } else {
                if (this.options.link == "cancel" && !this.hiding) {
                    this.cancel();
                    this.dissolve()
                }
            }
        }
        return this
    }, reveal: function () {
        if (!this.showing && !this.hiding) {
            if (this.element.getStyle("display") == "none") {
                this.hiding = false;
                this.showing = true;
                this.hidden = false;
                this.cssText = this.element.style.cssText;
                var d;
                this.element.measure(function () {
                    d = this.element.getComputedSize({styles: this.options.styles, mode: this.options.mode})
                }.bind(this));
                if (this.options.heightOverride != null) {
                    d.height = this.options.heightOverride.toInt()
                }
                if (this.options.widthOverride != null) {
                    d.width = this.options.widthOverride.toInt()
                }
                if (this.options.transitionOpacity) {
                    this.element.setStyle("opacity", 0);
                    d.opacity = this.options.opacity
                }
                var c = {height: 0, display: Function.from(this.options.display).call(this)};
                Object.each(d, function (f, e) {
                    c[e] = 0
                });
                c.overflow = "hidden";
                this.element.setStyles(c);
                var b = a(this);
                if (b) {
                    b.setStyle("visibility", "hidden")
                }
                this.$chain.unshift(function () {
                    this.element.style.cssText = this.cssText;
                    this.element.setStyle("display", Function.from(this.options.display).call(this));
                    if (!this.hidden) {
                        this.showing = false
                    }
                    if (b) {
                        b.setStyle("visibility", "visible")
                    }
                    this.callChain();
                    this.fireEvent("show", this.element)
                }.bind(this));
                this.start(d)
            } else {
                this.callChain();
                this.fireEvent("complete", this.element);
                this.fireEvent("show", this.element)
            }
        } else {
            if (this.options.link == "chain") {
                this.chain(this.reveal.bind(this))
            } else {
                if (this.options.link == "cancel" && !this.showing) {
                    this.cancel();
                    this.reveal()
                }
            }
        }
        return this
    }, toggle: function () {
        if (this.element.getStyle("display") == "none") {
            this.reveal()
        } else {
            this.dissolve()
        }
        return this
    }, cancel: function () {
        this.parent.apply(this, arguments);
        if (this.cssText != null) {
            this.element.style.cssText = this.cssText
        }
        this.hiding = false;
        this.showing = false;
        return this
    }});
    Element.Properties.reveal = {set: function (b) {
        this.get("reveal").cancel().setOptions(b);
        return this
    }, get: function () {
        var b = this.retrieve("reveal");
        if (!b) {
            b = new Fx.Reveal(this);
            this.store("reveal", b)
        }
        return b
    }};
    Element.Properties.dissolve = Element.Properties.reveal;
    Element.implement({reveal: function (b) {
        this.get("reveal").setOptions(b).reveal();
        return this
    }, dissolve: function (b) {
        this.get("reveal").setOptions(b).dissolve();
        return this
    }, nix: function (b) {
        var c = Array.link(arguments, {destroy: Type.isBoolean, options: Type.isObject});
        this.get("reveal").setOptions(b).dissolve().chain(function () {
            this[c.destroy ? "destroy" : "dispose"]()
        }.bind(this));
        return this
    }, wink: function () {
        var c = Array.link(arguments, {duration: Type.isNumber, options: Type.isObject});
        var b = this.get("reveal").setOptions(c.options);
        b.reveal().chain(function () {
            (function () {
                b.dissolve()
            }).delay(c.duration || 2000)
        })
    }})
})();
(function () {
    Fx.Scroll = new Class({Extends: Fx, options: {offset: {x: 0, y: 0}, wheelStops: true}, initialize: function (c, b) {
        this.element = this.subject = document.id(c);
        this.parent(b);
        if (typeOf(this.element) != "element") {
            this.element = document.id(this.element.getDocument().body)
        }
        if (this.options.wheelStops) {
            var d = this.element, e = this.cancel.pass(false, this);
            this.addEvent("start", function () {
                d.addEvent("mousewheel", e)
            }, true);
            this.addEvent("complete", function () {
                d.removeEvent("mousewheel", e)
            }, true)
        }
    }, set: function () {
        var b = Array.flatten(arguments);
        if (Browser.firefox) {
            b = [Math.round(b[0]), Math.round(b[1])]
        }
        this.element.scrollTo(b[0], b[1]);
        return this
    }, compute: function (d, c, b) {
        return[0, 1].map(function (e) {
            return Fx.compute(d[e], c[e], b)
        })
    }, start: function (c, d) {
        if (!this.check(c, d)) {
            return this
        }
        var b = this.element.getScroll();
        return this.parent([b.x, b.y], [c, d])
    }, calculateScroll: function (g, f) {
        var d = this.element, b = d.getScrollSize(), h = d.getScroll(), l = d.getSize(), c = this.options.offset, k = {x: g, y: f};
        for (var e in k) {
            if (!k[e] && k[e] !== 0) {
                k[e] = h[e]
            }
            if (typeOf(k[e]) != "number") {
                k[e] = b[e] - l[e]
            }
            k[e] += c[e]
        }
        return[k.x, k.y]
    }, toTop: function () {
        return this.start.apply(this, this.calculateScroll(false, 0))
    }, toLeft: function () {
        return this.start.apply(this, this.calculateScroll(0, false))
    }, toRight: function () {
        return this.start.apply(this, this.calculateScroll("right", false))
    }, toBottom: function () {
        return this.start.apply(this, this.calculateScroll(false, "bottom"))
    }, toElement: function (d, e) {
        e = e ? Array.from(e) : ["x", "y"];
        var c = a(this.element) ? {x: 0, y: 0} : this.element.getScroll();
        var b = Object.map(document.id(d).getPosition(this.element), function (g, f) {
            return e.contains(f) ? g + c[f] : false
        });
        return this.start.apply(this, this.calculateScroll(b.x, b.y))
    }, toElementEdge: function (d, g, e) {
        g = g ? Array.from(g) : ["x", "y"];
        d = document.id(d);
        var k = {}, f = d.getPosition(this.element), l = d.getSize(), h = this.element.getScroll(), b = this.element.getSize(), c = {x: f.x + l.x, y: f.y + l.y};
        ["x", "y"].each(function (m) {
            if (g.contains(m)) {
                if (c[m] > h[m] + b[m]) {
                    k[m] = c[m] - b[m]
                }
                if (f[m] < h[m]) {
                    k[m] = f[m]
                }
            }
            if (k[m] == null) {
                k[m] = h[m]
            }
            if (e && e[m]) {
                k[m] = k[m] + e[m]
            }
        }, this);
        if (k.x != h.x || k.y != h.y) {
            this.start(k.x, k.y)
        }
        return this
    }, toElementCenter: function (e, f, h) {
        f = f ? Array.from(f) : ["x", "y"];
        e = document.id(e);
        var k = {}, c = e.getPosition(this.element), d = e.getSize(), b = this.element.getScroll(), g = this.element.getSize();
        ["x", "y"].each(function (l) {
            if (f.contains(l)) {
                k[l] = c[l] - (g[l] - d[l]) / 2
            }
            if (k[l] == null) {
                k[l] = b[l]
            }
            if (h && h[l]) {
                k[l] = k[l] + h[l]
            }
        }, this);
        if (k.x != b.x || k.y != b.y) {
            this.start(k.x, k.y)
        }
        return this
    }});
    function a(b) {
        return(/^(?:body|html)$/i).test(b.tagName)
    }
})();
Fx.Slide = new Class({Extends: Fx, options: {mode: "vertical", wrapper: false, hideOverflow: true, resetHeight: false}, initialize: function (b, a) {
    b = this.element = this.subject = document.id(b);
    this.parent(a);
    a = this.options;
    var d = b.retrieve("wrapper"), c = b.getStyles("margin", "position", "overflow");
    if (a.hideOverflow) {
        c = Object.append(c, {overflow: "hidden"})
    }
    if (a.wrapper) {
        d = document.id(a.wrapper).setStyles(c)
    }
    if (!d) {
        d = new Element("div", {styles: c}).wraps(b)
    }
    b.store("wrapper", d).setStyle("margin", 0);
    if (b.getStyle("overflow") == "visible") {
        b.setStyle("overflow", "hidden")
    }
    this.now = [];
    this.open = true;
    this.wrapper = d;
    this.addEvent("complete", function () {
        this.open = (d["offset" + this.layout.capitalize()] != 0);
        if (this.open && this.options.resetHeight) {
            d.setStyle("height", "")
        }
    }, true)
}, vertical: function () {
    this.margin = "margin-top";
    this.layout = "height";
    this.offset = this.element.offsetHeight
}, horizontal: function () {
    this.margin = "margin-left";
    this.layout = "width";
    this.offset = this.element.offsetWidth
}, set: function (a) {
    this.element.setStyle(this.margin, a[0]);
    this.wrapper.setStyle(this.layout, a[1]);
    return this
}, compute: function (c, b, a) {
    return[0, 1].map(function (d) {
        return Fx.compute(c[d], b[d], a)
    })
}, start: function (b, e) {
    if (!this.check(b, e)) {
        return this
    }
    this[e || this.options.mode]();
    var d = this.element.getStyle(this.margin).toInt(), c = this.wrapper.getStyle(this.layout).toInt(), a = [
        [d, c],
        [0, this.offset]
    ], g = [
        [d, c],
        [-this.offset, 0]
    ], f;
    switch (b) {
        case"in":
            f = a;
            break;
        case"out":
            f = g;
            break;
        case"toggle":
            f = (c == 0) ? a : g
    }
    return this.parent(f[0], f[1])
}, slideIn: function (a) {
    return this.start("in", a)
}, slideOut: function (a) {
    return this.start("out", a)
}, hide: function (a) {
    this[a || this.options.mode]();
    this.open = false;
    return this.set([-this.offset, 0])
}, show: function (a) {
    this[a || this.options.mode]();
    this.open = true;
    return this.set([0, this.offset])
}, toggle: function (a) {
    return this.start("toggle", a)
}});
Element.Properties.slide = {set: function (a) {
    this.get("slide").cancel().setOptions(a);
    return this
}, get: function () {
    var a = this.retrieve("slide");
    if (!a) {
        a = new Fx.Slide(this, {link: "cancel"});
        this.store("slide", a)
    }
    return a
}};
Element.implement({slide: function (d, e) {
    d = d || "toggle";
    var b = this.get("slide"), a;
    switch (d) {
        case"hide":
            b.hide(e);
            break;
        case"show":
            b.show(e);
            break;
        case"toggle":
            var c = this.retrieve("slide:flag", b.open);
            b[c ? "slideOut" : "slideIn"](e);
            this.store("slide:flag", !c);
            a = true;
            break;
        default:
            b.start(d, e)
    }
    if (!a) {
        this.eliminate("slide:flag")
    }
    return this
}});
Fx.SmoothScroll = new Class({Extends: Fx.Scroll, options: {axes: ["x", "y"]}, initialize: function (c, d) {
    d = d || document;
    this.doc = d.getDocument();
    this.parent(this.doc, c);
    var e = d.getWindow(), a = e.location.href.match(/^[^#]*/)[0] + "#", b = $$(this.options.links || this.doc.links);
    b.each(function (g) {
        if (g.href.indexOf(a) != 0) {
            return
        }
        var f = g.href.substr(a.length);
        if (f) {
            this.useLink(g, f)
        }
    }, this);
    this.addEvent("complete", function () {
        e.location.hash = this.anchor;
        this.element.scrollTo(this.to[0], this.to[1])
    }, true)
}, useLink: function (b, a) {
    b.addEvent("click", function (d) {
        var c = document.id(a) || this.doc.getElement("a[name=" + a + "]");
        if (!c) {
            return
        }
        d.preventDefault();
        this.toElement(c, this.options.axes).chain(function () {
            this.fireEvent("scrolledTo", [b, c])
        }.bind(this));
        this.anchor = a
    }.bind(this));
    return this
}});
var Drag = new Class({Implements: [Events, Options], options: {snap: 6, unit: "px", grid: false, style: true, limit: false, handle: false, invert: false, preventDefault: false, stopPropagation: false, modifiers: {x: "left", y: "top"}}, initialize: function () {
    var b = Array.link(arguments, {options: Type.isObject, element: function (c) {
        return c != null
    }});
    this.element = document.id(b.element);
    this.document = this.element.getDocument();
    this.setOptions(b.options || {});
    var a = typeOf(this.options.handle);
    this.handles = ((a == "array" || a == "collection") ? $$(this.options.handle) : document.id(this.options.handle)) || this.element;
    this.mouse = {now: {}, pos: {}};
    this.value = {start: {}, now: {}};
    this.selection = (Browser.ie) ? "selectstart" : "mousedown";
    if (Browser.ie && !Drag.ondragstartFixed) {
        document.ondragstart = Function.from(false);
        Drag.ondragstartFixed = true
    }
    this.bound = {start: this.start.bind(this), check: this.check.bind(this), drag: this.drag.bind(this), stop: this.stop.bind(this), cancel: this.cancel.bind(this), eventStop: Function.from(false)};
    this.attach()
}, attach: function () {
    this.handles.addEvent("mousedown", this.bound.start);
    return this
}, detach: function () {
    this.handles.removeEvent("mousedown", this.bound.start);
    return this
}, start: function (a) {
    var k = this.options;
    if (a.rightClick) {
        return
    }
    if (k.preventDefault) {
        a.preventDefault()
    }
    if (k.stopPropagation) {
        a.stopPropagation()
    }
    this.mouse.start = a.page;
    this.fireEvent("beforeStart", this.element);
    var c = k.limit;
    this.limit = {x: [], y: []};
    var e, g;
    for (e in k.modifiers) {
        if (!k.modifiers[e]) {
            continue
        }
        var b = this.element.getStyle(k.modifiers[e]);
        if (b && !b.match(/px$/)) {
            if (!g) {
                g = this.element.getCoordinates(this.element.getOffsetParent())
            }
            b = g[k.modifiers[e]]
        }
        if (k.style) {
            this.value.now[e] = (b || 0).toInt()
        } else {
            this.value.now[e] = this.element[k.modifiers[e]]
        }
        if (k.invert) {
            this.value.now[e] *= -1
        }
        this.mouse.pos[e] = a.page[e] - this.value.now[e];
        if (c && c[e]) {
            var d = 2;
            while (d--) {
                var f = c[e][d];
                if (f || f === 0) {
                    this.limit[e][d] = (typeof f == "function") ? f() : f
                }
            }
        }
    }
    if (typeOf(this.options.grid) == "number") {
        this.options.grid = {x: this.options.grid, y: this.options.grid}
    }
    var h = {mousemove: this.bound.check, mouseup: this.bound.cancel};
    h[this.selection] = this.bound.eventStop;
    this.document.addEvents(h)
}, check: function (a) {
    if (this.options.preventDefault) {
        a.preventDefault()
    }
    var b = Math.round(Math.sqrt(Math.pow(a.page.x - this.mouse.start.x, 2) + Math.pow(a.page.y - this.mouse.start.y, 2)));
    if (b > this.options.snap) {
        this.cancel();
        this.document.addEvents({mousemove: this.bound.drag, mouseup: this.bound.stop});
        this.fireEvent("start", [this.element, a]).fireEvent("snap", this.element)
    }
}, drag: function (b) {
    var a = this.options;
    if (a.preventDefault) {
        b.preventDefault()
    }
    this.mouse.now = b.page;
    for (var c in a.modifiers) {
        if (!a.modifiers[c]) {
            continue
        }
        this.value.now[c] = this.mouse.now[c] - this.mouse.pos[c];
        if (a.invert) {
            this.value.now[c] *= -1
        }
        if (a.limit && this.limit[c]) {
            if ((this.limit[c][1] || this.limit[c][1] === 0) && (this.value.now[c] > this.limit[c][1])) {
                this.value.now[c] = this.limit[c][1]
            } else {
                if ((this.limit[c][0] || this.limit[c][0] === 0) && (this.value.now[c] < this.limit[c][0])) {
                    this.value.now[c] = this.limit[c][0]
                }
            }
        }
        if (a.grid[c]) {
            this.value.now[c] -= ((this.value.now[c] - (this.limit[c][0] || 0)) % a.grid[c])
        }
        if (a.style) {
            this.element.setStyle(a.modifiers[c], this.value.now[c] + a.unit)
        } else {
            this.element[a.modifiers[c]] = this.value.now[c]
        }
    }
    this.fireEvent("drag", [this.element, b])
}, cancel: function (a) {
    this.document.removeEvents({mousemove: this.bound.check, mouseup: this.bound.cancel});
    if (a) {
        this.document.removeEvent(this.selection, this.bound.eventStop);
        this.fireEvent("cancel", this.element)
    }
}, stop: function (b) {
    var a = {mousemove: this.bound.drag, mouseup: this.bound.stop};
    a[this.selection] = this.bound.eventStop;
    this.document.removeEvents(a);
    if (b) {
        this.fireEvent("complete", [this.element, b])
    }
}});
Element.implement({makeResizable: function (a) {
    var b = new Drag(this, Object.merge({modifiers: {x: "width", y: "height"}}, a));
    this.store("resizer", b);
    return b.addEvent("drag", function () {
        this.fireEvent("resize", b)
    }.bind(this))
}});
Drag.Move = new Class({Extends: Drag, options: {droppables: [], container: false, precalculate: false, includeMargins: true, checkDroppables: true}, initialize: function (b, a) {
    this.parent(b, a);
    b = this.element;
    this.droppables = $$(this.options.droppables);
    this.container = document.id(this.options.container);
    if (this.container && typeOf(this.container) != "element") {
        this.container = document.id(this.container.getDocument().body)
    }
    if (this.options.style) {
        if (this.options.modifiers.x == "left" && this.options.modifiers.y == "top") {
            var c = b.getOffsetParent(), d = b.getStyles("left", "top");
            if (c && (d.left == "auto" || d.top == "auto")) {
                b.setPosition(b.getPosition(c))
            }
        }
        if (b.getStyle("position") == "static") {
            b.setStyle("position", "absolute")
        }
    }
    this.addEvent("start", this.checkDroppables, true);
    this.overed = null
}, start: function (a) {
    if (this.container) {
        this.options.limit = this.calculateLimit()
    }
    if (this.options.precalculate) {
        this.positions = this.droppables.map(function (b) {
            return b.getCoordinates()
        })
    }
    this.parent(a)
}, calculateLimit: function () {
    var l = this.element, e = this.container, d = document.id(l.getOffsetParent()) || document.body, h = e.getCoordinates(d), c = {}, b = {}, m = {}, g = {}, o = {};
    ["top", "right", "bottom", "left"].each(function (t) {
        c[t] = l.getStyle("margin-" + t).toInt();
        b[t] = l.getStyle("border-" + t).toInt();
        m[t] = e.getStyle("margin-" + t).toInt();
        g[t] = e.getStyle("border-" + t).toInt();
        o[t] = d.getStyle("padding-" + t).toInt()
    }, this);
    var f = l.offsetWidth + c.left + c.right, s = l.offsetHeight + c.top + c.bottom, k = 0, n = 0, r = h.right - g.right - f, a = h.bottom - g.bottom - s;
    if (this.options.includeMargins) {
        k += c.left;
        n += c.top
    } else {
        r += c.right;
        a += c.bottom
    }
    if (l.getStyle("position") == "relative") {
        var q = l.getCoordinates(d);
        q.left -= l.getStyle("left").toInt();
        q.top -= l.getStyle("top").toInt();
        k -= q.left;
        n -= q.top;
        if (e.getStyle("position") != "relative") {
            k += g.left;
            n += g.top
        }
        r += c.left - q.left;
        a += c.top - q.top;
        if (e != d) {
            k += m.left + o.left;
            n += ((Browser.ie6 || Browser.ie7) ? 0 : m.top) + o.top
        }
    } else {
        k -= c.left;
        n -= c.top;
        if (e != d) {
            k += h.left + g.left;
            n += h.top + g.top
        }
    }
    return{x: [k, r], y: [n, a]}
}, getDroppableCoordinates: function (c) {
    var b = c.getCoordinates();
    if (c.getStyle("position") == "fixed") {
        var a = window.getScroll();
        b.left += a.x;
        b.right += a.x;
        b.top += a.y;
        b.bottom += a.y
    }
    return b
}, checkDroppables: function () {
    var a = this.droppables.filter(function (d, c) {
        d = this.positions ? this.positions[c] : this.getDroppableCoordinates(d);
        var b = this.mouse.now;
        return(b.x > d.left && b.x < d.right && b.y < d.bottom && b.y > d.top)
    }, this).getLast();
    if (this.overed != a) {
        if (this.overed) {
            this.fireEvent("leave", [this.element, this.overed])
        }
        if (a) {
            this.fireEvent("enter", [this.element, a])
        }
        this.overed = a
    }
}, drag: function (a) {
    this.parent(a);
    if (this.options.checkDroppables && this.droppables.length) {
        this.checkDroppables()
    }
}, stop: function (a) {
    this.checkDroppables();
    this.fireEvent("drop", [this.element, this.overed, a]);
    this.overed = null;
    return this.parent(a)
}});
Element.implement({makeDraggable: function (a) {
    var b = new Drag.Move(this, a);
    this.store("dragger", b);
    return b
}});
Hash.Cookie = new Class({Extends: Cookie, options: {autoSave: true}, initialize: function (b, a) {
    this.parent(b, a);
    this.load()
}, save: function () {
    var a = JSON.encode(this.hash);
    if (!a || a.length > 4096) {
        return false
    }
    if (a == "{}") {
        this.dispose()
    } else {
        this.write(a)
    }
    return true
}, load: function () {
    this.hash = new Hash(JSON.decode(this.read(), true));
    return this
}});
Hash.each(Hash.prototype, function (b, a) {
    if (typeof b == "function") {
        Hash.Cookie.implement(a, function () {
            var c = b.apply(this.hash, arguments);
            if (this.options.autoSave) {
                this.save()
            }
            return c
        })
    }
});
var Observer = new Class({Implements: [Options, Events], options: {periodical: false, delay: 1000}, initialize: function (c, a, b) {
    this.element = $(c) || $$(c);
    this.addEvent("onFired", a);
    this.setOptions(b);
    this.bound = this.changed.bind(this);
    this.resume()
}, changed: function () {
    var a = this.element.get("value");
    if ($equals(this.value, a)) {
        return
    }
    this.clear();
    this.value = a;
    this.timeout = this.onFired.delay(this.options.delay, this)
}, setValue: function (a) {
    this.value = a;
    this.element.set("value", a);
    return this.clear()
}, onFired: function () {
    this.fireEvent("onFired", [this.value, this.element])
}, clear: function () {
    clearTimeout(this.timeout || null);
    return this
}, pause: function () {
    if (this.timer) {
        clearInterval(this.timer)
    } else {
        this.element.removeEvent("keyup", this.bound)
    }
    return this.clear()
}, resume: function () {
    this.value = this.element.get("value");
    if (this.options.periodical) {
        this.timer = this.changed.periodical(this.options.periodical, this)
    } else {
        this.element.addEvent("keyup", this.bound)
    }
    return this
}});
var $equals = function (b, a) {
    return(b == a || JSON.encode(b) == JSON.encode(a))
};
var Overlay = new Class({Implements: [Options, Events], options: {color: "#000", duration: 500, opacity: 0.5, zIndex: 5000}, initialize: function (a, b) {
    this.setOptions(b);
    this.container = document.id(a);
    if (Browser.ie && Browser.version <= 6) {
        this.ie6 = true
    }
    this.overlay = new Element("div", {id: this.options.id, styles: {position: (this.ie6) ? "absolute" : "fixed", background: this.options.color, left: 0, top: 0, opacity: 0, "z-index": this.options.zIndex}, events: {click: function () {
        this.fireEvent("click")
    }.bind(this)}}).inject(this.container);
    this.tween = new Fx.Tween(this.overlay, {duration: this.options.duration, link: "cancel", property: "opacity", onStart: function () {
        this.overlay.setStyles({width: "100%", height: this.container.getScrollSize().y})
    }.bind(this), onComplete: function () {
        this.fireEvent(this.overlay.get("opacity") == this.options.opacity ? "show" : "hide")
    }.bind(this)});
    window.addEvents({resize: function () {
        if (!Browser.ie6) {
            this.resize()
        }
    }.bind(this), scroll: function () {
        if (!Browser.ie6) {
            this.scroll()
        }
    }.bind(this)})
}, open: function () {
    this.fireEvent("open");
    this.tween.start(this.options.opacity);
    return this
}, close: function () {
    this.fireEvent("close");
    this.tween.start(0);
    return this
}, resize: function () {
    this.fireEvent("resize");
    this.overlay.setStyle("height", this.container.getScrollSize().y);
    return this
}, scroll: function () {
    this.fireEvent("scroll");
    if (this.ie6) {
        this.overlay.setStyle("left", window.getScroll().x)
    }
    return this
}});
var Autocompleter = new Class({Implements: [Options, Events], options: {minLength: 1, markQuery: true, width: "inherit", maxChoices: 10, injectChoice: null, customChoices: null, emptyChoices: null, visibleChoices: true, className: "autocompleter-choices", zIndex: 42, delay: 400, observerOptions: {}, fxOptions: {}, autoSubmit: false, overflow: false, overflowMargin: 25, selectFirst: false, filter: null, filterCase: false, filterSubset: false, forceSelect: false, selectMode: true, choicesMatch: null, multiple: false, separator: ", ", separatorSplit: /\s*[,;]\s*/, autoTrim: false, allowDupes: false, cache: true, relative: false}, initialize: function (b, a) {
    this.element = $(b);
    this.setOptions(a);
    this.build();
    this.observer = new Observer(this.element, this.prefetch.bind(this), Object.merge({delay: this.options.delay}, this.options.observerOptions));
    this.queryValue = null;
    if (this.options.filter) {
        this.filter = this.options.filter.bind(this)
    }
    var c = this.options.selectMode;
    this.typeAhead = (c == "type-ahead");
    this.selectMode = (c === true) ? "selection" : c;
    this.cached = []
}, build: function () {
    if ($(this.options.customChoices)) {
        this.choices = this.options.customChoices
    } else {
        this.choices = new Element("ul", {"class": this.options.className, styles: {zIndex: this.options.zIndex}}).inject(document.body);
        this.relative = false;
        if (this.options.relative) {
            this.choices.inject(this.element, "after");
            this.relative = this.element.getOffsetParent()
        }
        this.fix = new OverlayFix(this.choices)
    }
    if (!this.options.separator.test(this.options.separatorSplit)) {
        this.options.separatorSplit = this.options.separator
    }
    this.fx = (!this.options.fxOptions) ? null : new Fx.Tween(this.choices, Object.merge({property: "opacity", link: "cancel", duration: 200}, this.options.fxOptions)).addEvent("onStart", Chain.prototype.clearChain).set(0);
    this.element.setProperty("autocomplete", "off").addEvent((Browser.ie || Browser.chrome || Browser.safari) ? "keydown" : "keypress", this.onCommand.bind(this)).addEvent("click", this.onCommand.bind(this, false)).addEvent("focus", (function () {
        this.toggleFocus.delay(100, this, true)
    }).bind(this)).addEvent("blur", (function () {
            this.toggleFocus.delay(100, this, false)
        }).bind(this))
}, destroy: function () {
    if (this.fix) {
        this.fix.destroy()
    }
    this.choices = this.selected = this.choices.destroy()
}, toggleFocus: function (a) {
    this.focussed = a;
    if (!a) {
        this.hideChoices(true)
    }
    this.fireEvent((a) ? "onFocus" : "onBlur", [this.element])
}, onCommand: function (b) {
    if (!b && this.focussed) {
        return this.prefetch()
    }
    if (b && b.key && !b.shift) {
        switch (b.key) {
            case"enter":
                if (this.element.value != this.opted) {
                    return true
                }
                if (this.selected && this.visible) {
                    this.choiceSelect(this.selected);
                    return !!(this.options.autoSubmit)
                }
                break;
            case"up":
            case"down":
                if (!this.prefetch() && this.queryValue !== null) {
                    var a = (b.key == "up");
                    this.choiceOver((this.selected || this.choices)[(this.selected) ? ((a) ? "getPrevious" : "getNext") : ((a) ? "getLast" : "getFirst")](this.options.choicesMatch), true)
                }
                return false;
            case"esc":
            case"tab":
                this.hideChoices(true);
                break
        }
    }
    return true
}, setSelection: function (f) {
    var g = this.selected.inputValue, h = g;
    var a = this.queryValue.length, c = g.length;
    if (g.substr(0, a).toLowerCase() != this.queryValue.toLowerCase()) {
        a = 0
    }
    if (this.options.multiple) {
        var e = this.options.separatorSplit;
        h = this.element.value;
        a += this.queryIndex;
        c += this.queryIndex;
        var b = h.substr(this.queryIndex).split(e, 1)[0];
        h = h.substr(0, this.queryIndex) + g + h.substr(this.queryIndex + b.length);
        if (f) {
            var d = h.split(this.options.separatorSplit).filter(function (l) {
                return this.test(l)
            }, /[^\s,]+/);
            if (!this.options.allowDupes) {
                d = [].combine(d)
            }
            var k = this.options.separator;
            h = d.join(k) + k;
            c = h.length
        }
    }
    this.observer.setValue(h);
    this.opted = h;
    if (f || this.selectMode == "pick") {
        a = c
    }
    this.element.selectRange(a, c);
    this.fireEvent("onSelection", [this.element, this.selected, h, g])
}, showChoices: function () {
    var c = this.options.choicesMatch, b = this.choices.getFirst(c);
    this.selected = this.selectedValue = null;
    if (this.fix) {
        var e = this.element.getCoordinates(this.relative), a = this.options.width || "auto";
        this.choices.setStyles({left: e.left, top: e.bottom, width: (a === true || a == "inherit") ? e.width : a})
    }
    if (!b) {
        return
    }
    if (!this.visible) {
        this.visible = true;
        this.choices.setStyle("display", "");
        if (this.fx) {
            this.fx.start(1)
        }
        this.fireEvent("onShow", [this.element, this.choices])
    }
    if (this.options.selectFirst || this.typeAhead || b.inputValue == this.queryValue) {
        this.choiceOver(b, this.typeAhead)
    }
    var d = this.choices.getChildren(c), f = this.options.maxChoices;
    var k = {overflowY: "hidden", height: ""};
    this.overflown = false;
    if (d.length > f) {
        var l = d[f - 1];
        k.overflowY = "scroll";
        k.height = l.getCoordinates(this.choices).bottom;
        this.overflown = true
    }
    this.choices.setStyles(k);
    this.fix.show();
    if (this.options.visibleChoices) {
        var h = document.getScroll(), m = document.getSize(), g = this.choices.getCoordinates();
        if (g.right > h.x + m.x) {
            h.x = g.right - m.x
        }
        if (g.bottom > h.y + m.y) {
            h.y = g.bottom - m.y
        }
        window.scrollTo(Math.min(h.x, g.left), Math.min(h.y, g.top))
    }
}, hideChoices: function (a) {
    if (a) {
        var c = this.element.value;
        if (this.options.forceSelect) {
            c = this.opted
        }
        if (this.options.autoTrim) {
            c = c.split(this.options.separatorSplit).filter(function (d) {
                return d
            }).join(this.options.separator)
        }
        this.observer.setValue(c)
    }
    if (!this.visible) {
        return
    }
    this.visible = false;
    if (this.selected) {
        this.selected.removeClass("autocompleter-selected")
    }
    this.observer.clear();
    var b = function () {
        this.choices.setStyle("display", "none");
        this.fix.hide()
    }.bind(this);
    if (this.fx) {
        this.fx.start(0).chain(b)
    } else {
        b()
    }
    this.fireEvent("onHide", [this.element, this.choices])
}, prefetch: function () {
    var f = this.element.value, e = f;
    if (this.options.multiple) {
        var c = this.options.separatorSplit;
        var a = f.split(c);
        var b = this.element.getSelectedRange().start;
        var g = f.substr(0, b).split(c);
        var d = g.length - 1;
        b -= g[d].length;
        e = a[d]
    }
    if (e.length < this.options.minLength) {
        this.hideChoices()
    } else {
        if (e === this.queryValue || (this.visible && e == this.selectedValue)) {
            if (this.visible) {
                return false
            }
            this.showChoices()
        } else {
            this.queryValue = e;
            this.queryIndex = b;
            if (!this.fetchCached()) {
                this.query()
            }
        }
    }
    return true
}, fetchCached: function () {
    return false;
    /*if (!this.options.cache || !this.cached || !this.cached.length || this.cached.length >= this.options.maxChoices || this.queryValue) {
        return false
    }
    this.update(this.filter(this.cached));
    return true*/
}, update: function (b) {
    this.choices.empty();
    this.cached = b;
    var a = b && typeOf(b);
    if (a == "null" || (a == "array" && !b.length) || (a == "hash" && !b.getLength())) {
        (this.options.emptyChoices || this.hideChoices).call(this)
    } else {
        if (this.options.maxChoices < b.length && !this.options.overflow) {
            b.length = this.options.maxChoices
        }
        b.each(this.options.injectChoice || function (d) {
            var c = new Element("li", {html: this.markQueryValue(d)});
            c.inputValue = d;
            this.addChoiceEvents(c).inject(this.choices)
        }, this);
        this.showChoices()
    }
}, choiceOver: function (c, d) {
    if (!c || c == this.selected) {
        return
    }
    if (this.selected) {
        this.selected.removeClass("autocompleter-selected")
    }
    this.selected = c.addClass("autocompleter-selected");
    this.fireEvent("onSelect", [this.element, this.selected, d]);
    if (!this.selectMode) {
        this.opted = this.element.value
    }
    if (!d) {
        return
    }
    this.selectedValue = this.selected.inputValue;
    if (this.overflown) {
        var f = this.selected.getCoordinates(this.choices), e = this.options.overflowMargin, g = this.choices.scrollTop, a = this.choices.offsetHeight, b = g + a;
        if (f.top - e < g && g) {
            this.choices.scrollTop = Math.max(f.top - e, 0)
        } else {
            if (f.bottom + e > b) {
                this.choices.scrollTop = Math.min(f.bottom - a + e, b)
            }
        }
    }
    if (this.selectMode) {
        this.setSelection()
    }
}, choiceSelect: function (a) {
    if (a) {
        this.choiceOver(a)
    }
    this.setSelection(true);
    this.queryValue = false;
    this.hideChoices()
}, filter: function (a) {
    return(a || this.tokens).filter(function (b) {
        return this.test(b)
    }, new RegExp(((this.options.filterSubset) ? "" : "^") + this.queryValue.escapeRegExp(), (this.options.filterCase) ? "" : "i"))
}, markQueryValue: function (a) {
    return(!this.options.markQuery || !this.queryValue) ? a : a.replace(new RegExp("(" + ((this.options.filterSubset) ? "" : "^") + this.queryValue.escapeRegExp() + ")", (this.options.filterCase) ? "" : "i"), '<span class="autocompleter-queried">$1</span>')
}, addChoiceEvents: function (a) {
    return a.addEvents({mouseover: this.choiceOver.bind(this, a), click: this.choiceSelect.bind(this, a)})
}});
var OverlayFix = new Class({initialize: function (a) {
    if (Browser.ie) {
        this.element = $(a);
        this.relative = this.element.getOffsetParent();
        this.fix = new Element("iframe", {frameborder: "0", scrolling: "no", src: "javascript:false;", styles: {position: "absolute", border: "none", display: "none", filter: "progid:DXImageTransform.Microsoft.Alpha(opacity=0)"}}).inject(this.element, "after")
    }
}, show: function () {
    if (this.fix) {
        var a = this.element.getCoordinates(this.relative);
        delete a.right;
        delete a.bottom;
        this.fix.setStyles(Object.append(a, {display: "", zIndex: (this.element.getStyle("zIndex") || 1) - 1}))
    }
    return this
}, hide: function () {
    if (this.fix) {
        this.fix.setStyle("display", "none")
    }
    return this
}, destroy: function () {
    if (this.fix) {
        this.fix = this.fix.destroy()
    }
}});
Element.implement({getSelectedRange: function () {
    if (!Browser.ie) {
        return{start: this.selectionStart, end: this.selectionEnd}
    }
    var e = {start: 0, end: 0};
    var a = this.getDocument().selection.createRange();
    if (!a || a.parentElement() != this) {
        return e
    }
    var c = a.duplicate();
    if (this.type == "text") {
        e.start = 0 - c.moveStart("character", -100000);
        e.end = e.start + a.text.length
    } else {
        var b = this.value;
        var d = b.length - b.match(/[\n\r]*$/)[0].length;
        c.moveToElementText(this);
        c.setEndPoint("StartToEnd", a);
        e.end = d - c.text.length;
        c.setEndPoint("StartToStart", a);
        e.start = d - c.text.length
    }
    return e
}, selectRange: function (d, a) {
    if (Browser.ie) {
        var c = this.value.substr(d, a - d).replace(/\r/g, "").length;
        d = this.value.substr(0, d).replace(/\r/g, "").length;
        var b = this.createTextRange();
        b.collapse(true);
        b.moveEnd("character", d + c);
        b.moveStart("character", d);
        b.select()
    } else {
        this.focus();
        this.setSelectionRange(d, a)
    }
    return this
}});
Autocompleter.Base = Autocompleter;
Autocompleter.Local = new Class({Extends: Autocompleter, options: {minLength: 0, delay: 200}, initialize: function (b, c, a) {
    this.parent(b, a);
    this.tokens = c
}, query: function () {
    this.update(this.filter())
}});
Autocompleter.Request = new Class({Extends: Autocompleter, options: {postData: {}, ajaxOptions: {}, postVar: "value"}, query: function () {
    var c = Object.clone(this.options.postData) || {};
    c[this.options.postVar] = this.queryValue;
    var b = $(this.options.indicator);
    if (b) {
        b.setStyle("display", "")
    }
    var a = this.options.indicatorClass;
    if (a) {
        this.element.addClass(a)
    }
    this.fireEvent("onRequest", [this.element, this.request, c, this.queryValue]);
    this.request.send({data: c})
}, queryResponse: function () {
    var b = $(this.options.indicator);
    if (b) {
        b.setStyle("display", "none")
    }
    var a = this.options.indicatorClass;
    if (a) {
        this.element.removeClass(a)
    }
    return this.fireEvent("onComplete", [this.element, this.request])
}});
Autocompleter.Request.JSON = new Class({Extends: Autocompleter.Request, initialize: function (c, b, a) {
    this.parent(c, a);
    var d = this;
    this.request = new Request(Object.merge({url: b, link: "cancel", onSuccess: function (g) {
        try {
            var f = JSON.decode(g)
        } catch (h) {
            return
        }
        d.queryResponse(f.response)
    }}, this.options.ajaxOptions))
}, queryResponse: function (a) {
    this.parent();
    this.update(a)
}});
Autocompleter.Request.HTML = new Class({Extends: Autocompleter.Request, initialize: function (c, b, a) {
    this.parent(c, a);
    this.request = new Request.HTML(Object.merge({url: b, link: "cancel", update: this.choices}, this.options.ajaxOptions)).addEvent("onComplete", this.queryResponse.bind(this))
}, queryResponse: function (a, b) {
    this.parent();
    if (!b || !b.length) {
        this.hideChoices()
    } else {
        this.choices.getChildren(this.options.choicesMatch).each(this.options.injectChoice || function (c) {
            var d = c.innerHTML;
            c.inputValue = d;
            this.addChoiceEvents(c.set("html", this.markQueryValue(d)))
        }, this);
        this.showChoices()
    }
}});
Autocompleter.Ajax = {Base: Autocompleter.Request, Json: Autocompleter.Request.JSON, Xhtml: Autocompleter.Request.HTML};
window.$w = function (a) {
    return Array.from(String(a).split(" "))
};
Function.implement({curry: function () {
    if (!arguments.length) {
        return this
    }
    var a = this;
    var b = Array.prototype.slice.call(Array.from(arguments), 0);
    return function () {
        return a.apply(this, b.concat(Array.from(arguments)))
    }
}, wrap: function (b) {
    var a = this;
    return function () {
        return b.apply(this, [a.bind(this)].concat(Array.from(arguments)))
    }
}});
Object.append(Object, {toHTML: function (a) {
    return a && a.toHTML ? a.toHTML() : (a == null ? "" : String(a))
}});
Array.implement({find: function (d, c) {
    var a;
    var b = d;
    if (c) {
        b = b.bind(c)
    }
    this.some(function (f, e, g) {
        if (b(f, e, g)) {
            a = f;
            return true
        }
        return false
    });
    return a
}, inject: function (b, a) {
    this.each(function (d, c, e) {
        b = a(b, d, c, e)
    });
    return b
}, invoke: function (a) {
    this.each(function (b) {
        if (b && b[a]) {
            b[a]()
        }
    });
    return this
}});
(function () {
    var a = Element.prototype;
    if (Browser.ie && Browser.version < 9) {
        a = Element.Prototype
    }
    Element.addClass = Element.addClass.wrap(function (d, c, b) {
        if (typeOf(b) != "array") {
            b = $w(b)
        }
        if (typeOf(b) == "array") {
            b.each(function (e) {
                d(e)
            })
        } else {
            d(b)
        }
        return c
    });
    a.addClass = a.addClass.wrap(function (c, b) {
        if (typeOf(b) != "array") {
            b = $w(b)
        }
        if (typeOf(b) == "array") {
            b.each(function (d) {
                c(d)
            })
        } else {
            c(b)
        }
        return this
    });
    Element.removeClass = Element.removeClass.wrap(function (d, c, b) {
        if (typeOf(b) != "array") {
            b = $w(b)
        }
        if (typeOf(b) == "array") {
            b.each(function (e) {
                d(e)
            })
        } else {
            d(b)
        }
        return c
    });
    a.removeClass = a.removeClass.wrap(function (c, b) {
        if (typeOf(b) != "array") {
            b = $w(b)
        }
        if (typeOf(b) == "array") {
            b.each(function (d) {
                c(d)
            })
        } else {
            c(b)
        }
        return this
    })
})();
Element.implement({disableSelection: function () {
    return this.setStyles({MozUserSelect: "none", KhtmlUserSelect: "none"}).setProperty("unselectable", "on")
}, down: function (a) {
    return this.getElement(a)
}, getSelectionEnd: function () {
    if (this.createTextRange) {
        var a = document.selection.createRange().duplicate();
        a.moveStart("character", -this.value.length);
        return a.text.length
    }
    return this.selectionEnd
}, getSelectionStart: function () {
    if (this.createTextRange) {
        var a = document.selection.createRange().duplicate();
        a.moveEnd("character", this.value.length);
        if (a.text == "") {
            return this.value.length
        }
        return this.value.lastIndexOf(a.text)
    }
    return this.selectionStart
}, insert: function (b) {
    var d = $(this);
    var c = {before: function (l, m) {
        l.parentNode.insertBefore(m, l)
    }, top: function (l, m) {
        l.insertBefore(m, l.firstChild)
    }, bottom: function (l, m) {
        l.appendChild(m)
    }, after: function (l, m) {
        l.parentNode.insertBefore(m, l.nextSibling)
    }, tags: {TABLE: ["<table>", "</table>", 1], TBODY: ["<table><tbody>", "</tbody></table>", 2], TR: ["<table><tbody><tr>", "</tr></tbody></table>", 3], TD: ["<table><tbody><tr><td>", "</td></tr></tbody></table>", 4], SELECT: ["<select>", "</select>", 1]}};
    var g = function (n, m) {
        var o = new Element("div"), l = c.tags[n];
        if (l) {
            o.innerHTML = l[0] + m + l[1];
            l[2].times(function () {
                o = o.firstChild
            })
        } else {
            o.innerHTML = m
        }
        return Array.from(o.childNodes)
    };
    if (typeof b == "string" || typeof b == "number" || (b.nodeName && b.nodeType == 1) || (b && (b.toElement || b.toHTML))) {
        b = {bottom: b}
    }
    var f, k, a, h;
    for (var e in b) {
        f = b[e];
        e = e.toLowerCase();
        k = c[e];
        if (f && f.toElement) {
            f = f.toElement()
        }
        if (f.nodeName && f.nodeType == 1) {
            k(d, f);
            continue
        }
        f = Object.toHTML(f);
        a = ((e == "before" || e == "after") ? d.parentNode : d).tagName.toUpperCase();
        h = g(a, f);
        if (e == "top" || e == "after") {
            h.reverse()
        }
        h.each(function (l) {
            k(d, l)
        });
        d.select("script").each(function (l) {
            Browser.exec(l.text)
        })
    }
    return d
}, next: function (a) {
    return this.getNext(a)
}, prev: function (a) {
    return this.getPrevious(a)
}, select: function (b) {
    var c = this;
    var a = [];
    Array.from(arguments).each(function (d) {
        var e = c.getElements(d);
        if (typeOf(e) == "elements") {
            a = a.concat(Array.from(e))
        }
    });
    return a
}, setSize: function (b, a) {
    if (b && b.$family && b.$family.name == "array") {
        a = b[1];
        b = b[0]
    } else {
        if (typeof b == "object") {
            if (typeof b.x == "number") {
                a = b.y;
                b = b.x
            } else {
                a = b.height;
                b = b.width
            }
        }
    }
    return this.setStyles({width: b, height: a})
}, serializeForm: function (a) {
    return Form.serialize(this, a)
}, up: function (a) {
    return this.getParent(a)
}, filterInput: function (a) {
    var b = a.regex;
    var d = this;

    function c(l) {
        var o = 0, h = 0, n, k, g, f, m;
        if (typeof l.selectionStart == "number" && typeof l.selectionEnd == "number") {
            o = l.selectionStart;
            h = l.selectionEnd
        } else {
            l.focus();
            k = document.selection.createRange();
            if (k && k.parentElement() == l) {
                f = l.value.length;
                n = l.value.replace(/\r\n/g, "\n");
                g = l.createTextRange();
                g.moveToBookmark(k.getBookmark());
                m = l.createTextRange();
                m.collapse(false);
                if (g.compareEndPoints("StartToEnd", m) > -1) {
                    o = h = f
                } else {
                    o = -g.moveStart("character", -f);
                    o += n.slice(0, o).split("\n").length - 1;
                    if (g.compareEndPoints("EndToEnd", m) > -1) {
                        h = f
                    } else {
                        h = -g.moveEnd("character", -f);
                        h += n.slice(0, h).split("\n").length - 1
                    }
                }
            }
        }
        return{start: o, end: h}
    }

    function e(n) {
        n = n || event;
        var l = d.get("value");
        var h = 0;
        var m = 0;
        if (n.type == "keypress") {
            h = n.event.charCode | h
        } else {
            m = n.event.keyCode | m
        }
        var g = c(n.target);
        if (h == 0 && m != 8 && m != 46) {
            return true
        }
        if (h == 0 && (m == 8 || m == 46)) {
            if (typeof(a.success) === "function") {
                var k = "";
                if (g.start == 0 && (g.end - g.start) > 0) {
                    k = l.substr(0, g.start - 1) + l.substr(g.end)
                } else {
                    if (g.end == l.length && (g.end - g.start) > 0) {
                        k = l.substr(0, g.start) + l.substr(g.end + 1)
                    } else {
                        if ((g.end - g.start) > 0) {
                            k = l.substr(0, g.start) + l.substr(g.end)
                        } else {
                            if ((g.end - g.start) == 0) {
                                if (m == 8) {
                                    k = l.substr(0, g.start - 1) + l.substr(g.end)
                                }
                                if (m == 46) {
                                    k = l.substr(0, g.start) + l.substr(g.end + 1)
                                }
                            }
                        }
                    }
                }
                return a.success.call(this, k)
            }
        }
        var o = l.substr(0, g.start);
        var f = l.substr(g.end);
        var l = o + String.fromCharCode(h) + f;
        if (h > 0 && b.test(l)) {
            if (typeof(a.success) === "function") {
                return a.success.call(this, l)
            }
            return true
        } else {
            if (typeof(a.failure) === "function") {
                return a.failure.call(this, l)
            }
        }
        return false
    }

    return(this.addEvent("keydown", e) && this.addEvent("keypress", e))
}});
var Form = (function () {
    function h(n) {
        switch (n.type.toLowerCase()) {
            case"checkbox":
            case"radio":
                return g(n);
            default:
                return e(n)
        }
    }

    function g(n) {
        return n.checked ? n.value : null
    }

    function e(n) {
        return n.value
    }

    function k(n) {
        return(n.type === "select-one" ? l : b)(n)
    }

    function l(o) {
        var n = o.selectedIndex;
        return n >= 0 ? f(o.options[n]) : null
    }

    function b(r) {
        var n, s = r.length;
        if (!s) {
            return null
        }
        for (var q = 0, n = []; q < s; q++) {
            var o = r.options[q];
            if (o.selected) {
                n.push(f(o))
            }
        }
        return n
    }

    function a(n, o) {
        return !!n.getAttribute(o)
    }

    function f(n) {
        return a(n, "value") ? n.value : n.text
    }

    var m = {input: h, inputSelector: g, textarea: e, select: k, selectOne: l, selectMany: b, optionValue: f, button: e};

    function c(n) {
        n = $(n);
        var o = n.tagName.toLowerCase();
        return m[o](n)
    }

    function d(r) {
        var s = $(r).getElementsByTagName("*"), q, n = [];
        for (var o = 0; q = s[o]; o++) {
            n.push(q)
        }
        return n.inject([], function (t, u) {
            if (m[u.tagName.toLowerCase()]) {
                t.push($(u))
            }
            return t
        })
    }

    return{serialize: function (o, w) {
        var n = d(o);
        if (typeof w != "object") {
            w = {}
        }
        var v, u, t = false, s = w.submit, q, r;
        r = {};
        q = function (x, y, z) {
            if (y in x) {
                if (typeOf(x[y]) == "array") {
                    x[y] = [x[y]]
                }
                x[y].push(z)
            } else {
                x[y] = z
            }
            return x
        };
        return n.inject(r, function (x, y) {
            if (!y.disabled && y.name) {
                v = y.name;
                u = c(y);
                if (u != null && y.type != "file" && (y.type != "submit" || (!t && s !== false && (!s || v == s) && (t = true)))) {
                    x = q(x, v, u)
                }
            }
            return x
        })
    }}
})();
Hash.implement({find: function (d, c) {
    var a;
    var b = d;
    if (c) {
        b = b.bind(c)
    }
    this.some(function (f, e, g) {
        if (b(f, e, g)) {
            a = f;
            return true
        }
        return false
    });
    return a
}, inject: function (b, a) {
    this.each(function (d, c, e) {
        b = a(b, d, c, e)
    });
    return b
}, invoke: function (a) {
    this.each(function (b) {
        if (b[a]) {
            b[a]()
        }
    });
    return this
}, ksort: function (c) {
    var b = this;
    var a = $H({});
    this.getKeys().sort(c).each(function (d) {
        a[d] = b[d]
    });
    return a
}, merge: function (a) {
    return $H(Object.merge({}, this.toObject(), a || {}))
}, sort: function (a) {
    return this.toArray().sort(a)
}, toArray: function () {
    var a = [];
    this.each(function (b) {
        a.push(b)
    });
    return a
}, toObject: function () {
    var a = {};
    this.each(function (c, b) {
        a[b] = c
    });
    return a
}});
Number.implement({isNaN: function () {
    return isNaN(this)
}, sgn: function () {
    if (this < 0) {
        return -1
    } else {
        if (this > 0) {
            return 1
        }
    }
    return 0
}});
String.implement({fromQueryString: function (b) {
    var c = this;
    var a = {};
    if (c.indexOf("?") != -1) {
        c = c.substr(c.indexOf("?") + 1)
    }
    a = $H(Array.from(c.split("&")).inject({}, function (d, e) {
        e = e.split("=");
        if (e.length == 2) {
            d[e[0]] = e[1]
        }
        return d
    }));
    if (a && a.toObject && b) {
        a = a.toObject()
    }
    return a
}, leftPad: function (b, c) {
    var a = new String(this);
    if (!c) {
        c = " "
    }
    while (a.length < b) {
        a = c + a
    }
    return a.toString()
}, stripTags: function () {
    return this.replace(/<\/?[^>]+>/gi, "")
}, substituteWithoutReplacingUndefinedKeys: function (a, b) {
    return this.replace(b || (/\\?\{([^{}]+)\}/g), function (d, c) {
        if (d.charAt(0) == "\\") {
            return d.slice(1)
        }
        return(a[c] != undefined) ? a[c] : "{" + c + "}"
    })
}, unescapeHtml: function () {
    var b = new Element("div");
    b.innerHTML = this.stripTags();
    if (!b.childNodes[0]) {
        return""
    }
    if (b.childNodes.length > 1) {
        var a = "";
        Array.from(b.childNodes).each(function (c) {
            return a + c.nodeValue
        });
        return a
    } else {
        return b.childNodes[0].nodeValue
    }
}});
Element.NativeEvents = Object.append(Element.NativeEvents, {touchstart: 2, touchend: 2, touchmove: 2, touchcancel: 2, gesturechange: 2, gestureend: 2});
Element.inject = Element.inject.wrap(function (f, b, d, c) {
    var a = f(b, d, c);
    var e;
    if (typeof a != "undefined" && (typeOf(e = a.select("script")) == "array")) {
        e.each(function (g) {
            Browser.exec(g.text)
        })
    }
    return a
});
Element.prototype.inject = Element.prototype.inject.wrap(function (f, b, d, c) {
    var a = f(b, d, c);
    var e;
    if (typeof a != "undefined" && (typeOf(e = a.select("script")) == "array")) {
        e.each(function (g) {
            Browser.exec(g.text)
        })
    }
    return a
});
Element.grab = Element.grab.wrap(function (e, c, b, f) {
    if (typeof f === "undefined") {
        f = true
    }
    var a = e(c, b, f);
    var d;
    if (f && typeof a != "undefined" && (typeOf(d = a.select("script")) == "array")) {
        d.each(function (g) {
            Browser.exec(g.text)
        })
    }
    return a
});
Element.prototype.grab = Element.prototype.grab.wrap(function (e, c, b, f) {
    if (typeof f === "undefined") {
        f = true
    }
    var a = e(c, b, f);
    var d;
    if (f && typeof a != "undefined" && (typeOf(d = a.select("script")) == "array")) {
        d.each(function (g) {
            Browser.exec(g.text)
        })
    }
    return a
});
(function () {
    function a(f) {
        var e, d, c = "", g = String.fromCharCode;
        f = f.replace(/\r\n/g, "\n");
        for (e = 0; d = f.charCodeAt(e); e++) {
            if (d < 128) {
                c += g(d)
            } else {
                if ((d > 127) && (d < 2048)) {
                    c += g((d >> 6) | 192);
                    c += g((d & 63) | 128)
                } else {
                    c += g((d >> 12) | 224);
                    c += g(((d >> 6) & 63) | 128);
                    c += g((d & 63) | 128)
                }
            }
        }
        return c
    }

    function b(f) {
        var d = 0, c = "", h = 0, g = 0, e = 0;
        while (d < f.length) {
            h = f.charCodeAt(d);
            if (h < 128) {
                c += String.fromCharCode(h);
                d++
            } else {
                if ((h > 191) && (h < 224)) {
                    g = f.charCodeAt(d + 1);
                    c += String.fromCharCode(((h & 31) << 6) | (g & 63));
                    d += 2
                } else {
                    g = f.charCodeAt(d + 1);
                    e = f.charCodeAt(d + 2);
                    c += String.fromCharCode(((h & 15) << 12) | ((g & 63) << 6) | (e & 63));
                    d += 3
                }
            }
        }
        return c
    }

    String.implement({toUTF8: function () {
        return a(this)
    }, fromUTF8: function () {
        return b(this)
    }})
})();
(function () {
    var b = {f: function (f, e, g) {
        return(f & e) | ((~f) & g)
    }, g: function (f, e, g) {
        return(f & g) | (e & (~g))
    }, h: function (f, e, g) {
        return(f ^ e ^ g)
    }, i: function (f, e, g) {
        return(e ^ (f | (~g)))
    }, rotateLeft: function (f, e) {
        return(f << e) | (f >>> (32 - e))
    }, addUnsigned: function (h, g) {
        var k = (h & 2147483648), l = (g & 2147483648), m = (h & 1073741824), f = (g & 1073741824), e = (h & 1073741823) + (g & 1073741823);
        if (m & f) {
            return(e ^ 2147483648 ^ k ^ l)
        }
        if (m | f) {
            if (e & 1073741824) {
                return(e ^ 3221225472 ^ k ^ l)
            } else {
                return(e ^ 1073741824 ^ k ^ l)
            }
        } else {
            return(e ^ k ^ l)
        }
    }, compound: function (s, r, q, o, n, m, l, k) {
        var v = b, u = v.addUnsigned, t = u(r, u(u(v[s](q, o, n), l), m));
        return u(v.rotateLeft(t, k), q)
    }};

    function a(f) {
        var h = f.length, m = (((h + 8) - ((h + 8) % 64)) / 64 + 1) * 16, g = new Array(), e, l, k = 0;
        while (k < h) {
            e = (k - (k % 4)) / 4;
            l = (k % 4) * 8;
            g[e] = (g[e] | (f.charCodeAt(k) << l));
            k++
        }
        e = (k - (k % 4)) / 4;
        l = (k % 4) * 8;
        g[e] = g[e] | (128 << l);
        g[m - 2] = h << 3;
        g[m - 1] = h >>> 29;
        return g
    }

    function d(g) {
        var e = "", f, k, h;
        for (h = 0; h <= 3; h++) {
            k = (g >>> (h * 8)) & 255;
            f = "0" + k.toString(16);
            e = e + f.substr(f.length - 2, 2)
        }
        return e
    }

    function c(f) {
        var A, y, w, v, z = a(f.toUTF8()), G = 1732584193, E = 4023233417, D = 2562383102, C = 271733878, m = 7, l = 12, h = 17, g = 22, e = 5, J = 9, I = 14, H = 20, F = 4, u = 11, t = 16, s = 23, r = 6, q = 10, o = 15, n = 21;
        for (var B = 0; B < z.length; B += 16) {
            A = G;
            y = E;
            w = D;
            v = C;
            G = b.compound("f", G, E, D, C, 3614090360, z[B + 0], m);
            C = b.compound("f", C, G, E, D, 3905402710, z[B + 1], l);
            D = b.compound("f", D, C, G, E, 606105819, z[B + 2], h);
            E = b.compound("f", E, D, C, G, 3250441966, z[B + 3], g);
            G = b.compound("f", G, E, D, C, 4118548399, z[B + 4], m);
            C = b.compound("f", C, G, E, D, 1200080426, z[B + 5], l);
            D = b.compound("f", D, C, G, E, 2821735955, z[B + 6], h);
            E = b.compound("f", E, D, C, G, 4249261313, z[B + 7], g);
            G = b.compound("f", G, E, D, C, 1770035416, z[B + 8], m);
            C = b.compound("f", C, G, E, D, 2336552879, z[B + 9], l);
            D = b.compound("f", D, C, G, E, 4294925233, z[B + 10], h);
            E = b.compound("f", E, D, C, G, 2304563134, z[B + 11], g);
            G = b.compound("f", G, E, D, C, 1804603682, z[B + 12], m);
            C = b.compound("f", C, G, E, D, 4254626195, z[B + 13], l);
            D = b.compound("f", D, C, G, E, 2792965006, z[B + 14], h);
            E = b.compound("f", E, D, C, G, 1236535329, z[B + 15], g);
            G = b.compound("g", G, E, D, C, 4129170786, z[B + 1], e);
            C = b.compound("g", C, G, E, D, 3225465664, z[B + 6], J);
            D = b.compound("g", D, C, G, E, 643717713, z[B + 11], I);
            E = b.compound("g", E, D, C, G, 3921069994, z[B + 0], H);
            G = b.compound("g", G, E, D, C, 3593408605, z[B + 5], e);
            C = b.compound("g", C, G, E, D, 38016083, z[B + 10], J);
            D = b.compound("g", D, C, G, E, 3634488961, z[B + 15], I);
            E = b.compound("g", E, D, C, G, 3889429448, z[B + 4], H);
            G = b.compound("g", G, E, D, C, 568446438, z[B + 9], e);
            C = b.compound("g", C, G, E, D, 3275163606, z[B + 14], J);
            D = b.compound("g", D, C, G, E, 4107603335, z[B + 3], I);
            E = b.compound("g", E, D, C, G, 1163531501, z[B + 8], H);
            G = b.compound("g", G, E, D, C, 2850285829, z[B + 13], e);
            C = b.compound("g", C, G, E, D, 4243563512, z[B + 2], J);
            D = b.compound("g", D, C, G, E, 1735328473, z[B + 7], I);
            E = b.compound("g", E, D, C, G, 2368359562, z[B + 12], H);
            G = b.compound("h", G, E, D, C, 4294588738, z[B + 5], F);
            C = b.compound("h", C, G, E, D, 2272392833, z[B + 8], u);
            D = b.compound("h", D, C, G, E, 1839030562, z[B + 11], t);
            E = b.compound("h", E, D, C, G, 4259657740, z[B + 14], s);
            G = b.compound("h", G, E, D, C, 2763975236, z[B + 1], F);
            C = b.compound("h", C, G, E, D, 1272893353, z[B + 4], u);
            D = b.compound("h", D, C, G, E, 4139469664, z[B + 7], t);
            E = b.compound("h", E, D, C, G, 3200236656, z[B + 10], s);
            G = b.compound("h", G, E, D, C, 681279174, z[B + 13], F);
            C = b.compound("h", C, G, E, D, 3936430074, z[B + 0], u);
            D = b.compound("h", D, C, G, E, 3572445317, z[B + 3], t);
            E = b.compound("h", E, D, C, G, 76029189, z[B + 6], s);
            G = b.compound("h", G, E, D, C, 3654602809, z[B + 9], F);
            C = b.compound("h", C, G, E, D, 3873151461, z[B + 12], u);
            D = b.compound("h", D, C, G, E, 530742520, z[B + 15], t);
            E = b.compound("h", E, D, C, G, 3299628645, z[B + 2], s);
            G = b.compound("i", G, E, D, C, 4096336452, z[B + 0], r);
            C = b.compound("i", C, G, E, D, 1126891415, z[B + 7], q);
            D = b.compound("i", D, C, G, E, 2878612391, z[B + 14], o);
            E = b.compound("i", E, D, C, G, 4237533241, z[B + 5], n);
            G = b.compound("i", G, E, D, C, 1700485571, z[B + 12], r);
            C = b.compound("i", C, G, E, D, 2399980690, z[B + 3], q);
            D = b.compound("i", D, C, G, E, 4293915773, z[B + 10], o);
            E = b.compound("i", E, D, C, G, 2240044497, z[B + 1], n);
            G = b.compound("i", G, E, D, C, 1873313359, z[B + 8], r);
            C = b.compound("i", C, G, E, D, 4264355552, z[B + 15], q);
            D = b.compound("i", D, C, G, E, 2734768916, z[B + 6], o);
            E = b.compound("i", E, D, C, G, 1309151649, z[B + 13], n);
            G = b.compound("i", G, E, D, C, 4149444226, z[B + 4], r);
            C = b.compound("i", C, G, E, D, 3174756917, z[B + 11], q);
            D = b.compound("i", D, C, G, E, 718787259, z[B + 2], o);
            E = b.compound("i", E, D, C, G, 3951481745, z[B + 9], n);
            G = b.addUnsigned(G, A);
            E = b.addUnsigned(E, y);
            D = b.addUnsigned(D, w);
            C = b.addUnsigned(C, v)
        }
        return(d(G) + d(E) + d(D) + d(C)).toLowerCase()
    }

    String.implement({toMD5: function () {
        return c(this)
    }})
})();
if (Browser.ie) {
    Element.implement({insertAtCursor: function (b, a) {
        var d = this.getSelectedRange();
        if (d.start == 0 && d.end == 0) {
            this.focus();
            sel = document.selection.createRange();
            sel.text = b;
            this.focus();
            return this
        }
        var c = this.get("value");
        this.set("value", c.substring(0, d.start) + b + c.substring(d.end, c.length));
        if (Array.pick(a, true)) {
            this.selectRange(d.start, d.start + b.length)
        } else {
            this.setCaretPosition(d.start + b.length)
        }
        return this
    }, insertAroundCursor: function (b, a) {
        b = Object.append({before: "", defaultMiddle: "", after: ""}, b);
        var c = this.getSelectedText() || b.defaultMiddle;
        var g = this.getSelectedRange();
        if (g.start == 0 && g.end == 0) {
            this.focus();
            sel = document.selection.createRange();
            sel.text = b.before + b.after;
            this.focus();
            return this
        }
        var f = this.get("value");
        if (g.start == g.end) {
            this.set("value", f.substring(0, g.start) + b.before + c + b.after + f.substring(g.end, f.length));
            this.selectRange(g.start + b.before.length, g.end + b.before.length + c.length)
        } else {
            var d = f.substring(g.start, g.end);
            this.set("value", f.substring(0, g.start) + b.before + d + b.after + f.substring(g.end, f.length));
            var e = g.start + b.before.length;
            if (Array.pick(a, true)) {
                this.selectRange(e, e + d.length)
            } else {
                this.setCaretPosition(e + f.length)
            }
        }
        return this
    }})
}
(function () {
    var e = "1.2.4";
    var s = false;
    var l = [];
    var w = function (B) {
        var C = B.split(".");
        return parseInt(C[0]) * 100000 + parseInt(C[1]) * 1000 + parseInt(C[2])
    };
    if (typeof MooTools == "undefined" || w(MooTools.version) < w(e)) {
        throw ("jScroll requires the MooTools JavaScript framework >= " + e);
        return
    }
    var o = /jScroll\.js(\?.*)?$/;
    var c = null;
    var u = $$("head script[src]").find(function (B) {
        if (c == null) {
            c = B
        }
        return B.src.match(o)
    });
    if (u) {
        u = u.src.replace(o, "")
    } else {
        u = c.src.replace(o, "")
    }
    var a = function (B) {
        if (!s) {
            window.addEvent("domready", function () {
                s = true;
                B()
            })
        } else {
            B.bind(window)()
        }
    };
    var x = function (B) {
        if (B < 0) {
            B = 0
        } else {
            if (B > 100) {
                B = 100
            }
        }
        return B
    };
    var f = function (D) {
        if ($(document.body).getStyle("direction").toLowerCase() == "rtl") {
            D = D.replace(/left/g, "#left#");
            D = D.replace(/ltr/g, "#ltr#");
            D = D.replace(/right/g, "left");
            D = D.replace(/rtl/g, "ltr");
            D = D.replace(/#left#/g, "right");
            D = D.replace(/#ltr#/g, "rtl")
        }
        var B = function () {
            var E = /^[\s\n\r]+|[\s\n\r]+$/g;
            return function (F) {
                return F.replace(E, "")
            }
        }();
        var C = function (E, I) {
            if (E.indexOf(",") != -1) {
                E.split(",").each(function (J) {
                    C(B(J), I)
                });
                return
            }
            var H = $("jScroll.css");
            if (!H) {
                var H = document.createElement("style");
                H.setAttribute("type", "text/css");
                H.setAttribute("media", "screen");
                H.setAttribute("id", "jScroll.css");
                Element.insert(document.getElementsByTagName("head")[0], {top: H})
            }
            if (typeof I != "string") {
                var F = "";
                Object.each(I, function (K, J) {
                    F + J.hyphenate() + ":" + K, J
                });
                I = F
            }
            if (!Browser.ie || (Browser.ie && Browser.version >= 9)) {
                H.appendChild(document.createTextNode(E + " {" + I + "}\n"))
            }
            if (Browser.ie && Browser.version < 9 && document.styleSheets && document.styleSheets.length > 0) {
                var G = document.styleSheets[0];
                if (typeof(G.addRule) == "object") {
                    G.addRule(E, I)
                }
            }
        };
        D.replace(/[\n\r]/gi, "").split("}").each(function (E) {
            E = E.split("{");
            if (E.length < 2 || B(E[0]) == 0 || B(E[1]) == 0) {
                return
            }
            C(B(E[0]), B(E[1]))
        })
    };
    var d = function (B) {
        B.container = $(B.container);
        if (!B.container || !B.container.nodeName || B.container.nodeType != 1) {
            throw ("Missing scroll container for jScroll!")
        }
        if (B.container.tagName != "DIV") {
            throw ("invalid scroll container for jScroll! Can only be a div")
        }
        B.container._jScroll = B;
        b(B.container);
        if (z(B, "onRenderBefore") === false) {
            return
        }
        if (B.rendered) {
            return
        }
        B.rendered = true;
        B.container.setStyles({overflow: "hidden"});
        var D = B.container.getChildren();
        D.each(function (E) {
            E.dispose()
        });
        B.container.innerHTML = "";
        Element.insert(B.container, {bottom: '<div class="jScroll"><div class="jScroll-content"></div><div class="jScroll-scroll ' + B.options.clsScroll + '"><div class="jScroll-scroll-up"><div class="' + B.options.clsUp + '"></div></div><div class="jScroll-scroll-between ' + B.options.clsBetween + '"></div><div class="jScroll-scroll-slider ' + B.options.clsSlider + '"><div class="' + B.options.clsSlider + ' top"></div><div class="' + B.options.clsSlider + ' center"></div><div class="' + B.options.clsSlider + ' bottom"></div></div><div class="jScroll-scroll-between ' + B.options.clsBetween + '"></div><div class="jScroll-scroll-down"><div class="' + B.options.clsDown + '"></div></div></div></div>'});
        B.element = B.container.down(".jScroll");
        B.elementContent = B.container.down(".jScroll-content");
        B.elementScroll = B.container.down(".jScroll-scroll");
        B.elementUp = B.container.down(".jScroll-scroll-up");
        B.elementUpBetween = B.container.down(".jScroll-scroll-between", 0);
        B.elementSlider = B.container.down(".jScroll-scroll-slider");
        B.elementSliderTop = B.elementSlider.down(".top");
        B.elementSliderCenter = B.elementSlider.down(".center");
        B.elementSliderBottom = B.elementSlider.down(".bottom");
        B.elementDownBetween = B.container.down(".jScroll-scroll-between", 1);
        B.elementDown = B.container.down(".jScroll-scroll-down");
        D.each(function (E) {
            Element.insert(B.elementContent, {bottom: E})
        });
        var C = 0;
        B.elementScroll.addEvent("mousedown", function (E) {
            B._sliderScroll = true;
            E.stop();
            m(function () {
                if (y(B.elementSlider) <= C && C <= y(B.elementSlider) + B.elementSlider.getSize().y) {
                    return
                }
                var F = C - y(B.elementSlider);
                if (F < 0) {
                    B.elementUpBetween.addClass(B.options.clsBetweenClicked);
                    B.elementDownBetween.removeClass(B.options.clsBetweenClicked)
                } else {
                    B.elementUpBetween.removeClass(B.options.clsBetweenClicked);
                    B.elementDownBetween.addClass(B.options.clsBetweenClicked)
                }
                B.scroll((F < 0 ? -1 : 1) * B.stepLarge)
            }, B)
        });
        B.elementUp.addEvent("mousedown", function (E) {
            B._sliderScroll = true;
            E.stop();
            m(B.up.pass([B.stepSmall, B], B), B)
        });
        B.elementDown.addEvent("mousedown", function (E) {
            B._sliderScroll = true;
            E.stop();
            m(B.down.pass([B.stepSmall], B), B)
        });
        B.elementSlider.addEvent("mousedown", function (E) {
            E.stop();
            B._sliderMove = true;
            B._sliderY = E.page.y - parseFloat(B.elementSlider.getStyle("top")) + B.elementUp.getSize().y
        });
        document.addEvent("mousemove", function (F) {
            C = F.page.y;
            if (!B._sliderMove) {
                return
            }
            F.stop();
            var E = (F.page.y - B._sliderY) * 100 / B.sliderHeight;
            if (z(B, "onScrollSlideBefore", E) === false) {
                return
            }
            B.update(E);
            z(B, "onScrollSlideAfter")
        });
        document.addEvent("mouseup", function (E) {
            if (B._sliderMove || B._sliderScroll) {
                E.stop();
                B._sliderMove = false;
                B._sliderScroll = false;
                A(B);
                B.elementUpBetween.removeClass(B.options.clsBetweenClicked);
                B.elementDownBetween.removeClass(B.options.clsBetweenClicked);
                B.elementDownBetween.removeClass(B.options.clsBetweenClicked)
            }
        });
        B.element.addEvent("mousewheel", function (E) {
            E.stop();
            B.scroll(-E.wheel * (E.alt ? B.stepSmall : B.stepLarge))
        });
        B.refresh();
        z(B, "onRenderAfter")
    };
    var z = function (C, B, E) {
        if (typeof C.options[B] != "function") {
            return true
        }
        if (typeof E != "undefined") {
            E = x(E);
            if (C.current == E) {
                return false
            }
            var G = C.options[B].pass([C, C.current, E])
        } else {
            var G = C.options[B].pass([C])
        }
        try {
            return G()
        } catch (D) {
            if (Browser.firefox) {
                var F = D.name + " in " + D.fileName + " #" + D.lineNumber + " : " + D.message
            } else {
                if (Browser.ie) {
                    var F = D.name + " " + D.number + " : " + D.message
                } else {
                    if (Browser.chrome || Browser.safari) {
                        var F = D.name + " in " + D.sourceURL + " #" + D.line + " : " + D.message
                    } else {
                        var F = JSON.encode(D)
                    }
                }
            }
            return
        }
    };
    var m = function (C, B) {
        A(B);
        C.bind(B)();
        B._pe = C.periodical(50, B)
    };
    var A = function (B) {
        if (B._pe) {
            clearInterval(B._pe)
        }
    };
    var b = function (B) {
        l.push(B);
        return l
    };
    window.jScroll = new Class({current: 0, container: null, element: null, elementContent: null, elementDown: null, elementScroll: null, elementSlider: null, elementUp: null, enabled: false, options: null, rendered: false, stepLarge: 10, stepSmall: 1, applyContent: function (B) {
        this.elementContent.innerHTML = "";
        Element.insert(this.elementContent, B);
        this.refresh();
        this.update();
        return this
    }, down: function (B) {
        if (typeof B == "undefined") {
            B = this.options.scrollSmall
        }
        if (z(this, "onScrollDownBefore", this.current + B) === false) {
            return this
        }
        this.scroll(B);
        z(this, "onScrollDownAfter");
        return this
    }, initialize: function (B) {
        if (typeof B.container == "undefined") {
            throw ("Missing container in options for jScroll!")
        }
        this.container = B.container;
        this.options = B;
        this.options.clsBetween = this.options.clsBetween || "jScroll-element-between";
        this.options.clsBetweenClicked = this.options.clsBetweenClicked || "clicked";
        this.options.clsDown = this.options.clsDown || "jScroll-element-down";
        this.options.clsScroll = this.options.clsScroll || "jScroll-element-scroll";
        this.options.clsSlider = this.options.clsSlider || "jScroll-element-slider";
        this.options.clsUp = this.options.clsUp || "jScroll-element-up";
        this.options.lines = this.options.lines || 10;
        this.options.alignRight = typeof this.options.alignRight != "undefined" ? this.options.alignRight : "auto";
        if (!s) {
            a(d.pass([this]))
        } else {
            d(this)
        }
    }, insertContent: function (B) {
        Element.insert(this.elementContent, B);
        this.refresh();
        this.update();
        return this
    }, refresh: function () {
        var G = true;
        var E = null;
        var D = null;
        if (!this.rendered) {
            return this
        }
        if (this.container.isDisplayed() === false) {
            G = false;
            this.container.setStyles({display: "block"})
        }
        E = this.elementContent.getSize().y;
        D = parseInt(this.container.getStyle("max-height"));
        if (D > 0) {
            this.container.setStyles({height: E <= D ? E : D})
        }
        this.elementContent.setStyles({height: "auto"});
        E = this.elementContent.getSize().y;
        if (E <= this.element.getSize().y) {
            this.enabled = false;
            this.container.setStyles({overflow: ""});
            this.elementScroll.hide();
            this.elementContent.setStyles({marginTop: 0, right: ""});
            if (G === false) {
                this.container.setStyles({display: ""})
            }
            return this
        }
        this.enabled = true;
        this.elementScroll.show();
        this.container.setStyles({overflow: "hidden"});
        if ($(document.body).getStyle("direction").toLowerCase() == "ltr") {
            this.elementContent.setStyles({marginTop: 0, right: this.options.alignRight == "auto" ? this.elementScroll.getSize().x + "px" : this.options.alignRight})
        } else {
            this.elementContent.setStyles({marginTop: 0, left: this.options.alignRight == "auto" ? this.elementScroll.getSize().x + "px" : this.options.alignRight})
        }
        this.sliderTop = this.elementUp.getSize().y - q(this.elementUp, "tb");
        this.sliderHeight = this.elementScroll.getSize().y - this.elementUp.getSize().y - q(this.elementUp, "tb") - this.elementDown.getSize().y - q(this.elementDown, "tb");
        var C = this.element.getSize().y;
        var F = this.elementContent.getSize().y;
        this.contentHeight = F - C;
        this.stepSmall = C * 100 / (this.options.lines * F);
        this.stepLarge = this.stepSmall * this.options.lines;
        var B = (this.sliderHeight * C / F);
        if (B < this.elementSliderTop.getSize().y + this.elementSliderBottom.getSize().y) {
            B = this.elementSliderTop.getSize().y + this.elementSliderBottom.getSize().y
        }
        this.elementSlider.setStyles({height: B, top: this.sliderTop});
        this.elementSliderCenter.setStyles({height: (B - this.elementSliderTop.getSize().y - this.elementSliderBottom.getSize().y)});
        this.elementContent.setStyles({height: "100%"});
        this.elementUpBetween.setStyles({top: this.sliderTop, height: 0});
        this.elementDownBetween.setStyles({top: (this.sliderTop + this.sliderHeight * this.current / 100 + this.elementSlider.getSize().y), bottom: this.elementDown.getSize().y});
        this.sliderHeight -= B;
        if (G === false) {
            this.container.setStyles({display: ""})
        }
        return this
    }, scroll: function (B) {
        if (typeof B == "undefined" || B == 0 || (B < 0 && this.current <= 0) || (B > 0 && this.current >= 100)) {
            return this
        }
        if (z(this, "onScrollBefore", this.current + B) === false) {
            return this
        }
        this.current += B;
        this.update();
        z(this, "onScrollAfter");
        return this
    }, scrollTo: function (K) {
        var I = this;
        var E = null;
        var B = false;
        var F = "view";
        var H = 0;
        if (typeOf(K) == "element") {
            E = K
        } else {
            E = K.element;
            B = K.animate;
            F = K.position
        }
        E = $(E);
        if (!E || !E.getParents().find(function (L) {
            return L == I.elementContent
        })) {
            return this
        }
        var D = y(this.elementContent);
        var J = this.elementContent.getSize().y;
        var C = y(E);
        var G = E.getSize().y;
        switch (F) {
            case"top":
                H = (C - D) * 100 / this.contentHeight;
                break;
            case"view":
            default:
                H = (C - D - this.sliderHeight / 2) * 100 / this.contentHeight;
                break
        }
        if (z(this, "onScrollBefore", H) === false) {
            return this
        }
        this.update(H, B);
        z(this, "onScrollAfter");
        return this
    }, up: function (B) {
        if (typeof B == "undefined") {
            B = this.options.scrollSmall
        }
        if (z(this, "onScrollUpBefore", this.current - B) === false) {
            return this
        }
        this.scroll(-1 * B);
        z(this, "onScrollUpAfter");
        return this
    }, update: function (C, B) {
        B = typeof B == "undefined" ? false : B;
        if (!this.rendered || !this.enabled) {
            return this
        }
        if (typeof C != "undefined") {
            this.current = C
        }
        this.current = x(this.current);
        z(this, "onUpdateBefore");
        this.elementSlider.setStyles({top: (this.sliderTop + this.sliderHeight * this.current / 100)});
        if (B) {
            new Fx.Morph(this.elementContent).start({marginTop: (-1 * this.contentHeight * this.current / 100)})
        } else {
            this.elementContent.setStyles({marginTop: (-1 * this.contentHeight * this.current / 100)})
        }
        this.elementUpBetween.setStyles({height: (this.sliderTop + this.sliderHeight * this.current / 100 - this.elementUp.getSize().y)});
        this.elementDownBetween.setStyles({top: (this.sliderTop + this.sliderHeight * this.current / 100 + this.elementSlider.getSize().y)});
        z(this, "onUpdateAfter");
        return this
    }});
    jScroll.$ = function (C) {
        var B = $(C);
        if (!B && typeof C == "string") {
            B = l.find(function (D) {
                return D.id == C
            })
        } else {
            if (B && typeof B._jScroll != "undefined") {
                B = B._jScroll
            } else {
                if (B && typeof B._jScroll == "undefined") {
                    B = null
                }
            }
        }
        return(B ? B : null)
    };
    var k = document.compatMode == "CSS1Compat";
    var r = function (F, H, G) {
        var I = 0, D, C;
        F = $(F);
        for (var E = 0, B = H.length; E < B; E++) {
            D = F.getStyle(G[H.charAt(E)]);
            if (D) {
                C = parseInt(D, 10);
                if (C) {
                    I += (C >= 0 ? C : -1 * C)
                }
            }
        }
        return I
    };
    var g = function (C, B) {
        C = $(C);
        return r(C, B, {l: "border-left-width", r: "border-right-width", t: "border-top-width", b: "border-bottom-width"})
    };
    var t = function (C) {
        var D = null;
        C = $(C);
        var B = 0;
        C.getChildren().each(function (F, E) {
            if (F.nodeType != 1) {
                if (E == 0) {
                    D = F
                }
                return
            }
            F = $(F);
            if (D) {
                B += F.offsetTop - C.offsetTop;
                D = null
            }
            return B + F.getSize().y + h(F, "tb")
        });
        return B
    };
    var q = function (C, D, B) {
        C = $(C);
        return B && Browser.ie && !k ? 0 : (v(C, D) + g(C, D))
    };
    var h = function (C, B) {
        C = $(C);
        if (!B) {
            return{top: parseInt(C.getStyle("margin-top"), 10) || 0, left: parseInt(C.getStyle("margin-left"), 10) || 0, bottom: parseInt(C.getStyle("margin-bottom"), 10) || 0, right: parseInt(C.getStyle("margin-right"), 10) || 0}
        } else {
            return r(C, B, {l: "margin-left", r: "margin-right", t: "margin-top", b: "margin-bottom"})
        }
    };
    var v = function (C, B) {
        C = $(C);
        return r(C, B, {l: "padding-left", r: "padding-right", t: "padding-top", b: "padding-bottom"})
    };
    var n = function (D) {
        D = $(D);
        var F = D, E = document;
        if (F == E || F == E.body) {
            var B, C;
            if (Browser.ie && k) {
                B = E.documentElement.scrollLeft || (E.body.scrollLeft || 0);
                C = E.documentElement.scrollTop || (E.body.scrollTop || 0)
            } else {
                B = window.pageXOffset || (E.body.scrollLeft || 0);
                C = window.pageYOffset || (E.body.scrollTop || 0)
            }
            return{left: B, top: C}
        } else {
            return{left: F.scrollLeft, top: F.scrollTop}
        }
    };
    var y = function (B) {
        B = $(B);
        var W, S, Q, G, T = (document.body || document.documentElement);
        if (B == T) {
            return 0
        }
        if (B.getBoundingClientRect) {
            Q = B.getBoundingClientRect();
            G = n($(document.body));
            return Q.top + G.top
        }
        var D = 0, R = 0;
        W = B;
        var X = B.getStyle("position") == "absolute";
        while (W) {
            $(W);
            D += W.offsetLeft;
            R += W.offsetTop;
            if (!X && W.getStyle("position") == "absolute") {
                X = true
            }
            if (Browser.firefox) {
                S = W;
                var C = parseInt(S.getStyle("borderTopWidth"), 10) || 0;
                var V = parseInt(S.getStyle("borderLeftWidth"), 10) || 0;
                D += V;
                R += C;
                if (W != B && S.getStyle("overflow") != "visible") {
                    D += V;
                    R += C
                }
            }
            W = W.offsetParent
        }
        if ((Browser.chrome || Browser.safari) && X) {
            D -= T.offsetLeft;
            R -= T.offsetTop
        }
        if (Browser.firefox && !X) {
            var U = $(T);
            D += parseInt(U.getStyle("borderLeftWidth"), 10) || 0;
            R += parseInt(U.getStyle("borderTopWidth"), 10) || 0
        }
        W = B.parentNode;
        while (W && W != T) {
            if (!Prototype.Browser.Opera || (W.tagName != "TR" && $(W).getStyle("display") != "inline")) {
                D -= W.scrollLeft;
                R -= W.scrollTop
            }
            W = W.parentNode
        }
        return R
    };
    a(function () {
    });
    window.addEvent("domready", function () {
        f(".jScroll {overflow: hidden; width: 100%; height: 100%;position:relative;}.jScroll .jScroll-content {position: absolute; top: 0px; left: 0px;}.jScroll .jScroll-scroll {cursor:pointer; position: absolute; height: 100%; right: 0px; top: 0px;}.jScroll .jScroll-scroll-up, .jScroll .jScroll-scroll-slider, .jScroll .jScroll-scroll-down, .jScroll .jScroll-scroll-between {position: absolute; width: 100%;}.jScroll .jScroll-scroll-slider {top: 10px; height: 50px;}.jScroll .jScroll-scroll-slider .top, .jScroll .jScroll-scroll-slider .center, .jScroll .jScroll-scroll-slider .bottom {width: 100%;}.jScroll .jScroll-scroll-between {}.jScroll .jScroll-scroll-down {bottom: 0px;}.jScroll .jScroll-element-scroll {width: 15px;}.jScroll .jScroll-element-down {background: transparent url(" + u + "images/down.gif) no-repeat center bottom; height: 6px;}.jScroll .jScroll-element-down:hover {background-image: url(" + u + "images/down-hover.gif);}.jScroll .jScroll-element-up {background: transparent url(" + u + "images/up.gif) no-repeat center top; height: 6px;}.jScroll .jScroll-element-up:hover {background-image: url(" + u + "images/up-hover.gif);}.jScroll .jScroll-element-between {margin-left: 4px; width: 7px; opacity: 0; background-color: #000000; filter: alpha(opacity=0);}.jScroll .jScroll-element-between:hover {opacity: 0.25; filter: alpha(opacity=25);}.jScroll .jScroll-element-between.clicked {opacity: 0.5; filter: alpha(opacity=50);}.jScroll .jScroll-element-slider .top {background: transparent url(" + u + "images/slider-top.gif) no-repeat center top; height: 1px;}.jScroll .jScroll-element-slider:hover .top {background-image: url(" + u + "images/slider-top-hover.gif);}.jScroll .jScroll-element-slider .center {background: transparent url(" + u + "images/slider-center.gif) repeat-y center top;}.jScroll .jScroll-element-slider:hover .center {background-image: url(" + u + "images/slider-center-hover.gif);}.jScroll .jScroll-element-slider .bottom {background: transparent url(" + u + "images/slider-bottom.gif) no-repeat center bottom; height: 1px;}.jScroll .jScroll-element-slider:hover .bottom {background-image: url(" + u + "images/slider-bottom-hover.gif);}")
    })
})();
window.Travian = {applicationId: "travian", emptyFunction: function () {
}, $d: function (b) {
    if (window.console && window.console.info) {
        if (Browser.ie) {
            console.info(JSON.encode(b))
        } else {
            console.info(b)
        }
    } else {
        if (!$("travian_console")) {
            var a = new Element("div", {id: "travian_console", styles: {position: "absolute", left: 0, height: 150, width: "100%", bottom: 0, zIndex: 10000, overflow: "auto", overflowX: "hidden", overflowY: "auto", borderTop: "1px solid #A06060", backgroundColor: "#FFD0D0", fontSize: "10px", fontFamily: "tahoma,arial,helvetica,sans-serif"}});
            (new Element("div", {html: "Console", styles: {fontWeight: "bold", padding: 1, marginBottom: 2, borderBottom: "1px solid #858484"}})).inject(a, "bottom");
            a.inject(document.body, "bottom")
        }
        (new Element("span", {html: JSON.encode(b) + "<br />"})).inject($("travian_console"), "bottom")
    }
}, ajax: function (a) {
    if (typeof a === "undefined") {
        a = {}
    }
    if (typeof a.data === "undefined") {
        a.data = {}
    }
    if (!a.url) {
        a.url = "ajax.php"
    }
    if (a.data && a.data.cmd) {
        a.url = a.url + (a.url.indexOf("?") == -1 ? "?" : "&") + "cmd=" + a.data.cmd
    }
    a.data.ajaxToken = window.ajaxToken;
    var b = {onRequest: a.onRequest || Travian.emptyFunction, onComplete: a.onComplete || Travian.emptyFunction, onCancel: a.onCancel || Travian.emptyFunction, onSuccess: a.onSuccess || Travian.emptyFunction, onFailure: a.onFailure || Travian.emptyFunction, onException: a.onException || Travian.emptyFunction, errorHandler: a.errorHandler || null};
    return new Request(Object.merge(a, {method: "post", encoding: "utf-8", evalResponse: false, evalScripts: false, headers: {"X-Request": "JSON"}, onRequest: function () {
        b.onRequest(this)
    }, onComplete: function () {
        if (!this.response.json) {
            this.response.json = JSON.decode(this.response.text)
        }
        var c = this.response.json.response;
        b.onComplete(c.data)
    }, onCancel: function () {
        b.onCancel(this)
    }, onSuccess: function () {
        if (!this.response.json) {
            this.response.json = JSON.decode(this.response.text)
        }
        var c = this.response.json.response;
        if (c.javascript) {
            Browser.exec(c.javascript)
        }
        if (c.error) {
            if (c.errorMsg == null) {
                c.errorMsg = "Ajax Request error and no text. That is not so good."
            }
            if (typeof b.errorHandler === "function") {
                b.errorHandler(c.errorMsg, c)
            } else {
                if (b.onFailure(c.data, c.errorMsg) !== false) {
                    c.errorMsg.dialog()
                }
                return
            }
        } else {
            if (c.reload) {
                window.location.reload()
            } else {
                if (c.redirectTo) {
                    window.location.href = c.redirectTo
                }
            }
        }
        b.onSuccess(c.data, c)
    }, onFailure: function () {
        if (!this.response.json) {
            this.response.json = JSON.decode(this.response.text)
        }
        var c = this.response.json.response;
        if (c.error) {
            if (c.errorMsg == null) {
                c.errorMsg = "Ajax Request error and no text. That is not so good."
            }
            if (b.onFailure(c.data, c.errorMsg) !== false) {
                c.errorMsg.dialog()
            }
            return
        }
        b.onFailure(c.data)
    }, onException: function () {
        b.onException(this)
    }})).send()
}, getDirection: function () {
    if (!this.direction) {
        this.direction = $(document.body).getStyle("direction").toLowerCase()
    }
    return this.direction
}, insertScript: (function () {
    var a = [];
    var b = function (c) {
        if (a.length == 0) {
            $$("script[src]").each(function (d) {
                a.push({src: d.src, id: d.id, defer: d.defer, defaultURL: false})
            })
        }
        return a.find(function (d) {
            return d.src == c.src
        })
    };
    return function (c) {
        var e = this;
        if (!c) {
            return
        }
        if (c && c.$family && c.$family.name == "array") {
            return c.each(function (f) {
                e.insertScript(f)
            })
        }
        if (typeof c == "string") {
            c = {src: c}
        }
        c.onLoad = c.onLoad || this.emptyFunction;
        if (b(c)) {
            c.onLoad(false);
            return true
        }
        a.push(c);
        var d = new Element("script", {id: (c.id ? c.id : undefined), src: c.src, type: "text/javascript", defer: (c.defer ? true : false)});
        if (Browser.ie) {
            d.onreadystatechange = function () {
                if (d.readyState == "loaded" || d.readyState == "complete" || d.readyState == 4) {
                    c.onLoad(true, d)
                }
            }
        } else {
            d.onload = c.onLoad.pass(true, d)
        }
        $(document.html).getElement("head").appendChild(d);
        return d
    }
})(), popup: function (b, a) {
    a = a || {};
    return window.open(b, a.id || "_blank", $H(a).getKeys().inject([],function (d, c) {
        if (c != "id") {
            if (typeOf(a[c]) == "boolean") {
                a[c] = a[c] ? "yes" : "no"
            }
            d.push(c + "=" + a[c])
        }
        return d
    }).join(","), true)
}, toggleSwitch: function (b, a) {
    b.toggleClass("hide");
    a.toggleClass("switchClosed");
    a.toggleClass("switchOpened");
    return this
}, toggleSwitchDescription: function (c, a, b) {
    if (typeOf(c) == "element") {
        c = [c]
    }
    c.each(function (d) {
        if (d.hasClass("switchClosed")) {
            d.setTitle(a)
        } else {
            d.setTitle(b)
        }
    });
    return this
}, addMouseEvents: function (a, b) {
    a.addEvent("mouseenter", function () {
        b.addClass("hover");
        b.removeClass("click")
    });
    a.addEvent("mouseleave", function () {
        b.removeClass("hover");
        b.removeClass("click")
    });
    a.addEvent("mousedown", function () {
        b.removeClass("hover");
        b.addClass("click")
    });
    a.addEvent("mouseup", function () {
        b.addClass("hover");
        b.removeClass("click")
    });
    return this
}, findButtonsAndBindEvents: function (a) {
    if (typeof a === "undefined") {
        var b = $$("button")
    } else {
        var b = a.select("button")
    }
    b.each(function (e) {
        var d = e;
        var c = d.getElement(".addHoverClick");
        if (c == null) {
            c = d
        }
        Travian.addMouseEvents(e, c)
    })
}, forceDisplay: function (a) {
    if (typeof a === "undefined") {
        var b = $$(".forceDisplayElement")
    } else {
        var b = [a]
    }
    b.each(function (c) {
        c.addClass("invisible");
        c.removeClass("invisible")
    })
}, showComingSoonInfo: function (a) {
    a.dialog({buttonOk: false});
    return false
}, adjustButtonDisableState: function () {
    $$(".disableButtonHandler").each(function (a) {
        if (a.getStyle("display") == "none" || a.getStyle("visibility") == "hidden") {
            a.getElements("button").each(function (b) {
                var c = b.get("olddisabled") == null ? b.get("disabled") : b.get("olddisabled") != "false";
                b.set("olddisabled", c).set("disabled", true)
            })
        } else {
            a.getElements("button").each(function (b) {
                var c = b.get("olddisabled");
                if (c != null) {
                    b.set("disabled", c != "false")
                } else {
                    b.set("disabled", false)
                }
            })
        }
    })
}, isMobile: function () {
    var a = false;
    var b = navigator.userAgent || navigator.vendor || window.opera;
    if (/ipad|ipod|(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|windows nt.+touch|xda|xiino/i.test(b) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(b.substr(0, 4))) {
        a = true
    }
    return a
}};
window.addEvent("domAltered", function (a) {
    Travian.findButtonsAndBindEvents(a)
});
window.addEvent("domready", function () {
    Travian.findButtonsAndBindEvents()
});
Travian.Storage = (function () {
    var c = null;
    var d = function (m, l) {
        var n = f(m);
        l = g(l);
        if (n === null) {
        } else {
            n.removeItem(l)
        }
    };
    var a = function (m, l) {
        return{data: m, time: (new Date()).getTime(), cachingTime: l}
    };
    var k = function (m, l) {
        var o = f(m);
        var n = null;
        l = g(l);
        if (o === null) {
            return null
        } else {
            n = o.getItem(l)
        }
        if (n == null || typeof n == "undefined") {
            return null
        }
        return JSON.decode(n)
    };
    var f = function (m) {
        var l = m ? "localStorage" : "sessionStorage";
        if (!window[l]) {
            return null
        }
        return window[l]
    };
    var b = function () {
        if (c === null) {
            c = new Element("input", {type: "hidden"}).setStyles({behavior: "url(#default#userData)"}).inject(document.body)
        }
        return c
    };
    var g = function (l) {
        return"Travian." + l
    };
    var e = function (m, l, n) {
        var q = f(m);
        var o = JSON.encode(n);
        l = g(l);
        if (q === null) {
            return null
        } else {
            q.setItem(l, o)
        }
    };
    var h = function (n, m) {
        var l = n.cachingTime;
        if (typeof m.cachingTime != "undefined" && m.cachingTime !== null) {
            l = m.cachingTime
        }
        return m.time !== false && (new Date()).getTime() - m.time > l
    };
    return{cachingTime: 365 * 24 * 60 * 60 * 1000, clear: function (l, m) {
        d(m, l);
        return this
    }, get: function (l, m) {
        var n = k(m, l);
        if (n === null) {
            return null
        }
        if (h(this, n) === true) {
            return null
        }
        return n.data
    }, set: function (m, o, n, l) {
        var q = a(this, o, l);
        e(n, m, q);
        return this
    }}
})();
Travian.Translation = {keys: {}, add: function (b, c) {
    var a = {};
    if (typeof b != "object") {
        a[b] = c
    } else {
        a = b
    }
    this.keys = Object.merge({}, this.keys, a);
    return this
}, get: function (a) {
    return this.keys[a]
}, translate: function (c, b) {
    var a = null;
    if (typeof b == "object") {
        a = Object.append(Object.clone(this.keys), b)
    } else {
        a = this.keys
    }
    return c.substituteWithoutReplacingUndefinedKeys(a)
}};
String.implement({translate: function (a) {
    return Travian.Translation.translate(this, a)
}});
Travian.Tips = (function () {
    var c = function (d) {
        var e = {title: "", text: ""};

		if (d == undefined) {
			return false;
		}
        var f = d.split("||");
        if (f.length == 1) {
            e.text = f[0]
        } else {
            if (f.length == 2) {
                e.title = f[0];
                e.text = f[1]
            } else {
                return false
            }
        }
        return e
    };
    var b = function (d) {
        d.each(function (e) {
            if (e.title != "") {
                var f = c(e.title);
                if (f === false) {
                    return
                }
                f.unescaped = true;
                e.setTip(f).removeAttribute("title");
                if (Browser.ie && Browser.version <= 7) {
                    e.setTip(f).removeAttribute("alt")
                }
            }
        })
    };
    var a = function (h) {
        var f = window.getSize();
        var e = window.getScroll();
        var g = {x: h.element.offsetWidth, y: h.element.offsetHeight};
        var d = Object.clone(h.mousePosition);
        d.x = h.mousePosition.x + h.options.offset.x;
        d.y = h.mousePosition.y + h.options.offset.y;
        if ((d.x + g.x - e.x) > f.x - h.options.windowPadding.x) {
            d.x = h.mousePosition.x - h.options.offset.x - g.x
        }
        if ((d.y + g.y - e.y) > f.y - h.options.windowPadding.y) {
            d.y = h.mousePosition.y - h.options.offset.y - g.y
        }
        if (d.x < h.options.windowPadding.x) {
            d.x = h.options.windowPadding.x
        }
        if (d.y < h.options.windowPadding.y) {
            d.y = h.options.windowPadding.y
        }
        h.element.setPosition(d)
    };
    window.addEvent("domready", function () {
        Travian.Tip = new Travian.Tips();
        b($$('[title!=""]'))
    });
    Element.inject = Element.inject.wrap(function (h, e, g, f) {
        var d = h(e, g, f);
        if (typeof Travian.Tip !== "undefined" && typeof this.select === "function") {
            b(this.select('[title!=""]'))
        }
        return d
    });
    Element.prototype.inject = Element.prototype.inject.wrap(function (h, e, g, f) {
        var d = h(e, g, f);
        if (typeof Travian.Tip !== "undefined" && typeof this.select === "function") {
            b(this.select('[title!=""]'))
        }
        return d
    });
    Element.grab = Element.grab.wrap(function (g, f, e, h) {
        var d = g(f, e, h);
        if (typeof Travian.Tip !== "undefined" && typeof this.select === "function") {
            b(this.select('[title!=""]'))
        }
        return d
    });
    Element.prototype.grab = Element.prototype.grab.wrap(function (g, f, e, h) {
        var d = g(f, e, h);
        if (typeof Travian.Tip !== "undefined" && typeof this.select === "function") {
            b(this.select('[title!=""]'))
        }
        return d
    });
    Element.insert = Element.insert.wrap(function (h, e, g, f) {
        var d = h(e, g, f);
        if (typeof Travian.Tip !== "undefined" && typeof this.select === "function") {
            b(this.select('[title!=""]'))
        }
        return d
    });
    Element.prototype.insert = Element.prototype.insert.wrap(function (e, g, f) {
        var d = e(g, f);
        if (typeof Travian.Tip !== "undefined" && typeof this.select === "function") {
            b(this.select('[title!=""]'))
        }
        return d
    });
    Element.set = Element.set.wrap(function (e, g, f) {
        if (typeof g == "string" && g == "title") {
            this.setTitle(f);
            return this
        }
        var d = e(g, f);
        if (typeof g == "string" && g == "html") {
            b(this.select('[title!=""]'))
        }
        return d
    });
    [Element.Prototype, Element.prototype].each(function (d) {
        if (!d) {
            return
        }
        d.set = d.set.wrap(function (f, h, g) {
            if (typeof h == "string" && h == "title") {
                this.setTitle(g);
                return this
            }
            var e = f(h, g);
            if (typeof h == "string" && h == "html") {
                b(this.select('[title!=""]'))
            }
            return e
        })
    });
    Element.implement({setTip: function (e) {
        if (typeof e == "string") {
            var d = e;
            e = c(d);
            if (e === false) {
                e = d
            }
        }
        Travian.Tip.set(this, e);
        return this
    }, setTipUnescaped: function (e) {
        if (typeof e == "string") {
            var d = e;
            e = c(d);
            if (e === false) {
                e = d
            }
        }
        e.unescaped = true;
        Travian.Tip.set(this, e);
        return this
    }, setTitle: function (d) {
        return this.setTip(d)
    }});
    return new Class({Implements: [Options], displayState: "hide", element: null, elementCurrent: null, elementTitle: null, elementText: null, lastText: "", lastTitle: "", mousePosition: {x: 0, y: 0}, options: {html: '<div class="tip"><div class="tip-container"><div class="tl"></div><div class="tr"></div><div class="tc"></div><div class="ml"></div><div class="mr"></div><div class="mc"></div><div class="bl"></div><div class="br"></div><div class="bc"></div><div class="tip-contents"><div class="title {title}"></div><div class="text {text}"></div></div></div></div>', hideDelay: 250, maxWidthInPercent: 0.33, offset: {x: 16, y: 16}, showDelay: 100, windowPadding: {x: 10, y: 10}, zIndex: 10000}, timer: null, hide: function () {
        if (this.displayState != "hide") {
            this.displayState = "hide";
            clearTimeout(this.timer);
            this.element.get("tween").cancel();
            if (Browser.ie6) {
                this.timer = (function () {
                    this.setStyles({opacity: 0, display: "none"})
                }).delay(this.options.hideDelay, this.element)
            } else {
                this.timer = this.element.fade.delay(this.options.hideDelay, this.element, "out")
            }
        }
        return this
    }, initialize: function (d) {
        this.setOptions(d);
        this.render()
    }, render: function () {
        var d = this;
        this.element = (new Element("div", {styles: {position: "absolute", top: 0, left: 0, opacity: 0, zIndex: this.options.zIndex}})).inject(document.body, "bottom").set("html", this.options.html.substitute({title: "elementTitle", text: "elementText"}));
        this.elementTitle = this.element.down(".elementTitle");
        this.elementText = this.element.down(".elementText");
        this.elementContainer = this.element.down(".tip-container");
        this.elementContents = this.element.down(".tip-contents");
        $(document.body).addEvents({mousemove: function (f) {
            d.mousePosition.x = f.page.x;
            d.mousePosition.y = f.page.y;
            if (d.displayState != "show") {
                return
            }
            a(d)
        }});
        return this
    }, set: function (d, e) {
        var f = this;
        d = $(d);
        d._extendedTipContent = e;
        if (!d._extendedTip) {
            d._extendedTip = true;
            d.addEvents({mouseover: function (g) {
                f.elementCurrent = d;
                f.show(d._extendedTipContent)
            }, mouseout: function (g) {
                f.elementCurrent = null;
                f.hide()
            }})
        }
        d.setTitle = function (g) {
            d._extendedTipContent = g;
            if (f.elementCurrent == d) {
                f.show(d._extendedTipContent)
            }
        };
        return this
    }, show: function (d) {
        if (typeof d == "string") {
            d = {title: "", text: d, unescaped: false}
        }
        if (!d.text && !d.title) {
            this.hide();
            return this
        }
        this.updateContent(d);
        if (this.displayState != "show") {
            this.displayState = "show";
            clearTimeout(this.timer);
            this.element.get("tween").cancel();
            if (Browser.ie6) {
                this.timer = (function (e) {
                    this.setStyles({opacity: 1, display: "block"})
                }).delay(this.options.showDelay, this.element)
            } else {
                this.timer = this.element.fade.delay(this.options.showDelay, this.element, "in")
            }
        }
        return this
    }, updateContent: function (g) {
        var f = Object.clone(g);
        var e = null;
        var h = null;
        var d = null;
        if (typeof f.title == "undefined" || !f.title) {
            f.title = ""
        }
        if (typeof f.text == "undefined" || !f.text) {
            f.text = ""
        }
        f.title = f.title.translate();
        f.text = f.text.translate();
        if (this.lastText != f.text || this.lastTitle != f.title) {
            if (typeof f.unescaped == "undefined" || f.unescaped !== true) {
                f.title = f.title.unescapeHtml();
                f.text = f.text.unescapeHtml()
            }
            this.elementContainer.setStyles({width: "auto"});
            this.elementTitle.set("html", f.title);
            if (f.title) {
                this.elementTitle.show()
            } else {
                this.elementTitle.hide()
            }
            this.elementText.set("html", f.text);
            if (f.text) {
                this.elementText.show()
            } else {
                this.elementText.hide()
            }
            if (Browser.ie7 && Travian.getDirection() == "rtl") {
                this.elementContainer.setStyles({width: this.elementContents.getSize().x})
            }
            e = $(document.body).getSize().x;
            h = this.elementContents.getSize().x;
            if (Math.floor(e * this.options.maxWidthInPercent) < h) {
                this.elementContainer.setStyles({width: Math.floor(e * this.options.maxWidthInPercent)})
            }
            d = this.elementContainer.getSize().x;
            if (Browser.ie6 && d == 0) {
                d = 200
            }
            this.elementContainer.setStyles({width: d});
            a(this);
            this.lastText = f.text;
            this.lastTitle = f.title
        }
        return this
    }, refresh: function () {
        b($$('[title!=""]'))
    }})
})();
Travian.Translation.add({"allgemein.ok": "ok", "allgemein.cancel": "cancel"});
Travian.Dialog = new Class({Implements: [Options, Events], buttonTemplates: {button: ""}, DIALOG_TYPE_MODAL: "modal", DIALOG_TYPE_NONMODAL: "nonmodal", options: {cssClass: "white", buttonOk: true, keepOpen: false, buttonTextOk: null, buttonCloseOnClickOk: false, buttonCancel: true, buttonTextCancel: null, elementFocus: "dialogButtonOk", maxWidthInPercent: 0.75, resizeDialogIfOverflow: true, relativeTo: null, scroll: true, title: null, useEscKey: true, submitMethod: null, submitUrl: null, overlayCancel: true, draggable: false, enableBackground: true, saveOnUnload: false, dragPosition: null, darkOverlay: false, savePositionForSession: {cookieName: null}, type: null, enableBringToFront: true, stickToUrlOnRestore: false, dialogOrigin: null, infoIcon: null, buttonTextInfo: null, preventFormSubmit: false, destroyElement: true, fx: {type: "tween", open: 1, close: 0, options: {duration: 400}}}, toggleFormState: function (a) {
    this.buttonOk.toggleClass("disabled", a).disabled = a;
    if (Browser.ie && (this.options.submitMethod || this.options.submitUrl)) {
        this.form.disabled = a
    }
    return this
}, disableForm: function () {
    return this.toggleFormState(true)
}, enableForm: function () {
    return this.toggleFormState(false)
}, initialize: function (a) {
    if (typeof this.options.savePositionForSession.position === "undefined") {
        this.options.savePositionForSession.position = null
    }
    if (!Browser.ie || Browser.version > 8) {
        this.options.fx.options.property = "opacity"
    }
    if (typeof Travian.Templates.ButtonTemplate != "undefined") {
        this.buttonTemplates.button = Travian.Templates.ButtonTemplate
    }
    this.setOptions(a);
    if (this.options.type == this.DIALOG_TYPE_NONMODAL) {
        this.options.enableBringToFront = true;
        this.options.enableBackground = false;
        this.options.draggable = true
    }
    if (this.options.type == this.DIALOG_TYPE_MODAL) {
        this.options.enableBringToFront = false;
        this.options.enableBackground = true;
        this.options.draggable = false
    }
    if (!this.options.dialogOrigin) {
        this.options.dialogOrigin = location.pathname
    }
    this.options.relativeTo = this.options.relativeTo || document.body;
    this.ie6 = Browser.ie && Browser.version <= 6;
    this.options.relativeTo = $(this.options.relativeTo);
    if (this.options.buttonTextOk == null) {
        this.options.buttonTextOk = Travian.Translation.get("allgemein.ok")
    }
    if (this.options.buttonTextCancel == null) {
        this.options.buttonTextCancel = Travian.Translation.get("allgemein.cancel")
    }
    this.render();
    if (typeof Travian.WindowManager != "undefined") {
        Travian.WindowManager.register(this)
    }
    if (this.buttonOk && (this.options.buttonTextOk == Travian.Translation.get("allgemein.ok"))) {
        if (!Travian.isMobile()) {
            try {
                $(this.buttonOk).focus()
            } catch (b) {
            }
        }
    }
}, correctDialogPosition: function (b) {
    var f = Travian.WindowManager.getWindowDimensions(), d = this.wrapper.clientWidth, c = 200, a = b.x, e = b.y;
    if (a + d < c) {
        a = c - d
    } else {
        if (a + c > f.width) {
            a = f.width - c
        }
    }
    if (e < 0) {
        e = 0
    } else {
        if (e + c > f.height) {
            e = f.height - c
        }
    }
    return{x: a, y: e}
}, render: function () {
    var e = this;
    var f = new Element("div", {html: this.buttonTemplates.button});
    var c = f.getFirst();
    if (this.options.savePositionForSession.cookieName !== null) {
        var d = JSON.decode(Cookie.read(this.options.savePositionForSession.cookieName));
        if (d) {
            this.options.savePositionForSession.position = d.position
        }
    }
    if (typeof c == "undefined" || !c) {
        throw ("Button for Dialog must not be empty.")
    }
    c.addClass("green");
    c.addClass("ok");
    c.addClass("dialogButtonOk");
    c.setAttribute("type", "submit");
    var a = f.getElement("div[class=button-content]");
    a.insert(new Element("div").addClass("text"));
    var b = {position: "absolute"};
    if (!Browser.ie || Browser.version > 8) {
        b.opacity = 0
    }
    this.wrapper = new Element("div", {styles: b}).inject(document.body).insert({top: '<div class="dialog ' + this.options.cssClass + '"><div class="dialog-container"><div class="dialog-background-tl"></div><div class="dialog-background-tr"></div><div class="dialog-background-tc"></div><div class="dialog-background-ml"></div><div class="dialog-background-mr"></div><div class="dialog-background-mc"></div><div class="dialog-background-bl"></div><div class="dialog-background-br"></div><div class="dialog-background-bc"></div><div class="dialog-contents"><form action="?" method="get" accept-charset="UTF-8"><div class="dialog-dragbar"><div class="dragbar-inner-left"></div><div class="dragbar-inner-mid"></div><div class="dragbar-inner-right"></div></div><div class="iconButton small info"></div><div class="iconButton small cancel"></div><div class="title"></div><div class="content"></div><div class="buttons">' + f.get("html") + "</div></form></div></div></div>"});
    this.content = this.wrapper.down(".content");
    this.title = this.wrapper.down(".title");
    this.setTitle(this.options.title);
    this.elementContainer = this.wrapper.down(".dialog-container");
    this.elementContents = this.wrapper.down(".dialog-contents");
    this.infoButton = this.wrapper.down(".info");
    this.dialogDragbar = this.wrapper.down(".dialog-dragbar");
    if (this.options.infoIcon) {
        this.setInfoIcon(this.options.infoIcon)
    }
    if (e.options.draggable) {
        this.wrapper.addClass("dragWrapper");
        new Drag.Move(this.wrapper, {droppables: this.title, handle: this.dialogDragbar, onDrop: function (g) {
            e.options.dragPosition = e.correctDialogPosition(g.getPosition());
            if (e.options.savePositionForSession.cookieName !== null) {
                e.options.savePositionForSession.position = e.correctDialogPosition(g.getPosition())
            }
        }});
        this.title.addClass("drag")
    }
    if (this.options.enableBringToFront) {
        this.wrapper.addEvent("mousedown", function (g) {
            e.bringToFront()
        })
    }
    this.form = this.wrapper.down("form").addEvent("submit", function (g) {
        if (e.form.disabled || e.options.preventFormSubmit) {
            g.stop();
            return
        }
        e.disableForm();
        e.fireEvent("okay", [e, e.content]);
        if (e.options.keepOpen == false) {
            e.close()
        }
        if (!e.options.submitMethod) {
            g.stop()
        }
    });
    this.form.disabled = false;
    if (this.options.submitMethod) {
        this.form.setAttribute("method", this.options.submitMethod);
        if (this.options.submitUrl) {
            this.form.setAttribute("action", this.options.submitUrl)
        }
    }
    this.buttonOk = this.wrapper.down("button.ok");
    if (this.options.buttonOk == false) {
        this.buttonOk.hide().up(".buttons").hide()
    }
    this.buttonOkText = this.wrapper.down("button.ok .text");
    if (this.buttonOkText) {
        this.buttonOkText.set("html", this.options.buttonTextOk)
    } else {
        this.buttonOk.setTitle(this.options.buttonTextOk)
    }
    if (this.options.buttonCloseOnClickOk) {
        this.wrapper.down("button.ok").addEvent("click", function (g) {
            e.fireEvent("cancel", [e, e.content]);
            e.close()
        })
    }
    this.buttonCancel = this.wrapper.down(".cancel").addEvent("click", function (g) {
        e.fireEvent("cancel", [e, e.content]);
        e.close()
    });
    if (this.options.buttonCancel == false) {
        this.buttonCancel.hide()
    }
    this.buttonCancelText = this.wrapper.down(".cancel .text");
    if (this.buttonCancelText) {
        this.buttonCancelText.set("html", this.options.buttonTextCancel)
    } else {
        this.buttonCancel.setTitle(this.options.buttonTextCancel)
    }
    this.fireEvent("render", [this, this.content]);
    if (!this.fx) {
        this.fx = this.options.fx.type == "morph" ? new Fx.Morph(this.wrapper, this.options.fx.options) : new Fx.Tween(this.wrapper, this.options.fx.options)
    }
    this.fx.addEvent("complete", function () {
        if (e.open && $(e.options.elementFocus)) {
            try {
                $(e.options.elementFocus).focus()
            } catch (g) {
            }
        }
        e.fireEvent(e.open ? "show" : "hide", [e, e.content]);
        if (!e.open) {
            e.dispose()
        }
    });
    if (e.options.enableBackground) {
        this.overlay = new Overlay(document.body, {onClick: function () {
            if (e.options.overlayCancel) {
                e.fireEvent("cancel", [e, e.content]);
                e.close()
            }
        }, opacity: (e.options.darkOverlay) ? 0.8 : 0.3, duration: this.options.fx.options.duration})
    }
    this.bringToFront()
}, updateInfoButton: function (a) {
    this.setOptions(a);
    if (this.options.infoIcon) {
        this.setInfoIcon(this.options.infoIcon)
    }
    return this
}, displayButtonOk: function (a) {
    if (typeof a === "undefined" || a == null || a == true) {
        this.buttonOk.show().up(".buttons").show()
    } else {
        this.buttonOk.hide()
    }
}, setContent: function (d, b) {
    var c = null;
    var a = null;
    this.content.empty();
    if (Browser.ie7 && Travian.getDirection() == "rtl") {
        this.elementContainer.setStyles({width: "auto"})
    }
    this.content.insert({bottom: d});
    if (Browser.ie7 && Travian.getDirection() == "rtl") {
        this.elementContainer.setStyles({width: this.elementContents.getSize().x})
    }
    c = $(document.body).getSize().x;
    a = this.elementContents.getSize().x;
    if (this.options.resizeDialogIfOverflow && Math.floor(c * this.options.maxWidthInPercent) < a) {
        this.elementContainer.setStyles({width: Math.floor(c * this.options.maxWidthInPercent)})
    }
    if (b) {
        this.options.elementFocus = b
    }
    if ($(this.options.elementFocus)) {
        (function () {
            try {
                $(this.options.elementFocus).focus()
            } catch (f) {
            }
        }).delay(50)
    }
    this.updatePosition();
    window.fireEvent("domAltered", this.wrapper);
    return this
}, setTitle: function (a) {
    this.options.title = a;
    this.title.set("html", this.options.title);
    if (!this.options.title) {
        this.title.hide()
    }
    return this
}, updatePosition: function () {
    var d = this.elementContents.getWidth();
    this.dialogDragbar.setStyles({width: d + 20});
    this.dialogDragbar.down(".dragbar-inner-mid").setStyles({width: d});
    if (this.options.savePositionForSession.cookieName !== null && this.options.savePositionForSession.position !== null) {
        this.setPosition(this.options.savePositionForSession.position)
    } else {
        if (this.options.dragPosition && typeof this.options.dragPosition.x != "undefined" && typeof this.options.dragPosition.y != "undefined") {
            this.setPosition(this.options.dragPosition)
        } else {
            var b = {x: 0, y: 0};
            var e = $(document.body).getSize();
            if (this.wrapper.getStyle("position") != "fixed" && document.body == this.options.relativeTo) {
                b = $(document.body).getScroll()
            }
            var c = this.wrapper.getDimensions({computeSize: true});
            var f = $(this.options.relativeTo).getSize();
            var g = $(this.options.relativeTo).getPosition();
            if (window.innerWidth !== undefined && g.x == 0) {
                f.x = window.innerWidth
            }
            if (window.innerHeight !== undefined && g.y == 0) {
                f.y = window.innerHeight
            }
            var a = {left: b.x + g.x + f.x / 2 - c.width / 2, top: b.y + g.y + f.y / 2 - c.height / 2};
            if (navigator.userAgent.match(/Windows Phone/i)) {
                a = {left: b.x + f.x / 2 - c.width / 2, top: b.y + f.y / 2 - c.height / 2}
            }
            if (a.left < 0) {
                a.left = 5
            }
            if (a.top < 0) {
                a.top = 40
            }
            if (Travian.getDirection() == "rtl" && (a.left + c.width) > e.x) {
                a.left = e.x - c.width - 5
            }
            this.setPosition({x: a.left, y: a.top})
        }
    }
}, show: function () {
    var a = this;
    this.open = true;
    this.fireEvent("open", [this, this.content]);
    this.updatePosition();
    if (!Browser.ie || Browser.version > 8) {
        this.fx.start(this.options.fx.open)
    }
    if (this.overlay) {
        this.overlay.open()
    }
    if (this.options.useEscKey) {
        document.id(document.body).addEvent("keydown", function (b) {
            if (b.key == "esc") {
                a.close()
            }
        })
    }
    return this
}, hide: function () {
    this.wrapper.hide();
    this.overlay.overlay.hide()
}, unhide: function () {
    this.wrapper.show();
    this.overlay.overlay.show()
}, close: function () {
    this.open = false;
    if (typeof Travian.WindowManager != "undefined") {
        Travian.WindowManager.unregister(this)
    }
    this.fireEvent("close", [this, this.content]);
    if (!Browser.ie || Browser.version > 8) {
        this.fx.start(this.options.fx.close);
        if (this.overlay) {
            this.overlay.close();
            this.overlay.overlay.hide();
            this.dispose()
        }
    } else {
        this.dispose()
    }
    if (this.options.savePositionForSession.cookieName !== null) {
        Cookie.dispose(this.options.savePositionForSession.cookieName);
        Cookie.write(this.options.savePositionForSession.cookieName, JSON.encode(this.options.savePositionForSession))
    }
    Travian.Tip.hide();
    return this
}, dispose: function () {
    if (typeof Travian.WindowManager != "undefined") {
        Travian.WindowManager.unregister(this)
    }
    if (this.options.destroyElement == true) {
        this.wrapper.destroy()
    }
    if (this.overlay) {
        this.overlay.overlay.destroy()
    }
}, toElement: function () {
    return this.wrapper
}, setPosition: function (a) {
    this.wrapper.setStyles({left: a.x, top: a.y});
    return a
}, setPositionExtended: function (a) {
    this.wrapper.setStyles({left: a.x, top: a.y, marginLeft: a.marginLeft + "px", marginTop: a.marginTop + "px"});
    return a
}, isAjax: function () {
    return false
}, reload: function () {
}, bringToFront: function () {
    if (typeof Travian.WindowManager == "undefined") {
        return false
    }
    if (Travian.WindowManager.getCurrentZIndex() == this.wrapper.getStyle("zIndex")) {
        return false
    }
    var a = Travian.WindowManager.getZIndex();
    this.wrapper.setStyles({zIndex: a});
    if (this.options.enableBackground) {
        this.overlay.overlay.setStyles({zIndex: (a - 5)})
    }
}, getOrigin: function () {
    return this.dialogOrigin
}, setInfoIcon: function (a) {
    if (a) {
        this.options.infoIcon = a;
        var b = this;
        this.infoButton.removeEvents("click");
        this.infoButton.show();
        this.infoButton.addEvent("click", function () {
            if (typeof b.options.infoIcon == "string") {
                return window.open(b.options.infoIcon, "_blank")
            }
            if (typeof b.options.infoIcon == "function") {
                return b.options.infoIcon()
            }
        });
        if (this.options.buttonTextInfo) {
            this.infoButton.setTitle(this.options.buttonTextInfo)
        }
    } else {
        this.infoButton.hide()
    }
    return this
}, updateCssClass: function (a) {
    if (a) {
        var e = this.options.cssClass.split(" ");
        var d = this.wrapper.down(".dialog");
        for (var c = 0; c < e.length; c++) {
            d.removeClass(e[c])
        }
        this.options.cssClass = a;
        var f = (a).split(" ");
        for (var b = 0; b < f.length; b++) {
            if (f[b] != "") {
                d.addClass(f[b])
            }
        }
    }
    return this
}});
Element.implement({dialog: function (a) {
    this.dialog = new Travian.Dialog(a).setContent(this.get("html")).show();
    return this
}});
String.implement({dialog: function (a) {
    this.dialog = new Travian.Dialog(a).setContent(this).show();
    return this
}});
Travian.WindowManager = new (new Class({Implements: [Events], windows: null, currentZIndex: 6000, zIndexMaxValue: 9900, initialize: function () {
    this.windows = []
}, register: function (a) {
    if (typeof a.options.context == "undefined") {
        a.options.context = "noContext"
    }
    a.identifier = this.__createIdentifier();
    this.windows.push(a);
    this.fireEvent("register", [this, a]);
    return a
}, unregister: function (a) {
    delete this.windows[a.identifier];
    this.fireEvent("unregister", [this, a])
}, closeWindow: function (a) {
    a.close()
}, hideWindow: function (a) {
    a.hide()
}, showWindow: function (a) {
    a.unhide()
}, hideByContext: function (a) {
    var b = this;
    this.getWindows().each(function (c) {
        if (!b.checkContext(a, c)) {
            return false
        }
        b.hideWindow(c)
    })
}, showByContext: function (a) {
    var b = this;
    this.getWindows().each(function (c) {
        if (!b.checkContext(a, c)) {
            return false
        }
        b.showWindow(c)
    })
}, closeByContext: function (a) {
    var b = this;
    this.getWindows().each(function (c) {
        if (!b.checkContext(a, c)) {
            return false
        }
        b.closeWindow(c)
    })
}, getWindowsByContext: function (a) {
    var b = [];
    var c = this;
    this.getWindows().each(function (d) {
        if (!c.checkContext(a, d)) {
            return false
        }
        b.push(d)
    });
    return b
}, checkContext: function (a, b) {
    if (typeof b.options.context != "undefined") {
        if (b.options.context == a) {
            return true
        }
    }
    return false
}, getWindows: function () {
    return this.windows
}, reloadWindow: function (a) {
    a.reload()
}, reloadWindowsByContext: function (a) {
    var b = this;
    this.getWindows().each(function (c) {
        if (!b.checkContext(a, c)) {
            return false
        }
        b.reloadWindow(c)
    })
}, __createIdentifier: function () {
    return this.windows.length
}, cleanupZIndex: function () {
    var a = 0;
    this.getWindows().each(function (c) {
        var d = $(c).getStyle("zIndex");
        var b = (d - 3000);
        if (b > a) {
            a = b
        }
        $(c).setStyle("zIndex", b)
    });
    this.currentZIndex = a
}, getZIndex: function () {
    if (this.currentZIndex >= this.zIndexMaxValue) {
        this.cleanupZIndex()
    }
    this.currentZIndex += 10;
    return this.currentZIndex
}, getCurrentZIndex: function () {
    return this.currentZIndex
}, checkOpenWindowByContext: function (a) {
    var c = false;
    var b = this;
    this.getWindows().each(function (d) {
        if (b.checkContext(a, d)) {
            c = true
        }
    });
    if (c) {
        return true
    }
    return false
}, checkForModalDialogs: function () {
    var a = false;
    var b = this;
    this.getWindows().each(function (c) {
        if (c.options.type == Travian.Dialog.DIALOG_TYPE_MODAL) {
            a = true
        }
    });
    return a
}, getWindowDimensions: function () {
    var a = 630, b = 460;
    if (document.body && document.body.offsetWidth) {
        a = document.body.offsetWidth;
        b = document.body.offsetHeight
    }
    if (document.compatMode == "CSS1Compat" && document.documentElement && document.documentElement.offsetWidth) {
        a = document.documentElement.offsetWidth;
        b = document.documentElement.offsetHeight
    }
    if (window.innerWidth && window.innerHeight) {
        a = window.innerWidth;
        b = window.innerHeight
    }
    return{width: a, height: b}
}}));
Travian.RestoreWindowManager = new (new Class({cookieName: "WMBlueprints", initialize: function () {
    var a = this;
    window.addEvent("domready", function () {
        var b = JSON.decode(Cookie.read(a.cookieName));
        if (!b) {
            return false
        }
        b.each(function (c) {
            if (c.options.stickToUrlOnRestore && c.options.dialogOrigin != location.pathname) {
                return false
            }
            $dialog = new Travian.Dialog.Ajax(c.options)
        })
    });
    window.addEvent("beforeunload", function (d) {
        var b = Travian.WindowManager.getWindows();
        var c = [];
        b.each(function (f) {
            if (f.options.saveOnUnload) {
                if (!f.isAjax()) {
                    throw ("Only Travian.Dialog.Ajax can be saved.")
                }
                delete f.options.relativeTo;
                var e = {options: f.options};
                c.push(e);
                if (f.options.savePositionForSession.cookieName !== null) {
                    Cookie.dispose(f.options.savePositionForSession.cookieName);
                    Cookie.write(f.options.savePositionForSession.cookieName, JSON.encode(f.options.savePositionForSession))
                }
            }
        });
        Cookie.dispose(a.cookieName);
        Cookie.write(a.cookieName, JSON.encode(c))
    })
}}));
Travian.Dialog.Ajax = new Class({Extends: Travian.Dialog, options: {data: {}, saveOnUnload: false}, initialize: function (a) {
    this.parent(a);
    this.request()
}, request: function () {
    var a = this;
    Travian.ajax({data: this.options.data, onSuccess: function (b) {
        if (b.html != "") {
            a.setContent(b.html).setTitle(b.title).setInfoIcon(b.infoIcon).updateCssClass(b.cssClass);
            a.show()
        } else {
            a.close()
        }
    }});
    return this
}, isAjax: function () {
    return true
}, reload: function () {
    this.request()
}});
Hash.implement({dialog: function (a) {
    new Travian.Dialog.Ajax(Object.merge({}, this.toObject(), a || {}));
    return this
}});
Travian.AutoCompleter = new Class({Extends: Autocompleter.Request.JSON, initialize: function (c, b, a) {
    var d = this;
    this.parent(c, b, Object.merge({minLength: 2, maxChoices: 10, width: "auto", postVar: "search", postData: {cmd: "autoComplete", ajaxToken: window.ajaxToken}, emptyChoices: function () {
        var e = new Element("li", {html: "{cropfinder.keine_ergebnisse}".translate()});
        e.inject(d.choices);
        d.showChoices()
    }}, a || {}))
}});
Travian.DoubleClickPreventer = new Class({prevent: false, timeout: 400, check: function () {
    if (this.prevent) {
        return false
    }
    this.prevent = true;
    $this = this;
    setTimeout(function () {
        $this.prevent = false
    }, this.timeout);
    return true
}});
Travian.Form = new Class({elements: {}, onClick: function (a) {
    return this
}, addElement: function (a, b) {
    b.setName(a);
    this.elements[a] = b;
    return this
}, addInputElementByName: function (a, c) {
    var b = Travian.Form.Element.Input.createElementByName(this, a, c);
    this.addElement(a, b);
    return this
}, onElementChanged: function (a) {
    var b = a.isDirty();
    if (b == false) {
        if ($H(this.elements).find(function (c) {
            return c.isDirty()
        })) {
            b = true
        }
    }
    this.onDirty(b);
    return this
}, onDirty: function (a) {
    return this
}});
Travian.Form.UnloadHelper = new (new Class({formQueryString: "input, textarea, select", message: null, identifierCount: 0, htmlForms: {}, formStates: {}, initialize: function () {
    $this = this;
    window.onbeforeunload = function () {
        var a = $this.isEnabled();
        if (a) {
            return $this.message
        } else {
            return
        }
    }
}, isEnabled: function () {
    for (var b in this.formStates) {
        if (this.formStates[b]) {
            return true
        }
    }
    for (var b in this.htmlForms) {
        var c = $(b);
        if (c == null) {
            delete this.htmlForms[b];
            continue
        }
        var a = this.htmlForms[b];
        var d = this.generateFormHash(c);
        if (a !== d) {
            return true
        }
    }
    return false
}, enableSecurity: function (a) {
    if (a === null) {
        a = this.getIdentifier()
    }
    this.formStates[a] = true;
    return a
}, disableSecurity: function (a) {
    this.formStates[a] = false
}, getIdentifier: function () {
    this.identifierCount++;
    return this.identifierCount
}, generateFormHash: function (b) {
    var a = "";
    var c = b.getElements(this.formQueryString);
    c.each(function (f) {
        var e = f.get("tag");
        var h = f.get("type");
        switch (true) {
            case e === "input" && h === "radio":
                a += f.get("checked");
                break;
            case e === "input" && h === "checkbox":
                a += f.get("checked");
                break;
            case e === "input" || e === "textarea":
                a += f.get("value");
                break;
            case e === "select":
                var g = f.getSelected();
                if (g) {
                    a += g.get("value")
                }
                break
        }
    });
    var d = a.toMD5();
    return d
}, watchHtmlForm: function (a) {
    var b = this;
    a.addEvent("change:relay(" + this.formQueryString + ")", function (d, c) {
        b.updateSubmitButtons(a)
    });
    this.htmlForms[a.get("id")] = this.generateFormHash(a);
    a.addEvent("submit", function () {
        b.htmlForms[a.get("id")] = b.generateFormHash(a)
    });
    this.updateSubmitButtons(a)
}, unwatchHtmlForm: function (a) {
    delete this.htmlForms[a.get("id")]
}, updateSubmitButtons: function (b) {
    var c = this;
    var a = (c.htmlForms[b.get("id")] === c.generateFormHash(b));
    b.getElements("input[type=submit], button[type=submit]").each(function (d) {
        if (a) {
            d.addClass("disabled")
        } else {
            d.removeClass("disabled")
        }
        d.disabled = a
    })
}}))();
Travian.Form.Element = new Class({form: null, name: null, initialize: function (a) {
    this.form = a
}, isDirty: function () {
    return false
}, onChange: function () {
    this.form.onElementChanged(this);
    return this
}, onClick: function () {
    this.form.onClick(this);
    return this
}, setForm: function (a) {
    this.form = a;
    return this
}, setName: function (a) {
    this.name = a;
    return this
}, getName: function () {
    return this.name
}});
Travian.Form.Element.Input = new Class({Extends: Travian.Form.Element, originalValue: null, currentValue: null, type: null, element: null, initialize: function (b, a) {
    this.parent(b);
    this.element = a;
    this.originalValue = this.currentValue = this.getValue();
    this.initEvents()
}, getInput: function () {
    return this.element
}, initEvents: function () {
    var a = this;
    this.element.addEvent("change", function () {
        a.onChange()
    });
    return this
}, onChange: function () {
    this.currentValue = this.getValue();
    this.parent();
    return this
}, getValue: function () {
    return this.element.value
}, isDirty: function () {
    return this.originalValue != this.currentValue
}});
Travian.Form.Element.Input.createElementByName = function (d, a, c) {
    var f = null;
    var b = null;
    var e = null;
    if (c === undefined) {
        c = $(document)
    }
    f = $(c).getElements('[name="' + a + '"]');
    if (f.length == 0) {
        throw new Error('Element with name "' + a + '" not found.')
    }
    b = $(f[0]);
    switch (b.nodeName.toLowerCase()) {
        case"input":
            e = b.get("type");
            if (e == "radio" || e == "checkbox") {
                b = f
            }
            break;
        default:
            e = b.nodeName.toLowerCase();
            break
    }
    e = e.capitalize();
    if (!Travian.Form.Element.Input[e]) {
        throw new Error('Element type "' + e + '" not yet implemented!')
    }
    return new Travian.Form.Element.Input[e](d, b)
};
Travian.Form.Element.Input.Button = new Class({Extends: Travian.Form.Element.Input, initEvents: function () {
    var a = this;
    this.element.addEvent("click", function () {
        a.onClick()
    });
    return this
}, getValue: function () {
    return null
}});
Travian.Form.Element.Input.Checkbox = new Class({Extends: Travian.Form.Element.Input, valueBefore: null, initEvents: function () {
    var a = this;
    this.valueBefore = this.getValue();
    this.element.addEvent("click", function () {
        if (a.getValue() != a.valueBefore) {
            a.valueBefore = a.getValue();
            a.onChange()
        }
    });
    return this
}, getValue: function () {
    var a = this.element.find(function (b) {
        return b.checked
    });
    if (a) {
        return a.value
    }
    return null
}});
Travian.Form.Element.Input.Radio = new Class({Extends: Travian.Form.Element.Input, valueBefore: null, initEvents: function () {
    var a = this;
    this.valueBefore = this.getValue();
    this.element.addEvent("click", function () {
        if (a.getValue() != a.valueBefore) {
            a.valueBefore = a.getValue();
            a.onChange()
        }
    });
    return this
}, getValue: function () {
    var a = this.element.find(function (b) {
        return b.checked
    });
    if (a) {
        return a.value
    }
    return null
}});
Travian.Form.Element.Input.Text = new Class({Extends: Travian.Form.Element.Input});
Travian.Form.Element.Input.Textarea = new Class({Extends: Travian.Form.Element.Input});
Travian.Formatter = new Class({Implements: [Options], options: {languageKey: "de", formatType: "type3", decimalSeperator: ",", forceDecimal: true}, initialize: function (b) {
    this.setOptions(b);
    if (b == undefined || b.languageKey == undefined) {
        var a = $$("meta[name=content-language]")[0];
        this.options.languageKey = a.content
    }
    if (this.options.languageKey !== undefined) {
        var c = this.getDefinitionByLanguage(this.options.languageKey);
        if (c !== false) {
            this.options.formatType = c.type;
            this.options.decimalSeperator = c.decimalSeperator
        }
    }
    return this
}, getFormattedNumber: function (b) {
    if (b == undefined || b == null || b == "") {
        return 0
    }
    if (!isNaN(b)) {
        if (parseInt(b) != b) {
            b = String(parseFloat(b))
        } else {
            b = String(parseFloat(b)) + ".0"
        }
    }
    var d = b.match(/([\d.,\s-]*?)[.]?(\d*)?$/);
    var e = {left: d[1], right: d[2]};
    e.left = e.left.replace(/[\s,.'"]*/g, "");
    var a = false;
    if (e.left < 0) {
        a = true
    }
    e.left = e.left.replace(/[-]*/g, "");
    var c = 0;
    if (this.typeFunctions[this.options.formatType] == undefined) {
        throw"Der Zahlenformattyp" + this.options.formatType + "ist unbekannt!"
    }
    c = this.typeFunctions[this.options.formatType].createNumberFunction(e, this.options);
    if (a == true) {
        c = "-" + c
    }
    return c
}, setOptionLanguageKey: function (a) {
    var b = this.getDefinitionByLanguage(a);
    if (b != false) {
        this.options.formatType = b.type;
        this.options.decimalSeperator = b.decimalSeperator;
        return true
    }
    return false
}, getAvailableTypes: function () {
    var a = [];
    Object.each(this.typeFunctions, function (c, b) {
        a.push(b)
    });
    return a
}, removeNonDigits: function (a) {
    var b = a.match(/\d/g);
    b = parseInt(b.join(""));
    return b
}, getDefinitionByLanguage: function (c) {
    var b = this;
    var a = false;
    Object.each(this.languageDefinitions, function (e, d) {
        if (e.languages.contains(c) === true) {
            a = b.languageDefinitions[d]
        }
    });
    return a
}, languageDefinitions: {1: {decimalSeperator: ",", type: "type1", languages: ["ae", "eg", "fi", "fr", "lv", "ma", "no", "pl", "sa", "se", "sk", "sy", "ua"]}, 2: {decimalSeperator: ".", type: "type2", languages: ["au", "cn", "en", "hk", "il", "ir", "jp", "kr", "lt", "my", "ph", "pk", "th", "tw", "uk", "us", "za"]}, 3: {decimalSeperator: ",", type: "type3", languages: ["ba", "bg", "br", "cl", "cz", "de", "dk", "ee", "es", "gr", "hr", "hu", "id", "it", "nl", "pt", "ro", "rs", "ru", "si", "tr", "vn"]}, 4: {decimalSeperator: ".", type: "type4", languages: ["in"]}}, typeFunctions: {type1: {createNumberFunction: function (e, b) {
    var a = "";
    var d = e.left.split("").reverse().join("");
    for (var c = 0; c <= (d.length - 1); c++) {
        if (c % 3 == 0 && c != 0) {
            a += " "
        }
        a += d.charAt(c)
    }
    a = a.split("").reverse().join("");
    if (e.right !== undefined && b.forceDecimal == true) {
        a += "," + e.right
    }
    return a
}}, type2: {createNumberFunction: function (e, b) {
    var a = "";
    var d = e.left.split("").reverse().join("");
    for (var c = 0; c <= (d.length - 1); c++) {
        if (c % 3 == 0 && c != 0) {
            a += ","
        }
        a += d.charAt(c)
    }
    a = a.split("").reverse().join("");
    if (e.right !== undefined && b.forceDecimal == true) {
        a += "." + e.right
    }
    return a
}}, type3: {createNumberFunction: function (e, b) {
    var a = "";
    var d = e.left.split("").reverse().join("");
    for (var c = 0; c <= (d.length - 1); c++) {
        if (c % 3 == 0 && c != 0) {
            a += "."
        }
        a += d.charAt(c)
    }
    a = a.split("").reverse().join("");
    if (e.right !== undefined && b.forceDecimal == true) {
        a += "," + e.right
    }
    return a
}}, type4: {createNumberFunction: function (g, c) {
    var b = "";
    var f = 3;
    var e = g.left.split("").reverse().join("");
    var a = 0;
    for (var d = 0; d <= (e.length - 1); d++) {
        if (a % f == 0 && a != 0) {
            b += ",";
            f = 2;
            a = 0
        }
        b += e.charAt(d);
        a++
    }
    b = b.split("").reverse().join("");
    if (g.right !== undefined && c.forceDecimal == true) {
        b += "." + g.right
    }
    return b
}}, seperatorless: {createNumberFunction: function (c, b) {
    var a = c.left;
    if (c.right !== undefined && b.forceDecimal == false) {
        a += b.decimalSeperator + c.right
    }
    return a
}}, toInt: {createNumberFunction: function (b, a) {
    return b.left
}}, toIntRounded: {createNumberFunction: function (c, b) {
    if (c.right == undefined) {
        return c.left
    }
    var a = c.left + "." + c.right;
    return(Number.from(a)).round()
}}}});
Travian.ajax = Travian.ajax.wrap(function (b, a) {
    if (!a.url) {
        a.url = "ajax.php"
    }
    return b(a)
});
Travian.Game = {currentPage: window.location.href.split("/").pop().split(".php", 2).shift(), eventJamHtml: null, speed: 1, version: 4, worldId: null, ajaxUpdate: function (b, a) {
    b = $(b);
    a = a || {};
    var c = {onRequest: a.onRequest || Travian.emptyFunction, onComplete: a.onComplete || Travian.emptyFunction, onCancel: a.onCancel || Travian.emptyFunction, onSuccess: a.onSuccess || Travian.emptyFunction, onFailure: a.onFailure || Travian.emptyFunction, onException: a.onException || Travian.emptyFunction};
    if (!a.url) {
        a.url = "admin.php"
    }
    if (a.parameters && a.parameters.cmd) {
        a.url = a.url + (a.url.indexOf("?") == -1 ? "?" : "&") + "cmd=" + a.parameters.cmd
    }
    return new Request(Object.merge({}, a, {method: "get", encoding: "utf-8", evalResponse: false, evalScripts: false, onRequest: function () {
        c.onRequest(this)
    }, onComplete: function () {
        c.onComplete(this.response.text)
    }, onCancel: function () {
        c.onCancel(this)
    }, onSuccess: function () {
        b.set("html", this.response.text);
        c.onSuccess(this.response.text)
    }, onFailure: function () {
        c.onFailure(this.response.text)
    }, onException: function () {
        c.onException(this)
    }})).send()
}, gotoPage: function (c, d, a, b) {
    Travian.ajax({data: {cmd: d, data: {page: c, entries: b}}, onSuccess: function (e) {
        $(a).set("html", e.result)
    }});
    return this
},buyplus:function(id,r){
    var gold = parseInt(document.getElementById("gold").innerHTML);
    var gold2 = parseInt(document.getElementById("ajaxReplaceableGoldAmount_2").innerHTML);
    var cost;
    switch(id){
        case 6:    cost=parseInt(document.getElementById("costcp").innerHTML); break;
        case 8:    cost=20; break;
        case 9:    cost=5; break;
        case 10:   cost=5; break;
        case 11:   cost=5; break;
        case 12:   cost=5; break;
        case 13:   cost=parseInt(document.getElementById("costres").innerHTML); break;
		case 21:   cost=parseInt(document.getElementById("offcost").innerHTML); break;
		case 31:   cost=parseInt(document.getElementById("defcost").innerHTML); break;
		default: cost = 0;
    }
    if(gold>0 && (gold-cost)>=0){
        Travian.ajax({
            data:{
                cmd:"buyplus&id="+id+"&r="+r
            },
            onSuccess:function(e){
                if(id<41 && id>7){
                    var hours=document.getElementById("time"+id).innerHTML;

                    if(id==21 || id==31){
                        var plus=parseInt(document.getElementById("offdefhour").innerHTML);
                    }else{
                        var plus=parseInt(document.getElementById("plushour").innerHTML);
                    }
                    if(hours==''){
                        $("hour"+id).innerHTML=" hours <b>0</b> minutes";
                        $("ost"+id).innerHTML="Remaining: ";
                        $("action"+id).innerHTML="Extend";
                    }
                    if(hours==''){ hours = 0;}else{hours = parseInt(hours);}
                    var newtime=hours+plus;
                    $("time"+id).innerHTML=newtime;
                }
                if(id==13 && r!=0){
                    location.reload();
                    return;
                }
                $("gold").innerHTML=gold-cost;
                $("ajaxReplaceableGoldAmount_2").innerHTML=gold2-cost;
            }
        })}else{
        location.reload();}
    return this
}, iPopupMap: function () {

    var w = window.innerWidth/1.35;
    var h = window.innerHeight/1.2;

    var width = w+"px";
    var  height = h+"px";

    ('<iframe class="popup"  id="Frame" src="fullmap.php"  width="'+width+'" height="'+height+'" frameborder = "no" scrolling="no" allowTransparency="true"></iframe>').dialog({

        title:"".translate(),
        buttonOk:false
    });
},Payment:function(tarif){
    ('<iframe class="popup"  id="Frame" src="payment.php?tarif='+tarif+'" width="700" scrolling="no" height="450" allowTransparency="true"></iframe>').dialog({
        title:"Покупка Золота".translate(),
        buttonOk:false
    });
}

    , iPopupAchiev: function () {


    ('<iframe class="popup"  id="Frame" src="achievDay.php"  width="560px" height="668px" frameborder = "no" scrolling="no" allowTransparency="true"></iframe>').dialog({

        title:"".translate(),
        draggable: true,
        enableBackground: false,
        buttonOk:false
    });
}

    , iPopup: function (a, b) {
    ('<iframe class="popup" frameborder="0" id="Frame" src="manual.php?typ=' + b + "&amp;gid=" + a + '" width="475" height="580" scrolling="no" border="0" allowTransparency="true"></iframe>').dialog({title: "{allgemein.anleitung}".translate(), buttonOk: false, enableBackground: false, draggable: true, fx: {options: {duration: 0}}});
    return false
}, unitZoom: function (a) {
    ('<div class="zoomTop"></div><div class="zoomMiddle"><img src="img/x.gif" class="unitBig u' + a + 'Big" /></div><div class="zoomBottom"></div>').dialog({buttonOk: false});
    return false
}, showEditVillageDialog: function (e, b, d, c) {
    var a = b + ' <input type="text" id="villageNameInput" name="villageName" value="" maxlength="20" class="text" />';
    a.dialog({title: e, relativeTo: $("villageName"), buttonTextOk: d, onOkay: function (f, g) {
        Travian.ajax({data: {cmd: "changeVillageName", name: $("villageNameInput").value, did: c}, onSuccess: function (h) {
            $("villageNameField").innerHTML = h.name
        }})
    }, onOpen: function (f, g) {
        g.down("#villageNameInput").value = $("villageNameField").get("text")
    }});
    return this
}};
window.addEvent("domready", function () {
    initTimer("l1", "lbar1");
    initTimer("l2", "lbar2");
    initTimer("l3", "lbar3");
    initTimer("l4", "lbar4");
    initCounter();
    $$("*.dynamic_img").addEvents({mouseenter: function () {
        this.addClass("over")
    }, mouseleave: function () {
        this.removeClass("over");
        this.removeClass("clicked")
    }, mousedown: function () {
        this.removeClass("over");
        this.addClass("clicked")
    }});
    if (Browser.ie6 || Browser.ie7) {
        Travian.forceDisplay()
    }
});
Travian.Game.Layout = {states: {travian_toggle: ["expanded", "collapsed"]}, toggleBox: function (d, f, b) {
    var a = this.readCookie(f);
    var c = a[b];
    var e = "";
    if (c == null) {
        c = this.states[f][0]
    }
    Array.each(this.states[f], function (g) {
        d.removeClass(g);
        if (g != c) {
            e = g;
            d.addClass(e);
            d.down("button.toggle").setTitle("{" + b + "_" + e + "}".translate())
        }
    });
    this.updateCookie(f, b, e)
}, readCookie: function (d) {
    var c = Cookie.read(d);
    var b = {};
    if (c != "" && c != null) {
        var a = c.split(",");
        Array.each(a, function (e) {
            var f = e.split(":");
            b[f[0]] = f[1]
        })
    }
    return b
}, updateCookie: function (e, b, d) {
    var a = this.readCookie(e);
    a[b] = d;
    var c = "";
    Object.each(a, function (g, f) {
        if (c != "") {
            c += ","
        }
        c += f + ":" + g
    });
    Cookie.write(e, c)
}, loadLayoutButtonTitle: function (a, c, b) {
    Travian.ajax({data: {cmd: "getLayoutButtonTitle", boxId: c, buttonId: b}, onSuccess: function (e) {
        var d = {title: e.newTitle, text: e.newText, unescaped: false};
        a.setTip(d);
        Travian.Tip.show(d)
    }})
}, setInfoboxItemsRead: function () {
    var b = $("sidebarBoxInfobox");
    if (b.hasClass("toggleable")) {
        var a = $$("#sidebarBoxInfobox li.unreaded").get("id");
        if (a.length > 0) {
            if (b.hasClass("expanded")) {
                Travian.ajax({data: {cmd: "infoboxSetReaded", infoIds: a}, onSuccess: function (c) {
                    $$("#sidebarBoxInfobox li.unreaded").removeClass("unreaded")
                }})
            } else {
                b.down("button.toggle").addEvent("click", function (d) {
                    var c = $$("#sidebarBoxInfobox li.unreaded").get("id");
                    if (b.hasClass("expanded") && c.length > 0) {
                        Travian.ajax({data: {cmd: "infoboxSetReaded", infoIds: c}, onSuccess: function (e) {
                            $$("#sidebarBoxInfobox li.unreaded").removeClass("unreaded")
                        }})
                    }
                })
            }
        }
    }
}, setupInfoboxItemsDeletionWithMessage: function (b, a) {
    $$(".infoboxDeleteButton").each(function (c) {
        c.addEvent("click", function (g) {
            var f = this.get("data-id");
            var d = new Travian.Dialog({buttonTextOk: a, onOkay: function () {
                Travian.ajax({data: {cmd: "infoboxDelete", id: f}, })
            }});
            d.setContent(b);
            d.show();
            return false
        })
    })
}, goldButtonAnimation: function (a) {
    if (a === undefined) {
        var a = true
    }
    var b = 30000;
    var g = 60;
    var e = 0;
    var f = "";
    var c = $$("#navigation .gold a");
    var d = function () {
        if (a) {
            var k = g;
            c.removeClass("ani_" + e);
            if (e < 12) {
                e++;
                c.addClass("ani_" + e)
            } else {
                e = 0;
                k = b
            }
        }
        f = window.setTimeout(d, k)
    };
    var h = function () {
        if (!Browser.ie6) {
            f = window.setTimeout(d, b);
            $$("#navigation .gold a").addEvent("mouseover", function () {
                clearTimeout(f);
                this.removeClass("ani_" + e);
                e = 0
            });
            $$("#navigation .gold a").addEvent("mouseout", function () {
                f = window.setTimeout(d, b)
            })
        }
    };
    h()
}};
Travian.Game.InputCoordinates = (function () {
    Element.inject = Element.inject.wrap(function (m, h, l, k) {
        e(Travian.Game.InputCoordinates, h);
        return m(h, l, k)
    });
    Element.prototype.inject = Element.prototype.inject.wrap(function (l, k, h) {
        e(Travian.Game.InputCoordinates, this);
        return l(k, h)
    });
    Element.insert = Element.insert.wrap(function (l, h, k) {
        return e(Travian.Game.InputCoordinates, l(h, k))
    });
    Element.prototype.insert = Element.prototype.insert.wrap(function (k, h) {
        return e(Travian.Game.InputCoordinates, k(h))
    });
    var e = function (k, h) {
        var l = {x: null, y: null};
        $(h).getElements(k.options.selector).each(function (m) {
            if (m.hasClass(k.options.classNames.x)) {
                l.x = m
            }
            if (m.hasClass(k.options.classNames.y)) {
                l.y = m
            }
            if (l.x != null && l.y != null) {
                k.add(l);
                l.x = null;
                l.y = null
            }
        });
        return h
    };
    var d = function (k, h) {
        var l = parseInt(h.value);
        if (l < k.options.range.min) {
            h.value = k.options.range.min;
            l = k.options.range.min
        } else {
            if (l > k.options.range.max) {
                h.value = k.options.range.max;
                l = k.options.range.max
            }
        }
        return l
    };
    var c = function (m, n, l) {
        var q = l.value;
        var o = m.options.splitChars.find(function (r) {
            return q.indexOf(r) != -1
        });
        if (!o) {
            return false
        }
        var k = q.split(o);
        if (k.length <= 1) {
            return false
        }
        var h = [k.shift(), k.join("")].map(function (r) {
            r = f(m, r);
            if (r < m.options.range.min) {
                r = m.options.range.min
            } else {
                if (r > m.options.range.max) {
                    r = m.options.range.max
                }
            }
            return parseInt(r)
        });
        if (typeof h[0] != "number" || typeof h[1] != "number" || h[0].isNaN() || h[1].isNaN()) {
            return false
        }
        n.x.value = h[0];
        n.y.value = h[1];
        return true
    };
    var f = function (h, k) {
        return k.split("").filter(function (m, l) {
            return(m == "-" || !parseInt(m).isNaN())
        }).filter(function (m, l) {
            return !(l >= 1 && m == "-")
        }).join("")
    };
    var a = function (m, h, k, l) {
        if (c(h, k, l)) {
            m.stop();
            return
        }
        l.value = f(h, l.value)
    };
    var b = function (m, h, l, k) {
        if (h.options.passThroughChars[m.code]) {
            return
        }
        if (m.control) {
            return
        }
        if (h.options.validChars[m.code] == "-" && l.value.indexOf("-") != -1 && l.getSelectionStart() != 0) {
            m.stop();
            return
        }
        if (h.options.splitChars[m.code]) {
            if (l.value.length != 0 && parseInt(l.value).isNaN() == false) {
                if (Browser.opera) {
                    l.value = f(h, l.value)
                }
                (k || Travian.emptyFunction)()
            }
            m.stop();
            return
        } else {
            if (!h.options.validChars[m.code]) {
                m.stop();
                return
            }
        }
    };
    var g = function (q, l, n, o, r, k) {
        if (l.options.passThroughChars[q.code]) {
            return
        }
        if (c(l, n, o)) {
            if (Browser.opera) {
                o.value = f(l, o.value)
            }
            (r || Travian.emptyFunction)();
            q.stop();
            return
        }
        if (q.control) {
            return
        }
        q.stop();
        var h = (o.value.length >= 1 && l.options.validChars[q.code] == "-");
        h = h || (l.options.splitChars[q.code]);
        h = h || (!l.options.validChars[q.code]);
        if (h) {
            return
        }
        var m = d(l, o);
        if (m.isNaN()) {
            return
        }
        h = m.sgn() == -1 && l.options.range.min.toString().length == m.toString().length;
        h = h || (m.sgn() >= 0 && l.options.range.max.toString().length == m.toString().length);
        if (h) {
            if (Browser.opera) {
                o.value = f(l, o.value)
            }
            (k || Travian.emptyFunction)();
            return
        }
    };
    return new (new Class({Implements: [Options], elements: [], options: {selector: "input[class~=coordinates]", classNames: {x: "x", y: "y"}, range: {min: -400, max: 400}, splitChars: $H({226: "|", 188: ",", 78: ",", 110: ",", 190: ".", 32: " "}), prefixChars: $H({107: "+", 43: "+", 109: "-", 189: "-", 173: "-"}), validChars: $H({109: "-", 189: "-", 173: "-", 96: "0", 97: "1", 98: "2", 99: "3", 100: "4", 101: "5", 102: "6", 103: "7", 104: "8", 105: "9", 48: "0", 49: "1", 50: "2", 51: "3", 52: "4", 53: "5", 54: "6", 55: "7", 56: "8", 57: "9"}), passThroughChars: $H({8: String.fromCharCode(8), 9: String.fromCharCode(9), 13: String.fromCharCode(13), 36: String.fromCharCode(36), 35: String.fromCharCode(35), 37: String.fromCharCode(37), 39: String.fromCharCode(39), 46: String.fromCharCode(46)})}, add: function (h) {
        var l = this;
        h = Object.clone(h);
        if (!h.x || !h.y) {
            return this
        }
        if (h.x._inputCoordinates && h.y._inputCoordinates) {
            return this
        }
        h.x._inputCoordinates = true;
        h.y._inputCoordinates = true;
        h.x.removeAttribute("maxlength");
        h.y.removeAttribute("maxlength");
        var k = null;
        h.x.addEvents({change: function (m) {
            a(m, l, h, h.x)
        }, keydown: function (m) {
            b(m, l, h.x, function () {
                h.y.focus()
            });
            return
        }, keyup: function (m) {
            g(m, l, h, h.x, function () {
                h.y.focus()
            }, function () {
                h.y.focus()
            })
        }});
        h.y.addEvents({change: function (m) {
            a(m, l, h, h.y)
        }, keydown: function (m) {
            b(m, l, h.y)
        }, keyup: function (m) {
            g(m, l, h, h.y)
        }});
        return this
    }, initialize: function (h) {
        var k = this;
        this.setOptions(h);
        $(document).addEvent("domready", (function () {
            e(k, document.body)
        }))
    }}))
})();
Travian.Game.ColorPicker = new Class({Implements: [Options, Events], options: {colors: [], defaultColor: -1, className: "moocolorcheckbox", selectedClassName: "moocolorcheckbox_selected"}, initialize: function (a, b) {
    var c = this;
    this.setOptions(b);
    this.container = $(a);
    this.container.setStyle("overflow", "hidden");
    this.container.addEvents({mouseenter: function () {
        c.fireEvent("mouseenter")
    }, mouseleave: function () {
        c.fireEvent("mouseleave")
    }});
    this.draw();
    if (this.options.defaultColor >= 0) {
        this.selectColor(this.options.colors[this.options.defaultColor])
    }
    return this
}, addColor: function (a) {
    if (!a) {
        return this
    }
    this.options.colors.include(a);
    this.draw();
    return this.draw()
}, removeColor: function (a) {
    if (!a) {
        return this
    }
    this.options.colors.erase(a);
    return this.draw()
}, selectColor: function (a) {
    if (!a) {
        return this
    }
    var b = this;
    this.container.getElements("div.moocolorcheckbox-container").each(function (c) {
        if (c.down(".entry").getStyle("background-color").toUpperCase() == a.toUpperCase()) {
            b.fireEvent("change", [a, c]);
            c.addClass(b.options.selectedClassName)
        } else {
            c.removeClass(b.options.selectedClassName)
        }
    });
    return this
}, getContainer: function () {
    return this.container
}, draw: function () {
    var a = this;
    this.container.empty();
    this.options.colors.each(function (b, c) {
        var e = new Element("div", {"class": a.options.className + " moocolorcheckbox-container"});
        var d = new Element("div", {"class": "entry"});
        d.set("html", "&nbsp;").setStyles({"background-color": b}).inject(e);
        e.setStyles({"float": "left", cursor: "pointer"}).addEvents({click: function () {
            a.selectColor(b)
        }, mouseenter: function () {
            a.fireEvent("mouseenter", [e])
        }, mouseleave: function () {
            a.fireEvent("mouseleave", [e])
        }}).inject(a.container)
    });
    return this
}});
Travian.Game.ImagePicker = new Class({Implements: [Options, Events], options: {images: [], defaultImage: -1, className: "mooimagecheckbox", selectedClassName: "mooimagecheckbox_selected"}, initialize: function (a, b) {
    var c = this;
    this.setOptions(b);
    this.container = $(a);
    this.container.setStyle("overflow", "hidden");
    this.container.addEvents({mouseenter: function () {
        c.fireEvent("mouseenter")
    }, mouseleave: function () {
        c.fireEvent("mouseleave")
    }});
    this.draw();
    if (this.options.defaultImage >= 0) {
        this.selectImage(this.options.images[this.options.defaultImage])
    }
    return this
}, addImage: function (a) {
    if (!a) {
        return this
    }
    this.options.images.include(a);
    this.draw();
    return this.draw()
}, removeImage: function (a) {
    if (!a) {
        return this
    }
    this.options.images.erase(a);
    return this.draw()
}, selectImage: function (b) {
    if (!b) {
        return this
    }
    var a = this;
    this.container.getElements("div").each(function (c) {
        var d = c.down("img")._src;
        if (d.toUpperCase() == b.toUpperCase()) {
            a.fireEvent("change", [b, c]);
            c.addClass(a.options.selectedClassName)
        } else {
            c.removeClass(a.options.selectedClassName)
        }
    });
    return this
}, getContainer: function () {
    return this.container
}, draw: function () {
    var a = this;
    this.container.empty();
    this.options.images.each(function (c, b) {
        var d = new Element("div", {"class": a.options.className});
        d.set("html", '<img src="' + c + '" alt="" />').down("img")._src = c;
        d.setStyles({"float": "left", cursor: "pointer"}).addEvents({click: function () {
            a.selectImage(c)
        }, mouseenter: function () {
            a.fireEvent("mouseenter", [d])
        }, mouseleave: function () {
            a.fireEvent("mouseleave", [d])
        }}).inject(a.container)
    });
    return this
}});
Travian.Game.Menu = new Class({initialize: function (a) {
    var c = $(a);
    var b = this;
    c.getElements("a").each(function (f) {
        var d = f.getParent(".normal");
        if (!d) {
            return
        }
        if (d.hasClass("gold")) {
            d.addEvents({mouseenter: function (g) {
                d.toggleClass("hover")
            }, mouseleave: function (g) {
                d.toggleClass("hover")
            }});
            return
        }
        d.addEvents({mouseenter: function (h) {
            var g = b.getMorphContainer(h);
            if (typeOf(g._fxMenu) != "null" && g._fxMenu.cancel) {
                g._fxMenu.cancel()
            }
            g._fxMenu = (new Fx.Morph(g, {duration: 200, transition: Fx.Transitions.Sine.easeOut, unit: true})).start({height: 39, "margin-top": 0})
        }, mouseleave: function (h) {
            var g = b.getMorphContainer(h);
            if (typeOf(g._fxMenu) != "null" && g._fxMenu.cancel) {
                g._fxMenu.cancel()
            }
            g._fxMenu = (new Fx.Morph(g, {duration: 200, transition: Fx.Transitions.Sine.easeOut, unit: true})).start({height: 30, "margin-top": 8})
        }})
    })
}, getMorphContainer: function (b) {
    var a = $(b.target);
    if (a.getParent(".container")) {
        var a = a.getParent(".container")
    }
    return a
}});
Travian.Game.SwitchDown = new Class({initialize: function (a) {
    var b = a;
    b.getChildren().each(function (c) {
        c.addEvent("click", function (d) {
            b.getChildren().toggleClass("hide");
            d.stop();
            return false
        })
    })
}});
Travian.Game.AddLine = new Class({Implements: [Options, Events], options: {insertAfterLastEntry: true, elements: {add: null, insert: null, table: null, template: null}, entryCount: 0, maxEntries: false, selectors: {add: ".addLine.addElement", insert: ".addLine.insertElement", template: ".addLine.templateElement"}}, getEntryCount: function () {
    return this.options.entryCount
}, initialize: function (a) {
    var b = this;
    this.setOptions(a);
    if (!this.options.elements.table) {
        throw"Table element for Travian.Game.AddLine is not definied"
    }
    this.options.elements.table = $(this.options.elements.table);
    $w("template add insert").each(function (c) {
        if (!b.options.elements[c]) {
            b.options.elements[c] = b.options.elements.table.down(b.options.selectors[c])
        }
        if (!b.options.elements[c]) {
            throw'Element "' + c + '" for Travian.Game.AddLine is not definied'
        }
    });
    this.options.elements.add.addClass("addLine removeElement");
    this.options.elements.template = $(this.options.elements.template).cloneNode(true);
    this.options.elements.add.removeClass("addLine removeElement");
    this.options.elements.add.addEvent("click", function (g) {
        var f = null;
        var d = null;
        var c = null;
        g.stop();
        b.fireEvent("addBefore", [b]);
        b.fireEvent("cloneBefore", [b]);
        f = b.options.elements.template.cloneNode(true);
        b.fireEvent("cloneAfter", [b, f]);
        d = f.select("label", "input", "textarea", "button", "select");
        b.fireEvent("insertBefore", [b, f]);
        d.each(function (e) {
            if (e.tagName.toLowerCase() == "input") {
                if (e.type.toLowerCase() == "checkbox" || e.type.toLowerCase() == "radio") {
                    e.tagName.checked = false
                } else {
                    if (e.type.toLowerCase() == "text" || e.type.toLowerCase() == "password") {
                        e.tagName.value = ""
                    }
                }
            } else {
                if (e.tagName.toLowerCase() == "select") {
                    e.tagName.selectedIndex = -1
                } else {
                    if (e.tagName.toLowerCase() == "textarea") {
                        e.tagName.value = ""
                    }
                }
            }
            b.fireEvent("insertInputBefore", [b, f, e])
        });
        b.options.elements.insert.insert({after: f.setStyles({opacity: 0})});
        c = f.down(".addLine.removeElement");
        if (c) {
            c.insert({after: b.options.elements.add});
            c.dispose()
        }
        b.options.entryCount++;
        if (b.options.maxEntries !== false && b.options.maxEntries == b.options.entryCount) {
            b.options.elements.add.dispose();
            Travian.Tip.hide()
        }
        d.each(function (e) {
            b.fireEvent("insertInputAfter", [b, f, e])
        });
        new Fx.Morph(f, {duration: 400}).start({opacity: [0, 1]});
        b.fireEvent("insertAfter", [b, f]);
        if (b.options.insertAfterLastEntry === true) {
            b.options.elements.insert = f
        }
        b.fireEvent("addAfter", [b, f])
    })
}});
Travian.Game.AutoCompleter = new Class({Extends: Travian.AutoCompleter, initialize: function (b, a) {
    this.parent(b, "ajax.php?cmd=autoComplete", a)
}});
Travian.Game.AutoCompleter.UserName = new Class({Extends: Travian.Game.AutoCompleter, initialize: function (a) {
    this.parent(a, {postData: {type: "username"}})
}});
Travian.Game.AutoCompleter.VillageName = new Class({Extends: Travian.Game.AutoCompleter, initialize: function (a) {
    this.parent(a, {maxChoices: 20, postData: {type: "villagename"}})
}});
Travian.Game.Messages = {};
Travian.Game.Messages.Write = {receivertext: "", initialize: function () {
    $("ally").addEvent("click", function () {
        $("recipient").getElement("input").set("value", "[ally]")
    });
    new Travian.Game.AutoCompleter.UserName("receiver");
    var a = false;
    var b = false;
    $("receiver").up("form").addEvent("submit", function (c) {
        c.stop();
        if (!b) {
            b = true;
            receivertext = $("receiver").get("value");
            Travian.ajax({data: {cmd: "checkRecipient", recipient: $("receiver").get("value")}, onSuccess: function () {
                $("receiver").up("form").submit();
                a = true;
                b = false
            }, onComplete: function () {
                b = false
            }})
        }
    })
}, showAddressBook: function (a) {
    var b = true;
    if (this.addressBookDialog) {
        $(a).removeClass("hide");
        this.addressBookDialog.show()
    } else {
        this.addressBookDialog = "".dialog({title: "{nachrichten.adressbuch}".translate(), buttonTextOk: "{allgemein.save}".translate(), submitMethod: "post", submitUrl: "nachrichten.php", destroyElement: false, onOpen: function (c, d) {
            $$(".dialog").removeClass("hide");
            if (!b) {
                return
            }
            b = false;
            $(a).removeClass("hide");
            $(a).inject(d);
            d.getElements("td.pla a").addEvent("click", function (f) {
                c.close();
                $("recipient").getElement("input").set("value", $(f.target).get("text"));
                f.stop()
            })
        }, onClose: function () {
            $$(".dialog").addClass("hide")
        }}).dialog
    }
    return this
}};
Travian.Game.Notice = new Class({maxNotesLength: -1, element: null, initialize: function (a) {
    if (typeof a === "undefined") {
        a = -1
    }
    this.maxNotesLength = parseInt(a);
    this.element = $("notice");
    var b = this;
    $("send").addEvent("click", function (c) {
        if (!b.DoubleClickPreventer) {
            b.DoubleClickPreventer = new Travian.DoubleClickPreventer();
            b.DoubleClickPreventer.timeout = 250
        }
        if (!b.DoubleClickPreventer.check()) {
            return
        }
        if (!b.checkMaxLength()) {
            c.preventDefault();
            b.showNoticeTooLongMessage()
        }
    })
}, showNoticeTooLongMessage: function () {
    Travian.Translation.get("nachrichten.notice_too_long").dialog()
}, checkMaxLength: function () {
    if (this.element == null) {
        return false
    }
    if (this.maxNotesLength < 0) {
        return true
    }
    return this.element.value.length <= this.maxNotesLength
}});
Travian.Game.BBEditor = (function () {
    var a = function (d, e) {
        var c = d;
        if (d.nodeName.toLowerCase() == "img") {
            d = c.up("button");
            if (!d) {
                d = c.up("a")
            }
        }
        var b = d.className.split(" ").find(function (f) {
            if (f.indexOf(e) == 0) {
                return true
            }
            return false
        });
        if (b) {
            b = b.substr(0, b.length - 1).split("{");
            if (b.length == 2) {
                b = b[1]
            } else {
                b = null
            }
        }
        return b
    };
    return new Class({preview: null, textArea: null, id: null, Binds: ["fetchPreview", "showToolbarWindow", "insertTag", "insertSingleTag", "insertSmilieTag", "hideToolbarWindow", "showPreview", "hidePreview"], initialize: function (b) {
        this.id = b;
        this.textArea = $(b);
        this.toolbar = $(b + "_toolbar");
        this.preview = $(b + "_preview");
        this.preview.setStyle("display", "none");
        this.preview.addClass("preview");

        $(b + "_resourceButton").addEvent("click", this.showToolbarWindow);
        $(b + "_smilieButton").addEvent("click", this.showToolbarWindow);
        $(b + "_troopButton").addEvent("click", this.showToolbarWindow);
        $(b).addEvent("click", this.hideToolbarWindow);
        this.addEvent($(b + "_toolbar"), this.insertTag);
        this.addEvent($(b + "_resources"), this.insertTag);
        this.addEvent($(b + "_smilies"), this.insertTag);
        this.addEvent($(b + "_troops"), this.insertTag)
    }, addEvent: function (d, b) {
        var c = d.getChildren();
        for (i = 0; i < c.length; i++) {
            if (a($(c[i]), "bbTag")) {
                $(c[i]).addEvent("click", b)
            }
        }
    }, insertTag: function (d) {
        d.stop();
        this.hidePreview();
        if ($(d.target).match("button")) {
            var c = $(d.target)
        } else {
            var c = $(d.target.parentNode)
        }
        var b = a(c, "bbTag");
        switch (a(c, "bbType")) {
            case"d":
                this.textArea.insertAroundCursor({before: "[" + b + "]", after: "[/" + b + "]"});
                break;
            case"s":
                this.textArea.insertAtCursor(b, false);
                break;
            case"o":
                this.textArea.insertAtCursor("[" + a(c, "bbTag") + "]", false);
                break
        }
    }, showToolbarWindow: function (f) {
        f.stop();
        var d = f.target;
        var c = $(this.id + "_" + a(d, "bbWin"));
        var b = true;
        if (c.getStyle("display") == "block") {
            b = false
        }
        this.hideToolbarWindow();
        if (b) {
            c.fade("hide").fade("in");
            c.setStyle("display", "block")
        }
    }, hideToolbarWindow: function (b) {
        if (b) {
            b.stop()
        }
        var c = $(this.id + "_toolbarWindows").getChildren();
        for (i = 0; i < c.length; i++) {
            $(c[i]).setStyle("display", "none")
        }
    }, fetchPreview: function (b) {
        b.stop();
        if (this.textArea.getStyle("display") == "none" || this.textArea.value.length < 1) {
            this.hidePreview();
            return
        }
        $this = this;
        Travian.ajax({data: {cmd: "bb", nl2br: 1, target: this.id, text: this.textArea.value}, onSuccess: function (c) {
            $this.showPreview(c)
        }})
    }, showPreview: function (b) {
        if (b.error === true) {
            alert(b.errorMsg);
            return
        } else {
            this.preview.innerHTML = b.text;
            this.preview.setStyle("display", "block");
            this.textArea.setStyle("display", "none")
        }
    }, hidePreview: function () {
        this.preview.setStyle("display", "none");
        this.textArea.setStyle("display", "inline")
    }})
})();
Travian.Game.GoldToSilver = (function () {
    var a = function (d, c, e) {
        return(e >= 1 && c >= e)
    };
    var b = function (c, d, e) {
        return(e >= 1 && e >= c.options.rateSilverToGold && d >= e)
    };
    return new Class({Binds: ["transfer", "transferSilverToGold"], Implements: [Options], options: {elementInputGold: null, elementInputSilver: null, elementResultGold: null, elementResultSilver: null, gold: null, rateGoldToSilver: null, rateSilverToGold: null, silver: null, lastFocusedElement: null}, initialize: function (c) {
        this.setOptions(c);
        this.options.elementInputGold = $(this.options.elementInputGold);
        this.options.elementInputSilver = $(this.options.elementInputSilver);
        this.options.elementResultGold = $(this.options.elementResultGold);
        this.options.elementResultSilver = $(this.options.elementResultSilver);
        this.options.elementInputGold.addEvent("keyup", this.transfer);
        this.options.elementInputSilver.addEvent("keyup", this.transfer)
    }, handleFocusChange: function (c) {
        if (this.options.lastFocusedElement != c) {
            if (c != this.options.elementInputGold) {
                this.options.elementInputGold.value = ""
            } else {
                this.options.elementInputSilver.value = ""
            }
            this.options.lastFocusedElement = c
        }
    }, transfer: function (h) {
        this.handleFocusChange(h.target);
        var d = parseInt(this.options.elementInputGold.value);
        var g = parseInt(this.options.elementInputSilver.value);
        var c = this.options.gold;
        var f = this.options.silver;
        if (typeOf(d) == "null" || a(this, c, d) == false) {
            d = 0
        }
        d = Math.floor(d * this.options.rateGoldToSilver) / this.options.rateGoldToSilver;
        f += Math.floor(d * this.options.rateGoldToSilver);
        c -= d;
        if (typeOf(g) == "null" || b(this, f, g) == false) {
            g = 0
        }
        g = Math.floor(g / this.options.rateSilverToGold) * this.options.rateSilverToGold;
        c += Math.floor(g / this.options.rateSilverToGold);
        f -= g;
        c -= this.options.gold;
        f -= this.options.silver;
        if (c > 0) {
            c = "+" + c
        }
        if (f > 0) {
            f = "+" + f
        }
        this.options.elementResultGold.set("html", c);
        this.options.elementResultSilver.set("html", f);
        return this
    }})
})();
Travian.Game.RaidList = {data: null, addSlot: function (b) {
    var c = $("list" + b);
    var a = c.down("input[name=sort]").value;
    var d = c.down("input[name=direction]").value;
    window.location.href = "build.php?gid=16&t=99&action=showSlot&lid=" + b + "&sort=" + a + "&direction=" + d
}, editSlot: function (b, c) {
    var d = $("list" + b);
    var a = d.down("input[name=sort]").value;
    var e = d.down("input[name=direction]").value;
    window.location.href = "build.php?gid=16&t=99&action=showSlot&eid=" + c + "&sort=" + a + "&direction=" + e
}, loadList: function (b, a, e) {
    var d = this;
    var c = $("list" + b);
    c.down(".loading").toggleClass("hide");
    Travian.ajax({data: {cmd: "raidListSlots", lid: b, sort: a, direction: e}, onComplete: function () {
        c.down(".loading").toggleClass("hide")
    }, onSuccess: function (f) {
        c.down(".listContent").set("html", f.html);
        d.data[b] = f.list;
        c.down("input[name=sort]").value = f.sort;
        c.down("input[name=direction]").value = f.direction
    }});
    return this
}, markAllSlotsOfAListForRaid: function (a, b) {
    Object.each(this.data[a].slots, function (c) {
        c.marked = b
    });
    $("list" + a).getElements(".markSlot").each(function (c) {
        c.checked = b
    });
    this.updateTroopSummaryForAList(a);
    return this
}, markSlotForRaid: function (a, b, c, d) {
    this.data[a].slots[b].marked = c;
    if (typeof d == "undefined" || d) {
        this.updateTroopSummaryForAList(a)
    }
    return this
}, setData: function (a) {
    this.data = a
}, sort: function (a, b) {
    return this.loadList(a, b, this.data[a].directions[b] != "asc" ? "asc" : "desc")
}, toggleList: function (a) {
    var b = $("list" + a);
    if (typeof this.data[a] == "undefined") {
        this.loadList(a)
    }
    Travian.toggleSwitch(b.down(".listContent"), b.down(".openedClosedSwitch"));
    return this
}, updateTroopSummaryForAList: function (b) {
    var c = this;
    var a = $H(this.data[b].slots).inject([0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], function (e, f) {
        if (f.marked) {
            for (var d = 1;
                 d <= 10; d++) {
                e[d] += f.troops[d]
            }
        }
        return e
    });
    $("list" + b).getElements(".troopSelectionValue").each(function (e, d) {
        if (a[d + 1] > 0) {
            e.set("html", '<span class="{alert}">{selected}/{available}'.substitute({selected: a[d + 1], available: c.data[b].troops[d + 1], alert: a[d + 1] > c.data[b].troops[d + 1] ? "alert" : ""})).up(".troopSelectionUnit").show()
        } else {
            e.up(".troopSelectionUnit").hide()
        }
    });
    return this
}};
Travian.Game.Reports = {editRights: function (b, a) {
    Travian.ajax({data: {cmd: "reportRightsGet", reportId: a.datas.reportId}, onSuccess: function (d) {
        a.datas = Object.merge({}, a.datas || {}, d || {});
        var c = '<div class="reports" id="editRights"><div><input type="checkbox" id="right1" class="check" /> {anonymOpponent}</div><div><input type="checkbox" id="right2" class="check" /> {anonymMyself}</div><div><input type="checkbox" id="right3" class="check" /> {hiddenOwnTroops}</div><div><input type="checkbox" id="right4" class="check" /> {hiddenOtherTroops}</div><div class="description">{description}<br /><textarea id="description"></textarea></div></div>';
        c.substitute(a.text).dialog({relativeTo: b, buttonTextOk: a.text.buttonTextOk, buttonTextCancel: a.text.buttonTextCancel, title: a.text.title, onOpen: function (e, f) {
            $("right1").checked = a.datas.right1;
            $("right2").checked = a.datas.right2;
            $("right3").checked = a.datas.right3;
            $("right4").checked = a.datas.right4;
            $("description").innerHTML = a.datas.description
        }, onOkay: function (e, f) {
            Travian.ajax({data: {cmd: "reportRightsSet", data: Object.merge({}, a.datas, {right1: $("right1").checked, right2: $("right2").checked, right3: $("right3").checked, right4: $("right4").checked, description: $("description").value})}})
        }})
    }});
    return false
}};
Travian.Game.Hero = {};
Travian.Game.Hero.Editor = function () {
    var a = null;
    return new Class({unloadIdentifier: null, Implements: [Options], options: {attributes: null, element: null, command: null, attributes: null, urlHeroImage: null, elementHeroImage: null}, hideAll: function () {
        var b = this.options.element.getElements(".attributes .container .infoOpen").removeClass("infoOpen");
        b.down(".headline").removeClass("switchOpened").addClass("switchClosed");
        this.options.element.getElements(".attributes .container .details").hide();
        if (Browser.ie6) {
            b.setStyles({height: "auto"})
        }
        return this
    }, initialize: function (b) {
        var d = this;
        d.initializeAttributes(b);
        var c = this.options.element.down("#save");
        if (c != null) {
            c.addEvent("click", function (f) {
                d.sendAction("save", function () {
                    var e = d.options.urlHeroImage.substitute({time: (new Date()).getTime()});
                    $$("." + d.options.elementHeroImage).set("src", e)
                });
                f.stop()
            })
        }
        var c = this.options.element.down("#random");
        if (c != null) {
            c.removeEvent("click", a);
            a = function (f) {
                d.sendAction("random");
                f.stop()
            };
            c.addEvent("click", a)
        }
        this.bindGenderSwitch();
        this.storeAttributesInInput(this.options.attributes)
    }, initializeAttributes: function (b) {
        var c = this;
        this.setOptions(b);
        this.options.element = $(this.options.element);
        this.hideAll();
        this.options.element.getElements(".attributes .container .info").each(function (d) {
            d.addEvent("click", function (e) {
                c.showAttribute(d);
                e.preventDefault()
            })
        });
        this.options.element.getElements(".attributes .container .attribute").addEvent("click", function (f) {
            var g = parseInt(f.target.id.split("attribute_button_")[1]);
            var d = f.target.getParent(".info").id;
            c.options.attributes[d] = g;
            c.sendAction("show");
            f.stop()
        })
    }, sendAction: function (b, d) {
        if (b == "save") {
            Travian.Form.UnloadHelper.disableSecurity(this.unloadIdentifier)
        } else {
            this.unloadIdentifier = Travian.Form.UnloadHelper.enableSecurity(this.unloadIdentifier)
        }
        var c = this;
        Travian.ajax({data: {cmd: this.options.command, action: b, attribs: this.options.attributes}, onSuccess: function (e) {
            $$(".hero_head .image").set("html", e.html);
            if (e.attributesHtml) {
                $("attributesContainer").set("html", e.attributesHtml);
                c.initializeAttributes(c.options)
            }
            c.options.attributes = e.attributes;
            c.storeAttributesInInput(e.attributes);
            (d || Travian.emptyFunction)()
        }});
        return this
    }, showAttribute: function (d) {
        this.hideAll();
        if (d.hasClass("infoOpen")) {
            return
        }
        d.addClass("infoOpen");
        var b = d.down(".headline").removeClass("switchClosed").addClass("switchOpened");
        var c = d.down(".details").show();
        if (Browser.ie6) {
            c.setStyles({position: "absolute", left: 0, top: b.getSize().y});
            d.setStyles({position: "relative", height: c.getSize().y + b.getSize().y})
        }
        return this
    }, storeAttributesInInput: function (c) {
        var b = this.options.element.down("input[name=attributes]");
        if (b != null) {
            b.set("value", escape(JSON.encode(c)))
        }
        return this
    }, switchGender: function (b) {
        if ($(this.options.element).hasClass("genderSwitch")) {
            if (b == "male") {
                this.options.element.removeClass("female").addClass("male");
                $("heroEditorActivateMale").addClass("iconActive disabled");
                $("heroEditorActivateFemale").removeClass("iconActive disabled")
            } else {
                this.options.element.removeClass("male").addClass("female");
                $("heroEditorActivateFemale").addClass("iconActive disabled");
                $("heroEditorActivateMale").removeClass("iconActive disabled")
            }
        }
        this.options.attributes.gender = b;
        this.sendAction("gender")
    }, bindGenderSwitch: function () {
        var b = this;
        $$("#heroEditorActivateMale, #heroEditorActivateFemale").addEvent("click", function (c) {
            if (this.get("id") == "heroEditorActivateMale" && b.options.element.hasClass("male") == false) {
                b.switchGender("male")
            } else {
                if (this.get("id") == "heroEditorActivateFemale" && b.options.element.hasClass("female") == false) {
                    b.switchGender("female")
                }
            }
            c.stop()
        })
    }})
}();
Travian.Game.Hero.Inventory = new Class({Implements: [Options], dragStatus: false, items: [], options: {a: null, c: null, gender: "male", heroState: {}, isInVillage: true, isDead: false, data: [], heroBodyHash: false, images: "img/hero/items/item{typeId}.png", text: {moveDialogDescription: "Anzahl der zu verschiebenden Items: {inputField}", useDialogDescription: "Anzahl der zu anwendenden Items: {inputField}", moveDialogTitle: "Verschieben!", useDialogTitle: "Anwenden!", useOneDialogTitle: "Soll dieser Gegenstand wirklich benutzt werden?", buttonOk: "Ok", buttonCancel: "Cancel"}}, startDrop: false, createAndAddItem: function (a) {
    this.items.include(Object.merge({placeElement: undefined, html_id: "item_" + a.id}, a || {}));
    return this
}, createDivs: function () {
    var a = this;
    var b = $("placeHolder");
    this.items.each(function (g, d) {
        g.isUseable = (g.slot == "bag" || a.options.isInVillage);
        if (a.options.isDead && !g.isUsableIfDead) {
            g.isUseable = false
        }
        var f = "";
        if (!g.isUseable) {
            if (a.options.isDead) {
                f = a.options.text.notMoveableTextDead
            } else {
                f = a.options.text.notMoveableText
            }
            f += "<br />"
        }
        f += g.attributes.join("<br />");
        var e = (new Element("div", {id: "item_" + g.id, "class": "item " + a.options.gender + "_item_" + g.typeId + " " + (g.isUseable ? "" : "disabled"), html: '<div class="amount">' + g.amount + "</div>", styles: {position: "relative"}, events: {click: function () {
            if (g.isUseable) {
                if (!Travian.isMobile() || (g.clickedFirstTime && Travian.isMobile())) {
                    Travian.Tip.hide();
                    a.moveToMatchingPlace(this)
                } else {
                    if (a.startDrop != true) {
                        a.mark(g.slot)
                    }
                    g.clickedFirstTime = true
                }
            }
        }, mouseover: function () {
            if (g.isUseable) {
                if (a.startDrop != true) {
                    a.mark(g.slot)
                }
            }
        }, mouseout: function () {
            if (g.isUseable) {
                if (a.startDrop != true) {
                    a.unMark(g.slot)
                }
            }
        }}}));
        e.setTip({unescaped: true, title: "(" + g.amount + ") " + g.name, text: f});
        e.inject(b);
        e.item = g;
        var c = null;
        if (g.placeId == 0) {
            c = $(g.slot);
            e.addClass("onHero")
        } else {
            c = $("inventory_" + g.placeId)
        }
        a.moveToDrop(e, c.addClass(g.isUseable ? "" : "disabled"), true)
    });
    this.makeDraggable();
    $(this.options.elementHeroBody).src = this.options.urlBodyImage.substitute({heroBodyHash: this.options.heroBodyHash});
    return this
}, dialog: function (a) {
    var d = this;
    var e = a.text;
    var c = a.amount;
    var b = a.calculate;
    delete (a.text);
    delete (a.amount);
    delete (a.calculate);
    a.onOpen = (a.onOpen || Travian.emptyFunction).wrap(function (l, k, m) {
        var h = m.down("#amount");
        if (h) {
            h.value = c
        }
        if (b) {
            var f = m.down(b.selectorDisplayUseValue || ".displayUseValue");
            var n = m.down(b.selectorDisplayAfterUse || ".displayAfterUse");
            if (!f) {
                throw'missing elementByItem in item dialog. Selector does not match "' + (b.selectorDisplayUseValue || ".displayUseValue") + '"'
            }
            if (!n) {
                throw'missing elementByItem in item dialog. Selector does not match "' + (b.selectorDisplayAfterUse || ".displayAfterUse") + '"'
            }
            var g = function (q) {
                q = parseInt(q);
                if (q.isNaN() || q < 0) {
                    q = 0
                }
                var o = q * b.valuePerItem;
                f.set("html", o);
                n.set("html", b.currentValue + o)
            };
            g(h.value);
            h.addEvent("keyup", function (o) {
                g(h.value)
            })
        }
        return l(k, m)
    });
    a = Object.merge(a, {buttonTextOk: this.options.text.buttonOk, buttonTextCancel: this.options.text.buttonCancel});
    e.substitute({inputField: '<input class="text" id="amount" type="text" value="0" />'}).dialog(a);
    return this
}, executeMovement: function (d, b, a) {
    var c = this;
    if (!c.DoubleClickPreventer) {
        c.DoubleClickPreventer = new Travian.DoubleClickPreventer();
        c.DoubleClickPreventer.timeout = 2000
    }
    if (!c.DoubleClickPreventer.check()) {
        return false
    }
    Travian.ajax({data: {cmd: "heroInventory", id: d, drid: b, amount: a, a: this.options.a, c: this.options.c}, onSuccess: function (h) {
        c.options.c = h.checkSum;
        c.options.heroState = Object.merge(c.options.heroState, h.heroState || {});
        if (h.heroBodyHash) {
            c.options.heroBodyHash = h.heroBodyHash
        }
        c.items.each(function (m, l) {
            $(m.html_id).dispose()
        });
        c.items = new Array();
        h.items.each(function (m, l) {
            c.createAndAddItem(m)
        });
        $$(".inventory").each(function (l) {
            l.dispose()
        });
        var k = h.inventorySize;
        if (h.heroData.freePoints > 0) {
            $$("div.hero_inventory .attribute .setPoint").show()
        }
        for (var f = 1, e = null; f <= k; f++) {
            e = new Element("div", {id: "inventory_" + f, "class": "inventory draggable"});
            e.inject($("itemsToSale").down(".market"), "before")
        }
        c.createDivs();
        var g = $("attributes");
        $H(h.heroData).each(function (o, m) {
            var n = g.down("." + m);
            if (n != null) {
                var q = n.down(".current");
                var r = n.down(".progress .bar");
                var t = n.down(".points");
                var l = n.getElements(".tooltip");
                if (n.hasClass("res")) {
                    var s = $("setResource").getElements(".resource label .current");
                    s.each(function (v, u) {
                        v.set("html", o["resourceHero" + u])
                    })
                }
                if (n.hasClass("tooltip")) {
                    l.push(n)
                }
                if (q && q.down(".value")) {
                    q = q.down(".value")
                }
                if (typeof o.current != "undefined" && q) {
                    q.set("html", o.current)
                }
                if (typeof o.percent != "undefined" && r) {
                    r.setStyles({width: o.percent + "%"});
                    if (typeof o.backgroundColor != "undefined") {
                        r.setStyles({backgroundColor: o.backgroundColor})
                    }
                }
                if (typeof o.points != "undefined" && t) {
                    if (t.down("input") !== null) {
                        t.down("input").value = o.points
                    } else {
                        t.set("html", o.points)
                    }
                }
                if (typeof o.tooltip != "undefined" && l.length) {
                    l.setTipUnescaped(o.tooltip)
                }
            }
        });
        g.down(".experience").down(".points").set("html", h.heroData.experience.current);
        if (g.down(".health")) {
            g.down(".health").down(".value").set("html", h.heroData.health.percent + "%");
            g.down(".health").down(".bar").setStyles({width: h.heroData.health.percent + "%"})
        }
        if (c.options.afterRequestCallback[h.itemTypeId]) {
            c.options.afterRequestCallback[h.itemTypeId](c, c.options, a, h)
        }
    }});
    return this
}, findFirstFreeInventory: function () {
    var a = null;
    $$(".inventory").each(function (b) {
        if (b.getChildren().length == 0 && a == null) {
            a = b
        }
    });
    return a
}, initialize: function (a) {
    var b = this;
    this.setOptions(a);
    this.options.data.each(function (c) {
        b.createAndAddItem(c)
    });
    this.createDivs()
}, isInventoryId: function (a) {
    return a.substr(0, 9) == "inventory"
}, makeDraggable: function () {
    var c = this;
    var a = $("drag_cont");
    var b = $$(".draggable");
    var d = $("text");
    $$(".item").each(function (e) {
        if (e.item.isUseable == false) {
            return
        }
        if (!Travian.isMobile()) {
            new Drag.Move(e, {droppables: b, container: a, handle: e, onDrop: function (f, g) {
                Travian.Tip.hide();
                if (c.startDrop == true) {
                    if (f.item.slot != "bag" && f.item.placeId == 0) {
                        f.addClass("onHero")
                    }
                    if (!g) {
                        c.moveToDrop(f, f.item.placeElement, true)
                    } else {
                        if (g.id == f.item.slot || c.isInventoryId(g.id)) {
                            f.addClass("highlight");
                            (function () {
                                f.removeClass("highlight")
                            }).delay(500);
                            c.unMark(g);
                            if (f.item.placeElement != g) {
                                c.moveToDrop(f, g)
                            } else {
                                c.moveToDrop(f, f.item.placeElement, true)
                            }
                        } else {
                            c.moveToDrop(f, f.item.placeElement, true)
                        }
                    }
                    c.startDrop = false;
                    f.removeClass("whileDragging")
                }
                if ($$("body")[0].hasClass("ie6") || $$("body")[0].hasClass("ie7")) {
                    f.getParents().each(function (h) {
                        if (h.id == "bodyOptions" || h.id == "hero_inventory") {
                            h.setStyles({zIndex: 0, position: "static"})
                        }
                    })
                }
                return true
            }, onLeave: function (f, g) {
            }, onEnter: function (f, g) {
                if (g.id == f.item.slot || g.id.substr(0, 9) == "inventory") {
                    c.mark(g)
                }
            }, onStart: function (f) {
                c.startDrop = true;
                c.dragStatus = true;
                f.addClass("whileDragging").removeClass("onHero");
                if ($$("body")[0].hasClass("ie6") || $$("body")[0].hasClass("ie7")) {
                    f.getParents().each(function (g) {
                        if (g.id == "bodyOptions" || g.id == "hero_inventory") {
                            g.setStyles({zIndex: 1, position: "relative"})
                        }
                    })
                }
            }})
        }
    });
    return this
}, mark: function (a) {
    $(a).addClass("heroMarked");
    return this
}, moveItem: function (c, a, b) {
    if (b) {
        this.executeMovement(c.item.id, a.id, b)
    } else {
        Element.dispose(c).inject(a)
    }
    this.resetItemDrop(c);
    c.item.placeElement = a;
    return this
}, moveToDrop: function (k, d, e) {
    var f = this;
    var a = null;
    var c = {title: "", text: "", executeAfterOkay: true, show: true, onOpen: Travian.emptyFunction, onOkay: Travian.emptyFunction, onCancel: Travian.emptyFunction, relativeTo: k, amount: k.item.amount};
    var g = false;
    var b = {title: "", text: ""};
    var h = function () {
        if (!c.executeAfterOkay) {
            f.resetItemDrop(k);
            return
        }
        var l;
        if (e) {
            l = false
        } else {
            if (k.item.amount == 1) {
                l = 1
            } else {
                if (g == true) {
                    l = $("amount").value
                } else {
                    l = k.item.amount
                }
            }
        }
        f.moveItem(k, d, l)
    };
    if (e != true && !this.isInventoryId(d.id) && ((k.item.instant && k.item.amount == 1) || k.item.amount > 1)) {
        if (this.options.useOneDialogTitleCallbacks[k.item.typeId]) {
            c = Object.merge(c, this.options.useOneDialogTitleCallbacks[k.item.typeId](k.item, this.options, c) || {})
        }
        g = true;
        if (k.item.instant) {
            if (k.item.amount == 1) {
                b.title = this.options.text.useDialogTitle;
                b.text = this.options.text.useOneDialogTitle
            } else {
                b.title = this.options.text.useDialogTitle;
                b.text = this.options.text.useDialogDescription
            }
        } else {
            b.title = this.options.text.moveDialogTitle;
            b.text = this.options.text.moveDialogDescription
        }
        if (c.title == "") {
            c.title = b.title
        }
        if (c.text == "") {
            c.text = b.text
        }
        if (c.show) {
            c.onOkay = (c.onOkay || Travian.emptyFunction).wrap(function (m, l, n) {
                h(l, n);
                return m(l, n)
            });
            c.onCancel = (c.onCancel || Travian.emptyFunction).wrap(function (m, l, n) {
                f.moveToDrop(k, k.item.placeElement, true);
                return m(l, n)
            });
            this.dialog(c)
        }
    } else {
        h()
    }
    return this
}, moveToMatchingPlace: function (b) {
    if (this.dragStatus == false) {
        var c = b.item.slot;
        if (b.item.placeElement == $(c)) {
            var a = this.findFirstFreeInventory();
            this.moveToDrop(b, a)
        } else {
            this.moveToDrop(b, $(c))
        }
        this.unMark(c)
    } else {
        this.dragStatus = false
    }
    return this
}, resetItemDrop: function (a) {
    a.setStyles({left: 0, top: 0});
    return this
}, unMark: function (a) {
    $(a).removeClass("heroMarked");
    return this
}});
Travian.Game.Hero.SilverExchange = new Class({Implements: [Options, Events], options: {exchangeOptions: {directionType: "SilverToGold", showExchangeTypeElement: null, inputElement: null, resultValueElements: [], inputValueElements: [], baseMultiplier: 1, maxAmount: null, submitButton: null, handleMaxFunction: null, submitButtonClickListener: null}, messages: {notEnoughGold: null, autoCorrect: null, disabledSubmitTooltip: null, enabledSubmitTooltip: null, maxAmountTooltip: null}, maxAmountChangedFunction: null}, isWaiting: false, lastUseTimestamp: 0, initialize: function (a) {
    this.setOptions(a);
    if (this.options.exchangeOptions.showExchangeTypeElement) {
        this.assignListenerToShowExchangeType(this.options.exchangeOptions.showExchangeTypeElement)
    }
    if (this.options.exchangeOptions.submitButton && this.options.exchangeOptions.directionType == "SilverToGold") {
        var b = this;
        this.options.exchangeOptions.submitButton.addEvent("click", function (c) {
            b.sendAction(this);
            c.stop()
        })
    }
    if (this.options.exchangeOptions.inputElement) {
        this.assignListenerToExchangeInput(this.options.exchangeOptions.inputElement)
    }
}, assignListenerToExchangeInput: function (a) {
    var c = this;
    var b = function (d) {
        c.hideAllMessages();
        return c.updateExchangeValue(d)
    };
    a.filterInput({regex: /^[1-9][0-9]{0,6}$/, success: b});
    return this
}, updateExchangeValue: function (g) {
    this.setLastUseTimestamp();
    var d = this.options.exchangeOptions;
    var b = parseInt(g, 10) || 0;
    var f = 0;
    var c = "enabledSubmitTooltip";
    var a = d.handleMaxFunction;
    var e = true;
    if (d.maxAmount !== null && "function" == typeof a && b > d.maxAmount) {
        f = a.call(this, b);
        c = "maxAmountTooltip";
        this.updateElementsTooltip(d.submitButton, "maxAmountTooltip");
        $$("#silverExchange .exchangeType" + this.options.exchangeOptions.directionType + " input")[0].set("value", b);
        e = false
    } else {
        f = b
    }
    f = Math.floor(f * d.baseMultiplier);
    if (d.submitButton && f == 0) {
        this.disableElement(d.submitButton);
        c = "disabledSubmitTooltip"
    } else {
        if (d.submitButton) {
            this.enableElement(d.submitButton)
        }
    }
    this.updateElementsTooltip(d.submitButton, c);
    this.setElementsValue(d.resultValueElements, f);
    this.setElementsValue(d.inputValueElements, b);
    return e
}, setElementsValue: function (c, b) {
    if (typeof(c) == "object" && (c instanceof Array)) {
        for (var a = 0; a < c.length; a++) {
            c[a].element.set(c[a].setType, b)
        }
    }
    return this
}, assignListenerToShowExchangeType: function (b) {
    var c = this;
    var a = function (d) {
        c.switchToExchangeType();
        d.stop()
    };
    b.addEvent("click", a);
    return this
}, switchToExchangeType: function () {
    this.setLastUseTimestamp();
    this.inactivateEach("#silverExchange .directionButtons .directionButton");
    this.activate(this.options.exchangeOptions.showExchangeTypeElement);
    this.inactivateEach("#silverExchange .exchangeType");
    this.activate($$("#silverExchange .exchangeType" + this.options.exchangeOptions.directionType)[0]);
    this.hideAllMessages();
    this.updateExchangeValue($$("#silverExchange .exchangeType" + this.options.exchangeOptions.directionType + " input")[0].get("value"));
    return this
}, inactivateEach: function (a) {
    Array.each($$(a), function (b) {
        b.removeClass("active");
        b.addClass("disabled")
    })
}, activate: function (a) {
    a.addClass("active");
    a.removeClass("disabled");
    return this
}, showMessageByKey: function (a) {
    var b = this.options.messages[a];
    this.showMessage(b);
    return this
}, showMessage: function (b) {
    var a = '<span class="' + b.type + '">' + b.message + "</span>";
    $$("#silverExchange .exchangeMessageLine").set("html", a);
    return this
}, hideAllMessages: function () {
    $$("#silverExchange .exchangeMessageLine").set("html", "<span>&nbsp;</span>");
    return this
}, updateElementsTooltip: function (a, b) {
    if (this.options.messages[b] && this.options.messages[b].message) {
        a.setTip(this.options.messages[b].message)
    }
}, sendAction: function (c) {
    var g = this;
    g.setLastUseTimestamp();
    if (this.isButtonInactive(c)) {
        return false
    }
    if (this.isWaiting === true) {
        return false
    }
    this.isWaiting = true;
    this.disableElement(c);
    var b = $$("#silverExchange .exchangeType input.text");
    b.each(this.disableElement);
    var d = new Date().getTime();
    var f = this.options.exchangeOptions.directionType;
    var e = b.filter("input[class^=silverInput]")[0].get("value");
    var a = b.filter("input[class^=goldInput]")[0].get("value");
    Travian.ajax({data: {cmd: "silverExchange", exTyp: f, s: e, g: a}, onSuccess: function (h) {
        if (h.errorMessage) {
            g.setError(h)
        } else {
            var l = Math.max(0, 500 - (new Date().getTime() - d));
            var k = function (m) {
                if (m.message) {
                    this.isWaiting = false;
                    this.hideAllMessages();
                    this.overrideGoldAndSilver(m.oldGold, m.oldSilver, m.newGold, m.newSilver);
                    this.enableElement(c);
                    b.each(this.enableElement);
                    if (this.options.exchangeOptions.directionType == "SilverToGold") {
                        this.options.exchangeOptions.maxAmount = m.newSilver
                    } else {
                        this.options.exchangeOptions.maxAmount = m.newGold
                    }
                    if (this.options.maxAmountChangedFunction === "function") {
                        this.options.maxAmountChangedFunction.call(this, {oldGold: m.oldGold, oldSilver: m.oldSilver, newGold: m.newGold, newSilver: m.newSilver})
                    }
                    this.fireEvent("changeMaxAmounts", {oldGold: m.oldGold, oldSilver: m.oldSilver, newGold: m.newGold, newSilver: m.newSilver});
                    this.updateExchangeValue($$("#silverExchange .exchangeType" + this.options.exchangeOptions.directionType + " input")[0].get("value"));
                    this.showMessage(m.message)
                }
            }.delay(l, g, h)
        }
    }});
    return this
}, setMaxAmounts: function (a) {
    if (this.options.exchangeOptions.directionType == "SilverToGold") {
        this.options.exchangeOptions.maxAmount = a.newSilver
    } else {
        this.options.exchangeOptions.maxAmount = a.newGold
    }
    return this
}, disableElement: function (a) {
    a.addClass("disabled");
    return this
}, enableElement: function (a) {
    a.removeClass("disabled");
    return this
}, isButtonInactive: function (a) {
    return a.hasClass("disabled")
}, overrideGoldAndSilver: function (a, b, e, d) {
    if (e === undefined && d === undefined) {
        return this
    }
    var b = b;
    var a = a;
    var c = function (k) {
        if (this.type == "gold") {
            var g = parseInt(a);
            var h = parseInt(e)
        } else {
            var g = parseInt(b);
            var h = parseInt(d)
        }
        var f = k.get("html");
        var l = new Travian.Formatter({forceDecimal: false});
        f = l.removeNonDigits(f);
        itemDiff = g - f;
        k.set("html", h + itemDiff)
    };
    $$(".ajaxReplaceableSilverAmountDiff").each(c, {type: "silver"});
    $$(".ajaxReplaceableGoldAmountDiff").each(c, {type: "gold"});
    $$(".ajaxReplaceableSilverAmount").each(function (f) {
        f.set("html", d)
    });
    $$(".ajaxReplaceableGoldAmount").each(function (f) {
        f.set("html", e)
    });
    return this
}, setLastUseTimestamp: function () {
    window.lastTimestampUseSilverExchange = new Date().getTime()
}});
Travian.Game.Hero.Properties = {};
Travian.Game.Hero.Properties.PropertyForm = new Class({Extends: Travian.Form, unloadIdentifier: null, onDirty: function (c) {
    var b = this.elements.saveHeroAttributes.getInput();
    var a = $$(".heroAttributesFormMessage");
    if (c) {
        a.removeClass("hide");
        b.removeClass("disabled").disabled = false;
        this.unloadIdentifier = Travian.Form.UnloadHelper.enableSecurity(this.unloadIdentifier)
    } else {
        a.addClass("hide");
        b.addClass("disabled").disabled = true;
        Travian.Form.UnloadHelper.disableSecurity(this.unloadIdentifier)
    }
    return this
}, onClick: function (a) {
    if (a.getName() != "saveHeroAttributes") {
        return
    }
    var b = {cmd: "heroSetAttributes", resource: this.elements.resource.getValue(), attackBehaviour: this.elements.attackBehaviour.getValue()};
    if (this.elements.properties !== undefined) {
        b.attributes = this.elements.properties.getPropertyValues()
    }
    Travian.Form.UnloadHelper.disableSecurity(this.unloadIdentifier);
    location.reload();
    Travian.ajax({data: b});

    return this
}});
Travian.Game.Hero.PropertySetter = new Class({Extends: Travian.Form.Element, options: {availablePoints: 0, element: null, selectorBtnMinus: ".pointsValueSetter.sub a", selectorBtnPlus: ".pointsValueSetter.add a", elementAvailablePoints: null}, getAvailablePoints: function () {
    return this.options.availablePoints - this.getSettedPoints()
}, getPropertyValues: function () {
    return this.options.attributes.inject({}, function (b, a) {
        b[a.getId()] = a.getSettedPoints();
        return b
    })
}, isDirty: function () {
    return this.getSettedPoints() > 0
}, initialize: function (b, a) {
    var c = this;
    this.parent(b);
    this.options = Object.append(this.options, a || {});
    this.options.attributes.each(function (d) {
        d.setPropertySetter(c)
    });
    this.options.element = $(this.options.element);
    this.options.elementAvailablePoints = $(this.options.elementAvailablePoints);
    this.update()
}, getSettedPoints: function () {
    return this.options.attributes.inject(0, function (b, a) {
        return b + a.getSettedPoints()
    })
}, update: function () {
    this.options.attributes.each(function (a) {
        a.updateButtons()
    });
    this.options.elementAvailablePoints.set("html", this.getAvailablePoints());
    this.onChange();
    return this
}});
Travian.Game.Hero.PropertySetter.Attribute = new Class({Implements: [Options], options: {id: null, element: null, value: null, usedPoints: null, maxPoints: null, elementBtnMinus: ".pointsValueSetter.sub a", elementBtnPlus: ".pointsValueSetter.add a", elementInput: ".points input", elementProgressBar: ".progress .bar.setted", elementValue: ".current .value"}, propertySetter: null, settedPoints: 0, addPoint: function (a) {
    if (typeOf(a) == "null") {
        a = 1
    }
    if (a < 0) {
        a = 0
    }
    return this.setSettedPoints(this.getSettedPoints() + a)
}, calculateValue: function () {
    return 0
}, getId: function () {
    return this.options.id
}, getMaxPoints: function () {
    return this.options.maxPoints
}, getPropertySetter: function () {
    if (this.propertySetter == null) {
        throw"missing propertySetter in Travian.Game.Hero.PropertySetter.Attribute"
    }
    return this.propertySetter
}, getSettedPoints: function () {
    return this.settedPoints
}, getTotalPoints: function () {
    return this.settedPoints + this.options.usedPoints
}, initialize: function (b) {
    var f = this;
    this.setOptions(b);
    this.options.element = $(this.options.element);
    this.options.elementBtnMinus = this.options.element.down(this.options.elementBtnMinus);
    this.options.elementBtnPlus = this.options.element.down(this.options.elementBtnPlus);
    this.options.elementInput = this.options.element.down(this.options.elementInput);
    this.options.elementProgressBar = this.options.element.down(this.options.elementProgressBar);
    this.options.elementValue = this.options.element.down(this.options.elementValue);
    var h = null;
    var a = false;
    var c = function (k, l) {
        l.stop();
        if (a == false) {
            f[k + "Point"]()
        }
        a = false;
        return false
    };
    var e = function (k) {
        k.stop();
        if (h) {
            clearInterval(h)
        }
        k.target.removeClass("click");
        return false
    };
    var g = function (k, l) {
        l.stop();
        if (h) {
            clearInterval(h)
        }
        a = true;
        l.target.addClass("click");
        $(document.body).removeEvent("mouseup", e);
        $(document.body).addEvent("mouseup", e);
        f[k + "Point"]();
        h = f[k + "Point"].periodical(200, f);
        return false
    };
    var d = function (m) {
        var k = null;
        var l = (m.wheel > 0 ? 1 : -1);
        m.stop();
        if (h) {
            clearInterval(h)
        }
        f.setSettedPoints(f.getSettedPoints() + l);
        if (l > 0) {
            k = f.options.elementBtnPlus;
            f.options.elementBtnMinus.removeClass("click")
        } else {
            k = f.options.elementBtnMinus;
            f.options.elementBtnPlus.removeClass("click")
        }
        k.addClass("click");
        h = (function () {
            k.removeClass("click")
        }).delay(100);
        return false
    };
    this.options.elementBtnMinus.addEvents({click: c.curry("sub"), mousedown: g.curry("sub"), mousewheel: d});
    this.options.elementBtnPlus.addEvents({click: c.curry("add"), mousedown: g.curry("add"), mousewheel: d});
    this.options.elementInput.addEvents({change: function (l) {
        var k = parseInt(f.options.elementInput.value);
        if (isNaN(k)) {
            k = f.getTotalPoints()
        }
        f.setSettedPoints(k - f.options.usedPoints)
    }, mousewheel: d})
}, setPropertySetter: function (a) {
    this.propertySetter = a;
    return this
}, setSettedPoints: function (b) {
    b = parseInt(b);
    if (isNaN(b)) {
        b = this.settedPoints
    }
    if (b < 0) {
        b = 0
    }
    if (b > this.getMaxPoints() - this.options.usedPoints) {
        b = this.getMaxPoints() - this.options.usedPoints
    }
    var a = this.getPropertySetter().getAvailablePoints();
    if (this.settedPoints < b && a < b - this.settedPoints) {
        b = this.settedPoints + a
    }
    this.settedPoints = b;
    return this.update()
}, subPoint: function (a) {
    if (typeOf(a) == "null") {
        a = 1
    }
    if (a < 0) {
        a = 0
    }
    return this.setSettedPoints(this.getSettedPoints() - a)
}, update: function () {
    this.options.elementValue.set("html", this.calculateValue());
    this.options.elementInput.value = this.options.usedPoints + this.getSettedPoints();
    this.options.elementProgressBar.setStyles({width: Math.max(0, Math.min(100, Math.round(100 / Math.min(this.getMaxPoints() + 4, 100) * this.getSettedPoints()))) + "%"});
    this.getPropertySetter().update();
    return this
}, updateButtons: function () {
    if (this.getTotalPoints() >= this.getMaxPoints() || this.getPropertySetter().getAvailablePoints() == 0) {
        this.options.elementBtnPlus.addClass("disabled")
    } else {
        this.options.elementBtnPlus.removeClass("disabled")
    }
    if (this.getSettedPoints() == 0) {
        this.options.elementBtnMinus.addClass("disabled")
    } else {
        this.options.elementBtnMinus.removeClass("disabled")
    }
    return this
}});
Travian.Game.Hero.PropertySetter.Attribute.Power = new Class({Extends: Travian.Game.Hero.PropertySetter.Attribute, options: {valueOfItems: 0, valueBonus: 0}, calculateValue: function () {
    return 100 + this.getTotalPoints() * this.options.valueBonus + this.options.valueOfItems
}});
Travian.Game.Hero.PropertySetter.Attribute.OffBonus = new Class({Extends: Travian.Game.Hero.PropertySetter.Attribute, calculateValue: function () {
    return Math.round(this.getTotalPoints() * 0.2 * 10) / 10
}});
Travian.Game.Hero.PropertySetter.Attribute.DefBonus = new Class({Extends: Travian.Game.Hero.PropertySetter.Attribute, calculateValue: function () {
    return Math.round(this.getTotalPoints() * 0.2 * 10) / 10
}});
Travian.Game.Hero.PropertySetter.Attribute.ProductionPoints = new Class({Extends: Travian.Game.Hero.PropertySetter.Attribute, calculateValue: function () {
    return this.getTotalPoints()
}, elementResources: [], getPossibleBonusProductionForResource: function (a) {
    if (a == 0) {
        return this.calculateValue() * 3 * Travian.Game.speed
    }
    if (a <= 4) {
        return this.calculateValue() * 10 * Travian.Game.speed
    }
    return 0
}, initialize: function (a) {
    var c = $("setResource");
    this.parent(a);
    if (c) {
        for (var b = 0; b <= 4; b++) {
            this.elementResources[b] = c.down('label[for="resourceHero' + b + '"] .current')
        }
    }
}, update: function () {
    var a = this;
    this.elementResources.each(function (c, b) {
        if (c) {
            c.set("html", a.getPossibleBonusProductionForResource(b))
        }
    });
    return this.parent()
}});
Travian.Game.Vid = new Class({active: null, initialize: function (b) {
    var a = this;
    a.active = b;
    a.setActive(b);
    a.showDescription(b);
    $$(".container .vid").addEvents({mouseover: function (c) {
        a.highlight($(c.target).get("id"))
    }, mouseout: function (c) {
        a.unhighlight()
    }, click: function (c) {
        a.setActive($(c.target).get("id"))
    }})
}, highlight: function (a) {
    $$(".container ." + a).addClass(a + "Highlight");
    this.showDescription(a)
}, unhighlight: function () {
    $$(".container .vid").removeClass("vid1Highlight").removeClass("vid2Highlight").removeClass("vid3Highlight");
    this.showDescription(this.active)
}, showDescription: function (a) {
    $$(".container .description.").hide();
    $$(".container .description." + a).show()
}, setActive: function (a) {
    this.active = a;
    $$('form input[name="vid"]').set("value", a.substring(3, 4));
    $$(".container .vid").removeClass("vid1Active").removeClass("vid2Active").removeClass("vid3Active");
    $$(".container ." + a).addClass(a + "Active")
}});
Travian.Game.Sector = new Class({active: null, initialize: function (b) {
    var a = this;
    a.setActive(b);
    $$("#sector .map .sector .highlight").addEvents({mouseover: function (c) {
        var d = $(c.target).up(".sector").get("id");
        if (d != a.active && !$(c.target).hasClass("disabled")) {
            $(c.target).addClass("hover")
        }
    }, mouseout: function (c) {
        $(c.target).removeClass("hover")
    }, click: function (c) {
        if (!$(c.target).hasClass("disabled")) {
            var d = $(c.target).up(".sector").get("id");
            $(c.target).removeClass("hover");
            a.setActive(d)
        }
    }});
    $$('#sector form select[name="sector"]').addEvent("change", function (c) {
        var d = $(c.target).get("value");
        a.setActive(d)
    })
}, show: function (a) {
    $$(".vid .description.").hide();
    $$(".vid .description." + a).show()
}, setActive: function (b) {
    this.active = b;
    $$("#sector .map .sector .highlight").removeClass("active");
    $$("#sector .map .sector." + b + " .highlight").addClass("active");
    var a = $$('#sector form select[name="sector"]');
    if (a.get("value") != b) {
        a.set("value", b)
    }
}});
Travian.Game.Overlay = {elementsForOverlay: [
    {elementId: "logo", element: null, position: null, placeholder: null, highlight: null},
    {elementId: "navigation", element: null, position: null, placeholder: null, highlight: null},
    {elementId: "goldSilver", element: null, position: null, placeholder: null, highlight: null},
    {elementId: "outOfGame", element: null, position: null, placeholder: null, highlight: null},
    {elementId: "stockBar", element: null, position: null, placeholder: null, highlight: null},
    {elementId: "sidebarBeforeContent", element: null, position: null, placeholder: null, highlight: null},
    {elementId: "sidebarAfterContent", element: null, position: null, placeholder: null, highlight: null}
], highlightGroups: [
    {groupId: "mainPage", element: null, members: ["logo"]},
    {groupId: "villageSwitch", element: null, members: ["n1", "n2"]},
    {groupId: "mainNavigation", element: null, members: ["n3", "n4", "n5", "n6"]},
    {groupId: "premiumFeatures", element: null, members: ["n7", "goldSilver"]},
    {groupId: "outOfGame", element: null, members: ["outOfGame"]},
    {groupId: "villageResources", element: null, members: ["stockBarWarehouseWrapper", "stockBarResource1", "stockBarResource2", "stockBarResource3"]},
    {groupId: "villageCrop", element: null, members: ["stockBarGranaryWrapper", "stockBarResource4", "stockBarFreeCropWrapper"]},
    {groupId: "sidebarBoxHero", element: null, members: ["sidebarBoxHero"]},
    {groupId: "sidebarBoxAlliance", element: null, members: ["sidebarBoxAlliance"]},
    {groupId: "sidebarBoxInfobox", element: null, members: ["sidebarBoxInfobox"]},
    {groupId: "sidebarBoxLinklist", element: null, members: ["sidebarBoxLinklist"]},
    {groupId: "sidebarBoxActiveVillage", element: null, members: ["sidebarBoxActiveVillage"]},
    {groupId: "sidebarBoxVillagelist", element: null, members: ["sidebarBoxVillagelist"]}
], darken: null, overlay: null, texts: null, createOverlay: function () {
    this.overlay = new Element("div").set({id: "overlay", "class": Travian.getDirection(), html: '<div class="center"><div class="overlayContent"><p class="overlayTitle">' + this.texts.defaultTitle + '</p><p class="overlayDescription">' + this.texts.defaultDescription + '</p><a class="overlayCloseLink" href="#" onclick="Travian.Game.Overlay.closeOverlay();">' + this.texts.closeLink + '</a></div><div class="elements"></div><div class="highlights"></div></div>'});
    document.body.grab(this.overlay, null, false)
}, moveElementsToOverlay: function () {
    var a = this;
    this.elementsForOverlay.each(function (b) {
        b.element = $(b.elementId);
        if (b.element !== null) {
            b.position = b.element.getPosition($("center"))
        }
    });
    this.elementsForOverlay.each(function (b) {
        if (b.element !== null) {
            b.placeholder = a.createPlaceholder(b.element);
            b.element.setStyles({position: "absolute", left: b.position.x, top: b.position.y, "float": "none", clear: "none"});
            b.element.grab(b.placeholder, "before", false);
            a.overlay.down(".center").down(".elements").grab(b.element, null, false)
        }
    })
}, createHighlights: function () {
    var c = this;
    var d = this.overlay.getElement(".overlayTitle");
    var a = this.overlay.getElement(".overlayDescription");
    var b = this.overlay.getElement(".overlayCloseLink");
    this.highlightGroups.each(function (f) {
        var e = c.getRectangle(f.members);
        if (e.top !== null && e.right !== null && e.bottom !== null && e.left !== null) {
            f.element = new Element("div", {"class": "highlight " + f.groupId, styles: {top: e.top, left: e.left, width: e.right - e.left + "px", height: e.bottom - e.top + "px"}});
            c.overlay.down(".center").down(".highlights").grab(f.element, null, false);
            if (Browser.ie) {
                var g = f.element.getSize();
                f.element.grab(new Element("img", {src: "img/x.gif", alt: "", width: g.x, height: g.y}), null, false)
            }
            f.element.addEvents({mouseenter: function (h) {
                d.set("html", c.texts[f.groupId + "Title"]);
                a.set("html", c.texts[f.groupId + "Description"]);
                f.element.addClass("activeHighlight");
                b.addClass("hide")
            }, mouseleave: function (h) {
                d.set("html", c.texts.defaultTitle);
                a.set("html", c.texts.defaultDescription);
                f.element.removeClass("activeHighlight");
                b.removeClass("hide")
            }, click: function (h) {
                return false
            }})
        }
    })
}, getRectangle: function (c) {
    var b = this;
    var a = {top: null, right: null, bottom: null, left: null};
    c.each(function (e) {
        var g = $(e);
        if (g !== null) {
            var d = g.getPosition(b.overlay.down(".center"));
            var f = g.getSize();
            if (a.top === null || d.y < a.top) {
                a.top = d.y
            }
            if (a.right === null || d.x + f.x > a.right) {
                a.right = d.x + f.x
            }
            if (a.bottom === null || d.y + f.y > a.bottom) {
                a.bottom = d.y + f.y
            }
            if (a.left === null || d.x < a.left) {
                a.left = d.x
            }
        }
    });
    return a
}, createPlaceholder: function (c) {
    var d = null;
    if (c !== null) {
        var b = c.getSize();
        var a = c.getAttribute("id") + "_placeholder";
        d = new Element("div", {styles: {width: b.x, height: b.y, position: c.getStyle("position"), left: c.getStyle("left"), right: c.getStyle("right"), top: c.getStyle("top"), bottom: c.getStyle("bottom"), margin: c.getStyle("margin"), "float": c.getStyle("float"), clear: c.getStyle("clear")}, id: a})
    }
    return d
}, moveElementsToMainLayout: function () {
    var a = this;
    this.elementsForOverlay.each(function (b) {
        if (b.element !== null) {
            b.placeholder.grab(b.element, "after", false);
            b.placeholder.destroy();
            b.element.removeProperty("style")
        }
    })
}, removeHighlights: function () {
    this.elementsToHighlight.each(function (a) {
        if (a.highlight !== null) {
            a.highlight.destroy()
        }
    })
}, openOverlay: function () {
    var a = this;
    Travian.ajax({data: {cmd: "overlay"}, onSuccess: function (b) {
        a.texts = b.texts;
        a.createOverlay();
        a.moveElementsToOverlay();
        a.createHighlights();
        a.darken = new Overlay(document.body, {opacity: 0.9, duration: 0, zIndex: 1999});
        a.darken.open();
        if (Browser.ie6 || Browser.ie7) {
            Travian.forceDisplay()
        }
    }})
}, closeOverlay: function () {
    this.moveElementsToMainLayout();
    this.overlay.destroy();
    this.darken.close().overlay.hide()
}};
Travian.Game.Highlight = new Class({Implements: [Options], options: {cssHighlighted: "highlighted on", element: null, renderer: "rectangle", rendererOptions: {}}, active: false, renderer: null, activate: function () {
    if (this.active === false) {
        this.active = true;
        this.renderer.activate();
        this.getElement().addClass(this.options.cssHighlighted)
    }
    return this
}, deactivate: function () {
    if (this.active === true) {
        this.active = false;
        this.getElement().removeClass(this.options.cssHighlighted);
        this.renderer.deactivate()
    }
    return this
}, getElement: function () {
    return this.options.element
}, initialize: function (a) {
    var b = this;
    this.setOptions(a);
    this.options.element = $(this.options.element);
    if (this.options.element === null) {
        throw"missing element for highlighting!"
    }
    if (typeof Travian.Game.Highlight.Renderer[this.options.renderer.capitalize()] === "undefined") {
        throw'unknown renderer "' + this.options.renderer.capitalize() + '" defined!'
    }
    this.renderer = new Travian.Game.Highlight.Renderer[this.options.renderer.capitalize()](this.options.rendererOptions, this)
}, toggle: function () {
    if (this.active) {
        return this.deactivate()
    }
    return this.activate()
}});
Travian.Game.Highlight.Renderer = new Class({Implements: [Options], options: {}, parentContainer: null, activate: function () {
    return this
}, deactivate: function () {
    return this
}, getElement: function () {
    return this.parentContainer.getElement()
}, initialize: function (a, b) {
    this.parentContainer = b;
    this.setOptions(a);
    if (this.parentContainer === null) {
        throw"missing parent container of type Travian.Game.Highlight"
    }
}});
Travian.Game.Highlight.Renderer.Rectangle = (function () {
    var a = function (f) {
        var k = f.getElement().getCoordinates();
        if (f._lastCoordinates && f._lastCoordinates.left == k.left && f._lastCoordinates.top == k.top && f._lastCoordinates.width == k.width && f._lastCoordinates.height == k.height && f._lastCoordinates.right == k.right && f._lastCoordinates.bottom == k.bottom) {
            return
        }
        var c = f.getElementLeft();
        var l = f.getElementTopLeft();
        var h = f.getElementTop();
        var d = f.getElementTopRight();
        var m = f.getElementRight();
        var g = f.getElementBottomLeft();
        var b = f.getElementBottom();
        var e = f.getElementBottomRight();
        if (Browser.firefox) {
            k.left += 1
        }
        c.show().setStyles({left: k.left - c.getSize().x, top: k.top, height: k.height});
        l.show().setStyles({left: k.left - l.getSize().x, top: k.top - l.getSize().y});
        h.show().setStyles({left: k.left, top: k.top - h.getSize().y, width: k.width});
        d.show().setStyles({left: k.right, top: k.top - d.getSize().y});
        m.show().setStyles({left: k.right, top: k.top, height: k.height});
        e.show().setStyles({left: k.right, top: k.bottom});
        b.show().setStyles({left: k.left, top: k.bottom, width: k.width});
        g.show().setStyles({left: k.left - g.getSize().x, top: k.bottom});
        f._lastCoordinates = k
    };
    return new Class({Extends: Travian.Game.Highlight.Renderer, elements: {left: null, topLeft: null, top: null, topRight: null, right: null, bottomLeft: null, bottom: null, bottomRight: null}, invalidTypes: ["area"], options: {cssClassLeft: "highlighted rectangle left", cssClassTopLeft: "highlighted rectangle top left", cssClassTop: "highlighted rectangle top", cssClassTopRight: "highlighted rectangle top right", cssClassRight: "highlighted rectangle right", cssClassBottomLeft: "highlighted rectangle bottom left", cssClassBottom: "highlighted rectangle bottom", cssClassBottomRight: "highlighted rectangle bottom right", zIndex: 6000}, timer: null, activate: function () {
        clearInterval(this.timer);
        a(this);
        this.timer = a.periodical(50, null, [this]);
        return this
    }, deactivate: function () {
        clearInterval(this.timer);
        this.getElementLeft().hide();
        this.getElementTopLeft().hide();
        this.getElementTop().hide();
        this.getElementTopRight().hide();
        this.getElementRight().hide();
        this.getElementBottomLeft().hide();
        this.getElementBottom().hide();
        this.getElementBottomRight().hide();
        this._lastCoordinates = null;
        return this
    }, getElementBottom: function () {
        if (this.elements.bottom === null) {
            this.elements.bottom = $(new Element("div", {"class": this.options.cssClassBottom})).hide().setStyles({position: "absolute", left: 0, top: 0, zIndex: this.options.zIndex});
            document.body.insert({bottom: this.elements.bottom})
        }
        return this.elements.bottom
    }, getElementBottomLeft: function () {
        if (this.elements.bottomLeft === null) {
            this.elements.bottomLeft = $(new Element("div", {"class": this.options.cssClassBottomLeft})).hide().setStyles({position: "absolute", left: 0, top: 0, zIndex: this.options.zIndex});
            document.body.insert({bottom: this.elements.bottomLeft})
        }
        return this.elements.bottomLeft
    }, getElementBottomRight: function () {
        if (this.elements.bottomRight === null) {
            this.elements.bottomRight = $(new Element("div", {"class": this.options.cssClassBottomRight})).hide().setStyles({position: "absolute", left: 0, top: 0, zIndex: this.options.zIndex});
            document.body.insert({bottom: this.elements.bottomRight})
        }
        return this.elements.bottomRight
    }, getElementLeft: function () {
        if (this.elements.left === null) {
            this.elements.left = $(new Element("div", {"class": this.options.cssClassLeft})).hide().setStyles({position: "absolute", left: 0, top: 0, zIndex: this.options.zIndex});
            document.body.insert({bottom: this.elements.left})
        }
        return this.elements.left
    }, getElementTop: function () {
        if (this.elements.top === null) {
            this.elements.top = $(new Element("div", {"class": this.options.cssClassTop})).hide().setStyles({position: "absolute", left: 0, top: 0, zIndex: this.options.zIndex});
            document.body.insert({bottom: this.elements.top})
        }
        return this.elements.top
    }, getElementTopLeft: function () {
        if (this.elements.topLeft === null) {
            this.elements.topLeft = $(new Element("div", {"class": this.options.cssClassTopLeft})).hide().setStyles({position: "absolute", left: 0, top: 0, zIndex: this.options.zIndex});
            document.body.insert({bottom: this.elements.topLeft})
        }
        return this.elements.topLeft
    }, getElementTopRight: function () {
        if (this.elements.topRight === null) {
            this.elements.topRight = $(new Element("div", {"class": this.options.cssClassTopRight})).hide().setStyles({position: "absolute", left: 0, top: 0, zIndex: this.options.zIndex});
            document.body.insert({bottom: this.elements.topRight})
        }
        return this.elements.topRight
    }, getElementRight: function () {
        if (this.elements.right === null) {
            this.elements.right = $(new Element("div", {"class": this.options.cssClassRight})).hide().setStyles({position: "absolute", left: 0, top: 0, zIndex: this.options.zIndex});
            document.body.insert({bottom: this.elements.right})
        }
        return this.elements.right
    }, initialize: function (b, c) {
        this.parent(b, c);
        if (this.invalidTypes.indexOf(this.getElement().tagName.toLowerCase()) != -1) {
            throw"invalid tag type for rectangle-highlighting!"
        }
    }})
})();
Travian.Game.Highlight.Renderer.Image = new Class({Extends: Travian.Game.Highlight.Renderer, elements: {background: null, placeholder: null}, options: {borderSurround: 4, cssBackground: "highlighted background"}, validTypes: ["div", "span", "a", "li", "img", "input", "button"], activate: function () {
    var b = this.getElement();
    var a = b.getSize();
    b.insert({before: this.getElementBackground().setStyles({position: "absolute", left: b.offsetLeft - this.options.borderSurround, right: "auto", top: b.offsetTop - this.options.borderSurround, width: a.x + 2 * this.options.borderSurround, height: a.y + 2 * this.options.borderSurround}).show().dispose()});
    if (Browser.ie6 || Browser.ie7) {
        Travian.forceDisplay(this.getElementBackground())
    }
    return this
}, deactivate: function () {
    this.getElementBackground().hide();
    return this
}, getElementBackground: function () {
    if (this.elements.background === null) {
        var a = this.getElement();
        this.elements.background = $(a.cloneNode(false)).hide().addClass(this.options.cssBackground);
        a.insert({before: this.elements.background})
    }
    return this.elements.background
}, initialize: function (a, b) {
    this.parent(a, b);
    if (this.validTypes.indexOf(this.getElement().tagName.toLowerCase()) == -1) {
        throw"invalid tag type for image-highlighting!"
    }
}});
Travian.AdventureList = new Class({openDurationsCalulator: function () {
    $("durationCalculations").toggleClass("hide");
    if (!$("durationCalculations").hasClass("hide")) {
        this.calculateDurations()
    }
}, calculateDurations: function () {
    var a = $("adventureListForm");
    var b = $("changeVillage").value;
    Travian.ajax({data: {cmd: "calculateDurationsForAdventure", adventureKids: $("adventureListForm").select("input[name*=adventureKid]").inject([], function (d, c) {
        d.push(c.value);
        return d
    }), currentKidAndDid: b, originalWalkTimes: $("adventureListForm").select("input[name*=adventureWalktimeOriginalVillage]").inject([], function (d, c) {
        d.push(c.value);
        return d
    })}, onSuccess: function (c) {
        if (c.noAdventures == false) {
            Object.each(c.responseArray, function (e, d) {
                $(d).set("html", e)
            })
        }
    }})
}});
Travian.Game.Marketplace = new Class({merchantsAvailable: 0, capacityPerMerchant: 0, merchantCapacity: 0, merchantsMax: 0, initialize: function (a) {
    this.merchantsAvailable = Math.max(a.merchantsAvailable, 0);
    this.capacityPerMerchant = a.capacityPerMerchant;
    this.merchantCapacity = this.merchantsAvailable * this.capacityPerMerchant;
    this.autoCompleter = a.autoCompleter;
    this.merchantsMax = a.merchantsMax;
    this.updateAutoCompleter()
}, refresh: function (a) {
    this.merchantsAvailable = Math.max(a, 0);
    this.merchantCapacity = this.merchantsAvailable * this.capacityPerMerchant;
    $("merchantCapacityValue").set("html", this.merchantCapacity);
    $$(".merchantsAvailable").set("html", this.merchantsAvailable);
    this.visualizeMerchantCapacity()
}, enableAllLinks: function () {
    var a;
    for (a = 1; a <= 4; a++) {
        linkToUpdate = $("addRessourcesLink" + a);
        linkToUpdate.removeClass("notClickable");
        linkToUpdate.disabled = false
    }
}, enableAllInputFields: function () {
    var a = 0;
    for (a = 1; a < 5; a++) {
        $("r" + a).removeClass("disabled");
        $("r" + a).readOnly = 0
    }
}, disableAllLinks: function () {
    var a;
    for (a = 1; a <= 4; a++) {
        linkToUpdate = $("addRessourcesLink" + a);
        linkToUpdate.addClass("notClickable");
        linkToUpdate.disabled = true
    }
}, disableAllInputFields: function () {
    var a = 0;
    for (a = 1; a < 5; a++) {
        $("r" + a).addClass("disabled");
        $("r" + a).readOnly = 1
    }
}, setNotice: function (a) {
    if (a.notice && a.formular) {
        $("note").set("html", a.notice);
        $$(".destination").set("html", a.formular);
        this.enableAllLinks();
        this.enableAllInputFields();
        var b = 1;
        for (b = 1; b < 5; b++) {
            $("r" + b).set("value", "")
        }
        if (a.button) {
            $("button").set("html", a.button)
        }
        $$(".run_dropdown").removeClass("hide")
    }
}, setError: function (a) {
    if (a.errorMessage) {
        $("prepareError").set("html", a.errorMessage);
        $("note").set("html", "")
    }
}, sendRessources: function () {
    var a = this;
    Travian.ajax({data: {cmd: "prepareMarketplace", t: $("t").get("value"), id: $("id").get("value"), a: $("a").get("value"), sz: $("sz").get("value"), kid: $("kid").get("value"), c: $("c").get("value"), x2: $("x2") ? $("x2").get("value") : 1, r1: $("r1").get("value"), r2: $("r2").get("value"), r3: $("r3").get("value"), r4: $("r4").get("value")}, onSuccess: function (b) {
        if (b.errorMessage) {
            a.setError(b)
        } else {
            if (b.notice) {
                $$(".run_dropdown").removeClass("hide");
                $$("div .destination").set("html", b.formular);
                a.setNotice(b);
                a.reloadMarketPlace();
                resetCounterForAjax();
                a.updateAutoCompleter()
            }
        }
    }})
}, prepare: function () {
    var b = this;
    var a = $("marketSend");
    x2 = 1;
    if ($("x2")) {
        if ($("x2").get("type") == "checkbox") {
            x2 = $("x2").get("checked") ? 2 : 1
        } else {
            x2 = $("x2").get("value")
        }
    }
    Travian.ajax({data: {cmd: "prepareMarketplace", r1: $("r1").get("value"), r2: $("r2").get("value"), r3: $("r3").get("value"), r4: $("r4").get("value"), dname: $("enterVillageName").get("value"), x: $("xCoordInput").get("value"), y: $("yCoordInput").get("value"), id: $("id").get("value"), t: $("t").get("value"), x2: x2}, onSuccess: function (c) {
        if (c.errorMessage) {
            b.setError(c)
        } else {
            if (c.formular) {
                b.disableAllLinks();
                b.disableAllInputFields();
                $$(".destination").set("html", c.formular);
                $$(".run_dropdown").addClass("hide");
                $("prepareError").set("html", "");
                $("note").set("html", "");
                $("r1").focus()
            }
        }
        if (c.button) {
            $("button").set("html", '<div id="prepareError" class="error">' + $("prepareError").get("html") + "</div>" + c.button + '<div class="clear"></div>')
        }
        return false
    }})
}, goBack: function () {
    var a = this;
    this.enableAllLinks();
    this.enableAllInputFields();
    Travian.ajax({data: {cmd: "marketPlaceGoBack", kid: $("kid").get("value"), x2: $("x2") ? $("x2").get("value") : 1, dname: $("dname") ? $("dname").get("value") : ""}, onSuccess: function (b) {
        $$("div .destination").set("html", b.formular);
        $$("div #button").set("html", '<div id="prepareError" class="error"></div>' + b.button + '<div class="clear"></div>');
        $$(".run_dropdown").removeClass("hide");
        a.updateAutoCompleter()
    }})
}, reloadMarketPlace: function () {
    var a = this;
    Travian.ajax({data: {cmd: "reloadMarketplace"}, onSuccess: function (b) {
        $("merchantsOnTheWayFormular").set("html", b.merchantsOnTheWay);
        var d = 0;
        var c;
        for (c = 1; c < 5; c++) {
            d = parseInt(b.storage["l" + c]);
            resources.storage["l" + c] = d
        }
        resetCounterForAjax();
        var e = new Travian.Formatter({forceDecimal: false});
        var d = 0;
        var c;
        for (c = 1; c < 5; c++) {
            d = parseInt(b.storage["l" + c]);
            resources.storage["l" + c] = d;
            $("l" + c).set("html", e.getFormattedNumber(d));
            timer["l" + c].start_res = d
        }
        a.refresh(b.merchantsAvailable)
    }})
}, visualizeMerchantCapacity: function () {
    this.merchantCapacity = this.merchantsAvailable * this.capacityPerMerchant;
    var a = this.summarizeInput();
    this.setSelectedRessourcesInfo(a);
    this.setNotEnoughMerchantsError(a);
    this.updateLinks()
}, validateAndVisualizeMerchantCapacity: function (a) {
    this.validateResources(a);
    this.visualizeMerchantCapacity()
}, validateResources: function (d) {
    var b = this.getValue(d);
    var e = this.clipToStorageMaximum(d, b);
    var a = b + e;
    var c = b;
    if (b > a) {
        c = a
    }
    this.setValue(d, c)
}, validateTradeRouteResources: function (a) {
    var c = Math.max(0, this.getValue(a));
    this.setValue(a, c);
    var e = this.summarizeInput();
    var b = this.merchantsMax * this.capacityPerMerchant;
    var f = {};
    var d = $("tradeSaveButton");
    if (e > b) {
        f = {MERCHANTS_NEEDED: Math.ceil(e / this.capacityPerMerchant), MERCHANTS_AVAILABLE: this.merchantsMax};
        $("tradeRouteError").set("html", "{notEnoughMerchants}".translate().substitute(f, /\\?\[([^\[\]]+)\]/g));
        $("tradeRouteError").addClass("error");
        d.disabled = 1;
        d.addClass("disabled")
    } else {
        $("tradeRouteError").set("html", "");
        $("tradeRouteError").removeClass("error");
        d.disabled = 0;
        d.removeClass("disabled")
    }
}, rearrangeButtons: function () {
}, furtherMerchantsAvailable: function () {
    var b = this.summarizeInput();
    var a = this.merchantCapacity - b;
    if (a >= 0) {
        return true
    } else {
        return false
    }
}, updateLinks: function () {
    var a = null;
    var c = 0;
    var b;
    for (b = 1; b <= 4; b++) {
        a = $("addRessourcesLink" + b);
        c = this.getValueToAddToRessources(b);
        if (c == 0) {
            a.addClass("notClickable")
        } else {
            a.removeClass("notClickable")
        }
    }
}, addRessources: function (c) {
    if ($("addRessourcesLink" + c).disabled) {
        return
    }
    var b = this.getValueToAddToRessources(c);
    var a = this.getValue(c);
    if (b != 0) {
        this.setValue(c, b + a)
    }
    this.visualizeMerchantCapacity()
}, getValueToAddToRessources: function (d) {
    var a = 0;
    var c = this.summarizeInput();
    var b = this.merchantCapacity - c;
    if (b > 0) {
        if (b < this.capacityPerMerchant) {
            a = b
        } else {
            if (b >= this.capacityPerMerchant) {
                a = this.capacityPerMerchant
            }
        }
    } else {
        if (b == 0) {
            a = 0
        } else {
            a = b
        }
    }
    a = this.clipToStorageMaximum(d, a);
    return a
}, clipToStorageMaximum: function (c, b) {
    var d = this.getStorageFor(c);
    var a = this.getValue(c);
    if (b > 0) {
        b = Math.min(b, (d - a))
    } else {
        if ((a + b) > d) {
            b = d - a
        }
    }
    return b
}, getStorageFor: function (a) {
    var b = "l" + (a);
    currentRes = resources[b].value;
    return currentRes
}, setValue: function (b, a) {
    var c = parseInt(a);
    if (!isNaN(c)) {
        $("r" + b).set("value", Math.max(c, 0))
    }
}, setSelectedRessourcesInfo: function (a) {
    $("sumResources").set("html", a);
    if (a > this.merchantCapacity) {
        $("sumResources").addClass("notEnoughMerchants")
    } else {
        $("sumResources").removeClass("notEnoughMerchants")
    }
}, setNotEnoughMerchantsError: function (c) {
    var e = {};
    var d = this.getNeededMerchants(c);
    $("merchantsNeededNumber").set("html", d);
    var b = null;
    if (typeof $$(".prepare")[0] == "object") {
        b = $$(".prepare")[0]
    }
    if (d > this.merchantsAvailable) {
        e = {MERCHANTS_NEEDED: d, MERCHANTS_AVAILABLE: this.merchantsAvailable};
        $("prepareError").set("html", "{notEnoughMerchants}".translate().substitute(e, /\\?\[([^\[\]]+)\]/g));
        $("note").set("html", "");
        $("prepareError").addClass("error");
        $("merchantsNeeded").addClass("error");
        $$(".merchantCapacity").addClass("error");
        $("sumResources").addClass("error");
        b.disabled = 1;
        b.addClass("disabled")
    } else {
        $("merchantsNeeded").removeClass("error");
        if ($("prepareError")) {
            $("prepareError").set("html", "")
        } else {
            var a = $("button").get("html");
            $("button").set("html", '<div id="prepareError" class="error"></div>' + a + '<div class="clear"></div>')
        }
        $$(".merchantCapacity").removeClass("error");
        $("sumResources").removeClass("error");
        b.disabled = 0;
        b.removeClass("disabled")
    }
}, getNeededMerchants: function (a) {
    return Math.ceil(a / this.capacityPerMerchant)
}, getValue: function (b) {
    var a = parseInt($("r" + b).get("value"));
    if (!isNaN(a)) {
        return a
    }
    return 0
}, summarizeInput: function () {
    var b = 0;
    for (var a = 1; a <= 4; a++) {
        id = "r".concat(a);
        b += this.getValue(a)
    }
    return b
}, updateAutoCompleter: function () {
    var a = "enterVillageName";
    if (this.autoCompleter && $(a) !== null) {
        new Travian.Game.AutoCompleter.VillageName(a)
    }
    return this
}});


Travian.Game.Marketplace.ExchangeResources = {overall: null,
	max123: null,
	max4: null,

	initialize: function(max123, max4)
	{
		this.max123 = max123;
		this.max4 = max4;
	},

	calculateRest: function()
	{
		resObj = document.getElementsByName('m2[]');
		this.overall = 0;

		for (i = 0; i < resObj.length; i++)
		{
			var tmp = '';

			for (j = 0; j < resObj[i].value.length; j++)
			{
				if ((resObj[i].value.charAt(j) >= '0') && (resObj[i].value.charAt(j) <= '9'))
				{
					tmp = tmp + resObj[i].value.charAt(j);
				}
			}

			if (tmp == '')
			{
				tmp = '0';
				newRes = 0;
				resObj[i].value = '';
			}
			else
			{
				newRes = parseInt(tmp) || 0;

				if ((i < 3) && (newRes > this.max123))
				{
					newRes = this.max123;
				}

				if ((i == 3) && (newRes > this.max4))
				{
					newRes = this.max4;
				}

				resObj[i].value = newRes;
			}

			dif = newRes - (parseInt(document.getElementById('org' + i).innerHTML) || 0);
			newHTML = dif;

			if (dif > 0)
			{
				newHTML = '+' + dif;
			}

			document.getElementById('diff' + i).innerHTML = newHTML;
			this.overall += newRes;
		}

		document.getElementById('newsum').innerHTML = this.overall;
		rest = (parseInt(document.getElementById('org4').innerHTML) || 0) - this.overall;
		document.getElementById('remain').innerHTML = rest;

		this.testSum();
	},

	fillup: function(nr)
	{
		resObj = document.getElementsByName('m2[]');

		if (nr < 3)
		{
			resObj[nr].value = this.max123;
		}
		else
		{
			resObj[nr].value = this.max4;
		}

		this.calculateRest();
	},

	portion: function(did)
	{
		var desired = [];
		var fields = $$("input[name=m2\\[\\]]");
		Array.each(fields, function (element, index) {
			desired.push(element.get('value'));
		});
		var $this = this;
		Travian.ajax({
			data: {
				cmd: 'exchangeResources',
				did: did,
				desired: desired
			},
			onSuccess: function(data) {
				Array.each(fields, function (element, index){
					element.set('value', data.distributed[index]);
					$$("table#npc #org" + index).set('text', data.resources[index]);
					$$("table#npc input#m1\\[" + index + "\\]]").set('value', data.resources[index])
				});
				$$("table#npc #org4").set('text', Array.sum(data.resources));
				$this.calculateRest();
			}
		});
	},

	testSum: function()
	{
		if (document.getElementById('remain').innerHTML != 0)
		{
			document.getElementById('submitText').style.display = 'block';
			document.getElementById('submitButton').style.display = 'none';
		}
		else
		{
			document.getElementById('submitText').style.display = 'none';
			document.getElementById('submitButton').style.display = 'block';
		}
		
		Travian.adjustButtonDisableState();
	},

    toggleTradeRoutes: function(routeId, obj)
    {
        var enabled = obj.get('checked') ? 1 : 0;

        Travian.ajax({
            data : {
                cmd : 'toggleTradeRoutes',
                routeId : routeId,
                enabled : enabled
            }
        });

        return false;
    }
};
Travian.Game.PaymentWizard = new Class({Extends: Travian.Dialog.Ajax, options: {data: {cmd: "paymentWizard", goldProductId: "", goldProductLocation: "", location: "", activeTab: "buyGold", formData: {}}, keepOpen: true, buttonCancel: true, buttonOk: false, context: "paymentWizard", cssClass: "brown", draggable: false, infoIcon: true, saveOnUnload: false, scroll: false, type: this.DIALOG_TYPE_MODAL, darkOverlay: true, overlayCancel: false, resizeDialogIfOverflow: false, useCallback: false, callback: Travian.emptyFunction(), callbackScope: null, onClose: function (a) {
    //Travian.Game.PaymentWizardEventListener.PaymentWizardObject = null;
    if (this.options.useCallback === true && typeof this.options.callback == "function") {
        this.options.callback({scope: this.options.callbackScope})
    }
    fireEvent("paymentWizardOnCloseEvent")
}}, initialize: function (b) {
    this.parent(Object.merge({}, this.options, b || {}));
    var c = this;
    var a = function (e) {
        var d = $$(e.target).getParents(".tabButton")[0].get("class")[0].split(" ");
        if (d[1] == "pros") {
            c.options.callback = null
        }
        c.options.data.activeTab = d[1];
		$("loader").removeClass("hide");
        c.reload();
        e.stop();
        return false
    };
    this.addEvent("open", function (f) {
        if (Browser.ie6) {
            var e = $$(".header");
            e.each(function (h) {
                $$(h).removeClass("header");
                $$(h).addClass("header")
            });
            var d = $$(".accountBalance");
            d.each(function (h) {
                $$(d).removeClass("accountBalance");
                $$(d).addClass("accountBalance")
            })
        }
        var g = $("paymentWizard");
        $$("#paymentWizard .header .tabButton").each(function (h) {
            h.removeEvents();
            h.addEvent("click", a)
        }, this);
        $$("#paymentWizard .header li").each(function (h) {
            if (h.hasClass("active")) {
                return false
            }
            h.set("morph", {duration: 200, transition: Fx.Transitions.Sine.easeOut, fps: 60});
            h.addEvent("mouseover", function () {
                h.morph({marginTop: -8, height: 40})
            });
            h.addEvent("mouseout", function () {
                h.morph({marginTop: -1, height: 33})
            })
        });
        if (g) {
            $$("#paymentWizard .iconButton.info").setTitle(Travian.Translation.get("paymentWizard.infoButtonLabel"));
            c.updateInfoButton({buttonTextInfo: Travian.Translation.get("paymentWizard.infoButtonLabel"), infoIcon: function () {
                window.open($("paymentWizard").getElement(".paymentWizardAnswersLink").get("value"))
            }})
        }
        if (c.options.data.activeTab == "buyGold" || c.options.data.activeTab == "") {
            c.initializeBuyGoldTab()
        } else {
            if (c.options.data.activeTab == "pros") {
                c.initializeProsTab()
            } else {
                if (c.options.data.activeTab == "earnGold") {
                    c.initializeEarnGoldTab()
                }
            }
        }
    });
    return this
}, initializeBuyGoldTab: function () {
    var k = this;
    var b = $$("#paymentWizard .contentWrapper .infoArea");
    var f = $$("#paymentWizard .contentWrapper .contentArea");
    var h = function (n, o) {
        if (!n.hasClass(o)) {
            n = n.up("." + o)
        }
        return n
    };
    var c = function (o) {
        var n = b.getElement(".buyGoldLocation")[0];
        if (n.options[0].value == n.options[n.selectedIndex].value) {
            b.getElements(".buyGoldInfoStep.locationStep").each(function (q) {
                q.hide()
            });
            b.down(".buyGoldInfoStep.locationStep.buyGoldInfoArrow").show();
            o.stop();
            return false
        }
        k.options.data.goldProductLocation = n.options[n.selectedIndex].value;
        k.options.data.goldProductId = "";
        k.reload();
        o.stop();
        return false
    };
    var a = function (n) {
        b.getElements(".buyGoldInfoStep.locationStep").each(function (o) {
            o.hide()
        });
        b.down(".buyGoldInfoStep.locationStep.buyGoldFormStep").show();
        n.stop();
        return false
    };
    var e = function (n) {
        k.options.data.goldProductId = "";
        k.reload();
        n.stop();
        return false
    };
    var d = function (o) {
        var n = h($(o.target), "goldProduct");
        if (n != null) {
            k.options.data.goldProductId = n.down(".goldProductId").get("value");
            k.reload()
        }
        o.stop();
        return false
    };
    var m = function (r) {
        var o = h($(r.target), "providerLink");
        if (o != null) {
            var s, t;
            var n = o.down(".providerId").get("value");
            try {
                s = o.down(".popupWidth").get("value")
            } catch (q) {
                s = 800
            }
            try {
                t = o.down(".popupHeight").get("value")
            } catch (q) {
                t = 600
            }
            k.options.useCallback = true;
            k.openProvider(k.options.data.goldProductId, n, s, t)
        }
        r.stop();
        return false
    };
    var l = function (o) {
        if (!k.DoubleClickPreventer) {
            k.DoubleClickPreventer = new Travian.DoubleClickPreventer();
            k.DoubleClickPreventer.timeout = 2000
        }
        if (!k.DoubleClickPreventer.check()) {
            o.stop();
            return false
        }
        var q = f.down(".paymentOpenOffersResult")[0];
        if (q) {
            q.destroy()
        }
        var n = $(o.target);
        n.hide();
        footerItem = n.up(".footerItem");
        if (n.hasClass("ordersHide") === true) {
            footerItem.down(".ordersShow").show();
            f.down(".buyGoldContent").show();
            f.down(".openOffers").hide();
            o.stop();
            return false
        }
        footerItem.down(".ordersHide").show();
        f.down(".buyGoldContent").hide();
        f.down(".openOffers").show();
        Travian.ajax({data: {cmd: "paymentWizardOpenOffers"}, onSuccess: function (s) {
            var r = f.down(".openOffers")[0];
            r.empty();
            if (s.noResult === false) {
                r.set("html", s.html)
            } else {
                r.set("html", s.errorMsg)
            }
        }});
        o.stop();
        return false
    };
    if (b.down(".buyGoldLocation")[0] != null) {
        b.down(".buyGoldLocation")[0].addEvent("change", c)
    }
    if (b.down("a")[0] != null) {
        b.down("a")[0].addEvent("click", a)
    }
    var g = b.down(".changeGoldProduct");
    if (g[0] != null) {
        g[0].addEvent("click", e)
    }
    Array.each(f.getElements(".goldProduct"), function (n) {
        n.addEvent("click", d)
    });
    Array.each(f.getElements(".paymentProvider"), function (n) {
        n.addEvent("click", m)
    });
    Array.each(b.getElements(".openOrdersLink"), function (n) {
        n.addEvent("click", l)
    });
    return this
}, initializeEarnGoldTab: function () {
    var g = this;
    var f = $$("#paymentWizard.earnGold .contentWrapper .earnGoldPage")[0].getParent();
    var b = function (k) {
        if (!k || k == "") {
            k = "earnGoldOverview"
        }
        f.getChildren().hide();
        f.getChildren("." + k).show();
        return this
    };
    var e = function (l) {
        var n = undefined;
        var m = $$(l.target).get("class")[0].split(" ");
        for (var k = 0; k < m.length; k++) {
            if (m[k].indexOf("earnGold") == 0) {
                n = m[k];
                break
            }
        }
        b(n);
        l.stop();
        return false
    };
    f.up("#paymentWizard").getElements("a.showEarnGoldPage").addEvent("click", e);
    var c = function (m) {
        var l = f.getElement(".receiverLines").getChildren().length;
        if (l < 6) {
            var k = "{earnGoldContentMailSendReceiverCount}".translate().replace("[RECEIVER_COUNT]", l + 1);
            var o = new Element("div.receiverLine[text=" + k + "]");
            var n = new Element("input.text[type=text][name=receiver[]]");
            o.adopt(n);
            f.getElement(".receiverLines").adopt(o);
            if (l >= 5) {
                f.getElement(".receiverLinkLine").hide()
            }
        }
        m.stop();
        return false
    };
    f.getElements(".earnGoldAddLink").addEvent("click", c);
    f.getElements(".earnGoldSendMailCancel").addEvent("click", function () {
        g.options.data.formData = {};
        g.options.data.location = "";
        g.reload()
    });
    f.getElements(".earnGoldSendMailSubmit").addEvent("click", function () {
        var k = {};
        k.receiver = f.getElements(".receiverLines input").get("value");
        k.message = f.getElements(".earnGoldSendMailMessage")[0].get("value");
        g.options.data.formData = k;
        g.options.data.location = "earnGoldMailSend";
        g.reload()
    });
    var d = false;
    var a = function (k) {
        if (d) {
            return this
        }
        d = true;
        Travian.ajax({data: {cmd: "paymentWizardAdvertisedPersons", page: k}, onSuccess: function (l) {
            if (l.errorMessage) {
                g.setError(l)
            } else {
                if (l.html) {
                    d = false;
                    f.getElement(".earnGoldAdvertisedPersonsList").set("html", l.html);
                    f.getElements(".paginator a").addEvent("click", function (n) {
                        var m = $$(n.target)[0];
                        if (m.get("tag") != "a") {
                            m = m.up("a")
                        }
                        k = m.get("href").toString().split("=")[1];
                        a(k);
                        n.stop();
                        return false
                    })
                }
            }
        }});
        return this
    };
    var h = f.getElement("a.showEarnGoldPage.earnGoldDrumUps");
    if (h != null) {
        h.addEvent("click", function (k) {
            a()
        })
    }
    b(g.options.data.location)
}, initializeProsTab: function () {
    var b = this;
    var a = $("featureCollectionWrapper");
    a.select(".prosButton").each(function (e) {
        e.removeEvent("click");
        e.addEvent("click", function (f) {
            b.options.useCallback = true;
            b.options.callback = function () {
                window.location.href = window.location.href;
                window.location.reload()
            };
            b.requestSend = true;
            if (this.hasClass("productionboostWood")) {
                window.fireEvent("startWayOfPayment", ["productionboostWood", "paymentWizard"])
            } else {
                if (this.hasClass("productionboostClay")) {
                    window.fireEvent("startWayOfPayment", ["productionboostClay", "paymentWizard"])
                } else {
                    if (this.hasClass("productionboostIron")) {
                        window.fireEvent("startWayOfPayment", ["productionboostIron", "paymentWizard"])
                    } else {
                        if (this.hasClass("productionboostCrop")) {
                            window.fireEvent("startWayOfPayment", ["productionboostCrop", "paymentWizard"])
                        } else {
                            if (this.hasClass("plus")) {
                                window.fireEvent("startWayOfPayment", ["plus", "paymentWizard"])
                            } else {
                                if (this.hasClass("goldclub")) {
                                    window.fireEvent("startWayOfPayment", ["goldclub", "paymentWizard"])
                                }
                            }
                        }
                    }
                }
            }
            return false
        })
    });
    a.select(".checkbox").each(function (e) {
        e.removeEvent("click");
        e.addEvent("click", function (f) {
            if (this.hasClass("prolongProductionboostWood")) {
                return b.toggleAutoprolong("productionboostWood", "productionBoost")
            } else {
                if (this.hasClass("prolongProductionboostClay")) {
                    return b.toggleAutoprolong("productionboostClay", "productionBoost")
                } else {
                    if (this.hasClass("prolongProductionboostIron")) {
                        return b.toggleAutoprolong("productionboostIron", "productionBoost")
                    } else {
                        if (this.hasClass("prolongProductionboostCrop")) {
                            return b.toggleAutoprolong("productionboostCrop", "productionBoost")
                        } else {
                            if (this.hasClass("prolongPlus")) {
                                return b.toggleAutoprolong("plus", "plus")
                            }
                        }
                    }
                }
            }
            f.stop();
            return false
        })
    });
    var c = function (e) {
        $("paymentWizard").getElements(e).hide()
    };
    var d = "";
    a.getElements(".feature").addEvent("mouseover", function (g) {
        var e = this.getElements(".premiumFeatureName")[0];
        if (!e || e.length == 0) {
            g.stop();
            return false
        }
        var f = e.get("value");
        if (!f || f == b.lastFeatureName) {
            g.stop();
            return false
        }
        var h = $("paymentWizard");
        h.getElements(".infoArea .premiumFeature").hide();
        h.getElements(".contentArea .feature .dynamicContent").hide();
        this.getElement(".dynamicContent").show();
        h.getElements(".infoArea .premiumFeature").filter("." + f).show();
        b.lastFeatureName = f
    })
}, toggleAutoprolong: function (d, a) {
    var c = this;
    var b = new Object();
    b.cmd = "premiumFeature";
    b.featureKey = d;
    b.toggleAutoprolong = 1;
    Travian.ajax({data: b, onSuccess: function (e) {
        c.reload()
    }})
}, openProvider: function (b, a, c, d) {
    window.open("/tgpay.php?product=" + b + "&provider=" + a, "tgpay", "scrollbars=yes,status=yes,resizable=yes,toolbar=yes,width=" + c + ",height=" + d)
}});
/*
Travian.Game.WayOfPayment = new Class({featureKey: null, context: null, initialize: function (d, a, b) {
    if (typeof d == "undefined") {
        throw ("Feature Key must not be empty!")
    }
    var c = {};
    if (typeof b == "string" && typeof window[b] == "function") {
        c = window[b]()
    }
    if (typeof b == "function") {
        c = b()
    }
    this.featureKey = d;
    this.context = a;
    this.bookPremiumFeature(c)
}, bookPremiumFeature: function (a) {
    var b = {cmd: "premiumFeature", featureKey: this.featureKey, context: this.context};
    if (typeof a != "undefined") {
        var b = Object.merge({}, a, b)
    }
    var c = this;
	$("loader").removeClass("hide");
    Travian.ajax({data: b, onSuccess: function (d) {
        if (typeof d.functionToCall != "undefined") {
            if (typeof c[d.functionToCall] == "function") {
                c[d.functionToCall](d.options, d.context)
            } else {
                if (typeof window[d.functionToCall] == "function") {
                    window[d.functionToCall](d.options, d.context)
                }
            }
        }
    }})
}, renderDialog: function (a) {
    var b = a.dialogOptions;
    var c = a.html;
    a.context = this.featureKey;
    $dialog = new Travian.Dialog(b);
    $dialog.setContent(c);
    $dialog.show();
    return $dialog
}, closeDialog: function (a, b) {
    Travian.WindowManager.closeByContext(b)
}, hideDialog: function (a, b) {
    Travian.WindowManager.hideByContext(b)
}, unhideDialog: function (a, b) {
    Travian.WindowManager.showByContext(b)
}, reloadDialog: function (a, b) {
    if (b == null && undefined != a.scope) {
        b = a.scope.context
    }
    Travian.WindowManager.reloadWindowsByContext(b)
}, reloadUrl: function () {
    if ($$("body")[0].hasClass("ie6") || $$("body")[0].hasClass("ie7") || $$("body")[0].hasClass("ie8")) {
        window.location.reload()
    } else {
        window.location.href = window.location.href
    }
}, openPaymentWizard: function (c, a) {
    var b;
    var d = Travian.emptyFunction;
    if (typeof c.goldProductId != "undefined") {
        b = c.goldProductId
    }
    if (typeof c.callback != "undefined" && typeof this[c.callback] == "function") {
        d = this[c.callback]
    }
    this.closeDialog(c, "smallestPackage");
    window.fireEvent("startPaymentWizard", {data: {goldProductId: b, activeTab: "buyGold"}, callback: d, callbackScope: this})
}, openPaymentWizardWithProsTab: function () {
    window.fireEvent("startPaymentWizard", {data: {activeTab: "pros"}})
}});
Travian.Game.WayOfPaymentEventListener = new (new Class({WayOfPaymentObject: null, initialize: function () {
    this.DoubleClickPreventer = new Travian.DoubleClickPreventer();
    this.DoubleClickPreventer.timeout = 500;
    this.bindEvents()
}, bindEvents: function () {
    var a = this;
    window.addEvent("buttonClicked", function (c, b) {
        if (typeof b.wayOfPayment == "object" && a.DoubleClickPreventer.check()) {
            a.WayOfPaymentObject = a.startWayOfPayment(b.wayOfPayment.featureKey, b.wayOfPayment.context, b.wayOfPayment.dataCallback)
        }
    });
    window.addEvent("startWayOfPayment", function (d, b, c) {
        if (!a.DoubleClickPreventer.check()) {
            return false
        }
        a.WayOfPaymentObject = a.startWayOfPayment(d, b, c)
    })
}, startWayOfPayment: function (c, a, b) {
    return new Travian.Game.WayOfPayment(c, a, b)
}}));
Travian.Game.ButtonEventListener = new (new Class({initialize: function () {
    this.DoubleClickPreventer = new Travian.DoubleClickPreventer();
    this.bindEvents()
}, bindEvents: function () {
    var a = this;
    window.addEvent("buttonClicked", function (c, b) {
        $(c.id).blur();
        if (typeof b.dialog == "object" && b.dialog && a.DoubleClickPreventer.check()) {
            return new Travian.Dialog.Ajax(b.dialog)
        }
        if (typeof b.plusDialog == "object" && b.plusDialog && a.DoubleClickPreventer.check()) {
            return new Travian.Game.PlusDialog(b.plusDialog)
        }
        if (typeof b.productionBoostDialog == "object" && b.productionBoostDialog && a.DoubleClickPreventer.check()) {
            return new Travian.Game.ProductionBoostDialog(b.productionBoostDialog)
        }
        if (typeof b.reportSpamMessagesDialog == "object" && b.reportSpamMessagesDialog && a.DoubleClickPreventer.check()) {
            return new Travian.Game.ReportSpamMessagesDialog(b.reportSpamMessagesDialog)
        }
        if (typeof b.goldclubDialog == "object" && b.goldclubDialog && a.DoubleClickPreventer.check()) {
            return new Travian.Game.GoldclubDialog(b.goldclubDialog)
        }
        if (typeof b.questButtonTipsToggle != "undefined" && b.questButtonTipsToggle) {
            if (typeof b.questButtonActivateTips != "undefined" && b.questButtonActivateTips && typeof b.questButtonDeactivateTips != "undefined" && b.questButtonDeactivateTips) {
                return Travian.Game.Quest.toggleHighlights(undefined, b.questButtonActivateTips, b.questButtonDeactivateTips)
            }
        }
        if (typeof b.questButtonGainReward != "undefined" && b.questButtonGainReward) {
            return Travian.Game.Quest.rewardButtonClick(b.questId)
        }
        if (typeof b.questButtonNext != "undefined" && b.questButtonNext) {
            return Travian.Game.Quest.nextButtonClick(b.questId)
        }
        if (typeof b.questButtonSkipTutorial != "undefined" && b.questButtonSkipTutorial) {
            return Travian.Game.Quest.skipButtonClick()
        }
        if (typeof b.questButtonOverview != "undefined" && b.questButtonOverview) {
            return Travian.Game.Quest.openTodoListDialog()
        }
        if (typeof b.questButtonOverviewAchievements != "undefined" && b.questButtonOverviewAchievements) {
            return Travian.Game.Quest.openTodoListDialog("", true)
        }
        if (typeof b.questButtonCloseOverlay != "undefined" && b.questButtonCloseOverlay) {
            return Travian.Game.Quest.closeDialog()
        }
        if (typeof b.overlay != "undefined" && b.overlay && a.DoubleClickPreventer.check()) {
            return Travian.Game.Overlay.openOverlay()
        }
        if (typeof b.villageDialog != "undefined" && b.villageDialog && a.DoubleClickPreventer.check()) {
            return Travian.Game.showEditVillageDialog(b.villageDialog.title, b.villageDialog.description, b.villageDialog.saveText, b.villageDialog.villageId)
        }
        if (typeof b.redirectUrl != "undefinded" && b.redirectUrl && a.DoubleClickPreventer.check()) {
            window.location.href = b.redirectUrl;
            return false
        }
        if (typeof b.redirectUrlExternal != "undefinded" && b.redirectUrlExternal && a.DoubleClickPreventer.check()) {
            window.open(b.redirectUrlExternal);
            return false
        }
    });
    window.addEvent("tabClicked", function (c, b) {
        if (typeof b.dialog == "object" && b.dialog && a.DoubleClickPreventer.check()) {
            return new Travian.Dialog.Ajax(b.dialog)
        }
        if (typeof b.plusDialog == "object" && b.plusDialog && a.DoubleClickPreventer.check()) {
            return new Travian.Game.PlusDialog(b.plusDialog)
        }
        if (typeof b.goldclubDialog == "object" && b.goldclubDialog && a.DoubleClickPreventer.check()) {
            return new Travian.Game.GoldclubDialog(b.goldclubDialog)
        }
    })
}}));
*/

Travian.Game.GoldTransferDialog = new Class({Extends: Travian.Dialog.Ajax, options: {data: {cmd: "goldTransfer"}, saveOnUnload: false}, request: function () {
    var a = this;
    this.options.data.context = this.context;
    Travian.ajax({data: this.options.data, onSuccess: function (b) {
        if (b.showDialog == true) {
            a.setContent(a.createContent(a, b));
            a.show();
            return true
        } else {
            window.location.reload()
        }
    }});
    return this
}, initialize: function (a, c, b) {
    this.options.data.code = c;
    this.options.data.messageId = a;
    this.options.data.accept = b ? 1 : 0;
    this.options.data.refuse = b ? 0 : 1;
    this.parent(Object.merge({}, this.options, {}))
}, createContent: function (b, a) {
    return a.statusText
}, close: function () {
    window.location.reload()
}});
Travian.Game.Quest = new (new Class({Implements: [Options], options: {isTutorial: false, listData: {}, tutorialData: {}, dialogListData: {}, highlightSelectors: {}, tipsTurnoffAjaxTrigger: false}, highlightObjects: [], toggleStatus: false, initialize: function () {
    var a = false;
    if (Cookie.read("highlightsToggle") !== "false") {
        a = true
    }
    this.toggleHighlights(a)
}, dialog: {quest: null, achievement: null}, mentorClick: function (a) {
    if (Travian.WindowManager.getWindowsByContext("quest").length > 0) {
        Travian.WindowManager.closeByContext("quest")
    } else {
        if (this.options.isTutorial == true) {
            if (typeof a == "undefined" || a == "") {
                throw ("Keine ID zur Darstellung an den Questdialog Гјbergeben!")
            }
            this.openInformationDialog(a, this.options.tutorialData.answersLink)
        } else {
            this.openTodoListDialog(this.options.dialogListData.answersLink)
        }
    }
}, rewardButtonClick: function (a) {
    Travian.WindowManager.closeByContext("quest");
    new Travian.ajax({data: {cmd: "quest", questTutorialId: a, action: "reward"}})
}, skipButtonClick: function () {
    new Travian.ajax({data: {cmd: "quest", action: "skip"}})
}, nextButtonClick: function (a) {
    new Travian.ajax({data: {cmd: "quest", questTutorialId: a, action: "next"}})
}, createHighlights: function () {
    var d = this;
    this.highlightObjects.each(function (e) {
        e.deactivate()
    });
    this.highlightObjects = [];
    for (var b = 0; b < this.options.highlightSelectors.length; b++) {
        var c = this.options.highlightSelectors[b];
        var a = $$(c.selector);
        if (a.length > 0) {
            a.each(function (f) {
                var g = 1000;
                if (c.selector.match(/^\.dialog/)) {
                    g = Travian.WindowManager.getCurrentZIndex() + 2
                }
                var e = new Travian.Game.Highlight({element: f, renderer: c.renderer, rendererOptions: {zIndex: g}});
                d.highlightObjects.push(e);
                if (d.toggleStatus) {
                    e.activate()
                }
            });
            break
        }
    }
}, toggleHighlights: function (c, e, b) {
    if (typeof c === "undefined") {
        this.toggleStatus = !this.toggleStatus
    } else {
        this.toggleStatus = (c)
    }
    var d = this;
    Cookie.write("highlightsToggle", this.toggleStatus);
    var a = $("questTutorialLightBulb");
    if (a) {
        if (this.toggleStatus) {
            a.addClass("bulbActive").removeClass("bulbWhite");
            if (b) {
                a.setTip(b);
                Travian.Tip.show(b)
            }
        } else {
            a.removeClass("bulbActive").addClass("bulbWhite");
            if (e) {
                a.setTip(e);
                Travian.Tip.show(e)
            }
        }
    }
    if (this.options.tipsTurnoffAjaxTrigger && this.toggleStatus === false) {
        new Travian.ajax({data: {cmd: "quest", action: "tipsOff"}})
    }
    if (this.highlightObjects.length == 0 && this.options.highlightSelectors.length > 0) {
        this.createHighlights()
    }
    this.highlightObjects.each(function (f) {
        if (d.toggleStatus) {
            f.activate()
        } else {
            f.deactivate()
        }
    })
}, openInformationDialog: function (f, a, b) {
    if (!b) {
        b = null
    }
    var c = (this.options.isTutorial ? "tutorial" : "quest");
    var e = "quest";
    if (f.search(/Achievement/) != -1) {
        e = "achievement"
    }
    var d = this;
    if (this.dialog[e] === null) {
        Travian.WindowManager.closeByContext("quest");
        this.dialog[e] = new Travian.Dialog.Ajax({data: {cmd: "quest", questTutorialId: f, action: b}, context: e, buttonOk: false, enableBackground: false, draggable: true, savePositionForSession: {cookieName: "QuestDialogPosition"}, saveOnUnload: true, overlayCancel: false, infoIcon: a, cssClass: "white questInformation " + f + " " + c, preventFormSubmit: true, buttonTextInfo: Travian.Translation.get("answers." + f.toLowerCase() + "_title") || "Answers", onClose: function () {
            d.highlightObjects.each(function (g) {
                g.deactivate()
            });
            d.dialog[e] = null;
            if (d.options.isTutorial && d.options.tutorialData.id === "Tutorial_01") {
                Cookie.write("firstTutorialClosed", "true")
            }
        }, fx: {options: {duration: 0}}})
    } else {
        this.dialog[e].options.data.cmd = "quest";
        this.dialog[e].displayButtonOk(false);
        this.dialog[e].options.data.questTutorialId = f;
        this.dialog[e].options.data.action = b;
        this.dialog[e].options.infoIcon = a;
        this.dialog[e].options.buttonTextInfo = Travian.Translation.get("answers." + f.toLowerCase() + "_title") || "Answers", this.dialog[e].request()
    }
    this.dialog[e].wrapper.down("form").removeEvent("submit");
    this.dialog[e].wrapper.down("form").addEvent("submit", function (g) {
        g.stop();
        return false
    })
}, openTodoListDialog: function (k, g) {
    var f = this;
    var d = "quest";
    var h = "quest";
    var e = false;
    var b = "";
    var a = false;
    var c = true;
    if (typeof g !== "undefined" && g !== null) {
        d = "questachievements";
        h = "achievement";
        e = true;
        b = Travian.Translation.get("allgemein.close");
        a = true;
        c = false
    }
    if (this.dialog[h] === null) {
        Travian.WindowManager.closeByContext(d);
        this.dialog[h] = new Travian.Dialog.Ajax({data: {cmd: d}, context: h, buttonOk: e, buttonTextOk: b, buttonCloseOnClickOk: a, enableBackground: false, draggable: true, infoIcon: k, savePositionForSession: {cookieName: "QuestDialogAchievementPosition"}, saveOnUnload: c, overlayCancel: false, cssClass: "white questTodoList", preventFormSubmit: true, onClose: function () {
            f.dialog[h] = null
        }, fx: {options: {duration: 0}}})
    } else {
        this.dialog[h].options.data.cmd = d;
        this.dialog[h].displayButtonOk(e);
        this.dialog[h].options.data.questTutorialId = null;
        this.dialog[h].options.infoIcon = null;
        this.dialog[h].options.data.action = null;
        this.dialog[h].request()
    }
}, bindDialogTodoListDelegation: function () {
    var b = this;
    var a = $("questTodoListDialog");
    a.addEvent("click:relay(a.quest)", function (f, d) {
        f.stop();
        var c = d.get("data-questId");
        var e = d.get("data-category");
        b.openInformationDialog(c, b.options.listData[e].quests[c].answersLink)
    })
}, bindListDelegation: function (c) {
    var b = this;
    if (typeof c === "undefined" || c == null) {
        c = null
    }
    if (c == null) {
        var a = $("mentorTaskList")
    } else {
        var a = $(c)
    }
    if (!a.hasClass("notClickable")) {
        a.addEvent("click:relay(a.quest)", function (g, e) {
            g.stop();
            var d = e.get("data-questId");
            var f = e.get("data-category");
          //  b.openInformationDialog(d, "quest")
            b.openInformationDialog(d, null)
        })
    }
}, initializeQuests: function () {
    if (this.options.isTutorial && this.options.tutorialData.id === "Tutorial_01" && Cookie.read("firstTutorialClosed") !== "true") {
        if (Travian.WindowManager.getWindowsByContext("quest").length == 0) {
            this.openInformationDialog(this.options.tutorialData.id, this.options.tutorialData.answersLink)
        }
    }
}, addListData: function (b) {
    if (typeof b !== "undefined" && b != null) {
        for (var a in b) {
            this.options.listData[a] = b[a]
        }
    }
}, animateQuestMaster: function () {
    var a = $$("#questmasterButton .animation");
    var d = 0;
    var f = 15;
    var e = 30;
    var c = 5000;
    var b = function () {
        if (d == 0) {
            a.addClass("animate")
        }
        if (d == f) {
            a.removeClass("frame" + d);
            a.removeClass("animate");
            d = 0;
            window.setTimeout(b, c)
        } else {
            a.removeClass("frame" + d);
            d++;
            a.addClass("frame" + d);
            window.setTimeout(b, e)
        }
    };
    b()
}, closeDialog: function () {
    if (this.dialog.quest !== null) {
        this.dialog.quest.close()
    }
}}))();
Travian.Game.ReportSpamMessagesDialog = new (new Class({reportSpam: function (c, h, f, b, a) {
    var g = '<select size="1" id="spamReason">';
    for (var e in a) {
        g += '<option value="' + e + '">' + a[e] + "</option>"
    }
    g += '</select><br/><br/><span class="notice">' + b + "</span>";
    var d = new Travian.Dialog({title: h, keepOpen: true, buttonTextOk: f, onOpen: function () {
        d.disableForm()
    }, onOkay: function () {
        var k = $("spamReason");
        if (null !== k) {
            Travian.ajax({data: {cmd: "reportSpamMessage", messageId: c, spamReason: $("spamReason").getSelected().get("value")[0]}, onSuccess: function (l) {
                if (undefined !== l.reportingSuccessful && l.reportingSuccessful) {
                    d.setContent(l.reportingSuccessful);
                    $$(".dialog button .button-container .button-content .text").set("html", l.closeButtonText);
                    $("reportSpam").addClass("disabled").set("onclick", "");
                    d.enableForm();
                    $$(".dialog form").addEvent("submit", function (m) {
                        m.stop();
                        d.close()
                    })
                }
            }})
        }
    }});
    d.setContent(g);
    d.show();
    $(d).addEvent("change:relay(#spamReason)", function () {
        var k = this.getSelected().get("value")[0] == "not_chosen";
        d.toggleFormState(k)
    })
}}));
var timer = new Object();
var counter_plus = new Object();
var counter_minus = new Object();
var clientTime = Math.round(Date.now() / 1000);
var in_reload = 0;
var auto_reload = 1;
var countdownReachedZero = 0;
var counterOnZero = [];
var inCustomReload = 0;
var lastReload = 0;
var resources = new Object();
var timerReloadCheck = false;
var lastTimestampUseSilverExchange = 0;
var delayTimeForReload = 1000;
function t_format1(a) {
    p = a.innerHTML.split(":");
    sek = p[0] * 3600 + p[1] * 60 + p[2] * 1;
    return sek
}
function t_format2(d, f) {
    var a, e, b, c;
    if (d > -2) {
        a = Math.floor(d / 3600);
        e = Math.floor(d / 60) % 60;
        b = d % 60;
        c = a + ":";
        if (e < 10) {
            c += "0"
        }
        c += e + ":";
        if (b < 10) {
            c += "0"
        }
        c += b
    } else {
        c = f ? "0:00:0?" : (Travian.Game.eventJamHtml || "0:00:0?")
    }
    return c
}
function resetCounterForAjax() {
    clientTime = Math.round(Date.now() / 1000);
    initTimer("l1", "lbar1");
    initTimer("l2", "lbar2");
    initTimer("l3", "lbar3");
    initTimer("l4", "lbar4");
    countdownReachedZero = 0;
    lastReload = 0;
    inCustomReload = 0;
    counterOnZero = [];
    in_reload = 0;
    counter_plus = {};
    counter_minus = {};
    initCounter()
}
function initCounter() {
    var a = null;
    for (var b = 1; ; b++) {
        a = document.getElementById("tp" + b);
        if (a != null) {
            counter_plus[b] = new Object();
            counter_plus[b].node = a;
            counter_plus[b].counter_time = t_format1(a)
        } else {
            break
        }
    }		var timers = document.querySelectorAll('span[id^="timer"]');	var tities = [];		for(var key in timers) {				if (timers.hasOwnProperty(key)) {						tities.push(timers[key].id)					}				}	
    for (b = 0; ; b++) {		a = document.getElementById(tities[b]);
        if (a != null) {
            counter_minus[b] = new Object();
            counter_minus[b].node = a;
            counter_minus[b].counter_time = t_format1(a)
        } else {			
            break			
        }
    }
    executeCounter()
}
function executeCounter() {
    for (var a in counter_plus) {
        time_elapsed = Math.round(Date.now() / 1000) - clientTime;
        div_time = t_format2(counter_plus[a].counter_time + time_elapsed);
        counter_plus[a].node.innerHTML = div_time
    }
    for (a in counter_minus) {
        time_elapsed = Math.round(Date.now() / 1000) - clientTime;
        int_time = counter_minus[a].counter_time - time_elapsed;
        if (in_reload == 0 && int_time+0.1 <= 0) {
            in_reload = 1;
            if (auto_reload == 1) {
                timerReloadForModalDialogs()
            } else {
                if (auto_reload == 0) {
                    setTimeout("mreload()", delayTimeForReload)
                } else {
                    if (auto_reload == 2) {
                        in_reload = 0;
                        if (time_elapsed != lastReload) {
                            lastReload = time_elapsed;
                            countdownReachedZero = 1;
                            counterOnZero[counterOnZero.length] = a;
                            if (functionCustomReloadExists()) {
                                window.customReload()
                            }
                        }
                    }
                }
            }
        }
        div_time = t_format2(int_time);
        counter_minus[a].node.innerHTML = div_time
    }
    if (in_reload == 0) {
       //wait(500);

        window.setTimeout("executeCounter()", 1000)
    }
}
function functionCustomReloadExists() {
    if ("function" == typeof window.customReload) {
        return true
    }
    return false
}
function initTimer(b, c) {
    var a = document.getElementById(b);
    if (a != null) {
        resources[b] = new Object();
        timer[b] = new Object();
        var d = resources.production[b];
        if (d != 0) {
            timer[b].start = Date.now();
            timer[b].production = d;
            timer[b].start_res = resources.storage[b];
            timer[b].max_res = resources.maxStorage[b];
            timer[b].min_res = 0;
            timer[b].ms = Math.max((3600000 / d), 100);
            timer[b].bar_name = c;
            timer[b].node = a;
            executeTimer(b)
        } else {
            resources[b].value = resources.storage[b]
        }
    }
}
function executeTimer(a) {
    time_elapsed = Date.now() - timer[a].start;
    if (time_elapsed >= 0) {
        new_res = Math.floor(timer[a].start_res + time_elapsed * (timer[a].production / 3600000));
        if (new_res >= timer[a].max_res) {
            new_res = timer[a].max_res
        } else {
            if (new_res <= timer[a].min_res) {
                new_res = timer[a].min_res
            } else {
                window.setTimeout("executeTimer('" + a + "')", timer[a].ms)
            }
        }
        resources[a].value = new_res;
        var d = new Travian.Formatter({forceDecimal: false});
        timer[a].node.innerHTML = d.getFormattedNumber(new_res);
        var c = $(timer[a].bar_name);
        if (c) {
            var b = Math.round(100 * new_res / timer[a].max_res);
            b = Math.min(b, 100);
            b = Math.max(0, b);
            c.removeClass("stockFull");
            if (new_res >= timer[a].max_res) {
                c.addClass("stockFull")
            }
            c.setStyles({width: b + "%"})
        }
    }
}
function mreload() {
    param = "reload=auto";
    url = window.location.href;
    if (url.indexOf(param) == -1) {
        if (url.indexOf("?") == -1) {
            url += "?" + param
        } else {
            url += "&" + param
        }
    }
    document.location.href = url
}
function timerReloadForModalDialogs() {
    timerReloadCheck = !Travian.WindowManager.checkForModalDialogs();
    var a = new Date().getTime() - 10000;
    if (timerReloadCheck === true && lastTimestampUseSilverExchange > a) {
        timerReloadCheck = false
    }
    if (timerReloadCheck) {
        document.location.reload()
    } else {
        //setTimeout(timerReload, 20000)
        document.location.reload()
    }
}
function http_request(url, callback, method, post_data) {
    if (method === undefined) {
        method = "GET"
    }
    var httprid;
    if (window.XMLHttpRequest) {
        httprid = new XMLHttpRequest()
    } else {
        if (window.ActiveXObject) {
            try {
                httprid = new ActiveXObject("Msxml2.XMLHTTP")
            } catch (e) {
                try {
                    httprid = new ActiveXObject("Microsoft.XMLHTTP")
                } catch (e) {
                }
            }
        } else {
            throw"Can not create XMLHTTP-instance"
        }
    }
    httprid.onreadystatechange = function () {
        if (httprid.readyState == 4) {
            if (httprid.status == 200) {
                var content_type = httprid.getResponseHeader("Content-Type");
                content_type = content_type.substr(0, content_type.indexOf(";"));
                switch (content_type) {
                    case"application/json":
                        callback((httprid.responseText == "" ? null : eval("(" + httprid.responseText + ")")));
                        break;
                    case"text/plain":
                    case"text/html":
                        callback(httprid.responseText);
                        break;
                    default:
                        throw"Illegal content type"
                }
            } else {
                throw"An error has occurred during request"
            }
        }
    };
    httprid.open(method, url, true);
    if (method == "POST") {
        httprid.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");
        var parameters = encode_querystring(post_data)
    } else {
        var parameters = null
    }
    httprid.send(parameters)
}
function encode_querystring(b) {
    var a = "";
    var d = true;
    for (var c in b) {
        a += (d ? "" : "&") + c + "=" + window.encodeURI(b[c]);
        if (d) {
            d = false
        }
    }
    return a
}








Travian.Game.Map = (function () {
    var a = 0;
    return{Containers: null, debug: false, version: 1, getNewId: function () {
        a++;
        return"mapId" + a
    }, isMapPositionInRect: function (d, b) {
        if (d.x0 <= b.x && d.y0 <= b.y && b.x <= d.x1 && b.y <= d.y1) {
            return true
        }
        var c = {x: b.x + (b.x < 0 ? +801 : -801), y: b.y + (b.y < 0 ? +801 : -801)};
        if (d.x0 <= b.x && d.y0 <= b.y && b.x <= d.x1 && b.y <= d.y1) {
            return true
        }
        return false
    }, isPositionInRect: function (c, b) {
        return(c.x0 <= b.x && c.y0 <= b.y && b.x <= c.x1 && b.y <= c.y1)
    }, register: function (b) {
        if (this.debug) {
            if (this.Containers == null) {
                this.Containers = []
            }
            this.Containers.push(b)
        }
    }, remapShortParameters: function (b) {
        if (typeof b.x != "undefined" && typeof b.y != "undefined") {
            b.position = {x: b.x, y: b.y};
            delete (b.x);
            delete (b.y)
        }
        if (typeof b.s != "undefined") {
            b.symbols = b.s;
            delete (b.s)
        }
        if (typeof b.c != "undefined") {
            b.title = b.c;
            delete (b.c)
        }
        if (typeof b.t != "undefined") {
            b.text = b.t;
            delete (b.t)
        }
        if (typeof b.u != "undefined") {
            b.uid = b.u;
            delete (b.u)
        }
        if (typeof b.d != "undefined") {
            b.did = b.d;
            delete (b.d)
        }
        if (typeof b.a != "undefined") {
            b.aid = b.a;
            delete (b.a)
        }
        return b
    }, xy2id: function (c, b) {
        if (c > 400) {
            c -= 801
        } else {
            if (c < -400) {
                c += 801
            }
        }
        if (b > 400) {
            b -= 801
        } else {
            if (b < -400) {
                b += 801
            }
        }
        $id = (400 + c) + (400 - b) * 801 + 1;
        if ($id < 1 || $id > 641601) {
            $id = 320801
        }
        return $id
    }}
})();
Travian.Game.Map.Base = new Class({contextMenu: null, id: null, globalProperties: ["cookie", "dataStore", "transition", "updater", "contextMenu"], element: null, options: null, parentContainer: null, transition: null, classType: "Travian.Game.Map.Base", updater: null, destroy: function () {
    if (this.element) {
        this.element.destroy()
    }
}, getMapCoordinates: function () {
    if (!this.position || !this.transition) {
        return null
    }
    return this.transition.translateToMap(this.position)
}, initialize: function (a, c) {
    a = Travian.Game.Map.remapShortParameters(a);
    var b = this;
    this.options = Object.merge({}, a);
    Object.each(this.options, function (e, d) {
        b[d] = e
    });
    if (this.id == null) {
        this.id = Travian.Game.Map.getNewId()
    }
    if (c) {
        this.parentContainer = c;
        this.globalProperties.each(function (d) {
            if (b.parentContainer[d]) {
                b[d] = b.parentContainer[d]
            }
        });
        if (c.classType == "Travian.Game.Map.Container") {
            this.mapContainer = c
        } else {
            if (c.mapContainer) {
                this.mapContainer = this.parentContainer.mapContainer
            }
        }
    }
}, isMapPositionInRect: function (a) {
    if (!this.mapCoordinates || !a) {
        return false
    }
    var b = Object.clone(this.mapCoordinates);
    if (!b.right) {
        b.right = b.x
    }
    if (!b.bottom) {
        b.bottom = b.y
    }
    return(b.x <= a.x && b.y <= a.y && a.x <= b.right && a.y <= b.bottom)
}, isPositionInRect: function (a) {
    return Travian.Game.Map.isPositionInRect({x0: this.position.x, y0: this.position.y, x1: this.position.x + this.position.width, y1: this.position.y + this.position.height}, a)
}, render: function (a) {
    a = a || {};
    if (!a.nodeType) {
        a.nodeType = "div"
    }
    this.element = (new Element(a.nodeType)).disableSelection();
    return this
}});
Travian.Game.Map.Container = (function () {
    var a = function (c) {
        var f = false;
        var b = false;
        var l = null;
        var g = {count: 0, shift: false, control: false, alt: false, keys: {}, fn: null};
        var d = {moved: false, x: null, y: null, target: null};
        Object.each(c.keyboard, function (o, n) {
            if (typeof c.keyboard[n] == "string") {
                c.keyboard[n] = {fn: c.keyboard[n]}
            }
            c.keyboard[n] = Object.append({on: ["keydown", "keyup"], periodical: 1}, c.keyboard[n]);
            if (typeof c.keyboard[n].fn == "string") {
                g.keys[n] = false
            }
        });
        var m = c.containerRender.getStyle("cursor");
        var k = function (q, n, r, o) {
            if (!c.isEventsEnabled()) {
                return
            }
            //возможно размер двигабельности карты тут
            if (c.containerViewSize.x <= n && c.containerViewSize.y <= r && n <= c.containerViewSize.right && r <= c.containerViewSize.bottom && o == c.containerMover && !q.rightClick) {
                f = true;
                b = false;
                l = {x: n, y: r};
                q.stop()
            }
        };
        var e = function (o, n, r) {
            if (c.containerViewSize.x <= n && c.containerViewSize.y <= r && n <= c.containerViewSize.right && r <= c.containerViewSize.bottom) {
                c.currentMousePosition.browserAbsolute.x = n;
                c.currentMousePosition.browserAbsolute.y = r;
                c.currentMousePosition.browser.x = n - c.containerSize.x - c.elementSize.x;
                c.currentMousePosition.browser.y = r - c.containerSize.y - c.elementSize.y;
                c.currentMousePosition.map = c.transition.translateToMap(c.currentMousePosition.browser)
            } else {
                c.currentMousePosition.browserAbsolute.x = null;
                c.currentMousePosition.browserAbsolute.y = null;
                c.currentMousePosition.browser.x = null;
                c.currentMousePosition.browser.y = null;
                c.currentMousePosition.map.x = null;
                c.currentMousePosition.map.y = null
            }
            if (!f) {
                return
            }
            if (!c.isEventsEnabled()) {
                return
            }
            var q = {x: n - l.x, y: -(r - l.y)};
            l = {x: n, y: r};
            b = true;
            c.containerRender.setStyles({cursor: "move"});
            c.move(q);
            o.stop()
        };
        var h = function (o, n, r) {
            if (!c.isEventsEnabled()) {
                return
            }
            if (n != null && r != null && c.containerViewSize.x <= n && c.containerViewSize.y <= r && n <= c.containerViewSize.right && r <= c.containerViewSize.bottom && !o.rightClick && !b && f && !Travian.WindowManager.checkOpenWindowByContext("map")) {
                var q = c.transition.translateToMap({x: n - c.containerViewSize.x - c.elementSize.x, y: r - c.containerViewSize.y - c.elementSize.y});
                if (c.tileDisplayInformation.type == "dialog") {
                    new Travian.Dialog.Ajax(Object.merge({}, c.tileDisplayInformation.optionsDialog, {context: "map", stickToUrlOnRestore: true, data: {x: q.x, y: q.y}, onOpen: function (t, s) {
                        $(s).getElements('a[href^="karte.php"]').addEvent("click", function (v) {
                            v.stop();
                            var u = new URI(v.target.href);
                            c.moveTo({x: parseInt(u.getData("x")), y: parseInt(u.getData("y"))});
                            t.close();
                            return false
                        })
                    }}))
                } else {
                    Travian.popup(c.tileDisplayInformation.optionsPopup.url.substitute(q), c.tileDisplayInformation.optionsPopup.windowOptions)
                }
            }
            c.containerRender.setStyles({cursor: m});
            if (b) {
                o.stop()
            }
            f = false;
            b = false
        };
        $(document).addEvents({selectstart: function (n) {
            if (!c.isEventsEnabled()) {
                return
            }
            if (!b) {
                return
            }
            n.stop();
            return false
        }, dragstart: function (n) {
            if (!c.isEventsEnabled()) {
                return
            }
            if (!b) {
                return
            }
            n.stop();
            return false
        }, mousedown: function (n) {
            k(n, n.page.x, n.page.y, n.target)
        }, mousemove: function (n) {
            e(n, n.page.x, n.page.y)
        }, mouseup: function (n) {
            h(n, n.page.x, n.page.y)
        }, mousewheel: function (n) {
            if (!c.isEventsEnabled()) {
                return
            }
            if (c.containerViewSize.x <= n.page.x && c.containerViewSize.y <= n.page.y && n.page.x <= c.containerViewSize.right && n.page.y <= c.containerViewSize.bottom && n.target == c.containerMover) {
                var o = c.transition.translateToMap({x: n.page.x - c.containerViewSize.x - c.elementSize.x, y: n.page.y - c.containerViewSize.y - c.elementSize.y});
                if (n.wheel < 0) {
                    c.zoomOut(o)
                } else {
                    if (n.wheel > 0) {
                        c.zoomIn(o)
                    }
                }
                n.stop()
            }
        }, touchstart: function (n) {
            d.moved = false;
            d.x = n.event.touches[0].pageX;
            d.y = n.event.touches[0].pageY;
            d.target = n.event.touches[0].target;
            k(n, d.x, d.y, d.target)
        }, touchmove: function (n) {
            d.moved = true;
            d.x = n.event.touches[0].pageX;
            d.y = n.event.touches[0].pageY;
            d.target = n.event.touches[0].target;
            e(n, d.x, d.y)
        }, touchend: function (n) {
            h(n, d.x, d.y)
        }, keydown: function (n) {
            if (!c.isEventsEnabled()) {
                return
            }
            if (n.shift) {
                g.shift = true
            }
            if (n.control) {
                g.control = true
            }
            if (n.alt) {
                g.alt = true
            }
            if (g.keys[n.code] === false && n.target.nodeName.toLowerCase() !== "input") {
                if (c.keyboard[n.code].on.contains("keydown") == false) {
                    return
                }
                g.count++;
                g.keys[n.code] = true;
                n.stop();
                if (!g.fnTimer) {
                    g.fn = (function () {
                        Object.each(g.keys, function (s, q) {
                            if (s) {
                                if (!c.keyboard[q]) {
                                    return
                                }
                                var u = c.keyboard[q].fn;
                                if (u === false || !c[u]) {
                                    return
                                }
                                var r = "";
                                if (u.substring(0, 4) == "move") {
                                    r = "normal";
                                    var o = c.keyboard.speed.slow;
                                    var t = c.keyboard.speed.fast;
                                    if (g[o] && !g[t]) {
                                        r = "slow"
                                    } else {
                                        if (!g[o] && g[t]) {
                                            r = "fast"
                                        }
                                    }
                                } else {
                                    if (u.substring(0, 4) == "zoom") {
                                        r = null
                                    }
                                }
                                c[u](r)
                            }
                        })
                    });
                    if (c.keyboard[n.code].periodical == 0) {
                        g.fn()
                    } else {
                        if (c.keyboard[n.code].periodical > 0) {
                            g.fnTimer = g.fn.periodical(c.keyboard[n.code].periodical)
                        }
                    }
                }
            }
        }, keyup: function (n) {
            if (!c.isEventsEnabled()) {
                return
            }
            if (!n.shift) {
                g.shift = false
            }
            if (!n.control) {
                g.control = false
            }
            if (!n.alt) {
                g.alt = false
            }
            if (g.keys[n.code]) {
                if (c.keyboard[n.code].on.contains("keyup") == false) {
                    return
                }
                g.count--;
                g.keys[n.code] = false;
                n.stop();
                if (g.count == 0 && g.fnTimer) {
                    clearInterval(g.fnTimer);
                    g.fnTimer = null
                }
            }
        }})
    };
    return new Class({Extends: Travian.Game.Map.Base, blocks: null, classType: "Travian.Game.Map.Container", containerRender: null, containerSize: null, containerViewSize: null, currentMousePosition: {browserAbsolute: {x: null, y: null}, browser: {x: null, y: null}, map: {x: null, y: null}}, element: null, elementSize: null, eventsEnabled: true, gridDisplayed: true, loading: false, forcedUpdates: 0, addSymbol: function (b) {
        var c = this.blocks.find(function (d) {
            return d.isMapPositionInRect(b.position)
        });
        if (c) {
            c.addSymbol(b)
        }
        return this
    }, deleteSymbol: function (b) {
        var c = this.blocks.find(function (d) {
            return d.isMapPositionInRect(b.position)
        });
        if (c) {
            c.deleteSymbol(b)
        }
        return this
    }, disableEvents: function () {
        this.eventsEnabled = false;
        return this
    }, enableEvents: function () {
        this.eventsEnabled = true;
        return this
    }, forceUpdateBlocksLayer: function (b) {
        this.forcedUpdates = this.forcedUpdates + 1;
        this.blocks.each(function (c) {
            c.forceUpdateLayer(b)
        });
        return this
    }, forceUpdateBlocksSymbols: function (c, b) {
        this.blocks.each(function (d) {
            d.forceUpdateSymbols(c, b)
        });
        return this
    }, getContentForTooltip: function (b) {
        var c = this.blocks.find(function (d) {
            return d.isPositionInRect(b)
        });
        return c ? c.getContentForTooltip(b) : false
    }, hideGrid: function () {
        this.cookie.set("grid", false);
        this.gridDisplayed = false;
        return this.updateGrid()
    }, initialize: function (b) {
        var d = this;
        var c = null;
        this.loading = true;
        if (typeof b == "undefined") {
            b = Travian.Game.Map.Options.Default
        }
        this.parent(b);
        this.onMove = this.onMove || Travian.emptyFunction;
        this.onCreate = this.onCreate || Travian.emptyFunction;
        this.onRender = this.onRender || Travian.emptyFunction;
        this.onZoom = this.onZoom || Travian.emptyFunction;
        Travian.Game.Map.register(this);
        this.cookie = new Hash.Cookie(this.id);
        this.containerRender = this.container = $(this.container);
        this.containerRender._map = this;
        var e = Object.append(this.containerRender.getDimensions({computeSize: true}), this.containerRender.getPosition());
        if (!this.containerViewSize) {
            this.containerViewSize = {}
        }
        if (typeof this.containerViewSize.x == "undefined") {
            this.containerViewSize.x = e.x
        }
        if (typeof this.containerViewSize.y == "undefined") {
            this.containerViewSize.y = e.y
        }
        if (typeof this.containerViewSize.width == "undefined") {
            this.containerViewSize.width = e.width
        }
        if (typeof this.containerViewSize.height == "undefined") {
            this.containerViewSize.height = e.height
        }
        this.containerViewSize.right = this.containerViewSize.x + this.containerViewSize.width;
        this.containerViewSize.bottom = this.containerViewSize.y + this.containerViewSize.height;
        this.containerSize = {x: this.containerViewSize.x, y: this.containerViewSize.y, width: Math.ceil(this.containerViewSize.width / this.blockSize.width) * this.blockSize.width, height: Math.ceil(this.containerViewSize.height / this.blockSize.height) * this.blockSize.height, right: this.containerViewSize.x + Math.ceil(this.containerViewSize.width / this.blockSize.width) * this.blockSize.width, bottom: this.containerViewSize.y + Math.ceil(this.containerViewSize.height / this.blockSize.height) * this.blockSize.height};
        this.globalProperties.each(function (f) {
            if (Travian.Game.Map[f.capitalize()]) {
                d[f] = new Travian.Game.Map[f.capitalize()](d[f] || {}, d)
            }
        });
        if (this.data.elements) {
            this.dataStore.setMultiple(Travian.Game.Map.DataStore.TYPE_TILE, this.data.elements)
        }
        var c = this.cookie.get("grid");
        if (c !== null) {
            this.gridDisplayed = c
        }
        this.onCreate(this);
        this.render()
    }, invalidateBlockVersionCache: function () {
        Object.each(this.blocks, function (b) {
            b.invalidateVersionCache()
        });
        return this
    }, isEventsEnabled: function () {
        return this.eventsEnabled
    }, move: function (b) {
        this.transition.move(b);
        if (this.blocks != null) {
            Object.each(this.blocks, function (c) {
                c.move(b)
            })
        }
        if (this.loading) {
            if (!this.blockInitialDelta) {
                this.blockInitialDelta = {x: 0, y: 0}
            }
            this.blockInitialDelta.x += b.x;
            this.blockInitialDelta.y += b.y
        }
        this.onMove(this, b);
        return this
    }, moveDown: function (b) {
        if (typeof b == "string") {
            b = this.speeds[b]
        }
        if (!b) {
            return
        }
        return this.move({x: 0, y: b})
    }, moveLeft: function (b) {
        if (typeof b == "string") {
            b = this.speeds[b]
        }
        if (!b) {
            return
        }
        return this.move({x: b, y: 0})
    }, moveLeftDown: function (b) {
        if (typeof b == "string") {
            b = this.speeds[b]
        }
        if (!b) {
            return
        }
        return this.move({x: b, y: b})
    }, moveLeftUp: function (b) {
        if (typeof b == "string") {
            b = this.speeds[b]
        }
        if (!b) {
            return
        }
        return this.move({x: b, y: -b})
    }, moveRight: function (b) {
        if (typeof b == "string") {
            b = this.speeds[b]
        }
        if (!b) {
            return
        }
        return this.move({x: -b, y: 0})
    }, moveRightDown: function (b) {
        if (typeof b == "string") {
            b = this.speeds[b]
        }
        if (!b) {
            return
        }
        return this.move({x: -b, y: b})
    }, moveRightUp: function (b) {
        if (typeof b == "string") {
            b = this.speeds[b]
        }
        if (!b) {
            return
        }
        return this.move({x: -b, y: -b})
    }, moveTo: function (c) {
        var b = this.transition.translateToBrowser({x: Math.floor(c.x), y: Math.floor(c.y)});
        b.x += this.blockSize.width / this.transition.elementsPerBlock.x / 2;
        b.y += this.blockSize.height / this.transition.elementsPerBlock.y / 2;
        b.x += (this.containerSize.width - this.containerViewSize.width) / 2;
        b.y += (this.containerSize.height - this.containerViewSize.height) / 2;
        return this.move({x: this.elementSize.width / 2 - b.x, y: -(this.elementSize.height / 2 - b.y)})
    }, moveUp: function (b) {
        if (typeof b == "string") {
            b = this.speeds[b]
        }
        if (!b) {
            return
        }
        return this.move({x: 0, y: -b})
    }, render: function () {
        //наверн эт карта
        if (top === self){
            this.container = new Element("div", {styles: {overflow: "hidden", position: "relative", left: 0, top: 0, width: "100%", height: "100%", right: 0, bottom: 0}}).disableSelection().inject(this.containerRender, "top").set("oncontextmenu", "return (false);");
        }else{
            var w = window.innerWidth;
            var h = window.innerHeight/1.05;

            var width = w+"px";
            var  height = h+"px";
            this.container = new Element("div", {styles: {overflow: "hidden", position: "relative", left: 0, top: 0, width: width, height: height, right: 0, bottom: 0}}).disableSelection().inject(this.containerRender, "top").set("oncontextmenu", "return (false);");

        }
        this.elementSize = {x: -this.blockSize.width * this.blockOverflow, y: -this.blockSize.height * this.blockOverflow, width: this.containerSize.width + this.blockSize.width * this.blockOverflow * 2, height: this.containerSize.height + this.blockSize.height * this.blockOverflow * 2};

        this.parent({nodeType: "div"}).element.setStyles({position: "absolute", left: this.elementSize.x, top: this.elementSize.y, width: this.elementSize.width, height: this.elementSize.height}).inject(this.container, "top");
        this.containerMover = new Element("div", {styles: {overflow: "hidden", position: "absolute", left: 0, top: 0, width: this.containerViewSize.width, height: this.containerViewSize.height, zIndex: 100, backgroundColor: Browser.ie ? "#FFFFFF" : "transparent", opacity: Browser.ie ? 0.001 : 1}}).disableSelection().inject(this.container, "after");
        this.onRender(this);
        this.moveTo(this.mapInitialPosition);
        this.renderBlocks();
        if (this.gridDisplayed) {
            this.showGrid()
        }
        a(this);
        this.loading = false;
        return this
    }, renderBlocks: function () {
        if (this.blocks) {
            return this
        }
        this.blocks = [];
        var c = Math.ceil(this.elementSize.width / this.blockSize.width);
        var b = Math.ceil(this.elementSize.height / this.blockSize.height);
        var e = {x: 0, y: 0};
        var g = null;
        var l = null;
        var d = null;
        if (this.blockInitialDelta) {
            e = Object.clone(this.blockInitialDelta);
            delete (this.blockInitialDelta)
        }
        for (var h = 0, f = 0; h < b; h++) {
            for (var k = 0; k < c; k++) {
                g = Travian.Game.Map.Layer.Block.getCorrectPosition({x: k * this.blockSize.width + e.x, y: h * this.blockSize.height - e.y, width: this.blockSize.width, height: this.blockSize.height}, this).position;
                l = this.transition.translateToMap(g);
                d = {id: f++, version: 0};
                if (this.data.blocks[l.x] && this.data.blocks[l.x][l.y] && this.data.blocks[l.x][l.y][l.right] && this.data.blocks[l.x][l.y][l.right][l.bottom]) {
                    d = Object.merge(d, this.data.blocks[l.x][l.y][l.right][l.bottom])
                }

                this.blocks.push(new Travian.Game.Map.Layer.Block(Object.merge({}, this.options.block, {id: d.id, symbolTypes: this.symbolTypes, position: g, mapCoordinates: l, version: d.version}), this))
            }
        }
        return this
    }, showGrid: function () {
        this.cookie.set("grid", true);
        this.gridDisplayed = true;
        return this.updateGrid()
    }, toggleGrid: function () {
        var b = "showGrid";
        if (this.gridDisplayed === true) {
            b = "hideGrid"
        }
        return this[b]()
    }, toggleMiniMap: function () {
        return this.miniMap.animate()
    }, toggleOutline: function () {
        return this.outline.animate()
    }, updateGrid: function () {
        var c = this;
        var b = c.gridDisplayed ? this.grid[this.transition.zoomLevel] : false;
        this.element.select(".imageMark").each(function (d) {
            d.setStyles({backgroundColor: "transparent", backgroundImage: b != false ? "url(" + b + ")" : "none", backgroundPosition: "left top", backgroundRepeat: "repeat"})
        });
        return this
    }, updateSymbolData: function (b) {
        var c = this.blocks.find(function (d) {
            return d.isMapPositionInRect(b.position)
        });
        if (c) {
            c.updateSymbolData(b)
        }
        return this
    }, zoom: function (c, b) {
        if (this.transition.zoom(c)) {
            this.onZoom(this);
            this.moveTo(b);
            if (this.gridDisplayed) {
                this.updateGrid()
            }
        }
        return this
    }, zoomIn: function (b) {
        if (!b) {
            b = this.transition.getPointOfCenterInView()
        }
        return this.zoom(-1, b)
    }, zoomOut: function (b) {
        if (!b) {
            b = this.transition.getPointOfCenterInView()
        }
        return this.zoom(1, b)
    }})
})();
Travian.Game.Map.Transition = (function () {
    var a = [];
    var d = function (g, f) {
        var e = false;
        do {
            e = false;
            if (Math.round(g.x) > f.border.right) {
                g.x = f.border.left + (g.x - f.border.right) - 1;
                e = true
            } else {
                if (Math.round(g.x) < f.border.left) {
                    g.x = f.border.right - (f.border.left - g.x) + 1;
                    e = true
                }
            }
            if (Math.round(g.right) > f.border.right) {
                g.right = f.border.left + (g.right - f.border.right) - 1;
                e = true
            } else {
                if (Math.round(g.right) < f.border.left) {
                    g.right = f.border.right - (f.border.left - g.right) + 1;
                    e = true
                }
            }
            if (Math.round(g.y) > f.border.bottom) {
                g.y = f.border.top + (g.y - f.border.bottom) - 1;
                e = true
            } else {
                if (Math.round(g.y) < f.border.top) {
                    g.y = f.border.bottom - (f.border.top - g.y) + 1;
                    e = true
                }
            }
            if (Math.round(g.bottom) > f.border.bottom) {
                g.bottom = f.border.top + (g.bottom - f.border.bottom) - 1;
                e = true
            } else {
                if (Math.round(g.bottom) < f.border.top) {
                    g.bottom = f.border.bottom - (f.border.top - g.bottom) + 1;
                    e = true
                }
            }
        } while (e);
        return g
    };
    var b = function (e) {
        e.elementsPerBlock = e.zoomOptions.sizes[e.zoomLevel - 1];
        e.pixelPerTile = {x: e.mapContainer.blockSize.width / e.elementsPerBlock.x, y: e.mapContainer.blockSize.height / e.elementsPerBlock.y};
        e.elementsInView = {x: e.elementsPerBlock.x * e.mapContainer.containerSize.width / e.mapContainer.blockSize.width, y: e.elementsPerBlock.y * e.mapContainer.containerSize.height / e.mapContainer.blockSize.height}
    };
    var c = function (h, f) {
        var g = {x: h.mapContainer.containerSize.x + h.mapContainer.elementSize.x, y: h.mapContainer.containerSize.y + h.mapContainer.elementSize.y};
        var e = h.mapContainer.blockSize.height / h.elementsPerBlock.y;
        return{x: (f.x - h.positionOrigin.map.x) * h.pixelPerTile.x + h.positionOrigin.browser.x - g.x, y: (h.positionOrigin.map.y - f.y) * h.pixelPerTile.y - e - g.y + h.positionOrigin.browser.y}
    };
    return new Class({Extends: Travian.Game.Map.Base, classType: "Travian.Game.Map.Transition", elementsPerBlock: null, pixelPerTile: null, zoomLevel: null, correctCoordinates: function (e) {
        return d(e, this)
    }, getPointOfCenterInView: function () {
        var e = {x: this.mapContainer.containerViewSize.x + this.mapContainer.containerViewSize.width / 2, y: this.mapContainer.containerViewSize.y + this.mapContainer.containerViewSize.height / 2};
        e.x -= this.mapContainer.containerSize.x;
        e.y -= this.mapContainer.containerSize.y;
        e.x -= this.mapContainer.elementSize.x;
        e.y -= this.mapContainer.elementSize.y;
        return this.translateToMap(e)
    }, initialize: function (e, g) {
        var f = this;
        this.parent(e, g);
        this.onMove = this.onMove || Travian.emptyFunction;
        this.onCreate = this.onCreate || Travian.emptyFunction;
        this.onZoom = this.onZoom || Travian.emptyFunction;
        this.border.width = this.border.right - this.border.left + 1;
        this.border.height = this.border.bottom - this.border.top + 1;
        this.zoomLevel = this.zoomOptions.level;
        this.zoomOptions.sizes.each(function (k, h) {
            if (typeof k == "number") {
                f.zoomOptions.sizes[h] = {x: Math.floor(f.zoomOptions.sizes[h] * f.mapContainer.blockSize.width / f.mapContainer.containerSize.width), y: Math.floor(f.zoomOptions.sizes[h] * f.mapContainer.blockSize.height / f.mapContainer.containerSize.height)}
            }
        });
        this.positionOrigin = {browser: {x: this.mapContainer.containerSize.x, y: this.mapContainer.containerSize.y + this.mapContainer.containerSize.height}, map: {x: 0, y: 0}};
        b(this);
        this.onCreate(this)
    }, move: function (e) {
        this.positionOrigin.browser.x += e.x;
        this.positionOrigin.browser.y -= e.y;
        this.onMove(this, e);
        return this
    }, registerCallbackOnZoom: function (e) {
        a.push(e);
        return this
    }, translateToBrowser: function (f) {
        var g = {x: this.mapContainer.containerSize.x + this.mapContainer.elementSize.x, y: this.mapContainer.containerSize.y + this.mapContainer.elementSize.y};
        var e = this.mapContainer.blockSize.height / this.elementsPerBlock.y;
        return{x: (f.x - this.positionOrigin.map.x) * this.pixelPerTile.x + this.positionOrigin.browser.x - g.x, y: (this.positionOrigin.map.y - f.y) * this.pixelPerTile.y - e - g.y + this.positionOrigin.browser.y}
    }, translateToMap: function (g, h) {
        h = Object.merge({round: true, correct: true}, h || {});
        var k = {x: this.mapContainer.containerSize.x + this.mapContainer.elementSize.x, y: this.mapContainer.containerSize.y + this.mapContainer.elementSize.y};
        var f = this.mapContainer.blockSize.height / this.elementsPerBlock.y;
        if (typeof g.height != "undefined") {
            f = g.height
        }
        var e = null;
        if (h.round) {
            e = {x: Math.floor((g.x + k.x - this.positionOrigin.browser.x) / this.pixelPerTile.x) + this.positionOrigin.map.x, y: this.positionOrigin.map.y - Math.floor((g.y + f + (k.y - this.positionOrigin.browser.y)) / this.pixelPerTile.y)}
        } else {
            e = {x: ((g.x + k.x - this.positionOrigin.browser.x) / this.pixelPerTile.x) + this.positionOrigin.map.x - 1, y: this.positionOrigin.map.y - ((g.y + f + (k.y - this.positionOrigin.browser.y)) / this.pixelPerTile.y)}
        }
        if (g.width) {
            e.right = e.x + g.width / this.pixelPerTile.x - 1
        }
        if (g.height) {
            e.bottom = e.y + g.height / this.pixelPerTile.y - 1
        }
        if (h.correct) {
            e = d(e, this)
        }
    //   console.log(e);
        return e
    }, zoom: function (f) {
        var e = this;
        if (f == 0 || (f < 0 && this.zoomLevel + f < 1) || (f > 0 && this.zoomLevel + f > //this.zoomOptions.sizes.length)) {
            2)){
            return false
        }
        this.zoomLevel += f;
        b(this);
        this.onZoom(this);
        a.each(function (g) {
            g(e)
        });
        return true
    }})
})();
Travian.Game.Map.Transition.Precision = 2;
Travian.Game.Map.Updater = (function () {
    var c = window.location.href.split("index.html").slice(0, -1).join("index.html") + "/";
    var b = function (g) {
        if (g.objects.ajax.getLength() <= 0) {
            return false
        }
        g.updateWorking(1);
        var f = [];
        g.objects.ajax.each(function (k) {
            var h = k.getRequestData();
            if (h !== false) {
                f.push(h)
            }
        });
        g.requestObject.multiple = Travian.ajax({url: g.url, data: Object.merge({}, g.parameters.multiple, {data: f, zoomLevel: g.transition.zoomLevel}), onSuccess: function (h) {
            g.updateWorking(-1);
            g.setContentDataAndRefresh(h);
            d(g)
        }, onFailure: function (h) {
            g.updateWorking(-1);
            g.setContentDataAndRefresh(h);
            d(g)
        }});
        return true
    };
    var a = function (h, g) {
        h.updateWorking(1);
//document.write('x0:' +g.position.x + '+'+ h.options.positionOptions.areaAroundPosition[h.transition.zoomLevel].left+' , y0: '+g.position.y +'+'+ h.options.positionOptions.areaAroundPosition[h.transition.zoomLevel].top);
        var f = {x0: g.position.x + h.options.positionOptions.areaAroundPosition[h.transition.zoomLevel].left, y0: g.position.y + h.options.positionOptions.areaAroundPosition[h.transition.zoomLevel].top, x1: g.position.x + h.options.positionOptions.areaAroundPosition[h.transition.zoomLevel].right, y1: g.position.y + h.options.positionOptions.areaAroundPosition[h.transition.zoomLevel].bottom};

        if (h.requestObject.position) {
            h.requestObject.position.cancel();
            h.requestObject.position = null;
            h.updateWorking(-1)
        }
        h.requestObject.position = Travian.ajax({url: h.url, data: Object.merge({}, h.parameters.position, {data: Object.merge({}, g.position, {zoomLevel: h.transition.zoomLevel, ignorePositions: h.dataStore.getPositionsOfData(g.dataStoreType).inject([], function (l, k) {
            if (Travian.Game.Map.isMapPositionInRect(f, k)) {
                l.push(Travian.Game.Map.xy2id(k.x, k.y))
            }
            return l
        })})}), onSuccess: function (k) {
            h.updateWorking(-1);
            (g.onSuccess || Travian.emptyFunction)(k)
        }, onFailure: function (k) {
            h.updateWorking(-1);
            (g.onFailure || Travian.emptyFunction)(k)
        }})
    };
    var e = function (g, f) {
        f.element.src = f.srcUrl;
        if (f.finishedLoading) {
            f.finishedLoading()
        }
        delete (g.loadings[f.blockContainer.updaterId][f.updaterId]);
        if (g.loadings[f.blockContainer.updaterId].getLength() == 0) {
            f.blockContainer.layers.loading.hide()
        }
        g.requestCountImages--;
        g.updateWorking(-1);
        d(g)
    };
    var d = function (f) {
        if (f.requestCountImages >= f.maxRequestCount) {
            return
        }
        if (f.objects.images.getLength() == 0) {
            return
        }
        f.objects.images.sort(function (l, k) {
            var h = l.getPriority();
            var g = k.getPriority();
            if (h < g) {
                return -1
            } else {
                if (h > g) {
                    return 1
                }
            }
            return 0
        }).some(function (k, h) {
            var g = e.pass([f, k]);
            delete (f.objects.images[k.updaterId]);
            f.requestCountImages++;
            f.updateWorking(1);
            if (k.element.src.replace(c, "") == k.srcUrl) {
                g.delay(1)
            } else {
                if (!k.imageLoader) {
                    k.imageLoader = $(new Image()).addEvent("load", g)
                }
                k.refreshSrcUrl();
                k.imageLoader.src = k.srcUrl
            }
            return f.requestCountImages >= f.maxRequestCount
        })
    };
    return new Class({Extends: Travian.Game.Map.Base, lastRequestPosition: {x: null, y: null}, loadings: {}, requestCount: 0, requestCountImages: 0, requestDelayId: {multiple: null, position: null}, requestImages: $H({}), requestObject: {multiple: null, position: null}, objects: null, classType: "Travian.Game.Map.Updater", initialize: function (f, g) {
        this.parent(f, g);
        this.objects = {ajax: $H({}), images: $H({})};
        this.elementWorking = $(this.elementWorking)
    }, register: function (g, f) {
        var h = this;
        if (!this.objects[g]) {
            return this
        }
        if (!f.updaterId) {
            f.updaterId = Travian.Game.Map.getNewId()
        }
        if (!this.objects[g][f.updaterId]) {
            this.objects[g][f.updaterId] = f
        }
        if (g == "images") {
            if (!f.blockContainer.updaterId) {
                f.blockContainer.updaterId = Travian.Game.Map.getNewId()
            }
            if (!this.loadings[f.blockContainer.updaterId]) {
                this.loadings[f.blockContainer.updaterId] = $H({})
            }
            this.loadings[f.blockContainer.updaterId][f.updaterId] = true;
            f.blockContainer.layers.loading.show()
        }
        this.request();
        return this
    }, request: function () {
        var f = this;
        if (this.requestObject.multiple && this.requestObject.multiple.cancel) {
            this.requestObject.multiple.cancel();
            this.requestObject.multiple = null;
            this.updateWorking(-1)
        }
        if (this.requestDelayId.multiple) {
            clearTimeout(this.requestDelayId.multiple);
            this.requestDelayId.multiple = null
        }
        this.requestDelayId.multiple = (function () {
            if (b(f) === false) {
                d(f)
            }
        }).delay(this.requestDelayTime.multiple);
        return this
    }, requestPosition: function (f) {
        var g = this;
        if (this.lastRequestPosition.x == f.position.x && this.lastRequestPosition.y == f.position.y) {
            return this
        }
        this.lastRequestPosition.x = f.position.x;
        this.lastRequestPosition.y = f.position.y;
        if (this.requestObject.position && this.requestObject.position.cancel) {
            this.requestObject.position.cancel();
            this.requestObject.position = null;
            this.updateWorking(-1)
        }
        if (this.requestDelayId.position) {
            clearTimeout(this.requestDelayId.position);
            this.requestDelayId.position = null
        }
        this.requestDelayId.position = (function () {
            a(g, f)
        }).delay(this.requestDelayTime.position);
        return this
    }, setContentDataAndRefresh: function (f) {
        var g = this;
        if (f.blocks) {
            Object.each(f.blocks, function (k, h) {
                Object.each(k, function (l, m) {
                    Object.each(l, function (o, n) {
                        Object.each(o, function (t, r) {
                            var q = {x: h, y: m, right: n, bottom: r};

                            var s = Object.merge({}, g.dataStore.get(Travian.Game.Map.DataStore.TYPE_BLOCKS, q, "block") || {}, t);
                            g.dataStore.push({type: Travian.Game.Map.DataStore.TYPE_BLOCKS, position: q, index: "block", data: s})
                        })
                    })
                })
            });
            this.mapContainer.invalidateBlockVersionCache()
        }
        if (f.elements) {
            this.dataStore.setMultiple(Travian.Game.Map.DataStore.TYPE_TILE, f.elements)
        }
        this.objects.ajax.each(function (h) {
            if (h.refreshContent) {
                h.refreshContent()
            }
            delete (g.objects.ajax[h.updaterId])
        });
        return this
    }, updateWorking: function (f) {
        this.requestCount += f;
        if (this.requestCount < 0) {
            this.requestCount = 0
        }
        if (this.elementWorking) {
            if (this.requestCount > 0) {
                this.elementWorking.setStyles({visibility: "visible"})
            } else {
                this.elementWorking.setStyles({visibility: "hidden"})
            }
            this.elementWorking.set("html", this.requestCount)
        }
        return this
    }})
})();

Travian.Game.Map.DataStore = (function () {
    var f = 0;
    var e = function (g) {
        Object.each(g.options.useStorageForType, function (k, h) {
            if (k) {
                Travian.Storage.set("mapDataContainer." + h, g.data[h], g.options.persistentStorage)
            }
        })
    };
    var c = function (k, n, g) {
        var l = g.x;
        var o = g.y;
        var h = typeof g.right != "undefined" ? g.right : l;
        var m = typeof g.bottom != "undefined" ? g.bottom : o;
        if (!k.data[n]) {
            k.data[n] = {all: $H()}
        }
        if (!k.data[n][l]) {
            k.data[n][l] = {}
        }
        if (!k.data[n][l][o]) {
            k.data[n][l][o] = {}
        }
        if (!k.data[n][l][o][h]) {
            k.data[n][l][o][h] = {}
        }
        if (!k.data[n][l][o][h][m]) {
            k.data[n][l][o][h][m] = {}
        }
        if (!k.data[n][l][o][h][m].id) {
            f++;
            k.data[n][l][o][h][m].id = f
        }
        k.data[n][l][o][h][m].position = g;
        return k.data[n][l][o][h][m]
    };
    var b = function (k, n, g) {
        var l = g.x;
        var o = g.y;
        var h = typeof g.right != "undefined" ? g.right : l;
        var m = typeof g.bottom != "undefined" ? g.bottom : o;
        if (!k.data[n]) {
            return null
        }
        if (!k.data[n][l]) {
            return null
        }
        if (!k.data[n][l][o]) {
            return null
        }
        if (!k.data[n][l][o][h]) {
            return null
        }
        if (!k.data[n][l][o][h][m]) {
            return null
        }
        if (d(k, k.data[n][l][o][h][m], n)) {
            return null
        }
        return k.data[n][l][o][h][m]
    };
    var d = function (g, k, h) {
        return k.time !== false && (new Date()).getTime() - k.time > g.cachingTimeForType[h]
    };
    var a = new Class({Extends: Travian.Game.Map.Base, classType: "Travian.Game.Map.DataStore", data: null, get: function (k, g, h) {
        var l = b(this, k, g);
        if (l == null) {
            return null
        }
        if (typeof h != "undefined") {
            if (l.data[h]) {
                return l.data[h]
            }
            return null
        }
        return l.data
    }, getDataForArea: function (l, h, o) {
        var m = this;
        var g = [];
        var n = null;
        var k = Object.clone(h);
        if (!this.data[l] || !this.data[l].all) {
            return g
        }
        if (k.x > k.right) {
            k.right += this.parentContainer.transition.border.width
        }
        if (k.y > k.bottom) {
            k.bottom += this.parentContainer.transition.border.height
        }
        this.data[l].all.each(function (q) {
            var r = {x: q.position.x, y: q.position.y};
            if (k.x > r.x) {
                r.x += m.parentContainer.transition.border.width
            }
            if (k.y > r.y) {
                r.y += m.parentContainer.transition.border.height
            }
            if (d(m, q, l) === false && k.x <= r.x && r.x <= k.right && k.y <= r.y && r.y <= k.bottom) {
                if (o) {
                    Object.each(q.data, function (s) {
                        g.push(s)
                    })
                } else {
                    g.push(q.data)
                }
            }
        });
        return g
    }, getPositionsOfData: function (g) {
        var h = this;
        if (!this.data[g] || !this.data[g].all) {
            return[]
        }
        return this.data[g].all.inject([], function (l, k) {
            if (d(h, k, g) === false) {
                l.push(k.position)
            }
            return l
        })
    }, initialize: function (g, k) {
        var h = this;
        this.parent(g, k);
        this.data = {};
        Object.each(this.options.clearStorageForType, function (m, l) {
            if (m) {
                Travian.Storage.clear("mapDataContainer." + l, h.options.persistentStorage)
            }
        });
        this.options.useStorageForType = $H(this.options.useStorageForType).inject($H(), function (n, o, l) {
            if (o) {
                n[l] = true;
                h.data[l] = Travian.Storage.get("mapDataContainer." + l, h.options.persistentStorage) || {};
                if (!h.data[l].all) {
                    h.data[l].all = $H({})
                } else {
                    h.data[l].all = $H(h.data[l].all);
                    var m = h.data[l].all.getKeys().max();
                    if (m > f) {
                        f = m
                    }
                }
            }
            return n
        })
    }, push: function (g) {
        if (typeof g.time == "undefined") {
            g.time = (new Date()).getTime()
        }
        if (g.time == -1) {
            g.time = false
        }
        g = Travian.Game.Map.remapShortParameters(g);
        var h = c(this, g.type, g.position);
        if (!h.data) {
            h.data = {}
        }
        h.data[g.index] = g.data;
        h.time = g.time;
        this.data[g.type].all[h.id] = h;
        return this
    }, refresh: function (g) {
        var h = b(this, g.type, g.position);
        if (h != null) {
            if (typeof g.time == "undefined") {
                g.time = (new Date()).getTime()
            }
            if (g.time == -1) {
                g.time = false
            }
            h.time = g.time
        }
        return this
    }, remove: function (k, g, h) {
        var l = b(this, k, g);
        if (l == null) {
            return this
        }
        if (typeof h != "undefined") {
            if (l.data[h]) {
                delete (l.data[h])
            }
            return this
        }
        l.time = 0;
        return this
    }, saveDataToStorage: function () {
        e(this);
        return this
    }, set: function (g) {
        var h = this;
        if (typeof g.time == "undefined") {
            g.time = (new Date()).getTime()
        }
        if (g.time == -1) {
            g.time = false
        }
        g = Travian.Game.Map.remapShortParameters(g);
        var k = c(this, g.type, g.position);
        k.data = g.data;
        k.time = g.time;
        this.data[g.type].all[k.id] = k;
        if (g.data.symbols) {
            g.data.symbols.each(function (m, l) {
                if (!m.dataId) {
                    m.dataId = m.type + "-" + l
                }
                m = Travian.Game.Map.remapShortParameters(m);
                if (!m.position) {
                    m.position = g.position
                }
                h.push({type: Travian.Game.Map.DataStore.TYPE_SYMBOL, position: g.position, data: m, index: m.dataId, time: false})
            })
        }
        return this
    }, setMultiple: function (h, g, l) {
        var k = this;
        g.each(function (m) {
            m = Travian.Game.Map.remapShortParameters(m);
            k.set({type: h, position: m.position, data: m, time: l})
        });
        e(this);
        return this
    }});
    a.TYPE_BLOCKS = "blocks";
    a.TYPE_SYMBOL = "symbol";
    a.TYPE_TILE = "tile";
    a.TYPE_TOOLTIP = "tooltip";
    return a
})();
Travian.Game.Map.Tips = {lastText: "", lastTitle: "", tooltipHtml: '<span class="xCoord">({x}</span><span class="pi">|</span><span class="yCoord">{y})</span><span class="clear"></span>', render: function (c, a) {
    var b = this;
    a.setTitle({title: "", text: ""}).addEvents({mousemove: function (g) {
        var f = {x: g.page.x - c.containerSize.x - c.elementSize.x, y: g.page.y - c.containerSize.y - c.elementSize.y};
        var d = c.getContentForTooltip(f, g);
        if (d === false) {
            d = {title: "", text: b.tooltipHtml.substitute(c.transition.translateToMap(f))}
        }
        if (b.lastText != d.text || b.lastTitle != d.title) {
            d.unescaped = true;
            Travian.Tip.show(d);
            b.lastText = d.text;
            b.lastTitle = d.title
        }
    }});
    return this
}};
Travian.Game.Map.Rulers = (function () {
    var b = function (g, f) {
        f += g.delta.x[g.transition.zoomLevel];
        if (f < g.transition.border.left) {
            f = g.transition.border.right - (g.transition.border.left - f) + 1
        } else {
            if (f > g.transition.border.right) {
                f = g.transition.border.left + (f - g.transition.border.right) - 1
            }
        }
        return f
    };
    var a = function (g, f) {
        f += g.delta.y[g.transition.zoomLevel];
        if (f < g.transition.border.top) {
            f = g.transition.border.bottom - (g.transition.border.top - f) + 1
        } else {
            if (f > g.transition.border.bottom) {
                f = g.transition.border.top + (f - g.transition.border.bottom) - 1
            }
        }
        return f
    };
    var e = function (f) {
        f.elements.moverX.setStyles({backgroundImage: "url(" + f.imgSource.x.substitute({zoomLevel: f.transition.zoomLevel}) + ")"});
        f.elements.moverY.setStyles({backgroundImage: "url(" + f.imgSource.y.substitute({zoomLevel: f.transition.zoomLevel}) + ")"})
    };
    var d = function (n) {
        if (n.elements.coordinates) {
            n.elements.coordinates.x.invoke("dispose");
            n.elements.coordinates.y.invoke("dispose")
        }
        n.elements.coordinates = {x: [], y: []};
        var o = n.transition.elementsInView.x + n.transition.elementsPerBlock.x * 2;
        var m = n.steps.x[n.transition.zoomLevel];
        for (var f = 0, g = null, k = null; f < o; f += m) {
            g = (new Element("div", {"class": "coordinate zoom" + n.transition.zoomLevel, styles: {position: "absolute", left: f * n.mapContainer.blockSize.width / n.transition.elementsPerBlock.x, top: 0, width: m * n.mapContainer.blockSize.width / n.transition.elementsPerBlock.x, height: n.containerSize.height}})).inject(n.elements.moverX, "bottom");
            g.rulerLeft = f * n.mapContainer.blockSize.width / n.transition.elementsPerBlock.x;
            k = g.getDimensions({computeSize: true});
            g.setStyles({width: k.width - k["padding-left"] - k["padding-right"], height: k.height - k["padding-top"] - k["padding-bottom"]});
            n.elements.coordinates.x[f] = g
        }
        var l = n.transition.elementsInView.y + n.transition.elementsPerBlock.y * 2;
        var h = n.steps.y[n.transition.zoomLevel];
        for (var f = 0, g = null, k = null; f < l; f += h) {
            g = (new Element("div", {"class": "coordinate zoom" + n.transition.zoomLevel, styles: {position: "absolute", left: 0, top: f * n.mapContainer.blockSize.height / n.transition.elementsPerBlock.y, width: n.containerSize.width, height: h * n.mapContainer.blockSize.height / n.transition.elementsPerBlock.y}})).inject(n.elements.moverY, "bottom");
            g.rulerTop = f * n.mapContainer.blockSize.height / n.transition.elementsPerBlock.y;
            k = g.getDimensions({computeSize: true});
            if (k.height - k["padding-top"] - k["padding-bottom"] > 0) {
                g.setStyles({width: k.width - k["padding-left"] - k["padding-right"], height: k.height - k["padding-top"] - k["padding-bottom"]})
            } else {
                g.setStyles({height: 0})
            }
            n.elements.coordinates.y[f] = g
        }
        c(n, true, true)
    };
    var c = function (k, g, f) {
        var h = false;
        do {
            h = false;
            if (k.position.x < -2 * k.mapContainer.blockSize.width) {
                k.position.x += k.mapContainer.blockSize.width * 1;
                g = true;
                h = true
            }
            if (k.position.x > 0) {
                k.position.x += k.mapContainer.blockSize.width * -1;
                g = true;
                h = true
            }
            if (k.position.y < -2 * k.mapContainer.blockSize.height) {
                k.position.y += k.mapContainer.blockSize.height * 1;
                f = true;
                h = true
            }
            if (k.position.y > 0) {
                k.position.y += k.mapContainer.blockSize.height * -1;
                f = true;
                h = true
            }
        } while (h);
        k.elements.moverX.setStyles({left: k.position.x});
        k.elements.moverY.setStyles({top: k.position.y});
        if (g && k.elements.coordinates) {
            k.elements.coordinates.x.each(function (n, l) {
                if (n) {
                    var m = k.transition.translateToMap({x: k.position.x + n.rulerLeft - k.mapContainer.elementSize.x, y: 0});
                    n.set("html", b(k, m.x))
                }
            })
        }
        if (f && k.elements.coordinates) {
            k.elements.coordinates.y.each(function (m) {
                if (m) {
                    var l = k.transition.translateToMap({x: 0, y: k.position.y + m.rulerTop - k.mapContainer.elementSize.y});
                    m.set("html", a(k, l.y))
                }
            })
        }
    };
    return new Class({Extends: Travian.Game.Map.Base, classType: "Travian.Game.Map.Rulers", destroy: function () {
        this.elements.containerX.dispose();
        this.elements.containerY.dispose();
        return this
    }, initialize: function (f, g) {
        if (!f.direction) {
            f.direction = $(document.body).getStyle("direction")
        }
        this.parent(f, g);
        this.position = {x: 0, y: 0}
    }, render: function () {
        var f = this;
        this.position = {x: this.mapContainer.blockSize.width, y: this.mapContainer.blockSize.height};
        Object.each(this.mapContainer.blocks, function (g) {
            if (f.position.x > g.position.x) {
                f.position.x = g.position.x
            }
            if (f.position.y > g.position.y) {
                f.position.y = g.position.y
            }
        });
        this.elements = {containerX: (new Element("div")).addClass(this.cls.x).inject(this.mapContainer.containerRender, "bottom").setStyles({position: "absolute", left: 0, right: 0, width: this.mapContainer.containerViewSize.width, overflow: "hidden"}), containerY: (new Element("div")).addClass(this.cls.y).inject(this.mapContainer.containerRender, "bottom").setStyles({position: "absolute", top: 0, bottom: 0, height: this.mapContainer.containerViewSize.height, overflow: "hidden"})};
        this.containerSize = {width: this.elements.containerY.getDimensions({computeSize: true}).width, height: this.elements.containerX.getDimensions({computeSize: true}).height};
        this.elements.containerX.setStyles({height: this.containerSize.height});
        if (this.direction.toLowerCase() == "ltr") {
            this.elements.containerY.setStyles({left: -this.containerSize.width})
        } else {
            if (this.direction.toLowerCase() == "rtl") {
                this.elements.containerY.setStyles({right: -this.containerSize.width})
            }
        }
        if (top === self){
            this.elements.moverX = new Element("div", {styles: {position: "absolute", left: 0, top: 0, width: this.mapContainer.containerSize.width + 2 * this.mapContainer.blockSize.width, height: "100%", backgroundPosition: "left top", backgroundColor: "transparent", backgroundRepeat: "repeat-x"}}).inject(this.elements.containerX, "bottom");
            this.elements.moverY = new Element("div", {styles: {position: "absolute", left: 0, top: 0, width: "100%", height: this.mapContainer.containerSize.height + 2 * this.mapContainer.blockSize.height, backgroundPosition: "left top", backgroundColor: "transparent", backgroundRepeat: "repeat-y"}}).inject(this.elements.containerY, "bottom");

        }else{
            var w = window.innerWidth;
            var h = window.innerHeight;

            var width = w+"px";
            var  height = h+"px";
            this.elements.moverX = new Element("div", {styles: {position: "absolute", left: 0, top: 0, width: this.mapContainer.containerSize.width + 2 * this.mapContainer.blockSize.width, height: height, backgroundPosition: "left top", backgroundColor: "transparent", backgroundRepeat: "repeat-x"}}).inject(this.elements.containerX, "bottom");
            this.elements.moverY = new Element("div", {styles: {position: "absolute", left: 0, top: 0, width: width, height: this.mapContainer.containerSize.height + 2 * this.mapContainer.blockSize.height, backgroundPosition: "left top", backgroundColor: "transparent", backgroundRepeat: "repeat-y"}}).inject(this.elements.containerY, "bottom");

        }
        e(this);
        d(this);
        c(this);
        return this
    }, move: function (f) {
        this.position.x += f.x;
        this.position.y -= f.y;
        c(this);
        return this
    }, zoom: function () {
        e(this);
        d(this);
        c(this);
        return this
    }})
})();
Travian.Game.Map.MiniMap = (function () {
    var c = Travian.emptyFunction;
    if (Browser.opera) {
        c = function (e) {
            var d = e.elements.background.getStyle("bottom");
            e.elements.background.setStyles({bottom: 0});
            (function () {
                e.elements.background.setStyles({bottom: d})
            }).delay(0.1)
        }
    }
    var b = function (l) {
        var f = l.transition.translateToMap({x: -l.mapContainer.elementSize.x, y: -l.mapContainer.elementSize.y}, false);
        var k = l.transition.translateToMap({x: 0, y: 0, width: l.mapContainer.containerViewSize.width, height: l.mapContainer.containerViewSize.height}, {round: false, correct: false});
        k.width = k.right - k.x;
        k.height = k.bottom - k.y;
        var h = {x: l.containerSize.width / l.transition.border.width, y: l.containerSize.height / l.transition.border.height};
        l.position.width = k.width * h.x;
        l.position.height = k.height * h.y;
        l.position.x = f.x * h.x;
        l.position.x += l.containerSize.width / 2;
        l.position.y = f.y * h.y * -1;
        l.position.y += l.containerSize.height / 2;
        var g = {x: l.position.x - l.elementSize["border-left-width"], y: l.position.y - l.elementSize["border-top-width"] - l.elementSize["border-bottom-width"], width: l.position.width + l.elementSize["border-left-width"] + l.elementSize["border-right-width"], height: l.position.height + l.elementSize["border-top-width"] + l.elementSize["border-bottom-width"]};
        if (g.width >= l.containerSize.width) {
            g.x = -1
        }
        if (g.height >= l.containerSize.height) {
            g.y = -1
        }
        l.element.setStyles({left: g.x, top: g.y, width: g.width, height: g.height});
        var e = Object.clone(g);
        var d = false;
        if (g.width >= l.containerSize.width) {
            d = true
        } else {
            if (g.x < 0) {
                g.x += l.containerSize.width;
                d = true
            } else {
                if (g.x + g.width > l.containerSize.width) {
                    g.x -= l.containerSize.width;
                    d = true
                }
            }
        }
        if (g.height >= l.containerSize.height) {
            d = true
        } else {
            if (g.y < 0) {
                g.y += l.containerSize.height;
                d = true
            } else {
                if (g.y + g.height > l.containerSize.height) {
                    g.y -= l.containerSize.height;
                    d = true
                }
            }
        }
        l.elementHelpers[0].setStyles({left: g.x, top: g.y, width: g.width, height: g.height, display: d ? "block" : "none"});
        l.elementHelpers[1].setStyles({left: e.x, top: g.y, width: g.width, height: g.height, display: (g.x < 0 && g.y < 0 && g.x + g.width > 0 && g.y + g.height > 0) ? "block" : "none"});
        l.elementHelpers[2].setStyles({left: g.x, top: e.y, width: g.width, height: g.height, display: (g.x < 0 && g.y < 0 && g.x + g.width > 0 && g.y + g.height > 0) ? "block" : "none"})
    };
    var a = function (g, f) {
        var d = {x: f.containerSize.width / f.transition.border.width, y: f.containerSize.height / f.transition.border.height};
        return{x: Math.floor((g.page.x - f.containerPosition.x) / d.x - Math.abs(f.transition.border.left)), y: -Math.floor((g.page.y - f.containerPosition.y) / d.y - Math.abs(f.transition.border.top))}
    };
    return new Class({Extends: Travian.Game.Map.Base, classType: "Travian.Game.Map.MiniMap", expanded: false, animate: function () {
        var d = this;
        if (this.elements.headlineExpander._fx && this.elements.headlineExpander._fx.cancel) {
            this.elements.headlineExpander._fx.cancel()
        }
        if (this.elements.headlineExpander.hasClass("expand")) {
            this.expanded = true;
            this.cookie.set("minimap-expanded", true);
            this.elements.headlineExpander.removeClass("expand").addClass("collapse");
            this.elements.headlineExpander._fx = (new Fx.Morph(this.elements.container, {onComplete: function () {
                c(d)
            }})).start({height: [this.elements.container.getSize().y, this.elements.container._height.max]});
            // this.parentContainer.outline.update(this.elements.container.getSize().y - this.elements.container._height.max)
        } else {
            this.expanded = false;
            this.cookie.set("minimap-expanded", false);
            this.elements.headlineExpander.removeClass("collapse").addClass("expand");
            this.elements.headlineExpander._fx = (new Fx.Morph(this.elements.container, {onComplete: function () {
                c(d)
            }})).start({height: [this.elements.container.getSize().y, this.elements.container._height.min]});
            this.parentContainer.outline.update(this.elements.container.getSize().y - this.elements.container._height.min)
        }
        return this
    }, getContentForTooltip: function (d, g) {
        var f = a(g, this);
        return{text: this.tooltipHtml.substitute(f)}
    }, initialize: function (d, e) {
        this.parent(d, e);
        this.position = {x: 0, y: 0, width: 0, height: 0}
    }, render: function () {
        var f = this;
        this.container = $(this.container).setStyles({overflow: "hidden"}).disableSelection().addEvent("click", function (h) {
            f.mapContainer.moveTo(a(h, f))
        });
        this.parent({nodeType: "div"}).element.addClass("view").setStyles({position: "absolute", zIndex: 3}).inject(this.container, "bottom");
        (new Element("div", {"class": "inner", styles: {height: "100%", opacity: 0.25, width: "100%"}})).inject(this.element, "bottom");
        this.elementHelpers = [];
        for (var e = 0; e < 3; e++) {
            var d = (new Element("div", {"class": "view", styles: {position: "absolute", zIndex: 3, display: "none"}})).inject(this.container, "bottom");
            (new Element("div", {"class": "inner", styles: {height: "100%", opacity: 0.25, width: "100%"}})).inject(d, "bottom");
            this.elementHelpers.push(d)
        }
        this.containerSize = this.container.getDimensions({computeSize: !(Browser.chrome || Browser.safari)});
        this.containerPosition = this.container.getPosition();
        this.elementSize = this.element.getDimensions({computeSize: true});
        if (this.showToolTip) {
            Travian.Game.Map.Tips.render(this, this.container.down("img"))
        }
        b(this);
        this.elements = {container: $(this.containerContent), headline: $(this.containerContent).down(".headline"), headlineExpander: $(this.containerContent).down(".headline").down(".iconButton"), background: $(this.containerContent).down(".background")};
        this.elements.headlineExpander.addClass(this.cookie.get("minimap-expanded") === true ? "collapse" : "expand");
        var g = function () {
            f.elements.container._height = {max: f.elements.container.getSize().y, min: f.elements.headline.getSize().y + parseInt(f.elements.headline.getStyle("margin-top")) + parseInt(f.elements.headline.getStyle("margin-bottom"))};
            if (f.elements.container._height.min < 0) {
                f.elements.container._height.min = 0
            }
            if (f.elements.container._height.max < 0) {
                f.elements.container._height.max = 0
            }
            if (f.cookie.get("minimap-expanded") !== true) {
                f.elements.container.setStyles({height: f.elements.container._height.min});
                c(f)
            }
            f.elements.headlineExpander.addEvent("click", function (h) {
                f.animate()
            })
        };
        if (Browser.chrome || Browser.safari) {
            g.delay(300)
        } else {
            g()
        }
    }, move: function () {
        b(this);
        return this
    }, zoom: function () {
        b(this);
        return this
    }})
})();
Travian.Game.Map.Toolbar = new Class({Extends: Travian.Game.Map.Base, classType: "Travian.Game.Map.Toolbar", initialize: function (a, b) {
    this.parent(a, b)
}, render: function () {
    var c = this;
    var a = null;
    this.element = $(this.element);
    this.zoomIn = this.element.down(".zoomIn").addEvent("click", function (d) {
        c.mapContainer.zoomIn()
    });
    this.zoomOut = this.element.down(".zoomOut").addEvent("click", function (d) {
        c.mapContainer.zoomOut()
    });
    var b = function () {
        c.zoomDropDownDataContainer._dropped = false;
        c.zoomDropDownDataContainer.setStyles({height: c.zoomDropDownDataContainer._styleBackup.height});
        c.zoomDropDownEntries.each(function (d) {
            if (d.hasClass("selected")) {
                d.addClass("display")
            }
            d.addClass("hide").removeClass("selected")
        });
        c.zoomDropDownEntries[c.transition.zoomLevel - 1].removeClass("hide").addClass("display")
    };
    this.zoomDropDownDataContainer = this.element.down(".dropdown .dataContainer");
    this.zoomDropDownEntries = this.zoomDropDownDataContainer.getElements(".entry");
    this.zoomDropDownDataContainer._styleBackup = {height: this.zoomDropDownDataContainer.getStyle("height"), maxHeight: this.zoomDropDownEntries.inject(0, function (e, d) {
        return e + parseInt(d.getStyle("height"))
    })};
    this.zoomDropDownClick = this.element.down(".dropdown .dropDownImage").addEvent("click", function (d) {
        if (!c.mapContainer.isEventsEnabled()) {
            return
        }
        d.stop();
        if (c.zoomDropDownDataContainer._dropped) {
            b();
            return
        }
        c.zoomDropDownDataContainer._dropped = true;
        c.zoomDropDownEntries.each(function (e) {
            if (e.hasClass("display")) {
                e.addClass("selected")
            }
            e.removeClass("display").removeClass("hide")
        });
        c.zoomDropDownDataContainer.setStyles({height: Browser.opera ? "auto" : c.zoomDropDownDataContainer._styleBackup.maxHeight})
    });
    this.zoomDropDownEntries.each(function (e, d) {
        e.addEvent("click", function (f) {
            f.stop();
            if (!c.zoomDropDownDataContainer._dropped) {
                return
            }
            c.zoomDropDownDataContainer._dropped = false;
            c.zoomDropDownDataContainer.setStyles({height: c.zoomDropDownDataContainer._styleBackup.height});
            c.zoomDropDownEntries.each(function (g) {
                g.addClass("hide").removeClass("selected")
            });
            e.removeClass("hide").addClass("display");
            c.mapContainer.zoom(d + 1 - c.mapContainer.transition.zoomLevel, c.mapContainer.transition.getPointOfCenterInView())
        })
    });
    $(document.body).addEvent("click", function () {
        if (c.zoomDropDownDataContainer._dropped) {
            b();
            return
        }
    });
    /* a = this.element.down(".viewFull");
     if (a) {
     this.viewFull = a.addEvent("click", function (d) {
     window.location.href = c.viewFullScreenUrl.substitute(Object.merge({}, c.mapContainer.transition.getPointOfCenterInView(), {zoom: c.mapContainer.transition.zoomLevel}))
     })
     }*/
    /*a = this.element.down(".viewNormal");
     if (a) {
     this.viewNormal = this.element.down(".viewNormal").addEvent("click", function (d) {
     window.location.href = c.viewNormalUrl.substitute(Object.merge({}, c.mapContainer.transition.getPointOfCenterInView(), {zoom: c.mapContainer.transition.zoomLevel}))
     })
     }
     */

    /*  a = this.element.down(".linkCropfinder");
     if (a && !(a.getParent().hasClass("iconRequireGold"))) {
     a.addEvent("click", function (d) {
     window.location.href = "cropfinder.php"
     })
     }*/
    this.coordinateEnter = $("mapCoordEnter").addEvent("submit", function (d) {
        var f = {x: parseInt(c.coordinateEnter.down("input.coordinates.x").value), y: parseInt(c.coordinateEnter.down("input.coordinates.y").value)};
        if (!f.x.isNaN() && !f.y.isNaN()) {
            c.mapContainer.moveTo(f)
        }
        d.stop();
        return false
    });
    this.update()
}, update: function () {
    var a = this;
    if (this.transition.zoomLevel == 1) {
        this.zoomIn.addClass("disabled");
        this.zoomOut.removeClass("disabled")
    } else {
        if (this.transition.zoomLevel == //this.transition.zoomOptions.sizes.length) {
            2){
            this.zoomIn.removeClass("disabled");
            this.zoomOut.addClass("disabled")
        } else {
            this.zoomIn.removeClass("disabled");
            this.zoomOut.removeClass("disabled")
        }
    }
    this.zoomDropDownEntries.each(function (b) {
        if (a.zoomDropDownDataContainer._dropped) {
            b.removeClass("selected")
        } else {
            b.addClass("hide").removeClass("display")
        }
    });
    this.zoomDropDownEntries[this.transition.zoomLevel - 1].removeClass("hide").addClass(this.zoomDropDownDataContainer._dropped ? "selected" : "display")
}, zoom: function () {
    this.update()
}});

Travian.Game.Map.Layer = (function () {
    return new Class({Extends: Travian.Game.Map.Base, element: null, index: null, position: null, classType: "Travian.Game.Map.Layer", finishedLoading: function () {
        return this
    }, forceUpdateContent: function () {
        return this
    }, getContentForTooltip: function (a) {
        return false
    }, getRequestData: function () {
        return false
    }, hide: function () {
        this.element.hide();
        return this
    }, initialize: function (a, c) {
        this.parent(a, c);
        if (this.position == null && this.parentContainer != null) {
            var b = this.parentContainer.element.getSize();
            this.position = {x: 0, y: 0, width: b.x, height: b.y}
        }
        if (this.parentContainer.classType == "Travian.Game.Map.Layer.Block") {
            this.blockContainer = this.parentContainer
        } else {
            if (this.parentContainer.blockContainer) {
                this.blockContainer = this.parentContainer.blockContainer
            }
        }
        if (typeof a.version != "undefined") {
            this.setVersion(a.version)
        }
        this.render()
    }, refreshContent: function () {
        return this
    }, render: function (a) {
        this.parent(a);
        if (this.id != null) {
            this.element.addClass(this.id)
        }
        if (this.position) {
            this.element.setStyles({position: "absolute", left: this.position.x, top: this.position.y, width: this.position.width, height: this.position.height})
        }
        if (this.zIndex) {
            this.element.setStyles({zIndex: this.zIndex + 1})
        }
        if (this.parentContainer && this.parentContainer.element) {
            this.element.inject(this.parentContainer.element, "bottom")
        }
        return this
    }, setVersion: function (a) {
        return this
    }, show: function () {
        this.element.show();
        return this
    }, update: function () {
        this.element.setStyles({left: this.position.x + "px", top: this.position.y + "px"});
        return this
    }, updateContent: function () {
        return this
    }})
})();
Travian.Game.Map.Layer.Block = (function () {
    var b = function (m, l, k) {
        if (typeof l.x == "undefined") {
            l.x = k.x
        }
        if (typeof l.y == "undefined") {
            l.y = k.y
        }
        l = Travian.Game.Map.remapShortParameters(l);
        if (typeof l.text == "undefined" && typeof l.title == "undefined") {
            l.text = m.tooltipHtml.substitute(l.position)
        }
        return l
    };
    var c = function (s, q) {
        var m = Object.clone(q);
        var l = s.transition.getPointOfCenterInView();
        var n = Object.clone(s.mapCoordinates);
        m.x = parseFloat(m.x);
        m.y = parseFloat(m.y);
        l.x = parseFloat(l.x);
        l.y = parseFloat(l.y);
        n.x = parseFloat(n.x);
        n.y = parseFloat(n.y);
        var o = {x: (s.transition.border.right - Math.abs(m.x) < s.transition.border.right / 2), y: (s.transition.border.bottom - Math.abs(m.y) < s.transition.border.bottom / 2)};
        var r = {x: (s.transition.border.right - Math.abs(l.x) < s.transition.border.right / 2), y: (s.transition.border.bottom - Math.abs(l.y) < s.transition.border.bottom / 2)};
        var k = {x: (s.transition.border.right - Math.abs(n.x) < s.transition.border.right / 2), y: (s.transition.border.bottom - Math.abs(n.y) < s.transition.border.bottom / 2)};
        if ((o.x || r.x) && (m.x.sgn() + l.x.sgn() == 0 && m.x.sgn() != l.x.sgn())) {
            m.x += l.x.sgn() * s.transition.border.width
        }
        if ((o.y || r.y) && (m.y.sgn() + l.y.sgn() == 0 && m.y.sgn() != l.y.sgn())) {
            m.y += l.y.sgn() * s.transition.border.height
        }
        if ((k.x || r.x) && (n.x.sgn() + l.x.sgn() == 0 && n.x.sgn() != l.x.sgn())) {
            n.x += l.x.sgn() * s.transition.border.width
        }
        if ((k.y || r.y) && (n.y.sgn() + l.y.sgn() == 0 && n.y.sgn() != l.y.sgn())) {
            n.y += l.y.sgn() * s.transition.border.height
        }

        return{x: (m.x - n.x) * s.transition.pixelPerTile.x, y: (s.transition.elementsPerBlock.y - (m.y - n.y) - 1) * s.transition.pixelPerTile.y}
    };
    var g = function (s, q, m) {
        if (!q.type) {
            throw"Missing symbol type for symbol: " + q.dataId;
            return
        }
        var o = s.symbolTypes[q.type];
        if (!o || !o["class"] || !o.visibleInZoom[s.transition.zoomLevel]) {
            return
        }
        if (!s.symbols[q.position.x]) {
            s.symbols[q.position.x] = {}
        }
        if (!s.symbols[q.position.x][q.position.y]) {
            s.symbols[q.position.x][q.position.y] = $H({})
        }
        var n = o.sizes[s.transition.zoomLevel];
        var r = c(s, m);
        var l = s.symbols[q.position.x][q.position.y];
        var k = e(s, o, l);
        l[q.dataId] = new o["class"](Object.merge({}, o, q, {positionOfTile: {x: r.x, y: r.y}, positionInTile: k, position: {x: r.x + k.x, y: r.y + k.y, width: o.sizes[s.transition.zoomLevel].width, height: o.sizes[s.transition.zoomLevel].height}, positionDefault: {x: r.x + k.x, y: r.y + k.y, width: o.sizes[s.transition.zoomLevel].width, height: o.sizes[s.transition.zoomLevel].height}, symbolSize: {width: o.sizes[s.transition.zoomLevel].width, height: o.sizes[s.transition.zoomLevel].height}}), s)
    };
    var f = function (k) {
        h(k);
        k.symbols = {};
        k.dataStore.getDataForArea(Travian.Game.Map.DataStore.TYPE_SYMBOL, k.mapCoordinates, true).each(function (l) {
            g(k, l, l.position)
        })
    };
    var h = function (k) {
        if (k.symbols) {
            Object.each(k.symbols, function (l) {
                Object.each(l, function (m) {
                    m.each(function (n) {
                        n.destroy();
                        delete (m[n.dataId])
                    })
                })
            });
            delete (k.symbols)
        }
    };
    var e = function (q, o, l) {
        var k = {x: false, y: false};
        var m = o.sizes[q.transition.zoomLevel].width;
        var n = l.getKeys().reverse().find(function (s) {
            var r = l[s].position.x == l[s].positionDefault.x;
            r = r && l[s].position.y == l[s].positionDefault.y;
            r = r && l[s].position.width == l[s].positionDefault.width;
            r = r && l[s].position.height == l[s].positionDefault.height;
            return r
        });
        if (n) {
            k.x = l[n].positionInTile.x;
            k.x += m
        }
        if (k.x === false) {
            k.x = 0
        }
        if (k.x + m > (q.position.width / q.transition.elementsPerBlock.x)) {
            k.x = 0;
            k.y += o.sizes[q.transition.zoomLevel].height
        }

        return k
    };
    var a = function (m, k, l) {
        if (typeof l == "undefined") {
            l = {}
        }
        if (typeof l.tiles != "undefined" && l.tiles.length != 0) {
            Object.each(l.tiles, function (n) {
                n = b(m, n, k);
                if (n.position.x == k.x && n.position.y == k.y) {
                    l.tile = n
                }
                m.dataStore.set({position: n.position, type: Travian.Game.Map.DataStore.TYPE_TOOLTIP, data: n})
            })
        }
        if (typeof l.tile == "undefined") {
            l.tile = {};
            l.tile = b(m, l.tile, k);
            m.dataStore.set({position: l.tile.position, type: Travian.Game.Map.DataStore.TYPE_TOOLTIP, data: l.tile})
        }
        if (typeof l.tiles != "undefined" || typeof l.tile == "undefined") {
            m.dataStore.saveDataToStorage()
        }
        if (m.mapContainer.currentMousePosition.map.x == null || m.mapContainer.currentMousePosition.map.y == null) {
            return
        }
        if (k.x != m.mapContainer.currentMousePosition.map.x || k.y != m.mapContainer.currentMousePosition.map.y) {
            return
        }
        m.mapContainer.containerMover.setTitle({unescaped: true, title: l.tile.title, text: l.tile.text});

    };
    var d = function (m, k, l) {
        if (m.mapContainer.currentMousePosition.map.x == null || m.mapContainer.currentMousePosition.map.y == null) {
            return
        }
        if (k.x != m.mapContainer.currentMousePosition.map.x || k.y != m.mapContainer.currentMousePosition.map.y) {
            return
        }
        m.mapContainer.containerMover.setTitle({title: "", text: "{x}|{y}".substitute(k)})
    };
    return new Class({Extends: Travian.Game.Map.Layer, mapCoordinates: null, layers: null, versionCache: null, classType: "Travian.Game.Map.Layer.Block", addSymbol: function (k) {
        g(this, k, k.position);
        return this
    }, deleteSymbol: function (k) {
        if (!this.symbols || !this.symbols[k.position.x] || !this.symbols[k.position.x][k.position.y]) {
            return this
        }
        if (this.symbols[k.position.x][k.position.y][k.dataId]) {
            this.symbols[k.position.x][k.position.y][k.dataId].destroy();
            delete (this.symbols[k.position.x][k.position.y][k.dataId])
        }
        return this
    }, forceUpdateLayer: function (k) {
        if (this.layers[k]) {
            this.layers[k].forceUpdateContent()
        }
        return this
    }, forceUpdateSymbols: function (l, k) {
        if (this.symbols) {
            Object.each(this.symbols, function (m) {
                Object.each(m, function (n) {
                    n.each(function (o) {
                        if (o.layer == l) {
                            o.forceUpdate(k)
                        }
                    })
                })
            })
        }
        return this
    }, getContentForTooltip: function (k) {
        var o = this;
        var l = this.transition.translateToMap(k);
        if (this.symbols && this.symbols[l.x] && this.symbols[l.x][l.y] && this.symbols[l.x][l.y] != 0) {
            var q = false;
            var n = this.symbols[l.x][l.y].find(function (r) {
                q = r.getContentForTooltip();
                return q !== false && r.isPositionInRect({x: k.x - o.position.x, y: k.y - o.position.y})
            });
            if (n && q !== false) {
                return q
            }
        }
        var m = this.dataStore.get(Travian.Game.Map.DataStore.TYPE_TOOLTIP, l);
        if (m != null && (m.text != undefined || m.title != undefined)) {
            m = {text: m.text, title: m.title}
        } else {
            m = {title: "", text: this.tooltipHtml.translate(l)};
            this.requestDataForPosition(l)
        }
        return m
    }, getData: function () {


        return Object.merge({loaded: false, version: 0}, this.dataStore.get(Travian.Game.Map.DataStore.TYPE_BLOCKS, this.mapCoordinates, "block") || {})
    }, getRequestData: function () {

        return {position: {x0: this.mapCoordinates.x, y0: this.mapCoordinates.y, x1: this.mapCoordinates.right, y1: this.mapCoordinates.bottom}}
    }, getVersion: function () {
        if (this.versionCache == null) {
            this.versionCache = this.getData().version;

               /* var result=0;
                jQuery.ajax({
                    url:"map_block_ver.php?tx0="+this.getRequestData().position.x0+"&ty0="+this.getRequestData().position.y0+"&tx1="+this.getRequestData().position.x1+"&ty1="+this.getRequestData().position.y1,
                    async: false,
                    success:function(data){
                        result = data;
                    }
                });
            this.versionCache = result;
*/
        }
        return this.versionCache
    }, invalidateVersionCache: function () {
        this.versionCache = null;
        return this
    }, move: function (l) {
        if (l.x == 0 && l.y == 0) {
            return this
        }
        this.position.x += l.x;
        this.position.y -= l.y;
        var k = Travian.Game.Map.Layer.Block.getCorrectPosition(this.position, this.mapContainer);
        this.position = k.position;
        this.mapCoordinates = this.transition.translateToMap(this.position);
        this.update(k.updateInnerContent);
        return this
    }, refreshContent: function (k) {
        if (k) {
            var l = this.getData();
            l.loaded = true;
            this.setData(l)
        }
        this.parent();
        Object.each(this.layers, function (m) {
            m.refreshContent()
        });
        f(this);
        return this
    }, render: function () {
        var l = this;
        this.layers = {};
        this.parent({nodeType: "div"});
        this.mapCoordinates = this.transition.registerCallbackOnZoom(function () {
            l.mapCoordinates = l.transition.translateToMap(l.position);
            l.update(true)
        }).translateToMap(this.position);
        this.mapContainer.layers.each(function (n, m) {
            if (!n["class"]) {
                return
            }
            var o = {};
            Object.append(o, n);
            o.index = m;
            l.layers[o.id] = new n["class"](o, l)
        });
        var k = this.getData();
        k.loaded = true;
        this.setData(k);
        f(this);
        return this
    }, requestDataForPosition: function (k) {
        var l = this;
        this.updater.requestPosition({dataStoreType: Travian.Game.Map.DataStore.TYPE_TOOLTIP, position: k, onSuccess: function (n, m) {
            a(l, k, n)
        }, onFailure: function (n, m) {
            d(l, k, n)
        }});
        return this
    }, setData: function (k) {
        this.dataStore.push({type: Travian.Game.Map.DataStore.TYPE_BLOCKS, position: this.mapCoordinates, index: "block", data: Object.merge({loaded: false, version: 0}, k)});
        return this
    }, setVersion: function (k) {
        var l = this.getData();
        l.version = k;
        return this.setData(l)
    }, update: function (k) {
        this.parent();
        this.updateContent(k);
        return this
    }, updateContent: function (k) {
        this.parent();
        Object.each(this.layers, function (l) {
            l.updateContent(k)
        });
        if (k) {
            h(this);
            if (this.getData.loaded) {
                this.refreshContent(false)
            } else {
                this.updater.register("ajax", this)
            }
        }
        return this
    }, updateSymbolData: function (k) {
        if (!this.symbols || !this.symbols[k.position.x] || !this.symbols[k.position.x][k.position.y]) {
            return this
        }
        if (this.symbols[k.position.x][k.position.y][k.dataId]) {
            this.symbols[k.position.x][k.position.y][k.dataId].updateData(k)
        }
        return this
    }})
})();
Travian.Game.Map.Layer.Block.getCorrectPosition = function (b, c) {
    var a = {position: b, updateInnerContent: false, updateBlockPosition: false};
    do {
        if (a.position.x==92 || a.position.x==-92 || a.position.y==92 || a.position.y==-92){a.updateInnerContent = a.updateBlockPosition = false;}
        a.updateBlockPosition = false;
        if (a.position.x < 0 && Math.abs(a.position.x) >= c.blockSize.width) {
            a.position.x = c.elementSize.width + a.position.x;
            a.updateInnerContent = true;
            a.updateBlockPosition = true
        } else {
            if (a.position.x + a.position.width > c.elementSize.width) {
                a.position.x = a.position.x - c.elementSize.width;
                a.updateInnerContent = true;
                a.updateBlockPosition = true
            }
        }
        if (a.position.y < 0 && Math.abs(a.position.y) >= c.blockSize.height) {
            a.position.y = c.elementSize.height + a.position.y;
            a.updateInnerContent = true;
            a.updateBlockPosition = true
        } else {
            if (a.position.y + a.position.height > c.elementSize.height) {
                a.position.y = a.position.y - c.elementSize.height;
                a.updateInnerContent = true;
                a.updateBlockPosition = true
            }
        }

    } while (a.updateBlockPosition);
    return a
};
Travian.Game.Map.Layer.Image = new Class({Extends: Travian.Game.Map.Layer, image: null, srcUrl: null, classType: "Travian.Game.Map.Layer.Image", getPriority: function () {

    var c = {x: this.blockContainer.mapCoordinates.x + (this.blockContainer.mapCoordinates.right - this.blockContainer.mapCoordinates.x) / 2, y: this.blockContainer.mapCoordinates.y + (this.blockContainer.mapCoordinates.bottom - this.blockContainer.mapCoordinates.y) / 2};

    //  document.write(this.blockContainer.mapCoordinates.x+'  ')
    var a = this.transition.getPointOfCenterInView();
    var b = {x: a.x - c.x, y: a.y - c.y};
    // document.write(Math.pow(b.y, 2)+Math.pow(b.x, 2)+' ');
    return Math.pow(b.x, 2) + Math.pow(b.y, 2)
}, getSrcUrl: function(){
//var result=0;
   // var version="";
   // jQuery.ajax({
       // url:"map_block_ver.php?tx0="+this.parentContainer.mapCoordinates.x+"&ty0="+this.parentContainer.mapCoordinates.y+"&tx1="+this.parentContainer.mapCoordinates.right+"&ty1="+this.parentContainer.mapCoordinates.bottom+"&w="+this.position.width+"&h="+this.position.height,
       // async: false,
      //  success:function(data){
      //      result = data;
     //   }
  //  });
    return this.src.substitute({x: this.parentContainer.mapCoordinates.x, y: this.parentContainer.mapCoordinates.y, right: this.parentContainer.mapCoordinates.right, bottom: this.parentContainer.mapCoordinates.bottom, width: this.position.width, height: this.position.height, time: this.time, forcedUpdates: this.mapContainer.forcedUpdates, version: this.blockContainer.getVersion()})
   // return this.src.substitute({x: this.parentContainer.mapCoordinates.x, y: this.parentContainer.mapCoordinates.y, right: this.parentContainer.mapCoordinates.right, bottom: this.parentContainer.mapCoordinates.bottom, width: this.position.width, height: this.position.height, time: this.time, forcedUpdates: this.mapContainer.forcedUpdates, version: 0})

}, refreshSrcUrl: function () {
    this.srcUrl = this.getSrcUrl();
    return this
}, render: function () {
    var a = this;
    this.parent({nodeType: "img"});
    if (this.srcInit) {
        this.element.src = this.srcInit
    }
    this.time = (new Date()).getTime();
    this.updateContent();
    return this
}, updateContent: function (a) {
    var b = this.getSrcUrl();
    if (this.srcUrl != b || a) {
        this.refreshSrcUrl();
        this.updater.register("images", this)
    }
    return this
}});

Travian.Game.Map.Layer.Loading = new Class({Extends: Travian.Game.Map.Layer, classType: "Travian.Game.Map.Layer.Loading", render: function () {
    this.parent({nodeType: "div"}).element.setStyles(this.styles).hide();
    return this
}, updateContent: function (a) {
    return this
}});
Travian.Game.Map.Layer.ImageMark = new Class({Extends: Travian.Game.Map.Layer.Image, classType: "Travian.Game.Map.Layer.ImageMark", finishedLoading: function () {
    this.parent();
    this.show();
    return this
}, forceUpdateContent: function () {
    this.time = (new Date()).getTime();
    this.updateContent(true);
    return this
}, updateContent: function (a) {
    this.parent(a);
    if (a) {
        this.hide()
    }
    return this
}});
Travian.Game.Map.Layer.Symbol = new Class({Extends: Travian.Game.Map.Layer, byUser: false, classType: "Travian.Game.Map.Layer.Symbol", visible: true, destroy: function () {
    if (this.element) {
        this.element.destroy()
    }
    return this
}, forceUpdate: function (a) {
    if (this.byUser) {
        this.visible = a;
        this.element[a ? "show" : "hide"]()
    }
    return this
}, getContentForTooltip: function () {
    if (this.visible && (this.title || this.text)) {
        return{title: this.title, text: this.text}
    }
    return false
}, initialize: function (a, c) {
    var b = this;
    a.mapCoordinates = a.mapCoordinates || c.transition.translateToMap({x: a.position.x + c.position.x, y: a.position.y + c.position.y});
    a.id = a.id || Travian.Game.Map.getNewId();
    a.parameters = a.parameters || {};
    this.parent(a, c)
}, render: function () {
    this.parent({nodeType: "img"}).element.set("src", this.imgSource.substitute(Object.merge({}, this.parameters, {width: this.symbolSize.width, height: this.symbolSize.height, zoomLevel: this.transition.zoomLevel}))).setStyles({position: "absolute", left: this.position.x, top: this.position.y, width: this.position.width, height: this.position.height});
    return this
}, updateData: function (a) {
    this.title = a.title;
    this.text = a.text
}});

Travian.Game.Map.Layer.Symbol.Attack = new Class({Extends: Travian.Game.Map.Layer.Symbol, classType: "Travian.Game.Map.Layer.Symbol.Attack"});
Travian.Game.Map.Layer.Symbol.BattleGround = new Class({Extends: Travian.Game.Map.Layer.Symbol, classType: "Travian.Game.Map.Layer.Symbol.BattleGround", getContentForTooltip: function () {
    return false
}, render: function () {
    this.position = {x: this.positionOfTile.x, y: this.positionOfTile.y, width: this.transition.pixelPerTile.x, height: this.transition.pixelPerTile.y};
    this.parent()
}});
Travian.Game.Map.Layer.Symbol.Adventure = new Class({Extends: Travian.Game.Map.Layer.Symbol, classType: "Travian.Game.Map.Layer.Symbol.Adventure", render: function () {
    this.position = {x: this.positionOfTile.x + this.transition.pixelPerTile.x - this.position.width, y: this.positionOfTile.y + this.transition.pixelPerTile.y - this.position.height, width: this.position.width, height: this.position.height};
    this.parent()
}});





Travian.Game.Map.Options = {};
Travian.Game.Map.Options.Symbols = { attack: {"class": Travian.Game.Map.Layer.Symbol.Attack, imgSource: "img/map/attack/attack-{attackType}/{width}x{height}.gif", zIndex: 10, visibleInZoom: {1: true, 2: true}, sizes: {1: {width: 16, height: 16}, 2: {width: 10, height: 10}}}, battleGround: {"class": Travian.Game.Map.Layer.Symbol.BattleGround, imgSource: "img/map/battleground/battleground-{center}-{north}-{east}-{south}-{west}-{width}x{height}.png", zIndex: 9, visibleInZoom: {1: true, 2: true, 3: false, 4: false}, sizes: {1: {width: 16, height: 16}, 2: {width: 8, height: 8}, 3: {width: 4, height: 4}, 4: {width: 4, height: 4}}}, adventure: {"class": Travian.Game.Map.Layer.Symbol.Adventure, imgSource: "img/map/adventure/difficulty-{difficulty}/{width}x{height}.png", zIndex: 10, visibleInZoom: {1: true, 2: true, 3: false, 4: false}, sizes: {1: {width: 16, height: 16}, 2: {width: 8, height: 8}, 3: {width: 6, height: 6}, 4: {width: 4, height: 4}}}};
Travian.Game.Map.Options.Rulers = {direction: null, imgSource: {x: "img/map/rulers/x-{zoomLevel}.gif", y: "img/map/rulers/y-{zoomLevel}.gif"}, cls: {x: "ruler x", y: "ruler y"}, steps: {x: {1: 1, 2: 1, 3: 10, 4: 20}, y: {1: 1, 2: 1, 3: 10, 4: 20}}, delta: {x: {1: 0, 2: 0, 3: 0, 4: 0}, y: {1: 0, 2: 0, 3: -9, 4: -19}}};
Travian.Game.Map.Options.MiniMap = {container: "miniMap", containerContent: "minimapContainer", showToolTip: true, classLines: {x: "lines", y: "lines"}, tooltipHtml: '<span class="xCoord">({x}</span><span class="pi">|</span><span class="yCoord">{y})</span><span class="clear"></span>'};
Travian.Game.Map.Options.Toolbar = {element: "toolbar", viewFullScreenUrl: "karte.php?fullscreen=1&x={x}&y={y}&zoom={zoom}", viewNormalUrl: "karte.php?x={x}&y={y}&zoom={zoom}"};

Travian.Game.Map.Options.Default = {container: "mapContainer", containerViewSize: null, tileDisplayInformation: {type: "dialog", optionsPopup: {url: "position_details.php?x={x}&y={y}", windowOptions: {}}, optionsDialog: {buttonOk: false, data: {cmd: "viewTileDetails", x: null, y: null}}}, blockOverflow: 1, blockSize: {width: 170, height: 150}, mapInitialPosition: {x: 0, y: 0}, grid: {1: "/img/map/grid/grid-1.gif", 2: "/img/map/grid/grid-2.gif", 3: "/img/map/grid/grid-3.gif", 4: false}, speeds: {slow: 5, normal: 20, fast: 40}, symbolTypes: Travian.Game.Map.Options.Symbols, onCreate: function (a) {
}, onRender: function (a) {
    (function () {
        Travian.Game.Map.Tips.render(a, a.containerMover);
        a.rulers = new Travian.Game.Map.Rulers(Travian.Game.Map.Options.Rulers, a);
        a.rulers.render();
        a.miniMap = new Travian.Game.Map.MiniMap(Travian.Game.Map.Options.MiniMap, a);
        a.miniMap.render();


        a.toolbar = new Travian.Game.Map.Toolbar(Travian.Game.Map.Options.Toolbar, a);
        a.toolbar.render()
    }).delay(500)
}, onMove: function (a, b) {
    if (a.rulers) {
        a.rulers.move(b)
    }
    if (a.miniMap) {
        a.miniMap.move()
    }
}, onZoom: function (a) {
    if (a.rulers) {
        a.rulers.zoom()
    }
    if (a.miniMap) {
        a.miniMap.zoom()
    }
    if (a.toolbar) {
        a.toolbar.zoom()
    }
}};

Travian.Game.Map.Options.Default.transition = {onCreate: function (a) {
}, onMove: function (a, b) {
}, onZoom: function (a) {
}, zoomOptions: {level: 1, sizes: [
    {x: 5, y: 5},
    {x: 10, y: 10}//,
    //{x: 51, y: 51},
    //{x: 135, y: 135}//,

]}, border: {left: -400, top: -400, right: 400, bottom: 400}};

Travian.Game.InstantTabs = new Class({
    initialize: function() {
        $$(".instantTabs .tabNavi .container").addEvent("click", function(c) {
            c.preventDefault();
            var b = this;
            var a = 0;
            $$(".instantTabs .tabNavi .container").each(function(d) {
                if (b != null ) {
                    if (d === b) {
                        b = null
                    } else {
                        a++
                    }
                }
            });
            $$(".instantTabs .tabNavi .container").removeClass("active");
            this.addClass("active");
            $$(".instantTabs .tabContainer").addClass("hide");
            $$(".instantTabs .tabContainer")[a].removeClass("hide")
        })
    }
});

Travian.Game.Map.Options.Default.layers = [
    {id: "loading", styles: {background: "#000000 url(img/loading.gif) center center no-repeat", opacity: 0.5}, "class": Travian.Game.Map.Layer.Loading, zIndex: 20},
    {id: "image", src: "map_block.php?tx0={x}&ty0={y}&tx1={right}&ty1={bottom}&w={width}&h={height}&version={version}", srcInit: "img/x.gif", "class": Travian.Game.Map.Layer.Image, zIndex: 1},
    {id: "imageMark", src: "map_mark.php?tx0={x}&ty0={y}&tx1={right}&ty1={bottom}&w={width}&h={height}&updates={forcedUpdates}", srcInit: "img/x.gif", "class": Travian.Game.Map.Layer.ImageMark, zIndex: 2}

];
Travian.Game.Map.Options.Default.block = {tooltipHtml: '<span class="xCoord">({x}</span><span class="pi">|</span><span class="yCoord">{y})</span><span class="clear"></span><br />{k.loadingData}'};
Travian.Game.Map.Options.Default.updater = {maxRequestCount: 5, parameters: {multiple: {cmd: "mapInfo"}, position: {cmd: "mapPositionData"}}, requestDelayTime: {multiple: 100, position: 300}, url: "ajax.php", elementWorking: "working", positionOptions: {areaAroundPosition: {1: {left: -5, top: -4, right: 5, bottom: 4}, 2: {left: -10, top: -8, right: 10, bottom: 8}, 3: {left: -25, top: -25, right: 25, bottom: 25}, 4: {left: -25, top: -25, right: 25, bottom: 25}}}};
Travian.Game.Map.Options.Default.keyboard = {37: "moveLeft", 65: "moveLeft", 100: !Browser.opera ? "moveLeft" : false, 52: Browser.opera ? "moveLeft" : false, 39: "moveRight", 68: "moveRight", 102: !Browser.opera ? "moveRight" : false, 54: Browser.opera ? "moveRight" : false, 38: "moveUp", 87: "moveUp", 104: !Browser.opera ? "moveUp" : false, 56: Browser.opera ? "moveUp" : false, 40: "moveDown", 83: "moveDown", 98: !Browser.opera ? "moveDown" : false, 50: Browser.opera ? "moveDown" : false, 61: "zoomIn", 107: !Browser.opera ? "zoomIn" : false, 43: Browser.opera ? "zoomIn" : false, 109: "zoomOut", 45: Browser.opera ? "zoomOut" : false, 103: !Browser.opera ? "moveLeftUp" : false, 55: Browser.opera ? "moveLeftUp" : false, 97: !Browser.opera ? "moveLeftDown" : false, 49: Browser.opera ? "moveLeftDown" : false, 105: !Browser.opera ? "moveRightUp" : false, 57: Browser.opera ? "moveRightUp" : false, 99: !Browser.opera ? "moveRightDown" : false, 51: Browser.opera ? "moveRightDown" : false, speed: {slow: "control", fast: "shift"}, 71: {fn: "toggleGrid", periodical: 0}, 77: {fn: "toggleMiniMap", periodical: 0}, 79: {fn: "toggleOutline", periodical: 0}};
Travian.Game.Map.Options.Default.dataStore = {cachingTimeForType: {blocks: 30 * 60 * 1000, symbol: 10 * 60 * 1000, tile: 10 * 60 * 1000, tooltip: 2 * 60 * 1000}, persistentStorage: false, useStorageForType: {blocks: false, symbol: false, tile: false, tooltip: true}, clearStorageForType: {blocks: false, symbol: false, tile: false, tooltip: false}};
Travian.Game.Map.Options.Default.data = {elements: []};

Travian.Game.PaymentWizardEventListener = new (new Class({
    PaymentWizardObject: null,
    initialize: function() {
        this.DoubleClickPreventer = new Travian.DoubleClickPreventer();
        this.DoubleClickPreventer.timeout = 2000;
        this.bindEvents()
    },
    bindEvents: function() {
        var a = this;
        window.addEvent("startPaymentWizard", function(b) {
            /*if (undefined === a.PaymentWizardObject || null === a.PaymentWizardObject) {
                if (!a.DoubleClickPreventer.check()) {
                    return false
                }
                a.PaymentWizardObject = a.startPaymentWizard(b)
            } else {
                a.PaymentWizardObject.options = Object.merge({}, a.PaymentWizardObject.options, b || {});
                a.PaymentWizardObject.reload()
            }*/
			a.PaymentWizardObject = a.startPaymentWizard(b)
        })
    },
    startPaymentWizard: function(a) {
        return new Travian.Game.PaymentWizard(a)
    }
}));
Travian.Game.WayOfPaymentEventListener = new (new Class({
    WayOfPaymentObject: null,
    initialize: function() {
        this.DoubleClickPreventer = new Travian.DoubleClickPreventer();
        this.DoubleClickPreventer.timeout = 500;
        this.bindEvents()
    },
    bindEvents: function() {
        var a = this;
        window.addEvent("buttonClicked", function(c, b) {
            if (typeof b.wayOfPayment == "object" && a.DoubleClickPreventer.check()) {
                a.WayOfPaymentObject = a.startWayOfPayment(b.wayOfPayment.featureKey, b.wayOfPayment.context, b.wayOfPayment.dataCallback, b.wayOfPayment.confirmPopup)
            }
        });
        window.addEvent("startWayOfPayment", function(e, c, d, b) {
            if (!a.DoubleClickPreventer.check()) {
                return false
            }
            a.WayOfPaymentObject = a.startWayOfPayment(e, c, d, b)
        })
    },
    startWayOfPayment: function(d, b, c, a) {
        return new Travian.Game.WayOfPayment(d,b,c,a)
    }
}));
Travian.Game.ButtonEventListener = new (new Class({
    initialize: function() {
        this.DoubleClickPreventer = new Travian.DoubleClickPreventer();
        this.bindEvents()
    },
    bindEvents: function() {
        var a = this;
        window.addEvent("buttonClicked", function(c, b) {
            $(c.id).blur();
            if (typeof b.dialog == "object" && b.dialog && a.DoubleClickPreventer.check()) {
                return new Travian.Dialog.Ajax(b.dialog)
            }
            if (typeof b.plusDialog == "object" && b.plusDialog && a.DoubleClickPreventer.check()) {
                return new Travian.Game.PlusDialog(b.plusDialog)
            }
            if (typeof b.productionBoostDialog == "object" && b.productionBoostDialog && a.DoubleClickPreventer.check()) {
                return new Travian.Game.ProductionBoostDialog(b.productionBoostDialog)
            }
            if (typeof b.reportSpamMessagesDialog == "object" && b.reportSpamMessagesDialog && a.DoubleClickPreventer.check()) {
                return new Travian.Game.ReportSpamMessagesDialog(b.reportSpamMessagesDialog)
            }
            if (typeof b.goldclubDialog == "object" && b.goldclubDialog && a.DoubleClickPreventer.check()) {
                return new Travian.Game.GoldclubDialog(b.goldclubDialog)
            }
            if (typeof b.questButtonTipsToggle != "undefined" && b.questButtonTipsToggle) {
                if (typeof b.questButtonActivateTips != "undefined" && b.questButtonActivateTips && typeof b.questButtonDeactivateTips != "undefined" && b.questButtonDeactivateTips) {
                    return Travian.Game.Quest.toggleHighlights(undefined, b.questButtonActivateTips, b.questButtonDeactivateTips)
                }
            }
            if (typeof b.questButtonGainReward != "undefined" && b.questButtonGainReward) {
                return Travian.Game.Quest.rewardButtonClick(b.questId)
            }
            if (typeof b.questButtonNext != "undefined" && b.questButtonNext) {
                return Travian.Game.Quest.nextButtonClick(b.questId)
            }
            if (typeof b.questButtonSkipTutorial != "undefined" && b.questButtonSkipTutorial) {
                return Travian.Game.Quest.skipButtonClick()
            }
            if (typeof b.questButtonOverview != "undefined" && b.questButtonOverview) {
                return Travian.Game.Quest.openTodoListDialog()
            }
            if (typeof b.questButtonOverviewAchievements != "undefined" && b.questButtonOverviewAchievements) {
                return Travian.Game.Quest.openTodoListDialog("", true)
            }
            if (typeof b.questButtonCloseOverlay != "undefined" && b.questButtonCloseOverlay) {
                return Travian.Game.Quest.closeDialog()
            }
            if (typeof b.overlay != "undefined" && b.overlay && a.DoubleClickPreventer.check()) {
                return Travian.Game.Overlay.openOverlay()
            }
            if (typeof b.villageDialog != "undefined" && b.villageDialog && a.DoubleClickPreventer.check()) {
                return Travian.Game.showEditVillageDialog(b.villageDialog.title, b.villageDialog.description, b.villageDialog.saveText, b.villageDialog.villageId)
            }
            if (typeof b.redirectUrl != "undefinded" && b.redirectUrl && a.DoubleClickPreventer.check()) {
                window.location.href = b.redirectUrl;
                return false
            }
            if (typeof b.redirectUrlExternal != "undefinded" && b.redirectUrlExternal && a.DoubleClickPreventer.check()) {
                window.open(b.redirectUrlExternal);
                return false
            }
        });
        window.addEvent("tabClicked", function(c, b) {
            if (typeof b.dialog == "object" && b.dialog && a.DoubleClickPreventer.check()) {
                return new Travian.Dialog.Ajax(b.dialog)
            }
            if (typeof b.plusDialog == "object" && b.plusDialog && a.DoubleClickPreventer.check()) {
                return new Travian.Game.PlusDialog(b.plusDialog)
            }
            if (typeof b.goldclubDialog == "object" && b.goldclubDialog && a.DoubleClickPreventer.check()) {
                return new Travian.Game.GoldclubDialog(b.goldclubDialog)
            }
        })
    }
}));
Travian.Game.WayOfPayment = new Class({
    featureKey: null,
    context: null,
    confirmPopup: null,
    initialize: function(e, b, c, a) {
        if (typeof e == "undefined") {
            throw ("Feature Key must not be empty!")
        }
        var d = {};
        if (typeof c == "string" && typeof this[c] == "function") {
            d = this[c]()
        }
        if (typeof c == "string" && typeof c.split(".").reduce(function(g, f) {
            return g[f]
        }, window) == "function") {
            d = c.split(".").reduce(function(g, f) {
                return g[f]
            }, window)()
        }
        if (typeof c == "function") {
            d = c()
        }
        this.featureKey = e;
        this.context = b;
        this.confirmPopup = a;
        if (typeof a !== "undefined" && typeof a === "object") {
            this.checkConfirmation(d)
        } else {
            this.bookPremiumFeature(d)
        }
    },
    checkConfirmation: function(a) {
        var b = this;
        Travian.ajax({
            data: {
                cmd: "getGoldAmount"
            },
            onSuccess: function(d) {
                var c = d.goldAmount;
                var e = a.coins;
                if (c > 0 && e <= c) {
                    b.showCustomConfirmationPopup(b.confirmPopup, a)
                } else {
                    b.bookPremiumFeature(a)
                }
            }
        })
    },
    showCustomConfirmationPopup: function(a, b) {
        new Travian.Dialog.Ajax({
            buttonOk: false,
            data: {
                cmd: a.name,
                goldAmount: b.coins
            },
            context: this.context,
            elementFocus: a.options["elementFocus"] || "spendGold_confirm_btn"
        })
    },
    bookPremiumFeature: function(a) {
        var b = {
            cmd: "premiumFeature",
            featureKey: this.featureKey,
            context: this.context
        };
        if (typeof a != "undefined") {
            var b = Object.merge({}, a, b)
        }
        var c = this;
		$("loader").removeClass("hide");
        Travian.ajax({
            data: b,
            onSuccess: function(d) {
                if (typeof d.functionToCall != "undefined") {
                    if (typeof c[d.functionToCall] == "function") {
                        c[d.functionToCall](d.options, d.context)
                    } else {
                        if (typeof window[d.functionToCall] == "function") {
                            window[d.functionToCall](d.options, d.context)
                        }
                    }
                }
				//$("loader").addClass("hide");
            }
        })
    },
    renderDialog: function(a) {
        var b = a.dialogOptions;
        var c = a.html;
        if (Travian.WindowManager.getWindowsByContext("convertGoldPopup")) {
            Travian.WindowManager.closeByContext("convertGoldPopup")
        }
        a.context = this.featureKey;
        $dialog = new Travian.Dialog(b);
        $dialog.setContent(c);
        $dialog.show();
        return $dialog
    },
    closeDialog: function(a, b) {
        Travian.WindowManager.closeByContext(b)
    },
    hideDialog: function(a, b) {
        Travian.WindowManager.hideByContext(b)
    },
    unhideDialog: function(a, b) {
        Travian.WindowManager.showByContext(b)
    },
    reloadDialog: function(a, b) {
        if (b == null && undefined != a.scope) {
            b = a.scope.context
        }
        Travian.WindowManager.reloadWindowsByContext(b)
    },
    reloadUrl: function() {
        if ($$("body")[0].hasClass("ie6") || $$("body")[0].hasClass("ie7") || $$("body")[0].hasClass("ie8")) {
            window.location.reload()
        } else {
            window.location.href = window.location.href.split("#")[0]
        }
    },
    openPaymentWizard: function(c, a) {
        var b;
        var d = Travian.emptyFunction;
        if (typeof c.goldProductId != "undefined") {
            b = c.goldProductId
        }
        if (typeof c.callback != "undefined" && typeof c.callback == "function") {
            d = c.callback
        }
        if (typeof c.callback == "string" && typeof c.callback.split(".").reduce(function(f, e) {
            return f[e]
        }, window) == "function") {
            d = c.callback.split(".").reduce(function(f, e) {
                return f[e]
            }, window)
        }
        this.closeDialog(c, "smallestPackage");
        window.fireEvent("startPaymentWizard", {
            data: {
                goldProductId: b,
                activeTab: "buyGold"
            },
            callback: d,
            callbackScope: this
        })
    },
    openPaymentWizardWithProsTab: function() {
        window.fireEvent("startPaymentWizard", {
            data: {
                activeTab: "pros"
            }
        })
    }
});
Travian.Game.PlusDialog = new Class({
    Extends: Travian.Dialog.Ajax,
    options: {
        data: {
            cmd: "plusPopup"
        },
        saveOnUnload: false,
        cssClass: "brown premiumFeaturePackage premiumFeaturePlus",
        buttonOk: false,
        context: "plus",
        darkOverlay: true,
        overlayCancel: false,
        featureMarkup: function(b, a, c) {
            return ['<div class="featureImage ' + c + '"></div>', '<div class="featureContent">', '<h3 class="featureTitle">' + b + "</h3>", '<div class="featureText">' + a + "</div>", "</div>", '<div class="clear"></div>'].join("")
        }
    },
    request: function() {
        var a = this;
        this.options.data.context = this.context;
        Travian.ajax({
            data: this.options.data,
            onSuccess: function(b) {
                a.setContent(a.createContent(a, b));
                a.show()
            }
        });
        return this
    },
    initialize: function(a) {
        this.parent(Object.merge({}, this.options, a || {}))
    },
    createContent: function(m, f) {
        var a = new Element("div",{
            "class": "paymentPopupDialogWrapper"
        });
        var b = new Element("h1");
        var k = new Element("span",{
            html: f.title,
            "class": "headlineText"
        });
        b.insert(k);
        var d = new Element("span",{
            html: f.gold,
            "class": "goldWrapper"
        });
        b.insert(d);
        b.insert(new Element("div",{
            "class": "clear"
        }));
        var o = new Element("h2",{
            html: f.subHeadLine,
            "class": "subHeadline"
        });
        var q = new Element("div",{
            "class": "goldButtonWrapper"
        });
        var r = new Element("div",{
            html: f.goldButton
        });
        var g = new Element("div",{
            html: f.buttonSubtitle,
            "class": "buttonSubTitle"
        });
        q.insert(r);
        q.insert(g);
        var p = new Element("h3",{
            html: f.plusPopupButtonExtraFeatures,
            "class": "extraFeatures"
        });
        var h = new Element("div");
        var e = new Element("div",{
            "class": "furtherFeatures"
        });
        Object.each(f.features, function(s, v) {
            if (v == m.options.featureKey) {
                var u = new Element("div",{
                    "class": "feature featureInfo",
                    html: m.options.featureMarkup(s.title, s.text, v)
                });
                h.insert(u)
            } else {
                var t = new Element("div",{
                    "class": "feature featureInfo",
                    html: m.options.featureMarkup(s.title, s.text, v)
                });
                e.insert(t)
            }
        });
        var c = new Element("p",{
            html: f.furtherInfos,
            "class": "furtherInfos"
        });
        a.insert(b);
        a.insert(h);
        a.insert(o);
        a.insert(q);
        a.insert(p);
        a.insert(e);
        a.insert(c);
        var n = this;
        r.addEvent("click", function() {
            n.goldButtonClicked()
        });
        return a
    },
    goldButtonClicked: function() {
        this.requestSend = true;
        window.fireEvent("startWayOfPayment", ["plus", "plus"]);
        return false
    },
    close: function() {
        if (typeof this.requestSend !== "undefined" && this.requestSend === true) {
            return window.location.reload()
        }
        this.parent()
    }
});
Travian.Game.GoldclubDialog = new Class({
    Extends: Travian.Dialog.Ajax,
    options: {
        data: {
            cmd: "goldclubPopup"
        },
        cssClass: "brown premiumFeaturePackage premiumFeatureGoldclub",
        buttonOk: false,
        context: "goldclub",
        darkOverlay: true,
        overlayCancel: false,
        saveOnUnload: false,
        featureMarkup: function(b, a, c) {
            return ['<div class="featureImage ' + c + '"></div>', '<div class="featureContent">', '<h3 class="featureTitle">' + b + "</h3>", '<div class="featureText">' + a + "</div>", "</div>", '<div class="clear"></div>'].join("")
        }
    },
    request: function() {
        var a = this;
        this.options.data.context = this.context;
        Travian.ajax({
            data: this.options.data,
            onSuccess: function(b) {
                a.setContent(a.createContent(a, b));
                a.show()
            }
        });
        return this
    },
    initialize: function(a) {
        this.parent(Object.merge({}, this.options, a || {}))
    },
    createContent: function(n, g) {
        var a = new Element("div",{
            "class": "paymentPopupDialogWrapper"
        });
        var b = new Element("h1");
        var m = new Element("span",{
            html: g.title,
            "class": "headlineText"
        });
        b.insert(m);
        var d = new Element("span",{
            html: g.gold,
            "class": "goldWrapper"
        });
        b.insert(d);
        b.insert(new Element("div",{
            "class": "clear"
        }));
        var p = new Element("h2",{
            html: g.subHeadLine,
            "class": "subHeadline"
        });
        var q = new Element("div",{
            "class": "goldButtonWrapper"
        });
        var r = new Element("div",{
            html: g.goldButton
        });
        var h = new Element("div",{
            html: g.buttonSubtitle,
            "class": "buttonSubTitle"
        });
        q.insert(r);
        q.insert(h);
        var f = new Element("h3",{
            html: g.goldclubPopupButtonExtraFeatures,
            "class": "extraFeatures"
        });
        var k = new Element("div");
        var e = new Element("div",{
            "class": "furtherFeatures"
        });
        Object.each(g.features, function(s, v) {
            if (v == n.options.featureKey) {
                var u = new Element("div",{
                    "class": "feature featureInfo",
                    html: n.options.featureMarkup(s.title, s.text, v)
                });
                k.insert(u)
            } else {
                var t = new Element("div",{
                    "class": "feature featureInfo",
                    html: n.options.featureMarkup(s.title, s.text, v)
                });
                e.insert(t)
            }
        });
        var c = new Element("p",{
            html: g.furtherInfos,
            "class": "furtherInfos"
        });
        a.insert(b);
        a.insert(k);
        a.insert(p);
        a.insert(q);
        a.insert(f);
        a.insert(e);
        a.insert(c);
        var o = this;
        r.addEvent("click", function() {
            o.goldButtonClicked()
        });
        return a
    },
    goldButtonClicked: function() {
        this.requestSend = true;
        window.fireEvent("startWayOfPayment", ["goldclub", "goldclub"]);
        return false
    }
});