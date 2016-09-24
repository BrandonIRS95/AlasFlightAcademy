@extends('layouts.master-admin')

@section('individual-styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        .panel {
            float: left;
            width: 40%;
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


               <table class="table table-striped">
                   <thead>
                        <tr>
                            <td><h4><strong>Name</strong></h4></td>
                            <td><h4><strong>Gender</strong></h4></td>
                            <td><h4><strong>City/Country of birth</strong></h4></td>
                        <tr>
                   </thead>
                   @foreach($posts as $post)
                   <tr class="posts" onclick="getAspirant().$post = $posts">
                        <td class="people"> {{$post->Person->last_name }} {{$post->Person->first_name}}</td>
                        <td class="people">{{$post->Person->gender}}</td>
                        <td class="people">{{$post->Person->city_country_of_birth}}</td>
                   </tr>
                   @endforeach
               </table>

        </div>
    </section>
@endsection

@section('javascript')
    <script src="{{URL::to('js/admin/bootstrap.js')}}"></script>
    <script src="{{URL::to('js/jquery-migrate-1.4.1.min.js')}}"></script>
    <script type="text/javascript">

    var Aspirant = [];

    function getAspirant() {
        var data = Aspirant.post;
        console.log(data);
    }
    </script>
 @endsection

