<?php

class Vacancy extends ModelAbstract{

    public function __construct(){
        parent::init(VAC_PRM_KEY, VAC_TABLE);
    }
} 