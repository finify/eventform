<?php $this->start('head');?>
<meta content="test">
<?php $this->end();?>

<?php $this->start('body');?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i style="font-size:30px;" class="tf-icons bx bxs-layer"></i>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Event</span>
                            <h3 class="card-title mb-2"><?= $this->EventsCount?></h3>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i style="font-size:30px;" class="tf-icons bx bxs-user-check"></i>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Attendees</span>
                            <h3 class="card-title mb-2"><?= $this->CustomersCount?></h3>
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
                        Customer Deleted Successfully
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }else{
                    echo "
                    <div class='alert alert-danger alert-dismissible' role='alert'>
                        Customer Could not Delete
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
               
            }
            ?>
            <h5 class="card-header">Attendance List</h5>
            <div class="table-responsive text-nowrap">
                <table id="homeTable" class="table table-dark">
                <thead>
                    <tr>
                    <th>Name </th>
                    <th>Email</th>
                    <th>Day</th>
                    <th>Subscribed</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php
                        $Customers = $this->Customers;

                        
                        if(!empty($Customers)){
                            foreach($Customers as $Customer){
                                
                                if($Customer->Confirmed == 0){
                                    $status = "<span class='badge bg-label-danger me-1'>Pending</span>";
                                }elseif($Customer->Confirmed == 1){
                                    $status = "<span class='badge bg-label-success me-1'>Completed</span>";
                                }

                                if($Customer->Subscribe == 0){
                                    $subscribe = "<span class='badge bg-label-danger me-1'>Not Subscribed</span>";
                                }elseif($Customer->Subscribe == 1){
                                    $subscribe = "<span class='badge bg-label-success me-1'>Subscribed</span>";
                                }


                                $onclick = "onclick=\"return confirm('Are you sure you want to Delete this purchase, please confirm');\"";
                                echo "<tr>
                                        <td>$Customer->Full_Name </td>
                                        <td>$Customer->Email </td>
                                        <td>$Customer->Day </td>
                                        <td>$subscribe </td>
                                        <td>$status </td>
                                        <td>$Customer->Created </td>
                                        <td>
                                            <div class='dropdown'>
                                            <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                                <i class='bx bx-dots-vertical-rounded'></i>
                                            </button>
                                            <div class='dropdown-menu'>
                                                <a $onclick class='dropdown-item' href='".PROOT."home/delete/$Customer->id'
                                                ><i class='bx bx-trash me-1'></i> Delete</a
                                                >
                                            </div>
                                            </div>
                                        </td>
                                    </tr>";
                                
                            }
                        }else{
                            echo "
                            <div class='alert alert-danger alert-dismissible' role='alert'>
                                No Attendee yet

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