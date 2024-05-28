<?php
function wp_get_menu_array($current_menu)
{
    $elements = wp_get_nav_menu_items($current_menu);


/*
    $array_menu = wp_get_nav_menu_items($current_menu);
    $menu = array();
    foreach ($array_menu as $m) {
        if (empty($m->menu_item_parent)) {

            $menu[$m->ID] = array();
            $menu[$m->ID]['id']      =   $m->ID;
            $menu[$m->ID]['title']       =   $m->title;
            $menu[$m->ID]['url']         =   $m->url;
            $menu[$m->ID]['post_content']  =   $m->post_content;
            $menu[$m->ID]['menu_item_parent']  =   $m->menu_item_parent;
                    //    $menu[$m->ID]['array']  =   $m;
            $menu[$m->ID]['children']    =   [];
        }
    }

    $submenu = array();
    foreach ($array_menu as $m) {
        if ($m->menu_item_parent) {
            $submenu[$m->ID] = array();
            $submenu[$m->ID]['id']  =   $m->ID;
            $submenu[$m->ID]['title'] =   $m->title;
            $submenu[$m->ID]['url']  =   $m->url;
            $submenu[$m->ID]['post_content']  =   $m->post_content;
            //            $menu[$m->ID]['array']  =   $m;
            $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
        }
    }   


    return $menu;
*/
}

function buildTree($elements, $parentId = 0)
    {
        $branch = array();
        foreach ($elements as $element )
        {
            if ( $element->menu_item_parent == $parentId )
            {
                $children = buildTree($elements, $element->ID );
                $element->id = $element->ID;
                if ( $children )
                    $element->children = $children;

                $branch[$element->ID] = $element;
                unset( $element );
            }
        }
        return $branch;        
    };

function load_menu($menu_name)
{
    $menu_name = $menu_name; //'primary';
    $locations = get_nav_menu_locations();
    //Get the id of 'primary_menu'
    $menu_id = $locations[ $menu_name ] ;
    //Returns a navigation menu object.
    $menuObject = wp_get_nav_menu_object($menu_id);
    // Retrieves all menu items of a navigation menu.
    $current_menu = $menuObject->slug;
    // $array_menu = wp_get_menu_array($current_menu);
    $array_menu = buildTree(wp_get_nav_menu_items($current_menu));
    return  $array_menu;
}
?>