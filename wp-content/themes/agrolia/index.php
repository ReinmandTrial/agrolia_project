<?php get_header(); ?>

<main class="page">
<section class="hero section-padding">
    <div class="hero__container">
        <div class="hero__content">
            <div class="hero__left">
                <?php
                $page_id = (is_front_page() && get_option('page_on_front')) ? get_option('page_on_front') : 'option';
                $hero_title = get_field('hero_title', $page_id) ?: 'Міжнародні автоперевезення';
                $hero_subtitle = get_field('hero_subtitle', $page_id) ?: '';
                $hero_text = get_field('hero_text', $page_id) ?: 'Надійні вантажні перевезення по Україні та Європі';
                $hero_button_text = get_field('hero_button_text', $page_id) ?: "Зв'язатись з нами";
                ?>

                <?php if ($hero_title): ?>
                    <h1 class="hero__title"><?php echo wp_kses_post($hero_title); ?></h1>
                <?php endif; ?>

                <?php if ($hero_subtitle): ?>
                    <h2 class="hero__subtitle title-h2"><?php echo wp_kses_post($hero_subtitle); ?></h2>
                <?php endif; ?>

                <?php if ($hero_text): ?>
                    <p class="hero__text main-txt"><?php echo wp_kses_post($hero_text); ?></p>
                <?php endif; ?>

                <?php if ($hero_button_text): ?>
                    <button
                        type="button"
                        class="hero__button button button-green px-8 py-3 rounded-lg font-semibold text-white bg-green-600 hover:bg-green-700 transition"
                        data-text="<?php echo esc_attr($hero_button_text); ?>"
                        data-popup="#popupForm"
                    >
                        <span><?php echo esc_html($hero_button_text); ?></span>
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if (get_field('hero_video')): ?>
        <div class="hero__video-bg absolute inset-0 z-0">
            <video autoplay muted loop class="w-full h-full object-cover">
                <?php $hero_video = get_field('hero_video'); if (!empty($hero_video)) : ?>
                    <source src="<?php echo esc_url($hero_video); ?>" type="video/mp4">
                <?php endif; ?>
            </video>
        </div>
    <?php endif; ?>
</section>
 
  <section class="features section-padding">
    <div class="features__container">
        <div class="features__content">
            <?php if(function_exists('have_rows') && have_rows('features_list')): ?>
                <div class="features__list">
                    <?php while(have_rows('features_list')): the_row(); ?>
                        <div class="features__item gradient-border">
                            <div class="features__icon">
                                <?php $icon = get_sub_field('icon'); ?>
                                <?php if (!empty($icon)) : ?>
                                    <img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr__('Feature icon', 'agrolia'); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="features__text">
                                <?php $feature_title = get_sub_field('title'); if($feature_title): ?>
                                    <h6><?php echo wp_kses_post($feature_title); ?></h6>
                                <?php endif; ?>
                                <?php $feature_desc = get_sub_field('description'); if($feature_desc): ?>
                                    <p class="features__description"><?php echo wp_kses_post($feature_desc); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
    
  <section class="why-us section-padding" id="why-us">
    <div class="why-us__container">
        <div class="why-us__content">
            <div class="why-us__header">
                <h2 class="title-h2">
                    <?php echo wp_kses_post(get_field('why_us_title')); ?>
                </h2>
            </div>
            <div class="why-us__body">
                <?php if(have_rows('why_us_items')): ?>
                    <div class="why-us__list">
                        <?php while(have_rows('why_us_items')): the_row(); ?>
                            <div class="why-us__item item-why-us gradient-border">
                                <div class="item-why-us__body">
                                    <?php $why_title = get_sub_field('title'); if($why_title): ?>
                                        <h6><?php echo wp_kses_post($why_title); ?></h6>
                                    <?php endif; ?>
                                    
                                    <?php if(have_rows('points')): ?>
                                        <ul>
                                            <?php while(have_rows('points')): the_row(); ?>
                                                <?php $point_text = get_sub_field('text'); ?>
                                                <li>
                                                    <p><?php echo wp_kses_post($point_text); ?></p>
                                                </li>
                                            <?php endwhile; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
    
  <section class="benefits section-padding" id="benefits">
    <div class="benefits__container">
        <div class="benefits__content">
            <?php if(function_exists('have_rows') && have_rows('benefits_items')): ?>
                <div class="benefits__list">
                    <?php while(have_rows('benefits_items')): the_row(); 
                        $icon = get_sub_field('icon');
                        $alt_text = get_sub_field('alt_text');
                    ?>
                        <div class="benefits__item item-benefits gradient-border">
                            <div class="item-benefits__body">
                                <div class="item-benefits__content">
                                    <?php $benefit_title = get_sub_field('title'); if($benefit_title): ?>
                                        <h6><?php echo wp_kses_post($benefit_title); ?></h6>
                                    <?php endif; ?>
                                    
                                    <?php $benefit_desc = get_sub_field('description'); if($benefit_desc): ?>
                                        <p><?php echo wp_kses_post($benefit_desc); ?></p>
                                    <?php endif; ?>
                                </div>
                                
                                <?php if($icon): ?>
                                    <div class="item-benefits__icon">
                                        <img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($alt_text); ?>">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
    
  <?php
