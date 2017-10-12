<?php 
  ini_set('display_errors', 0);
error_reporting( E_WARNING | E_PARSE);  
    session_start();  
 $user=$_SESSION['sess_user'];
 $aid=$_SESSION['aid'];
 $name=$_SESSION['cname'];	
 $aida=$_SESSION['aida'];
 $namea=$_SESSION['cnamea'];
 $aidam=$_SESSION['aidam'];
 $nameam=$_SESSION['cnameam'];
 $aidan=$_SESSION['aidan'];
 $namean=$_SESSION['cnamean'];
 $aiddmp=$_SESSION['aiddmp'];
 $namedmp=$_SESSION['cnamedmp'];
 $aidgame=$_SESSION['aidgame'];
 $namegame=$_SESSION['cnamegame'];
 $aidgraphic=$_SESSION['aidgraphic'];
 $namegraphic=$_SESSION['cnamegraphic'];
 $aidiot=$_SESSION['aidiot'];
 $nameiot=$_SESSION['cnameiot'];
 $aidmw=$_SESSION['aidmw'];
 $namemw=$_SESSION['cnamemw'];



    require_once("scripts/connect_db.php");
    $index_selecting_quiz = mysql_query("SELECT quiz_id, display_questions, time_allotted, quiz_name
                                    FROM quizes WHERE set_default=1");
    $index_selecting_quiz_row = mysql_fetch_array($index_selecting_quiz);
    $index_selecting_quiz_num = mysql_num_rows($index_selecting_quiz);

    $user_taken = "";
    if(isset($_POST['user_msg']) && $_POST['user_msg']!=""){
        $user_taken = $_POST['user_msg'];
    }
    if(isset($_GET['user_msg']) && $_GET['user_msg']!=""){
        $user_taken = $_GET['user_msg'];
    }

    $total_questions = preg_replace('/[^0-9]/', "", $index_selecting_quiz_row['display_questions']);
    $total_time = preg_replace('/[^0-9]/', "", $index_selecting_quiz_row['time_allotted']);
    $quizName = $index_selecting_quiz_row['quiz_name'];

    if($index_selecting_quiz_num>0)
    	$first_item = 'You\'ve got '.$total_time.' mins for attempting '.$total_questions.' questions.';
    else
    	$first_item = '<strong>Sorry, but it seems there are no quizzes Available right now!</strong>';
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>Instructions</title>

        <!-- ****** faviconit.com favicons ****** -->
            <!-- Basic favicons -->
                <link rel="shortcut icon" sizes="16x16 32x32 48x48 64x64" href="img/faviconit/favicon.ico">
                <link rel="shortcut icon" type="image/x-icon" href="img/faviconit/favicon.ico">

            <!--[if IE]><link rel="shortcut icon" href="/favicon.ico"><![endif]-->

            <!-- For Opera Speed Dial -->
                <link rel="icon" type="image/png" sizes="195x195" href="img/faviconit/favicon-195.png">
            <!-- For iPad with high-resolution Retina Display running iOS ≥ 7 -->
                <link rel="apple-touch-icon" sizes="152x152" href="img/faviconit/favicon-152.png">
            <!-- For iPad with high-resolution Retina Display running iOS ≤ 6 -->
                <link rel="apple-touch-icon" sizes="144x144" href="img/faviconit/favicon-144.png">
            <!-- For iPhone with high-resolution Retina Display running iOS ≥ 7 -->
                <link rel="apple-touch-icon" sizes="120x120" href="img/faviconit/favicon-120.png">
            <!-- For iPhone with high-resolution Retina Display running iOS ≤ 6 -->
                <link rel="apple-touch-icon" sizes="114x114" href="img/faviconit/favicon-114.png">
            <!-- For Google TV devices -->
                <link rel="icon" type="image/png" sizes="96x96" href="img/faviconit/favicon-96.png">
            <!-- For iPad Mini -->
                <link rel="apple-touch-icon" sizes="76x76" href="img/faviconit/favicon-76.png">
            <!-- For first- and second-generation iPad -->
                <link rel="apple-touch-icon" sizes="72x72" href="img/faviconit/favicon-72.png">
            <!-- For non-Retina iPhone, iPod Touch and Android 2.1+ devices -->
                <link rel="apple-touch-icon" href="img/faviconit/favicon-57.png">
            <!-- Windows 8 Tiles -->
                <meta name="msapplication-TileColor" content="#FFFFFF">
                <meta name="msapplication-TileImage" content="img/faviconit/favicon-144.png">
        <!-- ****** faviconit.com favicons ****** -->

        <link rel="stylesheet" type="text/css" href="css/master.css">
        <script type="text/javascript" src="scripts/overlay.js"></script>

        <script type="text/javascript">
            function submit(){
                var x=document.forms["onlyForm"]["rollno"].value;
                if (x==null || x==""){
                    document.getElementById("enter_rollno").innerHTML = "Please Enter Your Roll No.";
                    exit();
                }
                document.getElementById('myForm').submit(); 
                return false;
            }
        </script>

        <script language="javascript">
            document.addEventListener("contextmenu", function(e){
                e.preventDefault();
            }, false);
        </script>

    </head>

  

        <div id="main_body" align="center">
            <h2>So, you want to try your luck at the <big>QUIZ</big></h2>
            <strong><?php echo $quizName; ?> </strong>
            <h3 align="left">Here are the rules then:</h3>
            <div align="left">
                <ul>
                    <li><?php echo $first_item; ?></li>
                    <li>If time runs out, your quiz will automatically be submitted</li>
                    <li>You'll only be getting confirmation pop-up once if you try to leave during the quiz</li>
                    <li>You can only attempt the quiz once</li>
                </ul>
            </div>

            <h3>GOOD LUCK!</h3>

            <form id="myForm" name="onlyForm" action="quiz.php" method="POST">
                <table align="center">
                    <tr>
                        <td align="center">
                            <input type="text" name="rollno" placeholder="Enter Your Roll No." autofocus/>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <h3>Click below when you are ready to start the quiz</h3>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <a href="javascript:submit();" class="myButton">Click Here to Begin</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div id = "enter_rollno" align="center"><?php echo $user_taken ?></div>
                        </td>
                    </tr>
                </table>
            </form>
        </div><br><br><br><br><br><br>

        <div id="video" class="white_content">
            <a name="Planet_Earth">
                <video id="video_player" controls preload="meta" height="480">
                    <source src="videos/video.mp4" type='video/mp4' />
                    <source src="videos/video.webmhd.webm" type='video/webm' />
                    Your browser doesn't seem to support the video tag.
                </video>
                
            </a>
        </div>

        <div id="fade_overlay">
            <a href="javascript:close_overlay();" style="cursor: default;">
                <div id="fade" class="black_overlay">
                </div>
            </a>
        </div>

        
    </body>
</html>

