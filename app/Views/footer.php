 <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?=base_url()?>/assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <script src="<?=base_url()?>/assets/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
  <!-- Plugin js for this page -->
  <script src="<?=base_url()?>/assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?=base_url()?>/assets/js/off-canvas.js"></script>
  <script src="<?=base_url()?>/assets/js/hoverable-collapse.js"></script>
  <script src="<?=base_url()?>/assets/js/template.js"></script>
  <!-- endinject -->
  <script src="<?=base_url()?>/assets/js/form-validation.js"></script>
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
  <script src="<?=base_url()?>/assets/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="<?=base_url()?>/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="<?=base_url()?>/assets/js/data-table.js"></script>
  <script src="<?=base_url()?>/assets/js/toastDemo.js"></script>
  <script src="<?=base_url()?>/assets/js/desktop-notification.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    getProduct();
    $(".old-image-div").css('display', 'none');
  });
  $("#addproduct").submit(function(event){
    event.preventDefault();
    $.ajax({
      type: "POST",
      url:"<?=base_url('Home/saveProduct')?>",
      dataType: 'json',
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success:function(response){
        console.log(response);
        if(response.status==0){
          dangerToast(response.message);
        }else{
          $("#addproduct")[0].reset();//reset form
          clearForm();
          succToast(response.message);
          getProduct();
        }
      }
    });
  });

  function getProduct(){
    $.ajax({
      url:"<?=base_url('Home/getProductList')?>",
      dataType: 'html',
      success:function(response){
        infoToast("Updating Product List...");
        $("#tablebody").html(response);
        $("#product-table").DataTable();
        //tableFn();
      },
      error:function(){
        dangerToast("Error.....");
      }
    });
  }

  function editProduct(pid){
    $.ajax({
      type: "POST",
      url:"<?=base_url('Home/editProduct')?>",
      data: {'id': pid},
      dataType: 'json',
      success:function(response){
        if(response.status==1){
          infoToast("Edit Product");
          window.location.href="#formdiv";
          //we need to modify form
          $("#p_title").html("Update Product");
          $("#p_desc").html("Update Product without Reloading Page using AJAX");
          $("#action_type").val("Edit");
          $("#productid").val(response.message.id);
          $("#product_name").val(response.message.product_name);
          $("#price").val(response.message.price);
          $("#quantity").val(response.message.quantity);
          $("#mfg_date").val(response.message.mfg_date);
          $("#exp_date").val(response.message.exp_date);
          $("#formbtn").html("Update");
          $(".old-image-div").css('display', 'block');
          $("#old_image").val(response.message.image);
          $("#old_img_tag").attr("src", "<?=base_url()?>/public/upload/product/"+response.message.image);
          changeUrl("Crud Using Ajax", "<?=base_url()?>/Home/product");
        }else{
          dangerToast(response.message);
        }
        
        
      },
      error:function(){
        dangerToast("Error.....");
      }
    });
  }

  function deleteProduct(productid){
    //alert(productid);
    $.ajax({
      type: "POST",
      data: {'id': productid},
      dataType: 'json',
      url:"<?=base_url('Home/deleteProduct')?>",
      success:function(response){
        //console.log(response);
        if(response.status==0){
          dangerToast(response.message);
        }else{
          succToast(response.message);
          getProduct();
        }
      },
      error:function(){
        dangerToast("Error.....");
      }
    });
  }

  function tableFn(){
    var table = $("#product-table").DataTable({
      paging: true,
      searching: true,
      ordering: true,
      scrollx: true,
      scroller: true
    });
  }
  function changeUrl(page='', url){
    if(typeof(history.pushState)!='undefined'){
      var obj = { Page:page, Url:url};
      history.pushState(obj, obj.Page, obj.Url);
    }else{
      alert("Browser dose not Support HTML5");
    }
  }
  function clearForm(){
    $("#addproduct")[0].reset();//reset form
    $("#p_title").html("Add Product");
    $("#p_desc").html("Add Product without Reloading Page using AJAX");
    $("#action_type").val("Add");
    $("#product_name").val();
    $("#price").val();
    $("#quantity").val();
    $("#mfg_date").val();
    $("#exp_date").val();
    $("#formbtn").html("Submit");
    $(".old-image-div").css('display', 'none');
  }
  function succToast(msg){
    resetToastPosition();
    $.toast({
      heading: 'Success',
      text: msg,
      showHideTransition: 'slide',
      icon: 'success',
      loderBg: '#f96868',
      position: 'top-right'
    });
  }
  function infoToast(msg){
    resetToastPosition();
    $.toast({
      heading: 'Info',
      text: msg,
      showHideTransition: 'slide',
      icon: 'info',
      loderBg: '#46c35f',
      position: 'top-right'
    });
  }
  function dangerToast(msg){
    resetToastPosition();
    $.toast({
      heading: 'Error...',
      text: msg,
      showHideTransition: 'slide',
      icon: 'error',
      loderBg: '#f2a654',
      position: 'top-right'
    });
  }
</script>
</body>

</html>