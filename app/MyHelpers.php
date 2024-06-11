<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use App\Models\Favorite;

class MyHelpers
{

    /**
     * @param string $originalName
     * @return string
     */
    public static function encryptFileName(string $originalName): string{
        return substr(md5(time() . $originalName), 0, 80);
    }

    /**
     * @param $file
     * @param string $path
     * @return string
     */
    public static function uploadFile($file, string $path): string{
        // encrypt the file name
        $extension = $file->getClientOriginalExtension();
        $encryptedName = self::encryptFileName($file->getClientOriginalName() . time() . rand(1, 9));
        $fileName = $encryptedName . '.' . $extension;
        $file->move($path, $fileName);
        return $fileName;
    }

    /**
     * @param $image
     * @param string $relativePath
     * @return string
     */
    public static function uploadImage($image, string $relativePath): string{
        return MyHelpers::uploadFile($image, public_path($relativePath));
    }

    /**
     * @param string $imageName
     * @param string $relativePath
     * @return void
     */
    public static function deleteImageFromStorage(string $imageName, string $relativePath){
        // delete image from the uploaded images file
        $image = public_path($relativePath) . $imageName;
        try {
            unlink($image);
        }catch (Exception $exception){
            // log that exception
        }
    }

    /**
     * @param string $timestamp
     * @return string
     */
    public static function getDiffOfDate(string $timestamp): string{
        $result = Carbon::parse($timestamp)->diffForHumans();
        return $result;
    }

    public static function calculateMonthsPaid($totalAmountPaid, $monthlyRent)
    {
        if ($monthlyRent <= 0) {
            return 0; // Avoid division by zero
        }

        // Calculate the number of months paid
        $monthsPaid = floor($totalAmountPaid / $monthlyRent);

        return $monthsPaid;
    }

    public static  function calculateRentExpirationDate($startDate, $monthsPaid)
    {
        $start = Carbon::parse($startDate);

        // Add the months paid to the start date
        $expirationDate = $start->addMonths($monthsPaid);

        return $expirationDate;
    }

    public static function checkPropertyTypeByFavoriteId($id)
        {
      
      
          $favorite = Favorite::find($id);
      
          if (!empty($favorite->house_id)) {
      
            return "house";
          } elseif (!empty($favorite->room_id)) {
      
            return "room";
          } elseif (!empty($favorite->studio_id)) {
      
            return "studio";
          } elseif (!empty($favorite->apartment_id)) {
      
            return "apartment";
          } elseif (!empty($favorite->land_id)) {
      
            return "land";
          } elseif (!empty($favorite->vehicle_id)) {
      
            return "vehicle";
          } elseif (!empty($favorite->car_id)) {
      
            return "car";
          } elseif (!empty($favorite->bike_id)) {
      
            return "bike";
          } else {
      
            return 0;
          }
        }
    
        public static function getPropertyTypeIdByFavoriteId($id)
        {
        
        
            $favorite = Favorite::find($id);
        
            if (!empty($favorite->house_id)) {
      
            return "house";
            } elseif (!empty($favorite->room_id)) {
        
            return "room";
            } elseif (!empty($favorite->studio_id)) {
        
            return "studio";
            } elseif (!empty($favorite->apartment_id)) {
        
            return "apartment";
            } elseif (!empty($favorite->land_id)) {
        
            return "land";
            } elseif (!empty($favorite->vehicle_id)) {
        
            return "vehicle";
            } elseif (!empty($favorite->car_id)) {
        
            return "car";
            } elseif (!empty($favorite->bike_id)) {
        
            return "bike";
            } else {
        
            return 0;
            }
        }
}
