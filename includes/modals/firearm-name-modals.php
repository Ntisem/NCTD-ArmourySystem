 <div class="modal fade" id="updateModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="functions-add-new-names.php" method="POST">
                    <div class="modal-body text-center">
                        <h6 class="text-cyan mb-3">[ MOD_NOMENCLATURE ]</h6>
                        <input type="hidden" name="update_id" id="modal_update_id">
                        <input type="text" name="revised_name" id="modal_update_name" class="form-control mb-3" required>
                        <button type="submit" name="execute_update" class="btn btn-sm btn-info btn-block">COMMIT_CHANGE</button>
                        <button type="button" class="btn btn-sm btn-link text-muted mt-2 abort-trigger" data-dismiss="modal" data-bs-dismiss="modal">ABORT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content border-danger">
                <form action="functions-add-new-names.php" method="POST">
                    <div class="modal-body text-center">
                        <h5 class="text-danger">[ PURGE_SEQUENCE ]</h5>
                        <input type="hidden" name="delete_id" id="modal_delete_id">
                        <p class="small">Authorized removal of <br><b id="modal_delete_name" class="text-white"></b>?</p>
                        <button type="submit" name="execute_delete" class="btn btn-sm btn-danger btn-block">EXECUTE</button>
                        <button type="button" class="btn btn-sm btn-link text-muted mt-2 abort-trigger" data-dismiss="modal" data-bs-dismiss="modal">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>