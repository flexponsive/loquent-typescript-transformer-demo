<?php
namespace App\Enums;
/** @typescript */
enum UserRole : string {
    case ADMIN = 'admin';
    case GUEST =  'guest';
    case PROFESSIONAL = 'professional';
}