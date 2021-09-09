<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package debating-africa
 */

get_header();
?>

<?php



if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}?>

<?php global $current_user; wp_get_current_user(); global $wpdb;

while ( have_posts() ) :
    the_post();?>
    <?php $post_id = get_the_ID();?>
    <?php gt_set_post_view(); ?>

    <section class="inside-content">
        <div class="holder">
            <div class="row">
                    <div class="col-12 col-md-9 col-sm-9 main-content pt-5">
                      <section class="inner-header inside-page">
                          <div class="new-heading">
                              <div class="row">
                                  <div class="col-12 col-sm-8 pl-0">
                                      <h2><?php the_title();?></h2>
                                      <span class="date"><?php echo get_the_date() ?></span>
                                      <span class="date"><?= gt_get_post_view(); ?></span>
                                      <?php
                                      if(c_parent_comment_counter($post->ID)>1){
                                          $comment_name="comments";
                                      }else{
                                          $comment_name="comment";
                                      }
                                      ?>
                                       <?php if (get_field("comments_counter")=="yes") { ?>
                                      <span class="date"><?php echo $number_of_parents = c_parent_comment_counter($post->ID);?> <?php echo $comment_name; ?></span>
                                      <?php } ?>
                                      <span class="date"><?php echo reading_time($post->ID); ?> reading time</span>
                                  </div>

                                  <div class="col-12 col-sm-4 comments">
                                      <div class="row">
                                          <div class="voting no_padding col-6 col-sm-8 col-lg-8">
                                              <?php
                                              if (get_field("has_a_poll")== "yes"){
                                                  ?>
                                                  <div class="coment-holder">
                                                      <span><?php echo get_field('poll_title') ?></span>
                                                      <?php
                                                      $likes=get_field("likes");
                                                      $dislikes=get_field("dislikes");
                                                      if ($likes>0 || $dislikes>0){
                                                          $total_vote=$dislikes+$likes;
                                                          $like_per=round(( $likes/ ($total_vote)) * 100);
                                                          $dislikes_per=100-$like_per;
                                                      }else{
                                                          $like_per=50;
                                                          $dislikes_per=100-$like_per;
                                                      }

                                                      ?>
                                                  </div>
                                                  <form>
                                                      <div class="yes">
                                                          <a href="javascript:void(0)"  data-postid="<?php echo $post_id;?>"  id="like">
                                                              <span class="count"><?php echo $like_per; ?>%</span>
                                                              <input id="Checkbox2" class="form-check-input" type="checkbox">
                                                              <label for="Checkbox2">Yes</label>
                                                          </a>
                                                      </div>
                                                      <div class="no">
                                                          <a href="javascript:void(0)"  data-postid="<?php echo $post_id;?>"  id="dislike">
                                                              <input id="box2" class="form-check-input" type="checkbox" checked="">
                                                              <label for="box2">No</label>
                                                              <span class="count"><?php echo $dislikes_per; ?>%</span>
                                                          </a>
                                                      </div>
                                                  </form>
                                                  <?php
                                              }
                                              ?>
                                          </div>

                                      </div>
                                  </div>
                              </div>
                          </div>
                      </section>
                      <!---Inner Header----->
                      <!---Join Floating Button----->
                      <?php if (get_field("join_buttons")=="yes") { ?>
                      <button class="float-button">
                          <a class="join-debate" href="#main-comments"> Join the Debate</a>
                          <div class="bottom-join">
                              <a href="#main-comments">
                                  <span>Join</span>
                                  <img src="<?php echo get_template_directory_uri(); ?>/images/join.png" alt="join Us">
                              </a>
                          </div>
                      </button>
                      <!---Join Floating Button----->
                  <?php } ?>
                      <section class="innerpage-banner">
                          <div class="row">
                              <?php
                              $inner_image=get_field('debate_inner_image_now');
                              if(empty($inner_image)){
                                  ?>
                                  <img src="<?php echo the_post_thumbnail_url('debate_inside_image'); ?>" alt="<?php the_title();?>" />
                                  <?php
                              }else{
                                  ?>
                                  <img src="<?php echo $inner_image; ?>" alt="<?php the_title();?>" />
                                  <?php
                              }
                              ?>

                          </div>
                      </section>

                      <div class="row">
                        <?php
                        if (get_field("has_a_summary")=="yes") {
                            ?>
                            <div class="col-12 col-md-3 col-sm-3 sammary">
                                <h4>Summary</h4>
                                <ul>
                                    <?php echo get_field('summary'); ?>
                                </ul>
                            </div>
                            <div class="col-12 col-md-9 col-sm-9 pt-5 da-maincontent ">
                              <?php the_content(); ?>

                              <div class="social-media">
                                  <ul>
                                      <li>Share:</li>


                                      <li>
                                          <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo the_permalink(); ?>"
                                             target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>

                                      <li>
                                          <a href="http://twitter.com/share?text=<?php echo the_title(); ?>&url=<?php the_permalink(); ?>"
                                             target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                      <li>
                                          <a href="https://www.facebook.com/sharer.php?u=<?php echo the_permalink(); ?>&picture=<?php the_post_thumbnail_url('full'); ?>&name=<?php the_title(); ?>&description=<?php echo get_the_excerpt(); ?>&redirect_uri=<?php echo "https://www.facebook.com/"; ?>"
                                             target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>

                                  </ul>
                              </div>
                            </div>
                      </div>

                    </div>
                    <?php
                }else{
                    ?>
                    <div class="col-12 col-md-12 col-sm-13 main-content full-width">

                        <?php the_content(); ?>

                        <div class="social-media">
                            <ul>
                                <li>Share:</li>


                                <li>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo the_permalink(); ?>"
                                       target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>

                                <li>
                                    <a href="http://twitter.com/share?text=<?php echo the_title(); ?>&url=<?php the_permalink(); ?>"
                                       target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li>
                                    <a href="https://www.facebook.com/sharer.php?u=<?php echo the_permalink(); ?>&picture=<?php the_post_thumbnail_url('full'); ?>&name=<?php the_title(); ?>&description=<?php echo get_the_excerpt(); ?>&redirect_uri=<?php echo "https://www.facebook.com/"; ?>"
                                       target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>

                            </ul>
                        </div>
                    </div>
                    <?php
                }
                ?>

            </div>
            <!--video holder-->


            <?php
            $leaders=get_field('has_leaders');
            if( $leaders ):
                ?>
                <div class="headings">
                    <div class="row">
                        <div class="col-12" style="text-align: center;">
                            <h1>Leaders taking part in this debate</h1>
                        </div>
                    </div>
                </div>
                <div class="container leader-holder">
                    <div class="row justify-content-center text-center">

                        <?php
                        foreach( $leaders as $post ):

                            // Setup this post for WP functions (variable must be named $post).
                            setup_postdata($post);
                            ?>

                            <div class="col-12 col-sm-3 col-md-3 leader">
                                <a href="<?php the_permalink() ?>">
                                    <img src="<?php echo the_post_thumbnail_url('full'); ?>" alt="<?php the_title();?>">
                                    <h4><?php the_title();?> </h4>
                                    <span class="title"><?php the_field("position");?></span>
                                </a>
                            </div>

                        <?php endforeach; ?>


                    </div>

                </div>
                <?php
