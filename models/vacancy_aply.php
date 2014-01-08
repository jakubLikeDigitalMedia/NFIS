<?php

class VacancyAply extends ModelAbstract{

    public function __construct(){
        parent::init(VA_PRM_KEY, VA_TABLE);
    }
} 