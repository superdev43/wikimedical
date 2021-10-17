!function(){var e={666:function(e,t,i){"use strict";var a={};function r(e,t,i){return t in e?Object.defineProperty(e,t,{value:i,enumerable:!0,configurable:!0,writable:!0}):e[t]=i,e}i.r(a),i.d(a,{metadata:function(){return f},name:function(){return H},settings:function(){return V}});var n=window.wp.element,o=window.lodash,l=window.wp.blocks,m=(window.wp.richText,window.wp.i18n);function c(e,t){var i=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),i.push.apply(i,a)}return i}function s(e){for(var t=1;t<arguments.length;t++){var i=null!=arguments[t]?arguments[t]:{};t%2?c(Object(i),!0).forEach((function(t){r(e,t,i[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(i)):c(Object(i)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(i,t))}))}return e}var d=function(e){var t="1-3",i="2-3";return 75===parseInt(e)?(t="1-4",i="3-4"):66===parseInt(e)?(t="1-3",i="2-3"):50===parseInt(e)?(t="1-2",i="1-2"):33===parseInt(e)?(t="2-3",i="1-3"):25===parseInt(e)&&(t="3-4",i="1-4"),{textColumnWidth:t,mediaColumnWidth:i,imageColumnWidth:i}},u=function(e){return e.media_type?"image"===e.media_type?"image":"video":e.type},g=function(e,t){return t?(0,o.reduce)(e,(function(e,i){var a=(0,o.get)(t,["sizes",i.slug,"url"]),n=(0,o.get)(t,["media_details","sizes",i.slug,"source_url"]),l=(0,o.get)(t,["sizes",i.slug,"width"]),m=(0,o.get)(t,["media_details","sizes",i.slug,"width"]),c=(0,o.get)(t,["sizes",i.slug,"height"]),d=(0,o.get)(t,["media_details","sizes",i.slug,"height"]);return s(s({},e),{},r({},i.slug,{url:a||n,width:l||m,height:c||d}))}),{}):{}},p=["avi","mpg","mpeg","mov","mp4","m4v","ogg","ogv","webm","wmv"];function b(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"",t=e.split(".");return t[t.length-1]}function _(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";return!!e&&p.includes(b(e))}var f=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/media-text","title":"Media & text","description":"Set media and words side-by-side for a richer layout.","category":"smb","attributes":{"titleTagName":{"type":"string","default":"h2"},"title":{"type":"string","source":"html","selector":".smb-media-text__title","default":""},"mediaId":{"type":"number","default":0},"mediaUrl":{"type":"string","source":"attribute","selector":".smb-media-text__figure img, .smb-media-text__figure video","attribute":"src","default":""},"mediaLink":{"type":"string"},"mediaAlt":{"type":"string","source":"attribute","selector":".smb-media-text__figure img","attribute":"alt","default":""},"mediaWidth":{"type":"string","source":"attribute","selector":".smb-media-text__figure img, .smb-media-text__figure video","attribute":"width","default":""},"mediaHeight":{"type":"string","source":"attribute","selector":".smb-media-text__figure img, .smb-media-text__figure video","attribute":"height","default":""},"mediaSizeSlug":{"type":"string","default":"large"},"mediaType":{"type":"string"},"caption":{"type":"string","source":"html","selector":".smb-media-text__caption","default":""},"mediaPosition":{"type":"string","default":"right"},"verticalAlignment":{"type":"string","default":"center"},"mediaColumnSize":{"type":"string","default":66},"mobileOrder":{"type":"string"},"href":{"type":"string","default":""},"rel":{"type":"string","source":"attribute","selector":".smb-media-text__figure > a","attribute":"rel"},"linkClass":{"type":"string","source":"attribute","selector":".smb-media-text__figure > a","attribute":"class"},"linkDestination":{"type":"string"},"linkTarget":{"type":"string","source":"attribute","selector":".smb-media-text__figure > a","attribute":"target","default":"_self"}},"supports":{"anchor":true}}'),v=(0,n.createElement)("svg",{viewBox:"0 0 24 24"},(0,n.createElement)("path",{d:"M0,7.11v9.78a.61.61,0,0,0,.61.61h9.78a.61.61,0,0,0,.61-.61V7.11a.61.61,0,0,0-.61-.61H.61A.61.61,0,0,0,0,7.11m9.78,9.47H1.22a.29.29,0,0,1-.3-.3V7.72a.29.29,0,0,1,.3-.3H9.78a.29.29,0,0,1,.3.3v8.56a.29.29,0,0,1-.3.3"}),(0,n.createElement)("path",{d:"M.92,13.7,3.33,12a.15.15,0,0,1,.17,0l1.84,1.18a.15.15,0,0,0,.19,0l2.31-2.22a.15.15,0,0,1,.21,0l2.43,2.37v.91L8.05,11.8a.14.14,0,0,0-.21,0L5.53,14a.17.17,0,0,1-.19,0L3.5,12.87a.15.15,0,0,0-.18,0L.92,14.62Z"}),(0,n.createElement)("rect",{y:"6.5",width:"11",height:"11",fill:"none"}),(0,n.createElement)("rect",{x:"13.5",y:"8.5",width:"10.5",height:"1"}),(0,n.createElement)("rect",{x:"13.5",y:"11.5",width:"10.5",height:"1"}),(0,n.createElement)("rect",{x:"13.5",y:"14.5",width:"10.5",height:"1"})),h=i(184),y=i.n(h),w=window.wp.data,k=window.wp.components,E=window.wp.blockEditor,x=window.wp.primitives,S=(0,n.createElement)(x.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,n.createElement)(x.Path,{d:"M4 18h6V6H4v12zm9-9.5V10h7V8.5h-7zm0 7h7V14h-7v1.5z"})),T=(0,n.createElement)(x.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,n.createElement)(x.Path,{d:"M14 6v12h6V6h-6zM4 10h7V8.5H4V10zm0 5.5h7V14H4v1.5z"}));function C(){return C=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var i=arguments[t];for(var a in i)Object.prototype.hasOwnProperty.call(i,a)&&(e[a]=i[a])}return e},C.apply(this,arguments)}var N=function(e){var t=e.id,i=e.src,a=e.allowedTypes,r=e.accept,o=e.onSelect,l=e.onSelectURL,c=e.onRemove;return(0,n.createElement)(E.BlockControls,{group:"inline"},(0,n.createElement)(E.MediaReplaceFlow,{mediaId:t,mediaURL:i,allowedTypes:a,accept:r,onSelect:o,onSelectURL:l}),!!i&&!!c&&(0,n.createElement)(k.ToolbarItem,{as:k.Button,onClick:c},(0,m.__)("Release","snow-monkey-blocks")))},O=function(e){var t=e.src,i=e.alt,a=e.id,r=e.style;return(0,n.createElement)("img",{src:t,alt:i,className:"wp-image-".concat(a),style:r})},z=function(e){var t=e.src,i=e.style;return(0,n.createElement)("video",{controls:!0,src:t,style:i})},P=(0,n.memo)((function(e){var t,i,a=e.id,r=e.src,l=e.alt,m=e.url,c=e.target,s=e.allowedTypes,d=e.accept,u=e.onSelect,g=e.onSelectURL,p=e.onRemove,b=e.mediaType,_=e.style,f=e.rel,v=e.linkClass;return"image"===b?(t=(0,n.createElement)(O,{src:r,alt:l,id:a,style:_}),i=f?(0,o.isEmpty)(f)?void 0:f:"_self"!==c&&c?"noopener noreferrer":void 0,m&&(t=(0,n.createElement)("span",{href:m,target:"_self"===c?void 0:c,rel:i,className:v},t))):"video"===b&&(t=(0,n.createElement)(z,{src:r,style:_})),(0,n.createElement)(n.Fragment,null,(0,n.createElement)(N,{id:a,src:r,allowedTypes:s,accept:d,onSelect:u,onSelectURL:g,onRemove:p}),t)}),(function(e,t){for(var i=0,a=Object.keys(e);i<a.length;i++){var r=a[i];if(e[r]!==t[r])return!1}return!0}));function I(e){var t=e.src,i=e.onSelect,a=e.onSelectURL,r=e.mediaType,o=e.allowedTypes,l=void 0===o?["image"]:o,c=!r&&t?"image":r,s=(0,m.__)("Media","snow-monkey-blocks");1===l.length&&("image"===l[0]?s=(0,m.__)("Image","snow-monkey-blocks"):"video"===l[0]&&(s=(0,m.__)("Video","snow-monkey-blocks")));var d=(0,n.useMemo)((function(){return l.map((function(e){return"".concat(e,"/*")})).join(",")}),[l]);return t?(0,n.createElement)(P,C({},e,{accept:d,mediaType:c})):(0,n.createElement)(E.MediaPlaceholder,{icon:"format-image",labels:{title:s},onSelect:i,onSelectURL:a,accept:d,allowedTypes:l})}function R(e){var t=e.label,i=e.id,a=e.slug,r=e.onChange;if(!i)return null;var o=(0,w.useSelect)((function(e){var t=(0,e("core").getMedia)(i);if(!t)return{options:[]};var a=(0,e("core/block-editor").getSettings)().imageSizes,r=g(a,t);return{options:a.map((function(e){return!!r[e.slug]&&{value:e.slug,label:e.name}})).filter((function(e){return e}))}})).options;return 1>o.length?null:(0,n.createElement)(k.SelectControl,{label:t,value:a,options:o,onChange:r})}var j=["image","video"],U="media",B="attachment";function W(e,t){var i=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),i.push.apply(i,a)}return i}function A(e){for(var t=1;t<arguments.length;t++){var i=null!=arguments[t]?arguments[t]:{};t%2?W(Object(i),!0).forEach((function(t){r(e,t,i[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(i)):W(Object(i)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(i,t))}))}return e}var L=f.attributes,M=[{attributes:A(A({},L),{},{url:{type:"string",default:""},imageMediaType:{type:"string"},imageSizeSlug:{type:"string",default:"large"},imagePosition:{type:"string",default:"right"},imageID:{type:"number",default:0},imageURL:{type:"string",source:"attribute",selector:".smb-media-text__figure img, .smb-media-text__figure video",attribute:"src",default:""},imageAlt:{type:"string",source:"attribute",selector:".smb-media-text__figure img",attribute:"alt",default:""},imageWidth:{type:"string",source:"attribute",selector:".smb-media-text__figure img, .smb-media-text__figure video",attribute:"width",default:""},imageHeight:{type:"string",source:"attribute",selector:".smb-media-text__figure img, .smb-media-text__figure video",attribute:"height",default:""},imageColumnSize:{type:"string",default:66},target:{type:"string",default:"_self"}}),migrate:function(e){return A(A({},e),{},{href:e.url,mediaType:e.imageMediaType,mediaSizeSlug:e.imageSizeSlug,mediaPosition:e.imagePosition,mediaId:e.imageID,mediaUrl:e.imageURL,mediaAlt:e.imageAlt,mediaWidth:e.imageWidth,mediaHeight:e.imageHeight,mediaColumnSize:e.imageColumnSize,linkTarget:e.target})},save:function(e){var t,i=e.attributes,a=e.className,o=i.titleTagName,l=i.title,m=i.imageID,c=i.imageURL,s=i.imageAlt,u=i.imageWidth,g=i.imageHeight,p=i.imageMediaType,b=i.caption,_=i.imagePosition,f=i.verticalAlignment,v=i.imageColumnSize,h=i.mobileOrder,w=i.url,k=i.target,x=d(v),S=x.textColumnWidth,T=x.imageColumnWidth,C=y()("smb-media-text",a,r({},"smb-media-text--mobile-".concat(h),!!h)),N=y()("c-row","c-row--margin",{"c-row--reverse":"left"===_,"c-row--top":"top"===f,"c-row--middle":"center"===f,"c-row--bottom":"bottom"===f}),O=y()("c-row__col","c-row__col--1-1",["c-row__col--lg-".concat(S)]),z=y()("c-row__col","c-row__col--1-1",["c-row__col--lg-".concat(T)]),P=(0,n.createElement)("img",{src:c,alt:s,width:!!u&&u,height:!!g&&g,className:"wp-image-".concat(m)}),I=(0,n.createElement)("video",{controls:!0,src:c,width:!!u&&u,height:!!g&&g});return c&&("image"===p||void 0===p?t=w?(0,n.createElement)("a",{href:w,target:"_self"===k?void 0:k,rel:"_self"===k?void 0:"noopener noreferrer"},P):P:"video"===p&&(t=I)),(0,n.createElement)("div",E.useBlockProps.save({className:C}),(0,n.createElement)("div",{className:N},(0,n.createElement)("div",{className:O},!E.RichText.isEmpty(l)&&"none"!==o&&(0,n.createElement)(E.RichText.Content,{className:"smb-media-text__title",tagName:o,value:l}),(0,n.createElement)("div",{className:"smb-media-text__body"},(0,n.createElement)(E.InnerBlocks.Content,null))),(0,n.createElement)("div",{className:z},(0,n.createElement)("div",{className:"smb-media-text__figure"},t),!E.RichText.isEmpty(b)&&(0,n.createElement)("div",{className:"smb-media-text__caption"},(0,n.createElement)(E.RichText.Content,{value:b})))))}},{attributes:A(A({},L),{},{url:{type:"string",default:""},imageMediaType:{type:"string"},imageSizeSlug:{type:"string",default:"large"},imagePosition:{type:"string",default:"right"},imageID:{type:"number",default:0},imageURL:{type:"string",source:"attribute",selector:".smb-media-text__figure img, .smb-media-text__figure video",attribute:"src",default:""},imageAlt:{type:"string",source:"attribute",selector:".smb-media-text__figure img",attribute:"alt",default:""},imageWidth:{type:"string",source:"attribute",selector:".smb-media-text__figure img, .smb-media-text__figure video",attribute:"width",default:""},imageHeight:{type:"string",source:"attribute",selector:".smb-media-text__figure img, .smb-media-text__figure video",attribute:"height",default:""},imageColumnSize:{type:"string",default:66},target:{type:"string",default:"_self"}}),save:function(e){var t=e.attributes,i=t.title,a=t.imageID,r=t.imageURL,o=t.imagePosition,l=t.imageColumnSize,m=d(l),c=m.textColumnWidth,s=m.imageColumnWidth;return(0,n.createElement)("div",{className:"smb-media-text"},(0,n.createElement)("div",{className:y()("c-row","c-row--margin","c-row--middle",{"c-row--reverse":"left"===o})},(0,n.createElement)("div",{className:"c-row__col c-row__col--1-1 c-row__col--lg-".concat(c)},!E.RichText.isEmpty(i)&&(0,n.createElement)("h2",{className:"smb-media-text__title"},(0,n.createElement)(E.RichText.Content,{value:i})),(0,n.createElement)("div",{className:"smb-media-text__body"},(0,n.createElement)(E.InnerBlocks.Content,null))),(0,n.createElement)("div",{className:"c-row__col c-row__col--1-1 c-row__col--lg-".concat(s)},(0,n.createElement)("div",{className:"smb-media-text__figure"},r&&(0,n.createElement)("img",{src:r,alt:"",className:"wp-image-".concat(a)})))))}},{attributes:A(A({},L),{},{url:{type:"string",default:""},imageMediaType:{type:"string"},imageSizeSlug:{type:"string",default:"large"},imagePosition:{type:"string",default:"right"},imageID:{type:"number",default:0},imageURL:{type:"string",source:"attribute",selector:".smb-media-text__figure img, .smb-media-text__figure video",attribute:"src",default:""},imageAlt:{type:"string",source:"attribute",selector:".smb-media-text__figure img",attribute:"alt",default:""},imageWidth:{type:"string",source:"attribute",selector:".smb-media-text__figure img, .smb-media-text__figure video",attribute:"width",default:""},imageHeight:{type:"string",source:"attribute",selector:".smb-media-text__figure img, .smb-media-text__figure video",attribute:"height",default:""},imageColumnSize:{type:"string",default:66},target:{type:"string",default:"_self"}}),save:function(e){var t=e.attributes,i=t.title,a=t.imageURL,r=t.imagePosition,o=t.imageColumnSize,l=d(o),m=l.textColumnWidth,c=l.imageColumnWidth;return(0,n.createElement)("div",{className:"smb-media-text"},(0,n.createElement)("div",{className:y()("c-row","c-row--margin","c-row--middle",{"c-row--reverse":"left"===r})},(0,n.createElement)("div",{className:"c-row__col c-row__col--1-1 c-row__col--lg-".concat(m)},!E.RichText.isEmpty(i)&&(0,n.createElement)("h2",{className:"smb-media-text__title"},(0,n.createElement)(E.RichText.Content,{value:i})),(0,n.createElement)("div",{className:"smb-media-text__body"},(0,n.createElement)(E.InnerBlocks.Content,null))),(0,n.createElement)("div",{className:"c-row__col c-row__col--1-1 c-row__col--lg-".concat(c)},(0,n.createElement)("div",{className:"smb-media-text__figure"},a&&(0,n.createElement)("img",{src:a,alt:""})))))}}],D={attributes:{imageID:1,imageURL:"".concat(smb.pluginUrl,"/dist/img/photos/sunset-over-lake-1.jpg")},innerBlocks:[{name:"core/paragraph",attributes:{content:"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam"}}]},H=f.name,V={icon:{foreground:"#cd162c",src:v},keywords:[(0,m.__)("Image","snow-monkey-blocks"),(0,m.__)("Video","snow-monkey-blocks"),(0,m.__)("Media & sentence","snow-monkey-blocks")],edit:function(e){var t=e.attributes,i=e.setAttributes,a=e.isSelected,l=e.className,c=e.clientId,s=t.titleTagName,p=t.title,b=t.mediaId,f=t.mediaUrl,v=t.mediaAlt,h=t.mediaWidth,x=t.mediaHeight,C=t.mediaSizeSlug,N=t.caption,O=t.mediaPosition,z=t.verticalAlignment,P=t.mediaColumnSize,W=t.mobileOrder,A=t.href,L=t.linkTarget,M=t.rel,D=t.linkClass,H=t.linkDestination,V=t.mediaType,F=(0,w.useSelect)((function(e){if(!b)return{resizedImages:{}};var t=(0,e("core").getMedia)(b);if(!t)return{resizedImages:{}};var i=(0,e("core/block-editor").getSettings)().imageSizes;return{image:t,resizedImages:g(i,t)}}),[a,b]),G=F.resizedImages,q=F.image,J=(0,w.useSelect)((function(e){var t=(0,e("core/block-editor").getBlock)(c);return!(!t||!t.innerBlocks.length)}),[c]),Z=["h1","h2","h3","none"],K=d(P),Q=K.textColumnWidth,X=K.mediaColumnWidth,Y=y()("smb-media-text",l,r({},"smb-media-text--mobile-".concat(W),!!W)),$=y()("c-row","c-row--margin",{"c-row--reverse":"left"===O,"c-row--top":"top"===z,"c-row--middle":"center"===z,"c-row--bottom":"bottom"===z}),ee=y()("c-row__col","c-row__col--1-1",["c-row__col--lg-".concat(Q)]),te=y()("c-row__col","c-row__col--1-1",["c-row__col--lg-".concat(X)]),ie=(0,E.useBlockProps)({className:Y}),ae=(0,E.__experimentalUseInnerBlocksProps)({className:"smb-media-text__body"},{renderAppender:J?void 0:E.InnerBlocks.ButtonBlockAppender});return(0,n.createElement)(n.Fragment,null,(0,n.createElement)(E.InspectorControls,null,(0,n.createElement)(k.PanelBody,{title:(0,m.__)("Block Settings","snow-monkey-blocks")},(0,n.createElement)(k.SelectControl,{label:(0,m.__)("Image Column Size","snow-monkey-blocks"),value:P,options:[{value:66,label:(0,m.__)("66%","snow-monkey-blocks")},{value:50,label:(0,m.__)("50%","snow-monkey-blocks")},{value:33,label:(0,m.__)("33%","snow-monkey-blocks")},{value:25,label:(0,m.__)("25%","snow-monkey-blocks")}],onChange:function(e){return i({mediaColumnSize:e})}}),(0,n.createElement)(R,{label:(0,m.__)("Images size","snow-monkey-blocks"),id:b,slug:C,onChange:function(e){var t=f;G[e]&&G[e].url&&(t=G[e].url);var a=h;G[e]&&G[e].width&&(a=G[e].width);var r=x;G[e]&&G[e].height&&(r=G[e].height),i({mediaUrl:t,mediaWidth:a,mediaHeight:r,mediaSizeSlug:e})}}),(0,n.createElement)(k.SelectControl,{label:(0,m.__)("Sort by mobile","snow-monkey-blocks"),value:W,options:[{value:"",label:(0,m.__)("Default","snow-monkey-blocks")},{value:"text",label:(0,m.__)("Text > Image","snow-monkey-blocks")},{value:"image",label:(0,m.__)("Image > Text","snow-monkey-blocks")}],onChange:function(e){return i({mobileOrder:""===e?void 0:e})}}),(0,n.createElement)(k.BaseControl,{label:(0,m.__)("Title Tag","snow-monkey-blocks"),id:"snow-monkey-blocks/media-text/title-tag-name"},(0,n.createElement)("div",{className:"smb-list-icon-selector"},(0,o.times)(Z.length,(function(e){var t=s===Z[e];return(0,n.createElement)(k.Button,{isPrimary:t,isSecondary:!t,onClick:function(){return i({titleTagName:Z[e]})},key:e},Z[e])})))))),(0,n.createElement)(E.BlockControls,{gruop:"block"},(0,n.createElement)(k.ToolbarGroup,null,(0,n.createElement)(E.BlockVerticalAlignmentToolbar,{onChange:function(e){return i({verticalAlignment:e})},value:z}),(0,n.createElement)(k.ToolbarButton,{icon:S,title:(0,m.__)("Show media on left","snow-monkey-blocks"),isActive:"left"===O,onClick:function(){return i({mediaPosition:"left"})}}),(0,n.createElement)(k.ToolbarButton,{icon:T,title:(0,m.__)("Show media on right","snow-monkey-blocks"),isActive:"right"===O,onClick:function(){return i({mediaPosition:"right"})}}),f&&("image"===V||void 0===V)&&(0,n.createElement)(E.__experimentalImageURLInputUI,{url:A||"",onChangeUrl:function(e){i(e)},linkDestination:H,mediaType:V,mediaUrl:f,mediaLink:q&&q.link,linkTarget:L,linkClass:D,rel:M}))),(0,n.createElement)("div",ie,(0,n.createElement)("div",{className:$},(0,n.createElement)("div",{className:ee},(!E.RichText.isEmpty(p)||a)&&"none"!==s&&(0,n.createElement)(E.RichText,{className:"smb-media-text__title",tagName:s,value:p,onChange:function(e){return i({title:e})},placeholder:(0,m.__)("Write title…","snow-monkey-blocks")}),(0,n.createElement)("div",ae)),(0,n.createElement)("div",{className:te},(0,n.createElement)("div",{className:"smb-media-text__figure"},(0,n.createElement)(I,{src:f,id:b,alt:v,url:A,target:L,onSelect:function(e){var t=e.sizes&&e.sizes[C]?e.sizes[C].url:e.url,a=e.sizes&&e.sizes[C]?e.sizes[C].width:e.width,r=e.sizes&&e.sizes[C]?e.sizes[C].height:e.height,n=A;H===U&&(n=e.url),H===B&&(n=e.link),i({mediaType:u(e),mediaLink:e.link||void 0,mediaId:e.id,mediaUrl:t,mediaAlt:e.alt,mediaWidth:a,mediaHeight:r,href:n})},onSelectURL:function(e){if(e!==f){var t=A;H===U&&(t=e),H===B&&(t=""),i({mediaUrl:e,mediaId:0,mediaSizeSlug:"large",mediaType:u({media_type:_(e)?"video":"image"}),href:t})}},onRemove:function(){i({mediaUrl:"",mediaAlt:"",mediaWidth:"",mediaHeight:"",mediaId:0,mediaType:void 0,href:"",linkDestination:""})},mediaType:V,allowedTypes:j,linkClass:D,rel:M})),(!E.RichText.isEmpty(N)||a)&&(0,n.createElement)(E.RichText,{className:"smb-media-text__caption",placeholder:(0,m.__)("Write caption…","snow-monkey-blocks"),value:N,onChange:function(e){return i({caption:e})}})))))},save:function(e){var t,i=e.attributes,a=e.className,l=i.titleTagName,m=i.title,c=i.mediaId,s=i.mediaUrl,u=i.mediaAlt,g=i.mediaWidth,p=i.mediaHeight,b=i.mediaType,_=i.caption,f=i.mediaPosition,v=i.verticalAlignment,h=i.mediaColumnSize,w=i.mobileOrder,k=i.href,x=i.rel,S=i.linkClass,T=i.linkTarget,C=(0,o.isEmpty)(x)?void 0:x,N=d(h),O=N.textColumnWidth,z=N.mediaColumnWidth,P=y()("smb-media-text",a,r({},"smb-media-text--mobile-".concat(w),!!w)),I=y()("c-row","c-row--margin",{"c-row--reverse":"left"===f,"c-row--top":"top"===v,"c-row--middle":"center"===v,"c-row--bottom":"bottom"===v}),R=y()("c-row__col","c-row__col--1-1",["c-row__col--lg-".concat(O)]),j=y()("c-row__col","c-row__col--1-1",["c-row__col--lg-".concat(z)]),U=(0,n.createElement)("img",{src:s,alt:u,width:!!g&&g,height:!!p&&p,className:"wp-image-".concat(c)}),B=(0,n.createElement)("video",{controls:!0,src:s,width:!!g&&g,height:!!p&&p});return s&&("image"===b||void 0===b?t=k?(0,n.createElement)("a",{href:k,target:T,className:S,rel:C},U):U:"video"===b&&(t=B)),(0,n.createElement)("div",E.useBlockProps.save({className:P}),(0,n.createElement)("div",{className:I},(0,n.createElement)("div",{className:R},!E.RichText.isEmpty(m)&&"none"!==l&&(0,n.createElement)(E.RichText.Content,{className:"smb-media-text__title",tagName:l,value:m}),(0,n.createElement)("div",{className:"smb-media-text__body"},(0,n.createElement)(E.InnerBlocks.Content,null))),(0,n.createElement)("div",{className:j},(0,n.createElement)("div",{className:"smb-media-text__figure"},t),!E.RichText.isEmpty(_)&&(0,n.createElement)("div",{className:"smb-media-text__caption"},(0,n.createElement)(E.RichText.Content,{value:_})))))},deprecated:M,example:D};!function(e){if(e){var t=e.metadata,i=e.settings,a=e.name;t&&(t.title&&(t.title=(0,m.__)(t.title,"snow-monkey-blocks"),i.title=t.title),t.description&&(t.description=(0,m.__)(t.description,"snow-monkey-blocks"),i.description=t.description),t.keywords&&(t.keywords=(0,m.__)(t.keywords,"snow-monkey-blocks"),i.keywords=t.keywords)),(0,l.registerBlockType)(s({name:a},t),i)}}(a)},184:function(e,t){var i;!function(){"use strict";var a={}.hasOwnProperty;function r(){for(var e=[],t=0;t<arguments.length;t++){var i=arguments[t];if(i){var n=typeof i;if("string"===n||"number"===n)e.push(i);else if(Array.isArray(i)){if(i.length){var o=r.apply(null,i);o&&e.push(o)}}else if("object"===n)if(i.toString===Object.prototype.toString)for(var l in i)a.call(i,l)&&i[l]&&e.push(l);else e.push(i.toString())}}return e.join(" ")}e.exports?(r.default=r,e.exports=r):void 0===(i=function(){return r}.apply(t,[]))||(e.exports=i)}()}},t={};function i(a){var r=t[a];if(void 0!==r)return r.exports;var n=t[a]={exports:{}};return e[a](n,n.exports,i),n.exports}i.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return i.d(t,{a:t}),t},i.d=function(e,t){for(var a in t)i.o(t,a)&&!i.o(e,a)&&Object.defineProperty(e,a,{enumerable:!0,get:t[a]})},i.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},i.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},i(666)}();