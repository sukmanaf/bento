
    
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?php echo ucfirst($this->uri->segment(1)) ?></h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
        

        <form action="#" id="postForm" class="form-horizontal" enctype="multipart/form-data" method="post">
            <fieldset class="content-group">

        
     

        <div class="form-group">
                    <label class="control-label col-lg-2">menu</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="menu" name="menu" value="<?php echo $menu; ?>">
                    </div>
                </div>
        
        
     

        <div class="form-group">
                    <label class="control-label col-lg-2">controller</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="controller" name="controller" value="<?php echo $controller; ?>">
                    </div>
                </div>
        
        
     

        <div class="form-group">
                    <label class="control-label col-lg-2">parent</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="parent" name="parent" value="<?php echo $parent; ?>">
                    </div>
                </div>
        
        
     

        <div class="form-group">
                    <label class="control-label col-lg-2">active</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="active" name="active" value="<?php echo $active; ?>">
                        <!-- <div class="checkbox checkbox-switchery">
                            <label>
                                <input type="checkbox" name="active" class="switchery-primary" value="1" checked="checked">
                            </label>
                        </div> -->
                    </div>
                </div>
        
        <div align="center">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> <?php echo $button ?></button>
        <a href="<?php echo site_url('menu') ?>" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
        </div>
	    <input type="hidden" name="id_menu" value="<?php echo $id_menu; ?>" /> 
	</form>
    </div>
    </div>
    </div>
    <script >
$(document).ready(function() {
   // $('.summernote').summernote({
   //              height: "700px",
                
   //          });
$('#isi').summernote({
            height: 700,
            callbacks: {
                   onImageUpload: function(image) {
                               uploadImage(image[0]);
                           }
               }

            
        });

function uploadImage(image) {
        var data = new FormData();
        data.append("image", image);
        $.ajax({
            url:'<?php echo site_url('menu/upload_summernote');?>', //URL submit
                     type:"post", //method Submit
                     data:data, //penggunaan FormData
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
            success: function(url) {
                console.log('url', url)
                var image = $('<img>').attr('src', url);
                $('#isi').summernote("insertNode", image[0]);
            },
            error: function(data) {
                console.log('data', data)
            }
        });
    }


   $("#postForm").submit(function(event){
        $(".btn").css('display','none');
        event.preventDefault(); //prevent default action 
        var post_url = '<?php echo $action ?>'; //get form action url
        var request_method = $(this).attr("method"); //get form GET/POST method
        var form_data = new FormData(this); //Encode form elements for submission
        
        if ($('#desc').summernote('codeview.isActivated')) {
            $('#desc').summernote('codeview.deactivate'); 
        }
        
        $.ajax({
            url : post_url,
            type: 'POST',
            data : form_data,
            processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
        }).done(function(response){
            if (response == 1){

            // alert('Data Tersimpan');

            // $.notify("Data tersimpan", "success");
            $.growl.notice({ message: "Simpan Sukses!" });
              // $.growl.error({ message: "The kitten is attacking!" });
              // $.growl.notice({ message: "The kitten is cute!" });
              // $.growl.warning({ message: "The kitten is ugly!" });
             
            setTimeout(function () {
                    window.location.replace('<?php echo site_url('menu') ?>')
                       
                    }, 2000);
                //    $.ajax({
                //              url:'<?php echo site_url('menu/do_upload');?>', //URL submit
                //              type:"post", //method Submit
                //              data:new FormData(this), //penggunaan FormData
                //              processData:false,
                //              contentType:false,
                //              cache:false,
                //              async:false,
                //               success: function(data){
                //                   alert("Upload Image Berhasil."); //alert jika upload berhasil
                //            }
                //          });
            }else{
                $.growl.warning({ message: "Simpan gagal!" });
                $(".btn").css('display','inline');

            }
        });

        
    });
});

    


</script>
