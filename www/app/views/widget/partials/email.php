<section class="section-top">
	<div data-step="1">
	<?php setUserSectionTop(
				array(
					"<span class=\"user-area\">гарантировано доставим ваше сообщение!</span><div class=\"guest-area\">Гарантировано доставим ваше сообщение!</div>" ));
	$form_data = array( //
					'id'=>'form-user-letter',
					'name'=>'form-user-letter',
					'method'=>'post',
					'fields'=>array(
					array(
						'your-name-to-send'=>array(
							'id'=>'your-name-to-send',
							'type'=>'text',
							'placeholder'=>'Ваше имя',
							'pattern'=>'^[a-zA-Zа-яА-Я\-\s]{2,}',
								// dev:
							'value'=>'Tester',
							'required'=>true
						)
					),
					array(
						'your-email-to-send'=>array(
							'id'=>'your-email-to-send',
							'type'=>'email',
							'placeholder'=>'E-mail',
								// dev:
							'value'=>"tester@test.try",
							'required'=>true
							)
					),
					array(
						'your-phone-to-send'=>array(
							'id'=>'your-phone-to-send',
							'type'=>'tel',
							'placeholder'=>'Телефон',
								// dev:
							'value'=>'9876543210',
							'pattern'=>'^[0-9]{5,}$',
							'required'=>true
						)
					),
					array(
						'your-message-to-send'=>array(
							'id'=>'your-message-to-send',
							'tag'=>'textarea',
							'placeholder'=>'Сообщение',
							'required'=>true
						)
					)
		),
		'button'=>array("Отправить", null, null, 'submit')
	);
require $templates_dir . '/form.php';?>
	</div>
	<div data-step="2" class="invisible">
		<?php setUserSectionTop(array( "Ваше сообщение отправлено!"));?>
		<?php setButton("OK", ' id="btn-mail-sent-ok"', null, 'submit')?>
	</div>
</section>