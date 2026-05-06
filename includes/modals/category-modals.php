<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border border-info" style="background: #05070a; color: #fff;">
            <div class="modal-header border-bottom border-secondary">
                <h5 class="modal-title font-weight-bold" style="color: var(--neon-cyan);">[COMMAND]: UPDATE_CATEGORY_DATA</h5>
                <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="functions-add-new-categories.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="update_id" id="upd_id">
                    
                    <div class="form-group mb-3">
                        <label class="small text-info">ASSET_TYPE / CATEGORY</label>
                        <input type="text" name="revised_category" id="upd_cat" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="small text-info">CALIBER_SPECIFICATION</label>
                        <input type="text" name="revised_caliber" id="upd_cal" class="form-control bg-dark text-white border-secondary" required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="small text-info">MANUFACTURER_ORIGIN</label>
                        <input type="text" name="revised_manufacturer" id="upd_man" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                </div>
                <div class="modal-footer border-top border-secondary">
                    <button type="button" class="btn btn-outline-light btn-sm" data-bs-dismiss="modal">ABORT</button>
                    <button type="submit" name="execute_update" class="btn btn-info btn-sm">COMMIT_CHANGES</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content border border-danger" style="background: #05070a; color: #fff;">
            <div class="modal-header border-bottom border-danger">
                <h5 class="modal-title font-weight-bold text-danger">[WARNING]: DATA_DELETE</h5>
            </div>
            <form action="functions-add-new-categories.php" method="POST">
                <div class="modal-body text-center">
                    <p class="mb-2">Are you sure you want to remove this category?</p>
                    <h4 id="del_label" class="text-warning font-weight-bold"></h4>
                    <input type="hidden" name="delete_id" id="del_id">
                    <p class="small text-muted mt-3">ACTION_IRREVERSIBLE: Entry will be deleted from master records.</p>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-around">
                    <button type="button" class="btn btn-outline-light btn-xs" data-bs-dismiss="modal">CANCEL</button>
                    <button type="submit" name="execute_delete" class="btn btn-danger btn-xs">CONFIRM_DELETE</button>
                </div>
            </form>
        </div>
    </div>
</div>