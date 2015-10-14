<ul class="menu">
	<?php
	foreach ($menu_array as $text => $uri):
		$link_end = '">' . $text . '</a>';
		?><li><?php
		echo "\n	<a href=\"";
		if (gettype($uri) == 'string'):
			echo $uri . $link_end;
		else:
			echo '#" class="deeper' . $link_end;
			if (is_array($uri)):
				?>
				<ul>
					<?php
					foreach ($uri as $link => $url):
						?>
						<li>
							<a href="<?php echo $url; ?>">
								<?php echo $link; ?>
							</a>
						</li>
						<?php
					endforeach;
					?>
				</ul>
				<?php
			endif;
		endif; ?>
		</li>
		<?php
	endforeach; ?>
</ul>
<hr/>