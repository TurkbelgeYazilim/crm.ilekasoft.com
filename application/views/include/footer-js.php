<a href="<?= base_url("destek"); ?>?ref=footer" class="destek_btn"> <i data-feather="life-buoy" class="mr-1"></i> Destek Talep Et</a>



<?php

// MySQL bağlantısını yapalım

$mysqli = new mysqli('localhost', 'ilekasoft_crmuser', 'KaleW356!', 'ilekasoft_crmdb');



// Bağlantıyı kontrol et

if ($mysqli->connect_error) {

    die('Bağlantı hatası: ' . $mysqli->connect_error);

}



// En son destek_id değerini al

$result = $mysqli->query("SELECT MAX(destek_id) as son_destek_id FROM destek");

$row = $result->fetch_assoc();

$son_destek_id = $row['son_destek_id'] ?? 'Bilinmiyor';



$mysqli->close();

// Changelog'u oku
$changelog_path = APPPATH . 'config/changelog.json';
$app_version = '2.4.9'; // Varsayılan versiyon
if (file_exists($changelog_path)) {
    $changelog_content = file_get_contents($changelog_path);
    $changelog_data = json_decode($changelog_content, true);
    if ($changelog_data && isset($changelog_data['app_version'])) {
        $app_version = $changelog_data['app_version'];
    }
}
?>

<div class="footer">
	<p>&copy; ilekaSoft CRM | 
		<a href="#" onclick="showChangelog()" style="color:#d92637; cursor: pointer;" title="Versiyon değişikliklerini görüntüle">
			<i class="fa fa-code-branch"></i> v<?= $app_version; ?>
		</a> | 
		<a href="<?= base_url("destek"); ?>?ref=footer" style="color:#d92637;">Destek Talep Et</a> | 
		<a href="mailto:destek@ilekasoft.com" style="color:#d92637;">destek@ilekasoft.com</a>
	</p>
</div>

<!-- Changelog Modal -->
<div class="modal fade" id="changelogModal" tabindex="-1" role="dialog" aria-labelledby="changelogModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title" id="changelogModalLabel">
					<i class="fa fa-code-branch mr-2"></i>Versiyon Geçmişi
				</h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
				<div id="changelogLoading" class="text-center p-4">
					<i class="fa fa-spinner fa-spin fa-2x text-primary"></i>
					<div class="mt-2">Versiyon bilgileri yükleniyor...</div>
				</div>
				<div id="changelogContent" style="display: none;">
					<!-- Changelog içeriği buraya yüklenecek -->
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
			</div>
		</div>
	</div>
</div>

<style>
.version-toggle-icon {
    transition: transform 0.2s ease;
}

.card-header[aria-expanded="true"] .version-toggle-icon {
    transform: rotate(90deg);
}

.pagination .page-link {
    color: #d92637;
    border-color: #dee2e6;
}

.pagination .page-item.active .page-link {
    background-color: #d92637;
    border-color: #d92637;
}

.pagination .page-link:hover {
    color: #a91e2b;
    background-color: #f8f9fa;
    border-color: #dee2e6;
}

.pagination .page-item.disabled .page-link {
    color: #6c757d;
    background-color: #fff;
    border-color: #dee2e6;
}

#changelogContent .card-header {
    transition: background-color 0.2s ease;
}

#changelogContent .card-header:hover {
    opacity: 0.9;
}
</style>


<!-- jQuery -->

<script src="<?= base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<!-- Bootstrap Core JS -->

<script src="<?= base_url(); ?>assets/js/popper.min.js"></script>

<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>



<script src="<?= base_url(); ?>assets/plugins/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.min.js"></script>

<script src="<?= base_url(); ?>assets/plugins/bootstrap-datepicker-1.9.0-dist/locales/bootstrap-datepicker.tr.min.js"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js" type="text/javascript" ></script>

<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment-with-locales.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<script src="<?= base_url(); ?>assets/js/daterangepicker.js"></script>



<!-- Feather Icon JS -->

<script src="<?= base_url(); ?>assets/js/feather.min.js"></script>



<!-- Slimscroll JS -->

<script src="<?= base_url(); ?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>



<!-- Select2 JS -->

<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>





<!-- Session timeout script geçici olarak devre dışı bırakıldı -->
<!-- <script src="<?= base_url(); ?>assets/js/bootstrap-session-timeout.js"></script> -->



<!-- Custom JS -->

<script src="<?= base_url(); ?>assets/js/script.js"></script>





<!-- 

<script>

	setInterval(function(){

		var base_url = "<?php echo base_url();?>";

		$.post(base_url + 'home/sessionKontrol', function (result) {

			if(result=="1")

				window.location.href = base_url+"home/logout";

		});

	},5000);

</script>

-->



