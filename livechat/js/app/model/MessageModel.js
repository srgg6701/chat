//==============================================================================
//
//  Single chat message
//
//==============================================================================

(function(app, config)
{
    app.MessageModel = Backbone.Model.extend({
    
        defaults : {
            
            author       : '',
            body         : '',
            toAuthor     : 'all',
            toAuthorMail : ''
        },
        
        initialize : function(attributes, options)
        {   trc('MessageModel.initialize', [true, attributes, options]);
            this.options = options || {};
            
            // Initialize fields if stored as server-side data
            
            if(attributes)
            {
                if(attributes.datetime) this.set('time', new Date(attributes.datetime.replace(/-/g,"/")));
                
                if(typeof attributes.from_user_info === 'string' && attributes.from_user_info !== 'all')
                {
                    try      { attributes.from_user_info = JSON.parse(attributes.from_user_info); }
                    catch(e) { /* Do nothing... */}
                }
                
                if(typeof attributes.from_user_info === 'object')
                {
                    var fromUser = attributes.from_user_info;
                    
                    this.fromUser = fromUser;
                    
                    if(this.get('author').length === 0) this.set('author',     fromUser.name);
                    if(!this.has('authorMail'))         this.set('authorMail', fromUser.mail);
                }
                
                if(typeof attributes.to_user_info === 'string' && attributes.to_user_info !== 'all')
                {
                    try      { attributes.to_user_info = JSON.parse(attributes.to_user_info); }
                    catch(e) { /* Do nothing... */}
                }
                
                if(typeof attributes.to_user_info === 'object')
                {
                    var toUser = attributes.to_user_info;
                    
                    this.toUser = toUser;
                    
                    this.set('toAuthor',     toUser.name);
                    this.set('toAuthorMail', toUser.mail);
                }
                
                // ...
            }
        },
        
        getAge : function()
        {   trc('MessageModel.getAge');
            // Calculate how long ago the message was received (in seconds)
            
            var currentTime = Math.floor(new Date().getTime()       / 1000);
            var messageTime = Math.floor(this.get('time').getTime() / 1000 - (this.options.localMessage ? 0 : config.serverTimeDifference));
            
            return Math.ceil(currentTime - messageTime);
        },
        
        getReadableName : function()
        {   trc('MessageModel.getReadableName');
            var name = this.get('author');
            
            return name.lastIndexOf('-') !== -1 ? name.slice(0, name.lastIndexOf('-')) : name;
        },
        
        getToUserReadableName : function()
        {   trc('MessageModel.getToUserReadableName');
            var name = this.get('toAuthor');
            
            return name.lastIndexOf('-') !== -1 ? name.slice(0, name.lastIndexOf('-')) : name;
        },
        
        getTalkName : function()
        {   trc('MessageModel.getTalkName');
            var toName = this.get('toAuthor');
            
            return this.getReadableName() + (toName ? '/' + (toName.lastIndexOf('-') !== -1 ? toName.slice(0, toName.lastIndexOf('-')) : toName) : '');
        }
    });

})(window.Application, window.chatConfig);