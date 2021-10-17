!function(){var t={912:function(t,e,a){"use strict";var n={};function o(t,e,a){return e in t?Object.defineProperty(t,e,{value:a,enumerable:!0,configurable:!0,writable:!0}):t[e]=a,t}a.r(n),a.d(n,{metadata:function(){return b},name:function(){return I},settings:function(){return x}});var r=window.wp.element,l=(window.lodash,window.wp.blocks),s=(window.wp.richText,window.wp.i18n);function i(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,n)}return a}var c=(0,r.createElement)("svg",{viewBox:"0 0 24 24"},(0,r.createElement)("circle",{cx:"6.5",cy:"8",r:"1"}),(0,r.createElement)("path",{d:"M20,8H13.75a.25.25,0,0,1-.25-.25V5.5a1,1,0,0,0-1-1H4a1,1,0,0,0-1,1v13a1,1,0,0,0,1,1H20a1,1,0,0,0,1-1V9A1,1,0,0,0,20,8Zm0,10a.54.54,0,0,1-.53.54H4.53A.54.54,0,0,1,4,18V6a.54.54,0,0,1,.53-.54H12A.54.54,0,0,1,12.5,6V8.25a.54.54,0,0,0,.53.54h6.44a.54.54,0,0,1,.53.54Z"})),b=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/tabs","title":"Tabs","description":"This is tabs block.","category":"smb","attributes":{"tabs":{"type":"string","default":"[]"},"matchHeight":{"type":"string","source":"attribute","selector":".smb-tabs","attribute":"data-match-height","default":"false"},"tabsJustification":{"type":"string","source":"attribute","selector":".smb-tabs","attribute":"data-tabs-justification","default":"flex-start"},"tabsId":{"type":"string","source":"attribute","selector":".smb-tabs","attribute":"data-tabs-id","default":""},"orientation":{"type":"string","source":"attribute","selector":".smb-tabs","attribute":"data-orientation","default":"horizontal"}},"supports":{"html":false},"example":{"attributes":{"tabs":"[{\\"title\\":\\"Tab\\",\\"tabPanelId\\":\\"1\\"},{\\"title\\": \\"Tab\\",\\"tabPanelId\\":\\"2\\"}]"},"innerBlocks":[{"name":"snow-monkey-blocks/tab-panel","attributes":{"tabPanelId":"1","ariaHidden":"false"},"innerBlocks":[{"name":"core/paragraph","attributes":{"content":"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam"}}]},{"name":"snow-monkey-blocks/tab-panel","attributes":{"tabPanelId":"2","ariaHidden":"true"},"innerBlocks":[{"name":"core/paragraph","attributes":{"content":"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam"}}]}]}}');function u(){return u=Object.assign||function(t){for(var e=1;e<arguments.length;e++){var a=arguments[e];for(var n in a)Object.prototype.hasOwnProperty.call(a,n)&&(t[n]=a[n])}return t},u.apply(this,arguments)}function m(t,e){(null==e||e>t.length)&&(e=t.length);for(var a=0,n=new Array(e);a<e;a++)n[a]=t[a];return n}var d=a(184),p=a.n(d),f=window.wp.blockEditor,h=function({icon:t,size:e=24,...a}){return(0,r.cloneElement)(t,{width:e,height:e,...a})},w=window.wp.primitives,y=(0,r.createElement)(w.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,r.createElement)(w.Path,{d:"M14.6 7l-1.2-1L8 12l5.4 6 1.2-1-4.6-5z"})),v=(0,r.createElement)(w.SVG,{viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},(0,r.createElement)(w.Path,{d:"M6.5 12.4L12 8l5.5 4.4-.9 1.2L12 10l-4.5 3.6-1-1.2z"})),k=(0,r.createElement)(w.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,r.createElement)(w.Path,{d:"M12 13.06l3.712 3.713 1.061-1.06L13.061 12l3.712-3.712-1.06-1.06L12 10.938 8.288 7.227l-1.061 1.06L10.939 12l-3.712 3.712 1.06 1.061L12 13.061z"})),g=(0,r.createElement)(w.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,r.createElement)(w.Path,{d:"M10.6 6L9.4 7l4.6 5-4.6 5 1.2 1 5.4-6z"})),_=(0,r.createElement)(w.SVG,{viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},(0,r.createElement)(w.Path,{d:"M17.5 11.6L12 16l-5.5-4.4.9-1.2L12 14l4.5-3.6 1 1.2z"})),E=(0,r.createElement)(w.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,r.createElement)(w.Path,{d:"M18 11.2h-5.2V6h-1.6v5.2H6v1.6h5.2V18h1.6v-5.2H18z"})),P=window.wp.components,O=window.wp.data,S=["snow-monkey-blocks/tab-panel"],I=b.name,x={icon:{foreground:"#cd162c",src:c},edit:function(t){var e,a,n=t.attributes,o=t.setAttributes,i=t.className,c=t.clientId,b=n.tabs,d=n.matchHeight,w=n.tabsJustification,I=n.tabsId,x=n.orientation,B=JSON.parse(b),j=(0,O.useDispatch)("core/block-editor"),N=j.removeBlocks,z=j.insertBlocks,C=j.moveBlocksUp,A=j.moveBlocksDown,H=j.updateBlockAttributes,L=(0,O.useSelect)((function(t){return{getBlockOrder:t("core/block-editor").getBlockOrder,getBlock:t("core/block-editor").getBlock}}),[]),M=L.getBlockOrder,T=L.getBlock,V=(e=(0,r.useState)(void 0),a=2,function(t){if(Array.isArray(t))return t}(e)||function(t,e){var a=null==t?null:"undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(null!=a){var n,o,r=[],_n=!0,l=!1;try{for(a=a.call(t);!(_n=(n=a.next()).done)&&(r.push(n.value),!e||r.length!==e);_n=!0);}catch(t){l=!0,o=t}finally{try{_n||null==a.return||a.return()}finally{if(l)throw o}}return r}}(e,a)||function(t,e){if(t){if("string"==typeof t)return m(t,e);var a=Object.prototype.toString.call(t).slice(8,-1);return"Object"===a&&t.constructor&&(a=t.constructor.name),"Map"===a||"Set"===a?Array.from(t):"Arguments"===a||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(a)?m(t,e):void 0}}(e,a)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()),J=V[0],D=V[1];(0,r.useEffect)((function(){0<B.length&&D(B[0].tabPanelId),I||o({tabsId:c})}),[]),(0,r.useEffect)((function(){1>B.length||M(c).forEach((function(t){var e=T(t);H(t,{ariaHidden:e.attributes.tabPanelId===B[0].tabPanelId?"false":"true"})}))}),[B.length]),(0,r.useEffect)((function(){2>document.querySelectorAll('[data-tabs-id="'.concat(I,'"]')).length||(M(c).forEach((function(t,e){var a="block-".concat(t);B[e].tabPanelId=a,H(t,{tabPanelId:a})})),o({tabsId:c,tabs:JSON.stringify(B)}),D(B[0].tabPanelId))}),[c]);var G="vertical"===x||"horizontal"===x&&"true"===d,U=p()("smb-tabs",i),R=(0,f.useBlockProps)({className:U}),q=(0,f.__experimentalUseInnerBlocksProps)({className:"smb-tabs__body"},{allowedBlocks:S,templateLock:!1,renderAppender:!1});return(0,r.createElement)(r.Fragment,null,(0,r.createElement)(f.InspectorControls,null,(0,r.createElement)(P.PanelBody,{title:(0,s.__)("Block Settings","snow-monkey-blocks")},(0,r.createElement)(P.SelectControl,{label:(0,s.__)("Tabs orientation","snow-monkey-blocks"),value:x,onChange:function(t){return o({orientation:t})},options:[{value:"horizontal",label:(0,s.__)("Horizontal","snow-monkey-blocks")},{value:"vertical",label:(0,s.__)("Vertical","snow-monkey-blocks")}]}),"horizontal"===x&&(0,r.createElement)(r.Fragment,null,(0,r.createElement)(P.ToggleControl,{label:(0,s.__)("Align the height of each tab panels","snow-monkey-blocks"),checked:"true"===d,onChange:function(t){return o({matchHeight:t?"true":"false"})}}),(0,r.createElement)(P.SelectControl,{label:(0,s.__)("Tabs justification","snow-monkey-blocks"),value:w,onChange:function(t){return o({tabsJustification:t})},options:[{label:(0,s.__)("Left","snow-monkey-blocks"),value:"flex-start"},{label:(0,s.__)("Center","snow-monkey-blocks"),value:"center"},{label:(0,s.__)("Right","snow-monkey-blocks"),value:"flex-end"},{label:(0,s.__)("Stretch","snow-monkey-blocks"),value:"stretch"}]})))),(0,r.createElement)("div",u({},R,{"data-tabs-id":I,"data-orientation":x,"data-match-height":G?"true":d,"data-tabs-justification":"horizontal"===x?w:void 0}),(0,r.createElement)("div",{className:"smb-tabs__tabs","data-has-tabs":1<B.length?"true":"false"},B.map((function(t,e){return(0,r.createElement)("div",{className:"smb-tabs__tab-wrapper",key:"".concat(c,"-").concat(e),"aria-selected":J===t.tabPanelId?"true":"false"},0<e&&(0,r.createElement)("button",{className:"smb-tabs__up-tab",onClick:function(){C(M(c)[e],c);var t=B[e];B.splice(e,1),B.splice(e-1,0,t),o({tabs:JSON.stringify(B)}),D(B[e-1].tabPanelId)},"aria-label":"horizontal"===x?(0,s.__)("Move to left","snow-monkey-blocks"):(0,s.__)("Move to up","snow-monkey-blocks")},(0,r.createElement)(h,{icon:"horizontal"===x?y:v})),1<B.length&&(0,r.createElement)("button",{className:"smb-tabs__remove-tab",onClick:function(){N(M(c)[e],!1),B.splice(e,1),o({tabs:JSON.stringify(B)}),D(B[0].tabPanelId)},"aria-label":(0,s.__)("Remove this tab","snow-monkey-blocks")},(0,r.createElement)(h,{icon:k})),B.length-1>e&&(0,r.createElement)("button",{className:"smb-tabs__down-tab",onClick:function(){A(M(c)[e],c);var t=B[e];B.splice(e,1),B.splice(e+1,0,t),o({tabs:JSON.stringify(B)}),D(B[e+1].tabPanelId)},"aria-label":"horizontal"===x?(0,s.__)("Move to right","snow-monkey-blocks"):(0,s.__)("Move to down","snow-monkey-blocks")},(0,r.createElement)(h,{icon:"horizontal"===x?g:_})),(0,r.createElement)("button",{className:"smb-tabs__tab",role:"tab","aria-controls":t.tabPanelId,"aria-selected":J===t.tabPanelId?"true":"false",onClick:function(){D(t.tabPanelId)}},(0,r.createElement)(f.RichText,{value:t.title,onChange:function(t){B[e].title=t,o({tabs:JSON.stringify(B)})},placeholder:(0,s.__)("Tab","snow-monkey-blocks")})))})),(0,r.createElement)("div",{className:"smb-tabs__tab-wrapper"},(0,r.createElement)("button",{className:"smb-tabs__tab smb-tabs__add-tab",onClick:function(){var t=(0,l.createBlock)("snow-monkey-blocks/tab-panel"),e="block-".concat(t.clientId);t.attributes.tabPanelId=e,z(t,B.length,c,!1),B.push({tabPanelId:e}),o({tabs:JSON.stringify(B)}),D(e)}},(0,r.createElement)(h,{icon:E})))),(0,r.createElement)("div",q),!!J&&!G&&(0,r.createElement)("style",null,'[data-tabs-id="'.concat(I,'"] > .smb-tabs__body > .smb-tab-panel:not(#').concat(J,") {display: none !important}")),!!J&&G&&(0,r.createElement)("style",null,B.map((function(t,e){return'[data-tabs-id="'.concat(I,'"] > .smb-tabs__body > .smb-tab-panel:nth-child(').concat(e+1,") {left: ").concat(-100*e,"%}")})),'[data-tabs-id="'.concat(I,'"] > .smb-tabs__body > .smb-tab-panel:not(#').concat(J,") {visibility: hidden !important}"))))},save:function(t){var e=t.attributes,a=t.className,n=e.tabs,o=e.matchHeight,l=e.tabsJustification,s=e.tabsId,i=e.orientation,c=JSON.parse(n),b="vertical"===i||"horizontal"===i&&"true"===o,m=p()("smb-tabs",a);return(0,r.createElement)("div",u({},f.useBlockProps.save({className:m}),{"data-tabs-id":s,"data-orientation":i,"data-match-height":b?"true":o,"data-tabs-justification":"horizontal"===i?l:void 0}),0<c.length&&(0,r.createElement)("div",{className:"smb-tabs__tabs"},c.map((function(t,e){return(0,r.createElement)("div",{className:"smb-tabs__tab-wrapper",key:e},(0,r.createElement)("button",{className:"smb-tabs__tab",role:"tab","aria-controls":t.tabPanelId,"aria-selected":0===e?"true":"false"},(0,r.createElement)(f.RichText.Content,{value:t.title})))}))),(0,r.createElement)("div",{className:"smb-tabs__body"},(0,r.createElement)(f.InnerBlocks.Content,null)),b&&(0,r.createElement)("style",null,c.map((function(t,e){return'[data-tabs-id="'.concat(s,'"] > .smb-tabs__body > .smb-tab-panel:nth-child(').concat(e+1,") {left: ").concat(-100*e,"%}")}))))},styles:[{name:"default",label:(0,s.__)("Default","snow-monkey-blocks"),isDefault:!0},{name:"simple",label:(0,s.__)("Simple","snow-monkey-blocks")},{name:"line",label:(0,s.__)("Line","snow-monkey-blocks")}]};!function(t){if(t){var e=t.metadata,a=t.settings,n=t.name;e&&(e.title&&(e.title=(0,s.__)(e.title,"snow-monkey-blocks"),a.title=e.title),e.description&&(e.description=(0,s.__)(e.description,"snow-monkey-blocks"),a.description=e.description),e.keywords&&(e.keywords=(0,s.__)(e.keywords,"snow-monkey-blocks"),a.keywords=e.keywords)),(0,l.registerBlockType)(function(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?i(Object(a),!0).forEach((function(e){o(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):i(Object(a)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}({name:n},e),a)}}(n)},184:function(t,e){var a;!function(){"use strict";var n={}.hasOwnProperty;function o(){for(var t=[],e=0;e<arguments.length;e++){var a=arguments[e];if(a){var r=typeof a;if("string"===r||"number"===r)t.push(a);else if(Array.isArray(a)){if(a.length){var l=o.apply(null,a);l&&t.push(l)}}else if("object"===r)if(a.toString===Object.prototype.toString)for(var s in a)n.call(a,s)&&a[s]&&t.push(s);else t.push(a.toString())}}return t.join(" ")}t.exports?(o.default=o,t.exports=o):void 0===(a=function(){return o}.apply(e,[]))||(t.exports=a)}()}},e={};function a(n){var o=e[n];if(void 0!==o)return o.exports;var r=e[n]={exports:{}};return t[n](r,r.exports,a),r.exports}a.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return a.d(e,{a:e}),e},a.d=function(t,e){for(var n in e)a.o(e,n)&&!a.o(t,n)&&Object.defineProperty(t,n,{enumerable:!0,get:e[n]})},a.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},a.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},a(912)}();