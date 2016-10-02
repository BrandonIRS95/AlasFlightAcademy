@extends('layouts.master-admin')

@section('individual-styles')
    <style>
        .posts header{
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
        }
        .post{
            padding-left: 10px;
            border-left: 3px solid #0D47A1;
            margin-bottom: 30px;
        }
        .post .info{
            color: #aaa;
            font-style: italic;
        }

    </style>
@endsection
@section('content')
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>People who whant to know about us!</h3></header>
            @foreach($posts as $post)
            <article class="post">
                <p> {{$post->question}}</p>
                <div class="info">
                    Posted by {{$post->first_name}} on {{$post->created_at}}
                </div>
                <div class="interactions">
                    <a href="#">Delete</a> |
                    <a href="#">Answer</a>
                </div>
            </article>
            @endforeach
        </div>
    </section>
    <section>
        <div class="col-md-6 col-md-offset-3">
            <form>
              <div class="form-group">
                <label for="exampleInputEmail1">To</label>
                <input type="email" class="form-control" id="toEmail">
              </div>
                 <div class="form-group">
                <label for="exampleInputEmail1">From</label>
                <input type="email" class="form-control" id="fromEmail">
              </div>
              <div class="form-group">
                <textarea class="form-control" rows="5"></textarea>
              </div>                   
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </section>
@endsection
@section('javascript')
    <script src="{{URL::to('js/admin/animations.js')}}"></script>
    <script src="{{URL::to('js/TweenMax.min.js')}}"></script>
    <script type="text/javascript">

       

    </script>
 @endsection

