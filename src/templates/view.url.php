          <span class="uri">
            <?php if ($url_display): ?>
              <span data-tooltip class="has-tip" title="<?= $url_display ?>">
            <?php endif; ?>
            <?= $url_display_basename ?>
            <?php if ($url_display): ?>
              </span>
            <?php endif; ?>
            <?php if ($url_container_display): ?>
              in
            <span data-tooltip class="has-tip" title="<?= $url_container_display ?>">
            <?= $url_container_display_basename ?>
              </span>
            <?php endif; ?>
          </span>
          <br>
          <span class="uri">
            <?php if ($url_display_orig): ?>
              <span data-tooltip class="has-tip" title="<?= $url_display_orig ?>">
            <?php endif; ?>
            <a href="<?= $url_openfile_orig ?>"><?= $url_openfile_orig ?></a>
            <?php if ($url_display_orig): ?>
              </span>
            <?php endif; ?>
            <?php if ($url_container_display_orig): ?>
              in
            <span data-tooltip class="has-tip" title="<?= $url_container_display_orig ?>">
            <a href="<?= $url_container_display_orig ?>"><?= $url_container_display_orig ?></a>
              </span>
            <?php endif; ?>
          </span>
