var AceGeometric = /^u/.test(typeof exports) ? AceGeometric || {} : exports;
void function(exports){ 
    var 
        math = Math,
        cos = math.cos,
        sin = math.sin,
        PI = math.PI,
        PI2 = PI * 2,
        min = math.min,
        max = math.max,
        atan = math.atan,
        atan2 = math.atan2,
        sqrt = math.sqrt,
        pow = math.pow;
        
    /**
     * 获取正负符号
     * @param {Number} x 数值
     * @return 返回x的符号
     */
    function sign(x){
        return x == 0 ? 0 : (x < 0 ? -1 : 1);
    }
    
    /**
     * 计算点到点之间的距离
     * @param {Array[Number,Number]} a 坐标1
     * @param {Array[Number,Number]} b 坐标2
     * @return {Number} 返回点与点间的距离
     */ 
    function pointToPoint(a, b){
          return sqrt(pow(a[0] - b[0], 2) + pow(a[1] - b[1], 2));
    }
    
    /**
     * 计算点的角度
     * @param {Array} origin 圆心坐标
     * @param {Array} point 点坐标
     * @param {Number} eccentricity 离心率
     * @return {Number} 返回角度,单位弧度
     */
    function pointToAngle(origin, point, eccentricity){
        if (typeof eccentricity == 'undefined') eccentricity = 1;
        return atan2((point[1] - origin[1]) * eccentricity, point[0] - origin[0]);
    }
    
    /**
     * 计算点到线段的距离
     * @param {Array[Number,Number]} point 点坐标
     * @param {Array[Number,Number]} a 线段坐标1
     * @param {Array[Number,Number]} b 线段坐标2
     * @return {Number} 返回点到线段的距离
     */
    function pointToLine(point, a, b){
        if (a[0] == b[0] && a[1] == b[1]) return 0;
        var t = ((a[0] - b[0]) * (a[0] - point[0]) + (a[1] - b[1]) * (a[1] - point[1])) /
            ((a[0] - b[0]) * (a[0] - b[0]) + (a[1] - b[1]) * (a[1] - b[1]));
        t = max(0, min(1, t));
        return pointToPoint(point, bezier([a, b], t));
    }
    
    /**
     * 贝赛尔公式，支持多维数组
     * @param{Array[Array[Number, ...],...]} items 每个参考点
     * @param{Number} rate 比率
     * @return{Number|Array[Number, ...]} 返回
     */
    function bezier(items, rate){
        if (!items || !items.length) return;
        var first = items[0], second = items[1];
        var level = first instanceof Array ? first.length : 0; // 下标数,0为非数组
        switch(items.length){
            case 1:
                return level ? first.slice() : first; // 数组需要克隆，非数组直接返回
            case 2:
                if (level){ // 非数组
                    var result = [];
                    for (var i = 0; i < level; i++){
                        result[i] = bezier([first[i], second[i]], rate);
                    }
                    return result;
                }
                return first + (second - first) * rate; 
            default:
                var temp = [];
                for (var i = 1; i < items.length; i++){
                    temp.push(bezier([items[i - 1], items[i]], rate));
                }
                return bezier(temp, rate);
        }
    }

    //console.log(bezier([[1], [7]], 0.5));    

    /**
     * 将一条贝赛尔数组剪成两段
     * @param {Array[Array[Number, Number],...]} items 贝赛尔每个参考点
     * @param {Number} rate 比率
     * @return {Array[Array,Array]} 返回被裁剪后的两个贝赛尔数组
     */
    function cutBezier(items, rate){
        if (!items || items.length < 2) return;
        var pa = items[0], pb = items[items.length - 1],
            ta = [], tb = [],
            ra = [], rb = [];
        for (var i = 0; i < items.length; i++){
            ta.push(items[i]);
            ra.push(bezier(ta, rate));

            tb.unshift(items[items.length - i - 1]);
            rb.unshift(bezier(tb, rate));
        }
        return [ra, rb];
    }
    /**
     * 旋转一个点坐标
     * @param {Array} point 目标坐标
     * @param {Array} center 中心点
     * @param {Number} angle 选择角度，单位:弧度
     * @return {Array} 返回旋转后的坐标
     */
    function rotatePoint(point, center, angle){
        var radius = pointToPoint(center, point);
        angle = pointToAngle(center, point) + angle;
        return [
            center[0] + Math.cos(angle) * radius,
            center[1] + Math.sin(angle) * radius
        ];
    }

    /**
     * 获取两条线段的交点
     * @param {Array[Number,Number]} a 第一条线段坐标1
     * @param {Array[Number,Number]} b 第一条线段坐标2
     * @param {Array[Number,Number]} c 第二条线段坐标1
     * @param {Array[Number,Number]} d 第二条线段坐标2
     * @return {Array[Number,Number]} 返回两条线段的交点坐标
     */
    function doubleLineIntersect(a, b, c, d){
        var delta = (b[1] - a[1]) * (d[0] - c[0]) -
            (d[1] - c[1]) * (b[0] - a[0]);
        if (delta == 0) return;
        var x = (                                                           
                (b[0] - a[0]) *
                (d[0] - c[0]) *
                (c[1] - a[1]) +
                
                (b[1] - a[1]) *
                (d[0] - c[0]) *
                a[0] -
                
                (d[1] - c[1]) *
                (b[0] - a[0]) * c[0]
            ) / delta,
            y = (
                (b[1] - a[1]) *
                (d[1] - c[1]) *
                (c[0] - a[0]) +
                
                (b[0] - a[0]) *
                (d[1] - c[1]) *
                a[1] -
                
                (d[0] - c[0]) *
                (b[1] - a[1]) *
                c[1]
            ) / -delta;
            
        if (
            (sign(x - a[0]) * sign(x - b[0]) <= 0) &&
            (sign(x - c[0]) * sign(x - d[0]) <= 0) &&
            (sign(y - a[1]) * sign(y - b[1]) <= 0) &&
            (sign(y - c[1]) * sign(y - d[1]) <= 0)
        ){
            return [x, y];
        }
    }

    function pointToPolyline(point, polyline){
        if (!point || !polyline || !polyline.length) return;
        var result = pointToPoint(point, polyline[0]);
        for (var i = 1, l = polyline.length; i < l; i++){
            result = min(result, pointToLine(point, polyline[i - 1], polyline[i]));
        }
        return result;
    }

    exports.pointToPoint = pointToPoint;
    exports.pointToLine = pointToLine;
    exports.pointToPolyline = pointToPolyline;
    exports.bezier = bezier;
    exports.cutBezier = cutBezier;
    exports.pointToAngle = pointToAngle;
    exports.doubleLineIntersect = doubleLineIntersect;
    exports.rotatePoint = rotatePoint;
}(AceGeometric);var Ace3D = typeof exports == 'undefined' ? Ace3D || {} : exports;

