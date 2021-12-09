@extends('emails.layout')
@section('content')

<table width="100%">
	<tr>
		<th align="left" width="1" style="white-space: nowrap" valign="top">First name:&nbsp;</th><td>{{ $first_name }}</td>
	</tr>
	<tr>
		<th align="left" width="1" style="white-space: nowrap" valign="top">Last name:&nbsp;</th><td>{{ $last_name }}</td>
	</tr>
	<tr>
		<th align="left" width="1" style="white-space: nowrap" valign="top">Company:&nbsp;</th><td>{{ $company }}</td>
	</tr>
	<tr>
		<th align="left" width="1" style="white-space: nowrap" valign="top">Email:&nbsp;</th><td><a href="mailto:{{ $email }}">{{ $email }}</a></td>
	</tr>
	<tr>
		<th align="left" width="1" style="white-space: nowrap" valign="top">Country:&nbsp;</th><td>{{ $country }}</td>
	</tr>
	<tr>
		<th align="left" width="1" style="white-space: nowrap" valign="top">Comment:&nbsp;</th><td>{!! nl2br($comment) !!}</td>
	</tr>
</table>

@endsection
