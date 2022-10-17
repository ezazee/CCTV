<?php
/*
 * PHP QR Code encoder
 *
 * Root library file, prepares environment and includes dependencies
 *
 * Based on libqrencode C library distributed under LGPL 2.1
 * Copyright (C) 2006, 2007, 2008, 2009 Kentaro Fukuchi <fukuchi@megaui.net>
 *
 * PHP QR Code is distributed under LGPL 3
 * Copyright (C) 2010 Dominik Dzienia <deltalab at poczta dot fm>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 * ######## *
 * Usage :
 * to generate qrcode image, call Class below with forecolor and back color and also include a logo on your php file :
 * QRcode::png("Qr_content", "the_filename.png", "H", 6, 4, 0, "0,0,0","255,255,255", "logo_path");
 * 1'st param: Qr_content, 2'nd param:the_filename path, 3'rd param:errorcorectionlevel, 4'th param:pixel width, 5'th param:margin,6'th param:saveandprint,7'th param:forecolor,
 * 8th param:backcolor, 9th param: logopath
 * modify by saidalfaruq ~ www.saidalfaruq.net ~batam~indonesia
 * ######### *
 */
	
	$QR_BASEDIR = dirname(__FILE__).DIRECTORY_SEPARATOR;
	
	// Required libs
	
	include $QR_BASEDIR."qrconst.php";
	include $QR_BASEDIR."qrconfig.php";
	include $QR_BASEDIR."qrtools.php";
	include $QR_BASEDIR."qrspec.php";
	include $QR_BASEDIR."qrimage.php";
	include $QR_BASEDIR."qrinput.php";
	include $QR_BASEDIR."qrbitstream.php";
	include $QR_BASEDIR."qrsplit.php";
	include $QR_BASEDIR."qrrscode.php";
	include $QR_BASEDIR."qrmask.php";
	include $QR_BASEDIR."qrencode.php";

