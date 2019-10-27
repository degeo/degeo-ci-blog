<?php
isset( $article ) || die( 'Missing Article Variable for Article View in ' . __FILE__ );
isset( $read_more ) || $read_more = false;
?>
<div class="jumbotron text-secondary">

	<p class="lead">
		<?php echo date( 'M d, Y', strtotime( $article['article_published'] ) ); ?>
		&nbsp;&bull;&nbsp;
		<?php echo date( 'h:i:s a', strtotime( $article['article_published'] ) ); ?>
		<?php if(! empty( $article['article_is_sticky'] ) && $article['article_is_sticky'] === '1'): ?>
		&nbsp;&bull;&nbsp; Sticky
		<?php endif; ?>
	</p>

	<hr class="my-4">

	<h2 class="display-4 text-primary">
		<?php if($read_more === true): ?>
		<a href="<?php echo site_url( 'articles/' . $article['article_url'] ); ?>"
			title="<?php echo $article['article_title']; ?>">
			<?php echo $article['article_title']; ?>
		</a>
		<?php else: ?>
			<?php echo $article['article_title']; ?>
		<?php endif; ?>
	</h2>

	<?php if(! empty( $article['article_description'] )): ?>
	<hr class="my-4">

	<p class="lead">
		<?php echo $article['article_description']; ?>
	</p>
	<?php endif; ?>

	<?php if($read_more === true): ?>
	<p class="lead">
		<a class="btn btn-primary btn-lg" role="button"
			href="<?php echo site_url( 'articles/' . $article['article_url'] ); ?>"
			title="<?php echo $article['article_title']; ?>">
			Read more
		</a>
	</p>
	<?php endif; ?>

</div>