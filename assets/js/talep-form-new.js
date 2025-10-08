// İl/İlçe Dropdown AJAX Functionality
document.addEventListener('DOMContentLoaded', function() {
    // jQuery kontrolü
    if (typeof $ === 'undefined') {
        console.error('jQuery is not loaded!');
        return;
    }
    
    console.log('Talep form initialized successfully');
    
    // Sayfa yüklendiğinde varsayılan ülkeye göre illeri yükle
    var default_ulke_id = $('#ulke_select').val();
    if (default_ulke_id) {
        console.log('Varsayılan ülke bulundu:', default_ulke_id);
        loadIllerByUlkeId(default_ulke_id);
    }
    
    // İller yükleme fonksiyonu
    function loadIllerByUlkeId(ulke_id) {
        if (!ulke_id) return;
        
        console.log('İller yükleniyor, ülke ID:', ulke_id);
        
        // Base URL'yi daha güvenli şekilde al
        var base_url = window.location.protocol + '//' + window.location.host + '/';
        var urls = [
            base_url + 'index.php/talepler/get_iller/' + ulke_id,
            base_url + 'talepler/get_iller/' + ulke_id
        ];
        
        console.log('İller için AJAX URL:', urls[0]);
        
        $('#il_select').html('<option value="">Yükleniyor...</option>');
        
        // İlk URL'yi dene
        $.ajax({
            url: urls[0],
            type: 'GET',
            dataType: 'json',
            timeout: 10000,
            success: function(response) {
                console.log('İller AJAX Success:', response);
                var options = '<option value="">İl Seçiniz</option>';
                
                if (response && response.status === 'ok' && response.data && Array.isArray(response.data)) {
                    $.each(response.data, function(i, item) {
                        if (item.id && (item.il_adi || item.il)) {
                            var il_adi = item.il_adi || item.il;
                            options += '<option value="' + item.id + '">' + il_adi + '</option>';
                        }
                    });
                    console.log('İller yüklendi:', response.data.length, 'adet');
                } else if (response && response.status === 'error') {
                    options = '<option value="">' + response.message + '</option>';
                } else {
                    options = '<option value="">Bu ülkeye ait il bulunamadı</option>';
                }
                
                $('#il_select').html(options);
                
                // Eğer edit mode'da ve talep varsa, il değerini seç
                var selected_il_id = $('#il_select').data('selected');
                if (selected_il_id) {
                    $('#il_select').val(selected_il_id);
                    // İl seçildiğinde ilçeleri de yükle
                    $('#il_select').trigger('change');
                }
            },
            error: function(xhr, status, error) {
                console.error('İller AJAX Error:', status, error);
                
                // Hata detayını göster
                var errorMsg = 'İl yüklenemedi';
                if (xhr.status === 404) {
                    errorMsg = 'Servis bulunamadı (404)';
                } else if (xhr.status === 500) {
                    errorMsg = 'Sunucu hatası (500)';
                } else if (xhr.status === 0) {
                    errorMsg = 'Bağlantı hatası';
                }
                
                $('#il_select').html('<option value="">' + errorMsg + '</option>');
                
                // İkinci URL'yi dene
                if (urls[1]) {
                    console.log('Trying second URL for iller:', urls[1]);
                    $.ajax({
                        url: urls[1],
                        type: 'GET',
                        dataType: 'json',
                        timeout: 10000,
                        success: function(response) {
                            console.log('İller AJAX Success (2nd try):', response);
                            var options = '<option value="">İl Seçiniz</option>';
                            
                            if (response && response.status === 'ok' && response.data && Array.isArray(response.data)) {
                                $.each(response.data, function(i, item) {
                                    if (item.id && (item.il_adi || item.il)) {
                                        var il_adi = item.il_adi || item.il;
                                        options += '<option value="' + item.id + '">' + il_adi + '</option>';
                                    }
                                });
                            } else {
                                options = '<option value="">Bu ülkeye ait il bulunamadı</option>';
                            }
                            
                            $('#il_select').html(options);
                            
                            // Eğer edit mode'da ve talep varsa, il değerini seç
                            var selected_il_id = $('#il_select').data('selected');
                            if (selected_il_id) {
                                $('#il_select').val(selected_il_id);
                                $('#il_select').trigger('change');
                            }
                        },
                        error: function() {
                            console.error('Her iki URL de başarısız - iller için');
                            $('#il_select').html('<option value="">İl yüklenemedi</option>');
                        }
                    });
                }
            }
        });
    }
    
    // Ülke select değişiklik event'i
    $('#ulke_select').on('change', function() {
        var ulke_id = $(this).val();
        console.log('Ülke değişti:', ulke_id);
        
        // İl ve ilçe dropdown'larını temizle
        $('#il_select').html('<option value="">İl Seçiniz</option>');
        $('#ilce_select').html('<option value="">İlçe Seçiniz</option>');
        
        if (ulke_id) {
            loadIllerByUlkeId(ulke_id);
        }
    });
    
    // İl select değişiklik event'i
    $('#il_select').on('change', function() {
        var il_id = $(this).val();
        console.log('İl seçildi:', il_id);
        
        // İlçe dropdown'ını temizle
        $('#ilce_select').html('<option value="">İlçe Seçiniz</option>');
        
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
                    
                    // Eğer edit mode'da ve talep varsa, ilçe değerini seç
                    var selected_ilce_id = $('#ilce_select').data('selected');
                    if (selected_ilce_id) {
                        $('#ilce_select').val(selected_ilce_id);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    
                    // Hata detayını göster
                    var errorMsg = 'İlçe yüklenemedi';
                    if (xhr.status === 404) {
                        errorMsg = 'Servis bulunamadı (404)';
                    } else if (xhr.status === 500) {
                        errorMsg = 'Sunucu hatası (500)';
                    } else if (xhr.status === 0) {
                        errorMsg = 'Bağlantı hatası';
                    }
                    
                    $('#ilce_select').html('<option value="">' + errorMsg + '</option>');
                    
                    // İkinci URL'yi dene
                    if (urls[1]) {
                        console.log('Trying second URL:', urls[1]);
                        $.ajax({
                            url: urls[1],
                            type: 'GET',
                            dataType: 'json',
                            timeout: 10000,
                            success: function(response) {
                                console.log('AJAX Success (2nd try):', response);
                                var options = '<option value="">İlçe Seçiniz</option>';
                                
                                if (response && response.status === 'ok' && response.data && Array.isArray(response.data)) {
                                    $.each(response.data, function(i, item) {
                                        if (item.id && (item.ilce_adi || item.ilce)) {
                                            var ilce_adi = item.ilce_adi || item.ilce;
                                            options += '<option value="' + item.id + '">' + ilce_adi + '</option>';
                                        }
                                    });
                                } else {
                                    options = '<option value="">Bu ile ait ilçe bulunamadı</option>';
                                }
                                
                                $('#ilce_select').html(options);
                            },
                            error: function() {
                                console.error('Her iki URL de başarısız');
                                $('#ilce_select').html('<option value="">İlçe yüklenemedi</option>');
                            }
                        });
                    }
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
            alert('Ad Soyad alanı zorunludur!');
            $('input[name="talep_cari_adsoyad"]').focus();
            return false;
        }
        
        var telefon = $('input[name="talep_cari_telefon"]').val().trim();
        if (telefon === '') {
            e.preventDefault();
            alert('Telefon alanı zorunludur!');
            $('input[name="talep_cari_telefon"]').focus();
            return false;
        }
        
        console.log('Form validation passed');
        return true;
    });
    
    // Mobile toggle
    $('#mobile_btn').off('click').on('click', function(e) {
        e.preventDefault();
        $('body').toggleClass('slide-nav');
        $('.sidebar-overlay').toggleClass('opened');
    });
    
    console.log('✅ All form handlers initialized');
});
