<?php
if (!defined('ABSPATH')) exit;

class Products_List extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'products_list';
    }
    public function get_title()
    {
        return esc_html__('Product List', 'dodai-addons');
    }
    public function get_icon()
    {
        return 'eicon-products';
    }
    public function get_categories()
    {
        return ['dodai'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'dodai-addons'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'post_status' => 'publish',
        );

        $products = new WP_Query($args);
?>
        <ul class="custom_woocommerce_products d-flex flex-wrap gap-40 justify-between">
            <?php
            if ($products->have_posts()) : while ($products->have_posts()) : $products->the_post();
                    global $product;
            ?>
                    <li class="custom_woocommerce_product">
                        <a href="<?php echo get_permalink($product->get_id()); ?>" class="product_image_container">
                            <?php echo  $product->get_image(); ?>
                        </a>
                        <h3 class="custom_product_title"><?php echo $product->get_name(); ?></h3>
                        <div class="product_short_description"><?php echo get_the_excerpt();?></div>
                        <p><?php echo $product->get_price_html(); ?></p>
                        <?php
                        woocommerce_template_loop_add_to_cart(array('product_id' => $product->get_id()));
                        ?>
                    </li>
            <?php
                endwhile;
            endif; ?>
        </ul>
<?php

    }
}
