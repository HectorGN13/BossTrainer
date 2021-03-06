<?php

use frontend\assets\GymsAsset;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\web\JsExpression;
use yii\helpers\Url;
use common\models\UserTrainingSession;
use common\models\Board;
/* @var $this yii\web\View */
/* @var $model common\models\Gym */
/* @var $trainingSessionDataProvider common\models\TrainingSession */
/* @var $trainingSessionSearchModel backend\models\TrainingSessionSearch */

$this->title = $model->name;
GymsAsset::register($this);
\yii\helpers\VarDumper::dump('default_board');
$userTrainingSession = new UserTrainingSession();
?>
<body class="profile-page sidebar-collapse">
<div class="page-header header-filter" data-parallax="true" style="background-image: url(<?= $model->banner_img?>); transform: translate3d(0px, 0px, 0px);"></div>
<div class="main main-raised">
    <div class="profile-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto">
                    <?= Html::a((!$model->userFollowExist()) ? 'Unirse al Gim': 'Dejar el Gim', ['gym/follow','id' => $model->id], ['class' => 'btn btn-dark btn-md btn-follow']) ?>
                    <div class="profile">
                        <div class="avatar">
                            <img src="<?= $model->profile_img?>" alt="Circle Image" class="img-raised rounded-circle img-fluid" style="width: 400px; background-color: white;">
                        </div>

                        <div class="name">
                            <div class="lines-effect">
                                <h1 class="text-responsive" style="text-transform: uppercase"><?= $model->name ?></h1>
                            </div>
                            <a href="#" class="btn btn-just-icon btn-link "><i class="fab fa-facebook"></i></a>
                            <a href="#" class="btn btn-just-icon btn-link "><i class="fab fa-twitter"></i></a>
                            <a href="#" class="btn btn-just-icon btn-link "><i class="fab fa-instagram"></i></a>
                            <a href="#" class="btn btn-just-icon btn-link "><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="description text-center">
                <p><?= $model->description ?></p>
            </div>
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto">
                    <div class="profile-tabs">
                        <ul class="nav nav-pills nav-pills-icons justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" href="#board" role="tab" data-toggle="tab">
                                    <i class="fas fa-chalkboard"></i> PIZARRA
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#ranking" role="tab" data-toggle="tab">
                                    <i class="fas fa-medal"></i> RANKING
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#training_session" role="tab" data-toggle="tab">
                                    <i class="fas fa-clock"></i> HORARIOS
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content tab-space">
                <div class="tab-pane active text-center gallery" id="schedule">
                    <div class="row">

                    </div>
                </div>
                <div class="tab-pane text-center gallery" id="board">
                    <div class="row">
                        <div class="container">
                            <div class="lines-effect">
                                <?php if (isset($default_board)): ?>
                                <h1 class="text-responsive" style="text-transform: uppercase">
                                    <?= Html::encode($default_board->title) ?>
                                </h1>
                                <?php else: ?>
                                <h3 style="text-transform: uppercase">
                                   <?= Html::encode("La pizarra no está disponible...") ?>
                                </h3>
                                <?php endif; ?>
                            </div>

                            <div class="container">
                                <?php if (isset($default_board)): ?>
                                <div id="text" class="white-board col-12">
                                    <?php

                                    $config = HTMLPurifier_Config::createDefault();
                                    $config->set('HTML.SafeIframe', true);
                                    $config->set('URI.SafeIframeRegexp', '%^(https?:)?(\/\/www\.youtube(?:-nocookie)?\.com\/embed\/|\/\/player\.vimeo\.com\/)%');
                                    $purifier = new HTMLPurifier($config);

                                    $raw = $default_board->body;

                                    echo $purifier->purify($raw)

                                    ?>
                                </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="tab-pane text-center gallery" id="ranking">
                    <div class="row">


                    </div>
                </div>
                <div class="tab-pane text-center gallery" id="training_session">
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
                                    'class' => 'btn-change-date'
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
                                  $remainSeat = (int)$session['capacity'] - (int)$totalMembers;
                                  $userId = Yii::$app->user->id;
                                  $isUserJoined = $userTrainingSession->isSessionIsJoined($session['id'], $userId);
                                  $now =  strtotime(date("Y-m-d H:i:s"));
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
                                  <?php for($index=0;$index<$remainSeat;$index++):?>
                                      <div class="session-user session-user-box"></div>
                                  <?php endfor;?>
                              </div>
                              <div class="col-lg-3 col-md-3 text-left">
                                  <?php if($model->userFollowExist() && strtotime($session['start_time']) >= $now):?>
                                    <?php if(!$isUserJoined && $totalMembers < $session['capacity']):?>
                                      <a href="<?= Url::to(['gym/join', 'id' => $session['id']])?>" class="btn btn-actions btn-join-session btn-block">Unirse</a>
                                    <?php elseif (!$isUserJoined && $totalMembers >= $session['capacity']):?>
                                      <?= Html::a((!$session->userWaitingExist()) ? 'Avisar': 'Dejar de avisar',['trainingsession/addwaitinglist', 'id' => $session['id']], ['class' => 'btn btn-actions btn-notity-session btn-block']) ?>
                                    <?php else:?>
                                      <a <?= $userId."  ".$session['id']?> href="<?= Url::to(['gym/leave', 'id' => $session['id']])?>" class="btn btn-actions btn-exit-session btn-block btn-danger">Salirse</a>
                                    <?php endif;?>
                                  <?php endif;?>
                                  
                                  <button type="button" class="btn btn-actions btn-view-description btn-block btn-default" data-href="<?= Url::to(['trainingsession/view', 'id' => $session['id']])?>">Ver Descripción</button>
                              </div>
                          </div>
                        </div>
                      <?php endforeach;?>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 text-center">
                            <button class="btn btn-primary" type="button" id="btn-load-more">Load More</button>
                            <input type="hidden" id="row" value="0">
                            <input type="hidden" id="all" value="<?php echo $totalSessionCount; ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="session-description-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
      <?php

      $config = HTMLPurifier_Config::createDefault();
      $config->set('HTML.SafeIframe', true);
      $config->set('URI.SafeIframeRegexp', '%^(https?:)?(\/\/www\.youtube(?:-nocookie)?\.com\/embed\/|\/\/player\.vimeo\.com\/)%');
      $purifier = new HTMLPurifier($config);

      $raw = '<div class="modal-content"></div>';

      echo $purifier->purify($raw)

      ?>
  </div>
