<?php

$Req_id = $_POST['req_id'];
$HOD_id = $_POST['hod_id'];

$form_hod_sansation = '<div class="modal-body"><form name="remark" method="post"><div style="text-align: center;"><select id="hod_sansation" name="hod_sansation" style="color:black; display:inline-block; max-width: 200px;" class="form-control" name="status" required> <option value="">Choose your option</option> <option value="1">Approved</option> <option value="2">Not Approved</option> </select></div> <input type="hidden" id="Req-Hod-Ids" class="Req-Hod-Ids" name="Req-Hod-Ids" req_id="'.$Req_id.'" hod_id="'.$HOD_id.'"> <textarea  placeholder="leave the comment here" id="action_comment" class="form-control m-t-2" name="action_comment" rows="5" required></textarea> <div> <button onclick="Do_direct_ActionOnRequest()" type="button" class="btn btn-blue m-b-xs Do_direct_ActionOnRequest" name="submitAction" value="Send sansation">Send sansation</button> </div></form></div>';

echo $form_hod_sansation;
?>