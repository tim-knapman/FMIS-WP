			</div>
		</section>
		<footer>
			<div class="information">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<?php
								echo $footer_text = get_field( 'footer_text', 'options' );
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<p>&copy; <?php echo date('Y') . get_field( 'copyright_notice', 'options' ); ?></p>
						</div>
						<div class="col-md-4 text-right">
							<p>Website by <a href="http://timknapman.com.au" target="blank">Tim Knapman</a>.</p>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<?php wp_footer(); ?>
  </body>
</html>
