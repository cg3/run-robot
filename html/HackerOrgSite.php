<?php
include 'credentials.php';

class HackerOrgSite
{
    public function getHtmlForLevel()
    {
        $this->login(HACKER_NAME, HACKER_PASS);
        return $this->htmlSite();
    }
    
    private function login($name, $pass)
    {
        exec("wget -q --load-cookies cookies.txt --save-cookies cookies.txt --keep-session-cookies -U mozilla --post-data='username=".$name."&password=".$pass."&autologin=on&redirect=&login=Log+in' --delete-after http://www.hacker.org/forum/login.php");
    }
    
    private function htmlSite()
    {
	    exec("wget -q --load-cookies cookies.txt --save-cookies cookies.txt --keep-session-cookies -U mozilla -O level.html http://www.hacker.org/runaway/index.php");
	    // ?gotolevel=127
        return file_get_contents("level.html");
    }
    
    public function send($answer)
    {
        exec("wget -q --load-cookies cookies.txt --save-cookies cookies.txt --keep-session-cookies -U mozilla -O result.txt \"http://www.hacker.org/runaway/index.php?path=$answer\"");
    }
}
