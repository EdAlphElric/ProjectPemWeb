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
					<a href="<?php echo base_url()?>forum">FORUM</a>
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
					<a href="<?php echo base_url()?>user/profile/<?php echo $user_nama;?>">My Profile</a>
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
            <?php
            if($user_nama!="Guest"){?>
                <button class="btn btn-success" onclick="add_thread()"><i class="glyphicon glyphicon-plus" style="margin: 5px"></i> Tambah Ulasan</button>
            <?php
            }
            ?>
                <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh" style="margin: 5px"></i> Reload</button>
                <br />
                <br />
                <table id="table" class="table table-striped " cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Gambar Ulasan</th>
                            <th>Judul Ulasan</th>
                            <th>Penulis</th>
                            <th>Rating</th>
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
            "url": "<?php echo site_url('forum/ajax_list')?>",
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

$(function() {
    $('#upload_file').save(function(e) {
        e.preventDefault();
        $.ajaxFileUpload({
            url             :'./upload/upload_file/', 
            secureuri       :false,
            fileElementId   :'userfile',
            dataType        : 'json',
            data            : {
                'title'             : $('#title').val()
            },
            success : function (data, status)
            {
                if(data.status != 'error')
                {
                    $('#files').html('<p>Reloading files...</p>');
                    refresh_files();
                    $('#title').val('');
                }
                alert(data.msg);
            }
        });
        return false;
    });
});

function add_thread()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Ulasan'); // Set Title to Bootstrap modal title
}

function edit_thread(posting_id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('forum/ajax_edit/')?>/" + posting_id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="posting_id"]').val(data.posting_id);
            $('[name="posting_rating"]').val(data.posting_rating);
            $('[name="posting_user_id"]').val(data.posting_user_id);
            $('[name="posting_user_nama"]').val(data.posting_user_nama);
            $('[name="posting_judul"]').val(data.posting_judul);
            $('[name="posting_artikel"]').val(data.posting_artikel);
            $('[name="posting_mkn_foto"]').val(data.posting_mkn_foto);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Thread'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
function rating_thread(posting_id)
{
    $.ajax({
        url : "<?php echo site_url('forum/ajax_rating')?>/"+posting_id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            reload_table();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error + Rating data');
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
        url = "<?php echo site_url('forum/ajax_add')?>";
    } else {
        url = "<?php echo site_url('forum/ajax_update')?>";
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

function delete_thread(posting_id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('forum/ajax_delete')?>/"+posting_id,
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
                    <input type="hidden" value="" name="posting_id"/> 
                    <input type="hidden" value="0" name="posting_rating"/> 
                    <input type="hidden" value="<?php echo $this->session->userdata('user_id') ?>" name="posting_user_id"/> 
                    <input type="hidden" value="<?php echo $user_nama; ?>" name="posting_user_nama"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Judul Ulasan</label>
                            <div class="col-md-9">
                                <input name="posting_judul" placeholder="JUDUL ULASAN" class="form-control formText" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tulis Ulasan</label>
                            <div class="col-md-9">
                                <textarea rows="10" name="posting_artikel" placeholder="TULIS ULASAN ANDA DISINI" class="form-control formText"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Masukkan Gambar</label>
                            <div class="col-md-9">
                                <input name="posting_mkn_foto" type="file">
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
