<?php
session_start();
include("../include/config.php");
$_SESSION['sadmin_id']=="";
session_unset();
session_destroy();

?>
<script language="javascript">
document.location="../login.php";
</script>
