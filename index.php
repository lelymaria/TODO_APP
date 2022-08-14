<?php
include "layout/head.php";
include "layout/nav.php";
include "layout/side.php";
?>
<div class="container-fluid">
	<?php
	if (isset($_GET['page'])) {
		switch ($_GET['page']) {
			case "list_data":
			include "page/list_data.php";
			break;

			default:
			include "page/dashboard.php";
			break;
		}
	} else {
		include "page/dashboard.php";
	}
	?>
</div>

<?php include "layout/foot.php"; ?>