<?php
//
$templates_dir = __DIR__ . '/../templates';
// data from server
$recall_later = "<p>Перезвоним гарантированно в указанное время</p>";
$want_record_via_email = "<p>Хотите, отправим вам запись разговора на e-mail?</p>";
?>
<section id="waiting-for-calling" class="section-top">
	<!--switch off on the timer half way-->
	<div data-calls-section="initial">
		<div data-step="1">
			<?php
			/** NOTICE:    1. the outer array means that its elements will be processed in loop
			 * 2. the elements as arrays mean that they will get the class 'invisible'
			 * 3. in order to avoid the assignation the class 'invisible' it is necessary to pass the
			 * param as a string */
			// [data-user-message="@number"]
			setUserSectionTop(array(
						"<p>Перезвоню бесплатно и за 24 сек., засекайте!</p>", // visible
						array("<p>Мы вам звоним. Проверьте телефон</p>"),    // invisible
						array("<p>Ваш разговор будет записан и вы сможете получить запись на e-mail</p>"), // invisible
						array($recall_later)
					)
				);
			?>
		</div>
		<form id="form-user-phone" name="form-user-phone" method="post" />
		<div data-step="2" class="invisible">
			<?php setUserSectionTop( array(
							// invisible under [data-calls-section="initial"].no-money
							$recall_later .
							// visible under [data-calls-section="initial"].no-money
							"<p class=\"no-money\">Когда вам удобно перезвонить?</p>"
						 )
					);
// selects to point the recall time
require $templates_dir .'/block-recall-later.php';?>
		</div>
<?php
// Countdown block
require $templates_dir .'/block-timer.php';?>
		</form>
	</div>
	<div data-calls-section="process" class="invisible">
		<div data-step="1">
			<?php
			setUserSectionTop("<p>Вам удалось начать разговор?</p>"); ?>
			<div class="btns-group top-middle">
				<?php
				setButton("Да", 'data-action="success"');
				setButton("Нет", 'data-action="fail"'); ?>
			</div>
		</div>
	</div>
	<div data-calls-section="result" class="invisible">
		<div data-calls-result="success" class="invisible">
			<?php /** NOTICE: data-step blocks are to separate subsections */ ?>
			<div data-step="1">
				<?php setUserSectionTop("<p>Пожалуйста, оцените качество обслуживания!</p>");
require $templates_dir . '/stars.php';?>
			</div>
			<div data-step="2" class="invisible">
				<?php setUserSectionTop("<p>Спасибо за то, что помогаете нам становиться лучше!</p>
				$want_record_via_email",
				/*  don't remove the duplicate!
					it should be here due to switching different blocks	*/
				$want_record_via_email);
				// set form
				$form_data = $mail_form_data = array(
						'id'=>'send-record',
						'name'=>'send-record',
						'method'=>'post',
						'fields'=>array(
								array(
									'email'=>array(
										'id'=>'email',
										'type'=>'email',
										'placeholder'=>'Введите e-mail',
										'value'=>'dude@pupkine.me',
										'required'=>true
									)
								)
							),
						'button'=>array("Хочу запись!", null, null, 'submit')
				);
// form
require $templates_dir . '/form.php';
// link thank you, I don't need it
require $templates_dir . '/link-deny-record.php';?>
			</div>
			<div data-step="3" class="invisible">
				<?php setUserSectionTop("<p>Мы стараемся сделать наш сервис как можно лучше для вас!</p>"); ?>
				<div class="btns-group top-middle">
					<?php
					setButton("Оставить отзыв", 'data-ranking="show"'); ?>
				</div>
			</div>
		</div>
		<div data-calls-result="fail" class="invisible">
			<div data-step="1">
				<?php setUserSectionTop("<p>Очень жаль!</p>
            	<p>Уже отправлена жалоба директору!</p>"); ?>
			</div>
		</div>
	</div>
	<div data-calls-section="call-later" class="invisible">
		<div data-step="1">
			<?php
	setUserSectionTop("<p>Как к вам можно обращаться?</p>");
	//
	$form_data = array(
			'id'=>'send-record',
			'name'=>'send-record',
			'method'=>'post',
			'fields'=> array(
				array(
					'your-name'=>array(
						'id'=>'your-name',
						'type'=>'email',
						'placeholder'=>'Введите ваше имя',
						'value'=>'dude@pupkine.me',
						'required'=>true
					)
				)
			),
			'button'=>array("Указать имя!", null, null, 'submit')
	);
// form
require $templates_dir . '/form.php';
// link thank you, I don't need it
require $templates_dir . '/link-deny-record.php';?>
		</div>
		<div data-step="2" class="invisible">
			<?php setUserSectionTop(array($want_record_via_email));
	// it's almost the copy of the form #send-record above
	// we just need to make the id id unique
	$form_data = $mail_form_data;
	$form_data['id'] = 'send-record2';
	$form_data['name'] = 'send-record2';
	$form_data['fields'][0]['email']['id'] = 'email-req2';
// form
require $templates_dir . '/form.php';
// link thank you, I don't need it
require $templates_dir . '/link-deny-record.php';?>
		</div>
		<div data-step="3" class="invisible">
			<?php setUserSectionTop("<p>Звонок заказан!</p>
			<p>В указанное время мы свяжемся с вами!</p>");?>
			<?php
			setButton("Оставить отзыв", 'data-ranking="show"'); ?>
		</div>
	</div>
</section>