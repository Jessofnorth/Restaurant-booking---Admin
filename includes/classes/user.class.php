
<?php
/* @author Jessica Ejelöv - jeej2100@student.miun.se */

class User {

      // logout user by destroying session
      public function logoutUser()
      {
          session_destroy();
          header("Location: index.php");
          exit;
      }
}

