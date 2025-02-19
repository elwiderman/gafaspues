/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ 3738:
/***/ ((module) => {

function _typeof(o) {
  "@babel/helpers - typeof";

  return module.exports = _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) {
    return typeof o;
  } : function (o) {
    return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o;
  }, module.exports.__esModule = true, module.exports["default"] = module.exports, _typeof(o);
}
module.exports = _typeof, module.exports.__esModule = true, module.exports["default"] = module.exports;

/***/ }),

/***/ 4633:
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

var _typeof = (__webpack_require__(3738)["default"]);
function _regeneratorRuntime() {
  "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */
  module.exports = _regeneratorRuntime = function _regeneratorRuntime() {
    return e;
  }, module.exports.__esModule = true, module.exports["default"] = module.exports;
  var t,
    e = {},
    r = Object.prototype,
    n = r.hasOwnProperty,
    o = Object.defineProperty || function (t, e, r) {
      t[e] = r.value;
    },
    i = "function" == typeof Symbol ? Symbol : {},
    a = i.iterator || "@@iterator",
    c = i.asyncIterator || "@@asyncIterator",
    u = i.toStringTag || "@@toStringTag";
  function define(t, e, r) {
    return Object.defineProperty(t, e, {
      value: r,
      enumerable: !0,
      configurable: !0,
      writable: !0
    }), t[e];
  }
  try {
    define({}, "");
  } catch (t) {
    define = function define(t, e, r) {
      return t[e] = r;
    };
  }
  function wrap(t, e, r, n) {
    var i = e && e.prototype instanceof Generator ? e : Generator,
      a = Object.create(i.prototype),
      c = new Context(n || []);
    return o(a, "_invoke", {
      value: makeInvokeMethod(t, r, c)
    }), a;
  }
  function tryCatch(t, e, r) {
    try {
      return {
        type: "normal",
        arg: t.call(e, r)
      };
    } catch (t) {
      return {
        type: "throw",
        arg: t
      };
    }
  }
  e.wrap = wrap;
  var h = "suspendedStart",
    l = "suspendedYield",
    f = "executing",
    s = "completed",
    y = {};
  function Generator() {}
  function GeneratorFunction() {}
  function GeneratorFunctionPrototype() {}
  var p = {};
  define(p, a, function () {
    return this;
  });
  var d = Object.getPrototypeOf,
    v = d && d(d(values([])));
  v && v !== r && n.call(v, a) && (p = v);
  var g = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(p);
  function defineIteratorMethods(t) {
    ["next", "throw", "return"].forEach(function (e) {
      define(t, e, function (t) {
        return this._invoke(e, t);
      });
    });
  }
  function AsyncIterator(t, e) {
    function invoke(r, o, i, a) {
      var c = tryCatch(t[r], t, o);
      if ("throw" !== c.type) {
        var u = c.arg,
          h = u.value;
        return h && "object" == _typeof(h) && n.call(h, "__await") ? e.resolve(h.__await).then(function (t) {
          invoke("next", t, i, a);
        }, function (t) {
          invoke("throw", t, i, a);
        }) : e.resolve(h).then(function (t) {
          u.value = t, i(u);
        }, function (t) {
          return invoke("throw", t, i, a);
        });
      }
      a(c.arg);
    }
    var r;
    o(this, "_invoke", {
      value: function value(t, n) {
        function callInvokeWithMethodAndArg() {
          return new e(function (e, r) {
            invoke(t, n, e, r);
          });
        }
        return r = r ? r.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg();
      }
    });
  }
  function makeInvokeMethod(e, r, n) {
    var o = h;
    return function (i, a) {
      if (o === f) throw Error("Generator is already running");
      if (o === s) {
        if ("throw" === i) throw a;
        return {
          value: t,
          done: !0
        };
      }
      for (n.method = i, n.arg = a;;) {
        var c = n.delegate;
        if (c) {
          var u = maybeInvokeDelegate(c, n);
          if (u) {
            if (u === y) continue;
            return u;
          }
        }
        if ("next" === n.method) n.sent = n._sent = n.arg;else if ("throw" === n.method) {
          if (o === h) throw o = s, n.arg;
          n.dispatchException(n.arg);
        } else "return" === n.method && n.abrupt("return", n.arg);
        o = f;
        var p = tryCatch(e, r, n);
        if ("normal" === p.type) {
          if (o = n.done ? s : l, p.arg === y) continue;
          return {
            value: p.arg,
            done: n.done
          };
        }
        "throw" === p.type && (o = s, n.method = "throw", n.arg = p.arg);
      }
    };
  }
  function maybeInvokeDelegate(e, r) {
    var n = r.method,
      o = e.iterator[n];
    if (o === t) return r.delegate = null, "throw" === n && e.iterator["return"] && (r.method = "return", r.arg = t, maybeInvokeDelegate(e, r), "throw" === r.method) || "return" !== n && (r.method = "throw", r.arg = new TypeError("The iterator does not provide a '" + n + "' method")), y;
    var i = tryCatch(o, e.iterator, r.arg);
    if ("throw" === i.type) return r.method = "throw", r.arg = i.arg, r.delegate = null, y;
    var a = i.arg;
    return a ? a.done ? (r[e.resultName] = a.value, r.next = e.nextLoc, "return" !== r.method && (r.method = "next", r.arg = t), r.delegate = null, y) : a : (r.method = "throw", r.arg = new TypeError("iterator result is not an object"), r.delegate = null, y);
  }
  function pushTryEntry(t) {
    var e = {
      tryLoc: t[0]
    };
    1 in t && (e.catchLoc = t[1]), 2 in t && (e.finallyLoc = t[2], e.afterLoc = t[3]), this.tryEntries.push(e);
  }
  function resetTryEntry(t) {
    var e = t.completion || {};
    e.type = "normal", delete e.arg, t.completion = e;
  }
  function Context(t) {
    this.tryEntries = [{
      tryLoc: "root"
    }], t.forEach(pushTryEntry, this), this.reset(!0);
  }
  function values(e) {
    if (e || "" === e) {
      var r = e[a];
      if (r) return r.call(e);
      if ("function" == typeof e.next) return e;
      if (!isNaN(e.length)) {
        var o = -1,
          i = function next() {
            for (; ++o < e.length;) if (n.call(e, o)) return next.value = e[o], next.done = !1, next;
            return next.value = t, next.done = !0, next;
          };
        return i.next = i;
      }
    }
    throw new TypeError(_typeof(e) + " is not iterable");
  }
  return GeneratorFunction.prototype = GeneratorFunctionPrototype, o(g, "constructor", {
    value: GeneratorFunctionPrototype,
    configurable: !0
  }), o(GeneratorFunctionPrototype, "constructor", {
    value: GeneratorFunction,
    configurable: !0
  }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, u, "GeneratorFunction"), e.isGeneratorFunction = function (t) {
    var e = "function" == typeof t && t.constructor;
    return !!e && (e === GeneratorFunction || "GeneratorFunction" === (e.displayName || e.name));
  }, e.mark = function (t) {
    return Object.setPrototypeOf ? Object.setPrototypeOf(t, GeneratorFunctionPrototype) : (t.__proto__ = GeneratorFunctionPrototype, define(t, u, "GeneratorFunction")), t.prototype = Object.create(g), t;
  }, e.awrap = function (t) {
    return {
      __await: t
    };
  }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, c, function () {
    return this;
  }), e.AsyncIterator = AsyncIterator, e.async = function (t, r, n, o, i) {
    void 0 === i && (i = Promise);
    var a = new AsyncIterator(wrap(t, r, n, o), i);
    return e.isGeneratorFunction(r) ? a : a.next().then(function (t) {
      return t.done ? t.value : a.next();
    });
  }, defineIteratorMethods(g), define(g, u, "Generator"), define(g, a, function () {
    return this;
  }), define(g, "toString", function () {
    return "[object Generator]";
  }), e.keys = function (t) {
    var e = Object(t),
      r = [];
    for (var n in e) r.push(n);
    return r.reverse(), function next() {
      for (; r.length;) {
        var t = r.pop();
        if (t in e) return next.value = t, next.done = !1, next;
      }
      return next.done = !0, next;
    };
  }, e.values = values, Context.prototype = {
    constructor: Context,
    reset: function reset(e) {
      if (this.prev = 0, this.next = 0, this.sent = this._sent = t, this.done = !1, this.delegate = null, this.method = "next", this.arg = t, this.tryEntries.forEach(resetTryEntry), !e) for (var r in this) "t" === r.charAt(0) && n.call(this, r) && !isNaN(+r.slice(1)) && (this[r] = t);
    },
    stop: function stop() {
      this.done = !0;
      var t = this.tryEntries[0].completion;
      if ("throw" === t.type) throw t.arg;
      return this.rval;
    },
    dispatchException: function dispatchException(e) {
      if (this.done) throw e;
      var r = this;
      function handle(n, o) {
        return a.type = "throw", a.arg = e, r.next = n, o && (r.method = "next", r.arg = t), !!o;
      }
      for (var o = this.tryEntries.length - 1; o >= 0; --o) {
        var i = this.tryEntries[o],
          a = i.completion;
        if ("root" === i.tryLoc) return handle("end");
        if (i.tryLoc <= this.prev) {
          var c = n.call(i, "catchLoc"),
            u = n.call(i, "finallyLoc");
          if (c && u) {
            if (this.prev < i.catchLoc) return handle(i.catchLoc, !0);
            if (this.prev < i.finallyLoc) return handle(i.finallyLoc);
          } else if (c) {
            if (this.prev < i.catchLoc) return handle(i.catchLoc, !0);
          } else {
            if (!u) throw Error("try statement without catch or finally");
            if (this.prev < i.finallyLoc) return handle(i.finallyLoc);
          }
        }
      }
    },
    abrupt: function abrupt(t, e) {
      for (var r = this.tryEntries.length - 1; r >= 0; --r) {
        var o = this.tryEntries[r];
        if (o.tryLoc <= this.prev && n.call(o, "finallyLoc") && this.prev < o.finallyLoc) {
          var i = o;
          break;
        }
      }
      i && ("break" === t || "continue" === t) && i.tryLoc <= e && e <= i.finallyLoc && (i = null);
      var a = i ? i.completion : {};
      return a.type = t, a.arg = e, i ? (this.method = "next", this.next = i.finallyLoc, y) : this.complete(a);
    },
    complete: function complete(t, e) {
      if ("throw" === t.type) throw t.arg;
      return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && e && (this.next = e), y;
    },
    finish: function finish(t) {
      for (var e = this.tryEntries.length - 1; e >= 0; --e) {
        var r = this.tryEntries[e];
        if (r.finallyLoc === t) return this.complete(r.completion, r.afterLoc), resetTryEntry(r), y;
      }
    },
    "catch": function _catch(t) {
      for (var e = this.tryEntries.length - 1; e >= 0; --e) {
        var r = this.tryEntries[e];
        if (r.tryLoc === t) {
          var n = r.completion;
          if ("throw" === n.type) {
            var o = n.arg;
            resetTryEntry(r);
          }
          return o;
        }
      }
      throw Error("illegal catch attempt");
    },
    delegateYield: function delegateYield(e, r, n) {
      return this.delegate = {
        iterator: values(e),
        resultName: r,
        nextLoc: n
      }, "next" === this.method && (this.arg = t), y;
    }
  }, e;
}
module.exports = _regeneratorRuntime, module.exports.__esModule = true, module.exports["default"] = module.exports;

