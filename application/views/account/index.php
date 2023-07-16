<?php 
  echo '
    <ul>
      <li id="email">' . $_SESSION['user']['email'] . '</li>
      <li><a href="/logout/">Выйти</a></li>
    </ul>
    ';
?>
