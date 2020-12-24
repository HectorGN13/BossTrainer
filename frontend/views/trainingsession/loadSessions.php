<?php 
use yii\helpers\Url;
use common\models\UserTrainingSession;
$userTrainingSession = new UserTrainingSession();
?>
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
              ?>
              <?php foreach($members as $user):?>
                  <?php 
                  $username = $user->user->username;
                  $profileImage = $user->user->profile_img;
                  
                  ?>
                  <div class="session-user session-user-box"><img src="<?= $profileImage?>" title="<?= $username?>" alt="<?= $username?>" width="70" height="70" class="session-user-img session-user-box"></div>
              <?php endforeach;?>
              <?php for($index=0;$index<$remainSeat;$index++):?>
                  <div class="session-user"></div>
              <?php endfor;?>
          </div>
          <div class="col-lg-3 col-md-3 text-left">
              <?php if($is_user_follow_gym):?>
                  <?php if(!$isUserJoined && $totalMembers < $session['capacity']):?>
                      <a href="<?= Url::to(['gym/join', 'id' => $session['id']])?>" class="btn btn-actions btn-join-session btn-block">Unirse</a>
                  <?php elseif (!$isUserJoined && $totalMembers >= $session['capacity']):?>
                      <button type="button" class="btn btn-actions btn-notity-session btn-block">Avisar</button>
                  <?php else:?>
                      <a <?= $userId."  ".$session['id']?> href="<?= Url::to(['gym/leave', 'id' => $session['id']])?>" class="btn btn-actions btn-exit-session btn-block btn-danger">Salirse</a>
                  <?php endif;?>
              <?php endif;?>
              
              <button type="button" class="btn btn-actions btn-view-description btn-block btn-default" data-href="<?= Url::to(['trainingsession/view', 'id' => $session['id']])?>">Ver Descripción</button>
          </div>
      </div>
    </div>
  <?php endforeach;?>