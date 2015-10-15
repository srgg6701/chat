//==============================================================================
//
//  Widget view
//
//==============================================================================

(function(app, $, config)
{
    var WidgetView = app.WidgetView = Backbone.View.extend({
    
        events : {
        
            // Login form
            
            'click #customer-chat-login-start'                : 'login',
            'keydown #customer-chat-content-login-form input' : 'loginOnEnter',
            
            // Chat box
            
            'click #customer-chat-button-toggle'                : 'toggle',
            'click #customer-chat-button-close'                 : 'close',
            'click #customer-chat-button-settings'              : 'toggleSettings',
            'click .customer-chat-content-message-emots-button' : 'toggleEmoticons',
            'click .customer-chat-toggle-sound'                 : 'toggleSetting',
            'click .customer-chat-toggle-scroll'                : 'toggleSetting',
            'click .customer-chat-toggle-emots'                 : 'toggleSetting',
            'click .customer-chat-toggle-show'                  : 'toggleSetting',
            'click #customer-chat-toggle-fs'                    : 'toggleFullscreen',
            'click #customer-chat-action-end-chat'              : 'endChat',
            'click #customer-chat-action-end-chat-confirm'      : 'endChatConfirm',
            'click #customer-chat-action-end-chat-cancel'       : 'endChatCancel',
            'click .customer-chat-emoticon'                     : 'addEmoticon',
            'keydown #customer-chat-message-input'              : 'messageTyping',
            'click   #chat-send-button'                         : 'sendMessage',
            
            // Contact form
            
            'click #customer-chat-contact-send' : 'sendContactMessage',
            
            // Information
            
            'click #customer-chat-info-back' : 'showPrevState'
        },
        
        initialized        : false,
        visible            : false,
        state              : '',
        prevState          : '',
        titleBlinking      : false,
        typingInfoBlinking : false,
        emotsVisible       : false,
        
        initialize : function()
        {
            trc('WidgetView.initialize');
            // Initialize models
            console.log('%cWidgetView initialized!', 'color: darkblue; font-size:18px; background-color: #ddd; padding: 3px 5px;');
            this.settings = app.model.settings;
            
            // Create sub views
            
            this.loginForm    = new app.LoginFormView         ({ el : this.$('#customer-chat-content-login-form')   });
            this.chatBox      = new app.ChatBoxView           ({ el : this.$('.customer-chat-content-messages')     });
            this.contactForm  = new app.ContactFormView       ({ el : this.$('#customer-chat-content-contact-form') });
            this.selectAvatar = new app.SelectAvatarInlineView({ el : this.$('#customer-chat-select-avatar'), model : config.defaultAvatars });
            
            // Cache view components
            
            this.$window              = $(window);
            this.$html                = $('html');
            this.$header              = this.$('.customer-chat-header');
            this.$title               = this.$('.customer-chat-header-title');
            this.$mobileTitle         = $('#mobile-widget i');
            this.$toggleBtn           = this.$('#customer-chat-button-toggle');
            this.$settingsBtn         = this.$('#customer-chat-button-settings');
            this.$settings            = this.$('.customer-chat-header-menu');
            this.$typingInfo          = this.$('.typing-indicator');
            this.$emoticons           = this.$('.customer-chat-emots-menu');
            this.$input               = this.$('#customer-chat-message-input');
            this.$contactName         = this.$('#customer-chat-contact-name');
            this.$contactMail         = this.$('#customer-chat-contact-mail');
            this.$contactMessage      = this.$('#customer-chat-contact-message');
            this.$loginName           = this.$('#customer-chat-login-name');
            this.$loginMail           = this.$('#customer-chat-login-mail');
            this.$info                = this.$('#customer-chat-info-text');
            this.$toggleSound         = this.$('.customer-chat-toggle-sound');
            this.$toggleScroll        = this.$('.customer-chat-toggle-scroll');
            this.$toggleEmots         = this.$('.customer-chat-toggle-emots');
            this.$toggleShow          = this.$('.customer-chat-toggle-show');
            this.$endChat             = this.$('#customer-chat-action-end-chat');
            this.$endChatConfirmation = this.$('#customer-chat-action-end-chat-confirmation');
            this.$endChatConfirm      = this.$('#customer-chat-action-end-chat-confirm');
            
            // Set the initial state
            
            this.showLoading();
            
            // Check if operators are on-line/off-line
            
            this.model.once('operators:online',  this.autoLogin,   this);
            this.model.once('operators:offline', this.showContact, this);
            
            // Handle on-line/off-line visibility
            
            this.model.once('operators:online', function()
            {
                this.postMessage('show');
                
                this.initialized = true;
                
            }, this);
            
            this.model.once('operators:offline', function()
            {
                if(!this.initialized && config.ui.hideWhenOffline === 'true')
                {
                    this.postMessage('hide');
                }
                else
                {
                    this.postMessage('show');
                }
            
            }, this);
            
            // Disable default link elements functionality for buttons
            
            this.$('a[href="#"]').click(function(e) { e.preventDefault(); });
            
            // Handle logging in / out
            
            this.model.on('login:success',  this.showChat,        this);
            this.model.on('login:login',    this.showLogin,       this);
            this.model.on('login:error',    this.showLoginError,  this);
            this.model.on('logout:init',    this.onLogout,        this);
            this.model.on('logout:success', this.onLogoutSuccess, this);
            this.model.on('logout:error',   this.onLogoutError,   this);
            
            // Handle last & new messages
            
            this.model.once('messages:last', this.handleLastMessages, this);
            this.model.on  ('messages:new',  this.handleMessages,     this);
            
            // Handle typing status
            
            this.model.on('operator:typing', this.handleOperatorTyping, this);
            
            // Handle settings
            
            this.settings.on('change', this.renderSettings, this);
            
            this.renderSettings();
            
            // Handle frames communication
            
            this.initFramesCommunication();
            
            // Start up
            
            this.model.checkOperators();
            
            // Store widget's properties
            
            this.storeProperties();
            
            // Show if it's the mobile version
            
            if(config.mobile) this.toggle();
        },
        
        setState : function(state)
        {   trc('WidgetView.setState', [true, state]);
            // Return if it's the current state
            
            if(this.state == state)
            {
                return;
            }
            
            // Store the new state
            
            this.state = state;
            
            // Show appropriate view
            
            this.$el.removeClass('login-form chat-box contact-form loading-screen info-screen');
            
            switch(state)
            {
                case 'loading':
                    this.$el.addClass('loading-screen');
                    this.$title.html(config.ui.loadingLabel);
                break;
                
                case 'chat':
                    this.$el.addClass('chat-box');
                    this.$title.html(config.ui.chatHeader);
                    
                    // Add last messages to the chat
                    
                    for(var i = 0; i < this.model.lastMessages.length; i++)
                    {
                        var msgData = this.model.lastMessages[i];
                        
                        var message = new app.MessageModel({
                        
                            authorType : msgData.authorType,
                            author     : msgData.authorType === 'guest' ? msgData.author : this.model.getOperatorName(msgData.from_id),
                            body       : msgData.body,
                            time       : new Date(msgData.datetime)
                        });
                        
                        // Add message to the chat box
                        
                        this.chatBox.addMessage(message, true);
                    }
                    
                    this.prevState = state;
                break;
                
                case 'login':
                    this.$el.addClass('login-form');
                    this.$title.html(config.ui.chatHeader);
                    this.fullscreenOff();
                    
                    this.prevState = state;
                break;
                
                case 'contact':
                    this.$el.addClass('contact-form');
                    this.$title.html(config.ui.contactHeader);
                    this.fullscreenOff();
                    
                    this.prevState = state;
                break;
                
                case 'info':
                    this.$el.addClass('info-screen');
                break;
            }
        },
        
        toggle : function()
        {   trc('WidgetView.toggle');
            var bottom;
            
            if(this.visible) // Hide
            {
                // Store widget's properties
                
                this.storeProperties();
                this.prevFullscreen = this.fullscreen;
                
                // Exit fullscreen mode
                
                this.fullscreenOff();
                
                // -----
                
                this.$el.removeClass('customer-chat-visible');
                
                // Hide menus
                
                this.$settings.hide();
                this.$emoticons.hide();
                
                // -----
                
                bottom = this.headerHeight - this.frameHeight;
            }
            else // Show
            {
                this.$el.addClass('customer-chat-visible');
                this.stopTitleBlink();
                
                bottom = 0;
                
                // Go fullscreen if it was the previous state
                
                if(this.prevFullscreen) this.fullscreenOn();
            }
            
            this.postMessage('animate|bottom=' + bottom + '');
            
            this.visible = !this.visible;
        },
        
        toggleFullscreen : function()
        {   trc('WidgetView.toggleFullscreen');
            if(this.fullscreen) this.fullscreenOff();
            else                this.fullscreenOn();
        },
        
        fullscreenOn : function()
        {   trc('WidgetView.fullscreenOn');
            this.storeProperties();
            
            this.$html.addClass('fs');
            this.postMessage('animate|width=100%,height=100%,right=0');
            
            this.fullscreen = true;
        },
        
        fullscreenOff : function()
        {   trc('WidgetView.fullscreenOff');
            this.$html.removeClass('fs');
            this.postMessage('animate|width=' + this.frameWidth + 'px,height=' + this.frameHeight + 'px,right=' + this.frameOffset, 'px');
            
            this.fullscreen = false;
        },
        
        close : function()
        {   trc('WidgetView.close');
            if(history.length > 1) history.back();
            else
            {
                window.open('', '_self');
                window.close();
            }
        },
        
        autoLogin : function()
        {   trc('WidgetView.autoLogin');
            // Show loading screen
            
            this.showLoading();
            
            // Check if user is already logged in
            
            this.model.autoLogin();
        },
        
        login : function()
        {   trc('WidgetView.login');
            this.manualLogin = true;
            
            // Get the input
            
            var input = {
            
                name  : this.$loginName.val(),
                mail  : this.$loginMail.val(),
                image : this.selectAvatar.selected
            };
            
            // Return if form is not valid
            
            if(!this.loginForm.isValid())
            {
                return;
            }
            
            // Show loading screen
            
            this.showLoading();
            
            // Send the login request
            
            this.model.login(input);
        },
        
        loginOnEnter : function(e)
        {   trc('WidgetView.loginOnEnter', [true, e]);
            if(e.which === 13) // ENTER
            {
                this.login();
            }
        },
        
        toggleSettings : function()
        {   trc('WidgetView.toggleSettings');
            // Disable if hidden
            
            if(!this.visible)
            {
                return;
            }
            
            // Toggle menu
            
            if(this.$settings.is(':visible'))
            {
                this.$settings.fadeOut('fast');
                
                // Hide logout confirmation

                this.$endChatConfirmation.hide();
                this.$endChat.show();
            }
            else
            {
                this.$settings.fadeIn('fast');
            }
        },
        
        toggleEmoticons : function()
        {   trc('WidgetView.toggleEmoticons');
            if(this.emotsVisible) this.hideEmoticons();
            else                  this.showEmoticons();
        },
        
        showEmoticons : function()
        {   trc('WidgetView.showEmoticons');
            // Hide settings menu
            
            this.$settings.fadeOut('fast');
            
            this.emotsVisible = true;
            
            this.$emoticons.fadeIn('fast');
            
            var _this = this;
            
            setTimeout(function()
            {
                $('html, body').bind('click.hideemots', $.proxy(_this.hideEmoticons, _this));
            }, 10);
        },
        
        hideEmoticons : function()
        {   trc('WidgetView.hideEmoticons');
            this.emotsVisible = false;
            
            $('html, body').unbind('.hideemots');
            
            this.$emoticons.fadeOut('fast');
        },
        
        toggleSetting : function(evt)
        {   trc('WidgetView.toggleSetting', [true, evt]);
            var $option = $(evt.currentTarget);
            
            // Get setting's name
            
            var settingName = $option.attr('id').split('customer-chat-setting-toggle-')[1];
            
            // Update the setting
            
            this.settings.set(settingName, !this.settings.get(settingName));
        },
        
        endChat : function()
        {   trc('WidgetView.endChat');
            // Show confirmation
            
            this.$endChat.hide();
            this.$endChatConfirmation.show();
        },
        
        endChatCancel: function()
        {   trc('WidgetView.endChatCancel');
            // Hide confirmation
            
            this.$endChatConfirmation.hide();
            this.$endChat.show();
        },
        
        endChatConfirm : function()
        {   trc('WidgetView.endChatConfirm');
            // Hide confirmation
            
            this.$endChatConfirmation.hide();
            this.$endChat.show();
            
            // Hide the menu
            
            this.$settings.hide();
            
            // Clear the chatbox & login form
            
            this.chatBox.clear();
            
            this.$loginName.val('');
            this.$loginMail.val('');
            
            // Logout
            
            this.model.logout();
        },
        
        renderSettings : function()
        {   trc('WidgetView.renderSettings');
            // Update view according to the model
            
            this.settings.get('sound')  ? this.$toggleSound .removeClass('customer-chat-disabled') : this.$toggleSound .addClass('customer-chat-disabled');
            this.settings.get('scroll') ? this.$toggleScroll.removeClass('customer-chat-disabled') : this.$toggleScroll.addClass('customer-chat-disabled');
            this.settings.get('emots')  ? this.$toggleEmots .removeClass('customer-chat-disabled') : this.$toggleEmots .addClass('customer-chat-disabled');
            this.settings.get('show')   ? this.$toggleShow  .removeClass('customer-chat-disabled') : this.$toggleShow  .addClass('customer-chat-disabled');
        },
        
        addEmoticon : function(evt)
        {   trc('WidgetView.addEmoticon', [true, evt]);
            var $emot = $(evt.currentTarget);
            
            this.$input.val(this.$input.val() + ' ' + $emot.data('emot') + ' ');
            
            // Set focus on the input
            
            if(!config.mobile) this.$input.focus();
            
            // Hide emoticons menu
            
            this.$emoticons.fadeOut('fast');
        },
        
        handleMessages : function(messages)
        {   trc('WidgetView.handleMessages', [true, messages]);
            // Add messages to the chat
            
            for(var i = 0; i < messages.length; i++)
            {
                var msgData = messages[i];
                
                msgData.authorType = 'operator';
                msgData.author     = this.model.getOperatorName(msgData.from_id);
                
                var message = new app.MessageModel(msgData);
                
                message.fromUser = msgData.from_user_info;
                
                // Add message to the chat box
                
                this.chatBox.addMessage(message);
            }
            
            // Play notification sound
            
            if(this.settings.get('sound')) app.service.soundPlayer.play('message');
            
            // Show the widget and notify visually
            
            if(!this.visible)
            {
                if(this.settings.get('show')) this.toggle();
                else                          this.startTitleBlink();
            }
            
            if(this.$mobileTitle.is(':visible'))
            {
                this.stopTitleBlink();
                this.startTitleBlink();
            }
            
            // Hide typing indicator
            
            setTimeout($.proxy(this.stopTypingInfoBlink, this), 1);
        },
        
        handleLastMessages : function(messages)
        {   trc('WidgetView.handleLastMessages', [true, messages]);
            // Add last messages to the chat
            
            for(var i = 0; i < messages.length; i++)
            {
                var message = new app.MessageModel(messages[i]);

                // Add message to the chat box
                
                this.chatBox.addMessage(message, true);
            }
        },
        
        messageTyping : function(evt)
        {   trc('WidgetView.messageTyping', [true, evt]);
            // Handle typing status
            
            this.handleTyping();
            
            // React only to the ENTER key
            
            if(evt.keyCode !== 13 || evt.shiftKey)
            {
                return;
            }
            
            this.sendMessage();
        },
        
        sendMessage : function()
        {   trc('WidgetView.sendMessage');
            var body = $.trim(this.$input.val());
            
            // Do nothing if there's no input
            
            if(body.length == 0)
            {
                return;
            }
            
            var message = new app.MessageModel({
            
                author     : this.model.get('name'),
                authorType : 'guest',
                body       : body,
                time       : new Date(),
                
                from_user_info : { image : this.model.get('image') }
            },
            {
                localMessage : true
            });
            
            // Send the message
            
            this.model.sendMessage(message);
            
            // Add message to the chat box
            
            this.chatBox.addMessage(message, true);
            
            // Clear the input field
            
            this.$input.val('');
        },
        
        handleTyping : function()
        {   trc('WidgetView.handleTyping');
            this.model.updateTypingStatus();
        },
        
        handleOperatorTyping : function()
        {   trc('WidgetView.handleOperatorTyping');
            this.startTypingInfoBlink();
            
            // Hide automatically later
            
            if(this.stopTypingBlinkTimer) clearTimeout(this.stopTypingBlinkTimer);
            
            this.stopTypingBlinkTimer = setTimeout($.proxy(this.stopTypingInfoBlink, this), WidgetView.TYPING_STATUS_TIME);
        },
        
        sendContactMessage : function()
        {   trc('WidgetView.sendContactMessage');
            // Get the input
            
            var input = {
            
                name     : this.$contactName.val(),
                mail     : this.$contactMail.val(),
                question : this.$contactMessage.val()
            };
            
            // Return if form is not valid
            
            if(!this.contactForm.isValid())
            {
                return;
            }
            
            // Send question from the contact form
            
            var _this = this;
            
            $.post(config.contactPath, input, function(data)
            {
                if(data.success)
                {
                    // Clear the form fields
                    
                    _this.contactForm.reset();
                    
                    _this.showInfo(config.ui.contactSuccessMessage, config.ui.contactSuccessHeader);
                }
                else
                {
                    _this.showInfo(config.ui.contactErrorMessage, config.ui.contactErrorHeader)
                }
            });
            
            this.showLoading();
        },
        
        startTitleBlink : function()
        {   trc('WidgetView.startTitleBlink');
            this.titleBlinking = true;
            
            this.blinkTitle();
        },
        
        blinkTitle : function()
        {   trc('WidgetView.blinkTitle');
            if(!this.titleBlinking)
            {
                return;
            }
            
            var _this = this;
            
            this.$mobileTitle.fadeOut('slow');
            this.$title.fadeOut('slow', function()
            {
                _this.$mobileTitle.fadeIn('slow');
                _this.$title.fadeIn('slow', function()
                {
                    _this.blinkTitle();
                });
            });
        },
        
        stopTitleBlink : function()
        {   trc('WidgetView.stopTitleBlink');
            this.titleBlinking = false;
        },
        
        startTypingInfoBlink : function()
        {   trc('WidgetView.startTypingInfoBlink');
            if(!this.typingInfoBlinking)
            {
                this.typingInfoBlinking = true;
                this.blinkTypingInfo();
            }
        },
        
        blinkTypingInfo : function()
        {   trc('WidgetView.blinkTypingInfo');
            if(!this.typingInfoBlinking)
            {
                return;
            }
            
            var _this = this;
            
            this.$typingInfo.fadeIn('slow', function()
            {
                _this.$typingInfo.fadeOut('slow', function()
                {
                    _this.blinkTypingInfo();
                });
            });
        },
        
        stopTypingInfoBlink : function()
        {   trc('WidgetView.stopTypingInfoBlink');
            this.typingInfoBlinking = false;
        },
        
        showLogin : function()
        {   trc('WidgetView.showLogin');
            this.setState('login');
            
            // Handle welcome message (only after initial login)
            
            this.model.once('login:success', this.showWelcomeMessage, this);
        },
        
        showLoginError : function()
        {   trc('WidgetView.showLoginError');
            this.showInfo(config.ui.loginError);
        },
        
        onLogout : function()
        {   trc('WidgetView.onLogout');
            // Wait for success response
            
            this.showLoading();
        },
        
        onLogoutSuccess : function()
        {   trc('WidgetView.onLogoutSuccess');
            // Initialize the chat again
            
            this.showLogin();
            this.model.checkOperators();
        },
        
        onLogoutError : function()
        {   trc('WidgetView.onLogoutError');
            // Initialize the chat again
            
            this.showLogin();
            this.model.checkOperators();
        },
        
        showWelcomeMessage : function()
        {   trc('WidgetView.showWelcomeMessage');
            // Create the message
            
            var message = new app.MessageModel({

                authorType : 'operator',
                author     : config.ui.initMessageAuthor,
                body       : config.ui.initMessageBody,
                time       : new Date()
            });
            
            // Add message to the chat box

            this.chatBox.addMessage(message);
        },
        
        showChat : function()
        {   trc('WidgetView.showChat');
            this.setState('chat');
            
            // For mobile devices, refresh the page
            
            if(this.manualLogin && config.mobile) window.location.reload();
        },
        
        showContact : function()
        {   trc('WidgetView.showContact');
            this.setState('contact');
        },
        
        showLoading : function()
        {   trc('WidgetView.showLoading');
            this.setState('loading');
        },
        
        showInfo : function(text, title)
        {   trc('WidgetView.showInfo', [true, text, title]);
            this.$info.html(text);
            this.$title.html(title);
            
            this.setState('info');
        },
        
        showPrevState : function()
        {   trc('WidgetView.showPrevState');
            this.setState(this.prevState);
        },
        
        storeProperties : function()
        {   trc('WidgetView.storeProperties');
            if(!this.fullscreen)
            {
                this.headerHeight = this.$header.height();
                
                var _this = this;
                
                this.postMessage('get.properties', function(data)
                {
                    var p = data.split(',');
                    
                    _this.frameWidth  = parseInt(p[0]);
                    _this.frameHeight = parseInt(p[1]);
                    _this.frameOffset = parseInt(p[2]);
                    
                });
            }
        },
        
        postMessage : function(data, callback)
        {   trc('WidgetView.postMessage', [true, data, callback]);
            window.parent.postMessage(data, '*');
            
            if(callback)
            {
                var $window = $(window);
                var id      = Math.floor(new Date().getTime() * Math.random());
                
                $window.bind('message.' + id, function(evt)
                {
                    var parts = evt.originalEvent.data.split(':');
                    
                    if(parts[0] === data) callback(parts[1]);
                    
                    $window.unbind('message.' + id);
                });
            }
        },
        
        initFramesCommunication : function()
        {   trc('WidgetView.initFramesCommunication');
            var _this = this;
            
            this.$window.bind('message', function(evt)
            {
                if(!evt.originalEvent.data) return;
                
                var parts = evt.originalEvent.data.split(':');
                
                if     (parts[0] === 'state.mobile')  _this.$html.addClass   ('mobile-widget');
                else if(parts[0] === 'state.desktop') _this.$html.removeClass('mobile-widget');
            });
        }
    },
    {
        TYPING_STATUS_TIME : 2000,
        ANIMATION_TIME     :  400
    });

})(window.Application, jQuery, window.chatConfig);