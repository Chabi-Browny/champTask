 @extends('layout')

@section('content')
<div class="container">
    <div class="page-title mx-auto my-5">
        <h2>Table Soccer Championship registration and team election</h2>
    </div>
    {{ html()->form('PUT', '/champReg')->open() }}
    <div class="row my-3">
        <div class="col-3">
            <h4>Championship name</h4>
        </div>
        <div class="col-9">
            {{ html()->text('champ_name', null)->attributes(['class'=>'form-control']) }}
        </div>
    </div>
    <div class="row">
        <div class="col-4">Team Names</div>
        <div class="col-4">Striker</div>
        <div class="col-4">Goolkeeper</div>
    </div>
    <div class="team-wrapper">
        <div class="row  my-3">
            <div class="col-4">
                {{ html()->text('tmn_1', null)->attributes(['class'=>'form-control player-one', 'placeholder' => 'Team 1']) }}
            </div>
            <div class="col-4">
                {{ html()->text('tmm_1_p1', null)->attributes(['class'=>'form-control player-one', 'placeholder' => 'Player 1']) }}
            </div>
            <div class="col-4">
                {{ html()->text('tmm_1_p2', null)->attributes(['class'=>'form-control player-two', 'placeholder' => 'Player 2']) }}
            </div>
        </div>
        <div class="row  my-3">
            <div class="col-4">
                {{ html()->text('tmn_2', null)->attributes(['class'=>'form-control player-one', 'placeholder' => 'Team 2']) }}
            </div>
            <div class="col-4">
                {{ html()->text('tmm_2_p1', null)->attributes(['class'=>'form-control player-one', 'placeholder' => 'Player 1']) }}
            </div>
            <div class="col-4">
                {{ html()->text('tmm_2_p2', null)->attributes(['class'=>'form-control player-two', 'placeholder' => 'Player 2']) }}
            </div>
        </div>
    </div>
    <div class="action-btn-group my-3">
        {{ html()->button('Add Team', 'button')->attributes(['name' => 'add_team', 'class' => 'btn btn-outline-success', 'onclick' => 'addingTeam()']) }}
        {{ html()->submit('Register')->attributes(['name' => 'reg','class' => 'btn btn-primary', 'onclick' => 'submitTeams()' ]) }}
    </div>
    {{ html()->form()->close() }}
    <div class="match-list-wall"></div>
    <div class="submit-result"></div>
</div>
@endsection