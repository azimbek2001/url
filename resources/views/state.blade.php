@extends('master')

@section('content')

	<div class="container">
		<table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Short Link</th>
                        <th>Link</th>
                        <th>count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shortLinks as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td><a href="{{ route('shorten.link', $row->code) }}" target="_blank">{{ route('shorten.link', $row->code) }}</a></td>
                            <td>{{ $row->link }}</td>
                            <td>{{ $row->count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


            <table class="table table-bordered table-sm">
                   <thead>
                    <tr>
                        <th>IP</th>
                        <th>Short Link</th>
                        <th>Count</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($userIps as $userIp)

                        <tr>
                            <td>{{ $userIp->ip }}</td>
                             
                            <td>{{$shortLinks[$userIp->links_id]->code}}</a></td>
                         
                            <td>{{ $userIp->count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


   <table class="table table-bordered table-sm">
                   <thead>
                    <tr>
                        <th>User Agent</th>
                        <th>Short Link</th>
                        <th>Count</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($userAgents as $agent)

                        <tr>
                            <td>{{ $agent->name }}</td>
                             
                            <td>{{$shortLinks[$agent->links_id]->code}}</a></td>
                         
                            <td>{{ $agent->count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

	</div>
 @endsection