void function(exports){
    
    /*
     * see http://www.bitstorm.it/blog/en/2011/05/3d-sphere-html5-canvas/
     */
    
    var math = Math,
        sin = math.sin,
        cos = math.cos,
        /**
         * 旋转轴线
         */
        rotate_axis = {
            x: [1, 2],
            y: [0, 2],
            z: [0, 1]
        };

    /**
     * 旋转坐标
     * @param{Array|Object} point 原坐标
     * @param{Number} radians 选择角度，单位弧度
     * @param{String} axis 轴线 'x','y','z'
     */
    function rotate(point, radians, axis){
        if (!point) return;
        var indexs = point instanceof Array ? [0, 1, 2] : ['x', 'y', 'z'],
            t = point[indexs[rotate_axis[axis][0]]],
            p = point[indexs[rotate_axis[axis][1]]];
        point[indexs[rotate_axis[axis][0]]] = 
            t * cos(radians) - p * sin(radians);
        point[indexs[rotate_axis[axis][1]]] = 
            t * sin(radians) + p * cos(radians);
        return point;
    }
    /**
     * 旋转x轴
     * @param{Array|Object} point 原坐标 
     * @param{Number} radians 选择角度，单位弧度
     */
    function rotateX(point, radians){
        return rotate(point, radians, 'x');
    }

    /**
     * 旋转y轴
     * @param{Array|Object} point 原坐标 
     * @param{Number} radians 选择角度，单位弧度
     */
    function rotateY(point, radians){
        return rotate(point, radians, 'y');
    }

    /**
     * 旋转z轴
     * @param{Array|Object} point 原坐标 
     * @param{Number} radians 选择角度，单位弧度
     */
    function rotateZ(point, radians){
        return rotate(point, radians, 'z');
    }
    
    /**
     * 将3D坐标投影到2D
     * @param{Array} point 原坐标
     * @param{Number} zOffset z轴偏移
     * @param{Number} distance 距离
     */
    function projection(point, zOffset, distance){
        var indexs = point instanceof Array ? [0, 1, 2] : ['x', 'y', 'z'];
        var result = point instanceof Array ? [] : {};
        result[indexs[0]] = (distance * point[indexs[0]]) / (point[indexs[2]] - zOffset);
        result[indexs[1]] = (distance * point[indexs[1]]) / (point[indexs[2]] - zOffset);
        return result;
    }
    
    // /**
     // * p1--------p2
     // * |          |
     // * p3--------p4
     // */
    // function matrix(p1, p2, p3, p4){
        // var indexs = p1 instanceof Array ? [0, 1] : ['x', 'y'];
        // var tx = p1[indexs[0]];
        // var ty = p1[indexs[1]];

        // var a = (p2[indexs[0]] - tx) / 2;
        // var b = (ty - p1[indexs[1]]) / 2;

        // var c = (p3[indexs[0]] - tx) / 2;
        // var d = (ty - p3[indexs[1]]) / 2;

        // return [a, b, c, d, tx, ty];
    // }
    
    exports.rotate = rotate;
    exports.rotateX = rotateX;
    exports.rotateY = rotateY;
    exports.rotateZ = rotateZ;
    exports.projection = projection;

}(Ace3D);var AcePath = AcePath || {};

