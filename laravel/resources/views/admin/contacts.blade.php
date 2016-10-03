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
            cursor: pointer;
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
            <article class="post" data-id="{{$post->id}}">
                <p> {{$post->question}}</p>
                <div class="info">
                    Posted by {{$post->first_name}} on {{$post->created_at}}
                </div>
            </article>
            @endforeach
        </div>
    </section>
    <section>
        <div class="col-md-6 col-md-offset-3" id="mailForm">
            <form action="{{route('sendmail')}}" method="post" class="formSend">
              <div class="form-group">
                  <p type="email" name="mail" class="form-control" id="toEmail"></p>
              </div>                
              <div class="form-group">
                <input name="title" type="text" class="form-control" >
              </div>                   
              <button type="submit" id="submit" class="btn btn-default">Submit</button>
                {{csrf_field()}}
            </form>
        </div>
    </section>
@endsection
@section('javascript')
    <script src="{{URL::to('js/admin/animations.js')}}"></script>
    <script src="{{URL::to('js/TweenMax.min.js')}}"></script>
    <script type="text/javascript">
        
        $('#mailForm').hide();
        
        $( "#submit" ).click(function() {
            $( "#mailForm" ).hide("fast");
      
        });
        
        
     $('.post').on('click', function(event) {
            $('#mailForm').show("fast");

            var $postBody =  $(event.currentTarget);
            var idContact = $postBody.attr('data-id');
            console.log(idContact);

            getContactById(idContact).done(function (response) {
                console.log(response);
                $('#toEmail').html(response.contact.email);
            });
        });

            function getContactById(id)
            {
            return $.ajax({
                method: 'get',
                url: '{{route('getContactById')}}'+'/id',
                data: {'id' : id}
            });
        }
       

    </script>
 @endsection

