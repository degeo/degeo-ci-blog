<?php
isset( $article ) || show_error( 'Missing Article Variable for Article View in ' . __FILE__ );
?>
<h2><?php echo $article['article_title']; ?></h2>

<div class="article-content">
	<?php echo $article['article_content']; ?>
</div>