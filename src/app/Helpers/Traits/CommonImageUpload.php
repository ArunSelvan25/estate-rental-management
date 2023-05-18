<?php

namespace App\Helpers\Traits;

use Illuminate\Support\Facades\Storage;

/**
 * Common image upload in disks
 */
trait CommonImageUpload {

    /**
     * @param file $attachment
     * @param string $type
     * @return string
     */
    public function imageUpload($attachment, string $type = ''): string
    {
        if($type != '' || $attachment != '') {
            /** Image extension */
            $attachmentExtension = $attachment->getClientOriginalExtension();
            /** Image mime type */
            $attachment->getClientMimeType();
            /** Image original name */
            $attachment->getClientOriginalName();
            /** Image size */
            $attachment->getSize();
            /** Set folder path */
            $folderName = 'erm-'.$type;
            /** Set image name */
            $imageName = 'erm-'.$type . '-' . time() .'.'.$attachmentExtension ;
            /** store image in storage path */
            $attachment->move(public_path('images/'.$type), $folderName.'/'.$imageName);
            /** Return image name */
            return $imageName;

        }
        return false;
    }

}
