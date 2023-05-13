<?php

namespace WPC;

// use Elementor\Plugin; ?????

class Widget_Loader
{

    private static $_instance = null;

    public function __construct()
    {
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets'], 99);
        add_action('plugins_loaded', [$this, 'init']);
        // Add new Elementor Categories
        add_action('elementor/elements/categories_registered', [$this, 'ippi_add_elementor_category']);
    }

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function register_widgets()
    {

        $this->include_widgets_files();
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\FeaturedContent());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\SpecialsProjects());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ImageWithContent());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\LatestContentCarousel());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ExpertsCarousel());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\RelatedProgramsCarousel());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Topics());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Partners());
        // \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ExpertSpotlight());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ReletedContentCarousel());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\EventDropdown());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\IssueAreas());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\SearchArchiveList());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\PublicationArchiveFilter());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\JobsAndFellowships());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ContentLeads());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\RelatedPosts());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ImageFullBanner());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Authors());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Downloads());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\RecentReports());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ShareThisPage());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ExpertsList());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ProjectsList());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ProgramsList());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Agenda());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\OverviewContent());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Expertise());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\PublicationList());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\CategoryHeroSectction());
        //\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Image_Box());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Explainers());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\CTA());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\FormSelect());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\EventDetails());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Testimonials());
        // \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\MediaHeadingSection());
        // \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ExplainerPost());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\TopicsList());
    }

    private function include_widgets_files()
    {
        require_once(plugin_dir_path(__FILE__) . 'widget/featured-content.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/special-projects.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/image-with-content.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/latest-content-carousel.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/experts-carousel.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/related-programs-carousel.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/topics.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/partners.php');
        // require_once(plugin_dir_path(__FILE__) . 'widget/expert_spotlight.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/related-content-carousel.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/event-dropdown.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/issue-areas.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/search-archive-list.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/publication-archive-filter.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/jobs-and-fellowship.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/content-leads.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/related-posts.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/image-full-banner.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/authors.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/downloads.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/recent_reports.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/share-this-page.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/experts-list.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/projects-list.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/programs-list.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/agenda.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/overview-content.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/expertise.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/publication-list.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/category-hero-section.php');
        //require_once(plugin_dir_path(__FILE__) . 'widget/image-box.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/explainer-slider.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/cta.php');   
        require_once(plugin_dir_path(__FILE__) . 'widget/form-select.php');     
        require_once(plugin_dir_path(__FILE__) . 'widget/event-details.php');  
        require_once(plugin_dir_path(__FILE__) . 'widget/testimonial.php');
        // require_once(plugin_dir_path(__FILE__) . 'widget/media-heading-section.php');
        // require_once(plugin_dir_path(__FILE__) . 'widget/explainer-post.php');
        require_once(plugin_dir_path(__FILE__) . 'widget/topics-list.php');

    }

    /**
     * Load Scripts & Styles
     * @since 1.0.0
     */

    /**
     * Add new Elementor Categories
     *
     * Register new widget categories for Fitfloss widgets.
     *
     * @access public
     */
    public function ippi_add_elementor_category()
    {
        \Elementor\Plugin::instance()->elements_manager->add_category('ippi-elements', [
            'title' => __('Ippi Elements', 'ippi-elementor-child'),
        ], 1);
    }

    /**
     * Initialize the plugin
     * @since 1.0.0
     */
    public function init()
    {
        // Check if the ELementor installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            return;
        }
    }

    /**
     * Admin Notice
     * Warning when the site doesn't have Elementor installed or activated
     * @since 1.0.0
     */
    public function admin_notice_missing_main_plugin()
    {
        if (isset($_GET['activate'])) unset($_GET['activate']);
        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" to be installed and activated', 'my-elementor-widget'),
            '<strong>' . esc_html__('My Elementor Widget', 'my-elementor-widget') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'my-elementor-widget') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dimissible"><p>%1$s</p></div>', $message);
    }
}

// Instantiate Plugin Class
Widget_Loader::instance();
