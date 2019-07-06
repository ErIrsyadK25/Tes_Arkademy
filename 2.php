<?php
function ValidateUser($username)
{
    return preg_match('/^((?!([0-9]))[a-zA-Z0-9]{5,9})$/', $username);
}
function ValidatePassword($password)
{
    return preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\@])\S*$/', $password);
}


if (ValidateUser("1Arkademy")) {
    echo "Username Is Valid";
} else {
    echo "Username Is Invalid";
}
echo "</br>";
if (ValidatePassword("p@ssW0rd#")) {
    echo "Password Is Valid";
} else {
    echo "Password Is Invalid";
}
?>
