<!DOCTYPE html>

<html lang="tr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Evraklar - <?= $cari->cari_ad ?> <?= $cari->cari_soyad ?></title>

    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome/css/fontawesome.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome/css/all.min.css">

    <style>

        body {

            background-color: #f8f9fa;

            font-family: Arial, sans-serif;

        }

        .header {

            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);

            color: white;

            padding: 20px 0;

            margin-bottom: 20px;

        }

        .document-container {

            background: white;

            border-radius: 10px;

            box-shadow: 0 2px 10px rgba(0,0,0,0.1);

            margin-bottom: 20px;

            overflow: hidden;

        }

        .document-item {

            position: relative;

            border-bottom: 1px solid #eee;

        }

        .document-item:last-child {

            border-bottom: none;

        }

        .document-preview {

            padding: 30px;

            text-align: center;

            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);

            min-height: 200px;

            display: flex;

            align-items: center;

            justify-content: center;

            flex-direction: column;

        }

        .document-icon {

            font-size: 64px;

            margin-bottom: 15px;

            opacity: 0.8;

        }

        .document-type {

            font-size: 18px;

            font-weight: 600;

            margin-bottom: 5px;

            text-transform: uppercase;

        }

        .document-info {

            padding: 15px;

            background: white;

        }

        .document-name {

            font-weight: 600;

            color: #333;

            margin-bottom: 5px;

            word-break: break-all;

        }

        .document-actions {

            margin-top: 10px;

        }

        .btn-delete {

            background: #dc3545;

            border: none;

            color: white;

            padding: 5px 15px;

            border-radius: 5px;

            font-size: 12px;

        }

        .btn-delete:hover {

            background: #c82333;

            color: white;

        }

        .no-documents {

            text-align: center;

            padding: 60px 20px;

            color: #666;

        }

        .no-documents i {

            font-size: 48px;

            margin-bottom: 15px;

            color: #ccc;

        }

        .pdf-icon { color: #dc3545; }

        .word-icon { color: #007bff; }

        .excel-icon { color: #28a745; }

        .powerpoint-icon { color: #fd7e14; }

        .image-icon { color: #20c997; }

        .archive-icon { color: #6f42c1; }

        .text-icon { color: #6c757d; }

        .default-icon { color: #6c757d; }
        
        /* Görsel önizleme stilleri */
        .image-preview {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .image-thumbnail {
            width: 100%;
            height: 200px;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        
        .image-thumbnail:hover {
            transform: scale(1.05);
        }
        
        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(0,0,0,0.3), rgba(0,0,0,0.1));
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }
        
        .image-preview:hover .image-overlay {
            opacity: 1;
        }
        
        /* Modal stilleri */
        .modal-img {
            max-width: 100%;
            max-height: 80vh;
            margin: 0 auto;
            display: block;
        }

    </style>

</head>

<body>

    <div class="header">

        <div class="container">

            <h4 class="mb-0">

                <i class="fa fa-file mr-2"></i>

                Evraklar - <?= $cari->cari_ad ?> <?= $cari->cari_soyad ?>

            </h4>

        </div>

    </div>



    <div class="container">

        <?php if (!empty($cari->evrak_dosya)): ?>

            <?php 

            $evraklar = explode(',', $cari->evrak_dosya);

            foreach ($evraklar as $index => $evrak): 

                $trimmed_evrak = trim($evrak);

                if (empty($trimmed_evrak)) continue;

                

                $file_name = pathinfo($trimmed_evrak, PATHINFO_BASENAME);

                $clean_name = preg_replace('/^[^_]*_/', '', $file_name); // Prefix'i kaldır

                $file_extension = strtolower(pathinfo($clean_name, PATHINFO_EXTENSION));

                $document_url = base_url('assets/uploads/' . $trimmed_evrak);

                

                // Dosya tipine göre ikon, renk ve açıklama belirle

                $icon = 'fa-file';

                $icon_class = 'default-icon';

                $type_name = 'Dosya';

                

                if (in_array($file_extension, ['pdf'])) {

                    $icon = 'fa-file-pdf';

                    $icon_class = 'pdf-icon';

                    $type_name = 'PDF Belgesi';

                } elseif (in_array($file_extension, ['doc', 'docx'])) {

                    $icon = 'fa-file-word';

                    $icon_class = 'word-icon';

                    $type_name = 'Word Belgesi';

                } elseif (in_array($file_extension, ['xls', 'xlsx'])) {

                    $icon = 'fa-file-excel';

                    $icon_class = 'excel-icon';

                    $type_name = 'Excel Belgesi';

                } elseif (in_array($file_extension, ['ppt', 'pptx'])) {

                    $icon = 'fa-file-powerpoint';

                    $icon_class = 'powerpoint-icon';

                    $type_name = 'PowerPoint Belgesi';

                } elseif (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {

                    $icon = 'fa-file-image';

                    $icon_class = 'image-icon';

                    $type_name = 'Görsel Dosyası';

                } elseif (in_array($file_extension, ['zip', 'rar', '7z'])) {

                    $icon = 'fa-file-archive';

                    $icon_class = 'archive-icon';

                    $type_name = 'Arşiv Dosyası';

                } elseif (in_array($file_extension, ['txt'])) {

                    $icon = 'fa-file-alt';

                    $icon_class = 'text-icon';

                    $type_name = 'Metin Dosyası';

                }

            ?>

                <div class="document-container">

                    <div class="document-item">

                        <div class="document-preview">
                            <?php if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])): ?>
                                <!-- Görsel dosyalar için thumbnail önizleme -->
                                <div class="image-preview" style="position: relative; width: 100%; height: 200px;">
                                    <img src="<?= $document_url ?>" 
                                         alt="<?= $clean_name ?>" 
                                         class="image-thumbnail"
                                         onclick="showImageModal('<?= $document_url ?>', '<?= htmlspecialchars($clean_name) ?>')"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="image-overlay">
                                        <i class="fa fa-search-plus"></i>
                                    </div>
                                    <!-- Fallback icon if image fails to load -->
                                    <div style="display: none; width: 100%; height: 200px; align-items: center; justify-content: center; flex-direction: column;">
                                        <div class="document-icon <?= $icon_class ?>">
                                            <i class="fa <?= $icon ?>"></i>
                                        </div>
                                        <div class="document-type <?= $icon_class ?>"><?= $type_name ?></div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <!-- Diğer dosya türleri için eski görünüm -->
                                <div class="document-icon <?= $icon_class ?>">

                                    <i class="fa <?= $icon ?>"></i>

                                </div>

                                <div class="document-type <?= $icon_class ?>"><?= $type_name ?></div>
                            <?php endif; ?>

                        </div>

                        <div class="document-info">

                            <div class="document-name"><?= $clean_name ?></div>

                            <div class="document-actions">

                                <a href="<?= $document_url ?>" target="_blank" class="btn btn-primary btn-sm">

                                    <i class="fa fa-external-link-alt"></i> Aç

                                </a>

                                <a href="<?= $document_url ?>" download class="btn btn-success btn-sm ml-2">

                                    <i class="fa fa-download"></i> İndir

                                </a>

                                <?php if ($is_admin): ?>

                                    <button type="button" class="btn btn-delete btn-sm ml-2" 

                                            onclick="silEvrak('<?= $cari_id ?>', '<?= $trimmed_evrak ?>', this)">

                                        <i class="fa fa-trash"></i> Sil

                                    </button>

                                <?php endif; ?>

                            </div>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="document-container">

                <div class="no-documents">

                    <i class="fa fa-file"></i>

                    <h5>Evrak Bulunamadı</h5>

                    <p class="text-muted">Bu cari için henüz evrak yüklenmemiş.</p>

                </div>

            </div>

        <?php endif; ?>

    </div>

    <!-- Görsel Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Görsel Önizleme</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Görsel" class="modal-img">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <a id="downloadLink" href="" class="btn btn-primary" target="_blank" download>
                        <i class="fa fa-download"></i> İndir
                    </a>
                    <a id="openLink" href="" class="btn btn-success" target="_blank">
                        <i class="fa fa-external-link-alt"></i> Yeni Sekmede Aç
                    </a>
                </div>
            </div>
        </div>
    </div>



    <script src="<?= base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>

    <script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url(); ?>assets/plugins/sweetalert/sweetalert.min.js"></script>

    

    <script>

    var baseUrl = '<?= base_url(); ?>';

    

    // Görsel modal fonksiyonu
    function showImageModal(imageSrc, title) {
        $('#imageModalLabel').text(title);
        $('#modalImage').attr('src', imageSrc);
        $('#downloadLink').attr('href', imageSrc);
        $('#openLink').attr('href', imageSrc);
        $('#imageModal').modal('show');
    }

    

    function silEvrak(cariId, dosyaAdi, button) {

        if (confirm('Bu evrakı silmek istediğinizden emin misiniz?\n\nDosya: ' + dosyaAdi.split('/').pop())) {

            // Butonu devre dışı bırak

            $(button).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Siliniyor...');

            

            $.ajax({

                url: baseUrl + 'cari/evrakSil',

                type: 'POST',

                data: {

                    cari_id: cariId,

                    dosya_adi: dosyaAdi

                },

                success: function(response) {

                    try {

                        var result = JSON.parse(response);

                        if (result.success) {

                            // Evrakı sayfadan kaldır

                            $(button).closest('.document-item').fadeOut(300, function() {

                                $(this).remove();

                                

                                // Eğer hiç evrak kalmadıysa sayfayı yenile

                                if ($('.document-item').length === 0) {

                                    location.reload();

                                }

                            });

                            

                            swal({

                                title: "Başarılı",

                                text: "Evrak başarıyla silindi.",

                                type: "success",

                                timer: 2000,

                                showConfirmButton: false

                            });

                        } else {

                            alert('Hata: ' + (result.message || 'Evrak silinemedi'));

                            $(button).prop('disabled', false).html('<i class="fa fa-trash"></i> Sil');

                        }

                    } catch (e) {

                        alert('Beklenmeyen bir hata oluştu');

                        $(button).prop('disabled', false).html('<i class="fa fa-trash"></i> Sil');

                    }

                },

                error: function() {

                    alert('Sunucu hatası oluştu');

                    $(button).prop('disabled', false).html('<i class="fa fa-trash"></i> Sil');

                }

            });

        }

    }

    </script>

</body>

</html>

