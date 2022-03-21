<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

class Tournament
{
    public function __construct()
    {
    }

    public function tally(string $scores)
    {
        if (strlen($scores) === 0){
            return  "Team                           | MP |  W |  D |  L |  P";
        }

        $data = [];
        $matchs = explode("\n", $scores);
        foreach ($matchs as $match){
            $match = explode(";", $match);
            $team1 = $match[0];
            $team2 = $match[1];
            $scorr = $match[2];

            if(!array_key_exists($team1, $data)){
                $data[$team1] = [
                    'team' => $team1,
                    'mp' => 0,
                    'w' => 0,
                    'd' => 0,
                    'l' => 0,
                    'p' => 0
                ];
            }

            if(!array_key_exists($team2, $data)){
                $data[$team2] = [
                    'team' => $team2,
                    'mp' => 0,
                    'w' => 0,
                    'd' => 0,
                    'l' => 0,
                    'p' => 0
                ];
            }

            $data[$team1]['mp'] += 1;
            $data[$team2]['mp'] += 1;

            switch ($scorr){
                case 'win':
                    $data[$team1]['w'] = $data[$team1]['w'] + 1;
                    $data[$team2]['l'] = $data[$team2]['l'] + 1;
                    $data[$team1]['p'] = $data[$team1]['p'] + 3;
                    break;

                case 'loss':
                    $data[$team1]['l'] = $data[$team1]['l'] + 1;
                    $data[$team2]['w'] = $data[$team2]['w'] + 1;
                    $data[$team2]['p'] = $data[$team2]['p'] + 3;
                    break;

                case 'draw':
                    $data[$team1]['d'] = $data[$team1]['d'] + 1;
                    $data[$team2]['d'] = $data[$team2]['d'] + 1;
                    $data[$team1]['p'] = $data[$team1]['p'] + 1;
                    $data[$team2]['p'] = $data[$team2]['p'] + 1;
                    break;
            }
        }
        sort($data);
        usort($data, function ($team1, $team2){
            if($team1['p'] === $team2['p']){
                return 0;
            }
            return $team1['p'] < $team2['p']? 1: -1;

        });

        return $this->generateScoreBord($data);
    }

    private function generateScoreBord(array $data)
    {
        $scorebord = "Team                           | MP |  W |  D |  L |  P\n";

        foreach ($data as $team){
            $scorebord .= "".$this->setTeamName($team['team'])." |  ".$team['mp']." |  ".$team['w']." |  ".$team['d']." |  ".$team['l']." |  ".$team['p'];
            if (next($data)==true){
                $scorebord .= "\n";
            }
        }
        return $scorebord;

    }

    private function setTeamName(string $team){
        return "".$team.str_repeat(' ', 30-strlen($team));
    }
}
