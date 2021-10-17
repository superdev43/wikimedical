!function(){var e={32:function(e,t,n){"use strict";var a={};function r(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}n.r(a),n.d(a,{metadata:function(){return _},name:function(){return H},settings:function(){return B}});var i=window.wp.element,l=window.lodash,s=window.wp.blocks,o=(window.wp.richText,window.wp.i18n);function c(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}function m(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?c(Object(n),!0).forEach((function(t){r(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):c(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var u=function(e,t){return t?(0,l.reduce)(e,(function(e,n){var a=(0,l.get)(t,["sizes",n.slug,"url"]),i=(0,l.get)(t,["media_details","sizes",n.slug,"source_url"]),s=(0,l.get)(t,["sizes",n.slug,"width"]),o=(0,l.get)(t,["media_details","sizes",n.slug,"width"]),c=(0,l.get)(t,["sizes",n.slug,"height"]),u=(0,l.get)(t,["media_details","sizes",n.slug,"height"]);return m(m({},e),{},r({},n.slug,{url:a||i,width:s||o,height:c||u}))}),{}):{}},_=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/panels--item--horizontal","title":"Item (Horizontal layout)","description":"It is a child block of the panels block.","category":"smb","parent":["snow-monkey-blocks/panels"],"attributes":{"titleTagName":{"type":"string","default":"div"},"title":{"type":"string","source":"html","selector":".smb-panels__item__title","default":""},"summary":{"type":"string","source":"html","selector":".smb-panels__item__content","default":""},"linkLabel":{"type":"string","source":"text","selector":".smb-panels__item__link","default":""},"linkURL":{"type":"string","source":"attribute","selector":".smb-panels__item__action > a","attribute":"href","default":""},"linkTarget":{"type":"string","default":"_self"},"imagePosition":{"type":"string","default":"right"},"imageID":{"type":"number","default":0},"imageURL":{"type":"string","source":"attribute","selector":".smb-panels__item__figure > img","attribute":"src","default":""},"imageAlt":{"type":"string","source":"attribute","selector":".smb-panels__item__figure > img","attribute":"alt","default":""},"imageWidth":{"type":"string","source":"attribute","selector":".smb-panels__item__figure > img","attribute":"width","default":""},"imageHeight":{"type":"string","source":"attribute","selector":".smb-panels__item__figure > img","attribute":"height","default":""},"imageSizeSlug":{"type":"string","default":"large"}},"supports":{"html":false}}'),p=(0,i.createElement)("svg",{viewBox:"0 0 24 24"},(0,i.createElement)("path",{d:"M3,3v8h8V3Zm7,7H4V4h6Z"}),(0,i.createElement)("path",{d:"M13,3v8h8V3Zm7,7H14V4h6Z"}),(0,i.createElement)("path",{d:"M3,13v8h8V13Zm7,7H4V14h6Z"}),(0,i.createElement)("path",{d:"M13,13v8h8V13Zm7,7H14V14h6Z"}));function g(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,a=new Array(t);n<t;n++)a[n]=e[n];return a}var b=n(184),d=n.n(b),f=window.wp.blockEditor,v=window.wp.components,h=window.wp.data,y=window.wp.primitives,E=(0,i.createElement)(y.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,i.createElement)(y.Path,{d:"M15.6 7.2H14v1.5h1.6c2 0 3.7 1.7 3.7 3.7s-1.7 3.7-3.7 3.7H14v1.5h1.6c2.8 0 5.2-2.3 5.2-5.2 0-2.9-2.3-5.2-5.2-5.2zM4.7 12.4c0-2 1.7-3.7 3.7-3.7H10V7.2H8.4c-2.9 0-5.2 2.3-5.2 5.2 0 2.9 2.3 5.2 5.2 5.2H10v-1.5H8.4c-2 0-3.7-1.7-3.7-3.7zm4.6.9h5.3v-1.5H9.3v1.5z"})),k=(0,i.createElement)(y.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,i.createElement)(y.Path,{d:"M15.6 7.3h-.7l1.6-3.5-.9-.4-3.9 8.5H9v1.5h2l-1.3 2.8H8.4c-2 0-3.7-1.7-3.7-3.7s1.7-3.7 3.7-3.7H10V7.3H8.4c-2.9 0-5.2 2.3-5.2 5.2 0 2.9 2.3 5.2 5.2 5.2H9l-1.4 3.2.9.4 5.7-12.5h1.4c2 0 3.7 1.7 3.7 3.7s-1.7 3.7-3.7 3.7H14v1.5h1.6c2.9 0 5.2-2.3 5.2-5.2 0-2.9-2.4-5.2-5.2-5.2z"}));function w(){return w=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var a in n)Object.prototype.hasOwnProperty.call(n,a)&&(e[a]=n[a])}return e},w.apply(this,arguments)}var N=function(e){var t=e.id,n=e.src,a=e.allowedTypes,r=e.accept,l=e.onSelect,s=e.onSelectURL,c=e.onRemove;return(0,i.createElement)(f.BlockControls,{group:"inline"},(0,i.createElement)(f.MediaReplaceFlow,{mediaId:t,mediaURL:n,allowedTypes:a,accept:r,onSelect:l,onSelectURL:s}),!!n&&!!c&&(0,i.createElement)(v.ToolbarItem,{as:v.Button,onClick:c},(0,o.__)("Release","snow-monkey-blocks")))},T=function(e){var t=e.src,n=e.alt,a=e.id,r=e.style;return(0,i.createElement)("img",{src:t,alt:n,className:"wp-image-".concat(a),style:r})},R=function(e){var t=e.src,n=e.style;return(0,i.createElement)("video",{controls:!0,src:t,style:n})},x=(0,i.memo)((function(e){var t,n,a=e.id,r=e.src,s=e.alt,o=e.url,c=e.target,m=e.allowedTypes,u=e.accept,_=e.onSelect,p=e.onSelectURL,g=e.onRemove,b=e.mediaType,d=e.style,f=e.rel,v=e.linkClass;return"image"===b?(t=(0,i.createElement)(T,{src:r,alt:s,id:a,style:d}),n=f?(0,l.isEmpty)(f)?void 0:f:"_self"!==c&&c?"noopener noreferrer":void 0,o&&(t=(0,i.createElement)("span",{href:o,target:"_self"===c?void 0:c,rel:n,className:v},t))):"video"===b&&(t=(0,i.createElement)(R,{src:r,style:d})),(0,i.createElement)(i.Fragment,null,(0,i.createElement)(N,{id:a,src:r,allowedTypes:m,accept:u,onSelect:_,onSelectURL:p,onRemove:g}),t)}),(function(e,t){for(var n=0,a=Object.keys(e);n<a.length;n++){var r=a[n];if(e[r]!==t[r])return!1}return!0}));function S(e){var t=e.src,n=e.onSelect,a=e.onSelectURL,r=e.mediaType,l=e.allowedTypes,s=void 0===l?["image"]:l,c=!r&&t?"image":r,m=(0,o.__)("Media","snow-monkey-blocks");1===s.length&&("image"===s[0]?m=(0,o.__)("Image","snow-monkey-blocks"):"video"===s[0]&&(m=(0,o.__)("Video","snow-monkey-blocks")));var u=(0,i.useMemo)((function(){return s.map((function(e){return"".concat(e,"/*")})).join(",")}),[s]);return t?(0,i.createElement)(x,w({},e,{accept:u,mediaType:c})):(0,i.createElement)(f.MediaPlaceholder,{icon:"format-image",labels:{title:m},onSelect:n,onSelectURL:a,accept:u,allowedTypes:s})}var O=function(e){return"_self"!==e&&("_blank"===e||void 0)};function L(e){var t=e.url,n=e.target,a=e.onChange;return(0,i.createElement)(f.__experimentalLinkControl,{className:"wp-block-navigation-link__inline-link-input",value:{url:t,opensInNewTab:O(n)},onChange:a})}function z(e){var t=e.label,n=e.id,a=e.slug,r=e.onChange;if(!n)return null;var l=(0,h.useSelect)((function(e){var t=(0,e("core").getMedia)(n);if(!t)return{options:[]};var a=(0,e("core/block-editor").getSettings)().imageSizes,r=u(a,t);return{options:a.map((function(e){return!!r[e.slug]&&{value:e.slug,label:e.name}})).filter((function(e){return e}))}})).options;return 1>l.length?null:(0,i.createElement)(v.SelectControl,{label:t,value:a,options:l,onChange:r})}function P(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}function C(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?P(Object(n),!0).forEach((function(t){r(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):P(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var j=_.attributes,U=[{attributes:C({},j),save:function(e){var t=e.attributes,n=e.className,a=t.titleTagName,r=t.title,l=t.summary,s=t.linkLabel,o=t.linkURL,c=t.linkTarget,m=t.imagePosition,u=t.imageID,_=t.imageURL,p=t.imageAlt,g=d()("c-row__col",n),b=d()("smb-panels__item","smb-panels__item--horizontal",{"smb-panels__item--reverse":"right"===m});return(0,i.createElement)("div",{className:g},(0,i.createElement)("div",{className:b},!!_&&(0,i.createElement)("div",{className:"smb-panels__item__figure"},(0,i.createElement)("img",{src:_,alt:p,className:"wp-image-".concat(u)})),(0,i.createElement)("div",{className:"smb-panels__item__body"},!f.RichText.isEmpty(r)&&"none"!==a&&(0,i.createElement)(f.RichText.Content,{tagName:a,className:"smb-panels__item__title",value:r}),!f.RichText.isEmpty(l)&&(0,i.createElement)("div",{className:"smb-panels__item__content"},(0,i.createElement)(f.RichText.Content,{value:l})),!f.RichText.isEmpty(s)&&(0,i.createElement)("div",{className:"smb-panels__item__action"},o?(0,i.createElement)("a",{href:o,target:"_self"===c?void 0:c,rel:"_self"===c?void 0:"noopener noreferrer"},(0,i.createElement)("div",{className:"smb-panels__item__link"},(0,i.createElement)(f.RichText.Content,{value:s}))):(0,i.createElement)("div",{className:"smb-panels__item__link"},(0,i.createElement)(f.RichText.Content,{value:s}))))))}},{attributes:C(C({},j),{},{linkURL:{type:"string",source:"attribute",selector:".smb-panels__item",attribute:"href",default:""},linkTarget:{type:"string",source:"attribute",selector:".smb-panels__item",attribute:"target",default:"_self"}}),save:function(e){var t=e.attributes,n=e.className,a=t.titleTagName,r=t.title,l=t.summary,s=t.linkLabel,o=t.linkURL,c=t.linkTarget,m=t.imagePosition,u=t.imageID,_=t.imageURL,p=t.imageAlt,g=(0,i.createElement)(i.Fragment,null,!!_&&(0,i.createElement)("div",{className:"smb-panels__item__figure"},(0,i.createElement)("img",{src:_,alt:p,className:"wp-image-".concat(u)})),(0,i.createElement)("div",{className:"smb-panels__item__body"},!f.RichText.isEmpty(r)&&"none"!==a&&(0,i.createElement)(f.RichText.Content,{tagName:a,className:"smb-panels__item__title",value:r}),!f.RichText.isEmpty(l)&&(0,i.createElement)("div",{className:"smb-panels__item__content"},(0,i.createElement)(f.RichText.Content,{value:l})),!f.RichText.isEmpty(s)&&(0,i.createElement)("div",{className:"smb-panels__item__action"},(0,i.createElement)("div",{className:"smb-panels__item__link"},(0,i.createElement)(f.RichText.Content,{value:s}))))),b=d()("c-row__col",n),v=d()("smb-panels__item","smb-panels__item--horizontal",{"smb-panels__item--reverse":"right"===m});return(0,i.createElement)("div",{className:b},o?(0,i.createElement)("a",{className:v,href:o,target:"_self"===c?void 0:c,rel:"_self"===c?void 0:"noopener noreferrer"},g):(0,i.createElement)("div",{className:v},g))}},{attributes:C(C({},j),{},{linkURL:{type:"string",source:"attribute",selector:".smb-panels__item",attribute:"href",default:""},linkTarget:{type:"string",source:"attribute",selector:".smb-panels__item",attribute:"target",default:"_self"}}),save:function(e){var t=e.attributes,n=t.titleTagName,a=t.title,r=t.summary,l=t.linkLabel,s=t.linkURL,o=t.linkTarget,c=t.imagePosition,m=t.imageID,u=t.imageURL,_=function(){return(0,i.createElement)(i.Fragment,null,!!m&&(0,i.createElement)("div",{className:"smb-panels__item__figure"},(0,i.createElement)("img",{src:u,alt:"",className:"wp-image-".concat(m)})),(0,i.createElement)("div",{className:"smb-panels__item__body"},!f.RichText.isEmpty(a)&&(0,i.createElement)(f.RichText.Content,{tagName:n,className:"smb-panels__item__title",value:a}),!f.RichText.isEmpty(r)&&(0,i.createElement)("div",{className:"smb-panels__item__content"},(0,i.createElement)(f.RichText.Content,{value:r})),!f.RichText.isEmpty(l)&&(0,i.createElement)("div",{className:"smb-panels__item__action"},(0,i.createElement)("div",{className:"smb-panels__item__link"},(0,i.createElement)(f.RichText.Content,{value:l})))))};return(0,i.createElement)("div",{className:"c-row__col"},(0,i.createElement)((function(){return s?(0,i.createElement)("a",{className:d()("smb-panels__item","smb-panels__item--horizontal",{"smb-panels__item--reverse":"right"===c}),href:s,target:"_self"===o?void 0:o,rel:"_self"===o?void 0:"noopener noreferrer"},(0,i.createElement)(_,null)):(0,i.createElement)("div",{className:d()("smb-panels__item","smb-panels__item--horizontal",{"smb-panels__item--reverse":"right"===c})},(0,i.createElement)(_,null))}),null))}},{attributes:C(C({},j),{},{linkURL:{type:"string",source:"attribute",selector:".smb-panels__item",attribute:"href",default:""},linkTarget:{type:"string",source:"attribute",selector:".smb-panels__item",attribute:"target",default:"_self"}}),save:function(e){var t,n=e.attributes,a=n.titleTagName,r=n.title,l=n.summary,s=n.linkLabel,o=n.linkURL,c=n.linkTarget,m=n.imagePosition,u=n.imageID,_=n.imageURL;return(0,i.createElement)("div",{className:"c-row__col"},(t=(0,i.createElement)(i.Fragment,null,!!u&&(0,i.createElement)("div",{className:"smb-panels__item__figure"},(0,i.createElement)("img",{src:_,alt:"",className:"wp-image-".concat(u)})),(0,i.createElement)("div",{className:"smb-panels__item__body"},!f.RichText.isEmpty(r)&&(0,i.createElement)(f.RichText.Content,{tagName:a,className:"smb-panels__item__title",value:r}),!f.RichText.isEmpty(l)&&(0,i.createElement)("div",{className:"smb-panels__item__content"},(0,i.createElement)(f.RichText.Content,{value:l})),!f.RichText.isEmpty(s)&&(0,i.createElement)("div",{className:"smb-panels__item__action"},(0,i.createElement)("div",{className:"smb-panels__item__link"},(0,i.createElement)(f.RichText.Content,{value:s}))))),o?(0,i.createElement)("a",{className:d()("smb-panels__item","smb-panels__item--horizontal",{"smb-panels__item--reverse":"right"===m}),href:o,target:c},t):(0,i.createElement)("div",{className:d()("smb-panels__item","smb-panels__item--horizontal",{"smb-panels__item--reverse":"right"===m}),href:o,target:c},t)))}}],I={to:[{type:"block",blocks:["snow-monkey-blocks/panels--item"],transform:function(e){return(0,s.createBlock)("snow-monkey-blocks/panels--item",e)}},{type:"block",blocks:["snow-monkey-blocks/panels--item--free"],transform:function(e){return(0,s.createBlock)("snow-monkey-blocks/panels--item--free",{},[(0,s.createBlock)("core/paragraph",{content:e.summary})])}}]},H=_.name,B={icon:{foreground:"#cd162c",src:p},edit:function(e){var t,n,a=e.attributes,r=e.setAttributes,s=e.isSelected,c=e.className,m=a.titleTagName,_=a.title,p=a.summary,b=a.linkLabel,y=a.linkURL,w=a.linkTarget,N=a.imagePosition,T=a.imageID,R=a.imageURL,x=a.imageAlt,O=a.imageWidth,P=a.imageHeight,C=a.imageSizeSlug,j=(t=(0,i.useState)(!1),n=2,function(e){if(Array.isArray(e))return e}(t)||function(e,t){var n=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null!=n){var a,r,i=[],_n=!0,l=!1;try{for(n=n.call(e);!(_n=(a=n.next()).done)&&(i.push(a.value),!t||i.length!==t);_n=!0);}catch(e){l=!0,r=e}finally{try{_n||null==n.return||n.return()}finally{if(l)throw r}}return i}}(t,n)||function(e,t){if(e){if("string"==typeof e)return g(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);return"Object"===n&&e.constructor&&(n=e.constructor.name),"Map"===n||"Set"===n?Array.from(e):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?g(e,t):void 0}}(t,n)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()),U=j[0],I=j[1],H=!!y,B=H&&s,D=(0,h.useSelect)((function(e){if(!T)return{resizedImages:{}};var t=(0,e("core").getMedia)(T);if(!t)return{resizedImages:{}};var n=(0,e("core/block-editor").getSettings)().imageSizes;return{resizedImages:u(n,t)}})).resizedImages,M=["div","h2","h3","none"],A=d()("c-row__col",c),V=d()("smb-panels__item","smb-panels__item--horizontal",{"smb-panels__item--reverse":"right"===N}),W=d()("smb-panels__item__action",{"smb-panels__item__action--nolabel":!b&&!s}),Z=(0,i.useRef)(),F=(0,f.useBlockProps)({className:A,ref:Z}),G=function(e){var t=e.url,n=e.opensInNewTab;return r({linkURL:t,linkTarget:n?"_blank":"_self"})};return(0,i.createElement)(i.Fragment,null,(0,i.createElement)(f.InspectorControls,null,(0,i.createElement)(v.PanelBody,{title:(0,o.__)("Block Settings","snow-monkey-blocks")},(0,i.createElement)(v.BaseControl,{label:(0,o.__)("Title Tag","snow-monkey-blocks"),id:"snow-monkey-blocks/panels--item--horizontal/title-tag-name"},(0,i.createElement)("div",{className:"smb-list-icon-selector"},(0,l.times)(M.length,(function(e){var t=m===M[e];return(0,i.createElement)(v.Button,{isPrimary:t,isSecondary:!t,onClick:function(){return r({titleTagName:M[e]})},key:e},M[e])})))),(0,i.createElement)(v.SelectControl,{label:(0,o.__)("Image Position","snow-monkey-blocks"),value:N,options:[{value:"right",label:(0,o.__)("Right side","snow-monkey-blocks")},{value:"left",label:(0,o.__)("Left side","snow-monkey-blocks")}],onChange:function(e){return r({imagePosition:e})}}),(0,i.createElement)(z,{label:(0,o.__)("Images size","snow-monkey-blocks"),id:T,slug:C,onChange:function(e){var t=R;D[e]&&D[e].url&&(t=D[e].url);var n=O;D[e]&&D[e].width&&(n=D[e].width);var a=P;D[e]&&D[e].height&&(a=D[e].height),r({imageURL:t,imageWidth:n,imageHeight:a,imageSizeSlug:e})}}))),(0,i.createElement)("div",F,(0,i.createElement)("div",{className:V},(!!R||s)&&(0,i.createElement)("div",{className:"smb-panels__item__figure"},(0,i.createElement)(S,{src:R,id:T,alt:x,onSelect:function(e){var t=e.sizes&&e.sizes[C]?e.sizes[C].url:e.url,n=e.sizes&&e.sizes[C]?e.sizes[C].width:e.width,a=e.sizes&&e.sizes[C]?e.sizes[C].height:e.height;r({imageURL:t,imageID:e.id,imageAlt:e.alt,imageWidth:n,imageHeight:a})},onSelectURL:function(e){e!==R&&r({imageURL:e,imageID:0,imageSizeSlug:"large"})},onRemove:function(){return r({imageURL:"",imageAlt:"",imageWidth:"",imageHeight:"",imageID:0})},isSelected:s})),(0,i.createElement)("div",{className:"smb-panels__item__body"},(!f.RichText.isEmpty(_)||s)&&"none"!==m&&(0,i.createElement)(f.RichText,{tagName:m,className:"smb-panels__item__title",placeholder:(0,o.__)("Write title…","snow-monkey-blocks"),value:_,onChange:function(e){return r({title:e})}}),(!f.RichText.isEmpty(p)||s)&&(0,i.createElement)(f.RichText,{className:"smb-panels__item__content",placeholder:(0,o.__)("Write content…","snow-monkey-blocks"),value:p,onChange:function(e){return r({summary:e})}}),(!f.RichText.isEmpty(b)||!!y||s)&&(0,i.createElement)("div",{className:W},(!f.RichText.isEmpty(b)||s)&&(0,i.createElement)(f.RichText,{className:"smb-panels__item__link",value:b,placeholder:(0,o.__)("Link","snow-monkey-blocks"),onChange:function(e){return r({linkLabel:(t=e,n=document.createElement("div"),n.style.display="none",n.innerHTML=t,n.innerText)});var t,n}})),(U||B)&&(0,i.createElement)(v.Popover,{position:"bottom center",anchorRef:Z.current,onClose:function(){return I(!1)}},(0,i.createElement)(L,{url:y,target:w,onChange:G}))))),(0,i.createElement)(f.BlockControls,{group:"block"},!H&&(0,i.createElement)(v.ToolbarButton,{icon:E,label:(0,o.__)("Link","snow-monkey-blocks"),"aria-expanded":U,onClick:function(){return I(!U)}}),B&&(0,i.createElement)(v.ToolbarButton,{isPressed:!0,icon:k,label:(0,o.__)("Unlink","snow-monkey-blocks"),onClick:function(){return G("")}})))},save:function(e){var t=e.attributes,n=e.className,a=t.titleTagName,r=t.title,l=t.summary,s=t.linkLabel,o=t.linkURL,c=t.linkTarget,m=t.imagePosition,u=t.imageID,_=t.imageURL,p=t.imageAlt,g=t.imageWidth,b=t.imageHeight,v=d()("c-row__col",n),h=d()("smb-panels__item","smb-panels__item--horizontal",{"smb-panels__item--reverse":"right"===m}),y=d()("smb-panels__item__action",{"smb-panels__item__action--nolabel":!s}),E=!f.RichText.isEmpty(s)&&(0,i.createElement)("div",{className:"smb-panels__item__link"},(0,i.createElement)(f.RichText.Content,{value:s}));return(0,i.createElement)("div",f.useBlockProps.save({className:v}),(0,i.createElement)("div",{className:h},!!_&&(0,i.createElement)("div",{className:"smb-panels__item__figure"},(0,i.createElement)("img",{src:_,alt:p,width:!!g&&g,height:!!b&&b,className:"wp-image-".concat(u)})),(0,i.createElement)("div",{className:"smb-panels__item__body"},!f.RichText.isEmpty(r)&&"none"!==a&&(0,i.createElement)(f.RichText.Content,{tagName:a,className:"smb-panels__item__title",value:r}),!f.RichText.isEmpty(l)&&(0,i.createElement)("div",{className:"smb-panels__item__content"},(0,i.createElement)(f.RichText.Content,{value:l})),(!f.RichText.isEmpty(s)||!!o)&&(0,i.createElement)("div",{className:y},o?(0,i.createElement)("a",{href:o,target:"_self"===c?void 0:c,rel:"_self"===c?void 0:"noopener noreferrer"},E):(0,i.createElement)(i.Fragment,null,E)))))},deprecated:U,transforms:I};!function(e){if(e){var t=e.metadata,n=e.settings,a=e.name;t&&(t.title&&(t.title=(0,o.__)(t.title,"snow-monkey-blocks"),n.title=t.title),t.description&&(t.description=(0,o.__)(t.description,"snow-monkey-blocks"),n.description=t.description),t.keywords&&(t.keywords=(0,o.__)(t.keywords,"snow-monkey-blocks"),n.keywords=t.keywords)),(0,s.registerBlockType)(m({name:a},t),n)}}(a)},184:function(e,t){var n;!function(){"use strict";var a={}.hasOwnProperty;function r(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var i=typeof n;if("string"===i||"number"===i)e.push(n);else if(Array.isArray(n)){if(n.length){var l=r.apply(null,n);l&&e.push(l)}}else if("object"===i)if(n.toString===Object.prototype.toString)for(var s in n)a.call(n,s)&&n[s]&&e.push(s);else e.push(n.toString())}}return e.join(" ")}e.exports?(r.default=r,e.exports=r):void 0===(n=function(){return r}.apply(t,[]))||(e.exports=n)}()}},t={};function n(a){var r=t[a];if(void 0!==r)return r.exports;var i=t[a]={exports:{}};return e[a](i,i.exports,n),i.exports}n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,{a:t}),t},n.d=function(e,t){for(var a in t)n.o(t,a)&&!n.o(e,a)&&Object.defineProperty(e,a,{enumerable:!0,get:t[a]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n(32)}();