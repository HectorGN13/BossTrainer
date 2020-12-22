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
              $remainSeat = (int)$session['capacity'] + (int)$totalMembers;
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
              <a href="<?= Url::base(true);?>/trainingsession/update?id=<?= $session['id']?>" class="btn btn-actions btn-edit-session btn-block">Edit</a>
              <a href="<?= Url::base(true);?>/trainingsession/delete?id=<?= $session['id']?>" class="btn btn-actions btn-danger btn-block" data-confirm="Are you sure?" data-method="post">Delete</a>
              <button type="button" class="btn btn-actions btn-view-description btn-block btn-default" data-id="<?= $session['id']?>" data-href="<?= Url::to(['trainingsession/view', 'id' => $session['id']])?>">View Description</button>
          </div>
      </div>
    </div>
  <?php endforeach;?>