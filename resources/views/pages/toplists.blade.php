 @extends('layout')

@section('content')
<div class="container">
    <div class="page-title">
        <h2>The TOP lists</h2>
    </div>
    <div class="row">
        <div class="col-2">
            <h4>Championship name</h4>
        </div>
        <div class="col-10">
            <!--{{// Form::text('champ_name', $matches['championship']['name'], ['class' => 'form-control', 'readonly']) }}-->
            <!--{{// Form::hidden('champ_id', $matches['championship']['id']) }}-->
        </div>
    </div>
    <div class="row">
        <div class="col-3">Match Date</div>
        <div class="col-3">Team 1 Name</div>
        <div class="col-3">Team 2 Name</div>
        <div class="col-3">Scores</div>
    </div>
    <div class="team-wrapper">
        <?php
            if(!empty($matches)):
//                foreach($matches as $key => $match):
//                    if(is_int($key)):
            ?>
                <div class="row">
                    <div class="col-3">
<!--                        @if(!empty($match['date']))
                        @endif-->
                    </div>
                    <div class="col-3">
                        <?php // if(!empty($match['team_one_id']) && !empty($match['team_one_id']['name'])) { echo $match['team_one_id']['name']; } ?>
                    </div>
                    <div class="col-3">
                        <?php // if(!empty($match['team_two_id']) && !empty($match['team_two_id']['name'])) { echo $match['team_two_id']['name']; } ?>
                    </div>
                    <div class="col-3">
                        <!--{{ Form::text('scores['.$match['id'].']', null, ['class' => 'form-control player-two', 'placeholder' => 'exp: 10:1']) }}-->
                    </div>
                </div>
        <?php
//                    endif;
//                endforeach;
            endif;
        ?>
    </div>
</div>
@endsection