/***/ }),

/***/ 4756:
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

// TODO(Babel 8): Remove this file.

var runtime = __webpack_require__(4633)();
module.exports = runtime;

// Copied from https://github.com/facebook/regenerator/blob/main/packages/runtime/runtime.js#L736=
try {
  regeneratorRuntime = runtime;
} catch (accidentalStrictMode) {
  if (typeof globalThis === "object") {
    globalThis.regeneratorRuntime = runtime;
  } else {
    Function("r", "regeneratorRuntime = r")(runtime);
  }
}


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be in strict mode.
(() => {
"use strict";

;// ./node_modules/@babel/runtime/helpers/esm/asyncToGenerator.js
function asyncGeneratorStep(n, t, e, r, o, a, c) {
  try {
    var i = n[a](c),
      u = i.value;
  } catch (n) {
    return void e(n);
  }
  i.done ? t(u) : Promise.resolve(u).then(r, o);
}
function _asyncToGenerator(n) {
  return function () {
    var t = this,
      e = arguments;
    return new Promise(function (r, o) {
      var a = n.apply(t, e);
      function _next(n) {
        asyncGeneratorStep(a, r, o, _next, _throw, "next", n);
      }
      function _throw(n) {
        asyncGeneratorStep(a, r, o, _next, _throw, "throw", n);
      }
      _next(void 0);
    });
  };
}

;// ./node_modules/@babel/runtime/helpers/esm/classCallCheck.js
function _classCallCheck(a, n) {
  if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function");
}

;// ./node_modules/@babel/runtime/helpers/esm/typeof.js
function _typeof(o) {
  "@babel/helpers - typeof";

  return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) {
    return typeof o;
  } : function (o) {
    return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o;
  }, _typeof(o);
}

;// ./node_modules/@babel/runtime/helpers/esm/toPrimitive.js

function toPrimitive(t, r) {
  if ("object" != _typeof(t) || !t) return t;
  var e = t[Symbol.toPrimitive];
  if (void 0 !== e) {
    var i = e.call(t, r || "default");
    if ("object" != _typeof(i)) return i;
    throw new TypeError("@@toPrimitive must return a primitive value.");
  }
  return ("string" === r ? String : Number)(t);
}

;// ./node_modules/@babel/runtime/helpers/esm/toPropertyKey.js


function toPropertyKey(t) {
  var i = toPrimitive(t, "string");
  return "symbol" == _typeof(i) ? i : i + "";
}

;// ./node_modules/@babel/runtime/helpers/esm/createClass.js

function _defineProperties(e, r) {
  for (var t = 0; t < r.length; t++) {
    var o = r[t];
    o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, toPropertyKey(o.key), o);
  }
}
function _createClass(e, r, t) {
  return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", {
    writable: !1
  }), e;
}

;// ./node_modules/@babel/runtime/helpers/esm/defineProperty.js

function _defineProperty(e, r, t) {
  return (r = toPropertyKey(r)) in e ? Object.defineProperty(e, r, {
    value: t,
    enumerable: !0,
    configurable: !0,
    writable: !0
  }) : e[r] = t, e;
}

