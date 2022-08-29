 @extends('layout')

@section('content')
<div class="container">
    <div class="page-title">
        <h2>Championship Registration and Team Election</h2>
    </div>
    {!! Form::open(['url' => '/champReg']) !!}
    <div class="row">
        <div class="col-2">
            <h4>Championship name</h4>
        </div>
        <div class="col-10">
            {{ Form::text('champ_name', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="row">
        <div class="col-4">Team Names</div>
        <div class="col-4">Striker</div>
        <div class="col-4">Goolkeeper</div>
    </div>
    <div class="team-wrapper">
        <div class="row">
            <div class="col-4">
                {{ Form::text('tmn_1', 'Team 1', ['class' => 'form-control player-one']) }}
            </div>
            <div class="col-4">
                 {{ Form::text('tmm_1_p1', null, ['class' => 'form-control player-one', 'placeholder' => 'Player 1']) }}
            </div>
            <div class="col-4">
                {{ Form::text('tmm_1_p2', null, ['class' => 'form-control player-two', 'placeholder' => 'Player 1']) }}
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                {{ Form::text('tmn_2', 'Team 2', ['class' => 'form-control player-one']) }}
            </div>
            <div class="col-4">
                {{ Form::text('tmm_2_p1', null, ['class' => 'form-control player-one', 'placeholder' => 'Player 1']) }}
            </div>
            <div class="col-4">
                {{ Form::text('tmm_2_p2', null, ['class' => 'form-control player-two', 'placeholder' => 'Player 2']) }}
            </div>
        </div>
    </div>
    <div class="action-btn-group">
        {{ Form::button('Add Team', ['name' => 'add_team', 'class' => 'btn btn-outline-success', 'onclick' => 'addingTeam()']) }}
        {{ Form::submit('Register', ['name' => 'reg','class' => 'btn btn-primary', 'onclick' => 'submitTeams()' ]) }}
    </div>
    {!! Form::close() !!}
    <div class="match-list-wall"></div>
    <div class="submit-result"></div>
</div>
@endsection