<div class="modal fade" id="editDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit document</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        {{-- <form action="" id="addImageDetailFor" method="POST" enctype="multipart/form-data">
        </form> --}}
        <form id="addDocumentForm" method="post" enctype="multipart/form-data">
            <label for="">Add doccument</label>
            <input type="file" name="addDocument[]" id="addDocumentInput" multiple>
        </form>
        <table data-id="" class="table" id="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Mimetype</th>
                    <th scope="col">Size</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="tablecontents_document">
                <tr>
                    <td colspan="6" align="center"><img style="width: 150px" src="{{ asset('loaderGif/loading5.gif') }}" alt=""></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div>
    </div>
</div>
</div>
