<?php get_header(); ?>
    <div class="catalog-categories-page">
        <div class="catalog-categories-page__title title section"><?php echo get_queried_object()->name; ?></div>
        <div class="catalog-categories-page__desc section">
            <div class="catalog-categories-page__desc-text">
                <?php echo get_queried_object()->description; ?>
            </div>
            <a href="/shop-categories/majkop" class="catalog-categories-page__desc-btn btn">Магазины</a>
        </div>
        <div class="catalog-categories-page__categories">
            <?php if ($categories = get_categories(array('taxonomy' => 'catalog-categories', 'parent' => get_queried_object()->term_id, 'hide_empty' => 1, 'orderby' => 'id', 'order' => 'ASC'))) { ?>
                <?php foreach ($categories as $category) { ?>
                    <div class="catalog-categories-page__category">
                        <div class="catalog-categories-page__category-title section"><?php echo $category->cat_name; ?></div>
                        <div class="catalog-categories-page__category-items">
                            <div class="catalog-categories-page__category-items-wrapper">
                                <?php $loop = new WP_Query(array('posts_per_page' => 0, 'post_type' => 'catalog', 'tax_query' => array(array('taxonomy' => 'catalog-categories', 'terms'=> $category->term_id)), 'orderby' => 'id', 'order' => 'DESC')); ?>
                                <?php while ($loop->have_posts()) { $loop->the_post() ?>
                                    <a href="#" class="catalog-categories-page__category-item">
                                        <div class="catalog-categories-page__category-item-image">
                                            <img src="<?php echo wp_get_attachment_image_url(get_post_meta(get_the_ID(), '_thumbnail_id', true), 'full'); ?>">
                                        </div>
                                        <div class="catalog-categories-page__category-item-title">
                                            <?php the_title(); ?>
                                        </div>
                                    </a>
                                <?php } wp_reset_query(); ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
<?php get_footer(); ?>