<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

class WebScrapingController extends Controller
{
    // public function GetData()
    // {
    //     $client = new Client();
    //     $crawler = $client->request('GET', 'https://www.mlb.com/es/scores');
    //     /* $crawler->filter("[id='tb-4-body row-0 col-0']")->each(function ($node) {
    //         print $node->text()."\n";
    //     }); */
    //     $crawler->filter("[class='ScoresGamestyle__PaddingWrapper-sc-7t80if-5 btOCDf']")->each(function ($node)
    //     {
    //         $test = $node->filter("[class='TeamWrappersstyle__DesktopTeamWrapper-sc-uqs6qh-0 fdaoCu']")->text();
    //         $visit = $node->filter("[class='teamstyle__DataWrapper-sc-1suh43a-1 gLyCoL']")->text(); 

    //         echo($test . "-" . $visit."<br>");
    //     });
    // }

    public function GetCurrentMatches()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://www.espn.com.mx/beisbol/mlb/resultados');
        
        //CUADRO PRINCIPAL
        $crawler->filter("[class='ScoreboardScoreCell pa4 mlb baseball ScoreboardScoreCell--in ScoreboardScoreCell--tabletPlus']")->each(function ($node)
        {
            $this->localTeam = "";
            $this->runsLocal ="";
            $this->hitsLocal = "";
            $this->errorsLocal = "";

            $this->visitTeam = "";
            $this->runsVisit ="";
            $this->hitsVisit = "";
            $this->errorsVisit = "";

            $this->text = "";
            $this->aux = "";
            $this->parts = [];

            //VISITANTE
            $node->filter("[class='ScoreboardScoreCell__Item flex items-center relative pb2 ScoreboardScoreCell__Item--away']")->each(function($childNode)
            {
                $this->localTeam = $childNode->filter("[class='ScoreCell__TeamName ScoreCell__TeamName--shortDisplayName truncate db']")->text();
                $childNode->filter("[class='ScoreboardScoreCell_Linescores baseball flex justify-end']")->each(function($scoreBoard){
                    $scoreBoard->filter("[class='ScoreboardScoreCell__Value flex justify-center pl2 baseball']")->each(function($results){
                        $this->aux .= $results->text() . ",";
                    });
                });
            
            });
            $this->parts = explode(",",$this->aux);
            $this->runsVisit = $this->parts[0];
            $this->hitsVisit = $this->parts[1];
            $this->errorsVisit = $this->parts[2];
            //HOME
            $node->filter("[class='ScoreboardScoreCell__Item flex items-center relative pb2 ScoreboardScoreCell__Item--home']")->each(function($childNode)
            {
                $this->visitTeam = $childNode->filter("[class='ScoreCell__TeamName ScoreCell__TeamName--shortDisplayName truncate db']")->text();

                $childNode->filter("[class='ScoreboardScoreCell_Linescores baseball flex justify-end']")->each(function($scoreBoard){
                    $scoreBoard->filter("[class='ScoreboardScoreCell__Value flex justify-center pl2 baseball']")->each(function($results){
                        $this->aux .= $results->text() . ",";
                    });
                });
            }); 
            $this->parts = explode(",",$this->aux);
            $this->runsLocal = $this->parts[0];
            $this->hitsLocal = $this->parts[1];
            $this->errorsLocal = $this->parts[2];

            $this->text .="Visitante: " . $this->localTeam . "\n";
            $this->text .="R: " . $this->runsLocal . " H: " . $this->hitsLocal . " E: " . $this->errorsLocal . "\n";
            $this->text .="Local: " . $this->visitTeam . "\n";
            $this->text .="R: " . $this->runsVisit . " H: " . $this->hitsVisit . " E: " . $this->errorsVisit . "\n";
            $this->text .="_________________________________________\n";
            return $this->text;
        });
    }

    public function GetOldMatches()
    {
        $client = new Client();
        $tel = new TelegramController;
        $crawler = $client->request('GET', 'https://www.espn.com.mx/beisbol/mlb/resultados');
        $this->text = "";
        $this->test = "";
        $this->count = 0;
        $chat_id = "1475337310";
        
        //CUADRO PRINCIPAL
        $crawler->filter("[class='ScoreboardScoreCell pa4 mlb baseball ScoreboardScoreCell--post ScoreboardScoreCell--tabletPlus']")->each(function ($node)
        {
            $this->localTeam = "";
            $this->runsLocal ="";
            $this->hitsLocal = "";
            $this->errorsLocal = "";

            $this->visitTeam = "";
            $this->runsVisit ="";
            $this->hitsVisit = "";
            $this->errorsVisit = "";

            $this->aux = "";
            $this->partsLocal = [];
            $this->partsVisit = [];
            
            

            //VISITANTE
            $node->filter("[class='ScoreboardScoreCell__Item flex items-center relative pb2 ScoreboardScoreCell__Item--away ScoreboardScoreCell__Item--loser']")->each(function($childNode)
            {
                $this->localTeam = $childNode->filter("[class='ScoreCell__TeamName ScoreCell__TeamName--shortDisplayName truncate db']")->text();
                $childNode->filter("[class='ScoreboardScoreCell_Linescores baseball flex justify-end']")->each(function($scoreBoard){
                    $scoreBoard->filter("[class='ScoreboardScoreCell__Value flex justify-center pl2 baseball']")->each(function($results){
                        $this->aux .= $results->text() . ",";
                    });
                });
            
            });

            if($this->localTeam=="")
            {
                $node->filter("[class='ScoreboardScoreCell__Item flex items-center relative pb2 ScoreboardScoreCell__Item--away ScoreboardScoreCell__Item--winner']")->each(function($childNode)
                {
                    $this->localTeam = $childNode->filter("[class='ScoreCell__TeamName ScoreCell__TeamName--shortDisplayName truncate db']")->text();
                    $childNode->filter("[class='ScoreboardScoreCell_Linescores baseball flex justify-end']")->each(function($scoreBoard){
                        $scoreBoard->filter("[class='ScoreboardScoreCell__Value flex justify-center pl2 baseball']")->each(function($results){
                            $this->aux .= $results->text() . ",";
                        });
                    });
                
                });
            }
            $this->partsLocal = [];
            $this->partsLocal = explode(",",$this->aux);
            if(count($this->partsLocal)>1)
            {
                $this->runsLocal = $this->partsLocal[0];
                $this->hitsLocal = $this->partsLocal[1];
                $this->errorsLocal = $this->partsLocal[2];
            }
            $this->aux = "";
            
            //HOME
            $node->filter("[class='ScoreboardScoreCell__Item flex items-center relative pb2 ScoreboardScoreCell__Item--home ScoreboardScoreCell__Item--winner']")->each(function($childNode)
            {
                $this->visitTeam = $childNode->filter("[class='ScoreCell__TeamName ScoreCell__TeamName--shortDisplayName truncate db']")->text();

                $childNode->filter("[class='ScoreboardScoreCell_Linescores baseball flex justify-end']")->each(function($scoreBoard){
                    $scoreBoard->filter("[class='ScoreboardScoreCell__Value flex justify-center pl2 baseball']")->each(function($results){
                        $this->aux .= $results->text() . ",";
                    });
                });
            });

            if($this->visitTeam=="")
            {
                $node->filter("[class='ScoreboardScoreCell__Item flex items-center relative pb2 ScoreboardScoreCell__Item--home ScoreboardScoreCell__Item--loser']")->each(function($childNode)
                {
                    $this->visitTeam = $childNode->filter("[class='ScoreCell__TeamName ScoreCell__TeamName--shortDisplayName truncate db']")->text();

                    $childNode->filter("[class='ScoreboardScoreCell_Linescores baseball flex justify-end']")->each(function($scoreBoard){
                        $scoreBoard->filter("[class='ScoreboardScoreCell__Value flex justify-center pl2 baseball']")->each(function($results){
                            $this->aux .= $results->text() . ",";
                        });
                    });
                });
            }
            $this->partsVisit = [];
            $this->partsVisit = explode(",",$this->aux);
            if(count($this->partsVisit)>1)
            {
                $this->runsVisit = $this->partsVisit[0];
                $this->hitsVisit = $this->partsVisit[1];
                $this->errorsVisit = $this->partsVisit[2];
            }
            $this->aux = "";
            
            $this->text .="Visitante: " . $this->localTeam . "\n";
            $this->text .="R: " . $this->runsLocal . " H: " . $this->hitsLocal . " E: " . $this->errorsLocal . "\n";
            $this->text .="Local: " . $this->visitTeam . "\n";
            $this->text .="R: " . $this->runsVisit . " H: " . $this->hitsVisit . " E: " . $this->errorsVisit . "\n";
            $this->text .="_________________________________________\n";

            
        });
        
        //echo($this->text);
        //$tel->sendMessage($chat_id,$this->text);
        
        return $this->text;
    }
}
