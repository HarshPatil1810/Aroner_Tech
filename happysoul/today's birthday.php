<?php
// just returns the users having a birthday
function birthday_today() {
    $result = mysql_query("SELECT username FROM users` WHERE MONTH(birthday) = MONTH(NOW()) AND DAY(birthday) = DAY(NOW())");
    $users = array();
    while ($row = mysql_fetch_assoc($result))
        $users[] = $row['username'];
    return $users;
}

// make a unordered-list out of the users having birthday
$ul = "<ul>";
foreach(birthday_today() as $username)
    $ul .= "<li>$username</li>";
$ul .= "</ul>";

echo $ul;
?>