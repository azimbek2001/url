@extends('master')

@section('content')

   
<div class="container">
    
    <h1>Вставьте URL-адрес, который нужно сократить</h1>
   <a href="{{route('statePage')}}">Статистика</a>
    <div class="card">
      <div class="card-header">
        <form method="POST" action="store">
            <div class="input-group mb-3">
              <input type="text" name="link" class="form-control" placeholder="Enter URL" a>
              <div class="input-group-append"  required="Не может быть пустым">
                <button class="btn btn-success" onclick="event.preventDefault();addLink(); " type="submit">Сохранить</button>
              </div>
            </div>
        </form>
      </div>
      <div class="card-body">
   
            @if (Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif
      @if (Session::has('error'))
                <div class="alert alert-error">
                    <p>{{ Session::get('error') }}</p>
                </div>
            @endif
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Short Link</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shortLinks as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td><a href="{{ route('shorten.link', $row->code) }}" target="_blank">{{ route('shorten.link', $row->code) }}</a></td>
                            <td>{{ $row->link }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
      </div>
    </div>
   
</div>
<script>
    function addLink(){
        const link =document.querySelector('input[name="link"]').value;
        if(link.replace(/\s+/g, '') !=""){
        
        let formdata=new FormData();
        formdata.append('link',link);
        fetch('{{ route('generate.shorten.link.post') }}',{
            method:"POST",
            body:formdata,
            headers:{
                "X-CSRF-TOKEN":document.querySelector('meta[name="csrf"]').getAttribute('content')
            }
        })
        location.reload();

    }}
</script>
 @endsection