!function(){var t={307:function(t,e,n){"use strict";var r={};function o(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}n.r(r),n.d(r,{metadata:function(){return l},name:function(){return O},settings:function(){return j}});var i=window.wp.element,c=(window.lodash,window.wp.blocks),a=(window.wp.richText,window.wp.i18n);function s(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}var l=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/buttons","title":"Buttons","description":"Prompt visitors to take action with a group of button-style links.","category":"smb","attributes":{"contentJustification":{"type":"string"}},"supports":{"anchor":true,"align":["left","right"],"alignWide":false},"example":{"innerBlocks":[{"name":"snow-monkey-blocks/btn","attributes":{"content":"button","url":"https://2inc.org"}},{"name":"snow-monkey-blocks/btn","attributes":{"content":"button","url":"https://2inc.org"}}]}}'),u=(0,i.createElement)("svg",{viewBox:"0 0 24 24"},(0,i.createElement)("path",{d:"M18,3H6A1,1,0,0,0,5,4v6a1,1,0,0,0,1,1H18a1,1,0,0,0,1-1V4A1,1,0,0,0,18,3Zm0,5.8A1.15,1.15,0,0,1,16.91,10H6.55A.57.57,0,0,1,6,9.4V4.6A.57.57,0,0,1,6.55,4h10.9a.57.57,0,0,1,.55.6Z"}),(0,i.createElement)("rect",{x:"9.5",y:"6.5",width:"5",height:"1"}),(0,i.createElement)("path",{d:"M18,3H6A1,1,0,0,0,5,4v6a1,1,0,0,0,1,1H18a1,1,0,0,0,1-1V4A1,1,0,0,0,18,3Zm0,5.8A1.15,1.15,0,0,1,16.91,10H6.55A.57.57,0,0,1,6,9.4V4.6A.57.57,0,0,1,6.55,4h10.9a.57.57,0,0,1,.55.6Z"}),(0,i.createElement)("rect",{x:"9.5",y:"6.5",width:"5",height:"1"}),(0,i.createElement)("path",{d:"M18,13H6a1,1,0,0,0-1,1v6a1,1,0,0,0,1,1H18a1,1,0,0,0,1-1V14A1,1,0,0,0,18,13Zm0,5.8A1.15,1.15,0,0,1,16.91,20H6.55A.57.57,0,0,1,6,19.4V14.6a.57.57,0,0,1,.55-.6h10.9a.57.57,0,0,1,.55.6Z"}),(0,i.createElement)("rect",{x:"9.5",y:"16.5",width:"5",height:"1"})),p=n(184),f=n.n(p),b=window.wp.blockEditor,m=["snow-monkey-blocks/btn"],y=[["snow-monkey-blocks/btn"]],d={type:"default",alignments:[]},g=["left","center","right","space-between"];function w(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function k(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?w(Object(n),!0).forEach((function(e){o(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):w(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}var v=[{attributes:k(k({},l.attributes),{},{textAlign:{type:"string"}}),supports:{align:["left","right"]},save:function(t){var e=t.attributes,n=t.className,r=e.textAlign,c=f()("smb-buttons",n,o({},"has-text-align-".concat(r),r));return(0,i.createElement)("div",b.useBlockProps.save({className:c}),(0,i.createElement)(b.InnerBlocks.Content,null))},migrate:function(t){return k(k({},t),{},{contentJustification:t.textAlign})}}],h={from:[{type:"block",isMultiBlock:!0,blocks:["snow-monkey-blocks/btn"],transform:function(t){return(0,c.createBlock)(l.name,{},t.map((function(t){return(0,c.createBlock)("snow-monkey-blocks/btn",t)})))}}]},O=l.name,j={icon:{foreground:"#cd162c",src:u},edit:function(t){var e=t.attributes,n=t.setAttributes,r=t.className,c=e.contentJustification,a=f()("smb-buttons",r,o({},"is-content-justification-".concat(c),c)),s=(0,b.useBlockProps)({className:a}),l=(0,b.__experimentalUseInnerBlocksProps)(s,{allowedBlocks:m,template:y,orientation:"horizontal",__experimentalLayout:d}),u=g;return(0,i.createElement)(i.Fragment,null,(0,i.createElement)(b.BlockControls,{group:"block"},(0,i.createElement)(b.JustifyContentControl,{allowedControls:u,value:c,onChange:function(t){return n({contentJustification:t})}})),(0,i.createElement)("div",l))},save:function(t){var e=t.attributes,n=t.className,r=e.contentJustification,c=f()("smb-buttons",n,o({},"is-content-justification-".concat(r),r));return(0,i.createElement)("div",b.useBlockProps.save({className:c}),(0,i.createElement)(b.InnerBlocks.Content,null))},deprecated:v,transforms:h};!function(t){if(t){var e=t.metadata,n=t.settings,r=t.name;e&&(e.title&&(e.title=(0,a.__)(e.title,"snow-monkey-blocks"),n.title=e.title),e.description&&(e.description=(0,a.__)(e.description,"snow-monkey-blocks"),n.description=e.description),e.keywords&&(e.keywords=(0,a.__)(e.keywords,"snow-monkey-blocks"),n.keywords=e.keywords)),(0,c.registerBlockType)(function(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?s(Object(n),!0).forEach((function(e){o(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):s(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}({name:r},e),n)}}(r)},184:function(t,e){var n;!function(){"use strict";var r={}.hasOwnProperty;function o(){for(var t=[],e=0;e<arguments.length;e++){var n=arguments[e];if(n){var i=typeof n;if("string"===i||"number"===i)t.push(n);else if(Array.isArray(n)){if(n.length){var c=o.apply(null,n);c&&t.push(c)}}else if("object"===i)if(n.toString===Object.prototype.toString)for(var a in n)r.call(n,a)&&n[a]&&t.push(a);else t.push(n.toString())}}return t.join(" ")}t.exports?(o.default=o,t.exports=o):void 0===(n=function(){return o}.apply(e,[]))||(t.exports=n)}()}},e={};function n(r){var o=e[r];if(void 0!==o)return o.exports;var i=e[r]={exports:{}};return t[r](i,i.exports,n),i.exports}n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,{a:e}),e},n.d=function(t,e){for(var r in e)n.o(e,r)&&!n.o(t,r)&&Object.defineProperty(t,r,{enumerable:!0,get:e[r]})},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n(307)}();