(()=>{var e,t,r,n={8135:(e,t,r)=>{"use strict";r.r(t);var n=r(1609);const o=window.wp.blocks;var i=r(851),c=r(7104),l=r(3576);const a=window.wp.blockEditor;var s=r(7723);const u=window.wc.wcSettings;var m,p,d,b,_,w,g,f,h,k;const E=(0,u.getSetting)("wcBlocksConfig",{pluginUrl:"",productCount:0,defaultAvatar:"",restApiRoutes:{},wordCountType:"words"}),y=(E.pluginUrl,E.pluginUrl,null===(m=u.STORE_PAGES.shop)||void 0===m||m.permalink,null===(p=u.STORE_PAGES.checkout)||void 0===p||p.id,null===(d=u.STORE_PAGES.checkout)||void 0===d||d.permalink,null===(b=u.STORE_PAGES.privacy)||void 0===b||b.permalink,null===(_=u.STORE_PAGES.privacy)||void 0===_||_.title,null===(w=u.STORE_PAGES.terms)||void 0===w||w.permalink,null===(g=u.STORE_PAGES.terms)||void 0===g||g.title,null===(f=u.STORE_PAGES.cart)||void 0===f||f.id,null===(h=u.STORE_PAGES.cart)||void 0===h||h.permalink,null!==(k=u.STORE_PAGES.myaccount)&&void 0!==k&&k.permalink?u.STORE_PAGES.myaccount.permalink:(0,u.getSetting)("wpLoginUrl","/wp-login.php"),(0,u.getSetting)("localPickupEnabled",!1),(0,u.getSetting)("shippingMethodsExist",!1),(0,u.getSetting)("countries",{})),v=(0,u.getSetting)("countryData",{}),S=(Object.fromEntries(Object.keys(v).filter((e=>!0===v[e].allowBilling)).map((e=>[e,y[e]||""]))),Object.fromEntries(Object.keys(v).filter((e=>!0===v[e].allowBilling)).map((e=>[e,v[e].states||[]]))),Object.fromEntries(Object.keys(v).filter((e=>!0===v[e].allowShipping)).map((e=>[e,y[e]||""]))),Object.fromEntries(Object.keys(v).filter((e=>!0===v[e].allowShipping)).map((e=>[e,v[e].states||[]]))),Object.fromEntries(Object.keys(v).map((e=>[e,v[e].locale||[]]))),{address:["first_name","last_name","company","address_1","address_2","city","postcode","country","state","phone"],contact:["email"],order:[]});(0,u.getSetting)("addressFieldsLocations",S).address,(0,u.getSetting)("addressFieldsLocations",S).contact,(0,u.getSetting)("addressFieldsLocations",S).order,(0,u.getSetting)("additionalOrderFields",{}),(0,u.getSetting)("additionalContactFields",{}),(0,u.getSetting)("additionalAddressFields",{});var x=r(9491);r(4302);const C=(0,x.withInstanceId)((({className:e,headingLevel:t,onChange:r,heading:o,instanceId:i})=>{const c=`h${t}`;return(0,n.createElement)(c,{className:e},(0,n.createElement)("label",{className:"screen-reader-text",htmlFor:`block-title-${i}`},(0,s.__)("Block title","woocommerce")),(0,n.createElement)(a.PlainText,{id:`block-title-${i}`,className:"wc-block-editor-components-title",value:o,onChange:r,style:{backgroundColor:"transparent"}}))}));var N=r(4133);const F=window.wp.components;var O=r(6087);function P(e,t){const r=(0,O.useRef)();return(0,O.useEffect)((()=>{r.current===e||t&&!t(e,r.current)||(r.current=e)}),[e,t]),r.current}const A=window.wc.wcBlocksData,T=window.wp.data;var R=r(923),j=r.n(R);const B=(0,O.createContext)("page"),U=()=>(0,O.useContext)(B),L=(B.Provider,e=>{const t=U();e=e||t;const r=(0,T.useSelect)((t=>t(A.QUERY_STATE_STORE_KEY).getValueForQueryContext(e,void 0)),[e]),{setValueForQueryContext:n}=(0,T.useDispatch)(A.QUERY_STATE_STORE_KEY);return[r,(0,O.useCallback)((t=>{n(e,t)}),[e,n])]}),I=(e,t,r)=>{const n=U();r=r||n;const o=(0,T.useSelect)((n=>n(A.QUERY_STATE_STORE_KEY).getValueForQueryKey(r,e,t)),[r,e]),{setQueryValue:i}=(0,T.useDispatch)(A.QUERY_STATE_STORE_KEY);return[o,(0,O.useCallback)((t=>{i(r,e,t)}),[r,e,i])]};var M=r(4717);const q=window.wc.wcTypes;var G=r(5574);function Q(e){const t=(0,O.useRef)(e);return j()(e,t.current)||(t.current=e),t.current}const W=({queryAttribute:e,queryPrices:t,queryStock:r,queryRating:n,queryState:o,isEditor:i=!1})=>{let c=U();c=`${c}-collection-data`;const[l]=L(c),[a,s]=I("calculate_attribute_counts",[],c),[u,m]=I("calculate_price_range",null,c),[p,d]=I("calculate_stock_status_counts",null,c),[b,_]=I("calculate_rating_counts",null,c),w=Q(e||{}),g=Q(t),f=Q(r),h=Q(n);(0,O.useEffect)((()=>{"object"==typeof w&&Object.keys(w).length&&(a.find((e=>(0,q.objectHasProp)(w,"taxonomy")&&e.taxonomy===w.taxonomy))||s([...a,w]))}),[w,a,s]),(0,O.useEffect)((()=>{u!==g&&void 0!==g&&m(g)}),[g,m,u]),(0,O.useEffect)((()=>{p!==f&&void 0!==f&&d(f)}),[f,d,p]),(0,O.useEffect)((()=>{b!==h&&void 0!==h&&_(h)}),[h,_,b]);const[k,E]=(0,O.useState)(i),[y]=(0,M.d7)(k,200);k||E(!0);const v=(0,O.useMemo)((()=>(e=>{const t=e;return Array.isArray(e.calculate_attribute_counts)&&(t.calculate_attribute_counts=(0,G.di)(e.calculate_attribute_counts.map((({taxonomy:e,queryType:t})=>({taxonomy:e,query_type:t})))).asc(["taxonomy","query_type"])),t})(l)),[l]),{results:S,isLoading:x}=(e=>{const{namespace:t,resourceName:r,resourceValues:n=[],query:o={},shouldSelect:i=!0}=e;if(!t||!r)throw new Error("The options object must have valid values for the namespace and the resource properties.");const c=(0,O.useRef)({results:[],isLoading:!0}),l=Q(o),a=Q(n),s=(()=>{const[,e]=(0,O.useState)();return(0,O.useCallback)((t=>{e((()=>{throw t}))}),[])})(),u=(0,T.useSelect)((e=>{if(!i)return null;const n=e(A.COLLECTIONS_STORE_KEY),o=[t,r,l,a],c=n.getCollectionError(...o);if(c){if(!(0,q.isError)(c))throw new Error("TypeError: `error` object is not an instance of Error constructor");s(c)}return{results:n.getCollection(...o),isLoading:!n.hasFinishedResolution("getCollection",o)}}),[t,r,a,l,i,s]);return null!==u&&(c.current=u),c.current})({namespace:"/wc/store/v1",resourceName:"products/collection-data",query:{...o,page:void 0,per_page:void 0,orderby:void 0,order:void 0,...v},shouldSelect:y});return{data:S,isLoading:x}},V=window.wc.blocksComponents;r(9505);const Y=(e,t,r,n=1,o=!1)=>{let[i,c]=e;const l=e=>Number.isFinite(e);return l(i)||(i=t||0),l(c)||(c=r||n),l(t)&&t>i&&(i=t),l(r)&&r<=i&&(i=r-n),l(t)&&t>=c&&(c=t+n),l(r)&&r<c&&(c=r),!o&&i>=c&&(i=c-n),o&&c<=i&&(c=i+n),[i,c]};r(1504);const D=({className:e,isLoading:t,disabled:r,
/* translators: Submit button text for filters. */
label:o=(0,s.__)("Apply","woocommerce"),onClick:c,screenReaderLabel:l=(0,s.__)("Apply filter","woocommerce")})=>(0,n.createElement)("button",{type:"submit",className:(0,i.A)("wp-block-button__link","wc-block-filter-submit-button","wc-block-components-filter-submit-button",{"is-loading":t},e),disabled:r,onClick:c},(0,n.createElement)(V.Label,{label:o,screenReaderLabel:l})),$=({maxConstraint:e,minorUnit:t})=>({floatValue:r})=>void 0!==r&&r<=e/10**t&&r>0,H=({minConstraint:e,currentMaxValue:t,minorUnit:r})=>({floatValue:n})=>void 0!==n&&n>=e/10**r&&n<t/10**r;r(8335);const K=({className:e,
/* translators: Reset button text for filters. */
label:t=(0,s.__)("Reset","woocommerce"),onClick:r,screenReaderLabel:o=(0,s.__)("Reset filter","woocommerce")})=>(0,n.createElement)("button",{className:(0,i.A)("wc-block-components-filter-reset-button",e),onClick:r},(0,n.createElement)(V.Label,{label:t,screenReaderLabel:o})),z=({minPrice:e,maxPrice:t,minConstraint:r,maxConstraint:o,onChange:c,step:l,currency:a,showInputFields:u=!0,showFilterButton:m=!1,inlineInput:p=!0,isLoading:d=!1,isUpdating:b=!1,isEditor:_=!1,onSubmit:w=(()=>{})})=>{const g=(0,O.useRef)(null),f=(0,O.useRef)(null),h=l||10**a.minorUnit,[k,E]=(0,O.useState)(e),[y,v]=(0,O.useState)(t),S=(0,O.useRef)(null),[x,C]=(0,O.useState)(0);(0,O.useEffect)((()=>{E(e)}),[e]),(0,O.useEffect)((()=>{v(t)}),[t]),(0,O.useLayoutEffect)((()=>{var e;p&&S.current&&C(null===(e=S.current)||void 0===e?void 0:e.offsetWidth)}),[p,C]);const N=(0,O.useMemo)((()=>isFinite(r)&&isFinite(o)),[r,o]),F=(0,O.useMemo)((()=>isFinite(e)&&isFinite(t)&&N?{"--low":(e-r)/(o-r)*100+"%","--high":(t-r)/(o-r)*100+"%"}:{"--low":"0%","--high":"100%"}),[e,t,r,o,N]),P=(0,O.useCallback)((e=>{if(d||!N||!g.current||!f.current)return;const t=e.target.getBoundingClientRect(),r=e.clientX-t.left,n=g.current.offsetWidth,i=+g.current.value,c=f.current.offsetWidth,l=+f.current.value,a=n*(i/o),s=c*(l/o);Math.abs(r-a)>Math.abs(r-s)?(g.current.style.zIndex="20",f.current.style.zIndex="21"):(g.current.style.zIndex="21",f.current.style.zIndex="20")}),[d,o,N]),A=(0,O.useCallback)((n=>{const i=n.target.classList.contains("wc-block-price-filter__range-input--min"),l=+n.target.value,a=i?[Math.round(l/h)*h,t]:[e,Math.round(l/h)*h],s=Y(a,r,o,h,i);c(s)}),[c,e,t,r,o,h]),T=(0,M.YQ)(((e,t,r)=>{if(e>=t){const e=Y([0,t],null,null,h,r);return c([parseInt(e[0],10),parseInt(e[1],10)])}const n=Y([e,t],null,null,h,r);c(n)}),1e3),R=(0,M.YQ)(w,600),j=(0,i.A)("wc-block-price-filter","wc-block-components-price-slider",u&&"wc-block-price-filter--has-input-fields",u&&"wc-block-components-price-slider--has-input-fields",m&&"wc-block-price-filter--has-filter-button",m&&"wc-block-components-price-slider--has-filter-button",!N&&"is-disabled",(p||x<=300)&&"wc-block-components-price-slider--is-input-inline"),B=(0,q.isObject)(g.current)?g.current.ownerDocument.activeElement:void 0,U=B&&B===g.current?h:1,L=B&&B===f.current?h:1,I=String(k/10**a.minorUnit),G=String(y/10**a.minorUnit),Q=p&&x>300,W=(0,n.createElement)("div",{className:(0,i.A)("wc-block-price-filter__range-input-wrapper","wc-block-components-price-slider__range-input-wrapper",{"is-loading":d&&b}),onMouseMove:P,onFocus:P},N&&(0,n.createElement)("div",{"aria-hidden":u},(0,n.createElement)("div",{className:"wc-block-price-filter__range-input-progress wc-block-components-price-slider__range-input-progress",style:F}),(0,n.createElement)("input",{type:"range",className:"wc-block-price-filter__range-input wc-block-price-filter__range-input--min wc-block-components-price-slider__range-input wc-block-components-price-slider__range-input--min","aria-label":(0,s.__)("Filter products by minimum price","woocommerce"),"aria-valuetext":I,value:Number.isFinite(e)?e:r,onChange:A,step:U,min:r,max:o,ref:g,disabled:d&&!N,tabIndex:u?-1:0}),(0,n.createElement)("input",{type:"range",className:"wc-block-price-filter__range-input wc-block-price-filter__range-input--max wc-block-components-price-slider__range-input wc-block-components-price-slider__range-input--max","aria-label":(0,s.__)("Filter products by maximum price","woocommerce"),"aria-valuetext":G,value:Number.isFinite(t)?t:o,onChange:A,step:L,min:r,max:o,ref:f,disabled:d,tabIndex:u?-1:0}))),z=e=>`wc-block-price-filter__amount wc-block-price-filter__amount--${e} wc-block-form-text-input wc-block-components-price-slider__amount wc-block-components-price-slider__amount--${e}`,J={currency:a,decimalScale:0},X={...J,displayType:"input",allowNegative:!1,disabled:d||!N,onClick:e=>{const t=e.currentTarget;t&&t.select()}};return(0,n.createElement)("div",{className:j,ref:S},(!Q||!u)&&W,u&&(0,n.createElement)("div",{className:"wc-block-price-filter__controls wc-block-components-price-slider__controls"},b?(0,n.createElement)("div",{className:"input-loading"}):(0,n.createElement)("div",{className:"wc-block-price-filter__control wc-block-components-price-slider__control"},(0,n.createElement)("label",{className:"wc-block-components-price-slider__label",htmlFor:"minPriceInput"},(0,s.__)("Min. Price","woocommerce")),(0,n.createElement)(V.FormattedMonetaryAmount,{...X,id:"minPriceInput",className:z("min"),"aria-label":(0,s.__)("Filter products by minimum price","woocommerce"),isAllowed:H({minConstraint:r,minorUnit:a.minorUnit,currentMaxValue:y}),onValueChange:e=>{e!==k&&(E(e),T(e,y,!0))},value:k})),Q&&W,b?(0,n.createElement)("div",{className:"input-loading"}):(0,n.createElement)("div",{className:"wc-block-price-filter__control wc-block-components-price-slider__control"},(0,n.createElement)("label",{className:"wc-block-components-price-slider__label",htmlFor:"maxPriceInput"},(0,s.__)("Max. Price","woocommerce")),(0,n.createElement)(V.FormattedMonetaryAmount,{...X,id:"maxPriceInput",className:z("max"),"aria-label":(0,s.__)("Filter products by maximum price","woocommerce"),isAllowed:$({maxConstraint:o,minorUnit:a.minorUnit}),onValueChange:e=>{e!==y&&(v(e),T(k,e,!1))},value:y}))),!u&&!b&&Number.isFinite(e)&&Number.isFinite(t)&&(0,n.createElement)("div",{className:"wc-block-price-filter__range-text wc-block-components-price-slider__range-text"},(0,n.createElement)(V.FormattedMonetaryAmount,{...J,value:e}),(0,n.createElement)(V.FormattedMonetaryAmount,{...J,value:t})),(0,n.createElement)("div",{className:"wc-block-components-price-slider__actions"},(_||!b&&(e!==r||t!==o))&&(0,n.createElement)(K,{onClick:()=>{c([r,o]),R()},screenReaderLabel:(0,s.__)("Reset price filter","woocommerce")}),m&&(0,n.createElement)(D,{className:"wc-block-price-filter__button wc-block-components-price-slider__button",isLoading:b,disabled:d||!N,onClick:w,screenReaderLabel:(0,s.__)("Apply price filter","woocommerce")})))};r(1626);const J=({children:e})=>(0,n.createElement)("div",{className:"wc-block-filter-title-placeholder"},e),X=window.wc.priceFormat,Z=window.wp.url,ee=(0,u.getSettingWithCoercion)("isRenderingPhpTemplate",!1,q.isBoolean);function te(e){return window?(0,Z.getQueryArg)(window.location.href,e):null}function re(e){if(ee){const t=new URL(e);t.pathname=t.pathname.replace(/\/page\/[0-9]+/i,""),t.searchParams.delete("paged"),t.searchParams.forEach(((e,r)=>{r.match(/^query(?:-[0-9]+)?-page$/)&&t.searchParams.delete(r)})),window.location.href=t.href}else window.history.replaceState({},"",e)}const ne="ROUND_UP",oe="ROUND_DOWN",ie=(e,t,r)=>{const n=1*10**t;let o=null;const i=parseFloat(e);isNaN(i)||(r===ne?o=Math.ceil(i/n)*n:r===oe&&(o=Math.floor(i/n)*n));const c=P(o,Number.isFinite);return Number.isFinite(o)?o:c};r(8836);const ce=(0,O.createContext)({});function le(e,t){return Number(e)*10**t}const ae=({attributes:e,isEditor:t=!1})=>{const r=(()=>{const{wrapper:e}=(0,O.useContext)(ce);return t=>{e&&e.current&&(e.current.hidden=!t)}})(),o=(0,u.getSettingWithCoercion)("hasFilterableProducts",!1,q.isBoolean),i=(0,u.getSettingWithCoercion)("isRenderingPhpTemplate",!1,q.isBoolean),[c,l]=(0,O.useState)(!1),a=te("min_price"),s=te("max_price"),[m]=L(),p=(0,u.getSettingWithCoercion)("queryState",{},q.isObject),{data:d,isLoading:b}=W({queryPrices:!0,queryState:{...p,...m},isEditor:t}),_=(0,X.getCurrencyFromPriceResponse)((0,q.objectHasProp)(d,"price_range")?d.price_range:void 0),[w,g]=I("min_price"),[f,h]=I("max_price"),[k,E]=(0,O.useState)(le(a,_.minorUnit)||null),[y,v]=(0,O.useState)(le(s,_.minorUnit)||null),{minConstraint:S,maxConstraint:x}=(({minPrice:e,maxPrice:t,minorUnit:r})=>({minConstraint:ie(e||"",r,oe),maxConstraint:ie(t||"",r,ne)}))({minPrice:(0,q.objectHasProp)(d,"price_range")&&(0,q.objectHasProp)(d.price_range,"min_price")&&(0,q.isString)(d.price_range.min_price)?d.price_range.min_price:void 0,maxPrice:(0,q.objectHasProp)(d,"price_range")&&(0,q.objectHasProp)(d.price_range,"max_price")&&(0,q.isString)(d.price_range.max_price)?d.price_range.max_price:void 0,minorUnit:_.minorUnit});(0,O.useEffect)((()=>{c||(g(le(a,_.minorUnit)),h(le(s,_.minorUnit)),l(!0))}),[_.minorUnit,c,s,a,h,g]);const[C,N]=(0,O.useState)(b),F=(0,O.useCallback)(((e,t)=>{const r=t>=Number(x)?void 0:t,n=e<=Number(S)?void 0:e;if(window){const e=function(e,t){const r={};for(const[e,n]of Object.entries(t))n?r[e]=n.toString():delete r[e];const n=(0,Z.removeQueryArgs)(e,...Object.keys(t));return(0,Z.addQueryArgs)(n,r)}(window.location.href,{min_price:n/10**_.minorUnit,max_price:r/10**_.minorUnit});window.location.href!==e&&re(e)}g(n),h(r)}),[S,x,g,h,_.minorUnit]),A=(0,M.YQ)(F,500),T=(0,O.useCallback)((t=>{N(!0),t[0]!==k&&E(t[0]),t[1]!==y&&v(t[1]),i&&c&&!e.showFilterButton&&A(t[0],t[1])}),[k,y,E,v,i,c,A,e.showFilterButton]);(0,O.useEffect)((()=>{e.showFilterButton||i||A(k,y)}),[k,y,e.showFilterButton,A,i]);const R=P(w),j=P(f),B=P(S),U=P(x);if((0,O.useEffect)((()=>{(!Number.isFinite(k)||w!==R&&w!==k||S!==B&&S!==k)&&E(Number.isFinite(w)?w:S),(!Number.isFinite(y)||f!==j&&f!==y||x!==U&&x!==y)&&v(Number.isFinite(f)?f:x)}),[k,y,w,f,S,x,B,U,R,j]),!o)return r(!1),null;if(!b&&(null===S||null===x||S===x))return r(!1),null;const G=`h${e.headingLevel}`;r(!0),!b&&C&&N(!1);const Q=(0,n.createElement)(G,{className:"wc-block-price-filter__title"},e.heading),V=b&&C?(0,n.createElement)(J,null,Q):Q;return(0,n.createElement)(n.Fragment,null,!t&&e.heading&&V,(0,n.createElement)("div",{className:"wc-block-price-slider"},(0,n.createElement)(z,{minConstraint:S,maxConstraint:x,minPrice:k,maxPrice:y,currency:_,showInputFields:e.showInputFields,inlineInput:e.inlineInput,showFilterButton:e.showFilterButton,onChange:T,onSubmit:()=>F(k,y),isLoading:b,isUpdating:C,isEditor:t})))};r(6562);const se=({clientId:e,setAttributes:t,filterType:r,attributes:i})=>{const{replaceBlock:c}=(0,T.useDispatch)("core/block-editor"),{heading:l,headingLevel:u}=i;if((0,T.useSelect)((t=>{const{getBlockParentsByBlockName:r}=t("core/block-editor");return r(e,"woocommerce/filter-wrapper").length>0}),[e])||!r)return null;const m=[(0,n.createElement)(F.Button,{key:"convert",onClick:()=>{const n=[(0,o.createBlock)(`woocommerce/${r}`,{...i,heading:""})];l&&""!==l&&n.unshift((0,o.createBlock)("core/heading",{content:l,level:null!=u?u:2})),c(e,(0,o.createBlock)("woocommerce/filter-wrapper",{heading:l,filterType:r},[...n])),t({heading:"",lock:{remove:!0}})},variant:"primary"},(0,s.__)("Upgrade block","woocommerce"))];return(0,n.createElement)(a.Warning,{actions:m},(0,s.__)("Filter block: We have improved this block to make styling easier. Upgrade it using the button below.","woocommerce"))},ue=JSON.parse('{"name":"woocommerce/price-filter","version":"1.0.0","title":"Filter by Price Controls","description":"Enable customers to filter the product grid by choosing a price range.","category":"woocommerce","keywords":["WooCommerce"],"supports":{"html":false,"multiple":false,"color":{"text":true,"background":false},"inserter":false,"lock":false},"attributes":{"className":{"type":"string","default":""},"showInputFields":{"type":"boolean","default":true},"inlineInput":{"type":"boolean","default":false},"showFilterButton":{"type":"boolean","default":false},"headingLevel":{"type":"number","default":3}},"textdomain":"woocommerce","apiVersion":3,"$schema":"https://schemas.wp.org/trunk/block.json"}'),me={heading:{type:"string",default:(0,s.__)("Filter by price","woocommerce")}},pe=[{attributes:{...ue.attributes,...me},save:({attributes:e})=>{const{className:t,showInputFields:r,showFilterButton:o,heading:c,headingLevel:l}=e,s={"data-showinputfields":r,"data-showfilterbutton":o,"data-heading":c,"data-heading-level":l};return(0,n.createElement)("div",{...a.useBlockProps.save({className:(0,i.A)("is-loading",t)}),...s},(0,n.createElement)("span",{"aria-hidden":!0,className:"wc-block-product-categories__placeholder"}))}}];(0,o.registerBlockType)(ue,{icon:{src:(0,n.createElement)(c.A,{icon:l.A,className:"wc-block-editor-components-block-icon"})},attributes:{...ue.attributes,...me},edit:function({attributes:e,setAttributes:t,clientId:r}){const{heading:o,headingLevel:i,showInputFields:m,inlineInput:p,showFilterButton:d}=e,b=(0,a.useBlockProps)();return(0,n.createElement)("div",{...b},0===E.productCount?(0,n.createElement)(F.Placeholder,{className:"wc-block-price-slider",icon:(0,n.createElement)(c.A,{icon:l.A}),label:(0,s.__)("Filter by Price","woocommerce"),instructions:(0,s.__)("Display a slider to filter products in your store by price.","woocommerce")},(0,n.createElement)("p",null,(0,s.__)("To filter your products by price you first need to assign prices to your products.","woocommerce")),(0,n.createElement)(F.Button,{className:"wc-block-price-slider__add-product-button",variant:"secondary",href:(0,u.getAdminLink)("post-new.php?post_type=product"),target:"_top"},(0,s.__)("Add new product","woocommerce")+" ",(0,n.createElement)(c.A,{icon:N.A})),(0,n.createElement)(F.Button,{className:"wc-block-price-slider__read_more_button",variant:"tertiary",href:"https://woocommerce.com/document/managing-products/",target:"_blank"},(0,s.__)("Learn more","woocommerce"))):(0,n.createElement)(n.Fragment,null,(0,n.createElement)(a.InspectorControls,{key:"inspector"},(0,n.createElement)(F.PanelBody,{title:(0,s.__)("Settings","woocommerce")},(0,n.createElement)(F.__experimentalToggleGroupControl,{label:(0,s.__)("Price Range Selector","woocommerce"),isBlock:!0,value:m?"editable":"text",onChange:e=>t({showInputFields:"editable"===e}),className:"wc-block-price-filter__price-range-toggle"},(0,n.createElement)(F.__experimentalToggleGroupControlOption,{value:"editable",label:(0,s.__)("Editable","woocommerce")}),(0,n.createElement)(F.__experimentalToggleGroupControlOption,{value:"text",label:(0,s.__)("Text","woocommerce")})),m&&(0,n.createElement)(F.ToggleControl,{label:(0,s.__)("Inline input fields","woocommerce"),checked:p,onChange:()=>t({inlineInput:!p}),help:(0,s.__)("Show input fields inline with the slider.","woocommerce")}),(0,n.createElement)(F.ToggleControl,{label:(0,s.__)("Show 'Apply filters' button","woocommerce"),help:(0,s.__)("Products will update when the button is clicked.","woocommerce"),checked:d,onChange:()=>t({showFilterButton:!d})}))),(0,n.createElement)(se,{attributes:e,clientId:r,setAttributes:t,filterType:"price-filter"}),o&&(0,n.createElement)(C,{className:"wc-block-price-filter__title",headingLevel:i,heading:o,onChange:e=>t({heading:e})}),(0,n.createElement)(F.Disabled,null,(0,n.createElement)(ae,{attributes:e,isEditor:!0}))))},save({attributes:e}){const{className:t}=e;return(0,n.createElement)("div",{...a.useBlockProps.save({className:(0,i.A)("is-loading",t)})},(0,n.createElement)("span",{"aria-hidden":!0,className:"wc-block-product-categories__placeholder"}))},deprecated:pe})},1626:()=>{},8335:()=>{},1504:()=>{},9505:()=>{},6562:()=>{},8836:()=>{},4302:()=>{},1609:e=>{"use strict";e.exports=window.React},9491:e=>{"use strict";e.exports=window.wp.compose},6087:e=>{"use strict";e.exports=window.wp.element},7723:e=>{"use strict";e.exports=window.wp.i18n},923:e=>{"use strict";e.exports=window.wp.isShallowEqual},5573:e=>{"use strict";e.exports=window.wp.primitives}},o={};function i(e){var t=o[e];if(void 0!==t)return t.exports;var r=o[e]={exports:{}};return n[e].call(r.exports,r,r.exports,i),r.exports}i.m=n,e=[],i.O=(t,r,n,o)=>{if(!r){var c=1/0;for(u=0;u<e.length;u++){for(var[r,n,o]=e[u],l=!0,a=0;a<r.length;a++)(!1&o||c>=o)&&Object.keys(i.O).every((e=>i.O[e](r[a])))?r.splice(a--,1):(l=!1,o<c&&(c=o));if(l){e.splice(u--,1);var s=n();void 0!==s&&(t=s)}}return t}o=o||0;for(var u=e.length;u>0&&e[u-1][2]>o;u--)e[u]=e[u-1];e[u]=[r,n,o]},i.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return i.d(t,{a:t}),t},r=Object.getPrototypeOf?e=>Object.getPrototypeOf(e):e=>e.__proto__,i.t=function(e,n){if(1&n&&(e=this(e)),8&n)return e;if("object"==typeof e&&e){if(4&n&&e.__esModule)return e;if(16&n&&"function"==typeof e.then)return e}var o=Object.create(null);i.r(o);var c={};t=t||[null,r({}),r([]),r(r)];for(var l=2&n&&e;"object"==typeof l&&!~t.indexOf(l);l=r(l))Object.getOwnPropertyNames(l).forEach((t=>c[t]=()=>e[t]));return c.default=()=>e,i.d(o,c),o},i.d=(e,t)=>{for(var r in t)i.o(t,r)&&!i.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:t[r]})},i.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),i.r=e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},i.j=1493,(()=>{var e={1493:0};i.O.j=t=>0===e[t];var t=(t,r)=>{var n,o,[c,l,a]=r,s=0;if(c.some((t=>0!==e[t]))){for(n in l)i.o(l,n)&&(i.m[n]=l[n]);if(a)var u=a(i)}for(t&&t(r);s<c.length;s++)o=c[s],i.o(e,o)&&e[o]&&e[o][0](),e[o]=0;return i.O(u)},r=self.webpackChunkwebpackWcBlocksMainJsonp=self.webpackChunkwebpackWcBlocksMainJsonp||[];r.forEach(t.bind(null,0)),r.push=t.bind(null,r.push.bind(r))})();var c=i.O(void 0,[94],(()=>i(8135)));c=i.O(c),((this.wc=this.wc||{}).blocks=this.wc.blocks||{})["price-filter"]=c})();