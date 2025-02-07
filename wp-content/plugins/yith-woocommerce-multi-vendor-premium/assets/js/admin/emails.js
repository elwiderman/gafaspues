/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};

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
;// ./assets/js/admin/src/emails.js


/**
 * ADDONS JAVASCRIPT HANDLER
 *
 * @package
 * @since 4.0.0
 */


var VendorEmails = /*#__PURE__*/function () {
  function VendorEmails() {
    _classCallCheck(this, VendorEmails);
    var container = jQuery('#emails-container');
    container.on('change', '.single-email-toggle-active .on_off', this.toggleActive);
    container.on('click', '.single-email-toggle-editing a', this.toggleSettings);
    container.on('submit', '.single-email-settings-form', this.saveSettings);
  }
  return _createClass(VendorEmails, [{
    key: "toggleActive",
    value: function toggleActive() {
      var input = jQuery(this);
      var emailWrap = input.closest('.single-email');
      var emailKey = emailWrap.attr('data-key');

      // Make sure the WC alert is removed
      window.onbeforeunload = '';
      ajax_request.call({
        request: 'email_active_toggle',
        email: emailKey,
        status: input.is(':checked') ? 'yes' : 'no'
      }, emailWrap, 'POST').fail(function (response) {
        console.log(response);
        input.attr('checked', !input.is(':checked'));
      });
    }
  }, {
    key: "toggleSettings",
    value: function toggleSettings(event) {
      event.preventDefault();
      var emailWrap = jQuery(this).closest('.single-email');
      emailWrap.toggleClass('opened').find('.single-email-options').slideToggle();
    }
  }, {
    key: "saveSettings",
    value: function saveSettings(event) {
      event.preventDefault();
      var form = jQuery(this);
      var emailWrap = form.closest('.single-email');

      // Make sure the WC alert is removed
      window.onbeforeunload = '';
      ajax_request.call(form.serializeArray(), emailWrap, 'POST').done(function (response) {
        var button = form.find('.single-email-save'),
          buttonText = button.val();
        button.val(button.attr('data-saved-message'));
        setTimeout(function () {
          button.val(buttonText);
        }, 5000);
      }).fail(function (response) {
        console.log(response);
        input.attr('checked', !input.is(':checked'));
      });
    }
  }]);
}();
if (jQuery('#emails-container .single-email').length) {
  new VendorEmails();
}
var __webpack_export_target__ = window;
for(var __webpack_i__ in __webpack_exports__) __webpack_export_target__[__webpack_i__] = __webpack_exports__[__webpack_i__];
if(__webpack_exports__.__esModule) Object.defineProperty(__webpack_export_target__, "__esModule", { value: true });
/******/ })()
;
//# sourceMappingURL=emails.js.map