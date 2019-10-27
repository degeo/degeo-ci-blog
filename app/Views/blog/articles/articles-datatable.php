<?php
isset( $articles ) || $articles = [];
?>
<div class="<?php echo $layout->row(); ?>">
	<div class="<?php echo $layout->column( 'xs', 12 ); ?>">

		<div class="<?php echo $layout->row(); ?> no-gutters my-3">
			<div class="<?php echo $layout->column( 'xs', 12 ); ?>">
				<a class="btn btn-primary" href="<?php echo site_url( 'admin/blog/article' ); ?>">
					New Article
				</a>
			</div>
		</div>

		<table class="table datatable w-100">
			<thead>
				<tr>
					<th>Article ID</th>
					<th>Article Title</th>
					<th>Article URL</th>
					<th>Article Description</th>
					<th>Article Status</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($articles as $article): ?>
				<tr>
					<td><?php echo $article['article_id']; ?></td>
					<td>
						<a href="<?php echo site_url( 'admin/blog/article/' . $article['article_id'] ); ?>"
							title="<?php echo $article['article_title']; ?>">
							<?php echo $article['article_title']; ?>
						</a>
					</td>
					<td><?php echo $article['article_url']; ?></td>
					<td><?php echo $article['article_description']; ?></td>
					<td><?php echo $article['status_id']; ?></td>
				</tr>
			<?php endforeach; ?>
		</table>

	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('.datatable').DataTable();
	});
</script>