!function(){var e={138:function(e,t,n){"use strict";var r={};function o(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}n.r(r),n.d(r,{metadata:function(){return s},name:function(){return f},settings:function(){return v}});var c=window.wp.element,a=(window.lodash,window.wp.blocks),i=(window.wp.richText,window.wp.i18n);function l(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}var s=JSON.parse('{"apiVersion":2,"name":"snow-monkey-blocks/accordion--item","title":"Item","category":"smb","parent":["snow-monkey-blocks/accordion"],"attributes":{"title":{"type":"string","source":"html","selector":".smb-accordion__item__title__label","default":""},"initialState":{"type":"boolean","default":false}},"supports":{"html":false}}'),m=(0,c.createElement)("svg",{viewBox:"0 0 24 24"},(0,c.createElement)("path",{d:"M2,16.5v4H22v-4Zm19,3H3v-2H21Z"}),(0,c.createElement)("path",{d:"M2,3.5v4H22v-4Zm19,3H3v-2H21Z"}),(0,c.createElement)("polygon",{points:"21 7.5 21 13.5 3 13.5 3 7.5 2 7.5 2 14.5 22 14.5 22 7.5 21 7.5"})),_=n(184),u=n.n(_),d=window.wp.components,p=window.wp.blockEditor,b=[{attributes:{title:{type:"string",source:"html",selector:".smb-accordion__item__title",default:""}},save:function(e){var t=e.attributes,n=e.className,r=u()("smb-accordion__item",n),o=t.title;return(0,c.createElement)("div",{className:r},(0,c.createElement)("div",{className:"smb-accordion__item__title"},(0,c.createElement)(p.RichText.Content,{value:o})),(0,c.createElement)("input",{type:"checkbox",className:"smb-accordion__item__control"}),(0,c.createElement)("div",{className:"smb-accordion__item__body"},(0,c.createElement)(p.InnerBlocks.Content,null)))}},{attributes:{title:{type:"string",source:"html",selector:".smb-accordion__item__title",default:""}},save:function(e){var t=e.attributes.title;return(0,c.createElement)("div",{className:"smb-accordion__item"},(0,c.createElement)("div",{className:"smb-accordion__item__title"},(0,c.createElement)(p.RichText.Content,{value:t})),(0,c.createElement)("input",{type:"checkbox",className:"smb-accordion__item__control"}),(0,c.createElement)("div",{className:"smb-accordion__item__body"},(0,c.createElement)(p.InnerBlocks.Content,null)))}}],f=s.name,v={icon:{foreground:"#cd162c",src:m},edit:function(e){var t=e.attributes,n=e.setAttributes,r=e.className,o=t.title,a=t.initialState,l=u()("smb-accordion__item",r),s=(0,p.useBlockProps)({className:l}),m=(0,p.__experimentalUseInnerBlocksProps)({className:"smb-accordion__item__body"});return(0,c.createElement)(c.Fragment,null,(0,c.createElement)(p.InspectorControls,null,(0,c.createElement)(d.PanelBody,{title:(0,i.__)("Block Settings","snow-monkey-blocks")},(0,c.createElement)(d.CheckboxControl,{label:(0,i.__)("Display in open state","snow-monkey-blocks"),checked:a,onChange:function(e){return n({initialState:e})}}))),(0,c.createElement)("div",s,(0,c.createElement)("div",{className:"smb-accordion__item__title"},(0,c.createElement)(p.RichText,{className:"smb-accordion__item__title__label",value:o,onChange:function(e){return n({title:e})},placeholder:(0,i.__)("Enter title here","snow-monkey-blocks")}),(0,c.createElement)("div",{className:"smb-accordion__item__title__icon"},(0,c.createElement)("i",{className:"fas fa-angle-down"}))),(0,c.createElement)("div",m)))},save:function(e){var t=e.attributes,n=e.className,r=t.title,o=t.initialState,a=u()("smb-accordion__item",n);return(0,c.createElement)("div",p.useBlockProps.save({className:a}),(0,c.createElement)("input",{type:"checkbox",className:"smb-accordion__item__control",checked:o}),(0,c.createElement)("div",{className:"smb-accordion__item__title"},(0,c.createElement)("span",{className:"smb-accordion__item__title__label"},(0,c.createElement)(p.RichText.Content,{value:r})),(0,c.createElement)("div",{className:"smb-accordion__item__title__icon"},(0,c.createElement)("i",{className:"fas fa-angle-down"}))),(0,c.createElement)("div",{className:"smb-accordion__item__body"},(0,c.createElement)(p.InnerBlocks.Content,null)))},deprecated:b};!function(e){if(e){var t=e.metadata,n=e.settings,r=e.name;t&&(t.title&&(t.title=(0,i.__)(t.title,"snow-monkey-blocks"),n.title=t.title),t.description&&(t.description=(0,i.__)(t.description,"snow-monkey-blocks"),n.description=t.description),t.keywords&&(t.keywords=(0,i.__)(t.keywords,"snow-monkey-blocks"),n.keywords=t.keywords)),(0,a.registerBlockType)(function(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?l(Object(n),!0).forEach((function(t){o(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):l(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}({name:r},t),n)}}(r)},184:function(e,t){var n;!function(){"use strict";var r={}.hasOwnProperty;function o(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var c=typeof n;if("string"===c||"number"===c)e.push(n);else if(Array.isArray(n)){if(n.length){var a=o.apply(null,n);a&&e.push(a)}}else if("object"===c)if(n.toString===Object.prototype.toString)for(var i in n)r.call(n,i)&&n[i]&&e.push(i);else e.push(n.toString())}}return e.join(" ")}e.exports?(o.default=o,e.exports=o):void 0===(n=function(){return o}.apply(t,[]))||(e.exports=n)}()}},t={};function n(r){var o=t[r];if(void 0!==o)return o.exports;var c=t[r]={exports:{}};return e[r](c,c.exports,n),c.exports}n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,{a:t}),t},n.d=function(e,t){for(var r in t)n.o(t,r)&&!n.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:t[r]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n(138)}();