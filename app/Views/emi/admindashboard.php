<?= $this->extend('template') ?>

<?= $this->section('content') ?>

<head>
    <title>Home</title>
    <script src="https://code.jquery.com/jquery-3.6.3.js"> </script>

    <script src="static/admindashboard.js"></script>
  
</head>

<body>
<?php ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Mobile No.</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <?php
        $count=0;
        if( isset($_GET['page']))
        {
            $count=($_GET['page']-1)*5;
        }
        foreach($row as $rows )
        {
            $count+=1
        ?>
        <tbody>
            <tr>
                <th scope="row"><?php echo $count?></th>
                <th scope="row"><?php echo $rows['id']?></th>
                <td><?php echo($rows['fname'] . ' '. $rows['lname'])?></td>
                <td><?php echo $rows['email'];?></td>
                <td><?php echo $rows['mobile'];?></td>
                <td><?php echo $rows['role'];?></td>
                <td><button data-id='<?php echo $rows['id'];?>' class="info btn btn-success"> Show Data</button>
                <button data-id='<?php echo $rows['id']?>' class="edit btn btn-success"> Edit</button>
                <button data-id='<?php echo $rows['id'];?>' onclick="return confirm('Are you Sure')" class="delete btn btn-success"> Delete</button></td>
            </tr>
        </tbody>
        <?php }?>
    </table>


    <div class="modal" id="modal_data" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="data">
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  >Close</button>
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Update</button> -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?= $this->endSection() ?>