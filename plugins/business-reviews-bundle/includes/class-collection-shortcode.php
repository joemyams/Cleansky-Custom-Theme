<?php

namespace WP_Business_Reviews_Bundle\Includes;

use WP_Business_Reviews_Bundle\Includes\Core\Core;
use WP_Business_Reviews_Bundle\Includes\View\View;

class Collection_Shortcode {

    public function __construct(Collection_Deserializer $collection_deserializer, Core $core, View $view, Assets $assets) {
        $this->collection_deserializer = $collection_deserializer;
        $this->core = $core;
        $this->view = $view;
        $this->assets = $assets;
    }

    public function register() {
        add_shortcode('brb_collection', array($this, 'init'));
    }

    public function init($atts) {
        if (get_option('brb_active') === '0') {
            return '';
        }

        $atts = shortcode_atts(array(
            'id' => 0,
        ), $atts, 'brb_collection');

        $collection = $this->collection_deserializer->get_collection($atts['id']);

        if (!$collection) {
            return null;
        }

        $data = $this->core->get_reviews($collection);
        $businesses = $data['businesses'];
        $reviews = $data['reviews'];
        $options = $data['options'];

        if (isset($options->page_exclude) && strlen($options->page_exclude) > 0) {
            $url = parse_url(home_url($_SERVER['REQUEST_URI']));
            $page_exclude = urldecode($options->page_exclude);
            $pages = explode(',', $page_exclude);
            foreach ($pages as $page) {
                $page = urldecode($page);
                if (fnmatch($page, $url['path'])) {
                    return null;
                }
            }
        }

        $brb_demand_assets = get_option('brb_demand_assets');
        if ($brb_demand_assets || $brb_demand_assets == 'true') {
            $this->assets->enqueue_public_styles();
            $this->assets->enqueue_public_scripts();
        }

        return $this->view->render($collection->ID, $businesses, $reviews, $options);
    }
}
