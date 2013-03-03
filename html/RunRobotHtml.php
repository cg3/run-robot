<?php

class RunRobotHtml
{
    private $siteCode;
    private $site;
    
    public function getLevel()
    {
        $this->site = new HackerOrgSite();
        $this->siteCode = $this->site->getHtmlForLevel();
    }
    
    public function gameArray()
    {
        return HtmlConverter::toArray($this->siteCode);
    }
    
    public function sendAnswer($answer)
    {
        $this->site->send($answer);
    }
}

