<?php require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

if (!hasPerm([1],$user->data()->id)){die();}
if($settings->messaging != 1){
  Redirect::to($us_url_root.'users/account?err=Messaging+is+disabled');
}
?>
<style media="screen">
      body{
      background:-webkit-linear-gradient(45deg,rgba(42,27,161,.7),rgba(255,48,48,.7) 100%),url(images/404.jpg)no-repeat center center;
        background-size: cover;
}p{color: #fff;}
        .card {
            background-color: rgba(229, 228, 255, 0.2);

        }
        .md-form label {
            color: #ffffff;
        }
        h6 {
            line-height: 1.7;
        }
        html,
        body,
        header,
        .view {
          height: 100vh;
        }
        @media (max-width: 740px) {
          html,
          body,
          header,
          .view {
            height: 700px;
          }
        }
        @media (min-width: 800px) and (max-width: 850px) {
          html,
          body,
          header,
          .view  {
            height: 650px;
          }
        }
        .card {
            margin-top: 30px;
            /*margin-bottom: -45px;*/
        }
        .md-form input[type=text]:focus:not([readonly]),
        .md-form input[type=email]:focus:not([readonly]),
        .md-form input[type=password]:focus:not([readonly]) {
            border-bottom: 1px solid #fb5364;
            box-shadow: 0 1px 0 0 #fb5364;
        }

        .md-form input[type=text]:focus:not([readonly])+label,
        .md-form input[type=password]:focus:not([readonly])+label {
            color: #fb5364;
        }



        .md-form .form-control {
            color: #fff;
        }
        .jumbotron{
          width: 90%;
          align-self: center;
        }

    body{
      background:-webkit-linear-gradient(45deg,rgba(42,27,161,.7),rgba(255,48,48,.7) 100%),url(images/404.jpg)no-repeat center center;
        background-size: cover;
}


</style>
<?php
$validation = new Validate();
$errors = [];
$successes = [];
$id = Input::get('id');
$unread = Input::get('unread');


$findThread = $db->query("SELECT * FROM message_threads WHERE id = ?",array($id));
$thread = $findThread->first();

$findMessageQ = $db->query("SELECT * FROM messages WHERE msg_thread = ? AND deleted = 0",array($id));
$messages = $findMessageQ->results();
$single = $findMessageQ->first();

$findUnread = $db->query("SELECT * FROM messages WHERE msg_thread = ? AND msg_to = ? AND msg_read != 1 AND deleted = 0",array($id, $user->data()->id));
$myUnread = $findUnread->count();

//make sure there are messages TO me in the thread so I don't get a false unread button
$checkToQ = $db->query("SELECT * FROM messages WHERE msg_thread = ? AND msg_to = ? AND deleted = 0",array($id, $user->data()->id));
$checkTo = $checkToQ->count();

$perm = $db->query("SELECT SUM(permissions) AS count FROM users WHERE id = ? OR id = ?",array($thread->msg_to,$thread->msg_from))->first()->count;
if($perm < 2 && $settings->msg_blocked_users==0) $errors[] = "User is banned, you cannot reply.";
if($thread->hidden_from==1 || $thread->hidden_to==1) $errors[] = "The other user deleted this thread, so you cannot reply.";

if (($single->msg_to != $user->data()->id) && ($single->msg_from != $user->data()->id) && !hasPerm([2],$user->data()->id)){
  $ip = ipCheck();
  $fields = array(
    'user'              => $user->data()->id,
    'page'              => 42,
    'ip'                        => $ip,
  );
  $db->insert('audit',$fields);
  $msg = lang("REDIR_MSG_NOEX");
  Redirect::to($us_url_root.'users/messages?err='.$msg); die();
}

//ONLY mark messages read if you are the recipient
if($unread != 1){
  foreach ($messages as $message){
    if(($message->msg_read == 0) && ($message->msg_to == $user->data()->id)) {
      $db->update('messages',$message->id,['msg_read'=>1]);
    }
  }
}
if(!empty($_POST)){


  if(!empty($_POST['markUnreadHook'])){
    $token = $_POST['csrf'];
    if(!Token::check($token)){
      include($abs_us_root.$us_url_root.'usersc/scripts/token_error.php');
    }
    foreach ($messages as $message){
      if(($message->msg_read == 1) && ($message->msg_to == $user->data()->id)) {
        $db->update('messages',$message->id,['msg_read'=>0]);
        Redirect::to($us_url_root.'users/message?id='.$id.'&unread=1');
      }
    }

  }

  if(!empty($_POST['markRead'])){
    $token = $_POST['csrf'];
    if(!Token::check($token)){
      include($abs_us_root.$us_url_root.'usersc/scripts/token_error.php');
    }
    foreach ($messages as $message){
      if(($message->msg_read == 0) && ($message->msg_to == $user->data()->id)) {
        $db->update('messages',$message->id,['msg_read'=>1]);
      }
    }
    Redirect::to($us_url_root.'users/message?id='.$id);
  }
  //
  $validation = new Validate();

  if(!empty($_POST['replyHook']) && (($settings->msg_blocked_users==1 || ($perm==2 && $settings->msg_blocked_users==0)) && (!$thread->hidden_from==1 && !$thread->hidden_to==1))){
    $token = $_POST['csrf'];
    if(!Token::check($token)){
      include($abs_us_root.$us_url_root.'usersc/scripts/token_error.php');
    }

    $to = $single->msg_to;
    if($to == $user->data()->id){
      $to = $single->msg_from;
    }
    $msg_body = Input::get('msg_body');
    $validation->check($_POST,array(
      'msg_body' => array(
        'display' => lang("MSG_BLANK"),
        'required' => true
      )
    ));
    if($validation->passed()){
      $date = date("Y-m-d H:i:s");
      $fields = array(
        'msg_from'    => $user->data()->id,
        'msg_to'      => $to,
        'msg_body'    => $msg_body,
        'msg_thread'  => $id,
        'sent_on'     => $date,
      );

      $db->insert('messages',$fields);

      $threadUpdate = array(
        'last_update'    => $date,
        'last_update_by' => $user->data()->id,
        'archive_to' => 0,
        'archive_from' => 0
      );

      $db->update('message_threads',$id,$threadUpdate);

      $email = $db->query("SELECT fname,email,msg_notification FROM users WHERE id = ?",array($to))->first();
      if($settings->msg_notification == 1 && $email->msg_notification == 1) {
        $params = array(
          'fname' => $email->fname,
          'sendfname' => $user->data()->fname,
          'body' => Input::get('msg_body'),
          'msg_thread' => $id,
        );
        $to = rawurlencode($email->email);
        $body = email_body('_email_msg_template.php',$params);
        email($to,$thread->msg_subject,$body);
      }
      logger($user->data()->id,"Messaging","Sent a message to $email->fname.");
      $successes[] = lang("MSG_SENT");
    }
    $findMessageQ = $db->query("SELECT * FROM messages WHERE msg_thread = ? AND deleted = 0",array($id));
    $messages = $findMessageQ->results();
    $single = $findMessageQ->first();
  }
}
$csrf = Token::generate();
?>
<?=resultBlock($errors,$successes);?>
<?php if(!$validation->errors()=='') {?><div class="alert alert-danger"><?=display_errors($validation->errors());?></div><?php } ?>


  <?php if(!$validation->errors()=='') {?><div class="alert alert-danger"><?=display_errors($validation->errors());?></div><?php } ?>
<br><div id="page-wrapper">
<div class="container">
    <div class="jumbotron">
  <div class="row" >
  <div class="col-sm-10">
    <div class="row">
      <div class="col-sm-10">
        <h2><a href="messages"><i class="fa fa-chevron-left"></i></a> <font color="#fff">Subject: <?=$thread ->msg_subject?></h2>
      </div>
      
<style type="text/css" media="screen">
  
</style>
      
    </div>

    <ul class="chat">
      <?php
      //dnd($messages);$grav = get_gravatar(strtolower(trim($user->data()->email)));
      foreach ($messages as $m){
        $findUser = $db->query("SELECT email FROM users WHERE id = $m->msg_from");
        if($findUser->count()==1) $foundUser = $findUser->first()->email;
        if($findUser->count()==0) $foundUser = "null@null.com";
        $grav = get_gravatar(strtolower(trim($foundUser)));
        $lastmessage = strtotime($m->sent_on);
        $difference = ceil((time() - $lastmessage) / (60 * 60 * 24));
        // if($difference==0) { $last_update = "Today, "; $last_update .= date("g:i A",$lastmessage); }
        if($difference >= 0 && $difference < 7) {
          $today = date("j");
          $last_message = date("j",$lastmessage);
          $msg = lang("GEN_TODAY");
          if($today==$last_message) { $last_update = $msg.", "; $last_update .= date("g:i A",$lastmessage); }
          else {
            $last_update = date("l g:i A",$lastmessage); } }
            elseif($difference >= 7) { $last_update = date("M j, Y g:i A",$lastmessage); }
            if($m->msg_to == $user->data()->id){
              ?>
              <li class="left clearfix"><span class="chat-img pull-left" style="padding-right:10px">
                <img src="<?=$grav ?>" width="75" class="img-thumbnail" alt="Generic placeholder thumbnail"></p>
                <!-- <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" /> -->
              </span>
              <div class="chat-body clearfix">
                <div class="header">
                  <strong class="primary-font"><font color="#fff">From : <?php echouser($m->msg_from);?></strong> <small class="pull-right text-muted">
                    <font color="#fff"><span class="fa fa-clock-o"></span><?=$last_update?></small></font>
                  </div>
                  <div class="pull-left"><p>
                    <?php $msg = html_entity_decode($m->msg_body);
                    echo $msg; ?>
                  </p>
                </div>
              </li>

            <?php }else{ ?>

              <li class="left clearfix"><span class="chat-img pull-left" style="padding-right:10px">
                <img src="<?=$grav; ?>" width="75" class="img-thumbnail" alt="Generic placeholder thumbnail"></p>
              </span>
              <div class="chat-body clearfix">
                <div class="header">
                  <small class="pull-right text-muted"><font color="#fff"><span class="fa fa-clock-o"></span><font color="#fff"><?=$last_update?></small>
                  <strong class="pull-left primary-font"><?php echouser($m->msg_from);?></strong>
                </div>
                <p>
                  <br>
                  <?php $msg = html_entity_decode($m->msg_body);
                  echo $msg; ?>
                </p>
                <?php if($m->msgfrom = $user->data()->id) {?><p class="pull-right"><?php if($m->msg_read==1) {?><i class="fa fa-check"></i> <?=lang("MSG_READ");?><?php } else { ?><i class="fa fa-times"></i> <?=lang("MSG_DEL");?>
                <?php } ?></p><?php } ?>
              </div>
            </li>



          <?php } //end if/else statement ?>


        <?php } //end foreach ?>

        <ul>
          <!-- <h3>From: <?php //echouser($m->msg_from);?></h3> -->

          <h3><?=lang("MSG_QUICK");?> <a href="#" data-toggle="modal" data-target="#reply"><i class="fa fa-window-restore"></i></a></h3>
          <form name="reply_form" action="message?id=<?=$id?>" method="post">
            <div align="center">
              <input type="text" class="form-control" placeholder="<?=lang("MSG_MODAL");?>" name="msg_body" id="msg_body" <?php if(($perm < 2 && $settings->msg_blocked_users==0) || ($thread->hidden_from==1 || $thread->hidden_to==1)) {?>disabled<?php } ?>/>
              <?php /* textarea rows="10" cols="80"  id="mytextarea" name="msg_body"></textarea> */ ?></div>
              <input type="hidden" name="csrf" value="<?=$csrf?>" />
              <input type="hidden" name="replyHook" value="1" />
            </p>
            <p>
              <input type="submit" class="btn btn-primary pull-left" name="reply" value="<?=lang("MSG_REPLY");?>">
            </form><?php
        if($myUnread == 0 && $checkTo > 0){
          ?>
          <form class="" action="message?id=<?php echo $id?>" method="post">
            <input type="hidden" name="csrf" value="<?=$csrf?>" />
            <input type="hidden" name="markUnreadHook" value="1" />
            <input type="submit" class="btn btn-danger pull-right" name="markUnread" value="<?=lang("MSG_MK_UNREAD");?>">
          </form>
          <?php
        }
        ?></div>
                                
          </div> <!-- /.col -->

          <?php if(($settings->msg_blocked_users==1 || ($perm==2 && $settings->msg_blocked_users==0)) && (!$thread->hidden_from==1 && !$thread->hidden_to==1)) {?>
            <div id="reply" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><font color="#000"><?=lang("MSG_REPLY");?></font></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <form name="reply_form" action="message?id=<?=$id?>" method="post">
                      <div align="center">
                        <textarea rows="10" cols="80"  id="mytextarea" name="msg_body"></textarea></div>
                        <input type="hidden" name="csrf" value="<?=$csrf?>" />
                      </p>
                      <p>
                        <br />
                      </div>
                      <div class="modal-footer">
                        <div class="btn-group">       <input type="hidden" name="csrf" value="<?=$csrf?>" />
                          <input class='btn btn-primary' type='submit' name="reply" value='Reply' class='submit' /></div>
                        </form>
                        <div class="btn-group"><button type="button" class="btn btn-default" data-dismiss="modal"><?=lang("GEN_CLOSE")?></button>
                      </div>
                    </div>
                  </div></div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->
                </div>
              </div><?php } ?>


            <?php require_once $abs_us_root.$us_url_root.'usersc/templates/'.$settings->template.'/container_close.php'; //custom template container ?>
            <!-- footers -->
            <?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

            <script src='https://cdn.tinymce.com/4/tinymce.min.js'></script>
            <script src="../users/js/jwerty.js"></script>
            <script>
            tinymce.init({
              selector: '#mytextarea'
            });
            jwerty.key('esc', function () {
              $('.modal').modal('hide');
            });
            jwerty.key('shift+r', function () {
              $('.modal').modal('hide');
              $('#reply').modal();
            });
            jwerty.key('alt+r', function () {
              $('.modal').modal('hide');
              $('#msg_body').focus();
            });
          </script>
          <!-- Place any per-page javascript here -->

          <?php require_once $abs_us_root.$us_url_root.'usersc/templates/'.$settings->template.'/footer.php'; //custom template footer?>
