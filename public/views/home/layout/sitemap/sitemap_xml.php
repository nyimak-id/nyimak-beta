<?php header('Content-type: application/xml; charset="ISO-8859-1"',true);  ?>
<urlset
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
      http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <url>
        <loc><?php echo base_url()?></loc>
    </url>
    <?php foreach($data_sitemap as $url) { ?>
        <url>
            <loc><?php echo base_url()."watch/".$url['slug_video']; ?>/</loc>
        </url>
    <?php } ?>
</urlset>