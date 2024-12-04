<?php
require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

if (!hasPerm([1],$user->data()->id)){die();}
if($settings->messaging != 1){
  Redirect::to($us_url_root.'users/account?err=Messaging+is+disabled');
}
$validation = new Validate();
$errors = [];
$successes = [];
?><style type="text/css" media="screen">
    body{
      background:-webkit-linear-gradient(45deg,rgba(42,27,161,.7),rgba(255,48,48,.7) 100%),url(images/404.jpg)no-repeat center center;
        background-size: cover;
}
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
.toggle {
  position: relative;
  display: block;
  width: 40px;
  height: 20px;
  cursor: pointer;
  -webkit-tap-highlight-color: transparent;
  transform: translate3d(0, 0, 0);
}

.toggle:before {
  content: "";
  position: relative;
  top: 3px;
  left: 3px;
  width: 34px;
  height: 14px;
  display: block;
  background: #9A9999;
  border-radius: 8px;
  transition: background .2s ease;
}

.toggle span {
  position: absolute;
  top: 0;
  left: 0;
  width: 20px;
  height: 20px;
  display: block;
  background: white;
  border-radius: 10px;
  box-shadow: 0 3px 8px rgba(154, 153, 153, 0.5);
  transition: all .2s ease;
}

.toggle span:before {
  content: "";
  position: absolute;
  display: block;
  margin: -18px;
  width: 56px;
  height: 56px;
  background: rgba(79, 46, 220, 0.5);
  border-radius: 50%;
  transform: scale(0);
  opacity: 1;
  pointer-events: none;
}

#cbx:checked + .toggle:before {
  background: #947ADA;
}

#cbx:checked + .toggle span {
  background: #4F2EDC;
  transform: translateX(20px);
  transition: all 0.2s cubic-bezier(0.8, 0.4, 0.3, 1.25), background 0.15s ease;
  box-shadow: 0 3px 8px rgba(79, 46, 220, 0.2);
}

#cbx:checked + .toggle span:before {
  transform: scale(1);
  opacity: 0;
  transition: all .4s ease;
}