void function(exports){
    // 压缩代码相关
    /* compressor */    
    /**
     * Ace Engine Path
     * 一套展示矢量图路径的控件 简单版本
     * @see http://code.google.com/p/ace-engine/wiki/AcePath
     * @author 王集鹄(wangjihu,http://weibo.com/zswang)
     * @version 1.0
     * @copyright www.baidu.com
     */
    var 
        ie = document.all && document.attachEvent,
        /*
         * 是否ie9+
         */
        ie9plus = ie && window.XMLHttpRequest && window.addEventListener && document.documentMode >= 9,
        /*
         * 是否支持svg
         */
        svg = !ie || ie9plus,
        /*
         * vml样式元素,避免重复创建
         */
        vmlStyle,
        /*
         * 容器列表
         */
        parentList = [];
    
    /**
     * 格式化函数
     * @param {String} template 模板
     * @param {Object} json 数据项
     */
    function format(template, json){
        return template.replace(/#\{(.*?)\}/g, function(all, key){
            return json && (key in json) ? json[key] : "";
        });
    }

    /**
     * 矢量路径类
     * @param {Object} options 配置
     *    @field {String|Element} parent 容器
     *    @field {String} fill 填充色
     *    @field {Number} fillOpacity 填充透明度
     *    @field {String} stroke 描边色
     *    @field {Number} strokeOpacity 描边透明度
     *    @field {Number} strokeWidth 描边宽度
     *    @field {String} path 路径
     */
    function Path(options){
        options = options || {};
        if (typeof options.parent == 'string'){
            this.parent = document.getElementById(options.parent);
        } else {
            this.parent = options.parent || document.body;
        }

        this.fill = options.fill || 'none';
        this.fillOpacity = options.fillOpacity || options['fill-opacity'] || 1;
        this.stroke = options.stroke || 'black';
        this.strokeWidth = options.strokeWidth || options['stroke-width'] || 1;
        this.strokeOpacity = options.strokeOpacity || options['stroke-opacity'] || 1;
        this.path = options.path || 'M 0,0';
        
        // 处理相同的容器
        var parentInfo;
        for (var i = 0; i < parentList.length; i++){
            var item = parentList[i];
            if (item.parent == this.parent){
                parentInfo = item;
                break;
            }
        }
        
        var div = document.createElement('div');
        if (svg){
            div.innerHTML = format('\
<svg width=100% height=100% xmlns="http://www.w3.org/2000/svg">\
    <path fill="#{fill}" fill-rule="evenodd" stroke-linejoin="round" fill-opacity="#{fillOpacity}" stroke="#{stroke}" stroke-opacity="#{strokeOpacity}" stroke-width="#{strokeWidth}" d="#{path}"/>\
</svg>', this);
            this.elementPath = div.lastChild.lastChild;
            if (parentInfo){
                this.element = parentInfo.element;
                this.element.appendChild(this.elementPath);
            } else {
                this.element = div.lastChild;
                parentList.push({
                    parent: this.parent,
                    element: this.element
                });
                this.parent.appendChild(this.element);
            }
        } else {
            this.filled = this.fill == 'none' ? 'f' : 't';
            this.stroked = this.stroke == 'none' ? 'f' : 't';
            //div.style.height = '100%';
            //div.style.width = '100%';
            div.innerHTML = format('\
<v:shape class="ace_path_shape ace_vml" coordsize="1,1" stroked="#{stroked}" filled="#{filled}" path="#{path}">\
    <v:stroke class="ace_vml" opacity="#{strokeOpacity}" color="#{stroke}" weight="#{strokeWidth}"></v:stroke>\
    <v:fill class="ace_vml" opacity="#{fillOpacity}" color="#{fill}"></v:fill>\
</v:shape>', this);
            this.elementPath = div.lastChild;
            if (parentInfo){
                this.element = parentInfo.element;
                this.element.appendChild(this.elementPath);
            } else {
                this.element = div;
                div.className = 'ace_path_panel';
                parentList.push({
                    parent: this.parent,
                    element: this.element
                });
                this.parent.appendChild(this.element);
            }
            this.elementFill = this.elementPath.getElementsByTagName('fill')[0];
            this.elementStroke = this.elementPath.getElementsByTagName('stroke')[0];
        }
    }
    /*
     * 设置或获取属性
     * @param {Object} values
     * @or
     * @param {String} name
     * @param {String} value
     * @or
     * @param {String} name
     */
    Path.prototype.attr = function(name, value){
        if (arguments.length == 1){
            if (typeof name == 'string'){
                if (name == 'stroke-width'){
                    name = 'strokeWidth';
                }
                return this[name];
            }
            if (typeof name == 'object'){
                for (var p in name){
                    this.attr(p, name[p], true);
                }
                return this;
            }
        } else if (arguments.length > 1){
            switch(name){
                case 'path':
                    if (this.path == value) break;
                    this.path = value;
                    if (svg){
                        this.elementPath.setAttribute('d', value || 'M 0,0');
                    } else {
                        this.elementPath.path = String(value || 'M 0,0')
                            .replace(/(\d+)\.\d+/g, '$1') // 清理小数
                            .replace(/z/ig, 'X'); // 处理闭合
                    }
                    break;
                case 'fill':
                    if (this.fill == value) break;
                    this.fill = value;
                    if (svg){
                        this.elementPath.setAttribute('fill', value);
                    } else {
                        this.elementPath.Filled = this.filled = this.fill == 'none' ? 'f' : 't';
                        this.elementFill.Color = value;
                    }
                    break;
                case 'stroke':
                    if (this.stroke == value) break;
                    this.stroke = value;
                    if (svg){
                        this.elementPath.setAttribute('stroke', value);
                    } else {
                        this.elementPath.Stroked = this.stroked = this.stroke == 'none' ? 'f' : 't';
                        this.elementStroke.Color = value;
                    }
                    break;
                case 'fillOpacity':
                case 'fill-opacity':
                    if (this.fillOpacity == value) break;
                    this.fillOpacity = value;
                    if (svg){
                        this.elementPath.setAttribute('fill-opacity', value);
                    } else {
                        this.elementFill.Opacity = Math.min(Math.max(0, value), 1);
                    }
                    break;
                case 'strokeOpacity':
                case 'stroke-opacity':
                    if (this.strokeOpacity == value) break;
                    this.strokeOpacity = value;
                    if (svg){
                        this.elementPath.setAttribute('stroke-opacity', value);
                    } else {
                        this.elementStroke.Opacity = Math.min(Math.max(0, value), 1);
                    }
                    break;
                case 'strokeWidth':
                case 'stroke-width':
                    if (this.strokeWidth == value) break;
                    this.strokeWidth = value;
                    if (svg){
                        this.elementPath.setAttribute('stroke-width', value);
                    } else {
                        this.elementStroke.weight = value;
                    }
                    break;
            }
            return this;
        }
        
    };

    function create(options){
        return new Path(options);
    }

    if (ie && !vmlStyle){
        vmlStyle = document.createStyleSheet();
        vmlStyle.cssText = '\
.ace_vml{behavior:url(#default#VML);}\
.ace_path_shape{width:1px;height:1px;padding:0;margin:0;left:0;top:0;position:absolute;}\
.ace_path_panel{width:100%;height:100%;overflow:hidden;padding:0;margin:0;position:relative;}\
';
    }
    
    exports.create = create;
}(AcePath);var AceString = /^u/.test(typeof exports) ? AceString || {} : exports;
void function(exports){
    /**
     * Ace Engine String
     * 字符串编码处理
     * @see http://code.google.com/p/ace-engine/wiki/AceString
     * @author 王集鹄(wangjihu，http://weibo.com/zswang)
     * @version 1.0
     * @copyright www.baidu.com
     */
    var b64;
    /**
     * 对字符串进行base64编码
     * param{string} str 原始字符串
     */
    function encodeBase64(str) {
        if (!str) return;
        if (!b64){
            b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
        }
        var inputs = {}, outputs = {}, bits, i = 0, result = [];
        str = encodeUTF8(str);
        do {
            inputs[0] = str.charCodeAt(i++);
            inputs[1] = str.charCodeAt(i++);
            inputs[2] = str.charCodeAt(i++);

            bits = inputs[0] << 16 | inputs[1] << 8 | inputs[2];

            outputs[0] = bits >> 18 & 0x3f;
            outputs[1] = bits >> 12 & 0x3f;
            outputs[2] = bits >> 6 & 0x3f;
            outputs[3] = bits & 0x3f;

            if (isNaN(inputs[2])) outputs[3] = 64;
            if (isNaN(inputs[1])) outputs[2] = 64;

            result.push([
                b64.charAt(outputs[0]),
                b64.charAt(outputs[1]),
                b64.charAt(outputs[2]),
                b64.charAt(outputs[3])
            ].join(''));
        } while (i < str.length);
        return result.join('');
    }
    /**
     * 对base64字符串进行解码
     * @param {String} str 编码字符串
     */
    function decodeBase64(str) {
        if (!str) return;
        var inputs = {}, outputs = {}, bits, i = 0, result = [];

        do {
            inputs[0] = b64.indexOf(str.charAt(i++));
            inputs[1] = b64.indexOf(str.charAt(i++));
            inputs[2] = b64.indexOf(str.charAt(i++));
            inputs[3] = b64.indexOf(str.charAt(i++));

            bits = inputs[0] << 18 | inputs[1] << 12 | inputs[2] << 6 | inputs[3];

            outputs[0] = bits >> 16 & 0xff;
            outputs[1] = bits >> 8 & 0xff;
            outputs[2] = bits & 0xff;

            if (inputs[2] == 64) {
                result.push(String.fromCharCode(outputs[0]));
            } else if (inputs[3] == 64) {
                result.push(String.fromCharCode(outputs[0], outputs[1]));
            } else {
                result.push(String.fromCharCode(outputs[0], outputs[1], outputs[2]));
            }
        } while (i < str.length);
        return decodeUTF8(result.join(''));
    }

    /**
     * 对字符串进行utf8编码
     * param{string} str 原始字符串
     */
    function encodeUTF8(str) {
        if (!str) return;
        return String(str).replace(
            /[\u0080-\u07ff]/g,
            function(c) {
                var cc = c.charCodeAt(0);
                return String.fromCharCode(0xc0 | cc >> 6, 0x80 | cc & 0x3f);
            }
        ).replace(
            /[\u0800-\uffff]/g,
            function(c) {
                var cc = c.charCodeAt(0);
                return String.fromCharCode(0xe0 | cc >> 12, 0x80 | cc >> 6 & 0x3f, 0x80 | cc & 0x3f);
            }
        );
    }

    /**
     * 对utf8字符串进行解码
     * @param {String} str 编码字符串
     */
    function decodeUTF8(str) {
        if (!str) return;
        return String(str).replace(
            /[\u00c0-\u00df][\u0080-\u00bf]/g,
            function(c) {
                var cc = (c.charCodeAt(0) & 0x1f) << 6 | (c.charCodeAt(1) & 0x3f);
                return String.fromCharCode(cc);
            }
        ).replace(
            /[\u00e0-\u00ef][\u0080-\u00bf][\u0080-\u00bf]/g,
            function(c) {
                var cc = (c.charCodeAt(0) & 0x0f) << 12 | (c.charCodeAt(1) & 0x3f) << 6 | (c.charCodeAt(2) & 0x3f);
                return String.fromCharCode(cc);
            }
        );
        return str;
    }
    
    /**
     * 格式化函数
     * @param {String} template 模板
     * @param {Object} json 数据项
     */
    function format(template, json){
        return template.replace(/#\{(.*?)\}/g, function(all, key){
            return json && (key in json) ? json[key] : "";
        });
    }
    /*
     * html编码转换字典
     */
    var htmlDecodeDict, htmlEncodeDict;
    /**
     * HTML解码
     * @param {String} html
     */
    function decodeHTML(html){
        htmlDecodeDict || (htmlDecodeDict = {
            'quot': '"',
            'lt': '<',
            'gt': '>',
            'amp': '&',
            'nbsp': ' '
        });
        return String(html).replace(
            /&((quot|lt|gt|amp|nbsp)|#x([a-f\d]+)|#(\d+));/ig, 
            function(all, group, key, hex, dec){
                return key ? htmlDecodeDict[key.toLowerCase()] :
                    hex ? String.fromCharCode(parseInt(hex, 16)) : 
                    String.fromCharCode(+dec);
            }
        );
    }
    
    /**
     * HTML编码
     * @param {String} text 
     */
    function encodeHTML(text){
        htmlEncodeDict || (htmlEncodeDict = {
            '"': 'quot',
            '<': 'lt',
            '>': 'gt',
            '&': 'amp',
            ' ': 'nbsp'
        });
        return String(text).replace(/["<>& ]/g, function(all){
            return "&" + htmlEncodeDict[all] + ";";
        });
    }

    /*
    function decodeHTML(html){
        var pre = document.createElement('pre');
        pre.innerHTML = html.replace(/[\\<>]/g, function(all){
            return '\\' + all.charCodeAt() + ';';
        });
        return String(pre.innerText || pre.textContent).replace(/\\(\d+);/g, function(all, dec){
            return String.fromCharCode(+dec);
        });
    }
    
    function encodeHTML(text){
        var pre = document.createElement('pre');
        pre.appendChild(document.createTextNode(text));
        return pre.innerHTML;
    }
    */

    var crc32dict;
    function crc32(str){
        var i, j, k;
        if (!crc32dict){
            crc32dict = [];
            for (i = 0; i < 256; i++) {
                k = i;
                for (j = 8; j--;)
                    if (k & 1) 
                        k = (k >>> 1) ^ 0xedb88320;
                    else k >>>= 1;
                crc32dict[i] = k;
            }
        }
        
        str = encodeUTF8(str);
        k = -1;
        for (i = 0; i < str.length; i++) {
            k = (k >>> 8) ^ crc32dict[(k & 0xff) ^ str.charCodeAt(i)];
        }
        return -1 ^ k;
    }
    
    function encodeUnicode(str){
        if (!str) return;
        return String(str).replace(/[^\x00-\xff\uFEFF]/g, function(all){
            return escape(all).replace(/%u(....)/i, "\\u$1");
        });
    }

    function decodeUnicode(str){
        if (!str) return;
        return String(str).replace(/\\u([\da-f]{4})|\\x([\da-f]{2})/ig, function(all, $1, $2){
            return String.fromCharCode(parseInt($1 || $2, 16));
        });
    }
    
    exports.base64 = {
        encode: encodeBase64,
        decode: decodeBase64
    };
    exports.utf8 = {
        encode: encodeUTF8,
        decode: decodeUTF8
    };
    
    exports.format = format;
    exports.html = {
        encode: encodeHTML,
        decode: decodeHTML
    };
    exports.unicode = {
        encode: encodeUnicode,
        decode: decodeUnicode
    };
    exports.crc32 = crc32;
}(AceString);

/*
console.log(AceString.base64.decode(AceString.base64.encode('english 中文')));
console.log(AceString.html.decode("&amp;#34;&#x4F60;&#x3c;"));
console.log(AceString.unicode.decode(AceString.unicode.encode("english 中文")));
//*/