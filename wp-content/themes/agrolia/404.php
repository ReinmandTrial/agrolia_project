<?php
get_header();

$lang = function_exists('pll_current_language') ? pll_current_language() : (strpos(get_locale(), 'en_') === 0 ? 'en' : 'uk');
$texts = array(
    'uk' => array(
        'title' => '404',
        'headline' => 'Сторінку не знайдено',
        'desc' => 'Схоже, ви потрапили не туди.',
        'home' => 'На головну',
        'searchHint' => 'Або спробуйте пошук',
        'contact' => "Зв'язатися",
    ),
    'en' => array(
        'title' => '404',
        'headline' => 'Page not found',
        'desc' => 'Looks like you got lost.',
        'home' => 'Go home',
        'searchHint' => 'Or try a search',
        'contact' => 'Contact us',
    ),
);
$t = isset($texts[$lang]) ? $texts[$lang] : $texts['uk'];
$home_link = $lang === 'en' ? home_url('/en/') : home_url('/');
?>

<main class="page">
    <section class="page-404 section-padding">
        <div class="page-404__container">
          <div class="page-404__inner">
              <div class="page-404__code"><?php echo esc_html($t['title']); ?></div>
              <h1 class="page-404__title title-h2"><?php echo esc_html($t['headline']); ?></h1>
              <p class="page-404__desc main-txt"><?php echo esc_html($t['desc']); ?></p>
              <div class="page-404__actions">
                  <a href="<?php echo esc_url($home_link); ?>" class="page-404__btn page-404__btn--primary"><?php echo esc_html($t['home']); ?></a>
                  <button type="button" data-popup="#popupForm" class="page-404__btn page-404__btn--secondary"><?php echo esc_html($t['contact']); ?></button>
              </div>
            
          </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
