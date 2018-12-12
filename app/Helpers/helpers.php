<?php 

function flash($message, $type = 'success')
{
	session()->flash('message', [
		'title' => 'Success!',
		'text'  => $message,
		'type'  => $type
	]);
}