// EXTERNAL MODULE: ./node_modules/@babel/runtime/regenerator/index.js
var regenerator = __webpack_require__(4756);
var regenerator_default = /*#__PURE__*/__webpack_require__.n(regenerator);
;// ./assets/js/admin/src/ajax-request.js
/**
 * General AJAX request handler
 *
 * @package
 * @since 4.0.0
 * @author YITH
 */

var AjaxRequest = {
  xhr: false,
  block: function block(wrap) {
    if (wrap && wrap.length && typeof jQuery.fn.block !== 'undefined') {
      wrap.addClass('ajax-blocked');
      wrap.block({
        message: null,
        overlayCSS: {
          background: '#fff no-repeat center',
          opacity: 0.5,
          cursor: 'none'
        }
      });
    }
  },
  unblock: function unblock(wrap) {
    if (wrap && wrap.hasClass('ajax-blocked') && typeof jQuery.fn.block !== 'undefined') {
      wrap.unblock();
      wrap.removeClass('ajax-blocked');
    }
  },
  call: function call(data, wrap, type) {
    var self = this;
    type = typeof type !== 'undefined' ? type : 'GET';
    if (Array.isArray(data)) {
      data.push({
        name: 'action',
        value: yith_wcmv_ajax.ajaxAction
      });
      data.push({
        name: 'security',
        value: yith_wcmv_ajax.ajaxNonce
      });
      data.push({
        name: 'context',
        value: 'admin'
      });
    } else {
      data.action = yith_wcmv_ajax.ajaxAction;
      data.security = yith_wcmv_ajax.ajaxNonce;
      data.context = 'admin';
    }
    self.block(wrap);
    self.xhr = jQuery.ajax({
      url: yith_wcmv_ajax.ajaxUrl,
      data: data,
      type: type
    }).fail(function (response) {
      console.log(response);
      self.unblock(wrap);
    }).done(function (response) {
      self.unblock(wrap);
      self.xhr = false;
    });
    return self.xhr;
  },
  get: function get(data, wrap) {
    return this.call(data, wrap, 'GET');
  },
  post: function post(data, wrap) {
    return this.call(data, wrap, 'POST');
  },
  abort: function abort() {
    if (this.xhr) {
      this.xhr.abort();
    }
  }
};
/* harmony default export */ const ajax_request = (AjaxRequest);
;// ./node_modules/@babel/runtime/helpers/esm/assertThisInitialized.js
function _assertThisInitialized(e) {
  if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
  return e;
}

;// ./node_modules/@babel/runtime/helpers/esm/possibleConstructorReturn.js


function _possibleConstructorReturn(t, e) {
  if (e && ("object" == _typeof(e) || "function" == typeof e)) return e;
  if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined");
  return _assertThisInitialized(t);
}

;// ./node_modules/@babel/runtime/helpers/esm/getPrototypeOf.js
function _getPrototypeOf(t) {
  return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) {
    return t.__proto__ || Object.getPrototypeOf(t);
  }, _getPrototypeOf(t);
}

;// ./node_modules/@babel/runtime/helpers/esm/superPropBase.js

function _superPropBase(t, o) {
  for (; !{}.hasOwnProperty.call(t, o) && null !== (t = _getPrototypeOf(t)););
  return t;
}

;// ./node_modules/@babel/runtime/helpers/esm/get.js

function _get() {
  return _get = "undefined" != typeof Reflect && Reflect.get ? Reflect.get.bind() : function (e, t, r) {
    var p = _superPropBase(e, t);
    if (p) {
      var n = Object.getOwnPropertyDescriptor(p, t);
      return n.get ? n.get.call(arguments.length < 3 ? e : r) : n.value;
    }
  }, _get.apply(null, arguments);
}

;// ./node_modules/@babel/runtime/helpers/esm/setPrototypeOf.js
function _setPrototypeOf(t, e) {
  return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) {
    return t.__proto__ = e, t;
  }, _setPrototypeOf(t, e);
}

;// ./node_modules/@babel/runtime/helpers/esm/inherits.js

function _inherits(t, e) {
  if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function");
  t.prototype = Object.create(e && e.prototype, {
    constructor: {
      value: t,
      writable: !0,
      configurable: !0
    }
  }), Object.defineProperty(t, "prototype", {
    writable: !1
  }), e && _setPrototypeOf(t, e);
}

;// ./assets/js/admin/src/fields-handler.js





/**
 * Common fields js handler
 *
 * @package YITH WooCommerce Multi Vendor
 * @since 4.0.0
 */
