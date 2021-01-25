<!-- Modal -->
<div class="modal fade" id="categoryEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.category.update')}}" method="post" id="categoryEditForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                    <input type="text" name="category" id="category" class="form-control" placeholder="Enter new category here...">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('categoryEditForm').submit();">
                Save changes
            </button>
        </div>
        </div>
    </div>
</div>