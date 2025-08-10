    <footer class="footer">
		<div class="footer__container">
			<div class="footer__content">
				<div class="footer__copyright">
					<?php 
                    if (function_exists('get_field')) {
						$footer_copyright_group = get_field('footer_copyright', 'option');
						if (!empty($footer_copyright_group)) {
                            $current_language = function_exists('pll_current_language') ? pll_current_language() : 'uk';
							if ($current_language === 'en') {
								$copyright_text = $footer_copyright_group['footer_copyright_eng'];
							} else {
								$copyright_text = $footer_copyright_group['footer_copyright_ua'];
							}
							if (!empty($copyright_text)) {
                                echo '<p>' . wp_kses_post($copyright_text) . '</p>';
							}
						}
					}
					?>
				</div>
        <?php if (function_exists('have_rows') && have_rows('footer_socials', 'option')) : ?>
<div class="footer__socials">
    <ul>
        <?php while (have_rows('footer_socials', 'option')) : the_row(); 
            $icon = get_sub_field('icon');
            $url = get_sub_field('url');
            $name = get_sub_field('name');
        ?>
            <?php if (!empty($url) && !empty($icon)) : ?>
                <li>
                    <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr($name); ?>">
                        <img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($name); ?>">
                    </a>
                </li>
            <?php endif; ?>
        <?php endwhile; ?>
    </ul>
</div>
<?php endif; ?>
			</div>
		</div>
	</footer>

	<div id="popupForm" aria-hidden="true" class="popup">
		<div class="popup__wrapper">
			<div class="popup__content">
                <button data-close type="button" class="popup__close" aria-label="<?php echo esc_attr__('Close', 'agrolia'); ?>">
					<svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path opacity="0.850056" d="M1.73333 1.48883L21.5469 21.0288" stroke="#000" stroke-linecap="square" />
						<path opacity="0.850056" d="M21.2667 1.48883L1.45309 21.0288" stroke="#000" stroke-linecap="square" />
					</svg>
				</button>
				<div class="popup__form">
					<div class="popup-form__form-header">
          <?php
            $contact_title = '';
            $contact_subtitle = '';
            $contact_image = '';
            if (function_exists('get_field')) {
                $contact_group = get_field('contact_group');
                if ($contact_group) {
                    $contact_title = $contact_group['contact_title'] ?? '';
                    $contact_subtitle = $contact_group['contact_subtitle'] ?? '';
                    $contact_image = $contact_group['contact_image'] ?? '';
                }
            }
			?>
      <h3 class="title-h3">
                    <?php echo wp_kses_post($contact_title); ?>
				</h3>
        <?php if ($contact_subtitle): ?>
                <p class="contact-form__form-subtitle">
                  <?php echo wp_kses_post($contact_subtitle); ?>
                </p>
              <?php endif; ?>
					</div>
					<?php
                        $lang = function_exists('pll_current_language') ? pll_current_language() : 'uk';
						$form_id_uk = '0bb0b5a'; // <-- замени на ID украинской формы
						$form_id_en = '0e0d589'; // <-- замени на ID английской формы
						$cf7_id = $lang === 'en' ? $form_id_en : $form_id_uk;
						?>
						<?php echo do_shortcode('[contact-form-7 id="' . esc_attr($cf7_id) . '"]'); ?>
				</div>
			</div>
		</div>
	</div>

	<div id="popupVideos" aria-hidden="true" class="popup popup-videos">
		<div class="popup__wrapper">
			<div class="popup__content">
                <button data-close type="button" class="popup__close" aria-label="<?php echo esc_attr__('Close', 'agrolia'); ?>">
					<svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path opacity="0.850056" d="M1.73333 1.48883L21.5469 21.0288" stroke="#000" stroke-linecap="square" />
						<path opacity="0.850056" d="M21.2667 1.48883L1.45309 21.0288" stroke="#000" stroke-linecap="square" />
					</svg>
				</button>
				<div class="popup-videos">
					<div data-slider class="popup-videos__slider swiper">
						<div class="popup-videos__wrapper swiper-wrapper">
							<div class="popup-videos__slide swiper-slide">
								<video autoplay muted loop playsinline controls>
                                    <source src="<?php echo esc_url(get_template_directory_uri() . '/img/video/video-1.mp4'); ?>" type="video/mp4">
									Your browser does not support the video tag.
								</video>
							</div>
							<div class="popup-videos__slide swiper-slide">
								<video autoplay muted loop playsinline controls>
                                    <source src="<?php echo esc_url(get_template_directory_uri() . '/img/video/video-2.mp4'); ?>" type="video/mp4">
									Your browser does not support the video tag.
								</video>
							</div>
							<div class="popup-videos__slide swiper-slide">
								<video autoplay muted loop playsinline controls>
                                    <source src="<?php echo esc_url(get_template_directory_uri() . '/img/video/video-3.mp4'); ?>" type="video/mp4">
									Your browser does not support the video tag.
								</video>
							</div>
						</div>
						<div class="popup-videos__pagination swiper-pagination"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
