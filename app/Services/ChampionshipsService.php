<?php

namespace App\Services;

use App\Models\Championships;
use App\Models\Matches;
use App\Models\Player;
use App\Models\Teams;
use App\Helper\DateTimeHelper;
/**
 * Description of ChampionshipsService
 */
class ChampionshipsService
{
    /**/
    public function addPlayer($playerData): array
    {
        if (mb_strlen($playerData['p1']) >= 150 || mb_strlen($playerData['p1']) >= 150)
        {
            throw new \Exception('Invalid parameter length');
        }

        $player1Id = null;
        $player2Id = null;

        $player = new Player();
        $player->where('name', $playerData['p1'])
               ->orWhere('name', $playerData['p2'])
               ->get();

        if (empty($player->toArray()))
        {
            $player->name = $playerData['p1'];
            $player->save();
            $player1Id = $player->id;

            $player = new Player();
            $player->name = $playerData['p2'];
            $player->save();
            $player2Id = $player->id;
        }

        return [ 'striker' => (int) $player1Id, 'keeper' => (int) $player2Id ];
    }

    /**/
    public function addTeams(array $teamDatas, array $playerIds): array
    {
        if (is_numeric($playerIds['striker']) && is_numeric($playerIds['keeper']))
        {
            $team = new Teams();
            $team->where('name', $teamDatas['teamName'])
                 ->get();

            if (empty($team->toArray()))
            {
                if (mb_strlen($teamDatas['teamName']) >= 255)
                {
                    throw new \Exception('Invalid parameter length');
                }

                $team->name = $teamDatas['teamName'];
                $team->player_one_id = $playerIds['striker'];
                $team->player_two_id = $playerIds['keeper'];
                $team->save();

                return [
                    'id' => (int) $team->id,
                    'name' => $teamDatas['teamName'],
                ];
            }
        }
    }

    /**/
    public function addChampionship(string $champName): int
    {
        if (mb_strlen($champName) >= 255)
        {
            throw new \Exception('Invalid parameter length');
        }

        $champ = new Championships();
        $champ->where('name', $champName)
              ->get();

        if (empty($champ->toArray()))
        {
            $champ->name = $champName;
            $champ->save();

            return (int) $champ->id;
        }
    }

    /**/
    public function addMatches(array $teamPairs, array $teamsIds, int $champId )
    {
        $count = 0;
        foreach ($teamPairs as $teamPair)
        {
            $date = new DateTimeHelper();
            $team1 = $teamPair['team1'];
            $team2 = $teamPair['team2'];

            $team1Ids = $teamsIds[$team1['teamName']];
            $team2Ids = $teamsIds[$team2['teamName']];

            $match = new Matches();
            $match->date = $date->getModifiedDate('+' . (string) $count . 'day');
            $match->championship_id = $champId;
            $match->team_one_id = $team1Ids;
            $match->team_two_id = $team2Ids;

            $match->save();

            $count++;
        }
    }

    /**/
    public function getMatches($champId)
    {
        $matches = new Matches();
        $results = $matches->where('championship_id', $champId)->get();
        $retVal = $results->toArray();
        if (!empty($retVal))
        {
            $champ = $results[0]->championships->toArray();

            foreach($results as $key => $res)
            {
                unset($retVal[$key]['championship_id']);
                $retVal[$key]['team_one_id'] = $res->teamOneTeams->toArray();
                $retVal[$key]['team_two_id'] = $res->teamTwoTeams->toArray();

            }
            $retVal['championship'] = $champ;

            return $retVal;
        }
    }

    /**/
    public function updateMatches($champId, $scores)
    {
        $matches = new Matches();
        $matchRes = $matches->where('championship_id',$champId)->get();
        if (!empty($matchRes))
        {
            foreach($matchRes as $match)
            {
                $scoreArr = explode(':', $scores[$match->id]);
                $match->team_one_score = $scoreArr[0];
                $match->team_two_score = $scoreArr[1];
                $match->save();
            }
        }
    }

    public function getToplists($champId)
    {
        $matches = new Matches();
        $matchRes = $matches->where('championship_id',$champId)->get();

        $topTeam1Score =  $matchRes->max('team_one_score');

    }

}
