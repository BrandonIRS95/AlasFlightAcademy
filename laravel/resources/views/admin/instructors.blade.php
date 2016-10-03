@extends('layouts.master-admin')
@section('individual-styles')

    <style>

        .panel {
            float: left;
            margin-left: 12%;
            width: 60%;
            margin-top: 30px;
            font-family: "HelveticaNeue-Light", "Helvetica-Neue", "Helvetica", "Arial", "Sans-serif", "serif";
        }
        .edit{
            cursor: pointer;
        }

    </style>
@endsection

@section('content')
    <div class="panel panel-default">
        <table class="table table" >
            <thead>
            <tr>
                <td><h4><strong>Id</strong></h4></td>
                <td><h4><strong>Name</strong></h4></td>
                <td><h4><strong>Created at</strong></h4></td>
                <td><h4><strong></strong></h4></td>

            <tr>
            </thead>
            @foreach($posts as $post)
                <tr class="post">
                    <td class="people">{{$post->id}}</td>
                    <td class="people">{{$post->person->last_name}} {{$post->person->first_name}}</td>
                    <td class="people">{{$post->created_at}}</td>
                    <td class="edit"><button class="btn btn-primary">Edit</button></td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection


@section('javascript') @endsection