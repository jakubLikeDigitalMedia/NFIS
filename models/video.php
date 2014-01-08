<?php

class Video extends ModelAbstract{

    public function __construct(){
        parent::init(V_PRM_KEY, V_TABLE);
    }
} 