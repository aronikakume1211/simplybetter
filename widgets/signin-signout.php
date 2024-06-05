<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


class Signin_Signout extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'signin_signout_widget';
    }

    public function get_title()
    {
        return __('simplybetter Signin Signup', 'dodai-addons');
    }

    public function get_icon()
    {
        return 'eicon-lock-user';
    }

    public function get_categories()
    {
        return ['dodai'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'dodai-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'username_label',
            [
                'label' => __('Email Label', 'dodai-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Email', 'dodai-addons'),
                'placeholder' => __('Enter your Email label', 'dodai-addons'),
            ]
        );

        $this->add_control(
            'password_label',
            [
                'label' => __('Password Label', 'dodai-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Password', 'dodai-addons'),
                'placeholder' => __('Enter your password label', 'dodai-addons'),
            ]
        );

        $this->add_control(
            'submit_text',
            [
                'label' => __('Submit Button Text', 'dodai-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Login', 'dodai-addons'),
                'placeholder' => __('Enter submit button text', 'dodai-addons'),
            ]
        );
        $this->add_control(
            'login_text',
            [
                'label' => __('Signin Button Text', 'dodai-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Sign In', 'dodai-addons'),
                'placeholder' => __('Enter submit button text', 'dodai-addons'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <div class="signin_signout">

            <div class="btn_tabs_container">
                <button class="btn_tab btn_new_customer active_btn">New Customer?</button>
                <button class="btn_tab btn_old_customer">I'm a customer</button>
            </div>

            <form id="signup-form" class="mebrik_signup_form d-flex align-center flex-column signin_signout_form active_form" data-api="<?php echo get_rest_url(null, 'v1/register/user'); ?>">
                <?php wp_nonce_field('wp_rest'); ?>
                <h1 class="signin_info">Let's check if we can ship milk to your area</h1>
                <p class="username_container">
                    <label for="username" class="username_label"><?php echo esc_html($settings['username_label']); ?></label>
                    <input type="text" id="username" name="username" placeholder="Email" required>
                </p>
                <p class="password_container">
                    <label for="password" class="password_label"><?php echo esc_html($settings['password_label']); ?></label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </p>
                <p class="login_terms_privacy">By creating an account you agree to our <a href="https://a2simplybetter.com/terms-conditions/"> Terms of Service</a> and <a href="https://a2simplybetter.com/privacy-policy/">Privacy Policy</a></p>
                <p class="submit_container">
                    <input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('ajax-login-nonce'); ?>">
                    <input type="submit" class="submit_btn" value="<?php echo esc_html($settings['submit_text']); ?>">
                </p>
                <p id="signup_message"></p>
                <p id="signup_success_message"></p>
            </form>

            <form id="login-form" class="mebrik_login_form signin_signout_form" data-login="<?php echo get_rest_url(null, 'v1/user/login'); ?>">
                <?php wp_nonce_field('wp_rest'); ?>
                <h2 class="signin_info">Login</h2>
                <p class="username_container">
                    <label for="username" class="username_label"><?php echo esc_html($settings['username_label']); ?></label>
                    <input type="text" id="username" name="username" placeholder="Email" required>
                </p>
                <p class="password_container">
                    <label for="password" class="password_label"><?php echo esc_html($settings['password_label']); ?></label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </p>
                <p class="submit_container">
                    <input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('ajax-login-nonce'); ?>">
                    <input type="submit" class="submit_btn" value="<?php echo esc_html($settings['login_text']); ?>">
                </p>
                <p class="login_terms_privacy already_account_holder">Need an account?create one <span class="click_here_create" style="color: #004008; text-decoration: underline; cursor: pointer;">here</span></p>
                <p id="signin_message"></p>
                <p id="signin_success_message"></p>
            </form>
        </div>
    <?php
    }

    protected function _content_template()
    {
    ?>
        <form id="ajax-login-form" method="post">
            <p>
                <label for="username">{{{ settings.username_label }}}</label>
                <input type="text" id="username" name="username" required>
            </p>
            <p>
                <label for="password">{{{ settings.password_label }}}</label>
                <input type="password" id="password" name="password" required>
            </p>
            <p>
                <input type="hidden" id="security" name="security" value="{{{ settings.security }}}">
                <input type="submit" value="{{{ settings.submit_text }}}">
            </p>
        </form>
        <div id="login-message"></div>
<?php
    }
}
