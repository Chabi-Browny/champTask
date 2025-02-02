@extends('layout')

@section('content')
<div class="container">
    <div class="page-title mx-auto my-5">
        <h2>Register score of the teams of the matches</h2>
    </div>
    {{ html()->form('POST', '/scoreReg')->open() }}
    <div class="row my-3">
        <div class="col-3">
            <h4 class="fw-bold">Championship name</h4>
        </div>
        <div class="col-9">
            {{ html()->text('champ_name', $matches['championship']['name'])->attributes(['class'=>'form-control', 'readonly']) }}
            {{ html()->hidden('champ_id', $matches['championship']['id']) }}
        </div>
    </div>
    <div class="row">
        <div class="col-3 fw-bold">Match Date</div>
        <div class="col-3 fw-bold">Team 1 Name</div>
        <div class="col-3 fw-bold">Team 2 Name</div>
        <div class="col-3 fw-bold">Scores</div>
    </div>
    <div class="team-wrapper">
        <?php
            if(!empty($matches)):
                foreach($matches as $key => $match):
                    if(is_int($key)):
            ?>
                <div class="row my-2">
                    <div class="col-3">
                        @if(!empty($match['date']))
                            {{ $match['date'] }}
                        @endif
                    </div>
                    <div class="col-3">
                        <?php if(!empty($match['team_one_id']) && !empty($match['team_one_id']['name'])) { echo $match['team_one_id']['name']; } ?>
                    </div>
                    <div class="col-3">
                        <?php if(!empty($match['team_two_id']) && !empty($match['team_two_id']['name'])) { echo $match['team_two_id']['name']; } ?>
                    </div>
                    <div class="col-3">
                        {{ html()->text('scores['.$match['id'].']', null)->attributes(['class'=>'form-control player-two', 'placeholder' => 'exp: 10:1']) }}
                    </div>
                </div>
        <?php
                    endif;
                endforeach;
            endif;
        ?>
    </div>
    <div class="action-btn-group">
        {{ html()->submit('Register')->attributes(['name' => 'score_reg','class' => 'btn btn-primary' ]) }}
    </div>
    {{ html()->form()->close() }}
</div>
@endsection
