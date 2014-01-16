<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 13/12/2013
 * Time: 13:30
 */


include_once str_replace(basename(__FILE__), 'config.php', __FILE__);
include_once LIBS.'/session_manager.php';
include_once LIBS.'/dbmanager.php';
include_once LIBS.'/db_query_manager.php';
include_once LIBS.'/is_exception.php';
include_once LIBS.'/errormanager.php';
include_once LIBS.'/htmlgen.php';
include_once LIBS.'/gump.class.php';
include_once LIBS.'/input_validator.php';
include_once LIBS.'/helpers.php';
include_once LIBS.'/form_generator.php';
include_once LIBS.'/form_helper.php';

// models include
include_once MODELS . '/model_abstract.php';

include_once MODELS_DEF . '/employee.php';
include_once MODELS . '/employee.php';

include_once MODELS_DEF . '/address.php';
include_once MODELS . '/address.php';

include_once MODELS_DEF . '/employment.php';
include_once MODELS . '/employment.php';


include_once MODELS_DEF . '/brand.php';
include_once MODELS . '/brand.php';

include_once MODELS_DEF . '/location.php';
include_once MODELS . '/location.php';

include_once MODELS_DEF . '/position.php';
include_once MODELS . '/position.php';

include_once MODELS_DEF . '/department.php';
include_once MODELS . '/department.php';

include_once MODELS_DEF . '/group.php';
include_once MODELS . '/group.php';

include_once MODELS_DEF . '/page.php';
include_once MODELS . '/page.php';

include_once MODELS_DEF . '/permissions.php';
include_once MODELS . '/permissions.php';

include_once MODELS_DEF . '/section.php';
include_once MODELS . '/section.php';
