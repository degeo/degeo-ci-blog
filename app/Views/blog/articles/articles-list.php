<?php
isset( $articles ) || $articles = [];
?>
<div class="<?php echo $layout->row(); ?>">
	<div class="<?php echo $layout->column( 'xs', 12 ); ?>">

		<ul>
			<?php foreach($articles as $article): ?>
			<li>
				<h2><?php echo $article['article_title']; ?></h2>
				<?php if(! empty( $article['article_description'] )): ?>
				<p><?php echo $article['article_description']; ?></p>
				<?php endif; ?>
				<p>
					<a href="<?php echo site_url( 'articles/' . $article['article_url'] ); ?>"
						title="<?php echo $article['article_title']; ?>">
						Read more
					</a>
				</p>
			</li>
			<?php endforeach; ?>
		</ul>

	</div>
</div>