<script>

	// Slideshow functionality wrapped in IIFE to avoid global scope pollution

	(function() {

		let slideIndex = 1;

		

		function showSlides(n) {

			let i;

			let slides = document.getElementsByClassName("mySlides");

			let dots = document.getElementsByClassName("dot");

			

			if (slides.length === 0) return; // No slides found

			

			if (n > slides.length) {slideIndex = 1}

			if (n < 1) {slideIndex = slides.length}

			for (i = 0; i < slides.length; i++) {

				slides[i].style.display = "none";

			}

			for (i = 0; i < dots.length; i++) {

				dots[i].className = dots[i].className.replace(" active", "");

			}

			if (slides[slideIndex-1]) {

				slides[slideIndex-1].style.display = "block";

			}

			if (dots[slideIndex-1]) {

				dots[slideIndex-1].className += " active";

			}

		}

		

		// Global functions for slideshow control

		window.plusSlides = function(n) {

			showSlides(slideIndex += n);

		};



		window.currentSlide = function(n) {

			showSlides(slideIndex = n);

		};

		

		// Initialize slideshow if slides exist

		if (document.getElementsByClassName("mySlides").length > 0) {

			showSlides(slideIndex);

			

			// Auto-advance slides

			window.onload = function () {

				setInterval(function(){

					window.plusSlides(1);

				}, 5000);

			};

		}

	})();



	// Session timeout geçici olarak devre dışı bırakıldı
	/*
	$.sessionTimeout({

		logoutUrl: '<?= base_url('home/logout'); ?>',

		redirUrl: '<?= base_url('home/logout'); ?>',

		warnAfter: 600000, //600000    10 dakika

		redirAfter: 620000, //620000 10dakika20saniye

		ignoreUserActivity:true,

		countdownMessage: '{timer} saniye sonunda çıkışa yönlendirileceksiniz.'

	});
	*/

</script>



<!-- Bildirim Sistemi JavaScript -->

<script>

let notificationInterval;



function bildirimleriniYukle() {

    $.ajax({

        url: '<?= base_url("home/bildirim_listesi"); ?>',

        type: 'GET',

        dataType: 'json',

        success: function(response) {

            if(response.success) {

                const count = response.toplam;

                const bildirimler = response.bildirimler;

                

                // Bildirim sayısını güncelle

                if(count > 0) {

                    $('#notification-count').text(count).show();

                } else {

                    $('#notification-count').hide();

                }

                

                // Bildirim içeriğini güncelle

                let content = '';

                if(bildirimler.length > 0) {

                    bildirimler.forEach(function(bildirim) {

                        const tarih = new Date(bildirim.bildirim_tarih);

                        const tarihStr = tarih.toLocaleString('tr-TR', {

                            day: '2-digit',

                            month: '2-digit',

                            hour: '2-digit',

                            minute: '2-digit'

                        });

                        

                        content += `

                            <div class="notification-item ${bildirim.bildirim_okundu == 0 ? 'unread' : ''}" 

                                 data-id="${bildirim.bildirim_id}" 

                                 data-link="${bildirim.bildirim_link || '#'}"

                                 onclick="bildirimTikla(${bildirim.bildirim_id}, '${bildirim.bildirim_link || '#'}')">

                                <div class="noti-title">${bildirim.bildirim_baslik}</div>

                                <div class="noti-message">${bildirim.bildirim_mesaj}</div>

                                <div class="noti-time">${tarihStr}</div>

                            </div>

                        `;

                    });

                } else {

                    content = `

                        <div class="notification-message text-center">

                            <i data-feather="bell" class="text-muted"></i>

                            <p>Yeni bildirim bulunmuyor</p>

                        </div>

                    `;

                }

                

                $('#notification-content').html(content);

                

                // Feather icons'u yeniden başlat (güvenli şekilde)

                try {

                    if(typeof feather !== 'undefined' && feather && feather.replace) {

                        feather.replace();

                    }

                } catch(e) {

                    console.warn('Feather icons could not be replaced:', e);

                }

            }

        },

        error: function() {

            console.error('Bildirimler yüklenemedi');

        }

    });

}



function bildirimTikla(bildirimId, link) {

    // Bildirimi okundu olarak işaretle

    $.ajax({

        url: '<?= base_url("home/bildirim_okundu"); ?>',

        type: 'POST',

        data: {

            bildirim_id: bildirimId

        },

        success: function(response) {

            if(response.success) {

                // Bildirimi okundu olarak görsel güncelle

                $(`[data-id="${bildirimId}"]`).removeClass('unread');

                

                // Bildirim sayısını güncelle

                setTimeout(function() {

                    bildirimleriniYukle();

                }, 500);

            }

        }

    });

    

    // Linke yönlendir

    if(link && link !== '#') {

        window.location.href = link;

    }

}



