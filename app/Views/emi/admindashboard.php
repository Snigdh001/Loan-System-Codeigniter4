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
    <form action="" id="formid" method="get">
        <thead >
            <tr>
                <th scope="col" >S.no</th>
                <th scope="col"><button style="border: none;background: white; "type="submit" name="id" value="asc" id="id" onclick="fun(id)" > ID</button></th>
                <th scope="col"><button style="border: none;background: white; " type="submit"  name="fname" value="asc" id="name" onclick="fun(id)" > Name</button></th>
                <th scope="col"><button style="border: none;background: white; "type="submit" name="email" value="asc" id="email"  onclick="fun(id)">Email</button></th>
                <th scope="col"><button style="border: none;background: white; "type="submit" name="mobile" value="asc" id="mobile" onclick="fun(id)"> Mobile</button></th>
                <!-- <th scope="col"  name="name" value="asc" id="name" onclick="fun('name')" >Name</th>
                <th scope="col" name="email" value='asc' id="email" onclick="fun('email')">Email</th>
                <th scope="col" name="mobile" value='asc' id="mobile" onclick="fun('mobile')">Mobile No.</th> -->
                <th scope="col" >Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
    </form>
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
    <script>

        var form = document.getElementById("formid");
        var count=0;
        function fun(headid)
        {   
            
            var val= document.getElementById(headid).value;
            if (val=='asc')
            {   
            //     document.getElementById(headid).addEventListener("click", function(event){
            //     event.preventDefault()
            // })
                document.getElementById(headid).value= "desc";
                form.submit();

                
            }
            else if(val=='desc')
            {   
            document.getElementById(headid).value= "asc";
                form.submit();
            }
            else
            {   
                
            document.getElementById(headid).value= "asc";
                form.submit();
                
        }
        }
    </script>
</body>

</html>
<?= $this->endSection() ?>