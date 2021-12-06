<?php include 'header.php'; ?>
<?php
$limit = 6;
if (isset($_GET['p'])) {
	$noPage = $_GET['p'];
} else $noPage = 1;

$offset = ($noPage - 1) * $limit;

$sql = "SELECT
-- admin.id_admin,
-- admin.judul,
-- admin.id_admin,
-- admin.gambar,
-- berita.tgl_posting,
-- admin.nama_lengkap,
-- kategori.kategori
*
FROM
admin
-- INNER JOIN admin ON admin.id_admin = admin.id_admin
-- INNER JOIN kategori ON kategori.id_kategori = berita.id_kategori
-- ORDER BY berita.tgl_posting DESC
LIMIT " . $offset . "," . $limit;
$qry = $mysqli->query($sql);

$sql_rec = "SELECT admin FROM admin";

$total_rec = $mysqli->query($sql_rec);



?>
<div class="container-fluid body">
	<div class="row">
		<div class="col-lg-2 sidebar">
			<?php include 'sidebar.php'; ?>
		</div>
		<div class="col-lg-10 main-content">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<h2 class="page-header"><i class="fa fa-user"></i> Daftar Admin</h2>
						</div>
					</div>

					<div class="clear"></div>
					<table class="table table-hover">
						<thead>
							<tr>
								<th width="30%">Nama</th>
								<th width="5%">Foto</th>
								<th width="20%">deskripsi</th>
								<th width="15%">level</th>
								<th width="15%">Pilihan</th>
							</tr>
						</thead>
						<tbody>
							<?php while ($news_list = $qry->fetch_assoc()) { ?>
								<tr>
									<td><strong><?php echo $news_list['nama_lengkap']; ?></strong></td>
									<td>
										<img src="../images/author/<?php echo $news_list['foto']; ?>" height="75" width="75">
									</td>
									<td><?php echo $news_list['deskripsi']; ?></td>
									<td><?php echo $news_list['level']; ?></td>

									<td align="center">
										<?php if ($news_list['id_admin'] == $_SESSION['id_admin'] or $_SESSION['level'] == 'admin') { ?>

											<a href="edit-berita.php?id=<?= $news_list['id_admin'] ?>" class="btn btn-sm btn-success">
												<i class="fa fa-edit"></i>
											</a>
											<a onclick="return confirm('Anda Yakin Ingin Menghapus Data Ini?');" href="hapus-berita.php?id=<?= $news_list['id_admin'] ?>" class="btn btn-sm btn-danger">
												<i class="fa fa-trash"></i>
											</a>
										<?php } else { ?>
											<a class="btn btn-sm btn-primary" target="_blank" href="<?php echo $base_url . 'detail.php?id=' . $news_list['id_admin']; ?>">
												<i class="fa fa-eye"></i>
											</a>
										<?php } ?>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="col-md-12">
					<ul class="pagination">
						<?php if ($noPage > 1) { ?>

							<li>
								<a href="<?php echo "daftaradmin.php?p=" . ($noPage - 1); ?>">
									<i class="glyphicon glyphicon-chevron-left"></i>
								</a>
							</li>

						<?php } ?>






						<li>
							<a href="<?php echo "berita.php?p=" . ($noPage + 1); ?>">
								<i class="glyphicon glyphicon-chevron-right"></i>
							</a>
						</li>

					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<?php include 'footer.php'; ?>