<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
		  integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
		  crossorigin="anonymous" referrerpolicy="no-referrer"/>

</head>
<body>

<!-- Main Wrapper -->
<div class="main-wrapper">
	<!-- Header -->
	<?php $this->load->view("include/header"); ?>
	<!-- /Header -->

	<!-- Sidebar -->
	<?php $this->load->view("include/sidebar"); ?>
	<!-- /Sidebar -->

	<!-- Page Wrapper -->
	<div class="page-wrapper">
		<div class="content container-fluid">

			<!-- Page Header -->
			<div class="page-header">
				<div class="row">
					<div class="col-sm-10">
						<h3 class="page-title">Fatura</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
							<li class="breadcrumb-item">Fatura</li>
							<li class="breadcrumb-item active">Taslak Fatura Yükle</li>
						</ul>
					</div>
					<div class="d-flex justify-content-end text-align-center col-sm-2">
						<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i>
							<br>Önceki Sayfa</a>
					</div>
				</div>
			</div>
			<!-- /Page Header -->

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="col-md-7">
								<form action="<?= base_url("fatura/taslakFaturaKaydet"); ?>" method="POST"
									  enctype="multipart/form-data">
									<div class="form-group">
										<label>Yüklemek istediğiniz faturanın UBL_TR formatındaki XML dosyasını
											seçin</label>
										<input type="file" class="form-control" name="file" required="" accept="xml"
											   id="formFile">
									</div>
									<button type="submit" class="btn btn-danger" style="width:100%;">Yükle</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->


<?php $this->load->view("include/footer-js"); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
		integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>





