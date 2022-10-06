<div class="col">
    <label>Enter the reason for rejecting : <span class="text-danger">*</span></label>
    <textarea name="topup_remark" id="topup_remark" class="form-control" placeholder="Enter remark" required></textarea>
    <input hidden type="text" name="id_topup_reject" id="id_topup_reject" class="form-control form-control-solid" value="<?= @$topup->topup_id ?>"/>
</div>
