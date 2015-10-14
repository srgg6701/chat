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
		if(!color)
			color=(function_name.indexOf('MultiwidgetModel.')!=-1)?
				'darkred':'darkcyan';


		console.trace('%c'+function_name, 'color:'+(color? color: 'darkkhaki')+'; font-size:13px; font-weight: normal; background-color:#eee; padding:4px 6px; border-radius: 4px');
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