<?php if ($this->session->flashdata('dosya-yuklenemedi')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Dosya yüklenemedi, tekrar deneyiniz.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>


<?php if ($this->session->flashdata('dosya-yok')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Dosya seçiniz.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>


<?php if ($this->session->flashdata('cari_hatali')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Cari kodu veya cari adı kayıtlı değil, lütfen listeden seçerek devam ediniz.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>


<?php if ($this->session->flashdata('sablon-hata')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Şablon hatalı, lütfen başka bir şablon seçerek devam ediniz.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>


<script>

	toastr.options = {
		"closeButton": true,
		"debug": false,
		"newestOnTop": false,
		"progressBar": true,
		"positionClass": "toast-top-right",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	};


</script>

<script>


	$("#submitBtn").click(function (e) {
		let allAreFilled = true;
		document.getElementById("myForm").querySelectorAll("[required]").forEach(function (i) {
			if (!allAreFilled) return;
			if (!i.value) allAreFilled = false;
			if (i.type === "radio") {
				let radioValueCheck = false;
				document.getElementById("myForm").querySelectorAll(`[name=${i.name}]`).forEach(function (r) {
					if (r.checked) radioValueCheck = true;
				})
				allAreFilled = radioValueCheck;
			}
		})
		if (!allAreFilled) {
			toastr.error("Bütün gerekli alanları doldurup tekrar deneyiniz.");
		} else {
			e.preventDefault();

			var stokID = $("input[name='stokid[]']").map(function () {
				return $(this).val();
			}).get();
			var stokMiktar = $("input[name='miktar[]']").map(function () {
				return $(this).val();
			}).get();

			$.ajax({
				url: "<?= env('BASE_URL'); ?>/fatura/satisFaturasiStokKontrol",
				method: "POST",
				data: {stokID: stokID, stokMiktar: stokMiktar},
				success: function (result) {
					if (result == 1) {
						Swal.fire({
							title: "Emin misiniz?",
							text: "Yapacağınız işlem sonucunda eklediğiniz stoklardan eksiye düşenler olacak, onaylıyor musunuz?",
							icon: "warning",
							showCancelButton: true,
							confirmButtonText: "Evet, onaylıyorum.",
							cancelButtonText: "İptal"
						}).then(function (result) {
							if (result.value) {
								$("#myForm").submit();
							}
						});
					} else {
						$("#myForm").submit();
					}
				}
			});
		}
	});


	$("#ekle_kaydet").click(function (e) {

		e.preventDefault();
		$('#add_category').modal('toggle');

		let idsi = $("#add_idsi").val();
		let secim = $("#add_secim").val();
		var indirimyuzde = 0, indirimtutar = 0, tevkifat = 0, istisna = 0;
		if ($("#indirimyuzde" + idsi).length != 0) {
			indirimyuzde = 1;
		}
		if ($("#indirimtutar" + idsi).length != 0) {
			indirimtutar = 1;
		}
		if ($("#tevkifat" + idsi).length != 0) {
			tevkifat = 1;
		}
		if ($("#istisna" + idsi).length != 0) {
			istisna = 1;
		}


		let html = '';

		let array = secim.toString().split(",");

		$.each(array, function (i) {

			if (array[i] == 1) {
				$("#indirimytd" + idsi).show();

			} else if (array[i] == 3) {
				$("#tevkifatselecttd" + idsi).show();
				$("#tevkifattexttd" + idsi).show();
			}
		});

		$('#my_table > #tbody > tr').eq(idsi - 1).after(html);

		$("#add_secim").val([]).change();
	});
</script>

<script>
	//var tables = document.getElementsByClassName('flexiCol');
	var tables = document.getElementsByTagName('table');
	for (var i = 0; i < tables.length; i++) {
		resizableGrid(tables[i]);
	}

	function resizableGrid(table) {
		var row = table.getElementsByTagName('tr')[0],
			cols = row ? row.children : undefined;
		if (!cols) return;

		table.style.overflow = 'hidden';

		var tableHeight = table.offsetHeight;

		for (var i = 0; i < cols.length; i++) {
			var div = createDiv(tableHeight);
			cols[i].appendChild(div);
			cols[i].style.position = 'relative';
			setListeners(div);
		}

		function setListeners(div) {
			var pageX, curCol, nxtCol, curColWidth, nxtColWidth;

			div.addEventListener('mousedown', function (e) {
				curCol = e.target.parentElement;
				nxtCol = curCol.nextElementSibling;
				pageX = e.pageX;

				var padding = paddingDiff(curCol);

				curColWidth = curCol.offsetWidth - padding;
				if (nxtCol)
					nxtColWidth = nxtCol.offsetWidth - padding;
			});

			div.addEventListener('mouseover', function (e) {
				e.target.style.borderRight = '2px solid #d92637';
			})

			div.addEventListener('mouseout', function (e) {
				e.target.style.borderRight = '';
			})

			document.addEventListener('mousemove', function (e) {
				if (curCol) {
					var diffX = e.pageX - pageX;

					if (nxtCol)
						nxtCol.style.width = (nxtColWidth - (diffX)) + 'px';

					curCol.style.width = (curColWidth + diffX) + 'px';
				}
			});

			document.addEventListener('mouseup', function (e) {
				curCol = undefined;
				nxtCol = undefined;
				pageX = undefined;
				nxtColWidth = undefined;
				curColWidth = undefined
			});
		}

		function createDiv(height) {
			var div = document.createElement('div');
			div.style.top = 0;
			div.style.right = 0;
			div.style.width = '5px';
			div.style.position = 'absolute';
			div.style.cursor = 'col-resize';
			div.style.userSelect = 'none';
			div.style.height = height + 'px';
			return div;
		}

		function paddingDiff(col) {

			if (getStyleVal(col, 'box-sizing') == 'border-box') {
				return 0;
			}

			var padLeft = getStyleVal(col, 'padding-left');
			var padRight = getStyleVal(col, 'padding-right');
			return (parseInt(padLeft) + parseInt(padRight));

		}

		function getStyleVal(elm, css) {
			return (window.getComputedStyle(elm, null).getPropertyValue(css))
		}
	};
</script>

<script type="text/javascript">
	$(document).ready(function () {
		$("form").submit(function () {

			$(this).submit(function () {
				return false;
			});
			return true;
		});
	});
</script>


</body>
</html>
