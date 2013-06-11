<?php
require_once(dirname(__FILE__).'/../select/'.'field_select.php'); 
class rh_Options_menu_select extends rh_Options_select  {

    /**
     * Field Constructor.
     *
     * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
     *
     * @since rh_Options 1.0.0
    */
    function __construct($field = array(), $value ='', $parent) {
        $this->field = $field;
		$this->value = $value;
		$this->args = $parent->args;
		
        $menus = wp_get_nav_menus($args);
        if($menus) {
            foreach ($menus as $menu) {
				$this->field['options'][$menu->term_id] = $menu->name;
			}
		}
    }
}