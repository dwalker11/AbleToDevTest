@extends('layouts.app')

@section('content')
  <div class="container" id="app">
    <div class="row">
      <div class="col-md-12">
        <h1>Wellness Survey</h1>
        <p>Please answer the following questions.</p>
      </div>
      <div class="col-md-12">
        <div class="progress">
          <div class="progress-bar" role="progressbar" aria-valuenow="00" aria-valuemin="0" aria-valuemax="100" v-bind:style="{ width: (completeness * 100) + '%' }">@{{ (completeness * 100) + '%' }}</div>
        </div>
      </div>
    </div>

    <hr>

    <form method="post" action="/surveys">
      {{ csrf_field() }}

      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default" v-show="current == i" v-for="(question, i) in questions">
            <div class="panel-heading">
              <h3 class="panel-title">Question #@{{ i + 1 }}</h3>
            </div>
            <div class="panel-body">
              <div>@{{ question.text }}</div>
              <div class="radio" v-for="(option, j) in question.options">
                <label>
                  <input type="radio" v-bind:name="'question' + (i + 1)" v-bind:id="'optionsRadios' + (j + 1)" v-bind:value="option.id" v-on:click="answer(i)">
                  @{{ option.text }}
                </label>
              </div>
            </div>
          </div>
          <button class="btn btn-default" type="button" v-on:click="prev" v-bind:class="{ disabled: current == 0 }">Prev</button>
          <button class="btn btn-primary" type="button" v-on:click="next" v-bind:class="{ disabled: current == questions.length - 1 }">Next</button>
        </div>
      </div>

      <hr>

      <div class="row" v-if="completeness == 1">
        <div class="col-md-offset-3 col-md-6">
          <button class="btn btn-primary btn-block" type="submit">Submit</button>
        </div>
      </div>
    </form>

  </div>
@endsection

@section('script')
  <script>
    var questions = {!! $questions !!};

    var app = new Vue({
      el: '#app',
      data: {
        current: 0,
        questions: questions
      },
      computed: {
        completeness: function () {
          var answered = this.questions.filter(function (question) {
            return question.answered;
          });

          return answered.length / this.questions.length;
        }
      },
      methods: {
        next: function () {
          if (this.current != this.questions.length - 1) {
            this.current += 1;
          }
        },
        prev: function () {
          if (this.current != 0) {
            this.current -= 1;
          }
        },
        answer: function (index) {
          this.questions[index].answered = true;
        },
        validate: function (e) {
          if (completeness != 1) {
            e.preventDefault();
          }
        }
      }
    });
  </script>
@endsection
