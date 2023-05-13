<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class RecentReports extends Widget_Base
{

    public function get_name()
    {
        return 'recent_reports';
    }

    public function get_title()
    {
        return 'Recent Reports';
    }

    public function get_icon()
    {
        return 'eicon-document-file';
    }

    public function get_categories()
    {
        return ['ippi-elements'];
    }


     protected function register_controls()
     {
         require('controls/control-recent-reports.php');

         // Style Tab
         $this->style_tab();
     }

     private function style_tab()
     {
         //include styles
         //require ('../style_tab.php');
     }

     protected function render()
     {
         $settings = $this->get_settings_for_display();

         //include html
         ob_start();
         include('render-widget/recent-reports-html.php');
         echo ob_get_clean();
     }
}
