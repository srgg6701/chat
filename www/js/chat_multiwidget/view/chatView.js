(function(app, $){
	// app.ChatBoxViewMultiwidget
	var ChatView = Backbone.View.extend({
		events :{
			// Load operator's data into the chat section header
			'click [data-section="chat"]'	: 'loadOperatorData',
			'mouseenter #sandwich' 			: 'manageSandwich',
			'mouseleave #sandwich' 			: 'manageSandwich'
		},
		initialize : function() {
			//trc('chatView.initialize', [true]);
			//var Model = this.model;
		},
		manageSandwich : function(event){
			//trc('ChatView.manageSandwich', [true]);
			$('>div', event.currentTarget).slideToggle(200);
		},
		/**
		 * Load operator's data into the chat section header
		 */
		// refactor: see WidgetViews :: setState() and modify all that!
		loadOperatorData : function(){
			//trc('ChatView.loadOperatorData', [true]);
			var chatTitleBlock = $('#window-chat .customer-chat-header-title'),
				// sorry for a little trick :(
				// refactor: what about saving this block in the Application, Dude?
				operatorData = $('#operator-avatar')[0].outerHTML;
			//console.dir([chatTitleBlock, operatorData]);
			chatTitleBlock.html(operatorData);
			//
			var username = $('<div/>',{
					class: 'avatarUserName'
				}).html('♥ Коалаопер'),
				sandwich = $('<div/>',{
				id: 'sandwich'
			});
			chatTitleBlock.prepend(username)
						  .append(sandwich);
			//
			var sndwHTML = '<hr/><hr/><hr/><div><ul>',
				sndwData = [
					{'text':'История переписки'},
					{'text':'Отправить переписку на e-mail'},
					{'text':'Выключить звук'}
				];

			for(var i= 0, j=sndwData.length; i < j; i++){
				sndwHTML+='<li><a href="javascript:void()">'
					+ sndwData[i].text + '</a></li>';
			}
			sndwHTML+='</ul></div>';
			$(sandwich).html(sndwHTML);
		}
	});
	var model = new app.ChatBoxModelMultiwidget(),
		chat  = new ChatView({ model : model, el: $('body') });
})(window.Application, jQuery);