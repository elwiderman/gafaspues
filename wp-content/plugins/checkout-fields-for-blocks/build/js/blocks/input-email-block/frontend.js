(()=>{"use strict";var e={20:(e,t,o)=>{var l=o(609),a=Symbol.for("react.element"),r=(Symbol.for("react.fragment"),Object.prototype.hasOwnProperty),s=l.__SECRET_INTERNALS_DO_NOT_USE_OR_YOU_WILL_BE_FIRED.ReactCurrentOwner,c={key:!0,ref:!0,__self:!0,__source:!0};t.jsx=function(e,t,o){var l,i={},n=null,d=null;for(l in void 0!==o&&(n=""+o),void 0!==t.key&&(n=""+t.key),void 0!==t.ref&&(d=t.ref),t)r.call(t,l)&&!c.hasOwnProperty(l)&&(i[l]=t[l]);if(e&&e.defaultProps)for(l in t=e.defaultProps)void 0===i[l]&&(i[l]=t[l]);return{$$typeof:a,type:e,key:n,ref:d,props:i,_owner:s.current}}},848:(e,t,o)=>{e.exports=o(20)},609:e=>{e.exports=window.React}},t={};const o=window.wc.blocksCheckout,l=window.wp.i18n,a=window.wp.element,r=window.wp.url,s={required:{validate:e=>e&&""!==e.trim()?null:(0,l.__)("This field is required.","checkout-fields-for-blocks")},email:{validate:e=>(0,r.isEmail)(e)?null:(0,l.__)("Please enter a valid email address.","checkout-fields-for-blocks")},phone:{validate:e=>e&&!/^\+?[\d\s()-]{10,}$/.test(e)?(0,l.__)("Please enter a valid phone number.","checkout-fields-for-blocks"):null},url:{validate:e=>{try{return new URL(e),null}catch{return(0,l.__)("Please enter a valid URL.","checkout-fields-for-blocks")}}},minLength:{validate:(e,t)=>e.length>0&&e.length<t.value?(0,l.sprintf)(/* translators: %d is the number of characters. */ /* translators: %d is the number of characters. */
(0,l.__)("This field must be at least %d characters long.","checkout-fields-for-blocks"),t.value):null},maxLength:{validate:(e,t)=>e.length>0&&e.length>t.value?(0,l.sprintf)(/* translators: %d is the number of characters. */ /* translators: %d is the number of characters. */
(0,l.__)("This field must not exceed %d characters.","checkout-fields-for-blocks"),t.value):null},pattern:{validate:(e,t)=>new RegExp(t.value).test(e)?null:(0,l.__)("This field does not match the required pattern.","checkout-fields-for-blocks")}};var c=function o(l){var a=t[l];if(void 0!==a)return a.exports;var r=t[l]={exports:{}};return e[l](r,r.exports,o),r.exports}(848);const i=({fieldId:e,fieldName:t,metaName:l,label:r,className:i,defaultValue:n,validationSettings:d,inputType:u,helpText:f,checkoutExtensionData:p})=>{const{setExtensionData:m}=p,[h,k]=(0,a.useState)(n||""),b=`${l}-${e}`,v=(0,a.useMemo)((()=>JSON.parse(d||"{}")),[d]);return(0,a.useEffect)((()=>{m("checkout-fields-for-blocks",l,h)}),[m,l,h]),(0,c.jsx)("div",{className:i,children:(0,c.jsx)(o.ValidatedTextInput,{id:e,type:u,name:t,label:r,value:h,customValidation:e=>((e,t)=>{const o=((e,t)=>{for(const[o,l]of Object.entries(t))if(l.enabled&&s[o]){const t=s[o].validate(e,l);if(t)return t}return null})(e.value,t);return o?(e.setCustomValidity(o),!1):(e.setCustomValidity(""),!0)})(e,v),help:f,onChange:e=>k(e),errorId:b,showError:!0})})},n=JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":3,"name":"checkout-fields-for-blocks/input-email","version":"0.1.0","title":"Email","description":"","category":"checkout-fields-for-blocks","supports":{"html":true},"keywords":["checkout"],"parent":["woocommerce/checkout-totals-block","woocommerce/checkout-fields-block","woocommerce/checkout-contact-information-block","woocommerce/checkout-shipping-address-block","woocommerce/checkout-billing-address-block","woocommerce/checkout-shipping-method-block","woocommerce/checkout-shipping-methods-block","woocommerce/checkout-pickup-options-block"],"attributes":{"fieldId":{"type":"string","default":""},"fieldName":{"type":"string","default":""},"metaName":{"type":"string","default":""},"parentBlock":{"type":"string","default":""},"label":{"type":"string","default":""},"defaultValue":{"type":"string","default":""},"helpText":{"type":"string","default":""},"className":{"type":"string","default":""},"validationSettings":{"type":"object","default":{"required":{"enabled":false},"minLength":{"enabled":false,"value":""},"maxLength":{"enabled":false,"value":""},"pattern":{"enabled":false,"value":""}}},"display":{"type":"object","default":{"orderConfirmation":"","orderAdmin":"","orderMyAccount":"","orderEmail":""}}},"textdomain":"checkout-fields-for-blocks"}');(0,o.registerCheckoutBlock)({metadata:n,component:e=>i({...e,inputType:"email"})})})();