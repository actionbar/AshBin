<?php

class c_sitemap {
	function xmlFormat($urls){
		$time = time();
		$date = date('Y-m-d\Th:i:s+08:00', $time);
		$homepage = Yii::app()->homeUrl;
		return '<?xml version="1.0" encoding="UTF-8"?>
				<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
						xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
						xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
					'. $urls .'
				</urlset>';

	}

}