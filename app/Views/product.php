<?php include('header.php'); ?>
        <div class="content-wrapper">

          <!--Product  form -->
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title" id="p_title">Add Product </h4>
                  <form class="form-sample" method="POST" action="" enctype="multipart/form-data" id="addproduct">
                    <p class="card-description" id="p_desc">
                      Add Product without Reloading Page using AJAX
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Product Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="product_name" id="product_name" value="" class="form-control"  placeholder="Please Enter Product Name"/>
                            <input type="hidden" name="action_type" id="action_type" value="Add" />
                            <input type="hidden" name="productid" id="productid" value="" />

                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Price</label>
                          <div class="col-sm-9">
                            <input type="number" name="price" id="price" value="" class="form-control"  placeholder="Please Enter Price"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Quantity</label>
                          <div class="col-sm-9">
                            <input type="number" name="quantity" id="quantity" value="" class="form-control" placeholder="Please Enter Quantity"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Image</label>
                          <div class="col-sm-9">
                            <input type="file" name="image" id="image" value="" class="form-control" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 old-image-div" style="display: none;">  </div>
                      <div class="col-md-6 old-image-div" style="display: none;">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Old Image</label>
                          <div class="col-sm-9">
                            <img src="" id="old_img_tag" width="35%">
                            <input type="hidden" name="old_image" id="old_image" value="" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mfg. Date</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="date" name="mfg_date" id="mfg_date" value="" placeholder="dd/mm/yyyy"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Exp. Date</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="date" name="exp_date" id="exp_date" value="" placeholder="dd/mm/yyyy"/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2" style="float: right;" id="formbtn">Submit</button>
                    <button type="button" class="btn btn-secondary mb-2" style="float: left;" onclick="clearForm()">Clear</button>
                    
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!--Product  tables -->
          <div class="row">
            <div class="col-lg-12 stretch-card">
              <div class="card">
                <div class="card-body">
              <h4 class="card-title">Product List</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="product-table" class="table">
                      <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Mfg. Date</th>
                            <th>Exp. Date</th>
                            <th>Image</th>
                            <!-- <th>Added Date</th> -->
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody id="tablebody">
                        <tr>
                            <td>1</td>
                            <td>Product Name</td>
                            <td>Price</td>
                            <td>Quantity</td>
                            <td>Mfg. Date</td>
                            <td>Exp. Date</td>
                            <td>Image</td>
                            <!-- <td>Added Date</td> -->
                            <td>
                              <button type="button" class="btn btn-primary btn-rounded btn-icon"> 
                                <i class="ti-pencil"></i> 
                              </button>
                              <button type="button" class="btn btn-danger btn-rounded btn-icon"> 
                                <i class="ti-trash"></i> 
                              </button>
                            </td>
                        </tr>
                        <!-- <tr>
                            <td>2</td>
                            <td>2015/04/01</td>
                            <td>Doe</td>
                            <td>Brazil</td>
                            <td>$4500</td>
                            <td>$7500</td>
                            <td>
                              <label class="badge badge-danger">Pending</label>
                            </td>
                            <td>
                              <button class="btn btn-outline-primary">View</button>
                            </td>
                        </tr> -->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
<?php include('footer.php'); ?>
       
