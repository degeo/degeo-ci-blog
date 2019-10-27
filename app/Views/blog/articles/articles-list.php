<?php
isset( $articles ) || $articles = [];
?>
<div class="<?php echo $layout->row(); ?>">
	<div class="<?php echo $layout->column( 'xs', 12 ); ?>">

		<ul class="list-unstyled">
			<?php foreach($articles as $article): ?>
			<li>

				<?php echo view( 'blog/articles/article-jumbotron', [ 'article' => $article, 'read_more' => true ] ); ?>

			</li>
			<?php endforeach; ?>
		</ul>

	</div>
</div>