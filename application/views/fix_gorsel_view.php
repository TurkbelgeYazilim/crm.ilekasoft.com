<!DOCTYPE html>
<html>
<head>
    <title>Görsel JSON Düzeltme Aracı</title>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .result { background: #f5f5f5; padding: 10px; margin: 10px 0; border-left: 4px solid #007cba; }
        .error { border-left-color: #dc3545; }
        .success { border-left-color: #28a745; }
        .warning { border-left-color: #ffc107; }
        button { padding: 10px 20px; margin: 5px; cursor: pointer; }
        .fix { background: #dc3545; color: white; border: none; }
        .check { background: #007cba; color: white; border: none; }
        code { background: #f8f9fa; padding: 2px 4px; border-radius: 3px; }
    </style>
</head>
<body>
    <h1>Görsel JSON Formatı Düzeltme Aracı</h1>
    <p>Bu araç, hatalı JSON formatında kaydedilmiş görsel dosya isimlerini düzeltir.</p>
    
    <?php if (!isset($action)): ?>
        <p>Hatalı JSON formatındaki görsel kayıtlarını kontrol etmek için butona tıklayın:</p>
        <form method="post">
        <button type="submit" name="action" value="check" class="check">Hatalı Kayıtları Kontrol Et</button>
        </form>
    
    <?php else: ?>
        
        <?php if ($total_found == 0): ?>
            <div class="result success">Hiç hatalı kayıt bulunamadı! Tüm görsel verileri doğru formatta.</div>
        
        <?php else: ?>
            
            <?php foreach ($results as $table_result): ?>
                <div class="result warning">
                    <strong><?= $table_result['table'] ?></strong> tablosunda <?= $table_result['found'] ?> hatalı kayıt bulundu:
                </div>
                
                <?php if ($action == 'fix'): ?>
                    <?php foreach ($table_result['records'] as $record): ?>
                        <div style="margin-left: 20px; color: <?= $record['success'] ? 'green' : 'red' ?>;">
                            <?= $record['success'] ? '✓' : '✗' ?> 
                            ID <?= $record['id'] ?>: 
                            <code><?= htmlspecialchars($record['old_value']) ?></code> → 
                            <code><?= htmlspecialchars($record['new_value']) ?></code>
                        </div>
                    <?php endforeach; ?>
                    <div class="result success"><?= $table_result['table'] ?> tablosunda <?= $table_result['fixed'] ?> kayıt düzeltildi.</div>
                
                <?php else: ?>
                    <?php foreach ($table_result['records'] as $record): ?>
                        <div style="margin-left: 20px;">
                            ID <?= $record['id'] ?>: 
                            <code><?= htmlspecialchars($record['old_value']) ?></code> → 
                            <code><?= htmlspecialchars($record['new_value']) ?></code>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                
            <?php endforeach; ?>
            
            <?php if ($action == 'check'): ?>
                <div class="result warning"><strong>Toplam <?= $total_found ?> hatalı kayıt bulundu.</strong></div>
                <form method="post">
                <button type="submit" name="action" value="fix" class="fix">Bu Kayıtları Düzelt</button>
                </form>
            <?php else: ?>
                <div class="result success"><strong>Toplam <?= $total_fixed ?> kayıt başarıyla düzeltildi!</strong></div>
            <?php endif; ?>
            
        <?php endif; ?>
        
    <?php endif; ?>
    
</body>
</html>