var FieldsHandler = /*#__PURE__*/function () {
  function FieldsHandler(container) {
    _classCallCheck(this, FieldsHandler);
    _defineProperty(this, "container", null);
    this.container = container;
  }
  return _createClass(FieldsHandler, [{
    key: "init",
    value: function init() {
      if (!this.container.length) {
        return false;
      }

      // Init deps and fields.
      jQuery(document).trigger('yith_fields_init');
      jQuery(document.body).trigger('yith-plugin-fw-init-radio');
      jQuery(document).trigger('yith-add-box-button-toggle');

      // Init fields.
      this.initValue();
      this.initEnhancedSelect();
      // Init textarea editor.
      this.initTinyMCE();

      // Listen field change.
      this.container.on('change', '.field-required', {
        self: this
      }, this.listenRequired);
      this.container.on('change', '.email-validate', {
        self: this
      }, this.validateEmail);
      // Prevent submit on error.
      this.container.closest('form').on('submit', this.checkFormErrors.bind(this));
    }
  }, {
    key: "initTinyMCE",
    value: function initTinyMCE() {
      if (typeof tinyMCE == 'undefined' || typeof tinyMCEPreInit == 'undefined') {
        return;
      }
      this.container.find('.editor textarea').each(function () {
        // init editor
        var id = jQuery(this).attr('id'),
          mceInit = tinyMCEPreInit.mceInit,
          mceKey = Object.keys(mceInit)[0],
          mce = mceInit[mceKey],
          // get quick tags options
          qtInit = tinyMCEPreInit.qtInit,
          qtKey = Object.keys(qtInit)[0],
          qt = mceInit[qtKey];

        // change id
        mce.selector = id;
        mce.body_class = mce.body_class.replace(mceKey, id);
        qt.id = id;
        tinyMCE.init(mce);
        tinyMCE.execCommand('mceRemoveEditor', true, id);
        tinyMCE.execCommand('mceAddEditor', true, id);
        quicktags(qt);
        QTags._buttonsInit();
      });
    }
  }, {
    key: "initValue",
    value: function initValue() {
      // Init fields value.
      this.container.find(':input').each(function () {
        var _current$data;
        var current = jQuery(this),
          value = (_current$data = current.data('value')) !== null && _current$data !== void 0 ? _current$data : null;
        if (current.is(':radio') || 'hidden' === current.attr('type') || null === value) {
          // Radio is handled by plugin-fw
          return;
        }
        if (current.is(':checkbox')) {
          var checked = current.is(':checked');
          if (!checked && 'yes' === value || checked && 'yes' !== value) {
            current.click();
          }
        } else {
          current.val(value);
        }
      });
    }
  }, {
    key: "initEnhancedSelect",
    value: function initEnhancedSelect() {
      // AjaxRequest module and selectWoo plugin are requested.
      if (typeof yith_wcmv_ajax === 'undefined' || typeof jQuery.fn.selectWoo === 'undefined') {
        return false;
      }
      this.container.find('select.yith-wcmv-ajax-search').filter(':not(.initialized)').each(function () {
        var _select$data;
        // Set value if any on data.
        var select = jQuery(this),
          values = (_select$data = select.data('value')) !== null && _select$data !== void 0 ? _select$data : null;
        if (null !== values) {
          for (var option in values) {
            select.append(new Option(values[option], option, true, true));
          }
        }
        select.trigger('change');
        select.selectWoo({
          allowClear: true,
          placeholder: jQuery(this).data('placeholder'),
          minimumInputLength: '3',
          escapeMarkup: function escapeMarkup(m) {
            return m;
          },
          ajax: {
            url: yith_wcmv_ajax.ajaxUrl,
            dataType: 'json',
            delay: 1000,
            data: function data(params) {
              return {
                term: params.term,
                request: jQuery(this).data('action'),
                action: yith_wcmv_ajax.ajaxAction,
                security: yith_wcmv_ajax.ajaxNonce,
                context: 'admin'
              };
            },
            processResults: function processResults(results) {
              var terms = [];
              if (results.success) {
                jQuery.each(results.data, function (id, text) {
                  terms.push({
                    id: id,
                    text: text
                  });
                });
              }
              return {
                results: terms
              };
            },
            cache: true
          }
        }).addClass('initialized').on('select2:select', function (event) {
          select.find('option.value-placeholder').remove();
        }).on('select2:unselect', function (event) {
          var unselected = event.params.data.id;
          select.find('option[value="' + unselected + '"]').remove();
          if (!select.find('option').length) {
            select.append('<option value="" class="value-placeholder"></option>');
          }
        });
      });

      // simple select!
      this.container.find('select').filter(':not(.initialized)').each(function () {
        var _select$data2;
        var select = jQuery(this),
          value = (_select$data2 = select.data('value')) !== null && _select$data2 !== void 0 ? _select$data2 : null,
          placeholder = jQuery(this).find('option').filter('[value=""]'),
          args = {
            minimumResultsForSearch: 20 // at least 20 results must be displayed
          };

        // Add placeholder if there is an empty option.
        if (placeholder.length) {
          args.placeholder = {
            id: '',
            // the value of the option
            text: placeholder.text()
          };
          args.allowClear = true;
        }
        if (null !== value) {
          value += ''; // Make sure value is text.
          select.val(value.split(',')).change();
        }
        select.selectWoo(args).addClass('initialized');
      });
    }
  }, {
    key: "isValidEmail",
    value: function isValidEmail(email) {
      return email.toLowerCase().match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
    }
  }, {
    key: "validateEmail",
    value: function validateEmail(event) {
      var self = event.data.self;
      var input = jQuery(this),
        value = input.val();
      if (value && !self.isValidEmail(value)) {
        var _yith_vendors;
        self.addFieldError((_yith_vendors = yith_vendors) === null || _yith_vendors === void 0 ? void 0 : _yith_vendors.emailFieldError, input.attr('name'));
      } else {
        self.resetFieldError(input.attr('name'));
      }
    }
  }, {
    key: "addFormError",
    value: function addFormError(error, wrap) {
      wrap.prepend('<div id="error-message">' + error + '</div>');
    }
  }, {
    key: "addFieldError",
    value: function addFieldError(error, field_name, wrap) {
      if (!wrap || !wrap.length) {
        wrap = this.container;
      }
      var field = wrap.find('[name="' + field_name + '"]');
      if (!field.length) {
        this.addFormError(error, wrap);
      }
      var error_wrap = field.next('.error-msg');
      // Add error class.
      field.addClass('field-error');
      // Add error.
      if (error_wrap.length) {
        error_wrap.html(error);
      } else {
        field.after('<span class="error-msg">' + error + '</span>');
      }
    }
  }, {
    key: "resetFormError",
    value: function resetFormError(wrap) {
      var _this = this;
      if (!wrap || !wrap.length) {
        wrap = this.container;
      }
      wrap.find('#error-message').remove();
      // Reset single fields.
      wrap.find('.field-error').each(function (i, field) {
        _this.resetFieldError(jQuery(field).attr('name'));
      });
    }
  }, {
    key: "resetFieldError",
    value: function resetFieldError(field_name) {
      if (field_name && this.container.find('[name="' + field_name + '"]')) {
        var field = this.container.find('[name="' + field_name + '"]');
        field.removeClass('field-error');
        field.next('.error-msg').remove();
      }
    }
  }, {
    key: "listenRequired",
    value: function listenRequired(event) {
      var self = event.data.self,
        field = jQuery(this),
        name = field.attr('name');
      if (!field.val()) {
        var _yith_vendors2;
        self.addFieldError((_yith_vendors2 = yith_vendors) === null || _yith_vendors2 === void 0 ? void 0 : _yith_vendors2.requiredFieldError, name);
      } else if (!field.hasClass('ajax-check')) {
        self.resetFieldError(name);
      }
    }
  }, {
    key: "isFormWithErrors",
    value: function isFormWithErrors() {
      var form = this.container.closest('form');
      form.find(':input').filter('.field-required').trigger('change');
      return !!form.find('#error-message, .field-error').length;
    }
  }, {
    key: "checkFormErrors",
    value: function checkFormErrors(event) {
      if (this.isFormWithErrors()) {
        event.preventDefault();
        jQuery('html').animate({
          scrollTop: this.container.find('#error-message, .field-error').first().offset().top - 100
        }, 1000);
      }
    }
  }]);
}();

;// ./assets/js/admin/src/vendor-fields-handler.js







function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _superPropGet(t, o, e, r) { var p = _get(_getPrototypeOf(1 & r ? t.prototype : t), o, e); return 2 & r && "function" == typeof p ? function (t) { return p.apply(e, t); } : p; }
/**
 * Vendor Fields js helper
 *
 * @package YITH WooCommerce Multi Vendor
 * @since 4.0.0
 */



