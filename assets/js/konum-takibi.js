/**
 * Kullanıcı Konum Takibi JavaScript Modülü
 * Login olan kullanıcıların konum bilgilerini takip eder
 */

class KullaniciKonumTakibi {
    constructor() {
        this.watchId = null;
        this.lastPosition = null;
        this.isTracking = false;
        this.updateInterval = 5 * 60 * 1000; // 5 dakika
        this.maxAccuracy = 1000; // 1000 metre
        this.init();
    }

    init() {
        // Sayfa yüklendiğinde konum izinlerini kontrol et
        this.checkGeolocationSupport();
        
        // Login olduğunda konum al
        this.getCurrentLocation();
        
        // Periyodik konum güncellemeleri başlat
        this.startPeriodicTracking();
        
        // Sayfa kapatılırken konum takibini durdur
        window.addEventListener('beforeunload', () => {
            this.stopTracking();
        });
    }

    checkGeolocationSupport() {
        if (!navigator.geolocation) {
            console.warn('Bu tarayıcı geolocation desteklemiyor');
            return false;
        }
        return true;
    }

    getCurrentLocation() {
        if (!this.checkGeolocationSupport()) return;

        const options = {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 60000 // 1 dakika
        };

        navigator.geolocation.getCurrentPosition(
            (position) => this.onLocationSuccess(position),
            (error) => this.onLocationError(error),
            options
        );
    }

    startContinuousTracking() {
        if (!this.checkGeolocationSupport() || this.isTracking) return;

        const options = {
            enableHighAccuracy: true,
            timeout: 15000,
            maximumAge: 30000
        };

        this.watchId = navigator.geolocation.watchPosition(
            (position) => this.onLocationSuccess(position),
            (error) => this.onLocationError(error),
            options
        );

        this.isTracking = true;
        console.log('Konum takibi başlatıldı');
    }

    startPeriodicTracking() {
        // Her 5 dakikada bir konum güncelle
        setInterval(() => {
            this.getCurrentLocation();
        }, this.updateInterval);
    }

    stopTracking() {
        if (this.watchId !== null) {
            navigator.geolocation.clearWatch(this.watchId);
            this.watchId = null;
        }
        this.isTracking = false;
        console.log('Konum takibi durduruldu');
    }

    onLocationSuccess(position) {
        const coords = position.coords;
        
        // Konum doğruluğunu kontrol et
        if (coords.accuracy > this.maxAccuracy) {
            console.warn('Konum doğruluğu düşük:', coords.accuracy, 'metre');
        }

        const locationData = {
            latitude: coords.latitude,
            longitude: coords.longitude,
            accuracy: coords.accuracy,
            timestamp: new Date().toISOString(),
            speed: coords.speed || null,
            heading: coords.heading || null
        };

        // Konum değişti mi kontrol et
        if (this.hasLocationChanged(locationData)) {
            this.sendLocationToServer(locationData);
            this.lastPosition = locationData;
        }
    }

    onLocationError(error) {
        let message = '';
        switch(error.code) {
            case error.PERMISSION_DENIED:
                message = 'Konum izni reddedildi';
                break;
            case error.POSITION_UNAVAILABLE:
                message = 'Konum bilgisi alınamadı';
                break;
            case error.TIMEOUT:
                message = 'Konum alma zaman aşımına uğradı';
                break;
            default:
                message = 'Bilinmeyen konum hatası';
                break;
        }
        
        console.error('Konum hatası:', message);
        
        // Hata durumunda sunucuya bildir (isteğe bağlı)
        this.sendErrorToServer({
            error_code: error.code,
            error_message: message,
            timestamp: new Date().toISOString()
        });
    }

    hasLocationChanged(newLocation) {
        if (!this.lastPosition) return true;

        const distance = this.calculateDistance(
            this.lastPosition.latitude,
            this.lastPosition.longitude,
            newLocation.latitude,
            newLocation.longitude
        );

        // 50 metreden fazla değişiklik varsa güncelle
        return distance > 50;
    }

    calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371e3; // Earth radius in metres
        const φ1 = lat1 * Math.PI/180;
        const φ2 = lat2 * Math.PI/180;
        const Δφ = (lat2-lat1) * Math.PI/180;
        const Δλ = (lon2-lon1) * Math.PI/180;

        const a = Math.sin(Δφ/2) * Math.sin(Δφ/2) +
                  Math.cos(φ1) * Math.cos(φ2) *
                  Math.sin(Δλ/2) * Math.sin(Δλ/2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));

        return R * c; // Distance in metres
    }

    async sendLocationToServer(locationData) {
        try {
            // Adres bilgisini al (reverse geocoding)
            const address = await this.getAddressFromCoordinates(
                locationData.latitude, 
                locationData.longitude
            );

            const data = {
                ...locationData,
                address: address,
                device_info: this.getDeviceInfo(),
                user_agent: navigator.userAgent,
                screen_resolution: `${screen.width}x${screen.height}`
            };

            const response = await fetch(base_url + 'kullanici/konum_guncelle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            console.log('Konum başarıyla güncellendi:', result);

        } catch (error) {
            console.error('Konum gönderme hatası:', error);
        }
    }

    async getAddressFromCoordinates(lat, lng) {
        try {
            // Google Geocoding API (isteğe bağlı)
            // Kendi API anahtarınızı kullanın
            const response = await fetch(
                `https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${lat}&longitude=${lng}&localityLanguage=tr`
            );
            
            if (response.ok) {
                const data = await response.json();
                return data.display_name || `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
            }
        } catch (error) {
            console.warn('Adres alınamadı:', error);
        }
        
        return `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
    }

    getDeviceInfo() {
        const ua = navigator.userAgent;
        let device = 'Unknown';
        
        if (/Mobile|Android|iPhone|iPad/.test(ua)) {
            if (/iPhone/.test(ua)) device = 'iPhone';
            else if (/iPad/.test(ua)) device = 'iPad';
            else if (/Android/.test(ua)) device = 'Android';
            else device = 'Mobile';
        } else {
            device = 'Desktop';
        }
        
        return device;
    }

    async sendErrorToServer(errorData) {
        try {
            await fetch(base_url + 'kullanici/konum_hata', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(errorData)
            });
        } catch (error) {
            console.error('Hata gönderme hatası:', error);
        }
    }

    // Manuel konum güncelleme
    updateLocation() {
        this.getCurrentLocation();
    }

    // Konum paylaşım durumunu kontrol et
    async checkPermissionStatus() {
        if ('permissions' in navigator) {
            const permission = await navigator.permissions.query({name: 'geolocation'});
            return permission.state; // 'granted', 'denied', 'prompt'
        }
        return 'unknown';
    }
}

// Sayfa yüklendiğinde konum takibini başlat
document.addEventListener('DOMContentLoaded', function() {
    // Sadece login olan sayfalar için çalıştır
    if (typeof base_url !== 'undefined') {
        window.konumTakibi = new KullaniciKonumTakibi();
        
        // Debug için global erişim
        if (typeof console !== 'undefined') {
            console.log('Kullanıcı konum takibi sistemi aktif');
        }
    }
});
