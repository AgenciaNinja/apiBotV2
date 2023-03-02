!function(t){"function"==typeof define&&define.amd?define(["jquery"],t):t("object"==typeof exports?require("jquery"):window.jQuery)}(function(t){var e,i,r=function(e,i,n){this.options=t.extend({},r.DEFAULTS,i),this.normalizeNodes(e),this.$el=t(e),s(this.options,this.$el),this.marks=[],this.isRegex=!1,this.baseQuery=!1,n instanceof RegExp?(this.query=n,this.isRegex=!0):this.options.useSmartBehavior?(this.baseQuery=n.toString(),this.query=this.smartBehavior(n),this.isRegex=!0):(n=n.toString(),this.query=this.options.ignoreCase?n.toLowerCase():n),this.mark(e)},n=function(e,i){for(var r in i)i.hasOwnProperty(r)&&(e[r]=t.isPlainObject(i[r])&&t.isPlainObject(e[r])?n(e[r]||{},i[r]):i[r]);return e},s=function(e,i){/[a-zA-Z0-9]+/.test(e.markTag)||t.error("Invalid marking tag!"),t.isArray(e.skippedTags)||t.error("Option skippedTags expected to be an array"),t.isFunction(e.afterMark)&&t.isFunction(e.beforeMark)||t.error("Options afterMark and beforeMark must be functions"),-1!==t.inArray(i.prop("tagName").toLowerCase(),e.skippedTags)&&t.error("Given element is to be skipped!")},o=function(t){return t.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g,"\\$&")},a=t.fn.mark;r.DEFAULTS={skippedTags:["script","style"],ignoreCase:!0,escape:!1,useSmartBehavior:!1,beforeMark:function(){return!0},afterMark:function(){},markTag:"span",markData:{"class":"marked-text"}},r.prototype.smartBehavior=function(t){return new RegExp("[^\\W]*"+o(t)+"[^\\W]*",this.options.ignoreCase?"gi":"g")},r.prototype.queryPosition=function(t){return this.isRegex?t.search(this.query):this.options.ignoreCase?t.toLowerCase().indexOf(this.query):t.indexOf(this.query)},r.prototype.destroy=function(){t(this.marks).each(function(){t(this).replaceWith(t(this).html())}),this.normalizeNodes(this.$el.get(0))},r.prototype.normalizeNodes=function(t){t.normalize&&t.normalize()},r.prototype.wrapString=function(i){return e=t("<"+this.options.markTag+"/>",this.options.markData),e.append(i),this.marks.push(e),this.options.afterMark.call(e),e},r.prototype.smartBehaviorMatchLogic=function(t){if(!this.baseQuery)return!1;var e=this.baseQuery.length,i=t.length;return!(3>e&&i==i)},r.prototype.mark=function(e){var r=function(e,i){var r=t(i).siblings().get(e);void 0!==r&&null!==r.nextSibling&&n.call(this,e+1,r.nextSibling)},n=function(e,n){if(3===n.nodeType){var s=this.queryPosition(n.textContent);if(-1!==s)if(this.isRegex){var o=n.textContent.match(this.query)[0];this.options.beforeMark(o)&&this.smartBehaviorMatchLogic(o)&&(i=n.splitText(this.queryPosition(n.textContent)),i.splitText(o.length),i.parentNode.replaceChild(this.wrapString(t(i).clone()).get(0),i),r.call(this,e,n))}else this.options.beforeMark(this.query)&&(i=n.splitText(this.queryPosition(n.textContent)),i.splitText(this.query.length),i.parentNode.replaceChild(this.wrapString(t(i).clone()).get(0),i),r.call(this,e,n))}else 1===n.nodeType&&n.childNodes.length>0&&-1===t.inArray(n.tagName,this.options.skippedTags)&&this.mark(n)};t.each(e.childNodes,t.proxy(n,this))},t.fn.mark=function(e,i){return t.trim(e)&&""!==this.text().trim()?this.each(function(){if(t.isArray(e))return t.each(e,t.proxy(function(e,r){var s=i,o=r;t.isPlainObject(r)&&r.query&&(o=r.query,delete r.query,s=n(i,r)),t(this).mark(o,s)},this));var s=t(this).data("marker");void 0===s&&(s=[]),s.push(new r(this,i,e)),t(this).data("marker",s)}):this},t.fn.mark.Marker=r,t.fn.mark.noConflict=function(){return t.fn.mark=a,this}});