</div>
<input type="hidden" id="gym_id" value="<?= $gym_id?>">
<input type="hidden" id="current_day" value="<?= date('Y-m-d')?>">
<input type="hidden" id="get_more_sessions" value="<?php echo Yii::$app->request->baseUrl.'/trainingsession/getsessions' ?>">
<input type="hidden" id="csrf_token" value="<?=Yii::$app->request->getCsrfToken()?>">
<!--<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<?php
$script = <<< JS
    $(document).ready(function(){
        var allcount = Number($('#all').val());
        if(allcount < 10) {
            $("#btn-load-more").text("No hay más sesiones disponibles...");
        }
        // Load more data
        $('#btn-load-more').click(function(){
            applyFilter();
        });
        $('#btn-change-date').click(function(){
            var popup =$(this).offset();
            var popupTop = popup.top - 20;
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
        if(prevDay < 1) {
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
                data: {id:id},
                success: function(response){
                    if(response !== '') {
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
    /**
     *
     * @param input
     * @param days
     * @param months
     * @param years
     * @returns {Date}
     */
    function substractDate(input, days, months, years) {
    return new Date(
      input.getFullYear() + years,
      input.getMonth() + months,
      Math.min(
        input.getDate() + days,
        new Date(input.getFullYear() + years, input.getMonth() + months + 1, 0).getDate()
      ));
    }

    /**
     *
     * @param isFilterApplied
     */
    function applyFilter(isFilterApplied = false) {
        var row = Number($('#row').val());
        var allcount = Number($('#all').val());
        var rowperpage = 10;
        if(!isFilterApplied) {
          row = row + rowperpage;
        } else {
          row = 0;
        }
        var currentDay = $("#current_day").val();
        if(row <= allcount){
            $("#row").val(row);
            $.ajax({
                url: $("#get_more_sessions").val(),
                type: 'post',
                data: {row:row,gym_id:$("#gym_id").val(),current_day:currentDay,_csrf:$("#csrf_token").val()},
                beforeSend:function(){
                    $("#btn-load-more").text("Cargando...");
                },
                success: function(response){
                    // pequeño delay mientras se agregan las clases
                    setTimeout(function() {
                        // agrega clases después de la última
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

                        // detecta si el valor de las filas es más grande que allcount o no
                        if(rowno >= allcount || response == ''){

                            // cambia el texto y el background
                            $("#btn-load-more").text("No hay sesiones disponibles...");
                            $("#btn-load-more").css("background","darkorchid");
                        }else{
                            $("#btn-load-more").text("Cargar más");
                        }
                    }, 2000);
                }
            });
        }
    }

    /**
     *
     * @param type
     */
    function prevNextDate(type) {
        var currentDay = $("#current_day").val();
        var date = new Date(currentDay);
        if(type == 'prev') {
            date = substractDate(date, -1, 0, 0);
        } else {
            var nextDay = date.setDate(date.getDate() + 1);
            date = new Date(nextDay);
        }
        //console.log(date);
        var day = date.getDate();
        var month = date.getMonth()+1;
        var prevDay = parseInt(day) - 1;
        var prevMonth = date.getMonth()+1;
        var year = date.getFullYear();
        if(prevDay < 1) {
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