function tumBildirimleriTemizle() {

    swal({

        title: "Emin misiniz?",

        text: "Tüm bildirimler silinecektir!",

        type: "warning",

        showCancelButton: true,

        confirmButtonText: "Evet, sil!",

        cancelButtonText: "İptal",

        closeOnConfirm: false

    }, function(isConfirm) {

        if (isConfirm) {

            // Tüm bildirimleri temizle (bu endpoint'i ekleyeceğiz)

            $.ajax({

                url: '<?= base_url("home/bildirim_temizle"); ?>',

                type: 'POST',

                success: function(response) {

                    swal("Tamamlandı!", "Tüm bildirimler temizlendi.", "success");

                    bildirimleriniYukle();

                },

                error: function() {

                    swal("Hata!", "Bildirimler temizlenemedi.", "error");

                }

            });

        }

    });

}



// Sayfa yüklendiğinde bildirimler yükle

$(document).ready(function() {

    bildirimleriniYukle();

    

    // Her 30 saniyede bir bildirimler güncelle

    notificationInterval = setInterval(bildirimleriniYukle, 30000);

});



// Sayfa kapanırken interval'i temizle

$(window).on('beforeunload', function() {

    if(notificationInterval) {

        clearInterval(notificationInterval);

    }

});



// Destek detay sayfasında yanıtları okundu olarak işaretle

if(window.location.pathname.includes('/destek/detay/')) {

    // Sayfa yüklendiğinde tüm yanıtları okundu olarak işaretle

    setTimeout(function() {

        $('.new-reply').each(function() {

            const replyId = $(this).data('reply-id');

            if(replyId) {

                $.ajax({

                    url: '<?= base_url("home/yanit_okundu"); ?>',

                    type: 'POST',

                    data: {

                        yanit_id: replyId

                    },

                    success: function(response) {

                        if(response.success) {

                            $(this).removeClass('new-reply');

                        }

                    }

                });

            }

        });

    }, 2000);

}

</script>

<!-- Changelog Sistemi JavaScript -->
<script>
let changelogData = null;
let currentPage = 1;
const itemsPerPage = 10;

// Changelog modal'ını göster
function showChangelog() {
    $('#changelogModal').modal('show');
    $('#changelogLoading').show();
    $('#changelogContent').hide();
    
    // AJAX ile changelog verilerini getir
    $.ajax({
        url: '<?= base_url("home/getChangelog") ?>',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#changelogLoading').hide();
            $('#changelogContent').show();
            
            if (response.success && response.data) {
                changelogData = response.data;
                currentPage = 1;
                renderChangelog(changelogData);
            } else {
                $('#changelogContent').html(`
                    <div class="alert alert-warning text-center">
                        <i class="fa fa-exclamation-triangle fa-2x mb-2"></i>
                        <h5>Versiyon bilgileri yüklenemedi</h5>
                        <p>Lütfen daha sonra tekrar deneyin.</p>
                    </div>
                `);
            }
        },
        error: function(xhr, status, error) {
            $('#changelogLoading').hide();
            $('#changelogContent').show().html(`
                <div class="alert alert-danger text-center">
                    <i class="fa fa-exclamation-circle fa-2x mb-2"></i>
                    <h5>Hata Oluştu</h5>
                    <p>Versiyon bilgileri yüklenirken bir hata oluştu.</p>
                    <small>Hata: ${error}</small>
                </div>
            `);
        }
    });
}

