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

;// ./node_modules/@babel/runtime/helpers/esm/defineProperty.js

function _defineProperty(e, r, t) {
  return (r = toPropertyKey(r)) in e ? Object.defineProperty(e, r, {
    value: t,
    enumerable: !0,
    configurable: !0,
    writable: !0
  }) : e[r] = t, e;
}

;// ./assets/js/frontend/src/report-abuse.js



/**
 * Report abuse modal handler
 *
 * @package YITH WooCommerce Multi Vendor
 * @since 4.0.0
 * @author YITH
 */
var VendorReportAbuse = /*#__PURE__*/function () {
  function VendorReportAbuse(trigger) {
    _classCallCheck(this, VendorReportAbuse);
    _defineProperty(this, "modal", void 0);
    _defineProperty(this, "modalWrap", void 0);
    this.initModal();
    if (this.modal.length) {
      this.modal.on('click', '.yith-wpv-abuse-report-modal-close', this.closeModal.bind(this));
      this.modal.on('submit', 'form', this.submitModal.bind(this));
      trigger.on('click', this.openModal.bind(this));
    }
  }
  return _createClass(VendorReportAbuse, [{
    key: "initModal",
    value: function initModal() {
      // Granted backward compatibility with old templates.
      this.modal = jQuery(document).find('#yith-wpv-abuse-report');
      if (this.modal.length) {
        this.wrap = this.modal.closest('#yith-wpv-abuse-report-modal');

        // If wrap doesn't exists, add it!
        if (!this.wrap.length) {
          this.modal.wrap('<div id="yith-wpv-abuse-report-modal"></div>');
          this.wrap = this.modal.closest('#yith-wpv-abuse-report-modal');
        }
      }
    }
  }, {
    key: "openModal",
    value: function openModal(event) {
      event.preventDefault();
      // Load the template.
      this.setModalContent('yith-wcmv-abuse-report-content');
      // Show modal.
      this.wrap.show();
      this.modal.fadeIn();
    }
  }, {
    key: "setModalContent",
    value: function setModalContent(template) {
      var content = wp.template(template);
      if (typeof content !== 'undefined') {
        this.modal.html(content());
      }

      // Add close trigger if missing. Added with JS for backward compatibility.
      if (!this.modal.find('.yith-wpv-abuse-report-modal-close').length) {
        this.modal.prepend('<span class="yith-wpv-abuse-report-modal-close"></span>');
      }
    }
  }, {
    key: "addModalError",
    value: function addModalError(error) {
      var error_wrap = this.modal.find('.yith-wpv-abuse-report-modal-error');
      if (!error_wrap.length) {
        this.modal.find('.yith-wpv-abuse-report-title').after('<div class="yith-wpv-abuse-report-modal-error">' + error + '</div>');
      } else {
        error_wrap.html(error);
      }
    }
  }, {
    key: "submitModal",
    value: function submitModal(event) {
      event.preventDefault();
      var self = this;
      var form = self.modal.find('form'),
        data = form.serializeArray();
      data.push({
        name: 'context',
        value: 'frontend'
      });
      jQuery.ajax({
        url: woocommerce_params.wc_ajax_url.toString().replace('%%endpoint%%', 'send_report_abuse'),
        data: data,
        method: 'POST',
        dataType: 'json',
        beforeSend: function beforeSend() {
          if (typeof jQuery.fn.block !== 'undefined') {
            self.modal.block({
              message: null,
              overlayCSS: {
                background: '#fff no-repeat center',
                opacity: 0.5,
                cursor: 'none'
              }
            });
          }
        },
        error: function error(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        },
        success: function success(response) {
          if (response !== null && response !== void 0 && response.success) {
            // Load the template.
            self.setModalContent('yith-wcmv-abuse-report-sent');
            setTimeout(function () {
              self.closeModal();
            }, 5000);
          } else {
            self.addModalError(response === null || response === void 0 ? void 0 : response.data);
          }
        },
        complete: function complete() {
          if (typeof jQuery.fn.block !== 'undefined') {
            self.modal.unblock();
          }
        }
      });
    }
  }, {
    key: "closeModal",
    value: function closeModal(event) {
      this.wrap.hide();
      this.modal.hide().html('');
    }
  }]);
}();
jQuery(document).ready(function () {
  var trigger = jQuery(document).find('#yith-wpv-abuse');
  if (trigger.length) {
    new VendorReportAbuse(trigger);
  }
});
var __webpack_export_target__ = window;
for(var __webpack_i__ in __webpack_exports__) __webpack_export_target__[__webpack_i__] = __webpack_exports__[__webpack_i__];
if(__webpack_exports__.__esModule) Object.defineProperty(__webpack_export_target__, "__esModule", { value: true });
/******/ })()
;
//# sourceMappingURL=report-abuse.js.map