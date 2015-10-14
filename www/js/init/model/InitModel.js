/**
 * Модель начального отображения окна Мультивиджета
 */
(function (app, $) {
	/**
	 ChatBoxView: ()
	 ContactFormView: ()
	 GuestChatModel: ()
	 GuestSettingsModel: ()
	 LoginFormView: ()
	 MessageModel: ()
	 MessageView: ()
	 MultiwidgetModel: ()
	 SelectAvatarInlineView: ()
	 SoundPlayer: ()
	 WidgetView: ()
	 bind: (M,P,O)
	 listenTo: (Q,O,S)
	 listenToOnce: (Q,O,S)
	 model: Object
	 off: (M,V,N)
	 on: (M,P,O)
	 once: (N,Q,O)
	 service: Object
	 stopListening: (P,M,R)
	 template: Object
	 trigger: (O)
	 unbind: (M,V,N)
	 view: Object*/
	var InitModel = app.MultiwidgetModel = Backbone.Model.extend({
		defaults: {
			//iFrame: $(window.parent.document.getElementById("customer-chat-iframe")),
			Multiwidget: $('#customer-chat-widget'),
			sectionWrapperIdPrefix: 'window',
			initSuffix: 'init',
			windowInit: null,
			// classes
			wrapperClass: 'wrapper',
			//frameState : 'collapsed',
			invisibleClass: 'invisible',
			expandedClass: 'expanded',
			sectionWrapperClass: 'section-wrapper',
			sectionTopClass: 'section-top',
			messageToUserTopClass: 'message-to-user-top',
			// blocks
			defaultSection: $('.section-wrapper.default'),
			recallLaterBlock: $('#recall-later-block'),
			userPhoneForm: $('#form-user-phone'),
			Username: $('#lbl-username .header-string'),
			testUserStatus: $('#test-data'),
			// initialized by null
			avatarBlock: null,
			helloBlock: null,
			operatorBlock: null,
			operatorBlockWrapper: $('#operator-block-wrapper'),
			infoCountDownBlock: null,
			blocksLevel1: null, // .section-wrapper:not(#window-init)
			blocksLevel2: null, // .section-top 		in blocksLevel1
			blocksLevel3: null, // [data-calls-section] in blocksLevel1
			blocksLevel4: null, // [data-calls-result] 	in blocksLevel1
			blocksLevel5: null, // [data-step] 			in blocksLevel1
			blocksLevel6: null, // .message-to-user-top in blocksLevel1
			blocksLevel7: null, // [data-user-message]	in blocksLevel1
			//-----------------------------------------
			userStatus: null,
			// buttons
			buttons: {
				'collapse-current-section': $('#collapse-current-section'),
				'collapse-widget': $('#collapse-widget')
			},
			dataCompleted: 'data-completed',
			// data for timer's handler
			data_action: 'data-action',
			data_action_value: false,
			data_actionValues: {
				fail: 'fail',
				make_feedback: 'make-feedback',
				success: 'success',
				wait_for_call: 'wait-for-call',
				wanna_record: 'wanna-record'
			},
			data_calls_section: 'data-calls-section',
			data_calls_result: 'data-calls-result',
			data_section: 'data-section',
			data_star: 'data-star',
			data_step: 'data-step',
			data_user_message: 'data-user-message',
			topSectionNames: ['initial', 'process', 'result', 'call-later'],
			subsections: {
				result: ['success', 'fail']
			},
			//-DOM elements-----------------------------------
			'default.section-wrapper-alias': null, // their aliases ─ init, call, choice etc
			'default.section-wrapper': null, // level-1 blocks ─ #window-[init, call, choice]
			'default.section': null, // level-2 blocks (level-1 > section.default)
			'default.data-calls-section': null, // level-3 blocks, ie. subsections ─ [data-calls-section=[initial, process, result]
			'default.data-calls-result': null, // level-4 blocks, [data-calls-result=success/fail]
			'default.data-step': null, // level-5 blocks
			'default.message-to-user-section': null, // level-6 blocks, having the class .message-to-user-top
			'default.data-user-message': null, // level-7 blocks, [data-user-message=[1,2,3, ...n]]
			// this.clear().set(this.defaults); ─ but only if they are set as default, not being assigned later
			'prev.section-wrapper-alias': null,
			'prev.section-wrapper': null,
			'prev.section': null,
			'prev.data-calls-section': null,
			'prev.data-calls-result': null,
			'prev.data-step': null,
			'prev.message-to-user-section': null,
			'prev.data-user-message': null,
			//-----------------------------------------
			'active.section-wrapper-alias': null,
			//-----------------------------------------
			'active.section-wrapper': null,
			//'active.section': null,
			'active.data-calls-section': null,
			'active.data-calls-result': null,
			'active.data-step': null,
			//'active.message-to-user-section': null,
			'active.data-user-message': null,
			//-----------------------------------------
			model_state: false,
			widget_frame_state: 'collapsed',
			widget_frame_states: {
				collapsed: 'collapsed',
				expanded: 'expanded'
			},
			/**
			 * get [data] selector
			 * @dataName ─ string [data-[name]]
			 * @dataValue ─ string [data-[name]=[data-value]]
			 */
			getSelectorData: function (dataName, dataValue, exclude) {
				trc('MultiwidgetModel.getSelectorData', [true, dataName, dataValue, exclude]);
				var selector = dataValue ?
				'[' + dataName + '="' + dataValue + '"]'
					: '[' + dataName + ']';
				if (exclude) selector += ':not(' + exclude + ')';
				//console.log('%cselector: '+selector, 'color:green');
				return selector;
			},
			DomElementValue		: null,
			test				: null,
			'debug.old-prev'	: null,
			'debug.prev'		: null,
			'debug.active'		: null,
			debug_state 		: null,
		},
		initialize: function () {
			trc('MultiwidgetModel.initialize', [true, this]);

			this.set('frameState', 'unknown');

			var windowIdStr = '#' + this.get('sectionWrapperIdPrefix') + '-' + this.get('initSuffix');
			this.set('windowInit', $(windowIdStr)[0]);
			this.set('avatarImg', window.chatConfig.rootPath + 'upload/avatars/koala.jpg');
			this.set('default.section-wrapper', this.get('defaultSection'));
			this.set('greeting', "Готова вам помочь!");
			var operatorBlock = $(windowIdStr + '-minified');
			this.set('operatorBlock', operatorBlock);
			this.set('helloBlock', $('#operator-greeting', operatorBlock));
			this.set('avatarBlock', $('#operator-avatar', operatorBlock));

			// .section-wrapper, except #window-init
			this.set('blocksLevel1', $('.' + this.get('sectionWrapperClass') + ':not(' + windowIdStr + ')'));
			var blocksLevel1 = this.get('blocksLevel1');
			// .section-top
			// info: currently is not in use. Uses just as a container for styles applying
			this.set('blocksLevel2', $('.' + this.get('sectionTopClass'), blocksLevel1));
			// [data-calls-section]
			this.set('blocksLevel3', $('[' + this.get('data_calls_section') + ']', blocksLevel1));
			// [data-calls-result]
			this.set('blocksLevel4', $('[' + this.get('data_calls_result') + ']', blocksLevel1));
			// [data-step]
			this.set('blocksLevel5', $('[' + this.get('data_step') + ']', blocksLevel1));
			// .message-to-user-top
			// info: currently is not in use. Uses just as a container for styles applying
			this.set('blocksLevel6', $('.' + this.get('messageToUserTopClass'), blocksLevel1));
			// [data-user-message]
			this.set('blocksLevel7', $('[' + this.get('data_user_message') + ']', blocksLevel1));
			//console.dir([this.get('blocksLevel1'), this.get('blocksLevel2'), this.get('blocksLevel3'), this.get('blocksLevel4'), this.get('blocksLevel5')]);
			//
			//this.set('widget_frame_state', this.get('widget_frame_states').collapsed);
			// countdown block
			this.set('infoCountDownBlock', {
				element: $('#info-countdown'),
				timeLeftInit: 24,
				timeLeft: this.timeLeftInit,
				tmInterval: null,
				getCell: function (name) {
					return $($this.getSelectorData('data-container', name));
				},
				cells: {
					mins: null,
					secs: null,
					msecs: null
				},
				checkHalfTime: function () {
					//trc('MultiWidget.infoCountDownBlock.checkHalfTime',[true]);
					var result = (this.timeLeft == this.timeLeftInit / 2);
					//console.log('%cresult: ' + result, 'color: green');
					return result;
				},
				checkMajorTime: function () {
					//trc('MultiWidget.infoCountDownBlock.checkMajorTime',[true]);
					var result = (this.timeLeft == this.timeLeftInit / 2 - 5);
					//console.log('%cresult: ' + result, 'color: blue');
					return result;
				},
				setMsecs: function (value) {
					//trc('MultiWidget.infoCountDownBlock.setMsecs',[true, value]);
					this.cells.msecs.html(value);
				},
				setSecs: function (value) {
					//trc('MultiWidget.infoCountDownBlock.setSecs',[true, value]);
					this.cells.secs.html(value);
				},
				setCurrentSeconds: function () {
					//trc('MultiWidget.infoCountDownBlock.setCurrentSeconds',[true]);
					var value = this.timeLeft <= 10 ? '0' + --this.timeLeft : --this.timeLeft;
					this.setSecs(value);
				},
				init: function () {
					//trc('MultiWidget.infoCountDownBlock.init',[true]);
					this.timeLeft = this.timeLeftInit;

					this.cells.mins = this.getCell('mins');
					this.cells.secs = this.getCell('secs');
					this.cells.msecs = this.getCell('msecs');

					this.cells.secs.html(this.timeLeftInit);
					this.cells.msecs.html('00');
				}
			});
		},
		/**
		 * Just in dev mode. In real app should get from other sources
		 * @param status
		 */
		setUserStatus: function (status) {
			trc('MultiwidgetModel.setUserStatus', [true, status]);
			this.set('userStatus', status);
		},
		/**
		 * Save a previous param, set new one
		 * @param name of param
		 * @param value of param
		 */
		handleActiveSection: function (name, value) {
			trc('MultiwidgetModel.handleActiveSection', [true, name, value]);
			var test=false;

			var nameActiveParent = 'active.',
				nameActiveParentInit = nameActiveParent,
				nameActiveParentWrapper = nameActiveParent + this.get('sectionWrapperClass'),
				parent_section,
				data_sources = [
					'data_calls_section', 	//Level3 // initial, process, result
					'data_calls_result', 	//Level4 // success, fail
					'data_step', 			//Level5 // 1, 2, 3
					'data_user_message' 	//Level7 // 1, 2, 3
				],
				// it (probably) will be reduced later
				data_sources_children = data_sources,
				errorMsg;

			try {
				if(test) console.groupCollapsed('%cSee handleActiveSection', 'font-size:18px; background-color: #666; color: white; padding: 4px 6px; border-radius:4px');

				// commonly it should be the Wrapper (#window-[alias])
				if (typeof value == 'object') {
					if(test) console.log('the value is %cobject', 'color:violet');
					// get DOM object
					this.setParamsValues(name, value);
					// рокировочка
					if(test) console.log({parent_section:value});
					this.handleBlocksTree(value, data_sources);
				} else {

					var // ♥ convert symbols in coming value to search in the array
						under_name = name.replace(/\-/g, '_'), // data_step => data-step
						// get @name index in @data_sources array
						index = _.indexOf(data_sources, under_name),
						// ♥ Next we need a previous element's index as a parent
						// in order to set it as superior block to compound the
						// ♥ appropriate selector like $(element, parent) will be set later
						parent_index = index - 1; // index for a probable parent element
					if(test) console.log({
						index: index,
						parent_index: parent_index,
						'data_sources[parent_index]': data_sources[parent_index],
						data_sources: data_sources,
						name: name
					});
					/** Extract parent block
					In this segment we just need to get nameActiveParent value
					which is the name for [data_*] (look at active.* params)
					if there are no parents within @data_sources array up to
					this moment */
					if (parent_index == -1) {
						// get the the Wrapper itself (choice, call etc)
						nameActiveParent = nameActiveParentWrapper; // active.section-wrapper
						if(test) console.log('%cNo appropriate @data_source element was found. The Parent will be set AS %cactive.section-wrapper', 'color:red', 'font-weight: bold');
					} else { // otherwise (may be parent exists)
						if(test) console.log('%c@data_source element exists; getting the nameActiveParent...', 'color:rebeccapurple; font-weight: bold');
						/**
					 	try to get it
						Up to this moment parent_index was reduced by 1 (look at the
					 	initialization time for this variable). */
						nameActiveParent += this.get(data_sources[parent_index]); // active.data-step
						// reduce array from the @name index in order to
						// handle as active.* elements all following child ones
						data_sources_children = data_sources.slice(index);
						if(test) console.log({
							'1. parent_index': parent_index,
							'2. nameActiveParent': nameActiveParent,
							'3. data_sources': data_sources,
							'4. data_sources_children': data_sources_children
						});
					}
					// Check if the parent exists and reach it anyway
					if(!( parent_section = this.get(nameActiveParent))
						&& parent_index != -1){
						if(test) console.log('%cNo data_source element of ['+nameActiveParent+']. Parent index: '+parent_index+'... Trying go above...', 'background-color: lightyellow; padding:6px; border-radius:4px; color:darkred; text-decoration: underline font-size: 16px; line-height: 1.5;');
						if(test) console.log({
							'1. parent_index': parent_index,
							'2. parent_section': parent_section
						});
						// because parent_index already been unsuccessfully used above
						parent_index--;
						if(parent_index==-1){
							nameActiveParent = nameActiveParentInit+this.get('sectionWrapperClass');
							parent_section = this.get(nameActiveParent);
							if(test) console.group('Group1');
							if(test) console.log({
								'1. parent_index': parent_index,
								'2. nameActiveParent': nameActiveParent,
								'3. parent_section': parent_section
							}); console.groupEnd();
						}else{ // info: set to 0
							if(test) console.group('Group2');
							while(parent_index>=0){
								/**
							 	░ NOTICE: here we use the initial (not reduced!) array
							 	@data_sources because we need to go above through it from
							 	the target element in order to find its parent */
								nameActiveParent = nameActiveParentInit + this.get(data_sources[parent_index]);
								if(test) console.log({
									'1. parent_index': parent_index,
									'2. nameActiveParent': nameActiveParent,
									'3. parent_section': parent_section,
									'4. data_sources[parent_index]': data_sources[parent_index],
									'5. data_sources': data_sources,
									'6. data_sources_children': data_sources_children
								});
								/**
							 	Try to get a parent section. If succeed, leave the loop.
							 	Otherwise, further will make a last attempt, meaning to
							 	assign the Top Wrapper as it */
								if(parent_section = this.get(nameActiveParent)) {
									//
									if(test) console.log('%cparent_section is found!', 'background-color:#33f; color:lightskyblue; font-size:15px; padding:4px 6px;');
									if(test) console.log({
										'1. parent_section': parent_section,
										'2. data_sources': data_sources,
										'3. data_sources_children': data_sources_children
									});
									break;
								}
								parent_index--;
							} if(test) console.groupEnd();
						}
						if(!parent_section) {
							if(test) console.log('Parent_section is still %cnot found! ... trying to get and apply Top Wrapper (active.section-wrapper)', 'color:red; font-weight: bold; font-size: 17px;');
							if(!(parent_section = this.get(nameActiveParentWrapper))){
								errorMsg='Critical error!\nAll attempts to get the Parent for the current target element have failed!';
								alert(errorMsg+'\nExecution of the script will be aborted.');
								if(test) console.log(errorMsg, 'color:red; font-weight: bold; font-size: 17px;');
								return false;
							}
						}
					} // object
					if(test) console.log({
						'1. nameActive': nameActiveParent,
						'2. parent_section': parent_section,
						'3. data_sources': data_sources,
						'4. data_sources_children': data_sources_children
					});
					/** NOTICE!
					 * 1. The difference between blocks is that in the second case
					 * we don't call the set method for the incoming object in this
					 * function, leaving it to be implemented within the
					 * handleBlocksTree() method
					 * 2. Up to this time the data_sources is handled, having the
					 * target object which came as @name on the top of that array
					 * */
					this.handleBlocksTree(parent_section, data_sources_children, value);
					// so current block is parent for other
				}
				if(test) console.groupEnd();
			} catch (e) {
				alert(e.message);
			}
		},
		/**
		 * Walk through all visible child node to save them as active params
		 * @param parent_section
		 * @param children_sections_array
		 * @params param_value
		 */
		handleBlocksTree: function (parent_section, children_sections_array, param_value) { // top_block
			trc('MultiwidgetModel.handleBlocksTree', [true, parent_section, children_sections_array, param_value]);
			console.groupCollapsed('%cSee handleBlocksTree', 'font-size:16px; background-color: #999; color: white; padding: 3px 5px; border-radius:4px');

			console.log('%cinit calling', 'color: blue');

			var $this = this;

			//*************************************
			var dataArray =['section-wrapper',
					'data-calls-section',
					'data-calls-result',
					'data-step',
					'data-user-message'
				],
				debug_data_value;
				//, noData = '<span class="weak">null</span>';

			// dev: hide/remove on production
			var setTestData = function(prefix, pre_prefix){
				trc('MultiwidgetModel.handleBlocksTree.setTestData', [true, prefix, pre_prefix], 'violet');
				console.group('%cCheck Model params','color:navy; font-size:22px;');
				var debugData=[], debug_selector, element, raw_element;
					if(pre_prefix) prefix = pre_prefix+prefix;
				_.each(dataArray, function(selector){
					if(raw_element = $this.get(prefix+'.'+selector))
						element = raw_element;

					if(element){
						if(selector=="section-wrapper")
							debug_data_value=element.id;
						else debug_data_value=element.getAttribute(selector);
					}else
						debug_data_value=null;
					// selector
					debug_selector = prefix+'_'+selector;
					// DOM-element
					debugData.push([debug_selector,debug_data_value]);
					//
					/*console.log({
						'1. prefix': prefix,
						'2. debug_selector': debug_selector,
						'3. debug_data_value': debug_data_value,
						'4. selector': selector,
						'5. data selector': prefix+'.'+selector
					});*/
				});
				$this.set('debug_state', null);
				$this.set('debug.'+prefix, debugData);
				$this.set('debug_state', prefix);
				console.groupEnd();
			};

			setTestData('prev', 'old-');

			var invisibleClass = this.get('invisibleClass'),
				getSelectorData = this.get('getSelectorData'),
				/**
				 *
				 * @param parent_section
				 * @param children_sections
				 * @param selector_data_param
				 * @param i
				 * @param j
				 */
				handleBlocks = function (parent_section, children_sections, selector_data_param, i, j) {
					if (!i) i = 0;
					if (!j) j = children_sections.length;
					trc('MultiwidgetModel.handleBlocks', [true, parent_section, children_sections, selector_data_param, i, j]);
					//console.log('%ccalling # ' + i, 'color: violet');
					var // data_calls_section, data_calls_result, data_step, data_user_message
						selector_query = $this.get(children_sections[i]),
						// ▲ data-calls-section, data-calls-result, data-step, data-user-message
						/**
						 * first, we need to select the target block with selector_data_param being passed
						 * then we get all inner blocks by default, i.e. those
						 * that don't have the "invisible" class. They will be assigned
						 * as "active.*" blocks */
						selector = (selector_data_param) ?
							// will implemented once.
							// ▼ It gets selector like [data-[string]=selector_data_param]
							getSelectorData(selector_query, selector_data_param) :
							// ▼ will implemented after the initial running.
							// ▼ It gets selector like [data-[string]]:not(.invisible)
							getSelectorData(selector_query, false, '.' + invisibleClass),
						current_section = $(selector, parent_section)[0];
					//console.log('%cselector: '+selector, 'background-color:orange; opacity:0.5');

						/*console.log({
							'0. i': i,
							'1. invisibleClass': invisibleClass,
							'2. selector': selector,
							'3. parent_section': {
								'1.object': parent_section,
								'2.text': $(parent_section).text(),
								'3.html': $(parent_section).html()
							},
							'4. child_section': {
								'1.object': current_section,
								'2.text': $(current_section).text(),
								'3.html': $(current_section).html()
							}
						});*/
					if (!current_section) console.log('%ccurrent_section не обнаружена, вместо неё будет использована parent_section', 'text-decoration:underline');
					i++;
					//
					$this.setParamsValues(selector_query, current_section);
					if (i < j) handleBlocks((current_section || parent_section), children_sections, false, i, j);
				};

			console.log('Value to pass to handleBlocksTree(): %c' + param_value, 'color:brown; font-weight: bold');
			handleBlocks(parent_section, children_sections_array, param_value, null, null);

			setTestData('prev');
			setTestData('active');

			console.groupEnd();
		},
		/**
		 * Define default active params chain
		 */
		initHierarchy: function (blocksLevel1) {
			trc('MultiwidgetModel.initHierarchy', [true, blocksLevel1]);
			var Wrappers = blocksLevel1 || this.get('blocksLevel1'),
				wrapperClass = this.get('sectionWrapperClass'), // section-wrapper
				wrapperSection = $(Wrappers).has('.default')[0];
			console.groupCollapsed('initHierarchy show');
			console.log({
				'1. Wrappers': Wrappers,
				'2. wrapperSection': wrapperSection,
				'3. wrapperClass': wrapperClass,
				'4. WrappersInTime': {
					'1. prev': this.get('prev.' + wrapperClass),
					'2. active': this.get('active.' + wrapperClass)
				},
				'5. blocksLevel1': this.get('blocksLevel1')
			});
			console.groupEnd();
			/**
			 * 1. set active. and prev. Wrapper (.section-wrapper)
			 * 2. will make all the hierarchy chain for active.*
			 */
				// clarify: нужно ли нам вообще извлекать алиас?
			this.handleActiveSection( // ([prev/active].)section-wrapper
				wrapperClass,
				// #window-choice.section-wrapper.default
				wrapperSection);
		},
		/**
		 * set active.* values equal to default.* values
		 */
		setToDefault: function (def1, def2) {
			trc('MultiwidgetModel.setToDefault', [true, def1, def2]);
			// get only attributes which names have the "default." substring
			var attributes = _.filter(_.keys(this.attributes), function (def_key) {
					return def_key.indexOf(def1 + '.') != -1; // default or active
				}),
				key_val;
			// set values of filtered attributes to the those which names have the "active." substring
			_.each(attributes, function (key) {
				key_val = key.substring(key.indexOf('.') + 1);
				this.set(def2 + '.' + key_val, this.get(key)); // active or default
				//console.log(def2+'.'+key_val+' set to '+this.get(key));
			}, this);
			this.set('model_state', 'default');
			// console.log({attributes: this.attributes});
		},
		/**
		 *
		 * @param name
		 * @param value
		 * @param nameActive
		 */
		setParamsValues: function (name, value) {
			trc('MultiwidgetModel.setParamsValues', [true, name, value]);
			var test=false;
			try {
				if(test) console.groupCollapsed('%cChange param in setParamsValues', 'color:green; font-size:16px;');

				var nameActive = 'active.' + name,
					namePrev = 'prev.' + name;

				var incomingName = name,
					incomingValue = value,
					oldPrevObject = this.get(namePrev),
					oldActiveObject = this.get(nameActive),
					oldModelState = this.get('model_state');


				if (!value) value = null;

				if(test) console.log('%c' + name, 'background-color:yellow; padding:4px 6px; font-family:Verdana');
				if(test) console.log(namePrev + ' %cshould %cchange to %c' + oldActiveObject, 'color: darkred; font-weight: bold; ', 'color: violet', 'color:brown');

				// save a previous value
				this.set(namePrev, this.get(nameActive));

				var newPrevObject = this.get(namePrev);
				if(test){
					console.groupCollapsed('≡ check new prev value');
					console.log(newPrevObject ? newPrevObject.outerHTML : newPrevObject);
					console.log('%cequal? ' + (newPrevObject == oldActiveObject), 'font-size:16px; color: green;');
					console.groupEnd();

					console.log(nameActive + ' %cshould %cchange to %c' + value, 'color: darkred; font-weight: bold; ', 'color: violet', 'color:brown');
				}

				// set a new value
				this.set(nameActive, value); //console.dir(this.changed);

				var newActiveObject = this.get(nameActive);
				if(test){
					console.groupCollapsed('≡ check new active value');
					console.log(newActiveObject ? newActiveObject.outerHTML : newActiveObject);
					console.log('%cequal? ' + (value == newActiveObject), 'font-size:16px; color: rebeccapurple');
					console.groupEnd();
				}
				this.set('model_state', name + ':' + value);

				if(test){
					// dev:
					console.log({
						'0. incomingName': incomingName,
						'0. incomingValue': incomingValue,
						'1. prev.Old': {
							object: oldPrevObject,
							text: $(oldPrevObject).text(),
							html: $(oldPrevObject).html()
						},
						'2. prev.Current': {
							object: newPrevObject,
							text: $(newPrevObject).text(),
							html: $(newPrevObject).html()
						},
						'3. active.Old': {
							object: oldActiveObject,
							text: $(oldActiveObject).text(),
							html: $(oldActiveObject).html()
						},
						'4. active.Current': {
							object: newActiveObject,
							text: $(newActiveObject).text(),
							html: $(newActiveObject).html()
						},
						oldModelState: oldModelState,
						newModelState: this.get('model_state'),
						currentAttributes: this.attributes
					});
				}
				if(test) console.groupEnd();
				// Drop old value
				// because a previous value may be the same (data-step=>data-step)
				// while the content of the real object may be complitely different
				this.set('DomElementValue', null);
				// set current value
				// it is used in MultiWidget.switchWidgetSections()
				this.set('DomElementValue', name);
				if(test) console.log('%cDomElementValue => ' + name, 'font-size: 14px');

			} catch (e) {
				alert(e.message);
			}
		}
	});
})(window.Application, jQuery);