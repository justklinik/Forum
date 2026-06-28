<?php
/**
 * new-thread.php — Yeni başlık açma formu
 *
 * NOT (Claude Code'a):
 *  - JavaScript YOK. Form <form method="post"> ile create-thread.php'ye gider.
 *  - "Etiket" alanı YOK; ekleme. Sadece BAŞLIK, KATEGORİ ve İÇERİK var.
 *  - "PGP ile imzala" / anonim seçeneği YOK.
 *  - Kategorileri DB'den çek; aşağıdaki dizi örnektir.
 *  - POST işlerken CSRF token doğrula ve girdiyi temizle (htmlspecialchars).
 */

$kategoriler = [
  'guvenlik'  => 'Güvenlik & PGP',
  'pazar'     => 'Pazar / Satıcılar',
  'genel'     => 'Genel',
  'duyurular' => 'Duyurular',
];

$pageTitle = 'Yeni Başlık';
$activeNav = 'forum';
include __DIR__ . '/partials/header.php';
?>

  <section class="form-head">
    <h1>Bir başlık aç</h1>
  </section>

  <form method="post" action="create-thread.php" style="padding:20px 0;">
    <!-- CSRF: <input type="hidden" name="_token" value="..."> -->

    <div class="field">
      <div class="field__label">Başlık</div>
      <input class="input" type="text" name="baslik" maxlength="120"
             placeholder="Net ve açık bir başlık yaz…" required>
    </div>

    <div class="field">
      <div class="field__label">Kategori</div>
      <select class="select" name="kategori" required>
        <?php foreach($kategoriler as $slug=>$ad): ?>
          <option value="<?= htmlspecialchars($slug) ?>"><?= htmlspecialchars($ad) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="field">
      <div class="field__label">İçerik</div>
      <textarea class="textarea" name="icerik"
                placeholder="Sorununu veya bilgini paylaş. Markdown ve kod blokları desteklenir." required></textarea>
      <div class="fmt-bar">
        <span>B</span><span>i</span><span>&lt;/&gt;</span><span>bağlantı</span>
      </div>
    </div>

    <div class="form-actions">
      <button type="submit" class="btn btn--primary">Başlığı Aç</button>
    </div>
  </form>

<?php include __DIR__ . '/partials/footer.php'; ?>
