<html>
 <head>
 <title>Trying a facebook app</title>
 </head>
 <body>
 <h1>Who Am IIII? </h1> 
 <?php

//the next 4 lines will bring the Facebook SDK in to your program and initialize it
        require ("facebook.php");
        define("FACEBOOK_APP_ID", '303922503084013');
        define("FACEBOOK_SECRET_KEY", '65826b3708814bffa7267c5319d3e738');
        $facebook = new Facebook(array('appId' => FACEBOOK_APP_ID, 'secret' => FACEBOOK_SECRET_KEY));
        $uid = $facebook->getUser();
        echo $uid;
        if (!$uid)
           {echo '<h2>hi there</h2>';
            $loginUrl = $facebook->getLoginUrl();
               echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
               exit;
        }

       try {$uid = $facebook->getUser();
               print $uid; //this is the unique number that identifies a facebook user
               $user_profile = $facebook->api('/me','GET');
               echo "<br>First Name: " . $user_profile['first_name'];
               $profilepic= "https://graph.facebook.com/" . $user_profile['id'] ."/picture?type=large";
               echo "<p>URL Location of my facebook profile picture: " ;
               echo $profilepic; 
               $headers = get_headers ($profilepic, 1);
               $url = $headers['Location'];
              echo "<p>URL location of my facebook profile picture if I need to get at the .jpg file:";
              echo $url;
              echo "<img src=\" $profilepic \"/>";
              echo "<p>";
              $friends = $facebook->api('/me/friends',array('fields' => 'id,name,gender'));
              echo '<ul>';
               foreach ($friends["data"] as $value) {
                             echo '<li>';
                             echo '<div class="picName">'.$value["name"].$value["gender"].'<br></div>';
                             echo '</li>';
               }
               echo '</ul>'; 
         } catch (FacebookApiException $e) {
               print "in error exception";
               echo ($e);
         }
 ?>
 </body>
 </html>
