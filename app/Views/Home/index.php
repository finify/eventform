<?php $this->start('head');?>
<meta content="test">
<?php $this->end();?>

<?php $this->start('body');?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                        <?php
                        if(isset($data['status'])){
                            echo "
                            <div class='alert alert-success alert-dismissible' role='alert'>
                                 Uploaded Successfully
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                            }
                        ?>
                        <?php
                        if(isset($data['error'])){
                            echo "
                            <div class='alert alert-danger alert-dismissible' role='alert'>
                                Wrong file format Selected
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                            }
                        ?>


                            <h5 class="card-title text-primary">Upload Csv🎉</h5>
                            <form action="<?= PROOT?>home/upload" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Csv File</label>
                                <input type="file" required name="csv_file" class="form-control" id="basic-default-fullname"  />
                                </div>
                                <button name="submit" type="submit" class="btn btn-primary">Upload Products</button>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i style="font-size:30px;" class="tf-icons bx bx-spreadsheet"></i>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Products</span>
                            <h3 class="card-title mb-2"><?= $this->ProductsCount?></h3>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap Dark Table -->
        <div class="card">
        <?php
            if(isset($data['deletedstatus'])){
                if($data['deletedstatus'] === true){
                    echo "
                    <div class='alert alert-success alert-dismissible' role='alert'>
                        Purchase Deleted Successfully
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }else{
                    echo "
                    <div class='alert alert-danger alert-dismissible' role='alert'>
                        Purchase Could not Delete
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
               
            }
            ?>
            <h5 class="card-header">All Products</h5>
            <div class="table-responsive text-nowrap">
                <table id="homeTable" class="table table-dark">
                <thead>
                    <tr>
                    <th>Product </th>
                    <th>Vendor</th>
                    <th>Amount</th>
                    <th>Created</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php
                        $Products = $this->Products;

                        
                        if(!empty($Products)){
                            foreach($Products as $Product){
                                
                                if($Product->Title != ""){
                                    $Variant_Price = number_format($Product->Variant_Price);
                                    $onclick = "onclick=\"return confirm('Are you sure you want to Delete this purchase, please confirm');\"";
                                    echo "<tr>
                                            <td>$Product->Title </td>
                                            <td>$Product->Vendor </td>
                                            <td>₦ $Variant_Price </td>
                                            <td>₦ $Product->Created_At </td>
                                            <td>
                                                <div class='dropdown'>
                                                <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                                    <i class='bx bx-dots-vertical-rounded'></i>
                                                </button>
                                                <div class='dropdown-menu'>
                                                    <a class='dropdown-item' href='".PROOT."purchase/editpurchase/$Product->id'
                                                    ><i class='bx bx-edit-alt me-1'></i> Edit Product</a
                                                    >
                                                    <a $onclick class='dropdown-item' href='".PROOT."home/deletepurchase/$Product->id'
                                                    ><i class='bx bx-trash me-1'></i> Delete</a
                                                    >
                                                </div>
                                                </div>
                                            </td>
                                        </tr>";
                                }
                                
                            }
                        }else{
                            echo "
                            <div class='alert alert-danger alert-dismissible' role='alert'>
                                No Property Purchased yet
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                        }
                        
                    ?>
                </tbody>
                </table>
            </div>
        </div>
        <!--/ Bootstrap Dark Table -->
    </div>

<?php $this->end();?>