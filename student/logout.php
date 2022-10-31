<?php
session_start();
include("../include/config.php");
$_SESSION['sID']=="";
session_unset();
session_destroy();

?>
<script language="javascript">
document.location="index.php";
</script>
