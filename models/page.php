<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 16/12/2013
 * Time: 13:07
 */

class Page extends ModelAbstract{

    const TABLE = 'page';
    const PRM_KEY = 'page_id';

    const SECTION = 'id_section';
    const TITLE = 'title';
    const CODE = 'code';


    public function __construct(){
        parent::init(self::PRM_KEY, self::TABLE);
    }

    public function renderNavigation(){
        $nav = 'Navigation';
        return $nav;
    }

    public function getSiteMapWithPermissions(){

        $section = new Section();
        $permissions = new Permissions();

        $query = "SELECT
        ". $section->getSqlQueryField(Section::TITLE) . " AS 'section_title',
        ". $section->getSqlQueryField(Section::PRM_KEY) ." AS 'section_id',
        ". $section->getSqlQueryField(Section::CODE) ." AS 'section_code',
        ". $this->getSqlQueryField(self::PRM_KEY) ." AS page_id,
        ". $this->getSqlQueryField(self::TITLE) ." AS page_title,
        ". $this->getSqlQueryField(self::CODE) ." AS page_code,
        ". $permissions->getSqlQueryField(Permissions::GROUP) ." AS permissions_group_id,
        ". $permissions->getSqlQueryField(Permissions::ADD_POST) ." AS permissions_add_post,
        ". $permissions->getSqlQueryField(Permissions::ADD_COMMENT) ." AS permissions_add_comment,
        ". $permissions->getSqlQueryField(Permissions::ADD_VOTE) ." AS permissions_add_vote
            FROM ". self::TABLE ."
            LEFT JOIN ". Section::TABLE ." ON ". $this->getSqlQueryField(self::SECTION) ." = ". $section->getSqlQueryField(Section::PRM_KEY) ."
            LEFT JOIN ". Permissions::TABLE ." ON ". $permissions->getSqlQueryField(Permissions::PAGE) ." = ". $this->getSqlQueryField(self::PRM_KEY) ."
            ORDER BY section_id";

        //die($query);
        $resultArray = $this->getRecords($query, 'object');
        //var_dump($resultArray);
        $pageArray = array();
        $sectionArray = array();
        $previousSectionId = NULL;
        $previousPage = NULL;
        $i = 1;
        foreach($resultArray as $pageId => $page){

            $currentSectionId = $page->section_id;
            if (($currentSectionId != $previousSectionId) AND !empty($previousSectionId)){
                $sectionArray[$previousPage->section_id] = array(
                    "title" => $previousPage->section_title,
                    "code" => $previousPage->section_code,
                    "pages" => $pageArray
                );
                $pageArray = array();
            }

            $pageArray[$pageId] = array(
                "title" => $page->page_title,
                "code" => $page->page_code,
                "grp_id" => $page->permissions_group_id,
                "add_post" => $page->permissions_add_post,
                "add_comment" => $page->permissions_add_comment,
                "add_vote" => $page->permissions_add_vote
            );

            if( count($resultArray) == $i){
                $sectionArray[$page->section_id] = array(
                    "title" => $page->section_title,
                    "code" => $page->section_code,
                    "pages" => $pageArray
                );
                $pageArray = array();
            }

            $previousSectionId = $page->section_id;
            $previousPage = $page;
            $i++;
        }
        return $sectionArray;
    }

} 