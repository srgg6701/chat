/**
 *
 */
(function(app, $) {
	app.ChatBoxModelMultiwidget = Backbone.Model.extend({
		defaults:{
			/*parentBox : null,
			sandwich : null,
			submenu : null*/
		},
		initialize : function(){
			trc('ChatBoxModelMultiwidget.initialize');
			//this.parentBox = $('#window-chat');
			//this.sandwich = $('#sandwich');
			//this.submenu = $('>div', this.sandwich); //console.dir([this.sandwich, this.submenu]);
		}
	});
})(window.Application, jQuery);