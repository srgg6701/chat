//==============================================================================
//
//  Contact form view
//
//==============================================================================

(function(app, $)
{
    app.ContactFormView = Backbone.View.extend({
    
        mailExp : new RegExp('^[-+\\.0-9=a-z_]+@([-0-9a-z]+\\.)+([0-9a-z]){2,}$', 'i'),
        
        nameValid    : false,
        mailValid    : false,
        messageValid : false,
        
        initialize : function()
        {   trc('ContactFormView.initialize');
            // Cache view elements
            
            this.$name    = this.$('#customer-chat-contact-name');
            this.$mail    = this.$('#customer-chat-contact-mail');
            this.$message = this.$('#customer-chat-contact-message');
            
            this.$name.on   ('input change keydown blur', $.proxy(this.validateName,    this));
            this.$mail.on   ('input change keydown blur', $.proxy(this.validateMail,    this));
            this.$message.on('input change keydown blur', $.proxy(this.validateMessage, this));
        },
        
        reset : function()
        {   trc('ContactFormView.reset');
            this.$name.val('');
            this.$mail.val('');
            this.$message.val('');
            
            this.$name.removeClass   ('customer-chat-input-error');
            this.$mail.removeClass   ('customer-chat-input-error');
            this.$message.removeClass('customer-chat-input-error');
        },
        
        validateName : function()
        {   trc('ContactFormView.validateName');
            if(this.$name.val().length == 0)
            {
                this.$name.addClass('customer-chat-input-error');
                
                this.nameValid = false;
            }
            else
            {
                this.$name.removeClass('customer-chat-input-error');
                
                this.nameValid = true;
            }
        },
        
        validateMail : function()
        {   trc('ContactFormView.validateMail');
            if(this.$mail.val().length == 0 || !this.mailExp.test(this.$mail.val()))
            {
                this.$mail.addClass('customer-chat-input-error');
                
                this.mailValid = false;
            }
            else
            {
                this.$mail.removeClass('customer-chat-input-error');
                
                this.mailValid = true;
            }
        },
        
        validateMessage : function()
        {   trc('ContactFormView.validateMessage');
            if(this.$message.val().length < 6)
            {
                this.$message.addClass('customer-chat-input-error');
                
                this.messageValid = false;
            }
            else
            {
                this.$message.removeClass('customer-chat-input-error');
                
                this.messageValid = true;
            }
        },
        
        isValid : function()
        {   trc('ContactFormView.isValid');
            this.validateName();
            this.validateMail();
            this.validateMessage();
            
            return this.nameValid && this.mailValid && this.messageValid;
        }
    });

})(window.Application, jQuery);