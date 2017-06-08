<?php
        if($this->session->userdata('user_nama')!=null){
            $user_nama = $this->session->userdata('user_nama');
        }else{
            $user_nama = "Guest";
        }
?>
<div class="base-grid forum fade1">
<div class="layer fade2 layer-forum" >
		<div class="nothing" ></div>
		<div class="col-sm-1"></div>
		<div class="list col-sm-10 " style="animation: fadein08 5s;">
			<div class="col-sm-8 ">
				<span class="fontForum">
					<a href="<?php echo base_url()?>forum">Forum</a>
				</span>
			</div>
			<div class="col-sm-1 ">
				<span class="fontForum ">
					<a href="<?php echo base_url()?>user_list">Anggota</a>
				</span>
			</div>
			<div class="dropdown col-sm-2 fontForum">
				<button class="dropbtn fontForum"><?php echo $user_nama; ?>
				</button>
			<?php 
				if($user_nama=="Guest"){
			?>
				<div class="dropdown-content">
					<a href="<?php echo base_url(); ?>user/login_page">Masuk</a>
					<a href="<?php echo base_url(); ?>user/login">Daftar</a>
				</div>
			<?php
				}else{
			?>
				<div class="dropdown-content">  
					<a href="<?php echo base_url(); ?>user/login_page">My Profile</a>
					<a href="<?php echo base_url(); ?>user/logout">Logout</a>
				</div>
			<?php
				}
			?>
			</div>
			<div class="dropdown col-sm-1">
					<img class="img-circle" src="images/fff.png" width="50px" height="50px">
				<div class="dropdown-content">
					<a href="#forum/account">Ganti Foto Profile</a>
				</div>
			</div><br>
			<div class="col-sm-12">
				<ul class="nav navbar-nav trending-menu col-sm-12">
					<li class="col-sm-2" ><a class="week" href="#">TRENDING:</a></li>
				<?php
				$i=0;
				while ($i <= 0) {
				?>
					<li class="col-sm-2"><a href="#">TOP TRENDING</a></li>
				<?php
				$i++; 
				}
				?>
				</ul>
			</div><br>
            <div class="col-sm-12" style="height: 10px"></div>
 			<div class="container col-sm-12">

                <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh" style="margin: 5px"></i> Reload</button>
                <br />
                <br />
                <table id="table" class="table table-striped " cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Foto User</th>
                            <th>Nama User</th>
                            <th>Telepon User</th>
                            <th>Lokasi User</th>
                            <th>Logged In?</th>
                        <?php
                            if($this->session->userdata('user_jenis')=='Admin'){
                        ?>
                            <th>Jenis User</th>
                            <th>User Status</th>
                        <?php } 
                            if($user_nama !='Guest'){
                        ?>
                            <th style="width:125px;">Action</th>
                        <?php
                            }
                        ?>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>

                    <tfoot>
                    <tr>
                            <th>Foto User</th>
                            <th>Nama User</th>
                            <th>Telepon User</th>
                            <th>Lokasi User</th>
                            <th>Logged In?</th>
                        <?php
                            if($this->session->userdata('user_jenis')=='Admin'){
                        ?>
                            <th>Jenis User</th>
                            <th>User Status</th>
                        <?php } 
                            if($user_nama !='Guest'){
                        ?>
                            <th style="width:125px;">Action</th>
                        <?php
                            }
                        ?>
                    </tr>
                    </tfoot>
                </table>
            </div>
		</div>
	</div>
</div>



<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/dataTables.bootstrap.js')?>"></script>
<script type="text/javascript">
var save_method; //for save method string
var table;

$(document).ready(function() {

    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('user_list/ajax_list')?>",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],

    });
});


function edit_user(user_id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('user_list/ajax_edit/')?>/" + user_id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="user_id"]').val(data.user_id);
            $('[name="user_status"]').val(data.user_status);
            $('[name="user_jenis"]').val(data.user_jenis);
            $('[name="user_saldo"]').val(data.user_saldo);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Administrator'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
    } else {
        url = "<?php echo site_url('user_list/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            }

            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function delete_user(user_id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('user_list/ajax_delete')?>/"+user_id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

</script>
<?php
if($this->session->userdata('user_jenis')=="Admin"){
?>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">ADMINISTRATOR</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="user_id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Status User</label>
                            <div class="col-md-9">
                                <select name="user_status" class="selectpicker">
                                  <option class="btn-success" value="Active">Active</option>
                                  <option class="btn-danger" value="Banned">Banned</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Jenis User</label>
                            <div class="col-md-9">
                                <select name="user_jenis" class="selectpicker">
                                  <option class="btn-danger" value="Guest">Guest</option>
                                  <option class="btn-success" value="Admin">Admin</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">User Saldo</label>
                            <div class="col-md-9">
                                <input name="user_saldo" placeholder="USER_SALDO" class="form-control formText" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<?php
}
?>