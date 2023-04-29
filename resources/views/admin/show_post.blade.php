<!DOCTYPE html>
<html>
  <head> 

    @include('admin.css')

    <style type="text/css">
        .title_design{
            font-size:30px;
            font-weight:bold;
            color:white;
            padding:30px;
            text-align:center;
        }

        .table_design{
            border: 1px solid white;
            width:80%;
            text-align:center;
            margin-Left: 70px;
        }

        .th_design{
            background-color: pink;
        }

        .img_design{
            height: 100px;
            width: 150px;
            padding: 10px;
        }
    </style>
  </head>
  <body>

    @include('admin.header')

    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->

    @include('admin.sidebar')

      <!-- Sidebar Navigation end-->
      <div class="page-content">

        @if(session()->has('message'))

        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{session()->get('message')}}
        </div>

        @endif
        <h1 class="title_design">All Post</h1>

        <table class="table_design">
            <tr class="th_design">
                <th>Post title</th>

                <th>Description</th>

                <th>Posted by</th>

                <th>Post status</th>

                <th>UserType</th>

                <th>Image</th>

                <th>Delete</th>

                <th>Edit</th>

            </tr>

            @foreach($post as $post)

            <tr>
                <td>{{$post->title}}</td>
                <td>{{$post->description}}</td>
                <td>{{$post->name}}</td>
                <td>{{$post->post_status}}</td>
                <td>{{$post->usertype}}</td>
                <td>
                    <image class="img_design" src="postimage/{{$post->image}}">
                </td>

                <td>
                    <a href="{{url('delete_post',$post->id)}}" class="btn btn-danger" onclick="return confirm('Really want to Delete this post? :( ')">Delete</a>
                </td>

                <td>
                    <a href="{{url('edit_page',$post->id)}}" class="btn btn-success">Edit</a>
                </td>
            </tr>

            @endforeach
            
        </table>
      </div>

    @include('admin.footer')

    <script type="text/javascript">
        function confirmation(ev){
            ev.preventDefault();

            var urlToRedirect=ev.currentTarget.getAtribute('href');

            console.Log(urlToRedirect);

            swal({
                title:"Really want to Delete this post? :( ",

                text : "You can't get back the post after this ",

                icon : "warning",

                buttons : true,

                dangerMode : true,
            })
            .then((willCancel)=>
            {
               if(willCancel){
                window.location.href=urlToRedirect;
               } 
            });
        }
    </script>

    
  </body>
</html>