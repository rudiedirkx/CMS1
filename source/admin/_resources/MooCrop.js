/***
 * MooCrop (v. rc-1 - 2007-10-24 )
 *
 * @version			rc-1
 * @license			BSD-style license
 * @author			nwhite - < nw [at] nwhite.net >
 * @infos			http://www.nwhite.net/MooCrop/
 * @copyright		Author
 * 
 */

var MooCrop = new Class({

	calculateHandles : true,
	current : {},

	options : {
		maskColor : 'black',
		maskOpacity : '.8',
		handleColor : 'red',
		handleWidth : '8px',
		handleHeight : '8px',
		cropBorder : '0px dashed blue',
		min : { 'width' : 50, 'height' : 50 },
		showMask : true, // false to remove, helps on slow machines
		showHandles : false, // hide handles on drag
		aspectRatio: 0
	},

	initialize: function(el, options){
		this.setOptions(options);
		this.img = $(el);
		if ( this.img.getTag() != 'img') return false;

		this.resizeFunc = this.refresh.bindWithEvent(this);
		this.removeFunc = this.removeListener.bind(this);

		this.buildOverlay();
		this.setup();
	},

	setup: function(){
		$(this.cropArea).setStyles({
			'width': this.options.min.width, 
			'height': this.options.min.height,
			'top' : (this.img.height - this.options.min.height)/2,
			'left': (this.img.width - this.options.min.width) / 2 
		});

		this.current.crop = this.crop = this.getCropArea();
//console.log(JSON.stringify(this.current.crop));

		this.handleWidthOffset = this.options.handleWidth.toInt() / 2;
		this.handleHeightOffset = this.options.handleHeight.toInt() /2;

		this.fixBoxModel();
		this.drawMasks();
		this.positionHandles();
	},

	getCropArea : function(){
		var crop = this.cropArea.getCoordinates();
		crop.left -= this.offsets.x;
		crop.right -= this.offsets.x; // calculate relative (horizontal)
		crop.top -= this.offsets.y;
		crop.bottom  -= this.offsets.y; // calculate relative (vertical)
		return crop;
	},

	fixBoxModel : function(){
		var diff = this.boxDiff = (this.crop.width - this.options.min.width)/2;

		var b = this.bounds = { 'top' : diff, 'left' : diff, 
			'right' : this.img.width+(diff*2), 'bottom' : this.img.height+(diff*2),
			'width' : this.options.min.width+(diff*2), 'height' : this.options.min.height+(diff*2) };
		
		this.wrapper.setStyles({
			 'width' : b.right, 'height' : b.bottom
/*			,'background' : 'url('+this.img.src+') no-repeat '+diff+'px '+diff+'px'*/
		});
		this.north.setStyle('width', b.right);
		this.south.setStyle('width', b.right);
	},

	activate : function(event, handle){
		event.stop();
		if ( !([2, 4]).contains(handle.length) ) return;

		var w = this.bounds.right, h = this.bounds.bottom, ci = this.getCropInfo(), s = {top:'auto', bottom:'auto', left:'auto', right:'auto'};
		if ( handle.contains('S') ) {
			s['top'] = ci.top;
		}
		else {
			s['bottom'] = h - ci.top - ci.height;
		}
		if ( handle.contains('E') ) {
			s['left'] = ci.left;
		}
		else {
			s['right'] = w - ci.left - ci.width;
		}
		this.cropArea.setStyles(s);

		this.current = { 'x' : event.page.x, 'y' : event.page.y, 'handle' : handle, 'crop' : this.current.crop };

		if(this.current.handle == 'NESW' && !this.options.showHandles) this.hideHandles();
		
		this.fireEvent('onBegin',[this.img.src,this.getCropInfo(),this.bounds,handle]);

		document.addListener('mousemove', this.resizeFunc);
		document.addListener('mouseup', this.removeFunc);
	},

	removeListener : function(){
		if( this.current.handle == 'NESW' && !this.options.showHandles) this.showHandles();
		document.removeListener('mousemove', this.resizeFunc);
		document.removeListener('mouseup', this.removeFunc);
		this.crop = this.current.crop;
		this.fireEvent('onComplete',[this.img.src,this.getCropInfo(),this.bounds,this.current.handle]);
	},

	refresh : function(event){
		var xdiff = this.current.x - event.page.x;
		var ydiff = this.current.y - event.page.y;

		var b = this.bounds, c = this.crop, handle = this.current.handle, styles = {}; //saving bytes
		var dragging = handle.length > 2;

if ( !([2, 4]).contains(handle.length) ) return;

styles['width'] = c.width;
styles['height'] = c.height;
if ( dragging ) {
	styles['left'] = Math.max(0, Math.min((b.right-c.width), c.left - xdiff));
	styles['top'] = Math.max(0, Math.min((b.bottom-c.height), c.top - ydiff));
}
else {
	if ( handle.contains('S') ) {
		ydiff *= -1;
	}
	if ( handle.contains('E') ) {
		xdiff *= -1;
	}
	styles['width'] += xdiff;
	styles['height'] += ydiff;
}
//console.log(JSON.stringify(styles));

/*		if( handle.contains("S") ){ //SOUTH
			if(c.bottom - ydiff > b.bottom ) ydiff = c.bottom - b.bottom; // box south
			if(!dragging){
				if( (c.height - ydiff) < b.height ) ydiff = c.height - b.height; // size south
				styles['height'] = c.height - ydiff; // South handles only
			}
		}
		if( handle.contains("N") ){ //NORTH
			if(c.top - ydiff < b.top ) ydiff = c.top; //box north
			if(!dragging){
				if( (c.height + ydiff ) < b.height ) ydiff = b.height - c.height; // size north
				styles['height'] = c.height + ydiff; // North handles only
			}
			styles['top'] = c.top - ydiff; // both Drag and N handles
		}
		if( handle.contains("E") ){ //EAST
			if(c.right - xdiff > b.right) xdiff = c.right - b.right; //box east
			if(!dragging){
				if( (c.width - xdiff) < b.width ) xdiff = c.width - b.width; // size east
				styles['width'] = c.width - xdiff;
			}
		}
		if( handle.contains("W") ){ //WEST
			if(c.left - xdiff < b.left) xdiff = c.left; //box west
			if(!dragging){
				if( (c.width + xdiff) < b.width ) xdiff = b.width - c.width; //size west
				styles['width'] = c.width + xdiff;
			}
			styles['left'] = c.left - xdiff; // both Drag and W handles
		}*/

var r = this.options.aspectRatio;
if ( true && 'NESW' != handle && 0 != r ) {

	// r = w / h   so   w = r * h   and   h = w / r

	if ( $defined(styles.width) ) {
		var mh = b.bottom - c.top;
		styles.height = Math.round(styles.width / r);
		if ( styles.height > mh ) {
			styles.height = mh;
			styles.width = Math.round(styles.height * r);
		}
	}
	else if ( $defined(styles.height) ) {
		var mw = b.right - c.left;
		styles.width = Math.round(styles.height * r);
		if ( styles.width > mw ) {
			styles.width = mw;
			styles.height = Math.round(styles.width / r);
		}
	}
}

		var preCssStyles = $merge(styles);
//console.log(JSON.stringify(preCssStyles));
		if( $defined(styles.width)) styles.width -= this.boxDiff*2;
		if( $defined(styles.height)) styles.height -= this.boxDiff*2;

//console.log(JSON.stringify(styles));
		this.cropArea.setStyles(styles);
		var current = this.getCurrentCoords(preCssStyles);
//console.log(JSON.stringify(current));
		this.drawMasks();
		this.positionHandles();
		this.fireEvent('onCrop',[this.img.src,this.getCropInfo(),b,handle]);
	},

	getCurrentCoords : function(changed){
		var bs = this.bounds, ca = this.cropArea;
		var l = parseFloat(ca.getStyle('left')), t = parseFloat(ca.getStyle('top')),
			r = parseFloat(ca.getStyle('right')), b = parseFloat(ca.getStyle('bottom')),
			w = parseFloat(ca.getStyle('width')), h = parseFloat(ca.getStyle('height'));
		var north = isNaN(t) ? bs.bottom - h - b : t;
		var south = bs.bottom - h - north;
		var west = isNaN(l) ? bs.right - w - r : l;
		var east = bs.right - w - west;

		var current = {
			width: changed.width,
			height: changed.height,
			left: west,
			top: north,
			right: east,
			bottom: south
		};
console.log(JSON.stringify(current));
/*		var current = $merge(this.crop);

		current.width = changed.width;
		current.height = changed.height;

		if ( $defined(changed.left) ) {
			current.left = changed.left;
			current.right = current.left + current.width;
		}
		else {
			current.right = changed.right;
			current.left = current.right - current.width;
		}

		if ( $defined(changed.top) ) {
			current.top = changed.top;
			current.bottom = current.top + current.height;
		}
		else {
			current.bottom = changed.bottom;
			current.top = current.bottom - current.height;
		}*/

//console.log(JSON.stringify(current));
//console.log(JSON.stringify(changed));
/*		if($defined(changed.left)){
			current.left = changed.left;
			if($defined(changed.width)) current.width = changed.width;
			else current.right = current.left + current.width;
		}
		if($defined(changed.top)){
			current.top = changed.top;
			if($defined(changed.height)) current.height = changed.height;
			else current.bottom = current.top + current.height;
		}
		if($defined(changed.width) && !$defined(changed.left)){
			current.width = changed.width; current.right = current.left + current.width;
		}
		if($defined(changed.height) && !$defined(changed.top)){
			current.height = changed.height; current.bottom = current.top + current.height;
		}*/
		this.current.crop = current;
		return current;
	},

	drawMasks : function(){
		if(!this.options.showMask) return;
		var cr = this.current.crop, ca = this.cropArea;
//console.log(JSON.stringify(cr));
		this.north.setStyle('height', cr.top + 'px' );
		this.south.setStyle('height', cr.bottom + 'px');
		this.west.setStyles({ height: cr.height + 'px', width: cr.left + 'px', top: cr.top + 'px'});
		this.east.setStyles({ height: cr.height + 'px', width: cr.right + 'px', top: cr.top  + 'px', left: 'auto', right: '0px'});
	},

	positionHandles: function(){
		if(!this.calculateHandles) return;
		var c = this.current.crop, wOffset = this.handleWidthOffset, hOffset = this.handleHeightOffset;

		this.handles.get('N').setStyles({'left' : c.width / 2 - wOffset + 'px', 'top' : - hOffset + 'px'});
		this.handles.get('NE').setStyles({'left' : c.width - wOffset + 'px', 'top' : - hOffset + 'px'});
		this.handles.get('E').setStyles({ 'left' : c.width - wOffset + 'px', 'top' : c.height / 2 - hOffset + 'px'});
		this.handles.get('SE').setStyles({'left' : c.width - wOffset + 'px', 'top' : c.height - hOffset + 'px'});
		this.handles.get('S').setStyles({'left' : c.width / 2 - wOffset + 'px', 'top' : c.height - hOffset + 'px'});
		this.handles.get('SW').setStyles({'left' : - wOffset + 'px', 'top' : c.height - hOffset + 'px'});
		this.handles.get('W').setStyles({'left' : - wOffset + 'px', 'top' : c.height / 2 - hOffset + 'px'});
		this.handles.get('NW').setStyles({'left' : - wOffset + 'px', 'top' : - hOffset + 'px'});
	},

	hideHandles: function(){
		this.calculateHandles = false;
		this.handles.each(function(handle){
			handle.setStyle('display','none');
		});
	},

	showHandles: function(){
		this.calculateHandles = true;
		this.positionHandles();
		this.handles.each(function(handle){
			handle.setStyle('display','block');
		});
	},

	buildOverlay: function(){
		var o = this.options;

		this.wrapper = new Element("div", {
			'styles' : {'position' : 'relative', 'width' : this.img.width, 'height' : this.img.height, /*'background' : 'url('+this.img.src+') no-repeat',*/ 'float' : this.img.getStyle('float')  }
		}).injectBefore(this.img);

		this.img.setStyles({ /*'display': 'none',*/ 'width': '100%', 'height': '100%', 'position': 'absolute', 'left': '0', 'top': '0' }).injectTop(this.wrapper);

		this.offsets = { x : this.wrapper.getLeft(), y : this.wrapper.getTop() };

		if(this.options.showMask){		// optional masks
			var maskStyles = { 'position' : 'absolute', 'overflow' : 'hidden', 'background-color' : o.maskColor, 'opacity' : o.maskOpacity};
			this.north = new Element("div", {'styles' : maskStyles}).injectInside(this.wrapper);
			this.south = new Element("div", {'styles' : $merge(maskStyles,{'bottom':'0px'})}).injectInside(this.wrapper);
			this.east =  new Element("div", {'styles' : maskStyles}).injectInside(this.wrapper);
			this.west =  new Element("div", {'styles' : maskStyles}).injectInside(this.wrapper);
		}

		this.cropArea = new Element("div", {
			'styles': {
				'position': 'absolute',
				'top': '0px',
				'left': '0px',
				'border': o.cropBorder,
				'cursor': 'move'
			},
			'events' : {
				'dblclick' : function(){ this.fireEvent('onDblClk',[this.img.src,this.getCropInfo(),this.bounds])}.bind(this),
				'mousedown' : this.activate.bindWithEvent(this,'NESW')
			}
		}).injectInside(this.wrapper);

		this.handles = new Hash();
		['N','NE','E','SE','S','SW','W','NW'].each(function(handle) {
			this.handles.set(handle, new Element("div", {
				'styles' : { 'position' : 'absolute', 'background-color' : o.handleColor, 'width' : o.handleWidth, 'height' : o.handleHeight, 'overflow' : 'hidden', 'cursor' : (handle.toLowerCase()+'-resize') },
				'events' : { 'mousedown' : this.activate.bindWithEvent(this,handle) }
			}).injectInside(this.cropArea));
		}, this);

	},

	getCropInfo : function(){
//console.log(this.current);
		var c = $merge(this.current.crop);
		c.width -= this.boxDiff*2;
		c.height -= this.boxDiff*2;
		return c;
	},

	removeOverlay: function(){
		this.wrapper.remove();
		this.img.setStyle('display','block');
	}

});
MooCrop.implement(new Events, new Options);
