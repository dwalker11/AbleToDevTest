@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Wellness Results</h1>
        <p>Here are your results from the previous survey.</p>
      </div>
    </div>

    <hr>

    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            @foreach($surveyResult as $result)
              <div>
                <strong>{{ $result->question }}</strong><br>
                <span>{{ $result->answer }}</span>
              </div><br>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
