

<div class="card shadow p-4">

<h3 class="mb-4">Add Featured Collection</h3>

<form method="POST" enctype="multipart/form-data" action="featured_action.php">

<input
type="text"
name="title"
class="form-control mb-3"
placeholder="Collection Title"
required>

<textarea
name="description"
class="form-control mb-3"
placeholder="Description"
required></textarea>

<input
type="text"
name="link"
class="form-control mb-3"
placeholder="Link"
required>

<input
type="file"
name="image"
class="form-control mb-3"
required>

<button
name="add"
class="btn btn-primary">

Add Collection

</button>

</form>

</div>