var VendorFieldsHandler = /*#__PURE__*/function (_FieldsHandler) {
  function VendorFieldsHandler() {
    var _this;
    _classCallCheck(this, VendorFieldsHandler);
    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }
    _this = _callSuper(this, VendorFieldsHandler, [].concat(args));
    _defineProperty(_this, "states", null);
    return _this;
  }
  _inherits(VendorFieldsHandler, _FieldsHandler);
  return _createClass(VendorFieldsHandler, [{
    key: "init",
    value: function init() {
      if (typeof yith_wcmv_vendors !== 'undefined') {
        /* State/Country select boxes */
        this.states = JSON.parse(yith_wcmv_vendors.countries.replace(/&quot;/g, '"'));
      }

      // Init special image upload value.
      this.container.find('.vendor-image-upload-input').each(this.initImageValue.bind(this));
      // Event listener.
      this.container.on('change', '.country-field', {
        self: this
      }, this.changeCountry);
      jQuery('.country-field').change(); // init.
      // Handle image upload
      this.container.on('click', '.upload_vendor_image_button', {
        self: this
      }, this.uploadImage);
      this.container.on('click', '.remove_vendor_image_button', {
        self: this
      }, this.removeImage);
      _superPropGet(VendorFieldsHandler, "init", this, 3)([]);
      this.container.on('keyup', '.ajax-check', {
        self: this
      }, this.validateField);
      this.initSlugField();
    }
  }, {
    key: "addImage",
    value: function addImage(container, id, url) {
      container.find('input[type="hidden"]').val(id);
      container.css('background-image', 'url(' + url + ')');
      container.find('.upload_vendor_image_button').hide();
      container.find('.remove_vendor_image_button').show();
    }
  }, {
    key: "removeImage",
    value: function removeImage(event) {
      event.preventDefault();
      var container = jQuery(this).closest('.vendor-image-upload');
      container.find('input[type="hidden"]').val('');
      container.css('background-image', '');
      container.find('.upload_vendor_image_button').show();
      jQuery(this).hide();
      return false;
    }
  }, {
    key: "changeCountry",
    value: function changeCountry(event) {
      var self = event.data.self;
      // Prevent if we don't have the data.
      if (self.states === null) {
        return;
      }
      var $this = jQuery(this),
        country = $this.val(),
        $state = $this.closest('form').find('.state-field'),
        $parent = $state.parent(),
        stateValue = $state.val(),
        input_name = $state.attr('name'),
        input_id = $state.attr('id'),
        placeholder = $state.attr('placeholder'),
        $newstate;

      // Remove the previous DOM element.
      $parent.show().find('.select2-container').remove();
      if (!jQuery.isEmptyObject(self.states[country])) {
        var state = self.states[country],
          $defaultOption = jQuery('<option value=""></option>').text(yith_wcmv_vendors.i18nSelectStateText);
        $newstate = jQuery('<select></select>').prop('id', input_id).prop('name', input_name).prop('placeholder', placeholder).addClass('state-field').append($defaultOption);
        jQuery.each(state, function (index) {
          var $option = jQuery('<option></option>').prop('value', index).text(state[index]);
          if (index === stateValue) {
            $option.prop('selected');
          }
          $newstate.append($option);
        });
        $newstate.val(stateValue);
        $state.replaceWith($newstate);
        $newstate.show().selectWoo().hide().trigger('change');
      } else {
        $newstate = jQuery('<input type="text" />').prop('id', input_id).prop('name', input_name).prop('placeholder', placeholder).addClass('state-field').val(stateValue);
        $state.replaceWith($newstate);
      }
    }
  }, {
    key: "uploadImage",
    value: function uploadImage(event) {
      event.preventDefault();
      var self = event.data.self,
        container = jQuery(this).closest('.vendor-image-upload');

      // Create the media frame.
      var file_frame = wp.media.frames.downloadable_file = wp.media({
        title: yith_wcmv_vendors.uploadFrameTitle,
        button: {
          text: yith_wcmv_vendors.uploadFrameButtonText
        },
        multiple: false
      });

      // When an image is selected, run a callback.
      file_frame.on('select', function () {
        var attachment = file_frame.state().get('selection').first().toJSON();
        self.addImage(container, attachment.id, attachment.sizes.full.url);
      });

      // Finally, open the modal.
      file_frame.open();
    }
  }, {
    key: "initImageValue",
    value: function initImageValue(index, input) {
      var _current$data;
      var current = jQuery(input),
        value = (_current$data = current.data('value')) !== null && _current$data !== void 0 ? _current$data : null;
      if (null === value) {
        return;
      }
      for (var key in value) {
        this.addImage(current.parent(), key, value[key]);
      }
      current.removeAttr('data-value');
    }
  }, {
    key: "initSlugField",
    value: function initSlugField() {
      var slug = this.container.find('input#slug'),
        desc = slug.closest('.vendor-field').find('.description');
      desc.data('text', desc.text());
      slug.on('keyup', function () {
        var val = jQuery(this).val();
        if (val) {
          val = val.toLowerCase().replace(/[^0-9a-z-]+/, '-');
          desc.text(desc.data('text').replace('%yith_shop_vendor%', val));
          jQuery(this).val(val);
        } else {
          desc.text('');
        }
      }).keyup();
    }
  }, {
    key: "validateField",
    value: function validateField(event) {
      var self = event.data.self;
      // Call must be unique. Abort the current one if processing
      ajax_request.abort();
      var input = jQuery(this),
        value = input.val();

      // Reset field.
      input.removeClass('error success');
      if (!value.length) {
        return false;
      }

      // Add loading icon.
      input.addClass('loading');
      ajax_request.get({
        request: input.data('action'),
        value: value,
        vendor_id: self.container.find('input[name="vendor_id"]').val()
      }).fail(function () {
        input.removeClass('loading');
      }).done(function (res) {
        input.removeClass('loading');
        if (res.success) {
          input.addClass('success');
          self.resetFieldError(input.attr('name'));
        } else {
          input.addClass('error');
          self.addFieldError(res.data.error, input.attr('name'));
        }
      });
    }
  }]);
}(FieldsHandler);

;// ./assets/js/admin/src/vendors-table.js





/**
 * VENDORS TABLE JAVASCRIPT HANDLER
 *
 * @package
 * @since 4.0.0
 */



