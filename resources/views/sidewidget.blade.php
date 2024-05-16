<?php
$widget = DB::table('widget')->where('nama_widget','Side Widget')->first();
?>
{!! $widget->code !!}