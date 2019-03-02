<?php 

/**
 * Helper function for flashing messages. By default it's a success
 * flash message, but can be changed to display warning or danger messages.
 * 
 * @param $message string
 * @param $title default 'Success!'
 * @param $type default 'success', can be 'warning' and 'danger'
 */
function flash($message, $title = 'Success!', $type = 'success')
{
	session()->flash('message', [
		'text'  => $message,
		'title' => $title,
		'type'  => $type,
	]);
}

/**
 * Helper function for highlightning selected links in the navigation sidebar.
 * Used in blade files.
 * 
 * @param $route string
 * @param $output default 'active'
 */
function isActiveRoute($route, $output = 'active')
{
    if (Route::currentRouteName() == $route) {
        return $output;
    }
}