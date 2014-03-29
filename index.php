<?php
function randomString() {
  $length = 3;
  $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-._~";
  $out = "";
  for ($i = 0; $i < $length; $i++) {
    $out .= $chars[rand(0, strlen($chars) - 1)];
  }
  return $out;
}

if (isset($_GET['url'])) {
  $output = array();
  if( exec('grep '.escapeshellarg($_GET['url']).' ./list.txt', $output)) {
    $i = 0;
    foreach ($output as $outline) {
      $i++;
      $a = explode(" ", $outline, 2);
      $prnt = $_SERVER['HTTP_HOST'] . "/" . str_replace($_SERVER['DOCUMENT_ROOT'], "", dirname(__FILE__)) . $a[0]; ?>
<script>
  window.onload = function(){
    var tx = document.getElementById('url<?php echo $i; ?>');
    tx.focus();
    tx.select()
  }
</script>
<form><input type="text" id="url<?php echo $i; ?>" value="http://<?php echo $prnt; ?>"></form> <?php
    }
  } else {
    $spstr = randomString();
    if (!file_exists("./" . $spstr)) {
      mkdir("./" . $spstr);
    } else {
      die("Directory " . $spstr . " already exists");
    }
    file_put_contents("./" . $spstr . "/index.php", "<?php header(\"Location: " . $_GET['url'] . "\");");
    file_put_contents("./list.txt", "\n" . $spstr . " " . $_GET['url'], FILE_APPEND);
    $a = explode(" ", $spstr . " " . $_GET['url'], 2);
    $prnt = $_SERVER['HTTP_HOST'] . "/" . str_replace($_SERVER['DOCUMENT_ROOT'], "", dirname(__FILE__)) . $a[0]; ?>
<script>
  window.onload = function(){
    var tx = document.getElementById('url1');
    tx.focus();
    tx.select()
  }
</script>
<form><input type="text" id="url1" value="http://<?php echo $prnt; ?>"></form> <?php
  }
} else { ?>
<form method="GET" action="">
<label for="url">URL:</label><input type="text" name="url" id="url" placeholder="http://"><input type="submit">
</form>
<?php }
