<section class="section-top">
	<?php setUserSectionTop("если это не ваше имя, давайте исправим это недоразумение)");
	$form_data = array( //
			'id' => 'form-user-data',
			'name' => 'form-user-data',
			'method' => 'post',
			'fields' => array(
					array(
						'your-name-to-send' => array(
								'id' => 'your-name-to-send',
								'type' => 'text',
								'placeholder' => 'Введите ваше имя',
								'pattern'=>'^[a-zA-Zа-яА-Я\-\s]{2,}',
									// dev:
								'value' => 'Tester',
								'required' => true
							)
					)
		),
		'button'=>array("Это моё имя!", null, null, 'submit')
	);
	require $templates_dir . '/form.php';?>
</section>