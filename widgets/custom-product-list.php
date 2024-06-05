<?php
if (!defined('ABSPATH')) exit;

class Custom_Products_List extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'custom_products_list';
    }
    public function get_title()
    {
        return esc_html__('Custom Product List', 'dodai-addons');
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
                    $regular_price = (float) $product->get_regular_price();
                    $sale_price = (float) $product->get_sale_price();
            ?>
                    <li class="custom_woocommerce_product">
                        <ul class="bulk_saving_banner">
                            <li>₹<?php echo $sale_price ?: $regular_price; ?> Launch Offer</li>
                        </ul>
                        <div class="product_image_container">
                            <?php echo  $product->get_image(); ?>
                        </div>
                        <div class="product_contents">
                            <div>

                                <h3 class="custom_product_title"><?php echo $product->get_name(); ?></h3>
                                <div class="product_short_description">
                                    <!-- <ul>
                                        <li>Fresh & Organic Direct from the Farm</li>
                                        <li>100% Pure, Chemical-free, and Farm-fresh</li>
                                        <li>No Added Water, Powder, or Thickneres</li>
                                        <li>Delivered Fresh Within 2 Hours of Milking</li>
                                    </ul> -->
                                    <?php
                                    echo get_the_excerpt();
                                    ?>
                                </div>
                                <div class="hr"></div>
                                <p class="delivery_is_free">Delivery is free</p>
                                <div class="price_container">
                                    <p class="save_price">Save ₹<?php echo $regular_price - $sale_price; ?></p>
                                    <p class="prices"><?php echo $product->get_price_html(); ?></p>

                                </div>
                            </div>
                            <?php
                            woocommerce_template_loop_add_to_cart(array('product_id' => $product->get_id()));

                            ?>
                            <!-- <a href="https://a2simplybetter.com/signup/" class="btn_not_user">Buy Now</a> -->

                        </div>
                    </li>
            <?php
                endwhile;
            endif; ?>
        </ul>
<?php

    }
}
