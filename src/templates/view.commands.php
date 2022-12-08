        <div class="commands">
          <a href="<?= $url_openfile ?>"><?= t('open'); ?></a>
          <?php if ($cfg['metadata']['server']): ?>
            | <a title="<?= t('meta description'); ?>"
                 href="<?= get_metadata_uri($cfg['metadata']['server'], $url_annotation_orig); ?>"><?= t('meta'); ?></a>
          <?php endif; ?>
          
          <?php if ($cfg['hypothesis']['server']): ?>
            | <a title="<?= t('meta description'); ?>"
                 href="<?= get_metadata_uri($cfg['hypothesis']['server'], $url_annotation_orig); ?>"><?= t('Annotate visual'); ?></a>
          <?php endif; ?>

          | <a
            href="?view=preview&q=<?= rawurlencode('id:"' . $url_preview_orig . '"') ?>"><?= t('Preview') ?></a>

          <?php if (isset($url_prioritize_orig) && $url_prioritize_orig): ?>
          | <a
            target="_blank" href="<?= $url_prioritize_orig ?>"><?= t('Prioritize import') ?></a>
          <?php endif; ?>
            
        </div>
