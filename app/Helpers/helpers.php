<?php

/**
 * Helper function for flashing messages. By default it's a success
 * flash message, but can be changed to display warning or danger messages.
 *
 * @param  string $message
 * @param  string $title   default 'Success!'
 * @param  string $type    default 'success', can be 'warning' and 'danger'
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
 * Helper function for highlighting selected links in the navigation sidebar.
 * Used in blade files.
 *
 * @param  string $route
 * @param  string $output default 'active'
 * @return default|string
 */
function isActiveRoute($route, $output = 'active')
{
    if (Route::currentRouteName() == $route) {
        return $output;
    }
}
