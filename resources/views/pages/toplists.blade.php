 @extends('layout')

@section('content')
<div class="container">
    <div class="page-title">
        <h2>The TOP lists</h2>
    </div>
    <div class="team-wrapper">
            <?php
            if(!empty($champs)):
                foreach($champs as $champ):
            ?>
                <div class="row my-3">
                    <div class="col-3 fs-4 fw-semibold">
                        <span>Championship name:</span>
                    </div>
                    <div class="col-9 fs-4">
                        <span><?php echo $champ['name']; ?></span>
                    </div>
                    <div class="row">
                        <table class="table table-striped-columns text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Match Date</th>
                                    <th scope="col">Team 1 Name</th>
                                    <th scope="col">Scores</th>
                                    <th scope="col">Team 2 Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(!empty($champ['matches'])):
                                    foreach($champ['matches'] as $key => $match):

                                        $team1Score = $match['team_one_score'] ?? 0;
                                        $team2Score = $match['team_two_score'] ?? 0;
                                        $winnerLabel = ' The WINNER ';
                                        $winnerPointer = $team1Score > $team2Score ? '<-' . $winnerLabel : $winnerLabel . '->';
                                    ?>
                                    <tr>
                                        <th scope="row"><?php if(isset($match['date'])) echo $match['date']; ?></th>
                                        <td><?php if(isset($match['team_one_teams']['name'])) echo $match['team_one_teams']['name']; ?></td>
                                        <td>
                                            <div class=""><?php echo $team1Score . ' : ' . $team2Score; ?></div>
                                            <div class="fw-medium text-success">
                                                <h6><?php echo $winnerPointer; ?></h6>
                                            </div>
                                        </td>
                                        <td><?php if(isset($match['team_two_teams']['name'])) echo $match['team_two_teams']['name']; ?></td>
                                    </tr>
                                    <?php
                                    endforeach;
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php
                endforeach;
            endif;
            ?>
    </div>
</div>
@endsection