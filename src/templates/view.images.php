<?php
// Standard view
//
// Show results as images
require_once(__DIR__ . '/helpers.php');
?>

<div id="results" class="row">
  <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-3 no-bullet">

    <?php
    $result_nr = 0;
    foreach ($results->response->docs as $doc):
      $result_nr++;

		$container = isset($doc->container_s) ? $doc->container_s : NULL;
		list ($url_display_orig, $url_display_basename_orig, $url_preview_orig, $url_openfile_orig, $url_annotation_orig, $url_container_display_orig_orig, $url_container_display_basename_orig) = get_urls($doc->id, $container);
        list ($url_display, $url_display_basename, $url_preview, $url_openfile, $url_annotation, $url_container_display, $url_container_display_basename) = get_urls($doc->serve_id_s, $container);
        $url_display = !empty($url_display) ? $url_display : $url_display_orig;
        $url_display_basename = !empty($url_display_basename) ? $url_display_basename : $url_display_basename_orig;
        $url_preview = !empty($url_preview) ? $url_preview : $url_preview_orig;
        $url_openfile = !empty($url_openfile) ? $url_openfile : $url_openfile_orig;
        $url_annotation = !empty($url_annotation) ? $url_annotation : $url_annotation_orig;
        $url_container_display = !empty($url_container_display) ? $url_container_display : $url_container_display_orig;
        $url_container_display_basename = !empty($url_container_display_basename) ? $url_container_display_basename : $url_container_display_basename_orig;

		// Authors
		if (is_array($doc->author_ss)) {
			$authors = $doc->author_ss;
		} else {
			$authors = array($doc->author_ss);
		}
		
      // Title
      $title = format_title($doc->title_txt, $uri_label);

      // Modified date
      $datetime = FALSE;
      if (isset($doc->file_modified_dt)) {
        $datetime = $doc->file_modified_dt;
      }
      elseif (isset($doc->last_modified)) {
        $datetime = $doc->last_modified;
      }

      $file_size = 0;
      $file_size_txt = '';
      // File size
      $file_size_field = 'Content-Length_i';
      if (isset($doc->$file_size_field)) {
        $file_size = $doc->$file_size_field;
        $file_size_txt = filesize_formatted($file_size);
      }

      ?>

      <li>
        <div class="image">
          <a target="_blank" href="<?= $url_openfile ?>">
            <img width="200" src="<?= $url_openfile ?>" <?= $title ? 'title="' . $title . '"' : '' ?> />
          </a>
        </div>

        <div class="row">
          <div class="date small-8 columns"><?= $datetime ?></div>
          <div class="size small-4 columns"><?= $file_size_txt ?></div>
        </div>

          <?php if ($authors): ?>
            <div class="author"><?= htmlspecialchars(implode(", ", $authors)) ?></div>
          <?php endif; ?>

        <div class="title imagelist">
          <a href="<?= $url_openfile ?>"><h2><?= $title ? $title : $uri_label ?></h2></a>
        </div>

        <div class="snippet">
          <?= $snippets ?>
        </div>

        <?php
          include 'templates/view.commands.php';
        ?>

      </li>
    <?php endforeach; ?>
  </ul>
</div>
