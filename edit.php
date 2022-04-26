<!DOCTYPE html>
<html>
	<head>
		<title>Edit Form</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>

	<!-- Awal Navbar -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Ikromi</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="home.php">Home</a>
                    <a class="nav-link active" aria-current="page" href="user.php">User</a>
                    <a class="nav-link" href="view_data.php">Post</a>
                    <a class="nav-link" href="inputUser.php">Input</a>
                </div>
                </div>
            </div>
	    </nav>
		<!-- Akhir Navbar -->
		
		<br>

		<div class="row">
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
				<?php
					include "config/database.php";

					// menghilangkan | pada baris enkripsi yang sudah didecode
					$id = explode("|", base64_decode($_GET['id']));
					$cekuser=$db->prepare("SELECT * FROM user WHERE id=?");
					$cekuser->execute([$id[1]]);


					// jika $cekuser tidak kosong , maka jalankan :
					if($cekuser->rowCount()>0)
					{
						$cekuser->setFetchMode(PDO::FETCH_OBJ);
        				$user = $cekuser->fetch();

				?>

				
				<!-- Awal form edit -->
					<form method="post" action="edit_form.php" class="form-group">
						<label>Username *)</label>
						<input class="form-control" name="username" type="text" value="<?php echo $user->username?>" required><br>
						
						<label> Email *</label>
                		<input class="form-control" name="email" type="text" required> <br>

						<label>Password *)</label>
						<input class="form-control" name="passwd" type="password" required><br>

						<label>Confirm Password *)</label>
	                    <input class="form-control"  name="cpasswd" type="password" required><br>
	                    <input type="hidden" name="id" value="<?php echo base64_encode(sha1(rand())."|".$user->id)?>">

						<input class="btn btn-primary" value="Save" type="submit">
						<a class="btn btn-danger" href="user.php">Batal</a>
					</form>
				<!-- Akhir form edit -->
				<?php
					}
					else
					// jika $cekuser kosong maka kembali ke view_data.php ...
					{
						header("Location: user.php?message=notfound");	
					}
				?>
			</div>
			<div class="col-md-4">
			</div>
		</div>
	</body>
</html>