$reviews_title_type = get_field('reviews_title_type');
$reviews_list_type = get_field('reviews_list_type');
?>

<section class="reviews section-padding" id="reviews">
	<div class="reviews__container">
		<div class="reviews__content">
			<div class="reviews__header">
                <h2 class="title-h2">
                    <?php echo $reviews_title_type ? wp_kses_post($reviews_title_type) : 'Відгуки'; ?>
                </h2>
			</div>
			
			<?php if ($reviews_list_type): ?>
			<div class="reviews__slider swiper">
				<div class="reviews__wrapper swiper-wrapper">
					<?php foreach ($reviews_list_type as $review): ?>
					<div class="reviews__slide swiper-slide slide-review">
						<div class="slide-review__body">
							<div class="slide-review__header">
								<div class="slide-review__image">
                                    <?php 
									$avatar = $review['avatar'];
									if ($avatar): ?>
										<img src="<?php echo esc_url($avatar['url']); ?>" alt="<?php echo esc_attr($avatar['alt'] ?: 'Image review'); ?>">
									<?php else: ?>
                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/users/avatar-1.webp'); ?>" alt="Image review">
									<?php endif; ?>
								</div>
								<div class="slide-review__review">
									<?php if (!empty($review['rating'])): ?>
									<div class="slide-review__rating">
										<?php 
										$rating = (int)$review['rating'];
										for ($i = 1; $i <= 5; $i++): ?>
											<span class="star <?php echo $i <= $rating ? 'filled' : ''; ?>">
                      <svg xmlns="http://www.w3.org/2000/svg" width="28" height="27" viewBox="0 0 28 27" fill="none">
<path d="M12.4437 1.78972C12.9336 0.282123 15.0664 0.282121 15.5563 1.78972L17.6739 8.30699C17.8929 8.98121 18.5212 9.43769 19.2301 9.43769H26.0828C27.668 9.43769 28.3271 11.4662 27.0446 12.3979L21.5007 16.4258C20.9272 16.8425 20.6872 17.5811 20.9063 18.2553L23.0239 24.7726C23.5137 26.2802 21.7882 27.5338 20.5058 26.6021L14.9618 22.5742C14.3883 22.1575 13.6117 22.1575 13.0382 22.5742L7.49425 26.6021C6.21181 27.5338 4.48629 26.2802 4.97614 24.7726L7.09373 18.2553C7.3128 17.5811 7.07281 16.8425 6.49929 16.4258L0.955364 12.3979C-0.327077 11.4662 0.332009 9.43769 1.91719 9.43769H8.76986C9.47878 9.43769 10.1071 8.98121 10.3261 8.307L12.4437 1.78972Z" fill="#D7D7D7"/>
</svg>
                      </span>
										<?php endfor; ?>
									</div>
									<?php endif; ?>
								</div>
							</div>
							<div class="slide-review__content">
								<?php if (!empty($review['company'])): ?>
								<div class="slide-review__company">
									<p><?php echo esc_html($review['company']); ?></p>
								</div>
								<?php endif; ?>

                                <?php if (!empty($review['text'])): ?>
								<div class="slide-review__text">
                                    <p><?php echo wp_kses_post($review['text']); ?></p>
								</div>
								<?php endif; ?>
								
								<?php if (!empty($review['date'])): ?>
								<div class="slide-review__date">
									<small><?php echo esc_html($review['date']); ?></small>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="slider-navigation">
				<button type="button" class="slider-button-one swiper-button-prev"></button>
				<button type="button" class="slider-button-one swiper-button-next"></button>
			</div>
			<?php endif; ?>
		</div>

    <div class="reviews__for-carriers" id="for-carriers">
    <div class="reviews__for-carriers-header">
        <h2 class="title-h2">
            <?php echo wp_kses_post(get_field('for_carriers_title')); ?>
        </h2>

        <p>
            <b><?php echo wp_kses_post(get_field('for_carriers_subtitle')); ?></b>
        </p>
    </div>
    <div class="reviews__for-carriers-body">
        <div class="reviews__for-carriers-list">
            <?php if( function_exists('have_rows') && have_rows('for_carriers_list') ): ?>
                <?php while( have_rows('for_carriers_list') ): the_row(); ?>
                    <div class="reviews__for-carriers-item">
                        <p>
                            <?php echo wp_kses_post(get_sub_field('for_carriers_item')); ?>
                        </p>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
	</div>
