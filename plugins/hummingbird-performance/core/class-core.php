<?php
/**
 * Core class.
 *
 * @package Hummingbird\Core
 */

namespace Hummingbird\Core;

use Hummingbird\Core\Modules\Minify;
use WP_Admin_Bar;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Core
 */
class Core {

	/**
	 * API
	 *
	 * @var Api\API
	 */
	public $api;

	/**
	 * Hummingbird logs
	 *
	 * @since 1.9.2
	 * @var Logger
	 */
	public $logger;

	/**
	 * Saves the modules object instances
	 *
	 * @var array
	 */
	public $modules = array();

	/**
	 * Core constructor.
	 */
	public function __construct() {
		$this->init();
		$this->init_integrations();
		$this->load_modules();

		// Return is user has no proper permissions.
		if ( ! current_user_can( Utils::get_admin_capability() ) ) {
			return;
		}

		$this->add_menu_bar_actions();
		$this->init_ao_safe_mode();
	}

	/**
	 * Initialize core modules.
	 *
	 * @since 1.7.2
	 */
	private function init() {
		// Register private policy text.
		add_action( 'admin_init', array( $this, 'privacy_policy_content' ) );
		add_action( 'admin_init', array( $this, 'upsell_notice' ) );
		add_action( 'admin_init', array( $this, 'wphb_init_bf_banner' ) );

		// Init the API.
		$this->api = new Api\API();

		// Init logger.
		$this->logger = Logger::get_instance();
	}

	/**
	 * Load Black Friday.
	 *
	 * @since 3.3.7
	 */
	public function wphb_init_bf_banner() {
		$this->load_bf_module();

		if ( ! class_exists( 'WPMUDEV\BlackFriday\Banner' ) ) {
			return;
		}

		$labels = array(
			'close'       => esc_html__( 'Close', 'wphb' ),
			'get_deal'    => esc_html__( 'Get deal', 'wphb' ),
			'intro'       => esc_html__( 'Black Friday offer for WP businesses and agencies', 'wphb' ),
			'off'         => esc_html__( 'Off', 'wphb' ),
			'title'       => esc_html__( 'Everything you need to run your WP business for', 'wphb' ),
			'discount'    => '83.5',
			'price'       => '3000',
			'description' => wp_kses( __( "From the creators of Hummingbird, WPMU DEV's all-in-one platform gives you all the Pro tools and support you need to run and grow a web development business. Trusted by over 50,000 web developers. Limited deals available.", 'wphb' ), array() ),
		);

		$cta_url = add_query_arg(
			array(
				'coupon'	   => 'BFP-2022',
				'utm_source'   => 'hummingbird',
				'utm_medium'   => 'plugin',
				'utm_campaign' => 'BFP-2022-hummingbird',
				'utm_id'       => 'BFP-2022',
				'utm_term'     => 'BF-2022-plugin-Hummingbird',
				'utm_content'  => 'BF-2022',
			),
			esc_url( 'https://wpmudev.com/black-friday/' )
		);

		new \WPMUDEV\BlackFriday\Banner(
			$labels,
			$cta_url,
			\WPMUDEV\BlackFriday\Banner::HUMMIGNBIRD
		);
	}

	/**
	 * Load the banner module.
	 *
	 * @since 3.3.7
	 *
	 * @return void
	 */
	public function load_bf_module() {
		// Make sure to load banner module for free plugin only.
		if ( ! defined( 'WPHB_WPORG' ) || ! WPHB_WPORG ) {
			return;
		}

		$banner_file_path = WPHB_DIR_PATH . 'core/externals/blackfriday/banner.php';

		if ( ! file_exists( $banner_file_path ) ) {
			return;
		}

		require_once $banner_file_path;
	}

	/**
	 * Init integration modules.
	 *
	 * @since 2.1.0
	 */
	private function init_integrations() {
		new Integration\Builders();
		new Integration\Divi();
		new Integration\Gutenberg();
		new Integration\WPH();
		new Integration\SiteGround();
		Integration\Opcache::get_instance();
		Integration\Weglot::get_instance();
		new Integration\Wpengine();
		new Integration\WPMUDev();
		new Integration\Defender();
	}

	/**
	 * Load WP Hummingbird modules
	 */
	private function load_modules() {
		/**
		 * Filters the modules slugs list
		 */
		$modules = apply_filters(
			'wp_hummingbird_modules',
			array( 'minify', 'gzip', 'caching', 'performance', 'uptime', 'cloudflare', 'gravatar', 'page_cache', 'advanced', 'rss', 'redis' )
		);

		array_walk( $modules, array( $this, 'load_module' ) );
	}

