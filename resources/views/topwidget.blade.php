<?php
$widget = DB::table('widget')->where('nama_widget','Top Widget')->first();
?>
{!! $widget->code !!}