// Reset the global post object so that the rest of the page works correctly.
                wp_reset_postdata();
                ?>
            <?php endif; ?>


        </div>
    </section>

    <!----comments------->

    <!----comment From------->




    <section class="main-comments grey"  name="main-comments" id="main-comments" <?php if (get_field('disable_the_comment_feature') == "yes"){ ?> style="display: none;"<?php } ?>>
        <div class="holder">
            <div class="row">
                <h2>Comments</h2>
                <?php
                if (get_field('must_login_to_comment') == "yes" AND  !is_user_logged_in() ) {
                    ?>
                    <p class="not-login" style="width: 100%;">You have to login in order to comment on this debate <a href="<?php echo home_url( 'signin' ); ?>">Sign In </a>or
                        <a href="<?php echo home_url( 'signup' ); ?>">Sign Up</a></p>
                <?php }?>

                <!----comment Form------->
                <?php
                $name="";
                $email="";
                if (get_field('must_login_to_comment') == "yes" AND  !is_user_logged_in() ) {
                    ?>
                    <p></p>
                <?php }else{
                    $current_user = wp_get_current_user();
                    $name=get_user_meta( $current_user->ID, 'display_name', true );
                    if (empty($name)){
                        $name=get_user_meta( $current_user->ID, 'first_name', true )." ".get_user_meta( $current_user->ID, 'last_name', true );
                    }

                    $email= $current_user->user_email;
                    ?>
                    <div class="col-12 col-sm-10 comment-form main-comment-holder" id="reply2">
                        <div class="errorcomment" style="color: red"></div>
                        <form id="comment" class="user-reply-comment" action="<?php bloginfo( 'template_url' ); ?>/proc/comments.php" method="post"  encypte="multipart/formdata">
                            <div class="user-image">
                                <?php if ( is_user_logged_in() ) {  ?>
                                    <h6 style="background-color: aquamarine;height: 90px;text-align: center;align-items: center;padding-top: 15px;font-weight: bolder;">
                                        <?php echo strtoupper(substr(get_user_meta( $current_user->ID, 'first_name', true ),0,1));?><?php echo strtoupper(substr(get_user_meta( $current_user->ID, 'last_name', true ),0,1));?>
                                    </h6>
                                <?php }else{?>
                                    <h6 style="background-color: aquamarine;height: 90px;text-align: center;align-items: center;padding-top: 0px;font-weight: bolder;">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/user-icon.png">
                                    </h6>
                                <?php }?>
                            </div>
                            <div class="user-details">
                                <?php
                                $names=get_user_meta( $current_user->ID, 'display_name', true );
                                 if($names == ""){ ?>
                                    <input type="text" id="name" value=""  name="name" placeholder="Name Here" class="reply-name" required />

                                    <?php } else { ?>
                                        <input type="text" id="name" value="<?php echo $name;?>"  name="name" placeholder="Name Here" class="reply-name" required />
                                <?php } ?>

                                <input type="hidden" id="email" value="<?php echo $email; ?>"  name="email" placeholder="Janedoe@2021.com" class="reply-email" required/>
                            </div>
                            <?php wp_nonce_field( 'my_nonce' ); ?>
                            <input type="hidden" id="postid" name="postid" value="<?php echo  $post->ID; ?> ">
                            <textarea class="reply-area" id="comment_reply" name="comment_reply"  placeholder="Comment Here"></textarea>
                            <button type="submit" class="reply-comment-btn">Post Comment</button>
                        </form>
                        <div id="success"></div>
                    </div>
                    <!----comment From------->
                <?php } ?>




                <!----comment Iteam------->
                <?php
                $main_comment_array=array();
                $comments = get_comments(array(
                    'post_id' => $post->ID));
                $i=0;
                $top_comment_id="";
                $topcomment=0;
                foreach ($comments as $comment){
                    $args = array(
                        'parent' => $comment->comment_ID,
                        'orderby'=>'comment_date',
                        'order'=>'ASC',

                    );
                    $questions = get_comments($args);
                    $main_comment_array=$comment;

                    $count_main=count($questions);
                    if ($topcomment<$count_main){
                        $top_comment_id=$comment->comment_ID;
                        $topcomment=$count_main;
                    }

                }
                if ($top_comment_id !=""){
                    $comment = get_comment( intval( $top_comment_id ) );

                    ?>
                    <div class="col-12 comments-holder">
                        <div class="row dark-grey">
                            <div class="col-7 user">

                                <div class="user-image">
                                    <?php
                                    $full_name = explode(" ", $comment->comment_author);
                                    $last_word = "";
                                    $first_word = strtoupper(substr($full_name[0], 0, 1));
                                    if (isset($full_name[1])) {
                                        $last_word = strtoupper(substr($full_name[1], 0, 1));
                                    } else {
                                        $last_word = strtoupper(substr($full_name[0], 1, 1));
                                    }
                                    ?>
                                    <h6 style="background-color: aquamarine;height: 90px;text-align: center;align-items: center;padding-top: 20px;font-weight: bolder;">
                                        <?php echo $first_word ?><?php echo $last_word; ?>
                                    </h6>
                                </div>
                                <div class="user-info"><h3><?php echo $comment->comment_author; ?></h3><span
                                            class="date"><?php echo human_time_diff(strtotime($comment->comment_date), current_time('timestamp', 1)); ?> ago</span>
                                </div>
                            </div>
                            <div class="col-5 comment-title">
                                <h3>Top Comment</h3>
                            </div>
                            <div class="col-12 comments-content">
                                <?php echo $comment->comment_content; ?>
                                </p>
                            </div>
                        </div>
                        <?php $results = $wpdb->get_results("SELECT COUNT(*) as t_records FROM wp_comments_likes where wp_comments_id='" . $comment->comment_ID . "' AND status=1", OBJECT);
                        $total_records = $results[0]->t_records;
                        $results1 = $wpdb->get_results("SELECT COUNT(*) as t_records1 FROM wp_comments_likes where wp_comments_id='" . $comment->comment_ID . "' AND status=2", OBJECT);
                        $total_records1 = $results1[0]->t_records1;
                        ?>
                        <div class="col-12 cooment-footer">
                            <div class="row">
                                <div class="col-7 col-md-7 reply">
                                    <?php
                                    $args = array(
                                        'parent' => $comment->comment_ID,
                                        'count' => true,
                                        'orderby' => 'comment_date',
                                        'order' => 'ASC'

                                    );
                                    $questions = get_comments($args);

                                    ?>
                                    <span><a href="javascript:void(0)"
                                             id="btnreply<?php echo $comment->comment_ID; ?>" class="btnreply"
                                             btnreply="<?php echo $comment->comment_ID; ?>"><i
                                                    class="fa fa-reply reply" class="btnreply"
                                                    btnreply1="<?php echo $comment->comment_ID; ?>"
                                                    aria-hidden="true"></i> <?php echo $questions; ?>  </a> <a
                                                href="javascript:void(0)"
                                                btnreply="<?php echo $comment->comment_ID; ?>" class="btnreply">Replies</a></span>
                                </div>
                                <div class="col-5 col-md-5 reply-vote">
                                    <div class="vote<?php echo $comment->comment_ID; ?>">
                                        <?php wp_nonce_field('my_nonce'); ?>
                                        <button class="add views1<?php echo $comment->comment_ID; ?>"><i
                                                    class="fa fa-thumbs-o-up"
                                                    aria-hidden="true"></i><?php echo $total_records; ?>
                                            <input type="hidden" id="comments_id" name="comments_id"
                                                   value="<?php echo $comment->comment_ID; ?>">
                                            <input type="hidden" id="dislikes" name="dislikes"
                                                   value="<?php echo $total_records1; ?>">
                                            <input type="hidden" id="userid" name="userid"
                                                   value="<?php echo $current_user->ID; ?> ">
                                        </button>
                                        <button class="minus views2<?php echo $comment->comment_ID; ?>"><i
                                                    class="fa fa-thumbs-o-down"
                                                    aria-hidden="true"></i><?php echo $total_records1; ?>
                                            <input type="hidden" id="likes" name="likes"
                                                   value="<?php echo $total_records; ?>">
                                            <input type="hidden" id="userid" name="userid"
                                                   value="<?php echo $current_user->ID; ?> ">
                                            <input type="hidden" id="comments_id" name="comments_id"
                                                   value="<?php echo $comment->comment_ID; ?>">
                                        </button>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div id="repliescomments<?php echo $comment->comment_ID; ?>" style="display: none"
                                     class="repliescomments">
                                    <?php $comment_childrens = $comment->get_children();


                                    foreach ($comment_childrens as $comment_children) :?>

                                        <?php $results = $wpdb->get_results("SELECT COUNT(*) as t_records FROM wp_comments_likes where wp_comments_id='" . $comment_children->comment_ID . "' AND status=1", OBJECT);
                                        $total_records = $results[0]->t_records;
                                        $results1 = $wpdb->get_results("SELECT COUNT(*) as t_records1 FROM wp_comments_likes where wp_comments_id='" . $comment_children->comment_ID . "' AND status=2", OBJECT);
                                        $total_records1 = $results1[0]->t_records1;
                                        ?>

                                        <div class="col-9 reply-content reply_see<?php echo $comment_children->comment_ID; ?>">
                                            <span><?php echo $comment_children->comment_author; ?></span>
                                            <p><?php echo $comment_children->comment_content; ?>
                                            </p>
                                            <div class="reply-vote">
                                                <div class="vote<?php echo $comment_children->comment_ID; ?>">
                                                    <?php wp_nonce_field('my_nonce'); ?>
                                                    <button class="add add_reply views1<?php echo $comment_children->comment_ID; ?>">
                                                        <i class="fa fa-thumbs-o-up"
                                                           aria-hidden="true"></i><?php echo $total_records; ?>
                                                        <input type="hidden" id="comments_id" name="comments_id"
                                                               value="<?php echo $comment_children->comment_ID; ?>">
                                                        <input type="hidden" id="dislikes" name="dislikes"
                                                               value="<?php echo $total_records1; ?>">
                                                        <input type="hidden" id="userid" name="userid"
                                                               value="<?php echo $current_user->ID; ?> ">
                                                    </button>
                                                    <button class="minus minus_reply views2<?php echo $comment_children->comment_ID; ?>">
                                                        <i class="fa fa-thumbs-o-down"
                                                           aria-hidden="true"></i><?php echo $total_records1; ?>
                                                        <input type="hidden" id="likes" name="likes"
                                                               value="<?php echo $total_records; ?>">
                                                        <input type="hidden" id="userid" name="userid"
                                                               value="<?php echo $current_user->ID; ?> ">
                                                        <input type="hidden" id="comments_id" name="comments_id"
                                                               value="<?php echo $comment_children->comment_ID; ?>">
                                                    </button>
                                                </div>

                                            </div>

                                        </div>
                                    <?php endforeach; ?>
                                    <div class="morecontent<?php echo $comment->comment_ID; ?>"></div>
                                </div>
                                <div class="morereplies<?php echo $comment->comment_ID; ?>"></div>

                                <div class="col-10 comment-form reply-comment"
                                     id="replycomments<?php echo $comment->comment_ID; ?>">
                                    <?php
                                    $name = "";
                                    $email = "";
                                    if (get_field('must_login_to_comment') == "yes" AND !is_user_logged_in()) {
                                        ?>
                                        <p class="not-login">You have to login in order to reply to any comment on
                                            debate <a href="<?php echo home_url('signin'); ?>">Sign In </a>or
                                            <a href="<?php echo home_url('signup'); ?>">Sign Up</a></p>
                                    <?php } else { ?>
                                        <div class="errorreply" style="color: red"></div>

                                        <form class="user-reply-comment" method="post" id="comments_replies"
                                              data-rel="<?php echo $comment->comment_ID; ?>"
                                              encypte="multipart/formdata">
                                            <div class="user-image">
                                                <?php


                                                if (is_user_logged_in()) {
                                                    $current_user = wp_get_current_user();
                                                    $name = get_user_meta($current_user->ID, 'display_name', true);
                                                    if (empty($name)) {
                                                        $name = get_user_meta($current_user->ID, 'first_name', true) . " " . get_user_meta($current_user->ID, 'last_name', true);
                                                    }
                                                    $email = $current_user->user_email;

                                                    ?>
                                                    <h6 style="background-color: aquamarine;height: 90px;text-align: center;align-items: center;padding-top: 15px;font-weight: bolder;">
                                                        <?php echo strtoupper(substr(get_user_meta($current_user->ID, 'first_name', true), 0, 1)); ?><?php echo strtoupper(substr(get_user_meta($current_user->ID, 'last_name', true), 0, 1)); ?>
                                                    </h6>
                                                <?php } else {
                                                    ?>
                                                    <h6 style="background-color: aquamarine;height: 90px;text-align: center;align-items: center;padding-top: 15px;font-weight: bolder;">
                                                        DA
                                                    </h6>
                                                <?php } ?>
                                            </div>
                                            <?php wp_nonce_field('my_nonce'); ?>
                                            <div class="user-details">
                                                <input type="text" id="name" name="name" placeholder="Name Here"
                                                       value="<?php echo $name; ?>" class="reply-name"/ required>
                                                <input type="hidden" id="email" name="email"
                                                       value="<?php echo $email; ?>" placeholder="Janedoe@2021.com"
                                                       class="reply-email" required/>
                                            </div>
                                            <input type="hidden" id="postid" name="postid"
                                                   value="<?php echo $post->ID; ?> ">
                                            <input type="hidden" id="comments_id" name="comments_id"
                                                   value="<?php echo $comment->comment_ID; ?>">

                                            <textarea class="reply-area" id="replies" name="replies"
                                                      placeholder="Reply Here"></textarea>
                                            <button type="submit" class="reply-comment-btn">Post Reply</button>


                                        </form>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php
                }

                foreach ( $comments as $comment ) :
                    if ($top_comment_id != $comment->comment_ID ) {
                        ?>
                        <div class="col-12 comments-holder">
                            <div class="row dark-grey">
                                <div class="col-7 user">

                                    <div class="user-image">
                                        <?php
                                        $full_name = explode(" ", $comment->comment_author);
                                        $last_word = "";
                                        $first_word = strtoupper(substr($full_name[0], 0, 1));
                                        if (isset($full_name[1])) {
                                            $last_word = strtoupper(substr($full_name[1], 0, 1));
                                        } else {
                                            $last_word = strtoupper(substr($full_name[0], 1, 1));
                                        }
                                        ?>
                                        <h6 style="background-color: aquamarine;height: 90px;text-align: center;align-items: center;padding-top: 20px;font-weight: bolder;">
                                            <?php echo $first_word ?><?php echo $last_word; ?>
                                        </h6>
                                    </div>
                                    <div class="user-info"><h3><?php echo $comment->comment_author; ?></h3><span
                                                class="date"><?php echo human_time_diff(strtotime($comment->comment_date), current_time('timestamp', 1)); ?> ago</span>
                                    </div>
                                </div>
                                <div class="col-5 comment-title">

                                </div>
                                <div class="col-12 comments-content">
                                    <?php echo $comment->comment_content; ?>
                                    </p>
                                </div>
                            </div>
                            <?php $results = $wpdb->get_results("SELECT COUNT(*) as t_records FROM wp_comments_likes where wp_comments_id='" . $comment->comment_ID . "' AND status=1", OBJECT);
                            $total_records = $results[0]->t_records;
                            $results1 = $wpdb->get_results("SELECT COUNT(*) as t_records1 FROM wp_comments_likes where wp_comments_id='" . $comment->comment_ID . "' AND status=2", OBJECT);
                            $total_records1 = $results1[0]->t_records1;
                            ?>
                            <div class="col-12 cooment-footer">
                                <div class="row">
                                    <div class="col-7 col-md-7 reply">
                                        <?php
                                        $args = array(
                                            'parent' => $comment->comment_ID,
                                            'count' => true,
                                            'orderby' => 'comment_date',
                                            'order' => 'ASC'

                                        );
                                        $questions = get_comments($args);
                                        if ($questions>1){
                                            $reply_name="Replies";
                                        }else{
                                            $reply_name="Reply";
                                        }

                                        ?>
                                        <span><a href="javascript:void(0)"
                                                 id="btnreply<?php echo $comment->comment_ID; ?>" class="btnreply"
                                                 btnreply="<?php echo $comment->comment_ID; ?>"><i
                                                        class="fa fa-reply reply" class="btnreply"
                                                        btnreply1="<?php echo $comment->comment_ID; ?>"
                                                        aria-hidden="true"></i> <?php echo $questions; ?>  </a> <a
                                                    href="javascript:void(0)"
                                                    btnreply="<?php echo $comment->comment_ID; ?>" class="btnreply"><?php echo $reply_name; ?></a></span>
                                    </div>
                                    <div class="col-5 col-md-5 reply-vote">
                                        <div class="vote<?php echo $comment->comment_ID; ?>">
                                            <?php wp_nonce_field('my_nonce'); ?>
                                            <button class="add views1<?php echo $comment->comment_ID; ?>"><i
                                                        class="fa fa-thumbs-o-up"
                                                        aria-hidden="true"></i><?php echo $total_records; ?>
                                                <input type="hidden" id="comments_id" name="comments_id"
                                                       value="<?php echo $comment->comment_ID; ?>">
                                                <input type="hidden" id="dislikes" name="dislikes"
                                                       value="<?php echo $total_records1; ?>">
                                                <input type="hidden" id="userid" name="userid"
                                                       value="<?php echo $current_user->ID; ?> ">
                                            </button>
                                            <button class="minus views2<?php echo $comment->comment_ID; ?>"><i
                                                        class="fa fa-thumbs-o-down"
                                                        aria-hidden="true"></i><?php echo $total_records1; ?>
                                                <input type="hidden" id="likes" name="likes"
                                                       value="<?php echo $total_records; ?>">
                                                <input type="hidden" id="userid" name="userid"
                                                       value="<?php echo $current_user->ID; ?> ">
                                                <input type="hidden" id="comments_id" name="comments_id"
                                                       value="<?php echo $comment->comment_ID; ?>">
                                            </button>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div id="repliescomments<?php echo $comment->comment_ID; ?>" style="display: none"
                                         class="repliescomments">
                                        <?php $comment_childrens = $comment->get_children();


                                        foreach ($comment_childrens as $comment_children) :?>

                                            <?php $results = $wpdb->get_results("SELECT COUNT(*) as t_records FROM wp_comments_likes where wp_comments_id='" . $comment_children->comment_ID . "' AND status=1", OBJECT);
                                            $total_records = $results[0]->t_records;
                                            $results1 = $wpdb->get_results("SELECT COUNT(*) as t_records1 FROM wp_comments_likes where wp_comments_id='" . $comment_children->comment_ID . "' AND status=2", OBJECT);
                                            $total_records1 = $results1[0]->t_records1;
                                            ?>

                                            <div class="col-9 reply-content reply_see<?php echo $comment_children->comment_ID; ?>">
                                                <span><?php echo $comment_children->comment_author; ?></span>
                                                <p><?php echo $comment_children->comment_content; ?>
                                                </p>
                                                <div class="reply-vote">
                                                    <div class="vote<?php echo $comment_children->comment_ID; ?>">
                                                        <?php wp_nonce_field('my_nonce'); ?>
                                                        <button class="add add_reply views1<?php echo $comment_children->comment_ID; ?>">
                                                            <i class="fa fa-thumbs-o-up"
                                                               aria-hidden="true"></i><?php echo $total_records; ?>
                                                            <input type="hidden" id="comments_id" name="comments_id"
                                                                   value="<?php echo $comment_children->comment_ID; ?>">
                                                            <input type="hidden" id="dislikes" name="dislikes"
                                                                   value="<?php echo $total_records1; ?>">
                                                            <input type="hidden" id="userid" name="userid"
                                                                   value="<?php echo $current_user->ID; ?> ">
                                                        </button>
                                                        <button class="minus minus_reply views2<?php echo $comment_children->comment_ID; ?>">
                                                            <i class="fa fa-thumbs-o-down"
                                                               aria-hidden="true"></i><?php echo $total_records1; ?>
                                                            <input type="hidden" id="likes" name="likes"
                                                                   value="<?php echo $total_records; ?>">
                                                            <input type="hidden" id="userid" name="userid"
                                                                   value="<?php echo $current_user->ID; ?> ">
                                                            <input type="hidden" id="comments_id" name="comments_id"
                                                                   value="<?php echo $comment_children->comment_ID; ?>">
                                                        </button>
                                                    </div>

                                                </div>

                                            </div>
                                        <?php endforeach; ?>
                                        <div class="morecontent<?php echo $comment->comment_ID; ?>"></div>
                                    </div>
                                    <div class="morereplies<?php echo $comment->comment_ID; ?>"></div>

                                    <div class="col-10 comment-form reply-comment"
                                         id="replycomments<?php echo $comment->comment_ID; ?>">
                                        <?php
                                        $name = "";
                                        $email = "";
                                        if (get_field('must_login_to_comment') == "yes" AND !is_user_logged_in()) {
                                            ?>
                                            <p class="not-login">You have to login in order to reply to any comment on
                                                debate <a href="<?php echo home_url('signin'); ?>">Sign In </a>or
                                                <a href="<?php echo home_url('signup'); ?>">Sign Up</a></p>
                                        <?php } else { ?>
                                            <div class="errorreply" style="color: red"></div>

                                            <form class="user-reply-comment" method="post" id="comments_replies"
                                                  data-rel="<?php echo $comment->comment_ID; ?>"
                                                  encypte="multipart/formdata">
                                                <div class="user-image">
                                                    <?php


                                                    if (is_user_logged_in()) {
                                                        $current_user = wp_get_current_user();
                                                        $name = get_user_meta($current_user->ID, 'display_name', true);
                                                        if (empty($name)) {
                                                            $name = get_user_meta($current_user->ID, 'first_name', true) . " " . get_user_meta($current_user->ID, 'last_name', true);
                                                        }
                                                        $email = $current_user->user_email;

                                                        ?>
                                                        <h6 style="background-color: aquamarine;height: 90px;text-align: center;align-items: center;padding-top: 15px;font-weight: bolder;">
                                                            <?php echo strtoupper(substr(get_user_meta($current_user->ID, 'first_name', true), 0, 1)); ?><?php echo strtoupper(substr(get_user_meta($current_user->ID, 'last_name', true), 0, 1)); ?>
                                                        </h6>
                                                    <?php } else {
                                                        ?>
                                                        <h6 style="background-color: aquamarine;height: 90px;text-align: center;align-items: center;padding-top: 15px;font-weight: bolder;">
                                                            DA
                                                        </h6>
                                                    <?php } ?>
                                                </div>
                                                <?php wp_nonce_field('my_nonce'); ?>
                                                <div class="user-details">
                                                    <input type="text" id="name" name="name" placeholder="Name Here"
                                                           value="<?php echo $name; ?>" class="reply-name"/>
                                                    <input type="hidden" id="email" name="email"
                                                           value="<?php echo $email; ?>" placeholder="Janedoe@2021.com"
                                                           class="reply-email" required/>
                                                </div>
                                                <input type="hidden" id="postid" name="postid"
                                                       value="<?php echo $post->ID; ?> ">
                                                <input type="hidden" id="comments_id" name="comments_id"
                                                       value="<?php echo $comment->comment_ID; ?>">

                                                <textarea class="reply-area" id="replies" name="replies"
                                                          placeholder="Reply Here"></textarea>
                                                <button type="submit" class="reply-comment-btn">Post Reply</button>


                                            </form>
                                        <?php } ?>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    $i++;
                endforeach;?>




                <div class="modal fade login" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body row">
                                <div class="col-md-12 detail-content">
                                    <h3>Login</h3>
                                    <?php echo apply_shortcodes('[miniorange_social_login shape="longbuttonwithtext" view="horizontal" appcnt="3" theme="default" space="10" width="250" height="35" color="000000"]') ?>
                                    <span class="or"></span>

                                    <div class="sign-up-form">
                                        <form>
                                            <div class="row">
                                                <div class="col-sm-12 col-12">
                                                    <?php wp_nonce_field( 'my_nonce' ); ?>
                                                    <input type="text" id="loginemail" name="loginemail" placeholder="Username or Email Address">
                                                    <input type="password" id="loginpassword" name="loginpassword" placeholder="Password">
                                                    <button class="signup-sumbit" id="login" type="submit">login</button>
                                                    <div id="loginerror" style="color:red"></div>
                                                    <div class="success"></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!----end comments------->

<?php  endwhile;
wp_reset_query();// End of the loop.
?>





<section class="debates inner-debate related-debate">
    <div class="headings">
        <div class="row">
            <div class="col-7">
                <h1>Related Debates</h1>
            </div>
            <div class="col-5 read-more">
                <a href="<?php echo home_url('/debates'); ?>">Browse More<i class="fa fa-angle-right" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
    <div class="debate-holder debate-slider">
        <div id="innerdebate" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="carousel-inner">


                <div class="carousel-item active">
                    <div class="row">

                        <?php $args = array(
                            'post__not_in'   => array( $id), // post ids
                            'post_type'      => 'debate',
                            'orderby'        => 'ASC',
                            'posts_per_page' => '3',
                            'category_name'=>$category_name

                        );

                        $the_query = new WP_Query( $args );

                        while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                            <div class="col-12 col-md-4 col-sm-6 debate-card">
                                <a  href="<?php the_permalink(); ?>">
                                    <div class="image-holder">
                                        <img src="<?php echo the_post_thumbnail_url('full'); ?>" alt="<?php the_title();?>">
                                        <div class="col-sm-5 voting">

                                        </div>

                                    </div>
                                    <div class="content">
                                        <h3><?php the_title();?></h3>
                                        <span class="join">Join</span>
                                    </div>
                                </a>
                            </div>

                        <?php endwhile;
                        wp_reset_query();

                        ?>


                    </div>

                </div>
                <!--end of slider  item-->


                <!-- <div class="controllers">
                 <ul class="carousel-indicators">
                    <li data-target="#innerdebate" class="active" data-slide-to="0"></li>
                    <li data-target="#innerdebate" data-slide="next"></li>
                     <li data-target="#innerdebate" data-slide="next"></li>
                  </ul>
                </div> -->
            </div>
        </div>

    </div>
</section>

<?php

get_footer(); ?>

<script type="text/javascript">
    $(document).ready(function () {





        //$("div").on( "keypress", "#message", function()
        $('form#comments_replies').submit(function(e){
            e.preventDefault();

            var email=$(this).find("#email").val();
            var postid=$(this).find("#postid").val();
            var name=$(this).find("#name").val();
            var replies=$(this).find("#replies").val();
            var comments_id=$(this).find("#comments_id").val();
            var _wpnonce=$(this).find("#_wpnonce").val();

            var  ammount=$("#btnreply"+comments_id).text();

            ammount++ ;

            // console.log(ammount);

            $(".errorreply").html("");
            if (replies == "" || replies.match(/^[a-zA-Z\s]+$/) == false) {
                $(".error").html("Please fill reply field");
                return false
            }
            if (name == "") {
                $(".errorcomment").html("Please fill display name field");
                return false
            }


//console.log(replies);



            jQuery.ajax({
                type:"POST",
                url:"<?php bloginfo( 'template_url' ); ?>/proc/replies.php",
                data: {
                    email:email,
                    postid : postid,
                    name:name,
                    replies:replies,
                    comments_id:comments_id,
                    _wpnonce:_wpnonce

                },
                dataType: 'html',
                cache: false,
                success: function(response){
                    $("form#comments_replies").trigger('reset');

                    $("#btnreply"+comments_id).html('<i class="fa fa-reply reply"  class="btnreply" btnreply1="'+comments_id+'" aria-hidden="true"></i>'+ammount+'&nbsp;');
                    $(".morecontent"+comments_id).append(response);

                    // console.log(response);
                    //console.log("awesome");
                },
                error: function(results) {

                }
            });



        });

        $('form#comment').submit(function(e){
            e.preventDefault();

            var email=$(this).find("#email").val();
            var postid=$(this).find("#postid").val();
            var name=$(this).find("#name").val();
            var comment_reply=$(this).find("#comment_reply").val();
            var _wpnonce=$(this).find("#_wpnonce").val();

            //console.log(name);

            //var  ammount=$("#btnreply"+comments_id).text();

            //ammount++ ;

            // console.log(ammount);

            $(".errorcomment").html("");
            if (name == "") {
                $(".errorcomment").html("Please fill display name field");
                return false
            }

            if (comment_reply == "") {
                $(".errorcomment").html("Please fill comment field");
                return false
            }


//console.log(replies);



            jQuery.ajax({
                type:"POST",
                url:"<?php bloginfo( 'template_url' ); ?>/proc/comments.php",
                data: {
                    email:email,
                    postid : postid,
                    name:name,
                    comment_reply:comment_reply,
                    _wpnonce:_wpnonce

                },
                dataType: 'html',
                cache: false,
                success: function(response){
                    location.reload();
                },
                error: function(results) {
                    location.reload();
                }
            });



        });









        $('body').on('click', '.add', function(e) {
            e.preventDefault();


            var postid= $(this).find("#comments_id").val();

            var dislikes= $(this).find("#dislikes").val();



            var likes= $('.views1'+postid).text();


            var userid=$(this).find("#userid").val();
            var _wpnonce=$("#_wpnonce").val();

            jQuery.ajax({
                type:"POST",
                url:"<?php echo admin_url('admin-ajax.php'); ?>",
                data: {
                    action: "like_comment",
                    likes : likes,
                    dislikes:dislikes,
                    postid : postid,
                    userid:userid,
                    _wpnonce:_wpnonce

                },
                dataType: 'html',
                cache: false,
                success: function(response){
                    $('.vote'+postid).html(response);
                    // console.log(response);
                    //console.log("awesome");
                },
                error: function(results) {

                }
            });


        });



        $('body').on('click', '.minus', function(e) {
            e.preventDefault();
            var postid= $(this).find("#comments_id").val();


            var likes= $('.views2'+postid).text();
            var liks= $(this).find("#likes").val();




            var userid=$(this).find("#userid").val();

            var _wpnonce=$("#_wpnonce").val();

            jQuery.ajax({
                type:"POST",
                url:"<?php echo admin_url('admin-ajax.php'); ?>",
                data: {
                    action: "dislike_comment",
                    likes : likes,
                    liks:liks,
                    postid : postid,
                    userid:userid,
                    _wpnonce:_wpnonce

                },
                dataType: 'html',
                cache: false,
                success: function(response){
                    $('.vote'+postid).html(response);
                    // console.log(response);
                    //console.log("awesome");
                },
                error: function(results) {

                }
            });
            // console.log("awesome");
        });

        //reply_like
        $('body').on('click', '.add_reply', function(e) {
            e.preventDefault();


            var postid= $(this).find("#comments_id").val();

            var dislikes= $(this).find("#dislikes").val();



            var likes= $('.views1'+postid).text();


            var userid=$(this).find("#userid").val();
            var _wpnonce=$("#_wpnonce").val();

            jQuery.ajax({
                type:"POST",
                url:"<?php echo admin_url('admin-ajax.php'); ?>",
                data: {
                    action: "like_comment",
                    likes : likes,
                    dislikes:dislikes,
                    postid : postid,
                    userid:userid,
                    _wpnonce:_wpnonce

                },
                dataType: 'html',
                cache: false,
                success: function(response){
                    $('.vote'+postid).replaceWith(response);
                    // console.log(response);
                    //console.log("awesome");
                },
                error: function(results) {

                }
            });


        });



        $('body').on('click', '.minus_reply', function(e) {
            e.preventDefault();
            var postid= $(this).find("#comments_id").val();


            var likes= $('.views2'+postid).text();
            var liks= $(this).find("#likes").val();




            var userid=$(this).find("#userid").val();

            var _wpnonce=$("#_wpnonce").val();

            jQuery.ajax({
                type:"POST",
                url:"<?php echo admin_url('admin-ajax.php'); ?>",
                data: {
                    action: "dislike_comment",
                    likes : likes,
                    liks:liks,
                    postid : postid,
                    userid:userid,
                    _wpnonce:_wpnonce

                },
                dataType: 'html',
                cache: false,
                success: function(response){
                    $('.vote'+postid).replaceWith(response);
                    // console.log(response);
                    //console.log("awesome");
                },
                error: function(results) {

                }
            });
            // console.log("awesome");
        });



        $('#like').on('click', function(event){
            event.preventDefault();
            $("#like").toggleClass("like-green");
            $("#dislike").removeClass("like-red");
            var post_id = $(this).attr('data-postid');
            jQuery.ajax({
                type:"POST",
                url:"<?php echo admin_url('admin-ajax.php'); ?>",
                data: {
                    action: "user_liking_post",
                    post_id : post_id,

                },
                dataType: 'json',
                cache: false,
                success: function(response){
                    window.location=document.location.href;

                },
                error: function(results) {
                    window.location=document.location.href;
                }
            });



        });


        $('#dislike').on('click', function(event){
            event.preventDefault();
            $("#dislike").toggleClass("like-red");
            $("#like").removeClass("like-green");
            var post_id = $(this).attr('data-postid');
            jQuery.ajax({
                type:"POST",
                url:"<?php echo admin_url('admin-ajax.php'); ?>",
                data: {
                    action: "user_disliking_post",
                    post_id : post_id,

                },
                dataType: 'json',
                cache: false,
                success: function(response){
                    window.location=document.location.href;

                },
                error: function(results) {
                    window.location=document.location.href;
                }
            });
        });
    });
</script>
