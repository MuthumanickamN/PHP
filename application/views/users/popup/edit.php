
<div class="modal fade rotate" id="update-user" style="display:none;">
    <div class="modal-dialog modal-lg"> 
        <form id="update-user-form" method="post">   
            <div class="modal-content panel panel-primary">
                <div class="modal-header panel-heading">
                    <h4 class="modal-title -remove-title">Edit/Update</h4>
                    <button type="button" class="close" data-dismiss="modal" onclick="close_model()">&times;<span class="close-x">Close</span></button>
                </div>
                <div class="modal-body panel-body" id="render-update-data">
                    <div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>
                </div>
                <div class="modal-footer panel-footer">
                    <div class="row">
                        <div class="col-sm-12">                            
                            <button type="button" class="btn rkmd-btn btn-secondary" data-addempid="" id="update-user">Update</button> 
                            <button type="button" class="btn rkmd-btn btn-secondary" data-dismiss="modal" onclick="close_model()">Close</button>
                        </div>                    
                    </div>
                </div>
            </div>
        </form>      
    </div>
</div>
<script>
    function close_model(){
        $(".modal-fade").modal("hide");
        $(".modal-backdrop").remove();
    }
</script>
