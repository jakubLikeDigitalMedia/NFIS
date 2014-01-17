<?php

class Section extends ModelAbstract{

    const TABLE = 'section';
    const PRM_KEY = 'section_id';

    const PARENT = 'parent_id';
    const TITLE = 'title';
    const CODE = 'code';
    const ORDER = 'order';

    public function __construct(){
        parent::init(self::PRM_KEY, self::TABLE);
    }
} 