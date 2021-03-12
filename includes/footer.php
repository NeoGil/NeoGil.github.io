<!-- General site footer -->
<script  src="https://yastatic.net/jquery/2.1.3/jquery.min.js"></script>
<script  src="/js/buttonup.js"></script>
<footer>
	<div class="footer_wrapper">
		<div>
			<!-- link to instagram -->
			<a href="<?php echo $config['INST_url']; ?>" target="_blank">
				<div class="footer_social">
					<img src="icons/iso/social_mb.svg" alt="instagram">
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
<?php ob_end_flush(); ?>