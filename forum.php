<?php
/**
 * admin/forum.php — Admin Forum Yönetimi
 *
 * NOT (Claude Code'a):
 *  - JavaScript YOK. Tüm işlemler (sabitle, sil) <form method="post"> ile yapılır.
 *  - SABİTLEME (pin) YALNIZCA bu ekrandan yapılır. Public tarafta pin butonu olmamalı.
 *  - Her form için CSRF token ekle ve POST tarafında doğrula.
 *  - Silme gibi yıkıcı işlemler için method="post" kullan (GET ile silme YAPMA).
 *  - $stats ve $rows'u kendi DB sorgularınla değiştir.
 *  - Sayfaya girmeden önce yetki kontrolü: admin değilse login'e yönlendir.
 */

// require_once '../auth/guard.php';  // örnek: yalnız admin erişebilsin

// ---- ÖRNEK VERİ (DB ile değiştirilecek) -------------------------------
$stats = [
  ['142','TOPLAM BAŞLIK',''],
  ['5','BEKLEYEN ONAY','stat__num--amber'],
  ['3','RAPORLANAN','stat__num--red'],
  ['2','SABİTLİ','stat__num--violet'],
];

$filtreler = ['tumu'=>'Tümü','raporlanan'=>'Raporlanan','bekleyen'=>'Bekleyen'];
$aktifFiltre = $_GET['f'] ?? 'tumu';

$rows = [
  ['id'=>1,'baslik'=>'Topluluk kuralları & OPSEC','yazar'=>'yönetici','kategori'=>'Duyurular','yanit'=>12,'sabit'=>true,'rapor'=>0],
  ['id'=>2,'baslik'=>'PGP anahtarı doğrulama rehberi','yazar'=>'m4lr0v','kategori'=>'Güvenlik','yanit'=>48,'sabit'=>false,'rapor'=>0],
  ['id'=>3,'baslik'=>'Monero (XMR) ödemeleri nasıl çalışır?','yazar'=>'satici_07','kategori'=>'Pazar','yanit'=>23,'sabit'=>false,'rapor'=>1],
  ['id'=>4,'baslik'=>'Selamlar — Ben kimim?','yazar'=>'anonim_42','kategori'=>'Genel','yanit'=>0,'sabit'=>false,'rapor'=>0],
];
// -----------------------------------------------------------------------

$pageTitle = 'Forum Yönetimi';
$activeAdmin = 'forum';
include __DIR__ . '/partials/admin-header.php';
?>

  <section class="admin-head">
    <div>
      <h1>Forum Yönetimi</h1>
    </div>
    <div class="admin-head__actions">
      <a class="btn btn--ghost" href="kategoriler.php">Kategoriler</a>
      <a class="btn btn--primary" href="kategori-ekle.php">+ Kategori Ekle</a>
    </div>
  </section>

  <section class="stats">
    <?php foreach($stats as [$num,$label,$cls]): ?>
      <div class="stat"><div class="stat__num <?= $cls ?>"><?= htmlspecialchars($num) ?></div><div class="stat__label"><?= htmlspecialchars($label) ?></div></div>
    <?php endforeach; ?>
  </section>

  <form class="toolbar" method="get" action="forum.php">
    <input class="search" type="text" name="q" placeholder="Başlık veya yazar ara…"
           value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
    <?php foreach($filtreler as $slug=>$ad): ?>
      <a class="chip<?= $aktifFiltre===$slug?' is-active':'' ?>" href="forum.php?f=<?= urlencode($slug) ?>"><?= htmlspecialchars($ad) ?></a>
    <?php endforeach; ?>
  </form>

  <table class="atable">
    <thead>
      <tr>
        <th>Başlık</th>
        <th>Yazar</th>
        <th>Kategori</th>
        <th class="center">Yanıt</th>
        <th class="right">İşlemler</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($rows as $r): ?>
        <tr class="<?= $r['sabit']?'is-pinned':'' ?>">
          <td>
            <span class="t-title">
              <?php if($r['sabit']): ?><span class="pin-star">★</span> <?php endif; ?>
              <?= htmlspecialchars($r['baslik']) ?>
            </span>
            <?php if($r['rapor']>0): ?><span class="tag-report">RAPOR ×<?= (int)$r['rapor'] ?></span><?php endif; ?>
          </td>
          <td class="t-author"><?= htmlspecialchars($r['yazar']) ?></td>
          <td><?= htmlspecialchars($r['kategori']) ?></td>
          <td class="center t-count"><?= (int)$r['yanit'] ?></td>
          <td class="right">
            <div class="row-actions">
              <!-- Sabitleme: yalnız admin. POST ile durum değiştir. -->
              <form method="post" action="thread-pin.php" style="display:inline;">
                <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
                <input type="hidden" name="sabit" value="<?= $r['sabit']?'0':'1' ?>">
                <!-- <input type="hidden" name="_token" value="..."> -->
                <button type="submit" class="pin-btn<?= $r['sabit']?' is-on':'' ?>">
                  <?= $r['sabit'] ? '★ Sabit' : 'Sabitle' ?>
                </button>
              </form>
              <a class="btn btn--sm btn--ghost" href="thread-edit.php?id=<?= (int)$r['id'] ?>">Düzenle</a>
              <form method="post" action="thread-delete.php" style="display:inline;"
                    onsubmit="">
                <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
                <!-- <input type="hidden" name="_token" value="..."> -->
                <button type="submit" class="btn btn--sm btn--danger">Sil</button>
              </form>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <nav class="pager">
    <span>142 başlıktan 1–4 arası</span>
    <span class="pager__nums">
      <a href="forum.php?p=0">‹</a>
      <a class="is-active" href="forum.php?p=1">1</a>
      <a href="forum.php?p=2">2</a>
      <a href="forum.php?p=2">›</a>
    </span>
  </nav>

<?php include __DIR__ . '/partials/admin-footer.php'; ?>
