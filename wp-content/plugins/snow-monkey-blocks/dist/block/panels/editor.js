!function(){var e={369:function(e,t,n){"use strict";var a={};function r(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}n.r(a),n.d(a,{metadata:function(){return u},name:function(){return j},settings:function(){return T}});var i=window.wp.element,l=window.lodash,s=window.wp.blocks,o=(window.wp.richText,window.wp.i18n);function m(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}var c=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0,n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:null;return e=Number(e),(isNaN(e)||e<t)&&(e=t),null!==n&&e>n&&(e=n),e},u=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/panels","title":"Panels","description":"Let\'s line up the contents like the panel.","category":"smb","attributes":{"sm":{"type":"number","default":1},"md":{"type":"number","default":1},"lg":{"type":"number","default":2},"imagePadding":{"type":"boolean","default":false},"itemTitleTagName":{"type":"string","default":"div"},"contentJustification":{"type":"string"}},"supports":{"html":false}}'),p=(0,i.createElement)("svg",{viewBox:"0 0 24 24"},(0,i.createElement)("path",{d:"M3,3v8h8V3Zm7,7H4V4h6Z"}),(0,i.createElement)("path",{d:"M13,3v8h8V3Zm7,7H14V4h6Z"}),(0,i.createElement)("path",{d:"M3,13v8h8V13Zm7,7H4V14h6Z"}),(0,i.createElement)("path",{d:"M13,13v8h8V13Zm7,7H14V14h6Z"}));function d(){return d=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var a in n)Object.prototype.hasOwnProperty.call(n,a)&&(e[a]=n[a])}return e},d.apply(this,arguments)}var g=n(184),b=n.n(g),f=window.wp.components,_=window.wp.blockEditor;function y(e){var t=e.desktop,n=e.tablet,a=e.mobile,r=[];return t&&r.push({name:"desktop",title:(0,i.createElement)(f.Dashicon,{icon:"desktop"})}),n&&r.push({name:"tablet",title:(0,i.createElement)(f.Dashicon,{icon:"tablet"})}),a&&r.push({name:"mobile",title:(0,i.createElement)(f.Dashicon,{icon:"smartphone"})}),(0,i.createElement)(f.TabPanel,{className:"smb-inspector-tabs",tabs:r},(function(e){if(e.name){if("desktop"===e.name)return t();if("tablet"===e.name)return n();if("mobile"===e.name)return a()}}))}var v=["snow-monkey-blocks/panels--item","snow-monkey-blocks/panels--item--horizontal","snow-monkey-blocks/panels--item--free"],w=[["snow-monkey-blocks/panels--item"]],h=["left","center","right","space-between"];function k(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}function E(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?k(Object(n),!0).forEach((function(t){r(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):k(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var O=u.attributes,N=[{attributes:E({},O),save:function(e){var t=e.attributes,n=t.sm,a=t.md,r=t.lg,l=t.imagePadding;return(0,i.createElement)("div",{className:"smb-panels","data-image-padding":l},(0,i.createElement)("div",{className:"c-row c-row--margin c-row--fill","data-columns":n,"data-md-columns":a,"data-lg-columns":r},(0,i.createElement)(_.InnerBlocks.Content,null)))}},{attributes:E(E({},O),{},{columns:{type:"number",default:2},items:{type:"array",source:"query",default:[],selector:".smb-panels__item",query:{title:{source:"html",selector:".smb-panels__item__title"},summary:{source:"html",selector:".smb-panels__item__content"},linkLabel:{source:"html",selector:".smb-panels__item__link"},linkURL:{type:"string",source:"attribute",attribute:"href",default:""},linkTarget:{type:"string",source:"attribute",attribute:"target",default:"_self"},imageID:{type:"number",source:"attribute",selector:".smb-panels__item__figure > img",attribute:"data-image-id",default:0},imageURL:{type:"string",source:"attribute",selector:".smb-panels__item__figure > img",attribute:"src",default:""}}}}),migrate:function(e){var t;return[{sm:e.sm,md:e.md,lg:e.lg,imagePadding:Boolean(e.imagePadding)},(t=void 0===e.items?0:e.items.length,(0,l.times)(t,(function(t){var n=(0,l.get)(e.items,[t,"title"],""),a=(0,l.get)(e.items,[t,"summary"],""),r=(0,l.get)(e.items,[t,"linkLabel"],""),i=(0,l.get)(e.items,[t,"linkURL"],""),o=(0,l.get)(e.items,[t,"linkTarget"],"_self"),m=(0,l.get)(e.items,[t,"imageID"],0),c=(0,l.get)(e.items,[t,"imageURL"],"");return(0,s.createBlock)("snow-monkey-blocks/panels--item",{titleTagName:e.itemTitleTagName,title:n,summary:a,linkLabel:r,linkURL:i,linkTarget:o,imageID:Number(m),imageURL:c})})))]},save:function(e){var t=e.attributes,n=t.sm,a=t.md,r=t.lg,s=t.imagePadding,o=t.itemTitleTagName,m=t.items,c=void 0===t.items?0:t.items.length;return(0,i.createElement)("div",{className:"smb-panels smb-panels--sm-".concat(n," smb-panels--md-").concat(a," smb-panels--lg-").concat(r),"data-image-padding":s},(0,i.createElement)("div",{className:"c-row c-row--margin c-row--fill"},(0,l.times)(c,(function(e){var t,s,c=(0,l.get)(m,[e,"title"],""),u=(0,l.get)(m,[e,"summary"],""),p=(0,l.get)(m,[e,"linkLabel"],""),d=(0,l.get)(m,[e,"linkURL"],""),g=(0,l.get)(m,[e,"linkTarget"],"_self"),b=(0,l.get)(m,[e,"imageID"],0),f=(0,l.get)(m,[e,"imageURL"],"");return(0,i.createElement)("div",{className:(s=[],s.push("c-row__col"),s.push("c-row__col--1-".concat(n)),s.push("c-row__col--md-1-".concat(a)),s.push("c-row__col--lg-1-".concat(r)),s=s.join(" "))},(t=(0,i.createElement)(i.Fragment,null,!!b&&(0,i.createElement)("div",{className:"smb-panels__item__figure"},(0,i.createElement)("img",{src:f,alt:"",className:"wp-image-".concat(b),"data-image-id":b})),(0,i.createElement)("div",{className:"smb-panels__item__body"},!_.RichText.isEmpty(c)&&(0,i.createElement)(_.RichText.Content,{tagName:o,className:"smb-panels__item__title",value:c}),!_.RichText.isEmpty(u)&&(0,i.createElement)("div",{className:"smb-panels__item__content"},(0,i.createElement)(_.RichText.Content,{value:u})),!_.RichText.isEmpty(p)&&(0,i.createElement)("div",{className:"smb-panels__item__action"},(0,i.createElement)("div",{className:"smb-panels__item__link"},(0,i.createElement)(_.RichText.Content,{value:p}))))),d?(0,i.createElement)("a",{className:"smb-panels__item",href:d,target:g},t):(0,i.createElement)("div",{className:"smb-panels__item",href:d,target:g},t)))}))))}},{attributes:{columns:{type:"number",default:2},sm:{type:"number",default:1},md:{type:"number",default:1},lg:{type:"number",default:2},imagePadding:{type:"boolean",default:!1},items:{type:"array",source:"query",default:[],selector:".smb-panels__item",query:{title:{source:"html",selector:".smb-panels__item__title"},summary:{source:"html",selector:".smb-panels__item__content"},linkLabel:{source:"html",selector:".smb-panels__item__link"},linkURL:{type:"string",source:"attribute",attribute:"href",default:""},linkTarget:{type:"string",source:"attribute",attribute:"target",default:"_self"},imageID:{type:"number",source:"attribute",selector:".smb-panels__item__figure > img",attribute:"data-image-id",default:0},imageURL:{type:"string",source:"attribute",selector:".smb-panels__item__figure > img",attribute:"src",default:""}}}},save:function(e){var t=e.attributes,n=t.columns,a=t.sm,r=t.md,s=t.lg,o=t.imagePadding,m=t.items;return(0,i.createElement)("div",{className:"smb-panels smb-panels--sm-".concat(a," smb-panels--md-").concat(r," smb-panels--lg-").concat(s),"data-image-padding":o},(0,i.createElement)("div",{className:"c-row c-row--margin c-row--fill"},(0,l.times)(n,(function(e){var t,n,o=(0,l.get)(m,[e,"title"],""),c=(0,l.get)(m,[e,"summary"],""),u=(0,l.get)(m,[e,"linkLabel"],""),p=(0,l.get)(m,[e,"linkURL"],""),d=(0,l.get)(m,[e,"linkTarget"],"_self"),g=(0,l.get)(m,[e,"imageID"],0),b=(0,l.get)(m,[e,"imageURL"],"");return(0,i.createElement)("div",{className:(n=[],n.push("c-row__col"),n.push("c-row__col--1-".concat(a)),a===r&&n.push("c-row__col--1-".concat(r)),n.push("c-row__col--lg-1-".concat(s)),n=n.join(" "))},(t=(0,i.createElement)(i.Fragment,null,!!g&&(0,i.createElement)("div",{className:"smb-panels__item__figure"},(0,i.createElement)("img",{src:b,alt:"","data-image-id":g})),(0,i.createElement)("div",{className:"smb-panels__item__body"},!_.RichText.isEmpty(o)&&(0,i.createElement)("div",{className:"smb-panels__item__title"},(0,i.createElement)(_.RichText.Content,{value:o})),!_.RichText.isEmpty(c)&&(0,i.createElement)("div",{className:"smb-panels__item__content"},(0,i.createElement)(_.RichText.Content,{value:c})),!_.RichText.isEmpty(u)&&(0,i.createElement)("div",{className:"smb-panels__item__action"},(0,i.createElement)("div",{className:"smb-panels__item__link"},(0,i.createElement)(_.RichText.Content,{value:u}))))),p?(0,i.createElement)("a",{className:"smb-panels__item",href:p,target:d},t):(0,i.createElement)("div",{className:"smb-panels__item",href:p,target:d},t)))}))))}}],P={innerBlocks:[{name:"snow-monkey-blocks/panels--item",attributes:{title:"Lorem ipsum",summary:"sed do eiusmod tempor incididunt",imageURL:"".concat(smb.pluginUrl,"/dist/img/photos/clouds-in-sky-over-fields.jpg"),imageID:1}},{name:"snow-monkey-blocks/panels--item",attributes:{title:"dolor sit amet",summary:"ut labore et dolore magna aliqua",imageURL:"".concat(smb.pluginUrl,"/dist/img/photos/sunset-over-lake-1.jpg"),imageID:1}}]},j=u.name,T={icon:{foreground:"#cd162c",src:p},edit:function(e){var t=e.attributes,n=e.setAttributes,a=e.className,l=t.sm,s=t.md,m=t.lg,u=t.imagePadding,p=t.contentJustification,g=b()("smb-panels",a),k=(0,_.useBlockProps)({className:g}),E=p&&"left"!==p?p.replace("space-",""):void 0,O=b()("c-row","c-row--margin","c-row--fill",r({},"c-row--".concat(E),p)),N=(0,_.__experimentalUseInnerBlocksProps)({className:O},{allowedBlocks:v,template:w,templateLock:!1,renderAppender:_.InnerBlocks.ButtonBlockAppender,orientation:"horizontal"}),P=function(e){return n({lg:c(e,1,6)})},j=function(e){return n({md:c(e,1,6)})},T=function(e){return n({sm:c(e,1,6)})},R=h;return(0,i.createElement)(i.Fragment,null,(0,i.createElement)(_.InspectorControls,null,(0,i.createElement)(f.PanelBody,{title:(0,o.__)("Block Settings","snow-monkey-blocks")},(0,i.createElement)(y,{desktop:function(){return(0,i.createElement)(f.RangeControl,{label:(0,o.__)("Columns per row (Large window)","snow-monkey-blocks"),value:m,onChange:P,min:"1",max:"6"})},tablet:function(){return(0,i.createElement)(f.RangeControl,{label:(0,o.__)("Columns per row (Medium window)","snow-monkey-blocks"),value:s,onChange:j,min:"1",max:"6"})},mobile:function(){return(0,i.createElement)(f.RangeControl,{label:(0,o.__)("Columns per row (Small window)","snow-monkey-blocks"),value:l,onChange:T,min:"1",max:"6"})}}),(0,i.createElement)(f.ToggleControl,{label:(0,o.__)("Set padding around images","snow-monkey-blocks"),checked:u,onChange:function(e){return n({imagePadding:e})}}))),(0,i.createElement)(_.BlockControls,{group:"block"},(0,i.createElement)(_.JustifyContentControl,{allowedControls:R,value:p,onChange:function(e){return n({contentJustification:e})}})),(0,i.createElement)("div",d({},k,{"data-image-padding":u}),(0,i.createElement)("div",d({},N,{"data-columns":l,"data-md-columns":s,"data-lg-columns":m}))))},save:function(e){var t=e.attributes,n=e.className,a=t.sm,l=t.md,s=t.lg,o=t.imagePadding,m=t.contentJustification,c=b()("smb-panels",n),u=m&&"left"!==m?m.replace("space-",""):void 0,p=b()("c-row","c-row--margin","c-row--fill",r({},"c-row--".concat(u),m));return(0,i.createElement)("div",d({},_.useBlockProps.save({className:c}),{"data-image-padding":o}),(0,i.createElement)("div",{className:p,"data-columns":a,"data-md-columns":l,"data-lg-columns":s},(0,i.createElement)(_.InnerBlocks.Content,null)))},deprecated:N,example:P};!function(e){if(e){var t=e.metadata,n=e.settings,a=e.name;t&&(t.title&&(t.title=(0,o.__)(t.title,"snow-monkey-blocks"),n.title=t.title),t.description&&(t.description=(0,o.__)(t.description,"snow-monkey-blocks"),n.description=t.description),t.keywords&&(t.keywords=(0,o.__)(t.keywords,"snow-monkey-blocks"),n.keywords=t.keywords)),(0,s.registerBlockType)(function(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?m(Object(n),!0).forEach((function(t){r(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):m(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}({name:a},t),n)}}(a)},184:function(e,t){var n;!function(){"use strict";var a={}.hasOwnProperty;function r(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var i=typeof n;if("string"===i||"number"===i)e.push(n);else if(Array.isArray(n)){if(n.length){var l=r.apply(null,n);l&&e.push(l)}}else if("object"===i)if(n.toString===Object.prototype.toString)for(var s in n)a.call(n,s)&&n[s]&&e.push(s);else e.push(n.toString())}}return e.join(" ")}e.exports?(r.default=r,e.exports=r):void 0===(n=function(){return r}.apply(t,[]))||(e.exports=n)}()}},t={};function n(a){var r=t[a];if(void 0!==r)return r.exports;var i=t[a]={exports:{}};return e[a](i,i.exports,n),i.exports}n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,{a:t}),t},n.d=function(e,t){for(var a in t)n.o(t,a)&&!n.o(e,a)&&Object.defineProperty(e,a,{enumerable:!0,get:t[a]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n(369)}();