</section>
    
	<section class="contact-form section-padding" id="contact-form">
		<div class="contact-form__container">
			<?php
            $contact_group = function_exists('get_field') ? get_field('contact_group') : null;
			
			if ($contact_group) {
                $contact_title = $contact_group['contact_title'] ?? '';
                $contact_subtitle = $contact_group['contact_subtitle'] ?? '';
				$contact_image = $contact_group['contact_image'] ?? '';
			} else {
				$contact_title = '';
				$contact_image = '';
			}
			?>
			<div class="contact-form__header">
                <h2 class="title-h2">
                    <?php echo wp_kses_post($contact_title); ?>
                </h2>
        <?php if ($contact_subtitle): ?>
                <p class="contact-form__form-subtitle">
                  <?php echo wp_kses_post($contact_subtitle); ?>
                </p>
              <?php endif; ?>
			</div>
			<div class="contact-form__content">
				<div class="contact-form__left">
					<div class="contact-form__image">
						<?php if ($contact_image): ?>
							<?php if (is_array($contact_image)): ?>
								<img src="<?php echo esc_url($contact_image['url']); ?>" alt="<?php echo esc_attr($contact_image['alt']); ?>">
							<?php else: ?>
                                <img src="<?php echo esc_url($contact_image); ?>" alt="Contact Image">
							<?php endif; ?>
						<?php else: ?>
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/contact-form.webp'); ?>" alt="Image">
						<?php endif; ?>
					</div>
				</div>
				<div class="contact-form__right">
					<div class="contact-form__form">
						<div class="contact-form__form-header">
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

					
                        $form_id_uk = '0bb0b5a';
                        $form_id_en = '0e0d589';

						$cf7_id = $lang === 'en' ? $form_id_en : $form_id_uk;
						?>
						<?php echo do_shortcode('[contact-form-7 id="' . esc_attr($cf7_id) . '"]'); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
    
  <?php if (get_field('clients_active', 'option')) : ?>
<section class="clients">
    <div class="clients__content">
        <?php if ($title = get_field('clients_title', 'option')) : ?>
            <h2 class="clients__title"><?php echo wp_kses_post($title); ?></h2>
        <?php endif; ?>
        
        <div class="clients__list">
            <?php 
            $clients = get_field('clients_items', 'option');
            if ($clients) : 
                foreach ($clients as $client) : 
                    $logo = isset($client['logo']) ? $client['logo'] : null;
                    $name = isset($client['name']) ? $client['name'] : '';
            ?>
                <div class="clients__item">
                    <?php if (!empty($logo['url'])) : ?>
                        <img 
                            src="<?php echo esc_url($logo['url']); ?>" 
                            alt="<?php echo esc_attr($name); ?>"
                            width="240"
                            height="120"
                            loading="lazy"
                        >
                    <?php endif; ?>
                </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

	<!-- /.clients -->
	
  <?php if (get_field('contacts_active', 'option')) : 
  $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'ua';
  $titles = get_field('section_titles', 'option');
?>
<section class="contacts" id="contacts">
  <div class="contacts__container">
    <div class="contacts__content">
      <div class="contacts__map">
        <?php echo get_field('google_map', 'option'); ?>
      </div>
      
      <div class="contacts__info">
        <div class="contacts__info-header">
          <h2 class="title-h2">
            <?php echo esc_html($current_lang === 'en' ? $titles['en'] : $titles['ua']); ?>
          </h2>
        </div>
        
        <?php if (have_rows('phone_numbers', 'option')) : ?>
          <?php while (have_rows('phone_numbers', 'option')) : the_row(); 
            $number = get_sub_field('number');
            $clean_number = preg_replace('/[^0-9+]/', '', $number);
            $label = get_sub_field('label');
          ?>
            <div class="contacts__info-item">
              <div class="contacts__info-icon">
                <img src="<?php echo esc_url(get_field('contact_icons', 'option')['phone']); ?>" alt="<?php esc_attr_e('Phone', 'textdomain'); ?>">
              </div>
              <a href="tel:<?php echo esc_attr($clean_number); ?>">
                <?php echo esc_html($number); ?>
                <?php if ($label) : ?>
                  <span class="contact-label">(<?php echo esc_html($label); ?>)</span>
                <?php endif; ?>
              </a>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>
        
        <?php if (have_rows('addresses', 'option')) : ?>
          <?php while (have_rows('addresses', 'option')) : the_row(); 
            $address = $current_lang === 'en' ? get_sub_field('en') : get_sub_field('ua');
          ?>
            <div class="contacts__info-item">
              <div class="contacts__info-icon">
                <img src="<?php echo esc_url(get_field('contact_icons', 'option')['pin']); ?>" alt="<?php esc_attr_e('Location', 'textdomain'); ?>">
              </div>
              <p><?php echo nl2br(esc_html($address)); ?></p>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>
        
        <?php if (have_rows('emails', 'option')) : ?>
          <?php while (have_rows('emails', 'option')) : the_row(); 
            $email = get_sub_field('address');
            $label = get_sub_field('label');
          ?>
            <div class="contacts__info-item">
              <div class="contacts__info-icon">
                <img src="<?php echo esc_url(get_field('contact_icons', 'option')['mail']); ?>" alt="<?php esc_attr_e('Email', 'textdomain'); ?>">
              </div>
              <a href="mailto:<?php echo esc_attr($email); ?>">
                <?php echo esc_html($email); ?>
                <?php if ($label) : ?>
                  <span class="contact-label">(<?php echo esc_html($label); ?>)</span>
                <?php endif; ?>
              </a>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
    
