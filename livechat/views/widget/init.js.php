/**
 * Вывести trace вызванной функции
 * @param function_name -- объект.имя_метода
 */
function trc(function_name, params, color) {
	var show = false;

	if (!show && !($.isArray(params) && params[0] === true)) return false;
	else {
		if (!color)
			color = (function_name.indexOf('MultiwidgetModel.') != -1) ?
			'darkred' : 'darkcyan';

		console.trace('%c' + function_name, 'color:' + (color ? color : 'darkkhaki') + '; font-size:13px; font-weight: normal; background-color:#eee; padding:4px 6px; border-radius: 4px');
		if (params && params !== true) {
			var txtColor = color ? color : 'orange';
			console.groupCollapsed('%c  [params]', 'color: ' + txtColor);
			console.dir(params);
			console.groupEnd();
		}
		if (function_name.indexOf('.checkOperators') != -1
		|| function_name.indexOf('.getTalkWith') != -1)
			console.log('%c' + (new Date()).getSeconds() + '---[The end of the calls stack]---', 'color: navy, font-weight: bold');
	}
}
//==============================================================================
//
//  Inserts the chat widget into a web page
//
//==============================================================================

(function () {
	/*!
	 * contentloaded.js
	 *
	 * Author: Diego Perini (diego.perini at gmail.com)
	 * Summary: cross-browser wrapper for DOMContentLoaded
	 * Updated: 20101020
	 * License: MIT
	 * Version: 1.2
	 *
	 * URL:
	 * http://javascript.nwbox.com/ContentLoaded/
	 * http://javascript.nwbox.com/ContentLoaded/MIT-LICENSE
	 *
	 */
	function contentLoaded(c, h) {
		var b = false, g = true, j = c.document, i = j.documentElement, m = j.addEventListener ? "addEventListener" : "attachEvent", k = j.addEventListener ? "removeEventListener" : "detachEvent", a = j.addEventListener ? "" : "on", l = function (n) {
			if (n.type == "readystatechange" && j.readyState != "complete") {
				return
			}
			(n.type == "load" ? c : j)[k](a + n.type, l, false);
			if (!b && (b = true)) {
				h.call(c, n.type || n)
			}
		}, f = function () {
			try {
				i.doScroll("left")
			} catch (n) {
				setTimeout(f, 50);
				return
			}
			l("poll")
		};
		if (j.readyState == "complete") {
			h.call(c, "lazy")
		} else {
			if (j.createEventObject && i.doScroll) {
				try {
					g = !c.frameElement
				} catch (d) {
				}
				if (g) {
					f()
				}
			}
			j[m](a + "DOMContentLoaded", l, false);
			j[m](a + "readystatechange", l, false);
			c[m](a + "load", l, false)
		}
	};
	// Utils
	function addListener(b, a, c) {
		if (b.addEventListener) {
			b.addEventListener(a, c, false);
			return true
		} else {
			if (b.attachEvent) {
				return b.attachEvent("on" + a, c)
			} else {
				a = "on" + a;
				if (typeof b[a] === "function") {
					c = (function (d, e) {
						return function () {
							d.apply(this, arguments);
							e.apply(this, arguments)
						}
					})(b[a], c)
				}
				b[a] = c;
				return true
			}
		}
		return false
	}

	function getWindowWidth() {
		return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth
	}

	function getWindowHeight() {
		return window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight
	}

	function getWindowScrollY() {
		return window.scrollY || window.pageYOffset || document.documentElement.scrollTop
	};
	/*! jQuery v@1.8.0 -deprecated,-ajax,-ajax/jsonp,-ajax/script,-ajax/xhr jquery.com | jquery.org/license */
	(function (e, t) {
		function _(e) {
			var t = M[e] = {};
			return v.each(e.split(y), function (e, n) {
				t[n] = !0
			}), t
		}

		function H(e, n, r) {
			if (r === t && e.nodeType === 1) {
				var i = "data-" + n.replace(P, "-$1").toLowerCase();
				r = e.getAttribute(i);
				if (typeof r == "string") {
					try {
						r = r === "true" ? !0 : r === "false" ? !1 : r === "null" ? null : +r + "" === r ? +r : D.test(r) ? v.parseJSON(r) : r
					} catch (s) {
					}
					v.data(e, n, r)
				} else r = t
			}
			return r
		}

		function B(e) {
			var t;
			for (t in e) {
				if (t === "data" && v.isEmptyObject(e[t]))continue;
				if (t !== "toJSON")return !1
			}
			return !0
		}

		function et() {
			return !1
		}

		function tt() {
			return !0
		}

		function ut(e) {
			return !e || !e.parentNode || e.parentNode.nodeType === 11
		}

		function at(e, t) {
			do e = e[t]; while (e && e.nodeType !== 1);
			return e
		}

		function ft(e, t, n) {
			t = t || 0;
			if (v.isFunction(t))return v.grep(e, function (e, r) {
				var i = !!t.call(e, r, e);
				return i === n
			});
			if (t.nodeType)return v.grep(e, function (e, r) {
				return e === t === n
			});
			if (typeof t == "string") {
				var r = v.grep(e, function (e) {
					return e.nodeType === 1
				});
				if (it.test(t))return v.filter(t, r, !n);
				t = v.filter(t, r)
			}
			return v.grep(e, function (e, r) {
				return v.inArray(e, t) >= 0 === n
			})
		}

		function lt(e) {
			var t = ct.split("|"), n = e.createDocumentFragment();
			if (n.createElement)while (t.length)n.createElement(t.pop());
			return n
		}

		function Lt(e, t) {
			return e.getElementsByTagName(t)[0] || e.appendChild(e.ownerDocument.createElement(t))
		}

		function At(e, t) {
			if (t.nodeType !== 1 || !v.hasData(e))return;
			var n, r, i, s = v._data(e), o = v._data(t, s), u = s.events;
			if (u) {
				delete o.handle, o.events = {};
				for (n in u)for (r = 0, i = u[n].length; r < i; r++)v.event.add(t, n, u[n][r])
			}
			o.data && (o.data = v.extend({}, o.data))
		}

		function Ot(e, t) {
			var n;
			if (t.nodeType !== 1)return;
			t.clearAttributes && t.clearAttributes(), t.mergeAttributes && t.mergeAttributes(e), n = t.nodeName.toLowerCase(), n === "object" ? (t.parentNode && (t.outerHTML = e.outerHTML), v.support.html5Clone && e.innerHTML && !v.trim(t.innerHTML) && (t.innerHTML = e.innerHTML)) : n === "input" && Et.test(e.type) ? (t.defaultChecked = t.checked = e.checked, t.value !== e.value && (t.value = e.value)) : n === "option" ? t.selected = e.defaultSelected : n === "input" || n === "textarea" ? t.defaultValue = e.defaultValue : n === "script" && t.text !== e.text && (t.text = e.text), t.removeAttribute(v.expando)
		}

		function Mt(e) {
			return typeof e.getElementsByTagName != "undefined" ? e.getElementsByTagName("*") : typeof e.querySelectorAll != "undefined" ? e.querySelectorAll("*") : []
		}

		function _t(e) {
			Et.test(e.type) && (e.defaultChecked = e.checked)
		}

		function Kt(e, t) {
			if (t in e)return t;
			var n = t.charAt(0).toUpperCase() + t.slice(1), r = t, i = $t.length;
			while (i--) {
				t = $t[i] + n;
				if (t in e)return t
			}
			return r
		}

		function Qt(e, t) {
			return e = t || e, v.css(e, "display") === "none" || !v.contains(e.ownerDocument, e)
		}

		function Gt(e, t) {
			var n, r, i = [], s = 0, o = e.length;
			for (; s < o; s++) {
				n = e[s];
				if (!n.style)continue;
				i[s] = v._data(n, "olddisplay"), t ? (!i[s] && n.style.display === "none" && (n.style.display = ""), n.style.display === "" && Qt(n) && (i[s] = v._data(n, "olddisplay", tn(n.nodeName)))) : (r = Dt(n, "display"), !i[s] && r !== "none" && v._data(n, "olddisplay", r))
			}
			for (s = 0; s < o; s++) {
				n = e[s];
				if (!n.style)continue;
				if (!t || n.style.display === "none" || n.style.display === "")n.style.display = t ? i[s] || "" : "none"
			}
			return e
		}

		function Yt(e, t, n) {
			var r = qt.exec(t);
			return r ? Math.max(0, r[1] - (n || 0)) + (r[2] || "px") : t
		}

		function Zt(e, t, n, r) {
			var i = n === (r ? "border" : "content") ? 4 : t === "width" ? 1 : 0, s = 0;
			for (; i < 4; i += 2)n === "margin" && (s += v.css(e, n + Vt[i], !0)), r ? (n === "content" && (s -= parseFloat(Dt(e, "padding" + Vt[i])) || 0), n !== "margin" && (s -= parseFloat(Dt(e, "border" + Vt[i] + "Width")) || 0)) : (s += parseFloat(Dt(e, "padding" + Vt[i])) || 0, n !== "padding" && (s += parseFloat(Dt(e, "border" + Vt[i] + "Width")) || 0));
			return s
		}

		function en(e, t, n) {
			var r = t === "width" ? e.offsetWidth : e.offsetHeight, i = !0, s = v.support.boxSizing && v.css(e, "boxSizing") === "border-box";
			if (r <= 0) {
				r = Dt(e, t);
				if (r < 0 || r == null)r = e.style[t];
				if (Rt.test(r))return r;
				i = s && (v.support.boxSizingReliable || r === e.style[t]), r = parseFloat(r) || 0
			}
			return r + Zt(e, t, n || (s ? "border" : "content"), i) + "px"
		}

		function tn(e) {
			if (zt[e])return zt[e];
			var t = v("<" + e + ">").appendTo(i.body), n = t.css("display");
			t.remove();
			if (n === "none" || n === "") {
				Pt = i.body.appendChild(Pt || v.extend(i.createElement("iframe"), {
					frameBorder: 0,
					width: 0,
					height: 0
				}));
				if (!Ht || !Pt.createElement)Ht = (Pt.contentWindow || Pt.contentDocument).document, Ht.write("<!doctype html><html><body>"), Ht.close();
				t = Ht.body.appendChild(Ht.createElement(e)), n = Dt(t, "display"), i.body.removeChild(Pt)
			}
			return zt[e] = n, n
		}

		function an(e, t, n, r) {
			var i;
			if (v.isArray(t))v.each(t, function (t, i) {
				n || rn.test(e) ? r(e, i) : an(e + "[" + (typeof i == "object" ? t : "") + "]", i, n, r)
			}); else if (!n && v.type(t) === "object")for (i in t)an(e + "[" + i + "]", t[i], n, r); else r(e, t)
		}

		function mn() {
			return setTimeout(function () {
				fn = t
			}, 0), fn = v.now()
		}

		function gn(e, t) {
			v.each(t, function (t, n) {
				var r = (vn[t] || []).concat(vn["*"]), i = 0, s = r.length;
				for (; i < s; i++)if (r[i].call(e, t, n))return
			})
		}

		function yn(e, t, n) {
			var r, i = 0, s = 0, o = dn.length, u = v.Deferred().always(function () {
				delete a.elem
			}), a = function () {
				var t = fn || mn(), n = Math.max(0, f.startTime + f.duration - t), r = 1 - (n / f.duration || 0), i = 0, s = f.tweens.length;
				for (; i < s; i++)f.tweens[i].run(r);
				return u.notifyWith(e, [f, r, n]), r < 1 && s ? n : (u.resolveWith(e, [f]), !1)
			}, f = u.promise({
				elem: e,
				props: v.extend({}, t),
				opts: v.extend(!0, {specialEasing: {}}, n),
				originalProperties: t,
				originalOptions: n,
				startTime: fn || mn(),
				duration: n.duration,
				tweens: [],
				createTween: function (t, n, r) {
					var i = v.Tween(e, f.opts, t, n, f.opts.specialEasing[t] || f.opts.easing);
					return f.tweens.push(i), i
				},
				stop: function (t) {
					var n = 0, r = t ? f.tweens.length : 0;
					for (; n < r; n++)f.tweens[n].run(1);
					return t ? u.resolveWith(e, [f, t]) : u.rejectWith(e, [f, t]), this
				}
			}), l = f.props;
			bn(l, f.opts.specialEasing);
			for (; i < o; i++) {
				r = dn[i].call(f, e, l, f.opts);
				if (r)return r
			}
			return gn(f, l), v.isFunction(f.opts.start) && f.opts.start.call(e, f), v.fx.timer(v.extend(a, {
				anim: f,
				queue: f.opts.queue,
				elem: e
			})), f.progress(f.opts.progress).done(f.opts.done, f.opts.complete).fail(f.opts.fail).always(f.opts.always)
		}

		function bn(e, t) {
			var n, r, i, s, o;
			for (n in e) {
				r = v.camelCase(n), i = t[r], s = e[n], v.isArray(s) && (i = s[1], s = e[n] = s[0]), n !== r && (e[r] = s, delete e[n]), o = v.cssHooks[r];
				if (o && "expand"in o) {
					s = o.expand(s), delete e[r];
					for (n in s)n in e || (e[n] = s[n], t[n] = i)
				} else t[r] = i
			}
		}

		function wn(e, t, n) {
			var r, i, s, o, u, a, f, l, c = this, h = e.style, p = {}, d = [], m = e.nodeType && Qt(e);
			n.queue || (f = v._queueHooks(e, "fx"), f.unqueued == null && (f.unqueued = 0, l = f.empty.fire, f.empty.fire = function () {
				f.unqueued || l()
			}), f.unqueued++, c.always(function () {
				c.always(function () {
					f.unqueued--, v.queue(e, "fx").length || f.empty.fire()
				})
			})), e.nodeType === 1 && ("height"in t || "width"in t) && (n.overflow = [h.overflow, h.overflowX, h.overflowY], v.css(e, "display") === "inline" && v.css(e, "float") === "none" && (!v.support.inlineBlockNeedsLayout || tn(e.nodeName) === "inline" ? h.display = "inline-block" : h.zoom = 1)), n.overflow && (h.overflow = "hidden", v.support.shrinkWrapBlocks || c.done(function () {
				h.overflow = n.overflow[0], h.overflowX = n.overflow[1], h.overflowY = n.overflow[2]
			}));
			for (r in t) {
				s = t[r];
				if (cn.exec(s)) {
					delete t[r];
					if (s === (m ? "hide" : "show"))continue;
					d.push(r)
				}
			}
			o = d.length;
			if (o) {
				u = v._data(e, "fxshow") || v._data(e, "fxshow", {}), m ? v(e).show() : c.done(function () {
					v(e).hide()
				}), c.done(function () {
					var t;
					v.removeData(e, "fxshow", !0);
					for (t in p)v.style(e, t, p[t])
				});
				for (r = 0; r < o; r++)i = d[r], a = c.createTween(i, m ? u[i] : 0), p[i] = u[i] || v.style(e, i), i in u || (u[i] = a.start, m && (a.end = a.start, a.start = i === "width" || i === "height" ? 1 : 0))
			}
		}

		function En(e, t, n, r, i) {
			return new En.prototype.init(e, t, n, r, i)
		}

		function Sn(e, t) {
			var n, r = {height: e}, i = 0;
			for (; i < 4; i += 2 - t)n = Vt[i], r["margin" + n] = r["padding" + n] = e;
			return t && (r.opacity = r.width = e), r
		}

		function Tn(e) {
			return v.isWindow(e) ? e : e.nodeType === 9 ? e.defaultView || e.parentWindow : !1
		}

		var n, r, i = e.document, s = e.location, o = e.navigator, u = e.__jq2, a = e.__jq, f = Array.prototype.push, l = Array.prototype.slice, c = Array.prototype.indexOf, h = Object.prototype.toString, p = Object.prototype.hasOwnProperty, d = String.prototype.trim, v = function (e, t) {
			return new v.fn.init(e, t, n)
		}, m = /[\-+]?(?:\d*\.|)\d+(?:[eE][\-+]?\d+|)/.source, g = /\S/, y = /\s+/, b = g.test(" ") ? /^[\s\xA0]+|[\s\xA0]+$/g : /^\s+|\s+$/g, w = /^(?:[^#<]*(<[\w\W]+>)[^>]*$|#([\w\-]*)$)/, E = /^<(\w+)\s*\/?>(?:<\/\1>|)$/, S = /^[\],:{}\s]*$/, x = /(?:^|:|,)(?:\s*\[)+/g, T = /\\(?:["\\\/bfnrt]|u[\da-fA-F]{4})/g, N = /"[^"\\\r\n]*"|true|false|null|-?(?:\d\d*\.|)\d+(?:[eE][\-+]?\d+|)/g, C = /^-ms-/, k = /-([\da-z])/gi, L = function (e, t) {
			return (t + "").toUpperCase()
		}, A = function () {
			i.addEventListener ? (i.removeEventListener("DOMContentLoaded", A, !1), v.ready()) : i.readyState === "complete" && (i.detachEvent("onreadystatechange", A), v.ready())
		}, O = {};
		v.fn = v.prototype = {
			constructor: v,
			init: function (e, n, r) {
				var s, o, u, a;
				if (!e)return this;
				if (e.nodeType)return this.context = this[0] = e, this.length = 1, this;
				if (typeof e == "string") {
					e.charAt(0) === "<" && e.charAt(e.length - 1) === ">" && e.length >= 3 ? s = [null, e, null] : s = w.exec(e);
					if (s && (s[1] || !n)) {
						if (s[1])return n = n instanceof v ? n[0] : n, a = n && n.nodeType ? n.ownerDocument || n : i, e = v.parseHTML(s[1], a, !0), E.test(s[1]) && v.isPlainObject(n) && this.attr.call(e, n, !0), v.merge(this, e);
						o = i.getElementById(s[2]);
						if (o && o.parentNode) {
							if (o.id !== s[2])return r.find(e);
							this.length = 1, this[0] = o
						}
						return this.context = i, this.selector = e, this
					}
					return !n || n.jquery ? (n || r).find(e) : this.constructor(n).find(e)
				}
				return v.isFunction(e) ? r.ready(e) : (e.selector !== t && (this.selector = e.selector, this.context = e.context), v.makeArray(e, this))
			},
			selector: "",
			jquery: "1.8.0 -deprecated,-ajax,-ajax/jsonp,-ajax/script,-ajax/xhr",
			length: 0,
			size: function () {
				return this.length
			},
			toArray: function () {
				return l.call(this)
			},
			get: function (e) {
				return e == null ? this.toArray() : e < 0 ? this[this.length + e] : this[e]
			},
			pushStack: function (e, t, n) {
				var r = v.merge(this.constructor(), e);
				return r.prevObject = this, r.context = this.context, t === "find" ? r.selector = this.selector + (this.selector ? " " : "") + n : t && (r.selector = this.selector + "." + t + "(" + n + ")"), r
			},
			each: function (e, t) {
				return v.each(this, e, t)
			},
			ready: function (e) {
				return v.ready.promise().done(e), this
			},
			eq: function (e) {
				return e = +e, e === -1 ? this.slice(e) : this.slice(e, e + 1)
			},
			first: function () {
				return this.eq(0)
			},
			last: function () {
				return this.eq(-1)
			},
			slice: function () {
				return this.pushStack(l.apply(this, arguments), "slice", l.call(arguments).join(","))
			},
			map: function (e) {
				return this.pushStack(v.map(this, function (t, n) {
					return e.call(t, n, t)
				}))
			},
			end: function () {
				return this.prevObject || this.constructor(null)
			},
			push: f,
			sort: [].sort,
			splice: [].splice
		}, v.fn.init.prototype = v.fn, v.extend = v.fn.extend = function () {
			var e, n, r, i, s, o, u = arguments[0] || {}, a = 1, f = arguments.length, l = !1;
			typeof u == "boolean" && (l = u, u = arguments[1] || {}, a = 2), typeof u != "object" && !v.isFunction(u) && (u = {}), f === a && (u = this, --a);
			for (; a < f; a++)if ((e = arguments[a]) != null)for (n in e) {
				r = u[n], i = e[n];
				if (u === i)continue;
				l && i && (v.isPlainObject(i) || (s = v.isArray(i))) ? (s ? (s = !1, o = r && v.isArray(r) ? r : []) : o = r && v.isPlainObject(r) ? r : {}, u[n] = v.extend(l, o, i)) : i !== t && (u[n] = i)
			}
			return u
		}, v.extend({
			noConflict: function (t) {
				return e.__jq === v && (e.__jq = a), t && e.__jq2 === v && (e.__jq2 = u), v
			}, isReady: !1, readyWait: 1, holdReady: function (e) {
				e ? v.readyWait++ : v.ready(!0)
			}, ready: function (e) {
				if (e === !0 ? --v.readyWait : v.isReady)return;
				if (!i.body)return setTimeout(v.ready, 1);
				v.isReady = !0;
				if (e !== !0 && --v.readyWait > 0)return;
				r.resolveWith(i, [v]), v.fn.trigger && v(i).trigger("ready").off("ready")
			}, isFunction: function (e) {
				return v.type(e) === "function"
			}, isArray: Array.isArray || function (e) {
				return v.type(e) === "array"
			}, isWindow: function (e) {
				return e != null && e == e.window
			}, isNumeric: function (e) {
				return !isNaN(parseFloat(e)) && isFinite(e)
			}, type: function (e) {
				return e == null ? String(e) : O[h.call(e)] || "object"
			}, isPlainObject: function (e) {
				if (!e || v.type(e) !== "object" || e.nodeType || v.isWindow(e))return !1;
				try {
					if (e.constructor && !p.call(e, "constructor") && !p.call(e.constructor.prototype, "isPrototypeOf"))return !1
				} catch (n) {
					return !1
				}
				var r;
				for (r in e);
				return r === t || p.call(e, r)
			}, isEmptyObject: function (e) {
				var t;
				for (t in e)return !1;
				return !0
			}, error: function (e) {
				throw new Error(e)
			}, parseHTML: function (e, t, n) {
				var r;
				return !e || typeof e != "string" ? null : (typeof t == "boolean" && (n = t, t = 0), t = t || i, (r = E.exec(e)) ? [t.createElement(r[1])] : (r = v.buildFragment([e], t, n ? null : []), v.merge([], (r.cacheable ? v.clone(r.fragment) : r.fragment).childNodes)))
			}, parseJSON: function (t) {
				if (!t || typeof t != "string")return null;
				t = v.trim(t);
				if (e.JSON && e.JSON.parse)return e.JSON.parse(t);
				if (S.test(t.replace(T, "@").replace(N, "]").replace(x, "")))return (new Function("return " + t))();
				v.error("Invalid JSON: " + t)
			}, parseXML: function (n) {
				var r, i;
				if (!n || typeof n != "string")return null;
				try {
					e.DOMParser ? (i = new DOMParser, r = i.parseFromString(n, "text/xml")) : (r = new ActiveXObject("Microsoft.XMLDOM"), r.async = "false", r.loadXML(n))
				} catch (s) {
					r = t
				}
				return (!r || !r.documentElement || r.getElementsByTagName("parsererror").length) && v.error("Invalid XML: " + n), r
			}, noop: function () {
			}, globalEval: function (t) {
				t && g.test(t) && (e.execScript || function (t) {
					e.eval.call(e, t)
				})(t)
			}, camelCase: function (e) {
				return e.replace(C, "ms-").replace(k, L)
			}, nodeName: function (e, t) {
				return e.nodeName && e.nodeName.toUpperCase() === t.toUpperCase()
			}, each: function (e, n, r) {
				var i, s = 0, o = e.length, u = o === t || v.isFunction(e);
				if (r) {
					if (u) {
						for (i in e)if (n.apply(e[i], r) === !1)break
					} else for (; s < o;)if (n.apply(e[s++], r) === !1)break
				} else if (u) {
					for (i in e)if (n.call(e[i], i, e[i]) === !1)break
				} else for (; s < o;)if (n.call(e[s], s, e[s++]) === !1)break;
				return e
			}, trim: d ? function (e) {
				return e == null ? "" : d.call(e)
			} : function (e) {
				return e == null ? "" : e.toString().replace(b, "")
			}, makeArray: function (e, t) {
				var n, r = t || [];
				return e != null && (n = v.type(e), e.length == null || n === "string" || n === "function" || n === "regexp" || v.isWindow(e) ? f.call(r, e) : v.merge(r, e)), r
			}, inArray: function (e, t, n) {
				var r;
				if (t) {
					if (c)return c.call(t, e, n);
					r = t.length, n = n ? n < 0 ? Math.max(0, r + n) : n : 0;
					for (; n < r; n++)if (n in t && t[n] === e)return n
				}
				return -1
			}, merge: function (e, n) {
				var r = n.length, i = e.length, s = 0;
				if (typeof r == "number")for (; s < r; s++)e[i++] = n[s]; else while (n[s] !== t)e[i++] = n[s++];
				return e.length = i, e
			}, grep: function (e, t, n) {
				var r, i = [], s = 0, o = e.length;
				n = !!n;
				for (; s < o; s++)r = !!t(e[s], s), n !== r && i.push(e[s]);
				return i
			}, map: function (e, n, r) {
				var i, s, o = [], u = 0, a = e.length, f = e instanceof v || a !== t && typeof a == "number" && (a > 0 && e[0] && e[a - 1] || a === 0 || v.isArray(e));
				if (f)for (; u < a; u++)i = n(e[u], u, r), i != null && (o[o.length] = i); else for (s in e)i = n(e[s], s, r), i != null && (o[o.length] = i);
				return o.concat.apply([], o)
			}, guid: 1, proxy: function (e, n) {
				var r, i, s;
				return typeof n == "string" && (r = e[n], n = e, e = r), v.isFunction(e) ? (i = l.call(arguments, 2), s = function () {
					return e.apply(n, i.concat(l.call(arguments)))
				}, s.guid = e.guid = e.guid || s.guid || v.guid++, s) : t
			}, access: function (e, n, r, i, s, o, u) {
				var a, f = r == null, l = 0, c = e.length;
				if (r && typeof r == "object") {
					for (l in r)v.access(e, n, l, r[l], 1, o, i);
					s = 1
				} else if (i !== t) {
					a = u === t && v.isFunction(i), f && (a ? (a = n, n = function (e, t, n) {
						return a.call(v(e), n)
					}) : (n.call(e, i), n = null));
					if (n)for (; l < c; l++)n(e[l], r, a ? i.call(e[l], l, n(e[l], r)) : i, u);
					s = 1
				}
				return s ? e : f ? n.call(e) : c ? n(e[0], r) : o
			}, now: function () {
				return (new Date).getTime()
			}
		}), v.ready.promise = function (t) {
			if (!r) {
				r = v.Deferred();
				if (i.readyState === "complete" || i.readyState !== "loading" && i.addEventListener)setTimeout(v.ready, 1); else if (i.addEventListener)i.addEventListener("DOMContentLoaded", A, !1), e.addEventListener("load", v.ready, !1); else {
					i.attachEvent("onreadystatechange", A), e.attachEvent("onload", v.ready);
					var n = !1;
					try {
						n = e.frameElement == null && i.documentElement
					} catch (s) {
					}
					n && n.doScroll && function o() {
						if (!v.isReady) {
							try {
								n.doScroll("left")
							} catch (e) {
								return setTimeout(o, 50)
							}
							v.ready()
						}
					}()
				}
			}
			return r.promise(t)
		}, v.each("Boolean Number String Function Array Date RegExp Object".split(" "), function (e, t) {
			O["[object " + t + "]"] = t.toLowerCase()
		}), n = v(i);
		var M = {};
		v.Callbacks = function (e) {
			e = typeof e == "string" ? M[e] || _(e) : v.extend({}, e);
			var n, r, i, s, o, u, a = [], f = !e.once && [], l = function (t) {
				n = e.memory && t, r = !0, u = s || 0, s = 0, o = a.length, i = !0;
				for (; a && u < o; u++)if (a[u].apply(t[0], t[1]) === !1 && e.stopOnFalse) {
					n = !1;
					break
				}
				i = !1, a && (f ? f.length && l(f.shift()) : n ? a = [] : c.disable())
			}, c = {
				add: function () {
					if (a) {
						var t = a.length;
						(function r(t) {
							v.each(t, function (t, n) {
								v.isFunction(n) && (!e.unique || !c.has(n)) ? a.push(n) : n && n.length && r(n)
							})
						})(arguments), i ? o = a.length : n && (s = t, l(n))
					}
					return this
				}, remove: function () {
					return a && v.each(arguments, function (e, t) {
						var n;
						while ((n = v.inArray(t, a, n)) > -1)a.splice(n, 1), i && (n <= o && o--, n <= u && u--)
					}), this
				}, has: function (e) {
					return v.inArray(e, a) > -1
				}, empty: function () {
					return a = [], this
				}, disable: function () {
					return a = f = n = t, this
				}, disabled: function () {
					return !a
				}, lock: function () {
					return f = t, n || c.disable(), this
				}, locked: function () {
					return !f
				}, fireWith: function (e, t) {
					return t = t || [], t = [e, t.slice ? t.slice() : t], a && (!r || f) && (i ? f.push(t) : l(t)), this
				}, fire: function () {
					return c.fireWith(this, arguments), this
				}, fired: function () {
					return !!r
				}
			};
			return c
		}, v.extend({
			Deferred: function (e) {
				var t = [["resolve", "done", v.Callbacks("once memory"), "resolved"], ["reject", "fail", v.Callbacks("once memory"), "rejected"], ["notify", "progress", v.Callbacks("memory")]], n = "pending", r = {
					state: function () {
						return n
					}, always: function () {
						return i.done(arguments).fail(arguments), this
					}, then: function () {
						var e = arguments;
						return v.Deferred(function (n) {
							v.each(t, function (t, r) {
								var s = r[0], o = e[t];
								i[r[1]](v.isFunction(o) ? function () {
									var e = o.apply(this, arguments);
									e && v.isFunction(e.promise) ? e.promise().done(n.resolve).fail(n.reject).progress(n.notify) : n[s + "With"](this === i ? n : this, [e])
								} : n[s])
							}), e = null
						}).promise()
					}, promise: function (e) {
						return typeof e == "object" ? v.extend(e, r) : r
					}
				}, i = {};
				return r.pipe = r.then, v.each(t, function (e, s) {
					var o = s[2], u = s[3];
					r[s[1]] = o.add, u && o.add(function () {
						n = u
					}, t[e ^ 1][2].disable, t[2][2].lock), i[s[0]] = o.fire, i[s[0] + "With"] = o.fireWith
				}), r.promise(i), e && e.call(i, i), i
			}, when: function (e) {
				var t = 0, n = l.call(arguments), r = n.length, i = r !== 1 || e && v.isFunction(e.promise) ? r : 0, s = i === 1 ? e : v.Deferred(), o = function (e, t, n) {
					return function (r) {
						t[e] = this, n[e] = arguments.length > 1 ? l.call(arguments) : r, n === u ? s.notifyWith(t, n) : --i || s.resolveWith(t, n)
					}
				}, u, a, f;
				if (r > 1) {
					u = new Array(r), a = new Array(r), f = new Array(r);
					for (; t < r; t++)n[t] && v.isFunction(n[t].promise) ? n[t].promise().done(o(t, f, n)).fail(s.reject).progress(o(t, a, u)) : --i
				}
				return i || s.resolveWith(f, n), s.promise()
			}
		}), v.support = function () {
			var t, n, r, s, o, u, a, f, l, c, h, p = i.createElement("div");
			p.setAttribute("className", "t"), p.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", n = p.getElementsByTagName("*"), r = p.getElementsByTagName("a")[0], r.style.cssText = "top:1px;float:left;opacity:.5";
			if (!n || !n.length || !r)return {};
			s = i.createElement("select"), o = s.appendChild(i.createElement("option")), u = p.getElementsByTagName("input")[0], t = {
				leadingWhitespace: p.firstChild.nodeType === 3,
				tbody: !p.getElementsByTagName("tbody").length,
				htmlSerialize: !!p.getElementsByTagName("link").length,
				style: /top/.test(r.getAttribute("style")),
				hrefNormalized: r.getAttribute("href") === "/a",
				opacity: /^0.5/.test(r.style.opacity),
				cssFloat: !!r.style.cssFloat,
				checkOn: u.value === "on",
				optSelected: o.selected,
				getSetAttribute: p.className !== "t",
				enctype: !!i.createElement("form").enctype,
				html5Clone: i.createElement("nav").cloneNode(!0).outerHTML !== "<:nav></:nav>",
				boxModel: i.compatMode === "CSS1Compat",
				submitBubbles: !0,
				changeBubbles: !0,
				focusinBubbles: !1,
				deleteExpando: !0,
				noCloneEvent: !0,
				inlineBlockNeedsLayout: !1,
				shrinkWrapBlocks: !1,
				reliableMarginRight: !0,
				boxSizingReliable: !0,
				pixelPosition: !1
			}, u.checked = !0, t.noCloneChecked = u.cloneNode(!0).checked, s.disabled = !0, t.optDisabled = !o.disabled;
			try {
				delete p.test
			} catch (d) {
				t.deleteExpando = !1
			}
			!p.addEventListener && p.attachEvent && p.fireEvent && (p.attachEvent("onclick", h = function () {
				t.noCloneEvent = !1
			}), p.cloneNode(!0).fireEvent("onclick"), p.detachEvent("onclick", h)), u = i.createElement("input"), u.value = "t", u.setAttribute("type", "radio"), t.radioValue = u.value === "t", u.setAttribute("checked", "checked"), u.setAttribute("name", "t"), p.appendChild(u), a = i.createDocumentFragment(), a.appendChild(p.lastChild), t.checkClone = a.cloneNode(!0).cloneNode(!0).lastChild.checked, t.appendChecked = u.checked, a.removeChild(u), a.appendChild(p);
			if (p.attachEvent)for (l in{
				submit: !0,
				change: !0,
				focusin: !0
			})f = "on" + l, c = f in p, c || (p.setAttribute(f, "return;"), c = typeof p[f] == "function"), t[l + "Bubbles"] = c;
			return v(function () {
				var n, r, s, o, u = "padding:0;margin:0;border:0;display:block;overflow:hidden;", a = i.getElementsByTagName("body")[0];
				if (!a)return;
				n = i.createElement("div"), n.style.cssText = "visibility:hidden;border:0;width:0;height:0;position:static;top:0;margin-top:1px", a.insertBefore(n, a.firstChild), r = i.createElement("div"), n.appendChild(r), r.innerHTML = "<table><tr><td></td><td>t</td></tr></table>", s = r.getElementsByTagName("td"), s[0].style.cssText = "padding:0;margin:0;border:0;display:none", c = s[0].offsetHeight === 0, s[0].style.display = "", s[1].style.display = "none", t.reliableHiddenOffsets = c && s[0].offsetHeight === 0, r.innerHTML = "", r.style.cssText = "box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;padding:1px;border:1px;display:block;width:4px;margin-top:1%;position:absolute;top:1%;", t.boxSizing = r.offsetWidth === 4, t.doesNotIncludeMarginInBodyOffset = a.offsetTop !== 1, e.getComputedStyle && (t.pixelPosition = (e.getComputedStyle(r, null) || {}).top !== "1%", t.boxSizingReliable = (e.getComputedStyle(r, null) || {width: "4px"}).width === "4px", o = i.createElement("div"), o.style.cssText = r.style.cssText = u, o.style.marginRight = o.style.width = "0", r.style.width = "1px", r.appendChild(o), t.reliableMarginRight = !parseFloat((e.getComputedStyle(o, null) || {}).marginRight)), typeof r.style.zoom != "undefined" && (r.innerHTML = "", r.style.cssText = u + "width:1px;padding:1px;display:inline;zoom:1", t.inlineBlockNeedsLayout = r.offsetWidth === 3, r.style.display = "block", r.style.overflow = "visible", r.innerHTML = "<div></div>", r.firstChild.style.width = "5px", t.shrinkWrapBlocks = r.offsetWidth !== 3, n.style.zoom = 1), a.removeChild(n), n = r = s = o = null
			}), a.removeChild(p), n = r = s = o = u = a = p = null, t
		}();
		var D = /^(?:\{.*\}|\[.*\])$/, P = /([A-Z])/g;
		v.extend({
			cache: {},
			deletedIds: [],
			uuid: 0,
			expando: "jQuery" + (v.fn.jquery + Math.random()).replace(/\D/g, ""),
			noData: {embed: !0, object: "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000", applet: !0},
			hasData: function (e) {
				return e = e.nodeType ? v.cache[e[v.expando]] : e[v.expando], !!e && !B(e)
			},
			data: function (e, n, r, i) {
				if (!v.acceptData(e))return;
				var s, o, u = v.expando, a = typeof n == "string", f = e.nodeType, l = f ? v.cache : e, c = f ? e[u] : e[u] && u;
				if ((!c || !l[c] || !i && !l[c].data) && a && r === t)return;
				c || (f ? e[u] = c = v.deletedIds.pop() || ++v.uuid : c = u), l[c] || (l[c] = {}, f || (l[c].toJSON = v.noop));
				if (typeof n == "object" || typeof n == "function")i ? l[c] = v.extend(l[c], n) : l[c].data = v.extend(l[c].data, n);
				return s = l[c], i || (s.data || (s.data = {}), s = s.data), r !== t && (s[v.camelCase(n)] = r), a ? (o = s[n], o == null && (o = s[v.camelCase(n)])) : o = s, o
			},
			removeData: function (e, t, n) {
				if (!v.acceptData(e))return;
				var r, i, s, o = e.nodeType, u = o ? v.cache : e, a = o ? e[v.expando] : v.expando;
				if (!u[a])return;
				if (t) {
					r = n ? u[a] : u[a].data;
					if (r) {
						v.isArray(t) || (t in r ? t = [t] : (t = v.camelCase(t), t in r ? t = [t] : t = t.split(" ")));
						for (i = 0, s = t.length; i < s; i++)delete r[t[i]];
						if (!(n ? B : v.isEmptyObject)(r))return
					}
				}
				if (!n) {
					delete u[a].data;
					if (!B(u[a]))return
				}
				o ? v.cleanData([e], !0) : v.support.deleteExpando || u != u.window ? delete u[a] : u[a] = null
			},
			_data: function (e, t, n) {
				return v.data(e, t, n, !0)
			},
			acceptData: function (e) {
				var t = e.nodeName && v.noData[e.nodeName.toLowerCase()];
				return !t || t !== !0 && e.getAttribute("classid") === t
			}
		}), v.fn.extend({
			data: function (e, n) {
				var r, i, s, o, u, a = this[0], f = 0, l = null;
				if (e === t) {
					if (this.length) {
						l = v.data(a);
						if (a.nodeType === 1 && !v._data(a, "parsedAttrs")) {
							s = a.attributes;
							for (u = s.length; f < u; f++)o = s[f].name, o.indexOf("data-") === 0 && (o = v.camelCase(o.substring(5)), H(a, o, l[o]));
							v._data(a, "parsedAttrs", !0)
						}
					}
					return l
				}
				return typeof e == "object" ? this.each(function () {
					v.data(this, e)
				}) : (r = e.split(".", 2), r[1] = r[1] ? "." + r[1] : "", i = r[1] + "!", v.access(this, function (n) {
					if (n === t)return l = this.triggerHandler("getData" + i, [r[0]]), l === t && a && (l = v.data(a, e), l = H(a, e, l)), l === t && r[1] ? this.data(r[0]) : l;
					r[1] = n, this.each(function () {
						var t = v(this);
						t.triggerHandler("setData" + i, r), v.data(this, e, n), t.triggerHandler("changeData" + i, r)
					})
				}, null, n, arguments.length > 1, null, !1))
			}, removeData: function (e) {
				return this.each(function () {
					v.removeData(this, e)
				})
			}
		}), v.extend({
			queue: function (e, t, n) {
				var r;
				if (e)return t = (t || "fx") + "queue", r = v._data(e, t), n && (!r || v.isArray(n) ? r = v._data(e, t, v.makeArray(n)) : r.push(n)), r || []
			}, dequeue: function (e, t) {
				t = t || "fx";
				var n = v.queue(e, t), r = n.shift(), i = v._queueHooks(e, t), s = function () {
					v.dequeue(e, t)
				};
				r === "inprogress" && (r = n.shift()), r && (t === "fx" && n.unshift("inprogress"), delete i.stop, r.call(e, s, i)), !n.length && i && i.empty.fire()
			}, _queueHooks: function (e, t) {
				var n = t + "queueHooks";
				return v._data(e, n) || v._data(e, n, {
					empty: v.Callbacks("once memory").add(function () {
						v.removeData(e, t + "queue", !0), v.removeData(e, n, !0)
					})
				})
			}
		}), v.fn.extend({
			queue: function (e, n) {
				var r = 2;
				return typeof e != "string" && (n = e, e = "fx", r--), arguments.length < r ? v.queue(this[0], e) : n === t ? this : this.each(function () {
					var t = v.queue(this, e, n);
					v._queueHooks(this, e), e === "fx" && t[0] !== "inprogress" && v.dequeue(this, e)
				})
			}, dequeue: function (e) {
				return this.each(function () {
					v.dequeue(this, e)
				})
			}, delay: function (e, t) {
				return e = v.fx ? v.fx.speeds[e] || e : e, t = t || "fx", this.queue(t, function (t, n) {
					var r = setTimeout(t, e);
					n.stop = function () {
						clearTimeout(r)
					}
				})
			}, clearQueue: function (e) {
				return this.queue(e || "fx", [])
			}, promise: function (e, n) {
				var r, i = 1, s = v.Deferred(), o = this, u = this.length, a = function () {
					--i || s.resolveWith(o, [o])
				};
				typeof e != "string" && (n = e, e = t), e = e || "fx";
				while (u--)(r = v._data(o[u], e + "queueHooks")) && r.empty && (i++, r.empty.add(a));
				return a(), s.promise(n)
			}
		});
		var j, F, I, q = /[\t\r\n]/g, R = /\r/g, U = /^(?:button|input)$/i, z = /^(?:button|input|object|select|textarea)$/i, W = /^a(?:rea|)$/i, X = /^(?:autofocus|autoplay|async|checked|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped|selected)$/i, V = v.support.getSetAttribute;
		v.fn.extend({
			attr: function (e, t) {
				return v.access(this, v.attr, e, t, arguments.length > 1)
			}, removeAttr: function (e) {
				return this.each(function () {
					v.removeAttr(this, e)
				})
			}, prop: function (e, t) {
				return v.access(this, v.prop, e, t, arguments.length > 1)
			}, removeProp: function (e) {
				return e = v.propFix[e] || e, this.each(function () {
					try {
						this[e] = t, delete this[e]
					} catch (n) {
					}
				})
			}, addClass: function (e) {
				var t, n, r, i, s, o, u;
				if (v.isFunction(e))return this.each(function (t) {
					v(this).addClass(e.call(this, t, this.className))
				});
				if (e && typeof e == "string") {
					t = e.split(y);
					for (n = 0, r = this.length; n < r; n++) {
						i = this[n];
						if (i.nodeType === 1)if (!i.className && t.length === 1)i.className = e; else {
							s = " " + i.className + " ";
							for (o = 0, u = t.length; o < u; o++)~s.indexOf(" " + t[o] + " ") || (s += t[o] + " ");
							i.className = v.trim(s)
						}
					}
				}
				return this
			}, removeClass: function (e) {
				var n, r, i, s, o, u, a;
				if (v.isFunction(e))return this.each(function (t) {
					v(this).removeClass(e.call(this, t, this.className))
				});
				if (e && typeof e == "string" || e === t) {
					n = (e || "").split(y);
					for (u = 0, a = this.length; u < a; u++) {
						i = this[u];
						if (i.nodeType === 1 && i.className) {
							r = (" " + i.className + " ").replace(q, " ");
							for (s = 0, o = n.length; s < o; s++)while (r.indexOf(" " + n[s] + " ") > -1)r = r.replace(" " + n[s] + " ", " ");
							i.className = e ? v.trim(r) : ""
						}
					}
				}
				return this
			}, toggleClass: function (e, t) {
				var n = typeof e, r = typeof t == "boolean";
				return v.isFunction(e) ? this.each(function (n) {
					v(this).toggleClass(e.call(this, n, this.className, t), t)
				}) : this.each(function () {
					if (n === "string") {
						var i, s = 0, o = v(this), u = t, a = e.split(y);
						while (i = a[s++])u = r ? u : !o.hasClass(i), o[u ? "addClass" : "removeClass"](i)
					} else if (n === "undefined" || n === "boolean")this.className && v._data(this, "__className__", this.className), this.className = this.className || e === !1 ? "" : v._data(this, "__className__") || ""
				})
			}, hasClass: function (e) {
				var t = " " + e + " ", n = 0, r = this.length;
				for (; n < r; n++)if (this[n].nodeType === 1 && (" " + this[n].className + " ").replace(q, " ").indexOf(t) > -1)return !0;
				return !1
			}, val: function (e) {
				var n, r, i, s = this[0];
				if (!arguments.length) {
					if (s)return n = v.valHooks[s.type] || v.valHooks[s.nodeName.toLowerCase()], n && "get"in n && (r = n.get(s, "value")) !== t ? r : (r = s.value, typeof r == "string" ? r.replace(R, "") : r == null ? "" : r);
					return
				}
				return i = v.isFunction(e), this.each(function (r) {
					var s, o = v(this);
					if (this.nodeType !== 1)return;
					i ? s = e.call(this, r, o.val()) : s = e, s == null ? s = "" : typeof s == "number" ? s += "" : v.isArray(s) && (s = v.map(s, function (e) {
						return e == null ? "" : e + ""
					})), n = v.valHooks[this.type] || v.valHooks[this.nodeName.toLowerCase()];
					if (!n || !("set"in n) || n.set(this, s, "value") === t)this.value = s
				})
			}
		}), v.extend({
			valHooks: {
				option: {
					get: function (e) {
						var t = e.attributes.value;
						return !t || t.specified ? e.value : e.text
					}
				}, select: {
					get: function (e) {
						var t, n, r, i, s = e.selectedIndex, o = [], u = e.options, a = e.type === "select-one";
						if (s < 0)return null;
						n = a ? s : 0, r = a ? s + 1 : u.length;
						for (; n < r; n++) {
							i = u[n];
							if (i.selected && (v.support.optDisabled ? !i.disabled : i.getAttribute("disabled") === null) && (!i.parentNode.disabled || !v.nodeName(i.parentNode, "optgroup"))) {
								t = v(i).val();
								if (a)return t;
								o.push(t)
							}
						}
						return a && !o.length && u.length ? v(u[s]).val() : o
					}, set: function (e, t) {
						var n = v.makeArray(t);
						return v(e).find("option").each(function () {
							this.selected = v.inArray(v(this).val(), n) >= 0
						}), n.length || (e.selectedIndex = -1), n
					}
				}
			},
			attrFn: {},
			attr: function (e, n, r, i) {
				var s, o, u, a = e.nodeType;
				if (!e || a === 3 || a === 8 || a === 2)return;
				if (i && v.isFunction(v.fn[n]))return v(e)[n](r);
				if (typeof e.getAttribute == "undefined")return v.prop(e, n, r);
				u = a !== 1 || !v.isXMLDoc(e), u && (n = n.toLowerCase(), o = v.attrHooks[n] || (X.test(n) ? F : j));
				if (r !== t) {
					if (r === null) {
						v.removeAttr(e, n);
						return
					}
					return o && "set"in o && u && (s = o.set(e, r, n)) !== t ? s : (e.setAttribute(n, "" + r), r)
				}
				return o && "get"in o && u && (s = o.get(e, n)) !== null ? s : (s = e.getAttribute(n), s === null ? t : s)
			},
			removeAttr: function (e, t) {
				var n, r, i, s, o = 0;
				if (t && e.nodeType === 1) {
					r = t.split(y);
					for (; o < r.length; o++)i = r[o], i && (n = v.propFix[i] || i, s = X.test(i), s || v.attr(e, i, ""), e.removeAttribute(V ? i : n), s && n in e && (e[n] = !1))
				}
			},
			attrHooks: {
				type: {
					set: function (e, t) {
						if (U.test(e.nodeName) && e.parentNode)v.error("type property can't be changed"); else if (!v.support.radioValue && t === "radio" && v.nodeName(e, "input")) {
							var n = e.value;
							return e.setAttribute("type", t), n && (e.value = n), t
						}
					}
				}, value: {
					get: function (e, t) {
						return j && v.nodeName(e, "button") ? j.get(e, t) : t in e ? e.value : null
					}, set: function (e, t, n) {
						if (j && v.nodeName(e, "button"))return j.set(e, t, n);
						e.value = t
					}
				}
			},
			propFix: {
				tabindex: "tabIndex",
				readonly: "readOnly",
				"for": "htmlFor",
				"class": "className",
				maxlength: "maxLength",
				cellspacing: "cellSpacing",
				cellpadding: "cellPadding",
				rowspan: "rowSpan",
				colspan: "colSpan",
				usemap: "useMap",
				frameborder: "frameBorder",
				contenteditable: "contentEditable"
			},
			prop: function (e, n, r) {
				var i, s, o, u = e.nodeType;
				if (!e || u === 3 || u === 8 || u === 2)return;
				return o = u !== 1 || !v.isXMLDoc(e), o && (n = v.propFix[n] || n, s = v.propHooks[n]), r !== t ? s && "set"in s && (i = s.set(e, r, n)) !== t ? i : e[n] = r : s && "get"in s && (i = s.get(e, n)) !== null ? i : e[n]
			},
			propHooks: {
				tabIndex: {
					get: function (e) {
						var n = e.getAttributeNode("tabindex");
						return n && n.specified ? parseInt(n.value, 10) : z.test(e.nodeName) || W.test(e.nodeName) && e.href ? 0 : t
					}
				}
			}
		}), F = {
			get: function (e, n) {
				var r, i = v.prop(e, n);
				return i === !0 || typeof i != "boolean" && (r = e.getAttributeNode(n)) && r.nodeValue !== !1 ? n.toLowerCase() : t
			}, set: function (e, t, n) {
				var r;
				return t === !1 ? v.removeAttr(e, n) : (r = v.propFix[n] || n, r in e && (e[r] = !0), e.setAttribute(n, n.toLowerCase())), n
			}
		}, V || (I = {name: !0, id: !0, coords: !0}, j = v.valHooks.button = {
			get: function (e, n) {
				var r;
				return r = e.getAttributeNode(n), r && (I[n] ? r.value !== "" : r.specified) ? r.value : t
			}, set: function (e, t, n) {
				var r = e.getAttributeNode(n);
				return r || (r = i.createAttribute(n), e.setAttributeNode(r)), r.value = t + ""
			}
		}, v.each(["width", "height"], function (e, t) {
			v.attrHooks[t] = v.extend(v.attrHooks[t], {
				set: function (e, n) {
					if (n === "")return e.setAttribute(t, "auto"), n
				}
			})
		}), v.attrHooks.contenteditable = {
			get: j.get, set: function (e, t, n) {
				t === "" && (t = "false"), j.set(e, t, n)
			}
		}), v.support.hrefNormalized || v.each(["href", "src", "width", "height"], function (e, n) {
			v.attrHooks[n] = v.extend(v.attrHooks[n], {
				get: function (e) {
					var r = e.getAttribute(n, 2);
					return r === null ? t : r
				}
			})
		}), v.support.style || (v.attrHooks.style = {
			get: function (e) {
				return e.style.cssText.toLowerCase() || t
			}, set: function (e, t) {
				return e.style.cssText = "" + t
			}
		}), v.support.optSelected || (v.propHooks.selected = v.extend(v.propHooks.selected, {
			get: function (e) {
				var t = e.parentNode;
				return t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex), null
			}
		})), v.support.enctype || (v.propFix.enctype = "encoding"), v.support.checkOn || v.each(["radio", "checkbox"], function () {
			v.valHooks[this] = {
				get: function (e) {
					return e.getAttribute("value") === null ? "on" : e.value
				}
			}
		}), v.each(["radio", "checkbox"], function () {
			v.valHooks[this] = v.extend(v.valHooks[this], {
				set: function (e, t) {
					if (v.isArray(t))return e.checked = v.inArray(v(e).val(), t) >= 0
				}
			})
		});
		var $ = /^(?:textarea|input|select)$/i, J = /^([^\.]*|)(?:\.(.+)|)$/, K = /(?:^|\s)hover(\.\S+|)\b/, Q = /^key/, G = /^(?:mouse|contextmenu)|click/, Y = /^(?:focusinfocus|focusoutblur)$/, Z = function (e) {
			return v.event.special.hover ? e : e.replace(K, "mouseenter$1 mouseleave$1")
		};
		v.event = {
			add: function (e, n, r, i, s) {
				var o, u, a, f, l, c, h, p, d, m, g;
				if (e.nodeType === 3 || e.nodeType === 8 || !n || !r || !(o = v._data(e)))return;
				r.handler && (d = r, r = d.handler, s = d.selector), r.guid || (r.guid = v.guid++), a = o.events, a || (o.events = a = {}), u = o.handle, u || (o.handle = u = function (e) {
					return typeof v == "undefined" || !!e && v.event.triggered === e.type ? t : v.event.dispatch.apply(u.elem, arguments)
				}, u.elem = e), n = v.trim(Z(n)).split(" ");
				for (f = 0; f < n.length; f++) {
					l = J.exec(n[f]) || [], c = l[1], h = (l[2] || "").split(".").sort(), g = v.event.special[c] || {}, c = (s ? g.delegateType : g.bindType) || c, g = v.event.special[c] || {}, p = v.extend({
						type: c,
						origType: l[1],
						data: i,
						handler: r,
						guid: r.guid,
						selector: s,
						namespace: h.join(".")
					}, d), m = a[c];
					if (!m) {
						m = a[c] = [], m.delegateCount = 0;
						if (!g.setup || g.setup.call(e, i, h, u) === !1)e.addEventListener ? e.addEventListener(c, u, !1) : e.attachEvent && e.attachEvent("on" + c, u)
					}
					g.add && (g.add.call(e, p), p.handler.guid || (p.handler.guid = r.guid)), s ? m.splice(m.delegateCount++, 0, p) : m.push(p), v.event.global[c] = !0
				}
				e = null
			},
			global: {},
			remove: function (e, t, n, r, i) {
				var s, o, u, a, f, l, c, h, p, d, m, g = v.hasData(e) && v._data(e);
				if (!g || !(h = g.events))return;
				t = v.trim(Z(t || "")).split(" ");
				for (s = 0; s < t.length; s++) {
					o = J.exec(t[s]) || [], u = a = o[1], f = o[2];
					if (!u) {
						for (u in h)v.event.remove(e, u + t[s], n, r, !0);
						continue
					}
					p = v.event.special[u] || {}, u = (r ? p.delegateType : p.bindType) || u, d = h[u] || [], l = d.length, f = f ? new RegExp("(^|\\.)" + f.split(".").sort().join("\\.(?:.*\\.|)") + "(\\.|$)") : null;
					for (c = 0; c < d.length; c++)m = d[c], (i || a === m.origType) && (!n || n.guid === m.guid) && (!f || f.test(m.namespace)) && (!r || r === m.selector || r === "**" && m.selector) && (d.splice(c--, 1), m.selector && d.delegateCount--, p.remove && p.remove.call(e, m));
					d.length === 0 && l !== d.length && ((!p.teardown || p.teardown.call(e, f, g.handle) === !1) && v.removeEvent(e, u, g.handle), delete h[u])
				}
				v.isEmptyObject(h) && (delete g.handle, v.removeData(e, "events", !0))
			},
			customEvent: {getData: !0, setData: !0, changeData: !0},
			trigger: function (n, r, s, o) {
				if (!s || s.nodeType !== 3 && s.nodeType !== 8) {
					var u, a, f, l, c, h, p, d, m, g, y = n.type || n, b = [];
					if (Y.test(y + v.event.triggered))return;
					y.indexOf("!") >= 0 && (y = y.slice(0, -1), a = !0), y.indexOf(".") >= 0 && (b = y.split("."), y = b.shift(), b.sort());
					if ((!s || v.event.customEvent[y]) && !v.event.global[y])return;
					n = typeof n == "object" ? n[v.expando] ? n : new v.Event(y, n) : new v.Event(y), n.type = y, n.isTrigger = !0, n.exclusive = a, n.namespace = b.join("."), n.namespace_re = n.namespace ? new RegExp("(^|\\.)" + b.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, h = y.indexOf(":") < 0 ? "on" + y : "";
					if (!s) {
						u = v.cache;
						for (f in u)u[f].events && u[f].events[y] && v.event.trigger(n, r, u[f].handle.elem, !0);
						return
					}
					n.result = t, n.target || (n.target = s), r = r != null ? v.makeArray(r) : [], r.unshift(n), p = v.event.special[y] || {};
					if (p.trigger && p.trigger.apply(s, r) === !1)return;
					m = [[s, p.bindType || y]];
					if (!o && !p.noBubble && !v.isWindow(s)) {
						g = p.delegateType || y, l = Y.test(g + y) ? s : s.parentNode;
						for (c = s; l; l = l.parentNode)m.push([l, g]), c = l;
						c === (s.ownerDocument || i) && m.push([c.defaultView || c.parentWindow || e, g])
					}
					for (f = 0; f < m.length && !n.isPropagationStopped(); f++)l = m[f][0], n.type = m[f][1], d = (v._data(l, "events") || {})[n.type] && v._data(l, "handle"), d && d.apply(l, r), d = h && l[h], d && v.acceptData(l) && d.apply(l, r) === !1 && n.preventDefault();
					return n.type = y, !o && !n.isDefaultPrevented() && (!p._default || p._default.apply(s.ownerDocument, r) === !1) && (y !== "click" || !v.nodeName(s, "a")) && v.acceptData(s) && h && s[y] && (y !== "focus" && y !== "blur" || n.target.offsetWidth !== 0) && !v.isWindow(s) && (c = s[h], c && (s[h] = null), v.event.triggered = y, s[y](), v.event.triggered = t, c && (s[h] = c)), n.result
				}
				return
			},
			dispatch: function (n) {
				n = v.event.fix(n || e.event);
				var r, i, s, o, u, a, f, l, c, h, p, d = (v._data(this, "events") || {})[n.type] || [], m = d.delegateCount, g = [].slice.call(arguments), y = !n.exclusive && !n.namespace, b = v.event.special[n.type] || {}, w = [];
				g[0] = n, n.delegateTarget = this;
				if (b.preDispatch && b.preDispatch.call(this, n) === !1)return;
				if (m && (!n.button || n.type !== "click")) {
					o = v(this), o.context = this;
					for (s = n.target; s != this; s = s.parentNode || this)if (s.disabled !== !0 || n.type !== "click") {
						a = {}, l = [], o[0] = s;
						for (r = 0; r < m; r++)c = d[r], h = c.selector, a[h] === t && (a[h] = o.is(h)), a[h] && l.push(c);
						l.length && w.push({elem: s, matches: l})
					}
				}
				d.length > m && w.push({elem: this, matches: d.slice(m)});
				for (r = 0; r < w.length && !n.isPropagationStopped(); r++) {
					f = w[r], n.currentTarget = f.elem;
					for (i = 0; i < f.matches.length && !n.isImmediatePropagationStopped(); i++) {
						c = f.matches[i];
						if (y || !n.namespace && !c.namespace || n.namespace_re && n.namespace_re.test(c.namespace))n.data = c.data, n.handleObj = c, u = ((v.event.special[c.origType] || {}).handle || c.handler).apply(f.elem, g), u !== t && (n.result = u, u === !1 && (n.preventDefault(), n.stopPropagation()))
					}
				}
				return b.postDispatch && b.postDispatch.call(this, n), n.result
			},
			props: "attrChange attrName relatedNode srcElement altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
			fixHooks: {},
			keyHooks: {
				props: "char charCode key keyCode".split(" "), filter: function (e, t) {
					return e.which == null && (e.which = t.charCode != null ? t.charCode : t.keyCode), e
				}
			},
			mouseHooks: {
				props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
				filter: function (e, n) {
					var r, s, o, u = n.button, a = n.fromElement;
					return e.pageX == null && n.clientX != null && (r = e.target.ownerDocument || i, s = r.documentElement, o = r.body, e.pageX = n.clientX + (s && s.scrollLeft || o && o.scrollLeft || 0) - (s && s.clientLeft || o && o.clientLeft || 0), e.pageY = n.clientY + (s && s.scrollTop || o && o.scrollTop || 0) - (s && s.clientTop || o && o.clientTop || 0)), !e.relatedTarget && a && (e.relatedTarget = a === e.target ? n.toElement : a), !e.which && u !== t && (e.which = u & 1 ? 1 : u & 2 ? 3 : u & 4 ? 2 : 0), e
				}
			},
			fix: function (e) {
				if (e[v.expando])return e;
				var t, n, r = e, s = v.event.fixHooks[e.type] || {}, o = s.props ? this.props.concat(s.props) : this.props;
				e = v.Event(r);
				for (t = o.length; t;)n = o[--t], e[n] = r[n];
				return e.target || (e.target = r.srcElement || i), e.target.nodeType === 3 && (e.target = e.target.parentNode), e.metaKey = !!e.metaKey, s.filter ? s.filter(e, r) : e
			},
			special: {
				ready: {setup: v.bindReady},
				load: {noBubble: !0},
				focus: {delegateType: "focusin"},
				blur: {delegateType: "focusout"},
				beforeunload: {
					setup: function (e, t, n) {
						v.isWindow(this) && (this.onbeforeunload = n)
					}, teardown: function (e, t) {
						this.onbeforeunload === t && (this.onbeforeunload = null)
					}
				}
			},
			simulate: function (e, t, n, r) {
				var i = v.extend(new v.Event, n, {type: e, isSimulated: !0, originalEvent: {}});
				r ? v.event.trigger(i, null, t) : v.event.dispatch.call(t, i), i.isDefaultPrevented() && n.preventDefault()
			}
		}, v.event.handle = v.event.dispatch, v.removeEvent = i.removeEventListener ? function (e, t, n) {
			e.removeEventListener && e.removeEventListener(t, n, !1)
		} : function (e, t, n) {
			var r = "on" + t;
			e.detachEvent && (typeof e[r] == "undefined" && (e[r] = null), e.detachEvent(r, n))
		}, v.Event = function (e, t) {
			if (!(this instanceof v.Event))return new v.Event(e, t);
			e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || e.returnValue === !1 || e.getPreventDefault && e.getPreventDefault() ? tt : et) : this.type = e, t && v.extend(this, t), this.timeStamp = e && e.timeStamp || v.now(), this[v.expando] = !0
		}, v.Event.prototype = {
			preventDefault: function () {
				this.isDefaultPrevented = tt;
				var e = this.originalEvent;
				if (!e)return;
				e.preventDefault ? e.preventDefault() : e.returnValue = !1
			}, stopPropagation: function () {
				this.isPropagationStopped = tt;
				var e = this.originalEvent;
				if (!e)return;
				e.stopPropagation && e.stopPropagation(), e.cancelBubble = !0
			}, stopImmediatePropagation: function () {
				this.isImmediatePropagationStopped = tt, this.stopPropagation()
			}, isDefaultPrevented: et, isPropagationStopped: et, isImmediatePropagationStopped: et
		}, v.each({mouseenter: "mouseover", mouseleave: "mouseout"}, function (e, t) {
			v.event.special[e] = {
				delegateType: t, bindType: t, handle: function (e) {
					var n, r = this, i = e.relatedTarget, s = e.handleObj, o = s.selector;
					if (!i || i !== r && !v.contains(r, i))e.type = s.origType, n = s.handler.apply(this, arguments), e.type = t;
					return n
				}
			}
		}), v.support.submitBubbles || (v.event.special.submit = {
			setup: function () {
				if (v.nodeName(this, "form"))return !1;
				v.event.add(this, "click._submit keypress._submit", function (e) {
					var n = e.target, r = v.nodeName(n, "input") || v.nodeName(n, "button") ? n.form : t;
					r && !v._data(r, "_submit_attached") && (v.event.add(r, "submit._submit", function (e) {
						e._submit_bubble = !0
					}), v._data(r, "_submit_attached", !0))
				})
			}, postDispatch: function (e) {
				e._submit_bubble && (delete e._submit_bubble, this.parentNode && !e.isTrigger && v.event.simulate("submit", this.parentNode, e, !0))
			}, teardown: function () {
				if (v.nodeName(this, "form"))return !1;
				v.event.remove(this, "._submit")
			}
		}), v.support.changeBubbles || (v.event.special.change = {
			setup: function () {
				if ($.test(this.nodeName)) {
					if (this.type === "checkbox" || this.type === "radio")v.event.add(this, "propertychange._change", function (e) {
						e.originalEvent.propertyName === "checked" && (this._just_changed = !0)
					}), v.event.add(this, "click._change", function (e) {
						this._just_changed && !e.isTrigger && (this._just_changed = !1), v.event.simulate("change", this, e, !0)
					});
					return !1
				}
				v.event.add(this, "beforeactivate._change", function (e) {
					var t = e.target;
					$.test(t.nodeName) && !v._data(t, "_change_attached") && (v.event.add(t, "change._change", function (e) {
						this.parentNode && !e.isSimulated && !e.isTrigger && v.event.simulate("change", this.parentNode, e, !0)
					}), v._data(t, "_change_attached", !0))
				})
			}, handle: function (e) {
				var t = e.target;
				if (this !== t || e.isSimulated || e.isTrigger || t.type !== "radio" && t.type !== "checkbox")return e.handleObj.handler.apply(this, arguments)
			}, teardown: function () {
				return v.event.remove(this, "._change"), $.test(this.nodeName)
			}
		}), v.support.focusinBubbles || v.each({focus: "focusin", blur: "focusout"}, function (e, t) {
			var n = 0, r = function (e) {
				v.event.simulate(t, e.target, v.event.fix(e), !0)
			};
			v.event.special[t] = {
				setup: function () {
					n++ === 0 && i.addEventListener(e, r, !0)
				}, teardown: function () {
					--n === 0 && i.removeEventListener(e, r, !0)
				}
			}
		}), v.fn.extend({
			on: function (e, n, r, i, s) {
				var o, u;
				if (typeof e == "object") {
					typeof n != "string" && (r = r || n, n = t);
					for (u in e)this.on(u, n, r, e[u], s);
					return this
				}
				r == null && i == null ? (i = n, r = n = t) : i == null && (typeof n == "string" ? (i = r, r = t) : (i = r, r = n, n = t));
				if (i === !1)i = et; else if (!i)return this;
				return s === 1 && (o = i, i = function (e) {
					return v().off(e), o.apply(this, arguments)
				}, i.guid = o.guid || (o.guid = v.guid++)), this.each(function () {
					v.event.add(this, e, i, r, n)
				})
			}, one: function (e, t, n, r) {
				return this.on(e, t, n, r, 1)
			}, off: function (e, n, r) {
				var i, s;
				if (e && e.preventDefault && e.handleObj)return i = e.handleObj, v(e.delegateTarget).off(i.namespace ? i.origType + "." + i.namespace : i.origType, i.selector, i.handler), this;
				if (typeof e == "object") {
					for (s in e)this.off(s, n, e[s]);
					return this
				}
				if (n === !1 || typeof n == "function")r = n, n = t;
				return r === !1 && (r = et), this.each(function () {
					v.event.remove(this, e, r, n)
				})
			}, bind: function (e, t, n) {
				return this.on(e, null, t, n)
			}, unbind: function (e, t) {
				return this.off(e, null, t)
			}, live: function (e, t, n) {
				return v(this.context).on(e, this.selector, t, n), this
			}, die: function (e, t) {
				return v(this.context).off(e, this.selector || "**", t), this
			}, delegate: function (e, t, n, r) {
				return this.on(t, e, n, r)
			}, undelegate: function (e, t, n) {
				return arguments.length == 1 ? this.off(e, "**") : this.off(t, e || "**", n)
			}, trigger: function (e, t) {
				return this.each(function () {
					v.event.trigger(e, t, this)
				})
			}, triggerHandler: function (e, t) {
				if (this[0])return v.event.trigger(e, t, this[0], !0)
			}, toggle: function (e) {
				var t = arguments, n = e.guid || v.guid++, r = 0, i = function (n) {
					var i = (v._data(this, "lastToggle" + e.guid) || 0) % r;
					return v._data(this, "lastToggle" + e.guid, i + 1), n.preventDefault(), t[i].apply(this, arguments) || !1
				};
				i.guid = n;
				while (r < t.length)t[r++].guid = n;
				return this.click(i)
			}, hover: function (e, t) {
				return this.mouseenter(e).mouseleave(t || e)
			}
		}), v.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function (e, t) {
			v.fn[t] = function (e, n) {
				return n == null && (n = e, e = null), arguments.length > 0 ? this.on(t, null, e, n) : this.trigger(t)
			}, Q.test(t) && (v.event.fixHooks[t] = v.event.keyHooks), G.test(t) && (v.event.fixHooks[t] = v.event.mouseHooks)
		}), function (e, t) {
			function Y(e, t, n, r) {
				n = n || [], t = t || m;
				var i, s, o, f, l = t.nodeType;
				if (l !== 1 && l !== 9)return [];
				if (!e || typeof e != "string")return n;
				o = u(t);
				if (!o && !r)if (i = j.exec(e))if (f = i[1]) {
					if (l === 9) {
						s = t.getElementById(f);
						if (!s || !s.parentNode)return n;
						if (s.id === f)return n.push(s), n
					} else if (t.ownerDocument && (s = t.ownerDocument.getElementById(f)) && a(t, s) && s.id === f)return n.push(s), n
				} else {
					if (i[2])return w.apply(n, b.call(t.getElementsByTagName(e), 0)), n;
					if ((f = i[3]) && K && t.getElementsByClassName)return w.apply(n, b.call(t.getElementsByClassName(f), 0)), n
				}
				return lt(e, t, n, r, o)
			}

			function Z(e) {
				return function (t) {
					var n = t.nodeName.toLowerCase();
					return n === "input" && t.type === e
				}
			}

			function et(e) {
				return function (t) {
					var n = t.nodeName.toLowerCase();
					return (n === "input" || n === "button") && t.type === e
				}
			}

			function tt(e, t, n) {
				if (e === t)return n;
				var r = e.nextSibling;
				while (r) {
					if (r === t)return -1;
					r = r.nextSibling
				}
				return 1
			}

			function nt(e, t, n, r) {
				var i, o, u, a, f, l, c, h, p, v, g = !n && t !== m, y = (g ? "<s>" : "") + e.replace(D, "$1<s>"), w = T[d][y];
				if (w)return r ? 0 : b.call(w, 0);
				f = e, l = [], h = 0, p = s.preFilter, v = s.filter;
				while (f) {
					if (!i || (o = P.exec(f)))o && (f = f.slice(o[0].length), u.selector = c), l.push(u = []), c = "", g && (f = " " + f);
					i = !1;
					if (o = H.exec(f))c += o[0], f = f.slice(o[0].length), i = u.push({
						part: o.pop().replace(D, " "),
						string: o[0],
						captures: o
					});
					for (a in v)(o = W[a].exec(f)) && (!p[a] || (o = p[a](o, t, n))) && (c += o[0], f = f.slice(o[0].length), i = u.push({
						part: a,
						string: o.shift(),
						captures: o
					}));
					if (!i)break
				}
				return c && (u.selector = c), r ? f.length : f ? Y.error(e) : b.call(T(y, l), 0)
			}

			function rt(e, t, i, s) {
				var o = t.dir, u = y++;
				return e || (e = function (e) {
					return e === i
				}), t.first ? function (t) {
					while (t = t[o])if (t.nodeType === 1)return e(t) && t
				} : s ? function (t) {
					while (t = t[o])if (t.nodeType === 1 && e(t))return t
				} : function (t) {
					var i, s = u + "." + n, a = s + "." + r;
					while (t = t[o])if (t.nodeType === 1) {
						if ((i = t[d]) === a)return t.sizset;
						if (typeof i == "string" && i.indexOf(s) === 0) {
							if (t.sizset)return t
						} else {
							t[d] = a;
							if (e(t))return t.sizset = !0, t;
							t.sizset = !1
						}
					}
				}
			}

			function it(e, t) {
				return e ? function (n) {
					var r = t(n);
					return r && e(r === !0 ? n : r)
				} : t
			}

			function st(e, t, n) {
				var r, i, o = 0;
				for (; r = e[o]; o++)s.relative[r.part] ? i = rt(i, s.relative[r.part], t, n) : i = it(i, s.filter[r.part].apply(null, r.captures.concat(t, n)));
				return i
			}

			function ot(e) {
				return function (t) {
					var n, r = 0;
					for (; n = e[r]; r++)if (n(t))return !0;
					return !1
				}
			}

			function ut(e, t, n, r) {
				var i = 0, s = t.length;
				for (; i < s; i++)Y(e, t[i], n, r)
			}

			function at(e, t, n, r, i, o) {
				var u, a = s.setFilters[t.toLowerCase()];
				return a || Y.error(t), (e || !(u = i)) && ut(e || "*", r, u = [], i), u.length > 0 ? a(u, n, o) : []
			}

			function ft(e, n, r, i) {
				var s, o, u, a, f, l, c, h, p, d, v, m, g, y = 0, b = e.length, E = W.POS, S = new RegExp("^" + E.source + "(?!" + C + ")", "i"), x = function () {
					var e = 1, n = arguments.length - 2;
					for (; e < n; e++)arguments[e] === t && (p[e] = t)
				};
				for (; y < b; y++) {
					s = e[y], o = "", h = i;
					for (u = 0, a = s.length; u < a; u++) {
						f = s[u], l = f.string;
						if (f.part === "PSEUDO") {
							E.exec(""), c = 0;
							while (p = E.exec(l)) {
								d = !0, v = E.lastIndex = p.index + p[0].length;
								if (v > c) {
									o += l.slice(c, p.index), c = v, m = [n], H.test(o) && (h && (m = h), h = i);
									if (g = q.test(o))o = o.slice(0, -5).replace(H, "$&*"), c++;
									p.length > 1 && p[0].replace(S, x), h = at(o, p[1], p[2], m, h, g)
								}
								o = ""
							}
						}
						d || (o += l), d = !1
					}
					o ? H.test(o) ? ut(o, h || [n], r, i) : Y(o, n, r, i ? i.concat(h) : h) : w.apply(r, h)
				}
				return b === 1 ? r : Y.uniqueSort(r)
			}

			function lt(e, t, i, o, u) {
				e = e.replace(D, "$1");
				var a, l, c, h, p, d, v, m, g, y, E = nt(e, t, u), S = t.nodeType;
				if (W.POS.test(e))return ft(E, t, i, o);
				if (o)a = b.call(o, 0); else if (E.length === 1) {
					if ((d = b.call(E[0], 0)).length > 2 && (v = d[0]).part === "ID" && S === 9 && !u && s.relative[d[1].part]) {
						t = s.find.ID(v.captures[0].replace(z, ""), t, u)[0];
						if (!t)return i;
						e = e.slice(d.shift().string.length)
					}
					g = (E = I.exec(d[0].string)) && !E.index && t.parentNode || t, m = "";
					for (p = d.length - 1; p >= 0; p--) {
						v = d[p], y = v.part, m = v.string + m;
						if (s.relative[y])break;
						if (s.order.test(y)) {
							a = s.find[y](v.captures[0].replace(z, ""), g, u);
							if (a == null)continue;
							e = e.slice(0, e.length - m.length) + m.replace(W[y], ""), e || w.apply(i, b.call(a, 0));
							break
						}
					}
				}
				if (e) {
					l = f(e, t, u), n = l.dirruns++, a == null && (a = s.find.TAG("*", I.test(e) && t.parentNode || t));
					for (p = 0; h = a[p]; p++)r = l.runs++, l(h) && i.push(h)
				}
				return i
			}

			var n, r, i, s, o, u, a, f, l, c, h = !0, p = "undefined", d = ("sizcache" + Math.random()).replace(".", ""), m = e.document, g = m.documentElement, y = 0, b = [].slice, w = [].push, E = function (e, t) {
				return e[d] = t || !0, e
			}, S = function () {
				var e = {}, t = [];
				return E(function (n, r) {
					return t.push(n) > s.cacheLength && delete e[t.shift()], e[n] = r
				}, e)
			}, x = S(), T = S(), N = S(), C = "[\\x20\\t\\r\\n\\f]", k = "(?:\\\\.|[-\\w]|[^\\x00-\\xa0])+", L = k.replace("w", "w#"), A = "([*^$|!~]?=)", O = "\\[" + C + "*(" + k + ")" + C + "*(?:" + A + C + "*(?:(['\"])((?:\\\\.|[^\\\\])*?)\\3|(" + L + ")|)|)" + C + "*\\]", M = ":(" + k + ")(?:\\((?:(['\"])((?:\\\\.|[^\\\\])*?)\\2|([^()[\\]]*|(?:(?:" + O + ")|[^:]|\\\\.)*|.*))\\)|)", _ = ":(nth|eq|gt|lt|first|last|even|odd)(?:\\(((?:-\\d)?\\d*)\\)|)(?=[^-]|$)", D = new RegExp("^" + C + "+|((?:^|[^\\\\])(?:\\\\.)*)" + C + "+$", "g"), P = new RegExp("^" + C + "*," + C + "*"), H = new RegExp("^" + C + "*([\\x20\\t\\r\\n\\f>+~])" + C + "*"), B = new RegExp(M), j = /^(?:#([\w\-]+)|(\w+)|\.([\w\-]+))$/, F = /^:not/, I = /[\x20\t\r\n\f]*[+~]/, q = /:not\($/, R = /h\d/i, U = /input|select|textarea|button/i, z = /\\(?!\\)/g, W = {
				ID: new RegExp("^#(" + k + ")"),
				CLASS: new RegExp("^\\.(" + k + ")"),
				NAME: new RegExp("^\\[name=['\"]?(" + k + ")['\"]?\\]"),
				TAG: new RegExp("^(" + k.replace("w", "w*") + ")"),
				ATTR: new RegExp("^" + O),
				PSEUDO: new RegExp("^" + M),
				CHILD: new RegExp("^:(only|nth|last|first)-child(?:\\(" + C + "*(even|odd|(([+-]|)(\\d*)n|)" + C + "*(?:([+-]|)" + C + "*(\\d+)|))" + C + "*\\)|)", "i"),
				POS: new RegExp(_, "ig"),
				needsContext: new RegExp("^" + C + "*[>+~]|" + _, "i")
			}, X = function (e) {
				var t = m.createElement("div");
				try {
					return e(t)
				} catch (n) {
					return !1
				} finally {
					t = null
				}
			}, V = X(function (e) {
				return e.appendChild(m.createComment("")), !e.getElementsByTagName("*").length
			}), $ = X(function (e) {
				return e.innerHTML = "<a href='#'></a>", e.firstChild && typeof e.firstChild.getAttribute !== p && e.firstChild.getAttribute("href") === "#"
			}), J = X(function (e) {
				e.innerHTML = "<select></select>";
				var t = typeof e.lastChild.getAttribute("multiple");
				return t !== "boolean" && t !== "string"
			}), K = X(function (e) {
				return e.innerHTML = "<div class='hidden e'></div><div class='hidden'></div>", !e.getElementsByClassName || !e.getElementsByClassName("e").length ? !1 : (e.lastChild.className = "e", e.getElementsByClassName("e").length === 2)
			}), Q = X(function (e) {
				e.id = d + 0, e.innerHTML = "<a name='" + d + "'></a><div name='" + d + "'></div>", g.insertBefore(e, g.firstChild);
				var t = m.getElementsByName && m.getElementsByName(d).length === 2 + m.getElementsByName(d + 0).length;
				return i = !m.getElementById(d), g.removeChild(e), t
			});
			try {
				b.call(g.childNodes, 0)[0].nodeType
			} catch (G) {
				b = function (e) {
					var t, n = [];
					for (; t = this[e]; e++)n.push(t);
					return n
				}
			}
			Y.matches = function (e, t) {
				return Y(e, null, null, t)
			}, Y.matchesSelector = function (e, t) {
				return Y(t, null, null, [e]).length > 0
			}, o = Y.getText = function (e) {
				var t, n = "", r = 0, i = e.nodeType;
				if (i) {
					if (i === 1 || i === 9 || i === 11) {
						if (typeof e.textContent == "string")return e.textContent;
						for (e = e.firstChild; e; e = e.nextSibling)n += o(e)
					} else if (i === 3 || i === 4)return e.nodeValue
				} else for (; t = e[r]; r++)n += o(t);
				return n
			}, u = Y.isXML = function (t) {
				var n = t && (t.ownerDocument || t).documentElement;
				return n ? n.nodeName !== "HTML" : !1
			}, a = Y.contains = g.contains ? function (e, t) {
				var n = e.nodeType === 9 ? e.documentElement : e, r = t && t.parentNode;
				return e === r || !!(r && r.nodeType === 1 && n.contains && n.contains(r))
			} : g.compareDocumentPosition ? function (e, t) {
				return t && !!(e.compareDocumentPosition(t) & 16)
			} : function (e, t) {
				while (t = t.parentNode)if (t === e)return !0;
				return !1
			}, Y.attr = function (e, t) {
				var n, r = u(e);
				return r || (t = t.toLowerCase()), s.attrHandle[t] ? s.attrHandle[t](e) : J || r ? e.getAttribute(t) : (n = e.getAttributeNode(t), n ? typeof e[t] == "boolean" ? e[t] ? t : null : n.specified ? n.value : null : null)
			}, s = Y.selectors = {
				cacheLength: 50,
				createPseudo: E,
				match: W,
				order: new RegExp("ID|TAG" + (Q ? "|NAME" : "") + (K ? "|CLASS" : "")),
				attrHandle: $ ? {} : {
					href: function (e) {
						return e.getAttribute("href", 2)
					}, type: function (e) {
						return e.getAttribute("type")
					}
				},
				find: {
					ID: i ? function (e, t, n) {
						if (typeof t.getElementById !== p && !n) {
							var r = t.getElementById(e);
							return r && r.parentNode ? [r] : []
						}
					} : function (e, n, r) {
						if (typeof n.getElementById !== p && !r) {
							var i = n.getElementById(e);
							return i ? i.id === e || typeof i.getAttributeNode !== p && i.getAttributeNode("id").value === e ? [i] : t : []
						}
					}, TAG: V ? function (e, t) {
						if (typeof t.getElementsByTagName !== p)return t.getElementsByTagName(e)
					} : function (e, t) {
						var n = t.getElementsByTagName(e);
						if (e === "*") {
							var r, i = [], s = 0;
							for (; r = n[s]; s++)r.nodeType === 1 && i.push(r);
							return i
						}
						return n
					}, NAME: function (e, t) {
						if (typeof t.getElementsByName !== p)return t.getElementsByName(name)
					}, CLASS: function (e, t, n) {
						if (typeof t.getElementsByClassName !== p && !n)return t.getElementsByClassName(e)
					}
				},
				relative: {
					">": {dir: "parentNode", first: !0},
					" ": {dir: "parentNode"},
					"+": {dir: "previousSibling", first: !0},
					"~": {dir: "previousSibling"}
				},
				preFilter: {
					ATTR: function (e) {
						return e[1] = e[1].replace(z, ""), e[3] = (e[4] || e[5] || "").replace(z, ""), e[2] === "~=" && (e[3] = " " + e[3] + " "), e.slice(0, 4)
					}, CHILD: function (e) {
						return e[1] = e[1].toLowerCase(), e[1] === "nth" ? (e[2] || Y.error(e[0]), e[3] = +(e[3] ? e[4] + (e[5] || 1) : 2 * (e[2] === "even" || e[2] === "odd")), e[4] = +(e[6] + e[7] || e[2] === "odd")) : e[2] && Y.error(e[0]), e
					}, PSEUDO: function (e, t, n) {
						var r, i;
						if (W.CHILD.test(e[0]))return null;
						if (e[3])e[2] = e[3]; else if (r = e[4])B.test(r) && (i = nt(r, t, n, !0)) && (i = r.indexOf(")", r.length - i) - r.length) && (r = r.slice(0, i), e[0] = e[0].slice(0, i)), e[2] = r;
						return e.slice(0, 3)
					}
				},
				filter: {
					ID: i ? function (e) {
						return e = e.replace(z, ""), function (t) {
							return t.getAttribute("id") === e
						}
					} : function (e) {
						return e = e.replace(z, ""), function (t) {
							var n = typeof t.getAttributeNode !== p && t.getAttributeNode("id");
							return n && n.value === e
						}
					}, TAG: function (e) {
						return e === "*" ? function () {
							return !0
						} : (e = e.replace(z, "").toLowerCase(), function (t) {
							return t.nodeName && t.nodeName.toLowerCase() === e
						})
					}, CLASS: function (e) {
						var t = x[d][e];
						return t || (t = x(e, new RegExp("(^|" + C + ")" + e + "(" + C + "|$)"))), function (e) {
							return t.test(e.className || typeof e.getAttribute !== p && e.getAttribute("class") || "")
						}
					}, ATTR: function (e, t, n) {
						return t ? function (r) {
							var i = Y.attr(r, e), s = i + "";
							if (i == null)return t === "!=";
							switch (t) {
								case"=":
									return s === n;
								case"!=":
									return s !== n;
								case"^=":
									return n && s.indexOf(n) === 0;
								case"*=":
									return n && s.indexOf(n) > -1;
								case"$=":
									return n && s.substr(s.length - n.length) === n;
								case"~=":
									return (" " + s + " ").indexOf(n) > -1;
								case"|=":
									return s === n || s.substr(0, n.length + 1) === n + "-"
							}
						} : function (t) {
							return Y.attr(t, e) != null
						}
					}, CHILD: function (e, t, n, r) {
						if (e === "nth") {
							var i = y++;
							return function (e) {
								var t, s, o = 0, u = e;
								if (n === 1 && r === 0)return !0;
								t = e.parentNode;
								if (t && (t[d] !== i || !e.sizset)) {
									for (u = t.firstChild; u; u = u.nextSibling)if (u.nodeType === 1) {
										u.sizset = ++o;
										if (u === e)break
									}
									t[d] = i
								}
								return s = e.sizset - r, n === 0 ? s === 0 : s % n === 0 && s / n >= 0
							}
						}
						return function (t) {
							var n = t;
							switch (e) {
								case"only":
								case"first":
									while (n = n.previousSibling)if (n.nodeType === 1)return !1;
									if (e === "first")return !0;
									n = t;
								case"last":
									while (n = n.nextSibling)if (n.nodeType === 1)return !1;
									return !0
							}
						}
					}, PSEUDO: function (e, t, n, r) {
						var i, o = s.pseudos[e] || s.pseudos[e.toLowerCase()];
						return o || Y.error("unsupported pseudo: " + e), o[d] ? o(t, n, r) : o.length > 1 ? (i = [e, e, "", t], function (e) {
							return o(e, 0, i)
						}) : o
					}
				},
				pseudos: {
					not: E(function (e, t, n) {
						var r = f(e.replace(D, "$1"), t, n);
						return function (e) {
							return !r(e)
						}
					}),
					enabled: function (e) {
						return e.disabled === !1
					},
					disabled: function (e) {
						return e.disabled === !0
					},
					checked: function (e) {
						var t = e.nodeName.toLowerCase();
						return t === "input" && !!e.checked || t === "option" && !!e.selected
					},
					selected: function (e) {
						return e.parentNode && e.parentNode.selectedIndex, e.selected === !0
					},
					parent: function (e) {
						return !s.pseudos.empty(e)
					},
					empty: function (e) {
						var t;
						e = e.firstChild;
						while (e) {
							if (e.nodeName > "@" || (t = e.nodeType) === 3 || t === 4)return !1;
							e = e.nextSibling
						}
						return !0
					},
					contains: E(function (e) {
						return function (t) {
							return (t.textContent || t.innerText || o(t)).indexOf(e) > -1
						}
					}),
					has: E(function (e) {
						return function (t) {
							return Y(e, t).length > 0
						}
					}),
					header: function (e) {
						return R.test(e.nodeName)
					},
					text: function (e) {
						var t, n;
						return e.nodeName.toLowerCase() === "input" && (t = e.type) === "text" && ((n = e.getAttribute("type")) == null || n.toLowerCase() === t)
					},
					radio: Z("radio"),
					checkbox: Z("checkbox"),
					file: Z("file"),
					password: Z("password"),
					image: Z("image"),
					submit: et("submit"),
					reset: et("reset"),
					button: function (e) {
						var t = e.nodeName.toLowerCase();
						return t === "input" && e.type === "button" || t === "button"
					},
					input: function (e) {
						return U.test(e.nodeName)
					},
					focus: function (e) {
						var t = e.ownerDocument;
						return e === t.activeElement && (!t.hasFocus || t.hasFocus()) && (!!e.type || !!e.href)
					},
					active: function (e) {
						return e === e.ownerDocument.activeElement
					}
				},
				setFilters: {
					first: function (e, t, n) {
						return n ? e.slice(1) : [e[0]]
					}, last: function (e, t, n) {
						var r = e.pop();
						return n ? e : [r]
					}, even: function (e, t, n) {
						var r = [], i = n ? 1 : 0, s = e.length;
						for (; i < s; i += 2)r.push(e[i]);
						return r
					}, odd: function (e, t, n) {
						var r = [], i = n ? 0 : 1, s = e.length;
						for (; i < s; i += 2)r.push(e[i]);
						return r
					}, lt: function (e, t, n) {
						return n ? e.slice(+t) : e.slice(0, +t)
					}, gt: function (e, t, n) {
						return n ? e.slice(0, +t + 1) : e.slice(+t + 1)
					}, eq: function (e, t, n) {
						var r = e.splice(+t, 1);
						return n ? e : r
					}
				}
			}, l = g.compareDocumentPosition ? function (e, t) {
				return e === t ? (c = !0, 0) : (!e.compareDocumentPosition || !t.compareDocumentPosition ? e.compareDocumentPosition : e.compareDocumentPosition(t) & 4) ? -1 : 1
			} : function (e, t) {
				if (e === t)return c = !0, 0;
				if (e.sourceIndex && t.sourceIndex)return e.sourceIndex - t.sourceIndex;
				var n, r, i = [], s = [], o = e.parentNode, u = t.parentNode, a = o;
				if (o === u)return tt(e, t);
				if (!o)return -1;
				if (!u)return 1;
				while (a)i.unshift(a), a = a.parentNode;
				a = u;
				while (a)s.unshift(a), a = a.parentNode;
				n = i.length, r = s.length;
				for (var f = 0; f < n && f < r; f++)if (i[f] !== s[f])return tt(i[f], s[f]);
				return f === n ? tt(e, s[f], -1) : tt(i[f], t, 1)
			}, [0, 0].sort(l), h = !c, Y.uniqueSort = function (e) {
				var t, n = 1;
				c = h, e.sort(l);
				if (c)for (; t = e[n]; n++)t === e[n - 1] && e.splice(n--, 1);
				return e
			}, Y.error = function (e) {
				throw new Error("Syntax error, unrecognized expression: " + e)
			}, f = Y.compile = function (e, t, n) {
				var r, i, s, o = N[d][e];
				if (o && o.context === t)return o;
				r = nt(e, t, n);
				for (i = 0, s = r.length; i < s; i++)r[i] = st(r[i], t, n);
				return o = N(e, ot(r)), o.context = t, o.runs = o.dirruns = 0, o
			}, m.querySelectorAll && function () {
				var e, t = lt, n = /'|\\/g, r = /\=[\x20\t\r\n\f]*([^'"\]]*)[\x20\t\r\n\f]*\]/g, i = [], s = [":active"], o = g.matchesSelector || g.mozMatchesSelector || g.webkitMatchesSelector || g.oMatchesSelector || g.msMatchesSelector;
				X(function (e) {
					e.innerHTML = "<select><option selected=''></option></select>", e.querySelectorAll("[selected]").length || i.push("\\[" + C + "*(?:checked|disabled|ismap|multiple|readonly|selected|value)"), e.querySelectorAll(":checked").length || i.push(":checked")
				}), X(function (e) {
					e.innerHTML = "<p test=''></p>", e.querySelectorAll("[test^='']").length && i.push("[*^$]=" + C + "*(?:\"\"|'')"), e.innerHTML = "<input type='hidden'/>", e.querySelectorAll(":enabled").length || i.push(":enabled", ":disabled")
				}), i = i.length && new RegExp(i.join("|")), lt = function (e, r, s, o, u) {
					if (!o && !u && (!i || !i.test(e)))if (r.nodeType === 9)try {
						return w.apply(s, b.call(r.querySelectorAll(e), 0)), s
					} catch (a) {
					} else if (r.nodeType === 1 && r.nodeName.toLowerCase() !== "object") {
						var f, l, c, h = r.getAttribute("id"), p = h || d, v = I.test(e) && r.parentNode || r;
						h ? p = p.replace(n, "\\$&") : r.setAttribute("id", p), f = nt(e, r, u), p = "[id='" + p + "']";
						for (l = 0, c = f.length; l < c; l++)f[l] = p + f[l].selector;
						try {
							return w.apply(s, b.call(v.querySelectorAll(f.join(",")), 0)), s
						} catch (a) {
						} finally {
							h || r.removeAttribute("id")
						}
					}
					return t(e, r, s, o, u)
				}, o && (X(function (t) {
					e = o.call(t, "div");
					try {
						o.call(t, "[test!='']:sizzle"), s.push(W.PSEUDO.source, W.POS.source, "!=")
					} catch (n) {
					}
				}), s = new RegExp(s.join("|")), Y.matchesSelector = function (t, n) {
					n = n.replace(r, "='$1']");
					if (!u(t) && !s.test(n) && (!i || !i.test(n)))try {
						var a = o.call(t, n);
						if (a || e || t.document && t.document.nodeType !== 11)return a
					} catch (f) {
					}
					return Y(n, null, null, [t]).length > 0
				})
			}(), s.setFilters.nth = s.setFilters.eq, s.filters = s.pseudos, Y.attr = v.attr, v.find = Y, v.expr = Y.selectors, v.expr[":"] = v.expr.pseudos, v.unique = Y.uniqueSort, v.text = Y.getText, v.isXMLDoc = Y.isXML, v.contains = Y.contains
		}(e);
		var nt = /Until$/, rt = /^(?:parents|prev(?:Until|All))/, it = /^.[^:#\[\.,]*$/, st = v.expr.match.needsContext, ot = {
			children: !0,
			contents: !0,
			next: !0,
			prev: !0
		};
		v.fn.extend({
			find: function (e) {
				var t, n, r, i, s, o, u = this;
				if (typeof e != "string")return v(e).filter(function () {
					for (t = 0, n = u.length; t < n; t++)if (v.contains(u[t], this))return !0
				});
				o = this.pushStack("", "find", e);
				for (t = 0, n = this.length; t < n; t++) {
					r = o.length, v.find(e, this[t], o);
					if (t > 0)for (i = r; i < o.length; i++)for (s = 0; s < r; s++)if (o[s] === o[i]) {
						o.splice(i--, 1);
						break
					}
				}
				return o
			}, has: function (e) {
				var t, n = v(e, this), r = n.length;
				return this.filter(function () {
					for (t = 0; t < r; t++)if (v.contains(this, n[t]))return !0
				})
			}, not: function (e) {
				return this.pushStack(ft(this, e, !1), "not", e)
			}, filter: function (e) {
				return this.pushStack(ft(this, e, !0), "filter", e)
			}, is: function (e) {
				return !!e && (typeof e == "string" ? st.test(e) ? v(e, this.context).index(this[0]) >= 0 : v.filter(e, this).length > 0 : this.filter(e).length > 0)
			}, closest: function (e, t) {
				var n, r = 0, i = this.length, s = [], o = st.test(e) || typeof e != "string" ? v(e, t || this.context) : 0;
				for (; r < i; r++) {
					n = this[r];
					while (n && n.ownerDocument && n !== t && n.nodeType !== 11) {
						if (o ? o.index(n) > -1 : v.find.matchesSelector(n, e)) {
							s.push(n);
							break
						}
						n = n.parentNode
					}
				}
				return s = s.length > 1 ? v.unique(s) : s, this.pushStack(s, "closest", e)
			}, index: function (e) {
				return e ? typeof e == "string" ? v.inArray(this[0], v(e)) : v.inArray(e.jquery ? e[0] : e, this) : this[0] && this[0].parentNode ? this.prevAll().length : -1
			}, add: function (e, t) {
				var n = typeof e == "string" ? v(e, t) : v.makeArray(e && e.nodeType ? [e] : e), r = v.merge(this.get(), n);
				return this.pushStack(ut(n[0]) || ut(r[0]) ? r : v.unique(r))
			}, addBack: function (e) {
				return this.add(e == null ? this.prevObject : this.prevObject.filter(e))
			}
		}), v.fn.andSelf = v.fn.addBack, v.each({
			parent: function (e) {
				var t = e.parentNode;
				return t && t.nodeType !== 11 ? t : null
			}, parents: function (e) {
				return v.dir(e, "parentNode")
			}, parentsUntil: function (e, t, n) {
				return v.dir(e, "parentNode", n)
			}, next: function (e) {
				return at(e, "nextSibling")
			}, prev: function (e) {
				return at(e, "previousSibling")
			}, nextAll: function (e) {
				return v.dir(e, "nextSibling")
			}, prevAll: function (e) {
				return v.dir(e, "previousSibling")
			}, nextUntil: function (e, t, n) {
				return v.dir(e, "nextSibling", n)
			}, prevUntil: function (e, t, n) {
				return v.dir(e, "previousSibling", n)
			}, siblings: function (e) {
				return v.sibling((e.parentNode || {}).firstChild, e)
			}, children: function (e) {
				return v.sibling(e.firstChild)
			}, contents: function (e) {
				return v.nodeName(e, "iframe") ? e.contentDocument || e.contentWindow.document : v.merge([], e.childNodes)
			}
		}, function (e, t) {
			v.fn[e] = function (n, r) {
				var i = v.map(this, t, n);
				return nt.test(e) || (r = n), r && typeof r == "string" && (i = v.filter(r, i)), i = this.length > 1 && !ot[e] ? v.unique(i) : i, this.length > 1 && rt.test(e) && (i = i.reverse()), this.pushStack(i, e, l.call(arguments).join(","))
			}
		}), v.extend({
			filter: function (e, t, n) {
				return n && (e = ":not(" + e + ")"), t.length === 1 ? v.find.matchesSelector(t[0], e) ? [t[0]] : [] : v.find.matches(e, t)
			}, dir: function (e, n, r) {
				var i = [], s = e[n];
				while (s && s.nodeType !== 9 && (r === t || s.nodeType !== 1 || !v(s).is(r)))s.nodeType === 1 && i.push(s), s = s[n];
				return i
			}, sibling: function (e, t) {
				var n = [];
				for (; e; e = e.nextSibling)e.nodeType === 1 && e !== t && n.push(e);
				return n
			}
		});
		var ct = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video", ht = / jQuery\d+="(?:null|\d+)"/g, pt = /^\s+/, dt = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi, vt = /<([\w:]+)/, mt = /<tbody/i, gt = /<|&#?\w+;/, yt = /<(?:script|style|link)/i, bt = /<(?:script|object|embed|option|style)/i, wt = new RegExp("<(?:" + ct + ")[\\s/>]", "i"), Et = /^(?:checkbox|radio)$/, St = /checked\s*(?:[^=]|=\s*.checked.)/i, xt = /\/(java|ecma)script/i, Tt = /^\s*<!(?:\[CDATA\[|\-\-)|[\]\-]{2}>\s*$/g, Nt = {
			option: [1, "<select multiple='multiple'>", "</select>"],
			legend: [1, "<fieldset>", "</fieldset>"],
			thead: [1, "<table>", "</table>"],
			tr: [2, "<table><tbody>", "</tbody></table>"],
			td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
			col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"],
			area: [1, "<map>", "</map>"],
			_default: [0, "", ""]
		}, Ct = lt(i), kt = Ct.appendChild(i.createElement("div"));
		Nt.optgroup = Nt.option, Nt.tbody = Nt.tfoot = Nt.colgroup = Nt.caption = Nt.thead, Nt.th = Nt.td, v.support.htmlSerialize || (Nt._default = [1, "X<div>", "</div>"]), v.fn.extend({
			text: function (e) {
				return v.access(this, function (e) {
					return e === t ? v.text(this) : this.empty().append((this[0] && this[0].ownerDocument || i).createTextNode(e))
				}, null, e, arguments.length)
			}, wrapAll: function (e) {
				if (v.isFunction(e))return this.each(function (t) {
					v(this).wrapAll(e.call(this, t))
				});
				if (this[0]) {
					var t = v(e, this[0].ownerDocument).eq(0).clone(!0);
					this[0].parentNode && t.insertBefore(this[0]), t.map(function () {
						var e = this;
						while (e.firstChild && e.firstChild.nodeType === 1)e = e.firstChild;
						return e
					}).append(this)
				}
				return this
			}, wrapInner: function (e) {
				return v.isFunction(e) ? this.each(function (t) {
					v(this).wrapInner(e.call(this, t))
				}) : this.each(function () {
					var t = v(this), n = t.contents();
					n.length ? n.wrapAll(e) : t.append(e)
				})
			}, wrap: function (e) {
				var t = v.isFunction(e);
				return this.each(function (n) {
					v(this).wrapAll(t ? e.call(this, n) : e)
				})
			}, unwrap: function () {
				return this.parent().each(function () {
					v.nodeName(this, "body") || v(this).replaceWith(this.childNodes)
				}).end()
			}, append: function () {
				return this.domManip(arguments, !0, function (e) {
					(this.nodeType === 1 || this.nodeType === 11) && this.appendChild(e)
				})
			}, prepend: function () {
				return this.domManip(arguments, !0, function (e) {
					(this.nodeType === 1 || this.nodeType === 11) && this.insertBefore(e, this.firstChild)
				})
			}, before: function () {
				if (!ut(this[0]))return this.domManip(arguments, !1, function (e) {
					this.parentNode.insertBefore(e, this)
				});
				if (arguments.length) {
					var e = v.clean(arguments);
					return this.pushStack(v.merge(e, this), "before", this.selector)
				}
			}, after: function () {
				if (!ut(this[0]))return this.domManip(arguments, !1, function (e) {
					this.parentNode.insertBefore(e, this.nextSibling)
				});
				if (arguments.length) {
					var e = v.clean(arguments);
					return this.pushStack(v.merge(this, e), "after", this.selector)
				}
			}, remove: function (e, t) {
				var n, r = 0;
				for (; (n = this[r]) != null; r++)if (!e || v.filter(e, [n]).length)!t && n.nodeType === 1 && (v.cleanData(n.getElementsByTagName("*")), v.cleanData([n])), n.parentNode && n.parentNode.removeChild(n);
				return this
			}, empty: function () {
				var e, t = 0;
				for (; (e = this[t]) != null; t++) {
					e.nodeType === 1 && v.cleanData(e.getElementsByTagName("*"));
					while (e.firstChild)e.removeChild(e.firstChild)
				}
				return this
			}, clone: function (e, t) {
				return e = e == null ? !1 : e, t = t == null ? e : t, this.map(function () {
					return v.clone(this, e, t)
				})
			}, html: function (e) {
				return v.access(this, function (e) {
					var n = this[0] || {}, r = 0, i = this.length;
					if (e === t)return n.nodeType === 1 ? n.innerHTML.replace(ht, "") : t;
					if (typeof e == "string" && !yt.test(e) && (v.support.htmlSerialize || !wt.test(e)) && (v.support.leadingWhitespace || !pt.test(e)) && !Nt[(vt.exec(e) || ["", ""])[1].toLowerCase()]) {
						e = e.replace(dt, "<$1></$2>");
						try {
							for (; r < i; r++)n = this[r] || {}, n.nodeType === 1 && (v.cleanData(n.getElementsByTagName("*")), n.innerHTML = e);
							n = 0
						} catch (s) {
						}
					}
					n && this.empty().append(e)
				}, null, e, arguments.length)
			}, replaceWith: function (e) {
				return ut(this[0]) ? this.length ? this.pushStack(v(v.isFunction(e) ? e() : e), "replaceWith", e) : this : v.isFunction(e) ? this.each(function (t) {
					var n = v(this), r = n.html();
					n.replaceWith(e.call(this, t, r))
				}) : (typeof e != "string" && (e = v(e).detach()), this.each(function () {
					var t = this.nextSibling, n = this.parentNode;
					v(this).remove(), t ? v(t).before(e) : v(n).append(e)
				}))
			}, detach: function (e) {
				return this.remove(e, !0)
			}, domManip: function (e, n, r) {
				e = [].concat.apply([], e);
				var i, s, o, u, a = 0, f = e[0], l = [], c = this.length;
				if (!v.support.checkClone && c > 1 && typeof f == "string" && St.test(f))return this.each(function () {
					v(this).domManip(e, n, r)
				});
				if (v.isFunction(f))return this.each(function (i) {
					var s = v(this);
					e[0] = f.call(this, i, n ? s.html() : t), s.domManip(e, n, r)
				});
				if (this[0]) {
					i = v.buildFragment(e, this, l), o = i.fragment, s = o.firstChild, o.childNodes.length === 1 && (o = s);
					if (s) {
						n = n && v.nodeName(s, "tr");
						for (u = i.cacheable || c - 1; a < c; a++)r.call(n && v.nodeName(this[a], "table") ? Lt(this[a], "tbody") : this[a], a === u ? o : v.clone(o, !0, !0))
					}
					o = s = null, l.length && v.each(l, function (e, t) {
						t.src ? v.ajax ? v.ajax({
							url: t.src,
							type: "GET",
							dataType: "script",
							async: !1,
							global: !1,
							"throws": !0
						}) : v.error("no ajax") : v.globalEval((t.text || t.textContent || t.innerHTML || "").replace(Tt, "")), t.parentNode && t.parentNode.removeChild(t)
					})
				}
				return this
			}
		}), v.buildFragment = function (e, n, r) {
			var s, o, u, a = e[0];
			return n = n || i, n = (n[0] || n).ownerDocument || n[0] || n, typeof n.createDocumentFragment == "undefined" && (n = i), e.length === 1 && typeof a == "string" && a.length < 512 && n === i && a.charAt(0) === "<" && !bt.test(a) && (v.support.checkClone || !St.test(a)) && (v.support.html5Clone || !wt.test(a)) && (o = !0, s = v.fragments[a], u = s !== t), s || (s = n.createDocumentFragment(), v.clean(e, n, s, r), o && (v.fragments[a] = u && s)), {
				fragment: s,
				cacheable: o
			}
		}, v.fragments = {}, v.each({
			appendTo: "append",
			prependTo: "prepend",
			insertBefore: "before",
			insertAfter: "after",
			replaceAll: "replaceWith"
		}, function (e, t) {
			v.fn[e] = function (n) {
				var r, i = 0, s = [], o = v(n), u = o.length, a = this.length === 1 && this[0].parentNode;
				if ((a == null || a && a.nodeType === 11 && a.childNodes.length === 1) && u === 1)return o[t](this[0]), this;
				for (; i < u; i++)r = (i > 0 ? this.clone(!0) : this).get(), v(o[i])[t](r), s = s.concat(r);
				return this.pushStack(s, e, o.selector)
			}
		}), v.extend({
			clone: function (e, t, n) {
				var r, i, s, o;
				v.support.html5Clone || v.isXMLDoc(e) || !wt.test("<" + e.nodeName + ">") ? o = e.cloneNode(!0) : (kt.innerHTML = e.outerHTML, kt.removeChild(o = kt.firstChild));
				if ((!v.support.noCloneEvent || !v.support.noCloneChecked) && (e.nodeType === 1 || e.nodeType === 11) && !v.isXMLDoc(e)) {
					Ot(e, o), r = Mt(e), i = Mt(o);
					for (s = 0; r[s]; ++s)i[s] && Ot(r[s], i[s])
				}
				if (t) {
					At(e, o);
					if (n) {
						r = Mt(e), i = Mt(o);
						for (s = 0; r[s]; ++s)At(r[s], i[s])
					}
				}
				return r = i = null, o
			}, clean: function (e, t, n, r) {
				var s, o, u, a, f, l, c, h, p, d, m, g, y = 0, b = [];
				if (!t || typeof t.createDocumentFragment == "undefined")t = i;
				for (o = t === i && Ct; (u = e[y]) != null; y++) {
					typeof u == "number" && (u += "");
					if (!u)continue;
					if (typeof u == "string")if (!gt.test(u))u = t.createTextNode(u); else {
						o = o || lt(t), c = c || o.appendChild(t.createElement("div")), u = u.replace(dt, "<$1></$2>"), a = (vt.exec(u) || ["", ""])[1].toLowerCase(), f = Nt[a] || Nt._default, l = f[0], c.innerHTML = f[1] + u + f[2];
						while (l--)c = c.lastChild;
						if (!v.support.tbody) {
							h = mt.test(u), p = a === "table" && !h ? c.firstChild && c.firstChild.childNodes : f[1] === "<table>" && !h ? c.childNodes : [];
							for (s = p.length - 1; s >= 0; --s)v.nodeName(p[s], "tbody") && !p[s].childNodes.length && p[s].parentNode.removeChild(p[s])
						}
						!v.support.leadingWhitespace && pt.test(u) && c.insertBefore(t.createTextNode(pt.exec(u)[0]), c.firstChild), u = c.childNodes, c = o.lastChild
					}
					u.nodeType ? b.push(u) : b = v.merge(b, u)
				}
				c && (o.removeChild(c), u = c = o = null);
				if (!v.support.appendChecked)for (y = 0; (u = b[y]) != null; y++)v.nodeName(u, "input") ? _t(u) : typeof u.getElementsByTagName != "undefined" && v.grep(u.getElementsByTagName("input"), _t);
				if (n) {
					m = function (e) {
						if (!e.type || xt.test(e.type))return r ? r.push(e.parentNode ? e.parentNode.removeChild(e) : e) : n.appendChild(e)
					};
					for (y = 0; (u = b[y]) != null; y++)if (!v.nodeName(u, "script") || !m(u))n.appendChild(u), typeof u.getElementsByTagName != "undefined" && (g = v.grep(v.merge([], u.getElementsByTagName("script")), m), b.splice.apply(b, [y + 1, 0].concat(g)), y += g.length)
				}
				return b
			}, cleanData: function (e, t) {
				var n, r, i, s, o = 0, u = v.expando, a = v.cache, f = v.support.deleteExpando, l = v.event.special;
				for (; (i = e[o]) != null; o++)if (t || v.acceptData(i)) {
					r = i[u], n = r && a[r];
					if (n) {
						if (n.events)for (s in n.events)l[s] ? v.event.remove(i, s) : v.removeEvent(i, s, n.handle);
						a[r] && (delete a[r], f ? delete i[u] : i.removeAttribute ? i.removeAttribute(u) : i[u] = null, v.deletedIds.push(r))
					}
				}
			}
		});
		var Dt, Pt, Ht, Bt = /alpha\([^)]*\)/i, jt = /opacity=([^)]*)/, Ft = /^(top|right|bottom|left)$/, It = /^margin/, qt = new RegExp("^(" + m + ")(.*)$", "i"), Rt = new RegExp("^(" + m + ")(?!px)[a-z%]+$", "i"), Ut = new RegExp("^([-+])=(" + m + ")", "i"), zt = {}, Wt = {
			position: "absolute",
			visibility: "hidden",
			display: "block"
		}, Xt = {
			letterSpacing: 0,
			fontWeight: 400,
			lineHeight: 1
		}, Vt = ["Top", "Right", "Bottom", "Left"], $t = ["Webkit", "O", "Moz", "ms"], Jt = v.fn.toggle;
		v.fn.extend({
			css: function (e, n) {
				return v.access(this, function (e, n, r) {
					return r !== t ? v.style(e, n, r) : v.css(e, n)
				}, e, n, arguments.length > 1)
			}, show: function () {
				return Gt(this, !0)
			}, hide: function () {
				return Gt(this)
			}, toggle: function (e, t) {
				var n = typeof e == "boolean";
				return v.isFunction(e) && v.isFunction(t) ? Jt.apply(this, arguments) : this.each(function () {
					(n ? e : Qt(this)) ? v(this).show() : v(this).hide()
				})
			}
		}), v.extend({
			cssHooks: {
				opacity: {
					get: function (e, t) {
						if (t) {
							var n = Dt(e, "opacity");
							return n === "" ? "1" : n
						}
					}
				}
			},
			cssNumber: {
				fillOpacity: !0,
				fontWeight: !0,
				lineHeight: !0,
				opacity: !0,
				orphans: !0,
				widows: !0,
				zIndex: !0,
				zoom: !0
			},
			cssProps: {"float": v.support.cssFloat ? "cssFloat" : "styleFloat"},
			style: function (e, n, r, i) {
				if (!e || e.nodeType === 3 || e.nodeType === 8 || !e.style)return;
				var s, o, u, a = v.camelCase(n), f = e.style;
				n = v.cssProps[a] || (v.cssProps[a] = Kt(f, a)), u = v.cssHooks[n] || v.cssHooks[a];
				if (r === t)return u && "get"in u && (s = u.get(e, !1, i)) !== t ? s : f[n];
				o = typeof r, o === "string" && (s = Ut.exec(r)) && (r = (s[1] + 1) * s[2] + parseFloat(v.css(e, n)), o = "number");
				if (r == null || o === "number" && isNaN(r))return;
				o === "number" && !v.cssNumber[a] && (r += "px");
				if (!u || !("set"in u) || (r = u.set(e, r, i)) !== t)try {
					f[n] = r
				} catch (l) {
				}
			},
			css: function (e, n, r, i) {
				var s, o, u, a = v.camelCase(n);
				return n = v.cssProps[a] || (v.cssProps[a] = Kt(e.style, a)), u = v.cssHooks[n] || v.cssHooks[a], u && "get"in u && (s = u.get(e, !0, i)), s === t && (s = Dt(e, n)), s === "normal" && n in Xt && (s = Xt[n]), r || i !== t ? (o = parseFloat(s), r || v.isNumeric(o) ? o || 0 : s) : s
			},
			swap: function (e, t, n) {
				var r, i, s = {};
				for (i in t)s[i] = e.style[i], e.style[i] = t[i];
				r = n.call(e);
				for (i in t)e.style[i] = s[i];
				return r
			}
		}), e.getComputedStyle ? Dt = function (e, t) {
			var n, r, i, s, o = getComputedStyle(e, null), u = e.style;
			return o && (n = o[t], n === "" && !v.contains(e.ownerDocument.documentElement, e) && (n = v.style(e, t)), Rt.test(n) && It.test(t) && (r = u.width, i = u.minWidth, s = u.maxWidth, u.minWidth = u.maxWidth = u.width = n, n = o.width, u.width = r, u.minWidth = i, u.maxWidth = s)), n
		} : i.documentElement.currentStyle && (Dt = function (e, t) {
			var n, r, i = e.currentStyle && e.currentStyle[t], s = e.style;
			return i == null && s && s[t] && (i = s[t]), Rt.test(i) && !Ft.test(t) && (n = s.left, r = e.runtimeStyle && e.runtimeStyle.left, r && (e.runtimeStyle.left = e.currentStyle.left), s.left = t === "fontSize" ? "1em" : i, i = s.pixelLeft + "px", s.left = n, r && (e.runtimeStyle.left = r)), i === "" ? "auto" : i
		}), v.each(["height", "width"], function (e, t) {
			v.cssHooks[t] = {
				get: function (e, n, r) {
					if (n)return e.offsetWidth !== 0 || Dt(e, "display") !== "none" ? en(e, t, r) : v.swap(e, Wt, function () {
						return en(e, t, r)
					})
				}, set: function (e, n, r) {
					return Yt(e, n, r ? Zt(e, t, r, v.support.boxSizing && v.css(e, "boxSizing") === "border-box") : 0)
				}
			}
		}), v.support.opacity || (v.cssHooks.opacity = {
			get: function (e, t) {
				return jt.test((t && e.currentStyle ? e.currentStyle.filter : e.style.filter) || "") ? .01 * parseFloat(RegExp.$1) + "" : t ? "1" : ""
			}, set: function (e, t) {
				var n = e.style, r = e.currentStyle, i = v.isNumeric(t) ? "alpha(opacity=" + t * 100 + ")" : "", s = r && r.filter || n.filter || "";
				n.zoom = 1;
				if (t >= 1 && v.trim(s.replace(Bt, "")) === "" && n.removeAttribute) {
					n.removeAttribute("filter");
					if (r && !r.filter)return
				}
				n.filter = Bt.test(s) ? s.replace(Bt, i) : s + " " + i
			}
		}), v(function () {
			v.support.reliableMarginRight || (v.cssHooks.marginRight = {
				get: function (e, t) {
					return v.swap(e, {display: "inline-block"}, function () {
						if (t)return Dt(e, "marginRight")
					})
				}
			}), !v.support.pixelPosition && v.fn.position && v.each(["top", "left"], function (e, t) {
				v.cssHooks[t] = {
					get: function (e, n) {
						if (n) {
							var r = Dt(e, t);
							return Rt.test(r) ? v(e).position()[t] + "px" : r
						}
					}
				}
			})
		}), v.expr && v.expr.filters && (v.expr.filters.hidden = function (e) {
			return e.offsetWidth === 0 && e.offsetHeight === 0 || !v.support.reliableHiddenOffsets && (e.style && e.style.display || Dt(e, "display")) === "none"
		}, v.expr.filters.visible = function (e) {
			return !v.expr.filters.hidden(e)
		}), v.each({margin: "", padding: "", border: "Width"}, function (e, t) {
			v.cssHooks[e + t] = {
				expand: function (n) {
					var r, i = typeof n == "string" ? n.split(" ") : [n], s = {};
					for (r = 0; r < 4; r++)s[e + Vt[r] + t] = i[r] || i[r - 2] || i[0];
					return s
				}
			}, It.test(e) || (v.cssHooks[e + t].set = Yt)
		});
		var nn = /%20/g, rn = /\[\]$/, sn = /\r?\n/g, on = /^(?:color|date|datetime|datetime-local|email|hidden|month|number|password|range|search|tel|text|time|url|week)$/i, un = /^(?:select|textarea)/i;
		v.fn.extend({
			serialize: function () {
				return v.param(this.serializeArray())
			}, serializeArray: function () {
				return this.map(function () {
					return this.elements ? v.makeArray(this.elements) : this
				}).filter(function () {
					return this.name && !this.disabled && (this.checked || un.test(this.nodeName) || on.test(this.type))
				}).map(function (e, t) {
					var n = v(this).val();
					return n == null ? null : v.isArray(n) ? v.map(n, function (e, n) {
						return {name: t.name, value: e.replace(sn, "\r\n")}
					}) : {name: t.name, value: n.replace(sn, "\r\n")}
				}).get()
			}
		}), v.param = function (e, n) {
			var r, i = [], s = function (e, t) {
				t = v.isFunction(t) ? t() : t == null ? "" : t, i[i.length] = encodeURIComponent(e) + "=" + encodeURIComponent(t)
			};
			n === t && (n = v.ajaxSettings && v.ajaxSettings.traditional);
			if (v.isArray(e) || e.jquery && !v.isPlainObject(e))v.each(e, function () {
				s(this.name, this.value)
			}); else for (r in e)an(r, e[r], n, s);
			return i.join("&").replace(nn, "+")
		};
		var fn, ln, cn = /^(?:toggle|show|hide)$/, hn = new RegExp("^(?:([-+])=|)(" + m + ")([a-z%]*)$", "i"), pn = /queueHooks$/, dn = [wn], vn = {
			"*": [function (e, t) {
				var n, r, i, s = this.createTween(e, t), o = hn.exec(t), u = s.cur(), a = +u || 0, f = 1;
				if (o) {
					n = +o[2], r = o[3] || (v.cssNumber[e] ? "" : "px");
					if (r !== "px" && a) {
						a = v.css(s.elem, e, !0) || n || 1;
						do i = f = f || ".5", a /= f, v.style(s.elem, e, a + r), f = s.cur() / u; while (f !== 1 && f !== i)
					}
					s.unit = r, s.start = a, s.end = o[1] ? a + (o[1] + 1) * n : n
				}
				return s
			}]
		};
		v.Animation = v.extend(yn, {
			tweener: function (e, t) {
				v.isFunction(e) ? (t = e, e = ["*"]) : e = e.split(" ");
				var n, r = 0, i = e.length;
				for (; r < i; r++)n = e[r], vn[n] = vn[n] || [], vn[n].unshift(t)
			}, prefilter: function (e, t) {
				t ? dn.unshift(e) : dn.push(e)
			}
		}), v.Tween = En, En.prototype = {
			constructor: En, init: function (e, t, n, r, i, s) {
				this.elem = e, this.prop = n, this.easing = i || "swing", this.options = t, this.start = this.now = this.cur(), this.end = r, this.unit = s || (v.cssNumber[n] ? "" : "px")
			}, cur: function () {
				var e = En.propHooks[this.prop];
				return e && e.get ? e.get(this) : En.propHooks._default.get(this)
			}, run: function (e) {
				var t, n = En.propHooks[this.prop];
				return this.pos = t = v.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration), this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : En.propHooks._default.set(this), this
			}
		}, En.prototype.init.prototype = En.prototype, En.propHooks = {
			_default: {
				get: function (e) {
					var t;
					return e.elem[e.prop] == null || !!e.elem.style && e.elem.style[e.prop] != null ? (t = v.css(e.elem, e.prop, !1, ""), !t || t === "auto" ? 0 : t) : e.elem[e.prop]
				}, set: function (e) {
					v.fx.step[e.prop] ? v.fx.step[e.prop](e) : e.elem.style && (e.elem.style[v.cssProps[e.prop]] != null || v.cssHooks[e.prop]) ? v.style(e.elem, e.prop, e.now + e.unit) : e.elem[e.prop] = e.now
				}
			}
		}, En.propHooks.scrollTop = En.propHooks.scrollLeft = {
			set: function (e) {
				e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now)
			}
		}, v.each(["toggle", "show", "hide"], function (e, t) {
			var n = v.fn[t];
			v.fn[t] = function (r, i, s) {
				return r == null || typeof r == "boolean" || !e && v.isFunction(r) && v.isFunction(i) ? n.apply(this, arguments) : this.animate(Sn(t, !0), r, i, s)
			}
		}), v.fn.extend({
			fadeTo: function (e, t, n, r) {
				return this.filter(Qt).css("opacity", 0).show().end().animate({opacity: t}, e, n, r)
			}, animate: function (e, t, n, r) {
				var i = v.isEmptyObject(e), s = v.speed(t, n, r), o = function () {
					var t = yn(this, v.extend({}, e), s);
					i && t.stop(!0)
				};
				return i || s.queue === !1 ? this.each(o) : this.queue(s.queue, o)
			}, stop: function (e, n, r) {
				var i = function (e) {
					var t = e.stop;
					delete e.stop, t(r)
				};
				return typeof e != "string" && (r = n, n = e, e = t), n && e !== !1 && this.queue(e || "fx", []), this.each(function () {
					var t = !0, n = e != null && e + "queueHooks", s = v.timers, o = v._data(this);
					if (n)o[n] && o[n].stop && i(o[n]); else for (n in o)o[n] && o[n].stop && pn.test(n) && i(o[n]);
					for (n = s.length; n--;)s[n].elem === this && (e == null || s[n].queue === e) && (s[n].anim.stop(r), t = !1, s.splice(n, 1));
					(t || !r) && v.dequeue(this, e)
				})
			}
		}), v.each({
			slideDown: Sn("show"),
			slideUp: Sn("hide"),
			slideToggle: Sn("toggle"),
			fadeIn: {opacity: "show"},
			fadeOut: {opacity: "hide"},
			fadeToggle: {opacity: "toggle"}
		}, function (e, t) {
			v.fn[e] = function (e, n, r) {
				return this.animate(t, e, n, r)
			}
		}), v.speed = function (e, t, n) {
			var r = e && typeof e == "object" ? v.extend({}, e) : {
				complete: n || !n && t || v.isFunction(e) && e,
				duration: e,
				easing: n && t || t && !v.isFunction(t) && t
			};
			r.duration = v.fx.off ? 0 : typeof r.duration == "number" ? r.duration : r.duration in v.fx.speeds ? v.fx.speeds[r.duration] : v.fx.speeds._default;
			if (r.queue == null || r.queue === !0)r.queue = "fx";
			return r.old = r.complete, r.complete = function () {
				v.isFunction(r.old) && r.old.call(this), r.queue && v.dequeue(this, r.queue)
			}, r
		}, v.easing = {
			linear: function (e) {
				return e
			}, swing: function (e) {
				return .5 - Math.cos(e * Math.PI) / 2
			}
		}, v.timers = [], v.fx = En.prototype.init, v.fx.tick = function () {
			var e, t = v.timers, n = 0;
			for (; n < t.length; n++)e = t[n], !e() && t[n] === e && t.splice(n--, 1);
			t.length || v.fx.stop()
		}, v.fx.timer = function (e) {
			e() && v.timers.push(e) && !ln && (ln = setInterval(v.fx.tick, v.fx.interval))
		}, v.fx.interval = 13, v.fx.stop = function () {
			clearInterval(ln), ln = null
		}, v.fx.speeds = {
			slow: 600,
			fast: 200,
			_default: 400
		}, v.fx.step = {}, v.expr && v.expr.filters && (v.expr.filters.animated = function (e) {
			return v.grep(v.timers, function (t) {
				return e === t.elem
			}).length
		});
		var xn = /^(?:body|html)$/i;
		v.fn.offset = function (e) {
			if (arguments.length)return e === t ? this : this.each(function (t) {
				v.offset.setOffset(this, e, t)
			});
			var n, r, i, s, o, u, a, f, l, c, h = this[0], p = h && h.ownerDocument;
			if (!p)return;
			return (i = p.body) === h ? v.offset.bodyOffset(h) : (r = p.documentElement, v.contains(r, h) ? (n = h.getBoundingClientRect(), s = Tn(p), o = r.clientTop || i.clientTop || 0, u = r.clientLeft || i.clientLeft || 0, a = s.pageYOffset || r.scrollTop, f = s.pageXOffset || r.scrollLeft, l = n.top + a - o, c = n.left + f - u, {
				top: l,
				left: c
			}) : {top: 0, left: 0})
		}, v.offset = {
			bodyOffset: function (e) {
				var t = e.offsetTop, n = e.offsetLeft;
				return v.support.doesNotIncludeMarginInBodyOffset && (t += parseFloat(v.css(e, "marginTop")) || 0, n += parseFloat(v.css(e, "marginLeft")) || 0), {
					top: t,
					left: n
				}
			}, setOffset: function (e, t, n) {
				var r = v.css(e, "position");
				r === "static" && (e.style.position = "relative");
				var i = v(e), s = i.offset(), o = v.css(e, "top"), u = v.css(e, "left"), a = (r === "absolute" || r === "fixed") && v.inArray("auto", [o, u]) > -1, f = {}, l = {}, c, h;
				a ? (l = i.position(), c = l.top, h = l.left) : (c = parseFloat(o) || 0, h = parseFloat(u) || 0), v.isFunction(t) && (t = t.call(e, n, s)), t.top != null && (f.top = t.top - s.top + c), t.left != null && (f.left = t.left - s.left + h), "using"in t ? t.using.call(e, f) : i.css(f)
			}
		}, v.fn.extend({
			position: function () {
				if (!this[0])return;
				var e = this[0], t = this.offsetParent(), n = this.offset(), r = xn.test(t[0].nodeName) ? {
					top: 0,
					left: 0
				} : t.offset();
				return n.top -= parseFloat(v.css(e, "marginTop")) || 0, n.left -= parseFloat(v.css(e, "marginLeft")) || 0, r.top += parseFloat(v.css(t[0], "borderTopWidth")) || 0, r.left += parseFloat(v.css(t[0], "borderLeftWidth")) || 0, {
					top: n.top - r.top,
					left: n.left - r.left
				}
			}, offsetParent: function () {
				return this.map(function () {
					var e = this.offsetParent || i.body;
					while (e && !xn.test(e.nodeName) && v.css(e, "position") === "static")e = e.offsetParent;
					return e || i.body
				})
			}
		}), v.each({scrollLeft: "pageXOffset", scrollTop: "pageYOffset"}, function (e, n) {
			var r = /Y/.test(n);
			v.fn[e] = function (i) {
				return v.access(this, function (e, i, s) {
					var o = Tn(e);
					if (s === t)return o ? n in o ? o[n] : o.document.documentElement[i] : e[i];
					o ? o.scrollTo(r ? v(o).scrollLeft() : s, r ? s : v(o).scrollTop()) : e[i] = s
				}, e, i, arguments.length, null)
			}
		}), v.each({Height: "height", Width: "width"}, function (e, n) {
			v.each({padding: "inner" + e, content: n, "": "outer" + e}, function (r, i) {
				v.fn[i] = function (i, s) {
					var o = arguments.length && (r || typeof i != "boolean"), u = r || (i === !0 || s === !0 ? "margin" : "border");
					return v.access(this, function (n, r, i) {
						var s;
						return v.isWindow(n) ? n.document.documentElement["client" + e] : n.nodeType === 9 ? (s = n.documentElement, Math.max(n.body["scroll" + e], s["scroll" + e], n.body["offset" + e], s["offset" + e], s["client" + e])) : i === t ? v.css(n, r, i, u) : v.style(n, r, i, u)
					}, n, o ? i : t, o)
				}
			})
		}), e.__jq2 = e.__jq = v, typeof define == "function" && define.amd && define.amd.jQuery && define("jquery", [], function () {
			return v
		})
	})(window);
	var $ = window.__jq2;
	// -----

	var ANIMATION_TIME = 400;

	contentLoaded(window, function () {
		trc('contentLoaded', [true, window]);
		var iframe = document.createElement('iframe');

		var HEADER_HEIGHT = <?php echo $vars['ui']['headerHeight'] ?>;
		//console.log(': <?php echo $vars['ui']['headerHeight'];?>');
		var MOBILE_BREAKPOINT = <?php echo $vars['ui']['mobileBreakpoint'] ?>;
		//console.log(': <?php echo $vars['ui']['mobileBreakpoint'];?>');
		var MOBILE_BUTTON_SIZE = 55;

		iframe.id = 'customer-chat-iframe';
		iframe.src = '<?php echo $app->url("Widget:iframeContent") ?>&domain=' + document.domain;
		//console.log(': <?php echo $app->url("Widget:iframeContent");?>&domain='+document.domain);
		iframe.border = 0;
		iframe.marginwidth = 0;
		iframe.marginWidth = 0;
		iframe.marginheight = 0;
		iframe.marginHeight = 0;
		iframe.frameBorder = 0;
		iframe.outline = 'none';
		iframe.style.display = 'none';
		iframe.style.background = 'transparent';
		iframe.style.border = 'none';
		iframe.style.outline = 'none';
		iframe.style.position = 'fixed';
		iframe.style.zIndex = 999999;
		iframe.style.overflow = 'hidden';
		iframe.style.bottom = '';
		iframe.style.bottom = -(<?php echo $vars['ui']['widgetHeight'] ?> -HEADER_HEIGHT) + 'px';
		//console.log(': <?php echo $vars['ui']['widgetHeight'];?>');
		iframe.style.right = '<?php echo $vars['ui']['widgetOffset'] ?>px';
		//console.log(': <?php echo $vars['ui']['widgetOffset'];?>');
		iframe.style.width = '<?php echo $vars['ui']['widgetWidth'] ?>px';
		//console.log(': <?php echo $vars['ui']['widgetWidth'];?>');
		iframe.style.height = '<?php echo $vars['ui']['widgetHeight'] ?>px';
		//console.log(': <?php echo $vars['ui']['widgetHeight'];?>');
		iframe.style.margin = 0;
		iframe.style.padding = 0;

		// Responsiveness support

		var mobileStyles = {

			position: 'absolute',
			width: MOBILE_BUTTON_SIZE + 'px',
			height: MOBILE_BUTTON_SIZE + 'px',
			top: '',
			bottom: '',
			right: 0
		};

		var state = 'desktop';
		var originalStyles = {};

		addListener(iframe, 'load', function () {
			trc('contentLoaded.addListener', [true, iframe, 'load']);

			addListener(window, 'resize', updateState);
			addListener(window, 'scroll', positionWidget);

			updateState();

			// Messaging

			addListener(window, 'message', function (evt) {
				trc('contentLoaded.addListener.addListener', [true, window, 'message']);

				var parts = evt.data.split('|');
				var type = parts[0];

				switch (type) {
					case 'get.properties':
						console.log('case: ' + type);
						console.log('%cpostMessage=> get.properties: ' + [iframe.style.width, iframe.style.height, iframe.style.right].join(','), 'color:navy');
						postMessage('get.properties:' + [iframe.style.width, iframe.style.height, iframe.style.right].join(','));
						break;

					case 'fs.on':
						console.log('case: ' + type);
						console.log('%cpostMessage=> get.properties:' + [iframe.style.width, iframe.style.height, iframe.style.right].join(',') + 'color:navy');
						postMessage('get.properties:' + [iframe.style.width, iframe.style.height, iframe.style.right].join(','));
						break;

					case 'fs.off':
						console.log('case: ' + type);
						console.log('%cpostMessage => state.mobile, commented' + [iframe.style.width, iframe.style.height, iframe.style.right].join(','), 'color:navy;');
						//postMessage('get.properties:' + [iframe.style.width, iframe.style.height, iframe.style.right].join(','));
						break;

					case 'animate':
						console.log('case: ' + type);
						var props = {};
						var propsArray = parts[1].split(',');

						for (var i = 0; i < propsArray.length; i++) {
							var propParts = propsArray[i].split('=');

							props[propParts[0]] = propParts[1];
						}
						console.log({
							'1. iframe action': 'animate',
							'2. props': props,
							'3. duration': ANIMATION_TIME,
							'4. queue': false
						});
						$(iframe).animate(props, {duration: ANIMATION_TIME, queue: false});
						break;

					case 'css':
						console.log('case: ' + type);
						var props = {};
						var propsArray = parts[1].split(',');

						for (var i = 0; i < propsArray.length; i++) {
							var propParts = propsArray[i].split('=');

							props[propParts[0]] = propParts[1];
						}
						console.log('iframe set css ' + props);
						$(iframe).css(props);
						break;

					case 'show':
						console.log('case: ' + type);
						console.log('%ciframe set display %cblock', 'color: blue;', 'font-weight: bold;');
						iframe.style.display = 'block';
						break;

					case 'hide':
						console.log('case: ' + type);
						console.log('%ciframe set display %cnone', 'color: #999;', 'font-weight: bold;');
						iframe.style.display = 'none';
						break;
				}
			});
		});

		// -----

		document.body.appendChild(iframe);

		// -----

		// Helper functions

		function updateState() {
			trc('contentLoaded.updateState', [true]);
			if (state !== 'mobile' && getWindowWidth() < MOBILE_BREAKPOINT) setMobileState();
			else if (state !== 'desktop' && getWindowWidth() >= MOBILE_BREAKPOINT) setDesktopState();

			positionWidget();
		}

		function positionWidget() {
			trc('contentLoaded.positionWidget', [true], 'green');

			if (getWindowWidth() < MOBILE_BREAKPOINT) {
				var viewportBottom = getWindowScrollY() + getWindowHeight();
				console.log('iframe set style.top: ' + (viewportBottom - MOBILE_BUTTON_SIZE) + 'px');
				iframe.style.top = (viewportBottom - MOBILE_BUTTON_SIZE) + 'px';
			}
		}

		function setMobileState() {
			trc('contentLoaded.setMobileState', [true, 'return false']);
			return false;
			state = 'mobile';

			for (var key in mobileStyles) originalStyles[key] = iframe.style[key];
			for (var key in mobileStyles) iframe.style[key] = mobileStyles[key];

			console.log('%cpostMessage => state.mobile', 'color:navy;');

			postMessage('state.mobile');

			positionWidget();
		}

		function setDesktopState() {
			trc('contentLoaded.setDesktopState', [true]);

			state = 'desktop';

			for (var key in originalStyles) iframe.style[key] = originalStyles[key];

			console.log('%cpostMessage: state.desktop', 'color:navy;');
			postMessage('state.desktop');
		}

		function postMessage(data) {
			trc('contentLoaded.postMessage', [true, data], 'blue');
			console.log({
				'1. domain': document.domain,
				'2. iframe': iframe,
				'3. iframe.contentWindow': iframe.contentWindow
			});
			iframe.contentWindow.postMessage(data, '*');
		}
	});
})();