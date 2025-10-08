// İl/İlçe Dropdown AJAX Functionality
document.addEventListener('DOMContentLoaded', function() {
    // jQuery kontrolü
    if (typeof $ === 'undefined') {
        console.error('jQuery is not loaded!');
        return;
    }
    
    console.log('Talep form initialized successfully');
    
    // Ülke select değişiklik event'i - basit versiyon
    $('#ulke_select').on('change', function() {
        var ulke_id = $(this).val();
        console.log('Ülke seçildi:', ulke_id);
        
        // İl ve ilçe dropdown'larını temizle
        $('#il_select').html('<option value="">İl Seçiniz</option>');
        $('#ilce_select').html('<option value="">İlçe Seçiniz</option>');
        
        // Şimdilik sadece Türkiye için illeri göster
        if (ulke_id == '3') { // Türkiye ID'si
            // AJAX ile il getir (şimdilik disable, sadece form temizliği)
            console.log('Türkiye seçildi - iller yüklenecek');
        }
    });
    
    // İl select değişiklik event'i
    $('#il_select').on('change', function() {
        var il_id = $(this).val();
        console.log('İl seçildi:', il_id);
        
        if (il_id) {
            // Base URL'yi daha güvenli şekilde al
            var base_url = window.location.protocol + '//' + window.location.host + '/';
            var urls = [
                base_url + 'index.php/talepler/get_ilceler/' + il_id,
                base_url + 'talepler/get_ilceler/' + il_id
            ];
            
            console.log('AJAX URL:', urls[0]);
            
            $('#ilce_select').html('<option value="">Yükleniyor...</option>');
            
            // İlk URL'yi dene
            $.ajax({
                url: urls[0],
                type: 'GET',
                dataType: 'json',
                timeout: 10000,
                success: function(response) {
                    console.log('AJAX Success:', response);
                    var options = '<option value="">İlçe Seçiniz</option>';
                    
                    if (response && response.status === 'ok' && response.data && Array.isArray(response.data)) {
                        $.each(response.data, function(i, item) {
                            if (item.id && (item.ilce_adi || item.ilce)) {
                                var ilce_adi = item.ilce_adi || item.ilce;
                                options += '<option value="' + item.id + '">' + ilce_adi + '</option>';
                            }
                        });
                        console.log('İlçeler yüklendi:', response.data.length, 'adet');
                    } else if (response && response.status === 'error') {
                        options = '<option value="">' + response.message + '</option>';
                    } else {
                        options = '<option value="">Bu ile ait ilçe bulunamadı</option>';
                    }
                    
                    $('#ilce_select').html(options);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    console.error('Response Text:', xhr.responseText);
                    
                    // İkinci URL'yi dene
                    console.log('Trying alternative URL:', urls[1]);
                    $.ajax({
                        url: urls[1],
                        type: 'GET', 
                        dataType: 'json',
                        timeout: 10000,
                        success: function(response) {
                            console.log('Alternative URL success:', response);
                            var options = '<option value="">İlçe Seçiniz</option>';
                            
                            if (response && response.status === 'ok' && response.data && Array.isArray(response.data)) {
                                $.each(response.data, function(i, item) {
                                    if (item.id && (item.ilce_adi || item.ilce)) {
                                        var ilce_adi = item.ilce_adi || item.ilce;
                                        options += '<option value="' + item.id + '">' + ilce_adi + '</option>';
                                    }
                                });
                            }
                            
                            $('#ilce_select').html(options);
                        },
                        error: function(xhr2, status2, error2) {
                            console.error('Alternative URL also failed:', status2, error2);
                            $('#ilce_select').html('<option value="">İlçe yüklenemedi</option>');
                        }
                    });
                }
            });
        } else {
            $('#ilce_select').html('<option value="">Önce İl Seçiniz</option>');
        }
    });
                    console.error('Status Code:', xhr.status);
                    
                    var errorMsg = 'İlçe yüklenemedi';
                    if (xhr.status === 404) {
                        errorMsg = 'Servis bulunamadı (404)';
                    } else if (xhr.status === 500) {
                        errorMsg = 'Sunucu hatası (500)';
                    } else if (xhr.status === 0) {
                        errorMsg = 'Bağlantı hatası';
                    }
                    
                    $('#ilce_select').html('<option value="">' + errorMsg + '</option>');
                }
            });
        } else {
            $('#ilce_select').html('<option value="">Önce İl Seçiniz</option>');
        }
    });

    // Form validation
    $('#talepForm').on('submit', function(e) {
        var adsoyad = $('input[name="talep_cari_adsoyad"]').val().trim();
        if (adsoyad === '') {
            e.preventDefault();
            alert('Ad Soyad alanı zorunludur.');
            $('input[name="talep_cari_adsoyad"]').focus();
            return false;
        }
        console.log('Form validation passed');
        return true;
    });
    
    // Sidebar toggle
    $('#toggle_btn').off('click').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        if ($('body').hasClass('mini-sidebar')) {
            $('body').removeClass('mini-sidebar');
            $(this).removeClass('active');
        } else {
            $('body').addClass('mini-sidebar');
            $(this).addClass('active');
        }
    });
    
    // Mobile toggle
    $('#mobile_btn').off('click').on('click', function(e) {
        e.preventDefault();
        $('body').toggleClass('slide-nav');
        $('.sidebar-overlay').toggleClass('opened');
    });
    
    console.log('✅ All form handlers initialized');
});
