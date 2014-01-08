<?php

class PostMedia extends ModelAbstract{

    public function __construct(){
        parent::init(PM_PRM_KEY, PM_TABLE);
    }
} 