<?php
isset( $article ) || die( 'Missing Article Variable for Article View in ' . __FILE__ );
?>
<form action="<?php echo site_url( uri_string() ); ?>" method="post" class="needs-validation" novalidate>
	<input type="hidden" name="form_name" value="admin.blog.article"/>

	<div class="row">
		<div class="col-12 col-lg-8">

			<div class="form-group">
				<label for="article_title" class="control-label">Article Title</label>
				<input type="text" id="article_title" name="article_title" class="form-control" value="<?php echo set_value( 'article_title', $article['article_title'] ); ?>" required="required"/>
			</div>

			<div class="form-group">
				<label for="article_url" class="control-label">Article URL</label>
				<input type="text" id="article_url" name="article_url" class="form-control" value="<?php echo set_value( 'article_url', $article['article_url'] ); ?>" required="required"/>
			</div>

			<div class="form-group">
				<label for="article_description" class="control-label">Article Description</label>
				<textarea id="article_description" name="article_description" class="form-control" rows="4" required="required"><?php echo set_value( 'article_description', $article['article_description'] ); ?></textarea>
			</div>

			<div class="form-group">
				<label for="article_content" class="control-label">Article Content</label>
				<textarea id="article_content" name="article_content" class="form-control" rows="20"><?php echo html_entity_decode( set_value( 'article_content', $article['article_content'] ) ); ?></textarea>
			</div>

		</div>
		<div class="col-12 col-lg-4">

			<div class="form-group">
				<label for="user_id" class="control-label">Article Author</label>
				<select name="user_id" class="form-control">
					<option value="1">Jay</option>
				</select>
			</div>

			<div class="form-group">
				<label for="status_id" class="control-label">Article Status</label>
				<select name="status_id" class="form-control">
					<?php if(! empty( $statuses )): ?>
						<?php foreach($statuses as $status): ?>
					<option value="<?php echo $status['status_id']; ?>"<?php echo ( $article['status_id'] === $status['status_id'] ) ? ' selected="selected"' : ''; ?>>
							<?php echo $status['status_name']; ?>
					</option>
						<?php endforeach; ?>
					<?php else: ?>
					<option value="1">Draft</option>
					<?php endif; ?>
				</select>
			</div>

			<div class="form-check mb-3">
				<input type="checkbox" class="form-check-input" id="article_is_sticky" name="article_is_sticky" value="1"<?php echo ( $article['article_is_sticky'] === 1 ) ? ' checked="checked"' : ''; ?>/>
				<label class="form-check-label" for="article_is_sticky">Sticky</label>
			</div>

			<div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
				<div class="btn-group mr-2" role="group" aria-label="First group">
					<?php if(! empty( $article['article_id'] )): ?>
					<button type="submit" class="btn btn-primary">Update</button>
					<?php else: ?>
					<button type="submit" class="btn btn-primary">Create</button>
					<?php endif; ?>
				</div>
				<div class="btn-group mr-2" role="group" aria-label="Second group">
					<a class="btn btn-secondary" role="button"
						href="<?php echo site_url( 'admin/blog' ); ?>">
						Cancel
					</a>
				</div>
			</div>

			<?php if(! empty( $article['article_created'] )): ?>
			<p>
				Created on
				<?php echo date( 'M d, Y \a\t h:i:s a', strtotime( $article['article_created'] ) ); ?>
			</p>
			<?php endif; ?>

			<?php if(! empty( $article['article_modified'] )): ?>
			<p>
				Modified on
				<?php echo date( 'M d, Y \a\t h:i:s a', strtotime( $article['article_modified'] ) ); ?>
			</p>
			<?php endif; ?>

			<?php if(! empty( $article['article_published'] )): ?>
			<p>
				Published on
				<?php echo date( 'M d, Y \a\t h:i:s a', strtotime( $article['article_published'] ) ); ?>
			</p>
			<?php endif; ?>

			<?php if(! empty( $article['article_deleted'] )): ?>
			<p>
				Deleted on
				<?php echo date( 'M d, Y \a\t h:i:s a', strtotime( $article['article_deleted'] ) ); ?>
			</p>
			<?php endif; ?>

		</div>
	</div>

	<?php echo csrf_field(); ?>

</form>
<script type="text/javascript">
	// CKEditor 4
	$(document).ready( function(){
		CKEDITOR.replace( 'article_content' );
	} );

	// Example starter JavaScript for disabling form submissions if there are invalid fields
	(function() {
	  'use strict';
	  window.addEventListener('load', function() {
		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.getElementsByClassName('needs-validation');
		// Loop over them and prevent submission
		var validation = Array.prototype.filter.call(forms, function(form) {
		  form.addEventListener('submit', function(event) {
			if (form.checkValidity() === false) {
			  event.preventDefault();
			  event.stopPropagation();
			}
			form.classList.add('was-validated');
		  }, false);
		});
	  }, false);
	})();
</script>