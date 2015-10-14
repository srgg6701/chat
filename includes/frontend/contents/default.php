<?php
$arrMenus = array_keys($menu_array);
//var_dump("menu_array<pre>",$menu_array,"</pre>");
$lastMenuOptions = $menu_array[$arrMenus[2]];
//var_dump("arrMenus<pre>",$arrMenus,"</pre>");
$lastMenuPoints = array_keys($lastMenuOptions);
//var_dump("lastMenuPoints<pre>",$lastMenuPoints,"</pre>");
?>
<h1>Welcome!</h1>
<p>Добро пожаловать к дэдди, разработчик Мультивиджета™.</p>
<b>Самое главное:</b> <cite>Go hard or go home!&copy;</cite>
<p>Здесь собрана общая полезная информация. Меню:</p>
<ol>
	<li><?php
		echo $arrMenus[1];?> ─ исключительно для тестирования роутинга под <b>Slim</b>.</li>
	<li>Multiwidget:
		<ol>
			<li><a href="<?php echo $menu_array[$arrMenus[2]][$lastMenuPoints[0]];?>"><?php echo $lastMenuPoints[0];?></a> ─ раздел помощи по установке и работе с оригинальным чатом (от разработчиков чата, англ.)</li>
			<li><a href="<?php echo $menu_array[$arrMenus[2]][$lastMenuPoints[1]];?>"><?php echo $lastMenuPoints[1];?></a> ─ панель управления мультивиджетом</li>
		</ol>
	</li>
</ol>
<p>Вышеуказанный чат является базовым компонентом мультивиджета. Идея в том, чтобы постепенно наращивать его функционал до набора опций, указанных в ТЗ.</p>
<hr/>
<p><b>So, good luck!</b></p>
<p>Говоря по-русски:</p>
<cite>Запряги свои нервы в узду,<br>не охай, и не ахай...&copy;</cite>
<p>ну ты понел&copy;</p>