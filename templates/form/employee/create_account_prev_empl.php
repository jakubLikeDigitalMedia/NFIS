<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 06/01/2014
 * Time: 15:03
 */



?>



        <div class="new-block <?php echo (!$hide)? '': 'original hide'?>">
            <button type="button" class="remove-block">Remove</button>
            <div class="form-input">
                <label class="form-label-left" for="position"> Possition </label>
                <div class="error"><?=  get_field_error(PREV_PREFIX.EMPL_TABLE.SEP.EMPL_POSITION, $inputErrors) ?></div>
                <select class="form-dropdown" style="width:150px" id="position" name="<?= PREV_PREFIX.EMPL_TABLE.SEP.EMPL_POSITION ?>[]">
                    <?= $htmlGen->renderSelectOptions($positionList, get_field_value(PREV_PREFIX.EMPL_TABLE.SEP.EMPL_POSITION, $userInputs))?>
                </select>
            </div>
            <div class="form-input">
                <label class="form-label-left" for="brand"> Brand </label>
                <div class="error"><?=  get_field_error(PREV_PREFIX.EMPL_TABLE.SEP.EMPL_BRAND, $inputErrors) ?></div>
                <select class="form-dropdown" style="width:150px" id="brand" name="<?= PREV_PREFIX.EMPL_TABLE.SEP.EMPL_BRAND ?>[]">
                    <?= $htmlGen->renderSelectOptions($brandList, get_field_value(PREV_PREFIX.EMPL_TABLE.SEP.EMPL_BRAND, $userInputs))?>
                </select>
            </div>
            <div class="form-input">
                <label class="form-label-left" for="department"> Department </label>
                <div class="error"><?=  get_field_error(PREV_PREFIX.EMPL_TABLE.SEP.EMPL_DEPARTMENT, $inputErrors) ?></div>
                <select class="form-dropdown" style="width:150px" id="department" name="<?= PREV_PREFIX.EMPL_TABLE.SEP.EMPL_DEPARTMENT ?>[]">
                    <?= $htmlGen->renderSelectOptions($departmentList, get_field_value(PREV_PREFIX.EMPL_TABLE.SEP.EMPL_DEPARTMENT, $userInputs))?>
                </select>
            </div>
            <div class="form-input">
                <label class="form-label-left" for="location"> Location </label>
                <div class="error"><?=  get_field_error(PREV_PREFIX.EMPL_TABLE.SEP.EMPL_LOCATION, $inputErrors) ?></div>
                <select class="form-dropdown" style="width:150px" id="location" name="<?= PREV_PREFIX.EMPL_TABLE.SEP.EMPL_LOCATION ?>[]">
                    <?= $htmlGen->renderSelectOptions($locationList, get_field_value(PREV_PREFIX.EMPL_TABLE.SEP.EMPL_LOCATION, $userInputs))?>
                </select>
            </div>
            <ul>
                <li class="form-line" id="id_13">
                    <label class="form-label-left" id="label_13" for="street"> House number & Street </label>
                    <div class="error"><?=  get_field_error(PREV_PREFIX.OA_TABLE.SEP.OA_STREET, $inputErrors) ?></div>
                    <div id="cid_13" class="form-input">
                        <input type="text" class=" form-textbox" data-type="input-textbox" id="street" name="<?= PREV_PREFIX.OA_TABLE.SEP.OA_STREET ?>[]" size="40" value="<?= get_field_value(PREV_PREFIX.OA_TABLE.SEP.OA_STREET, $userInputs, 'Enter your house number and street') ?>" />
                    </div>
                </li>
                <li class="form-line" id="id_14">
                    <label class="form-label-left" id="label_14" for="postcode"> Postcode </label>
                    <div class="error"><?=  get_field_error(PREV_PREFIX.OA_TABLE.SEP.OA_POSTCODE, $inputErrors) ?></div>
                    <div id="cid_14" class="form-input">
                        <input type="text" class=" form-textbox" data-type="input-textbox" id="postcode" name="<?= PREV_PREFIX.OA_TABLE.SEP.OA_POSTCODE ?>[]" size="20" value="<?= get_field_value(PREV_PREFIX.OA_TABLE.SEP.OA_POSTCODE, $userInputs, 'Enter postcode')?>" maxlength="20" />
                    </div>
                </li>
                <li class="form-line" id="id_15">
                    <label class="form-label-left" id="label_15" for="city"> City </label>
                    <div class="error"><?=  get_field_error(PREV_PREFIX.OA_TABLE.SEP.OA_CITY, $inputErrors) ?></div>
                    <div id="cid_15" class="form-input">
                        <input type="text" class=" form-textbox" data-type="input-textbox" id="city" name="<?= PREV_PREFIX.OA_TABLE.SEP.OA_CITY ?>[]" size="40" value="<?= get_field_value(PREV_PREFIX.OA_TABLE.SEP.OA_CITY, $userInputs, 'Enter city')?>" />
                    </div>
                </li>
                <li class="form-line" id="id_16">
                    <label class="form-label-left" id="label_16" for="county"> County </label>
                    <div class="error"><?=  get_field_error(PREV_PREFIX.OA_TABLE.SEP.OA_COUNTY, $inputErrors) ?></div>
                    <div id="cid_16" class="form-input">
                        <input type="text" class=" form-textbox" data-type="input-textbox" id="county" name="<?= PREV_PREFIX.OA_TABLE.SEP.OA_COUNTY ?>[]" size="40" value="<?= get_field_value(PREV_PREFIX.OA_TABLE.SEP.OA_COUNTY, $userInputs, 'Enter county')?>" />
                    </div>
                </li>
            </ul>
        </div>

