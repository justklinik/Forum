# Saykonot — Forum + Admin Forum Yönetimi (Cipher teması)

Bu klasör, foruma ait **saf PHP + CSS** (JavaScript YOK) bir başlangıç paketidir.
Aşağıdaki komutu **Claude Code**'a verebilirsin.

---

## 📋 Claude Code için komut (kopyala–yapıştır)

```
Projeme forum bölümünü ekle. Aşağıdaki kurallara harfiyen uy.

TASARIM
- `php-export/` klasöründeki dosyaları referans al: forum.php, thread.php,
  new-thread.php, admin/forum.php, partials/*, assets/forum.css.
- Görsel dil "Cipher" temasıdır: koyu arka plan (#0c0d12), mor vurgu (#9d7bff),
  Space Grotesk + IBM Plex Sans + JetBrains Mono. TÜM renk/tipografi
  `assets/forum.css` içindeki CSS değişkenlerinden gelir; sayfalara inline
  stil yazma, yeni renk uydurma.

KESİN KURALLAR
- JavaScript KULLANMA. Hiçbir .js dosyası ekleme, <script> yazma, onclick koyma.
  Tüm etkileşim <a> bağlantıları ve <form method="post"> ile olur.
- Forumda "etiket" (tag) KAVRAMI YOK. Etiket alanı, etiket çipi, #hashtag gösterme.
- "Görüntülenme sayısı" YOK. "PGP ile imzala" seçeneği YOK. "Çevrimiçi" sayacı YOK.
- Sabitleme (pin) YALNIZCA admin/forum.php üzerinden, admin tarafından yapılır.
  Public forumda sadece "★ SABİT" rozeti gösterilir; pin butonu/kontrolü OLMAZ.
- Yeni başlık formunda sadece: Başlık, Kategori, İçerik alanları olur.

VERİTABANI
- Örnek $stats / $threads / $rows dizilerini KENDİ veritabanı sorgularımla değiştir.
- Mevcut DB katmanımı (PDO/mysqli) kullan; yeni bir bağlantı yöntemi uydurma.
- Şu işlem dosyalarını oluştur: create-thread.php, reply.php,
  admin/thread-pin.php, admin/thread-delete.php, admin/thread-edit.php.
  Hepsi POST alır; silme/sabitleme GET ile ASLA yapılmaz.

GÜVENLİK
- Ekrana basılan her kullanıcı verisini htmlspecialchars() ile kaçır (XSS).
- DB sorgularında prepared statement kullan (SQL injection'a karşı).
- Tüm POST formlarına CSRF token ekle ve sunucuda doğrula.
- admin/ altındaki her sayfanın başında yetki kontrolü yap; admin değilse
  login'e yönlendir (header('Location: ...'); exit;).

DOSYA BÜTÜNLÜĞÜ — HATA YAPMA
- Mevcut dosyaların ÜZERİNE körlemesine yazma; önce oku, sonra entegre et.
- Her <?php ... ?> bloğunu doğru aç/kapat. include/require yollarını kontrol et.
- header.php HTML'i AÇAR, footer.php KAPATIR; <html>/<head>/<body> etiketlerini
  tek bir yerde tut, tekrarlama, eksik bırakma.
- Türkçe karakterler için dosyaları UTF-8 (BOM'suz) kaydet; <meta charset="utf-8"> koru.
- İş bitince her sayfayı `php -l dosya.php` ile sözdizimi açısından denetle;
  hata varsa düzeltmeden bırakma.
- Mevcut menü yapısını koru: Ana Sayfa · Ürünler · Forum · Giriş · Kayıt.
```

---

## 📁 Dosya yapısı

```
forum.php                      → Forum ana sayfası (başlık listesi)
thread.php                     → Başlık detayı + yanıtlar
new-thread.php                 → Yeni başlık formu (Başlık · Kategori · İçerik)
partials/header.php            → Site menüsü + sayfa başlangıcı
partials/footer.php            → Alt bilgi + kapanış
admin/forum.php                → Admin forum yönetimi (sabitleme burada)
admin/partials/admin-header.php→ Admin menüsü
admin/partials/admin-footer.php→ Admin kapanışı
assets/forum.css               → Tüm tema (tek dosya, değişken tabanlı)
```

## ⚙️ Oluşturulacak işlem dosyaları (POST handler'lar)

| Dosya | Görev |
|---|---|
| `create-thread.php` | Yeni başlık kaydı |
| `reply.php` | Başlığa yanıt ekleme |
| `admin/thread-pin.php` | Sabitle / sabiti kaldır (admin) |
| `admin/thread-delete.php` | Başlık silme (admin) |
| `admin/thread-edit.php` | Başlık düzenleme (admin) |

## 🎨 Tema değişkenleri (`assets/forum.css` → `:root`)
- Arka plan `--bg:#0c0d12` · Yüzey `--surface:#121320` · Kenar `--border:#20222e`
- Vurgu `--violet:#9d7bff` · Açık mor `--violet-l:#b89bff`
- Durumlar: `--green` (PGP), `--amber` (satıcı), `--red` (rapor/sil)

Renk değiştirmek istersen yalnız bu değişkenleri düzenle — tüm sayfalar otomatik uyum sağlar.
