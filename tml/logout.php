<?php
session_start();
// include("../include/config.php");
$_SESSION['tml_email']=="";
session_unset();
session_destroy();

?>
<script language="javascript">
document.location="../login.php";
</script>
