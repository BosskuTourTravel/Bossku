<?php
$base_url = "https://bosskujalanjalan.com/"; // Ganti sama domain lo
$directory = __DIR__;

$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

$sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
$sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

foreach ($rii as $file) {
    if ($file->isDir()) continue;

    $ext = pathinfo($file, PATHINFO_EXTENSION);
    if (!in_array($ext, ["html", "php"])) continue;

    $fullPath = $file->getPathname();
    $relativePath = str_replace("\\", "/", str_replace($directory, "", $fullPath));

    if (strpos($relativePath, 'generate-sitemap.php') !== false) continue; // Skip file ini sendiri

    $url = $base_url . ltrim($relativePath, "/");

    // LASTMOD: Ambil waktu terakhir file diubah
    $lastmod = date("Y-m-d", filemtime($fullPath));

    // CHANGEFREQ: Default aja, lo bisa bikin lebih pintar kalau mau
    $changefreq = "monthly";

    $isHomepage = in_array(strtolower($relativePath), ["/index.php", "/index.html"]);
    $priority = $isHomepage ? "1.0" : "0.8";

    $sitemap .= "  <url>\n";
    $sitemap .= "    <loc>$url</loc>\n";
    $sitemap .= "    <lastmod>$lastmod</lastmod>\n";
    $sitemap .= "    <changefreq>$changefreq</changefreq>\n";
    $sitemap .= "    <priority>$priority</priority>\n";
    $sitemap .= "  </url>\n";
}

$sitemap .= '</urlset>';
file_put_contents("sitemap.xml", $sitemap);

echo "Sitemap PRO lo udah jadi, bangsat! 🚀";