var VendorsTable = /*#__PURE__*/function () {
  function VendorsTable() {
    _classCallCheck(this, VendorsTable);
    _defineProperty(this, "tableSelector", '#vendors-list-table');
    _defineProperty(this, "table", null);
    _defineProperty(this, "modal", null);
    _defineProperty(this, "modalType", null);
    _defineProperty(this, "fieldsHandler", null);
    this.table = jQuery(this.tableSelector);
    this.init();
  }
  return _createClass(VendorsTable, [{
    key: "init",
    value: function init() {
      this.addHeadingCreateButton();
      jQuery(document).on('click', '.create-vendor', {
        self: this
      }, this.create);
      if (this.table.length) {
        this.table.on('click', '.view-vendor a', this.view);
        this.table.on('click', '.edit-vendor', {
          self: this
        }, this.edit);
        this.table.on('click', '.approve-vendor a', this.approve);
        this.table.on('click', '.reject-vendor a', this.reject);
      }
    }
  }, {
    key: "addHeadingCreateButton",
    value: function addHeadingCreateButton() {
      var _jQuery$find;
      (_jQuery$find = jQuery('#yith_wpv_panel_vendors-list').find('.yith-plugin-fw__panel__content__page__title')) === null || _jQuery$find === void 0 || _jQuery$find.after(jQuery('<a>', {
        href: '#',
        "class": 'create-vendor page-title-action',
        text: yith_wcmv_vendors.createVendorButtonLabel
      }));
    }
  }, {
    key: "initModalActions",
    value: function initModalActions() {
      if (null === this.modal) {
        return false;
      }
      this.modal.elements.title.on('click', '.steps-list a', {
        self: this
      }, this.navToStep);
      this.modal.elements.content.on('click', '.owner-navigation a', {
        self: this
      }, this.vendorOwnerNav);
      this.modal.elements.content.on('click', '.vendor-field .set-password', this.showPasswordField);
      this.modal.elements.footer.on('click', '.vendor-next-step', {
        self: this
      }, this.nextStep);
      this.modal.elements.footer.on('click', '.vendor-modal-submit', this.submitForm.bind(this));
    }
  }, {
    key: "create",
    value: function create(event) {
      event.preventDefault();
      event.data.self.openModal({
        type: 'create',
        "class": 'yith-wcmv-create-vendor-modal',
        content: yith_wcmv_vendors.createModalDefault
      });
    }
  }, {
    key: "view",
    value: function view(event) {
      event.preventDefault();
      window.open(jQuery(this).attr('href'), '_blank');
    }
  }, {
    key: "edit",
    value: function edit(event) {
      event.preventDefault();
      var self = event.data.self;
      var trigger = jQuery(this),
        vendor_id = trigger.data('vendor_id'),
        data = {
          request: 'get-vendor-data',
          vendor_id: vendor_id
        };
      ajax_request.call(data, trigger.closest('td'), 'GET').done(function (res) {
        if (res.success) {
          var _data = {
            modalType: 'edit'
          };
          self.openModal({
            type: 'edit',
            "class": 'yith-wcmv-edit-vendor-modal',
            header: _data,
            content: res.data !== 'undefined' ? jQuery.extend({}, _data, res.data) : {}
          });
        }
      });
    }
  }, {
    key: "approve",
    value: function approve(event) {
      event.preventDefault();
      var wrap = jQuery(this).closest('td'),
        data = {
          vendor_id: jQuery(this).parent().data('vendor_id'),
          request: 'approve-vendor'
        };
      ajax_request.call(data, wrap, 'POST').done(function (res) {
        var _res$data;
        if (res !== null && res !== void 0 && res.success && res !== null && res !== void 0 && res.data && (_res$data = res.data) !== null && _res$data !== void 0 && _res$data.html) {
          wrap.html(res.data.html);
        }
      });
    }
  }, {
    key: "reject",
    value: function reject(event) {
      event.preventDefault();
      var contentTemplate = wp.template('yith-wcmv-modal-vendor-reject');
      var wrap = jQuery(this).closest('td'),
        trigger = jQuery(this),
        vendor_name = trigger.closest('tr').find('td.name .edit-vendor').text();
      var modal = yith.ui.modal({
        title: yith_wcmv_vendors.rejectVendorModalTitle,
        content: contentTemplate({
          vendor: vendor_name
        }),
        footer: '',
        width: 350,
        classes: {
          wrap: 'yith-wcmv-reject-vendor-modal',
          content: 'yith-plugin-ui'
        }
      });
      modal.elements.content.find('form').on('submit', function (event) {
        event.preventDefault();
        var data = {
          vendor_id: trigger.parent().data('vendor_id'),
          message: jQuery('#reject-reason').val(),
          request: 'reject-vendor'
        };
        ajax_request.call(data, modal.elements.main, 'POST').done(function (res) {
          var _res$data2;
          modal.close();
          if (res !== null && res !== void 0 && res.success && res !== null && res !== void 0 && res.data && (_res$data2 = res.data) !== null && _res$data2 !== void 0 && _res$data2.html) {
            wrap.html(res.data.html);
          }
        });
      });
    }
  }, {
    key: "openModal",
    value: function openModal(data) {
      var self = this;
      var defaults = {
        type: 'create',
        "class": '',
        header: {},
        content: {},
        footer: {}
      };
      if (null !== this.modal) {
        return false;
      }
      var headerTemplate = wp.template('yith-wcmv-modal-vendor-modal-header'),
        contentTemplate = wp.template('yith-wcmv-modal-vendor-modal-content'),
        footerTemplate = wp.template('yith-wcmv-modal-vendor-modal-footer');
      data = jQuery.extend({}, defaults, data);
      self.modal = yith.ui.modal({
        title: headerTemplate(data.header),
        content: contentTemplate(data.content),
        footer: footerTemplate(data.footer),
        width: 1000,
        classes: {
          wrap: data["class"],
          content: 'yith-plugin-ui'
        },
        closeSelector: '.vendor-close-modal',
        onCreate: function onCreate() {
          self.modalType = data.type;
          self.fieldsHandler = new VendorFieldsHandler(jQuery('.yith-plugin-fw__modal__content'));
          self.fieldsHandler.init();
        },
        onClose: function onClose() {
          self.modal = null;
          self.modalType = null;
        }
      });
      self.initModalActions();
      jQuery(document).trigger('yith_wcmv_vendors_modal_opened', [self.modal, self.modalType]);
    }
  }, {
    key: "goToStep",
    value: function () {
      var _goToStep = _asyncToGenerator(/*#__PURE__*/regenerator_default().mark(function _callee(stepID) {
        var step, owner;
        return regenerator_default().wrap(function _callee$(_context) {
          while (1) switch (_context.prev = _context.next) {
            case 0:
              step = this.modal.elements.title.find('li[data-step="' + stepID + '"]');
              if (step.length) {
                _context.next = 3;
                break;
              }
              return _context.abrupt("return", false);
            case 3:
              _context.next = 5;
              return this.maybeCreateOwner();
            case 5:
              owner = _context.sent;
              if (owner !== null && owner !== void 0 && owner.success) {
                _context.next = 8;
                break;
              }
              return _context.abrupt("return", false);
            case 8:
              // Update Nav.
              step.removeClass('done').addClass('current').prevAll().removeClass('current').addClass('done').end().nextAll().removeClass('current done');

              // Update Content.
              this.modal.elements.content.find('fieldset[data-step="' + stepID + '"]').siblings('fieldset').hide().end().fadeIn();

              // If is modal create, update also footer buttons
              if ('create' === this.modalType) {
                if (!step.next().length) {
                  this.modal.elements.footer.find('.vendor-next-step').hide().end().find('.vendor-modal-submit').show();
                } else {
                  this.modal.elements.footer.find('.vendor-modal-submit').hide().end().find('.vendor-next-step').show();
                }
              }
            case 11:
            case "end":
              return _context.stop();
          }
        }, _callee, this);
      }));
      function goToStep(_x) {
        return _goToStep.apply(this, arguments);
      }
      return goToStep;
    }()
  }, {
    key: "navToStep",
    value: function navToStep(event) {
      event.preventDefault();
      var self = event.data.self,
        trigger = jQuery(this);
      if (self.isFormWithError()) {
        return false;
      }

      // Nav only done steps for create modal.
      if ('create' === self.modalType && !trigger.parent().hasClass('done')) {
        return false;
      }
      self.goToStep(trigger.attr('href').replace('#', ''));
    }
  }, {
    key: "getCurrentStep",
    value: function getCurrentStep() {
      return this.modal.elements.title.find('.steps-list li.current').data('step');
    }
  }, {
    key: "nextStep",
    value: function nextStep(event) {
      event.preventDefault();
      var self = event.data.self;
      var currentStep = self.getCurrentStep();
      if (!currentStep || self.isFormWithError()) {
        return false;
      }
      var nextStep = self.modal.elements.title.find('li[data-step="' + currentStep + '"]').next().data('step');
      if (nextStep) {
        self.goToStep(nextStep);
      }
    }
  }, {
    key: "vendorOwnerNav",
    value: function vendorOwnerNav(event) {
      var _event$data$self$fiel;
      event.preventDefault();
      var trigger = jQuery(this),
        wrap = trigger.closest('.vendor-owner-wrapper'),
        dest = wrap.find(trigger.attr('href'));
      trigger.addClass('current').siblings().removeClass('current');
      dest.fadeIn().siblings(':not( .owner-navigation )').hide();
      (_event$data$self$fiel = event.data.self.fieldsHandler) === null || _event$data$self$fiel === void 0 || _event$data$self$fiel.resetFormError(wrap);
    }
  }, {
    key: "maybeCreateOwner",
    value: function maybeCreateOwner() {
      var _this = this;
      if (!this.modal.elements.content.find('#create-owner').is(':visible')) {
        return {
          success: true
        };
      }
      var data = {};
      jQuery.each(this.modal.elements.content.find('form').serializeArray(), function (i, item) {
        if (0 === item.name.indexOf('new_owner_')) {
          data[item.name] = item.value;
        }
      });
      data.request = 'create_owner';
      return ajax_request.post(data, this.modal.elements.content).done(function (res) {
        var wrap = _this.modal.elements.content.find('#create-owner');
        if (res.success) {
          var _this$fieldsHandler;
          // add new owner.
          var newOption = new Option(res.data.name, res.data.id, true, true);

          // Reset errors.
          (_this$fieldsHandler = _this.fieldsHandler) === null || _this$fieldsHandler === void 0 || _this$fieldsHandler.resetFormError(wrap);
          _this.modal.elements.content.find('.yith-wcmv-owner-select').append(newOption).trigger('change');
          _this.modal.elements.content.find('#create-owner').find('input').val('');
          _this.modal.elements.content.find('.owner-navigation a').first().click();
        } else {
          var _this$fieldsHandler2;
          (_this$fieldsHandler2 = _this.fieldsHandler) === null || _this$fieldsHandler2 === void 0 || _this$fieldsHandler2.addFieldError(res.data.message, res.data.field, wrap);
        }
      });
    }
  }, {
    key: "showPasswordField",
    value: function showPasswordField(event) {
      event.preventDefault();
      jQuery(this).hide().next().fadeIn();
    }
  }, {
    key: "submitForm",
    value: function () {
      var _submitForm = _asyncToGenerator(/*#__PURE__*/regenerator_default().mark(function _callee2() {
        var owner;
        return regenerator_default().wrap(function _callee2$(_context2) {
          while (1) switch (_context2.prev = _context2.next) {
            case 0:
              _context2.next = 2;
              return this.maybeCreateOwner();
            case 2:
              owner = _context2.sent;
              if (owner !== null && owner !== void 0 && owner.success && !this.isFormWithError()) {
                if (typeof jQuery.fn.block !== 'undefined') {
                  this.modal.elements.main.block({
                    message: null,
                    overlayCSS: {
                      background: '#fff no-repeat center',
                      opacity: 0.5,
                      cursor: 'none'
                    }
                  });
                }
                this.modal.elements.content.find('form').submit();
              }
            case 4:
            case "end":
              return _context2.stop();
          }
        }, _callee2, this);
      }));
      function submitForm() {
        return _submitForm.apply(this, arguments);
      }
      return submitForm;
    }() // ERRORS HANDLER
  }, {
    key: "isFormWithError",
    value: function isFormWithError() {
      var _this2 = this;
      var wrap = this.modal !== null ? this.modal.elements.content : '';
      if (!wrap.length) {
        return false;
      }
      // Check for single field.
      wrap.find('.field-required').filter(':visible').each(function (i, field) {
        if (!jQuery(field).closest('.field-error').length && !jQuery(field).val()) {
          var _this2$fieldsHandler;
          (_this2$fieldsHandler = _this2.fieldsHandler) === null || _this2$fieldsHandler === void 0 || _this2$fieldsHandler.addFieldError(yith_vendors.requiredFieldError, jQuery(field).attr('name'));
        }
      });
      var errors = wrap.find('#error-message, .field-error');
      if (!errors.length) {
        return false;
      }
      var step = errors.last().closest('.step-content').attr('data-step');
      if (step !== this.getCurrentStep) {
        this.goToStep(step);
      }
      return true;
    }
  }]);
}();

