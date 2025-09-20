<?php
session_start();
$activeForm = $_SESSION['active_form'] ?? 'searchBox';
$msgs = [
	'error' => $_SESSION['acc_found'] ?? '',
	'not_found' => $_SESSION['acc_not_found'] ?? '',
	'result' => $_SESSION['print'] ?? ''
];
session_unset();
function isActiveForm($formName, $activeForm)
{
	return $formName == $activeForm ? 'active':'';
}

function showMsg($msg)
{
	if (is_array($msg))
	{
		return implode(' ',$msg);
	}
	return !empty($msg) ? "<p class='MSG'>$msg</p>" : '';
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tra cứu học sinh</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Tra cứu học sinh</h1>

<!-- Form tìm kiếm -->
<div class="container">
	<div class="formBox <?php echo isActiveForm('searchBox', $activeForm) ?>" id="searchBox" >
		<form action="search_register.php" method="post">
			<label for="search">Nhập thông tin:</label>
			<input type="text" id="search" name="search" placeholder="VD: Nguyen Van A" required>
			<?php echo showMsg($msgs['not_found']);?>
			<button type="submit" name="searchBtn">Tra cứu</button>
			<p>Chưa có tài khoản? <a href="#" onclick="showForm('registerBox')">Đăng ký</a></p>
		</form>

	</div>
</div>
<?php echo showMsg($msgs['result']);?>
<!-- Form đăng ký -->
<div class="container">
	<div class="formBox <?php echo isActiveForm('registerBox', $activeForm)?>" id="registerBox">
		<form action="search_register.php" method="post">
			<h2>Đăng ký học sinh mới</h2>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" required>
	
			<label for="name">Họ và tên:</label>
			<input type="text" id="name" name="name" required>
	
			<label for="class">Lớp:</label>
			<input type="text" id="class" name="class" required>
			<?php echo showMsg($msgs['error']);?>
			<button type="submit" name="registerBtn">Đăng ký tài khoản</button>
			<a href="#" onclick="showForm('searchBox')">Tra cứu</a>
		</form>
	</div>
</div>
	<script src="script.js"></script>
</body>
</html>
