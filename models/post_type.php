<?php

class PostType extends ModelAbstract{

    public function __construct(){
        parent::init(PT_PRM_KEY, PT_TABLE);
    }
} 