;// ./assets/js/admin/src/vendor-registration-table.js




/**
 * Vendor registration table custom field JS
 *
 * @package YITH WooCommerce Multi Vendor
 * @since 4.0.0
 */



var VendorRegistrationTable = /*#__PURE__*/function () {
  function VendorRegistrationTable() {
    _classCallCheck(this, VendorRegistrationTable);
    _defineProperty(this, "field_handler", void 0);
    this.init();
  }
  return _createClass(VendorRegistrationTable, [{
    key: "init",
    value: function init() {
      this.table = jQuery('.yith-vendor-registration-table-wrapper');
      this.form = null;
      this.modal = null;
      if (this.table.length) {
        this.initSortable();
        this.table.on('click', '.yith-vendor-registration-table__add-fields', {
          self: this
        }, this.addField);
        this.table.on('click', '.yith-vendor-registration-table__edit-field', {
          self: this
        }, this.editField);
        this.table.on('click', '.yith-vendor-registration-table__delete-field', {
          self: this
        }, this.deleteField);
        this.table.on('click', '.yith-vendor-registration-table__restore-default', {
          self: this
        }, this.formReset);
        this.table.on('change', 'input[name="active"]', {
          self: this
        }, this.fieldActiveSwitch);
      }
    }
  }, {
    key: "initSortable",
    value: function initSortable() {
      var self = this,
        items_wrapper = self.table.find('tbody'),
        items = items_wrapper.find('tr');
      if (items.length > 1) {
        items_wrapper.sortable({
          handle: '.yith-vendor-registration-table__drag-field',
          cursor: 'move',
          scrollSensitivity: 10,
          tolerance: 'pointer',
          axis: 'y',
          stop: function stop(event, ui) {
            var order = [];
            items_wrapper.find('tr').each(function () {
              order.push(jQuery(this).data('id'));
            });
            ajax_request.post({
              request: 'registration_table_order_fields',
              order: order
            }, self.table);
          }
        }).disableSelection();
      }
    }
  }, {
    key: "modalActions",
    value: function modalActions() {
      if (this.modal) {
        this.form = this.modal.elements.content.find('#vendor-registration-field-form');
        this.form.on('keyup', '#name', this.sanitizeFieldName);
        this.form.on('change', '#name', {
          self: this
        }, this.checkDuplicatedName);
        // Handle options.
        this.initTableOptions();
        this.form.on('click', '#add_new_option', this.addNewOption.bind(this));
        this.form.on('click', '.options-table .delete', this.deleteOption);
        // Handle submit form.
        this.modal.elements.footer.on('click', '.vendor-registration-field-form-submit', {
          self: this
        }, this.formSubmit);
      }
    }
  }, {
    key: "sanitizeFieldName",
    value: function sanitizeFieldName() {
      var value = jQuery(this).val();
      // Format value.
      value = value.toLowerCase().replace(/[^0-9a-z-]+/, '-');
      // Set new value.
      jQuery(this).val(value);
    }
  }, {
    key: "checkDuplicatedName",
    value: function checkDuplicatedName(event) {
      var self = event.data.self;
      var value = jQuery(this).val();
      if (value) {
        if (self.table.find('tr:not(.editing)').filter('tr[data-name="' + value + '"]').length) {
          self.field_handler.addFieldError(jQuery(this).data('error'), 'registration_form[name]');
        } else {
          self.field_handler.resetFieldError('registration_form[name]');
        }
      }
    }
  }, {
    key: "tableReplace",
    value: function tableReplace(newTable) {
      this.table.replaceWith(newTable);
      this.init(); // Refresh form.
    }
  }, {
    key: "openModal",
    value: function openModal(data, title) {
      var self = this,
        contentTemplate = wp.template('yith-wcmv-modal-registration-form'),
        footerTemplate = wp.template('yith-wcmv-modal-registration-form-footer');
      var tableRows = this.table.find('tr[data-name]');
      this.modal = yith.ui.modal({
        title: title,
        content: contentTemplate(data),
        footer: footerTemplate(),
        width: 550,
        classes: {
          wrap: 'yith-vendor-registration-form-modal',
          content: 'yith-plugin-ui'
        },
        onCreate: function onCreate() {
          var formTable = jQuery('#vendor-registration-field-form .form-table');
          self.field_handler = new FieldsHandler(formTable);
          self.field_handler.init();

          // Handle special field vendor-name
          if ('vendor-name' === (data === null || data === void 0 ? void 0 : data.field_id)) {
            formTable.find(':input').filter(function () {
              return -1 === jQuery.inArray(this.id, ['label', 'class', 'placeholder', 'position']);
            }).closest('tr').remove();
          }
          if (!jQuery.isEmptyObject(data)) {
            tableRows.filter('[data-name="' + data.name + '"]').addClass('editing');
          }
        },
        onClose: function onClose() {
          tableRows.removeClass('editing');
        }
      });
      this.modalActions();
    }
  }, {
    key: "addField",
    value: function addField(event) {
      event.preventDefault();
      event.data.self.openModal(yith_wcmv_vendors.registrationTableFieldsDefault, yith_wcmv_vendors.registrationModalAddTitle);
    }
  }, {
    key: "editField",
    value: function editField(event) {
      event.preventDefault();
      var row = jQuery(this).closest('tr'),
        options = jQuery(this).closest('tr').data('options');
      if (typeof options === 'undefined') {
        return;
      }
      options.options = JSON.stringify(options.options); // Stringify options.
      options.field_id = row.data('id'); // Add row ID.
      event.data.self.openModal(options, yith_wcmv_vendors.registrationModalEditTitle);
    }
  }, {
    key: "deleteField",
    value: function deleteField(event) {
      event.preventDefault();
      var self = event.data.self,
        field_id = jQuery(this).closest('tr').data('id');
      if (!field_id) {
        return false;
      }
      yith.ui.confirm({
        title: yith_wcmv_vendors.registrationDeleteFieldTitle,
        message: yith_wcmv_vendors.registrationDeleteFieldContent,
        confirmButtonType: 'delete',
        confirmButton: yith_wcmv_vendors.registrationDeleteFieldButton,
        closeAfterConfirm: true,
        onConfirm: function onConfirm() {
          var data = {
            request: 'registration_table_field_delete',
            field_id: field_id
          };
          ajax_request.call(data, self.table, 'POST').done(function (res) {
            if (res.success && res.data !== 'undefined') {
              self.tableReplace(res.data.html);
            }
          });
        }
      });
    }
  }, {
    key: "formSubmit",
    value: function formSubmit(event) {
      event.preventDefault();
      var self = event.data.self;

      // Trigger name check!
      self.form.find('#name').trigger('change');
      if (self.field_handler.isFormWithErrors()) {
        return false;
      }
      var data = self.form.serializeArray();

      // Add request param and do AJAX request
      data.push({
        name: 'request',
        value: 'registration_table_field_save'
      });
      self.modal.close();
      ajax_request.call(data, self.table, 'POST').done(function (res) {
        if (res.success && res.data !== 'undefined') {
          self.tableReplace(res.data.html);
        }
      });
    }
  }, {
    key: "fieldActiveSwitch",
    value: function fieldActiveSwitch(event) {
      event.preventDefault();
      event.stopImmediatePropagation();
      var input = jQuery(this),
        self = event.data.self;
      var data = {
        request: 'registration_table_field_active_switch',
        field_id: input.closest('tr').data('id'),
        active: input.is(':checked') ? 'yes' : 'no'
      };
      ajax_request.call(data, self.table, 'POST').done(function (res) {
        if (res.success && res.data !== 'undefined') {
          self.tableReplace(res.data.html);
        }
      });
    }
  }, {
    key: "formReset",
    value: function formReset(event) {
      event.preventDefault();
      var self = event.data.self;
      yith.ui.confirm({
        title: yith_wcmv_vendors.registrationTableResetTitle,
        message: yith_wcmv_vendors.registrationTableResetContent,
        confirmButtonType: 'delete',
        confirmButton: yith_wcmv_vendors.registrationTableResetButton,
        closeAfterConfirm: true,
        onConfirm: function onConfirm() {
          ajax_request.call({
            request: 'registration_table_fields_reset'
          }, self.table, 'POST').done(function (res) {
            if (res.success && res.data !== 'undefined') {
              self.tableReplace(res.data.html);
            }
          });
        }
      });
    }

    // OPTIONS HANDLER
  }, {
    key: "initTableOptions",
    value: function initTableOptions() {
      var _this = this;
      var table = this.form.find('table.options-table'),
        value = table.data('value');
      // Add an empty row if there aren't any row.
      if (_typeof(value) !== 'object') {
        this.addOption();
      } else {
        var i = 0;
        jQuery.each(value, function (value, label) {
          _this.addOption(i, value, label);
          i++;
        });
      }

      // Init sortable
      table.find('tbody').sortable({
        handle: '.drag',
        cursor: 'move',
        scrollSensitivity: 10,
        tolerance: 'pointer',
        axis: 'y'
      });
    }
  }, {
    key: "addNewOption",
    value: function addNewOption(event) {
      event.preventDefault();
      var index = 0;
      // Get the higher index value
      while (this.form.find('table.options-table tr[data-index="' + index + '"]').length) {
        index++;
      }
      this.addOption(index);
    }
  }, {
    key: "addOption",
    value: function addOption() {
      var index = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
      var value = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
      var label = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : '';
      var table = this.form.find('table.options-table'),
        name = table.data('name');
      table.find('tbody').append('<tr data-index="' + index + '">' + '<td class="column-label"><input type="text" name="' + name + '[' + index + '][label]" id="options_' + index + '_label" value="' + label + '"></td>' + '<td class="column-value"><input type="text" name="' + name + '[' + index + '][value]" id="options_' + index + '_value" value="' + value + '"></td>' + '<td class="column-actions"><span class="drag yith-icon yith-icon-drag ui-sortable-handle"></span><a href="#" role="button" class="delete yith-icon yith-icon-trash"></a></td>' + '</tr>');
    }
  }, {
    key: "deleteOption",
    value: function deleteOption(event) {
      event.preventDefault();
      jQuery(this).closest('tr').remove();
    }
  }]);
}();

;// ./assets/js/admin/src/vendors.js
/**
 * Vendor TAB js
 *
 * @package YITH WooCommerce Multi Vendor
 * @since 4.0.0
 */




if (jQuery('.vendors-list-table-wrapper').length) {
  new VendorsTable();
}
if (jQuery('.yith-vendor-registration-table-wrapper').length) {
  new VendorRegistrationTable();
}
jQuery(document.body).on('click', '.yith_wpv_vendors_skip_review_for_all', function (event) {
  event.preventDefault();
  var button = jQuery(this);
  yith.ui.confirm({
    title: '',
    message: yith_vendors.forceSkipMessage,
    onConfirm: function onConfirm() {
      ajax_request.call({
        request: button.data('action')
      }, button, 'POST');
    }
  });
});
})();

var __webpack_export_target__ = window;
for(var __webpack_i__ in __webpack_exports__) __webpack_export_target__[__webpack_i__] = __webpack_exports__[__webpack_i__];
if(__webpack_exports__.__esModule) Object.defineProperty(__webpack_export_target__, "__esModule", { value: true });
/******/ })()
;
//# sourceMappingURL=vendors.js.map