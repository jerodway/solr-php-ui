<?php
// Standard view
//
// Show results as list
require_once(__DIR__ . '/helpers.php');
?>

<div id="results" class="row">

  <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-2">

    <?php
    $result_nr = 0;
    foreach ($results->response->docs as $doc):
      $result_nr++;

		$container = isset($doc->container_s) ? $doc->container_s : NULL;
		list ($url_display_orig, $url_display_basename_orig, $url_preview_orig, $url_openfile_orig, $url_annotation_orig, $url_container_display_orig, $url_container_display_basename_orig) = get_urls($doc->id, $container);
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
      $title = format_title($doc->title_txt);

      // Modified date
      if (isset($doc->file_modified_dt)) {
        $datetime = $doc->file_modified_dt;
      }
      elseif (isset($doc->last_modified_dt)) {
        $datetime = $doc->last_modified_dt;
      }
      else {
        $datetime = FALSE;
      }

      $file_size = 0;
      $file_size_txt = '';
      // File size
      $file_size_field = 'Content-Length_i';
      if (isset($doc->$file_size_field)) {
        $file_size = $doc->$file_size_field;
        $file_size_txt = filesize_formatted($file_size);
      }

      // Snippet
      if (isset($results->highlighting->$id->content_txt)) {
        $snippet = $results->highlighting->$id->content_txt[0];
      }
      else {
        $snippet = $doc->content_txt;
        if (strlen($snippet) > $snippetsize) {
          $snippet = substr($snippet, 0, $snippetsize) . "...";
          $snippet = htmlspecialchars($snippet);
        }
      }

      ?>
      <li>

        <div class="title">
          <a class="title" target="_blank" href="<?= $url_openfile ?>">
            <?php if ($title) { ?>
              <?= $title ?>
            <?php } ?>

          </a>
        </div>

        <?php
          include 'templates/view.url.php';
        ?>

        <div class="video">

          <video controls src="<?= $url_openfile ?>"></video>

        </div>


        <div class="row">
          <div class="date small-8 columns"><?= $datetime ?></div>
          <div class="size small-4 columns"><?= $file_size_txt ?></div>
        </div>

        <div class="snippet">
          <?php if ($authors): ?>
            <div class="author"><?= htmlspecialchars(implode(", ", $authors)) ?></div>
          <?php endif; ?>

          <?= $snippet ?>
        </div>

        <?php
          include 'templates/view.commands.php';
        ?>

      </li>

    <?php endforeach; ?>

  </ul>
</div>
