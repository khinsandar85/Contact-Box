<?php 
    session_start();
    require_once "function.php"; 
    require_once "base.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="vendor/feather-icons-web/feather.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">    
    <title>Contact List</title>
</head>
<body style="background: var(--primary-soft);">
    
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div  class="d-flex justify-content-between align-items-center ">
                            <h3 class="text-success">
                                <i class="feather-users"></i>
                                Contacts
                            </h3>
                            <div class="">
                                <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="feather-plus"></i>
                                </button>
                            </div>
                        </div>
                        <?php
                            if(isset($_POST['createBtn'])){
                                createContact();
                            }
                        ?>
                        <hr>
                        <table class="table table-hover table-bordered mt-3 mb-0 ">
                            <thead class="table-info">
                                <tr>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach(contacts() as $c){ ?>
                                    <tr>
                                        <td class="text-nowrap">
                                            <div class="d-flex align-items-center">
                                                <img src="store/<?php echo $c['photo']; ?>" alt="" class="" style=" width: 15%;border-radius: 50%; margin-right:10px;">
                                                <p class="font-weight-bolder mb-0 ml-3"><?php echo $c['name']; ?></p>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="font-weight-bolder mt-2 ml-3"><?php echo $c['phone']; ?></p>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-success" id="exampleModalLabel">
                    Create new contact
                </h3>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name" class="text-success font-weight-bold">Your Name</label>
                        <input type="text" name="name" id="name" value="<?php echo old('name'); ?>" class="form-control"> 
                        <?php if(getError('name')){ ?>
                            <small class="text-danger font-weight-bold"><?php echo getError('name'); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="text-success font-weight-bold">Phone Number</label>
                        <input type="text" name="phone" id="phone" value="<?php echo old('phone'); ?>" class="form-control"> 
                        <?php if(getError('phone')){ ?>
                            <small class="text-danger font-weight-bold"><?php echo getError('phone'); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="upload" class="text-success font-weight-bold">Upload</label>
                        <input type="file" name="upload" id="upload" value="<?php echo old('upload'); ?>" class="form-control"> 
                        <?php if(getError('upload')){ ?>
                        <small class="text-danger font-weight-bold"><?php echo getError('upload'); ?></small>
                        <?php } ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button name="createBtn" class="btn btn-outline-success">Create</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    </div>

    <?php clearError(); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>