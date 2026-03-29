<?php
// --- YAPAY ZEKA MOTORU (PHP SÜRÜMÜ) ---
$cevap = "Selam 6-C! Sosyal Bilgiler sınavı için bir soru sor, hemen cevaplayayım.";
$is_loading = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['soru'])) {
    $soru = htmlspecialchars($_POST['soru']);
    $api_url = "https://api-inference.huggingface.co/models/meta-llama/Llama-3.1-8B-Instruct";
    $token = "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"; // Senin token

    $postData = json_encode([
        "inputs" => "Sen bir Sosyal Bilgiler öğretmenisin. Aşağıdaki soruyu 6. sınıf düzeyinde, Türkçe, kısa ve net cevapla: " . $soru,
        "parameters" => ["max_new_tokens" => 200, "wait_for_model" => true]
    ]);

    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer " . $token,
        "Content-Type: application/json"
    ]);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $result = json_decode($response, true);

    if ($http_code == 200 && isset($result[0]['generated_text'])) {
        $raw_text = $result[0]['generated_text'];
        $cevap = explode("cevapla:", $raw_text)[1] ?? $raw_text;
    } elseif (isset($result['error']) && strpos($result['error'], 'loading') !== false) {
        $cevap = "⚠️ Model şu an uyanıyor, lütfen 15 saniye sonra tekrar sor kanka!";
    } else {
        $cevap = "❌ Bir bağlantı sorunu oldu. Lütfen birazdan tekrar dene.";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>6. Sınıf Sosyal Bilgiler | Ortak Yazılı Hazırlık - Kurucu Yafeş Gümüş</title>
    <style>
        /* SENİN MEVCUT STİLLERİN */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: linear-gradient(145deg, #f2efe5 0%, #e8e2d4 100%); font-family: 'Segoe UI', Roboto, sans-serif; padding: 20px 25px 50px; color: #1e2a2f; }
        .container { max-width: 1400px; margin: 0 auto; background: rgba(255, 255, 245, 0.92); border-radius: 64px 64px 48px 48px; box-shadow: 0 25px 45px rgba(0, 0, 0, 0.2); overflow: hidden; }
        .hero { background: #1e3c2c; background-image: radial-gradient(circle at 10% 30%, #2b5a3e, #0e2a1c); padding: 2rem; color: #fef7e0; text-align: center; border-bottom: 6px solid #f7b32b; }
        .hero h1 { font-size: 2.8rem; font-weight: 800; }
        .kurucu { font-size: 1.3rem; margin-top: 12px; background: #f7b32bdd; display: inline-block; padding: 8px 24px; border-radius: 60px; font-weight: bold; color: #1e3c2c; }
        .amac { margin-top: 18px; font-size: 1.2rem; background: #00000040; border-radius: 40px; padding: 8px 20px; display: inline-block; }
        .content-grid { display: flex; flex-direction: column; gap: 32px; padding: 35px 30px; }
        .topic-card { background: #ffffffea; border-radius: 48px; box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1); border: 1px solid #e0d6c2; overflow: hidden; }
        .card-header { background: #f5e7d3; padding: 20px 28px; border-bottom: 3px solid #c5a56b; display: flex; justify-content: space-between; align-items: baseline; }
        .card-header h2 { font-size: 1.9rem; color: #2a4b2f; }
        .info-section { background: #fefaf2; border-radius: 32px; padding: 20px 26px; border-left: 12px solid #f7b32b; }
        .highlight { background: #faeec2; padding: 14px 20px; border-radius: 28px; font-weight: 500; }
        .glow-text { font-weight: 700; color: #c4631b; }
        
        /* YAPAY ZEKA KUTUSU ÖZEL STİL */
        .ai-box { background: #fff; border: 4px solid #27ae60; border-radius: 40px; padding: 25px; margin-bottom: 30px; }
        .ai-response { background: #e1f5fe; padding: 15px; border-radius: 20px; margin-bottom: 15px; font-size: 1.1rem; border-left: 8px solid #0288d1; }
        .ai-form { display: flex; gap: 10px; }
        .ai-input { flex: 1; padding: 15px; border-radius: 30px; border: 2px solid #ddd; font-size: 1rem; outline: none; }
        .ai-btn { background: #27ae60; color: white; border: none; padding: 0 30px; border-radius: 30px; font-weight: bold; cursor: pointer; transition: 0.3s; }
        .ai-btn:hover { background: #1e8449; }
    </style>
</head>
<body>
<div class="container">
    <div class="hero">
        <h1>📜 SOSYAL BİLGİLER 6 📜</h1>
        <div class="kurucu">🏆 KURUCU: YAFEŞ GÜMÜŞ 🏆</div>
        <div class="amac">🎯 6-C SINIFININ YÜKSEK NOT ALMASI İÇİN ÖZEL HAZIRLIK PLATFORMU 🎯</div>
    </div>

    <div class="content-grid">
        
        <div class="ai-box">
            <h2 style="color: #27ae60; margin-bottom: 15px; text-align: center;">🤖 Yafeş Gümüş AI Asistanı (6-C Özel)</h2>
            <div class="ai-response">
                <strong>Öğretmen Notu:</strong> <?php echo trim($cevap); ?>
            </div>
            <form class="ai-form" method="POST">
                <input type="text" name="soru" class="ai-input" placeholder="Sınavla ilgili bir soru sor (Örn: Malazgirt Savaşı neden önemli?)" required>
                <button type="submit" class="ai-btn">SOR</button>
            </form>
        </div>

        <div class="topic-card">
            <div class="card-header">
                <h2>⚔️ XI–XIII. Yüzyıllar: Askeri Mücadele ve Anadolu’nun İslamlaşması</h2>
                <div style="background: #2a4b2f; color: white; border-radius: 60px; padding: 8px 20px; font-weight: bold;">📌 2 soru</div>
            </div>
            <div class="card-body" style="padding: 28px 32px;">
                <div class="info-section">
                    <h3>🏹 Öğrenme Çıktısı: SB.6.3.4</h3>
                    <p><strong>Malazgirt Meydan Muharebesi (1071)</strong> – Anadolu'nun kapıları Türklere açıldı. İlk beylikler kuruldu.</p>
                    <div class="highlight">💡 Sınav ipucu: Malazgirt ve Haçlı Seferleri mutlaka sorulur!</div>
                </div>
            </div>
        </div>

        </div>

    <footer style="background: #1e2f23; color: #e9e0cb; text-align: center; padding: 24px; border-top: 4px solid #f7b32b;">
        <p>📚 6. Sınıf Sosyal Bilgiler - Kurucu Öğretmen Yafeş Gümüş liderliğinde hazırlanmıştır. 🇹🇷</p>
    </footer>
</div>
</body>
</html>