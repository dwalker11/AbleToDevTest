@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Wellness Survey</h1>
        <p>Please answer the following questions.</p>
      </div>
    </div>

    <hr>

    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Question #1</h3>
          </div>
          <div class="panel-body">
            <div>What did you eat for breakfast?</div>
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                Option one is this and that&mdash;be sure to include why it's great
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                Option two can be something else and selecting it will deselect option one
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
                Option three is disabled
              </label>
            </div>
          </div>
        </div>
        <button class="btn btn-default" type="button">Prev</button>
        <button class="btn btn-primary" type="button">Next</button>
      </div>
    </div>

    <hr>

    <div class="row">
      <div class="col-md-10">
        <div class="progress">
          <div class="progress-bar" role="progressbar" aria-valuenow="00" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">0%</div>
        </div>
      </div>
      <div class="col-md-2">
        <button class="btn btn-primary btn-block" type="button">Submit</button>
      </div>
    </div>

  </div>
@endsection
