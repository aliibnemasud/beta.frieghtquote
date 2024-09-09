<!DOCTYPE html>
<html lang="en">

<head>
    <title>ITC Staff Directory</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url(); ?>assets/temp/img/favicon.png">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/temp/source/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <style>
        @media only screen and (max-width: 600px) {
            #logo_image {
                margin-left: 20px !important;
                width: 10rem !important;
            }
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 300px;
            margin: auto;
            text-align: center;
            font-family: arial;
        }

        p {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <img src="<?= base_url(); ?>assets/temp/img/logo.png" style="margin-top: 30px;width: 250px;margin-left: 200px;" id="logo_image" alt="">
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-success" style="float: right" id="create_staff" data-toggle="modal" data-target="#exampleModal">Create</button>
            </div>
        </div>

        <?php if (count($employee) > 0) { ?>
            <div class="row mt-5">
                <?php foreach ($employee as $emp) { ?>
                    <div class="col-md-3 mt-2 employee_card" id="employee_card<?= $emp['id'] ?>" data-id="<?= $emp['id'] ?>" style="cursor: pointer">
                        <div class="card">
                            <img src="<?= base_url() . $emp['image'] ?>" alt="John" style="width:180px;margin:auto;margin-top: 30px">
                            <h4 data-first="<?= $emp['f_name'] ?>" data-last="<?= $emp['l_name'] ?>" class="mt-2 edit_name" style="margin-bottom: 0rem"><?= $emp['f_name'] . " " . $emp['l_name'] ?></h4>
                            <p data-val="<?= $emp['position'] ?>" class="edit_position title mb-2"><?= $emp['position'] ?></p>
                            <p data-val="<?= $emp['email'] ?>" class="edit_email title" style="margin-bottom: 0rem"><?= $emp['email'] ?></p>
                            <p data-val="<?= $emp['direct_phone'] ?>" class="edit_direct_phone title" style="margin-bottom: 0rem">Direct Phone: <?= $emp['direct_phone'] ?></p>
                            <p data-val="<?= $emp['cell_phone'] ?>" class="edit_cell_phone title" style="margin-bottom: 0rem">Cell Phone: <?= $emp['cell_phone'] ?></p>
                            <p data-val="<?= $emp['extension'] ?>" class="edit_extension title" style="margin-bottom: 0rem">Extension: <?= $emp['extension'] ?></p>
                            <p data-val="<?= $emp['workstation'] ?>" class="edit_workstation title"><?= $emp['workstation'] ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    <h2>There is no employeers</h2>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: #808080e0">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url(); ?>staff/save_employee" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="f_name">First Name</label>
                                <input type="text" class="form-control" id="f_name" name="f_name" required="true">
                            </div>
                            <div class="col-md-6">
                                <label for="l_name">Last Name</label>
                                <input type="text" class="form-control" id="l_name" name="l_name" required="true">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="pos">Position/Job Title</label>
                                <input type="text" class="form-control" id="pos" name="pos" required="true">
                            </div>
                            <div class="col-md-6">
                                <label for="email_add">Email Address</label>
                                <input type="text" class="form-control" id="email_add" name="email_add" required="true">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="direct_phone">Direct Phone Number</label>
                                <input type="text" class="form-control" id="direct_phone" name="direct_phone" required="true">
                            </div>
                            <div class="col-md-6">
                                <label for="cell_phone">Cell Phone Number</label>
                                <input type="text" class="form-control" id="cell_phone" name="cell_phone" required="true">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="direct_phone">Extension</label>
                                <input type="text" class="form-control" id="extension" name="extension" required="true">
                            </div>
                            <div class="col-md-6">
                                <label for="cell_phone">Workstating Location</label>
                                <input type="text" class="form-control" id="workstation" name="workstation" required="true">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <button class="btn btn-success w-100" id="view_upload" type="button"><i class="fas fa-upload"></i> Upload Image</button>
                                <input type="file" class="form-control" id="file_upload" name="file_upload" style="display: none">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success" type="submit" style="float: right;margin-right: 1rem">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: #808080e0">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url(); ?>staff/update_employee" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mt-2 show_employee"></div>
                            <div class="col-md-8 mt-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="f_name">First Name</label>
                                        <input type="text" class="form-control" id="edit_f_name" name="edit_f_name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="l_name">Last Name</label>
                                        <input type="text" class="form-control" id="edit_l_name" name="edit_l_name">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label for="pos">Position/Job Title</label>
                                        <input type="text" class="form-control" id="edit_pos" name="edit_pos">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email_add">Email Address</label>
                                        <input type="text" class="form-control" id="edit_email_add" name="edit_email_add">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label for="direct_phone">Direct Phone Number</label>
                                        <input type="text" class="form-control" id="edit_direct_phone" name="edit_direct_phone">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="cell_phone">Cell Phone Number</label>
                                        <input type="text" class="form-control" id="edit_cell_phone" name="edit_cell_phone">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label for="direct_phone">Extension</label>
                                        <input type="text" class="form-control" id="edit_extension" name="edit_extension">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="cell_phone">Workstating Location</label>
                                        <input type="text" class="form-control" id="edit_workstation" name="edit_workstation">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <button class="btn btn-success w-100" id="edit_view_upload" type="button"><i class="fas fa-recycle"></i> Change Image</button>
                                        <input type="file" class="form-control" id="edit_file_upload" name="edit_file_upload" style="display: none">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="hidden_edit_id" name="hidden_edit_id">
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-danger" id="delete_user" style="float: right;margin-right: 1rem">Delete</button>
                                <button class="btn btn-success" type="submit" style="float: right;margin-right: 1rem">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?= base_url(); ?>assets/temp/source/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/temp/source/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/staff.js"></script>
</body>

</html>
