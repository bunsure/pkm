<?php
$widget = DB::table('widget')->where('nama_widget','Bottom Widget')->first();
?>
{!! $widget->code !!}