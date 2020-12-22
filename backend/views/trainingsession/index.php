<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;
use yii\web\JsExpression;
use yii\helpers\Url;
use common\models\UserTrainingSession;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TrainingSessionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sesiones de entrenamientos';
$this->params['breadcrumbs'][] = $this->title;
$userTrainingSession = new UserTrainingSession();
?>
<div class="training-session-index container">
    <div class="row">
      <div class="col-lg-12 col-md-12">
          <div class="lines-effect">
              <h1 class="text-responsive" style="text-transform: uppercase"><?= Html::encode($this->title) ?></h1>
          </div>

        <p>
            <?= Html::a('Crear Entreno', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
      </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 text-center">
            <h2 class="m-0 pt-2 pb-2 training-session-heading"><?= date('d/m')?></h2>
        </div>
        <div class="col-lg-12 col-md-12 text-center mt-3 mb-3 d-flex">
            <div class="col-lg-2 col-md-2 text-right p-0">
                <button type="button" class="btn-prev-date btn-day-change" onclick="prevNextDate('prev');">&lt;</button>
            </div>
            <div class="col-lg-8 col-md-8 p-0 date-picker-container">
                <!-- <input type="text" id="datepicker" class="datepicker"> -->
                <?php 
                echo DatePicker::widget([
                  'name' => 'session_date_picker',
                  'type' => DatePicker::TYPE_BUTTON,
                  'value' => date('d-M-Y H:i A'),
                  'buttonOptions' => [
                    'id' => "btn-change-date",
                    'class' => 'btn btn-change-date'
                  ],
                  'pluginOptions' => [
                      'autoclose'=>true,
                      'format' => 'dd-M-yyyy',
                  ],
                  'pluginEvents' =>[
                      "changeDate" => "function(date) {
                          var date = new Date(date.date);
                          var day = date.getDate();
                          var month = date.getMonth()+1;
                          var year = date.getFullYear();
                          var prevDay = parseInt(day) - 1;
                          var prevMonth = date.getMonth()+1;
                          $('#current_day').val(year+'-'+month+'-'+day);
                          if(prevDay < 1)
                          {
                              var substractedDate = substractDate(date, 0, -1, 0);
                              var prevDay = new Date(substractedDate.getYear(), substractedDate.getMonth() + 1, 0);
                              prevDay = prevDay.getDate();
                              var prevMonth = substractedDate.getMonth()+1;
                              //console.log(prevDay+'/'+prevMonth);
                          }
                          var nextDay = date.setDate(date.getDate() + 1);
                          date = new Date(nextDay);
                          var nextDay = date.getDate();
                          var nextMonth = date.getMonth()+1;
                          ///var year = date.getFullYear();
                          $('.btn-prev-date').html('< '+prevDay + '/' + prevMonth);
                          $('.btn-next-date').html(nextDay + '/' + nextMonth + ' >');
                          $('.training-session-heading').html(day+'/'+month);
                          console.log('test');
                          applyFilter(true);
                      }",
                  ]
              ]);
                ?>
            </div>
            <div class="col-lg-2 col-md-2 text-left p-0">
                <button type="button" class="btn-next-date btn-day-change" onclick="prevNextDate('next');">&gt;</button>
            </div>
        </div>
    </div>
    <div id="session-container">
      <?php foreach($trainingSessions as $session):?>
        <div class="session-item">
          <div class="row">
              <div class="col-lg-10 col-md-10 text-left">
                  <h4 class="session-title"><?= $session['title']?></h4>
              </div>
              <div class="col-lg-2 col-md-2 text-right">
                  <h4 class="session-start-time"><?= date('H:i', strtotime($session['start_time']))?></h4>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-9 col-md-9 text-left d-flex_">
                  <?php
                  $members = $userTrainingSession->getSessionMembers($session['id']);
                  $totalMembers = count($members);
                  $remain = (int)$session['capacity'] + (int)$totalMembers;
                  $userId = Yii::$app->user->id;
                  $isUserJoined = $userTrainingSession->isSessionIsJoined($session['id'], $userId);
                  ?>
                  <?php foreach($members as $user):?>
                      <?php 
                      
                      $username = $user->user->username;
                      $profileImage = $user->user->profile_img;
                      $avatarImage = 'http://placehold.it/70';
                      if(empty($profileImage))
                          $profileImage = $avatarImage;
                      ?>
                      <div class="session-user session-user-box"><img src="<?= $profileImage?>" title="<?= $username?>" alt="<?= $username?>" width="70" height="70" class="session-user-img session-user-box"></div>
                  <?php endforeach;?>
                  <?php for($index=0;$index<$remain;$index++):?>
                      <div class="session-user session-user-box"></div>
                  <?php endfor;?>
              </div>
              <div class="col-lg-3 col-md-3 text-left">
                  <a href="<?= Url::base(true);?>/trainingsession/update?id=<?= $session['id']?>" class="btn btn-actions btn-edit-session btn-block">Editar</a>
                  <a href="<?= Url::base(true);?>/trainingsession/delete?id=<?= $session['id']?>" class="btn btn-actions btn-danger btn-block" data-confirm="¿Estas seguro de que quieres eliminar esta sesión?" data-method="post">Borrar</a>
                  <button type="button" class="btn btn-actions btn-view-description btn-block btn-default" data-id="<?= $session['id']?>" data-href="<?= Url::to(['trainingsession/view', 'id' => $session['id']])?>">Ver descripción</button>
              </div>
          </div>
        </div>
      <?php endforeach;?>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 text-center">
            <button class="btn btn-primary mb-3 mt-3" type="button" id="btn-load-more">Cargar más</button>
            <input type="hidden" id="row" value="0">
            <input type="hidden" id="all" value="<?php echo $totalSessionCount; ?>">
        </div>
    </div>
