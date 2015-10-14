<?php
/**
 * @param $form_data
 * @param string $method
 */?>
	<form id="<?php echo $form_data['id'];?>" name="<?php echo $form_data['name'];?>" method="<?php echo $form_data['method'];?>">
	<?php
		//var_dump("<pre>",array(count($form_data['fields']), $form_data['fields'],$form_data),"</pre>");
		foreach($form_data['fields'] as $i=>$field):
			foreach($field as $name=>$params):?>
			<<?php
			if(!isset($params['tag'])) $params['tag']='input';
			echo $params['tag'];
			?> name="<?php echo $name;?>"<?php
				if(isset($params['id'])):
			?> id="<?php echo $params['id'];?>"<?php
				endif;
				if(isset($params['type'])):
			?> type="<?php echo $params['type'];?>"<?php
				endif;
				if(isset($params['pattern'])):
				?> pattern="<?php echo $params['pattern'];?>"<?php
				endif;
				if(isset($params['placeholder'])):
			?> placeholder="<?php echo $params['placeholder'];?>"<?php
				endif;
				if(isset($params['value'])):
			?> value="<?php echo $params['value'];?>"<?php
				endif;
				if($params['required']):
			?> required="required"<?php
				endif;
				if($params['tag']=='textarea'):
					echo "></$params[tag]>";
				else:
					?> />
					<?php
				endif;
			endforeach;
		endforeach;
		setButton(
				$form_data['button'][0], // value
				$form_data['button'][1], // params
				$form_data['button'][2], // class
				$form_data['button'][3]	 // type
			); ?>
	</form>
