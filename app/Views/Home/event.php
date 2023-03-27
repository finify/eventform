<?php $this->start('head');?>
<meta content="test">
<?php $this->end();?>

<?php $this->start('body');?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-12">
                        <div class="card-body">
                        <?php
                        if(isset($data['insertedstatus'])){
                            if($data['insertedstatus']){
                            echo "
                            <div class='alert alert-success alert-dismissible' role='alert'>
                                 New Event Added Successfully
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                            }else{
                                echo "
                                <div class='alert alert-danger alert-dismissible' role='alert'>
                                    Event Not Added
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                            }
                        }
                        ?>
                        


                            <h5 class="card-title text-primary">Add New Event🎉</h5>
                            <form action="<?= PROOT?>event/index" method="post">
                                <div class="mb-3">
                                    <label class="form-label" for="event_name">Event Name</label>
                                    <input type="text" required name="Event_Name" class="form-control" id="event_name" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="max">Max Attendees</label>
                                    <input type="number" required name="max" class="form-control" id="max" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Date</label>
                                    <input type="date" value="2023-01-01" required name="Event_Date" class="form-control"  />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="Position">Position</label>
                                    <input type="number" required name="Position" class="form-control" id="Position" />
                                </div>
                                <button name="submit" type="submit" class="btn btn-primary">Add New Event</button>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 mb-4">
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
            <h5 class="card-header">Attendance List</h5>
            <div class="table-responsive text-nowrap">
                <table id="homeTable" class="table table-dark">
                <thead>
                    <tr>
                    <th>Event Name </th>
                    <th>Date</th>
                    <th>Max</th>
                    <th>Position</th>
                    <th>Attendees</th>
                    <th>Created</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php
                        $Schedules = $this->Schedules;

                        
                        if(!empty($Schedules)){
                            foreach($Schedules as $Schedule){
                                
                                
                                $onclick = "onclick=\"return confirm('Are you sure you want to Delete this purchase, please confirm');\"";
                                echo "<tr>
                                        <td>$Schedule->Event_Name </td>
                                        <td>$Schedule->Event_Day </td>
                                        <td>$Schedule->Max_Attendees </td>
                                        <td>$Schedule->Position </td>
                                        <td>$Schedule->Attendees </td>
                                        <td>$Schedule->Created </td>
                                        <td>
                                            <div class='dropdown'>
                                            <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                                <i class='bx bx-dots-vertical-rounded'></i>
                                            </button>
                                            <div class='dropdown-menu'>
                                                <a $onclick class='dropdown-item' href='".PROOT."home/deletepurchase/$Schedule->id'
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