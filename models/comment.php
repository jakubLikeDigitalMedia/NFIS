<?php

class Comment extends ModelAbstract{

    public function __construct(){
        parent::init(C_PRM_KEY, C_TABLE);
    }
} 