// Changelog'u render et
function renderChangelog(data) {
    if (!data.versions || data.versions.length === 0) {
        $('#changelogContent').html(`
            <div class="text-center text-muted">
                <i class="fa fa-info-circle fa-2x mb-2"></i>
                <p>Henüz versiyon geçmişi bulunmuyor.</p>
            </div>
        `);
        return;
    }

    const totalPages = Math.ceil(data.versions.length / itemsPerPage);
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const currentVersions = data.versions.slice(startIndex, endIndex);

    let html = `
        <div class="mb-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <h6 class="mb-0">Güncel Versiyon: </h6>
                    <span class="badge badge-primary ml-2">${data.app_version}</span>
                    <small class="text-muted ml-3">Son güncelleme: ${formatDate(data.last_updated)}</small>
                </div>
                <div class="text-muted small">
                    Sayfa ${currentPage} / ${totalPages} (Toplam ${data.versions.length} versiyon)
                </div>
            </div>
        </div>
        <hr>
    `;
    
    currentVersions.forEach(function(version, index) {
        const globalIndex = startIndex + index;
        const isLatest = globalIndex === 0;
        const versionId = `version-${version.version.replace(/\./g, '-')}`;
        
        html += `
            <div class="card mb-3 ${isLatest ? 'border-primary' : ''}">
                <div class="card-header ${isLatest ? 'bg-primary text-white' : 'bg-light'}" 
                     style="cursor: pointer;" 
                     onclick="toggleVersionDetails('${versionId}')" 
                     data-toggle="collapse" 
                     data-target="#${versionId}" 
                     aria-expanded="false">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">
                            <i class="fa fa-chevron-right mr-2 version-toggle-icon" id="icon-${versionId}"></i>
                            <i class="fa fa-tag mr-2"></i>
                            v${version.version} - ${version.title}
                            ${isLatest ? '<span class="badge badge-light text-primary ml-2">Güncel</span>' : ''}
                        </h6>
                        <small>${formatDate(version.date)}</small>
                    </div>
                </div>
                <div class="collapse" id="${versionId}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h6>Değişiklikler:</h6>
                                <ul class="list-unstyled">
        `;
        
        if (version.changes && version.changes.length > 0) {
            version.changes.forEach(function(change) {
                const changeType = data.change_types[change.type] || {
                    label: change.type,
                    icon: 'fa-circle',
                    color: 'secondary'
                };
                
                html += `
                    <li class="mb-2">
                        <span class="badge badge-${changeType.color} mr-2">
                            <i class="fa ${changeType.icon} mr-1"></i>
                            ${changeType.label}
                        </span>
                        <strong>${change.description}</strong>
                        ${change.details ? `<br><small class="text-muted ml-4">${change.details}</small>` : ''}
                    </li>
                `;
            });
        }
        
        html += `
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h6>Teknik Bilgiler:</h6>
                                <ul class="list-unstyled small">
                                    <li><strong>Değiştirilen Dosyalar:</strong> ${version.files_modified.length}</li>
                                    <li><strong>Veritabanı Değişikliği:</strong> ${version.db_changes ? 'Evet' : 'Hayır'}</li>
                                </ul>
                                ${version.files_modified.length > 0 ? `
                                    <button class="btn btn-sm btn-outline-info" type="button" data-toggle="collapse" 
                                            data-target="#files-${version.version.replace(/\./g, '-')}" aria-expanded="false">
                                        <i class="fa fa-file-code"></i> Dosyaları Göster
                                    </button>
                                    <div class="collapse mt-2" id="files-${version.version.replace(/\./g, '-')}">
                                        <div class="card card-body p-2">
                                            <ul class="list-unstyled mb-0 small">
                                                ${version.files_modified.map(file => `<li><code>${file}</code></li>`).join('')}
                                            </ul>
                                        </div>
                                    </div>
                                ` : ''}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    });

    // Pagination kontrollerini ekle
    if (totalPages > 1) {
        html += `
            <nav aria-label="Versiyon sayfalama">
                <ul class="pagination justify-content-center">
                    <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                        <a class="page-link" href="#" onclick="changePage(${currentPage - 1}); return false;">
                            <i class="fa fa-chevron-left"></i> Önceki
                        </a>
                    </li>
        `;

        // Sayfa numaralarını göster
        const startPage = Math.max(1, currentPage - 2);
        const endPage = Math.min(totalPages, currentPage + 2);

        if (startPage > 1) {
            html += `<li class="page-item"><a class="page-link" href="#" onclick="changePage(1); return false;">1</a></li>`;
            if (startPage > 2) {
                html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
            }
        }

        for (let i = startPage; i <= endPage; i++) {
            html += `
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="#" onclick="changePage(${i}); return false;">${i}</a>
                </li>
            `;
        }

        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
            }
            html += `<li class="page-item"><a class="page-link" href="#" onclick="changePage(${totalPages}); return false;">${totalPages}</a></li>`;
        }

        html += `
                    <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                        <a class="page-link" href="#" onclick="changePage(${currentPage + 1}); return false;">
                            Sonraki <i class="fa fa-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        `;
    }
    
    $('#changelogContent').html(html);
}

// Versiyon detaylarını aç/kapat
function toggleVersionDetails(versionId) {
    const icon = $('#icon-' + versionId);
    const isCollapsed = $('#' + versionId).hasClass('show');
    
    if (isCollapsed) {
        icon.removeClass('fa-chevron-down').addClass('fa-chevron-right');
    } else {
        icon.removeClass('fa-chevron-right').addClass('fa-chevron-down');
    }
}

// Sayfa değiştir
function changePage(page) {
    if (!changelogData || page < 1 || page > Math.ceil(changelogData.versions.length / itemsPerPage)) {
        return;
    }
    
    currentPage = page;
    renderChangelog(changelogData);
    
    // Modal içeriğini en üste kaydır
    $('#changelogContent').scrollTop(0);
}

// Tarih formatla
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('tr-TR', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
}
</script>

<!-- Konum Takibi Sistemi -->
<script src="<?= base_url(); ?>assets/js/konum-takibi.js"></script>