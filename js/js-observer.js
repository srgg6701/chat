console.log('observer here');
/**
 * Вывести trace вызванной функции
 * @param function_name -- объект.имя_метода
 */
function trace_all(function_name, params, color){

	var hide = false;
	// check conditions
	if( hide ||
		( params &&
			! ( ( typeof (params) == 'object' && "push" in params ) // is array
				|| params[0]===true // true is passed
				|| params === 1
			)
		)
	)   return false;
	else {
		if(!color){
			if(function_name.indexOf('MultiwidgetModel.')!=-1)
				color='darkred';
			if(function_name.indexOf('AdminChatModel.')!=-1)
				color='darkcyan';
			if(function_name.indexOf('CannedMessagesModel.')!=-1)
				color='darkrblue';
			if(function_name.indexOf('GuestChatModel.')!=-1)
				color='violet';
			if(function_name.indexOf('ChatViewModel.')!=-1)
				color='orangered';
			if(function_name.indexOf('GuestSettingsModel.')!=-1)
				color='darkorange';
			if(function_name.indexOf('MessageModel.')!=-1)
				color='blue';
			if(function_name.indexOf('UISettingsModel.')!=-1)
				color='black';
			if(function_name.indexOf('UserModel.')!=-1)
				color='#808000';
			if(function_name.indexOf('ChatBoxView.')!=-1)
				color='#006400';
			if(function_name.indexOf('ContactFormView.')!=-1)
				color='#2F4F4F';
			if(function_name.indexOf('LoginFormView.')!=-1)
				color='#008080';
			if(function_name.indexOf('MessageView.')!=-1)
				color='#191970';
			if(function_name.indexOf('SelectAvatarInlineView.')!=-1)
				color='#483D8B';
			if(function_name.indexOf('SelectAvatarView.')!=-1)
				color='#9400D3';
			if(function_name.indexOf('UserInfoPopoverView.')!=-1)
				color='#BA55D3';
			if(function_name.indexOf('WidgetView.')!=-1)
				color='rebeccablue';
			if(function_name.indexOf('CannedMessagesView.')!=-1)
				color='#800080';
			if(function_name.indexOf('ChatTabView.')!=-1)
				color='#DC143C';
			if(function_name.indexOf('ChatView.')!=-1)
				color='#696969';
			if(function_name.indexOf('DialogsView.')!=-1)
				color='#B22222';
			if(function_name.indexOf('HistoryView.')!=-1)
				color='#FF6347';
			if(function_name.indexOf('MenuView.')!=-1)
				color='#A0522D';
			if(function_name.indexOf('OperatorsView.')!=-1)
				color='#D2691E';
			if(function_name.indexOf('SelectCannedMessageView.')!=-1)
				color='#FF8C00';
			if(function_name.indexOf('SettingsView.')!=-1)
				color='#B8860B';
			if(function_name.indexOf('TabsView.')!=-1)
				color='#556B2F';
			if(function_name.indexOf('WidgetThemeView.')!=-1)
				color='#7CFC00';
			if(function_name.indexOf('WindowView.')!=-1)
				color='#00FF00';
		}

		var css = '; font-size:13px; font-weight: normal; padding:4px 6px; border-radius: 4px;';
		if(function_name.indexOf('Model.')!=-1) css+='background-color:#ddd;';

		console.trace('%c'+function_name, 'color:'+(color? color: 'darkkhaki')+css);
		if(params && params!==true) {
			var txtColor = color ? color : 'orange';
			console.groupCollapsed('%c  [params]', 'color: ' + txtColor);
			console.dir(params);
			console.groupEnd();
		}
		if( function_name.indexOf('.checkOperators')!=-1
			|| function_name.indexOf('.getTalkWith')!=-1	)
			console.log('%c'+(new Date()).getSeconds()+'---[The end of the calls stack]---', 'color: navy, font-weight: bold');
	}
}

function trc(function_name, params, color){
	//return false;
	trace_all(function_name, params, color);
}

function trc2(function_name, params, color){
	trace_all(function_name, params, color);
}


function outputConsoleData(Model){
	trc('Test: outputConsoleData',[true]);
	console.log({
		prev:{
			'1. section-wrapper':Model.get('prev.section-wrapper'),
			'2. data-section':Model.get('prev.data-section'),
			'3. data-result':Model.get('prev.data-result'),
			'4. data-step':Model.get('prev.data-step'),
			'5. data-user-message':Model.get('prev.data-user-message')
		},
		active:{
			'1. section-wrapper':Model.get('active.section-wrapper'),
			'2. data-section':Model.get('active.data-section'),
			'3. data-result':Model.get('active.data-result'),
			'4. data-step':Model.get('active.data-step'),
			'5. data-user-message':Model.get('active.data-user-message')
		}
	});
}