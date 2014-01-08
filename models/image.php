<?php

class Image extends ModelAbstract{

    public function __construct(){
        parent::init(I_PRM_KEY, I_TABLE);
    }
} 