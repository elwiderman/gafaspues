(()=>{"use strict";var e={n:o=>{var n=o&&o.__esModule?()=>o.default:()=>o;return e.d(n,{a:n}),n},d:(o,n)=>{for(var t in n)e.o(n,t)&&!e.o(o,t)&&Object.defineProperty(o,t,{enumerable:!0,get:n[t]})},o:(e,o)=>Object.prototype.hasOwnProperty.call(e,o)};const o=window.wp.element,n=window.wp.blocks,t=window.wp.components,r=window.wp.serverSideRender;var a=e.n(r);const c=window.wp.i18n,l=window.wp.blockEditor,i=window.wp.data,s={from:[{type:"block",blocks:["core/navigation-link"],transform:()=>(0,n.createBlock)("fibosearch/search-nav",{inheritPluginSettings:!1,layout:"icon"})},{type:"block",blocks:["core/search"],transform:()=>(0,n.createBlock)("fibosearch/search-nav",{inheritPluginSettings:!1,layout:"icon"})}],to:[{type:"block",blocks:["core/search"],transform:()=>(0,n.createBlock)("core/search",{showLabel:!1,buttonUseIcon:!0,buttonPosition:"button-inside"})},{type:"block",blocks:["core/navigation-link"],transform:()=>(0,n.createBlock)("core/navigation-link")}]},m=window.wp.primitives,b=(0,o.createElement)(m.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 88.000000 88.000000",fill:"none"},(0,o.createElement)("g",{transform:"translate(0.000000,88.000000) scale(0.100000,-0.100000)"},(0,o.createElement)("path",{stroke:"none",fill:"#040404",fillRule:"evenodd",d:"M434 840 c-22 -5 -58 -16 -80 -26 l-39 -17 66 -8 c153 -17 271 -131\n286 -277 l6 -55 15 29 c24 45 28 165 8 219 -22 57 -92 119 -151 134 -49 12\n-53 12 -111 1z"}),(0,o.createElement)("path",{stroke:"none",fill:"#7c3b7c",fillRule:"evenodd",d:"M766 725 c4 -11 18 -49 31 -85 61 -162 4 -334 -132 -400 -61 -30\n-168 -25 -238 9 l-49 24 -99 -99 c-54 -54 -97 -99 -95 -101 2 -2 39 12 82 30\n74 31 81 32 117 20 176 -60 367 19 451 185 54 106 54 215 2 326 -25 53 -84\n129 -70 91z"}),(0,o.createElement)("path",{stroke:"none",fill:"#7c3b7c",fillRule:"evenodd",d:"M265 711 c-62 -29 -102 -77 -119 -146 -20 -75 -20 -113 0 -191 l15\n-62 -46 -84 c-26 -46 -58 -103 -72 -128 -21 -37 -1 -21 120 100 l146 144 -6\n58 c-7 71 8 111 52 138 53 33 98 27 149 -20 23 -22 51 -58 61 -80 10 -22 21\n-40 25 -40 14 0 20 80 10 126 -15 65 -33 97 -81 137 -75 65 -177 84 -254 48z"})));(0,n.registerBlockType)("fibosearch/search-nav",{edit:function(e){const{deviceType:n}=(0,i.useSelect)((e=>{let o="";const n=e("core/editor");return e("core/edit-post"),"object"==typeof n&&"function"==typeof n.getDeviceType?o=n.getDeviceType():"object"==typeof editPost&&"function"===editPost.__experimentalGetPreviewDeviceType&&(o=editPost.__experimentalGetPreviewDeviceType()),{deviceType:o}}),[]),r=(0,l.useBlockProps)({className:`wp-block-fibosearch-search__device-preview-${n.toLowerCase()}`}),{attributes:s}=e,{attributes:{darkenedBackground:m,mobileOverlay:b,inheritPluginSettings:d,layout:h,iconColor:p},name:w,setAttributes:u}=e;return(0,o.createElement)("div",r,(0,o.createElement)(l.InspectorControls,{key:"inspector"},(0,o.createElement)(t.PanelBody,{title:(0,c.__)("Settings","ajax-search-for-woocommerce"),initialOpen:!1},(0,o.createElement)(t.ToggleControl,{label:(0,c.__)("Inherit global plugin settings","ajax-search-for-woocommerce"),checked:d,onChange:()=>u({inheritPluginSettings:!d}),__nextHasNoMarginBottom:!0}),d?null:(0,o.createElement)(t.SelectControl,{label:(0,c.__)("Layout","ajax-search-for-woocommerce"),value:h,options:[{label:(0,c.__)("Search bar","ajax-search-for-woocommerce"),value:"classic"},{label:(0,c.__)("Search icon","ajax-search-for-woocommerce"),value:"icon"},{label:(0,c.__)("Icon on mobile, search bar on desktop","ajax-search-for-woocommerce"),value:"icon-flexible"},{label:(0,c.__)("Icon on desktop, search bar on mobile","ajax-search-for-woocommerce"),value:"icon-flexible-inv"}],onChange:e=>{u({layout:e}),"icon"!==e&&"icon-flexible"!==e&&"icon-flexible-inv"!==e||u({mobileOverlay:!0})},__nextHasNoMarginBottom:!0}),d?null:(0,o.createElement)(t.ToggleControl,{label:(0,c.__)("Darkened background","ajax-search-for-woocommerce"),checked:m,onChange:()=>u({darkenedBackground:!m}),__nextHasNoMarginBottom:!0}),d?null:(0,o.createElement)(t.ToggleControl,{label:(0,c.__)("Overlay on mobile","ajax-search-for-woocommerce"),checked:b,onChange:()=>u({mobileOverlay:!b}),help:b?(0,c.__)("The search will open in overlay on mobile","ajax-search-for-woocommerce"):"",__nextHasNoMarginBottom:!0}),d||"classic"===h?null:(0,o.createElement)(l.PanelColorSettings,{__experimentalHasMultipleOrigins:!0,__experimentalIsRenderedInSidebar:!0,title:(0,c.__)("Color","ajax-search-for-woocommerce"),initialOpen:!1,colorSettings:[{value:p,onChange:e=>{u({iconColor:e})},label:(0,c.__)("Icon","ajax-search-for-woocommerce")}]}))),(0,o.createElement)(t.Disabled,null,(0,o.createElement)(a(),{block:w,attributes:s})))},icon:{src:(0,o.createElement)((function(e){let{icon:n,size:t=24,...r}=e;return(0,o.cloneElement)(n,{width:t,height:t,...r})}),{icon:b})},save:()=>{},transforms:s})})();