<!DOCTYPE html>

<html lang="tr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php 
        switch($tip) {
            case 'satis': echo 'Satış Görselleri'; break;
            case 'banka': echo 'Banka Hareketi Görselleri'; break;
            case 'cek': echo 'Çek Görselleri'; break;
            case 'senet': echo 'Senet Görselleri'; break;
            default: echo 'İşletme Görselleri'; break;
        }
    ?> - <?= $cari->cari_ad ?> <?= $cari->cari_soyad ?></title>

    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome/css/fontawesome.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome/css/all.min.css">

    <style>

        body {

            background-color: #f8f9fa;

            font-family: Arial, sans-serif;

        }

        .header {

            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);

            color: white;

            padding: 20px 0;

            margin-bottom: 20px;

        }

        .image-container {

            background: white;

            border-radius: 10px;

            box-shadow: 0 2px 10px rgba(0,0,0,0.1);

            margin-bottom: 20px;

            overflow: hidden;

        }

        .image-item {

            position: relative;

            border-bottom: 1px solid #eee;

        }

        .image-item:last-child {

            border-bottom: none;

        }

        .image-preview {

            width: 100%;

            max-height: 400px;

            object-fit: contain;

            background: #f8f9fa;

        }

        .image-info {

            padding: 15px;

            background: white;

        }

        .image-name {

            font-weight: 600;

            color: #333;

            margin-bottom: 5px;

        }

        .image-actions {

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

        .no-images {

            text-align: center;

            padding: 60px 20px;

            color: #666;

        }

        .no-images i {

            font-size: 48px;
        }
        
        .pdf-preview {
            text-align: center;
            padding: 40px 20px;
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        
        .pdf-preview p {
            margin: 0;
            color: #666;
            font-size: 14px;
        }

        
        .pdf-preview i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #ccc;
        }

    </style>

</head>

<body>

    <div class="header">

        <div class="container">

            <h4 class="mb-0">

                <i class="fa fa-images mr-2"></i>

                <?php 
                switch($tip ?? 'cari') {
                    case 'satis': 
                        echo 'Satış Görselleri'; 
                        break;
                    case 'banka': 
                        echo 'Banka Hareketi Görselleri'; 
                        break;
                    case 'cek': 
                        echo 'Çek Görselleri'; 
                        break;
                    case 'senet': 
                        echo 'Senet Görselleri'; 
                        break;
                    default: 
                        echo 'İşletme Görselleri'; 
                        break;
                }
                ?> - <?= $cari->cari_ad ?> <?= $cari->cari_soyad ?>

            </h4>

        </div>

    </div>



    <div class="container">

        <?php 
        // Hangi dosya alanını kullanacağımızı belirle
        $foto_dosyalar = isset($dosya_field) ? $dosya_field : $cari->fotograf_dosya;
        
        if (!empty($foto_dosyalar)): ?>

            <?php 

            $fotograflar = explode(',', $foto_dosyalar);

            foreach ($fotograflar as $index => $fotograf): 

                $trimmed_fotograf = trim($fotograf);

                if (empty($trimmed_fotograf)) continue;

                

                $file_name = pathinfo($trimmed_fotograf, PATHINFO_BASENAME);

                $clean_name = preg_replace('/^[^_]*_/', '', $file_name); // Prefix'i kaldır

                // Dosya yolu kontrolü - eğer klasör yolu zaten varsa kullan, yoksa tip'e göre ekle
                if (strpos($trimmed_fotograf, '/') !== false) {
                    // Dosya yolu zaten klasör içeriyor (örn: faturalar/dosya.jpg)
                    $image_url = base_url('assets/uploads/' . $trimmed_fotograf);
                } else {
                    // Tip için doğru klasör yolunu belirle (eski format)
                    $folder_path = 'assets/uploads/';
                    switch($tip ?? 'cari') {
                        case 'satis':
                            $folder_path = 'assets/uploads/faturalar/';
                            break;
                        case 'senet':
                            $folder_path = 'assets/uploads/senetler/';
                            break;
                        case 'banka':
                            $folder_path = 'assets/uploads/dekontlar/';
                            break;
                        case 'cek':
                            $folder_path = 'assets/uploads/cekler/';
                            break;
                        default:
                            $folder_path = 'assets/uploads/';
                            break;
                    }
                    
                    $image_url = base_url($folder_path . $trimmed_fotograf);
                }
                
                // Dosya uzantısını kontrol et
                $file_extension = strtolower(pathinfo($trimmed_fotograf, PATHINFO_EXTENSION));
                $is_pdf = ($file_extension === 'pdf');

            ?>

                <div class="image-container">

                    <div class="image-item">
                        
                        <?php if ($is_pdf): ?>
                            <!-- PDF dosyaları için özel gösterim -->
                            <div class="pdf-preview">
                                <i class="fa fa-file-pdf-o" style="font-size: 4rem; color: #dc3545;"></i>
                                <p class="mt-2"><strong>PDF Dosyası</strong></p>
                            </div>
                        <?php else: ?>
                            <!-- Normal görsel dosyaları için önizleme -->
                            <img src="<?= $image_url ?>" alt="Görsel <?= $index + 1 ?>" class="image-preview">
                        <?php endif; ?>

                        <div class="image-info">

                            <div class="image-name"><?= $clean_name ?></div>

                            <div class="image-actions">

                                <a href="<?= $image_url ?>" target="_blank" class="btn btn-primary btn-sm">

                                    <i class="fa fa-external-link-alt"></i> Yeni Sekmede Aç

                                </a>

                                <a href="<?= $image_url ?>" download class="btn btn-success btn-sm ml-2">

                                    <i class="fa fa-download"></i> İndir

                                </a>

                                <?php if ($is_admin && ($tip ?? 'cari') !== 'banka'): ?>

                                    <button type="button" class="btn btn-delete btn-sm ml-2" 

                                            onclick="silGorsel('<?= $cari_id ?>', '<?= $trimmed_fotograf ?>', this)">

                                        <i class="fa fa-trash"></i> Sil

                                    </button>

                                <?php endif; ?>

                            </div>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="image-container">

                <div class="no-images">

                    <i class="fa fa-images"></i>

                    <h5>Görsel Bulunamadı</h5>

                    <p class="text-muted">Bu <?php 
                        switch($tip ?? 'cari') {
                            case 'satis': echo 'satış'; break;
                            case 'banka': echo 'banka hareketi'; break;
                            case 'cek': echo 'çek'; break;
                            case 'senet': echo 'senet'; break;
                            default: echo 'cari'; break;
                        }
                    ?> için henüz görsel yüklenmemiş.</p>

                </div>

            </div>

        <?php endif; ?>

        <!-- Dosya Yükleme Alanı -->
        <?php if ($is_admin && ($tip ?? 'cari') !== 'banka'): ?>
            <div class="image-container mt-4">
                <div class="p-4">
                    <h5><i class="fa fa-cloud-upload-alt mr-2"></i>Yeni Görsel Yükle</h5>
                    <form id="uploadForm" enctype="multipart/form-data" class="mt-3">
                        <input type="hidden" name="cari_id" value="<?= $cari_id ?>">
                        <input type="hidden" name="tip" value="<?= $tip ?? 'cari' ?>">
                        <?php if (isset($satis_id)): ?>
                            <input type="hidden" name="satis_id" value="<?= $satis_id ?>">
                        <?php endif; ?>
                        
                        <div class="form-group">
                            <label>Dosya Seçin <small class="text-muted">(JPG, JPEG, PNG, PDF - Max: 10MB)</small></label>
                            <input type="file" class="form-control-file" name="gorsel_dosyalar[]" id="gorselDosyalar" 
                                   multiple accept=".jpg,.jpeg,.png,.pdf">
                            <small class="form-text text-muted">
                                <i class="fa fa-info-circle"></i> Birden fazla dosya seçebilirsiniz.
                            </small>
                            <div id="selectedFiles" class="mt-2"></div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary" id="uploadBtn">
                            <i class="fa fa-upload"></i> Yükle
                        </button>
                        <div id="uploadProgress" class="mt-2" style="display: none;">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                     role="progressbar" style="width: 0%"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>

    </div>



    <script src="<?= base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>

    <script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>

    

    <script>

    var baseUrl = '<?= base_url(); ?>';

    

    // jQuery yüklü mü kontrol et
    if (typeof $ !== 'undefined') {
        $(document).ready(function() {
            console.log('jQuery loaded successfully');
            
            // Dosya seçimi event'i
            $('#gorselDosyalar').on('change', function() {
                showSelectedFiles();
            });

            // Form submit event'i
            $('#uploadForm').on('submit', function(e) {
                e.preventDefault();
                uploadFiles();
            });
        });
    } else {
        // jQuery yoksa vanilla JavaScript ile event'leri ekle
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Using vanilla JavaScript events');
            
            var fileInput = document.getElementById('gorselDosyalar');
            var form = document.getElementById('uploadForm');
            
            if (fileInput) {
                fileInput.addEventListener('change', showSelectedFiles);
            }
            
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    uploadFiles();
                });
            }
        });
    }

    // Seçilen dosyaları göster
    function showSelectedFiles() {
        const fileInput = document.getElementById('gorselDosyalar');
        const selectedFilesDiv = document.getElementById('selectedFiles');
        
        if (fileInput.files.length === 0) {
            selectedFilesDiv.innerHTML = '';
            return;
        }
        
        let html = '<div class="selected-files-list">';
        html += '<strong>Seçilen Dosyalar:</strong>';
        html += '<div class="list-group mt-2">';
        
        for (let i = 0; i < fileInput.files.length; i++) {
            const file = fileInput.files[i];
            const fileSize = (file.size / 1024 / 1024).toFixed(2); // MB
            const fileIcon = getFileIcon(file.name);
            
            html += `<div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <i class="fa ${fileIcon} mr-2"></i>
                    <strong>${file.name}</strong>
                    <small class="text-muted"> (${fileSize} MB)</small>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile(${i})">
                    <i class="fa fa-trash"></i>
                </button>
            </div>`;
        }
        
        html += '</div></div>';
        selectedFilesDiv.innerHTML = html;
    }

    // Dosya ikonu belirleme
    function getFileIcon(fileName) {
        const extension = fileName.split('.').pop().toLowerCase();
        
        switch (extension) {
            case 'pdf': return 'fa-file-pdf text-danger';
            case 'jpg':
            case 'jpeg':
            case 'png': return 'fa-file-image text-success';
            default: return 'fa-file text-secondary';
        }
    }

    // Dosya silme (listeden)
    function removeFile(index) {
        const fileInput = document.getElementById('gorselDosyalar');
        const dt = new DataTransfer();
        
        for (let i = 0; i < fileInput.files.length; i++) {
            if (i !== index) {
                dt.items.add(fileInput.files[i]);
            }
        }
        
        fileInput.files = dt.files;
        showSelectedFiles();
    }

    // Dosya yükleme
    function uploadFiles() {
        const fileInput = document.getElementById('gorselDosyalar');
        const uploadBtn = document.getElementById('uploadBtn');
        const progressDiv = document.getElementById('uploadProgress');
        const progressBar = progressDiv.querySelector('.progress-bar');

        if (fileInput.files.length === 0) {
            alert('Lütfen en az bir dosya seçin.');
            return;
        }

        const formData = new FormData(document.getElementById('uploadForm'));

        // UI'yi güncelle
        uploadBtn.disabled = true;
        uploadBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Yükleniyor...';
        progressDiv.style.display = 'block';

        // jQuery kullanmadan vanilla JavaScript ile Ajax
        var xhr = new XMLHttpRequest();
        
        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                const percentComplete = (e.loaded / e.total) * 100;
                progressBar.style.width = percentComplete + '%';
            }
        });

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                // UI'yi resetle
                uploadBtn.disabled = false;
                uploadBtn.innerHTML = '<i class="fa fa-upload"></i> Yükle';
                progressDiv.style.display = 'none';
                progressBar.style.width = '0%';

                if (xhr.status === 200) {
                    try {
                        const result = JSON.parse(xhr.responseText);
                        if (result.success) {
                            alert("Başarılı: " + (result.message || "Dosyalar başarıyla yüklendi."));
                            setTimeout(function() {
                                location.reload(); // Sayfayı yenile
                            }, 1000);
                        } else {
                            alert('Hata: ' + (result.message || 'Dosyalar yüklenemedi'));
                        }
                    } catch (e) {
                        alert('Beklenmeyen bir hata oluştu');
                        console.error('JSON Parse Error:', e);
                    }
                } else {
                    alert('Sunucu hatası oluştu (Status: ' + xhr.status + ')');
                }
            }
        };

        xhr.open('POST', baseUrl + 'cari/gorselYukle');
        xhr.send(formData);
    }
    
    function silGorsel(cariId, dosyaAdi, button) {

        if (confirm('Bu görseli silmek istediğinizden emin misiniz?\n\nDosya: ' + dosyaAdi.split('/').pop())) {

            // Butonu devre dışı bırak
            button.disabled = true;
            button.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Siliniyor...';

            // Vanilla JavaScript Ajax
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        try {
                            var result = JSON.parse(xhr.responseText);
                            if (result.success) {
                                // Görseli sayfadan kaldır
                                var container = button.closest('.image-container');
                                container.style.transition = 'opacity 0.3s';
                                container.style.opacity = '0';
                                
                                setTimeout(function() {
                                    container.remove();
                                    
                                    // Eğer hiç görsel kalmadıysa sayfayı yenile
                                    if (document.querySelectorAll('.image-container').length === 0) {
                                        location.reload();
                                    }
                                }, 300);

                                alert("Başarılı: Görsel başarıyla silindi.");
                            } else {
                                alert('Hata: ' + (result.message || 'Görsel silinemedi'));
                                button.disabled = false;
                                button.innerHTML = '<i class="fa fa-trash"></i> Sil';
                            }
                        } catch (e) {
                            alert('Beklenmeyen bir hata oluştu');
                            button.disabled = false;
                            button.innerHTML = '<i class="fa fa-trash"></i> Sil';
                        }
                    } else {
                        alert('Sunucu hatası oluştu (Status: ' + xhr.status + ')');
                        button.disabled = false;
                        button.innerHTML = '<i class="fa fa-trash"></i> Sil';
                    }
                }
            };

            xhr.open('POST', baseUrl + 'cari/gorselSil');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('cari_id=' + encodeURIComponent(cariId) + '&dosya_adi=' + encodeURIComponent(dosyaAdi));
        }

    }

    </script>

</body>

</html>