.center {
  position: absolute;
  top: calc(50% - 10px);
  left: calc(50% - 20px);
}
</style>
<link rel="stylesheet" type="text/css" href="<?=$us_url_root?>users/js/pagination/datatables.min.css" media="screen" />
<?php
if (!empty($_POST)) {
  $token = $_POST['csrf'];
  if(!Token::check($token)){
    include($abs_us_root.$us_url_root.'usersc/scripts/token_error.php');
  }else {
    //Delete User Checkboxes
    if (!empty($_POST['archive'])){
      $deletions = Input::get('archive');
      if ($deletion_count = archiveThreads($deletions,$user->data()->id,1)){
        $successes[] = lang("MSG_ARCHIVE_SUCCESSFUL", array($deletion_count));
        Redirect::to($us_url_root.'users/messages');
      }
      else {
        $errors[] = lang("SQL_ERROR");
      }
    }
    if (!empty($_POST['unarchive']) && isset($_POST['checkbox'])){
      $deletions = Input::get('checkbox');
      if ($deletion_count = archiveThreads($deletions,$user->data()->id,0)){
        $successes[] = lang("MSG_UNARCHIVE_SUCCESSFUL", array($deletion_count));
      }
      else {
        $errors[] = lang("SQL_ERROR");
      }
    }
    if (!empty($_POST['delete']) && isset($_POST['checkbox'])){
      $deletions = Input::get('checkbox');
      if ($deletion_count = deleteThread($deletions,$user->data()->id,1)){
        $successes[] = lang("MSG_DELETE_SUCCESSFUL", array($deletion_count));
      }
      else {
        $errors[] = lang("SQL_ERROR");
      }
    }
    if(!empty($_POST['send_message'])){

      if (empty(Input::get('user_id'))) {
        $errors[] = lang("MSG_UNKN"); }

        if (strlen(Input::get('msg_body')) == 0) {
          $errors[] = lang("MSG_BLANK"); }

          $date = date("Y-m-d H:i:s");

          $thread = array(
            'msg_from'    => $user->data()->id,
            'msg_to'      => Input::get('user_id'),
            'msg_subject' => Input::get('msg_subject'),
            'last_update' => $date,
            'last_update_by' => $user->data()->id,
          );
          if (empty($errors)) {
            $db->insert('message_threads',$thread); }
            $newThread = $db->lastId();


            $fields = array(
              'msg_from'    => $user->data()->id,
              'msg_to'      => Input::get('user_id'),
              'msg_body'    => Input::get('msg_body'),
              'msg_thread'  => $newThread,
              'sent_on'     => $date,
            );
            $msgto = Input::get('user_id');
            $msg_subject = Input::get('msg_subject');

            if (empty($errors)) {
              $db->insert('messages',$fields);
              $email = $db->query("SELECT fname,email,msg_notification FROM users WHERE id = ?",array($msgto))->first();
              if($settings->msg_notification == 1 && $email->msg_notification == 1) {
                $params = array(
                  'fname' => $email->fname,
                  'sendfname' => $user->data()->fname,
                  'body' => Input::get('msg_body'),
                  'msg_thread' => $newThread,
                );
                $to = rawurlencode($email->email);
                $body = email_body('_email_msg_template.php',$params);
                email($to,$msg_subject,$body);
                logger($user->data()->id,"Messaging","Sent a message to $email->fname.");
              } }

              $successes[] = lang("MSG_SENT"); }

              if(!empty($_POST['messageSettings'])) {
                //Toggle msg_notification setting
                if($settings->msg_notification==1) {
                  $msg_notification = Input::get("msg_notification");
                  if (isset($msg_notification) AND $msg_notification == 'Yes'){
                    if ($user->data()->msg_notification == 0){
                      if (updateUser('msg_notification', $userId, 1)){
                        $successes[] = lang("FRONTEND_USER_SYS_TOGGLED", array("msg_notification","enabled"));
                      }else{
                        $errors[] = lang("SQL_ERROR");
                      }
                    }
                  }elseif ($user->data()->msg_notification == 1){
                    if (updateUser('msg_notification', $userId, 0)){
                      $successes[] = lang("FRONTEND_USER_SYS_TOGGLED", array("msg_notification","disabled"));
                    }else{
                      $errors[] = lang("SQL_ERROR");
                    }
                  }
                }
              }
            }
          }
          $messagesQ = $db->query("SELECT * FROM message_threads WHERE (msg_to = ? AND archive_to = ? AND hidden_to = ?) OR (msg_from = ? AND archive_from = ? AND hidden_from = ?) ORDER BY last_update DESC",array($user->data()->id,0,0,$user->data()->id,0,0));
          $messages = $messagesQ->results();
          $count = $messagesQ->count();
          $archiveCount = $db->query("SELECT * FROM message_threads WHERE (msg_to = ? AND archive_to = ? AND hidden_to = ?) OR (msg_from = ? AND archive_from = ? AND hidden_from = ?) ORDER BY last_update DESC",array($user->data()->id,1,0,$user->data()->id,1,0))->count();

          $csrf = Token::generate();
          ?>
          <?=resultBlock($errors,$successes);?>
          <?php if(!$validation->errors()=='') {?><div class="alert alert-danger"><?=display_errors($validation->errors());?></div><?php } ?>