	/**
	 * Add menu bar actions.
	 */
	private function add_menu_bar_actions() {
		if ( ! current_user_can( Utils::get_admin_capability() ) ) {
			return;
		}

		add_action( 'admin_bar_menu', array( $this, 'admin_bar_menu' ), 100 );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_global' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_global' ) );

		// Defer the loading of the global js.
		add_filter( 'script_loader_tag', array( $this, 'add_defer_attribute' ), 10, 2 );
	}

	/**
	 * Load a single module
	 *
	 * @param string $module  Module slug.
	 */
	public function load_module( $module ) {
		$parts = explode( '_', $module );
		$parts = array_map( 'ucfirst', $parts );
		$class = implode( '_', $parts );

		$class_name = 'Hummingbird\\Core\\Modules\\' . ucfirst( $class );

		/**
		 * Module.
		 *
		 * @var Module $module_obj
		 */
		$module_obj = new $class_name( $module );

		if ( $module_obj instanceof $class_name ) {
			if ( $module_obj->is_active() ) {
				$module_obj->run();
			}

			$this->modules[ $module ] = $module_obj;
			$this->logger->register_module( $module );
		}
	}

	/**
	 * Add HB menu to the admin bar
	 *
	 * @param WP_Admin_Bar $admin_bar  Admin bar.
	 */
	public function admin_bar_menu( $admin_bar ) {
		$menu = array();

		$active_modules = Utils::get_active_cache_modules();
		if ( empty( $active_modules ) ) {
			return; // No active caching modules - exit.
		}

		$minify    = Settings::get_setting( 'enabled', 'minify' );
		$pc_module = Settings::get_setting( 'enabled', 'page_cache' );

		// Do not strict compare $pc_module to true, because it can also be 'blog-admins'.
		if ( ! is_multisite() || ( ( 'super-admins' === $minify && is_super_admin() ) || true === $minify || true === (bool) $pc_module ) ) {
			$cache_control = Settings::get_setting( 'control', 'settings' );
			if ( true === $cache_control ) {
				$menu['wphb-clear-all-cache'] = array( 'title' => __( 'Clear all cache', 'wphb' ) );
			} elseif ( is_array( $cache_control ) ) {
				foreach ( $active_modules as $module => $name ) {
					if ( ! in_array( $module, $cache_control, true ) ) {
						continue;
					}

					if ( 'cloudflare' === $module ) {
						if ( Utils::get_module( 'cloudflare' )->is_connected() && Utils::get_module( 'cloudflare' )->is_zone_selected() ) {
							$menu['wphb-clear-cloudflare'] = array( 'title' => __( 'Clear Cloudflare cache', 'wphb' ) );
						}

						continue;
					}

					$menu[ 'wphb-clear-cache-' . $module ] = array(
						'title' => __( 'Clear', 'wphb' ) . ' ' . strtolower( $name ),
						'meta'  => array(
							'onclick' => "WPHBGlobal.clearCache(\"$module\");",
						),
					);
				}
			}
		}

		if ( is_multisite() && is_network_admin() && $pc_module ) {
			$menu['wphb-clear-cache-network-wide'] = array( 'title' => __( 'Clear page cache on all subsites', 'wphb' ) );
		}

		if ( ! is_admin() ) {
			if ( Utils::get_module( 'minify' )->is_active() ) {
				$avoid_minify = filter_input( INPUT_GET, 'avoid-minify', FILTER_VALIDATE_BOOLEAN );

				$menu['wphb-page-minify'] = array(
					'title' => $avoid_minify ? __( 'See this page minified', 'wphb' ) : __( 'See this page unminified', 'wphb' ),
					'href'  => $avoid_minify ? remove_query_arg( 'avoid-minify' ) : add_query_arg( 'avoid-minify', 'true' ),
				);
			}
		}

		if ( empty( $menu ) ) {
			return;
		}

		$menu_args = array(
			'id'    => 'wphb',
			'title' => __( 'Hummingbird', 'wphb' ),
			'href'  => admin_url( 'admin.php?page=wphb' ),
		);

		if ( is_multisite() && is_main_site() ) {
			$menu_args['href'] = network_admin_url( 'admin.php?page=wphb' );
		} elseif ( is_multisite() && ! is_main_site() ) {
			unset( $menu_args['href'] );
		}

		$admin_bar->add_node( $menu_args );
		foreach ( $menu as $id => $tab ) {
			$admin_bar->add_node(
				array(
					'id'     => $id,
					'parent' => $menu_args['id'],
					'title'  => $tab['title'],
					'href'   => isset( $tab['href'] ) ? $tab['href'] : '#',
					'meta'   => isset( $tab['meta'] ) ? $tab['meta'] : '',
				)
			);
		}
	}

	/**
	 * Enqueue global scripts.
	 *
	 * @since 1.9.3
	 */
	public function enqueue_global() {
		wp_enqueue_script(
			'wphb-global',
			WPHB_DIR_URL . 'admin/assets/js/wphb-global.min.js',
			array( 'underscore', 'jquery' ),
			WPHB_VERSION,
			true
		);

		wp_localize_script(
			'wphb-global',
			'wphbGlobal',
			array(
				'ajaxurl'    => admin_url( 'admin-ajax.php' ),
				'nonce'      => wp_create_nonce( 'wphb-fetch' ),
				'minify_url' => admin_url( 'admin.php?page=wphb-minification' ),
			)
		);
	}

	/**
	 * Defer global scripts.
	 *
	 * @since 1.9.3
	 *
	 * @param string $tag     HTML element tag.
	 * @param string $handle  Script handle.
	 *
	 * @return string
	 */
	public function add_defer_attribute( $tag, $handle ) {
		if ( 'wphb-global' !== $handle ) {
			return $tag;
		}
		return str_replace( ' src', ' defer="defer" src', $tag );
	}

	/**
	 * Register private policy text.
	 */
	public function privacy_policy_content() {
		if ( ! function_exists( 'wp_add_privacy_policy_content' ) ) {
			return;
		}

		$content = sprintf(
			'<h3>%s</h3><p>%s</p>',
			__( 'Third parties', 'wphb' ),
			sprintf(
				/* translators: %s: start of a href tag, %s: end of a tag */
				__( 'Hummingbird uses the Stackpath Content Delivery Network (CDN). Stackpath may store web log information of site visitors, including IPs, UA, referrer, Location and ISP info of site visitors for 7 days. Files and images served by the CDN may be stored and served from countries other than your own. Stackpath’s privacy policy can be found %1$shere%2$s.', 'wphb' ),
				'<a href="https://www.stackpath.com/legal/privacy-statement/" target="_blank">',
				'</a>'
			)
		);

		wp_add_privacy_policy_content(
			__( 'Hummingbird', 'wphb' ),
			wp_kses_post( wpautop( $content, false ) )
		);
	}

	/**
	 * Show upsell notice for the newsletter.
	 *
	 * @since 2.5.0
	 */
	public function upsell_notice() {
		if ( ! defined( 'WPHB_WPORG' ) || ! WPHB_WPORG ) {
			return;
		}

		if ( ! file_exists( WPHB_DIR_PATH . 'core/externals/free-dashboard/module.php' ) ) {
			return;
		}

		// If dash plugin exists, no need to upsell.
		if ( class_exists( 'WPMUDEV_Dashboard' ) || file_exists( WP_PLUGIN_DIR . '/wpmudev-updates/update-notifications.php' ) ) {
			return;
		}

		/* @noinspection PhpIncludeInspection */
		require_once WPHB_DIR_PATH . 'core/externals/free-dashboard/module.php';

		// Add the Mailchimp group value.
		add_action(
			'frash_subscribe_form_fields',
			function ( $mc_list_id ) {
				if ( '4b14b58816' === $mc_list_id ) {
					echo '<input type="hidden" id="mce-group[53]-53-1" name="group[53][4]" value="4" />';
				}
			}
		);

		// Register the current plugin.
		do_action(
			'wdev_register_plugin',
			/* 1             Plugin ID */ WPHB_BASENAME,
			/* 2          Plugin Title */ 'Hummingbird',
			/* 3 https://wordpress.org */ '/plugins/hummingbird-performance/',
			/* 4      Email Button CTA */ __( 'Get Fast!', 'wphb' ),
			/* 5  Mailchimp List id for the plugin - e.g. 4b14b58816 is list id for Smush */ '4b14b58816'
		);

		// The email message contains 1 variable: plugin-name.
		add_filter(
			'wdev_email_message_' . WPHB_BASENAME,
			function () {
				return "You're awesome for installing %s! Make sure you get the most out of it, boost your Google PageSpeed score with these tips and tricks - just for users of Hummingbird!";
			}
		);
	}

	/**
	 * Init safe mode.
	 *
	 * @since 3.4.0
	 *
	 * @return void
	 */
	private function init_ao_safe_mode() {
		$status = filter_input( INPUT_GET, 'minify-safe', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );

		if ( true !== $status ) {
			return;
		}

		if ( ! Minify::get_safe_mode_status() ) {
			return;
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		add_action( 'wp_body_open', array( $this, 'display_safe_mode_box' ) );
	}

	/**
	 * Display safe mode DIV on front-end.
	 *
	 * @since 3.4.0
	 *
	 * @return void
	 */
	public function display_safe_mode_box() {
		?>
		<div id="wphb-ao-safe-mode">
			<div id="wphb-ao-safe-mode-actions">
				<a role="button" href="<?php echo admin_url( 'admin.php?page=wphb-minification' ); ?>"
				   id="wphb-ao-safe-mode-back"><?php esc_html_e( 'Go Back', 'wphb' ); ?></a>

				<div>
					<a href="#" id="wphb-ao-safe-mode-copy">
						<span><?php esc_html_e( "Copy Test Link", 'wphb' ); ?></span>
						<span><?php esc_html_e( "Link Copied", 'wphb' ); ?></span>
					</a>
					<button role="button" id="wphb-ao-safe-mode-save"><?php esc_html_e( 'Publish', 'wphb' ); ?></button>
				</div>
			</div>
			<p><?php esc_html_e( "You are currently viewing the frontend of your website in Safe Mode preview. Check for any errors in your browser's console or broken UI. You can also test with page speed tools in order to see how the changes affected the score. When ready, publish your changes to live.", 'wphb' ); ?></p>
			<style>
				#wphb-ao-safe-mode {
					z-index: 99999;
					position: sticky;
					top: 32px;
					left: 0;
					width: 100%;
					min-width: 600px;
					background: #FFFFFF;
					display: flex;
					flex-direction: column;
					align-items: center;
					padding: 30px 80px;
					font-weight: 400;
					font-size: 15px;
					line-height: 30px;
					letter-spacing: -0.25px;
					color: #333333;
					box-shadow: 0 0 40px rgba(0, 0, 0, 0.1);
					box-sizing: border-box;
				}

				#wphb-ao-safe-mode p { 
					margin: 0;
					font-size: 13px;
					line-height: 22px;
				}

				#wphb-ao-safe-mode-actions {
					display: flex;
					justify-content: space-between;
					width: 100%;
					margin-bottom: 15px;
				}

				@media screen and ( max-width: 385px ) {
					#wphb-ao-safe-mode-actions {
						flex-direction: column;
						align-items: flex-start;
					}

					#wphb-ao-safe-mode-actions > div {
						display: flex;
						flex-direction: column;
						align-items: flex-start;
					}

					#wphb-ao-safe-mode-copy {
						padding: 10px 0;
					}
				}

				#wphb-ao-safe-mode-copy {
					font-size: 13px;
					font-weight: 500;
					line-height: 22px;
					color: #17A8E3;
					margin-right: 21px;
					text-decoration: none;
					position: relative;
				}

				#wphb-ao-safe-mode-copy span:first-child {
					display: inline;
				}

				#wphb-ao-safe-mode-copy span:last-child {
					display: none;
				}

				#wphb-ao-safe-mode-copy.wphb-ao-safe-mode-copy-success:after {
					font-family: dashicons;
					content: '\f15e';
					vertical-align: middle;
					left: 103%;
					position: absolute;
					top: -1px;
				}

				#wphb-ao-safe-mode-copy.wphb-ao-safe-mode-copy-success span:first-child {
					display: none;
				}

				#wphb-ao-safe-mode-copy.wphb-ao-safe-mode-copy-success span:last-child {
					display: inline;
				}

				#wphb-ao-safe-mode [role="button"] {
					border: 2px solid #DDDDDD;
					border-radius: 4px;
					background: #FFFFFF;
					padding: 7px 16px;
					text-transform: uppercase;
					font-weight: 700;
					font-size: 12px;
					line-height: 16px;
					letter-spacing: -0.25px;
					color: #888888;
					text-decoration: none;
				}

				#wphb-ao-safe-mode [role="button"]:hover {
					text-decoration: none;
				}

				#wphb-ao-safe-mode [role="button"]:before {
					font-family: dashicons;
					font-size: 18px;
					line-height: 16px;
					margin-right: 5px;
					vertical-align: bottom;
					content: '\f341';
				}

				#wphb-ao-safe-mode [role="button"]:hover { cursor: pointer; }
				#wphb-ao-safe-mode-actions div [role="button"]:before { content: '\f15e'; }

				#wphb-ao-safe-mode-actions div [role="button"] {
					background: #17A8E3;
					border-color: #17A8E3;
					color: #FFFFFF;
				}

				#wphb-ao-safe-mode-actions div [role="button"][disabled] {
					background: #DDDDDD;
					border-color: #DDDDDD;
					cursor: default;
				}

				@media screen and ( max-width: 782px ) {
					#wphb-ao-safe-mode {
						display: block;
						padding: 20px 20px;
						min-width: 240px;
						top: 46px;
					}
				}
			</style>
		</div>
		<?php
	}

}
