<?php
isset( $article ) || die( 'Missing Article Variable for Article View in ' . __FILE__ );
?>
<?php echo view( 'blog/articles/article-jumbotron' ); ?>

<div class="article-content px-5 mb-5">
	<?php echo html_entity_decode( $article['article_content'] ); ?>
</div>

<p class="text-center">
	<a class="btn btn-primary btn-lg" role="button"
		href="<?php echo site_url(); ?>">
		Return Home
	</a>
</p>