<div class="popup video-popup ex-<?php echo $args['idx']; ?>__popup lesson__popup full-hight-popup">
	<div class="popup__body lesson__popup-body">
      <button class="button grey-button close-button lesson__close-button js-close-popup">
         <i class="icon realgh-close"></i>
      </button>
      <div class="video-block lesson__video-block">
         <iframe
            class="video video-inner"
            src="<?php echo apply_filters('youtube_url', $args['video']); ?>"
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
         ></iframe>
      </div>
      <h4 class="title lesson__popup-title">
         <?php echo $args['title']; ?>
      </h4>
      <p class="subtitle">
      	<?php echo nl2br($args['text']); ?>
      </p>
   </div>
</div>
