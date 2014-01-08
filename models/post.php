<?php

class Post extends ModelAbstract{

    public function __construct(){
        parent::init(POS_PRM_KEY, POS_TABLE);
    }
} 