<div class="base-grid forum fade1">
<div class="layer fade2 layer-forum" >
		<div class="nothing" ></div>
		<div class="col-sm-1"></div>
		<div class="list col-sm-10 " style="animation: fadein08 5s;">
			<div class="col-sm-8 ">
				<span class="fontForum">
					<a href="#forum">FORUM</a>
				</span>
			</div>
			<div class="col-sm-1 ">
				<span class="fontForum ">
					<a href="#forum/member">Anggota</a>
				</span>
			</div>
			<div class="dropdown col-sm-2 fontForum">
				<button class="dropbtn fontForum"><?php echo $username; ?>
				</button>
			<?php 
				if($username=="Guest"){
			?>
				<div class="dropdown-content">
					<a href="#login">Masuk</a>
					<a href="#register">Daftar</a>
				</div>
			<?php
				}else{
			?>
				<div class="dropdown-content">
					<a href="#account">My Profile</a>
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
 			<div class="container col-sm-12">
                <button class="btn btn-success" onclick="add_thread()"><i class="glyphicon glyphicon-plus"></i> Tambah Ulasan</button>
                <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                <br />
                <br />
                <table id="table" class="table table-striped " cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Gambar Ulasan</th>
                            <th>Judul Ulasan</th>
                            <th>Penulis</th>
                            <th>Rating</th>
                            <th>Tanggal Penulisan</th>
                            <th style="width:125px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>

                    <tfoot>
                    <tr>
                        <th>Gambar Ulasan</th>
                        <th>Judul Ulasan</th>
                        <th>Penulis</th>
                        <th>Rating</th>
                        <th>Tanggal Penulisan</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
		</div>
	</div>
</div>



<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>


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
            "url": "<?php echo site_url('person/ajax_list')?>",
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

    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });

});



function add_thread()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
}

/*function edit_person(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('person/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="firstName"]').val(data.firstName);
            $('[name="lastName"]').val(data.lastName);
            $('[name="gender"]').val(data.gender);
            $('[name="address"]').val(data.address);
            $('[name="dob"]').datepicker('update',data.dob);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}*/

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
        url = "<?php echo site_url('thread/ajax_add')?>";
    } /*else {
        url = "<?php echo site_url('thread/ajax_update')?>";
    }*/

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

function delete_person(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('person/ajax_delete')?>/"+id,
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

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Buat Ulasan</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Judul Ulasan</label>
                            <div class="col-md-9">
                                <input name="judul" placeholder="JUDUL ULASAN" class="form-control formText" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tulis Ulasan</label>
                            <div class="col-md-9">
                                <textarea rows="10" name="ulasan" placeholder="TULIS ULASAN ANDA DISINI" class="form-control formText"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Masukkan Gambar</label>
                            <div class="col-md-9">
                                <input name="gambar" type="file">
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
</body>
</html>