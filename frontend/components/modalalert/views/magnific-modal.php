<?php
/* @var $title string|null */
/* @var $messages array */
/* @var $popupCssClass string */
/* @var $popupId string */

?>
<div id="<?= $popupId ?>" class="<?= $popupCssClass ?> mfp-hide" style="position:relative;">
    <?php if ($title): ?>
        <h3 class="<?= $messages[0]['cssClass'] ?>"></h3>
    <?php endif; ?>
    <?php foreach ($messages as $message): ?>
        <p class="<?= !$title ? $message['cssClass'] : '' ?>"><?= $message['message'] ?></p>
    <?php endforeach; ?>
</div>
