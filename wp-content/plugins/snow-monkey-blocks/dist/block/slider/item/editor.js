!function(){var e={430:function(e,t,r){"use strict";var n={};function i(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}r.r(n),r.d(n,{metadata:function(){return g},name:function(){return x},settings:function(){return C}});var a=window.wp.element,o=window.lodash,l=window.wp.blocks,s=(window.wp.richText,window.wp.i18n);function c(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function u(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?c(Object(r),!0).forEach((function(t){i(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):c(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}var m=function(e,t){return t?(0,o.reduce)(e,(function(e,r){var n=(0,o.get)(t,["sizes",r.slug,"url"]),a=(0,o.get)(t,["media_details","sizes",r.slug,"source_url"]),l=(0,o.get)(t,["sizes",r.slug,"width"]),s=(0,o.get)(t,["media_details","sizes",r.slug,"width"]),c=(0,o.get)(t,["sizes",r.slug,"height"]),m=(0,o.get)(t,["media_details","sizes",r.slug,"height"]);return u(u({},e),{},i({},r.slug,{url:n||a,width:l||s,height:c||m}))}),{}):{}},g=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/slider--item","title":"Items (Deprecated)","description":"It is a child block of the slider block.","category":"smb-deprecated","parent":["snow-monkey-blocks/slider"],"attributes":{"imageID":{"type":"number","default":0},"imageURL":{"type":"string","source":"attribute","selector":".smb-slider__item__figure > img","attribute":"src","default":""},"imageAlt":{"type":"string","source":"attribute","selector":".smb-slider__item__figure > img","attribute":"alt","default":""},"imageWidth":{"type":"string","source":"attribute","selector":".smb-slider__item__figure > img","attribute":"width","default":""},"imageHeight":{"type":"string","source":"attribute","selector":".smb-slider__item__figure > img","attribute":"height","default":""},"imageSizeSlug":{"type":"string","default":"large"},"caption":{"type":"string","source":"html","selector":".smb-slider__item__caption","default":""},"url":{"type":"string","default":""},"target":{"type":"string","default":"_self"}},"supports":{"html":false}}'),d=(0,a.createElement)("svg",{viewBox:"0 0 24 24"},(0,a.createElement)("path",{d:"M5,5.78V18.22a.78.78,0,0,0,.78.78H18.22a.78.78,0,0,0,.78-.78V5.78A.78.78,0,0,0,18.22,5H5.78A.78.78,0,0,0,5,5.78m12.44,12H6.56a.38.38,0,0,1-.39-.39V6.56a.38.38,0,0,1,.39-.39H17.44a.38.38,0,0,1,.39.39V17.44a.38.38,0,0,1-.39.39"}),(0,a.createElement)("path",{d:"M6.17,14.16l3.06-2.23a.22.22,0,0,1,.22,0l2.34,1.5a.21.21,0,0,0,.24,0l3-2.83a.19.19,0,0,1,.27,0l3.09,3v1.16l-3.09-3a.18.18,0,0,0-.27,0l-3,2.82a.19.19,0,0,1-.24,0L9.45,13.11a.18.18,0,0,0-.22,0L6.17,15.33Z"}),(0,a.createElement)("path",{d:"M2.22,5H0V6.17H1.44a.38.38,0,0,1,.39.39V17.44a.38.38,0,0,1-.39.39H0V19H2.22A.78.78,0,0,0,3,18.22V5.78A.78.78,0,0,0,2.22,5Z"}),(0,a.createElement)("path",{d:"M24,17.83H22.56a.38.38,0,0,1-.39-.39V6.56a.38.38,0,0,1,.39-.39H24V5H21.78a.78.78,0,0,0-.78.78V18.22a.78.78,0,0,0,.78.78H24Z"}));function p(e,t){(null==t||t>e.length)&&(t=e.length);for(var r=0,n=new Array(t);r<t;r++)n[r]=e[r];return n}var f=r(184),b=r.n(f),v=window.wp.blockEditor,h=window.wp.components,y=window.wp.data,w=window.wp.primitives,_=(0,a.createElement)(w.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,a.createElement)(w.Path,{d:"M15.6 7.2H14v1.5h1.6c2 0 3.7 1.7 3.7 3.7s-1.7 3.7-3.7 3.7H14v1.5h1.6c2.8 0 5.2-2.3 5.2-5.2 0-2.9-2.3-5.2-5.2-5.2zM4.7 12.4c0-2 1.7-3.7 3.7-3.7H10V7.2H8.4c-2.9 0-5.2 2.3-5.2 5.2 0 2.9 2.3 5.2 5.2 5.2H10v-1.5H8.4c-2 0-3.7-1.7-3.7-3.7zm4.6.9h5.3v-1.5H9.3v1.5z"})),k=(0,a.createElement)(w.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,a.createElement)(w.Path,{d:"M15.6 7.3h-.7l1.6-3.5-.9-.4-3.9 8.5H9v1.5h2l-1.3 2.8H8.4c-2 0-3.7-1.7-3.7-3.7s1.7-3.7 3.7-3.7H10V7.3H8.4c-2.9 0-5.2 2.3-5.2 5.2 0 2.9 2.3 5.2 5.2 5.2H9l-1.4 3.2.9.4 5.7-12.5h1.4c2 0 3.7 1.7 3.7 3.7s-1.7 3.7-3.7 3.7H14v1.5h1.6c2.9 0 5.2-2.3 5.2-5.2 0-2.9-2.4-5.2-5.2-5.2z"}));function E(){return E=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var r=arguments[t];for(var n in r)Object.prototype.hasOwnProperty.call(r,n)&&(e[n]=r[n])}return e},E.apply(this,arguments)}var S=function(e){var t=e.id,r=e.src,n=e.allowedTypes,i=e.accept,o=e.onSelect,l=e.onSelectURL,c=e.onRemove;return(0,a.createElement)(v.BlockControls,{group:"inline"},(0,a.createElement)(v.MediaReplaceFlow,{mediaId:t,mediaURL:r,allowedTypes:n,accept:i,onSelect:o,onSelectURL:l}),!!r&&!!c&&(0,a.createElement)(h.ToolbarItem,{as:h.Button,onClick:c},(0,s.__)("Release","snow-monkey-blocks")))},O=function(e){var t=e.src,r=e.alt,n=e.id,i=e.style;return(0,a.createElement)("img",{src:t,alt:r,className:"wp-image-".concat(n),style:i})},j=function(e){var t=e.src,r=e.style;return(0,a.createElement)("video",{controls:!0,src:t,style:r})},H=(0,a.memo)((function(e){var t,r,n=e.id,i=e.src,l=e.alt,s=e.url,c=e.target,u=e.allowedTypes,m=e.accept,g=e.onSelect,d=e.onSelectURL,p=e.onRemove,f=e.mediaType,b=e.style,v=e.rel,h=e.linkClass;return"image"===f?(t=(0,a.createElement)(O,{src:i,alt:l,id:n,style:b}),r=v?(0,o.isEmpty)(v)?void 0:v:"_self"!==c&&c?"noopener noreferrer":void 0,s&&(t=(0,a.createElement)("span",{href:s,target:"_self"===c?void 0:c,rel:r,className:h},t))):"video"===f&&(t=(0,a.createElement)(j,{src:i,style:b})),(0,a.createElement)(a.Fragment,null,(0,a.createElement)(S,{id:n,src:i,allowedTypes:u,accept:m,onSelect:g,onSelectURL:d,onRemove:p}),t)}),(function(e,t){for(var r=0,n=Object.keys(e);r<n.length;r++){var i=n[r];if(e[i]!==t[i])return!1}return!0}));function P(e){var t=e.src,r=e.onSelect,n=e.onSelectURL,i=e.mediaType,o=e.allowedTypes,l=void 0===o?["image"]:o,c=!i&&t?"image":i,u=(0,s.__)("Media","snow-monkey-blocks");1===l.length&&("image"===l[0]?u=(0,s.__)("Image","snow-monkey-blocks"):"video"===l[0]&&(u=(0,s.__)("Video","snow-monkey-blocks")));var m=(0,a.useMemo)((function(){return l.map((function(e){return"".concat(e,"/*")})).join(",")}),[l]);return t?(0,a.createElement)(H,E({},e,{accept:m,mediaType:c})):(0,a.createElement)(v.MediaPlaceholder,{icon:"format-image",labels:{title:u},onSelect:r,onSelectURL:n,accept:m,allowedTypes:l})}var z=function(e){return"_self"!==e&&("_blank"===e||void 0)};function R(e){var t=e.url,r=e.target,n=e.onChange;return(0,a.createElement)(v.__experimentalLinkControl,{className:"wp-block-navigation-link__inline-link-input",value:{url:t,opensInNewTab:z(r)},onChange:n})}function T(e){var t=e.label,r=e.id,n=e.slug,i=e.onChange;if(!r)return null;var o=(0,y.useSelect)((function(e){var t=(0,e("core").getMedia)(r);if(!t)return{options:[]};var n=(0,e("core/block-editor").getSettings)().imageSizes,i=m(n,t);return{options:n.map((function(e){return!!i[e.slug]&&{value:e.slug,label:e.name}})).filter((function(e){return e}))}})).options;return 1>o.length?null:(0,a.createElement)(h.SelectControl,{label:t,value:n,options:o,onChange:i})}function I(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}var N=[{attributes:function(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?I(Object(r),!0).forEach((function(t){i(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):I(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}({},g.attributes),save:function(e){var t=e.attributes,r=e.className,n=t.imageID,i=t.imageURL,o=t.imageAlt,l=t.imageWidth,s=t.imageHeight,c=t.caption,u=t.url,m=t.target,g=b()("smb-slider__item",r),d=(0,a.createElement)(a.Fragment,null,(0,a.createElement)("div",{className:"smb-slider__item__figure"},(0,a.createElement)("img",{src:i,alt:o,width:!!l&&l,height:!!s&&s,className:"wp-image-".concat(n)})),!v.RichText.isEmpty(c)&&(0,a.createElement)("div",{className:"smb-slider__item__caption"},(0,a.createElement)(v.RichText.Content,{value:c})));return u?(0,a.createElement)("a",{className:g,href:u,target:"_self"===m?void 0:m,rel:"_self"===m?void 0:"noopener noreferrer"},d):(0,a.createElement)("div",{className:g},d)}}],x=g.name,C={icon:{foreground:"#cd162c",src:d},edit:function(e){var t,r,n=e.attributes,i=e.setAttributes,o=e.isSelected,l=e.className,c=n.imageID,u=n.imageURL,g=n.imageAlt,d=n.imageWidth,f=n.imageHeight,w=n.imageSizeSlug,E=n.caption,S=n.url,O=n.target,j=(t=(0,a.useState)(!1),r=2,function(e){if(Array.isArray(e))return e}(t)||function(e,t){var r=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null!=r){var n,i,a=[],_n=!0,o=!1;try{for(r=r.call(e);!(_n=(n=r.next()).done)&&(a.push(n.value),!t||a.length!==t);_n=!0);}catch(e){o=!0,i=e}finally{try{_n||null==r.return||r.return()}finally{if(o)throw i}}return a}}(t,r)||function(e,t){if(e){if("string"==typeof e)return p(e,t);var r=Object.prototype.toString.call(e).slice(8,-1);return"Object"===r&&e.constructor&&(r=e.constructor.name),"Map"===r||"Set"===r?Array.from(e):"Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r)?p(e,t):void 0}}(t,r)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()),H=j[0],z=j[1],I=!!S,N=I&&o,x=(0,y.useSelect)((function(e){if(!c)return{resizedImages:{}};var t=(0,e("core").getMedia)(c);if(!t)return{resizedImages:{}};var r=(0,e("core/block-editor").getSettings)().imageSizes;return{resizedImages:m(r,t)}})).resizedImages,C=b()("c-row__col",l),L=(0,a.useRef)(),A=(0,v.useBlockProps)({className:C,ref:L}),U=function(e){var t=e.url,r=e.opensInNewTab;return i({url:t,target:r?"_blank":"_self"})},M=(0,a.createElement)(a.Fragment,null,(0,a.createElement)("div",{className:"smb-slider__item__figure"},(0,a.createElement)(P,{src:u,id:c,alt:g,onSelect:function(e){var t=e.sizes&&e.sizes[w]?e.sizes[w].url:e.url,r=e.sizes&&e.sizes[w]?e.sizes[w].width:e.width,n=e.sizes&&e.sizes[w]?e.sizes[w].height:e.height;i({imageURL:t,imageID:e.id,imageAlt:e.alt,imageWidth:r,imageHeight:n})},onSelectURL:function(e){e!==u&&i({imageURL:e,imageID:0,imageSizeSlug:"large"})},onRemove:function(){return i({imageURL:"",imageAlt:"",imageWidth:"",imageHeight:"",imageID:0})},isSelected:o}),(H||N)&&(0,a.createElement)(h.Popover,{position:"bottom center",anchorRef:L.current,onClose:function(){return z(!1)}},(0,a.createElement)(R,{url:S,target:O,onChange:U}))),o&&(0,a.createElement)(v.RichText,{className:"smb-slider__item__caption",placeholder:(0,s.__)("Write caption…","snow-monkey-blocks"),value:E,onChange:function(e){return i({caption:e})}}));return(0,a.createElement)(a.Fragment,null,(0,a.createElement)(v.InspectorControls,null,(0,a.createElement)(h.PanelBody,{title:(0,s.__)("Block Settings","snow-monkey-blocks")},(0,a.createElement)(T,{label:(0,s.__)("Images size","snow-monkey-blocks"),id:c,slug:w,onChange:function(e){var t=u;x[e]&&x[e].url&&(t=x[e].url);var r=d;x[e]&&x[e].width&&(r=x[e].width);var n=f;x[e]&&x[e].height&&(n=x[e].height),i({imageURL:t,imageWidth:r,imageHeight:n,imageSizeSlug:e})}}))),(0,a.createElement)("div",A,M),(0,a.createElement)(v.BlockControls,{group:"block"},!I&&(0,a.createElement)(h.ToolbarButton,{icon:_,label:(0,s.__)("Link","snow-monkey-blocks"),"aria-expanded":H,onClick:function(){return z(!H)}}),N&&(0,a.createElement)(h.ToolbarButton,{isPressed:!0,icon:k,label:(0,s.__)("Unlink","snow-monkey-blocks"),onClick:function(){return U("")}})))},save:function(e){var t=e.attributes,r=e.className,n=t.imageID,i=t.imageURL,o=t.imageAlt,l=t.imageWidth,s=t.imageHeight,c=t.caption,u=t.url,m=t.target,g=b()("smb-slider__item",r),d=(0,a.createElement)(a.Fragment,null,(0,a.createElement)("div",{className:"smb-slider__item__figure"},(0,a.createElement)("img",{src:i,alt:o,width:!!l&&l,height:!!s&&s,className:"wp-image-".concat(n),decoding:"auto",loading:"auto"})),!v.RichText.isEmpty(c)&&(0,a.createElement)("div",{className:"smb-slider__item__caption"},(0,a.createElement)(v.RichText.Content,{value:c})));return u?(0,a.createElement)("a",E({},v.useBlockProps.save({className:g}),{href:u,target:"_self"===m?void 0:m,rel:"_self"===m?void 0:"noopener noreferrer"}),d):(0,a.createElement)("div",v.useBlockProps.save({className:g}),d)},deprecated:N};!function(e){if(e){var t=e.metadata,r=e.settings,n=e.name;t&&(t.title&&(t.title=(0,s.__)(t.title,"snow-monkey-blocks"),r.title=t.title),t.description&&(t.description=(0,s.__)(t.description,"snow-monkey-blocks"),r.description=t.description),t.keywords&&(t.keywords=(0,s.__)(t.keywords,"snow-monkey-blocks"),r.keywords=t.keywords)),(0,l.registerBlockType)(u({name:n},t),r)}}(n)},184:function(e,t){var r;!function(){"use strict";var n={}.hasOwnProperty;function i(){for(var e=[],t=0;t<arguments.length;t++){var r=arguments[t];if(r){var a=typeof r;if("string"===a||"number"===a)e.push(r);else if(Array.isArray(r)){if(r.length){var o=i.apply(null,r);o&&e.push(o)}}else if("object"===a)if(r.toString===Object.prototype.toString)for(var l in r)n.call(r,l)&&r[l]&&e.push(l);else e.push(r.toString())}}return e.join(" ")}e.exports?(i.default=i,e.exports=i):void 0===(r=function(){return i}.apply(t,[]))||(e.exports=r)}()}},t={};function r(n){var i=t[n];if(void 0!==i)return i.exports;var a=t[n]={exports:{}};return e[n](a,a.exports,r),a.exports}r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,{a:t}),t},r.d=function(e,t){for(var n in t)r.o(t,n)&&!r.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r(430)}();