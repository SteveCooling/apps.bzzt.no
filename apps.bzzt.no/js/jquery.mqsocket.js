(function($){
$.extend({
	mqsocket: function(url, s) {
		var ws = $.websocket(url, s);
		
		ws.subscribe = function(type, f) {
			this.send('subscribe',type);
			this._settings.events[type] = f;
		}

		ws.unsubscribe = function (type) {
			this.send('unsubscribe',type);
			this._settings.events[type] = false;
		}

		return ws;
	}
});
})(jQuery);