<br>
<div id="page-wrapper">
<div class="container">
    <div class="jumbotron">
          <div class="row">
            <div class="col-sm-12">
              <div>

                <?php if (checkMenu(2,$user->data()->id)){  ?>
                  <div class="btn-group pull-left"><h3><?=lang("MSG_CONV");?> <a href="#" data-toggle="modal" class="nounderline" data-target="#settings"><i class="fa fa-cog"></i></a></h3></div>
                <?php } ?>
                <div class="btn-group pull-right"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#compose"><i class="fa fa-plus"></i> <?=lang("MSG_NEW");?></button>
                </div>
              </center>

            </div>
          </div>
        </div>



        <?php if($count > 0) {?><input type="checkbox" id="cbx" class="checkAllMsg" style="display:none"/>
  <label for="cbx" class="toggle"><span></span></label><font color="white">Select All</font><?php } ?>
          <form name="threads" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <center><font color="#fff"><table id="paginate" class="table table-striped">
              <thead>
                <tr>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php if($count > 0) {?>
                    <?php foreach($messages as $m){
                      if($m->msg_from == $user->data()->id) { $findId = $m->msg_to; } else { $findId = $m->msg_from; }
                      $findUser = $db->query("SELECT picture,email FROM users WHERE id = $findId");
                      if($findUser->count()==1) $foundUser = $findUser->first()->email;
                      if($findUser->count()==0) $foundUser = "null@null.com";
                      $grav = get_gravatar(strtolower(trim($foundUser))); ?>
                      <?php $lastmessage = strtotime($m->last_update);
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
                          $replies = $db->query("SELECT COUNT(*) AS count FROM messages WHERE msg_thread = ? GROUP BY msg_thread",array($m->id));
                          $repliescount = $replies->count();
                          ?>
                          <td style="width:100px">
                            <center>
                              <span class="chat-img pull-left" style="padding-right:5px">
                                <a class="nounderline" href="message?id=<?=$m->id?>">
                                  <img src="<?=$grav ?>" width="75" class="img-thumbnail">
                                </a>
                              </span>
                            </center>
                          </td>
                          <td class="pull-left">
                            <h4>
                              <input type="checkbox" class="maincheck" name="archive[<?=$m->id?>]" value="<?=$m->id?>"/>
                              <a class="nounderline" href="message?id=<?=$m->id?>">
                                <?=$m->msg_subject?> - <?=lang("GEN_WITH");?> <?php if($m->msg_from == $user->data()->id) { echouser($m->msg_to); } else { echouser($m->msg_from); } ?>
                              </a>
                              <?php $unread = $db->query("SELECT * FROM messages WHERE msg_thread = ? AND msg_to = ? AND msg_read = ?",array($m->id,$user->data()->id,0));
                              $unreadCount = $unread->count();?>
                              <?php if($unreadCount > 0) {?> - <font color="red"><?=$unreadCount?> <?=lang("MSG_NEW");?><?php if($unreadCount > 1) {?>s<?php } ?></font><?php } ?></h4>
                              <a class="nounderline" href="message?id=<?=$m->id?>">
                                <?=lang("GEN_UPDATED");?> <?=$last_update?> <?=lang("GEN_BY");?> <?php echouser($m->last_update_by);?>
                              </a>
                            </td>
                          </tr>
                        <?php } } else {?>
                          <tr>
                            <td colspan="2"><center><h3><?=lang("MSG_NO_CONV");?></h3></center></td></tr>
                          <?php } ?>
                        </tbody>
                      </table></center><br>
                      <input type="hidden" name="csrf" value="<?=$csrf?>" />
                      <?php if($count > 0) {?><div class="btn-group pull-right"><input class='btn btn-danger' type='submit' name='Submit' value='<?=lang("MSG_ARC_THR");?>' /></div><?php } ?>
                    </form>
                    <?php if($archiveCount > 0) {?><center><div class="btn-group pull-left"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#archived"><i class="fa fa-envelope-o"></i> <?=lang("MSG_VIEW_ARC");?></button></center><?php } ?><br>
                    <?php
                    include($abs_us_root.$us_url_root."users/views/msg1.php");
                    include($abs_us_root.$us_url_root."users/views/msg2.php");
                    include($abs_us_root.$us_url_root."users/views/msg3.php");
                    include($abs_us_root.$us_url_root."users/views/msg4.php");
                    ?>
                  </div>
                </div> <!-- /.row -->
              </div> <!-- /.container -->
            </div> <!-- /.wrapper -->
          </div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->
            <!-- Place any per-page javascript here -->

            <script src='https://cdn.tinymce.com/4/tinymce.min.js'></script>
            <script src="<?=$us_url_root?>users/js/jwerty.js"></script>
            <script src="<?=$us_url_root?>users/js/combobox.js"></script>
            <script>
            $(document).ready(function(){
              $('.combobox').combobox();
            });
            tinymce.init({
              selector: '#mytextarea'
            });
            tinymce.init({
              selector: '#mytextarea2'
            });
            $('.checkAllMsg').on('click', function(e) {
              $('.maincheck').prop('checked', $(e.target).prop('checked'));
            });
            $('.checkAllArchive').on('click', function(e) {
              $('.checkarchive').prop('checked', $(e.target).prop('checked'));
            });
            jwerty.key('esc', function () {
              $('.modal').modal('hide');
            });
            </script>

            <script>
            $(document).ready(function() {
              $('#paginate').DataTable(
                {  searching: false,
                  "stateSave": true,
                  "pageLength": 10
                }
              );
            } );
            </script>
            <!-- <script src="../users/js/pagination/jquery.dataTables.js" type="text/javascript"></script> -->
            <script src="<?=$us_url_root?>users/js/pagination/datatables.min.js" type="text/javascript"></script>

            <?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer

            ?>
