<div class="modal fade" id="delete" name="delete" tabindex="-1" role="dialog" aria-labelledby="addTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="@yield('delete')">
                @method('delete')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h6 class="modal-title">Are you sure you want to delete this record?<br /></h6>
                            <div class="form-group col-12">
                                <textarea name="reason" class="form-control text-uppercase @error('reason') is-invalid @enderror" placeholder="Reason for Deletion" ></textarea>
                                @error('reason') <div class="invalid-feedback">{{ $message }} </div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-success loading">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>