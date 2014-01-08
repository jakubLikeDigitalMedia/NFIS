<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 16/12/2013
 * Time: 13:07
 */

class Page {

    public function __construct(){
        parent::init(PAG_PRM_KEY, PAG_TABLE);
    }

    public function renderNavigation(){
        $nav = 'Navigation';
        return $nav;
    }
} 