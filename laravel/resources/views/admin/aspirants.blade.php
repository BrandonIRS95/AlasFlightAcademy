@extends('layouts.master-admin')

@section('individual-styles')
    <link rel="stylesheet" href="{{URL::to('css/admin/bootstrap.css')}}" >
        <style>
        .panel {
            float: left;
            width: 60%;
            margin-left: 5%;
            margin-top: 30px;
            font-family: "HelveticaNeue-Light", "Helvetica-Neue", "Helvetica", "Arial", "Sans-serif", "serif";
        }

        .people{
            cursor: pointer;
        }

    </style>

@endsection
@section('content')
    <section class="row posts">
        <div class="panel panel-default">
               <table class="table table-striped" >
                   <thead>
                        <tr>
                            <td><h4><strong>Name</strong></h4></td>
                            <td><h4><strong>Gender</strong></h4></td>
                            <td><h4><strong>City/Country of birth</strong></h4></td>
                            <td><h4><strong>Pilot program</strong></h4></td>

                        <tr>
                   </thead>
                   @foreach($posts as $post)
                   <tr class="posts" onclick="getAspirant({{$post}})">
                        <td class="people">{{$post->Person->last_name }} {{$post->Person->first_name}}</td>
                        <td class="people">{{$post->Person->gender}}</td>
                        <td class="people">{{$post->Person->city_country_of_birth}}</td>
                        <td class="people">{{$post->PilotProgram->name}}</td>
                   </tr>
                   @endforeach
               </table>
            {!! $posts->render() !!}
        </div>
        <button id="btn" class="btn btn-primary" >Atras</button>
    </section>
@endsection

@section('javascript')
    <script src="{{URL::to('js/jquery-migrate-1.4.1.min.js')}}"></script>
    <script type="text/javascript">

        var Aspirant = [];

        $("button.btn").ready(function () {
           $("button.btn").hide();
        });


        $("button.btn").click(function () {
           $("div.panel").show(1000);
            $("button.btn").hide();
        });

        $("td").click(function () {
            $("div.panel").hide(1000);
            $("button.btn").show();

        });

        function getAspirant() {

            console.log("{{$post}}");
        }


    </script>
 @endsection

