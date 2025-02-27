<?php if (!isset ($GLOBALS ['SAFE_REQUIRE_ONCE'])) exit (0); ?>

<link rel="stylesheet" href="view/global.css">

<div class="flex_col">
    <h1>Main</h1>
    <?php generate_toolbar (["Main"], ["Settings"], ["Logout"]); ?>
</div>

<select id="day">
<?php
  for ($i = 1 ; $i <= 31 ; $i ++) {
  echo ("<option>$i</option>");
  }
?>
</select>

<input type="time" pattern="[0-9]{2}:[0-9]{2}" id="" />
<input type="number" min=1 max=31 id="" />
<input type="number" min=1 max=12 id="" />
<input type="number" min=2000 max=2100 id="" />

<input type="datetime-local" id="cal1" />
<input type="datetime" id="cal12" />
<script>
  document.getElementById('cal1').valueAsDate = new Date();
  </script>

<label for="cars">Choose a car:</label>
<select name="cars" id="cars">
  <optgroup label="Swedish Cars">
    <option value="volvo">Volvo</option>
    <option value="saab">Saab</option>
  </optgroup>
  <optgroup label="German Cars">
    <option value="mercedes">Mercedes</option>
    <option value="audi">Audi</option>
  </optgroup>
</select> 

<?php
$v_date = new DateTime ("now");
$v_output = $v_date->format ("d/m/Y H:i:s");
echo ("<div>$v_output</div>");
$v_date = $v_date->setDate (2001,$v_date->format("m"),$v_date->format("d"));
$v_output = $v_date->format ("d/m/Y H:i:s");
echo ("<div>$v_output</div>");


$v_date_1 = (new DateTime ("now"))->format ("d/m/Y H:i:s");
$v_date_2 = (new DateTime ("-1 day"))->format ("d/m/Y H:i:s");
$v_date_3 = (new DateTime ("-2 days"))->format ("d/m/Y H:i:s");
$v_date_4 = (new DateTime ("-3 days +5 min -10 sec"))->format ("d/m/Y H:i:s");
$v_date_5 = (new DateTime ("today +21 hours +0 min"))->format ("d/m/Y H:i:s");
$v_date_6 = (new DateTime ("today +21 hours +15 min"))->format ("d/m/Y H:i:s");
$v_date_7 = (new DateTime ("today +21 hours +30 min"))->format ("d/m/Y H:i:s");
$v_date_8 = (new DateTime ("today +21 hours +75 min"))->format ("d/m/Y H:i:s");
$v_date_9 = (new DateTime ("2000-01-01"))->format ("j J M m");
echo ("<div>1 -> $v_date_1</div>");
echo ("<div>2 -> $v_date_2</div>");
echo ("<div>3 -> $v_date_3</div>");
echo ("<div>4 -> $v_date_4</div>");
echo ("<div>5 -> $v_date_5</div>");
echo ("<div>6 -> $v_date_6</div>");
echo ("<div>7 -> $v_date_7</div>");
echo ("<div>8 -> $v_date_8</div>");
echo ("<div>9 -> $v_date_9</div>");
?>