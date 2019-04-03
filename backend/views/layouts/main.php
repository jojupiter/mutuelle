<?php

/* @var $this View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\web\View;

AppAsset::register($this);
$asset = AppAsset::register($this);
$baseUrl = $asset->baseUrl;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
    <title><?= Html::encode($this->title) ?></title>    
</head>
<body class="hold-transition sidebar-mini sidebar-collapse" id="ventre">
<?php $this->beginBody() ?>
<script>
    function change(i){
            if(i == 1){
                $("#nav1").addClass('menu-open');
            }else{
                if(i == 2){
                    $("#nav2").addClass('menu-open');
                }else{
                    $("#nav3").addClass('menu-open');
                }
            }
    }
    
    function enable_disable(username){
        alert("Yo")
        window.open('index.php?r=user/index&username='+username, "_self");
    }
    
    function change_session(i) {
            var ide = $('#exercice_combo > option:selected').attr('name');
            var ids = $('#session_combo > option:selected').attr('name');
            if(i==3){
                window.open('index.php?r=help/index&ide='+ide+"&ids="+ids+"&i="+2, "_self");
            }
            if(i==4){
                window.open('index.php?r=socialbackground/index&ide='+ide+"&ids="+ids+"&i="+2, "_self");
            }
            $('#exercice_combo').addClass("select2-dropdown-below");
            $('#exercice_combo').addClass("select2");
    };
    function change_exercice(i) {
            var id = $('#exercice_combo > option:selected').attr('name');
            if(i == 1){
                window.open('index.php?r=setting/index&id='+id, "_self");
            }
            
            if(i==2){
                window.open('index.php?r=session/index&id='+id, "_self");
            }
            
            if(i==5){
                window.open('index.php?r=saving/index&id='+id, "_self");
            }
            
            if(i==6){
                window.open('index.php?r=loan/index&id='+id, "_self");
            }
            
            if(i==3){
                var ide = $('#exercice_combo > option:selected').attr('name');
                var ids = $('#session_combo > option:selected').attr('name');
                window.open('index.php?r=help/index&ide='+ide+"&ids="+ids+"&i="+1, "_self");
            }
            
            if(i==4){
                var ide = $('#exercice_combo > option:selected').attr('name');
                window.open('index.php?r=socialbackground/index&ide='+ide+"&ids="+ids+"&i="+1, "_self");
            }
    };
</script>
    <?= $this->render('navbar.php',['baseUrl' => $baseUrl]) ?>
    <?= $this->render('mainSidebar.php',['baseUrl' => $baseUrl]) ?>
    <?= $this->render('content.php',['baseUrl' => $baseUrl, 'content' => $content]) ?>
    <?= $this->render('footer.php',['baseUrl' => $baseUrl]) ?>
    <?= $this->render('controlSidebar.php',['baseUrl' => $baseUrl]) ?>
    <?= $this->registerJs("
$(document).ready(function() {
    $(function() {
    $('.toggle-two').bootstrapToggle({
      on: 'Enabled',
      off: 'Disabled'
    });  
    
    $('.toggle-one').bootstrapToggle({
      on: 'Yes',
      off: 'No'
    });
    })
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'pdfHtml5'
        ]
    } );
    $('#example1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
    $('#image').hide();
   $('#image').change(function(e){
        readURL(this);  
    });
    
    function readURL(input){
       if (input.files && input.files[0]) {
      
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
       }else{
        $('#profile').attr('src', '/advanced/backend/web/assets/b81d9a59/dist/img/user1-128x128.jpg').fadeIn('slow');
                
       }
    }
    
    $('.alert').delay(4000).slideUp(200, function () {
            $(this).alert('close');
    });
    
    $('#datephone').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
  //  $(':dataphone').inputmask();
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker         : true,
      timePickerIncrement: 30,
      format             : 'MM/DD/YYYY h:mm A'
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    );

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    });
} );") ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
