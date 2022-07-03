<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

class WebScrapingController extends Controller
{
    public function GetData()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://www.mlb.com/es/scores');
        /* $crawler->filter("[id='tb-4-body row-0 col-0']")->each(function ($node) {
            print $node->text()."\n";
        }); */
        $crawler->filter("[class='ScoresGamestyle__PaddingWrapper-sc-7t80if-5 btOCDf']")->each(function ($node)
        {
            $test = $node->filter("[class='TeamWrappersstyle__DesktopTeamWrapper-sc-uqs6qh-0 fdaoCu']")->text();
            $visit = $node->filter("[class='teamstyle__DataWrapper-sc-1suh43a-1 gLyCoL']")->text(); 

            echo($test . "-" . $visit."<br>");
        });
    }
}
