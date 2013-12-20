<?php
$htmlGen = HtmlGenerator::getInstance();
$brand = new Brand();
$position =  new Position();
$location = new Location();
$department = new Department();
$employee = new Employee();
$superiorList = $employee->getSuperiors();
$brandList = $brand->getPropertyList('title', 'title');
$positionList = $position->getPropertyList('title');
$locationList = $location->getPropertyList('title');
$departmentList = $department->getPropertyList('title');

$inputErrors = (isset($_SESSION['user']['input_errors']))? $_SESSION['user']['input_errors']: array();
$userInputs = (isset($_SESSION['user']['inputs']))? $_SESSION['user']['inputs']: array();

?>

<form action="../scripts/create_account.php" method="post" name="create-account" id="create-account" accept-charset="utf-8">
  <div class="form-all">
    <fieldset>
        <label>Personal Information</label>
        <ul class="form-section">
          <li class="form-line">
            <label for="name"> Name </label>
              <div class="error"><?=  get_field_error(E_TABLE.SEP.E_NAME, $inputErrors) ?></div>
            <div class="form-input">
              <input type="text" id="name" name="<?= E_TABLE.SEP.E_NAME?>" size="40" value="<?= get_field_value(E_TABLE.SEP.E_NAME, $userInputs,'Enter you name ') ?>" />
            </div>
          </li>
          <li class="form-line">
            <label for="surname"> Surname </label>
              <div class="error"><?=  get_field_error(E_TABLE.SEP.E_SURNAME, $inputErrors) ?></div>
            <div class="form-input">
              <input type="text" id="surname" name=<?= E_TABLE.SEP.E_SURNAME ?> size="40" value="<?= get_field_value(E_TABLE.SEP.E_SURNAME, $userInputs, 'Enter you surname ') ?>" />
            </div>
          </li>
          <li class="form-line" >
            <label class="form-label-left" for="dob"> Date of Birth </label>
              <div class="error"><?=  get_field_error(E_TABLE.SEP.E_DOB, $inputErrors) ?></div>
            <div id="cid_5" class="form-input">
              <input type="text" class=" form-textbox" data-type="input-textbox" id="dob" name=<?= E_TABLE.SEP.E_DOB ?> size="40" value="<?= get_field_value(E_TABLE.SEP.E_DOB, $userInputs, 'click here to see calendar') ?>"/>
            </div>
          </li>
          <li class="form-line">
            <label class="form-label-left" for="email"> Email </label>
              <div class="error"><?=  get_field_error(E_TABLE.SEP.E_EMAIL, $inputErrors) ?></div>
            <div id="cid_7" class="form-input">
              <input type="text" class=" form-textbox" data-type="input-textbox" id="email" name=<?= E_TABLE.SEP.E_EMAIL ?> size="40" value="<?= get_field_value(E_TABLE.SEP.E_EMAIL, $userInputs, 'Enter you email') ?>"  />
            </div>
          </li>
          <li class="form-line">
            <label class="form-label-left" for="phone"> Tel. Number </label>
              <div class="error"><?=  get_field_error(E_TABLE.SEP.E_PHONE_NUMBER, $inputErrors) ?></div>
            <div id="cid_6" class="form-input">
              <input type="text" class=" form-textbox" data-type="input-textbox" id="phone" name=<?= E_TABLE.SEP.E_PHONE_NUMBER ?> size="40" value="<?= get_field_value(E_TABLE.SEP.E_PHONE_NUMBER, $userInputs, 'Enter you phone number') ?>"  />
            </div>
          </li>
          <li class="form-line">
            <label class="form-label-left" id="label_8" for="position"> Job Title </label>
              <div class="error"><?=  get_field_error(EMPL_TABLE.SEP.EMPL_POSITION, $inputErrors) ?></div>
            <div id="cid_8" class="form-input">
              <select class="form-dropdown" style="width:150px" id="position" name="<?= EMPL_TABLE.SEP.EMPL_POSITION ?>">
                  <?= $htmlGen->renderSelectOptions($positionList, get_field_value(EMPL_TABLE.SEP.EMPL_POSITION, $userInputs))?>
              </select>
            </div>
          </li>
          <li class="form-line" id="id_9">
            <label class="form-label-left" id="label_9" for="brand"> Brand </label>
              <div class="error"><?=  get_field_error(EMPL_TABLE.SEP.EMPL_BRAND, $inputErrors) ?></div>
            <div id="cid_9" class="form-input">
              <select class="form-dropdown" style="width:150px" id="brand" name="<?= EMPL_TABLE.SEP.EMPL_BRAND ?>">
                  <?= $htmlGen->renderSelectOptions($brandList, get_field_value(EMPL_TABLE.SEP.EMPL_BRAND, $userInputs))?>
              </select>
            </div>
          </li>
          <li class="form-line" id="id_10">
            <label class="form-label-left" id="label_10" for="department"> Department </label>
            <div class="error"><?=  get_field_error(EMPL_TABLE.SEP.EMPL_DEPARTMENT, $inputErrors) ?></div>
            <div id="cid_10" class="form-input">
              <select class="form-dropdown" style="width:150px" id="department" name="<?= EMPL_TABLE.SEP.EMPL_DEPARTMENT ?>">
                  <?= $htmlGen->renderSelectOptions($departmentList, get_field_value(EMPL_TABLE.SEP.EMPL_DEPARTMENT, $userInputs))?>
              </select>
            </div>
          </li>
            <li class="form-line">
                <label for="location"> Location </label>
                <div class="error"><?=  get_field_error(EMPL_TABLE.SEP.EMPL_LOCATION, $inputErrors) ?></div>
                <div id="cid_10" class="form-input">
                    <select class="form-dropdown" style="width:150px" id="location" name="<?= EMPL_TABLE.SEP.EMPL_LOCATION ?>">
                        <?= $htmlGen->renderSelectOptions($locationList, get_field_value(EMPL_TABLE.SEP.EMPL_LOCATION, $userInputs))?>
                    </select>
                </div>
            </li>
          <li class="form-line" id="id_11">
            <label class="form-label-left" id="label_11" for="superior"> Superior </label>
              <div class="error"><?=  get_field_error(E_TABLE.SEP.E_PARENT, $inputErrors) ?></div>
              <select class="form-dropdown" style="width:150px" id="location" name="<?= E_TABLE.SEP.E_PARENT ?>">
                  <?= $htmlGen->renderSelectOptions($superiorList, get_field_value(E_TABLE.SEP.E_PARENT, $userInputs))?>
              </select>
          </li>
        </ul>
        </fieldset>
  </div>
  <div>
    <fieldset>
      <legend>Office Address</legend>
        <ul>
          <li class="form-line" id="id_13">
            <label class="form-label-left" id="label_13" for="street"> House number & Street </label>
            <div class="error"><?=  get_field_error(OA_TABLE.SEP.OA_STREET, $inputErrors) ?></div>
            <div id="cid_13" class="form-input">
              <input type="text" class=" form-textbox" data-type="input-textbox" id="street" name=<?= OA_TABLE.SEP.OA_STREET ?> size="40" value="<?= get_field_value(OA_TABLE.SEP.OA_STREET, $userInputs, 'Enter your house number and street') ?>" />
            </div>
          </li>
          <li class="form-line" id="id_14">
            <label class="form-label-left" id="label_14" for="postcode"> Postcode </label>
            <div class="error"><?=  get_field_error(OA_TABLE.SEP.OA_POSTCODE, $inputErrors) ?></div>
            <div id="cid_14" class="form-input">
              <input type="text" class=" form-textbox" data-type="input-textbox" id="postcode" name=<?= OA_TABLE.SEP.OA_POSTCODE ?> size="20" value="<?= get_field_value(OA_TABLE.SEP.OA_POSTCODE, $userInputs, 'Enter postcode')?>" maxlength="12" />
            </div>
          </li>
          <li class="form-line" id="id_15">
            <label class="form-label-left" id="label_15" for="city"> City </label>
            <div class="error"><?=  get_field_error(OA_TABLE.SEP.OA_CITY, $inputErrors) ?></div>
            <div id="cid_15" class="form-input">
              <input type="text" class=" form-textbox" data-type="input-textbox" id="city" name="<?= OA_TABLE.SEP.OA_CITY ?>" size="40" value="<?= get_field_value(OA_TABLE.SEP.OA_CITY, $userInputs, 'Enter city')?>" />
            </div>
          </li>
          <li class="form-line" id="id_16">
            <label class="form-label-left" id="label_16" for="county"> County </label>
            <div class="error"><?=  get_field_error(OA_TABLE.SEP.OA_COUNTY, $inputErrors) ?></div>
            <div id="cid_16" class="form-input">
              <input type="text" class=" form-textbox" data-type="input-textbox" id="county" name=<?= OA_TABLE.SEP.OA_COUNTY ?> size="40" value="<?= get_field_value(OA_TABLE.SEP.OA_COUNTY, $userInputs, 'Enter county')?>" />
            </div>
          </li>
        </ul>
    </fieldset>
      <div id="cid_2" class="form-input-wide">
          <div style="margin-left:156px" class="form-buttons-wrapper">
              <button id="input_2" type="submit" class="form-submit-button">Submit</button>
          </div>
      </div>
  </div>
</form>
<?php
//clear session
unset($_SESSION['user']['input_errors']);
unset($_SESSION['user']['inputs']);

?>