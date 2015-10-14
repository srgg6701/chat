<div id="recall-later-block">
	<select id="select-day" class="float-left">
		<?php foreach (['Сегодня', 'Завтра', 'Послезавтра', 'Следующее число'] as $day): ?>
			<option value="<?php echo $day; ?>"><?php echo $day; ?></option>
		<?php endforeach; ?>
	</select>
	<span> в </span>
	<select id="select-time" class="float-right">
		<?php foreach (range(9, 20) as $hour): ?>
			<option value="<?php echo $hour; ?>"><?php
				if ($hour < 10) $hour = '0' . $hour;
				echo $hour;
				?></option>
		<?php endforeach; ?>
	</select>
</div>
