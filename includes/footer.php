<footer>
	<div class="footer_wrapper">
		<div>
			<a href="<?php echo $config['INST_url']; ?>" target="_blank">
				<div class="footer_social">
					<img src="icons/iso/social_mb.webp" alt="">
				</div>
			</a>
		</div>
		<div>
			<div class="footer_links">
				<div class="footer_links_main">
					<!-- принимает данные из config файла -->
					<?php
						echo $config['title'];
					?>
				</div>
			</div>
		</div>
		<div>
			<div class="footer_mobile">	</div>
		</div>
	</div>
</footer>