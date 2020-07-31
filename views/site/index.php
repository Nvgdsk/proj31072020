<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Main page';


?>

<table id="example" class="display" style="width:100%">
    <thead>
    <tr>
        <th>Name</th>
        <th>LastName</th>
        <th>Phone</th>

    </tr>
    </thead>


</table>

<script type="text/javascript">
    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: 'http://gentesttask/api/users',
            success: function (data) {
                $('#example').DataTable({
                    data: data,
                    "columns": [
                        {"data": "firstName"},
                        {"data": "lastName"},
                        {"data": "phone"},


                    ]
                })
            }
        })
    });

</script>





