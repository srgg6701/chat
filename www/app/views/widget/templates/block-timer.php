<div id="timer-objects">
	<!--phone number cell-->
	<input id="field-user-phone" type="tel" placeholder="<?php echo _("Введите ваш телефон"); ?>" required="required" pattern="^[0-9]{5,}$" title="<?php echo _("Только цифры, не менее 5 значений"); ?>" <?php //dev: ?>value="123456789" />
	<?php
	// the button
	setButton("Жду звонка", null, null, 'submit');
	?>
	<!--timer info-->
	<div id="info-countdown">
		<span data-container="mins">00</span> :
		<span data-container="secs">24</span> :
		<span data-container="msecs">00</span>
	</div>
	<!--calling delay link-->
	<a href="javascript:void(0)" class="display-table centered-horizontal"
	   id="link-not-now"><?php echo _("Сейчас неудобно, перезвоните в другое время"); ?></a>
</div>