</div>
<div id="session-description-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      
    </div>
  </div>
</div>
<input type="hidden" id="current_day" value="<?= date('Y-m-d')?>">
<input type="hidden" id="get_more_sessions" value="<?php echo Yii::$app->request->baseUrl. '/trainingsession/getsessions' ?>">
<input type="hidden" id="csrf_token" value="<?=Yii::$app->request->getCsrfToken()?>">
<?php 
 $script = <<< JS
    $(document).ready(function(){
        var allcount = Number($('#all').val());
        if(allcount < 12)
        {
            $("#btn-load-more").text("No hay más sesiones disponibles...");
        }
        // Load more data
        $('#btn-load-more').click(function(){
            applyFilter();
        });
        $('#btn-change-date').click(function(){
            var popup =$(this).offset();
            var popupTop = popup.top + 35;
            var popupLeft = popup.left ;
            $('.datepicker.datepicker-dropdown').css({
              'top' : popupTop,
              'left' : popupLeft
             });
        });
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth()+1;
        var prevDay = parseInt(day) - 1;
        var prevMonth = date.getMonth()+1;
        if(prevDay < 1)
        {
            var substractedDate = substractDate(date, 0, -1, 0);
            var prevDay = new Date(substractedDate.getYear(), substractedDate.getMonth() + 1, 0);
            prevDay = prevDay.getDate();
            var prevMonth = substractedDate.getMonth()+1;
            //console.log(prevDay+'/'+prevMonth);
        }
        var nextDay = parseInt(day) + 1;
        $('.btn-prev-date').html('< '+prevDay + '/' + prevMonth);
        $('.btn-next-date').html(nextDay + '/' + month + ' >');
        $('.training-session-heading').html(day+'/'+month);
        $(document).on("click", ".btn-view-description", function(){
            var id = $(this).data('id');
            var href = $(this).data('href');
            $.ajax({
                type: 'get',
                url: href,
                data: {id: id},
                success: function(response){
                    if(response != '')
                    {
                        $("#session-description-modal .modal-content").html(response);
                        $("#session-description-modal").modal('show');
                    }
                }
            })
        });
    });
 JS;
 $this->registerJs($script);
 ?>
<script>
function substractDate(input, days, months, years) {
    return new Date(
      input.getFullYear() + years, 
      input.getMonth() + months, 
      Math.min(
        input.getDate() + days,
        new Date(input.getFullYear() + years, input.getMonth() + months + 1, 0).getDate()
      )
    );
}
function applyFilter(isFilterApplied = false)
{
    var row = Number($('#row').val());
    var allcount = Number($('#all').val());
    var rowperpage = 12;
    if(!isFilterApplied)
    {
      row = row + rowperpage;  
    }
    else
    {
      row = 0;
    }
    var current_day = $("#current_day").val();
    if(row <= allcount){
        $("#row").val(row);
        $.ajax({
            url: $("#get_more_sessions").val(),
            type: 'post',
            data: {row:row,current_day: current_day, _csrf : $("#csrf_token").val()},
            beforeSend:function(){
                $("#btn-load-more").text("Loading...");
            },
            success: function(response){
                // Setting little delay while displaying new content
                setTimeout(function() {
                    // appending posts after last post with class="post"
                    if(isFilterApplied)
                    {
                      $("#session-container").html(response).show().fadeIn("slow");
                    }
                    else
                    {
                      $(".session-item:last").after(response).show().fadeIn("slow");  
                    }
                    if(!isFilterApplied)
                    var rowno = row + rowperpage;

                    // checking row value is greater than allcount or not
                    if(rowno > allcount || response == ''){

                        // Change the text and background
                        $("#btn-load-more").text("No more session available...");
                        $("#btn-load-more").css("background","darkorchid");
                    }else{
                        $("#btn-load-more").text("Load more");
                    }
                }, 2000);
            }
        });
    }
}
function prevNextDate(type)
{
    var currentDay = $("#current_day").val();
    var date = new Date(currentDay);
    if(type == 'prev')
    {
        date = substractDate(date, -1, 0, 0);
    }
    else
    {
        var nextDay = date.setDate(date.getDate() + 1);
        date = new Date(nextDay);
    }
    //console.log(date);
    var day = date.getDate();
    var month = date.getMonth()+1;
    var prevDay = parseInt(day) - 1;
    var prevMonth = date.getMonth()+1;
    var year = date.getFullYear();
    if(prevDay < 1)
    {
        var substractedDate = substractDate(date, 0, -1, 0);
        var prevDay = new Date(substractedDate.getYear(), substractedDate.getMonth() + 1, 0);
        prevDay = prevDay.getDate();
        var prevMonth = substractedDate.getMonth()+1;
        //console.log(prevDay+'/'+prevMonth);
    }
    var nextDay = date.setDate(date.getDate() + 1);
    date = new Date(nextDay);
    var nextDay = date.getDate();
    var nextMonth = date.getMonth()+1;
    $('.btn-prev-date').html('< '+prevDay + '/' + prevMonth);
    $('.btn-next-date').html(nextDay + '/' + nextMonth + ' >');
    $('.training-session-heading').html(day+'/'+month);
    $("#current_day").val(year+'-'+month+'-'+day)
    applyFilter(true);
}
</script>