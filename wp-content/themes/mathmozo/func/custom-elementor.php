<?php
namespace WPC;

// use Elementor\Plugin; ?????

class Widget_Loader{

    private static $_instance = null;

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }


    private function include_widgets_files(){
//        require_once(get_template_directory(). '/elementors/advertisement.php');
        require_once(get_template_directory(). '/elementors/PageHeader.php');
    }

    public function register_widgets(){

        $this->include_widgets_files();

//        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Advertisement());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\PageHeader());

    }

    function add_elementor_widget_categories( $elements_manager ) {

//        $elements_manager->add_category(
//            'a_mathmozo_ele_cat',
//            [
//                'title' => esc_html__( 'Mathmozo', 'mmele' ),
//                'icon' => 'fas fa-plug',
//            ]
//        );
        $categories = [];
        $categories['mathmozo_ele_cat'] =
            [
                'title' => 'Mathmozo',
                'icon'  => 'fa fa-plug'
            ];
        /*
        $elements_manager->add_category(
            'second-category',
            [
                'title' => esc_html__( 'Second Category', 'textdomain' ),
                'icon' => 'fa fa-plug',
            ]
        );
        */
        $old_categories = $elements_manager->get_categories();
        $categories = array_merge($categories, $old_categories);

        $set_categories = function ( $categories ) {
            $this->categories = $categories;
        };

        $set_categories->call( $elements_manager, $categories );
    }

    public function __construct(){
        add_action('elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories'], 50);
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets'], 99);
    }



}

// Instantiate Plugin Class
Widget_Loader::instance();