</main>

<div id="preloader">
	<script>
		function preloader() {
			const preloaderImages = document.querySelector('[data-preloader]') ? document.querySelectorAll('[data-preloader] img') : document.querySelectorAll('img');
			const preloaderContainer = document.querySelector('#preloader');
			if (preloaderImages.length) {
				const preloaderStyleTemplate = `
		<style>
			* {
				padding: 0px;
				margin: 0px;
				border: 0px;
				box-sizing: border-box;
			}
			/* Головний блок */
			.preloader{
				pointer-events: none;
				z-index: 100;
				position: fixed;
				width: 100%;
				height: 100%;
				top: 0;
				left: 0;
				display: flex;
				justify-content:center;
				align-items: center;
        transition: all 0.3s ease;
			}
			/* Блок з елементами */
			.preloader__body{
				padding: 0.93rem;
				max-width: 31.25rem;
				display: flex;
				flex-direction: column;
			}
			/* Блок з лічильником */
			.preloader__counter{
				font-size: 10rem;
			}
			/* Прогресбар */
			.preloader__line{}
			/* Лінія прогресбару */
			.preloader__line span{
				display: inline-block;
				transition: width 0.2s ease;
				height: 0.8rem;
				background-color: #7A956B;
			}
			.lock body{
				overflow: hidden;
				touch-action: none;
				overscroll-behavior: none;
			}
			.loading body>*:not(.preloader){
				opacity: 0;
				visibility: hidden;
			}
			.loaded body>*:not(.preloader){
				transition: opacity 0.5s ease 0s;
				opacity: 1;
				visibility: visible;
			}
		</style>`;

				document.head.insertAdjacentHTML("beforeend", preloaderStyleTemplate);

				const preloaderTemplate = `
			<div class="preloader">
				<div class="preloader__body">
					<div class="preloader__image">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/logo.webp'); ?>" alt="Logo">
					</div>
          <div class="preloader__spinner">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icons/spinner.svg'); ?>" alt="Spinner">
          </div>
				</div>
			</div>`;
				document.body.insertAdjacentHTML("beforeend", preloaderTemplate);

				const
					preloader = document.querySelector('.preloader'),
					showPecentLoad = document.querySelector('.preloader__counter'),
					showLineLoad = document.querySelector('.preloader__line span'),
					htmlDocument = document.documentElement;

				let imagesLoadedCount = counter = progress = 0;

				htmlDocument.classList.add('loading');
				htmlDocument.classList.add('lock');

				preloaderImages.forEach(preloaderImage => {
					const imgClone = document.createElement('img');
					if (imgClone) {
						imgClone.onload = imageLoaded;
						imgClone.onerror = imageLoaded;
						preloaderImage.dataset.src ? imgClone.src = preloaderImage.dataset.src : imgClone.src = preloaderImage.src;
					}
				});

				function setValueProgress(progress) {
					showPecentLoad ? showPecentLoad.innerText = `${progress}%` : null;
					showLineLoad ? showLineLoad.style.width = `${progress}%` : null;
				}
				showPecentLoad ? setValueProgress(progress) : null;

				function imageLoaded() {
					imagesLoadedCount++;
					progress = Math.round((100 / preloaderImages.length) * imagesLoadedCount);
					const intervalId = setInterval(() => {
						counter >= progress ? clearInterval(intervalId) : setValueProgress(++counter);
						counter >= 100 ? addLoadedClass() : null;
					}, 10);
				}

				function addLoadedClass() {
					htmlDocument.classList.add('loaded');
					htmlDocument.classList.remove('lock');
					htmlDocument.classList.remove('loading');
					setInterval(() => {
						preloader.remove();
						preloaderContainer.remove();
					}, 150);
				}
			} else {
				preloaderContainer.remove();
			}
		}
		preloader();
	</script>
</div>

<?php
get_footer();
